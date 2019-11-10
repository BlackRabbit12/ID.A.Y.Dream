<?php

//validation of each one, call 'requiredInputIsValid' from 'validation_functions.php'
function userInsert($user_first, $user_last, $user_phone, $user_email)
{
    //global declaration
    global $cnxn;
    //error message array
    global $error;

    //set isValid to true, change to false if one field fails to pass validation
    $isValid = true;

    //dreamer first name
    if (requiredInputIsValid($user_first)) {
        $user_first = mysqli_real_escape_string($cnxn, $user_first);
    } else {
        $isValid = false;
        $error[] = 'First name';
    }

    //dreamer last name
    if (requiredInputIsValid($user_last)) {
        $user_last = mysqli_real_escape_string($cnxn, $user_last);
    } else {
        $isValid = false;
        $error[] = 'Last name';
    }

    //dreamer phone number
    $user_phone = preg_replace("/[^0-9]/", "", $user_phone);
    if (phoneIsValid($user_phone)) {
        $user_phone = mysqli_real_escape_string($cnxn, $user_phone);
    } else {
        $isValid = false;
        $error[] = 'Phone number';
    }

    //dreamer email
    if (emailIsValid($user_email)) {
        $user_email = mysqli_real_escape_string($cnxn, $user_email);
    } else {
        $isValid = false;
        $error[] = 'Email';
    }

    if ($isValid) {
        $sql = "INSERT INTO User VALUES(default, '$user_first', '$user_last', '$user_email', '$user_phone', now());";

        //look at the sql insert for data checking
        //echo $sql;

        //look at the errors made in the database connection
        //echo mysqli_error($cnxn);

        //true/false if the query works
        $result = mysqli_query($cnxn, $sql);

        //0 or 1 depending on true/false for if the query works
        //echo (int) $result;

        //return the user_id number for the created row
        return $cnxn->insert_id;
    }
    //echo out which fields contain errors
    else {
        foreach($error as $value){
            echo $value . ' ';
        }
    }
} //end userInsertValidation(4x)


function dreamerInsert($user_id, $user_college, $user_graduation, $user_dob, $user_gender, $user_ethnicity, $user_snack, $user_aspirations){
    //global declaration
    global $cnxn;
    //error message array
    global $error;

    $isValid = true;

    if(inputIsValid($user_college)){
        $user_college = mysqli_real_escape_string($cnxn, $user_college);
    }
    else{
        $isValid = false;
        $error[] = 'College';
    }

    if(textareaIsValid($user_snack)){
        $user_snack = mysqli_real_escape_string($cnxn, $user_snack);
    }
    else{
        $isValid = false;
        $error[] = 'Snack';
    }

    if(textareaIsValid($user_aspirations)){
        $user_aspirations = mysqli_real_escape_string($cnxn, $user_aspirations);
    }
    else{
        $isValid = false;
        $error[] = 'Aspirations';
    }

    if(validateGrad($user_graduation)){
        $user_graduation = mysqli_real_escape_string($cnxn, $user_graduation);
    }
    else{
        $isValid = false;
        $error[] = 'Graduation';
    }

    if(validateDOB($user_dob)){
        $user_dob = mysqli_real_escape_string($cnxn, $user_dob);
    }
    else{
        $isValid = false;
        $error[] = 'Date of Birth';
    }

    if(genderIsValid($user_gender)){
        $user_gender = mysqli_real_escape_string($cnxn, $user_gender);
    }
    else{
        $isValid = false;
        $error[] = 'Gender';
    }

    if(ethnicityIsValid($user_ethnicity)){
        $user_ethnicity = mysqli_real_escape_string($cnxn, $user_ethnicity);
    }
    else {
        $isValid = false;
        $error[] = 'Ethnicity';
    }

    if ($isValid) {
        $sql = "INSERT INTO Dreamer VALUES(default, '$user_college', '$user_dob', '$user_graduation', '$user_ethnicity', '$user_snack', '$user_aspirations', 0, $user_id);";

        //true/false if the query works
        $result = mysqli_query($cnxn, $sql);

        return $result;
    } else {
        foreach($error as $value){
            echo $value . ' ';
        }
    }
} //end dreamerInsert()

function volunteerInsert($volunteer_street_address, $volunteer_zip, $volunteer_city, $volunteer_state,
                         $volunteer_tshirt_size, $volunteer_about_us, $volunteer_motivated,
                         $volunteer_volunteer_experience, $volunteer_dreamer_experience, $volunteer_skills,
                         $volunteer_emailing, $volunteer_agree_terms_of_service, $user_id) {
    //global declaration
    global $cnxn;
    //error message array
    global $error;

    $isValid = true;

    if(requiredInputIsValid($volunteer_street_address)){
        $volunteer_street_address = mysqli_real_escape_string($cnxn, $volunteer_street_address);
    }
    else{
        $isValid = false;
        $error[] = 'Address';
    }

    if(zipIsValid($volunteer_zip)){
        $volunteer_zip = mysqli_real_escape_string($cnxn, $volunteer_zip);
    }
    else{
        $isValid = false;
        $error[] = 'Zip';
    }

    if(requiredInputIsValid($volunteer_city)){
        $volunteer_city = mysqli_real_escape_string($cnxn, $volunteer_city);
    }
    else{
        $isValid = false;
        $error[] = 'City';
    }

    if(inputIsValid($volunteer_state)){
        $volunteer_state = mysqli_real_escape_string($cnxn, $volunteer_state);
    }
    else{
        $isValid = false;
        $error[] = 'State';
    }

    if(inputIsValid($volunteer_tshirt_size)){
        $volunteer_tshirt_size = mysqli_real_escape_string($cnxn, $volunteer_tshirt_size);
    }
    else{
        $isValid = false;
        $error[] = 'T-shirt';
    }

    if(textareaIsValid($volunteer_about_us)){
        $volunteer_about_us = mysqli_real_escape_string($cnxn, $volunteer_about_us);
    }
    else{
        $isValid = false;
        $error[] = 'About Us';
    }

    if(requiredTextareaIsValid($volunteer_motivated)){
        $volunteer_motivated = mysqli_real_escape_string($cnxn, $volunteer_motivated);
    }
    else{
        $isValid = false;
        $error[] = 'Motivated';
    }

    if(textareaIsValid($volunteer_volunteer_experience)){
        $volunteer_volunteer_experience = mysqli_real_escape_string($cnxn, $volunteer_volunteer_experience);
    }
    else{
        $isValid = false;
        $error[] = 'Volunteer Experience';
    }

    if(textareaIsValid($volunteer_dreamer_experience)){
        $volunteer_dreamer_experience = mysqli_real_escape_string($cnxn, $volunteer_dreamer_experience);
    }
    else{
        $isValid = false;
        $error[] = 'Dreamer Experience';
    }

    if(textareaIsValid($volunteer_skills)){
        $volunteer_skills = mysqli_real_escape_string($cnxn, $volunteer_skills);
    }
    else{
        $isValid = false;
        $error[] = 'Skills';
    }

    if ($volunteer_emailing == 'yes'){
        $volunteer_emailing = 1;
    }
    else {
        $volunteer_emailing = 0;
    }

    if ($volunteer_agree_terms_of_service != 'true') {
        $isValid = false;
        $error[] = 'Terms of Service';
    }

    if ($isValid) {
        $sql = "INSERT INTO Volunteer VALUES(default, 0, '$volunteer_street_address', $volunteer_zip, '$volunteer_city', 
                '$volunteer_state', '$volunteer_tshirt_size', '$volunteer_about_us', '$volunteer_motivated', 
                '$volunteer_volunteer_experience', '$volunteer_dreamer_experience', '$volunteer_skills', 
                $volunteer_emailing, 0, $user_id);";

        //true/false if the query works
        $result = mysqli_query($cnxn, $sql);

        //return the user_id number for the created row
        return $cnxn->insert_id;
    } else {
        foreach($error as $value){
            echo $value . ' ';
        }
    }
} //end volunteerInsert()

//name relation email phone, returns the id of the reference to pair with our volunteer_id
function referenceInsert($reference_phone, $reference_email, $reference_relationship, $reference_name) {
    //global declaration
    global $cnxn;
    //error message array
    global $error;

    $isValid = true;

    $reference_phone = preg_replace("/[^0-9]/", "", $reference_phone);
    if(phoneIsValid($reference_phone)){
        $reference_phone = mysqli_real_escape_string($cnxn, $reference_phone);
    }
    else{
        $isValid = false;
        $error[] = 'Reference Phone';
    }

    if(emailIsValid($reference_email)){
        $reference_email = mysqli_real_escape_string($cnxn, $reference_email);
    }
    else{
        $isValid = false;
        $error[] = 'Reference Email';
    }

    if(requiredInputIsValid($reference_relationship)){
        $reference_relationship = mysqli_real_escape_string($cnxn, $reference_relationship);
    }
    else{
        $isValid = false;
        $error[] = 'Reference Relationship';
    }

    if(requiredInputIsValid($reference_name)){
        $reference_name = mysqli_real_escape_string($cnxn, $reference_name);
    }
    else{
        $isValid = false;
        $error[] = 'Reference Name';
    }

    if ($isValid) {
        $sql = "INSERT INTO Reference VALUES(default, $reference_phone, '$reference_email', '$reference_relationship', '$reference_name')";

        //true/false if the query works
        $result = mysqli_query($cnxn, $sql);

        return $cnxn->insert_id;
    } else {
        foreach($error as $value){
            echo $value . ' ';
        }
    }
} //end referenceInsert()

//volunteer_id reference_id, pairs them in joining table
function referenceInsertVolunteer($volunteer_id, $reference_id){
    //global declaration
    global $cnxn;

    $sql = "INSERT INTO Volunteer_Reference VALUES($volunteer_id, $reference_id)";

    $result = mysqli_query($cnxn, $sql);

} //end referenceInsertVolunteer()


