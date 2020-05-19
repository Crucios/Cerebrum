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

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);

	return $data;
}

?>