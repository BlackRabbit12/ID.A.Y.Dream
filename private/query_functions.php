<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-11-09
 * Last Update: 2019-11-12
 * File name: query_functions.php
 * Associated Files:
 *      volunteer_success_splash_page.php
 *      youth_success_splash.php
 *
 * Description:
 *      File contains **********************************************************************************
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
 * @param $references [] array of associative arrays containing reference information
 * @return bool for success or failure of insert
 */
function volunteerInsert($user, $volunteer, $references)
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

        //insert new volunteer_id into the database with new user_id
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
        } else {
            echo "Adding volunteer failed.";
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

/**
 * Deletes user by id and all data associated with them
 * @param $user_id int id of the user to delete
 */
function deleteUser($user_id) {
    global $db;

    $sql = "DELETE FROM Contact WHERE user_id = $user_id;";
    mysqli_query($db, $sql);

    $sql = "DELETE FROM Dreamer WHERE user_id = $user_id;";
    mysqli_query($db, $sql);

    $sql = "DELETE FROM Volunteer WHERE user_id = $user_id;";
    mysqli_query($db, $sql);

    $sql = "DELETE FROM User WHERE user_id = $user_id;";
    mysqli_query($db, $sql);
}