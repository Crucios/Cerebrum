<?php
    require_once("connect.php");
    
    if(isset($_POST["message"]) && $_POST["message"] != ""){
        $message = test_input($_POST["message"]);
        $id_user = $_POST["id"];
        $id_post = $_POST["post"];

        date_default_timezone_set('Asia/Bangkok');
        $timestamp = date('Y-m-d h:i:s', time());

        $query = mysqli_query($conn, "INSERT INTO comments VALUES (0, '$message', '$timestamp', '$id_user', '$id_post')");

        if($query){
            echo "Y";
        }else{
            echo "*Failed to post comment";
        }
    }else{
        echo "*You can't post an empty comment!";
    }
?>
