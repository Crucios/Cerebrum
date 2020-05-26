<?php

	require_once "connect.php";

	$id = $_POST["id"];

	echo "<?xml version='1.0' encoding='UTF-8'?>\n";
	echo "<data>\n";
	
	$result = mysqli_query($conn, "SELECT class.id, class.name, users.nickname, class.description, class.code FROM class_details JOIN class ON class_details.class_id = class.id JOIN users ON class.id_creator = users.id WHERE class_details.users_id = $id AND class_details.status = 1 AND class.status = 1");
	
	if(!empty($result)){
		while($row = mysqli_fetch_array($result)){
			echo "<class id='".$row["id"]."'>\n";
			echo "<name>".$row["name"]."</name>\n";
			echo "<creator>".$row["nickname"]."</creator>\n";
			echo "<description>".$row["description"]."</description>\n";
			echo "<code>".$row["code"]."</code>\n";
			echo "</class>\n";
		}
	}
	echo "</data>";

	mysqli_close($conn);
?>