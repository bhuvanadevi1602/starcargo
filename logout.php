<?php
session_start();
unset($_SESSION["user_name"]);
session_destroy();
header("location: login.php");
header("Refresh:0");
?>