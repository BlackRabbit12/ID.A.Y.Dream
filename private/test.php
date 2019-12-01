<form action="test.php" method="POST">
    <input type="text" name="test">
    <button type="submit">submit</button>
</form>

<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-11=09
 * Last Update: 2019-11-12
 * File name: test.php
 * Associated Files:
 *      ************************************************************************************************
 *
 * Description:
 *      File contains **********************************************************************************
 */

require_once("validation_functions.php");
require_once "db_connect.php";

$result = validateDOB($_POST["test"]);
$date = formatDOB($_POST["test"]);

echo "date = $date<br>";
echo "result = $result";

//echo date("Y") + 1;