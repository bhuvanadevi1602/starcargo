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
if($result){
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

if($action=="partycreation") {
  $creationdate=isset($_POST['creationdate'])?$_POST['creationdate']:"";
 $partyname=isset($_POST['partyname'])?$_POST['partyname']:"";
 $partymobile=isset($_POST['partymobile'])?$_POST['partymobile']:"";
 $partyaddress=isset($_POST['partyaddress'])?$_POST['partyaddress']:"";
  $state=isset($_POST['state'])?$_POST['state']:"";
 $city=isset($_POST['city'])?$_POST['city']:"";
 $partyzip=isset($_POST['partyzip'])?$_POST['partyzip']:""; 
 $bookmode=isset($_POST['bookmode'])?$_POST['bookmode']:"";
 $trainprice=isset($_POST['trainprice'])?$_POST['trainprice']:"";
 $airprice=isset($_POST['airprice'])?$_POST['airprice']:"";
 $gst=isset($_POST['gst'])?$_POST['gst']:"";
 $destinate=isset($_POST['destinate'])?$_POST['destinate']:"";

 if($creationdate!="" && $partyname!="" && $partymobile!="" && $partyaddress!="" && $state!="" && $city!="" && $partyzip!="" && $bookmode!="" && ($trainprice!=0 || $airprice!=0) && $gst!="" && $destinate!="") {
 $query="insert into party(creationdate,partyname,partymobile,partyaddress,state,city,partyzip,bookmode,trainprice,airprice,gst,destinate) values(:creationdate,:partyname,:partymobile,:partyaddress,:state,:city,:partyzip,:bookmode,:trainprice,:airprice,:gst,:destinate)";
$exe=$con->prepare($query);
$data=[':creationdate'=>$creationdate,':partyname'=>$partyname,':partymobile'=>$partymobile,':partyaddress'=>$partyaddress,':state'=>$state,':city'=>$city,':partyzip'=>$partyzip,':bookmode'=>$bookmode,':trainprice'=>$trainprice,':airprice'=>$airprice,':gst'=>$gst,':destinate'=>$destinate];
// print_r($data);die();
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

if($action=="partyfetch") {
  $ids=isset($_POST['ids'])?$_POST['ids']:"";
  
 if($ids!="") {
 $query="select * from party where id=:ids";
$exe=$con->prepare($query);
$data=[':ids'=>$ids];
$exe->execute($data);
$result = $exe->fetch(PDO::FETCH_ASSOC);
if($result){
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

if($action=="partyupdation") {
  $ids=isset($_POST['ids'])?$_POST['ids']:"";

  $creationdate=isset($_POST['creationdate'])?$_POST['creationdate']:"";
  $partyname=isset($_POST['partyname'])?$_POST['partyname']:"";
  $partymobile=isset($_POST['partymobile'])?$_POST['partymobile']:"";
  $partyaddress=isset($_POST['partyaddress'])?$_POST['partyaddress']:"";
   $state=isset($_POST['state'])?$_POST['state']:"";
  $city=isset($_POST['city'])?$_POST['city']:"";
  $partyzip=isset($_POST['partyzip'])?$_POST['partyzip']:""; 
  $bookmode=isset($_POST['bookmode'])?$_POST['bookmode']:"";
  $trainprice=isset($_POST['trainprice'])?$_POST['trainprice']:"";
  $airprice=isset($_POST['airprice'])?$_POST['airprice']:"";
  $gst=isset($_POST['gst'])?$_POST['gst']:"";
  $destinate=isset($_POST['destinate'])?$_POST['destinate']:"";

$query="update party set creationdate=:creationdate,partyname=:partyname,partymobile=:partymobile,partyaddress=:partyaddress,state=:state,city=:city,partyzip=:partyzip,bookmode=:bookmode,trainprice=:trainprice,airprice=:airprice,gst=:gst,destinate=:destinate where id=:ids";
$exe=$con->prepare($query);
$data=['ids'=>$ids,':creationdate'=>$creationdate,':partyname'=>$partyname,':partymobile'=>$partymobile,':partyaddress'=>$partyaddress,':state'=>$state,':city'=>$city,':partyzip'=>$partyzip,':bookmode'=>$bookmode,':trainprice'=>$trainprice,':airprice'=>$airprice,':gst'=>$gst,':destinate'=>$destinate];
// print_r($data);die();
$query_execute=$exe->execute($data);
if($query_execute){
$msg="Success";
}
else{
$msg="Failure";
}

$data=[];
$data['msg']=$msg;
echo json_encode($data);
}

if($action=="partydeletion") {
  $ids=isset($_POST['ids'])?$_POST['ids']:"";
if($ids!="") {
$query="delete from party where id=:ids";
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

if($action=="bookcreation") {

  $creationdate=isset($_POST['creationdate'])?$_POST['creationdate']:"";
 $state=isset($_POST['state'])?$_POST['state']:"";
 $origin=isset($_POST['origin'])?$_POST['origin']:"";
 $destination=isset($_POST['destination'])?$_POST['destination']:"";
  $coraddress=isset($_POST['coraddress'])?$_POST['coraddress']:"";
 $corstate=isset($_POST['corstate'])?$_POST['corstate']:"";
 $corzip=isset($_POST['corzip'])?$_POST['corzip']:""; 
 $conaddress=isset($_POST['conaddress'])?$_POST['conaddress']:"";
 $constate=isset($_POST['constate'])?$_POST['constate']:"";
 $conzip=isset($_POST['conzip'])?$_POST['conzip']:"";
 $area=isset($_POST['area'])?$_POST['area']:"";
 $transport=isset($_POST['transport'])?$_POST['transport']:"";
 $pack=isset($_POST['pack'])?$_POST['pack']:"";
 $invoiceno=isset($_POST['invoiceno'])?$_POST['invoiceno']:"";
 $describe=isset($_POST['describe'])?$_POST['describe']:"";
 $quantity=isset($_POST['quantity'])?$_POST['quantity']:"";
 $gross=isset($_POST['gross'])?$_POST['gross']:"";
 $weight=isset($_POST['weight'])?$_POST['weight']:"";
 $amount=isset($_POST['amount'])?$_POST['amount']:"";
 $gst=isset($_POST['gst'])?$_POST['gst']:"";
 $paymentmode=isset($_POST['paymentmode'])?$_POST['paymentmode']:"";
 $paid=isset($_POST['paid'])?$_POST['paid']:"";

 if($creationdate!="" && $state!="" && $origin!="" && $destination!="" && $coraddress!="" && $corstate!="" && $corzip!="" && $conaddress!="" && $constate!="" && $conzip!="" && $area!="" && $transport!="" && $pack!="" &&  $invoiceno!="" && $describe!="" && $quantity!="" && $gross!="" && $weight!="" && $amount!="" && $gst!="" && $paymentmode!="" && $paid!="")  {
 $query="insert into booking(creationdate,state,origin,destination,coraddress,corstate,corzip,conaddress,constate,conzip,area,transport,pack,invoiceno,description,quantity,gross,weight,amount,gst,paymentmode,paid) values(:creationdate,:state,:origin,:destination,:coraddress,:corstate,:corzip,:conaddress,:constate,:conzip,:area,:transport,:pack,:invoiceno,:describe,:quantity,:gross,:weight,:amount,:gst,:paymentmode,:paid)";
$exe=$con->prepare($query);
$data=[':creationdate'=>$creationdate,':state'=>$state,':origin'=>$origin,':destination'=>$destination,':coraddress'=>$coraddress,':corstate'=>$corstate,':corzip'=>$corzip,':conaddress'=>$conaddress,':constate'=>$constate,':conzip'=>$conzip,':area'=>$area,':transport'=>$transport,':pack'=>$pack,':invoiceno'=>$invoiceno,':describe'=>$describe,':quantity'=>$quantity,':gross'=>$gross,':weight'=>$weight,':amount'=>$amount,':gst'=>$gst,':paymentmode'=>$paymentmode,':paid'=>$paid];
// print_r($data);die();
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