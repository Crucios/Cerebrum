<?php

require_once "connect.php";
session_start();

$id = $_POST["id"];
$role = $_POST["role"];

$query = mysqli_query($conn, "UPDATE class_details SET role = $role WHERE id = $id");

if($query){
	echo "New role assigned successfully!";
}else{
	echo "Failed to assign new role!";
}

?>