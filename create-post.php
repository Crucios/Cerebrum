<?php
session_start();

if(!isset($_SESSION["username"])){
	header("Location: index.php");
}

if(!isset($_SESSION["class_id"])){
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
      padding: 1.5rem 3rem 1rem 3rem;
      background-color: rgba(180, 225, 225, 0.7);
      font-weight: bold;
    }
    #create-post-content{
      background-color: white;
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
      margin-right: 10px;
      margin-bottom: 20px;
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
    function preview_images()
    {
     var total_file=document.getElementById("images").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('#image_preview').append("<img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"' width='40' height='40'>");
     }
    }
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
				<li class="nav-item active">
					<a class="nav-link" href="#">Classwork</a>
				</li>
				<li class="nav-item">
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
              <form>
                <!-- Select Type Post -->
                <div class="input-group mb-3">
                 <div class="input-group-prepend">
                   <label class="input-group-text" for="select_type">Type Post</label>
                 </div>
                 <select class="custom-select" id="select_type">
                   <option selected>Choose...</option>
                   <option value="announce">Announcement</option>
                   <option value="material">Material</option>
                   <option value="assignment">Assignment</option>
                 </select>
                </div>
                <!-- Select Type Post -->

                <label for="title">Title</label>
                <input type="text" id="title_post" name="title" placeholder="Quiz 1: Arithmetics" class="form-control">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" rows="3" placeholder="This quiz will be your first assignment."></textarea>

                 <input type="file" class="form-control" id="images" name="images[]" onchange="preview_images();" multiple/>
                 <div id="image_preview"></div><br>

								 <div id="deadline_datetime"></div>

								 <button type='submit' class='btn btn-primary'>Submit</button>
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
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	$(document).ready(function(){
		$("#select_type").change(function(){
			var value_select = $(this).val();
			var markup = "";

			if(value_select == "assignment"){
				markup = "<label for='deadline_date'>Deadline Date</label>" +
				"<input type='date' name='deadline_date' value='0000-00-00' class='form-control' required=''>" +
				"<br><label for='deadline_time'>Deadline Time</label>" +
				"<input id='timepicker' name='deadline_time' width='276' /><br>;"
			}

			$("#deadline_datetime").html(markup);

		});

    $('#timepicker').timepicker({
         uiLibrary: 'bootstrap4'
     });

		$("#changeNick_text").val("<?php echo $_SESSION["nickname"]; ?>");

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
			window.location.href = "classwork.php";
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


    $('#add_more').click(function() {
         "use strict";
         $(this).before($("<div/>", {
           id: 'filediv'
         }).fadeIn('slow').append(
           $("<input/>", {
             name: 'file[]',
             type: 'file',
             id: 'file',
             multiple: 'multiple',
             accept: 'image/*'
           })
         ));
       });

       $('#upload').click(function(e) {
         "use strict";
         e.preventDefault();

         if (window.filesToUpload.length === 0 || typeof window.filesToUpload === "undefined") {
           alert("No files are selected.");
           return false;
         }

         // Now, upload the files below...
         // https://developer.mozilla.org/en-US/docs/Using_files_from_web_applications#Handling_the_upload_process_for_a_file.2C_asynchronously
       });

       deletePreview = function (ele, i) {
         "use strict";
         try {
           $(ele).parent().remove();
           window.filesToUpload.splice(i, 1);
         } catch (e) {
           console.log(e.message);
         }
       }

       $("#file").on('change', function() {
         "use strict";

         // create an empty array for the files to reside.
         window.filesToUpload = [];

         if (this.files.length >= 1) {
           $("[id^=previewImg]").remove();
           $.each(this.files, function(i, img) {
             var reader = new FileReader(),
               newElement = $("<div id='previewImg" + i + "' class='previewBox'><img /></div>"),
               deleteBtn = $("<span class='delete' onClick='deletePreview(this, " + i + ")'>X</span>").prependTo(newElement),
               preview = newElement.find("img");

             reader.onloadend = function() {
               preview.attr("src", reader.result);
               preview.attr("alt", img.name);
             };

             try {
               window.filesToUpload.push(document.getElementById("file").files[i]);
             } catch (e) {
               console.log(e.message);
             }

             if (img) {
               reader.readAsDataURL(img);
             } else {
               preview.src = "";
             }

             newElement.appendTo("#filediv");
           });
         }
       });
	});
</script>
</body>
</html>
