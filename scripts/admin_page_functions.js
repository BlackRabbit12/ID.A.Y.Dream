/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-11-12
 * Last Update: 2019-12-09
 * File name: admin_page_functions.js
 * Associated Files:
 *      admin_page.php
 *      private/init.php
 *      scripts/validation_functions.js
 *      private/logout.php
 *
 * Description:
 *      File contains the admin page's main functionality. It adds the clickable events on the page such as opening a
 *      user modal, updating the user's information, sending emails, toggling between different types and status of
 *      users.
 *      Quick File Relations:
 *          admin_page.php - uses event functions made in admin page funcitons javascript
 *          validation_functions.js - uses formatting and validation
 *          logout.php - uses logout button functions
 *          init.php - all 'required once' files
 *      Functions:
 *          addEditEvents()
 *          addClickEvents()
 *          populateModalData(1x)
 *          getUpdateData(1x)
 *          tableName(1x)
 *          formatHeadings(1x)
 *          tableSelected()
 *          formatDate(1x)
 *          formatYear(1x)
 *          formatPhone(1x)
 *          validateDate(1x)
 *          validatePhone(1x)
 *          validateYear(1x)
 */

// global variable allowSave. Is false when the data the admin is entering is invalid.
let allowSave = true;


/**
 * Allows an admin to edit any field inside the modal.
 */
function addEditEvents() {
    $(".editInput").on("click", function () {
        // get the id of the row that is being updated from the modal's user_id
        let id = $(this).parent().children("#user_id").children("p").first().text();
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
            /*
             * keep focus on current <input> (because "blur" drops focus) after 'appends' a sibling, "append" a 'save'
             * button to row for when edit is confirmed to send to database
             */
            let saveBtn = "<button type=\"button\" id=\"save\" class=\"pull-left bg-success text-white btn btn-default btn-sm\">Save</button>";
            // reset allowSave to true by default since most inputs don't require validation
            allowSave = true;
            // check if the item being updated requires special formatting (date and phone number)
            if (this.id.includes("phone")) {
                // add event listener to format the phone number
                $("#input_id").on("keydown input focus", function () {
                    this.value = formatPhone(this.value);
                    allowSave = validatePhone(this.value);
                    // coloring the border of the input red for invalid input
                    if (!allowSave) {
                        this.style = "border-color: red";
                    } else {
                        this.style = "border-color: lightblue";
                    }
                });
            } else if (this.id.includes("date")) {
                // add event listener to format the date
                $("#input_id").on("keydown input focus", function () {
                    this.value = formatDate(this.value);
                    allowSave = validateDate(this.value);
                    // coloring the border of the input red for invalid input
                    if (!allowSave) {
                        this.style = "border-color: red";
                    } else {
                        this.style = "border-color: lightblue";
                    }
                });
            } else if (this.id.includes("year")) {
                // add event listener to format the year
                $("#input_id").on("keydown input focus", function () {
                    this.value = formatYear(this.value);
                    allowSave = validateYear(this.value);
                    // coloring the border of the input red for invalid input
                    if (!allowSave) {
                        this.style = "border-color: red";
                    } else {
                        this.style = "border-color: lightblue";
                    }
                });
            }

            document.getElementById("input_id").focus();

            $(this).append(saveBtn);

            //add event listener for when click outside of box to dump changes
            this.children[0].addEventListener("blur", function (event) {
                event.preventDefault();
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
                     * getUpdateData (admin_page_functions.js)
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
                            } else {
                                $("#" + id).children("." + data_to_update[2]).html(data_to_update[3]);
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
                        } //end success
                    }); //.ajax
                } else {
                    alert("Save failed. Data was not properly formatted.");
                }
            }); //.on 'mousedown'
        }
        // else we have already clicked on the field so it has an input_id
        else {
        }
    }); //.on 'click'
} //end function addEditEvents()


/**
 * Fills a modal when the user is selected in the table.
 * Makes the fields populate with proper data and makes the fields edit-able.
 */
function addClickEvents() {
    //fills modal on 'click' of member's name
    // removes event listeners before reassigning to prevent duplication
    $(".update").off();

    $(".update").on("click", function () {
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
        } else if (dataSelect === "volunteers") {
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
    }); //.on 'click'

    // removes event listeners before reassigning to prevent duplication
    $(".status-dropdown").off();

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
            }
        }); //.ajax
    }); //.on 'change'
} //end addClickEvents()


/**
 * Set data tables and add click events the first time page loads.
 */
$(document).ready(function () {
    $('#dreamer-table').DataTable();
    $('#volunteer-table').DataTable();

    //addClickEvents (admin_page_functions.js)
    addClickEvents();
}); //.ready


/**
 * Set data tables and add click events.
 */
document.getElementById("data-select").addEventListener("change", function () {
    this.form.submit();
}); //addEventListener


/**
 * Set the three-way-toggle for Dreamers + Volunteers, Toggles Email 'To' List, Delete user in current modal.
 */
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
    }); //.on 'click'

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
    }); //.on 'click'

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
    }); //.on 'click'

    // three toggle switch for Volunteers: Pending
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
    }); //.on 'click'

    // three toggle switch for Volunteers: Active
    $("#active-label").on("click", function () {
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
    }); //.on 'click'

    // three toggle switch for Volunteers: Inactive
    $("#inactive-label").on("click", function () {
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
    }); //.on 'click'

    // toggle the modal for emailing functionality
    $("#email-button").on("click", function () {
        //tableSelected (admin_page_functions.js)
        let str = tableSelected();
        str = str[0].toUpperCase() + str.substr(1, str.length);
        $("#email-modal-title").html("Email Active " + str);
        $("#emailModal").modal("toggle");
        $("#email-subject").on("input focus blur", function () {
            //validateEmpty (validation_functions.js)
            validateEmpty("email-subject");
        }); //end .on 'input focus blur'
        $("#email-body").on("input focus blur", function () {
            //validateEmpty (validation_functions.js)
            validateEmpty("email-body");
        }); //end .on 'input focus blur'
    }); //.on 'click'

    // deletes the user for the current modal
    $("#delete").on("click", function() {
        // find the user id in the modal
        let id = $(this).parent().parent().find("#user_id").find("p").text();

        // confirm deletion with user, run ajax deletion if true
        if (confirm("Permanently remove user " + $("#full-name-status").html() + " from the system?")) {
            $.ajax({
                url: 'private/init.php',
                method: 'post',
                data: {queryType: "delete", user_id: id},
                success: function (response) {
                    // removes item from the table
                    let table = $("#dreamer-table").DataTable();
                    table
                        .row("#" + id)
                        .remove()
                        .draw();

                    // close the modal since the user at this point will have been deleted
                    $("#myModal").modal("toggle");
                } //end success
            }); //.ajax
        }
    }); // end delete event listener
}); //.ready


/**
 * Populates modal with selected user's information from database.
 * Appends all children into modal-body. JSON array.
 * @param responseData From addClickEvents() ajax success.
 */
function populateModalData(responseData) {
    /*
     * clear modal data before we populate -- added here as well
     * because in testing it was not clearing out the modal before re-populating
     */
    $("#modal-body").html("");

    //for each data field, displaying 'key' and 'value' paired data into the modal
    $.each(responseData, function (key, value) {

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
function getUpdateData(column_name) {
    //tableName (admin_page_functions.js)
    let table = tableName(column_name);
    //table id field name
    let table_id;

    /*
     * checks if the column being updated is column. If so, keeps the numbers appended to the ends of the column names
     * used to disambiguate multiple contacts
     */
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
function tableName(column_name) {
    //upper case first letter and add the rest of the string back on
    return column_name.charAt(0).toUpperCase() + column_name.substr(1, column_name.indexOf('_') - 1);
} //end tableName(column_name)

/**
 * Clears modal body after click away.
 */
$('#myModal').on('hidden.bs.modal', function () {
    $("#modal-body").html("");
}); //.on 'hidden.bs.modal'


/**
 * Formats the heading names retrieved from database for clear user view.
 * @param str Column name retrieved from database.
 * @returns {string} Table Heading formatted for easy admin viewing.
 */
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


/**
 * Finds which table is currently selected.
 * @returns {string} Table name selected.
 */
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


/**
 * Send email to selected table's active member list.
 */
$("#email-send").on("click", function () {
    let subject = $("#email-subject").val();
    let body = $("#email-body").val();

    /*
     * get the selected table from "select" dropdown
     * tableSelected (admin_page_functions.js)
     */
    let dataSelect = tableSelected();

    if (subject.trim() == "" || body.trim() == "") {
    }
    else {
        // make ajax call to update the display of pending volunteers
        $.ajax({
            url: 'private/init.php',
            method: 'post',
            data: {emailType: dataSelect, subject: subject, body: body},
            success: function (response) {
                // get the number of emails sent to choose which modal to populate
                let emailCount = parseInt(response.substring(14, response.length - 1));

                // we display a failure pop up that notifies the sender that emails we not going through
                if (emailCount == 0) {
                    $("#email-body").val('').end();
                    $("#email-subject").val('').end();
                    $('#emailModal').modal('toggle');
                    alert("Emails were not able to be sent or you have no actives!");
                }
                //here we know that the emails sent and we can display a success pop up and close the email modal
                else {
                    // clears out the email and body on successful send
                    $("#email-body").val('').end();
                    $("#email-subject").val('').end();
                    $('#emailModal').modal('toggle');
                    alert("Active " + dataSelect + ": " + emailCount + " emails were sent!");
                }
            } //end success
        }); //.ajax
    }
}); //end .on 'click'


/**
 * Log out button for admin.
 * Destroys credentials and forces admin to log back in on next page visit.
 */
$('#logout-button').on('click', function () {
    window.location.href = '../private/logout.php';
}); //end .on 'click'

/**
 * Formats the date and provides inline warnings for invalid data when it is updated in the admin page.
 * @return string The correctly formatted date.
 */
function formatDate(str) {
    str = str.replace(/\D/g, "");

    if (str.length < 3) {
        // do nothing
    } else if (str.length < 5) {
        str = str.substring(0, 2) + "/" + str.substring(2, 4);
    } else {
        str = str.substring(0, 2) + "/" + str.substring(2, 4) + "/" + str.substring(4, 8);
    }

    return str;
} //end formatDate()

/**
 * Formats a year to ensure it contains only numbers and is never more than 4 digits.
 * @param str String the year as a string.
 * @returns string The formatted year.
 */
function formatYear(str) {
    str = str.replace(/\D/g, "");
    if (str.length > 4) {
        return str.substr(0,4);
    }
    return str;
} //end formatYear()

/**
 * Formats the phone number and provides inline warnings for invalid data when it is updated in the admin page.
 * @return string The correctly formatted phone number.
 */
function formatPhone(str) {
    str = str.replace(/\D/g, "");

    if (str.length < 4) {
        // do nothing
    } else if (str.length < 7) {
        str = "(" + str.substring(0, 3) + ") " + str.substring(3, 6);
    } else {
        str = "(" + str.substring(0, 3) + ") " + str.substring(3, 6) + "-" + str.substring(6, 10);
    }

    return str;
} //end formatPhone()

/**
 * Checks if date is valid.
 * @return True/False if date is/is not valid.
 */
function validateDate(str) {
    if (str.length === 10) {
        // check if date exists
        let month = parseInt(str.substring(0,2));
        let day = parseInt(str.substring(3,5));
        let year = parseInt(str.substring(6,10));
        let dateObj = new Date(year, month, day);
        return dateObj.getFullYear() === year && dateObj.getMonth() === month && dateObj.getDate() === day;
    }
} //end validateDate()

/**
 * Checks if phone number is valid.
 * @return True/False if phone number is/is not valid.
 */
function validatePhone(str) {
    return str.length === 14;
} //end validatePhone()

/**
 * Checks if year is valid.
 * @return True/False if year is/is not valid.
 */
function validateYear(str) {
    return str.length === 4;
} //end validateYear()