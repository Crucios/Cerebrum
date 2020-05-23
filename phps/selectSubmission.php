<?php

	require_once "connect.php";

	$iduser = $_POST["user"];
	$idpost = $_POST["post"];

	$query = mysqli_query($conn, "SELECT id, score, `timestamp` FROM submissions WHERE id_post = $idpost AND id_users = $iduser");

	$data = array("exist" => false, "score" => null, "files" => array(), "time" => null);

	if(mysqli_num_rows($query) > 0){

		while($row = mysqli_fetch_assoc($query)){
			if($row["score"] == ""){
				$data["score"] = "Not graded yet";
			}else{
				$data["score"] = $row["score"];
			}

			$data["time"] = date('F d, Y - H:i:s', strtotime($row["timestamp"]));

			$result = mysqli_query($conn, "SELECT id, link FROM submissions_files WHERE id_submissions = ".$row['id']);

			if(mysqli_num_rows($result) > 0){
				$data["exist"] = true;
				while($row2 = mysqli_fetch_assoc($result)){
					array_push($data["files"], $row["id"]."_".$row2["id"]."-".$row2["link"]);
				}
			}

			break;
		}
	}

	echo json_encode($data);

	mysqli_close($conn);
?>