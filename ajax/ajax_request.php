<?php
include('../include/config.php');
// print_r($con);die();
$action = $_POST["action"];
$msg = '';
if ($action == "usercreation") {
  $creationdate = isset($_POST['creationdate']) ? $_POST['creationdate'] : "";
  $username = isset($_POST['username']) ? $_POST['username'] : "";
  $password = isset($_POST['password']) ? $_POST['password'] : "";
  $role = isset($_POST['role']) ? $_POST['role'] : "";
  $type = isset($_POST['type']) ? $_POST['type'] : "";
  if ($creationdate != "" && $username != "" && $password != "" && $role != "" && $type != "") {
    $query = "insert into user(creationdate,username,password,role,type) values(:creationdate,:username,:password,:role,:type)";
    $exe = $con->prepare($query);
    $data = [':creationdate' => $creationdate, ':username' => $username, ':password' => $password, ':role' => $role, ':type' => $type];
    $query_execute = $exe->execute($data);
    if ($query_execute) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}

if ($action == "gstcreation") {
  $creationdate = isset($_POST['creationdate']) ? $_POST['creationdate'] : "";
  $bookmode = isset($_POST['bookmode']) ? $_POST['bookmode'] : "";
  $cgst = isset($_POST['cgst']) ? $_POST['cgst'] : "";
  $sgst = isset($_POST['sgst']) ? $_POST['sgst'] : "";
  $igst = isset($_POST['igst']) ? $_POST['igst'] : "";
  $gsttype = isset($_POST['gsttype']) ? $_POST['gsttype'] : "";
  if ($creationdate != "" && $gsttype != "") {
    $query = "insert into gst(creationdate,gsttype,bookmode,igst,cgst,sgst) values(:creationdate,:gsttype,:bookmode,:igst,:cgst,:sgst)";
    $exe = $con->prepare($query);
    $data = [':creationdate' => $creationdate, ':gsttype' => $gsttype, ':bookmode' => $bookmode, ':igst' => $igst, ':sgst' => $sgst, ':cgst' => $cgst];
    // print_r($data);die();
    $query_execute = $exe->execute($data);
    if ($query_execute) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}

if ($action == "userfetch") {
  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";
  if ($ids != "") {
    $query = "select * from user where id=:ids";
    $exe = $con->prepare($query);
    $data = [':ids' => $ids];
    $exe->execute($data);
    $result = $exe->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  $data['data'] = $result;
  echo json_encode($data);
}

if ($action == "gstfetch") {
  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";
  if ($ids != "") {
    $query = "select * from gst where id=:ids";
    $exe = $con->prepare($query);
    $data = [':ids' => $ids];
    $exe->execute($data);
    $result = $exe->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  $data['data'] = $result;
  echo json_encode($data);
}


if ($action == "gstfetchtype") {
  $gsttype = isset($_POST['gsttype']) ? $_POST['gsttype'] : "";
  $booktype = isset($_POST['booktype']) ? $_POST['booktype'] : "";
  if ($gsttype != "" && $booktype!="") {
    $query = "select * from gst where gsttype=:gsttype and bookmode=:bookmode";
    $exe = $con->prepare($query);
    $data = [':gsttype' => $gsttype,':bookmode'=>$booktype];
    $exe->execute($data);
    $result = $exe->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  $data['data'] = $result;
  echo json_encode($data);
}

if ($action == "usernamecheck") {
  $username = isset($_POST['username']) ? $_POST['username'] : "";
  if ($username != "") {
    $query = "select * from user where username=:username";
    $exe = $con->prepare($query);
    $data = [':username' => $username];
    $exe->execute($data);
    $result = $exe->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  $data['data'] = $result;
  echo json_encode($data);
}

if ($action == "userupdation") {
  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";
  $creationdate = isset($_POST['creationdate']) ? $_POST['creationdate'] : "";
  $username = isset($_POST['username']) ? $_POST['username'] : "";
  $password = isset($_POST['password']) ? $_POST['password'] : "";
  $role = isset($_POST['role']) ? $_POST['role'] : "";
  $type = isset($_POST['type']) ? $_POST['type'] : "";
  if ($creationdate != "" && $username != "" && $password != "" && $role != "") {
    $query = "update user set creationdate=:creationdate,username=:username,password=:password,role=:role,type=:type where id=:ids";
    $exe = $con->prepare($query);
    $data = [':creationdate' => $creationdate, ':username' => $username, ':password' => $password, ':role' => $role, ':type' => $type, ':ids' => $ids];
    $query_execute = $exe->execute($data);
    if ($query_execute) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}

if ($action == "gstupdation") {
  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";
  $creationdate = isset($_POST['creationdate']) ? $_POST['creationdate'] : "";
  $bookmode = isset($_POST['bookmode']) ? $_POST['bookmode'] : "";
  $gsttype = isset($_POST['gsttype']) ? $_POST['gsttype'] : "";
  $igst = isset($_POST['igst']) ? $_POST['igst'] : "";
  $sgst = isset($_POST['sgst']) ? $_POST['sgst'] : "";
  $cgst = isset($_POST['cgst']) ? $_POST['cgst'] : "";
  if ($creationdate != "" && $bookmode != "" && $gsttype != "") {
    $query = "update gst set creationdate=:creationdate,bookmode=:bookmode,gsttype=:gsttype,igst=:igst,sgst=:sgst,cgst=:cgst where id=:ids";
    $exe = $con->prepare($query);
    $data = [':creationdate' => $creationdate, ':bookmode' => $bookmode, ':gsttype' => $gsttype, ':igst' => $igst, ':sgst' => $sgst,':cgst' => $cgst, ':ids' => $ids];
    $query_execute = $exe->execute($data);
    if ($query_execute) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}

if($action=="partypod"){
  $pod = isset($_POST['pod']) ? $_POST['pod'] : "";
  if ($pod != "") {
    $query = "select * from booking where pod=:pod";
    $exe = $con->prepare($query);
    $data = [':pod' => $pod];
  //  print_r($data);die();
   $exe->execute($data);
    $result = $exe->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  $data['data'] = $result;
  echo json_encode($data);
}
if ($action == "mnoupdation") {
  $creationdate = isset($_POST['creationdate']) ? $_POST['creationdate'] : "";
  $mno = isset($_POST['mno']) ? $_POST['mno'] : "";
 
    $query = "update booking set mno=:mno where creationdate=:creationdate";
    $exe = $con->prepare($query);
    $data = [':mno' => $mno, ':creationdate' => $creationdate];
    $query_execute = $exe->execute($data);
    if ($query_execute) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}
if ($action == "userdeletion") {
  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";
  if ($ids != "") {
    $query = "delete from user where id=:ids";
    // print_r($query);die();
    $exe = $con->prepare($query);
    $data = [':ids' => $ids];
    $query_execute = $exe->execute($data);
    if ($query_execute) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}
if ($action == "userpartydetail") {
  $creationdate = isset($_POST['creationdate']) ? $_POST['creationdate'] : "";
  $partyname = isset($_POST['partyname']) ? $_POST['partyname'] : "";
  $partymobile = isset($_POST['partymobile']) ? $_POST['partymobile'] : "";
  $types = isset($_POST['types']) ? $_POST['types'] : "";
  $trainprice = isset($_POST['trainprice']) ? $_POST['trainprice'] : "";
  $airprice = isset($_POST['airprice']) ? $_POST['airprice'] : "";
  $gst = isset($_POST['gst']) ? $_POST['gst'] : "";
  $route = isset($_POST['route']) ? $_POST['route'] : "";
  $weight = isset($_POST['weight']) ? $_POST['weight'] : 0;

  if ($creationdate != "" && $partyname != "" && $partymobile != "" && $types != "" && ($trainprice != "" || $airprice != "") && $gst != "" && $route!="") {
   $query = "insert into party(creationdate,partyname,partymobile,bookmode,trainprice,airprice,gst,route,weight) values(:creationdate,:partyname,:partymobile,:bookmode,:trainprice,:airprice,:gst,:route,:weight)";
      $exe = $con->prepare($query);
    $data = [':creationdate' => $creationdate, ':partyname' => $partyname, ':partymobile' => $partymobile, ':bookmode' => $types, ':trainprice' => $trainprice, ':airprice' => $airprice, ':gst' => $gst,':route'=>$route,':weight'=>$weight];
    $query_execute = $exe->execute($data);
    if ($query_execute) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } 
  else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}

if ($action == "partydetfetch") {
  $id = isset($_POST['id']) ? $_POST['id'] : "";  
  $route = isset($_POST['route']) ? $_POST['route'] : "";
  $bookmode = isset($_POST['bookmode']) ? $_POST['bookmode'] : "";

  if ($id != "") {
    $query = "select * from party where id=:id and route=:route and bookmode=:bookmode";
    $exe = $con->prepare($query);
    $data = [':id' => $id,'route'=>$route,':bookmode'=>$bookmode];
  //  print_r($data);die();
   $exe->execute($data);
    $result = $exe->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  $data['data'] = $result;
  echo json_encode($data);
}

if ($action == "partybookfetch") {
  $id = isset($_POST['id']) ? $_POST['id'] : "";  
  $route = isset($_POST['route']) ? $_POST['route'] : "";
  $bookmode = isset($_POST['bookmode']) ? $_POST['bookmode'] : "";
  $city = isset($_POST['city']) ? $_POST['city'] : "";
  $destinate = isset($_POST['destinate']) ? $_POST['destinate'] : "";

  if ($id != "") {
    $query = "select * from partyset where partyid=:partyid and route=:route and bookmode=:bookmode and city=:city and destinate=:destinate";
    $exe = $con->prepare($query);
    $data = [':partyid' => $id,'route'=>$route,':bookmode'=>$bookmode,':city'=>$city,':destinate'=>$destinate];
  //  print_r($data);die();
   $exe->execute($data);
    $result = $exe->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  $data['data'] = $result;
  echo json_encode($data);
}

if ($action == "partydetsfetch") {
  $id = isset($_POST['id']) ? $_POST['id'] : "";

 if ($id != "") {
    $query = "select * from partyset where id=:id";
    // print_r($query);die();
    $exe = $con->prepare($query);
    $data = [':id' => $id];
    $exe->execute($data);
    $result = $exe->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  $data['data'] = $result;
  echo json_encode($data);
}


if ($action == "partydetupdation") {
  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";

  $creationdate = isset($_POST['creationdate']) ? $_POST['creationdate'] : "";
  $partyname = isset($_POST['partyname']) ? $_POST['partyname'] : "";
  $partymobile = isset($_POST['partymobile']) ? $_POST['partymobile'] : "";
  $bookmode = isset($_POST['bookmode']) ? $_POST['bookmode'] : "";
  $trainprice = isset($_POST['trainprice']) ? $_POST['trainprice'] : "";
  $airprice = isset($_POST['airprice']) ? $_POST['airprice'] : "";
  $gst = isset($_POST['gst']) ? $_POST['gst'] : "";
  $route = isset($_POST['route']) ? $_POST['route'] : "";
  $weight = isset($_POST['weight']) ? $_POST['weight'] : "";
 
  $query = "update party set creationdate=:creationdate,partyname=:partyname,partymobile=:partymobile,bookmode=:bookmode,trainprice=:trainprice,airprice=:airprice,gst=:gst,route=:route,weight=:weight where id=:ids";
  $exe = $con->prepare($query);
  $data = ['ids' => $ids, ':creationdate' => $creationdate, ':partyname' => $partyname, ':partymobile' => $partymobile, ':bookmode' => $bookmode, ':trainprice' => $trainprice, ':airprice' => $airprice, ':gst' => $gst,':route'=>$route,':weight'=>$weight];
  // print_r($data);die();
  $query_execute = $exe->execute($data);
  if ($query_execute) {
    $msg = "Success";
  } else {
    $msg = "Failure";
  }

  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}


if ($action == "partycreation") {
  $creationdate = isset($_POST['creationdate']) ? $_POST['creationdate'] : "";
  $partyids = isset($_POST['partyids']) ? $_POST['partyids'] : "";
  $partyname = isset($_POST['partyname']) ? $_POST['partyname'] : "";
  $partymobile = isset($_POST['partymobile']) ? $_POST['partymobile'] : "";
  $partyaddress = isset($_POST['partyaddress']) ? $_POST['partyaddress'] : "";
  $state = isset($_POST['state']) ? $_POST['state'] : "";
  $city = isset($_POST['city']) ? $_POST['city'] : "";
  $partyzip = isset($_POST['partyzip']) ? $_POST['partyzip'] : "";
  $bookmode = isset($_POST['bookmode']) ? $_POST['bookmode'] : "";
  $trainprice = isset($_POST['trainprice']) ? $_POST['trainprice'] : "";
  $airprice = isset($_POST['airprice']) ? $_POST['airprice'] : "";
  $gst = isset($_POST['gst']) ? $_POST['gst'] : "";
  $destinate = isset($_POST['destinate']) ? $_POST['destinate'] : "";
  $route = isset($_POST['route']) ? $_POST['route'] : "";
  $weight = isset($_POST['weight']) ? $_POST['weight'] : "";

  if ($creationdate != "" && $partyname != "" && $partymobile != "" && $partyaddress != "" && $state != "" && $city != "" && $partyzip != "" && $bookmode != "" && ($trainprice != 0 || $airprice != 0) && $gst != "" && $destinate != "" && $route!='') {
    $query = "insert into partyset(creationdate,partyname,partymobile,partyaddress,state,city,partyzip,bookmode,trainprice,airprice,gst,destinate,partyid,route,weight) values(:creationdate,:partyname,:partymobile,:partyaddress,:state,:city,:partyzip,:bookmode,:trainprice,:airprice,:gst,:destinate,:partyid,:route,:weight)";
    $exe = $con->prepare($query);
    $data = [':creationdate' => $creationdate, ':partyname' => $partyname, ':partymobile' => $partymobile, ':partyaddress' => $partyaddress, ':state' => $state, ':city' => $city, ':partyzip' => $partyzip, ':bookmode' => $bookmode, ':trainprice' => $trainprice, ':airprice' => $airprice, ':gst' => $gst, ':destinate' => $destinate,':partyid'=>$partyids,':route'=>$route,':weight'=>$weight];
    // print_r($data);die();
    $query_execute = $exe->execute($data);
    if ($query_execute) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}

if ($action == "partyfetch") {
  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";

  if ($ids != "") {
    $query = "select * from party where id=:ids";
    $exe = $con->prepare($query);
    $data = [':ids' => $ids];
    $exe->execute($data);
    $result = $exe->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  $data['data'] = $result;
  echo json_encode($data);
}

if ($action == "partyratefetch") {
  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";
  $partyid = isset($_POST['partyid']) ? $_POST['partyid'] : "";

  if ($ids != "") {
    $query = "select * from partyset where id=:ids and partyid=:partyid";
    $exe = $con->prepare($query);
    $data = [':ids' => $ids,':partyid'=>$partyid];
    $exe->execute($data);
    $result = $exe->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  $data['data'] = $result;
  echo json_encode($data);
}

if ($action == "partyupdation") {
  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";

  $creationdate = isset($_POST['creationdate']) ? $_POST['creationdate'] : "";
  $partyname = isset($_POST['partyname']) ? $_POST['partyname'] : "";
  $partymobile = isset($_POST['partymobile']) ? $_POST['partymobile'] : "";
  $bookmode = isset($_POST['bookmode']) ? $_POST['bookmode'] : "";
  $trainprice = isset($_POST['trainprice']) ? $_POST['trainprice'] : "";
  $address = isset($_POST['partyaddress']) ? $_POST['partyaddress'] : "";
  $airprice = isset($_POST['airprice']) ? $_POST['airprice'] : "";
  $gst = isset($_POST['gst']) ? $_POST['gst'] : "";
  $route = isset($_POST['route']) ? $_POST['route'] : "";
  $destination = isset($_POST['destination']) ? $_POST['destination'] : "";
  $city = isset($_POST['city']) ? $_POST['city'] : "";
  $state = isset($_POST['state']) ? $_POST['state'] : "";
  $zip = isset($_POST['zip']) ? $_POST['zip'] : "";
  $weight = isset($_POST['weight']) ? $_POST['weight'] : "";
 
  $query = "update partyset set creationdate=:creationdate,partyname=:partyname,partymobile=:partymobile,bookmode=:bookmode,trainprice=:trainprice,airprice=:airprice,partyaddress=:partyaddress,gst=:gst,route=:route,destinate=:destinate,city=:city,state=:state,partyzip=:partyzip,weight=:weight where id=:ids";
  $exe = $con->prepare($query);
  $data = ['ids' => $ids, ':creationdate' => $creationdate, ':partyname' => $partyname, ':partymobile' => $partymobile, ':bookmode' => $bookmode, ':trainprice' => $trainprice, ':airprice' => $airprice,':partyaddress'=>$address,':gst' => $gst,':route'=>$route,':destinate'=>$destination,':city'=>$city,'state'=>$state,':partyzip'=>$zip,':weight'=>$weight];
// print_r($data);die();
  $query_execute = $exe->execute($data);
  if ($query_execute) {
    $msg = "Success";
  } else {
    $msg = "Failure";
  }

  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}


if ($action == "partysetdeletion") {
  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";
  if ($ids != "") {
    $query = "delete from partyset where id=:ids";
    $exe = $con->prepare($query);
    $data = [':ids' => $ids];
    $query_execute = $exe->execute($data);
    if ($query_execute) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}

if ($action == "partydeletion") {
  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";
  if ($ids != "") {
    $query = "delete from party where id=:ids";
    $exe = $con->prepare($query);
    $data = [':ids' => $ids];
    $query_execute = $exe->execute($data);
    if ($query_execute) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}

if ($action == "bookcreation") {

$creationdate = isset($_POST['creationdate']) ? $_POST['creationdate'] : "";
  $partyid = isset($_POST['partyid']) ? $_POST['partyid'] : "";
   $type = isset($_POST['type']) ? $_POST['type'] : "";
   $route = isset($_POST['route']) ? $_POST['route'] : "";
  $origin = isset($_POST['origin']) ? $_POST['origin'] : "";
  $destination = isset($_POST['destination']) ? $_POST['destination'] : "";
  $area = isset($_POST['area']) ? $_POST['area'] : "";
  $coraddress = isset($_POST['coraddress']) ? $_POST['coraddress'] : "";
  $conaddress = isset($_POST['conaddress']) ? $_POST['conaddress'] : "";
  $transport = isset($_POST['transport']) ? $_POST['transport'] : "";
  $pod = isset($_POST['pod']) ? $_POST['pod'] : "";
  $trainname = isset($_POST['trainname']) ? $_POST['trainname'] : "";
  $pack = isset($_POST['pack']) ? $_POST['pack'] : "";
  $invoiceno = isset($_POST['invoiceno']) ? $_POST['invoiceno'] : "";
  $describe = isset($_POST['describe']) ? $_POST['describe'] : "";
  $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : "";
  $gross = isset($_POST['gross']) ? $_POST['gross'] : "";
  $weight = isset($_POST['weight']) ? $_POST['weight'] : "";
  $rate = isset($_POST['rate']) ? $_POST['rate'] : "";
  $weight1 = isset($_POST['weight1']) ? $_POST['weight1'] : "";
  $rate1 = isset($_POST['rate1']) ? $_POST['rate1'] : "";
  $weight2 = isset($_POST['weight2']) ? $_POST['weight2'] : "";
  $rate2 = isset($_POST['rate2']) ? $_POST['rate2'] : "";
   $docs = isset($_POST['docs']) ? $_POST['docs'] : "";
 $othercharge = isset($_POST['othercharge']) ? $_POST['othercharge'] : "";
  $amount = isset($_POST['amount']) ? $_POST['amount'] : "";
  $gst_types = isset($_POST['gst_types']) ? $_POST['gst_types'] : "";
  $igst = isset($_POST['igst']) ? $_POST['igst'] : "";
  $sgst = isset($_POST['sgst']) ? $_POST['sgst'] : "";
  $cgst = isset($_POST['cgst']) ? $_POST['cgst'] : "";
  $paymentmode = isset($_POST['paymentmode']) ? $_POST['paymentmode'] : "";
  $paid = isset($_POST['paid']) ? $_POST['paid'] : "";

  if ($creationdate != "" && $type != "" && $origin != "" && $destination != "" && $coraddress != "" && $conaddress != "" && $area != "" && $transport != "" && $pack != "" &&  $invoiceno != "" && $describe != "" && $quantity != "" && $gross != "" && $weight != "" && $docs != "" && $rate != "" && $amount != "" && $gst_types != "" && $paymentmode != "" && $paid != "") {
    $query = "insert into booking(creationdate,partyid,type,route,origin,destination,coraddress,conaddress,area,transport,pod,trainname,pack,invoiceno,description,quantity,rate,docs,gross,weight,amount,othercharge,gst,igst,cgst,sgst,paymentmode,paid,weight1,rate1,weight2,rate2) values(:creationdate,:partyid,:type,:route,:origin,:destination,:coraddress,:conaddress,:area,:transport,:pod,:trainname,:pack,:invoiceno,:description,:quantity,:rate,:docs,:gross,:weight,:amount,:othercharge,:gst,:igst,:cgst,:sgst,:paymentmode,:paid,:weight1,:rate1,:weight2,:rate2)";
    $exe = $con->prepare($query);
    $data = [':creationdate' => $creationdate,':partyid'=>$partyid,':type' => $type,':route'=>$route,':origin' => $origin, ':destination' => $destination, ':coraddress' => $coraddress, ':conaddress' => $conaddress, ':area' => $area, ':transport' => $transport,':pod'=>$pod,':trainname'=>$trainname,':pack' => $pack, ':invoiceno' => $invoiceno, ':description' => $describe, ':quantity' => $quantity, ':rate' => $rate, ':docs' => $docs, ':gross' => $gross, ':weight' => $weight, ':amount' => $amount,':othercharge'=>$othercharge,':gst' => $gst_types, ':igst' => $igst, ':cgst' => $cgst, ':sgst' => $sgst, ':paymentmode' => $paymentmode, ':paid' => $paid,':weight1'=>$weight1,':rate1'=>$rate1,':weight2'=>$weight2,':rate2'=>$rate2];
    // print_r($data);die();
    $query_execute = $exe->execute($data);
    if ($query_execute) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}

if ($action == "bookingdeletion") {
  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";
  if ($ids != "") {
    $query = "delete from booking where id=:ids";
    $exe = $con->prepare($query);
    $data = [':ids' => $ids];
    $query_execute = $exe->execute($data);
    if ($query_execute) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}
if ($action == "bookfetch") {
  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";
  if ($ids != "") {
    $query = "select * from booking where id=:ids";
    $exe = $con->prepare($query);
    $data = [':ids' => $ids];
    $exe->execute($data);
    $result = $exe->fetch(PDO::FETCH_ASSOC);

    $boid=$result['partyid'];
    $query1 = "select * from party where id=:boid";
    $exe1 = $con->prepare($query1);
    $data1 = [':boid' => $boid];
    $exe1->execute($data1);
    $result1 = $exe1->fetch(PDO::FETCH_ASSOC);
    
    if ($result && $result1) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  $data = [];
  $data['msg'] = $msg;
  $data['data'] = $result;
  $data['data']['party'] = $result1;
  echo json_encode($data);
}

if ($action == "partyimg") {
  $ids = isset($_POST['id']) ? $_POST['id'] : "";
  if ($ids != "") {
    $query = "select * from booking where id=:id";
    $exe = $con->prepare($query);
    $data = [':id' => $ids];
    $exe->execute($data);
    $result = $exe->fetch(PDO::FETCH_ASSOC);

    if ($result) {
      $msg = "Success";
    } else {
      $msg = "Failure";
    }
  } else {
    $msg = "Failure";
  }
  
  $data = [];
  $data['msg'] = $msg;
  $data['data'] = $result;
  echo json_encode($data);
}

if ($action == "bookupdation") {

  $ids = isset($_POST['ids']) ? $_POST['ids'] : "";
  $creationdate = isset($_POST['creationdate']) ? $_POST['creationdate'] : "";
    $type = isset($_POST['type']) ? $_POST['type'] : "";
 $partyid = isset($_POST['partyid']) ? $_POST['partyid'] : "";
 $route = isset($_POST['route']) ? $_POST['route'] : "";
  $origin = isset($_POST['origin']) ? $_POST['origin'] : "";
  $destination = isset($_POST['destination']) ? $_POST['destination'] : "";
  $area = isset($_POST['area']) ? $_POST['area'] : "";
  $coraddress = isset($_POST['coraddress']) ? $_POST['coraddress'] : "";
  $conaddress = isset($_POST['conaddress']) ? $_POST['conaddress'] : "";
  $pod = isset($_POST['pod']) ? $_POST['pod'] : "";
  $trainname = isset($_POST['trainname']) ? $_POST['trainname'] : "";
  $transport = isset($_POST['transport']) ? $_POST['transport'] : "";
  $pack = isset($_POST['pack']) ? $_POST['pack'] : "";
  $invoiceno = isset($_POST['invoiceno']) ? $_POST['invoiceno'] : "";
  $describe = isset($_POST['describe']) ? $_POST['describe'] : "";
  $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : "";
  $gross = isset($_POST['gross']) ? $_POST['gross'] : "";
  $weight = isset($_POST['weight']) ? $_POST['weight'] : "";
  $rate = isset($_POST['rate']) ? $_POST['rate'] : "";
  $weight1 = isset($_POST['weight1']) ? $_POST['weight1'] : "";
  $rate1 = isset($_POST['rate1']) ? $_POST['rate1'] : "";
  $weight2 = isset($_POST['weight2']) ? $_POST['weight2'] : "";
  $rate2 = isset($_POST['rate2']) ? $_POST['rate2'] : "";
  $docs = isset($_POST['docs']) ? $_POST['docs'] : "";
  $amount = isset($_POST['amount']) ? $_POST['amount'] : "";
  $othercharge = isset($_POST['othercharge']) ? $_POST['othercharge'] : "";
  $gst = isset($_POST['gst_types']) ? $_POST['gst_types'] : "";
  $igst = isset($_POST['igst']) ? $_POST['igst'] : "";
  $sgst = isset($_POST['sgst']) ? $_POST['sgst'] : "";
  $cgst = isset($_POST['cgst']) ? $_POST['cgst'] : "";
  $paymentmode = isset($_POST['paymentmode']) ? $_POST['paymentmode'] : "";
  $paid = isset($_POST['paid']) ? $_POST['paid'] : "";

  //  print_r($_POST);die();
  $query = "update booking set creationdate=:creationdate,type=:type,partyid=:partyid,route=:route,origin=:origin,destination=:destination,coraddress=:coraddress,conaddress=:conaddress,area=:area, pod=:pod,trainname=:trainname,transport=:transport,pack=:pack,invoiceno=:invoiceno,description=:description,quantity=:quantity,gross=:gross,weight=:weight,docs=:docs,rate=:rate,amount=:amount,gst=:gst,igst=:igst,sgst=:sgst,cgst=:cgst,paymentmode=:paymentmode,paid=:paid,weight1=:weight1,rate1=:rate1,weight2=:weight2,rate2=:rate2 where id=:ids";
  $exe = $con->prepare($query);
  $data = [':creationdate' => $creationdate,':type' => $type,':partyid'=>$partyid,':route'=>$route,':origin' => $origin, ':destination' => $destination, ':coraddress' => $coraddress, ':conaddress' => $conaddress,':area' => $area,':pod'=>$pod,':trainname'=>$trainname, ':transport' => $transport, ':pack' => $pack, ':invoiceno' => $invoiceno, ':description' => $describe, ':quantity' => $quantity, ':gross' => $gross, ':weight' => $weight,':docs' => $docs, ':rate' => $rate, ':amount' => $amount, ':gst' => $gst, ':igst' => $igst,':cgst'=>$cgst,':sgst'=>$sgst, ':paymentmode' => $paymentmode, ':paid' => $paid,':weight1'=>$weight1,':rate1'=>$rate1,':weight2'=>$weight2,':rate2'=>$rate2, ':ids' => $ids];
  // print_r($data);die();
  $query_execute = $exe->execute($data);
  if ($query_execute) {
    $msg = "Success";
  } else {
    $msg = "Failure";
  }

  $data = [];
  $data['msg'] = $msg;
  echo json_encode($data);
}
