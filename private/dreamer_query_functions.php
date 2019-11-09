<?php

    //validation of each one, call 'requiredInputIsValid' from 'validation_functions.php'
    function userInsertValidation($user_first, $user_last, $user_phone, $user_email) {
        //global declaration
        global $cnxn;
//        $user_first;
//        $user_last;
//        $user_phone;
//        $user_email;

        //set isValid to true, change to false if one field fails to pass validation
        $isValid = true;

        //dreamer first name
        if(requiredInputIsValid($user_first)){
            $user_first = mysqli_real_escape_string($cnxn, $user_first);
        }
        else{
            $isValid = false;
            echo 'First name';
        }

        //dreamer last name
        if (requiredInputIsValid($user_last)) {
            $user_last = mysqli_real_escape_string($cnxn, $user_last);
        }
        else {
            $isValid = false;
            echo 'Last name';
        }

        //dreamer phone number
        if (requiredInputIsValid($user_phone)) {
            $user_phone = mysqli_real_escape_string($cnxn, $user_phone);
        }
        else {
            $isValid = false;
            echo 'Phone number';
        }

        //dreamer email
        if (requiredInputIsValid($user_email)) {
            $user_email = mysqli_real_escape_string($cnxn, $user_email);
        }
        else {
            $isValid = false;
            echo 'Email';
        }

        if($isValid){
//            $sql = "INSERT INTO User VALUES(default, '$user_first', '$user_last', '$user_phone', '$user_email')";
//
//            echo $sql;
//
//            //echo mysqli_error($cnxn);
//
//            $row_id = mysqli_query($cnxn, $sql);
//
//            echo (int)$row_id;

            $sql = "INSERT INTO User VALUES(default, ?, ?, ?, ?)";
            $stmt = $cnxn->prepare($sql);
            $stmt->bind_param("ss", $user_first, $user_last, $user_phone, $user_email);
            $stmt->execute();
            $stmt->close();
        }
    } //end userInsertValidation(4x)
