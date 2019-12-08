/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-11-12
 * Last Update: 2019-11-24
 * File name: admin_page_functions.js
 * Associated Files:
 *      admin_page.php
 *      private/init.php
 *      scripts/validation_functions.js
 *
 * Description:
 *      File contains **********************************************************************************
 */

// global variable allowSave. Is false when the data the admin is entering is invalid.
let allowSave = true;

function addEditEvents() {
    $(".editInput").on("click", function () {
        // get the id of the row that is being updated from the modal's user_id
        let id = $(this).parent().children("#user_id").children("p").first().text();
        console.log(id); //***************************************************************************************
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
            //after 'appends' a sibling, "append" a 'save' button to row for when edit is confirmed to send to database
            let saveBtn = "<button type=\"button\" id=\"save\" class=\"pull-left bg-success text-white btn btn-default btn-sm\">Save</button>";

            // check if the item being updated requires special formatting (date and phone number)
            if (this.id.includes("phone")) {
                // add event listener to format the phone number
                $("#input_id").on("keydown input focus", function() {
                    this.value = formatPhone(this.value);
                    allowSave = validatePhone(this.value);
                    console.log(allowSave);
                });
            } else if (this.id.includes("date")) {
                // add event listener to format the date
                $("#input_id").on("keydown input focus", function() {
                    this.value = formatDate(this.value);
                    allowSave = validateDate(this.value);
                    console.log(allowSave);
                });
            }

            document.getElementById("input_id").focus();

            $(this).append(saveBtn);

            // $("#save").on("mousedown", function (event) {
            //     console.log("yay");
            // }); //.on

            //add event listener for when click outside of box to dump changes
            this.children[0].addEventListener("blur", function (event) {
                event.preventDefault();
                console.log("blurry"); //************************************************************************************
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
                // if data is valid allow the ajax call
                if (allowSave) {
                    let column_name = document.getElementById("input_id").parentElement.getAttribute("id");
                    /*
                     * Collects data and values for running an update/edit on #save
                     * getUpdateData (admin_page_funcitons.js)
                     */
                    let data_to_update = getUpdateData(column_name);
                    //updates the value in the selected field's database equivalent
                    $.ajax({
                        url: 'private/init.php',
                        method: 'post',
                        data: {
                            table: data_to_update[0],
                            table_id: data_to_update[1],
                            column_name: data_to_update[2],
                            value: data_to_update[3],
                            id: data_to_update[4]
                        },
                        success: function (response) {
                            //update input with new value
                            $("#" + data_to_update[2]).find("p").html(data_to_update[3]);
                            //update the table data with new value. If user first, add a tags for link styling
                            if (data_to_update[2].toString() === "user_first") {
                                $("#" + data_to_update[4]).children("." + data_to_update[2]).html("<a href=\'#\'>" + data_to_update[3] + "</a>");
                                console.log("if"); //******************************************************************************
                            } else {
                                $("#" + data_to_update[4]).children("." + data_to_update[2]).html(data_to_update[3]);
                                console.log("else"); //*********************************************************************************
                            }
                            let firstName = $("#" + id).children(".user_first").text();
                            let lastName = $("#" + id).children(".user_last").text();

                            /*
                             * get the selected table from "select" dropdown
                             * tableSelected (admin_page_functions.js)
                             */
                            let dataSelect = tableSelected();
                            //get the status of member "inactive, active, pending"
                            let status;
                            if (dataSelect === "dreamers") {
                                status = $("#" + id).children(".dreamer_status").find("option:selected").text();
                            } else if (dataSelect === "volunteers") {
                                status = $("#" + id).children(".volunteer_status").find("option:selected").text();
                            }

                            //Top of modal display full name and status of member
                            $("#full-name-status").html(firstName + " " + lastName + " (" + status + ")");
                            console.log(response); //************************************************************************************
                            //populateModalData(response);
                        }
                    }); //.ajax
                } else {
                    alert("Save failed. Data was not properly formatted.");
                }
            }); //.on
        }
        // else we have already clicked on the field so it has an input_id
        else {
            console.log("else"); //******************************************************************************************
        }
    }); //.on
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

        /*
        * get the selected table from "select" dropdown
        * tableSelected (admin_page_functions.js)
        */
        let dataSelect = tableSelected();

        //get the status of member "inactive, active, pending" from the table
        let status;
        if (dataSelect === "dreamers") {
            //finding the child that contains the selected option for the dreamer's status
            status = $("#" + id).children(".dreamer_status").children(".status-dropdown").children("option:selected").text();
        }
        else if (dataSelect === "volunteers"){
            status = $("#" + id).children(".volunteer_status").children(".status-dropdown").children("option:selected").text();
        }

        //to be passed into .ajax
        $("#hidden-id").val(id);
        //Top of modal display full name of member and their status
        $("#full-name-status").html(firstName + " " + lastName + " (" + status + ")");

        $("#myModal").modal("toggle");

        //writes 'active' members to table
        $.ajax({
            url: 'private/init.php',
            method: 'post',
            data: {id: id, dataSelect: dataSelect},
            dataType: 'JSON',
            success: function (response) {
                console.log(response); //************************************************************************************
                //populateModalData (admin_page_functions.js)
                populateModalData(response);
            }
        }); //.ajax

        /*
        * after ajax is done loading, then add the editable events
        * addEditEvents (admin_page_functions.js)
        */
        $(document).ajaxComplete(function () {
            //addEditEvents (admin_page_functions.js)
            addEditEvents();
        }); //.ajaxComplete
    }); //.on

    //update member's status via dropdown in admin tables
    $(".status-dropdown").on("change", function () {
        //grab the id of user_id
        let id = this.parentElement.parentElement.getAttribute("id");

        /*
        * get the selected table from "select" dropdown
        * tableSelected (admin_page_functions.js)
        */
        let dataSelect = tableSelected();

        //get the changed status of member "inactive, active, pending"
        let status = $(this).val();

        //make the changed status update in table + database
        $.ajax({
            url: 'private/init.php',
            method: 'post',
            data: {id: id, dataSelect: dataSelect, status: status},
            success: function (response) {
                console.log(response); //****************************************************
            }
        }); //.ajax
    }); //.on
} //end function addClickEvents()

$(document).ready(function () {
    $('#dreamer-table').DataTable();
    $('#volunteer-table').DataTable();

    //addClickEvents (admin_page_functions.js)
    addClickEvents();

    /*
     * on page load if the user has chosen to look at the volunteers table we want to initialize
     * the position of the three switch toggle to active to start
     * tableSelected (admin_page_functions.js)
     */
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
            //addClickEvents (admin_page_functions.js)
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
            //addClickEvents (admin_page_functions.js)
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
            //addClickEvents (admin_page_functions.js)
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
            //addClickEvents (admin_page_functions.js)
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
            //addClickEvents (admin_page_functions.js)
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
            //addClickEvents (admin_page_functions.js)
            addClickEvents();
            $("#dreamer-table").DataTable().destroy();
            $("#dreamer-table").DataTable();
        }); //.ajaxComplete
    }); //.on

    // toggle the modal for emailing functionality
    $("#email-button").on("click", function () {
        //tableSelected (admin_page_functions.js)
        let str = tableSelected();
        str = str[0].toUpperCase() + str.substr(1, str.length);
        $("#email-modal-title").html("Email Active " + str);
        $("#emailModal").modal("toggle");
        $("#email-subject").on("input focus blur", function() {
            //validateEmpty (validation_functions.js)
            validateEmpty("email-subject");
        });
        $("#email-body").on("input focus blur", function() {
            //validateEmpty (validation_functions.js)
            validateEmpty("email-body");
        });
    }); //.on
}); //.ready

//JSON array
//appending all children into modal-body
function populateModalData(responseData) {

    /*
     * clear modal data before we populate -- added here as well
     * because in testing it was not clearing out the modal before re-populating
     */
    $("#modal-body").html("");

    //for each data field, displaying 'key' and 'value' paired data into the modal
    $.each(responseData, function (key, value) {
        console.log(key); //****************************************************************************************************

        //create a textNode wrapping the field heading (the column's name (aka 'key'))
        let textNode = document.createTextNode(formatHeadings(key) + ":   ");
        //create a <label>
        let label = document.createElement('label');

        /*
         * assign the database column name to the label, formatting class = "editInput" used for function
         * addEditEvents() checks if the column being added is for a contact. If so, keeps the numbers appended to
         * the ends of the column names used to disambiguate multiple contacts
         */
        if (key.includes("contact")) {
            label.setAttribute("id", key.substring(0, key.length));
        } else {
            label.setAttribute("id", key.substring(0, key.length - 1));
        }



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

/* HELPER METHODS */

/**
 * Collects data and values for running an update/edit on #save.
 * @param column_name Column being looked at for which table it comes from.
 * @returns {[table, table_id, column_name, value, id]} Table name in database, table primary key column name,
 * name of column, new value to be updated with ajax, table primary key value.
 */
function getUpdateData(column_name){
    //tableName (admin_page_functions.js)
    let table = tableName(column_name);
    //table id field name
    let table_id;

    // checks if the column being updated is column. If so, keeps the numbers appended to the ends of the column names
    // used to disambiguate multiple contacts
    if (column_name.includes("contact")) {
        table_id = column_name.substr(0, column_name.indexOf('_')) + "_id" + column_name.slice(-1);
    } else {
        table_id = column_name.substr(0, column_name.indexOf('_')) + "_id";
    }
    //table id literal
    let id = document.getElementById(table_id).children[0].innerText;
    //data associative array that we are updating, returned as an array for JS
    let value = document.getElementById("input_id").value;
    return [table, table_id, column_name, value, id];
} //end updateData(column_name)

/**
 * Helper function returns the table name being used.
 * @param column_name Column being looked at for which table it comes from.
 * @returns {string} Return name of database table associated with parameter column_name.
 */
function tableName(column_name){
    //upper case first letter and add the rest of the string back on
    return column_name.charAt(0).toUpperCase() + column_name.substr(1, column_name.indexOf('_') - 1);
} //end tableName(column_name)

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

    /*
     * get the selected table from "select" dropdown
     * tableSelected (admin_page_functions.js)
     */
    let dataSelect = tableSelected();

    if (subject.trim() == "" || body.trim() == "") {
        console.log("failed"); //********************************************************************************************
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

$('#logout-button').on('click', function() {
    window.location.href = '../private/logout.php';
});

/**
 * formats the date and provides inline warnings for invalid data when it is updated in the admin page.
 * @return string the correctly formatted date
 */
function formatDate(str) {
    str = str.replace(/\D/g, "");

    if (str.length < 3) {
        // do nothing
    } else if (str.length < 5) {
        str = str.substring(0,2) + "/" + str.substring(2,4);
    } else {
        str = str.substring(0,2) + "/" + str.substring(2,4) + "/" + str.substring(4,8);
    }

    return str;
}

/**
 * formats the phone number and provides inline warnings for invalid data when it is updated in the admin page.
 * @return string the correctly formatted phone number
 */
function formatPhone(str) {
    str = str.replace(/\D/g, "");

    if (str.length < 4) {
        // do nothing
    } else if (str.length < 7) {
        str =  "(" + str.substring(0, 3) + ") " + str.substring(3, 6);
    } else {
        str =  "(" + str.substring(0, 3) + ") " + str.substring(3, 6) + "-" + str.substring(6, 10);
    }

    return str;
}

/**
 * checks if date is valid
 * @return true if date is valid
 */
function validateDate(str) {
    return str.length === 10;
}

/**
 * checks if phone number is valid
 * @return true if phone number is valid
 */
function validatePhone(str) {
    return str.length === 14;

}