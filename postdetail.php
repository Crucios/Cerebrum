<?php
session_start();

if(!isset($_SESSION["username"])){
  header("Location: index.php");
}

$filename = "tugas1.docx";
$submitfile = "tugas1.jpg";

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

    #submissions{
      background-color: rgba(205, 180, 255, 0.8); 
      padding: 1rem 3rem; 
      color: rgb(80, 80, 80);
      border: 3px solid rgba(55, 100, 100);
      border-radius: 1rem;
    }

    #comments{
      background-color: rgba(180, 205, 180, 0.8); 
      padding: 1rem 3rem; 
      color: rgb(80, 80, 80);
      border: 3px solid rgba(55, 100, 100);
      border-radius: 1rem;
    }

    .files{
      background-color:rgba(205, 205, 205, 0.9);
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      border: 3px solid rgba(55, 100, 100);
      font-size: 15px;
      font-weight: bold;
      box-shadow: 0.2rem 0.2rem grey;
      color: rgb(80, 80, 80);
    }

    .files:hover{
      background-color:rgba(165, 165, 165, 0.8);
      color: darkblue;
    }

    a:hover{
      text-decoration: none;
    }

    .comment{
      margin: 0.5rem 0;
      padding: 0.3rem 1rem;
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
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-sm-10 offset-sm-1" id="alert">
      <div class="card" id="content">
        <h3>Post Details:</h3>
        <?php if($_SESSION["post_type"] != "announcement"){ ?>
        <div class="row mb-2" id="listFiles">
          <div class="col-md-3 col-sm-6">
            <a href="/assets/postfiles/<?php echo $filename; ?>" download="<?php echo $filename; ?>">
              <div class="card files">
                <?php echo $filename; ?>
              </div>
            </a>
          </div>
        </div>
        <?php } ?>
        <h5 class="mt-1"><?php echo $_SESSION["post_content"]; ?></h5>
      </div>
      <?php if($_SESSION["post_type"] == "assignment"){ ?>
      <div class="card mt-3" id="submissions">
        <h3>Your Submissions:</h3>
        <div class="row" id="listFiles">
          <div class="col-md-3 col-sm-6">
            <a href="/assets/submitfiles/<?php echo $submitfile; ?>" download="<?php echo $submitfile; ?>">
              <div class="card files">
                <?php echo $submitfile; ?>
              </div>
            </a>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4 col-sm-6">
            <button type="button" class="btn btn-primary">Edit Submissions</button>
          </div>
        </div>
        <h5 class="mt-2"><strong>Deadline: <?php echo date('F d, Y', strtotime($_SESSION["post_deadline"])); ?></strong></h5>
      </div>
      <?php } ?>
      <div class="card mt-3" id="comments">
        <h3>Post Comments:</h3>
        <span class="form-inline mt-1">
          <input class="form-control" placeholder="Write your comment here..." id="comment_text" type="text" style="width: 80%;"><button type="button" class="btn btn-primary" style="width: 20%;"><img src="assets/images/send.png" width="20" height="20"></button>
        </span>
        <div id="listComments">
          <div class="card comment">
            <a><img src="assets/images/account.png" height="15" width="15" style="margin-right: 0.5rem;"><strong>Henry Wicaksono</strong>&nbsp;&nbsp;May 12</a>
            <a>Tugas apa apaan ini susah banget hah ga tau lagi liburan apa!</a>
          </div>
          <div class="card comment">
            <a><img src="assets/images/account.png" height="15" width="15" style="margin-right: 0.5rem;"><strong>Gerry Steven</strong>&nbsp;&nbsp;May 12</a>
            <a>Nani</a>
          </div>
          <div class="card comment">
            <a><img src="assets/images/account.png" height="15" width="15" style="margin-right: 0.5rem;"><strong>Misael Setio</strong>&nbsp;&nbsp;May 13</a>
            <a>Memecahkan... celengan nilai ~</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){

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
