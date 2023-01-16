<?php
session_start();
echo "Hi !.";
print_r($_SESSION['email']);
echo $_SESSION['name'] ;
echo "<br>";
echo "welcome to your account";

?>