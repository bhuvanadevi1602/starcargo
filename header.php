<?php
session_start();
error_reporting(0);
include('include/config.php');
$usernames = ucfirst($_SESSION['user_name']);
$sqluser = "select * from user where username=:username";
$exeuser = $con->prepare($sqluser);
$data = [':username' => $usernames];
$exeuser->execute($data);
$userrole = $exeuser->fetch(PDO::FETCH_ASSOC);
$_SESSION['types'] = $userrole['type'];
$_SESSION['role'] = $userrole['role'];
// print_r($userrole);die();
$types = $_SESSION['types'];
$roles = $_SESSION['role'];
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
    <title>Star Cargo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/Star-cargo-logo.png">

    <link href="assets/plugins/datatables/datatable.css" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body id="body" class="dark-sidebar">
    <!-- leftbar-tab-menu -->
    <div class="left-sidebar">
        <!-- LOGO -->
        <div class="brand">
            <a href="index.php" class="logo">
                <span>
                    <img src="assets/images/Star-cargo-logo.png" alt="logo-small" class="logo-sm">
                </span>
                <span>
                    <?php if ($roles == "Super Admin") { ?>
                        <h4 style="color:#fff"> Star Admin Cargo</h4>
                    <?php } else if ($roles == 'Air' || $roles == 'Train') { ?>
                        <h4 style="color:#fff"> Star <?= $types ?> Cargo</h4>
                    <?php } else { ?>
                        <h4 style="color:#fff"> Star <?= $types ?> Cargo</h4>
                    <?php } ?>
                    <!-- <img src="assets/images/star-cargo-logo-text-white.png" alt="logo-large" class="logo-lg logo-light">
                        <img src="assets/images/star-cargo-logo-text.png" alt="logo-large" class="logo-lg logo-dark"> -->
                </span>
            </a>
        </div>
        <!--<div class="sidebar-user-pro media border-end">                    -->
        <!--    <div class="position-relative mx-auto">-->
        <!--        <img src="assets/images/Star-cargo-logo.png" alt="user" class="rounded-circle thumb-md">-->
        <!--        <span class="online-icon position-absolute end-0"><i class="mdi mdi-record text-success"></i></span>-->
        <!--    </div>-->
        <!--    <div class="media-body ms-2 user-detail align-self-center">-->
        <!--        <h5 class="font-14 m-0 fw-bold">Mr.Ibrahim</h5>  -->

        <!--    </div>                    -->
        <!--</div>-->
        <div class="border-end">
            <ul class="nav nav-tabs menu-tab nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#Main" role="tab" aria-selected="true">M<span>ain</span></a>
                </li>

            </ul>
        </div>
        <!-- Tab panes -->

        <!--end logo-->
        <div class="menu-content h-100" data-simplebar>
            <div class="menu-body navbar-vertical">
                <div class="collapse navbar-collapse tab-content" id="sidebarCollapse">
                    <!-- Navigation -->
                    <ul class="navbar-nav tab-pane active" id="Main" role="tabpanel">
                        <!--<li class="menu-label mt-0 text-primary font-12 fw-semibold">M<span>ain</span><br><span class="font-10 text-secondary fw-normal">Unique Dashboard</span></li>                    -->

                        <?php
                        if ($roles == "Admin" || $roles == "Super Admin") {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php"><i class="ti ti-brand-hipchat menu-icon"></i><span>Dashboard</span></a>
                            </li><!--end nav-item-->
                            <li class="nav-item">
                                <a class="nav-link" href="party.php"><i class="ti ti-user menu-icon"></i><span>Party Details</span></a>
                            </li><!--end nav-item-->
                            <li class="nav-item">
                                <a class="nav-link" href="partysetup.php"><i class="ti ti-calendar menu-icon"></i><span>Party - Route Setup</span></a>
                            </li><!--end nav-item-->

                            <li class="nav-item">
                                <a class="nav-link" href="booking.php"><i class="ti ti-file-diff menu-icon"></i><span>Booking</span></a>
                            </li><!--end nav-item-->
                            <li class="nav-item">
                                <a class="nav-link" href="bonofied.php"><i class="ti ti-headphones menu-icon"></i><span>Bonofied</span></a>
                            </li><!--end nav-item-->
                        <?php }
                        if ($roles == "Super Admin") { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="user.php"><i class="ti ti-file-invoice menu-icon"></i><span>User Control</span></a>
                            </li><!--end nav-item-->
                            <li class="nav-item">
                                <a class="nav-link" href="gst.php"><i class="ti ti-percentage menu-icon"></i><span>GST</span></a>
                            </li><!--end nav-item-->
                        <?php }
                        if ($roles == "Delivery" ) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="bookupdate.php"><i class="ti ti-file menu-icon"></i><span>Booking Updations</span></a>
                            </li>
                        <?php } ?>
                    </ul>

                </div><!--end sidebarCollapse-->
            </div>
        </div>
    </div>
    <!-- end left-sidenav-->
    <!-- end leftbar-menu-->

    <!-- Top Bar Start -->
    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- Navbar -->
        <nav class="navbar-custom" id="navbar-custom">
            <ul class="list-unstyled topbar-nav float-end mb-0">
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle nav-user" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <img src="assets/images/Star-cargo-logo.png" alt="profile-user" class="rounded-circle me-2 thumb-sm" />
                            <div>
                                <small class="d-none d-md-block font-11"><?= ucfirst($_SESSION['user_name']) ?></small>
                                <span class="d-none d-md-block fw-semibold font-12">Star Cargo <i class="mdi mdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#"><i class="ti ti-user font-16 me-1 align-text-bottom"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="ti ti-settings font-16 me-1 align-text-bottom"></i> Settings</a>
                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item" href="logout.php"><i class="ti ti-power font-16 me-1 align-text-bottom"></i> Logout</a>
                    </div>
                </li>
            </ul>
            <ul class="list-unstyled topbar-nav mb-0">
                <li>
                    <button class="nav-link button-menu-mobile nav-icon" id="togglemenu">
                        <i class="ti ti-menu-2"></i>
                    </button>
                </li>
            </ul>
        </nav>
        <!-- end navbar-->
    </div>
    <!-- Top Bar End -->
    <!-- Top Bar End -->