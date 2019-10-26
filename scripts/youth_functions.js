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
    validate_phone("phone");
});

$("#email").on("input focus blur", function () {
    validate_email("email");
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