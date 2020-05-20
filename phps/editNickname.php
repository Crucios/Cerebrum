<?php
  require_once "connect.php";
  session_start();
  $output = array('successEdit' => false, 'successQuery' => false, 'errorNick' => null, 'message' => null, 'markup' => null);

  if(!empty($_POST["nickname"])){
    $id = $_SESSION["id"];
    $nickname = test_input($_POST["nickname"]);
    if($nickname != "0"){
        $query = mysqli_query($conn, "UPDATE `users` SET `nickname` = '$nickname' WHERE `users`.`id` = $id");
        if($query){
          $output["successEdit"] = true;
          $_SESSION["nickname"] = $nickname;
          $output["message"] = "Nickname changed successfully!";
        }
        else{
          $output["message"] = "Nickname failed to change";
        }
    }
    $query = mysqli_query($conn, "SELECT `users`.`nickname` FROM `users` WHERE `users`.`id` = $id");
    if($query){
      if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
          $output["markup"] = $row["nickname"];
          $output["successQuery"] = true;
          break;
        }
      }
    }
  }
  else{
    $output["errorNick"] = "Nickname is empty";
  }

  echo json_encode($output);
?>
