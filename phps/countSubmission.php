<?php

	require_once "connect.php";

	$idclass = $_POST["idclass"];
	$idpost = $_POST["idpost"];

	$query = mysqli_query($conn, "SELECT count(id) AS count FROM class_details WHERE class_id = $idclass AND role = 3");

	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_assoc($query)){
			$student = $row["count"];
		}
	}

	$query = mysqli_query($conn, "SELECT count(id) AS count FROM submissions WHERE id_post = $idpost");

	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_assoc($query)){
			$submissions = $row["count"];
		}
	}

	$data = array("student" => $student, "submissions" => $submissions);

	echo json_encode($data);

	mysqli_close($conn);
?>