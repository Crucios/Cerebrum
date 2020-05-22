<?php

	require_once "connect.php";

	$id = $_POST["id"];

	echo "<?xml version='1.0' encoding='UTF-8'?>\n";
	echo "<data>\n";
	
	$result = mysqli_query($conn, "SELECT users.nickname, comments.timestamp, comments.message FROM comments JOIN users ON comments.id_users = users.id WHERE comments.id_post = $id");
	
	if(!empty($result)){
		while($row = mysqli_fetch_array($result)){
			echo "<comment>\n";
			echo "<creator>".$row["nickname"]."</creator>\n";
			echo "<timestamp>".date('F d, Y', strtotime($row["timestamp"]))."</timestamp>\n";
			echo "<message>".$row["message"]."</message>\n";
			echo "</comment>\n";
		}
	}
	echo "</data>";

	mysqli_close($conn);
?>