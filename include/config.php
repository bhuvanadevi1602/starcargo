<?php
//udhaarsu_starcargo
//starcargo@123

$servername="localhost";
$username="root";
$password="";
$dbname="starcargo";

// $servername="localhost";
// $username="udhaarsu_starcargo";
// $password="starcargo@123";
// $dbname="udhaarsu_starcargo";

try { 
$con=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// echo "Connection Succeed";
}
catch(PDOException $e) {
    echo "Connection Failed".$e->getMessage();
}

?>