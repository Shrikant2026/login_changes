<?php
session_start();
session_destroy();
header("Location:forms.php");
exit;
?>