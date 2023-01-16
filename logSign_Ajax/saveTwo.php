<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include('connection.php');

/*  if ($myConn == true) {  
        echo "success"; 
    } else {
        echo "failure";
    }*/
    $nameErr = $emailErr = $cityErr = $passwordErr = "";

    if (isset($_POST['signUp'])){
        // print_r($_POST, 1);die("ghgfhgh");
        $address = $_POST['address'];
        $city    = $_POST['city'];

        if(!empty($_POST['name'])){

            if (!ctype_alpha($_POST['name'])) {
                $nameErr = "<span class='error'>Please use alphabets only.</span>";
            }
            else {
                $name = $_POST['name'];
            }
        }
        else {
            $nameErr = "<span class='error'>Please enter your Name.</span>";      
        }

        if(!empty($_POST['email'])) {
            if(!preg_match("/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i", $_POST['email'])) {
                $emailErr = "<span class='error'>not valid email !</span>";  
            }
            else {
                $email = $_POST['email'];
            }
        }
        else {
            $emailErr = "<span class='error'>Please enter your Email</span>";
        }  
        // print_r($emailErr);
        // print_r($email);die();
        
        // if(!empty($city)) {
        //     $city = $_POST['city'];           
        // }
        // else if (!ctype_alpha($city)) 
        // {
        //     $cityErr = "<span class='error'>Please use alphabets only.</span>";   
        // }
        // else {
        //     $cityErr = "<span class='error'>Please enter your City</span>";    
        // }

        if(!empty($_POST['password'])) {
            $password = $_POST['password'];     
        }
        else {
            $passwordErr = "<span class='error'>Please enter your Password</span>";         
        }
        if ( $nameErr == 0 && $emailErr == 0 && $passwordErr == 0) {

            $query= $myConn -> prepare("SELECT * FROM `getInfo` WHERE `email` = :email");
            $query-> bindParam(':email', $email);
            // $query-> bindParam(':password', $password, PDO::PARAM_STR);
            $query-> execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            // print_r($result);die();

            if(!empty($result)) {

                echo json_encode(array("statusCode"=>"201", "msg" => "email already exist"));

            } else {
         //         $sql = "INSERT INTO `getInfo` (`name`,`email`,`address`,`city`,`password`) 
                        // VALUES ('$name','$email','$address','$city','$password')";
                $stmt = $myConn->prepare("INSERT INTO `getInfo` (`name`,`email`,`address`,`city`,`password`) 
                  VALUES (:name,:email,:address,:city,:password)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':city', $city);
                $stmt->bindParam(':password', $password);
                $finalcheck = $stmt->execute();

                if ($finalcheck == 1) {

                    echo json_encode(array("statusCode"=>true,"msg" => "Successfully submitted"));
                    // session_start();
                    //     $_SESSION['email'] = $result[0]['email'];
                    //  $_SESSION['name'] = $result[0]['name'];
                    echo "Click here to login ";

                }else {

                    echo json_encode(array("statusCode"=>false,"msg" => "Not submitted"));

                }

            }

        }else{
            $msg = "invalid credential";
            echo json_encode(array("statusCode"=>201 ,'message' => $msg));
        }    
    }
    ?>