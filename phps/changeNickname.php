<?php
session_start();
require_once("connect.php");
if(isset($_POST["name"]) && $_POST["name"] != ""){
    $name = test_input($_POST["name"]);
    $id = $_POST["id"];

    $result = mysqli_query($conn, "UPDATE users SET nickname = '$name' WHERE id = $id");

    if($result){
        echo "Nickname changed successfully!";
        $_SESSION["nickname"] = $name;
    }else{
        echo "Failed to changed nickname!";
    }
}
else{
  echo "Nickname can't be empty!";
}
?>
