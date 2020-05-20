<?php
require_once "connect.php";
session_start();
$output = array('successEdit' => false, 'message' => null);

if(isset($_POST["nickname"]) && $_POST["nickname"] != ""){
  $id = $_POST["id"];
  $nickname = test_input($_POST["nickname"]);

  $query = mysqli_query($conn, "UPDATE users SET nickname = '$nickname' WHERE id = $id");
  if($query){
    $output["successEdit"] = true;
    $_SESSION["nickname"] = $nickname;
    $output["message"] = "Nickname changed successfully!";
  }
  else{
    $output["message"] = "Failed to change nickname!";
  }
}else{
  $output["message"] = "Nickname can't be empty!";
}

echo json_encode($output);
?>
