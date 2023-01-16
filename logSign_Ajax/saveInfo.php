<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include('connection.php');

	$nameErr = $emailErr = $cityErr = $passwordErr = "";

if (isset($_POST['signUp'])) {
	// die("qwerty");
        $address = $_POST['address'];
	    // if (isset($_POST['name'])){

        if(!empty($_POST['name'])){
            $name = $_POST['name'];
        }
        else {
	        if (!ctype_alpha($_POST['name'])) {
	            $nameErr = "<span class='error'>Please use alphabets only.</span>";
	        }else {
	            $nameErr = "<span class='error'>Please enter your Name.</span>";      
	        }
		    // }
        }
        if(!empty($_POST['email'])) {
        
	        if(!preg_match("/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i", $_POST['email'])) {
	            $emailErr = "<span class='error'>not valid email !</span>";  
	        }
	        else {
	            $email = $_POST['email'];  
	        }
	    }else {
	    	$emailErr = "<span class='error'>Please enter your Email</span>";
	    }
        if(!empty($password)) {
            $password = $_POST['password'];     
        }
        else {
            $passwordErr = "<span class='error'>Please enter your Password</span>";         
        }
        print_r($email);
        print_r($emailErr);die();






} else {
	# code...
}



?>