<!DOCTYPE html>
<!--
    Authors: Shayna Jamieson, Bridget Black, Keller Flint
    2019-10-16
    Last Update: 2019-11-12
    Version: 1.0
    File Name: admin_page.php
-->
<html lang="en">
<?php require_once "private/init.php";

if (!isset($_GET["data_select"])) {
    $_GET["data_select"] = "none";
}

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin - iD.A.Y.Dream</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin_styles.css" type="text/css">

    <!-- https://favicon.io/emoji-favicons/blue-heart/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32_title.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16_title.png">
    <link rel="manifest" href="images/site.webmanifest_title">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>

    </style>
</head>
<body>
<input type="hidden" id="anchor">
<div class="text-center logo-container">
    <img src="images/iDayDreamLogo.png" alt="IDAYDream Logo">
</div>
<div class="entire-container">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Summary:</label>
        </div>
        <form action="admin_page.php" id="select-form" method="GET">
            <select class="custom-select" id="data-select" name="data_select">
                <option value="none">None</option>
                <option value="dreamers"
                        id="dreamer-option" <?php if ($_GET["data_select"] == "dreamers") echo "selected"; ?>>Dreamers
                </option>
                <option value="volunteers"
                        id="volunteer-option" <?php if ($_GET["data_select"] == "volunteers") echo "selected"; ?>>
                    Volunteers
                </option>
            </select>
        </form>
        <?php
        // displays switch for toggling active vs inactive if dreamer is selected
        if ($_GET["data_select"] == "dreamers") { ?>
        <p>Active: </p>
        <label class="switch">
            <input type="checkbox" id="toggle-inactive" checked>
            <span class="slider"></span>
        </label><br><br>
        <?php }
            // this is where we need the three toggle switch
            // we will allow the admin to switch between inactive, active, and pending
            // for her volunteer users and will populate the table as such
            else if($_GET['data_select'] == "volunteers") {
            ?>
                <div class="parent">
                    <div class="switch_3_ways">
                        <div id="pending" class="switch pending">Pending</div>
                        <div id="active" class="switch active">Active</div>
                        <div id="inactive" class="switch inactive">Inactive</div>
                        <div id="selector" class="selector"></div>
                    </div>

                </div> <!-- displays the three toggle switch-->

             <?
            }
            ?>
        <button id="email-button" type="button" class="btn btn-primary btn-lg">Email</button>
    </div>
    <?php
    //if it's the dreamer table, run $sql for member row + run $sql_ids for user_ids Foreign key
    if ($_GET["data_select"] == "dreamers") {
        $sql = "SELECT user_first, user_last, user_email, user_phone, dreamer_date_of_birth, dreamer_active, user_date_joined FROM User 
                INNER JOIN Dreamer ON User.user_id = Dreamer.user_id
                WHERE dreamer_active = 'active';";
        $sql_ids = "SELECT user_id FROM Dreamer;";
    } //if it's the volunteer table, run $sql for member row + run $sql_ids for user_ids Foreign key
    else if ($_GET["data_select"] == "volunteers") {
        $sql = "SELECT user_first, user_last, user_email, user_phone, volunteer_verified, volunteer_status, user_date_joined FROM User 
                INNER JOIN Volunteer ON User.user_id = Volunteer.user_id;";
        //******************************************* need to add a WHERE volunteer = active statement and change TINYINT to Varchar??********************
        $sql_ids = "SELECT user_id FROM Volunteer;";
    }

    //if on the dreamer or volunteer table then continue:
    if (($_GET["data_select"] == "dreamers") || $_GET["data_select"] == "volunteers") {
        //storing return data and ensuring query executes correctly
        $result = mysqli_query($db, $sql);
        //storing column names
        $tableHeadingNames = $result->fetch_fields();
        //storing return data and ensuring query executes correctly
        $result_ids = mysqli_query($db, $sql_ids);
        ?>

        <!--start the building of the table-->
        <table data-order='[[<?php echo mysqli_num_fields($result) - 1; ?>, "desc"]]' id="dreamer-table"
               class="display">
            <?php echo buildTable($result, $tableHeadingNames, $result_ids); ?>
        </table>
        <?php
    } //closing if statement
    ?>
</div> <!-- entire container -->

<!-- Modal for individual users and their data -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="full-name"></h4>
                <button type="button" class="close btn bg-secondary" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modal-body">
                <!--                <p>Some text in the modal.</p>-->
                <input type="hidden" id="hidden-id">
            </div>
            <div class="modal-footer">
                <button type="button" id="delete" class="pull-right bg-danger text-white btn btn-default">Delete
                </button>
                <button type="button" id="save" class="pull-left bg-danger text-white btn btn-default">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for email functionality -->
<div id="emailModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="email-modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Subject</span>
                    </div>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div> <!-- end of subject line code -->
                <textarea rows="10" cols="50"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="scripts/admin_page_functions.js"></script>
</body>
</html>