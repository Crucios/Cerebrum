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
</head>
<body>
  <!-- Join Class Modal -->
  <div class="modal fade" id="joinClass_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Join Class</h5>
        </div>
        <div class="modal-body form-group">
          <p>Ask your teacher to tell you about the class code</p>
          <label for="codeClass">Class Code</label>
          <input name="codeClass" class="form-control" placeholder="ex: 8RsrGw64" id="joinClass_text" type="text">
        </div>
        <div class="modal-footer" style="text-align: right;">
          <button type="button" class="btn" data-dismiss="modal">Cancel</button>
          <button type="button" id="joinClass_confirm" class="btn btn-warning" style="margin-left: 40%;" data-dismiss="modal">Join</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Create Class Modal -->
  <div class="modal fade" id="createClass_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Class</h5>
        </div>
        <div class="modal-body form-group">
          <label for="nameClass">Class Name (required)</label>
          <input name="nameClass" class="form-control" placeholder="Mathematics D" id="nameClass_text" type="text">
          <label for="descClass">Description (optional)</label>
          <input name="descClass" class="form-control" placeholder="Mathematics Class of 2019/2020" id="descriptionClass_text" type="text">
        </div>
        <div class="modal-footer" style="text-align: right;">
          <button type="button" class="btn" data-dismiss="modal">Cancel</button>
          <button type="button" id="createClass_confirm" class="btn btn-warning" style="margin-left: 40%;" data-dismiss="modal">Create</button>
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
      <span style="color: lightgray;">User Settings</span>
       <img src="assets/images/user-icon.png" style="width:30px; height:30px;">
     </a>
     <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
       <a class="dropdown-item" href="#" id="joinClass_button">Change Password</a>
       <a class="dropdown-item" href="#" id="createClass_button">Change Nickname</a>
       <a class="dropdown-item" href="logout.php" id="createClass_button">Log Out</a>
     </div>
   </div>
 </nav>
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="scripts/home.js"></script>
</body>
</html>
