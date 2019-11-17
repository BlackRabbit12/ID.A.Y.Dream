<?php

//if the admin_page.php <select> <option> is selected (not 'none')
if(isset($_POST['dataSelect'])){
    //if user is a dreamer
    if ($_POST['dataSelect'] == 'dreamers') {
        //user_id
        $id = $_POST['id'];

        //Get all of data columns from User table + Dreamer table for this row
        $result = mysqli_query($cnxn, "SELECT * FROM User INNER JOIN Dreamer ON User.user_id = Dreamer.user_id WHERE User.user_id = '$id';");

        //create associative arrays
        $data = [];
        $data = createAssociativeArray($result, $data);

        //if $results is a good call, send associative array back to admin modal
        if ($result) {
            echo json_encode($data);
        }
    } //end dreamers
    //if user is a volunteer
    else if ($_POST['dataSelect'] == 'volunteers'){
        // user_id
        $id = $_POST['id'];

        // IMPORTANT !!!
        // here we need to actually get the volunteer id that we want to use in the second query
        // before we were just inserting the same user id so it did not grab relevant data
        $tempSQL = "SELECT volunteer_id FROM Volunteer INNER JOIN User ON Volunteer.user_id = User.user_id WHERE Volunteer.user_id = '$id'";
        $result = mysqli_query($cnxn, $tempSQL);
        $volunteerId = "";
        if($result) {
            // gets the accurate volunteer_id based on the $POST user_id
            while ($row = mysqli_fetch_assoc($result)) {
                $volunteerId = $row['volunteer_id'];
            }
        }

        // here are the queries that go into the multi_query line and into our associative arrays function
        // the FIRST uses the USER id, the SECOND uses the VOLUNTEER id !!! IMPORTANT
        $sql = "SELECT * FROM User INNER JOIN Volunteer ON User.user_id = Volunteer.user_id WHERE User.user_id = '$id';";
        $sql .= "SELECT reference_name, reference_phone, reference_email, reference_relationship FROM Volunteer_Reference INNER JOIN Reference ON Volunteer_Reference.reference_id = Reference.reference_id WHERE volunteer_id = '$volunteerId';";

        // ALL data that we add to our associative array
        $data = [];

        if (mysqli_multi_query($cnxn, $sql)){
            do{
                // get the result for each query to perform steps
                if ($result = mysqli_store_result($cnxn)){
                    // keep adding to data with our call to this method
                    $data = createAssociativeArray($result, $data);

                    mysqli_free_result($result);
                }
            } while (mysqli_next_result($cnxn));
        }
        //if $results is a good call, send associative array back to admin modal
        if ($result) {
            echo json_encode($data);
        }
    } //end volunteers
} //end isset


//helper functions
function createAssociativeArray($result, $data){
    //get the column table names
    $fieldNames = $result -> fetch_fields();

    // create an array of field (column names)
    $fieldNames_array = [];
    foreach ($fieldNames as $value) {
        $fieldNames_array[] = $value -> name;
    }

    // use $i to loop through our row and get the correct
    // field name to insert as a key
    $i = 0;

    // refCount keeps track of which reference it is displaying
    // as we start adding keys so that no duplicates exist
    $refCount = 0;

    // here we do a generic keys / values add to our $data array for dreamers, some volunteer data, etc.
    // BUT for references and later interests we need to loop through a different way because of the
    // fact that there are key "duplicates"
    while ($row = mysqli_fetch_assoc($result)) {
        $refCount++;
        foreach ($row as $value) {
            // we go in here if we know that we are in the references section
            if($fieldNames_array[0] == 'reference_name') {

                // HARD CODED RIGHT NOW -- we can think of something better?
                $refName = "$fieldNames_array[0]{$refCount}";
                $data[$refName] = $row['reference_name'];

                $refPhone = "$fieldNames_array[1]{$refCount}";
                $data[$refPhone] = $row['reference_phone'];

                $refEmail = "$fieldNames_array[2]{$refCount}";
                $data[$refEmail] = $row['reference_email'];

                $refRelationship = "$fieldNames_array[3]{$refCount}";
                $data[$refRelationship] = $row['reference_relationship'];
            }
            // else is for normal dreamer or volunteer information
            else {
                $data[$fieldNames_array[$i]] = $value;
                $i++;
            }
        }
    }

    //return object
    return $data;
} //end createAssociativeArray()
