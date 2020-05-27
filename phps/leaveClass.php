<?php 
require_once("connect.php");
session_start();

$id = $_POST["id"];
$classid = $_POST["classid"];
$name = $_SESSION["classname"];

$query = mysqli_query($conn, "UPDATE class_details SET status = 0 WHERE users_id = $id AND class_id = $classid");

if ($query) {
	echo "Succesfully left $name!";
}
else{
	echo "Failed to leave $name!";
}

unset($_SESSION["classname"]);
unset($_SESSION["creator"]);	
unset($_SESSION["description"]);
unset($_SESSION["code"]);
unset($_SESSION["role"]);

?>