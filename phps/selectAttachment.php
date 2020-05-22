<?php

	require_once "connect.php";

	$id = $_POST["id"];

	echo "<?xml version='1.0' encoding='UTF-8'?>\n";
	echo "<data>\n";
	
	$result = mysqli_query($conn, "SELECT files FROM files WHERE id_posts = $id");
	
	if(!empty($result)){
		while($row = mysqli_fetch_array($result)){
			echo "<file>\n";
			echo "<files>".$row["files"]."</files>\n";
			echo "</file>\n";
		}
	}
	echo "</data>";

	mysqli_close($conn);
?>