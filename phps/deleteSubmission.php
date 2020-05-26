<?php 

require_once "connect.php";

$id = $_POST["id"];
$data = array("success" => false, "message" => null);

$query = mysqli_query($conn, "SELECT * FROM submissions_files WHERE id = $id");

if(mysqli_num_rows($query) > 0){
	while($row = mysqli_fetch_assoc($query)){
		$filename = "../assets/submitfiles/".$row["id_submissions"]."_$id-".$row['link'];

		$query = mysqli_query($conn, "DELETE FROM submissions_files WHERE id = $id");

		if($query){
			if(unlink($filename)){
				$data["success"] = true;
				$data["message"] = "Successfully deleted ".$row["link"]."!";
			}else{
				$data["message"] = "Failed to delete file!";
			}
		}else{
			$data["message"] = "Failed to delete file!";
		}
		break;
	}
}else{
	$data["message"] = "Failed to locate file!";
}

echo json_encode($data);

?>