<?php

	require_once "connect.php";

	$idpost = $_POST["idpost"];
	$idclass = $_POST["idclass"];

	$query = mysqli_query($conn, "SELECT users.nickname FROM users JOIN class_details ON users.id = class_details.users_id WHERE class_details.class_id = $idclass AND class_details.status = 1 AND class_details.users_id NOT IN (SELECT submissions.id_users FROM submissions WHERE submissions.id_post = $idpost) AND class_details.role = 3");

	$data = array();

	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_array($query)){
			array_push($data, $row["nickname"]);
		}
	}

	echo json_encode($data);

	mysqli_close($conn);
?>