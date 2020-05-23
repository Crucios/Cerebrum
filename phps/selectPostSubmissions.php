<?php

	require_once "connect.php";

	$id = $_POST["id"];

	echo "<?xml version='1.0' encoding='UTF-8'?>\n";
	echo "<data>\n";
	
	$result = mysqli_query($conn, "SELECT submissions.id, submissions.timestamp, submissions.score, users.nickname FROM submissions JOIN users ON submissions.id_users = users.id WHERE submissions.id_post = $id");
	
	if(!empty($result)){
		while($row = mysqli_fetch_array($result)){
			echo "<submission id='".$row["id"]."'>\n";
			echo "<timestamp>".date('F d, Y - H:i:s', strtotime($row["timestamp"]))."</timestamp>\n";
			echo "<score>".$row["score"]."</score>\n";
			echo "<name>".$row["nickname"]."</name>\n";

			echo "<files>\n";
			
			$query = mysqli_query($conn, "SELECT id, link FROM submissions_files WHERE id_submissions = ".$row["id"]);
			if(!empty($query)){
				while($row2 = mysqli_fetch_array($query)){
					echo "<file>".$row["id"]."_".$row2["id"]."-".$row2["link"]."</file>\n";
				}
			}

			echo "</files>\n";

			echo "</submission>\n";
		}
	}
	echo "</data>";

	mysqli_close($conn);
?>