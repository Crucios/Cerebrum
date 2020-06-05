<?php
session_start();

if(!isset($_SESSION["username"])){
  header("Location: index.php");
}
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
    .error{
      color: red;
    }
    .disabled{
      pointer-events: none;
      cursor: default;
    }
    .card{
      border: 4px solid rgba(55, 100, 100);
      border-radius: 0.5rem;
      height: 100%;
      position: relative;
      overflow: hidden;
    }
    .card-header{
      padding: 0.5rem 1rem 0rem 1rem;
      background-color: rgba(180, 225, 225, 0.7);
      font-weight: bold;
    }
    .card-header > h4{
      font-weight: bold;
      margin-top: 0.5rem;
    }
    .card-header:hover{
      background-color: rgba(140, 185, 185, 0.7);
    }
    .card-body{
      padding: 0.5rem 1rem 0rem 1rem;
      background-color: rgba(255, 255, 255, 0.7);
    }
    a, a:hover{
      color: rgb(60, 60, 60);
      text-decoration: none;
    }
    tr{
      background-color: rgb(230, 230, 230);
    }
    table, tr, td{
      border: 2px solid rgb(60, 60, 60);
    }
    #containerAnimate {
      opacity: 0;
		}
  </style>
</head>
<body>
  <!-- Recover Class Modal -->
  <div class="modal fade" id="recoverClass_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="margin: 2rem;">
        <div class="modal-header">
          <h5 class="modal-title">Recover Deleted Class</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped" id="listRecover">

          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Join Class Modal -->
  <div class="modal fade" id="joinClass_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="margin: 2rem;">
        <div class="modal-header">
          <h5 class="modal-title">Join Class</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body form-group">
          <p>Ask your teacher to tell you about the class code</p>
          <label for="codeClass"><strong>Class Code:</strong></label>
          <input name="codeClass" class="form-control" placeholder="ex: 8RsrGw64" id="joinClass_text" type="text">
        </div>
        <div class="modal-footer" style="text-align: right;">
          <button type="button" id="joinClass_confirm" class="btn btn-warning" style="margin-right: 0; width: 30%;" data-dismiss="modal">Join Class</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Create Class Modal -->
  <div class="modal fade" id="createClass_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="margin: 1rem;">
        <div class="modal-header">
          <h5 class="modal-title">Create Class</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body form-group">
          <label for="nameClass"><strong>Class Name (required):</strong></label>
          <input name="nameClass" class="form-control" placeholder="Mathematics D" id="nameClass_text" type="text" required>
          <label style="margin-top: 0.5rem;" for="descClass"><strong>Description (optional):</strong></label>
          <input name="descClass" class="form-control" placeholder="Mathematics Class of 2019/2020" id="descriptionClass_text" type="text">
        </div>
        <div class="modal-footer" style="text-align: right;">
          <button type="button" id="createClass_confirm" class="btn btn-warning" style="margin-right: 0; width: 30%;" data-dismiss="modal">Create Class</button>
        </div>
      </div>
    </div>
  </div>

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
       <li class="nav-item active">
         <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search Classroom" aria-label="Search" style="margin-top: 0.3rem;">
       </li>
       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <img src="assets/images/plus.png" style="width:30px; height:30px;">
           <span>Create or Join Class</span>
         </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
           <a class="dropdown-item" href="#" id="joinClass_button" data-toggle="modal" data-target="#joinClass_modal">Join Class</a>
           <a class="dropdown-item" href="#" id="createClass_button" data-toggle="modal" data-target="#createClass_modal">Create Class</a>
         </div>
       </li>
       <li class="nav-item" id="recoverMenu">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#recoverClass_modal">Recover Class</a>
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

<div class="container-fluid" id="containerAnimate" style="margin-top: 5rem;">
  <div class="row">
    <div class="col-sm-10 offset-sm-1" id="alert">

    </div>
  </div>
  <div class="row">
    <div class="col-sm-10 offset-sm-1">
      <div class="row" id="listClass">

      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script type="text/javascript">

  function refreshClass(){
    var id = <?php echo $_SESSION['id']; ?>;
    $("#listClass").empty();
    $.ajax({
      type: "POST",
      data: { id:id },
      url: "phps/selectClass.php",
      success:function(xml){
        $(xml).find("class").each(function(){
          var class_id = $(this).attr("id");
          var name = $(this).find("name").text();
          var creator = $(this).find("creator").text();
          var description = $(this).find("description").text();
          var code = $(this).find("code").text();

          var classcard = "<a href='viewclass.php?id=" + class_id + "'class='cardAnimate'><div class='col-md-4 col-sm-6' style='margin: 1rem 0;'><div class='card'><div class='card-header'><h4><img src='assets/images/studying.png' width='25' height='25'>&nbsp;&nbsp;<span class='name'>"+name+"</span></h4><p>"+creator+"</p></div><div class='card-body'><a>"+description+"</a><p><strong>Class Code: </strong>"+code+"</p></div></div></div></a>"

          $("#listClass").append(classcard);

          $('.cardAnimate').click(function(){
            var lien = $(this).attr('href');
            console.log(lien);
            event.preventDefault();
            $("#listClass").fadeOut(1000, function(){
              window.location.href = lien;
            });
          });
        });
      }
    });
  }

  function refreshRecover(){
    var id = <?php echo $_SESSION["id"]; ?>;
    $("#listRecover").empty();
    $.ajax({
      type: "POST",
      data: { id:id },
      dataType: "json",
      url: "phps/selectRecoverable.php",
      success:function(res){
        if(res.exist){
          for(var i = 0; i < res.name.length; i++){
            var row = "<tr><td style='width: 70%; vertical-align: middle; font-weight: bold;'>"+res.name[i]+"</td><td><button type='button' class='btn btn-primary' style='width: 100%;' onclick='recover(" + res.id[i] + ")' data-dismiss='modal'>Recover</button></td></tr>";
            $("#listRecover").append(row);
          }
        }else{
          $("#recoverMenu").hide();
        }
      }
    });
  }

  function recover(id){
    $.ajax({
      type: "POST",
      data: { id:id },
      url: "phps/recoverClass.php",
      success:function(result){
        if(result[0] == "C"){
          var alert = "success";
        }else{
          var alert = "danger";
        }

        var alert = "<div class='alert alert-" + alert + " alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>" + result + "</strong></div>";
        $("#alert").html(alert);
        refreshClass();
        refreshRecover();
      }
    });
  }

 $(document).ready(function(){
  refreshClass();
  refreshRecover();
  $("#changeNick_text").val("<?php echo $_SESSION["nickname"]; ?>");

  $("#search").on("input", function(){
    var keyword = $("#search").val();

    var cards = $(".card");

    var body, word;

    if(keyword == ""){
      for(var i = 0; i < cards.length; i++){
        cards.eq(i).parent().css("display", "block");
      }
    }else{
      for(var i = 0; i < cards.length; i++){
        body = cards.eq(i).find("*[class=card-header]");

        word =  body.find("*[class=name]").html();

        word = word.toLowerCase();
        keyword = keyword.toLowerCase();

        if(word.match(keyword)){
          cards.eq(i).parent().css("display", "block");
        }else{
          cards.eq(i).parent().css("display", "none");
        }
      }
    }
  });

  $("#createClass_confirm").click(function(){
    var name = $("#nameClass_text").val();
    var desc = $("#descriptionClass_text").val();
    var id = <?php echo $_SESSION['id']; ?>;

    $.post("phps/addClass.php", {
      id:id, name:name, desc:desc
    }, function(result){

      if(result == "Class Successfully Created!"){
        var alert = "success";
      }else{
        var alert = "danger";
      }

      var alert = "<div class='alert alert-" + alert + " alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>" + result + "</strong></div>";
      $("#alert").html(alert);
      $("#nameClass_text").val("");
      $("#descriptionClass_text").val("");
      refreshClass();
    });
  });

  $("#joinClass_confirm").click(function(){
    var code = $("#joinClass_text").val();
    var id = <?php echo $_SESSION['id']; ?>;

    $.post("phps/joinClass.php", {
      id:id, code:code
    }, function(result){
      if(result[0] == "S"){
        var alert = "success";
      }else{
        var alert = "danger";
      }

      var alert = "<div class='alert alert-" + alert + " alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>" + result + "</strong></div>";
      $("#alert").html(alert);
      $("#joinClass_text").val("");

      refreshClass();
    });
  });

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

  $("#containerAnimate").delay(0).animate({"opacity": "1"}, 1500);
  
});
</script>
</body>
</html>
