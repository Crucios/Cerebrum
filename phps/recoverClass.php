<?php

require_once "connect.php";

$id = $_POST["id"];

$query = mysqli_query($conn, "UPDATE class SET status = 1 WHERE id = $id");

if($query){
	echo "Class recovered successfully!";
}else{
	echo "Failed to recover class!";
}

?>