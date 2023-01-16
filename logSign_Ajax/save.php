<?php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	include('connection.php');
	//print_r($_POST);die;
	if (isset($_POST['name']) ){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$password = $_POST['password'];
		    // $check = "SELECT * FROM `getInfo` WHERE `email` = :email";

		    $query= $myConn -> prepare("SELECT * FROM `getInfo` WHERE `email` = :email");
		    $query-> bindParam(':email', $email);
		    // $query-> bindParam(':password', $password, PDO::PARAM_STR);
		    $query-> execute();
		    $result = $query->fetchAll(PDO::FETCH_ASSOC);
		    // print_r($result);die();

	    if($result) {
	    	json_encode(array("statusCode"=>"201", "msg" => "email already exist"));

	    } 
	    else {
     //  		$sql = "INSERT INTO `getInfo` (`name`,`email`,`address`,`city`,`password`) 
					// VALUES ('$name','$email','$address','$city','$password')";
		    $stmt = $myConn->prepare("INSERT INTO `getInfo` (`name`,`email`,`address`,`city`,`password`) 
		    						  VALUES (:name,:email,:address,:city,:password)");
		    $stmt->bindParam(':name', $name);
		    $stmt->bindParam(':email', $email);
		    $stmt->bindParam(':address', $address);
		    $stmt->bindParam(':city', $city);
		    $stmt->bindParam(':password', $password);
		    $finalcheck = $stmt->execute();
	    	// print_r($finalcheck);die();

		    if ($finalcheck == 1) {

		    	echo json_encode(array("statusCode"=>true,"msg" => "Successfully submitted"));
		    	// session_start();
		    	//     $_SESSION['email'] = $result[0]['email'];
				// 	$_SESSION['name'] = $result[0]['name'];
		    	 echo "Click here to login ";
		    }else {

		    	echo json_encode(array("statusCode"=>false,"msg" => "Not submitted"));

		    }

		}

	}else{
		$msg = "invalid credential";
		echo json_encode(array("statusCode"=>201 ,'message' => $msg));
	}
?>




