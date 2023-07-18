<?php
session_start();
include('include/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="utf-8" />
    <title> | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    App favicon
    <link rel="shortcut icon" href="assets/images/favicon.ico"> -->
    <meta charset="utf-8" />
            <title>STAR Cargo - Login</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
            <meta content="" name="author" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- App favicon -->
            <link rel="shortcut icon" href="assets/images/favicon.ico">
<!-- App css -->
     <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
     <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body id="body" class="auth-page" style="background-image: url('assets/images/p-1.png'); background-size: cover; background-position: center center;">
   
   <!-- Log In page -->
    <div class="container-md">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                        <a href="index.html" class="logo logo-admin">
                                            <img src="assets/images/Star-cargo-logo.png" height="50" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Login</h4>   
                                        <!--<p class="text-muted  mb-0">Sign in to continue to Unikit.</p>  -->
                                    </div>
                                </div>
                                <div class="card-body pt-0">                                    
                                    <form class="my-4" action="" method="POST">            
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">                               
                                        </div><!--end form-group--> 
            
                                        <div class="form-group">
                                            <label class="form-label" for="userpassword">Password</label>                                            
                                            <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">                            
                                        </div><!--end form-group--> 
            
                                        <div class="form-group row mt-3">
                                            <div class="col-sm-6">
                                                <!--<div class="form-check form-switch form-switch-success">-->
                                                <!--    <input class="form-check-input" type="checkbox" id="customSwitchSuccess">-->
                                                <!--    <label class="form-check-label" for="customSwitchSuccess">Remember me</label>-->
                                                <!--</div>-->
                                            </div><!--end col--> 
                                            <!-- <div class="col-sm-6 text-end">
                                                <a href="auth-recover-pw.html" class="text-muted font-13"><i class="dripicons-lock"></i> Forgot password?</a>                                    
                                            </div> -->
                                            <!--end col--> 
                                        </div><!--end form-group--> 
            
                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid mt-3">
                                                    <input type="submit" class="btn btn-primary" name="login" value="Log In" />
                                                    <!--<i class="fas fa-sign-in-alt ms-1"></i>-->
                                                </div>
                                            </div><!--end col--> 
                                        </div> <!--end form-group-->                           
                                    </form><!--end form-->
                                    <!--<div class="m-3 text-center text-muted">-->
                                    <!--    <p class="mb-0">Don't have an account ?  <a href="auth-register.html" class="text-primary ms-2">Free Resister</a></p>-->
                                    <!--</div>-->
                                    <!--<hr class="hr-dashed mt-4">-->
                                    <!--<div class="text-center mt-n5">-->
                                    <!--    <h6 class="card-bg px-3 my-4 d-inline-block">Or Login With</h6>-->
                                    <!--</div>-->
                                    <!--<div class="d-flex justify-content-center mb-1">-->
                                    <!--    <a href="" class="d-flex justify-content-center align-items-center thumb-sm bg-soft-primary rounded-circle me-2">-->
                                    <!--        <i class="fab fa-facebook align-self-center"></i>-->
                                    <!--    </a>-->
                                    <!--    <a href="" class="d-flex justify-content-center align-items-center thumb-sm bg-soft-info rounded-circle me-2">-->
                                    <!--        <i class="fab fa-twitter align-self-center"></i>-->
                                    <!--    </a>-->
                                    <!--    <a href="" class="d-flex justify-content-center align-items-center thumb-sm bg-soft-danger rounded-circle">-->
                                    <!--        <i class="fab fa-google align-self-center"></i>-->
                                    <!--    </a>-->
                                    <!--</div>-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-body-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>
</html>
<?php
if(isset($_POST['login'])){
    $username=isset($_POST['username'])?$_POST['username']:"";
    $password=isset($_POST['password'])?$_POST['password']:"";
   
    $query="select * from user where username=:username and password=:password";
    $exe=$con->prepare($query);
    $data=[':username'=>$username,':password'=>$password];
    $queryexecute=$exe->execute($data);
    $count=$exe->rowCount();
    
 
  if($count>0){
    $_SESSION['user_name']=$username;
    echo "<script type='text/javascript'>
 Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Login Success',
  showConfirmButton: false,
  timer: 3000
}).then(function() {
window.location.href='dashboard.php';
})
</script>";
    }
    else{
  echo "<script type='text/javascript'>
  Swal.fire({
  position: 'top-end',
  icon: 'error',
  title: 'Login Failed',
  showConfirmButton: false,
  timer: 3000
}).then(function() {
window.location.href='login.php';
})
</script>";
        
    }
}
?>