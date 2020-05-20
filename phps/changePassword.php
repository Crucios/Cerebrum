<?php

require_once "connect.php";
$errOldPass = $errNewPass = $errConfirmPass = "";
$output = array('success' => false, 'errorOld' => null, 'errorNew' => null, 'errConfirm' => null, 'message' => null);

if(!empty($_POST["password"]) && !empty($_POST["newPass"]) && !empty($_POST["confirmPass"])){
  session_start();
  $id = $_SESSION["id"];
  $password = test_input($_POST["password"]);
  $changePass = test_input($_POST["newPass"]);
  $confirmPass = test_input($_POST["confirmPass"]);
	$query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id AND password = '$password'");


	if(mysqli_num_rows($query) > 0){
    if($changePass != $confirmPass){
      $output["errorNew"] = $output["errConfirm"] = "*Password does not match";
    }
    else{
      $query2 = mysqli_query($conn, "UPDATE `users` SET `password` = '$confirmPass' WHERE `users`.`id` = $id");
      if($query2){
        $output["success"] = true;
        $output["message"] = "Password successfully changed!";
      }
      else{
        $output["message"] = "Password failed to change";
      }
  	}
  }
  else{
    $output["errorOld"] = "*Password incorrect";
  }
}

if(empty($_POST["password"])){
  $output["errorOld"] = "*Password empty";
}

if(empty($_POST["newPass"])){
  $output["errorNew"] = "*New password empty";
}

if(empty($_POST["confirmPass"])){
  $output["errConfirm"] = "*Confirm Password empty";
}

echo json_encode($output);
?>
