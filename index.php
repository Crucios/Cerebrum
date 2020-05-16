<!DOCTYPE html>
<html>
<head>
	<title>Elgoog Classroom</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="icon" href="assets/images/studying.png">
	<link rel="stylesheet" type="text/css" href="website.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row mt-5">
			<div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1">
				<div class="card" style="background-color: rgba(245, 245, 245, 0.7); border-radius: 1rem; margin: auto;">
					<div class="row" align="center" style="margin-top: 2.5rem;">
						<div class="col-10 offset-1">
							<h1 style="color: #264475; font-weight: bolder; font-size: 3rem;">Elgoog Classroom</h1>
						</div>
					</div>
					<div class="row" align="center" style="margin: 0.5rem;">
						<div class="col-10 offset-1">
							<h6 style="color: #626075;">"Education is the most powerful weapon that you can use to change the world"</h6>
							<h6 style="color: #626075; font-weight: bold;">- Nelson Mandela -</h6>
						</div>
					</div>
					<div class="row" align="center" style="margin: 1rem 3.5rem;">
						<div class="col-md-6" id="logo">
							<img src="assets/images/studying.png" height="150" width="150" style="margin-top: 3rem; margin-bottom: 6rem;">
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col">
									<h3>Sign In</h3>
									<input type="text" name="username" placeholder="Enter your username" class="form-control" style="width: 90%; margin-top: 1rem;">
									<input type="text" name="password" placeholder="Enter your password" class="form-control" style="width: 90%; margin-top: 1rem;">
									<button type="submit" class="btn btn-success" style="width: 88%; margin-top: 1rem;">Sign In</button>
									<p style="margin-top: 0.5rem;">Don't have an account? <a href="register.php">Sign up here!</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(window).resize(function(){
			if($(window).width() < 768){
				$("#logo").css("display", "none");
			}else{
				$("#logo").css("display", "block");
			}
		});
	</script>
</body>
</html>