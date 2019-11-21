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
 * Adds values of data set to table
 * @param $table string The name of the sql table to update
 * @param $table_id string The primary key field of the table to update
 * @param $data [] Associative rray of data to add
 * @param $id int The id of the row we want to add data to
 */
function updateData($table, $table_id, $data, $id)
{
    global $db;

    foreach ($data as $key => $value) {
        $value = mysqli_real_escape_string($db, $value);
        $sql = "UPDATE $table SET $key = '$value' WHERE $table_id = $id";
        mysqli_query($db, $sql);
    }

}

/**
 * Inserts a User/Dreamer into the database.
 * @param $user [] associative array of user data
 * @param $dreamer [] associative array of dreamer data
 * @return bool for success or failure of insert
 */
function insertDreamer($user, $dreamer)
{
    //global declaration
    global $error;
    global $db;

    //if all validation is good, add user to database
    if (validateUser($user) && validateDreamer($dreamer)) {
        //insert new user_id into the database
        $sql = "INSERT INTO User (user_id, user_date_joined) VALUES (default, now());";
        $user_result = mysqli_query($db, $sql);
        $user_id = $db->insert_id;

        //insert new dreamer_id into the database with new user_id
        $sql = "INSERT INTO Dreamer (dreamer_id, user_id) VALUES (default, $user_id);";
        $dreamer_result = mysqli_query($db, $sql);
        $dreamer_id = $db->insert_id;
        echo "test = $dreamer_id";

        if ($user_result && $dreamer_result) {
            // calls update data on user and dreamer associative arrays
            updateData("User", "user_id", $user, $user_id);
            updateData("Dreamer", "dreamer_id", $dreamer, $dreamer_id);
        } else {
            echo "Adding dreamer failed.";
            return false;
        }
        return true;
    } //if validation is bad, echo out which fields contain errors
    else {
        foreach ($error as $value) {
            echo $value . ' ';
        }
        return false;
    }
} //end userInsertValidation(4x)

/**
 * Inserts a User/Volunteer into the database.
 * @param $user [] associative array of user data
 * @param $volunteer [] associative array of volunteer data
 * @return bool for success or failure of insert
 */
function volunteerInsert($user, $volunteer)
{
    //global declaration
    global $db;

    global $error;

    //if validation is good, add volunteer to database
    if ($isValid) {
        //insert into database, (volunteer id, volunteer verified, volunteer info, volunteer active, volunteer user id)
        $sql = "INSERT INTO Volunteer VALUES(default, 0, '$volunteer_street_address', $volunteer_zip, '$volunteer_city', 
                '$volunteer_state', '$volunteer_tshirt_size', '$volunteer_about_us', '$volunteer_motivated', 
                '$volunteer_volunteer_experience', '$volunteer_dreamer_experience', '$volunteer_skills', 
                $volunteer_emailing, 0, $volunteer_user_id)";

        //true-false if the query works
        $result = mysqli_query($db, $sql);

        //return to 'volunteer_success_splash.php' the volunteer_id number for the created row
        return $db->insert_id;
    } //if validation is bad, echo out which fields contain errors
    else {
        foreach ($error as $value) {
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
function referenceInsert($reference_phone, $reference_email, $reference_relationship, $reference_name)
{
    //global declaration
    global $db;
    //error message array
    global $error;

    $isValid = true;

    //Reference phone number
    $reference_phone = preg_replace("/[^0-9]/", "", $reference_phone);
    if (phoneIsValid($reference_phone)) {
        $reference_phone = mysqli_real_escape_string($db, $reference_phone);
    } else {
        $isValid = false;
        $error[] = 'Reference Phone';
    }

    //Reference email
    if (emailIsValid($reference_email)) {
        $reference_email = mysqli_real_escape_string($db, $reference_email);
    } else {
        $isValid = false;
        $error[] = 'Reference Email';
    }

    //Reference relationship to volunteer
    if (requiredInputIsValid($reference_relationship)) {
        $reference_relationship = mysqli_real_escape_string($db, $reference_relationship);
    } else {
        $isValid = false;
        $error[] = 'Reference Relationship';
    }

    //Reference name
    if (requiredInputIsValid($reference_name)) {
        $reference_name = mysqli_real_escape_string($db, $reference_name);
    } else {
        $isValid = false;
        $error[] = 'Reference Name';
    }

    //if validation is good, insert the Reference to database
    if ($isValid) {
        //insert into database, (reference id, reference info)
        $sql = "INSERT INTO Reference VALUES(default, $reference_phone, '$reference_email', '$reference_relationship', '$reference_name')";

        //true-false if the query works
        $result = mysqli_query($db, $sql);

        //return to 'volunteer_success_splash.php' the reference_id number for the created row
        return $db->insert_id;
    } //if validation is bad, echo out which fields contain errors
    else {
        foreach ($error as $value) {
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
function referenceInsertVolunteer($volunteer_id, $reference_id)
{
    //global declaration
    global $db;

    //insert into database, (volunteer id, reference id)
    $sql = "INSERT INTO Volunteer_Reference VALUES($volunteer_id, $reference_id)";

    //true-false if the query works
    $result = mysqli_query($db, $sql);
} //end referenceInsertVolunteer()

/**
 * Insert a Volunteer-Interest link.
 * @param $volunteer_id Volunteer primary key.
 * @param $interest_id Interest primary key.
 */
function interestInsertVolunteer($volunteer_id, $interest_id)
{
    //global declaration
    global $db;

    //insert into database, ($volunteer id, $interest id)
    $sql = "INSERT INTO Volunteer_Interest VALUES($volunteer_id, $interest_id)";

    //true-false if the query works
    $result = mysqli_query($db, $sql);
} //end interestInsertVolunteer()

// returns the names of all interests
function findInterests()
{
    global $db;

    $sql = "SELECT * FROM Interest;";

    $result = mysqli_query($db, $sql);

    return $result;
}
