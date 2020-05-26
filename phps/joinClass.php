<?php
require_once("connect.php");
if(isset($_POST["code"])){
    $code = test_input($_POST["code"]);
    $id = $_POST["id"];

    $result = mysqli_query($conn, "SELECT id, name FROM class WHERE code = '$code'");

    if(mysqli_num_rows($result) > 0){
        $row = $result->fetch_assoc();
        $id_class = $row["id"];
        $name = $row["name"];

        $query = mysqli_query($conn, "SELECT * FROM class_details WHERE class_id = $id_class AND users_id = $id");

        if(mysqli_num_rows($query) > 0){
            $hasil = mysqli_fetch_array($query);
            if ($hasil['status'] == 0) {
                $query = mysqli_query($conn, "UPDATE class_details SET status = 1 WHERE users_id = $id");
                if($query){
                    echo "Successfully joined $name!";
                }
                else{
                    echo "Failed to join $name!";
                }
            }
            else{
                echo "You already joined $name!";
            }
        }else{
            $query = mysqli_query($conn, "INSERT INTO class_details VALUES (0, $id_class, $id, 3, 1)");

            if($query){
                echo "Successfully joined $name!";
            }
            else{
                echo "Failed to join $name!";
            }
        }   
    }else{
        echo "Class code invalid!";
    }
}
else{
  echo "Class code invalid!";
}
?>
