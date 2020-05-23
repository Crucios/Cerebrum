<?php
require_once("connect.php");
$username = $_POST['username'];
$query = mysqli_query($conn, "SELECT * FROM users u JOIN class_details cd ON u.id = cd.users_id WHERE u.username = '$username'");
$hasil = mysqli_fetch_array($query);
if ($hasil['role'] == 2) {
	$users_id = $hasil['users_id'];
	$query = "UPDATE class_details SET role = 3 WHERE users_id = $users_id";
	$go = mysqli_query($conn, $query);
	if($go)
	{
		echo "Assigned to student!";

	}
	else
	{
		echo "Cannot assign to student!";
	}
}
else if ($hasil['role'] == 3)
{
	$users_id = $hasil['users_id'];
	$query = "UPDATE class_details SET role = 2 WHERE users_id = $users_id";
	$go = mysqli_query($conn, $query);
	if($go)
	{
		echo "Assigned to teacher!";
		
	}
	else
	{
		echo "Cannot assign to teacher!";
	}
}




?>