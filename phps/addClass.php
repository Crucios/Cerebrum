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
        $name = test_input($_POST["name"]);
        $desc = test_input($_POST["desc"]);
        $id = $_POST["id"];

        do{
            $code = generateRandomString();
            $result = mysqli_query($conn, "SELECT * FROM class WHERE code = '$code'");
        } while (mysqli_num_rows($result) > 0);

        $query = mysqli_query($conn, "INSERT INTO class VALUES (0, $id, '$name', '$desc', '$code')");

        if($query){
            $query = mysqli_query($conn, "SELECT id FROM class WHERE code = '$code'");

            if(mysqli_num_rows($query) > 0){
                $row = $query->fetch_assoc();
                $id_class = $row["id"];
            }

            $query = mysqli_query($conn, "INSERT INTO class_details VALUES (0, $id_class, $id)");

            if($query){
                echo "Class Successfully Created!";
            }else{
                echo "Failed to Connect to Class!";
            }
        }
        else{
            echo "Failed to Create Class!";
        }
    }
    else{
      echo "Class name required!";
    }
?>
