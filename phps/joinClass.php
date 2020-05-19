<?php
    require_once("connect.php");
    if(isset($_POST["code"])){
        $code = $_POST["code"];
        $query = mysqli_query($conn, "INSERT INTO `class` VALUES (0, '" .$name. "', '" . $desc . "', '" . $code . "')");

        if($query){
            echo "Class Successfully Created!";
        }
        else{
            echo "Class Failed to Create";
        }
    }
    else{
      echo "Class name required";
    }
?>
