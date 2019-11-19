<?php
/*
 * Authors: Shayna Jamieson, Keller Flint, Bridget Black
 * 2019-11-09
 * Last Updated: 2019-11-12
 * Version 1.0
 * File name: query_functions.php
 * Associated Files: volunteer_success_splash.php
 *                  youth_success_splash.php
 */

/**
 * Inserts a User into the database.
 * @param $user_first User first name.
 * @param $user_last User last name.
 * @param $user_email User email address.
 * @param $user_phone User phone number.
 * @return mixed User id for newly created row.
 */
function userInsert($user_first, $user_last, $user_email, $user_phone)
{
    //global declaration
    global $cnxn;
    //error message array
    global $error;

    //set isValid to true, change to false if one field fails to pass validation
    $isValid = true;

    //user first name
    if (requiredInputIsValid($user_first)) {
        $user_first = mysqli_real_escape_string($cnxn, $user_first);
    } else {
        $isValid = false;
        $error[] = 'First name';
    }

    //user last name
    if (requiredInputIsValid($user_last)) {
        $user_last = mysqli_real_escape_string($cnxn, $user_last);
    } else {
        $isValid = false;
        $error[] = 'Last name';
    }

    //user email
    if (emailIsValid($user_email)) {
        $user_email = mysqli_real_escape_string($cnxn, $user_email);
    } else {
        $isValid = false;
        $error[] = 'Email';
    }

    //user phone number
    $user_phone = preg_replace("/[^0-9]/", "", $user_phone);
    if (phoneIsValid($user_phone)) {
        $user_phone = mysqli_real_escape_string($cnxn, $user_phone);
    } else {
        $isValid = false;
        $error[] = 'Phone number';
    }

    //if all validation is good, add user to database
    if ($isValid) {
        //insert into database, (default user_id, user info, time user is created in database)
        $sql = "INSERT INTO User VALUES(default, '$user_first', '$user_last', '$user_email', '$user_phone', now());";

        //look at the sql insert for data checking
        //echo $sql;

        //look at the errors made in the database connection
        //echo mysqli_error($cnxn);

        //true-false if the query works
        $result = mysqli_query($cnxn, $sql);

        //0 or 1 depending on true/false for if the query works
        //echo (int) $result;

        //return to 'youth_success_splash.php' OR 'volunteer_success_splash.php' the user_id number for the created row
        return $cnxn->insert_id;
    }
    //if validation is bad, echo out which fields contain errors
    else {
        foreach($error as $value){
            echo $value . ' ';
        }
    }
} //end userInsertValidation(4x)

/**
 * Inserts a Dreamer into the database.
 * @param $dreamer_user_id Dreamer User id foreign key.
 * @param $dreamer_college Dreamer college of interest.
 * @param $dreamer_dob Dreamer date of birth.
 * @param $dreamer_graduation Dreamer high school graduation date.
 * @param $dreamer_gender Dreamer gender.
 * @param $dreamer_ethnicity Dreamer ethnicity.
 * @param $dreamer_snack Dreamer favorite snacks.
 * @param $dreamer_aspirations Dreamer goals and aspirations.
 * @return mixed Dreamer id for newly created row.
 */
function dreamerInsert($dreamer_user_id, $dreamer_college, $dreamer_dob, $dreamer_graduation, $dreamer_gender, $dreamer_ethnicity, $dreamer_snack, $dreamer_aspirations){
    //global declaration
    global $cnxn;
    //error message array
    global $error;

    $isValid = true;

    //dreamer college of interest
    if(inputIsValid($dreamer_college)){
        $dreamer_college = mysqli_real_escape_string($cnxn, $dreamer_college);
    }
    else{
        $isValid = false;
        $error[] = 'College';
    }

    //dreamer date of birth
    $dreamer_dob = formatDOB($dreamer_dob);
    if(validateDOB($dreamer_dob)){
        $dreamer_dob = mysqli_real_escape_string($cnxn, $dreamer_dob);
    }
    else{
        $isValid = false;
        $error[] = 'Date of Birth';
    }

    //dreamer graduation year
    if(validateGrad($dreamer_graduation)){
        $dreamer_graduation = mysqli_real_escape_string($cnxn, $dreamer_graduation);
    }
    else{
        $isValid = false;
        $error[] = 'Graduation';
    }

    //dreamer gender
    if(genderIsValid($dreamer_gender)){
        $dreamer_gender = mysqli_real_escape_string($cnxn, $dreamer_gender);
    }
    else{
        $isValid = false;
        $error[] = 'Gender';
    }

    //dreamer ethnicity
    if(ethnicityIsValid($dreamer_ethnicity)){
        $dreamer_ethnicity = mysqli_real_escape_string($cnxn, $dreamer_ethnicity);
    }
    else {
        $isValid = false;
        $error[] = 'Ethnicity';
    }

    //dreamer favorite snacks
    if(textareaIsValid($dreamer_snack)){
        $dreamer_snack = mysqli_real_escape_string($cnxn, $dreamer_snack);
    }
    else{
        $isValid = false;
        $error[] = 'Snack';
    }

    //dreamer goals-aspirations
    if(textareaIsValid($dreamer_aspirations)){
        $dreamer_aspirations = mysqli_real_escape_string($cnxn, $dreamer_aspirations);
    }
    else{
        $isValid = false;
        $error[] = 'Aspirations';
    }

    //if all validation is good, add dreamer to database
    if ($isValid) {
        //insert into database, (dreamer_id, dreamer info, dreamer's user id)
        $sql = "INSERT INTO Dreamer VALUES(default, '$dreamer_college', '$dreamer_dob', '$dreamer_graduation', '$dreamer_gender', '$dreamer_ethnicity', '$dreamer_snack', '$dreamer_aspirations', 1, $dreamer_user_id);";

        //true-false if the query works
        $result = mysqli_query($cnxn, $sql);

        //return to 'youth_success_splash.php' the dreamer_id number for the created row
        return $cnxn->insert_id;
    }
    //if validation is bad, echo out which fields contain errors
    else {
        foreach($error as $value){
            echo $value . ' ';
        }
    }
} //end dreamerInsert()

/**
 * Inserts a volunteer into the database.
 * @param $volunteer_user_id Volunteer's User id foreign key.
 * @param $volunteer_street_address Volunteer residence address.
 * @param $volunteer_zip Volunteer residence zip code.
 * @param $volunteer_city Volunteer residence city.
 * @param $volunteer_state Volunteer residence state.
 * @param $volunteer_tshirt_size Volunteer t-shirt size.
 * @param $volunteer_about_us How did volunteer hear about us.
 * @param $volunteer_motivated What motivated volunteer to join idaydream.
 * @param $volunteer_volunteer_experience Volunteer previous volunteer experience.
 * @param $volunteer_dreamer_experience Volunteer previous volunteer experience with youth organizations.
 * @param $volunteer_skills Volunteer applicable skills.
 * @param $volunteer_emailing Volunteer wants to be on the mailing list.
 * @param $volunteer_agree_terms_of_service Volunteer agrees to terms of service.
 * @return mixed Volunteer id for newly created row.
 */
function volunteerInsert($volunteer_user_id, $volunteer_street_address, $volunteer_zip, $volunteer_city, $volunteer_state,
                         $volunteer_tshirt_size, $volunteer_about_us, $volunteer_motivated,
                         $volunteer_volunteer_experience, $volunteer_dreamer_experience, $volunteer_skills,
                         $volunteer_emailing, $volunteer_agree_terms_of_service) {
    //global declaration
    global $cnxn;
    //error message array
    global $error;

    $isValid = true;

    //volunteer address
    if(requiredInputIsValid($volunteer_street_address)){
        $volunteer_street_address = mysqli_real_escape_string($cnxn, $volunteer_street_address);
    }
    else{
        $isValid = false;
        $error[] = 'Address';
    }

    //volunteer zipcode
    if(zipIsValid($volunteer_zip)){
        $volunteer_zip = mysqli_real_escape_string($cnxn, $volunteer_zip);
    }
    else{
        $isValid = false;
        $error[] = 'Zip';
    }

    //volunteer city
    if(requiredInputIsValid($volunteer_city)){
        $volunteer_city = mysqli_real_escape_string($cnxn, $volunteer_city);
    }
    else{
        $isValid = false;
        $error[] = 'City';
    }

    //volunteer state
    if(inputIsValid($volunteer_state)){
        $volunteer_state = mysqli_real_escape_string($cnxn, $volunteer_state);
    }
    else{
        $isValid = false;
        $error[] = 'State';
    }

    //volunteer t-shirt size
    if(inputIsValid($volunteer_tshirt_size)){
        $volunteer_tshirt_size = mysqli_real_escape_string($cnxn, $volunteer_tshirt_size);
    }
    else{
        $isValid = false;
        $error[] = 'T-shirt';
    }

    //volunteer about us
    if(textareaIsValid($volunteer_about_us)){
        $volunteer_about_us = mysqli_real_escape_string($cnxn, $volunteer_about_us);
    }
    else{
        $isValid = false;
        $error[] = 'About Us';
    }

    //volunteer motivations to work with ID.A.Y.Dream
    if(requiredTextareaIsValid($volunteer_motivated)){
        $volunteer_motivated = mysqli_real_escape_string($cnxn, $volunteer_motivated);
    }
    else{
        $isValid = false;
        $error[] = 'Motivated';
    }

    //volunteer previous volunteer experience
    if(textareaIsValid($volunteer_volunteer_experience)){
        $volunteer_volunteer_experience = mysqli_real_escape_string($cnxn, $volunteer_volunteer_experience);
    }
    else{
        $isValid = false;
        $error[] = 'Volunteer Experience';
    }

    //volunteer previous volunteer experience with youth organizations
    if(textareaIsValid($volunteer_dreamer_experience)){
        $volunteer_dreamer_experience = mysqli_real_escape_string($cnxn, $volunteer_dreamer_experience);
    }
    else{
        $isValid = false;
        $error[] = 'Dreamer Experience';
    }

    //volunteer's applicable skills
    if(textareaIsValid($volunteer_skills)){
        $volunteer_skills = mysqli_real_escape_string($cnxn, $volunteer_skills);
    }
    else{
        $isValid = false;
        $error[] = 'Skills';
    }

    //volunteer wants to be on the mailing list
    if ($volunteer_emailing == 'yes'){
        $volunteer_emailing = 1;
    }
    else {
        $volunteer_emailing = 0;
    }

    //does not save in the database
    //ensures nothing submits into database if volunteer does not agree to terms of service
    if ($volunteer_agree_terms_of_service != 'true') {
        $isValid = false;
        $error[] = 'Terms of Service';
    }

    //if validation is good, add volunteer to database
    if ($isValid) {
        //insert into database, (volunteer id, volunteer verified, volunteer info, volunteer active, volunteer user id)
        $sql = "INSERT INTO Volunteer VALUES(default, 0, '$volunteer_street_address', $volunteer_zip, '$volunteer_city', 
                '$volunteer_state', '$volunteer_tshirt_size', '$volunteer_about_us', '$volunteer_motivated', 
                '$volunteer_volunteer_experience', '$volunteer_dreamer_experience', '$volunteer_skills', 
                $volunteer_emailing, 0, $volunteer_user_id)";

        //true-false if the query works
        $result = mysqli_query($cnxn, $sql);

        //return to 'volunteer_success_splash.php' the volunteer_id number for the created row
        return $cnxn->insert_id;
    }
    //if validation is bad, echo out which fields contain errors
    else {
        foreach($error as $value){
            echo $value . ' ';
        }
    }
} //end volunteerInsert()

/**
 * Inserts a reference into the database.
 * @param $reference_phone Reference's phone number.
 * @param $reference_email Reference's email address.
 * @param $reference_relationship Reference's relationship to Volunteer.
 * @param $reference_name Reference's name.
 * @return mixed Reference_id for the newly created row.
 */
function referenceInsert($reference_phone, $reference_email, $reference_relationship, $reference_name) {
    //global declaration
    global $cnxn;
    //error message array
    global $error;

    $isValid = true;

    //Reference phone number
    $reference_phone = preg_replace("/[^0-9]/", "", $reference_phone);
    if(phoneIsValid($reference_phone)){
        $reference_phone = mysqli_real_escape_string($cnxn, $reference_phone);
    }
    else{
        $isValid = false;
        $error[] = 'Reference Phone';
    }

    //Reference email
    if(emailIsValid($reference_email)){
        $reference_email = mysqli_real_escape_string($cnxn, $reference_email);
    }
    else{
        $isValid = false;
        $error[] = 'Reference Email';
    }

    //Reference relationship to volunteer
    if(requiredInputIsValid($reference_relationship)){
        $reference_relationship = mysqli_real_escape_string($cnxn, $reference_relationship);
    }
    else{
        $isValid = false;
        $error[] = 'Reference Relationship';
    }

    //Reference name
    if(requiredInputIsValid($reference_name)){
        $reference_name = mysqli_real_escape_string($cnxn, $reference_name);
    }
    else{
        $isValid = false;
        $error[] = 'Reference Name';
    }

    //if validation is good, insert the Reference to database
    if ($isValid) {
        //insert into database, (reference id, reference info)
        $sql = "INSERT INTO Reference VALUES(default, $reference_phone, '$reference_email', '$reference_relationship', '$reference_name')";

        //true-false if the query works
        $result = mysqli_query($cnxn, $sql);

        //return to 'volunteer_success_splash.php' the reference_id number for the created row
        return $cnxn->insert_id;
    }
    //if validation is bad, echo out which fields contain errors
    else {
        foreach($error as $value){
            echo $value . ' ';
        }
    }
} //end referenceInsert()

//volunteer_id reference_id, pairs them in joining table
/**
 * Insert a Volunteer-Reference link.
 * @param $volunteer_id Volunteer primary key.
 * @param $reference_id Reference primary key.
 */
function referenceInsertVolunteer($volunteer_id, $reference_id){
    //global declaration
    global $cnxn;

    //insert into database, (volunteer id, reference id)
    $sql = "INSERT INTO Volunteer_Reference VALUES($volunteer_id, $reference_id)";

    //true-false if the query works
    $result = mysqli_query($cnxn, $sql);
} //end referenceInsertVolunteer()

/**
 * Insert a Volunteer-Interest link.
 * @param $volunteer_id Volunteer primary key.
 * @param $interest_id Interest primary key.
 */
function interestInsertVolunteer($volunteer_id, $interest_id){
    //global declaration
    global $cnxn;

    //insert into database, ($volunteer id, $interest id)
    $sql = "INSERT INTO Volunteer_Interest VALUES($volunteer_id, $interest_id)";

    //true-false if the query works
    $result = mysqli_query($cnxn, $sql);
} //end interestInsertVolunteer()
