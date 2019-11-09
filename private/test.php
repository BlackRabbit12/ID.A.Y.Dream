<form action="test.php" method="POST">
    <input type="text" name="test">
    <button type="submit">submit</button>
</form>

<?php

require_once("validation_functions.php");
require_once "db_connect.php";

$result = genderIsValid($_POST["test"]);

echo "result = $result";

//echo date("Y") + 1;