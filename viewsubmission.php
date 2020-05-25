<?php
session_start();

if(!isset($_SESSION["username"])){
  header("Location: index.php");
}

if(!isset($_SESSION["post_id"]) or ($_SESSION["role"] != "creator" and $_SESSION["role"] != "teacher")){
  header("Location: postdetail.php");
}

date_default_timezone_set('Asia/Bangkok');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Cerebrum</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="website.css">
  <link rel="icon" href="assets/images/logo.png">
  <style type="text/css">
    #main{
      background-color: rgba(180, 255, 255, 0.8); 
      padding: 1.5rem 3rem; 
      color: rgb(80, 80, 80);
      border: 3px solid rgba(55, 100, 100);
      border-radius: 1rem;
    }

    #content{
      background-color: rgba(255, 255, 255, 0.7); 
      padding: 1rem 3rem; 
      color: rgb(80, 80, 80);
      border: 3px solid rgba(55, 100, 100);
      border-radius: 1rem;
    }

    #submit{
      background-color: rgba(180, 205, 180, 0.8); 
      padding: 1rem 3rem; 
      color: rgb(80, 80, 80);
      border: 3px solid rgba(55, 100, 100);
      border-radius: 1rem;
    }

    #nosubmit{
      background-color: rgba(255, 200, 200, 0.7); 
      padding: 1rem 4rem; 
      color: rgb(80, 80, 80);
      border: 3px solid rgba(55, 100, 100);
      border-radius: 1rem;
    }

    .submission{
      padding: 1rem;
      margin: 0.5rem 0;
      border: 3px solid rgba(100, 145, 140, 0.8);
      border-radius: 0.5rem;
      background-color: rgba(245, 240, 190, 0.8);
    }

    .noSubmission{
      padding: 0.5rem 1rem 0rem 1rem;
      margin: 0.2rem 0;
      border: 3px solid rgba(100, 145, 140, 0.8);
      border-radius: 0.5rem;
      background-color: rgba(245, 245, 245, 0.8);
    }

    .files{
      background-color: white;
      padding: 0.5rem 1rem;
      border: 3px solid rgba(55, 100, 100);
      font-size: 15px;
      font-weight: bold;
      box-shadow: 0.2rem 0.2rem #5984b3;
      color: rgb(80, 80, 80);
    }

    .files:hover{
      background-color:rgba(165, 165, 165, 0.8);
      color: darkblue;
      box-shadow: 0rem 0rem; 
    }

    a:hover{
      text-decoration: none;
    }

    .error{
      color: red;
      margin-left: 1rem;
      display: none;
    }
  </style>
</head>
<body>
 
  <!-- Change Password Modal -->
  <div class="modal fade" id="changePassword_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="margin: 1rem;">
        <div class="modal-header">
          <h5 class="modal-title">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body form-group">
          <label for="password"><strong>Input Password:</strong>&nbsp;&nbsp;<span id="passwordErrorHandler" style="color: red;"></span></label>
          <input type="password" id="oldPass_Text" name="password" placeholder="Enter your old password" class="form-control">
          <label style="margin-top: 0.5rem;" for="changePass"><strong>Change Password:</strong>&nbsp;&nbsp;<span id="change_passwordErrorHandler" style="color: red;"></span></label>
          <input name="changePass" id="changePass_Text" class="form-control" placeholder="Enter your new password" type="password">
          <label style="margin-top: 0.5rem;" for="confirmPass"><strong>Confirm Password:</strong>&nbsp;&nbsp;<span id="confirm_passwordErrorHandler" style="color: red;"></span></label>
          <input name="confirmPass" id="confirmPass_Text" class="form-control" placeholder="Confirm your new password" type="password">
        </div>
        <div class="modal-footer" style="text-align: right;">
          <button type="submit" id="changePass_confirm" class="btn btn-warning" style="margin-right: 0; width: 50%;" data-dismiss="modal">Change Password</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Change Nickname Modal -->
  <div class="modal fade" id="changeNickname_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="margin: 1rem;">
        <div class="modal-header">
          <h5 class="modal-title">Change Nickname</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body form-group">
          <input name="changeNick" class="form-control" placeholder="New Nickname" id="changeNick_text" type="text" required style="margin-top: 0.5rem;">
        </div>
        <div class="modal-footer" style="text-align: right;">
          <button type="button" id="changeNick_confirm" class="btn btn-warning" style="margin-right: 0; width: 50%;" data-dismiss="modal">Change Nickname</button>
        </div>
      </div>
    </div>
  </div>

  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand navIcon" href="#">
      <img src="assets/images/logo.png">
      <span>Cerebrum</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="postdetail.php">Post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="classwork.php">Classwork</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="listmember.php">People</a>
        </li>
      </ul>
    </div>
   <div class="nav-item dropdown">
     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span id="nickname" style="color: lightgray; margin-right: 0.5rem;"><?php echo $_SESSION["nickname"]; ?></span>
      <img src="assets/images/user-icon.png" style="width:30px; height:30px;">
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
     <a class="dropdown-item disabled"><img src="assets/images/account.png" height="15" width="15" style="margin-right: 0.5rem;"><?php echo $_SESSION["username"]; ?></a> 
     <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePassword_modal">Change Password</a>
     <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changeNickname_modal">Change Nickname</a>
     <a class="dropdown-item" href="logout.php" id="createClass_button">Log Out</a>
   </div>
 </div>
</div>
</nav>

<div class="container-fluid" style="margin-top: 5rem;">
  <div class="row">
    <div class="col-sm-10 offset-sm-1" id="alert">

    </div>
  </div>
  <div class="row mt-2">
    <div class="col-sm-10 offset-sm-1" id="alert">
      <div class="card" id="main">
        <h2><img src="assets/images/<?php echo $_SESSION["post_type"]; ?>.png" height="25" width="25" style="margin-right: 0.5rem;"><?php echo $_SESSION["post_title"]; ?></h2>
        <h5><img src="assets/images/account.png" height="20" width="20" style="margin-right: 0.5rem;"><?php echo $_SESSION["post_creator"]; ?> - Posted on <strong><?php echo date('F d, Y', strtotime($_SESSION["post_timestamp"])); ?></strong></h5>
        <h5><strong>Deadline: <?php echo date('F d, Y - H:i:s', strtotime($_SESSION["post_deadline"])); ?></strong></h5>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-sm-10 offset-sm-1">
      <div class="card" id="content">
        <h3><?php echo ucfirst($_SESSION["post_type"]); ?> Details:</h3>
        <div class="row" id="listFiles">

        </div>
        <h5><?php echo $_SESSION["post_content"]; ?></h5>
        <h5 class="mt-1"><strong>Status: </strong><span id="submitCount"></span> out of <span id="studentCount"></span> students have submitted their assignments</h5>
      </div>
      <div class="card mt-3" id="submit">
        <h3>Submissions: </h3>
        <div class="row" id="listSubmissions">
          
        </div>
      </div>
      <div class="card mt-3" id="nosubmit">
        <h3>No Submission Yet: </h3>
        <div class="row" id="listNoSubmit">
          
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">

function changeGrade(id){
    var score = $("#grade-input-"+id).val();
    $.ajax({
      type: "POST",
      data: { id:id, score:score },
      url: "phps/changeGrade.php",
      success:function(result){
        result = $.parseJSON(result);

        if(result.success){
          $("#error-"+id).html("");
          $("#grade-input-"+id).val("");
          $("#score-"+id).html(parseInt(score));
          $("#error-"+id).hide();
        }else{
          $("#error-"+id).html(result.error);
          $("#error-"+id).show();
        }
      }
    });
  }

 $(document).ready(function(){

  function countSubmission(){
    var idpost = <?php echo $_SESSION['post_id']; ?>;
    var idclass = <?php echo $_SESSION['class_id']; ?>;
    $.ajax({
      type: "POST",
      data: { idpost:idpost, idclass:idclass },
      url: "phps/countSubmission.php",
      success:function(result){
        result = $.parseJSON(result);
        $("#studentCount").html(result.student);
        $("#submitCount").html(result.submissions);
      }
    });
  }

  function refreshNoSubmit(){
    var idpost = <?php echo $_SESSION['post_id']; ?>;
    var idclass = <?php echo $_SESSION['class_id']; ?>;
    $("#listNoSubmit").html("");
    $.ajax({
      type: "POST",
      data: { idpost:idpost, idclass:idclass },
      url: "phps/selectNoSubmission.php",
      success:function(result){
        result = $.parseJSON(result);
        console.log(result);

        for(var name in result){
          var nosubmitcard = "<div class='col-12'><div class='card noSubmission'><h5><img src='assets/images/account.png' height='20' width='20' style='margin-right: 0.5rem;'>Leonardo DiCaprio</h5></div></div>";
          $("#listNoSubmit").append(nosubmitcard);
        }
      }
    });
  }

  function refreshAttachment(){
    var id = <?php echo $_SESSION['post_id']; ?>;
    $("#listFiles").empty();
    $.ajax({
      type: "POST",
      data: { id:id },
      url: "phps/selectAttachment.php",
      success:function(xml){
        $(xml).find("file").each(function(){
          var link = $(this).find("files").text();
          var display = link.split("-")[1];

          var filecard = "<div class='col-md-3 col-sm-6 mb-3'><a href='./assets/postfiles/"+link+"' download='"+display+"'><div class='card files'>"+display+"</div></a></div>";

          $("#listFiles").append(filecard);
        });
      }
    });
  }

  function refreshSubmissions(){
    var id = <?php echo $_SESSION['post_id']; ?>;
    $("#listSubmissions").empty();
    $.ajax({
      type: "POST",
      data: { id:id },
      url: "phps/selectPostSubmissions.php",
      success:function(xml){
        $(xml).find("submission").each(function(){
          var id = $(this).attr("id");
          var name = $(this).find("name").text();
          var timestamp = $(this).find("timestamp").text();
          var score = $(this).find("score").text();

          if(score == ""){
            score = "Not graded yet";
          }

          var subcard = "<div class='col-12'><div class='card submission'><h5><img src='assets/images/account.png' height='20' width='20' style='margin-right: 0.5rem;'>"+name+" - Submitted on <strong>"+timestamp+"</strong></h5><h6><span class='error' id='error-"+id+"'></span></h6><div class='row'>";

          $(this).find("files").each(function(){
            var file = $(this).find("file").text();
            var display = file.split("-")[1];
            subcard += "<div class='col-md-3 col-sm-6 mb-2 mt-1'><a href='./assets/submitfiles/"+file+"' download='"+display+"'><div class='card files'>"+display+"</div></a></div>";
          });

          subcard += "</div><div class='row'><div class='col-md-6'><h5 class='mt-2'><strong>Grade: </strong><span id='score-"+id+"'>"+score+"</span></h5></div><div class='col-md-6'><span class='form-inline mt-1'><input class='form-control' id='grade-input-"+id+"' placeholder='Grade' type='number' max='100' min='0' style='width: 45%;'><span style='width: 5%;'></span><button type='button' class='btn btn-primary' style='width: 45%;' onclick='changeGrade("+id+")'>Change Grade</button></span></div></div></div></div>";

          $("#listSubmissions").append(subcard);
        });
      }
    });
  }

  countSubmission();
  refreshAttachment();
  refreshSubmissions();
  refreshNoSubmit();

  $("#changeNick_text").val("<?php echo $_SESSION["nickname"]; ?>");

  $("#changePass_confirm").click(function(){
    var id = <?php echo $_SESSION["id"]; ?>;
    var password = $("#oldPass_Text").val();
    var newPass = $("#changePass_Text").val();
    var confirmPass = $("#confirmPass_Text").val();

    $.ajax({
      url: 'phps/changePassword.php',
      type: 'POST',
      datatype: 'json',
      data: {
        id:id,
        password: password,
        newPass: newPass,
        confirmPass: confirmPass
      },
      success: function(response){
        var responseJSON = $.parseJSON(response);

        $("#passwordErrorHandler").html(responseJSON.errorOld);
        $("#change_passwordErrorHandler").html(responseJSON.errorNew);
        $("#confirm_passwordErrorHandler").html(responseJSON.errConfirm);

        if(responseJSON.message == "Password successfully changed!"){
          var alert = "success";
        }else{
          var alert = "danger";
        }

        var alert = "<div class='alert alert-" + alert + " alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>" + responseJSON.message + "</strong></div>";
        $("#alert").html(alert);
      }
    });

    $("#oldPass_Text").val("");
    $("#changePass_Text").val("");
    $("#confirmPass_Text").val("");
  });

  $("#changeNick_confirm").click(function(){
    var id = <?php echo $_SESSION["id"]; ?>;
    var nickname = $("#changeNick_text").val();
    $.ajax({
      type: "POST",
      url: "phps/editNickname.php",
      data: {
        id:id, nickname:nickname
      }, success:function(response){
        var responseJSON = $.parseJSON(response);

        if(responseJSON.successEdit){
          var alert = "success";
          $("#nickname").html(nickname);
        }else{
          var alert = "danger";
          $("#changeNick_text").val("<?php echo $_SESSION["nickname"]; ?>");
        }

        var alert = "<div class='alert alert-" + alert + " alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>" + responseJSON.message + "</strong></div>";
        $("#alert").html(alert);
      }
    });
  });
});
</script>
</body>
</html>
