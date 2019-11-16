<?php

if(isset($_POST['id'])){
//    $firstName = $_POST['firstName'];
//    $lastName = $_POST['lastName'];
    $id = $_POST['id'];

//    $result = mysqli_query($cnxn, "UPDATE User SET user_first = 'Hi', user_last = 'Griffin' WHERE user_id = '$id'");
    $result = mysqli_query($cnxn, "SELECT * FROM User WHERE user_id = '$id';");

    $fieldNames = $result -> fetch_fields();

    $fieldNames_array = [];
    foreach($fieldNames as $value){
        $fieldNames_array[] = $value -> name;
    }

    $data = [];
    $i = 0;
    while($row = mysqli_fetch_assoc($result)) {
        foreach($row as $value) {
            $data[$fieldNames_array[$i]] = $value;
            $i++;
        }
    }

    if ($result){
      echo json_encode($data);
    }
}
