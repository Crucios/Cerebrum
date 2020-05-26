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
			padding: 1.5rem 2rem 0.5rem 2rem;
			background-color: rgba(180, 225, 225, 0.7);
			font-weight: bold;
		}
		#titleDesc{
			padding: 1rem 2rem 1rem 2rem;
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
		<div class="row" id="creatorCard">

		</div>

		<div class="row" id="teacherCard">

		</div>

		<div class="row" id="studentCard">

		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			getCreator();
			getTeacher();
			getStudent();
			function getTeacher(){
				var classid = <?php echo $_SESSION['class_id']; ?>;
				$("#teacherCard").empty();
				$.ajax({
					type: "POST",
					data: { classid:classid },
					url: "phps/getTeacher.php",
					success:function(xml){
						$(xml).find("member").each(function(){
							var class_id = $(this).attr("class");
							var username = $(this).find("username").text();
							var nickname = $(this).find("nickname").text();
							var role = $(this).find("role").text();
							var status = $(this).find("status").text();
							var rolenow = $(this).find("session").text();
							var teachercard = '<div class="col-sm-10 offset-sm-1"><div class="card" style="border-radius: 1rem; background-color: rgba(180, 225, 225, 0.9); border: 4px solid rgba(55, 100, 100); margin-top: 10px;"><div class="card-body" id="titleDesc"><div class="row"><div class="col"><img src="assets/images/user-icon.png" style="width:50px; height:50px; float: left; margin-right: 10px;"><h5>'+username+'</h5><h6>'+nickname+'</h6><button type="button" class="btn btn-info editrole" style="float: right; white-space: nowrap;">Assign to Student</button></div></div></div></div></div></div>';
							
								


							$("#teacherCard").append(teachercard);
						});
					}
				});

			}
			function getCreator(){
				var classid = <?php echo $_SESSION['class_id']; ?>;
				$("#creatorCard").empty();
				$.ajax({
					type: "POST",
					data: { classid:classid },
					url: "phps/getCreator.php",
					success:function(xml){
						$(xml).find("member").each(function(){
							var class_id = $(this).attr("class");
							var username = $(this).find("username").text();
							var nickname = $(this).find("nickname").text();
							var role = $(this).find("role").text();
							var status = $(this).find("status").text();
							

							var creatorcard = '<div class="col-sm-10 offset-sm-1"><div class="card" style="border-radius: 1rem; background-color: rgba(180, 225, 225, 0.9); border: 4px solid rgba(55, 100, 100); margin-top: 10px;"><div class="card-body" id="titleDesc"><div class="row"><div class="col"><img src="assets/images/user-icon.png" style="width:50px; height:50px; float: left; margin-right: 10px;"><h5>'+username+'</h5><h6>'+nickname+'</h6></div></div></div></div></div></div>';

							$("#creatorCard").append(creatorcard);
						});
					}
				});

			}
			function getMember(){
				var classid = <?php echo $_SESSION['class_id']; ?>;

				$("#teacherCard").empty();
				$.ajax({
					type: "POST",
					data: { classid:classid },
					url: "phps/getMember.php",
					success:function(xml){
						$(xml).find("member").each(function(){
							var class_id = $(this).attr("class");
							var username = $(this).find("username").text();
							var nickname = $(this).find("nickname").text();
							var role = $(this).find("role").text();
							var status = $(this).find("status").text();
							

							var teachercard = '<div class="col-sm-10 offset-sm-1"><div class="card" style="border-radius: 1rem; background-color: rgba(180, 225, 225, 0.9); border: 4px solid rgba(55, 100, 100); margin-top: 10px;"><div class="card-body" id="titleDesc"><div class="row"><div class="col"><img src="assets/images/user-icon.png" style="width:50px; height:50px; float: left; margin-right: 10px;"><h5>'+username+'</h5><h6>'+nickname+'</h6></div></div></div></div></div></div>';

							$("#teacherCard").append(teachercard);
						});
					}
				});

			}
			function getStudent(){
				var id = <?php echo $_SESSION['id']; ?>;
				var classid = <?php echo $_SESSION['class_id']; ?>;
				$("#studentCard").empty();
				$.ajax({
					type: "POST",
					data: { classid:classid, id:id},
					url: "phps/getStudent.php",
					success:function(xml){
						$(xml).find("member").each(function(){
							var class_id = $(this).attr("class");
							var username = $(this).find("username").text();
							var nickname = $(this).find("nickname").text();
							var role = $(this).find("role").text();
							var status = $(this).find("status").text();
							var rolenow = $(this).find("session").text();
							alert(rolenow);

							if (rolenow == "creator") {
								var studentcard = '<div class="col-sm-10 offset-sm-1"><div class="card" style="border-radius: 1rem; background-color: rgba(180, 225, 225, 0.9); border: 4px solid rgba(55, 100, 100); margin-top: 10px;"><div class="card-body" id="titleDesc"><div class="row"><div class="col"><img src="assets/images/user-icon.png" style="width:50px; height:50px; float: left; margin-right: 10px;"><h5>'+username+'</h5><h6>'+nickname+'</h6></div></div></div></div></div></div>';
							}
							else{
								var studentcard = '<div class="col-sm-10 offset-sm-1"><div class="card" style="border-radius: 1rem; background-color: rgba(180, 225, 225, 0.9); border: 4px solid rgba(55, 100, 100); margin-top: 10px;"><div class="card-body" id="titleDesc"><div class="row"><div class="col"><img src="assets/images/user-icon.png" style="width:50px; height:50px; float: left; margin-right: 10px;"><h5>'+username+'</h5><h6>'+nickname+'</h6><button type="button" class="btn btn-info editrole" style="float: right; white-space: nowrap;">Assign to Teacher</button></div></div></div></div></div></div>';
							}
							

							$("#studentCard").append(studentcard);
						});
					}
				});

			}

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
			$(".editrole").click(function(){
				var username = $(this).parent().find("h5").text();
				console.log(username);
				$.post("phps/editRole.php", {username:username},
					function(data){
						alert(data);
						location.reload();
					}
					);
			});
		});
	</script>
</body>
</html>
