/*
* Authors: Shayna Jamieson, Keller Flint, Bridget Black
* 2019-11-09
* Last Updated: 2019-11-12
* Version 1.0
* File name: test.php
*/

<form action="test.php" method="POST">
    <input type="text" name="test">
    <button type="submit">submit</button>
</form>

<?php

require_once("validation_functions.php");
require_once "db_connect.php";

$result = validateDOB($_POST["test"]);
$date = formatDOB($_POST["test"]);

echo "date = $date<br>";
echo "result = $result";

//echo date("Y") + 1;