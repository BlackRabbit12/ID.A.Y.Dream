<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-11-09
 * Last Updated: 2019-11-12
 * File name: db_connect.php
 *
 * Description:
 *      Database connection file.
 */

$username = 'root';
$password = 'password';
$hostname = 'database';
$database = 'idaydream';

global $db;

$db = mysqli_connect($hostname, $username, $password, $database)
    or die("Connection error: " . mysqli_connect_error());
