/* --- Background Check Question  --- */
let bgCheckNo = document.getElementById("bg-check-btn-no");
let bgCheckYes = document.getElementById("bg-check-btn-yes");

bgCheckNo.onclick = displayDecline;
bgCheckYes.onclick = displayForm;

function displayDecline() {
    document.getElementById("background-check-container").style.display = "none";
    document.getElementById("bg-check-no-container").style.display = "block";
}

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

weekendAvail.onclick = toggleWeekendExplanation;
otherInterest.onclick = toggleInterestExplanation;
youthExperienceYes.onchange = toggleYouthExplanationShow;
youthExperienceNo.onchange = toggleYouthExplanationHide;

function toggleWeekendExplanation() {
    let wkndDisplay = document.getElementById("toggle-weekend-availability");
    if(weekendAvail.checked) {
        wkndDisplay.style.display = "block";
    } else {
        wkndDisplay.style.display = "none";
    }
}

function toggleInterestExplanation() {
    let interestDisplay = document.getElementById("toggle-other-interests");
    if(otherInterest.checked) {
        interestDisplay.style.display = "block";
    } else {
        interestDisplay.style.display = "none";
    }
}

function toggleYouthExplanationShow() {
    let youthDisplay = document.getElementById("toggle-please-explain");
    youthDisplay.style.display = "block";
}

function toggleYouthExplanationHide() {
    let youthDisplay = document.getElementById("toggle-please-explain");
    youthDisplay.style.display = "none";
}


/* --- Form functions --- */

// assigning form event listeners

// Show textbox if "other" is selected for "Where would you like to help?"

// Show textbox if "weekends" is selected for "I can help..." in the availability section for specific hours

// Show text box for youth experience explanation if Yes is selected


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
    "ref-relationship-3"
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
        validate_empty(validateEmptyArray[i]);
    });
}

// assign validate email on all input elements in validateEmailArray
for (let i = 0; i < validateEmailArray.length; i++) {
    $("#" + validateEmailArray[i]).on("input focus blur", function () {
        validate_email(validateEmailArray[i]);
    });
}

// assign validate phone on all input elements in validatePhoneArray
for (let i = 0; i < validatePhoneArray.length; i++) {
    $("#" + validatePhoneArray[i]).on("input focus blur", function () {
        validate_phone(validatePhoneArray[i]);
    });
}

$("#t-shirt").on("input focus blur", function() {
    validate_tshirt();
});

$("#zip").on("input focus blur", function() {
    validate_zip();
});

// checks if all form data is valid on submit
function validateForm() {
    let isValid = true;

    // checks if input fields are empty
    for (let i = 0; i < validateEmptyArray.length; i++) {
        if (!validate_empty(validateEmptyArray[i])) {
            isValid = false;
        }
    }

    for (let i = 0; i < validatePhoneArray.length; i++) {
        if (!validate_phone(validatePhoneArray[i])) {
            isValid = false;
        }
    }

    for (let i = 0; i < validateEmailArray.length; i++) {
        if (!validate_email(validateEmailArray[i])) {
            isValid = false;
        }
    }

    if (!validate_zip()) {
        isValid = false;
    }

    if (!validate_tshirt()) {
        isValid = false;
    }

    return isValid;
}