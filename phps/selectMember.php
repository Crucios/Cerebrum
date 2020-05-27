<?php

require_once "connect.php";
session_start();

$id = $_POST["id"];
$role = $_POST["role"];

if($role == "creator"){
	$output = array("teacher" => array(), "teacherId" => array(), "student" => array(), "studentId" => array());

	$query = mysqli_query($conn, "SELECT class_details.id, users.username, class_details.role FROM users JOIN class_details ON users.id = class_details.users_id WHERE class_details.class_id = $id AND class_details.status = 1 AND class_details.role > 1;");

	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_assoc($query)){
			if($row["role"] === "2"){
				array_push($output["teacher"], $row["username"]);
				array_push($output["teacherId"], $row["id"]);
			}else if($row["role"] === "3"){
				array_push($output["student"], $row["username"]);
				array_push($output["studentId"], $row["id"]);
			}
		}
	}

}else{
	$output = array("teacher" => array(), "student" => array());

	$query = mysqli_query($conn, "SELECT users.username, class_details.role FROM users JOIN class_details ON users.id = class_details.users_id WHERE class_details.class_id = $id AND class_details.status = 1 AND class_details.role > 1;");

	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_assoc($query)){
			if($row["role"] == "2"){
				array_push($output["teacher"], $row["username"]);
			}else if($row["role"] == "3"){
				array_push($output["student"], $row["username"]);
			}
		}
	}
}

echo json_encode($output);

?>