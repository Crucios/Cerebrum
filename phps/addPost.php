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
    date_default_timezone_set("Asia/Bangkok");

    $output = array('success' => true, 'message' => null, 'titleError' => null, 'contentError' => null, 'deadlineDateError' => null, 'deadlineTimeError' => null, 'attachmentsError' => null, 'query' => array());

    if(!isset($_POST["title"]) || $_POST["title"] == ""){
      $output['titleError'] = "*Title is required";
      $output["success"] = false;
    }

    if(!isset($_POST["content"]) || $_POST["content"] == ""){
      $output['contentError'] = "*Content is required";
      $output["success"] = false;
    }

    if($_POST["type"] == "assignment"){
      if(!isset($_POST["date"]) || $_POST["date"] == ""){
        $output['deadlineDateError'] = "*Deadline date is required";
        $output["success"] = false;
      }

      if(!isset($_POST["time"]) || $_POST["time"] == ""){
        $output['deadlineTimeError'] = "*Deadline time is required";
        $output["success"] = false;
      }
    }

    if($output["success"]){
      $idclass = $_SESSION["class_id"];
      $iduser = $_SESSION["id"];

      $title = test_input($_POST["title"]);
      $content = test_input($_POST["content"]);
      $type = test_input($_POST["type"]);

      if($type == "assignment"){
        $deadline = "'".test_input($_POST["date"]).' '.test_input($_POST["time"])."'";
      }else{
        $deadline = "NULL";
      }

      $timestamp = date("Y-m-d H:i:s", time());

      $query = mysqli_query($conn, "INSERT INTO posts VALUES(NULL, '$title', '$content', '$timestamp', '$type', $deadline, $idclass, $iduser)");

      if(!$query){
        $output['message'] = "*Failed to create post";
        $output["success"] = false;
      }
    }

    if($output["success"]){
      $file_array = reArrayFiles($_FILES['postfiles']);
      $array_files = array();
      $id = 0;
      $idFile = 0;

      if(count($file_array) > 0 and $file_array[0]["name"] != ""){
        $query = mysqli_query($conn, "SELECT max(id) AS id FROM posts");

        if(mysqli_num_rows($query) > 0){
          while($row = mysqli_fetch_assoc($query)){
            $id = $row["id"];
          }
        }else{
          $output['message'] = "*Failed to insert files";
          $output["success"] = false;
        }

        if($output["success"]){
          for($i = 0; $i < count($file_array); $i++){
            if($file_array[$i]['error']){
              if ($phpFileUploadError[$file_array[$i]['error']] != "No files were uploaded"){
                $output['attachmentsError'] = $file_array[$i]['name'].' - '.$phpFileUploadError[$file_array[$i]['error']];
                $output['success'] = false;
                break;
              }
            }
            else{
              $filename = $file_array[$i]['name'];
              $files = array('filename' => $file_array[$i]['name'], 'file_tmp' => $file_array[$i]['tmp_name'], 'query' => "INSERT INTO files VALUES(NULL, '$filename', $id)");
              array_push($array_files, $files);
            }
          }
        }

        if($output["success"]){
          for($i = 0; $i < count($array_files); $i++){

            $query = mysqli_query($conn, $array_files[$i]['query']);

            if($query){
              $query = mysqli_query($conn, "SELECT max(id) AS id FROM files");

              if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                  $idFile = $row["id"];
                  break;
                }
              }
              else{
                $output["success"] = false;
                $output["attachmentsError"] = "*Failed to reach files database";
              }

              if($output["success"]){
                move_uploaded_file($array_files[$i]['file_tmp'], "../assets/postfiles/".$id.'_'.$idFile.'-'.$array_files[$i]['filename']);
              }
            }else{
              $output["success"] = false;
              $output["attachmentsError"] = "*Failed to submit file";
              break;
            }
          }
        }
      }
    }
   
    echo json_encode($output);
?>
