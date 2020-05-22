<?php 

require_once "phps/connect.php";

session_start();
$id = $_GET["id"];

$_SESSION["post_id"] = $id;

$query = mysqli_query($conn, "SELECT posts.id, posts.title, posts.type, posts.timestamp, posts.deadline, posts.content, users.nickname FROM posts JOIN users ON users.id = posts.id_users WHERE posts.id = $id");

if(mysqli_num_rows($query) > 0){
	while($row = $query->fetch_array()){
		$_SESSION["post_title"] = $row["title"];
		$_SESSION["post_type"] = $row["type"];
		$_SESSION["post_timestamp"] = $row["timestamp"];
		$_SESSION["post_deadline"] = $row["deadline"];
		$_SESSION["post_content"] = $row["content"];
		$_SESSION["post_creator"] = $row["nickname"];
	}
}

header("Location: postdetail.php");

?>