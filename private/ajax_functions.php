<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-10-29
 * Last Update: 2019-12-09
 * File name: ajax_functions.php
 * Associated Files:
 *      private/functions.php
 *      private/query_functions.php
 *      private/validation_functions.php
 *      scripts/admin_page_functions.js
 *      admin_page.php
 *      private/init.php
 *
 * Description:
 *      File contains several helper and stand-alone functionalism's for updating the status of a user via a dropdown
 *      on the admin tables, changing which status type user being viewed in the table, updates/edits utilizing ajax,
 *      delete user utilizing ajax, and changing email recipients.
 *      Quick File Relations:
 *          functions.php - build table
 *          query_functions.php - update data + delete users
 *          validation_functions.php - formatting
 *          admin_page_functions.js - formatting
 *          admin_page.php - makes queries that ajax functions responds to (table building)
 *          init.php - all 'required once' files
 *      Functions:
 *          createAssociativeArray(2x)
 */

require_once "init.php";

/**
 * Updates 'status' via admin tables dropdown
 */
if (isset($_POST['status'])) {
    //get table name (remove end of string to match table)
    $table = substr($_POST['dataSelect'], 0, strlen($_POST['dataSelect']) - 1);
    //get table id with the table name + id
    $table_id = $table . "_id";
    $key = $table . "_status";
    //uppercase table name
    $table = strtoupper(substr($table, 0, 1)) . substr($table, 1, strlen($table));

    //get id of dreamer OR volunteer
    $sql = "SELECT $table_id FROM $table WHERE user_id = '{$_POST['id']}';";
    $result = mysqli_query($db, $sql);
    $id = mysqli_fetch_assoc($result)[$table_id];

    //create associative array of data
    $dataArray[$key] = $_POST['status'];

    //update the changes
    //updateData (query_functions.php)
    updateData($table, $table_id, $dataArray, $id);
} //end isset($_POST['status'])



/* HELPER */
/**
 * Helps populate the user modal.
 * If the admin page select tag option tag is 'selected' (not 'none'), then this helps populate the user modal depending
 * on which dataSelect is sent in the ajax call.
 */
if (isset($_POST['dataSelect'])) {

    // get the user id for the User to use in the sql queries
    $id = $_POST['id'];

    // if the user is a dreamer then we set the User/Dreamer query for information
    if ($_POST['dataSelect'] == 'dreamers') {
        $sql = "SELECT * FROM User INNER JOIN Dreamer ON User.user_id = Dreamer.user_id WHERE User.user_id = '$id';";
    } // if the user is a volunteer then we set the User/Volunteer query for information
    else {
        $sql = "SELECT * FROM User INNER JOIN Volunteer ON User.user_id = Volunteer.user_id WHERE User.user_id = '$id';";
    }

    // this select works regardless of if the User is a dreamer or volunteer and get's their references/guardians
    $sql .= "SELECT * FROM Contact WHERE user_id = '$id';";

    // ALL data that we add to our associative array
    $data = [];

    if (mysqli_multi_query($db, $sql)) {
        do {
            // get the result for each query to perform steps
            if ($result = mysqli_store_result($db)) {
                // keep adding to data with our call to this method
                //createAssociativeArray (ajax_functions.php)
                $data = createAssociativeArray($result, $data);

                mysqli_free_result($result);
            }
        } while (mysqli_more_results($db) && mysqli_next_result($db));
    }
    //if $results is a good call, send associative array back to admin modal
    if ($result) {
        echo json_encode($data);
    }
} //end isset($_POST['dataSelect'])


/* HELPER FUNCTION */
/**
 * Creates an associative array of data to be used for JSON return.
 * @param $result $result is the result of each sql query made in (isset($_POST['dataSelect']))
 * @param $data $data is all the data we add to our associative array.
 * @return mixed $data is an object.
 */
function createAssociativeArray($result, $data)
{
    global $log;
    //get the column table names
    $fieldNames = $result->fetch_fields();

    // create an array of field (column names)
    $fieldNames_array = [];
    foreach ($fieldNames as $value) {
        $fieldNames_array[] = $value->name;
    }

    // use $i to loop through our row and get the correct field name to insert as a key
    $i = 0;
    $row_num = 0;
    $log = [];

    /*
     * here we do a generic keys / values add to our $data array for dreamers, some volunteer data, etc.
     * row_num is appended to field name if the while loop runs more than once (which would indicate a multi-row return)
     */
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($fieldNames_array as $value) {
            if ($row[$fieldNames_array[$i]] == null) {
                //if 'value' at given 'key' is null, then display empty string instead of null
                $data[$fieldNames_array[$i] . $row_num] = "";
            } //if 'key' is "dreamer's date of birth" or "user's date joined" then format them for readability
            //formatSQLDate (functions.php)
            else if ($fieldNames_array[$i] == "dreamer_date_of_birth" || $fieldNames_array[$i] == "user_date_joined") {
                $data[$fieldNames_array[$i] . $row_num] = formatSQLDate($row[$fieldNames_array[$i]]);
            } //if 'key' is "user's phone" then format them for readability
            //formatSQLPhone (functions.php)
            else if ($fieldNames_array[$i] == "user_phone") {
                $data[$fieldNames_array[$i] . $row_num] = formatSQLPhone($row[$fieldNames_array[$i]]);
            } else {
                //display 'value' at given 'key'
                $data[$fieldNames_array[$i] . $row_num] = $row[$fieldNames_array[$i]];
            }
            $i++;
        }
        $i = 0;
        $row_num++;
    }
    //return object
    return $data;
}//end createAssociativeArray()


/**
 * Selects and returns output string containing table with inactive users.
 */
if (isset($_POST['queryType'])) {
    if ($_POST['queryType'] == 'inactive_query') {
        global $db;

        $sql = "SELECT user_first, user_last, user_email, user_phone, dreamer_date_of_birth, dreamer_status, user_date_joined FROM User 
            INNER JOIN Dreamer ON User.user_id = Dreamer.user_id
            WHERE dreamer_status = 'inactive';";
        $sql_ids = "SELECT user_id FROM Dreamer WHERE dreamer_status = 'inactive';";

        $result = mysqli_query($db, $sql);
        $tableHeadingNames = $result->fetch_fields();
        $result_ids = mysqli_query($db, $sql_ids);

        //buildTable (functions.php)
        echo buildTable($result, $tableHeadingNames, $result_ids, 0);
    } else if ($_POST['queryType'] == 'pending_query') {
        // Selects and returns output string containing table with inactive users
        global $db;

        $sql = "SELECT user_first, user_last, user_email, user_phone, dreamer_date_of_birth, dreamer_status, user_date_joined FROM User 
                INNER JOIN Dreamer ON User.user_id = Dreamer.user_id
                WHERE dreamer_status = 'pending';";
        $sql_ids = "SELECT user_id FROM Dreamer WHERE dreamer_status = 'pending';";

        $result = mysqli_query($db, $sql);
        $tableHeadingNames = $result->fetch_fields();
        $result_ids = mysqli_query($db, $sql_ids);

        //buildTable (functions.php)
        echo buildTable($result, $tableHeadingNames, $result_ids, 0);
    } else if ($_POST['queryType'] == 'active_query') {
        // Selects and returns output string containing table with inactive users
        global $db;

        $sql = "SELECT user_first, user_last, user_email, user_phone, dreamer_date_of_birth, dreamer_status, user_date_joined FROM User 
                INNER JOIN Dreamer ON User.user_id = Dreamer.user_id
                WHERE dreamer_status = 'active';";
        $sql_ids = "SELECT user_id FROM Dreamer WHERE dreamer_status = 'active';";

        $result = mysqli_query($db, $sql);
        $tableHeadingNames = $result->fetch_fields();
        $result_ids = mysqli_query($db, $sql_ids);

        //buildTable (functions.php)
        echo buildTable($result, $tableHeadingNames, $result_ids, 0);
    } // volunteers query for pending to switch what volunteers we display
    else if ($_POST['queryType'] == "pending_volunteers_query") {
        global $db;

        $sql = "SELECT user_first, user_last, user_email, user_phone, volunteer_verified, volunteer_status, user_date_joined FROM User
                INNER JOIN Volunteer ON User.user_id = Volunteer.user_id
                WHERE volunteer_status = 'pending';";

        $sql_ids = $sql_ids = "SELECT user_id FROM Volunteer WHERE volunteer_status = 'pending';";

        $result = mysqli_query($db, $sql);
        $tableHeadingNames = $result->fetch_fields();
        $result_ids = mysqli_query($db, $sql_ids);

        //buildTable (functions.php)
        echo buildTable($result, $tableHeadingNames, $result_ids, 0);
    } // volunteers query for active to switch what volunteers we display
    else if ($_POST['queryType'] == "active_volunteers_query") {
        global $db;

        $sql = "SELECT user_first, user_last, user_email, user_phone, volunteer_verified, volunteer_status, user_date_joined FROM User
                INNER JOIN Volunteer ON User.user_id = Volunteer.user_id
                WHERE volunteer_status = 'active';";

        $sql_ids = $sql_ids = "SELECT user_id FROM Volunteer WHERE volunteer_status = 'active';";

        $result = mysqli_query($db, $sql);
        $tableHeadingNames = $result->fetch_fields();
        $result_ids = mysqli_query($db, $sql_ids);

        //buildTable (functions.php)
        echo buildTable($result, $tableHeadingNames, $result_ids, 0);
    } // volunteers query for active to switch what volunteers we display
    else if ($_POST['queryType'] == "inactive_volunteers_query") {
        global $db;

        $sql = "SELECT user_first, user_last, user_email, user_phone, volunteer_verified, volunteer_status, user_date_joined FROM User
                INNER JOIN Volunteer ON User.user_id = Volunteer.user_id
                WHERE volunteer_status = 'inactive';";

        $sql_ids = $sql_ids = "SELECT user_id FROM Volunteer WHERE volunteer_status = 'inactive';";

        $result = mysqli_query($db, $sql);
        $tableHeadingNames = $result->fetch_fields();
        $result_ids = mysqli_query($db, $sql_ids);

        //buildTable (functions.php)
        echo buildTable($result, $tableHeadingNames, $result_ids, 0);
    }
} //end isset($_POST['queryType'])


/**
 * Mouseup event for user modal 'save' button.
 */
if (isset($_POST['table'])) {
    // checks if the column being updated is column. If so, strips out the numbers used to disambiguate multiple contacts
    if (strpos($_POST['table_id'], "contact") !== false) {
        $_POST["table_id"] = substr($_POST['table_id'], 0, strlen($_POST['table_id']) - 1);
        $_POST["column_name"] = substr($_POST['column_name'], 0, strlen($_POST['column_name']) - 1);
    }

    // formatting value if the column being updated is date or phone number
    if (strpos($_POST['column_name'], 'date') !== false) {
        //formatDOB (validation_functions.php)
        $_POST['value'] = formatDOB($_POST['value']);
    } else if (strpos($_POST['column_name'], 'phone') !== false) {
        //formatPhone (admin_page_functions.js)
        $_POST['value'] = formatPhone($_POST['value']);
    }


    // creates associative key value pair to add to database
    $dataAssociativeArray[$_POST['column_name']] = $_POST['value'];

    //updateData (query_functions.php)
    updateData($_POST['table'], $_POST["table_id"], $dataAssociativeArray, $_POST['id']);
} //end isset($_POST['table'])

/**
 * Queries the database to get all active volunteers and dreamers.
 * Send the list of emails back via a semicolon separated String.
 */
if(isset($_POST['emailType'])) {
    $sql = "";

    if ($_POST["emailType"] == "dreamers") {
        $sql = "SELECT user_email FROM User INNER JOIN Dreamer ON User.user_id = Dreamer.user_id WHERE dreamer_status = 'active';";
    } else if ($_POST["emailType"] == "volunteers") {
        $sql = "SELECT user_email FROM User INNER JOIN Volunteer ON User.user_id = Volunteer.user_id WHERE volunteer_status = 'active';";
    }

    $result = mysqli_query($db, $sql);

    $emailList = '';

    while($emails = mysqli_fetch_assoc($result)) {
        $emailList .= $emails['user_email'].'; ';
    }

    echo $emailList;
} //end if(isset($_POST['emailType']))

/**
 * Delete a user.
 */
if (isset($_POST["queryType"])) {
    if ($_POST["queryType"] == "delete") {
        //deleteUser (query_functions.php)
        deleteUser($_POST["user_id"]);
    }
} //end (isset($_POST["queryType"]))
