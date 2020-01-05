<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version: 1.0
 * 2020-01-05
 * Last Update: 2020-01-05
 * File Name: excel.php
 * Associated Files:
 *      excel_page_functions.php
 *      css/admin_styles.css
 *      images/apple-touch-icon.png
 *      images/favicon-32x32_title.png
 *      images/favicon-16x16_title.png
 *      images/site.webmanifest_title
 *      @link https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css
 *      @link https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css
 *      @link https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css
 *
 * Description:
 *      File contains iD.A.Y.Dream Youth Organization's Admin export to excel functions.
 *      Quick File Relations:
 *          excel_page_functions.js - makes datatable exportable to excel
 */

//Start the session
session_start();

/*
 * if our admin user is not logged in currently then we need to disable them from viewing admin content and
 * redirect to the project splash (home) page
 * header (index.php)
 */
if(!isset($_SESSION['username'])) {
    header('location: index.php');
}

//Require once, single link for all php files that are required once
require_once "private/init.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Excel - iD.A.Y.Dream</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- https://favicon.io/emoji-favicons/blue-heart/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32_title.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16_title.png">
    <link rel="manifest" href="images/site.webmanifest_title">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" href="css/admin_styles.css" type="text/css">
</head>
<body>
    <?php
        //get Dreamer info from data tables
    if ($_GET["data_select"] == "dreamers") {
        $sql = "SELECT User.user_first, User.user_last, User.user_email, User.user_phone, User.user_date_joined, 
        Dreamer.dreamer_college, Dreamer.dreamer_date_of_birth, Dreamer.dreamer_graduation_year, 
        Dreamer.dreamer_gender, Dreamer.dreamer_ethnicity, Dreamer.dreamer_food, Dreamer.dreamer_goals, 
        Dreamer.dreamer_status, Dreamer.dreamer_notes FROM User INNER JOIN Dreamer ON User.user_id = Dreamer.user_id 
        ORDER BY dreamer_status;";
        $user_ids = "SELECT user_id FROM Dreamer;";
    } else if ($_GET["data_select"] == "volunteers") {
        $sql = "SELECT User.user_first, User.user_last, User.user_email, User.user_phone, User.user_date_joined, 
        volunteer_verified, volunteer_street_address, volunteer_zip, volunteer_city, volunteer_state, volunteer_tshirt_size,
        volunteer_about_us, volunteer_interest, volunteer_availability, volunteer_motivated, volunteer_experience,
        volunteer_youth_experience, volunteer_skills, volunteer_status, volunteer_notes
        FROM User INNER JOIN Volunteer ON User.user_id = Volunteer.user_id 
        ORDER BY volunteer_status;";
        $user_ids = "SELECT user_id FROM Volunteer;";
    }

        //storing return data and ensuring query executes correctly
        $result = mysqli_query($db, $sql);
        //storing column names
        $tableHeadingNames = $result->fetch_fields();
        //storing return data and ensuring query executes correctly
        $result_ids = mysqli_query($db, $user_ids);

    ?>
    <div class="space">
    <table data-order='[[<?php echo mysqli_num_fields($result) - 2; ?>, "asc"]]' id="dreamer-table"
           class="display">
        <?php
        //buildTable (functions.php)
        echo buildTable($result, $tableHeadingNames, $result_ids, 1); ?>
    </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <!-- jquery data tables-->
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <!-- for the html5 excel button to work -->
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <!-- for the html5 excel button to work -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- for the html5 excel button -->
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <!-- script that builds data table and excel button -->
    <script type="text/javascript" src="scripts/excel_page_functions.js"></script>
</body>
</html>
