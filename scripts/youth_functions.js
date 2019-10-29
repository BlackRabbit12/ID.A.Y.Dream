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

// *** Functions ***

// *** event listeners  ***

//  form on submit event listener
$("#youth-form").on("submit", validateForm);

// assign check if empty function on all input elements in validateEmptyArray
for (let i = 0; i < validateEmptyArray.length; i++) {
    $("#" + validateEmptyArray[i]).on("input focus blur", function () {
        validateEmpty(validateEmptyArray[i]);
    });
}

// Event listeners for input elements in the form that require immediate validation
$("#phone").on("input focus blur", function () {
    validatePhone("phone");
});

$("#email").on("input focus blur", function () {
    validateEmail("email");
});

$("#gender").on("input focus blur", function () {
    validateGender();
});

$("#ethnicity").on("input focus blur", function () {
    validateEthnicity();
});

$("#dob").on("input focus blur", function() {
    validateDOB();
});

$("#graduation-year").on("input focus blur", function() {
    validateGraduation();
});

// *** validation functions ***

// checks if all form data is valid on submit
function validateForm() {
    let isValid = true;

    // checks if input fields are empty
    for (let i = 0; i < validateEmptyArray.length; i++) {
        if (!validateEmpty(validateEmptyArray[i])) {
            isValid = false;
        }
    }

    if (!validatePhone("phone")) {
        isValid = false;
    }

    if (!validateEmail("email")) {
        isValid = false;
    }

    if (!validateGender()) {
        isValid = false;
    }

    if (!validateEthnicity()) {
        isValid = false;
    }

    if (!validateDOB()) {
        isValid = false;
    }

    if (!validateGraduation()) {
        isValid = false;
    }

    return isValid;
} 