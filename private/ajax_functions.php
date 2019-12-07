<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-10-29
 * Last Update: 2019-11-27
 * File name: ajax_functions.php
 * Associated Files:
 *      private/functions.php
 *      ************************************************************************************************
 *
 * Description:
 *      File contains **********************************************************************************
 */

require_once "init.php";

//updates status via admin tables
if (isset($_POST['status'])){
    //get table name (remove end of string to match table)
    $table = substr($_POST['dataSelect'], 0, strlen($_POST['dataSelect']) -1);
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
    updateData($table, $table_id, $dataArray, $id);
} //end isset($_POST['status'])

//if the admin_page.php <select> <option> is selected (not 'none')
// this helps to populate the volunteer or dreamer modal depending on which dataSelect is sent in the AJAX call
if (isset($_POST['dataSelect'])) {

    // get the user id for the User to use in the sql queries
    $id = $_POST['id'];

    // if the user is a dreamer then we set the User/Dreamer query for information
    if ($_POST['dataSelect'] == 'dreamers') {
        $sql = "SELECT * FROM User INNER JOIN Dreamer ON User.user_id = Dreamer.user_id WHERE User.user_id = '$id';";
    }
    // if the user is a volunteer then we set the User/Volunteer query for information
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


//helper functions
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

    // use $i to loop through our row and get the correct
    // field name to insert as a key
    $i = 0;
    $row_num = 0;
    $log = [];

    // here we do a generic keys / values add to our $data array for dreamers, some volunteer data, etc.
    // row_num is appended to fieldname if the while loop runs more than once (which would indicate a multi-row return)
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $value) {
            if($row[$fieldNames_array[$i]] == null){
                //if 'value' at given 'key' is null, then display empty string instead of null
                $data[$fieldNames_array[$i] . $row_num] = "";
            }
            //if 'key' is "dreamer's date of birth" or "user's date joined" then format them for readability
            else if ($fieldNames_array[$i] == "dreamer_date_of_birth" || $fieldNames_array[$i]== "user_date_joined") {
                $data[$fieldNames_array[$i] . $row_num]= formatSQLDate($row[$fieldNames_array[$i]]);
            }
            //if 'key' is "user's phone" then format them for readability
            else if ($fieldNames_array[$i] == "user_phone") {
                $data[$fieldNames_array[$i] . $row_num] = formatSQLPhone($row[$fieldNames_array[$i]]);
            }
            else {
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

// Selects and returns output string containing table with inactive users
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

        echo buildTable($result, $tableHeadingNames, $result_ids);
    } else if($_POST['queryType'] == 'pending_query') {
        // Selects and returns output string containing table with inactive users
        global $db;

        $sql = "SELECT user_first, user_last, user_email, user_phone, dreamer_date_of_birth, dreamer_status, user_date_joined FROM User 
                INNER JOIN Dreamer ON User.user_id = Dreamer.user_id
                WHERE dreamer_status = 'pending';";
        $sql_ids = "SELECT user_id FROM Dreamer WHERE dreamer_status = 'pending';";

        $result = mysqli_query($db, $sql);
        $tableHeadingNames = $result->fetch_fields();
        $result_ids = mysqli_query($db, $sql_ids);

        echo buildTable($result, $tableHeadingNames, $result_ids);
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

        echo buildTable($result, $tableHeadingNames, $result_ids);
    }
    // volunteers query for pending to switch what volunteers we display
    else if($_POST['queryType'] == "pending_volunteers_query") {
        global $db;

        $sql = "SELECT user_first, user_last, user_email, user_phone, volunteer_verified, volunteer_status, user_date_joined FROM User
                INNER JOIN Volunteer ON User.user_id = Volunteer.user_id
                WHERE volunteer_status = 'pending';";

        $sql_ids =  $sql_ids = "SELECT user_id FROM Volunteer WHERE volunteer_status = 'pending';";

        $result = mysqli_query($db, $sql);
        $tableHeadingNames = $result->fetch_fields();
        $result_ids = mysqli_query($db, $sql_ids);

        echo buildTable($result, $tableHeadingNames, $result_ids);
    }

    // volunteers query for active to switch what volunteers we display
    else if($_POST['queryType'] == "active_volunteers_query") {
        global $db;

        $sql = "SELECT user_first, user_last, user_email, user_phone, volunteer_verified, volunteer_status, user_date_joined FROM User
                INNER JOIN Volunteer ON User.user_id = Volunteer.user_id
                WHERE volunteer_status = 'active';";

        $sql_ids =  $sql_ids = "SELECT user_id FROM Volunteer WHERE volunteer_status = 'active';";

        $result = mysqli_query($db, $sql);
        $tableHeadingNames = $result->fetch_fields();
        $result_ids = mysqli_query($db, $sql_ids);

        echo buildTable($result, $tableHeadingNames, $result_ids);
    }

    // volunteers query for active to switch what volunteers we display
    else if($_POST['queryType'] == "inactive_volunteers_query") {
        global $db;

        $sql = "SELECT user_first, user_last, user_email, user_phone, volunteer_verified, volunteer_status, user_date_joined FROM User
                INNER JOIN Volunteer ON User.user_id = Volunteer.user_id
                WHERE volunteer_status = 'inactive';";

        $sql_ids =  $sql_ids = "SELECT user_id FROM Volunteer WHERE volunteer_status = 'inactive';";

        $result = mysqli_query($db, $sql);
        $tableHeadingNames = $result->fetch_fields();
        $result_ids = mysqli_query($db, $sql_ids);

        echo buildTable($result, $tableHeadingNames, $result_ids);
    }

} //end isset($_POST['queryType'])

//mouseup event for user modal 'save' button
if (isset($_POST['table'])){
    // checks if the column being updated is column. If so, strips out the numbers used to disambiguate multiple contacts
    if (strpos($_POST['table_id'], "contact") !== false) {
        $_POST["table_id"] = substr($_POST['table_id'], 0, strlen($_POST['table_id']) - 1);
        $_POST["column_name"] = substr($_POST['column_name'], 0, strlen($_POST['column_name']) - 1);
    }

    // creates associatve key value pair to add to database
    $dataAssociativeArray[$_POST['column_name']] = $_POST['value'];

    updateData($_POST['table'], $_POST["table_id"], $dataAssociativeArray, $_POST['id']);
} //end isset($_POST['table'])

//emailType: dataSelect, subject: subject, body: body

if(isset($_POST["emailType"])) {
    $sql = "";
    if ($_POST["emailType"] == "dreamers") {
        $sql = "SELECT user_email FROM User INNER JOIN Dreamer ON User.user_id = Dreamer.user_id WHERE dreamer_status = 'active';";
    } else if ($_POST["emailType"] == "volunteers") {
        $sql = "SELECT user_email FROM User INNER JOIN Volunteer ON User.user_id = Volunteer.user_id WHERE volunteer_status = 'active';";
    } else {
        echo "You shouldn't be here";
    }

    /*
     *
     *
     *
     *         $email_body = "Youth Information:\r\n\r\n";
        $email_subject = "ID.A.Y.Dream Youth Sign-Up Information";

        echo createSummary($email_body)[0];
        $email_body .= createSummary($email_body)[1];

        // sending email to client
        $sendTo = "Sjamieson2@mail.greenriver.edu";
        $to = $sendTo;
        $headers = "From: " . $user["user_email"] . " \r\n";
        $headers .= "Reply-To: " . $user["user_email"] . "\r\n";
        $success = mail($to, $email_subject, $email_body, $headers);
     */

    $result = mysqli_query($db, $sql);

    $subject = $_POST['subject'];
    $body = $_POST['body'];

    $emailCount = 0;

    while($email = mysqli_fetch_assoc($result)) {
        // sending email to client
        $sendTo = "{$email['user_email']}";
        $to = $sendTo;
        //echo $to;
        //  $to = "jamieson.shayna@gmail.com";
        // $headers = "From: " . "kflint0068@gmail.com" . " \r\n";
        // $headers .= "Reply-To: " . "kflint0068@gmail.com" . "\r\n";
        //  echo ("to $to, subject {$_POST["subject"]}, body {$_POST["body"]}, ");
        // $success = mail($to, $_POST["subject"], $_POST["body"], $headers);
        // if(mail($to, $subject, $body)) {
        //     echo "success";
        //     $emailCount++;
        // } else {
        //     echo "failure";
        // }

        $success = mail($to, $subject, $body);
        // echo $success;
        $emailCount = $emailCount + 1;

    }
    //echo $emailCount;
    $data["emailCount"] = $emailCount;
    //echo $data["emailCount"];

    echo json_encode($data);


}


// //--- debugging log for php during ajax calls ---
//    $myfile = fopen("log.txt", "w") or die("Unable to open file!");
//    $text = "";
//    foreach($log as $item)
//        $text .= "$item\n";
//    fwrite($myfile, $text);
//    fclose($myfile);
// //--- end debug ---