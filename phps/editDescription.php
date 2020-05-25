<?php
require_once "connect.php";
session_start();
$output = array('success' => false, 'message' => null);

if(isset($_POST["desc"]) && $_POST["desc"] != ""){
  $id = $_POST["id"];
  $desc = test_input($_POST["desc"]);

  $query = mysqli_query($conn, "UPDATE class SET `description` = '$desc' WHERE id = $id");
  if($query){
    $output["success"] = true;
    $_SESSION["description"] = $desc;
    $output["message"] = "Description edited successfully!";
  }
  else{
    $output["message"] = "Failed to edit description!";
  }
}else{
  $output["message"] = "Class description can't be empty!";
}

echo json_encode($output);
?>
