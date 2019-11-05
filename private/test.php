<form action="test.php" method="POST">
    <input type="text" name="test">
    <button type="submit">submit</button>
</form>

<?php

require_once("validation_functions.php");

$result = phoneIsValid($_POST["test"]);

echo "result = $result";