<?php 
require_once("connect.php");
$id = $_POST["id"];
$classid = $_POST["classid"];
$query = mysqli_query($conn, "UPDATE class_details SET status = 0 WHERE users_id = $id AND class_id = $classid");

if ($query) {
	echo "Succesfully leaving the class!";
}
else{
	echo "Fail to leave the class!";
}

?>