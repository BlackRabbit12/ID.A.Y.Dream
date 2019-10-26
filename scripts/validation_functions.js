
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

function validate_graduation() {
    if (document.getElementById("graduation-none").selected) {
        $("#err-graduation-year").removeClass("d-none");
        $("#graduation-year").addClass("red-border-drop");
        return false;
    } else {
        $("#err-graduation-year").addClass("d-none");
        $("#graduation-year").removeClass("red-border-drop");
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

/* --- Helper functions --- */

// returns true if string is empty
function isEmpty(str) {
    return str.trim() == "";
}