<?php

require_once "connect.php";
$errOldPass = $errNewPass = $errConfirmPass = "";
$output = array('success' => false, 'errorOld' => null, 'errorNew' => null, 'errConfirm' => null, 'message' => null);

if(isset($_POST["password"]) && $_POST["password"] != "" && isset($_POST["newPass"]) && $_POST["newPass"] != "" && isset($_POST["confirmPass"]) && $_POST["confirmPass"] != ""){
  $id = test_input($_POST["id"]);
  $password = test_input($_POST["password"]);
  $changePass = test_input($_POST["newPass"]);
  $confirmPass = test_input($_POST["confirmPass"]);

  
  $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id AND password = '$password'");
  if(mysqli_num_rows($query) > 0){
    if($changePass == $confirmPass){
      if(strlen($changePass) < 6){
        $output["errorNew"] = "*Password has to be at least 6 characters long";
        $output["message"] = "Failed to change password! Password has to be at least 6 characters long";
      }else{
        $query = mysqli_query($conn, "UPDATE users SET password = '$confirmPass' WHERE id = $id");
        if($query){
          $output["success"] = true;
          $output["message"] = "Password successfully changed!";
        }else{
          $output["message"] = "Failed to change password!";
        }
      }
    }else{
      $output["errConfirm"] = "*Password does not match";
      $output["message"] = "Failed to change password! Password does not match!";
    }
  }else{
    $output["errorOld"] = "*Password incorrect";
    $output["message"] = "Failed to change password! Old password incorrect!";
  }
}else{
  if(empty($_POST["password"]) or $_POST["password"] == ""){
    $output["errorOld"] = "*Password empty";
  }
  if(empty($_POST["newPass"]) or $_POST["newPass"] == ""){
    $output["errorNew"] = "*New password empty";
  }
  if(empty($_POST["confirmPass"]) or $_POST["confirmPass"] == ""){
    $output["errConfirm"] = "*Confirm Password empty";
  }
  $output["message"] = "Failed to change password! Password fields can't be empty!";
}

echo json_encode($output);
?>
