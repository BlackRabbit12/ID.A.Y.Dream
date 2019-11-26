<?php

/*
* Authors: Shayna Jamieson, Keller Flint, Bridget Black
* 2019-11-09
* Last Updated: 2019-11-12
* Version 1.0
* File name: init.php
*/

ini_set('display_errors', 1);
error_reporting(E_ALL);

//require_once "/home/threeofa/db_connect.php"; for cpanel upload

require_once "db_connect.php";
require_once "functions.php";
require_once "validation_functions.php";
require_once "query_functions.php";
require_once "ajax_functions.php";
