/*
Authors: Shayna Jamieson, Bridget Black, Keller Flint
2019-10-29
Last Update: 2019-10-29
Version: 1.0
File Name: volunteer_functions.js
Associated File: volunteer_form.php
                youth_form.php
*/
/* --- Globals --- */
let otherChecked = false;
let weekendChecked  = false;

/* --- Background Check Question  --- */
let bgCheckNo = document.getElementById("bg-check-btn-no");
let bgCheckYes = document.getElementById("bg-check-btn-yes");

bgCheckNo.onclick = displayDecline;
bgCheckYes.onclick = displayForm;

// Displays warning if consent to background check isn't given
function displayDecline() {
    document.getElementById("background-check-container").style.display = "none";
    document.getElementById("bg-check-no-container").style.display = "block";
}

// Displays form if consent to background check is given
function displayForm() {
    document.getElementById("background-check-container").style.display = "none";
    document.getElementById("entire-form-container").style.display = "block";
    document.getElementById("footer").style.display = "block";
}

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

// Displays or removes the weekend times explanation textarea
function toggleWeekendExplanation() {
    let wkndDisplay = document.getElementById("toggle-weekend-availability");
    if(weekendAvail.checked) {
        wkndDisplay.style.display = "block";
        weekendChecked = true;
    } else {
        wkndDisplay.style.display = "none";
        weekendChecked = false;
    }

}

// Displays or removes the interest explanations textarea
function toggleInterestExplanation() {
    let interestDisplay = document.getElementById("toggle-other-interests");
    if(otherInterest.checked) {
        interestDisplay.style.display = "block";
        otherChecked = true;
    } else {
        interestDisplay.style.display = "none";
        otherChecked = false;
    }
}

// Displays the youth explanation textarea
function toggleYouthExplanationShow() {
    let youthDisplay = document.getElementById("toggle-please-explain");
    youthDisplay.style.display = "block";
}

// Hides the youth explanation text area
function toggleYouthExplanationHide() {
    let youthDisplay = document.getElementById("toggle-please-explain");
    youthDisplay.style.display = "none";
}

// Clears Reference Fields when 'Clear' button is clicked
$(".clear-reference").on("click", function() {
    $card = $(this).parent().parent().parent();
    $inputs = $card.find("input");
    for (let i = 0; i < $inputs.length; i++) {
        $inputs[i].value = "";
    }
});

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

// Assigning other event listeners on page

$("#t-shirt").on("input focus blur", function() {
    validateTshirt();
});

$("#zip").on("input focus blur", function() {
    validateZip();
});

// checks if all form data is valid on submit
function validateForm() {
    let isValid = true;

    // checks if input fields are empty
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

    // Checks all phone values on form are valid
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
}
