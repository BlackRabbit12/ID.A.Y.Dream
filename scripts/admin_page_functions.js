/*
 * Authors: Shayna Jamieson, Keller Flint, Bridget Black
 * 2019-11-12
 * Last Updated: 2019-11-12
 * Version 1.0
 * File name: admin_page_functions.js
 * Associated Files: admin_page.php
 */



function addClickEvents() {
    //fills modal on 'click' of member's name
    console.log("click events");
    $(".update").on("click", function () {
        console.log("update clicked");
        //get the 'id' of the row (parent of first name clicked)
        let id = this.parentElement.getAttribute("id");
        let firstName = $("#" + id).children("td[data-field-name = user_first]").text();
        let lastName = $("#" + id).children("td[data-field-name = user_last]").text();

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
                console.log(response);
                populateModalData(response);
            }
        }); //.ajax
    }); //.on
}

$(document).ready(function () {
    $('#dreamer-table').DataTable();
    $('#volunteer-table').DataTable();

    addClickEvents();

    // on page load if the user has chosen to look at the volunteers table we want to initialize
    // the position of the three switch toggle to active to start
    if(tableSelected() == "volunteers") {
        change_status("active");
    }
});

document.getElementById("data-select").addEventListener("change", function () {
    this.form.submit();
});

$(document).ready(function () {
    //toggle switch for 'active'/'inactive' members
    $("#toggle-inactive").on("change", function () {
        //overwrites 'active' members on table and displays 'inactive'
        console.log("changed");

        if ($("#toggle-inactive").is(":checked")) {
            $.ajax({
                url: 'private/init.php',
                method: 'post',
                data: {queryType: "active_query"},
                success: function (response) {
                    $("#dreamer-table").html(response);
                }
            }); //.ajax
        } else {
            $.ajax({
                url: 'private/init.php',
                method: 'post',
                data: {queryType: "inactive_query"},
                success: function (response) {
                    $("#dreamer-table").html(response);
                }
            }); //.ajax
        }
        $( document ).ajaxComplete(function() {
            addClickEvents();
        });
    }); //.on

    // the code here allows us to update/change the display of volunteers for active,
    // pending, and inactive. We have to make separate calls to update the table and use ajaxComplete()
    // NEW STUFF *************************************************************************************

    $("#pending").on("click", function() {
        // update status of three switch toggle for colors/design
        change_status("pending");

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
        $( document ).ajaxComplete(function() {
            addClickEvents();
        });
    });

    // for displaying ONLY active volunteers
    $("#active").on("click", function () {
        change_status("active");

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
        $( document ).ajaxComplete(function() {
            addClickEvents();
        });
    });

    // for displaying ONLY inactive volunteers
    $("#inactive").on("click", function () {
        change_status("inactive");

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
        $( document ).ajaxComplete(function() {
            addClickEvents();
        });
    });


    // toggle the modal for emailing functionality
    $("#email-button").on("click", function () {
        let str = tableSelected();
        str = str[0].toUpperCase() + str.substr(1, str.length);
        $("#email-modal-title").html("Email Active " + str);
        $("#emailModal").modal("toggle");
    });

}); //.ready

//user_id for row we're working on
//save button doesn't work 2019-11-16 DELETE WHEN WORKING ***************************************************
$('#save').on('click', function () {
    let id = $('#hidden-id').val();
}); //.on

//JSON array
//appending all children into modal-body
function populateModalData(responseData) {

    // clear modal data before we populate -- added here as well
    // because in testing it was not clearing out the modal before re-populating
    $("#modal-body").html("");

    //for each data field, displaying 'key' and 'value' paired data into the modal
    $.each(responseData, function (key, value) {
        //the field heading
        let textNode = document.createTextNode(formatHeadings(key) + ":   ");
        let label = document.createElement('label');
        label.append(textNode);

        //the field value
        textNode = document.createTextNode(value);
        let p = document.createElement('p');
        p.append(textNode);

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
}

function tableSelected() {
    // get the selected table from "select" dropdown
    let dataSelect;
    if (document.getElementById('dreamer-option').selected) {
        dataSelect = 'dreamers';
    } else if (document.getElementById('volunteer-option').selected) {
        dataSelect = 'volunteers';
    }
    return dataSelect;
}

// FOR THE THREE TOGGLE SWITCH !!! -- should be moved later
function change_status(status){
    let pending = document.getElementById("pending");

    let active = document.getElementById("active");

    let inactive = document.getElementById("inactive");

    let selector = document.getElementById("selector");


    if(status === "active"){
        selector.style.left = pending.clientWidth + "px";
        selector.style.width = active.clientWidth + "px";
        selector.innerHTML = "Active";
        selector.style.backgroundColor = "#418d92";
    }
    else if(status === "pending"){
        selector.style.left = 0;
        selector.style.width = pending.clientWidth + "px";
        selector.style.backgroundColor = "#777777";
        selector.innerHTML = "Pending";
    }

    else{
        selector.style.left = pending.clientWidth + active.clientWidth + 1 + "px";
        selector.style.width = inactive.clientWidth + "px";
        selector.innerHTML = "Inactive";
        selector.style.backgroundColor = "#4d7ea9";
    }
}