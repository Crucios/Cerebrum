<?php 

require_once "phps/connect.php";

session_start();
$id = $_GET["id"];

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

header("Location: classwork.php");

?>