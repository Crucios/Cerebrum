<?php
    require_once("connect.php");
    
    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    if(isset($_POST["name"]) && $_POST["name"] != ""){
        $name = $_POST["name"];
        $desc = $_POST["desc"];
        $code = generateRandomString();
        $query = mysqli_query($conn, "INSERT INTO class VALUES (0, '$name', '$desc', '$code')");

        if($query){
            echo "Class Successfully Created!";
        }
        else{
            echo "Failed to Create Class!";
        }
    }
    else{
      echo "Class name required!";
    }
?>
