<!DOCTYPE html>
<html>
<head>
	<title>Create your Cerebrum Account!</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="website.css">
	<link rel="icon" href="assets/images/studying.png">
	<style type="text/css">
		.error {
			color: red;
			font-weight: bold;
		}
	</style>
</head>
<body>

<?php 

require_once "phps/connect.php";

$birth = "0000-00-00";
$name = $email = $password = $passcon = $nick = "";
$nameErr = $emailErr = $passErr = $conErr = $nickErr = "";
$valid = true;

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$name = test_input($_POST["username"]);

	if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name)) 
	{
		$nameErr = "*Only letters, numbers, and white space are allowed!";
		$valid = false;
	}

	$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$name'");

	$row = mysqli_num_rows($query);

	if($row > 0){
		$nameErr ="*Username already taken!";
		$valid = false;
	}

	$email = test_input($_POST["email"]);

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		$emailErr = "*Invalid email format!";
  		$valid = false;
	}

	$query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

	$row = mysqli_num_rows($query);

	if($row > 0){
		$emailErr ="*Email already taken!";
		$valid = false;
	}

	$birth = $_POST["birth"];

	$password = test_input($_POST["password"]);
	$passcon = test_input($_POST["passcon"]);
	
	if ($password!=$passcon){
		$conErr = "Password doesn't match!";
		$valid = false;
	} else if (strlen($password) < 6){
		$passErr = "Password has to be at least 6 characters long!";
		$valid = false;
	}

	$nick = test_input($_POST["nickname"]);

	if (!preg_match("/^[a-zA-Z0-9 ]*$/", $nick)) 
	{
		$nickErr = "*Only letters, numbers, and white space are allowed!";
		$valid = false;
	}

	if($valid){
		$sql = "INSERT INTO users VALUES(0, '$name', '$password', '$email', '$birth', '$nick')";

		if ($conn->query($sql) === TRUE) {
			$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$name'");

			if(mysqli_num_rows($query) > 0){
				while($result = mysqli_fetch_assoc($query)){
					session_start();
					$_SESSION["username"] = $name;
					$_SESSION["id"] = $result["id"];
					$_SESSION["email"] = $result["email"];
					$_SESSION["nickname"] = $result["nickname"];
					header("Location: home.php");
				}
			}
		} else {
			echo "<script type='text/javascript'>alert('Failed');</script>";
		}

		$conn->close();
	}
}

?>

	<div class="container-fluid">
		<div class="row mt-5">
			<div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1">
				<div class="card" style="background-color: rgba(245, 245, 245, 0.7); border-radius: 1rem; margin: auto;">
					<div class="row" align="center" style="margin-top: 2rem;">
						<div class="col-sm-10 offset-sm-1">
							<h3><img src="assets/images/studying.png" width="30" height="30">&nbsp;&nbsp;Create Your Cerebrum Account</h3>
						</div>
					</div>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
						<div class="row" style="margin: 0.5rem 5rem;">
							<div class="col">
								<label for="username">Username:&nbsp;&nbsp;&nbsp;<span class="error" id="usermatch"><?php echo $nameErr; ?></span></label>
								<input type="text" name="username" placeholder="Username" id="username" value="<?php echo $name; ?>" class="form-control" required>
							</div>
						</div>
						<div class="row" style="margin: 0.3rem 5rem;">
							<div class="col">
								<label for="email">Email:&nbsp;&nbsp;&nbsp;<span class="error" id="emailmatch"><?php echo $emailErr; ?></span></label>
								<input type="text" name="email" placeholder="Email" id="email" value="<?php echo $email; ?>" class="form-control" required>
							</div>
						</div>
						<div class="row" style="margin: 0.3rem 5rem;">
							<div class="col">
								<label for="birth">Birthdate:</label>
								<input type="date" name="birth" value="<?php echo $birth; ?>" class="form-control" required>
							</div>
						</div>
						<div class="row" style="margin: 0.3rem 5rem;">
							<div class="col">
								<label for="username">Password:&nbsp;&nbsp;&nbsp;<span class="error" id="passmin"><?php echo $passErr; ?></span></label>
								<input type="password" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" class="form-control" required>
							</div>
						</div>
						<div class="row" style="margin: 0.3rem 5rem;">
							<div class="col">
								<label for="email">Confirm Password:&nbsp;&nbsp;&nbsp;<span class="error" id="match"><?php echo $conErr; ?></span></label>
								<input type="password" name="passcon" id="passcon" placeholder="Confirm Password" value="<?php echo $passcon; ?>" class="form-control" required>
							</div>
						</div>
						<div class="row" style="margin: 0.3rem 5rem;">
							<div class="col">
								<label for="nickname">Nickname:&nbsp;&nbsp;&nbsp;<span class="error"><?php echo $nickErr; ?></span></label>
								<input type="text" name="nickname" placeholder="Nickname" value="<?php echo $nick; ?>" class="form-control" required>
							</div>
						</div>
						<div class="row" style="margin: 1.5rem 5rem;" align="center">
							<div class="col">
								<button type="submit" class="btn btn-success" style="width: 80%;">Sign Up</button>
								<p style="margin-top: 0.5rem;">Already have an account? <a href="index.php">Sign in</a> instead!</p>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			function checkMatch(){
				if($("#passcon").val()!=""){
					if($("#passcon").val()==$("#password").val()){
						$("#match").html("Password matched!");
						$("#match").css("color", "green");
					}else{
						$("#match").html("Password doesn't match!");
						$("#match").css("color", "red");
					}
				}else{
					$("#match").html("");
				}
			}

			function checkUsername(){
				if($("#username").val() == ""){
					$("#usermatch").html("");
				}else{
					var username = $("#username").val();
					$.post("phps/checkUsername.php", {
						user:username
					}, function(result){
						if(result == "1"){
							$("#usermatch").html("*Username already taken!");
						}else{
							$("#usermatch").html("")
						}
					});
				}
			}

			function checkEmail(){
				if($("#email").val() == ""){
					$("#emailmatch").html("");
				}else{
					var email = $("#email").val();
					$.post("phps/checkEmail.php", {
						email:email
					}, function(result){
						if(result == "1"){
							$("#emailmatch").html("*Email already taken!");
						}else{
							$("#emailmatch").html("")
						}
					});
				}
			}

			$("#passcon").on("input", function(){
				checkMatch();
			});

			$("#username").on("input", function(){
				checkUsername();
			});

			$("#email").on("input", function(){
				checkEmail();
			});

			$("#password").on("input", function(){
				if($("#password").val()!=""){
					if($("#password").val().length < 6){
						$("#passmin").html("Password has to be at least 6 characters long!");
						$("#passmin").css("color", "red");
					}else{
						$("#passmin").html("");
					}
				}else{
					$("#passmin").html("");
				}
				checkMatch();
			});
		});
	</script>
</body>
</html>