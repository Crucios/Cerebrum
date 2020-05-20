<?php

	require_once "connect.php";

	$id = $_POST["id"];

	echo "<?xml version='1.0' encoding='UTF-8'?>\n";
	echo "<data>\n";
	
	$result = mysqli_query($conn, "SELECT * FROM class");
	
	if(!empty($result)){
		while($row = mysqli_fetch_array($result)){
			echo "<class id='".$row['id']."'>\n";
			echo "<creator>".$row["id_creator"]."</creator>\n";
			echo "<name>".$row["name"]."</name>\n";
			echo "<description>".$row["description"]."</description>\n";
			echo "<code>".$row["code"]."</code>\n";
			echo "</class>\n";
		}
	}
	echo "</data>";

	mysqli_close($conn);
?>