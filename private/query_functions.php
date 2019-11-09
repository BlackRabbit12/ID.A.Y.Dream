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
        $sql = "INSERT INTO User VALUES(default, '$user_first', '$user_last', '$user_email', '$user_phone');";

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

//    dreamer_college         VARCHAR(255),
//    dreamer_date_of_birth   DATE         NOT NULL,
//    dreamer_graduation_date DATE         NOT NULL,
//    dreamer_ethnicity       VARCHAR(255) NOT NULL,
//    dreamer_food            VARCHAR(255),
//    dreamer_goals           TEXT,
//    dreamer_active          TINYINT      NOT NULL,
//    user_id                 INT          NOT NULL,

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

    if(generIsValid($user_gender)){
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
} //end dreamerInsert()
