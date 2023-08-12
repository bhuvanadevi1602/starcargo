<?php
session_start();
error_reporting(0);
$user_name = $_SESSION['user_name'];
include('include/config.php');
// print_r($user_name);die();
if ($user_name != "") {
    include('header.php');
    $dates = date('Y-m-d');
?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <style>
        .swal2-popup {
            font-size: 1.0rem !important;
        }
    </style>
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
                                    <li class="breadcrumb-item"><a href="#">Start Cargo</a></li>
                                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                    <li class="breadcrumb-item active">Datatables</li>
                                </ol>
                            </div>
                            <h4 class="page-title">User Datatables</h4>
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
                                <h4 class="card-title">User Details </h4>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalLarge" style="float:right">
                                    Create GST
                                </button>
                                <!--Start modal-header-->
                                <div class="modal fade bd-example-modal-lg" id="exampleModalLarge" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title m-0" id="myLargeModalLabel">Create GST</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div><!--end modal-header-->
                                            <div class="modal-body">
                                                <div class="row">


                                                    <div class="card-header">
                                                        <h4 class="card-title">Create GST</h4>


                                                    </div><!--end card-header-->
                                                    <div class="card-body">
                                                        <form class="row g-3 needs-validation" novalidate action="" method="POST" autocomplete="off">
                                                            <div class="col-md-4">
                                                                <label for="creationdate" class="form-label">Date</label>
                                                                <input type="date" class="form-control" id="creationdate" name="creationdate" value="<?= $dates ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Please provide a creation date
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="username" class="form-label">Booking Type</label>
                                                                <select name="bookmode" class="form-select" id="bookmode">
                                                                    <option value="">Select Booking Type</option>
                                                                    <option value="Air">Air</option>
                                                                    <option value="Train">Train</option>
                                                                </select>

                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="username" class="form-label">GST Type</label>
                                                                <select name="gsttype" class="form-select" id="gsttype">
                                                                    <option value="">Select GST Type</option>
                                                                    <option value="Interstate">Interstate</option>
                                                                    <option value="State">State</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4" id="interstate">
                                                                <label for="role" class="form-label">IGST</label>
                                                                <input type="text" class="form-control" id="igstval" name="igstval" />
                                                            </div>

                                                            <div class="col-md-6" id="state1">
                                                                <label for="password" class="form-label">SGST</label>
                                                                <input type="text" class="form-control" id="sgstval" name="sgstval" />
                                                            </div>


                                                            <div class="col-md-6" id="state2">
                                                                <label for="password" class="form-label">CGST</label>
                                                                <input type="text" class="form-control" id="cgstval" name="cgstval" />
                                                            </div>

                                                            <div class="col-12 text-center">
                                                                <input type="submit" name="gstcreation" id="gstcreation" class="btn btn-primary" value="Create GST">
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


                                <div class="modal fade bd-example-modal-lg" id="editgst" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title m-0" id="myLargeModalLabel">Edit User</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div><!--end modal-header-->
                                            <div class="modal-body">
                                                <div class="row">


                                                    <div class="card-header">
                                                        <h4 class="card-title">Create GST</h4>
                                                    </div><!--end card-header-->
                                                    <div class="card-body">
                                                        <form class="row g-3 needs-validation" novalidate action="" method="POST" autocomplete="off">
                                                            <input type="hidden" name="ed_gstid" id="ed_gstid" />
                                                            <div class="col-md-4">
                                                                <label for="creationdate" class="form-label">Date</label>
                                                                <input type="date" class="form-control" id="ed_creationdate" name="ed_creationdate" value="<?= $dates ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Please provide a creation date
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="username" class="form-label">Booking Type</label>
                                                                <select name="edbookmode" class="form-select" id="edbookmode">
                                                                    <option value="">Select Booking Type</option>
                                                                    <option value="Air">Air</option>
                                                                    <option value="Train">Train</option>
                                                                </select>

                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="username" class="form-label">GST Type</label>
                                                                <select name="edgsttype" class="form-select" id="edgsttype">
                                                                    <option value="">Select GST Type</option>
                                                                    <option value="Interstate">Interstate</option>
                                                                    <option value="State">State</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4" id="edinterstate">
                                                                <label for="role" class="form-label">IGST</label>
                                                                <input type="text" class="form-control" id="edigstval" name="edigstval" />
                                                            </div>

                                                            <div class="col-md-6" id="edstate1">
                                                                <label for="password" class="form-label">SGST</label>
                                                                <input type="text" class="form-control" id="edsgstval" name="edsgstval" />
                                                            </div>


                                                            <div class="col-md-6" id="edstate2">
                                                                <label for="password" class="form-label">CGST</label>
                                                                <input type="text" class="form-control" id="edcgstval" name="edcgstval" />
                                                            </div>

                                                            <div class="col-12 text-center">
                                                                <input type="submit" name="ed_gstcreation" id="ed_gstcreation" class="btn btn-primary" value="Update GST">
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


                            </div><!--end card-header-->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="datatable_1">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>S. No</th>
                                                <th data-type="date" data-format="YYYY/DD/MM">Creation Date</th>
                                                <th>Book Mode</th>
                                                <th>GST Type</th>
                                                <th>IGST</th>
                                                <th>CGST</th>
                                                <th>SGST</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $usersql = "select * from gst";
                                            $presql = $con->prepare($usersql);
                                            $presql->execute();
                                            $result = $presql->fetchAll(PDO::FETCH_ASSOC);
                                            $i = 0;
                                            if ($result) {
                                                foreach ($result as $res) {
                                                    $i += 1;
                                            ?>
                                                    <tr>
                                                        <td><?= $i ?></td>
                                                        <td><?= $res['creationdate'] ?></td>
                                                        <td><?= $res['bookmode'] ?></td>
                                                        <td><?= $res['gsttype'] ?></td>
                                                        <td><?= $res['igst'] ?></td>
                                                        <td><?= $res['cgst'] ?></td>
                                                        <td><?= $res['sgst'] ?></td>
                                                        <td>
                                                            <?php if ($res['role'] != 'Super Admin') { ?>
                                                                <button type="button" class="btn btn-primary btn-sm edit_gst" data-bs-toggle="modal" data-bs-target="#editgst" ids="<?= $res['id'] ?>">
                                                                    <i class="fa fa-pen"></i>
                                                                </button>
                                                            <?php } else { ?>
                                                                <button type="button" class="btn btn-sm">
                                                                    - </button>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($res['role'] != 'Super Admin') { ?>
                                                                <form method="POST" action="">
                                                                    <!-- <input type="hidden" name="delid" id="delid" value="<?= $res['id'] ?>" /> -->
                                                                    <!-- <input type="submit" class="btn btn-danger btn-sm userdeletion" name="userdeletion" id="userdeletion" value="Delete"> -->
                                                                    <button type="submit" class="btn btn-danger btn-sm userdeletion" ids="<?= $res['id'] ?>" name="userdeletion" id="userdeletion">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            <?php } else { ?>
                                                                <button type="button" class="btn btn btn-sm">
                                                                    - </button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td>No Data Found</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->




            </div><!-- container -->
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

            <!--<script src="assets/pages/form-validation.js"></script>-->
            <!-- App js -->
            <script src="assets/js/app.js"></script>
            <script src="assets/plugins/datatables/simple-datatables.js"></script>
            <script src="assets/pages/datatable.init.js"></script>

            <!-- App js -->
            <script src="assets/js/app.js"></script>
            </body>

            </html>
        <?php
        include('footer.php');
    } else {
        header("location:login.php");
    }
        ?>
        <script type="text/javascript">
            $(document).ready(function() {

                $("#interstate").hide();
                $("#state1").hide();
                $("#state2").hide();

                $('#gsttype').change(function() {
                    var gsttype = this.value;
                    // alert(gsttype)
                    if (gsttype == "Interstate") {
                        $("#interstate").show();
                        $("#state1").hide();
                        $("#state2").hide();
                    } else if (gsttype == "State") {
                        $("#state1").show();
                        $("#state2").show();
                        $("#interstate").hide();
                    }
                });

               
                $('#edgsttype').change(function() {
                    var gsttype = this.value;
                   if (gsttype == "Interstate") {
                        $("#edinterstate").show();
                        $("#edstate1").hide();
                        $("#edstate2").hide();
                    } else if (gsttype == "State") {
                        $("#edstate1").show();
                        $("#edstate2").show();
                        $("#edinterstate").hide();
                    }
                });


                $(".edit_gst").click(function(e) {
                    e.preventDefault();
                    var usereid = $(this).attr("ids");
                    // alert(usereid)
                    $("#ed_gstid").val(usereid);
                    $.ajax({
                        url: 'ajax/ajax_request.php?action=gstfetch',
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            'action': "gstfetch",
                            'ids': usereid
                        },
                        success: function(response) {
                            $("#ed_creationdate").val(response.data.creationdate);
                            $("#edbookmode").val(response.data.bookmode);
                            $("#edgsttype").val(response.data.gsttype);
                            $("#edigstval").val(response.data.igst);
                            $("#edcgstval").val(response.data.cgst);
                            $("#edsgstval").val(response.data.sgst);
                            var gsttype = $("#edgsttype").val();
                 if (gsttype == "Interstate") {
                        $("#edinterstate").show();
                        $("#edstate1").hide();
                        $("#edstate2").hide();
                    } else if (gsttype == "State") {
                        $("#edstate1").show();
                        $("#edstate2").show();
                        $("#edinterstate").hide();
                    }
                       }
                    });
                });

                $("#gstcreation").click(function(e) {
                    e.preventDefault();
                    var creationdate = $('#creationdate').val();
                    var bookmode = $('#bookmode').val();
                    var gsttype = $('#gsttype').val();
                    var cgst = $('#cgstval').val();
                    var sgst = $('#sgstval').val();
                    var igst = $('#igstval').val();

                    if (gsttype != "") {
                        $.ajax({
                            url: 'ajax/ajax_request.php?action=gstcreation',
                            type: 'POST',
                            dataType: "JSON",
                            data: {
                                'action': "gstcreation",
                                'creationdate': creationdate,
                                'bookmode': bookmode,
                                'gsttype': gsttype,
                                'cgst': cgst,
                                'sgst': sgst,
                                'igst': igst
                            },
                            success: function(response) {
                                if (response.msg == "Success") {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'GST Created',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(function() {
                                        window.location.href = 'gst.php';
                                    })
                                } else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'GST Create Failed',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(function() {
                                        window.location.href = 'gst.php';
                                    })
                                }
                            }

                        });
                    }
                });

                $(".userdeletion").click(function(e) {
                    e.preventDefault();
                    var userdid = $(this).attr('ids');
                    //  alert(userdid)
                    $.ajax({
                        url: 'ajax/ajax_request.php?action=userdeletion',
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            'action': "userdeletion",
                            'ids': userdid
                        },
                        success: function(response) {
                            console.log(response.data)
                            if (response.msg == "Success") {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'User Deleted',
                                    showConfirmButton: false,
                                    timer: 3000
                                }).then(function() {
                                    window.location.href = 'user.php';
                                })
                            } else {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'User Delete Failed',
                                    showConfirmButton: false,
                                    timer: 3000
                                }).then(function() {
                                    window.location.href = 'user.php';
                                })
                            }
                        }
                    });
                });

                $("#ed_gstcreation").click(function(e) {
                    e.preventDefault();
                    var ids = $('#ed_gstid').val();
                    var creationdate = $('#ed_creationdate').val();
                    var bookmode = $('#edbookmode').val();
                    var gsttype = $('#edgsttype').val();
                    var igst = $('#edigstval').val();
                    var  sgst= $('#edsgstval').val();
                    var cgst = $('#edcgstval').val();
                  
                        $.ajax({
                            url: 'ajax/ajax_request.php?action=gstupdation',
                            type: 'POST',
                            dataType: "JSON",
                            data: {
                                'action': "gstupdation",
                                'ids': ids,
                                'creationdate': creationdate,
                                'bookmode': bookmode,
                                'gsttype': gsttype,
                                'igst': igst,
                                'sgst': sgst,
                                'cgst': cgst
                            },
                            success: function(response) {
                                console.log(response.data)
                                if (response.msg == "Success") {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'GST Updated',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(function() {
                                        window.location.href = 'gst.php';
                                    })
                                } else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'GST Update Failed',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(function() {
                                        window.location.href = 'gst.php';
                                    })
                                }
                            }
                        });
                });
            });
        </script>