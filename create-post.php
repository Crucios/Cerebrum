<?php
session_start();

if(!isset($_SESSION["username"])){
	header("Location: index.php");
}

if(!isset($_SESSION["class_id"])){
	header("Location: home.php");
}

if($_SESSION["role"] == "student" || !isset($_SESSION["role"])){
	header("Location: classwork.php");
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
			padding: 1.5rem 3rem 1rem 3rem;
			background-color: rgba(180, 225, 225, 0.7);
			font-weight: bold;
		}
		#create-post-content{
			background-color: rgba(255, 255, 255, 0.6);
			padding: 2rem 3rem;
		}
		#formdiv {
			text-align: center;
		}
		#file {
			color: green;
			padding: 5px;
			border: 1px dashed #123456;
			background-color: #f9ffe5;
		}
		#img {
			width: 17px;
			border: none;
			height: 17px;
			margin-left: -20px;
			margin-bottom: 191px;
		}
		.upload {
			width: 100%;
			height: 30px;
		}
		.previewBox {
			text-align: center;
			position: relative;
			width: 150px;
			height: 150px;
			margin: 1rem 2rem;
			float: left;
		}
		.previewBox img {
			height: 150px;
			width: 150px;
			padding: 5px;
			border: 1px solid rgb(232, 222, 189);
		}
		.delete {
			color: red;
			font-weight: bold;
			position: absolute;
			top: 0;
			cursor: pointer;
			width: 20px;
			height:  20px;
			border-radius: 50%;
			background: #ccc;
		}
	</style>
	<script>

	</script>
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
		<div class="col-sm-10 offset-sm-1">
			<div class="card" style="border-radius: 1rem; background-color: rgba(180, 225, 225, 0.9); border: 4px solid rgba(55, 100, 100);">
				<div class="card-header" id="titleHeader">
					<div class="row">
						<div class="col">
							<h2 style="font-weight: bold;"><img src="assets/images/pencil.png" width="30" height="30">&nbsp;&nbsp;Create Post</h2>
						</div>
					</div>
				</div>
				<div class="card-body" id="create-post-content">
					<div class="row">
						<div class="col">
							<!-- <form action="phps/addPost.php" method="post" enctype="multipart/form-data" id="dataPost"> -->
							<form id="dataPost" enctype="multipart/form-data">
								<!-- Select Type Post -->
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text" for="select_type">Type Post</label>
									</div>
									<select class="custom-select" id="select_type" name="type">
										<option selected disabled>Choose...</option>
										<option value="announcement">Announcement</option>
										<option value="material">Material</option>
										<option value="assignment">Assignment</option>
									</select>
								</div>
								<!-- Select Type Post -->

								<label for="title">Title:</label>
								<input type="text" id="title_post" name="title" placeholder="Quiz 1: Arithmetics" class="form-control">
								<p id="titleError" style="color: red;"></p>
								<label for="content" class="mt-3">Content:</label>
								<textarea class="form-control" id="content" name="content" rows="3" placeholder="This quiz will be your first assignment."></textarea>
								<p id="contentError" style="color: red;"></p>

								<div id="attachments">
									<label for='postfiles' class='mt-3'>Add Attachment Files:</label><br>
									<input type='file' id='postfiles' name='postfiles[]' onchange='preview_postfiles();' multiple><div id='image_preview' class='mt-3 mb-3'></div>
									<p id="attachmentsError" style="color: red;"></p>
								</div>

								<div id="deadline_datetime">

								</div>

								<div class="row mt-4" align="center" id="submitBtn">

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript">
	function preview_postfiles()
	{
		var total_file=document.getElementById("postfiles").files.length;
		$("#image_preview").html("");
		for(var i=0;i<total_file;i++)
		{
			$('#image_preview').append("<img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"' width='40' height='40'>");
		}
	}

	$(document).ready(function(){
		form = $("form");
		form.submit(function(event){
			event.preventDefault();

			const formData = new FormData(this);

			var data = form.serialize();
			console.log(data);
			console.log(formData);
			$.ajax({
				url:'phps/addPost.php',
				type:"POST",
				data: formData,
				cache: false,
        contentType: false,
        processData: false,
				success:function(response){
					response = $.parseJSON(response);
					console.log(response);


					if(!response.success){
						$("#titleError").html(response.titleError);
						$("#contentError").html(response.contentError);
						$("#deadlineDateError").html(response.deadlineDateError);
						$("#deadlineTimeError").html(response.deadlineTimeError);
						$("#attachmentsError").html(response.attachmentsError);
					}
					else{
						alert(response.message);
					}
				},
				error:function (xhr, desc, err)
        {
					console.log(xhr);
					console.log(desc);
					console.log(err);
        }
			}); //ajax call ends
		}); //form.submit() ends

		$("#select_type").change(function(){
			var value_select = $(this).val();
			var markup = "";

			if(value_select == "assignment"){
				markup = "<label for='deadline_date'>Deadline Date:</label>" +
				"<input type='date' name='date' value='0000-00-00' class='form-control'>" +
				"<div class='form-group pmd-textfield pmd-textfield-floating-label mt-3'>" +
				"<p id='deadlineDateError' style='color: red;'></p>" +
				"<label class='control-label' for='timepicker'>Deadline Time:</label>" +
				"<input type='time' class='form-control' id='timepicker' name='time'></div>" +
				"<p id='deadlineTimeError' style='color: red;'></p>" ;
			}

			$("#deadline_datetime").html(markup);
			$("#submitBtn").html("<div class='col-12'><button type='submit' class='btn btn-primary' id='submit_post' style='width: 50%;'>Create Post</button></div>")
		});

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
