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
 ?>
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
                                    <li class="breadcrumb-item"><a href="#">Party</a></li>
                                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                    <li class="breadcrumb-item active">Datatables</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Party Datatables</h4>
                            <input type="hidden" name="typ" id="typ" value="<?=$types?>" />
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
                                <h4 class="card-title">Party Details </h4>

                                <!-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalLarge" style="float:right">
                                    Add Party
                                </button> -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalLargedetails" style="float:right;">
                                    Add Party Details
                                </button>
                                <!--Start modal-header-->

                                <div class="modal fade bd-example-modal-lg" id="exampleModalLargedetails" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title m-0" id="myLargeModalLabel">Party</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div><!--end modal-header-->
                                            <div class="modal-body">
                                                <div class="row">


                                                    <div class="card-header">
                                                        <h4 class="card-title">Add Party Details</h4>


                                                    </div><!--end card-header-->
                                                    <div class="card-body">
                                                        <form class="row g-3 needs-validation" method="POST" novalidate autocomplete="off">
                                                            <div class="col-md-3">
                                                                <label for="validationCustom01" class="form-label">Date</label>
                                                                <input type="date" value="<?= $dates ?>" class="form-control" id="detcreationdate" name="detcreationdate" required>
                                                                <div class="invalid-feedback" id="partydatem">
                                                                    Please provide a valid Date.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="validationCustom01" class="form-label">Party Name</label>
                                                                <input type="text" class="form-control" id="detpartyname" name="detpartyname" required>
                                                                <div class="invalid-feedback" id="detpartyname">
                                                                    Please provide a valid Party Name.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="validationCustom03" class="form-label">Mobile</label>
                                                                <input type="number" class="form-control" id="detpartymobile" name="detpartymobile">
                                                                <div class="invalid-feedback" id="detpartymobile">
                                                                    Please provide a valid Mobile.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="validationCustom03" class="form-label">Route</label>
                                                                <input list="routes" class="form-control" name="route" id="route">

                                                                <datalist id="routes">
                                                                    <option selected disabled value="">Choose Route</option>
                                                                    <option value="Vaniyambadi">Vaniyambadi</option>
                                                                    <option value="CHENNAI">CHENNAI</option>
                                                                    <option value="RANIPET">RANIPET</option>
                                                                    <option value="AMBUR">AMBUR</option>
                                                                    <option value="Other Place">Other Place</option>
                                                                </datalist>
                                                            </div>
                                                      
                                                            <div class="col-md-3">
                                                                <label for="validationCustom05" class="form-label">Type of Booking</label>
                                                                <div class="col-md-12">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input sample" type="radio" id="air" name="bookmode" value="Air">
                                                                        <label class="form-check-label" for="inlineCheckbox1">Air</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input sample" type="radio" id="train" name="bookmode" value="Train">
                                                                        <label class="form-check-label" for="inlineCheckbox2">Train</label>
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        Please provide a valid zip.
                                                                    </div>
                                                                </div>
                                                                <div class="invalid-feedback" id="detpartytype">
                                                                    Please provide a valid Types.
                                                                </div>
                                                            </div>

                                                         
                                                            <div class="col-md-3" id="weights">
                                                                <label for="validationCustom03" class="form-label">Weight</label>
                                                                <input type="text" class="form-control" name="weight" id="weight" required>
                                                                <div class="invalid-feedback" id="weight">
                                                                    Please provide a valid Weight.
                                                                </div>
                                                            </div>

                                                         
                                                            <div class="col-md-3" id="airprices">
                                                                <label for="validationCustom03" class="form-label">Air Rate</label>
                                                                <input type="number" class="form-control" name="airprice" id="airprice" required>
                                                                <div class="invalid-feedback">
                                                                    Please provide a valid Air Rate.
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3" id="trainprices">
                                                                <label for="validationCustom03" class="form-label">Trian Rate</label>
                                                                <input type="number" class="form-control" name="trainprice" id="trainprice" required>
                                                                <div class="invalid-feedback">
                                                                    Please provide a valid Trian Rate.
                                                                </div>
                                                            </div>
   <div class="col-md-3">
                                                                <label for="validationCustom03" class="form-label">GST No</label>
                                                                <input type="text" class="form-control" name="detpartygst" id="detpartygst">
                                                                  <div class="invalid-feedback" id="rate">
                                                                    Please provide a valid Rate.
                                                                </div>
                                                            </div>

                                                            <div class="col-12 text-center">
                                                                <button class="btn btn-primary" type="submit" name="createpartydetail" id="createpartydetail">Save Party Details</button>
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
                                                <th>S.No</th>
                                                <th>Party</th>
                                                <th>Mobile</th>
                                                <th data-type="date" data-format="YYYY/DD/MM">Date</th>
                                                <th>Route</th>
                                                <th>Book Mode</th>
                                                <th>GST</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($types == "Admin") {
                                                $sqlparty = "select * from party";
                                                $exeparty = $con->prepare($sqlparty);
                                                $exeparty->execute();
                                                $resultparty = $exeparty->fetchAll(PDO::FETCH_ASSOC);
                                            } else if ($types == "Air" || $types == "Delivery Air") {
                                                $sqlparty = "select * from party where bookmode=:bookmode";
                                                $exeparty = $con->prepare($sqlparty);
                                                $data = [':bookmode' => $types];
                                                $exeparty->execute($data);
                                                $resultparty = $exeparty->fetchAll(PDO::FETCH_ASSOC);
                                            } else if ($types == "Train" || $types == "Delivery Train") {
                                                $sqlparty = "select * from party where bookmode=:bookmode";
                                                $exeparty = $con->prepare($sqlparty);
                                                $data = [':bookmode' => $types];
                                                $exeparty->execute($data);
                                                $resultparty = $exeparty->fetchAll(PDO::FETCH_ASSOC);
                                            }
                                            $i = 0;
                                            foreach ($resultparty as $party) {
                                                $i += 1;
                                            ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $party['partyname'] ?></td>
                                                    <td><?= $party['partymobile'] ?></td>
                                                    <!-- <td><?= $party['partyaddress'] ?></td> -->
                                                    <td><?= $party['creationdate'] ?></td>
                                                    <td><?= $party['route'] ?></td>
                                                    <td><?= $party['bookmode'] ?></td>
                                                    <td><?= $party['gst'] ?></td>
                                                    <td>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-6">
                                                                <button type="button" class="btn btn-primary btn-sm edit_party" data-bs-toggle="modal" data-bs-target="#editparty" ids="<?= $party['id'] ?>">
                                                                    <i class="fa fa-pen"></i>
                                                                </button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <form method="POST" action="">
                                                                    <!-- <input type="submit" class="btn btn-danger btn-sm userdeletion" name="userdeletion" id="userdeletion" value="Delete"> -->
                                                                    <button type="submit" class="btn btn-danger btn-sm partydeletion" name="partydeletion" ids="<?= $party['id'] ?>" id="partydeletion">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>

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

            <div class="modal fade bd-example-modal-lg" id="editparty" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title m-0" id="myLargeModalLabel">Edit Party</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div><!--end modal-header-->
                        <div class="modal-body">
                            <div class="row">
                                <div class="card-body">
                                    <form class="row g-3 needs-validation" method="POST" novalidate autocomplete="off">
                                        <input type="hidden" name="edpartyid" id="edpartyid" />
                                        <div class="col-md-3">
                                            <label for="validationCustom01" class="form-label">Date</label>
                                            <input type="date" value="<?= $dates ?>" class="form-control" id="edcreationdate" name="edcreationdate" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid Date.
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="validationCustom01" class="form-label">Party Name</label>
                                            <input type="text" class="form-control" id="edpartyname" name="edpartyname" required>
                                            <div class="invalid-feedback" id="edpartynamem">
                                                Please provide a valid Party Name.
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="validationCustom03" class="form-label">Mobile</label>
                                            <input type="number" class="form-control" id="edpartymobile" name="edpartymobile">
                                            <div class="invalid-feedback" id="edpartymobilem">
                                                Please provide a valid Mobile.
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="validationCustom03" class="form-label">Route</label>
                                            <input list="routes" class="form-control" name="ed_route" id="ed_route">

                                            <datalist id="routes">
                                                <option selected disabled value="">Choose Route</option>
                                                <option value="Vaniyambadi">Vaniyambadi</option>
                                                <option value="CHENNAI">CHENNAI</option>
                                                <option value="RANIPET">RANIPET</option>
                                                <option value="AMBUR">AMBUR</option>
                                                <option value="Other Place">Other Place</option>
                                            </datalist>
                                        </div>

                                        <div class="col-md-3" id="validationCustom05">
                                            <label for="validationCustom05" class="form-label">Type of Booking</label>
                                            <div class="col-md-12">
                                                <input type="hidden" id="ed_bookmode" name="ed_bookmode" />
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sample" type="radio" id="edair" name="edbookmode" value="Air">
                                                    <label class="form-check-label" for="inlineCheckbox1">Air</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sample" type="radio" id="edtrain" name="edbookmode" value="Train">
                                                    <label class="form-check-label" for="inlineCheckbox2">Train</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please provide a valid zip.
                                                </div>
                                            </div>

                                             </div><!--end row-->
                                             
                                             <div class="col-md-3" id="edweights">
                                                                <label for="validationCustom03" class="form-label">Weight</label>
                                                                <input type="text" class="form-control" name="edweight" id="edweight" required>
                                                                <div class="invalid-feedback" id="weight">
                                                                    Please provide a valid Weight.
                                                                </div>
                                                            </div>

                                      
                                             <div class="col-md-3" id="edairprices">
                                            <label for="validationCustom03" class="form-label">Air Rate</label>
                                            <input type="number" class="form-control " name="edairprice" id="edairprice" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid Air Rate.
                                            </div>
                                        </div>

                                        <div class="col-md-3" id="edtrainprices">
                                            <label for="validationCustom03" class="form-label">Train Rate</label>
                                            <input type="number" class="form-control " name="edtrainprice" id="edtrainprice" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid Train Rate.
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <label for="validationCustom03" class="form-label">GST Number</label>
                                            <input type="text" class="form-control" name="edgst" id="edgst" required>
                                            <div class="invalid-feedback" id="edpartygstm">
                                                Please provide a valid GST
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary" type="submit" name="partydetupdation" id="partydetupdation">Update Party</button>
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
                            <input class="form-check-input" type="radio" id="settings-switch1">
                            <label class="form-check-label" for="settings-switch1">Auto updates</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="radio" id="settings-switch2" checked>
                            <label class="form-check-label" for="settings-switch2">Location Permission</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="radio" id="settings-switch3">
                            <label class="form-check-label" for="settings-switch3">Show offline Contacts</label>
                        </div><!--end form-switch-->
                    </div><!--end /div-->
                    <h6>General Settings</h6>
                    <div class="p-2 text-start mt-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="radio" id="settings-switch4">
                            <label class="form-check-label" for="settings-switch4">Show me Online</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="radio" id="settings-switch5" checked>
                            <label class="form-check-label" for="settings-switch5">Status visible to all</label>
                        </div><!--end form-switch-->
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="radio" id="settings-switch6">
                            <label class="form-check-label" for="settings-switch6">Notifications Popup</label>
                        </div><!--end form-switch-->
                    </div><!--end /div-->
                </div><!--end offcanvas-body-->
            </div>

            <script src="assets/pages/form-validation.js"></script>
            <!-- App js -->
            <script src="assets/js/app.js"></script>
            <script src="assets/plugins/datatables/simple-datatables.js"></script>
            <script src="assets/pages/datatable.init.js"></script>
            <script>
                $(document).ready(function() {
                    var ty=$("#typ").val();
                  
                    if(ty=="Admin") {
    $("#trainprices").hide();
                    $("#airprices").hide();
                    $("#edtrainprices").hide();
                    $("#edairprices").hide();
                    $("#edweights").hide();
                          }
                   else if(ty=="Air") {
                    $("#air").prop('checked',true);
                        $("#trainprices").hide();
                    $("#airprices").show();
                    $("#edtrainprices").hide();
                    $("#edairprices").show();
                    $("#edweights").show();
                           }
          else if(ty=="Train") {
            $("#train").prop('checked',true);
                       $("#trainprices").show();
                    $("#airprices").hide();
                    $("#edtrainprices").show();
                    $("#edairprices").hide();
                    $("#edweights").hide();
                           }
                    
                    
                    $("input[type='radio']").click(function() {
                        var airs = $("input[id='air']:checked").val();
                        var trains = $("input[id='train']:checked").val();
                        //  alert(airs+" - "+trains)

                        if (airs != "Air" && trains != "Train") {
                            $("#trainprices").hide();
                            $("#airprices").hide();
                            $("#weights").hide();
                          } else if (airs == "Air" && trains != "Train") {
                            $("#trainprices").hide();
                            $("#weights").show();
                            $("#airprices").show();
                        } else if (airs != "Air" && trains == "Train") {
                            $("#trainprices").show();
                            $("#airprices").hide();
                            $("#weights").hide();
                          } else if (airs == "Air" && trains == "Train") {
                            $("#trainprices").show();
                            $("#airprices").show();
                            $("#weights").show();
                         }
                    });

                    $("input[type='radio']").click(function() {
                        var airs = $("input[id='edair']:checked").val();
                        var trains = $("input[id='edtrain']:checked").val();
                        //  alert(airs+" - "+trains)

                        if (airs != "Air" && trains != "Train") {
                            $("#edtrainprices").hide();
                            $("#edairprices").hide();
                            $("#edweights").hide();
                   } else if (airs == "Air" && trains != "Train") {
                            $("#edtrainprices").hide();
                            $("#edairprices").show();
                            $("#edweights").show();
                  } else if (airs != "Air" && trains == "Train") {
                            $("#edtrainprices").show();
                            $("#edairprices").hide();
                            $("#edweights").hide();
                    } else if (airs == "Air" && trains == "Train") {
                            $("#edtrainprices").show();
                            $("#edairprices").show();
                            $("#edweights").show();
                     }
                    });



                    $("#createpartydetail").click(function(e) {
                        e.preventDefault();
                        var creationdate = $('#detcreationdate').val();
                        var partyname = $('#detpartyname').val();
                        var mobile = $('#detpartymobile').val();
                        var gst = $('#detpartygst').val();
                        var route = $('#route').val();
                        var weight = $('#weight').val();

                        var types = [];
                        $.each($("input[name='bookmode']:checked"), function() {
                            types.push($(this).val());
                        });
                        bookmode = types.toString();

                        var airp = $("#airprice").val();
                        var trainp = $("#trainprice").val();

                        if (partyname != "" && types != "") {
                            $("#invalid-type").hide();
                            $.ajax({
                                url: 'ajax/ajax_request.php?action=userpartydetail',
                                type: 'POST',
                                dataType: "JSON",
                                data: {
                                    'action': "userpartydetail",
                                    'creationdate': creationdate,
                                    'partyname': partyname,
                                    'partymobile': mobile,
                                    'types': bookmode,
                                    'gst': gst,
                                    'airprice': airp,
                                    'trainprice': trainp,
                                    'route': route,
                                    'weight':weight
                                },
                                success: function(response) {
                                    if (response.msg == "Success") {
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: 'Party Created',
                                            showConfirmButton: false,
                                            timer: 3000
                                        }).then(function() {
                                            window.location.href = 'party.php';
                                        })
                                    } else {
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'error',
                                            title: 'Party Create Failed',
                                            showConfirmButton: false,
                                            timer: 3000
                                        }).then(function() {
                                            window.location.href = 'party.php';
                                        })
                                    }
                                }
                            });
                        }
                    });
                    $(".edit_party").click(function(e) {
                        e.preventDefault();
                        var partyid = $(this).attr("ids");
                        $("#edpartyid").val(partyid);
                        $.ajax({
                            url: 'ajax/ajax_request.php?action=partyfetch',
                            type: 'POST',
                            dataType: "JSON",
                            data: {
                                'action': "partyfetch",
                                'ids': partyid
                            },
                            success: function(response) {
                                $("#edcreationdate").val(response.data.creationdate);
                                $("#edpartyname").val(response.data.partyname);
                                $("#edpartymobile").val(response.data.partymobile);
                                $("#ed_bookmode").val(response.data.bookmode);
                                $("#edairprice").val(response.data.airprice);
                                $("#edtrainprice").val(response.data.trainprice);
                                $("#ed_route").val(response.data.route);
                                $("#edweight").val(response.data.weight);
                                var booksmode = $("#ed_bookmode").val();

                                if (booksmode == "Train") {
                                    $("#edtrain").prop('checked', true);
                                    $("#edtrainprices").show();
                                    $("#edairprices").hide();
                                    $("#edweights").hide();
                                } else if (booksmode == "Air") {
                                    $("#edair").prop('checked', true);
                                    $("#edtrainprices").hide();
                                    $("#edairprices").show();
                                    $("#edweights").show();
                               }
                                $("#edgst").val(response.data.gst);
                            }
                        });
                    });

                    $("#partydetupdation").click(function(e) {
                        e.preventDefault();
                        var ids = $('#edpartyid').val();
                        var creationdate = $("#edcreationdate").val();
                        var partyname = $("#edpartyname").val();
                        var route = $("#ed_route").val();
                        var partymobile = $("#edpartymobile").val();
                        var gst = $("#edgst").val();
                        var book_mode = $("input[name='edbookmode']:checked").val();
                        var weight = $("#edweight").val();
                          
                        if (book_mode == "Air") {
                            $("#edtrainprice").val(0);
                        } else if (book_mode == "Train") {
                            $("#edairprice").val(0);
                        }

                        var airprice = $("#edairprice").val();
                        var trainprice = $("#edtrainprice").val();

                        $.ajax({
                            url: 'ajax/ajax_request.php?action=partydetupdation',
                            type: 'POST',
                            dataType: "JSON",
                            data: {
                                'action': "partydetupdation",
                                'ids': ids,
                                'creationdate': creationdate,
                                'partyname': partyname,
                                'partymobile': partymobile,
                                'airprice': airprice,
                                'trainprice': trainprice,
                                'gst': gst,
                                'bookmode': book_mode,
                                'route': route,
                                'weight': weight
                            },
                            success: function(response) {
                                console.log(response.data)
                                if (response.msg == "Success") {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Party Updated',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(function() {
                                        window.location.href = 'party.php';
                                    })
                                } else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'Party Update Failed',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(function() {
                                        window.location.href = 'party.php';
                                    })
                                }
                            }
                        });
                    });

                    $(".partydeletion").click(function(e) {
                        e.preventDefault();
                        var partydid = $(this).attr('ids');
                        //    alert(partydid)
                        $.ajax({
                            url: 'ajax/ajax_request.php?action=partydeletion',
                            type: 'POST',
                            dataType: "JSON",
                            data: {
                                'action': "partydeletion",
                                'ids': partydid
                            },
                            success: function(response) {
                                console.log(response.data)
                                if (response.msg == "Success") {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Party Deleted',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(function() {
                                        window.location.href = 'party.php';
                                    })
                                } else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'Party Delete Failed',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(function() {
                                        window.location.href = 'party.php';
                                    })
                                }
                            }
                        });
                    });

                });
            </script>
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