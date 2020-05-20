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
  </style>
</head>
<body>
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
         <form class="form-inline" style="margin-top: 5px;">
           <input class="form-control mr-sm-2" type="search" placeholder="Search Classroom" aria-label="Search">
           <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
         </form>
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
     </ul>
   </div>
   <div class="nav-item dropdown">
     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span style="color: lightgray; margin-right: 0.5rem;"><?php echo $_SESSION["nickname"]; ?></span>
       <img src="assets/images/user-icon.png" style="width:30px; height:30px;">
     </a>
     <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
       <a class="dropdown-item disabled"><img src="assets/images/account.png" height="15" width="15" style="margin-right: 0.5rem;"><?php echo $_SESSION["username"]; ?></a> 
       <a class="dropdown-item" href="#" id="joinClass_button">Change Password</a>
       <a class="dropdown-item" href="#" id="createClass_button">Change Nickname</a>
       <a class="dropdown-item" href="logout.php" id="createClass_button">Log Out</a>
     </div>
   </div>
 </nav>

 <div class="container-fluid" style="margin-top: 5rem;">
  <div class="row">
    <div class="col-sm-10 offset-sm-1" id="alert">
      
    </div>
  </div>
</div>

 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function(){

    $("#createClass_confirm").click(function(){
      var name = $("#nameClass_text").val();
      var desc = $("#descriptionClass_text").val();
      
      $.post("phps/addClass.php", {
            name:name, desc:desc
          }, function(result){

            if(result == "Class Successfully Created!"){
              var alert = "success";
            }else{
              var alert = "danger";
            }

            var alert = "<div class='alert alert-" + alert + " alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>" + result + "</strong></div>";
            $("#alert").html(alert);
          });
    });

   });
 </script>
</body>
</html>
