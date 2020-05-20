<?php

require_once "phps/connect.php";
session_start();
$errOldPass = $errNewPass = $errConfirmPass = "";

if(isset($_POST["password"]) && isset($_POST["newPass"]) && isset($_POST["confirmPass"])){
  $id = $_SESSION["id"];
  $password = test_input($_POST["password"]);
  $changePass = test_input($_POST["newPass"]);
  $confirmPass = test_input($_POST["confirmPass"]);
	$query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id AND password = '$password'");

	if(mysqli_num_rows($query) > 0){
    if($changePass != $confirmPass){
      $errNewPass = $errConfirmPass = "*Password does not match";
    }
    else{
      $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id AND password = '$password'");
    }
	}else{
		$errOldPass = "*Password incorrect";
	}
}

if(!isset($_POST["password"])){
  $errOldPass = "*Password empty";
}

if(!isset($_POST["newPass"])){
  $errOldPass = "*New password empty";
}

if(!isset($_POST["confirmPass"])){
  $errOldPass = "*Confirm Password empty";
}

?>
