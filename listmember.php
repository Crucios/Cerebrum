<?php
session_start();

if(!isset($_SESSION["username"])){
	header("Location: index.php");
}

if(!isset($_SESSION["class_id"])){
	header("Location: home.php");
}

if ($_SESSION["status"] == "inactive") {
	header("Location: home.php");
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
		#titleHeader{
			padding: 1.5rem 2rem 0.5rem 2rem;
			background-color: rgba(180, 225, 225, 0.7);
			font-weight: bold;
		}
		#titleDesc{
			padding: 1rem 2rem 1rem 2rem;
			background-color: rgba(255, 255, 255, 0.7);
		}

		#teacherCard{
			background-color: rgba(200, 255, 255, 0.7);
			padding: 1rem 3rem;
			color: rgb(80, 80, 80);
			border: 3px solid rgba(55, 100, 100);
			border-radius: 1rem;
		}

		#studentCard{
			background-color: rgba(160, 180, 255, 0.8);
      		padding: 1rem 3rem;
      		color: rgb(80, 80, 80);
      		border: 3px solid rgba(55, 100, 100);
      		border-radius: 1rem;
		}

		.member{
			padding: 0.5rem 1rem;
			border-radius: 0.5rem;
			border: 3px solid rgba(130, 150, 150, 0.9);
			margin-bottom: 0.5rem;
			background-color: rgba(250, 250, 250, 0.6);
		}

		#containerAnimate {
    opacity: 0;
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
					<a class="nav-link classAnimate" href="home.php">Home</a>
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
	</nav>

	<div class="container-fluid" id="containerAnimate" style="margin-top: 6rem;">
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
		<div class="row mt-2">
			<div class="col-sm-10 offset-sm-1">
				<div class="card" id="teacherCard">
					<h3>Teachers (<span id="teacherCount"></span>):</h3>
					<div id="listTeacher">

					</div>
				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-sm-10 offset-sm-1">
				<div class="card" id="studentCard">
					<h3>Students (<span id="studentCount"></span>):</h3>
					<div id="listStudent">

					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">


		function assignTo(id, role){
			$.ajax({
				url: 'phps/editRole.php',
				type: 'POST',
				datatype: 'json',
				data: { id:id, role:role },
				success: function(response){

					if(response == "New role assigned successfully!"){
						var alert = "success";
					}else{
						var alert = "danger";
					}

					var alert = "<div class='alert alert-" + alert + " alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>" + response + "</strong></div>";
					$("#alert").html(alert);

					refreshMember();
				}
			});
		}

		function refreshMember(){
			var id = <?php echo $_SESSION["class_id"]; ?>;
			var role = "<?php echo $_SESSION["role"]; ?>";
			$("#listTeacher").html("<div class='card member'><div class='row'><div class='col-sm-8 pt-2'><h5><img src='assets/images/account.png' height='30' width='30' style='margin-right: 0.5rem'><?php echo $_SESSION['creator']; ?></h5></div></div></div>");
			$("#listStudent").html("");

			$.ajax({
				type: "POST",
				data: { id:id, role:role },
				url: "phps/selectMember.php",
				dataType: "json",
				success:function(resp){
					for(var i = 0; i < resp.teacher.length; i++){
						var card = "<div class='card member'><div class='row'><div class='col-sm-8 pt-2'><h5><img src='assets/images/account.png' height='30' width='30' style='margin-right: 0.5rem'>"+resp.teacher[i]+"</h5></div>";

						if(role == "creator"){
							card += "<div class='col-sm-4'><button type='button' class='btn btn-primary' style='width: 100%; margin-top: 0.3rem;' onclick='assignTo("+resp.teacherId[i]+", 3)'>Assign to Student</button></div>";
						}

						card += "</div></div>";

						$("#listTeacher").append(card);
					}

					$("#teacherCount").html(resp.teacher.length + 1);

					for(var i = 0; i < resp.student.length; i++){
						var card = "<div class='card member'><div class='row'><div class='col-sm-8 pt-2'><h5><img src='assets/images/account.png' height='30' width='30' style='margin-right: 0.5rem'>"+resp.student[i]+"</h5></div>";

						if(role == "creator"){
							card += "<div class='col-sm-4'><button type='button' class='btn btn-primary' style='width: 100%; margin-top: 0.3rem;' onclick='assignTo("+resp.studentId[i]+", 2)'>Assign to Teacher</button></div>";
						}

						card += "</div></div>";

						$("#listStudent").append(card);
					}

					$("#studentCount").html(resp.student.length);
				}
			});
		}

		$(document).ready(function(){

			refreshMember();

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
			// $(".editrole").click(function(){
			// 	var username = $(this).parent().find("h5").text();
			// 	console.log(username);
			// 	$.post("phps/editRole.php", {username:username},
			// 		function(data){
			// 			alert(data);
			// 			location.reload();
			// 		}
			// 		);
			// });

			$(".classAnimate").click(function(){
				var lien = $(this).attr('href');
				event.preventDefault();
				$("#containerAnimate").delay(0).animate({"opacity": "0"}, 1500, function(){
					window.location.href = "home.php";
				});
			});

			$("#containerAnimate").delay(0).animate({"opacity": "1"}, 1500);
		});
	</script>
</body>
</html>
