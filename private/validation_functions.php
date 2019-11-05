<?php

// for future reference https://www.php.net/manual/en/filter.filters.sanitize.php
// and https://www.php.net/manual/en/filter.filters.validate.php

/* --- Globals --- */
const VARCHAR_MAX = 255; // Max length of VARCHAR data in tables
const TEXT_MAX = 2147483647; // Max length of TEXT data in tables
const PHONE_LENGTH = 10;
const ZIP_LENGTH = 5;

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
    return trim($str) == "";
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