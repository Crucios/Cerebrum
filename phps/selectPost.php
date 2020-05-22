<?php

	require_once "connect.php";

	$id = $_POST["id"];

	echo "<?xml version='1.0' encoding='UTF-8'?>\n";
	echo "<data>\n";
	
	$result = mysqli_query($conn, "SELECT posts.id, posts.title, posts.type, posts.timestamp, users.nickname FROM posts JOIN users ON users.id = posts.id_users WHERE id_classroom = $id");
	
	if(!empty($result)){
		while($row = mysqli_fetch_array($result)){
			echo "<post id='".$row["id"]."'>\n";
			echo "<type>".$row["type"]."</type>\n";
			echo "<creator>".$row["nickname"]."</creator>\n";
			echo "<timestamp>".date('F d, Y', strtotime($row["timestamp"]))."</timestamp>\n";
			echo "<title>".$row["title"]."</title>\n";
			echo "</post>\n";
		}
	}
	echo "</data>";

	mysqli_close($conn);
?>