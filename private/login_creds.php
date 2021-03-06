<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-12-04
 * Last Update: 2019-12-09
 * File name: login_creds.php
 * Associated Files:
 *      index.php
 *
 * Description:
 *      This file contains the login credentials for the admin page access.
 *      Currently we will only have one username and password that Brandi can use and
 *      share with whomever needs to give CRUD access to.
 *      Quick File Relations:
 *          index.php - uses the credentials for login
 *
 *      *** PLEASE NOTE : when uploading to the cPanel server this file needs to be transferred to
 *      a location behind the public html file area, and deleted from this project's private directory ***
 */

global $loginCreds;
$loginCreds = array("admin"=>"iD@yDr3@m");


