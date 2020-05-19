<?php 

require_once "connect.php";

if(isset($_POST["user"])){
	$username = $_POST["user"];

	$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

	$row = mysqli_num_rows($query);

	if($row > 0){
		echo "1";
	}
	else{
		echo "0";
	}
}

$conn->close();

?>