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
    $output = array('success' => false, 'message' => null);

    if(isset($_POST["title"]) && $_POST["title"] != "" && isset($_POST["type"]) && $_POST["type"] != ""){
      $title = $_POST["title"];
      $content = $_POST["content"];
      $type = $_POST["type"];
      $id_class = $_SESSION["class_id"];
      $id_user = $_SESSION['id'];

      $checkFile = true;
      $checkDeadline = true;
      $filesToUpload = false;

      $deadlineDate = "";
      $deadlineTime = "";

      if($type == "assignment"){
        if(!isset($_POST["date"]) || $_POST["date"] == ""){
          $checkDeadline = false;
          echo "date is empty";
        }
        else{
          $deadlineDate = $_POST["date"];
        }
        if(!isset($_POST["time"]) || $_POST["time"] == ""){
          $checkDeadline = false;
          echo "time is empty";
        }
        else{
          $deadlineTime = $_POST["time"];
        }
      }

      // Find max id
      $query = mysqli_query($conn, "SELECT id FROM posts");
      $maxId = 0;
      if(mysqli_num_rows($query) > 0){
      	while($row = $query->fetch_array()){
      		$maxId = $row["id"];
      	}
      }

      // If there is file to upload
  		if(isset($_FILES['postfiles']) && $checkDeadline){
        $filesToUpload = true;
        $file_array = reArrayFiles($_FILES['postfiles']);
        $array_files = array();

        for($i = 0; $i < count($file_array); $i++){
          if($file_array[$i]['error']){
              echo $file_array[$i]['name'].' - '.$phpFileUploadError[$file_array[$i]['error']];
              $checkFile = false;
          }
          else{
            $filename = $file_array[$i]['name'];
            $files = array('filename' => $file_array[$i]['name'], 'file_tmp' => $file_array[$i]['tmp_name'], 'query' => "INSERT INTO files VALUES(NULL, '$filename', $maxId)");
            array_push($array_files, $files);
          }
        }


        // Query if all necessary is true
        if($checkFile && $checkDeadline){
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
              $deadlineTimeStamp = strtotime($deadlineDate.' '.$deadlineTime);
              $query = mysqli_query($conn, "INSERT INTO posts VALUES(NULL, '$title', '$content', '$timestamp', '$type', $deadlineTimeStamp, '$id_class', '$id_user')");
              if($query){
                $checkQuery = true;
              }
          }

          if($checkQuery){
            echo "Query Post Success";
            if($filesToUpload){
              $checkFileQuery = true;
              for($i = 0; $i < count($array_files); $i++){
                move_uploaded_file($array_files[$i]['file_tmp'], "../assets/postfiles/".$array_files[$i]['filename']);
                $query = mysqli_query($conn, $array_files[$i]['query']);

                if(!$query){
                  echo "File query failed";
                  $checkFileQuery = false;
                  break;
                }
              }

              if($checkFileQuery){
                $output['success'] = true;
              }
            }
          }
          else{
            echo "Query post failed";
          }

        }
      }
    }
    else{
      echo "Title required!";
    }

    if($output['success']){
        header("Location: ../classwork.php");
    }
?>
