<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
 include_once('saveTwo.php');
?>


<!DOCTYPE html>
<html>
<head>
	<title>FORM</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
	<div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
	<nav class="navbar bg-body-tertiary">
	    <button type="button" class="btn btn-success btn-sm" id="register"> New User? Register Here</button> 
		<button type="button" class="btn btn-success btn-sm" id="login">Click here to login </button>	
	</nav>
	<div class="container">
		<form id="signUp_form"  method="POST">
			<div class="form-group">
				<label for="inputName4">Name</label>
				<input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
				<?php if(isset($nameErr)){
					echo $nameErr;
				} else {
					echo "";
				}
				?>
			</div>
			<div class="form-group">
				<label for="inputEmail4">Email</label>
				<input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
				<?php if(isset($emailErr)){
					echo $emailErr;
				} else {
					echo "";
				}
				?>
			</div>
			<div class="form-group">
				<label for="inputAddress">Address</label>
				<input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St">
			</div>
			<div class="form-group">
				<label for="inputCity">City</label>
				<input type="text" class="form-control" id="inputCity" name="city">
			</div>
			<div class="form-group">
				<label for="inputPassword4">Password</label>
				<input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" autocomplete="nope">
				<?php if(isset($passwordErr)){
					echo $passwordErr;
				} else {
					echo "";
				}
				?>
			</div>
				<button type="submit" name="signUp" class="btn btn-primary" id="signUp">Sign Up</button>
			    <input type="button" class="btn btn-primary" onclick="myFunctionSignIn()" value="Reset form">
		</form>


		<form id="login_form" action="loginTwo.php" name="form1" method="POST" style="display: none;">
			<div class="form-group">
				<label for="email">Email address</label>
				<input type="email" class="form-control" id="email_log" name="email" aria-describedby="emailHelp" placeholder="Enter email">
				<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password_log" name="password" placeholder="Password" autocomplete="nope">
			</div>
			<div class="form-check">
				<input type="checkbox" class="form-check-input" id="exampleCheck1">
				<label class="form-check-label" for="exampleCheck1">Check me out</label>
			</div>
			<button type="submit" class="btn btn-primary" id="butlogin">Log In</button>
			<input type="button" class="btn btn-primary" onclick="myFunctionLogIn()" value="Reset form">

		</form>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {


			$('#login').on('click', function() {
				$('#login_form').show();
				$('#signUp_form').hide();
			});
			$('#register').on('click', function() {
				$('#signUp_form').show();
				$('#login_form').hide();
			});
			$(document).on("submit", "#signUp_form", function(e){
				e.preventDefault();
			//$('#signUp').on('click', function() {
				// $("#signUp").attr("disabled", "disabled");
				var name = $('#inputName').val();
				var email = $('#inputEmail').val();
				var address = $('#inputAddress').val();
				var city = $('#inputCity').val();
				var password = $('#inputPassword').val();
				if(name != "" && email != "" && address != "" && city != "" && password != ""){
					$.ajax({
						url: "save.php",
						type: "POST",
						data: {
							// type: 1,
							name: name,
							email: email,
							address: address,
							city: city,
							password: password						
						},
						// dataType:'json',
						cache: false,

						success: function(dataResult){
							console.log(dataResult);
							if(dataResult.statusCode == true){
								$('#signUp_form').find('input:text').val('');
								$("#success").show();
								$('#success').html('Successfully registered'); 						
							}else{
								// alert("3");
								$("#error").show();
								$('#error').html('Email ID already exists !');
							}
						}
					});
				}
				else{
					alert('Please fill all the field !');
					//resetForm('signUp_form');
				}
			});

			$('#butlogin').on('click', function() {
				var email = $('#email_log').val();
				var password = $('#password_log').val();
				if(email != "" && password != "" ){
					$.ajax({
						url: "loginTwo.php",
						type: "POST",
						data: {
							// type: 2,
							email: email,
							password: password						
						},
						cache: false,
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);
							if(dataResult.statusCode == 200){
								location.href = "welcome.php";						
							}
							else if(dataResult.statusCode == 201){
								$('#error').show();
								$('#error').html('Invalid EmailId or Password !');
							}
							
						}

					});
				}
				else {
					alert('Please fill both fields !');

				}
			});
		});

		function myFunctionSignIn() {
		    document.getElementById("signUp_form").reset();
		}
		function myFunctionLogIn() {
		    document.getElementById("login_form").reset();
		}
	</script>
</body>
</html>