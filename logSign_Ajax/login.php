<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
	include('connection.php');
	session_start();

   // if ($myConn == true) {
 //        echo "success";
 //    } else {
 //        echo "failure";
 //    }

	if (empty($_POST['email']) && empty($_POST['password'])) {
		echo "invalid";
	}
	else {
		$email = $_POST['email'];

		$password = $_POST['password'];

		    // $sql = " SELECT * FROM `getInfo` WHERE email = $email AND password = $password";

		    $query= $myConn->prepare("SELECT * FROM `getInfo` WHERE email = :email AND password = :password");
		    //$query->execute(array(`:email` => $email, `:password` => $password));
		     $query->bindParam(':email', $email);
		     $query->bindParam(':password', $password);
		     $results = $query->execute();
		    $results=$query->fetchAll(PDO::FETCH_ASSOC);
			print_r($results);die();




		    if(count($results) > 0) {
		      session_start();
		      $_SESSION['login_user']= $email;
		      $_SESSION['login_email']=$_POST['email'];
		      header('Location: welcome.php');
		    } else{
		      echo "invalid credentials";
		    }

	}
?>