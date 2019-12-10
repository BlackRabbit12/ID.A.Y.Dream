/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-10-29
 * Last Updated: 2019-12-09
 * File name: validation_functions.js
 * Associated Files:
 *      scripts/youth_functions.js
 *      scripts/volunteer_functions.js
 *      youth_form.php
 *      volunteer_form.php
 *
 * Description:
 *      File contains functions for client side validation for Volunteer and Dreamer forms. If either form is
 *      incorrectly filled out, these functions will give the user visual indications where they need to fix their
 *      inputs in order to successfully submit their sign up form.
 *      Quick File Relations:
 *          youth_functions.js - gets client side validation from validation_functions.js
 *          volunteer_functions.js - gets client side validation from validation_functions.js
 *          youth_form.php - gets client side validation from validation_functions.js
 *          volunteer_form.php - gets client side validation from validation_functions.js
 *      Functions:
 *          validatePhone(1x)
 *          validateEmpty(1x)
 *          validateEmail(1x)
 *          validateZip()
 *          validateTshirt()
 *          validateGender()
 *          validateEthnicity()
 *          validateGraduation()
 *          validateDOB()
 *          isEmpty(1x)
 */

/**
 * Formats phone numbers and validates the data.
 * Uses the form element's id for phone number to get the user's input, then uses string manipulation to format the
 * phone number for optimal readability and testing. Displays error if the phone number is invalid.
 * @param id The form element's id for the phone number data field.
 * @returns {boolean} True or False if the phone number is valid or not.
 */
function validatePhone(id) {
    // formats phone number
    let str = $("#" + id).val();
    str = str.replace(/\D/g, "");

    if (str.length < 4) {
        // do nothing
    } else if (str.length < 7) {
        str =  "(" + str.substring(0, 3) + ") " + str.substring(3, 6);
    } else {
        str =  "(" + str.substring(0, 3) + ") " + str.substring(3, 6) + "-" + str.substring(6, 10);
    }

    $("#" + id).val(str);

    //validate phone number
    if (str.length != 14) {
        $("#err-" + id).removeClass("d-none");
        $("#" + id).addClass("red-border-drop");
        return false;
    } else {
        $("#err-" + id).addClass("d-none");
        $("#" + id).removeClass("red-border-drop");
        return true;
    }
} //end validatePhone(id)


/**
 * Takes an Array from youth_functions and volunteer_functions js and checks for empty inputs.
 * @param id Array of input element ids.
 * @returns {boolean} True or False if there are empty inputs.
 */
function validateEmpty(id) {
    if (!isEmpty($("#" + id).val())) {
        $("#err-" + id).addClass("d-none");
        $("#" + id).removeClass("red-border-drop");
        return true;
    } else {
        $("#err-" + id).removeClass("d-none");
        $("#" + id).addClass("red-border-drop");
        return false;
    }
} //end validateEmpty(id)


/**
 * Checks for valid email data.
 * Uses the form element's id for email to get the user's input, then uses relational string to ensure proper email
 * address formatting. Displays error if the email is invalid.
 * @param id The form element's id for the email data field.
 * @returns {boolean} True or False if the email is valid or not.
 */
function validateEmail(id) {
    let expression = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!expression.test(String($("#" + id).val()).toLocaleLowerCase())) {
        $("#err-" + id).removeClass("d-none");
        $("#" + id).addClass("red-border-drop");
        return false;
    } else {
        $("#err-" + id).addClass("d-none");
        $("#" + id).removeClass("red-border-drop");
        return true;
    }
} //end validateEmail(id)


/**
 * Checks for valid zip code data.
 * Uses the form element's id for zip code to get the user's input, formats to test and display 5 digits. Displays
 * error if the email is invalid.
 * @returns {boolean} True or False if the zip code is valid or not.
 */
function validateZip() {
    $("#zip").val($("#zip").val().trim().substring(0, 5));
    if ($("#zip").val().trim().length < 5) {
        $("#err-zip").removeClass("d-none");
        $("#zip").addClass("red-border-drop");
        return false;
    } else {
        $("#err-zip").addClass("d-none");
        $("#zip").removeClass("red-border-drop");
        return true;
    }
} //end validateZip()


/**
 * Checks for valid T-shirt size data.
 * @returns {boolean} True or False if the T-shirt size is valid or not.
 */
function validateTshirt() {
    if (document.getElementById("t-shirt-none").selected) {
        $("#err-t-shirt").removeClass("d-none");
        $("#t-shirt").addClass("red-border-drop");
        return false;
    } else {
        $("#err-t-shirt").addClass("d-none");
        $("#t-shirt").removeClass("red-border-drop");
        return true;
    }
} //end validateTshirt()


/**
 * Displays errors if gender has invalid input.
 * @returns {boolean} True or False if the gender is valid or not.
 */
function validateGender() {
    if (document.getElementById("gender-none").selected) {
        $("#err-gender").removeClass("d-none");
        $("#gender").addClass("red-border-drop");
        return false;
    } else {
        $("#err-gender").addClass("d-none");
        $("#gender").removeClass("red-border-drop");
        return true;
    }
} //end validateGender()


/**
 * Checks for valid Ethnicity data.
 * @returns {boolean} True or False if the Ethnicity is valid or not.
 */
function validateEthnicity() {
    if (document.getElementById("ethnicity-none").selected) {
        $("#err-ethnicity").removeClass("d-none");
        $("#ethnicity").addClass("red-border-drop");
        return false;
    } else {
        $("#err-ethnicity").addClass("d-none");
        $("#ethnicity").removeClass("red-border-drop");
        return true;
    }
} //end validateEthnicity()


/**
 * Checks for valid graduation date data.
 * @returns {boolean} True or False if the graduation date is valid or not.
 */
function validateGraduation() {
    if (document.getElementById("graduation-none").selected) {
        $("#err-graduation-year").removeClass("d-none");
        $("#graduation-year").addClass("red-border-drop");
        return false;
    } else {
        $("#err-graduation-year").addClass("d-none");
        $("#graduation-year").removeClass("red-border-drop");
        return true;
    }
} //end validateGraduation()


/**
 * Checks for valid date of birth data.
 * Uses string manipulation to format the date of birth for optimal readability and testing. Displays error if the
 * date of birth is invalid.
 * @returns {boolean} True or False if the Date of Birth is valid or not.
 */
function validateDOB() {
    //format date of birth
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

    //validate date of birth
    if (str.length != 10) {
        $("#err-dob").removeClass("d-none");
        $("#dob").addClass("red-border-drop");
        return false;
    } else {
        // check if date exists
        let month = parseInt(str.substring(0,2));
        let day = parseInt(str.substring(3,5));
        let year = parseInt(str.substring(6,10));
        let dateObj = new Date(year, month, day);
        if (dateObj.getFullYear() === year && dateObj.getMonth() === month && dateObj.getDate() === day) {
            $("#err-dob").addClass("d-none");
            $("#dob").removeClass("red-border-drop");
        } else {
            return false;
        }

        /*
         * here is where we check to see if the dob for the prospective dreamer is too young or too old and handle
         * this with alert direction
         */
        let birthYear = str.substring(6);
        birthYear = parseInt(birthYear);
        let currentYear = new Date();
        currentYear = currentYear.getFullYear();
        let age = currentYear - birthYear;

        // we now have their date of birth and can handle the different options starting with if the user is too young
        if (age < 10) {
            // if they choose ok then we redirect them to the home page of Brandi's site
            if(window.confirm("Dreamers must be youth ages 10 - 19. Go back to ID.A.Y.Dream Home Page?")){
                window.location = "https://www.idaydream.org/";
            }
            // if they do not choose ok we reset the dob field and let them stay on the form
            $("#dob").val("");
        }

        // second check is if they are too old to be a dreamer
        else if(age > 19) {
            if(window.confirm("Dreamers must be youth ages 10 - 19. Go to ID.A.Y.Dream Volunteer Form?")){
                window.location.href = "volunteer_form.php";
            }
            // if they do not choose ok we reset the dob field and let them stay on the form
            $("#dob").val("");
        }
        return true;
    }
} //end validateDOB()

/* --- Helper functions --- */

/**
 * Checks if the string is empty or not.
 * @param str String being trimmed and checked if it's empty.
 * @returns {boolean} True or False if the string is empty or not.
 */
function isEmpty(str) {
    return str.trim() == "";
} //end isEmpty(str)
