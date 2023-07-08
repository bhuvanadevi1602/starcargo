<?php
include('../include/config.php');
// print_r($con);die();
$action=$_POST["action"];
$msg='';
if($action=="usercreation") {
     $creationdate=isset($_POST['creationdate'])?$_POST['creationdate']:"";
    $username=isset($_POST['username'])?$_POST['username']:"";
    $password=isset($_POST['password'])?$_POST['password']:"";
    $role=isset($_POST['role'])?$_POST['role']:"";
    if($creationdate!="" && $username!="" && $password!="" && $role!="") {
    $query="insert into user(creationdate,username,password,role) values(:creationdate,:username,:password,:role)";
$exe=$con->prepare($query);
$data=[':creationdate'=>$creationdate,':username'=>$username,':password'=>$password,':role'=>$role];
 $query_execute=$exe->execute($data);
if($query_execute){
    $msg="Success";
}
else{
  $msg="Failure";
}
}
else{
  $msg="Failure";
}
$data=[];
$data['msg']=$msg;
echo json_encode($data);
}

if($action=="userfetch") {
     $ids=isset($_POST['ids'])?$_POST['ids']:"";
    if($ids!="") {
    $query="select * from user where id=:ids";
$exe=$con->prepare($query);
$data=[':ids'=>$ids];
  $exe->execute($data);
$result = $exe->fetch(PDO::FETCH_ASSOC);
if($query_execute){
    $msg="Success";
}
else{
  $msg="Failure";
}
}
else{
  $msg="Failure";
}
$data=[];
$data['msg']=$msg;
$data['data']=$result;
echo json_encode($data);
}
if($action=="userupdation") {
      $ids=isset($_POST['ids'])?$_POST['ids']:"";
     $creationdate=isset($_POST['creationdate'])?$_POST['creationdate']:"";
    $username=isset($_POST['username'])?$_POST['username']:"";
    $password=isset($_POST['password'])?$_POST['password']:"";
    $role=isset($_POST['role'])?$_POST['role']:"";
    if($creationdate!="" && $username!="" && $password!="" && $role!="") {
    $query="update user set creationdate=:creationdate,username=:username,password=:password,role=:role where id=:ids";
$exe=$con->prepare($query);
$data=[':creationdate'=>$creationdate,':username'=>$username,':password'=>$password,':role'=>$role,':ids'=>$ids];
 $query_execute=$exe->execute($data);
if($query_execute){
    $msg="Success";
}
else{
  $msg="Failure";
}
}
else{
  $msg="Failure";
}
$data=[];
$data['msg']=$msg;
echo json_encode($data);
}
if($action=="userdeletion") {
      $ids=isset($_POST['ids'])?$_POST['ids']:"";
    if($ids!="") {
    $query="delete from user where id=:ids";
$exe=$con->prepare($query);
$data=[':ids'=>$ids];
 $query_execute=$exe->execute($data);
if($query_execute){
    $msg="Success";
}
else{
  $msg="Failure";
}
}
else{
  $msg="Failure";
}
$data=[];
$data['msg']=$msg;
echo json_encode($data);
}
?>