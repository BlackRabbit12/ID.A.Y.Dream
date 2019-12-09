<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-11-09
 * Last Updated: 2019-12-08
 * File name: db_connect.php
 * Associated Files:
 *      private/init.php
 *
 * Description:
 *      Database connection file.
 *      Quick File Relations:
 *          init.php - allows other files to connect with db_connect.php
 */

$username = 'root';
$password = 'password';
$hostname = 'database';
$database = 'idaydream';

global $db;

$db = mysqli_connect($hostname, $username, $password, $database)
    or die("Connection error: " . mysqli_connect_error());
