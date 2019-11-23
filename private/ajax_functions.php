<?php

//if the admin_page.php <select> <option> is selected (not 'none')
if (isset($_POST['dataSelect'])) {

    //if user is a dreamer
    if ($_POST['dataSelect'] == 'dreamers') {
        //user_id
        $id = $_POST['id'];

        //Get all of data columns from User table + Dreamer table for this row
        $result = mysqli_query($db, "SELECT * FROM User INNER JOIN Dreamer ON User.user_id = Dreamer.user_id WHERE User.user_id = '$id';");

        //create associative arrays
        $data = [];
        $data = createAssociativeArray($result, $data);

        //if $results is a good call, send associative array back to admin modal
        if ($result) {
            echo json_encode($data);
        }
    } //end dreamers
    //if user is a volunteer
    else if ($_POST['dataSelect'] == 'volunteers') {

        // user_id
        $id = $_POST['id'];


        // here are the queries that go into the multi_query line and into our associative arrays function
        // the FIRST uses the USER id, the SECOND uses the VOLUNTEER id !!! IMPORTANT
        $sql = "SELECT * FROM User INNER JOIN Volunteer ON User.user_id = Volunteer.user_id WHERE User.user_id = '$id';";
        $sql .= "SELECT contact_name, contact_phone, contact_email, contact_relationship FROM Contact WHERE user_id = '$id';";

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
        $myfile = fopen("log.txt", "w") or die("Unable to open file!");
        $text = json_encode($data);
        fwrite($myfile, $text);
        fclose($myfile);
        if ($result) {

            echo json_encode($data);
        }
    } //end volunteers
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
            $data[$fieldNames_array[$i] . $row_num] = $row[$fieldNames_array[$i]];
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

        $sql = "SELECT user_first, user_last, user_email, user_phone, dreamer_date_of_birth, dreamer_active, user_date_joined FROM User 
            INNER JOIN Dreamer ON User.user_id = Dreamer.user_id
            WHERE dreamer_active = 'inactive';";
        $sql_ids = "SELECT user_id FROM Dreamer WHERE dreamer_active = 'inactive';";

        $result = mysqli_query($db, $sql);
        $tableHeadingNames = $result->fetch_fields();
        $result_ids = mysqli_query($db, $sql_ids);

        echo buildTable($result, $tableHeadingNames, $result_ids);
    } else if ($_POST['queryType'] == 'active_query') {
        // Selects and returns output string containing table with inactive users
        global $db;

        $sql = "SELECT user_first, user_last, user_email, user_phone, dreamer_date_of_birth, dreamer_active, user_date_joined FROM User 
                INNER JOIN Dreamer ON User.user_id = Dreamer.user_id
                WHERE dreamer_active = 'active';";
        $sql_ids = "SELECT user_id FROM Dreamer WHERE dreamer_active = 'active';";

        $result = mysqli_query($db, $sql);
        $tableHeadingNames = $result->fetch_fields();
        $result_ids = mysqli_query($db, $sql_ids);

        echo buildTable($result, $tableHeadingNames, $result_ids);
    }

} //end isset($_POST['queryType'])

// --- debugging log for php during ajax calls ---
//    $myfile = fopen("log.txt", "w") or die("Unable to open file!");
//    $text = "";
//    foreach($log as $item)
//        $text .= "$item\n";
//    fwrite($myfile, $text);
//    fclose($myfile);
// --- end debug ---