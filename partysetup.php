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

                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalLarge" style="float:right">
                                    Add Party
                                </button>
                                <!--Start modal-header-->
                                <div class="modal fade bd-example-modal-lg" id="exampleModalLarge" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title m-0" id="myLargeModalLabel">Party</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div><!--end modal-header-->
                                            <div class="modal-body">
                                                <div class="row">


                                                    <div class="card-header">
                                                        <h4 class="card-title">Add Party</h4>


                                                    </div><!--end card-header-->
                                                    <div class="card-body">
                                                        <form class="row g-3 needs-validation" method="POST" novalidate>
                                                            <div class="col-md-4">
                                                                <label for="validationCustom01" class="form-label">Date</label>
                                                                <input type="hidden" id="partyids" name="partyids" />
                                                                <input type="date" value="<?= $dates ?>" class="form-control" id="creationdate" name="creationdate" required>
                                                                <div class="invalid-feedback" id="partydatem">
                                                                    Please provide a valid Date.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="validationCustom01" class="form-label">Party Name</label>
                                                                <!-- <input type="text" class="form-control" id="partyname" name="partyname" required> -->
                                                                <input list="parties" class="form-control" name="partyname" id="partyname">
                                                                <datalist id="parties">
                                                                    <?php
                                                                    $sqlstate = "select * from party";
                                                                    $exestate = $con->prepare($sqlstate);
                                                                    $exestate->execute();
                                                                    $result = $exestate->fetchAll(PDO::FETCH_ASSOC);
                                                                    foreach ($result as $res) {
                                                                    ?>

                                                                        <option selected disabled value="">Choose State...</option>
                                                                        <option data-value="<?= $res['id'] ?>" value="<?= $res['partyname'] ?>"><?= $res['partyname'] ?></option>
                                                                    <?php } ?>
                                                                </datalist>

                                                                <div class="invalid-feedback" id="partynamem">
                                                                    Please provide a valid Party Name.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="validationCustom01" class="form-label">Route</label>
                                                                <!-- <input type="text" class="form-control" id="partyname" name="partyname" required> -->
                                                                <input list="routes" class="form-control" name="route" id="route">

                                                                <datalist id="routes">
                                                                    <option selected disabled value="">Choose Route</option>
                                                                    <option value="Vaniyambadi">Vaniyambadi</option>
                                                                    <option value="CHENNAI">CHENNAI</option>
                                                                    <option value="RANIPET">RANIPET</option>
                                                                    <option value="AMBUR">AMBUR</option>
                                                                    <option value="Other Place">Other Place</option>
                                                                </datalist>
                                                                <div class="invalid-feedback" id="partynamem">
                                                                    Please provide a valid Party Name.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3" id="validationCustom05">
                                                                <label for="validationCustom05" class="form-label">Type of Booking</label>
                                                                <input list="bookmodes" class="form-control" name="bookmode" id="bookmode">

                                                                <datalist id="bookmodes">
                                                                    <option selected disabled value="">Choose Type</option>
                                                                    <option value="Air">Air</option>
                                                                    <option value="Train">Train</option>

                                                                </datalist>

                                                            </div><!--end row-->
                                                            <div class="col-md-3" id="airprices">
                                                                <label for="validationCustom03" class="form-label">Air Rate</label>
                                                                <input type="number" class="form-control" name="airprice" id="airprice" readonly required>
                                                                <div class="invalid-feedback" id="airpricem">
                                                                    Please provide a valid Air Rate.
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3" id="trainprices">
                                                                <label for="validationCustom03" class="form-label">Trian Rate</label>
                                                                <input type="number" class="form-control" name="trainprice" id="trainprice" readonly required>
                                                                <div class="invalid-feedback" id="trainpricem">
                                                                    Please provide a valid Trian Rate.
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label for="validationCustom03" class="form-label">GST Number</label>
                                                                <input type="text" class="form-control" name="gst" readonly id="gst" required>
                                                                <div class="invalid-feedback" id="partygstm">
                                                                    Please provide a valid GST.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="validationCustom03" class="form-label">Mobile</label>
                                                                <input type="number" class="form-control" id="partymobile" readonly name="partymobile" required>
                                                                <div class="invalid-feedback" id="partymobilem">
                                                                    Please provide a valid Mobile.
                                                                </div>
                                                            </div>



                                                            <div class="col-md-12">
                                                                <label for="validationCustom02" class="form-label">Address</label>
                                                                <!-- <input type="text" class="form-control" id="validationCustom02"  required> -->
                                                                <textarea name="partyaddress" id="partyaddress" class="form-control"></textarea>
                                                                <div class="invalid-feedback" id="partyaddressm">
                                                                    Please provide a valid Address.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="validationCustom04" class="form-label">State</label>
                                                                <input list="states" class="form-control" name="state" id="state">

                                                                <datalist id="states">
                                                                    <?php
                                                                    $sqlstate = "select * from states";
                                                                    $exestate = $con->prepare($sqlstate);
                                                                    $exestate->execute();
                                                                    $result = $exestate->fetchAll(PDO::FETCH_ASSOC);
                                                                    foreach ($result as $res) {
                                                                    ?>

                                                                        <option selected disabled value="">Choose State...</option>
                                                                        <option value="<?= $res['name'] ?>"><?= $res['name'] ?></option>
                                                                    <?php } ?>
                                                                </datalist>
                                                                <div class="invalid-feedback" id="partystatem">
                                                                    Please provide a valid State.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="validationCustom04" class="form-label">City</label>
                                                                <input list="cities" class="form-control" name="city" id="city">

                                                                <datalist id="cities">
                                                                    <?php
                                                                    $sqlcity = "select * from cities";
                                                                    $execity = $con->prepare($sqlcity);
                                                                    $execity->execute();
                                                                    $rescity = $execity->fetchAll(PDO::FETCH_ASSOC);
                                                                    foreach ($rescity as $resc) {
                                                                    ?>

                                                                        <option selected disabled value="">Choose City...</option>
                                                                        <option value="<?= $resc['city'] ?>"><?= $resc['city'] ?></option>
                                                                    <?php } ?>
                                                                </datalist>
                                                                <div class="invalid-feedback" id="partycitym">
                                                                    Please provide a valid City.
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="validationCustom05" class="form-label">Zip</label>
                                                                <input type="number" class="form-control" name="partyzip" id="partyzip" required>
                                                                <div class="invalid-feedback" id="partyzipm">
                                                                    Please provide a valid zip.
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3" id="validationCustom05">
                                                                <label for="validationCustom05" class="form-label">Destination</label>
                                                                <div class="col-md-12">
                                                                    <input list="destinates" class="form-control" name="destination" id="destination">
                                                                    <datalist id="destinates">
                                                                        <option value="Delhi">Delhi</option>
                                                                        <option value="Agra">Agra</option>
                                                                        <option value="Kaura">Kaura</option>
                                                                        <option value="Kanpur">Kanpur</option>
                                                                    </datalist>
                                                                </div>
                                                                <div class="invalid-feedback" id="destinationm">
                                                                    Please provide a valid Destination.
                                                                </div>
                                                            </div><!--end row-->



                                                            <div class="col-12 text-center">
                                                                <button class="btn btn-primary" type="submit" name="createparty" id="createparty">Create Party</button>
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
                                                <th>Address</th>
                                                <th data-type="date" data-format="YYYY/DD/MM">Date</th>
                                                <th>Air - Rs</th>
                                                <th>Train - Rs</th>
                                                <th>City</th>
                                                <th>Destination</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($roles == "Super Admin" && $types == "") {
                                                $sqlparty = "select * from partyset";
                                                $exeparty = $con->prepare($sqlparty);
                                                $exeparty->execute();
                                                $resultparty = $exeparty->fetchAll(PDO::FETCH_ASSOC);
                                            } else if ($roles == "Admin" && $types == "Air") {
                                                $sqlparty = "select * from party where bookmode=:bookmode";
                                                $exeparty = $con->prepare($sqlparty);
                                                $data = [':bookmode' => $types];
                                                $exeparty->execute($data);
                                                $resultparty = $exeparty->fetchAll(PDO::FETCH_ASSOC);
                                            } else if ($roles == "Admin" && $types == "Train") {
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
                                                    <td><?= $party['partyaddress'] ?></td>
                                                    <td><?= $party['creationdate'] ?></td>
                                                    <?php
                                                    $bmode = explode(",", $party['bookmode']);
                                                    foreach ($bmode as $air) {
                                                        if ($air == "Air") {
                                                    ?>
                                                            <td><?= "Air - " . $party['airprice']; ?> </td>
                                                        <?php } else {
                                                        ?> <td>-</td>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    $bmodes = explode(",", $party['bookmode']);
                                                    foreach ($bmodes as $train) {
                                                        if ($train == "Train") {
                                                    ?>
                                                            <td><?= "Train - " . $party['trainprice']; ?> </td>
                                                        <?php } else {
                                                        ?> <td>-</td>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <td><?= $party['city'] ?></td>
                                                    <td><?= $party['destinate'] ?></td>
                                                    <td> <button type="button" class="btn btn-primary btn-sm edit_party" data-bs-toggle="modal" data-bs-target="#editparty" ids="<?= $party['id'] ?>">
                                                            <i class="fa fa-pen"></i>
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="">
                                                            <!-- <input type="submit" class="btn btn-danger btn-sm userdeletion" name="userdeletion" id="userdeletion" value="Delete"> -->
                                                            <button type="submit" class="btn btn-danger btn-sm partydeletion" name="partydeletion" ids="<?= $party['id'] ?>" id="partydeletion">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <!-- <button type="button" class="btn btn-sm btn-de-primary csv">Export CSV</button>
                                    <button type="button" class="btn btn-sm btn-de-primary sql">Export SQL</button>
                                    <button type="button" class="btn btn-sm btn-de-primary txt">Export TXT</button>
                                    <button type="button" class="btn btn-sm btn-de-primary json">Export JSON</button> -->
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
                                    <form class="row g-3 needs-validation" method="POST" novalidate>
                                        <input type="hidden" name="edpartyid" id="edpartyid" />
                                        <input type="hidden" id="partyidss" name="partyidss" />
                                        <div class="col-md-4">
                                            <label for="validationCustom01" class="form-label">Date</label>
                                            <input type="date" value="<?= $dates ?>" class="form-control" id="edcreationdate" name="edcreationdate" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid Date.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationCustom01" class="form-label">Party Name</label>
                                            <input list="edparties" class="form-control" name="edpartyname" id="edpartyname">
                                            <datalist id="edparties">
                                                <?php
                                                $sqlstate = "select * from party";
                                                $exestate = $con->prepare($sqlstate);
                                                $exestate->execute();
                                                $result = $exestate->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($result as $res) {
                                                ?>

                                                    <option selected disabled value="">Choose State...</option>
                                                    <option data-value="<?= $res['id'] ?>" value="<?= $res['partyname'] ?>"><?= $res['partyname'] ?></option>
                                                <?php } ?>
                                            </datalist>

                                            <div class="invalid-feedback" id="edpartynamem">
                                                Please provide a valid Party Name.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationCustom03" class="form-label">Route</label>
                                            <input list="edroutes" class="form-control" name="edroute" id="edroute">

                                            <datalist id="edroutes">
                                                <option selected disabled value="">Choose Route</option>
                                                <option value="Vaniyambadi">Vaniyambadi</option>
                                                <option value="CHENNAI">CHENNAI</option>
                                                <option value="RANIPET">RANIPET</option>
                                                <option value="AMBUR">AMBUR</option>
                                                <option value="Other Place">Other Place</option>
                                            </datalist>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="validationCustom03" class="form-label">Book Mode</label>
                                            <input list="edbookmodes" class="form-control" name="edbookmode" id="edbookmode">

                                            <datalist id="edbookmodes">
                                                <option selected disabled value="">Choose Type</option>
                                                <option value="Air">Air</option>
                                                <option value="Train">Train</option>

                                            </datalist>
                                        </div>


                                        <div class="col-md-3" id="edairprices">
                                            <label for="validationCustom03" class="form-label">Air Rate</label>
                                            <input type="number" class="form-control " name="edairprice" id="edairprice" readonly required>
                                            <div class="invalid-feedback" id="edpartyairpricem">
                                                Please provide a valid Air Rate
                                            </div>
                                        </div>

                                        <div class="col-md-3" id="edtrainprices">
                                            <label for="validationCustom03" class="form-label">Trian Rate</label>
                                            <input type="number" class="form-control " name="edtrainprice" id="edtrainprice" readonly required>
                                            <div class="invalid-feedback" id="edpartytrainpricem">
                                                Please provide a valid Trian Rate
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="validationCustom03" class="form-label">GST Number</label>
                                            <input type="text" class="form-control" name="edgst" id="edgst" required>
                                            <div class="invalid-feedback" id="edpartygstm">
                                                Please provide a valid GST
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="validationCustom03" class="form-label">Mobile</label>
                                            <input type="number" class="form-control" id="edpartymobile" name="edpartymobile" required>
                                            <div class="invalid-feedback" id="edpartymobilem">
                                                Please provide a valid Mobile.
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="validationCustom02" class="form-label">Address</label>
                                            <!-- <input type="text" class="form-control" id="validationCustom02"  required> -->
                                            <textarea name="edpartyaddress" id="edpartyaddress" class="form-control"></textarea>
                                            <div class="invalid-feedback" id="edpartyaddressm">
                                                Please provide a valid Address.
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="validationCustom04" class="form-label">State</label>
                                            <input list="states" class="form-control" name="edstate" id="edstate">

                                            <datalist id="states">
                                                <?php
                                                $sqlstate = "select * from states";
                                                $exestate = $con->prepare($sqlstate);
                                                $exestate->execute();
                                                $result = $exestate->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($result as $res) {
                                                ?>

                                                    <option selected disabled value="">Choose State...</option>
                                                    <option value="<?= $res['name'] ?>"><?= $res['name'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                            <div class="invalid-feedback" id="edpartystatem">
                                                Please provide a valid State.
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="validationCustom04" class="form-label">City</label>
                                            <input list="cities" class="form-control" name="edcity" id="edcity">

                                            <datalist id="cities">
                                                <?php
                                                $sqlcity = "select * from cities";
                                                $execity = $con->prepare($sqlcity);
                                                $execity->execute();
                                                $rescity = $execity->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($rescity as $resc) {
                                                ?>

                                                    <option selected disabled value="">Choose City...</option>
                                                    <option value="<?= $resc['city'] ?>"><?= $resc['city'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                            <div class="invalid-feedback" id="edpartycitym">
                                                Please provide a valid City.
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="validationCustom05" class="form-label">Zip</label>
                                            <input type="number" class="form-control" name="edpartyzip" id="edpartyzip" required>
                                            <div class="invalid-feedback" id="edpartyzipm">
                                                Please provide a valid zip.
                                            </div>
                                        </div>


                                        <div class="col-md-3" id="validationCustom05">
                                            <label for="validationCustom05">Destination</label>
                                            <div class="col-md-12">
                                                <input list="eddestinates" class="form-control" name="ed_destination" id="ed_destination">

                                                <datalist id="eddestinates">
                                                    <option value="Delhi">Delhi</option>
                                                    <option value="Agra">Agra</option>
                                                    <option value="Kaura">Kaura</option>
                                                    <option value="Kanpur">Kanpur</option>
                                                </datalist>
                                            </div>
                                            <div class="invalid-feedback" id="edpartydestinationm">
                                                Please provide a valid Destination
                                            </div>
                                        </div><!--end row-->



                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary" type="submit" name="party_updation" id="party_updation">Update Party</button>
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

            <script src="assets/pages/form-validation.js"></script>
            <!-- App js -->
            <script src="assets/js/app.js"></script>
            <script src="assets/plugins/datatables/simple-datatables.js"></script>
            <script src="assets/pages/datatable.init.js"></script>
            <script>
                $(document).ready(function() {
                    $("#airprices").hide();
                    $("#trainprices").hide();

                    $('#bookmode').change(function(e) {
                        e.preventDefault();
                        var value = $('#partyname').val();
                        var partyid = $('#parties [value="' + value + '"]').data('value');
                        var route = $('#route').val();
                        bookmode = $('#bookmode').val();

                        if (partyid != '' && route != '') {
                            $.ajax({
                                url: 'ajax/ajax_request.php?action=partydetfetch',
                                type: 'POST',
                                dataType: "JSON",
                                data: {
                                    'action': "partydetfetch",
                                    'id': partyid,
                                    'route': route,
                                    'bookmode': bookmode
                                },
                                success: function(response) {
                                    $("#partyids").val(response.data.id);
                                    $("#partymobile").val(response.data.partymobile);
                                    $("#gst").val(response.data.gst);
                                    $("#trainprice").val(response.data.trainprice);
                                    $("#airprice").val(response.data.airprice);
                                    $("#ed_bookmode").val(response.data.bookmode);
                                    var booksmode = $("#ed_bookmode").val();

                                    if (booksmode == "Train") {
                                        $('#train').prop('checked', true);
                                        $("#trainprices").show();
                                        $('#air').prop('checked', false);
                                        $("#airprices").hide();
                                    } else if (booksmode == "Air") {
                                        $('#train').prop('checked', false);
                                        $("#trainprices").hide();
                                        $('#air').prop('checked', true);
                                        $("#airprices").show();
                                    }
                                }
                            });
                        }
                    });

                    $('#edpartyname').change(function(e) {
                        $('#edroute').val('');
                        $('#edbookmode').val('');
                        $('#edairprice').val('');
                        $('#edtrainprice').val('');
                        $('#edgst').val('');
                        $('#edpartymobile').val('');
                        });

                    $('#edbookmode').change(function(e) {
                        e.preventDefault();
                        var value = $('#edpartyname').val();
                        var partyid = $('#edparties [value="' + value + '"]').data('value');
                        var route = $('#edroute').val();
                        bookmode = $('#edbookmode').val();

                        if (partyid != '' && route != '') {
                            $.ajax({
                                url: 'ajax/ajax_request.php?action=partydetfetch',
                                type: 'POST',
                                dataType: "JSON",
                                data: {
                                    'action': "partydetfetch",
                                    'id': partyid,
                                    'route': route,
                                    'bookmode': bookmode
                                },
                                success: function(response) {
                                    $("#edcreationdate").val(response.data.creationdate);
                                    $("#partyids").val(response.data.id);
                                    $("#edpartymobile").val(response.data.partymobile);
                                    $("#edgst").val(response.data.gst);
                                    $("#edtrainprice").val(response.data.trainprice);
                                    $("#edairprice").val(response.data.airprice);
                                    $("#edbookmode").val(response.data.bookmode);
                                    var booksmode = $("#edbookmode").val();

                                    if (booksmode == "Train") {
                                        $("#edtrainprices").show();
                                        $("#edairprices").hide();
                                    } else if (booksmode == "Air") {
                                        $("#edtrainprices").hide();
                                        $("#edairprices").show();
                                    }
                                }
                            });
                        }
                    });



                    $("#createparty").click(function(e) {
                        e.preventDefault();
                        var creationdate = $('#creationdate').val();
                        var partyids = $('#partyids').val();
                        var partyname = $('#partyname').val();
                        var partymobile = $('#partymobile').val();
                        var partyaddress = $('#partyaddress').val();
                        var state = $('#state').val();
                        var city = $('#city').val();
                        var partyzip = $('#partyzip').val();
                        var route = $('#route').val();
                        var book_mode = $("#bookmode").val();
                        if (book_mode == "Air") {
                            $('#trainprice').val(0);
                            var trainprice = $('#trainprice').val();
                            var airprice = $('#airprice').val();
                        } else if (book_mode == "Train") {
                            $('#airprice').val(0);
                            var trainprice = $('#trainprice').val();
                            var airprice = $('#airprice').val();
                        }

                        var destination = $("#destination").val();

                        var gst = $('#gst').val();


                        $.ajax({
                            url: 'ajax/ajax_request.php?action=partycreation',
                            type: 'POST',
                            dataType: "JSON",
                            data: {
                                'action': "partycreation",
                                'creationdate': creationdate,
                                'partyids': partyids,
                                'partyname': partyname,
                                'partymobile': partymobile,
                                'partyaddress': partyaddress,
                                'state': state,
                                'city': city,
                                'partyzip': partyzip,
                                'bookmode': book_mode,
                                'trainprice': trainprice,
                                'airprice': airprice,
                                'gst': gst,
                                'destinate': destination,
                                'route': route
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
                                        window.location.href = 'partysetup.php';
                                    })
                                } else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'Party Create Failed',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(function() {
                                        window.location.href = 'partysetup.php';
                                    })
                                }
                            }
                        });
                    });

                    $(".edit_party").click(function(e) {
                        e.preventDefault();
                        var partyid = $(this).attr("ids");
                        // alert(partyid)
                        $("#edpartyid").val(partyid);
                        $.ajax({
                            url: 'ajax/ajax_request.php?action=partydetsfetch',
                            type: 'POST',
                            dataType: "JSON",
                            data: {
                                'action': "partydetsfetch",
                                'id': partyid
                            },
                            success: function(response) {
                                $("#edcreationdate").val(response.data.creationdate);
                                $("#edpartyname").val(response.data.partyname);
                                $("#edpartymobile").val(response.data.partymobile);
                                $("#edstate").val(response.data.state);
                                $("#edcity").val(response.data.city);
                                $("#edpartyzip").val(response.data.partyzip);
                                $("#edpartyaddress").val(response.data.partyaddress);
                                $("#edroute").val(response.data.route);
                                $("#edbookmode").val(response.data.bookmode);
                                $("#edairprice").val(response.data.airprice);
                                $("#edtrainprice").val(response.data.trainprice);
                                $("#edpartyaddress").val(response.data.partyaddress);
                                $("#edgst").val(response.data.gst);
                                $("#partyidss").val(response.data.partyid);
                                var booksmode = $("#edbookmode").val();

                                if (booksmode == "Train") {
                                    $('#edtrain').prop('checked', true);
                                    $("#edtrainprices").show();
                                    $('#edair').prop('checked', false);
                                    $("#edairprices").hide();
                                } else {
                                    $('#edtrain').prop('checked', false);
                                    $("#edtrainprices").hide();
                                    $('#edair').prop('checked', true);
                                    $("#edairprices").show();
                                }

                                $("#edairprice").val(response.data.airprice);
                                $("#edtrainprice").val(response.data.trainprice);
                                $("#edgst").val(response.data.gst);
                                $("#ed_destination").val(response.data.destinate);
                            }
                        });
                    });

                    $("#party_updation").click(function(e) {
                        e.preventDefault();
                        var ids = $('#edpartyid').val();
                        var creationdate = $("#edcreationdate").val();
                        var partyname = $("#edpartyname").val();
                        var route = $("#edroute").val();
                        var bookmode = $("#edbookmode").val();
                        var partymobile = $("#edpartymobile").val();
                        var airprice = $("#edairprice").val();
                         var state = $("#edstate").val();
                        var city = $("#edcity").val();
                        var partyzip = $("#edpartyzip").val();
                        var partyaddress = $("#edpartyaddress").val();
                        var trainprice = $("#edtrainprice").val();
                        var gst = $("#edgst").val();
                        var destination = $("#ed_destination").val();

                        if (creationdate != "" && partyname != "" && partymobile != '' && state != '' && city != '' && partyzip != '' && partyaddress != '' && (airprice != '' || trainprice != '') && gst != '' && destination != '') {
                            $.ajax({
                                url: 'ajax/ajax_request.php?action=partyupdation',
                                type: 'POST',
                                dataType: "JSON",
                                data: {
                                    'action': "partyupdation",
                                    'ids': ids,
                                    'creationdate': creationdate,
                                    'partyname': partyname,
                                    'route': route,
                                    'bookmode': bookmode,
                                    'partyaddress': partyaddress,
                                    'partymobile': partymobile,
                                    'state': state,
                                    'city': city,
                                    'zip': partyzip,
                                    'airprice': airprice,
                                    'trainprice': trainprice,
                                    'gst': gst,
                                    'route': route,
                                    'destination': destination

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
                                            window.location.href = 'partysetup.php';
                                        })
                                    } else {
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'error',
                                            title: 'Party Update Failed',
                                            showConfirmButton: false,
                                            timer: 3000
                                        }).then(function() {
                                            window.location.href = 'partysetup.php';
                                        })
                                    }
                                }
                            });
                        }

                    });

                    $(".partydeletion").click(function(e) {
                        e.preventDefault();
                        var partydid = $(this).attr('ids');
                        //    alert(partydid)
                        $.ajax({
                            url: 'ajax/ajax_request.php?action=partysetdeletion',
                            type: 'POST',
                            dataType: "JSON",
                            data: {
                                'action': "partysetdeletion",
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
                                        window.location.href = 'partysetup.php';
                                    })
                                } else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'Party Delete Failed',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(function() {
                                        window.location.href = 'partysetup.php';
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