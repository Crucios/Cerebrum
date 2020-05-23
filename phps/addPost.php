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
    $output = array('success' => false, 'message' => null, 'titleError' => null, 'contentError' => null, 'deadlineDateError' => null, 'deadlineTimeError' => null, 'attachmentsError' => null);

    if(isset($_POST["title"]) && $_POST["title"] != "" && isset($_POST["content"]) && $_POST["content"] != ""){
      // if title and content is not empty do below
      $title = $_POST["title"];
      $content = $_POST["content"];
      $type = $_POST["type"];
      $id_class = $_SESSION["class_id"];
      $id_user = $_SESSION['id'];

      $checkFile = true;
      $checkDeadline = true;  // check if there is deadline, is the deadline true
      $filesToUpload = false; // check if there is files to upload

      $deadlineDate = "";
      $deadlineTime = "";

      if($type == "assignment"){
        // If the type is assignment then do below
        if(!isset($_POST["date"]) || $_POST["date"] == ""){
          $checkDeadline = false;
          $output['deadlineDateError'] = "Deadline date is required";
        }
        else{
          $deadlineDate = $_POST["date"];
        }
        if(!isset($_POST["time"]) || $_POST["time"] == ""){
          $checkDeadline = false;
          $output['deadlineTimeError'] = "Deadline time is required";
        }
        else{
          $deadlineTime = $_POST["time"];
        }
      }

      // Find max id for new id post
      $query = mysqli_query($conn, "SELECT id FROM posts");
      $maxId = 0;
      if(mysqli_num_rows($query) > 0){
      	while($row = $query->fetch_array()){
      		$maxId = $row["id"];
      	}
        $maxId += 1;
      }

      // if type is not assignment do below, if assignment must check deadline
  		if($checkDeadline){
        // If there is file to upload
        $filesToUpload = true;
        $file_array = reArrayFiles($_FILES['postfiles']);
        $array_files = array();

        // this is for check if file to be upload is valid
        for($i = 0; $i < count($file_array); $i++){
          if($file_array[$i]['error']){
              if ($phpFileUploadError[$file_array[$i]['error']] != "No files were uploaded"){
                  $checkFile = false;
                  $output['attachmentsError'] = $file_array[$i]['name'].' - '.$phpFileUploadError[$file_array[$i]['error']];
                  break;
              }
          }
          else{
            $filename = $file_array[$i]['name'];
            $files = array('filename' => $file_array[$i]['name'], 'file_tmp' => $file_array[$i]['tmp_name'], 'query' => "INSERT INTO files VALUES(NULL, '$filename', $maxId)");
            array_push($array_files, $files);
          }
        }


        // Query if all files are valid and deadline is valid
        if($checkFile && $checkDeadline){
          // Get time now
          date_default_timezone_set('Asia/Bangkok');
          $timestamp = date('Y-m-d h:i:s', time());
          $checkQuery = false;

          if($type == "material" || $type == "announcement"){
              $query = mysqli_query($conn, "INSERT INTO posts VALUES(NULL, '$title', '$content', '$timestamp', '$type', NULL, '$id_class', '$id_user')");
              if($query){
                $checkQuery = true;
              }
          }
          else if($type == "assignment"){
              $deadlineTimeStamp = $deadlineDate.' '.$deadlineTime;
              $query = mysqli_query($conn, "INSERT INTO posts VALUES(NULL, '$title', '$content', '$timestamp', '$type', $deadlineTimeStamp, '$id_class', '$id_user')");
              if($query){
                $checkQuery = true;
              }
          }

          if($checkQuery){
            if($filesToUpload){
              $checkFileQuery = true;

              // Get max id file
              $query = mysqli_query($conn, "SELECT id FROM files");
              $maxIdFile = 0;
              if(mysqli_num_rows($query) > 0){
              	while($row = $query->fetch_array()){
              		$maxIdFile = $row["id"];
              	}
                $maxIdFile += 1;
              }

              for($i = 0; $i < count($array_files); $i++){
                // to upload each files
                move_uploaded_file($array_files[$i]['file_tmp'], "../assets/postfiles/".$maxId.'_'.$maxIdFile.'-'.$array_files[$i]['filename']);

                // to query each files
                $query = mysqli_query($conn, $array_files[$i]['query']);

                if(!$query){
                  $output['message'] = "File query failed";
                  $checkFileQuery = false;
                  break;
                }
              }

              if($checkFileQuery){
                $output['success'] = true;
                $output['message'] = "Post successfully created";
              }
            }
            else{
              $output['success'] = true;
              $output['message'] = "Post successfully created";
            }
          }
          else{
            $output['message'] = "Query post failed";
          }

        }
      }
    }

    // Check if the fields required are empty
    if($_POST["type"] == "assignment"){
      if(!isset($_POST["date"]) || $_POST["date"] == ""){
        $output['deadlineDateError'] = "Deadline date is required";
      }

      if(!isset($_POST["time"]) || $_POST["time"] == ""){
        $output['deadlineTimeError'] = "Deadline time is required";
      }
    }

    if(!isset($_POST["title"]) || $_POST["title"] == ""){
      $output['titleError'] = "Title is required";
    }

    if(!isset($_POST["content"]) || $_POST["content"] == ""){
      $output['contentError'] = "Content is required";
    }

    // if($output['success']){
    //     header("Location: ../classwork.php");
    // }
    // else{
    //     header("Location: ../create-post.php");
    // }

    echo json_encode($output);

?>
