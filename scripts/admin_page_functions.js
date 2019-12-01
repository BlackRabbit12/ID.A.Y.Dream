/*
 * Authors: Shayna Jamieson, Keller Flint, Bridget Black
 * 2019-11-12
 * Last Updated: 2019-11-24
 * Version 1.0
 * File name: admin_page_functions.js
 * Associated Files: admin_page.php
 */


function addEditEvents() {
    $(".editInput").on("click", function () {
        //if we have not "set" the input_id by clicking on it, then it's null
        if (document.getElementById("input_id") == null) {
            //set paragraph to text input, use children[0] because we only have one child for each label
            let text = this.children[0].innerText;
            //creates a new element of type <input>
            let inputElement = document.createElement("input");
            //set the attribute id
            inputElement.setAttribute("id", "input_id");
            //set the attribute of <input>'s type to text
            inputElement.setAttribute("type", "text");
            //set the attribute of <input>'s value to 'text'
            inputElement.setAttribute("value", text);
            //remove the <p> element
            this.removeChild(this.children[0]);
            //append the new <input> to the <label>
            this.append(inputElement);
            //keep focus on current <input> (because "blur" drops focus)
            document.getElementById("input_id").focus();
            //after 'appends' a sibling, "append" a 'save' button to row for when edit is confirmed to send to database
            let saveBtn = "<button type=\"button\" id=\"save\" class=\"pull-left bg-success text-white btn btn-default btn-sm\">Save</button>";
            $(this).append(saveBtn);

            // $("#save").on("mousedown", function (event) {
            //     console.log("yay");
            // }); //.on

            //add event listener for when click outside of box to dump changes
            this.children[0].addEventListener("blur", function (event) {
                event.preventDefault();
                console.log("blurry");
                // get the <input>'s parent = <label>
                let parent = this.parentElement;
                //removes the <input>
                this.remove(this);
                //removes the 'save' button when "outside" of field click happens (looses focus)
                document.getElementById("save").remove();
                //create a new <p> element for updated admin value
                let p = document.createElement("p");
                //create a new Text Node for 'text'
                let textNode = document.createTextNode(text);
                //append 'textNode' to <p>
                p.append(textNode);
                //appends <p> to <label>
                parent.append(p);
            }); //.addEventListener

            $("#save").on("mousedown", function () {
                    //get user's id
                    let user_id = document.getElementById("user_id").children[0].innerText;
                    let key = document.getElementById("input_id").parentElement.getAttribute("id");
                    let value = document.getElementById("input_id").value;
                    console.log("user_id " + user_id); //**************************************************************************************
                    console.log("key " + key);
                    console.log("value " + value);
                    //updates the value in the selected field's database equivalent
                    $.ajax({
                        url: 'private/init.php',
                        method: 'post',
                        data: {user_id: user_id, table: "User", pKName: "user_id", key: key, value: value},
                        success: function (response) {
                            //update input with new value
                            $("#" + key).find("p").html(value);
                            //update the table data with new value. If user first, add a tags for link styling
                            if (key === "user_first") {
                                $("#" + user_id).children("." + key).html("<a href=\'#\'>" + value + "</a>");
                            } else {
                                $("#" + user_id).children("." + key).html(value);
                            }
                            let firstName = $("#" + user_id).children(".user_first").text();
                            let lastName = $("#" + user_id).children(".user_last").text();

                            //Top of modal display full name of member
                            $("#full-name").html(firstName + " " + lastName);
                            console.log(response); //************************************************************************************
                            //populateModalData(response);
                        }
                    }); //.ajax
                }
            ); //.on
        }

// else we have already clicked on the field so it has an input_id
        else {
            console.log("else"); //******************************************************************************************
        }
    })
    ; //.on


} //end function addEditEvents()

function addClickEvents() {
    //fills modal on 'click' of member's name
    console.log("click events"); //******************************************************************************************
    $(".update").on("click", function () {
        console.log("update clicked"); //************************************************************************************
        //get the 'id' of the row (parent of first name clicked)
        let id = this.parentElement.getAttribute("id");
        let firstName = $("#" + id).children(".user_first").text();
        let lastName = $("#" + id).children(".user_last").text();

        //get the selected table from "select" dropdown
        let dataSelect = tableSelected();

        //to be passed into .ajax
        $("#hidden-id").val(id);
        //Top of modal display full name of member
        $("#full-name").html(firstName + " " + lastName);

        $("#myModal").modal("toggle");

        //writes 'active' members to table
        $.ajax({
            url: 'private/init.php',
            method: 'post',
            data: {id: id, dataSelect: dataSelect},
            dataType: 'JSON',
            success: function (response) {
                console.log(response); //************************************************************************************
                populateModalData(response);
            }
        }); //.ajax
        //after ajax is done loading, then add the editable events
        $(document).ajaxComplete(function () {
            addEditEvents();
        }); //.ajaxComplete
    }); //.on
} //end function addClickEvents()

$(document).ready(function () {
    $('#dreamer-table').DataTable();
    $('#volunteer-table').DataTable();

    addClickEvents();

    // on page load if the user has chosen to look at the volunteers table we want to initialize
    // the position of the three switch toggle to active to start
    if (tableSelected() == "volunteers") {
        // change_status("active");
    }
}); //.ready

document.getElementById("data-select").addEventListener("change", function () {
    this.form.submit();
}); //addEventListener

$(document).ready(function () {
    // three toggle switch for Dreamers: Pending
    $("#pending-dreamer-label").on("click", function () {
        // make ajax call to update the display of pending volunteers
        $.ajax({
            url: 'private/init.php',
            method: 'post',
            data: {queryType: "pending_query"},
            success: function (response) {
                $("#dreamer-table").html(response);
            }
        }); //.ajax

        // need to re-update the click events on the page
        $(document).ajaxComplete(function () {
            addClickEvents();
            $("#dreamer-table").DataTable().destroy();
            $("#dreamer-table").DataTable();
        }); //.ajaxComplete
    }); //.on

    // three toggle switch for Dreamers: Active
    $("#active-dreamer-label").on("click", function () {
        // make ajax call to update the display of pending volunteers
        $.ajax({
            url: 'private/init.php',
            method: 'post',
            data: {queryType: "active_query"},
            success: function (response) {
                $("#dreamer-table").html(response);
            }
        }); //.ajax

        // need to re-update the click events on the page
        $(document).ajaxComplete(function () {
            addClickEvents();
            $("#dreamer-table").DataTable().destroy();
            $("#dreamer-table").DataTable();
        }); //.ajaxComplete
    }); //.on

    // three toggle switch for Dreamers: Inactive
    $("#inactive-dreamer-label").on("click", function () {
        // make ajax call to update the display of pending volunteers
        $.ajax({
            url: 'private/init.php',
            method: 'post',
            data: {queryType: "inactive_query"},
            success: function (response) {
                $("#dreamer-table").html(response);
            }
        }); //.ajax

        // need to re-update the click events on the page
        $(document).ajaxComplete(function () {
            addClickEvents();
            $("#dreamer-table").DataTable().destroy();
            $("#dreamer-table").DataTable();
        }); //.ajaxComplete
    }); //.on

    // the code here allows us to update/change the display of volunteers for active,
    // pending, and inactive. We have to make separate calls to update the table and use ajaxComplete()
    // NEW STUFF *************************************************************************************
    // ($("#toggle-inactive").is(":checked"))
    $("#pending-label").on("click", function () {
        // make ajax call to update the display of pending volunteers
        $.ajax({
            url: 'private/init.php',
            method: 'post',
            data: {queryType: "pending_volunteers_query"},
            success: function (response) {
                $("#dreamer-table").html(response);
            }
        }); //.ajax

        // need to re-update the click events on the page
        $(document).ajaxComplete(function () {
            addClickEvents();
            $("#dreamer-table").DataTable().destroy();
            $("#dreamer-table").DataTable();
        }); //.ajaxComplete
    }); //.on

    // for displaying ONLY active volunteers
    $("#active-label").on("click", function () {
        //change_status("active");

        // make ajax call to update the display of pending volunteers
        $.ajax({
            url: 'private/init.php',
            method: 'post',
            data: {queryType: "active_volunteers_query"},
            success: function (response) {
                $("#dreamer-table").html(response);
            }
        }); //.ajax

        // need to re-update the click events on the page
        $(document).ajaxComplete(function () {
            addClickEvents();
            $("#dreamer-table").DataTable().destroy();
            $("#dreamer-table").DataTable();
        }); //.ajaxComplete
    }); //.on

    // for displaying ONLY inactive volunteers
    $("#inactive-label").on("click", function () {
        //change_status("inactive");

        // make ajax call to update the display of pending volunteers
        $.ajax({
            url: 'private/init.php',
            method: 'post',
            data: {queryType: "inactive_volunteers_query"},
            success: function (response) {
                $("#dreamer-table").html(response);
            }
        }); //.ajax

        // need to re-update the click events on the page
        $(document).ajaxComplete(function () {
            addClickEvents();
            $("#dreamer-table").DataTable().destroy();
            $("#dreamer-table").DataTable();
        }); //.ajaxComplete
    }); //.on

    // toggle the modal for emailing functionality
    $("#email-button").on("click", function () {
        let str = tableSelected();
        str = str[0].toUpperCase() + str.substr(1, str.length);
        $("#email-modal-title").html("Email Active " + str);
        $("#emailModal").modal("toggle");
        $("#email-subject").on("input focus blur", function() {
            validateEmpty("email-subject");
        });
        $("#email-body").on("input focus blur", function() {
            validateEmpty("email-body");
        });
    }); //.on
}); //.ready

//JSON array
//appending all children into modal-body
function populateModalData(responseData) {

    // clear modal data before we populate -- added here as well
    // because in testing it was not clearing out the modal before re-populating
    $("#modal-body").html("");

    //for each data field, displaying 'key' and 'value' paired data into the modal
    $.each(responseData, function (key, value) {
        //create a textNode wrapping the field heading (the column's name (aka 'key'))
        let textNode = document.createTextNode(formatHeadings(key) + ":   ");
        //create a <label>
        let label = document.createElement('label');
        //assign the database column name to the label, formatting class = "editInput" used for function addEditEvents()
        label.setAttribute("id", key.substring(0, key.length - 1));
        // TODO add correct class and display style (dropdown or text field) inside the modal for consistent user experience
        label.classList.add("editInput");
        //append the textNode(with heading) to the <label>
        label.append(textNode);

        //the field value
        textNode = document.createTextNode(value);
        let p = document.createElement('p');
        p.append(textNode);

        //creates class for the modal input so it can be reassigned after save

        //append the key and value together
        label.append(p);

        //the modal body
        let modalB = document.getElementById("modal-body");
        //append key and value into the modal
        modalB.append(label);
    }); //.each
} //end populateModalData

//clears modal body after click away
$('#myModal').on('hidden.bs.modal', function () {
    $("#modal-body").html("");
}); //.on

// formats the heading names retrieved from database for clear user view
function formatHeadings(str) {
    str = str.replace(/\d+/g, '');
    str = str.replace(/_/g, " ");
    str = str.replace("user", "");
    str = str.replace("volunteer", "");
    str = str.replace("dreamer", "");
    if (str[0] == " ") {
        str = str.substr(1, str.length);
    }
    str = str[0].toUpperCase() + str.substr(1, str.length);
    return str;
} //function formatHeadings(str)

function tableSelected() {
    // get the selected table from "select" dropdown
    let dataSelect;
    if (document.getElementById('dreamer-option').selected) {
        dataSelect = 'dreamers';
    } else if (document.getElementById('volunteer-option').selected) {
        dataSelect = 'volunteers';
    }
    return dataSelect;
} //function tableSelected()

$("#email-send").on("click", function () {
    let subject = $("#email-subject").val();
    let body = $("#email-body").val();

    //get the selected table from "select" dropdown
    let dataSelect = tableSelected();

    if (subject.trim() == "" || body.trim() == "") {
        console.log("failed");
    } else {
        // make ajax call to update the display of pending volunteers
        $.ajax({
            url: 'private/init.php',
            method: 'post',
            data: {emailType: dataSelect, subject: subject, body: body},
            success: function (response) {
                //console.log(response);
                // get the number of emails sent to choose which modal to populate
                let emailCount = parseInt(response.substring(14, response.length - 1));

                // we display a failure pop up that notifies the sender that emails we not going through
                if (emailCount == 0) {
                    $("#email-body").val('').end();
                    $("#email-subject").val('').end();
                    $('#emailModal').modal('toggle');
                    alert("Emails were not able to be sent or you have no actives!");
                }
                // here we know that the emails sent and we can display a
                // success pop up and close the email modal
                else {
                    // clears out the email and body on successful send
                    $("#email-body").val('').end();
                    $("#email-subject").val('').end();
                    $('#emailModal').modal('toggle');
                    alert("Active " + dataSelect + ": " + emailCount + " emails were sent!");
                }
            }
        }); //.ajax
    }
});
