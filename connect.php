<?php 

$server = "localhost";
$username = "root";
$password = "";
$database = "proyek";

$conn = mysqli_connect($server, $username, $password, $database);

if($conn === false)
{
	die("ERROR: Could not conncet. " . msqli_connect_error());
}

?>