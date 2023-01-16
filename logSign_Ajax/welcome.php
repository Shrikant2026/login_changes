
<!DOCTYPE html>
<html>
<head>
	<title>FORM</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style type="text/css">
		.container {
			max-width: 1320px;
			margin: 0px auto;
			margin-top: 40px;
		}
	</style>
</head>
<body>
	<div class="container">
		<?php
		session_start();
		echo "Hi !.";
		print_r($_SESSION['email']);
		echo $_SESSION['name'] ;
		echo "<br>";
		echo "welcome to your account";	 
		echo "<br>";

		?>
		<a href="logout.php">Logout</a>

<!-- 	<button type="button" class="btn btn-outline-primary">Primary</button>
		<button type="button" class="btn btn-outline-info">Info</button> -->
	</div>
</body>
</html>