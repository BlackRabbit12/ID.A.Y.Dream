<?

$username = 'root';
$password = 'password';
$hostname = 'database';
$database = 'idaydream';

$db = mysqli_connect($hostname, $username, $password, $database)
or die("Connection error: " . mysqli_connect_error());
