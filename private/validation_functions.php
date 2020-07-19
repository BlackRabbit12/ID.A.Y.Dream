<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-11-09
 * Last Update: 2019-12-09
 * File name: validation_functions.php
 * Associated Files:
 *      volunteer_success_splash.php
 *      youth_success_splash.php
 *
 * Description:
 *      File contains multiple validation functions.
 *      Quick File Relations:
 *          volunteer_success_splash_page.php - uses server side validation
 *          youth_success_splash.php - uses server side validation
 *      Functions:
 *          hasLength(3x)
 *          isEmpty(1x)
 *          isNumeric(1x)
 *          requiredInputIsValid(1x)
 *          requiredTextareaIsValid(1x)
 *          inputIsValid(1x)
 *          textareaIsValid(1x)
 *          emailIsValid(1x)
 *          zipIsValid(1x)
 *          formatPhone(1x)
 *          phoneIsValid(1x)
 *          validateContact(1x)
 *          validateVolunteer(1x)
 *          validateDreamer(1x)
 *          validateUser(1x)
 *          validateDOB(1x)
 *          formatDOB(1x)
 *          validateGrad(1x)
 *          genderIsValid(1x)
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
/**
 * Returns true if string is of required min and max length (inclusive).
 * @param $str string String to check the length of
 * @param $min int Minimum size of the string
 * @param $max int Maximum size of the string
 * @return bool Returns true if string is of required min and max length (inclusive).
 */
function hasLength($str, $min, $max){
    if (strlen($str) < $min) {
        return false;
    }

    if (strlen($str) > $max) {
        return false;
    }

    return true;
} //end hasLength($str, $min, $max)


/**
 * Returns true if string is empty.
 * @param $str string to test.
 * @return bool Returns true if string is empty, false if it is not empty.
 */
function isEmpty($str){
    return trim($str) == "" || $str == null;
} //end isEmpty($str)


/**
 * Returns true if string contains only numbers.
 * @param $str string to test.
 * @return bool Returns true if string contains only numbers.
 */
function isNumeric($str){
    return ctype_digit($str);
} //end isNumeric($str)



/* --- Validation Functions --- */
/**
 * Returns true if the phone number is valid.
 * @param $str phone number string
 * @return bool Returns true if phone number is valid.
 */
function phoneIsValid($str){
    return isNumeric($str) && hasLength($str, PHONE_LENGTH, PHONE_LENGTH);
} //end phoneIsValid($str)


/**
 * Formats phone number for entry into database.
 * @param $str string phone number formatted for the client side.
 * @return string the formatted phone number string for the database
 */
function formatPhone($str){
    $str = preg_replace("/[^0-9]/", "", $str);
    return $str;
} //end formatPhone($str)


/**
 * Returns true if zip is valid.
 * @param $str string the zip to test.
 * @return bool Return true if zip is valid.
 */
function zipIsValid($str){
    return isNumeric($str) && hasLength($str, ZIP_LENGTH, ZIP_LENGTH);
} //end zipIsValid($str)

/**
 *Returns true if email is valid.
 * @param $str string the email to test.
 * @return bool Returns true if email is valid.
 */
function emailIsValid($str){
    if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
        return hasLength($str, 0, VARCHAR_MAX);
    }
    return false;
} //end emailIsValid($str)

/**
 * Returns true if the textarea is valid
 * @param $str string text to test.
 * @return bool Returns true if textarea is valid.
 */
function textareaIsValid($str){
    return hasLength($str, 0, TEXT_MAX);
} //end textareaIsValid($str)

/**
 * Return true if input is valid.
 * @param $str string to test.
 * @return bool Returns true if input is valid.
 */
function inputIsValid($str){
    return hasLength($str, 0, VARCHAR_MAX);
} //end inputIsValid($str)

/**
 * Returns true if required textarea is valid.
 * @param $str string input text to test.
 * @return bool Returns true if required textarea is valid.
 */
function requiredTextareaIsValid($str){
    return !isEmpty($str) && hasLength($str, 0, TEXT_MAX);
} //end requiredTextareaIsValid($str)

/**
 * Returns true if required input is valid.
 * @param $str string the input text to test.
 * @return bool Returns true if required input is valid.
 */
function requiredInputIsValid($str){
    return !isEmpty($str) && hasLength($str, 0, VARCHAR_MAX);
} //end requiredInputIsValid($str)

/**
 * Return true if gender is valid.
 * @param $str string the gender to test.
 * @return bool Returns true if gender is valid.
 */
function genderIsValid($str){
    return $str == "male" || $str == "female" || $str == "other" || $str == "prefer-not-to-say";
} //end genderIsValid($str)

/**
 * Return true if graduation year is valid input and is within the next 10 years.
 * @param $str string the graduation year to test.
 * @return bool Returns true if graduation year is valid.
 */
function validateGrad($str){
    if (isNumeric($str)) {
        return ((int)$str < date("Y") + 10 && (int)$str >= date("Y"));
    }
    return false;
} //end validateGrad($str)

/**
 * Turns date into format for SQL db.
 * @param $str string MM/DD/YYYY date to format.
 * @return string returns SQL formatted date.
 */
function formatDOB($str){
    $month = substr($str, 0, 2);
    $day = substr($str, 3, 2);
    $year = substr($str, 6, 4);
    return $year . "-" . $month . "-" . $day;
} //end formatDOB($str)

/**
 * Returns true if date of birth is valid.
 * @param $str string date of birth to test.
 * @return bool Returns true if date of birth is valid.
 */
function validateDOB($str){
    $isValid = true;
    $year = substr($str, 0, 4);
    $month = substr($str, 5, 2);
    $day = substr($str, 8, 2);
    // checking if not numeric, casting to ints if numeric
    if (!isNumeric($year) || !isNumeric($month) || !isNumeric($day)) {
        $isValid = false;
    } else {
        $year = (int) substr($str, 0, 4);
        $month = (int) substr($str, 5, 2);
        $day = (int) substr($str, 8, 2);
    }
    // dreamer age is between 10 and 20
    if ((int)$year > date("Y") - 10 || (int)$year < date("Y") - 20) {
        $isValid = false;
    }

    // checking if date exists
    if (!checkdate($month, $day, $year)) {
        $isValid = false;
    }

    return $isValid;
} //end validateDOB($str)

/**
 * Returns true if the user information is valid.
 * @param $user array Associative array of user data.
 * @return bool Returns true if the user information is valid.
 */
function validateUser($user){
    global $error;

    //set isValid to true, change to false if one field fails to pass validation
    $isValid = true;

    //user first name
    if (!requiredInputIsValid($user["user_first"])) {
        $isValid = false;
        $error[] = 'First name is invalid';
    }

    //user last name
    if (!requiredInputIsValid($user["user_last"])) {
        $isValid = false;
        $error[] = 'Last name is invalid';
    }

    //user email
    if (!emailIsValid($user["user_email"])) {
        $isValid = false;
        $error[] = 'Email is invalid';
    }

    //user phone number
    if (!phoneIsValid($user["user_phone"])) {
        $isValid = false;
        $error[] = 'Phone number is invalid';
    }

    return $isValid;
} //end validateUser($user)

/**
 * Returns true if the dreamer information is valid.
 * @param $dreamer array Associative array of dreamer data.
 * @return bool Returns true if the dreamer information is valid.
 */
function validateDreamer($dreamer){
    //global declaration
    global $db;
    //error message array
    global $error;

    $isValid = true;

    //dreamer college of interest
    if (!inputIsValid($dreamer["dreamer_college"])) {
        $isValid = false;
        $error[] = 'College is invalid';
    }

    //dreamer date of birth
    //$dreamer_dob = formatDOB($dreamer_dob);
    if (!validateDOB($dreamer["dreamer_date_of_birth"])) {
        $isValid = false;
        $error[] = 'Date of Birth is invalid';
    }

    //dreamer graduation year
    if (!validateGrad($dreamer["dreamer_graduation_year"])) {
        $isValid = false;
        $error[] = 'Graduation is invalid';
    }

    //dreamer gender
    if (!genderIsValid($dreamer["dreamer_gender"])) {
        $isValid = false;
        $error[] = 'Gender is invalid';
    }

    //dreamer ethnicity
    if (!requiredInputIsValid($dreamer["dreamer_ethnicity"])) {
        $isValid = false;
        $error[] = 'Ethnicity is invalid';
    }

    //dreamer favorite snacks
    if (!textareaIsValid($dreamer["dreamer_food"])) {
        $isValid = false;
        $error[] = 'Food is invalid';
    }

    //dreamer goals-aspirations
    if (!textareaIsValid($dreamer["dreamer_goals"])) {
        $isValid = false;
        $error[] = 'Goals is invalid';
    }

    return $isValid;
} //end validateDreamer($dreamer)


/**
 * Returns true if the volunteer information is valid.
 * @param $volunteer array Associative array of volunteer data.
 * @return bool Returns true if the volunteer information is valid.
 */
function validateVolunteer($volunteer){
//error message array
    global $error;

    $isValid = true;

    //volunteer address
    if (!requiredInputIsValid($volunteer["volunteer_street_address"])) {
        $isValid = false;
        $error[] = 'Address is invalid';
    }

    //volunteer zipcode
    if (!zipIsValid($volunteer["volunteer_zip"])) {
        $isValid = false;
        $error[] = 'Zip is invalid';
    }

    //volunteer city
    if (!requiredInputIsValid($volunteer["volunteer_city"])) {
        $isValid = false;
        $error[] = 'City is invalid';
    }

    //volunteer state
    if (!inputIsValid($volunteer["volunteer_state"])) {
        $isValid = false;
        $error[] = 'State is invalid';
    }

    //volunteer t-shirt size
    if (!inputIsValid($volunteer["volunteer_tshirt_size"])) {
        $isValid = false;
        $error[] = 'T-shirt is invalid';
    }

    //volunteer about us
    if (!textareaIsValid($volunteer["volunteer_about_us"])) {
        $isValid = false;
        $error[] = 'About Us is invalid';
    }

    //volunteer motivations to work with ID.A.Y.Dream
    if (!requiredTextareaIsValid($volunteer["volunteer_motivated"])) {
        $isValid = false;
        $error[] = 'Motivated is invalid';
    }

    //volunteer previous volunteer experience
    if (!textareaIsValid($volunteer["volunteer_experience"])) {
        $isValid = false;
        $error[] = 'Volunteer Experience is invalid';
    }

    //volunteer previous volunteer experience with youth organizations
    if (!textareaIsValid($volunteer["volunteer_youth_experience"])) {
        $isValid = false;
        $error[] = 'Dreamer Experience is invalid';
    }

    //volunteer's applicable skills
    if (!textareaIsValid($volunteer["volunteer_skills"])) {
        $isValid = false;
        $error[] = 'Skills are invalid';
    }

    return $isValid;
} //end validateVolunteer($volunteer)


/**
 * Returns true if the contact information is valid.
 * @param $contact array Associative array of contact data.
 * @return bool Returns true if the contact information is valid.
 */
function validateContact($contact){
    //global declaration
    global $db;
    //error message array
    global $error;

    $isValid = true;

    //Reference phone number
    if (!phoneIsValid($contact["contact_phone"])) {
        $isValid = false;
        $error[] = 'Contact Phone is invalid';
    }

    //Reference email
    if (!emailIsValid($contact["contact_email"])) {
        $isValid = false;
        $error[] = 'Contact Email is invalid';
    }

    //Reference relationship to volunteer
    if (!requiredInputIsValid($contact["contact_relationship"])) {
        $isValid = false;
        $error[] = 'Contact Relationship is invalid';
    }

    //Reference name
    if (!requiredInputIsValid($contact["contact_name"])) {
        $isValid = false;
        $error[] = 'Contact Name is invalid';
    }

    // checking address is valid for guardians
    if ($contact["contact_type"] == "guardian") {
        //contact address
        if (!requiredInputIsValid($contact["contact_address"])) {
            $isValid = false;
            $error[] = 'Address is invalid';
        }

        //contact zipcode
        if (!zipIsValid($contact["contact_zip"])) {
            $isValid = false;
            $error[] = 'Zip is invalid';
        }

        //contact city
        if (!requiredInputIsValid($contact["contact_city"])) {
            $isValid = false;
            $error[] = 'City is invalid';
        }

        //contact state
        if (!inputIsValid($contact["contact_state"])) {
            $isValid = false;
            $error[] = 'State is invalid';
        }
    }

    return $isValid;
} //end validateContact($contact)