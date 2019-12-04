<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-12-04
 * Last Update: 2019-12-04
 * File name: logout.php
 * Associated Files: admin_page_functions.js
 *
 * Description:
 *      This file contains is used to log the admin user out of the admin page and destroy sessions
 */

    //Start the session
    session_start();

    //Destroy the session
    session_destroy();
    $_SESSION = array();

    //Redirect to login page
    header('location: ../index.php');
