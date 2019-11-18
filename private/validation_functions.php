<?php

/*
* Authors: Shayna Jamieson, Keller Flint, Bridget Black
* 2019-11-09
* Last Updated: 2019-11-12
* Version 1.0
* File name: validation_functions.php
* Associated Files: volunteer_success_splash.php
*                  youth_success_splash.php
*/

// for future reference https://www.php.net/manual/en/filter.filters.sanitize.php
// and https://www.php.net/manual/en/filter.filters.validate.php

/* --- Globals --- */
const VARCHAR_MAX = 255; // Max length of VARCHAR data in tables
const TEXT_MAX = 2147483647; // Max length of TEXT data in tables
const PHONE_LENGTH = 10;
const ZIP_LENGTH = 5;
const YEAR_LENGTH = 4;
const DATE_LENGTH = 8;

/* --- Helper Functions --- */
// Returns true if string is of required min and max length (inclusive)
function hasLength($str, $min, $max) {
    if (strlen($str) < $min) {
        return false;
    }

    if (strlen($str) > $max) {
        return false;
    }

    return true;
}

// returns true if string is empty
function isEmpty($str) {
    return trim($str) == "" || $str == null;
}

// returns true if string contains only numbers
function isNumeric($str) {
    return ctype_digit($str);
}

// returns true if string contains only letters
function isAlpha($str) {
    return ctype_alpha($str);
}

/* --- Validation Functions --- */
// returns true if phone number is valid
function phoneIsValid($str) {
    return isNumeric($str) && hasLength($str, PHONE_LENGTH, PHONE_LENGTH);
}

// return true if zip is valid
function zipIsValid($str) {
    return isNumeric($str) && hasLength($str, ZIP_LENGTH, ZIP_LENGTH);
}

// returns true if email is valid
function emailIsValid($str) {
    if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
        return hasLength($str,0, VARCHAR_MAX);
    }
    return false;
}

// returns true if textarea is valid
function textareaIsValid($str) {
    return hasLength($str,0, TEXT_MAX);
}

// returns true if input is valid
function inputIsValid($str) {
    return hasLength($str,0, VARCHAR_MAX);
}

// returns true if required textarea is valid
function requiredTextareaIsValid($str) {
    return !isEmpty($str) && hasLength($str, 0, TEXT_MAX);
}

// returns true if required input is valid
function requiredInputIsValid($str) {
    return !isEmpty($str) && hasLength($str, 0, VARCHAR_MAX);
}

// returns true if year is valid
function yearIsValid($str) {
    return isNumeric($str) && hasLength($str, YEAR_LENGTH, YEAR_LENGTH);
}

// returns true if date is valid
function dateIsValid($str) {
    return isNumeric($str) && hasLength($str, DATE_LENGTH, DATE_LENGTH);
}

//returns true if gender is valid (could make this rely on database too so she can add more genders)
function genderIsValid($str) {
    return $str == "male" || $str == "female" || $str == "other" || $str == "prefer-not-to-say";
}

// returns true if ethnicity is valid TODO: unclear on implementation details
function ethnicityIsValid($str) {
    return true;
}

// returns true if graduation year is valid
function validateGrad($str) {
    if (isNumeric($str)) {
        return ((int)$str < date("Y") + 10 && (int)$str >= date("Y"));
    }
    return false;
}

// turns date into format for mysql db
function formatDOB($str) {
    $month = substr($str, 0, 2);
    $day = substr($str, 3, 2);
    $year = substr($str, 6, 4);
    return $year . "-" . $month . "-" . $day;
}

// returns true if date of birth is valid
function validateDOB($str) {
    $sub = substr($str, 0, 4);
    if (isNumeric($sub)) {
        return ((int)$sub <= date("Y") - 10 && (int)$sub >= date("Y") - 20);
    }
    return false;
}
