<?php

if(isset($_POST['id'])){
//    $firstName = $_POST['firstName'];
//    $lastName = $_POST['lastName'];
    $id = $_POST['id'];

    $result = mysqli_query($cnxn, "UPDATE User SET user_first = 'Hi', user_last = 'Griffin' WHERE user_id = '$id'");
    if ($result){
        echo "Data uploaded";
    }
}
