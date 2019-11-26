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
 * @param $data [] Associative array of data to add
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
function insertDreamer($user, $dreamer, $guardian)
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

        if ($user_result && $dreamer_result) {
            // calls update data on user and dreamer associative arrays
            updateData("User", "user_id", $user, $user_id);
            updateData("Dreamer", "dreamer_id", $dreamer, $dreamer_id);

            // calls insert function for guardian
            foreach($guardian as $value) {
                // checks if each guardian is valid, executes query if true
                if (validateContact($value)) {
                    $sql = "INSERT INTO Contact (contact_id, user_id) VALUES (default, $user_id);";
                    $contact_result = mysqli_query($db, $sql);
                    $contact_id = $db->insert_id;

                    if ($contact_result) {
                        updateData("Contact", "contact_id", $value, $contact_id);
                    }
                }
            }
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
 * @param $interests [] array of names that represent events
 * @param $references [] array of associative arrays containing reference information
 * @return bool for success or failure of insert
 */
function volunteerInsert($user, $volunteer, $interests, $references)
{
    //global declaration
    global $db;
    global $error;

    //if validation is good, add volunteer to database
    if (validateUser($user) && validateVolunteer($volunteer)) {
        //insert new user_id into the database
        $sql = "INSERT INTO User (user_id, user_date_joined) VALUES (default, now());";
        $user_result = mysqli_query($db, $sql);
        $user_id = $db->insert_id;

        //insert new dreamer_id into the database with new user_id
        $sql = "INSERT INTO Volunteer (volunteer_id, user_id) VALUES (default, $user_id);";
        $volunteer_result = mysqli_query($db, $sql);
        $volunteer_id = $db->insert_id;

        if ($user_result && $volunteer_result) {
            // calls update data on user and volunteer associative arrays
            updateData("User", "user_id", $user, $user_id);
            updateData("Volunteer", "volunteer_id", $volunteer, $volunteer_id);

            // calls insert function for references
            foreach($references as $value) {
                // checks if each reference is valid, executes query if true
                if (validateContact($value)) {
                    $sql = "INSERT INTO Contact (contact_id, user_id) VALUES (default, $user_id);";
                    $contact_result = mysqli_query($db, $sql);
                    $contact_id = $db->insert_id;

                    if ($contact_result) {
                        updateData("Contact", "contact_id", $value, $contact_id);
                    }
                }
            }

            // insert interests intro joining table
            foreach($interests as $value) {
                $sql = "INSERT INTO Volunteer_Interest (volunteer_id, interest_id) VALUES ($volunteer_id, $value);";
                mysqli_query($db, $sql);
            }

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
    }
} //end volunteerInsert()

// returns the names of all interests
function findInterests()
{
    global $db;

    $sql = "SELECT * FROM Interest;";

    $result = mysqli_query($db, $sql);

    return $result;
}

/**
 * Finds names of interests given their ids
 * @param $ids array of interest ids to find names of
 * @return array of interest names
 */
function findInterestNamesByIds($ids) {
    global $db;

    $results = [];

    foreach($ids as $value) {
        $sql = "SELECT interest_name_of_interest FROM Interest WHERE interest_id = $value;";
        $result = mysqli_query($db, $sql);
        $results[] = mysqli_fetch_assoc($result)["interest_name_of_interest"];
    }
    return $results;
}