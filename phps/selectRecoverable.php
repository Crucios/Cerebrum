<?php

require_once "connect.php";

$id = $_POST["id"];
$data = array("exist" => false, "name" => array(), "id" => array());

$query = mysqli_query($conn, "SELECT id, name FROM class WHERE id_creator = $id AND status = 0");

if(mysqli_num_rows($query) > 0){
	$data["exist"] = true;
	while($row = mysqli_fetch_assoc($query)){
		array_push($data["name"], $row["name"]);
		array_push($data["id"], $row["id"]);
	}
}

echo json_encode($data);

?>