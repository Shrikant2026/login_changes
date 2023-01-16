<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include('connection.php');

$error = array();
$res = array();

if (empty($_POST['email'])) {
    $error[] = "Email field is required";
}

if (empty($_POST['password'])) {
    $error[] = "Password field is required";
}
if (!empty($_POST['email']) && !filter_var($_POST['email'])) {
    $error[] = "Enter Valid Email address";
}

if (count($error) > 0) {
    $resp['msg'] = $error;
    $resp['status'] = false;
    echo json_encode($resp);
    exit;
}

$statement = $myConn->prepare("select * from getInfo where email = :email");
$statement->execute(array(':email' => $_POST['email']));
$row = $statement->fetchAll(PDO::FETCH_ASSOC);
 // print_r($row);die(); 
if (count($row) > 0) {
    if (($_POST['password']) != $row[0]['password']) {
        $error[] = "Password is not valid";
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp);
        exit;
    }
    session_start();
    $_SESSION['user_id'] = $row[0]['id'];
    $_SESSION['email'] = $row[0]['email'];
    $_SESSION['name'] = $row[0]['name'];
    
    $resp['redirect'] = "welcome.php";
    $resp['status'] = true;
    header('Location: welcome.php');
    echo json_encode($resp);
    exit;
} else {
    $error[] = "Email does not match";
    $resp['msg'] = $error;
    $resp['status'] = false;
    echo json_encode($resp);
    exit;
}