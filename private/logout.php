<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-12-04
 * Last Update: 2019-12-08
 * File name: logout.php
 * Associated Files:
 *      scripts/admin_page_functions.js
 *      index.php
 *
 * Description:
 *      This file contents is used to log the admin user out of the admin page and destroy sessions.
 *      Quick File Relations:
 *          admin_page_functions.js - contains logout button functions
 *          index.php - page logged out of
 */

    //Start the session
    session_start();

    //Destroy the session
    session_destroy();
    $_SESSION = array();

    //Redirect to login page
    header('location: ../index.php');
