<?php
    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    require_once("connect.php");
    if(isset($_POST["name"]) && isset($_POST["price"])){
        $name = $_POST["name"];
        $desc = $_POST["desc"];
        $code = generateRandomString();
        $query = mysqli_query($conn, "INSERT INTO `class` (0, '" .$name. "', '" . $desc . "', '" . $code . "')");

        if($query){
            echo "Class Successfully Created!";
        }
        else{
            echo "Class Failed to Create";
        }
    }
?>
