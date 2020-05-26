<?php

require_once "connect.php";
session_start();

$id = $_POST["id"];

$query = mysqli_query($conn, "UPDATE class SET status = 0 WHERE id = $id");

if($query){
	unset($_SESSION["classname"]);
	unset($_SESSION["creator"]);
	unset($_SESSION["description"]);
	unset($_SESSION["code"]);
	unset($_SESSION["post_title"]);
	unset($_SESSION["post_content"]);
	unset($_SESSION["post_timestamp"]);
	unset($_SESSION["post_deadline"]);
	unset($_SESSION["post_type"]);
	unset($_SESSION["post_creator"]);
	echo "S";
}else{
	echo "Failed to delete class";
}

?>