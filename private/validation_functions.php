<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-11-09
 * Last Update: 2019-11-12
 * File name: validation_functions.php
 * Associated Files:
 *      volunteer_success_splash.php
 *      youth_success_splash.php
 *
 * Description:
 *      File contains **********************************************************************************
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
function hasLength($str, $min, $max)
{
    if (strlen($str) < $min) {
        return false;
    }

    if (strlen($str) > $max) {
        return false;
    }

    return true;
}

// returns true if string is empty
function isEmpty($str)
{
    return trim($str) == "" || $str == null;
}

// returns true if string contains only numbers
function isNumeric($str)
{
    return ctype_digit($str);
}

// returns true if string contains only letters
function isAlpha($str)
{
    return ctype_alpha($str);
}

/* --- Validation Functions --- */
// returns true if phone number is valid
function phoneIsValid($str)
{
    return isNumeric($str) && hasLength($str, PHONE_LENGTH, PHONE_LENGTH);
}

// formats phone number
function formatPhone($str)
{
    $str = preg_replace("/[^0-9]/", "", $str);
    return $str;
}

// return true if zip is valid
function zipIsValid($str)
{
    return isNumeric($str) && hasLength($str, ZIP_LENGTH, ZIP_LENGTH);
}

// returns true if email is valid
function emailIsValid($str)
{
    if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
        return hasLength($str, 0, VARCHAR_MAX);
    }
    return false;
}

// returns true if textarea is valid
function textareaIsValid($str)
{
    return hasLength($str, 0, TEXT_MAX);
}

// returns true if input is valid
function inputIsValid($str)
{
    return hasLength($str, 0, VARCHAR_MAX);
}

// returns true if required textarea is valid
function requiredTextareaIsValid($str)
{
    return !isEmpty($str) && hasLength($str, 0, TEXT_MAX);
}

// returns true if required input is valid
function requiredInputIsValid($str)
{
    return !isEmpty($str) && hasLength($str, 0, VARCHAR_MAX);
}

// returns true if year is valid
function yearIsValid($str)
{
    return isNumeric($str) && hasLength($str, YEAR_LENGTH, YEAR_LENGTH);
}

// returns true if date is valid
function dateIsValid($str)
{
    return isNumeric($str) && hasLength($str, DATE_LENGTH, DATE_LENGTH);
}

//returns true if gender is valid (could make this rely on database too so she can add more genders)
function genderIsValid($str)
{
    return $str == "male" || $str == "female" || $str == "other" || $str == "prefer-not-to-say";
}

// returns true if graduation year is valid
function validateGrad($str)
{
    if (isNumeric($str)) {
        return ((int)$str < date("Y") + 10 && (int)$str >= date("Y"));
    }
    return false;
}

// turns date into format for mysql db
function formatDOB($str)
{
    $month = substr($str, 0, 2);
    $day = substr($str, 3, 2);
    $year = substr($str, 6, 4);
    return $year . "-" . $month . "-" . $day;
}

// returns true if date of birth is valid
function validateDOB($str)
{
    $sub = substr($str, 0, 4);
    if (isNumeric($sub)) {
        return ((int)$sub <= date("Y") - 10 && (int)$sub >= date("Y") - 20);
    }
    return false;
}

// returns true if the user information is valid
function validateUser($user)
{
    global $error;

    //set isValid to true, change to false if one field fails to pass validation
    $isValid = true;

    //user first name
    if (!requiredInputIsValid($user["user_first"])) {
        $isValid = false;
        $error[] = 'First name';
    }

    //user last name
    if (!requiredInputIsValid($user["user_last"])) {
        $isValid = false;
        $error[] = 'Last name';
    }

    //user email
    if (!emailIsValid($user["user_email"])) {
        $isValid = false;
        $error[] = 'Email';
    }

    //user phone number
    if (!phoneIsValid($user["user_phone"])) {
        $isValid = false;
        $error[] = 'Phone number';
    }

    return $isValid;
}

// returns true if the dreamer information is valid
function validateDreamer($dreamer)
{
    //global declaration
    global $db;
    //error message array
    global $error;

    $isValid = true;

    //dreamer college of interest
    if (!inputIsValid($dreamer["dreamer_college"])) {
        $isValid = false;
        $error[] = 'College';
    }

    //dreamer date of birth
    //$dreamer_dob = formatDOB($dreamer_dob);
    if (!validateDOB($dreamer["dreamer_date_of_birth"])) {
        $isValid = false;
        $error[] = 'Date of Birth';
    }

    //dreamer graduation year
    if (!validateGrad($dreamer["dreamer_graduation_date"])) {
        $isValid = false;
        $error[] = 'Graduation';
    }

    //dreamer gender
    if (!genderIsValid($dreamer["dreamer_gender"])) {
        $isValid = false;
        $error[] = 'Gender';
    }

    //dreamer ethnicity
    if (!requiredInputIsValid($dreamer["dreamer_ethnicity"])) {
        $isValid = false;
        $error[] = 'Ethnicity';
    }

    //dreamer favorite snacks
    if (!textareaIsValid($dreamer["dreamer_food"])) {
        $isValid = false;
        $error[] = 'Food';
    }

    //dreamer goals-aspirations
    if (!textareaIsValid($dreamer["dreamer_goals"])) {
        $isValid = false;
        $error[] = 'Goals';
    }

    return $isValid;
}

function validateVolunteer($volunteer)
{
//error message array
    global $error;

    $isValid = true;

    //volunteer address
    if (!requiredInputIsValid($volunteer["volunteer_street_address"])) {
        $isValid = false;
        $error[] = 'Address';
    }

    //volunteer zipcode
    if (!zipIsValid($volunteer["volunteer_zip"])) {
        $isValid = false;
        $error[] = 'Zip';
    }

    //volunteer city
    if (!requiredInputIsValid($volunteer["volunteer_city"])) {
        $isValid = false;
        $error[] = 'City';
    }

    //volunteer state
    if (!inputIsValid($volunteer["volunteer_state"])) {
        $isValid = false;
        $error[] = 'State';
    }

    //volunteer t-shirt size
    if (!inputIsValid($volunteer["volunteer_tshirt_size"])) {
        $isValid = false;
        $error[] = 'T-shirt';
    }

    //volunteer about us
    if (!textareaIsValid($volunteer["volunteer_about_us"])) {
        $isValid = false;
        $error[] = 'About Us';
    }

    //volunteer motivations to work with ID.A.Y.Dream
    if (!requiredTextareaIsValid($volunteer["volunteer_motivated"])) {
        $isValid = false;
        $error[] = 'Motivated';
    }

    //volunteer previous volunteer experience
    if (!textareaIsValid($volunteer["volunteer_experience"])) {
        $isValid = false;
        $error[] = 'Volunteer Experience';
    }

    //volunteer previous volunteer experience with youth organizations
    if (!textareaIsValid($volunteer["volunteer_youth_experience"])) {
        $isValid = false;
        $error[] = 'Dreamer Experience';
    }

    //volunteer's applicable skills
    if (!textareaIsValid($volunteer["volunteer_skills"])) {
        $isValid = false;
        $error[] = 'Skills';
    }

    //volunteer wants to be on the mailing list
    // hiding this per Sprint 4 feedback to take off of the form
//    if ($volunteer["volunteer_emailing"] == 'yes') {
//        $volunteer_emailing = 1;
//    } else {
//        $volunteer_emailing = 0;
//    }

    return $isValid;
}

function validateContact($contact) {
    //global declaration
    global $db;
    //error message array
    global $error;

    $isValid = true;

    //Reference phone number
    if (!phoneIsValid($contact["contact_phone"])) {
        $isValid = false;
        $error[] = 'Contact Phone';
    }

    //Reference email
    if (!emailIsValid($contact["contact_email"])) {
        $isValid = false;
        $error[] = 'Contact Email';
    }

    //Reference relationship to volunteer
    if (!requiredInputIsValid($contact["contact_relationship"])) {
        $isValid = false;
        $error[] = 'Contact Relationship';
    }

    //Reference name
    if (!requiredInputIsValid($contact["contact_name"])) {
        $isValid = false;
        $error[] = 'Contact Name';
    }

    return $isValid;
}