<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.o
 * 2019-10-30
 * Last Update: 2019-12-09
 * File Name: index.php
 * Associated Files:
 *      css/index_styles.css
 *      @link https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css
 *      images/apple-touch-icon.png
 *      images/favicon-32x32_title.png
 *      images/favicon-16x16_title.png
 *      images/site.webmanifest_title
 *      private/login_creds.php
 *      admin_page.php
 *
 * Description:
 *      File contains iD.A.Y.Dream Youth Organization's Admin Login page. Admin can use this page to go straight to
 *      a new volunteer or youth sign up form, or use their credentials to login and use the admin_page.php admin
 *      tools.
 *      Quick File Relations:
 *          index_styles.css - styles for log in page
 *          login_creds.php - credentials for admin
 *          admin_page.php - if credentials are good, redirect admin to admin_page
 */

//TODO remove error report when live
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

// start a session for login functionality
session_start();

// variable for validation display of the error span for invalid display
$error = '';
$showModal = false;

/**
 * Check to see if the admin has previously logged in using valid credentials.
 * If the login form has been 'submitted' -- we need to check if there are valid credentials or not. If there are
 * valid credentials then we direct user to admin_page.php. If there are NOT valid credentials then we display a
 * login error message for the admin user.
 */
if (isset($_POST['submit'])) {
    // NEED TO CHANGE TO REQUIRE FROM BEHIND PUBLIC DIRECTORY
    require('private/login_creds.php');


    // get the username and password from the POST array login modal
    $username = $_POST['uname1'];
    $password = $_POST['pwd1'];

    // this is the associated CORRECT login credentials that we check user input against
    //$loginCreds (login_creds.php)
    global $loginCreds;

    /*
     * if the username and password are correct we need to set a session and direct the admin user the admin_page.php
     */
    if(array_key_exists($username, $loginCreds) && $loginCreds["$username"] == $password) {
        //Store login name in a session variable
        $_SESSION['username'] = $username;

        // redirect to admin_page.php
        header('location: admin_page.php');
    }

    else {
        $showModal = true;
        $error = 'invalid login credentials, please try again';
    }
} //end (isset($_POST['submit']))
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home - iD.A.Y.Dream</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index_styles.css" type="text/css">
    <!-- https://favicon.io/emoji-favicons/blue-heart/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32_title.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16_title.png">
    <link rel="manifest" href="images/site.webmanifest_title">
</head>
<body>
        <!-- admin button -->
        <div class="row float-right">
            <div class="col">
                <?
                // if the admin user is already logged in we can automatically direct them to admin_page.php
                if (isset($_SESSION['username'])) {
                    echo "<button id='auto-login-button' class='btn rounded-pill float-right text-dark border-dark mr-4 mt-4 pr-3 pl-3' role='button'>ADMIN</button>";
                }
                // else we display the button that will bring up our login modal
                else {
                    echo "<button id=\"admin-button\" class=\"btn rounded-pill float-right text-dark border-dark mr-4 mt-4 pr-3 pl-3\" href=\"#loginModal\" role=\"button\" data-toggle=\"modal\">ADMIN</button>";
                }
                ?>
            </div>
        </div> <!-- end of row that holds the admin button -->

        <!-- page title and admin button -->
        <div class="row" id="title-row">
            <div class="col-sm-9 col-md-5">
                <img src="images/index_title.png" alt="Dreamers & Volunteers">
            </div>
            <div class="col-sm-3 col-md-7"></div>
        </div> <!-- end of row that has the photo of the title -->

        <!-- description text -->
        <div class="row" id="body-text-row">
            <div class="col-sm-9 col-md-5">
                <div class="container">
                    <p id="description-text">We strive to motivate and inspire our dreamers to become leaders in their communities. Through educational programming, one on one mentorship, and community engagement events, we make sure that all youth have the confidence to dream out loud.</p>
                </div>
            </div>
            <div class="col-sm-3 col-md-7"></div>
        </div> <!-- end of row that has the description text -->

        <!-- youth_form.php button -->
        <div class="row">
            <div class="col-sm-9 col-md-5">
                <div class="container bottom-button-containers">
                    <a class="btn ml-2 mt-2 bottom-buttons" href="youth_form.php">DREAMER</a>
                </div>
            </div>
            <div class="col-sm-3 col-md-7"></div>
        </div> <!-- end of row that has the youth form button link -->

        <!-- volunteer_form.php button -->
        <div class="row">
            <div class="col-sm-9 col-md-5">
                <div class="container bottom-button-containers">
                    <a class="btn ml-2 mt-2 bottom-buttons" href="volunteer_form.php">VOLUNTEER</a>
                </div>
            </div>
            <div class="col-sm-3 col-md-7"></div>
        </div> <!-- end of row that has the volunteer button link -->
        <!-- HERE IS THE MODAL THAT ALLOWS ADMIN USERS TO LOG IN -->
        <div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Admin Login</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form method="post" action="">
                        <div class="modal-body">
                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
                                <div class="form-group">
                                    <label for="uname1">Username</label>
                                    <input type="text" class="form-control form-control-lg" name="uname1" id="uname1">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control form-control-lg" name="pwd1" id="pwd1">
                                </div>
                                <!-- this displays the error for logging in that we manipulate in the php at the top -->
                                <span id="error-login"><?= $error; ?></span>
                                <div class="form-group py-4">
                                    <button type="submit" name="submit" value="Submit" class="btn btn-dark btn-lg float-right" id="btnLogin">Login</button>
                                </div>
                            </form> <!-- end formLogin -->
                        </div> <!-- end modal-body -->
                    </form> <!-- end form method="post" -->
                </div> <!-- end modal-content -->
            </div> <!-- end modal-dialog -->
        </div> <!-- end of div that holds the login modal -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="scripts/index_page_functions.js"></script>
        <!-- this handles bringing the modal back up when the user enters invalid login credentials
         since the action happens on post, if you don't do this you will never see the inline error -->
        <?php if($showModal):?>
            <script> $('#loginModal').modal('show');</script>
        <?php endif;?>
</body>
</html>