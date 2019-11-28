/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-10-29
 * Last Updated: 2019-10-29
 * File name: volunteer_functions.js
 * Associated File:
 *      volunteer_form.php
 *      youth_form.php
 *      validation_functions.js
 *
 * Description:
 *      File contains functions for validating Volunteer and Dreamer Form input client side.
 */

/* --- Globals --- */
let otherChecked = false;
let weekendChecked  = false;

/* --- Background Check Question  --- */
let bgCheckNo = document.getElementById("bg-check-btn-no");
let bgCheckYes = document.getElementById("bg-check-btn-yes");

bgCheckNo.onclick = displayDecline;
bgCheckYes.onclick = displayForm;


/**
 * Displays warning if consent to background check isn't given.
 * Redirect back to iD.A.Y.Dream Home provided.
 */
function displayDecline() {
    document.getElementById("background-check-container").style.display = "none";
    document.getElementById("bg-check-no-container").style.display = "block";
} //end displayDecline()


/**
 * Displays form if consent to background check is given.
 * Direct to form.
 */
function displayForm() {
    document.getElementById("background-check-container").style.display = "none";
    document.getElementById("entire-form-container").style.display = "block";
    document.getElementById("footer").style.display = "block";
} //end displayForm()

/* --- Toggling availability, areas of interest, and youth experience explanation blocks --- */
let weekendAvail = document.getElementById("weekend-availability");
let otherInterest = document.getElementById("other-interest");
let youthExperienceYes = document.getElementById("youth-experience-yes");
let youthExperienceNo = document.getElementById("youth-experience-no");

// Event listeners for toggling availability, areas of interest, and youth experience explanation blocks
weekendAvail.onclick = toggleWeekendExplanation;
otherInterest.onclick = toggleInterestExplanation;
youthExperienceYes.onchange = toggleYouthExplanationShow;
youthExperienceNo.onchange = toggleYouthExplanationHide;


/**
 * Displays or removes the weekend times explanation textarea.
 */
function toggleWeekendExplanation() {
    let wkndDisplay = document.getElementById("toggle-weekend-availability");
    if(weekendAvail.checked) {
        wkndDisplay.style.display = "block";
        weekendChecked = true;
    } else {
        wkndDisplay.style.display = "none";
        weekendChecked = false;
    }
} //end toggleWeekendExplanation()


/**
 * Displays or removes the interest explanations textarea.
 */
function toggleInterestExplanation() {
    let interestDisplay = document.getElementById("toggle-other-interests");
    if(otherInterest.checked) {
        interestDisplay.style.display = "block";
        otherChecked = true;
    } else {
        interestDisplay.style.display = "none";
        otherChecked = false;
    }
} //end toggleInterestExplanation()

/**
 * Displays the youth explanation textarea.
 */
function toggleYouthExplanationShow() {
    let youthDisplay = document.getElementById("toggle-please-explain");
    youthDisplay.style.display = "block";
} //end toggleYouthExplanationShow()

/**
 * Hides the youth explanation text area.
 */
function toggleYouthExplanationHide() {
    let youthDisplay = document.getElementById("toggle-please-explain");
    youthDisplay.style.display = "none";
} //end toggleYouthExplanationHide()


/**
 * Clears Reference Fields when 'Clear' button is clicked.
 */
$(".clear-reference").on("click", function() {
    $card = $(this).parent().parent().parent();
    $inputs = $card.find("input");
    for (let i = 0; i < $inputs.length; i++) {
        $inputs[i].value = "";
    }
}); //.on

/* --- Form validation --- */

// Array for the ids of inputs and text areas that may not be empty
let validateEmptyArray = [
    "fname",
    "lname",
    "street-address",
    "city",
    "motivation",
    "ref-name-1",
    "ref-name-2",
    "ref-name-3",
    "ref-relationship-1",
    "ref-relationship-2",
    "ref-relationship-3",
    "other-interests-explanation",
    "weekend-availability-explanation"

];

// Array for the ids of inputs that required a valid email
let validateEmailArray = [
    "ref-email-1",
    "ref-email-2",
    "ref-email-3",
    "email"
];

// Array for ids of inputs that require a valid phone number
let validatePhoneArray = [
    "ref-phone-1",
    "ref-phone-2",
    "ref-phone-3",
    "phone"
];

/* --- Assigning validation event listeners --- */

/**
 * On 'submit', form data from 'volunteer_form.php' is validated.
 * Form is validated by the volunteer_functions.js function validateForm, which utilizes validation and formatting
 * tools written in validation_functions.js.
 */
$("#volunteer-form").on("submit", validateForm);

// assign check if empty function on all input elements in validateEmptyArray
for (let i = 0; i < validateEmptyArray.length; i++) {
    $("#" + validateEmptyArray[i]).on("input focus blur", function () {
        validateEmpty(validateEmptyArray[i]);
    });
}

// assign validate email on all input elements in validateEmailArray
for (let i = 0; i < validateEmailArray.length; i++) {
    $("#" + validateEmailArray[i]).on("input focus blur", function () {
        validateEmail(validateEmailArray[i]);
    });
}

// assign validate phone on all input elements in validatePhoneArray
for (let i = 0; i < validatePhoneArray.length; i++) {
    $("#" + validatePhoneArray[i]).on("input focus blur", function () {
        validatePhone(validatePhoneArray[i]);
    });
}

/**
 * Event listeners for input elements in the form that require immediate validation.
 */
$("#t-shirt").on("input focus blur", function() {
    validateTshirt();
}); //.on

$("#zip").on("input focus blur", function() {
    validateZip();
}); //.on


/**
 * If 'volunteer_form.php' is 'submitted', validateForm ensures all data passed from the form is valid.
 * ValidateForm checks each data field submitted and enforces formatting on some to ensure validity, uses functions
 * written in validate_functions.js.
 * @returns {boolean} isValid If all of the data provided is valid then isValid stays true, if any data is invalid,
 * isValid becomes false.
 */
function validateForm() {
    let isValid = true;

    // checks if input array fields are empty
    for (let i = 0; i < validateEmptyArray.length; i++) {
        if (!validateEmpty(validateEmptyArray[i])) {
            if (validateEmptyArray[i] == "other-interests-explanation") {
                // if other interests box is checked, does not need to have data
                if (otherChecked && !validateEmpty(validateEmptyArray[i])) {
                    isValid = false;
                }
            } else if (validateEmptyArray[i] == "weekend-availability-explanation") {
                // if weekend box is checked, does not need to have data
                if (weekendChecked && !validateEmpty(validateEmptyArray[i])) {
                    isValid = false;
                }
            } else {
                isValid = false;
            }
        }
    }

    // Checks all phone values on form are valid and formatted
    for (let i = 0; i < validatePhoneArray.length; i++) {
        if (!validatePhone(validatePhoneArray[i])) {
            isValid = false;
        }
    }

    // Checks all email values on form are valid
    for (let i = 0; i < validateEmailArray.length; i++) {
        if (!validateEmail(validateEmailArray[i])) {
            isValid = false;
        }
    }

    if (!validateZip()) {
        isValid = false;
    }

    if (!validateTshirt()) {
        isValid = false;
    }

    return isValid;
} //end validateForm()
