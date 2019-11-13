<?php

/*
* Authors: Shayna Jamieson, Keller Flint, Bridget Black
* 2019-11-09
* Last Updated: 2019-11-12
* Version 1.0
* File name: db_connect.php
*/

$username = 'root';
$password = 'password';
$hostname = 'database';
$database = 'idaydream';

global $cnxn;

$cnxn = mysqli_connect($hostname, $username, $password, $database)
    or die("Connection error: " . mysqli_connect_error());
