<?php
    // TODO: after final product submitted: remember to turn off error reporting for normal use
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //Start the session
    session_start();

    // if our admin user is not logged in currently then we need to disable them from
    // viewing admin content and redirect to the project splash (home) page
    if(!isset($_SESSION['username'])) {
        header('location: index.html');
    }
?>
<!DOCTYPE html>
<!--
    @author Shayna Jamieson
    @author Bridget Black
    @author Keller Flint
    @version: 1.0
    2019-10-16
    Last Update: 2019-11-27
    File Name: admin_page.php
    Associated Files:
        init.php
        admin_styles.css
        new_admin_logo.png
        create_tables.sql
        ajax_functions.php
        validation_functions.js
        admin_page_functions.js
        @link https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css
        @link //cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css
        @link https://code.jquery.com/jquery-3.4.1.min.js
        @link https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js
        @link https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js
        @link //cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js

    Description:
        File contains iD.A.Y.Dream Youth Organization's Administration Page. Admin page is where any persons
        authorized to be 'admin' will be able to login, then view + edit + delete database entries.
        This page queries the database and populates tables for the selected member type (volunteer or dreamer), and
        the selected member status (active, inactive, pending).
        There is an 'email' button provided after selecting the member type desired, the email button will allow an
        admin to send an email to all 'active' members of the given type (volunteer or dreamer).
        When a member's row in the table is selected, the page will also query the database to populate that member's
        modal, with all of the selected member's information displayed inside. The admin will be allowed to 'edit' or
        'delete' the member while viewing this modal.
        The tables are sortable via column arrows and/or by the 'search' bar.
-->

<html lang="en">
<!-- Require once, single link for all php files that are required once -->
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
</head>
<body>
    <input type="hidden" id="anchor">
    <!-- Admin table logo --> <!-- logo-container -->

    <!-- Entire admin tools + table container -->
    <div class="logo-container">
        <img src="images/new_admin_logo.png" alt="IDAYDream Logo">
    </div>
    <div class="entire-container">
    <!-- Choosing which table summary to look at: None, Dreamer, Volunteer -->
    <div class="input-group">

        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Summary:</label>
        </div> <!-- input-group-prepend -->
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
        </form><!-- select-form -->

        <!-- Toggle: Active, Inactive, Pending -->
        <?php
        // displays switch for toggling active vs inactive if dreamer is selected
        if ($_GET["data_select"] == "dreamers") { ?>
            <div class="switch-field">
                <input type="radio" id="pending-dreamer" name="switch-one" value="Pending"/>
                <label id="pending-dreamer-label" for="pending-dreamer">Pending</label>
                <input type="radio" id="active-dreamer" name="switch-one" value="Active" checked/>
                <label id="active-dreamer-label" for="active-dreamer">Active</label>
                <input type="radio" id="inactive-dreamer" name="switch-one" value="Inactive" />
                <label id="inactive-dreamer-label" for="inactive-dreamer">Inactive</label>
            </div>
        <?php }
        /*
         * This is where the three toggle switch will allow the admin to switch between 'inactive', 'active', and
         * 'pending' for their volunteers and will populate the table according to the member status
         */
        else if($_GET['data_select'] == "volunteers") {
                ?>
                <div class="switch-field">
                    <input type="radio" id="pending" name="switch-two" value="Pending" />
                    <label id="pending-label" for="pending">Pending</label>
                    <input type="radio" id="active" name="switch-two" value="Active" checked/>
                    <label id="active-label" for="active">Active</label>
                    <input type="radio" id="inactive" name="switch-two" value="Inactive" />
                    <label id="inactive-label" for="inactive">Inactive</label>
                </div>
                <?
            }
            /*
             * If the Select table option is = 'volunteers' or 'dreamers', then the admin can send an email to all
             * the 'active' status members of the selected type.
             */
            if($_GET['data_select'] == "volunteers" || $_GET['data_select'] == "dreamers") {
            ?>
            <!-- Email for all active users of table type -->
            <button id="email-button" type="button" class="btn btn-lg text-white">Email</button>
        </div> <!-- input-group -->
        <?php
        }
        ?>


        <?php
        //if it's the dreamer table, run $sql for member row + run $sql_ids for user_ids Foreign key
        if ($_GET["data_select"] == "dreamers") {
            $sql = "SELECT user_first, user_last, user_email, user_phone, dreamer_date_of_birth, dreamer_status, user_date_joined FROM User 
                    INNER JOIN Dreamer ON User.user_id = Dreamer.user_id
                    WHERE dreamer_status = 'active';";
            $sql_ids = "SELECT user_id FROM Dreamer WHERE dreamer_status = 'active';";
        }
        //if it's the volunteer table, run $sql for member row + run $sql_ids for user_ids Foreign key
        else if ($_GET["data_select"] == "volunteers") {
            $sql = "SELECT user_first, user_last, user_email, user_phone, volunteer_verified, volunteer_status, user_date_joined FROM User 
                    INNER JOIN Volunteer ON User.user_id = Volunteer.user_id
                    WHERE volunteer_status = 'active';";
            //******************************************* need to add a WHERE volunteer = active statement ********************
            $sql_ids = "SELECT user_id FROM Volunteer WHERE volunteer_status = 'active';";
        }
        /*
         * If on the dreamer or volunteer table selected, then ensure both database queries executed correctly and
         * then start building the admin page table.
         */
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

    <!-- Modal for member and their data -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="full-name-status"></h4>
                    <button type="button" class="close btn text-white btn-lg" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="modal-body">
                    <!--                <p>Some text in the modal.</p>-->
                    <input type="hidden" id="hidden-id">
                </div>
                <div class="modal-footer">
                    <button type="button" id="delete" class="pull-right bg-danger text-white btn btn-default btn-lg">Delete
                    </button>
                </div>
            </div>
        </div>
    </div> <!-- #myModal -->

    <!-- Modal for email -->
    <div id="emailModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="email-modal-title"></h5>
                    <button type="button" class="close btn text-white btn-lg" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <div class="input-group-prepend" id="email-subject-background">
                            <span class="input-group-text" id="basic-addon3">Subject</span>
                        </div>
                        <input type="text" class="form-control" id="email-subject" aria-describedby="basic-addon3">
                    </div> <!-- end of subject line code -->
                    <span id="err-email-subject" class="d-none">Subject must not be blank</span>
                    <textarea id="email-body" rows="13"></textarea>
                    <span id="err-email-body" class="d-none">Email must not be blank</span>
                </div>
                <div class="modal-footer">
                    <button type="button" id="email-send" class="btn btn-lg btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div> <!-- #emailModal -->


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="scripts/validation_functions.js"></script>
    <script src="scripts/admin_page_functions.js"></script>
</body>
</html>