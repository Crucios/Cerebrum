<?php
function pre_r($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

function reArrayFiles($file_post){
	$file_array = array();
	$file_count = count($file_post['name']);
	$file_keys = array_keys($file_post);

	for($i=0; $i<$file_count; $i++){
		foreach ($file_keys as $key){
			$file_array[$i][$key] = $file_post[$key][$i];
		}
	}

	return $file_array;
}

$phpFileUploadError = array(
	0 => 'There is no error file uploaded with success',
	1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
	2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
	3 => 'The uploaded file was only partially uploaded',
	4 => 'No files were uploaded',
	6 => 'Missing a temporary folder',
	7 => 'Failed to write file to disk',
	8 => 'A PHP extension stopped the file upload',
);

require_once("connect.php");
session_start();
date_default_timezone_set('Asia/Bangkok');
$timestamp = date('Y-m-d H:i:s', time());

$output = array("success" => true, "error" => null, "data" => array());

$file_array = reArrayFiles($_FILES['upload']);
$array_files = array();
$id = 0;
$idFile = 0;

if(count($file_array) > 0 and $file_array[0]["name"] != ""){
	$query = mysqli_query($conn, "SELECT id FROM submissions WHERE id_post = ".$_SESSION['post_id']." AND id_users = ".$_SESSION['id']);

	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_assoc($query)){
			$id = $row["id"];
		}

		$time = mysqli_query($conn, "UPDATE submissions SET `timestamp` = '$timestamp' WHERE id = $id");

		if(!$time){
			$output["success"] = false;
			$output["error"] = "*Failed to update submission time";
		}

	}else{
		$query = mysqli_query($conn, "INSERT INTO submissions VALUES (NULL, '$timestamp', NULL, ".$_SESSION['id'].", ".$_SESSION['post_id'].")");

		if($query){
			$query = mysqli_query($conn, "SELECT id FROM submissions WHERE id_post = ".$_SESSION['post_id']." AND id_users = ".$_SESSION['id']);

			if(mysqli_num_rows($query) > 0){
				while($row = mysqli_fetch_assoc($query)){
					$id = $row["id"];
				}
			}

		}else{
			$output["success"] = false;
			$output["error"] = "Add submission failed";
		}
	}

	if($output["success"]){
		for($i = 0; $i < count($file_array); $i++){
			if($file_array[$i]['error']){
				if ($phpFileUploadError[$file_array[$i]['error']] != "No files were uploaded"){
					$output['error'] = $file_array[$i]['name'].' - '.$phpFileUploadError[$file_array[$i]['error']];
					$output['success'] = false;
					break;
				}
			}
			else{
				$filename = $file_array[$i]['name'];
				$files = array('filename' => $file_array[$i]['name'], 'file_tmp' => $file_array[$i]['tmp_name'], 'query' => "INSERT INTO submissions_files VALUES(NULL, '$filename', $id)");
				array_push($array_files, $files);
			}
		}
	}

	if($output["success"]){
		for($i = 0; $i < count($array_files); $i++){

			$query = mysqli_query($conn, $array_files[$i]['query']);

			if($query){
				$query = mysqli_query($conn, "SELECT max(id) AS id FROM submissions_files");

				if(mysqli_num_rows($query) > 0){
					while($row = mysqli_fetch_assoc($query)){
						$idFile = $row["id"];
						break;
					}
				}
				else{
					$output["success"] = false;
					$output["error"] = "*Failed to reach submission database";
				}

				if($output["success"]){
					move_uploaded_file($array_files[$i]['file_tmp'], "../assets/submitfiles/".$id.'_'.$idFile.'-'.$array_files[$i]['filename']);
				}
			}else{
				$output["success"] = false;
				$output["error"] = "*Failed to submit file";
				break;
			}
		}
	}
}else{
	$output["success"] = false;
	$output["error"] = "*Files can't be empty";
}

echo json_encode($output);

?>
