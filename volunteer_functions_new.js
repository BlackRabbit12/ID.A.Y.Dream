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
}

/* --- Form functions --- */

// assigning form event listeners


// Show textbox if "other" is  selected for "Where would you like to help?"

// Show textbox if "weekends" is selected for "I can help..." in the availability section for specific hours

// Show text box for youth experience explanation if Yes is selected

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

// Validates phone numbers and adds formatting
// forces valid phone number and returns true if the phone number contains 10 or 11 characters. Displays errors
function validate_phone(id) {
    console.log("validate phone");
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

    if (str.length != 14) {
        $("#err-" + id).removeClass("d-none");
        $("#" + id).addClass("red-border-drop");
        return false;
    } else {
        $("#err-" + id).addClass("d-none");
        $("#" + id).removeClass("red-border-drop");
        return true;
    }
}

// checks if given inputs are empty
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

// returns true if email is valid and false otherwise. Displays errors
function validate_email(id) {
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
}

// Validates zip code and adds formatting
function validate_zip() {
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
}

// Validates that a T-Shirt size is selected
function validate_tshirt() {
    if (document.getElementById("t-shirt-none").selected) {
        $("#err-t-shirt").removeClass("d-none");
        $("#t-shirt").addClass("red-border-drop");
        return false;
    } else {
        $("#err-t-shirt").addClass("d-none");
        $("#t-shirt").removeClass("red-border-drop");
        return true;
    }
}

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

/* --- Helper functions --- */

// returns true if string is empty
function isEmpty(str) {
    return str.trim() == "";
}