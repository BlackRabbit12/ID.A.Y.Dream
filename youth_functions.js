/*
Authors: Shayna Jamieson, Bridget Black, Keller Flint
Version: 1.0
File Name: youth_functions.js
*/

// 2D  function array with input element ids
let validateEmptyArray = [
    "fname",
    "lname",
];

// *** event listeners  ***
//  form on submit event listener
$("#youth-form").on("submit", validateForm);

// assign check if empty function on all input elements in validateEmptyArray
for (let i = 0; i < validateEmptyArray.length; i++) {
    $("#" + validateEmptyArray[i]).on("input focus blur", function () {
        validate_empty(validateEmptyArray[i]);
    });
}

$("#phone").on("input focus blur", function () {
    validate_phone();
});

$("#email").on("input focus blur", function () {
    validate_email();
});

$("#gender").on("input focus blur", function () {
    validate_gender();
});

$("#ethnicity").on("input focus blur", function () {
    validate_ethnicity();
});

$("#dob").on("input focus blur", function() {
    validate_dob();
});


// *** validation functions ***
// checks if all form data is valid on submit
function validateForm() {
    let isValid = true;
    // checks if input fields are empty
    for (let i = 0; i < validateEmptyArray.length; i++) {
        if (!validate_empty(validateEmptyArray[i])) {
            isValid = false;
        }
    }

    if (!validate_phone()) {
        isValid = false;
    }

    if (!validate_email()) {
        isValid = false;
    }

    if (!validate_gender()) {
        isValid = false;
    }

    if (!validate_ethnicity()) {
        isValid = false;
    }

    if (!validate_dob()) {
        isValid = false;
    }

    return isValid;
}

// checks if given id input is empty
function validate_empty(id) {
    if (!isEmpty($("#" + id).val())) {
        $("#err-" + id).addClass("d-none");
        $("#" + id).removeClass("red-border-drop");
        return true;
    } else {
        $("#err-" + id).removeClass("d-none");
        $("#" + id).addClass("red-border-drop");
        return false;
    }
}

// forces valid phone number and returns true if the phone number contains 10 or 11 characters. Displays errors
function validate_phone() {
    // formats phone number
    let str = $("#phone").val();
    str = str.replace(/\D/g, "");

    if (str.length < 4) {
        // do nothing
    } else if (str.length < 7) {
        str =  "(" + str.substring(0, 3) + ") " + str.substring(3, 6);
    } else {
        str =  "(" + str.substring(0, 3) + ") " + str.substring(3, 6) + "-" + str.substring(6, 10);
    }

    $("#phone").val(str);

    if (str.length != 14) {
        $("#err-phone").removeClass("d-none");
        $("#phone").addClass("red-border-drop");
        return false;
    } else {
        $("#err-phone").addClass("d-none");
        $("#phone").removeClass("red-border-drop");
        return true;
    }
}

// returns true if email is valid and false otherwise. Displays errors
function validate_email() {
    let expression = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!expression.test(String($("#email").val()).toLocaleLowerCase())) {
        $("#err-email").removeClass("d-none");
        $("#email").addClass("red-border-drop");
        return false;
    } else {
        $("#err-email").addClass("d-none");
        $("#email").removeClass("red-border-drop");
        return true;
    }
}

function validate_gender() {
    if (document.getElementById("gender-none").selected) {
        $("#err-gender").removeClass("d-none");
        $("#gender").addClass("red-border-drop");
        return false;
    } else {
        $("#err-gender").addClass("d-none");
        $("#gender").removeClass("red-border-drop");
        return true;
    }
}

function validate_ethnicity() {
    if (document.getElementById("ethnicity-none").selected) {
        $("#err-ethnicity").removeClass("d-none");
        $("#ethnicity").addClass("red-border-drop");
        return false;
    } else {
        $("#err-ethnicity").addClass("d-none");
        $("#ethnicity").removeClass("red-border-drop");
        return true;
    }
}

//
function validate_dob() {
    let str = $("#dob").val();
    str = str.replace(/\D/g, "");

    if (str.length < 3) {
        // do nothing
    } else if (str.length < 5) {
        str = str.substring(0,2) + "/" + str.substring(2,4);
    } else {
        str = str.substring(0,2) + "/" + str.substring(2,4) + "/" + str.substring(4,8);
    }

    $("#dob").val(str);

    if (str.length != 10) {
        $("#err-dob").removeClass("d-none");
        $("#dob").addClass("red-border-drop");
        return false;
    } else {
        $("#err-dob").addClass("d-none");
        $("#dob").removeClass("red-border-drop");
        return true;
    }
}

// Returns true if string is empty
function isEmpty(str) {
    return str.trim() == "";
}