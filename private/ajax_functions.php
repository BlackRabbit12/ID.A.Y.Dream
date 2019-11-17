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
        $data = createAssociativeArray($result);

        //if $results is a good call, send associative array back to admin modal
        if ($result) {
            echo json_encode($data);
        }
    } //end dreamers
    //if user is a volunteer
    else if ($_POST['dataSelect'] == 'volunteers'){
        //user_id
        $id = $_POST['id'];

        //Get all of data columns from User table + Dreamer table for this row
        $sql = "SELECT * FROM User INNER JOIN Volunteer ON User.user_id = Volunteer.user_id WHERE User.user_id = '$id';";
        $sql .= "SELECT * FROM Volunteer_Reference INNER JOIN Reference ON Volunteer_Reference.reference_id = Reference.reference_id WHERE volunteer_id = 'id';";

        //all data
        $data = [];
        if (mysqli_multi_query($cnxn, $sql)){
            do{
                //store first result
                if ($result = mysqli_store_result($cnxn)){
                    $data[] = createAssociativeArray($result, $data);
                    mysqli_free_result($result);
                }
            } while (mysqli_next_result($cnxn));
        }
        //$result = mysqli_query($cnxn, $sql);

        //create associative arrays
        //$data = createAssociativeArray($result);

        //if $results is a good call, send associative array back to admin modal
        if ($result) {
            echo json_encode($data);
        }
    } //end volunteers
} //end isset


//helper functions
function createAssociativeArray($result, $data){
    //get the column table names
    $fieldNames = $result->fetch_fields();

    //
    $fieldNames_array = [];
    foreach ($fieldNames as $value) {
        $fieldNames_array[] = $value->name;
    }

    //
    //$data = [];
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $value) {
            $data[$fieldNames_array[$i]] = $value;
            $i++;
        }
    }

    //return object
    return $data;
} //end createAssociativeArray()
