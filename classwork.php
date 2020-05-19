<?php  
session_start();

if(!isset($_SESSION["username"])){
  header("Location: index.php");
}

$role = "creator";

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
    h2, h5, h6, a > strong, a > span{
      color: rgb(55, 100, 100);
    }
    .post{
      border-radius: 1rem; 
      background-color: rgba(255, 255, 255, 0.9); 
      border: 3px solid rgba(55, 100, 100);
    }
    button{
      margin-top: 0.5rem;
      width: 200px;
    }
  </style>
</head>
<body>

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
      <li class="nav-item active">
        <a class="nav-link" href="#">Classwork</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">People</a>
      </li>
    </ul>
  </div>
  <a class="navIcon" href="#">
   <span>User Settings</span>
   <img src="assets/images/user-icon.png">
 </a>
 <ul class="nav navbar-nav" style="margin-left: 1rem;">
  <li class="nav-item">
    <a class="nav-link" href="index.php">Log out</a>
  </li>
</ul>
</nav>

<div class="container-fluid" style="margin-top: 6rem;">
  <div class="row mt-5">
    <div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1">
      <div class="card" style="border-radius: 1rem; background-color: rgba(180, 225, 225, 0.9); border: 4px solid rgba(55, 100, 100);">
        <div class="row" style="margin: 1rem 2rem 0rem 2rem;">
          <div class="col">
            <h2 style="font-weight: bold;"><img src="assets/images/studying.png" width="30" height="30">&nbsp;&nbsp;Teknologi Web A</h2>
          </div>
        </div>
        <div class="row" style="margin: 0.5rem 2rem 0rem 2rem;">
          <div class="col">
            <h5 style="font-weight: bold;">Barack Obama</h5>
          </div>
        </div>
        <div class="row" style="margin: 0rem 2rem 1rem 2rem;">
          <div class="col">
            <h6>Ini ceritanya buat deskripsi kelasnya. Ya gitu lah ya</h6>
            <a><strong>Class Code: </strong><span>hgtuBGF76H</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1">
      <div class="row">
        <div class="col-md-4">
          <div class="row mb-2">
            <div class="col">
              <div class="card" style="border-radius: 1rem; background-color: rgba(200, 200, 200, 0.9); border: 3px solid rgba(55, 100, 100);">
                <div class="row" align="center" style="margin: 1rem;">
                  <div class="col">
                    <?php if($role == "creator"){ ?>
                    <button class="btn btn-warning">Edit Description</button>
                    <button class="btn btn-warning">Edit Roles</button>
                    <?php } if ($role == "creator" or $role == "teacher"){ ?>
                    <button class="btn btn-success">Grade Assignments</button>
                    <?php } if ($role == "student"){ ?>
                    <button class="btn btn-primary">Check Grades</button>
                    <?php } ?>
                    <button class="btn btn-danger">Leave Class</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <?php if($role == "teacher" or $role == "creator"){ ?> <!-- if role == teacher -->
          <div class="row mb-1">
            <div class="col">
              <div class="card" style="border-radius: 1rem; background-color: rgba(245, 245, 245, 0.8); border: 3px solid rgba(55, 100, 100);">
                <div class="row" style="margin: 1rem 2rem 0.5rem 1rem;">
                  <div class="col">
                    <h5 style="width: bold;"><img id="plus" src="assets/images/black-plus.png" width="25" height="25">&nbsp;&nbsp;Create a new post!</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <div class="row">
            <div class="col" id="postTemplate">
              <!-- example -->
              <div class="card mt-1 post">
                <div class="row" style="margin: 1rem 2rem 0.5rem 1rem;">
                  <div class="col">
                    <h5 style="width: bold;"><img src="assets/images/assignment.png" width="25" height="25">&nbsp;&nbsp;Assignment I : PHP</h5>
                  </div>
                </div>
              </div>
              <div class="card mt-1 post">
                <div class="row" style="margin: 1rem 2rem 0.5rem 1rem;">
                  <div class="col">
                    <h5 style="width: bold;"><img src="assets/images/announcement.png" width="25" height="25">&nbsp;&nbsp;Announcement I : Ajax</h5>
                  </div>
                </div>
              </div>
              <div class="card mt-1 post">
                <div class="row" style="margin: 1rem 2rem 0.5rem 1rem;">
                  <div class="col">
                    <h5 style="width: bold;"><img src="assets/images/material.png" width="25" height="25">&nbsp;&nbsp;Material I : MySQL</h5>
                  </div>
                </div>
              </div>
              <!-- example -->
            </div>
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

    $("#plus").mouseenter(function(){
      $(this).animate({
        width: "35px",
        height: "35px"
      }, 200);
    });

    $("#plus").mouseleave(function(){
      $(this).animate({
        width: "25px",
        height: "25px"
      }, 200);
    });

    $(".post").click(function(){
      <?php $_SESSION["username"] = NULL; ?>
      window.location.href = "classwork.php";
    });
  });
</script>
</body>
</html>
