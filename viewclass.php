<?php 

require_once "phps/connect.php";

session_start();
$id = $_GET["id"];
$user_id = $_SESSION["id"];

$_SESSION["class_id"] = $id;

$query = mysqli_query($conn, "SELECT class.name, users.nickname, class.description, class.code FROM class JOIN users ON class.id_creator = users.id WHERE class.id = $id");

if(mysqli_num_rows($query) > 0){
	while($row = $query->fetch_array()){
		$_SESSION["classname"] = $row["name"];
		$_SESSION["creator"] = $row["nickname"];
		$_SESSION["description"] = $row["description"];
		$_SESSION["code"] = $row["code"];
	}
}

$query = mysqli_query($conn, "SELECT role FROM class_details WHERE users_id = $user_id AND class_id = $id");

if(mysqli_num_rows($query) > 0){
	while($row = $query->fetch_array()){
		if($row["role"] == 1){
			$_SESSION["role"] = "creator";
		}else if($row["role"] == 2){
			$_SESSION["role"] = "teacher";
		}else if($row["role"] == 3){
			$_SESSION["role"] = "student";	
		}
	}
}
// role 1 = creator, 2 = teacher, 3 = student
header("Location: classwork.php");

?>