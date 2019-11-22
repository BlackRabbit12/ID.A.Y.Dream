/*
 * Authors: Shayna Jamieson, Keller Flint, Bridget Black
 * 2019-11-12
 * Last Updated: 2019-11-12
 * Version 1.0
 * File name: admin_page_functions.js
 * Associated Files: admin_page.php
 */

$(document).ready(function () {
    $('#dreamer-table').DataTable();
    $('#volunteer-table').DataTable();
});

document.getElementById("data-select").addEventListener("change", function () {
    this.form.submit();
});


$(document).ready(function () {
    // call function to set the three switch toggle to "active"
    change_status("active");
    //toggle switch for 'active'/'inactive' members
    $("#toggle-inactive").on("change", function () {
        //overwrites 'active' members on table and displays 'inactive'
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

    }); //.on

    //fills modal on 'click' of member's name
    $(".update").on("click", function () {
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

    if(status === "pending"){
        selector.style.left = 0;
        selector.style.width = pending.clientWidth + "px";
        selector.style.backgroundColor = "#777777";
        selector.innerHTML = "Pending";
    }

    else if(status === "active"){
        selector.style.left = pending.clientWidth + "px";
        selector.style.width = active.clientWidth + "px";
        selector.innerHTML = "Active";
        selector.style.backgroundColor = "#418d92";
    }

    else{
        selector.style.left = pending.clientWidth + active.clientWidth + 1 + "px";
        selector.style.width = inactive.clientWidth + "px";
        selector.innerHTML = "Inactive";
        selector.style.backgroundColor = "#4d7ea9";
    }
}