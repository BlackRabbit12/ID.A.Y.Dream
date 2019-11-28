/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.o
 * 2019-10-29
 * Last Updated: 2019-11-27
 * File name: youth_functions.js
 * Associated Files:
 *      validation_functions.js
 *      youth_form.php
 *      volunteer_form.php
 *
 * Description:
 *      File contains functions for validating Volunteer and Dreamer Form input client side.
 */

/**
 * If Ethnicity 'Other' option tag is selected.
 * Function: .addEventListener("change") listens for if 'other' is selected. If selected, a textarea will be
 * displayed for user to fill out, Not required.
 */
document.getElementById("toggle-ethnicity-other").classList.add("d-none");
document.getElementById("ethnicity").addEventListener("change", function() {
    if (document.getElementById("select-ethnicity-other").selected) {
        document.getElementById("toggle-ethnicity-other").classList.remove("d-none");
        document.getElementById("toggle-ethnicity-other").classList.add("d-block");
    } else {
        document.getElementById("toggle-ethnicity-other").classList.add("d-none");
        document.getElementById("toggle-ethnicity-other").classList.remove("d-block");
    }
}); //.addEventListener


//2D funcion array holds input element ids, used in function 'validateForm' (youth_functions.js)
let validateEmptyArray = [
    "fname",
    "lname",
    "guardian-fName",
    "guardian-lName",
    "guardian-relationship"
];


/**
 * On 'submit', form data from 'youth_form.php' is validated.
 * Form is validated by the youth_functions.js function validateForm, which utilizes validation and formatting tools
 * written in validation_functions.js
 */
$("#youth-form").on("submit", validateForm);


/**
 * Checks array holding input element ids, looks for empty inputs.
 * Assign check if empty function on all input elements in validateEmptyArray.
 */
for (let i = 0; i < validateEmptyArray.length; i++) {
    $("#" + validateEmptyArray[i]).on("input focus blur", function () {
        validateEmpty(validateEmptyArray[i]);
    }); //.on
}


/**
 * Event listeners for input elements in the form that require immediate validation.
 */
$("#phone").on("input focus blur", function () {
    validatePhone("phone");
}); //.on

$("#guardian-phone").on("input focus blur", function () {
    validatePhone("guardian-phone");
}); //.on

$("#email").on("input focus blur", function () {
    validateEmail("email");
}); //.on

$("#guardian-email").on("input focus blur", function () {
    validateEmail("guardian-email");
}); //.on

$("#gender").on("input focus blur", function () {
    validateGender();
}); //.on

$("#ethnicity").on("input focus blur", function () {
    validateEthnicity();
}); //.on

$("#dob").on("input focus blur", function() {
    validateDOB();
}); //.on

$("#graduation-year").on("input focus blur", function() {
    validateGraduation();
}); //.on

/**
 * If 'youth_form.php' is 'submitted', validateForm ensures all data passed from the form is valid.
 * ValidateForm checks each data field submitted and enforces formatting on some to ensure validity, uses functions
 * written in validate_functions.js.
 * @returns {boolean} isValid If all of the data provided is valid then isValid stays true, if any data is invalid,
 * isValid becomes false.
 */
function validateForm() {
    let isValid = true;

    // checks if input 2D array fields are empty
    for (let i = 0; i < validateEmptyArray.length; i++) {
        if (!validateEmpty(validateEmptyArray[i])) {
            isValid = false;
        }
    }

    //function formats phone number
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

    //function formats date of birth
    if (!validateDOB()) {
        isValid = false;
    }

    if (!validateGraduation()) {
        isValid = false;
    }

    //function formats phone number
    if (!validatePhone("guardian-phone")) {
        isValid = false;
    }

    if (!validateEmail("guardian-email")) {
        isValid = false;
    }

    return isValid;
} //end validateForm()
