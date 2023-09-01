<?php
session_start();
error_reporting(0);
$user_name = $_SESSION['user_name'];
include('include/config.php');
$dates = date("Y-m-d");
// print_r($user_name);die();
if ($user_name != "") {
    include('header.php');
    $types = $_SESSION['types'];
    $roles = $_SESSION['role'];
    // print_r($_SESSION);die();

    $sqldel = "select * from user where username=:user_name";
    $exedel = $con->prepare($sqldel);
    $data = [':user_name' => $user_name];
    $exedel->execute($data);
    $result1 = $exedel->fetch(PDO::FETCH_ASSOC);
    // print_r($result1);die();
    $delsid = $result1['id'];

?>
    <!DOCTYPE html>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content-tab">

            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="float-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Booking</a></li>
                                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                    <li class="breadcrumb-item active">Datatables</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Booking Datatables</h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Booking Details</h4>

                                <form method="POST" autocomplete="off">
                                    <div class="row col-md-12 mt-4">
                                        <div class="col-md-5"></div>
                                        <div class="col-md-2">
                                            <input list="partiess" class="form-control" name="partynamess" id="partynamess">
                                            <datalist id="partiess">
                                                <?php
                                                if($types=="Air" || $types == "Delivery Air") {
                                                $sqlstate = "select * from booking where type='Air'";
                                                $exestate = $con->prepare($sqlstate);
                                                $exestate->execute();
                                                $result = $exestate->fetchAll(PDO::FETCH_ASSOC);
                                                }
                                                if($types=="Train" || $types == "Delivery Train") {
                                                    $sqlstate = "select * from booking where type='Train'";
                                                    $exestate = $con->prepare($sqlstate);
                                                    $exestate->execute();
                                                    $result = $exestate->fetchAll(PDO::FETCH_ASSOC);
                                                    }

                                                foreach ($result as $res) {
                                                ?>

                                                    <option selected disabled value="">Choose State...</option>
                                                    <option data-value="<?= $res['pod'] ?>" value="<?= $res['pod'] ?>"><?= $res['pod'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="submit" name="search" id="search" class="btn btn-sm btn-de-primary csv p-2" value="Search" />
                                        </div>
                                    </div>
                                </form>
                                <!--Start modal-header-->

                            </div><!--end card-header-->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="datatable_1">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>S.No</th>
                                                <th>M.No</th>
                                                <th data-type="date" data-format="YYYY/DD/MM">Date</th>
                                                <th data-type="date" data-format="YYYY/DD/MM">Run Date</th>
                                                <th>Party</th>
                                                <th>Type</th>
                                                <th>From - To</th>
                                                <th>Origin - Destination</th>
                                                <th>Transport</th>
                                                <th>Train</th>
                                                <th>POD</th>
                                                <th>Amount</th>
                                                <th>GST</th>
                                                <th>Payment</th>
                                                <th>Status</th>
                                                <th colspan="3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;

                                            if (isset($_POST['search'])) {
                                                $pod=$_POST['partynamess'];
                                               $sqlbook = "SELECT * from booking where pod='$pod' ORDER BY id ASC";
                                                // print_r($sqlbook);die();
                                                $exebook = $con->prepare($sqlbook);
                                                $exebook->execute();
                                                $resultbook = $exebook->fetchAll(PDO::FETCH_ASSOC);
                                               

                                            if ($resultbook != "") {
                                                foreach ($resultbook as $book) {
                                                    $ids = $book['partyid'];
                                                    $sqlbookp = "select * from party where id=:ids";
                                                    $exebookp = $con->prepare($sqlbookp);
                                                    $datap = [':ids' => $ids];
                                                    $exebookp->execute($datap);
                                                    $resultbookp = $exebookp->fetch(PDO::FETCH_ASSOC);

                                                    $i++;
                                            ?>
                                                    <tr>
                                                        <td><?= $i ?></td>
                                                        <td><?= $book['mno'] ?></td>
                                                        <td><?= $book['creationdate'] ?></td>
                                                        <td><?= isset($book['runningdate'])?$book['runningdate']:""; ?></td>
                                                        <td><?= $resultbookp['partyname'] ?></td>
                                                        <td><?= $book['type'] ?></td>
                                                        <td><?= $book['coraddress'] . " - " . $book['conaddress'] ?></td>
                                                        <td><?= $book['origin'] . " - " . $book['destination'] ?></td>
                                                        <td><?= $book['transport'] ?></td>
                                                        <td><?= $book['trainname'] ?></td>
                                                        <td><?= $book['pod'] ?></td>
                                                        <td><?= $book['amount'] ?></td>
                                                        <td><?= ($book['gst'] != "") ? $book['gst'] : "-" ?></td>
                                                        <td><?= $book['paid'] ?></td>
                                                        <?php if($book['status']!="") { ?>
                              <td> <button class="btn btn-sm btn-warning"><?=$book["status"]?></button></td>
                                    <?php } else { ?>
                            <td>-</td>
                            <?php } ?>
                               <td>
                                                            <button type="button" class="btn btn-primary btn-sm upload_book" data-bs-toggle="modal" data-bs-target="#uploadbooking" ids="<?= $book['id'] ?>">
                                                                <i class="fa fa-upload"></i>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-dark btn-sm upload_image" data-bs-toggle="modal" data-bs-target="#uploadimage" imgids="<?= $book['id'] ?>"><i class="fa fa-image"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            }  else { ?>
                                                <td>No Data Found</td>
                                                <?php } 
                                             }
                                       
                                        else {
                                            if($types=="Air" || $types == "Delivery Air") {
                                                $sqlstate = "select * from booking where type='Air'";
                                                $exestate = $con->prepare($sqlstate);
                                                $exestate->execute();
                                                $result = $exestate->fetchAll(PDO::FETCH_ASSOC);
                                                }
                                                if($types=="Train" || $types == "Delivery Train") {
                                                    $sqlstate = "select * from booking where type='Train'";
                                                    $exestate = $con->prepare($sqlstate);
                                                    $exestate->execute();
                                                    $result = $exestate->fetchAll(PDO::FETCH_ASSOC);
                                                    }

                                            $i = 0;
 if ($result != "") {
                                                foreach ($result as $book) {
                                                    $ids = $book['partyid'];
                                                    $sqlbookp = "select * from party where id=:ids";
                                                    $exebookp = $con->prepare($sqlbookp);
                                                    $datap = [':ids' => $ids];
                                                    $exebookp->execute($datap);
                                                    $resultbookp = $exebookp->fetch(PDO::FETCH_ASSOC);

                                                    $i++;
                                            ?>
                                                    <tr>
                                                        <td><?= $i ?></td>
                                                        <td><?= $book['mno'] ?></td>
                                                        <td><?= $book['creationdate'] ?></td>
                                                        <td><?= isset($book['runningdate'])?$book['runningdate']:""; ?></td>
                                                           <td><?= $resultbookp['partyname'] ?></td>
                                                        <td><?= $book['type'] ?></td>
                                                        <td><?= $book['coraddress'] . " - " . $book['conaddress'] ?></td>
                                                        <td><?= $book['origin'] . " - " . $book['destination'] ?></td>
                                                        <td><?= $book['transport'] ?></td>
                                                        <td><?= $book['trainname'] ?></td>
                                                        <td><?= $book['pod'] ?></td>
                                                        <td><?= $book['amount'] ?></td>
                                                        <td><?= ($book['gst'] != "") ? $book['gst'] : "-" ?></td>
                                                        <td><?= $book['paid'] ?></td>
                                                        <?php if($book['status']!="") { ?>
                              <td> <button class="btn btn-sm btn-warning"><?=$book["status"]?></button></td>
                                    <?php } else { ?>
                            <td>-</td>
                            <?php } ?> <td>
                                                            <button type="button" class="btn btn-primary btn-sm upload_book" data-bs-toggle="modal" data-bs-target="#uploadbooking" ids="<?= $book['id'] ?>">
                                                                <i class="fa fa-upload"></i>
                                                            </button>
                                                        </td>
                                                        <?php if($book['proofdoc']!="") { ?>
                                                        <td>
                                                            <button class="btn btn-dark btn-sm upload_image" data-bs-toggle="modal" data-bs-target="#uploadimage" imgids="<?= $book['id'] ?>"><i class="fa fa-image"></i></button>
                                                        </td>
                                                        <?php } ?>
                                                    </tr>
                                            <?php } 
                                            }
                                        }
                                           ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->




            </div><!-- container -->

            <!--Start Rightbar-->
            <!--Start Rightbar/offcanvas-->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="Appearance" aria-labelledby="AppearanceLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 class="m-0 font-14" id="AppearanceLabel">Appearance</h5>
                    <button type="button" class="btn-close text-reset p-0 m-0 align-self-center" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <h6>Account Settings</h6>
                    <div class="p-2 text-start mt-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="settings-switch1">
                            <label class="form-check-label" for="settings-switch1">Auto updates</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="settings-switch2" checked>
                            <label class="form-check-label" for="settings-switch2">Location Permission</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="settings-switch3">
                            <label class="form-check-label" for="settings-switch3">Show offline Contacts</label>
                        </div><!--end form-switch-->
                    </div><!--end /div-->
                    <h6>General Settings</h6>
                    <div class="p-2 text-start mt-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="settings-switch4">
                            <label class="form-check-label" for="settings-switch4">Show me Online</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="settings-switch5" checked>
                            <label class="form-check-label" for="settings-switch5">Status visible to all</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="settings-switch6">
                            <label class="form-check-label" for="settings-switch6">Notifications Popup</label>
                        </div><!--end form-switch-->
                    </div><!--end /div-->
                </div><!--end offcanvas-body-->
            </div>
            <!--end Rightbar/offcanvas-->
            <!--end Rightbar-->
            <!--Start modal-header-->


            <div class="modal fade bd-example-modal-xl" id="uploadimage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title m-0" id="myLargeModalLabel">View Image</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div><!--end modal-header-->
                        <div class="modal-body">
                            <div class="row">


                                <div class="card-header">
                                    <h4 class="card-title" style="color:#22b783;">View Image Details</h4>
                                </div><!--end card-header-->

                                <div class="card-body">
                                    <input type="hidden" name="edbookid" id="edbookid" value=""/>
                                    <img src="" name="delimg" id="delimg" width="100%"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade bd-example-modal-xl" id="uploadbooking" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title m-0" id="myLargeModalLabel">Upload Docs</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div><!--end modal-header-->
                        <div class="modal-body">
                            <div class="row">


                                <div class="card-header">
                                    <h4 class="card-title" style="color:#22b783;">Booking Details</h4>
                                </div><!--end card-header-->

                                <div class="card-body">
                                    <input type="hidden" name="role" id="role" value="<?= $types ?>" />
                                    <form class="row g-3" method="POST" autocomplete="off" enctype="multipart/form-data">
                                        <input type="hidden" name="ed_bookid" id="ed_bookid" />
                                        <div class="col-md-2"></div>
                                        <div class="col-md-3">
                                            <label for="validationCustom01" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="edcreationdate" name="edcreationdate" value="<?= $dates ?>" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid Date.
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="validationCustom03" class="form-label">From</label>
                                            <input type="file" class="form-control" id="uploadimg" name="uploadimg" multiple>
                                            <div class="invalid-feedback" id="bookfromaddress">
                                                Please provide a consignor address.
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="validationCustom03" class="form-label">Status</label>
                                            <select class="form-control" name="delstatus" id="delstatus">
                                                <option value="Started">Started</option>
                                                <option value="Transit">Transit</option>
                                                <option value="Delivered">Delivered</option>
                                            </select>
                                        </div>


                                        <div class="col-12 text-center">
                                            <input class="btn btn-primary" type="submit" name="bookupdation" id="bookupdation" value="Save Docs" />
                                        </div>
                                    </form><!--end form-->
                                </div><!--end card-body-->




                            </div>

                        </div><!--end modal-body-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-de-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        </div><!--end modal-footer-->
                    </div><!--end modal-content-->
                </div><!--end modal-dialog-->
            </div><!--end modal-->

            <script src="assets/pages/form-validation.js"></script>
            <!-- App js -->
            <script src="assets/js/app.js"></script>
            <script src="assets/plugins/datatables/simple-datatables.js"></script>
            <script src="assets/pages/datatable.init.js"></script>

            <!-- App js -->
            <script src="assets/js/app.js"></script>
            <script>
                $(document).ready(function() {

                    $(".upload_book").click(function(e) {
                        e.preventDefault();
                        var bookeid = $(this).attr("ids");
                        $("#ed_bookid").val(bookeid);
                        $.ajax({
                url: 'ajax/ajax_request.php?action=bookupfet',
                type: 'POST',
                dataType: "JSON",
                data: {
                  'action': "bookupfet",
                  'id': bookeid
                 },
                success: function(response) {
                    var path="uploads/"+response.data.proofdoc;
                    $('#delimg').attr("src",path);
                    $('#delstatus').val(response.data.status);
                  }
                });
                    });

                    $(".upload_image").click(function(e) {
                        e.preventDefault();
                        var bookeid = $(this).attr("imgids");
                        // alert(bookeid)
                        $("#edbookid").val(bookeid);
                        $.ajax({
                url: 'ajax/ajax_request.php?action=partyimg',
                type: 'POST',
                dataType: "JSON",
                data: {
                  'action': "partyimg",
                  'id': bookeid
                 },
                success: function(response) {
                    var path="uploads/"+response.data.proofdoc;
                    $('#delimg').attr("src",path);
                  }
                });
                });
            });
            </script>

            </body>

            </html>
        <?php
        include('footer.php');
        if (isset($_POST['bookupdation'])) {
            $delid = $delsid;
            $deldate = $_POST['edcreationdate'];
            $delstatus = $_POST['delstatus'];
            $bookid = $_POST['ed_bookid'];

            $s = array();

            $images = $_FILES['uploadimg']['name'];

            $tmpFilePath = $_FILES['uploadimg']['tmp_name'];
            $path = "uploads/" . basename($images);

            if (move_uploaded_file($tmpFilePath, $path)) {
                $query = "update booking set proofdoc='$images',deliveryid=$delid,deliverydate='$deldate',status='$delstatus' where id=$bookid";
                $exe = $con->prepare($query);
                $query_execute = $exe->execute();

                if ($query_execute) {
                    echo "<script>Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Image Uploaded Success',
                            showConfirmButton: false,
                            timer: 3000
                          }).then(function() {
                            window.location.href = 'bookupdate.php';
                          })</script>";
                } else {
                    echo "<script>Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Image Upload Failed',
                                showConfirmButton: false,
                                timer: 3000
                              }).then(function() {
                                window.location.href = 'bookupdate.php';
                              })</script>";
                }
            }
            else {
                $query = "update booking set deliveryid=$delid,deliverydate='$deldate',status='$delstatus' where id=$bookid";
                $exe = $con->prepare($query);
                $query_execute = $exe->execute();

                if ($query_execute) {
                    echo "<script>Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Status Update Success',
                            showConfirmButton: false,
                            timer: 3000
                          }).then(function() {
                            window.location.href = 'bookupdate.php';
                          })</script>";
                } else {
                    echo "<script>Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Status Update Failed',
                                showConfirmButton: false,
                                timer: 3000
                              }).then(function() {
                                window.location.href = 'bookupdate.php';
                              })</script>";
                }
            }
        }
    } else {
        header("location:login.php");
    }
        ?>