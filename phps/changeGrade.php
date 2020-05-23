<?php 

require_once "connect.php";

$output = array("success" => false, "error" => null);

if(isset($_POST["score"]) && $_POST["score"] >= 0 && $_POST["score"] <= 100){
	$id = $_POST["id"];
	$score = test_input($_POST["score"]);

	if (preg_match("/^-?(?:\d+|\d*\.\d+)$/", $score)){
		$query = mysqli_query($conn, "UPDATE submissions SET score = $score WHERE id = $id");

		if($query){
			$output["success"] = true;
		}else{
			$output["error"] = "Failed to change grade!";
		}
	}else{
		$output["error"] = "*Grade can only be a number ranging from 0-100";
	}

}else{
	$output["error"] = "*Grade can only be a number ranging from 0-100";
}

echo json_encode($output);

?>