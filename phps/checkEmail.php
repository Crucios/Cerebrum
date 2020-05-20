<?php 

require_once "connect.php";

if(isset($_POST["email"])){
	$email = test_input($_POST["email"]);

	$query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

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