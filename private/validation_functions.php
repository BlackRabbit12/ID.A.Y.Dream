<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-11-09
 * Last Update: 2019-12-08
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
 * @param $str
 * @param $min
 * @param $max
 * @return bool
 */
//TODO finish docs
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
 * Checks if the given string is empty or not.
 * @param $str
 * @return bool Returns true if string is empty, false if it is not empty.
 */
//TODO finish docs
function isEmpty($str){
    return trim($str) == "" || $str == null;
} //end isEmpty($str)


/**
 *
 * @param $str
 * @return bool Returns true if string contains only numbers.
 */
//TODO finish docs
function isNumeric($str){
    return ctype_digit($str);
} //end isNumeric($str)

//TODO delete clean up?

// returns true if string contains only letters
function isAlpha($str){
    return ctype_alpha($str);
}

/* --- Validation Functions --- */
/**
 *
 * @param $str
 * @return bool Returns true if phone number is valid.
 */
//TODO finish docs
function phoneIsValid($str){
    return isNumeric($str) && hasLength($str, PHONE_LENGTH, PHONE_LENGTH);
} //end phoneIsValid($str)


/**
 * Formats phone number.
 * @param $str
 * @return string|string[]|null
 */
function formatPhone($str){
    $str = preg_replace("/[^0-9]/", "", $str);
    return $str;
} //end formatPhone($str)


/**
 *
 * @param $str
 * @return bool Return true if zip is valid.
 */
//TODO finish docs
function zipIsValid($str){
    return isNumeric($str) && hasLength($str, ZIP_LENGTH, ZIP_LENGTH);
} //end zipIsValid($str)

/**
 *
 * @param $str
 * @return bool Returns true if email is valid.
 */
//TODO finish docs
function emailIsValid($str){
    if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
        return hasLength($str, 0, VARCHAR_MAX);
    }
    return false;
} //end emailIsValid($str)

/**
 *
 * @param $str
 * @return bool Returns true if textarea is valid.
 */
//TODO finish docs
function textareaIsValid($str){
    return hasLength($str, 0, TEXT_MAX);
} //end textareaIsValid($str)

/**
 *
 * @param $str
 * @return bool Returns true if input is valid.
 */
//TODO finish docs
function inputIsValid($str){
    return hasLength($str, 0, VARCHAR_MAX);
} //end inputIsValid($str)

/**
 *
 * @param $str
 * @return bool Returns true if required textarea is valid.
 */
//TODO finish docs
function requiredTextareaIsValid($str){
    return !isEmpty($str) && hasLength($str, 0, TEXT_MAX);
} //end requiredTextareaIsValid($str)

/**
 *
 * @param $str
 * @return bool Returns true if required input is valid.
 */
//TODO finish docs
function requiredInputIsValid($str){
    return !isEmpty($str) && hasLength($str, 0, VARCHAR_MAX);
} //end requiredInputIsValid($str)

//TODO delete clean up?

// returns true if year is valid
function yearIsValid($str)
{
    return isNumeric($str) && hasLength($str, YEAR_LENGTH, YEAR_LENGTH);
}

//TODO delete clean up?

// returns true if date is valid
function dateIsValid($str)
{
    return isNumeric($str) && hasLength($str, DATE_LENGTH, DATE_LENGTH);
}

/**
 *
 * @param $str
 * @return bool Returns true if gender is valid (could make this rely on database too so she can add more genders).
 */
//TODO finish docs
function genderIsValid($str){
    return $str == "male" || $str == "female" || $str == "other" || $str == "prefer-not-to-say";
} //end genderIsValid($str)

/**
 *
 * @param $str
 * @return bool Returns true if graduation year is valid.
 */
//TODO finish docs
function validateGrad($str){
    if (isNumeric($str)) {
        return ((int)$str < date("Y") + 10 && (int)$str >= date("Y"));
    }
    return false;
} //end validateGrad($str)

/**
 * Turns date into format for mysql db.
 * @param $str
 * @return string
 */
//TODO finish docs
function formatDOB($str){
    $month = substr($str, 0, 2);
    $day = substr($str, 3, 2);
    $year = substr($str, 6, 4);
    return $year . "-" . $month . "-" . $day;
} //end formatDOB($str)

/**
 *
 * @param $str
 * @return bool Returns true if date of birth is valid.
 */
//TODO finish docs
function validateDOB($str){
    $sub = substr($str, 0, 4);
    if (isNumeric($sub)) {
        return ((int)$sub <= date("Y") - 10 && (int)$sub >= date("Y") - 20);
    }
    return false;
} //end validateDOB($str)

/**
 *
 * @param $user
 * @return bool Returns true if the user information is valid.
 */
//TODO finish docs
function validateUser($user){
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
} //end validateUser($user)

/**
 *
 * @param $dreamer
 * @return bool Returns true if the dreamer information is valid.
 */
//TODO finish docs
function validateDreamer($dreamer){
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
    if (!validateGrad($dreamer["dreamer_graduation_year"])) {
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
} //end validateDreamer($dreamer)


/**
 *
 * @param $volunteer
 * @return bool
 */
//TODO finish docs
function validateVolunteer($volunteer){
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
} //end validateVolunteer($volunteer)


/**
 *
 * @param $contact
 * @return bool
 */
//TODO finish docs
function validateContact($contact){
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
} //end validateContact($contact)