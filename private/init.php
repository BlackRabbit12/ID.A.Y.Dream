<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-11-09
 * Last Update: 2019-11-12
 * File name: init.php
 * Associated Files:
 *      ************************************************************************************************
 *
 * Description:
 *      File contains required_once files used by associated files.
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

//require_once "/home/threeofa/db_connect.php"; for cpanel upload

require_once "db_connect.php";
require_once "functions.php";
require_once "validation_functions.php";
require_once "query_functions.php";
require_once "ajax_functions.php";
