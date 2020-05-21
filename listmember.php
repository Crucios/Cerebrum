<?php  
session_start();

if(!isset($_SESSION["username"])){
	header("Location: index.php");
}

if(!isset($_SESSION["class_id"])){
	header("Location: home.php");
}

require_once "phps/connect.php";
$useractive = $_SESSION["username"];
$classid = $_SESSION["class_id"];
$queryidusers = mysqli_query($conn, "SELECT * FROM users WHERE username = '$useractive'");
$hasilusers = mysqli_fetch_array($queryidusers);
$idusersactive = $hasilusers['id'];
$query = mysqli_query($conn, "SELECT * FROM class_details WHERE class_id = $classid AND users_id = $idusersactive");
$hasilquery = mysqli_fetch_array($query);
$role = $hasilquery['role'];
// role 1 = creator, 2 = teacher, 3 = student

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

		.btn{
			margin-top: 0.5rem;
			width: 200px;
		}
		#titleHeader{
			padding: 1.5rem 3rem 1rem 3rem;
			background-color: rgba(180, 225, 225, 0.7);
			font-weight: bold;
		}
		#titleDesc{
			padding: 1rem 3rem 1rem 3rem;
			background-color: rgba(255, 255, 255, 0.7);
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
				<li class="nav-item active">
					<a class="nav-link" href="#">People</a>
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
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePassword_modal">Change Password</a>
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#changeNickname_modal">Change Nickname</a>
				<a class="dropdown-item" href="logout.php" id="createClass_button">Log Out</a>
			</div>
		</div>
	</nav>
	<div class="container-fluid" style="margin-top: 6rem;">
		<div class="row">
			<div class="col-sm-10 offset-sm-1" id="alert">

			</div>
		</div>
		<div class="row">
			<div class="col-sm-10 offset-sm-1">
				<div class="card" style="border-radius: 1rem; background-color: rgba(180, 225, 225, 0.9); border: 4px solid rgba(55, 100, 100);">
					<div class="card-header" id="titleHeader">
						<div class="row">
							<div class="col">
								<h2 style="font-weight: bold;"><img src="assets/images/studying.png" width="30" height="30">&nbsp;&nbsp;<?php echo $_SESSION["classname"]; ?></h2>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<h5 style="font-weight: bold;"><?php echo $_SESSION["creator"]; ?></h5>
							</div>
						</div>
					</div>
					<div class="card-body" id="titleDesc">
						<div class="row">
							<div class="col">
								<h6><?php echo $_SESSION["description"]; ?></h6>
								<a><strong>Class Code: </strong><span><?php echo $_SESSION["code"]; ?></span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-10 offset-sm-1">
				<div class="card" style="border-radius: 1rem; background-color: rgba(180, 225, 225, 0.9); border: 4px solid rgba(55, 100, 100); margin-top: 10px;">
					<div class="card-body" id="titleDesc">
						<div class="row">
							<div class="col">
								<img src="assets/images/user-icon.png" style="width:50px; height:50px; float: left;">
								<h5>&nbsp;&nbsp;&nbsp;Username</h5>
								<h6>&nbsp;&nbsp;&nbsp;&nbsp;Nickname</h6>
								<button type="button" class="btn btn-info" style="float: right; white-space: nowrap;">Assign to Whatever</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>