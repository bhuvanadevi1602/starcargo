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
                <button type="button" class="btn btn-danger btn-sm edit_mno mr-3" data-bs-toggle="modal" data-bs-target="#editmno" style="float:right">
                  M.No Updation
                </button>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalLarge" style="float:right">
                  Add Booking
                </button>
                <div class="row col-md-12">
                  <div class="col-md-3 text-center">
                    <?php
                    $fromdate = isset($_POST['fromdate']) ? $_POST['fromdate'] : "-";
                    $todate = isset($_POST['todate']) ? $_POST['todate'] : "-";
                    $partytypes = isset($_POST['partytypes']) ? $_POST['partytypes'] : "-";


                    $pname = $_POST['partynamess'];
                    $query1 = "select * from party where partyname=:pname";
                    $exe = $con->prepare($query1);
                    $data = [':pname' => $pname];
                    $exe->execute($data);
                    $result = $exe->fetch(PDO::FETCH_ASSOC);

                    $pid = $_POST['pid'];
                    $partynames = isset($result['partyname']) ? $result['partyname'] : "-";
                    ?>
                    <h5>From Date : <?= $fromdate ?></h5>
                  </div>
                  <div class="col-md-3 text-center">
                    <h5>To Date : <?= $todate ?></h5>
                  </div>
                  <div class="col-md-3 text-center">
                    <h5>Type : <?= $partytypes ?></h5>
                  </div>
                  <div class="col-md-3 text-center">
                    <h5>Party Name : <?= $partynames ?></h5>
                  </div>
                </div>
                <form method="POST" autocomplete="off">
                  <div class="row col-md-12 mt-4">
                    <div class="col-md-2">
                      <input type="date" name="fromdate" to="fromdate" class="form-control" />
                    </div>
                    <div class="col-md-2">
                      <input type="date" name="todate" to="todate" class="form-control" />
                    </div>
                    <div class="col-md-2">
                      <?php if ($types == "Air" || $types == "Train" || $types == "Delivery Air" || $types == "Delivery Train") { ?>
                        <input list="partytypess" class="form-control" name="partytypes" id="partytypes" value="<?= $types ?>">
                        <datalist id="partytypess">
                          <option selected disabled value="">Choose Type...</option>
                          <option value="Air">Air</option>
                          <option value="Train">Train</option>
                        </datalist>
                      <?php } else { ?>
                        <input list="partytypess" class="form-control" name="partytypes" id="partytypes">
                        <datalist id="partytypess">
                          <option selected disabled value="">Choose Type...</option>
                          <option value="Air">Air</option>
                          <option value="Train">Train</option>
                        </datalist>
                      <?php } ?>
                    </div>

                    <div class="col-md-2">
                      <input list="partiess" class="form-control" name="partynamess" id="partynamess">
                      <datalist id="partiess">
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
                    </div>

                    <div class="col-md-2">
                      <input type="hidden" name="pid" id="pid" class="btn btn-sm btn-de-primary csv p-2" value="" />
                      <input type="submit" name="search" id="search" class="btn btn-sm btn-de-primary csv p-2" value="Search" />
                      <?php
                      if ($partytypes == "Air") {
                      ?>
                        <a href="exportair.php?export&fromdate=<?= $fromdate ?>&todate=<?= $todate ?>&type=<?= $partytypes ?>&partyname=<?= $pid ?>" class="btn btn-sm btn-de-primary csv p-2" target="_blank">Export CSV</a>
                        <a href="exportsair.php?export&fromdate=<?= $fromdate ?>&todate=<?= $todate ?>&type=<?= $partytypes ?>&partyname=<?= $pid ?>" class="btn btn-sm btn-de-primary csv p-2" target="_blank">Print</a>
                       <?php } else if ($partytypes == "Train") { ?>
                        <a href="exporttrain.php?export&fromdate=<?= $fromdate ?>&todate=<?= $todate ?>&type=<?= $partytypes ?>&partyname=<?= $pid ?>" class="btn btn-sm btn-de-primary csv p-2" target="_blank">Export CSV</a>
                        <a href="exportstrain.php?export&fromdate=<?= $fromdate ?>&todate=<?= $todate ?>&type=<?= $partytypes ?>&partyname=<?= $pid ?>" class="btn btn-sm btn-de-primary csv p-2" target="_blank">Print</a>
                      <?php } else { ?>
                        <a href="#" class="btn btn-sm btn-de-primary csv p-2">Export CSV</a>
                      
                      <?php } ?>
                    </div>

                  </div>
                </form>
                <!--Start modal-header-->
                <div class="modal fade bd-example-modal-xl" id="exampleModalLarge" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title m-0" id="myLargeModalLabel">Booking</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div><!--end modal-header-->
                      <div class="modal-body">
                        <div class="row">


                          <div class="card-header">
                            <h4 class="card-title" style="color:#22b783;">Booking Details</h4>
                          </div><!--end card-header-->


                          <div class="card-body">
                            <form class="row g-3 needs-validation" novalidate method="POST" autocomplete="off">

                              <div class="col-md-2">
                                <label for="validationCustom01" class="form-label">Date</label>
                                <input type="date" class="form-control" id="creationdate" name="creationdate" value="<?= $dates ?>" required>
                                <div class="invalid-feedback">
                                  Please provide a valid Date.
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="validationCustom01" class="form-label">Running Date</label>
                                <input type="date" class="form-control" id="runcreationdate" name="runcreationdate" value="<?= $dates ?>" required>
                                <div class="invalid-feedback">
                                  Please provide a valid Date.
                                </div>
                              </div>
                              <div class="col-md-3">
                                <label for="validationCustom01" class="form-label">Party Name</label>
                                <input list="edparties" class="form-control" name="partyname" id="partyname">
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

                              <div class="col-md-2">
                                <label for="validationCustom02" class="form-label">Type</label>
                                <input list="type_s" class="form-control" name="types" id="types">
                                <datalist id="type_s">
                                  <option value="" disabled>Select Types</option>
                                  <option value="Air">Air</option>
                                  <option value="Train">Train</option>
                                  </select>
                                  <div class="invalid-feedback" id="booktypes">
                                    Please provide a valid types.
                                  </div>
                              </div>

                              <div class="col-md-3">
                                <label for="validationCustom03" class="form-label">Route</label>
                                <input list="edroutes" class="form-control" name="route" id="route">

                                <datalist id="edroutes">
                                  <option selected disabled value="">Choose Route</option>
                                  <option value="Vaniyambadi">Vaniyambadi</option>
                                  <option value="CHENNAI">CHENNAI</option>
                                  <option value="RANIPET">RANIPET</option>
                                  <option value="AMBUR">AMBUR</option>
                                  <option value="Other Place">Other Place</option>
                                </datalist>
                              </div>
                              <!-- <div class="col-md-3">
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
                                <div class="invalid-feedback">
                                  Please select a valid state.
                                </div>
                              </div> -->

                              <div class="col-md-3">
                                <label for="validationCustom01" class="form-label">Orgin</label>
                                <input list="origins" class="form-control" name="origin" id="origin">
                                <datalist id="origins">
                                  <?php
                                  $sqlcity = "select * from partyset group by city"; //cities
                                  $execity = $con->prepare($sqlcity);
                                  $execity->execute();
                                  $rescity = $execity->fetchAll(PDO::FETCH_ASSOC);
                                  foreach ($rescity as $resc) {
                                  ?>

                                    <option selected disabled value="">Choose City...</option>
                                    <option value="<?= $resc['city'] ?>"><?= $resc['city'] ?></option>
                                  <?php } ?>
                                </datalist>

                                <div class="invalid-feedback" id="bookorigin">
                                  Please provide a valid Orgin.
                                </div>
                              </div>

                              <div class="col-md-3">
                                <label for="validationCustom02" class="form-label">Destination</label>
                                <input list="destinations" class="form-control" name="destination" id="destination">
                                <datalist id="destinations">
                                  <?php
                                  $sqlcity = "select * from partyset group by destinate"; //cities
                                  $execity = $con->prepare($sqlcity);
                                  $execity->execute();
                                  $rescity = $execity->fetchAll(PDO::FETCH_ASSOC);
                                  foreach ($rescity as $resc) {
                                  ?>

                                    <option selected disabled value="">Choose City...</option>
                                    <option value="<?= $resc['destinate'] ?>"><?= $resc['destinate'] ?></option>
                                  <?php } ?>
                                </datalist>
                                <div class="invalid-feedback" id="bookdestination">
                                  Please provide a valid Destination.
                                </div>
                              </div>
                              <div class="col-md-3">
                                <label for="validationCustom03" class="form-label">From</label>
                                <input type="text" class="form-control" id="coraddress" name="coraddress" required>
                                <div class="invalid-feedback" id="bookfromaddress">
                                  Please provide a consignor address.
                                </div>
                              </div>
                              <!-- <div class="col-md-3">
                                <label for="validationCustom04" class="form-label">State</label>
                                <input list="corsstate" class="form-control" name="corstate" id="corstate">

                                <datalist id="corsstate">
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
                                <div class="invalid-feedback">
                                  Please select a valid state.
                                </div>
                              </div> -->
                              <!-- <div class="col-md-3">
                                <label for="validationCustom05" class="form-label">Zip</label>
                                <input type="number" class="form-control" id="corzip" name="corzip" required>
                                <div class="invalid-feedback">
                                  Please provide a valid zip.
                                </div>
                              </div> -->



                              <div class="col-md-3">
                                <label for="validationCustom03" class="form-label">To</label>
                                <input type="text" class="form-control" id="conaddress" name="conaddress" required>
                                <div class="invalid-feedback" id="booktoaddress">
                                  Please provide a valid consignee address.
                                </div>
                              </div>





                              <div class="col-md-3">
                                <label for="validationCustom03" class="form-label">POD No</label>
                                <input type="text" class="form-control" id="pod" name="pod" required>
                                <div class="invalid-feedback" id="podsuc">
                                  Already Taken POD., Please Change
                                </div>
                              </div>


                              <!-- <div class="col-md-3">
                                <label for="validationCustom04" class="form-label">State</label>
                                <input list="consstate" class="form-control" name="constate" id="constate">

                                <datalist id="consstate">
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
                                <div class="invalid-feedback">
                                  Please select a valid state.
                                </div>
                              </div> -->
                              <!-- <div class="col-md-3">
                                <label for="validationCustom05" class="form-label">Zip</label>
                                <input type="number" class="form-control" id="conzip" name="conzip" required>
                                <div class="invalid-feedback">
                                  Please provide a valid zip.
                                </div>
                              </div> -->

                              <div class="col-md-4">
                                <label for="validationCustom05" class="form-label">Area</label>
                                <textarea class="form-control" id="area" name="area" required></textarea>
                                <div class="invalid-feedback" id="bookarea">
                                  Please provide a valid zip.
                                </div>
                              </div>

                              <div class="col-md-3">
                                <label for="validationCustom03" class="form-label">Train Name</label>
                                <input type="text" class="form-control" id="trainname" name="trainname" required>
                                <div class="invalid-feedback" id="booktoaddress">
                                  Please provide a valid consignee address.
                                </div>
                              </div>

                              <div class="col-md-2" id="validationCustom05">
                                <label for="validationCustom05" class="form-label">Transport</label>
                                <div class="col-md-12 mt-1">
                                  <input list="transports" class="form-control" name="transport" id="transport">
                                  <datalist id="transports">
                                    <option selected disabled value="">Choose Transport</option>
                                    <option value="MAR">MAR</option>
                                    <option value="SAR">SAR</option>
                                    <option value="AMT">AMT</option>
                                    <option value="Others">Others</option>
                                  </datalist>

                                  <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input sample" type="checkbox" id="transport" name="transport" value="MAR">
                                    <label class="form-check-label" for="inlineCheckbox1">MAR</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input sample" type="checkbox" id="transport" name="transport" value="SAR">
                                    <label class="form-check-label" for="inlineCheckbox2">SAR</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input sample" type="checkbox" id="transport" name="transport" value="AMT">
                                    <label class="form-check-label" for="inlineCheckbox3">AMT</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input sample" type="checkbox" id="transport" name="transport" value="Others">
                                    <label class="form-check-label" for="inlineCheckbox4">Others</label>
                                  </div> -->
                                  <div class="invalid-feedback" id="booktransport">
                                    Please provide a valid Transport.
                                  </div>
                                </div>

                              </div><!--end row-->

                              <div class="card-header">
                                <h4 class="card-title" style="color:#ff9f43;">Package Details</h4>
                              </div><!--end card-header-->

                              <div class="col-md-2">
                                <label for="validationCustom04" class="form-label">Types of packing</label>
                                <!-- <select class="form-select" id="validationCustom04" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option>...</option>
                                      </select> -->
                                <input class="form-control" list="pack" name="packs" id="packs">

                                <datalist id="pack">
                                  <option>G/B</option>
                                  <option>P/B</option>
                                  <option>Box</option>
                                </datalist>
                                <div class="invalid-feedback" id="bookpack">
                                  Please select a valid Packing.
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="validationCustom03" class="form-label">Party Invice No</label>
                                <input type="text" class="form-control" id="invoiceno" name="invoiceno" required>
                                <div class="invalid-feedback" id="bookinvno">
                                  Please provide a valid Party Invice No.
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="validationCustom05" class="form-label">Said to Content</label>
                                <input type="text" class="form-control" id="describe" name="describe">
                                <div class="invalid-feedback" id="bookdescribe">
                                  Please provide a valid Said to Content.
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="validationCustom05" class="form-label">Quantity</label>
                                <input type="text" class="form-control" id="quantity" name="quantity" required>
                                <div class="invalid-feedback" id="bookquantity">
                                  Please provide a valid Quantity.
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="validationCustom05" class="form-label">Gross Weight</label>
                                <input type="text" class="form-control" id="gross" name="gross" required>
                                <div class="invalid-feedback" id="bookgross">
                                  Please provide a valid Gross Weight.
                                </div>
                              </div>

                              <div class="col-md-2">
                                <label for="validationCustom05" class="form-label">Doc Charge</label>
                                <input type="text" class="form-control" id="docs" name="docs" required value="50">
                                <div class="invalid-feedback" id="bookdocs">
                                  Please provide a valid Rate.
                                </div>
                              </div>

                              <div class="col-md-2" id="weights1">
                                <label for="validationCustom05" class="form-label">Charged Weight (1&lt30) </label>
                                <input type="text" class="form-control" id="weight" name="weight" required>
                                <div class="invalid-feedback" id="bookweight">
                                  Please provide a valid Charged Weight.
                                </div>
                              </div>

                              <div class="col-md-2" id="rates1">
                                <label for="validationCustom05" class="form-label">Rate</label>
                                <input type="text" class="form-control" id="rate" name="rate" required>
                                <div class="invalid-feedback" id="bookrate">
                                  Please provide a valid Rate.
                                </div>
                              </div>

                              <div class="col-md-2" id="weight30">
                                <label for="validationCustom05" class="form-label">Charged Weight (31&lt50)</label>
                                <input type="text" class="form-control" id="weight1" name="weight1" required>
                                <div class="invalid-feedback" id="bookweight">
                                  Please provide a valid Charged Weight.
                                </div>
                              </div>

                              <div class="col-md-2" id="rate30">
                                <label for="validationCustom05" class="form-label">Rate</label>
                                <input type="text" class="form-control" id="rate1" name="rate1" required>
                                <div class="invalid-feedback" id="bookrate">
                                  Please provide a valid Rate.
                                </div>
                              </div>

                              <div class="col-md-2" id="weight50">
                                <label for="validationCustom05" class="form-label">Charged Weight (&gt50)</label>
                                <input type="text" class="form-control" id="weight2" name="weight2" required>
                                <div class="invalid-feedback" id="bookweight">
                                  Please provide a valid Charged Weight.
                                </div>
                              </div>

                              <div class="col-md-2" id="rate50">
                                <label for="validationCustom05" class="form-label">Rate</label>
                                <input type="text" class="form-control" id="rate2" name="rate2" required>
                                <div class="invalid-feedback" id="bookrate">
                                  Please provide a valid Rate.
                                </div>
                              </div>

                              <div class="col-md-2">
                              </div>

                              <div class="col-md-3" style="text-align:center;">
                                <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">Amount</label>
                                <div class="col-sm-12">
                                  <input class="form-control" type="text" name="amount" id="amount">
                                  <!-- placeholder="0.00" style="text-align:center;font-weight: 800;font-size: 2.5rem;"  form-control-lg-->
                                </div>
                                <div class="invalid-feedback" id="bookamount">
                                  Please provide a valid Rate.
                                </div>
                              </div>

                              <div class="col-md-3" style="text-align:center;">
                                <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">Other Charges</label>
                                <div class="col-sm-12">
                                  <input class="form-control" type="text" name="otherchg" id="otherchg">
                                  <!-- placeholder="0.00" style="text-align:center;font-weight: 800;font-size: 2.5rem;"  form-control-lg-->
                                </div>
                                <div class="invalid-feedback" id="bookamount">
                                  Please provide a valid Rate.
                                </div>
                              </div>

                              <!-- <div class="col-md-2">
                                <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">GST Amount</label>
                                <div class="col-sm-12">
                                  <input type="text" name="gsts" id="gsts" value="5" class="form-control">
                                </div>
                                <div class="invalid-feedback" id="bookgst">
                                  Please provide a valid Rate.
                                </div>
                              </div> -->

                              <div class="col-md-2">
                                <label for="validationCustom04" class="form-label">Payment Type</label>
                                <select class="form-select" id="paymentmode" name="paymentmode" required style="position: relative;top:5px!important">
                                  <option selected disabled value="">Choose...</option>
                                  <option value="Bill">Bill</option>
                                  <option value="Cash">Cash</option>
                                  <option value="To Pay">To Pay</option>
                                </select>
                                <div class="invalid-feedback" id="bookpayment">
                                  Please select a valid Packing.
                                </div>
                              </div>



                              <div class="col-md-3"></div>
                              <div class="col-md-2">
                                <label for="validationCustom02" class="form-label">GST Type</label>
                                <input list="gsttypes" class="form-control" name="gst_types" id="gst_types">
                                <datalist id="gsttypes">
                                  <option value="" disabled>Select Types</option>
                                  <option value="State">State</option>
                                  <option value="Interstate">Interstate</option>
                                </datalist>
                                <div class="invalid-feedback" id="edtype_s">
                                  Please provide a valid types.
                                </div>
                              </div>

                              <div class="col-md-2" id="states">
                                <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">IGST Amount (%)</label>
                                <div class="col-sm-12">
                                  <input type="text" name="igstamt" id="igstamt" value="5" class="form-control">
                                </div>
                                <div class="invalid-feedback" id="igsts">
                                  Please provide a valid GST.
                                </div>
                              </div>

                              <div class="col-md-2" id="cgst">
                                <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">CGST Amount (%)</label>
                                <div class="col-sm-12">
                                  <input type="text" name="cgstamt" id="cgstamt" value="2.5" class="form-control">
                                </div>
                                <div class="invalid-feedback" id="edgsts">
                                  Please provide a valid GST.
                                </div>
                              </div>

                              <div class="col-md-2" id="sgst">
                                <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">SGST Amount (%)</label>
                                <div class="col-sm-12">
                                  <input type="text" name="sgstamt" id="sgstamt" value="2.5" class="form-control">
                                </div>
                                <div class="invalid-feedback" id="edgsts">
                                  Please provide a valid GST.
                                </div>
                              </div>


                              <!-- <div class="col-md-2" style="text-align:center;position: relative;top:35px !important">
                                <input type="checkbox" name="gst" id="gst" value="GST"><span> GST(<span id="gstp">5%</span>)
                                  <div class="invalid-feedback" id="bookgsts">
                                    Please provide a valid Rate.
                                  </div>
                              </div> -->

                              <div class="row col-md-12">
                                <div class="col-md-4"></div>
                                <div class="col-md-4" style="text-align:center;">
                                  <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">Payment</label>
                                  <input class="form-control form-control-lg" type="text" name="paid" id="paid" placeholder="0.00" style="text-align:center;font-weight: 800;font-size: 2.5rem;">
                                  <div class="invalid-feedback" id="bookpaid">
                                    Please select a valid Packing.
                                  </div>
                                </div>
                              </div>
                              <div class="col-12 text-center">
                                <button class="btn btn-primary" type="submit" name="bookcreation" id="bookcreation">Save Booking</button>
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

                        $sqlbook = "SELECT * from booking where type='$partytypes' and (creationdate>='$fromdate' and creationdate<='$todate') and partyid='$pid'  ORDER BY id ASC";
                        // print_r($sqlbook);die();
                        $exebook = $con->prepare($sqlbook);
                        $exebook->execute();
                        $resultbook = $exebook->fetchAll(PDO::FETCH_ASSOC);
                      } else {
                        if ($types == "Admin") {
                          $sqlbook = "select * from booking";
                          $exebook = $con->prepare($sqlbook);
                          $exebook->execute();
                          $resultbook = $exebook->fetchAll(PDO::FETCH_ASSOC);
                        } else if ($types == "Air" || $types == "Train" || $types == "Delivery Air" || $types == "Delivery Train") {
                          $sqlbook = "select * from booking where type=:types";
                          $exebook = $con->prepare($sqlbook);
                          $data = [':types' => $types];
                          $exebook->execute($data);
                          $resultbook = $exebook->fetchAll(PDO::FETCH_ASSOC);
                        }
                      }

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
                            <td><?= $book['runningdate'] ?></td>
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
                              <button type="button" class="btn btn-primary btn-sm edit_book" data-bs-toggle="modal" data-bs-target="#editbooking" ids="<?= $book['id'] ?>">
                                <i class="fa fa-pen"></i>
                              </button>
                            </td>
                            <?php if($book['proofdoc']!="") { ?>
                                                        <td>
                                                            <button class="btn btn-dark btn-sm upload_image" data-bs-toggle="modal" data-bs-target="#uploadimage" imgids="<?= $book['id'] ?>"><i class="fa fa-image"></i></button>
                                                        </td>
                                                        <?php } ?>
                            <!-- <td>
                              <button type="button" class="btn btn-primary btn-sm edit_mno" data-bs-toggle="modal" data-bs-target="#editmno" idss="<?= $book['id'] ?>">
                                <i class="fa fa-file"></i>
                              </button>
                            </td> -->
                            <td>
                              <form method="POST" action="">
                                <button type="submit" class="btn btn-danger btn-sm bookingdeletion" ids="<?= $book['id'] ?>" name="bookingdeletion" id="bookingdeletion">
                                  <i class="fa fa-trash"></i>
                                </button>
                              </form>
                            </td>
                          </tr>
                        <?php }
                      } else {
                        ?>
                        <tr>
                          <td>No Data Found</td>
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
      <div class="modal fade bd-example-modal-xl" id="editbooking" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title m-0" id="myLargeModalLabel">Booking</h6>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
              <div class="row">


                <div class="card-header">
                  <h4 class="card-title" style="color:#22b783;">Booking Details</h4>
                </div><!--end card-header-->



                <div class="card-body">
                  <input type="hidden" name="role" id="role" value="<?= $types ?>" />
                  <form class="row g-3 needs-validation" novalidate method="POST" autocomplete="off">
                    <input type="hidden" name="ed_bookid" id="ed_bookid" />
                    <div class="col-md-2">
                      <label for="validationCustom01" class="form-label">Date</label>
                      <input type="date" class="form-control" id="edcreationdate" name="edcreationdate" value="<?= $dates ?>" required>
                      <div class="invalid-feedback">
                        Please provide a valid Date.
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="validationCustom01" class="form-label">Date</label>
                      <input type="date" class="form-control" id="edrunningdate" name="edrunningdate" value="<?= $dates ?>" required>
                      <div class="invalid-feedback">
                        Please provide a valid Date.
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationCustom01" class="form-label">Party Name</label>
                      <input list="ed_parties" class="form-control" name="edpartyname" id="edpartyname">
                      <datalist id="ed_parties">
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

                    <div class="col-md-2">
                      <label for="validationCustom02" class="form-label">Type</label>
                      <input list="type_s" class="form-control" name="edtypes" id="edtypes">
                      <datalist id="type_s">
                        <option value="" disabled>Select Types</option>
                        <option value="Air">Air</option>
                        <option value="Train">Train</option>
                        </select>
                        <div class="invalid-feedback" id="booktypes">
                          Please provide a valid types.
                        </div>
                    </div>

                    <div class="col-md-3">
                      <label for="validationCustom03" class="form-label">Route</label>
                      <input list="e_droutes" class="form-control" name="edroute" id="edroute">

                      <datalist id="e_droutes">
                        <option selected disabled value="">Choose Route</option>
                        <option value="Vaniyambadi">Vaniyambadi</option>
                        <option value="CHENNAI">CHENNAI</option>
                        <option value="RANIPET">RANIPET</option>
                        <option value="AMBUR">AMBUR</option>
                        <option value="Other Place">Other Place</option>
                      </datalist>
                    </div>
                    <!-- <div class="col-md-3">
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
                                <div class="invalid-feedback">
                                  Please select a valid state.
                                </div>
                              </div> -->

                    <div class="col-md-3">
                      <label for="validationCustom01" class="form-label">Orgin</label>
                      <input list="origins" class="form-control" name="edorigin" id="edorigin">
                      <datalist id="origins">
                        <?php
                        $sqlcity = "select * from partyset group by city"; //cities
                        $execity = $con->prepare($sqlcity);
                        $execity->execute();
                        $rescity = $execity->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rescity as $resc) {
                        ?>

                          <option selected disabled value="">Choose City...</option>
                          <option value="<?= $resc['city'] ?>"><?= $resc['city'] ?></option>
                        <?php } ?>
                      </datalist>

                      <div class="invalid-feedback" id="bookorigin">
                        Please provide a valid Orgin.
                      </div>
                    </div>

                    <div class="col-md-3">
                      <label for="validationCustom02" class="form-label">Destination</label>
                      <input list="destination_s" class="form-control" name="eddestination" id="eddestination">
                      <datalist id="destination_s">
                        <?php
                        $sqlcity = "select * from partyset group by destinate"; //cities
                        $execity = $con->prepare($sqlcity);
                        $execity->execute();
                        $rescity = $execity->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rescity as $resc) {
                        ?>

                          <option selected disabled value="">Choose City...</option>
                          <option value="<?= $resc['destinate'] ?>"><?= $resc['destinate'] ?></option>
                        <?php } ?>
                      </datalist>
                      <div class="invalid-feedback" id="bookdestination">
                        Please provide a valid Destination.
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationCustom03" class="form-label">From</label>
                      <input type="text" class="form-control" id="edcoraddress" name="edcoraddress" required>
                      <div class="invalid-feedback" id="bookfromaddress">
                        Please provide a consignor address.
                      </div>
                    </div>
                    <!-- <div class="col-md-3">
                                <label for="validationCustom04" class="form-label">State</label>
                                <input list="corsstate" class="form-control" name="corstate" id="corstate">

                                <datalist id="corsstate">
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
                                <div class="invalid-feedback">
                                  Please select a valid state.
                                </div>
                              </div> -->
                    <!-- <div class="col-md-3">
                                <label for="validationCustom05" class="form-label">Zip</label>
                                <input type="number" class="form-control" id="corzip" name="corzip" required>
                                <div class="invalid-feedback">
                                  Please provide a valid zip.
                                </div>
                              </div> -->



                    <div class="col-md-3">
                      <label for="validationCustom03" class="form-label">To</label>
                      <input type="text" class="form-control" id="edconaddress" name="edconaddress" required>
                      <div class="invalid-feedback" id="booktoaddress">
                        Please provide a valid consignee address.
                      </div>
                    </div>





                    <div class="col-md-3">
                      <label for="validationCustom03" class="form-label">POD No</label>
                      <input type="text" class="form-control" id="edpod" name="edpod" required>
                      <div class="invalid-feedback" id="edpodsuc">
                        Already Taken POD., Please Change
                      </div>
                    </div>


                    <!-- <div class="col-md-3">
                                <label for="validationCustom04" class="form-label">State</label>
                                <input list="consstate" class="form-control" name="constate" id="constate">

                                <datalist id="consstate">
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
                                <div class="invalid-feedback">
                                  Please select a valid state.
                                </div>
                              </div> -->
                    <!-- <div class="col-md-3">
                                <label for="validationCustom05" class="form-label">Zip</label>
                                <input type="number" class="form-control" id="conzip" name="conzip" required>
                                <div class="invalid-feedback">
                                  Please provide a valid zip.
                                </div>
                              </div> -->

                    <div class="col-md-4">
                      <label for="validationCustom05" class="form-label">Area</label>
                      <textarea class="form-control" id="edarea" name="edarea" required></textarea>
                      <div class="invalid-feedback" id="bookarea">
                        Please provide a valid zip.
                      </div>
                    </div>

                    <div class="col-md-3">
                      <label for="validationCustom03" class="form-label">Train Name</label>
                      <input type="text" class="form-control" id="edtrainname" name="edtrainname" required>
                      <div class="invalid-feedback" id="booktoaddress">
                        Please provide a valid consignee address.
                      </div>
                    </div>

                    <div class="col-md-2" id="validationCustom05">
                      <label for="validationCustom05" class="form-label">Transport</label>
                      <div class="col-md-12 mt-1">
                        <input list="transport_s" class="form-control" name="edtransport" id="edtransport">
                        <datalist id="transport_s">
                          <option selected disabled value="">Choose Transport</option>
                          <option value="MAR">MAR</option>
                          <option value="SAR">SAR</option>
                          <option value="AMT">AMT</option>
                          <option value="Others">Others</option>
                        </datalist>

                        <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input sample" type="checkbox" id="transport" name="transport" value="MAR">
                                    <label class="form-check-label" for="inlineCheckbox1">MAR</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input sample" type="checkbox" id="transport" name="transport" value="SAR">
                                    <label class="form-check-label" for="inlineCheckbox2">SAR</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input sample" type="checkbox" id="transport" name="transport" value="AMT">
                                    <label class="form-check-label" for="inlineCheckbox3">AMT</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input sample" type="checkbox" id="transport" name="transport" value="Others">
                                    <label class="form-check-label" for="inlineCheckbox4">Others</label>
                                  </div> -->
                        <div class="invalid-feedback" id="booktransport">
                          Please provide a valid Transport.
                        </div>
                      </div>

                    </div><!--end row-->

                    <div class="card-header">
                      <h4 class="card-title" style="color:#ff9f43;">Package Details</h4>
                    </div><!--end card-header-->

                    <div class="col-md-2">
                      <label for="validationCustom04" class="form-label">Types of packing</label>
                      <!-- <select class="form-select" id="validationCustom04" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option>...</option>
                                      </select> -->
                      <input class="form-control" list="pack_s" name="edpacks" id="edpacks">

                      <datalist id="pack_s">
                        <option>G/B</option>
                        <option>P/B</option>
                        <option>Box</option>
                      </datalist>
                      <div class="invalid-feedback" id="bookpack">
                        Please select a valid Packing.
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="validationCustom03" class="form-label">Party Invice No</label>
                      <input type="text" class="form-control" id="edinvoiceno" name="edinvoiceno" required>
                      <div class="invalid-feedback" id="bookinvno">
                        Please provide a valid Party Invice No.
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="validationCustom05" class="form-label">Said to Content</label>
                      <input type="text" class="form-control" id="eddescribe" name="eddescribe" required>
                      <div class="invalid-feedback" id="bookdescribe">
                        Please provide a valid Said to Content.
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="validationCustom05" class="form-label">Quantity</label>
                      <input type="text" class="form-control" id="edquantity" name="edquantity" required>
                      <div class="invalid-feedback" id="bookquantity">
                        Please provide a valid Quantity.
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="validationCustom05" class="form-label">Gross Weight</label>
                      <input type="text" class="form-control" id="edgross" name="edgross" required>
                      <div class="invalid-feedback" id="bookgross">
                        Please provide a valid Gross Weight.
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="validationCustom05" class="form-label">Doc Charge</label>
                      <input type="text" class="form-control" id="eddocs" name="eddocs" required value="50">
                      <div class="invalid-feedback" id="bookdocs">
                        Please provide a valid Rate.
                      </div>
                    </div>

                    <div class="col-md-2">
                      <label for="validationCustom05" class="form-label">Charged Weight</label>
                      <input type="text" class="form-control" id="edweight" name="edweight" required>
                      <div class="invalid-feedback" id="bookweight">
                        Please provide a valid Charged Weight.
                      </div>
                    </div>
                    <div class="col-md-2" id="edrates1">
                      <label for="validationCustom05" class="form-label">Rate</label>
                      <input type="text" class="form-control" id="edrate" name="edrate" required>
                      <div class="invalid-feedback" id="bookrate">
                        Please provide a valid Rate.
                      </div>
                    </div>

                    <div class="col-md-2" id="edweight30">
                      <label for="validationCustom05" class="form-label">Charged Weight (31&lt50)</label>
                      <input type="text" class="form-control" id="edweight1" name="edweight1" required>
                      <div class="invalid-feedback" id="bookweight">
                        Please provide a valid Charged Weight.
                      </div>
                    </div>

                    <div class="col-md-2" id="edrate30">
                      <label for="validationCustom05" class="form-label">Rate</label>
                      <input type="text" class="form-control" id="edrate1" name="edrate1" required>
                      <div class="invalid-feedback" id="bookrate">
                        Please provide a valid Rate.
                      </div>
                    </div>

                    <div class="col-md-2" id="edweight50">
                      <label for="validationCustom05" class="form-label">Charged Weight (&gt50)</label>
                      <input type="text" class="form-control" id="edweight2" name="edweight2" required>
                      <div class="invalid-feedback" id="bookweight">
                        Please provide a valid Charged Weight.
                      </div>
                    </div>

                    <div class="col-md-2" id="edrate50">
                      <label for="validationCustom05" class="form-label">Rate</label>
                      <input type="text" class="form-control" id="edrate2" name="edrate2" required>
                      <div class="invalid-feedback" id="bookrate">
                        Please provide a valid Rate.
                      </div>
                    </div>

                    <div class="col-md-2">
                    </div>

                    <div class="col-md-3" style="text-align:center;">
                      <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">Amount</label>
                      <div class="col-sm-12">
                        <input class="form-control" type="text" name="edamount" id="edamount">
                        <!-- placeholder="0.00" style="text-align:center;font-weight: 800;font-size: 2.5rem;"  form-control-lg-->
                      </div>
                      <div class="invalid-feedback" id="bookamount">
                        Please provide a valid Rate.
                      </div>
                    </div>

                    <div class="col-md-3" style="text-align:center;">
                      <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">Other Charges</label>
                      <div class="col-sm-12">
                        <input class="form-control" type="text" name="edotherchg" id="edotherchg">
                        <!-- placeholder="0.00" style="text-align:center;font-weight: 800;font-size: 2.5rem;"  form-control-lg-->
                      </div>
                      <div class="invalid-feedback" id="bookamount">
                        Please provide a valid Rate.
                      </div>
                    </div>

                    <!-- <div class="col-md-2">
                                <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">GST Amount</label>
                                <div class="col-sm-12">
                                  <input type="text" name="gsts" id="gsts" value="5" class="form-control">
                                </div>
                                <div class="invalid-feedback" id="bookgst">
                                  Please provide a valid Rate.
                                </div>
                              </div> -->

                    <div class="col-md-2">
                      <label for="validationCustom04" class="form-label">Payment Type</label>
                      <select class="form-select" id="edpaymentmode" name="edpaymentmode" required style="position: relative;top:5px!important">
                        <option selected disabled value="">Choose...</option>
                        <option value="Bill">Bill</option>
                        <option value="Cash">Cash</option>
                        <option value="To Pay">To Pay</option>
                      </select>
                      <div class="invalid-feedback" id="bookpayment">
                        Please select a valid Packing.
                      </div>
                    </div>



                    <div class="col-md-3"></div>
                    <div class="col-md-2">
                      <label for="validationCustom02" class="form-label">GST Type</label>
                      <input list="edgsttypes" class="form-control" name="edgst_types" id="edgst_types">
                      <datalist id="edgsttypes">
                        <option value="" disabled>Select Types</option>
                        <option value="State">State</option>
                        <option value="Interstate">Interstate</option>
                      </datalist>
                      <div class="invalid-feedback" id="edtype_s">
                        Please provide a valid types.
                      </div>
                    </div>

                    <div class="col-md-2" id="edstates">
                      <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">IGST Amount (%)</label>
                      <div class="col-sm-12">
                        <input type="text" name="edigstamt" id="edigstamt" value="5" class="form-control">
                      </div>
                      <div class="invalid-feedback" id="igsts">
                        Please provide a valid GST.
                      </div>
                    </div>

                    <div class="col-md-2" id="edcgst">
                      <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">CGST Amount (%)</label>
                      <div class="col-sm-12">
                        <input type="text" name="edcgstamt" id="edcgstamt" value="2.5" class="form-control">
                      </div>
                      <div class="invalid-feedback" id="edgsts">
                        Please provide a valid GST.
                      </div>
                    </div>

                    <div class="col-md-2" id="edsgst">
                      <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">SGST Amount (%)</label>
                      <div class="col-sm-12">
                        <input type="text" name="edsgstamt" id="edsgstamt" value="2.5" class="form-control">
                      </div>
                      <div class="invalid-feedback" id="edgsts">
                        Please provide a valid GST.
                      </div>
                    </div>


                    <!-- <div class="col-md-2" style="text-align:center;position: relative;top:35px !important">
                                <input type="checkbox" name="gst" id="gst" value="GST"><span> GST(<span id="gstp">5%</span>)
                                  <div class="invalid-feedback" id="bookgsts">
                                    Please provide a valid Rate.
                                  </div>
                              </div> -->

                    <div class="row col-md-12">
                      <div class="col-md-4"></div>
                      <div class="col-md-4" style="text-align:center;">
                        <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">Payment</label>
                        <input class="form-control form-control-lg" type="text" name="edpaid" id="edpaid" placeholder="0.00" style="text-align:center;font-weight: 800;font-size: 2.5rem;">
                        <div class="invalid-feedback" id="bookpaid">
                          Please select a valid Packing.
                        </div>
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <button class="btn btn-primary" type="submit" name="bookupdation" id="bookupdation">Update Booking</button>
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


      <div class="modal fade bd-example-modal-xl" id="editmno" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title m-0" id="myLargeModalLabel">Booking</h6>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
              <div class="row">


                <div class="card-header">
                  <h4 class="card-title" style="color:#22b783;">M No Updation</h4>
                </div><!--end card-header-->


                <div class="card-body">
                  <form class="row g-3 needs-validation" novalidate method="POST" autocomplete="off">
                    <input type="hidden" name="edmbookid" id="edmbookid" />
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                      <label for="validationCustom01" class="form-label">From Date</label>
                      <input type="date" class="form-control" id="mcreationdate" name="mcreationdate" value="<?= $dates ?>" required>
                      <div class="invalid-feedback">
                        Please provide a valid Date.
                      </div>
                    </div>

                    <!-- <div class="col-md-3">
                      <label for="validationCustom01" class="form-label">Party Name</label>
                      <input list="ed_parties" class="form-control" name="mpartyname" readonly id="mpartyname">
                      <datalist id="ed_parties">
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

                    <div class="col-md-2">
                      <label for="validationCustom02" class="form-label">Type</label>
                      <input list="type_s" class="form-control" name="mtypes" id="mtypes" readonly>
                      <datalist id="type_s">
                        <option value="" disabled>Select Types</option>
                        <option value="Air">Air</option>
                        <option value="Train">Train</option>
                        </select>
                        <div class="invalid-feedback" id="booktypes">
                          Please provide a valid types.
                        </div>
                    </div>

                    <div class="col-md-2">
                      <label for="validationCustom03" class="form-label">Route</label>
                      <input list="e_droutes" class="form-control" name="mroute" id="mroute" readonly>

                      <datalist id="e_droutes">
                        <option selected disabled value="">Choose Route</option>
                        <option value="Vaniyambadi">Vaniyambadi</option>
                        <option value="CHENNAI">CHENNAI</option>
                        <option value="RANIPET">RANIPET</option>
                        <option value="AMBUR">AMBUR</option>
                        <option value="Other Place">Other Place</option>
                      </datalist>
                    </div>


                    <div class="col-md-3">
                      <label for="validationCustom01" class="form-label">Orgin</label>
                      <input list="origins" class="form-control" name="morigin" id="morigin" readonly>
                      <datalist id="origins">
                        <?php
                        $sqlcity = "select * from partyset group by city"; //cities
                        $execity = $con->prepare($sqlcity);
                        $execity->execute();
                        $rescity = $execity->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rescity as $resc) {
                        ?>

                          <option selected disabled value="">Choose City...</option>
                          <option value="<?= $resc['city'] ?>"><?= $resc['city'] ?></option>
                        <?php } ?>
                      </datalist>

                      <div class="invalid-feedback" id="bookorigin">
                        Please provide a valid Orgin.
                      </div>
                    </div>

                    <div class="col-md-3">
                      <label for="validationCustom02" class="form-label">Destination</label>
                      <input list="destination_s" class="form-control" name="mdestination" id="mdestination" readonly>
                      <datalist id="destination_s">
                        <?php
                        $sqlcity = "select * from partyset group by destinate"; //cities
                        $execity = $con->prepare($sqlcity);
                        $execity->execute();
                        $rescity = $execity->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rescity as $resc) {
                        ?>

                          <option selected disabled value="">Choose City...</option>
                          <option value="<?= $resc['destinate'] ?>"><?= $resc['destinate'] ?></option>
                        <?php } ?>
                      </datalist>
                      <div class="invalid-feedback" id="bookdestination">
                        Please provide a valid Destination.
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationCustom03" class="form-label">From</label>
                      <input type="text" class="form-control" id="mcoraddress" name="mcoraddress" readonly required>
                      <div class="invalid-feedback" id="bookfromaddress">
                        Please provide a consignor address.
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationCustom03" class="form-label">To</label>
                      <input type="text" class="form-control" id="mconaddress" readonly name="mconaddress" required>
                      <div class="invalid-feedback" id="booktoaddress">
                        Please provide a valid consignee address.
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationCustom03" class="form-label">POD No</label>
                      <input type="text" class="form-control" id="mpod" name="mpod" readonly required>
                      <div class="invalid-feedback" id="booktoaddress">
                        Please provide a valid consignee address.
                      </div>
                    </div>

                    <div class="col-md-4">
                    </div> -->
                    <div class="col-md-3">
                      <label for="validationCustom03" class="form-label">M.No</label>
                      <input type="text" class="form-control" id="mno" name="mno" required>
                      <div class="invalid-feedback" id="booktoaddress">
                        Please provide a valid consignee address.
                      </div>
                    </div>


                    <div class="col-12 text-center">
                      <button class="btn btn-primary" type="submit" name="bookupdationmno" id="bookupdationmno">Update MNo</button>
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

          $("#weights1").show();
          $("#weight30").hide();
          $("#weight50").hide();
          $("#rates1").show();
          $("#rate30").hide();
          $("#rate50").hide();

          $("#edweights1").show();
          $("#edweight30").hide();
          $("#edweight50").hide();
          $("#edrates1").show();
          $("#edrate30").hide();
          $("#edrate50").hide();

          $('#partynamess').change(function(e) {
            var vals = this.value;
            var partyids = $('#partiess [value="' + vals + '"]').data('value');
            $("#pid").val(partyids);
            //  var pids=$("#pid").val();
            //  alert(pids);
          });

          $("#states").hide();
          $("#sgst").hide();
          $("#cgst").hide();

          $("#edstates").hide();
          $("#edsgst").hide();
          $("#edcgst").hide();


          var ty = $("#role").val();
          // alert(ty)
          if (ty == "Air") {
            $("#types").val("Air");
          } else if (ty == "Train") {
            $("#types").val("Train");
          } else if (ty == "Admin") {
            $("#types").val("");
          }

          $('#types').change(function(e) {
            var tys = this.value;
            if (tys == "Air") {
              $("#weights1").show();
              $("#weight30").show();
              $("#weight50").show();
              $("#rates1").show();
              $("#rate30").show();
              $("#rate50").show();
            } else if (tys == "Train") {

              $("#weights1").show();
              $("#weight30").hide();
              $("#weight50").hide();
              $("#rates1").show();
              $("#rate30").hide();
              $("#rate50").hide();
            } else {
              $("#weights1").show();
              $("#weight30").hide();
              $("#weight50").hide();
              $("#rates1").show();
              $("#rate30").hide();
              $("#rate50").hide();
            }
          });

          $('#edtypes').change(function(e) {
            var tys = this.value;
            if (tys == "Air") {
              $("#edweights1").show();
              $("#edweight30").show();
              $("#edweight50").show();
              $("#edrates1").show();
              $("#edrate30").show();
              $("#edrate50").show();
            } else if (tys == "Train") {

              $("#edweights1").show();
              $("#edweight30").hide();
              $("#edweight50").hide();
              $("#edrates1").show();
              $("#edrate30").hide();
              $("#edrate50").hide();
            } else {
              $("#edweights1").show();
              $("#edweight30").hide();
              $("#edweight50").hide();
              $("#edrates1").show();
              $("#edrate30").hide();
              $("#edrate50").hide();
            }
          });


          $('#pod').change(function(e) {
            e.preventDefault();
            var pod = $("#pod").val();
            // alert(pod)
            $.ajax({
              url: 'ajax/ajax_request.php?action=partypod',
              type: 'POST',
              dataType: "JSON",
              data: {
                'action': "partypod",
                'pod': pod,
              },
              success: function(response) {
                if (response.msg == "Success") {
                  $("#podsuc").show();
                }
                if (response.msg == "Failure") {
                  $("#podsuc").hide();
                }
              }
            });
          });

          $('#edpod').change(function(e) {
            e.preventDefault();
            var pod = $("#edpod").val();
            // alert(pod)
            $.ajax({
              url: 'ajax/ajax_request.php?action=partypod',
              type: 'POST',
              dataType: "JSON",
              data: {
                'action': "partypod",
                'pod': pod,
              },
              success: function(response) {
                if (response.msg == "Success") {
                  $("#edpodsuc").show();
                }
                if (response.msg == "Failure") {
                  $("#edpodsuc").hide();
                }
              }
            });
          });

          $('#destination').change(function(e) {
            e.preventDefault();
            var value = $('#partyname').val();
            var partyid = $('#edparties [value="' + value + '"]').data('value');
            var route = $('#route').val();
            var types = $('#types').val();
            var city = $('#origin').val();
            var destinate = $('#destination').val();
            var typ = "<?= $types ?>";
            // alert(typ)
            if (partyid != '' && route != '' && types != '' && city != '' && destinate != '') {
              $.ajax({
                url: 'ajax/ajax_request.php?action=partybookfetch',
                type: 'POST',
                dataType: "JSON",
                data: {
                  'action': "partybookfetch",
                  'id': partyid,
                  'route': route,
                  'bookmode': types,
                  'city': city,
                  'destinate': destinate
                },
                success: function(response) {
                  if (typ == "Air") {
                    $("#weight").val(response.data.weight);
                    $("#rate").val(response.data.airprice);
                  } else if (typ == "Train") {
                    $("#rate").val(response.data.trainprice);
                  } else if (typ == "Admin") {
                    if (response.data.airprice == 0) {
                      $("#rate").val(response.data.trainprice);
                    } else if (response.data.trainprice == 0) {
                      $("#rate").val(response.data.airprice);
                      $("#weight").val(response.data.weight);
                    }
                  }
                  $("#area").val(response.data.partyaddress);
              
                  var weight = $("#weight").val();
                  var rate = $("#rate").val();
                  var amount = weight * rate;
                  var docs = $("#docs").val();

                  var qty = (weight * rate);
                  var tot = parseFloat(qty) + parseFloat(docs);
                  $("#amount").val(tot);

                }
              });
            }
          });

          $('#eddestination').change(function(e) {
            e.preventDefault();
            var value = $('#edpartyname').val();
            var partyid = $('#ed_parties [value="' + value + '"]').data('value');
            var route = $('#edroute').val();
            var types = $('#edtypes').val();
            var city = $('#edorigin').val();
            var destinate = $('#eddestination').val();
            var typ = "<?= $types ?>";
            var sgst = $("#edsgstamt").val();
            var cgst = $("#edcgstamt").val();
            var igst = $("#edigstamt").val();

            if (partyid != '' && route != '' && types != '' && city != '' && destinate != '') {
              $.ajax({
                url: 'ajax/ajax_request.php?action=partybookfetch',
                type: 'POST',
                dataType: "JSON",
                data: {
                  'action': "partybookfetch",
                  'id': partyid,
                  'route': route,
                  'bookmode': types,
                  'city': city,
                  'destinate': destinate
                },
                success: function(response) {
                  if (typ == "Air") {
                    $("#edweight").val(response.data.weight);
                    $("#edrate").val(response.data.airprice);
                  } else if (typ == "Train") {
                    $("#edrate").val(response.data.trainprice);
                  } else if (typ == "Admin") {
                    if (response.data.airprice == 0) {
                      $("#edrate").val(response.data.trainprice);
                    } else if (response.data.trainprice == 0) {
                      $("#edrate").val(response.data.airprice);
                      $("#edweight").val(response.data.weight);
                    }
                  }

                  var weight = $("#edweight").val();
                  var rate = $("#edrate").val();
                  var amount = weight * rate;
                  var docs = $("#eddocs").val();

                  var qty = (weight * rate);
                  var tot = parseFloat(qty) + parseFloat(docs);
                  $("#edamount").val(tot);
                }
              });
            }
          });


          $("#gst_types").change(function() {
            var gst = this.value;
            var booktype = $("#types").val();

            $.ajax({
              url: 'ajax/ajax_request.php?action=gstfetchtype',
              type: 'POST',
              dataType: "JSON",
              data: {
                'action': "gstfetchtype",
                'gsttype': gst,
                'booktype': booktype
              },
              success: function(response) {

                $("#sgstamt").val(response.data.sgst);
                $("#cgstamt").val(response.data.cgst);
                $("#igstamt").val(response.data.igst);

                var sgst = $("#sgstamt").val();
                var cgst = $("#cgstamt").val();
                var igst = $("#igstamt").val();

                var other = $("#otherchg").val();
                if (other != '') {
                  others = other;
                } else {
                  others = 0;
                }

                var rates = $("#rate").val();
                var weights = $("#weight").val();
                var rates1 = $("#rate1").val();
                var weights1 = $("#weight1").val();
                var rates2 = $("#rate2").val();
                var weights2 = $("#weight2").val();

                if (rates1 != '' && weights1 != '') {
                  var rates = $("#rate1").val();
                  var weights = $("#weight1").val();
                } else if (rates2 != '' && weights2 != '') {
                  var rates = $("#rate2").val();
                  var weights = $("#weight2").val();
                } else {
                  var rates = $("#rate").val();
                  var weights = $("#weight").val();
                }

                var tot = rates * weights;
                var doc = $("#docs").val();

                var tots = parseFloat(tot) + parseFloat(doc) + parseFloat(others);
                $("#amount").val(tots);

                var amount = $("#amount").val();

                if (gst == 'State') {
                  $("#states").hide();
                  $("#sgst").show();
                  $("#cgst").show();

                  var gstamts = parseFloat(amount);
                  var gsttot1 = ((gstamts * cgst) / 100);
                  var gsttot2 = ((gstamts * sgst) / 100);
                  var gstamt = parseFloat(gstamts) + parseFloat(gsttot1) + parseFloat(gsttot2);
                  $("#paid").val(gstamt);
                } else if (gst == 'Interstate') {
                  $("#states").show();
                  $("#sgst").hide();
                  $("#cgst").hide();

                  var gsttot1 = parseFloat(amount);
                  var gstamt = parseFloat(gsttot1) + ((gsttot1 * igst) / 100);
                  $("#paid").val(gstamt);
                } else {
                  var amount = $("#amount").val();
                  $("#paid").val(amount);
                }


              }

            });

          });

          $("#edgst_types").change(function() {
            var gst = this.value;
            var booktype = $("#types").val();
            $.ajax({
              url: 'ajax/ajax_request.php?action=gstfetchtype',
              type: 'POST',
              dataType: "JSON",
              data: {
                'action': "gstfetchtype",
                'gsttype': gst,
                'booktype': booktype
              },
              success: function(response) {

                $("#sgstamt").val(response.data.sgst);
                $("#cgstamt").val(response.data.cgst);
                $("#igstamt").val(response.data.igst);

                var sgst = $("#sgstamt").val();
                var cgst = $("#cgstamt").val();
                var igst = $("#igstamt").val();

                var other = $("#otherchg").val();
                if (other != '') {
                  others = other;
                } else {
                  others = 0;
                }

                var rates = $("#rate").val();
                var weights = $("#weight").val();
                var rates1 = $("#rate1").val();
                var weights1 = $("#weight1").val();
                var rates2 = $("#rate2").val();
                var weights2 = $("#weight2").val();

                if (rates1 != '' && weights1 != '') {
                  var rates = $("#rate1").val();
                  var weights = $("#weight1").val();
                } else if (rates2 != '' && weights2 != '') {
                  var rates = $("#rate2").val();
                  var weights = $("#weight2").val();
                } else {
                  var rates = $("#rate").val();
                  var weights = $("#weight").val();
                }

                var tot = rates * weights;
                var doc = $("#docs").val();
                var tots = parseFloat(tot) + parseFloat(doc);
                $("#amount").val(tots);

                var amount = $("#amount").val();

                if (gst == 'State') {
                  $("#states").hide();
                  $("#sgst").show();
                  $("#cgst").show();

                  var gstamts = parseFloat(amount) + parseFloat(others);
                  var gsttot1 = ((gstamts * cgst) / 100);
                  var gsttot2 = ((gstamts * sgst) / 100);
                  var gstamt = parseFloat(gstamts) + parseFloat(gsttot1) + parseFloat(gsttot2);
                  $("#paid").val(gstamt);
                } else if (gst == 'Interstate') {
                  $("#states").show();
                  $("#sgst").hide();
                  $("#cgst").hide();

                  var gsttot1 = parseFloat(amount) + parseFloat(others);
                  var gstamt = parseFloat(gsttot1) + ((gsttot1 * igst) / 100);
                  $("#paid").val(gstamt);
                } else {
                  var amount = $("#amount").val();
                  $("#paid").val(amount);
                }


              }
            });
          });


          $("#docs").change(function() {
            var gst = $('#gst_types').val();
            var sgst = $("#sgstamt").val();
            var cgst = $("#cgstamt").val();
            var igst = $("#igstamt").val();

            var other = $("#otherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }
            var amount = $("#amount").val();

            if (gst == 'State') {
              $("#states").hide();
              $("#sgst").show();
              $("#cgst").show();

              var gsts = parseFloat(amount) + parseFloat(others);
              var gsttot1 = ((gsts * cgst) / 100);
              var gsttot2 = ((gsts * sgst) / 100);
              var gstamt = parseFloat(gsts) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#paid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#states").show();
              $("#sgst").hide();
              $("#cgst").hide();

              var gsttot1 = parseFloat(amount) + parseFloat(others);
              var gstamt = parseFloat(gsttot1) + ((gsttot1 * igst) / 100);
              $("#paid").val(gstamt);
            } else {
              var amount = $("#amount").val();
              $("#paid").val(amount);
            }

            var rates = $("#rate").val();
            var weights = $("#weight").val();
            var tot = rates * weights;
            var doc = $("#docs").val();
            var tots = parseFloat(tot) + parseFloat(doc);
            $("#amount").val(tots);
          });

          $("#eddocs").change(function() {
            var gst = $('#gst_types').val();
            var sgst = $("#edsgstamt").val();
            var cgst = $("#edcgstamt").val();
            var igst = $("#edigstamt").val();

            var other = $("#edotherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            var rates = $("#edrate").val();
            var weights = $("#edweight").val();
            var tot = rates * weights;
            var doc = $("#eddocs").val();
            var tots = parseFloat(tot) + parseFloat(doc);
            $("#edamount").val(tots);

            var gst = $("#edgst_types").val();
            if (gst == 'State') {
              $("#edstates").hide();
              $("#edsgst").show();
              $("#edcgst").show();
              var gtamts = parseFloat(tots) + parseFloat(others);
              var gsttot1 = ((gtamts * cgst) / 100);
              var gsttot2 = ((gtamts * sgst) / 100);
              var gstamt = parseFloat(gtamts) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#edpaid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#edstates").show();
              $("#edsgst").hide();
              $("#edcgst").hide();

              var gsttot1 = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(others);
              var gstamt = parseFloat(gsttot1) + ((gsttot1 * igst) / 100);
              $("#edpaid").val(gstamt);
            } else {
              var amount = $("#edamount").val();
              $("#edpaid").val(amount);
            }
          });


          $("#weight").keyup(function() {
            var gst = $('#gst_types').val();
            var sgst = $("#sgstamt").val();
            var cgst = $("#cgstamt").val();
            var igst = $("#igstamt").val();

            var other = $("#otherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            var rates = $("#rate").val();
            var weights = $("#weight").val();
            var tot = rates * weights;

            var doc = $("#docs").val();
            var tots = parseFloat(tot) + parseFloat(doc) + parseFloat(others);
            console.log(tots)
            $("#amount").val(tots);

            var amount = $("#amount").val();

            if (gst == 'State') {
              $("#states").hide();
              $("#sgst").show();
              $("#cgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#paid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#states").show();
              $("#sgst").hide();
              $("#cgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#paid").val(gstamt);
            } else {
              var amount = $("#amount").val();
              $("#paid").val(amount);
            }

          });

          $("#edweight").keyup(function() {
            var gst = $('#edgst_types').val();
            var sgst = $("#edsgstamt").val();
            var cgst = $("#edcgstamt").val();
            var igst = $("#edigstamt").val();

            var other = $("#edotherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            var rates = $("#edrate").val();
            var weights = $("#edweight").val();
            var tot = rates * weights;

            var doc = $("#eddocs").val();
            var tots = parseFloat(tot) + parseFloat(doc) + parseFloat(others);
            console.log(tots)
            $("#edamount").val(tots);

            var amount = $("#edamount").val();


            if (gst == 'State') {
              $("#edstates").hide();
              $("#edsgst").show();
              $("#edcgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#edpaid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#edstates").show();
              $("#edsgst").hide();
              $("#edcgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#edpaid").val(gstamt);
            } else {
              var amount = $("#edamount").val();
              $("#edpaid").val(amount);
            }

          });

          $("#rate").keyup(function() {
            var gst = $('#gst_types').val();
            var sgst = $("#sgstamt").val();
            var cgst = $("#cgstamt").val();
            var igst = $("#igstamt").val();

            var other = $("#otherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            var rates = $("#rate").val();
            var weights = $("#weight").val();
            var tot = rates * weights;

            var doc = $("#docs").val();
            var tots = parseFloat(tot) + parseFloat(doc) + parseFloat(others);
            console.log(tots)
            // alert(tots)
            $("#amount").val(tots);
            var amount = $("#amount").val();

            if (gst == 'State') {
              $("#states").hide();
              $("#sgst").show();
              $("#cgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#paid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#states").show();
              $("#sgst").hide();
              $("#cgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#paid").val(gstamt);
            } else {
              var amount = $("#amount").val();
              $("#paid").val(amount);
            }

          });

          $("#edrate").keyup(function() {
            var gst = $('#edgst_types').val();
            var sgst = $("#edsgstamt").val();
            var cgst = $("#edcgstamt").val();
            var igst = $("#edigstamt").val();

            var other = $("#edotherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            var rates = $("#edrate").val();
            var weights = $("#edweight").val();
            var tot = rates * weights;

            var doc = $("#eddocs").val();
            var tots = parseFloat(tot) + parseFloat(doc) + parseFloat(others);
            console.log(tots)
            // alert(tots)
            $("#edamount").val(tots);
            var amount = $("#edamount").val();

            if (gst == 'State') {
              $("#edstates").hide();
              $("#edsgst").show();
              $("#edcgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#edpaid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#edstates").show();
              $("#edsgst").hide();
              $("#edcgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#edpaid").val(gstamt);
            } else {
              var amount = $("#edamount").val();
              $("#edpaid").val(amount);
            }

          });

          $("#weight1").keyup(function() {
            var gst = $('#gst_types').val();
            var sgst = $("#sgstamt").val();
            var cgst = $("#cgstamt").val();
            var igst = $("#igstamt").val();

            var other = $("#otherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            var rates = $("#rate1").val();
            var weights = $("#weight1").val();
            var tot = rates * weights;

            var doc = $("#docs").val();
            var tots = parseFloat(tot) + parseFloat(doc) + parseFloat(others);
            // alert(tots)
            $("#amount").val(tots);

            var amount = $("#amount").val();

            if (gst == 'State') {
              $("#states").hide();
              $("#sgst").show();
              $("#cgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#paid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#states").show();
              $("#sgst").hide();
              $("#cgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#paid").val(gstamt);
            } else {
              var amount = $("#amount").val();
              $("#paid").val(amount);
            }

          });

          $("#edweight1").keyup(function() {
            var gst = $('#edgst_types').val();
            var sgst = $("#edsgstamt").val();
            var cgst = $("#edcgstamt").val();
            var igst = $("#edigstamt").val();

            var other = $("#edotherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

           
            $("#edrate2").val(0);
            $("#edweight2").val(0);

            var rates = $("#edrate1").val();
            var weights = $("#edweight1").val();
            var tot = rates * weights;

            var doc = $("#eddocs").val();
            var tots = parseFloat(tot) + parseFloat(doc) + parseFloat(others);
            $("#edamount").val(tots);

            var amount = $("#edamount").val();

            if (gst == 'State') {
              $("#edstates").hide();
              $("#edsgst").show();
              $("#edcgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#edpaid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#edstates").show();
              $("#edsgst").hide();
              $("#edcgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#edpaid").val(gstamt);
            } else {
              var amount = $("#edamount").val();
              $("#edpaid").val(amount);
            }

          });

          $("#rate1").keyup(function() {
            var gst = $('#gst_types').val();
            var sgst = $("#sgstamt").val();
            var cgst = $("#cgstamt").val();
            var igst = $("#igstamt").val();

            var other = $("#otherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            var rates = $("#rate1").val();
            var weights = $("#weight1").val();
            var tot = rates * weights;

            var doc = $("#docs").val();
            var tots = parseFloat(tot) + parseFloat(doc) + parseFloat(others);
            console.log(tots)
            // alert(tots)
            $("#amount").val(tots);
            var amount = $("#amount").val();

            if (gst == 'State') {
              $("#states").hide();
              $("#sgst").show();
              $("#cgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#paid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#states").show();
              $("#sgst").hide();
              $("#cgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#paid").val(gstamt);
            } else {
              var amount = $("#amount").val();
              $("#paid").val(amount);
            }

          });

          $("#edrate1").keyup(function() {
            var gst = $('#edgst_types').val();
            var sgst = $("#edsgstamt").val();
            var cgst = $("#edcgstamt").val();
            var igst = $("#edigstamt").val();

            var docs = $("#eddocs").val();
            var other = $("#edotherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            $("#edrate2").val(0);
            $("#edweight2").val(0);

            var rates = $("#edrate1").val();
            var weights = $("#edweight1").val();
            var tot = rates * weights;

            var doc = $("#eddocs").val();
            var tots = parseFloat(tot) + parseFloat(doc) + parseFloat(others);
            console.log(tots)
            alert(tots)
            $("#edamount").val(tots);
            var amount = $("#edamount").val();

            if (gst == 'State') {
              $("#edstates").hide();
              $("#edsgst").show();
              $("#edcgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#edpaid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#edstates").show();
              $("#edsgst").hide();
              $("#edcgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#edpaid").val(gstamt);
            } else {
              var amount = $("#edamount").val();
              $("#edpaid").val(amount);
            }

          });

          $("#weight2").keyup(function() {
            var gst = $('#gst_types').val();
            var sgst = $("#sgstamt").val();
            var cgst = $("#cgstamt").val();
            var igst = $("#igstamt").val();

            var docs = $("#docs").val();
            var other = $("#otherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            var rates = $("#rate2").val();
            var weights = $("#weight2").val();
            var tot = rates * weights;

            $("#edrate2").val(0);
            $("#edweight2").val(0);

            var doc = $("#docs").val();
            var tots = parseFloat(tot) + parseFloat(doc) + parseFloat(others);
            console.log(tots)
            $("#amount").val(tots);

            var amount = $("#amount").val();


            if (gst == 'State') {
              $("#states").hide();
              $("#sgst").show();
              $("#cgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#paid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#states").show();
              $("#sgst").hide();
              $("#cgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#paid").val(gstamt);
            } else {
              var amount = $("#amount").val();
              $("#paid").val(amount);
            }

          });

          $("#edweight2").keyup(function() {
            var gst = $('#edgst_types').val();
            var sgst = $("#edsgstamt").val();
            var cgst = $("#edcgstamt").val();
            var igst = $("#edigstamt").val();

           var other = $("#edotherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            var rates = $("#edrate2").val();
            var weights = $("#edweight2").val();
            var tot = rates * weights;

        
            $("#edrate1").val(0);
            $("#edweight1").val(0);

            var doc = $("#eddocs").val();
            var tots = parseFloat(tot) + parseFloat(doc) + parseFloat(others);
            // alert(tots)
            $("#edamount").val(tots);

            var amount = $("#edamount").val();

            if (gst == 'State') {
              $("#edstates").hide();
              $("#edsgst").show();
              $("#edcgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#edpaid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#edstates").show();
              $("#edsgst").hide();
              $("#edcgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#edpaid").val(gstamt);
            } else {
              var amount = $("#edamount").val();
              $("#edpaid").val(amount);
            }

          });

          $("#rate2").keyup(function() {
            var gst = $('#gst_types').val();
            var sgst = $("#sgstamt").val();
            var cgst = $("#cgstamt").val();
            var igst = $("#igstamt").val();

            var docs = $("#docs").val();
            var other = $("#otherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            var rates = $("#rate2").val();
            var weights = $("#weight2").val();
            var tot = rates * weights;

            var doc = $("#docs").val();
            var tots = parseFloat(tot) + parseFloat(doc) + parseFloat(others);
            console.log(tots)
            // alert(tots)
            $("#amount").val(tots);
            var amount = $("#amount").val();

            if (gst == 'State') {
              $("#states").hide();
              $("#sgst").show();
              $("#cgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#paid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#states").show();
              $("#sgst").hide();
              $("#cgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#paid").val(gstamt);
            } else {
              var amount = $("#amount").val();
              $("#paid").val(amount);
            }

          });

          $("#edrate2").keyup(function() {
            var gst = $('#edgst_types').val();
            var sgst = $("#edsgstamt").val();
            var cgst = $("#edcgstamt").val();
            var igst = $("#edigstamt").val();

            var docs = $("#eddocs").val();
            var other = $("#edotherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            var rates = $("#edrate2").val();
            var weights = $("#edweight2").val();
            var tot = rates * weights;

            $("#edrate1").val(0);
            $("#edweight1").val(0);

            var doc = $("#eddocs").val();
            var tots = parseFloat(tot) + parseFloat(doc) + parseFloat(others);
            console.log(tots)
            // alert(tots)
            $("#edamount").val(tots);
            var amount = $("#edamount").val();

            if (gst == 'State') {
              $("#edstates").hide();
              $("#edsgst").show();
              $("#edcgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#paid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#edstates").show();
              $("#edsgst").hide();
              $("#edcgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#edpaid").val(gstamt);
            } else {
              var amount = $("#edamount").val();
              $("#edpaid").val(amount);
            }
          });

          $("#otherchg").on("keyup", function() {
            var gst = $('#gst_types').val();
            var sgst = $("#sgstamt").val();
            var cgst = $("#cgstamt").val();
            var igst = $("#igstamt").val();

            var rates = $("#rate").val();
            var weights = $("#weight").val();
            var rate1 = $("#rate1").val();
            var weight1 = $("#weight1").val();
            var rate2 = $("#rate2").val();
            var weight2 = $("#weight2").val();
            if (rates != "" && weights != "") {
              var tot = rates * weights;
            }
            if (rate1 != "" && weight1 != "") {
              var tot = rate1 * weight1;
            }
            if (rate2 != "" && weight2 != "") {
              var tot = rate2 * weight2;
            }
            var doc = $("#docs").val();


            var tots = parseFloat(tot) + parseFloat(doc);
            $("#amount").val(tots);

            // alert(tots)

            var other = $("#otherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            var amounts = $("#amount").val();
            var amountss = parseFloat(amounts) + parseFloat(others);
            $("#amount").val(amountss);
            var amount = $("#amount").val();
            if (gst == 'State') {
              $("#states").hide();
              $("#sgst").show();
              $("#cgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#paid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#states").show();
              $("#sgst").hide();
              $("#cgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#paid").val(gstamt);
            } else {
              var amount = $("#amount").val();
              $("#paid").val(amount);
            }


          });

          $("#edotherchg").on("keyup", function() {
            var gst = $('#edgst_types').val();
            var sgst = $("#edsgstamt").val();
            var cgst = $("#edcgstamt").val();
            var igst = $("#edigstamt").val();

            var rates = $("#edrate").val();
            var weights = $("#edweight").val();
            var rate1 = $("#edrate1").val();
            var weight1 = $("#edweight1").val();
            var rate2 = $("#edrate2").val();
            var weight2 = $("#edweight2").val();
            if (rates != "" && weights != "") {
              var tot = rates * weights;
            }
            if (rate1 != "" && weight1 != "") {
              var tot = rate1 * weight1;
            }
            if (rate2 != "" && weight2 != "") {
              var tot = rate2 * weight2;
            }
            var doc = $("#eddocs").val();


            var tots = parseFloat(tot) + parseFloat(doc);
            $("#edamount").val(tots);

            // alert(tots)

            var other = $("#edotherchg").val();
            if (other != '') {
              others = other;
            } else {
              others = 0;
            }

            var amounts = $("#edamount").val();
            var amountss = parseFloat(amounts) + parseFloat(others);
            $("#edamount").val(amountss);
            var amount = $("#edamount").val();
            if (gst == 'State') {
              $("#edstates").hide();
              $("#edsgst").show();
              $("#edcgst").show();

              var gsttot1 = ((amount * cgst) / 100);
              var gsttot2 = ((amount * sgst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1) + parseFloat(gsttot2);
              $("#edpaid").val(gstamt);
            } else if (gst == 'Interstate') {
              $("#edstates").show();
              $("#edsgst").hide();
              $("#edcgst").hide();

              var gsttot1 = ((amount * igst) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot1);
              $("#edpaid").val(gstamt);
            } else {
              var amount = $("#edamount").val();
              $("#edpaid").val(amount);
            }


          });

         $("#bookupdationmno").click(function(e) {
            e.preventDefault();
            var mcreationdate = $('#mcreationdate').val();
            var mno = $("#mno").val();
            $.ajax({
              url: 'ajax/ajax_request.php?action=mnoupdation',
              type: 'POST',
              dataType: "JSON",
              data: {
                'action': "mnoupdation",
                'creationdate': mcreationdate,
                'mno': mno
              },
              success: function(response) {
                if (response.msg == "Success") {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Booking MNO Updated',
                    showConfirmButton: false,
                    timer: 3000
                  }).then(function() {
                    window.location.href = 'booking.php';
                  })
                } else {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Booking MNO Update Failure',
                    showConfirmButton: false,
                    timer: 3000
                  }).then(function() {
                    window.location.href = 'booking.php';
                  })
                }
              }
            });
          });

          $("#bookcreation").click(function(e) {
            e.preventDefault();
            var creationdate = $('#creationdate').val();
            var runcreationdate = $('#runcreationdate').val();
            var value = $('#partyname').val();
            var partyid = $('#edparties [value="' + value + '"]').data('value');
            var type = $('#types').val();
            var route = $('#route').val();
            var origin = $('#origin').val();
            var destination = $('#destination').val();
            var coraddress = $('#coraddress').val();
            var conaddress = $('#conaddress').val();
            var pod = $('#pod').val();
            var area = $('#area').val();
            var trainname = $('#trainname').val();

            var transports = $('#transport').val();

            var packs = $('#packs').val();
            var invoiceno = $('#invoiceno').val();
            var describe = $('#describe').val();
            var quantity = $('#quantity').val();
            var gross = $('#gross').val();
            var weight = $('#weight').val();
            var rate = $('#rate').val();
            var weight1 = $('#weight1').val();
            var rate1 = $('#rate1').val();
            var weight2 = $('#weight2').val();
            var rate2 = $('#rate2').val();
            var docs = $('#docs').val();
            var amount = $('#amount').val();
            var othercharge = $('#otherchg').val();
            var paymentmode = $('#paymentmode').val();
            var otherchrg = $('#otherchg').val();
            var gst_types = $('#gst_types').val();
            if (gst_types == "State") {
              $("#igstamt").val(0);
              $("#cgstamt").val();
              $("#sgstamt").val();
            } else if (gst_types == "Interstate") {
              $("#igstamt").val();
              $("#cgstamt").val(0);
              $("#sgstamt").val(0);
            }
            var igstamt = $("#igstamt").val();
            var cgstamt = $("#cgstamt").val();
            var sgstamt = $("#sgstamt").val();

            var paid = $('#paid').val();

            // if (creationdate != '' && type != '' && origin != '' && destination != '' && area != '' && area != '' && coraddress != '' && conaddress != '' && transport != '' && packs != '' && invoiceno != '' && describe != '' && quantity != '' && gross != '' && weight != '' && docs != '' && rate != '' && amount != '' && gst_types != '' && paymentmode != '' && paid != '') {
            $.ajax({
              url: 'ajax/ajax_request.php?action=bookcreation',
              type: 'POST',
              dataType: "JSON",
              data: {
                'action': "bookcreation",
                'creationdate': creationdate,
                'runcreationdate':runcreationdate,
                'partyid': partyid,
                'type': type,
                'route': route,
                'origin': origin,
                'destination': destination,
                'area': area,
                'coraddress': coraddress,
                'conaddress': conaddress,
                'pod': pod,
                'trainname': trainname,
                'transport': transports,
                'pack': packs,
                'invoiceno': invoiceno,
                'describe': describe,
                'quantity': quantity,
                'gross': gross,
                'weight': weight,
                'rate': rate,
                'weight1': weight1,
                'rate1': rate1,
                'weight2': weight2,
                'rate2': rate2,
                'docs': docs,
                'amount': amount,
                'othercharge': othercharge,
                'gst_types': gst_types,
                'igst': igstamt,
                'sgst': sgstamt,
                'cgst': cgstamt,
                'paymentmode': paymentmode,
                'paid': paid
              },
              success: function(response) {
                if (response.msg == "Success") {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Booking Created',
                    showConfirmButton: false,
                    timer: 3000
                  }).then(function() {
                    window.location.href = 'booking.php';
                  })
                } else {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Booking Failed',
                    showConfirmButton: false,
                    timer: 3000
                  }).then(function() {
                    window.location.href = 'booking.php';
                  })
                }
              }
            });
                     });

          $(".bookingdeletion").click(function(e) {
            e.preventDefault();
            var bookdid = $(this).attr('ids');
            $.ajax({
              url: 'ajax/ajax_request.php?action=bookingdeletion',
              type: 'POST',
              dataType: "JSON",
              data: {
                'action': "bookingdeletion",
                'ids': bookdid
              },
              success: function(response) {
                console.log(response.data)
                if (response.msg == "Success") {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Booking Deleted',
                    showConfirmButton: false,
                    timer: 3000
                  }).then(function() {
                    window.location.href = 'booking.php';
                  })
                } else {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Booking Delete Failed',
                    showConfirmButton: false,
                    timer: 3000
                  }).then(function() {
                    window.location.href = 'booking.php';
                  })
                }
              }
            });
          });



          $(".edit_book").click(function(e) {
            e.preventDefault();
            var bookeid = $(this).attr("ids");
            $("#ed_bookid").val(bookeid);
            $.ajax({
              url: 'ajax/ajax_request.php?action=bookfetch',
              type: 'POST',
              dataType: "JSON",
              data: {
                'action': "bookfetch",
                'ids': bookeid
              },
              success: function(response) {
                $('#creationdate').val(response.data.creationdate);
                $('#edpartyname').val(response.data.party.partyname);
                $('#edtypes').val(response.data.type);
                $('#edorigin').val(response.data.origin);
                $('#eddestination').val(response.data.destination);
                $('#edcoraddress').val(response.data.coraddress);
                $('#edconaddress').val(response.data.conaddress);
                $('#edarea').val(response.data.area);
                $('#edroute').val(response.data.route);
                $("#edpod").val(response.data.pod);
                $("#edtrainname").val(response.data.trainname);

                $("#edtransport").val(response.data.transport);

                $('#edpacks').val(response.data.pack);
                $('#edinvoiceno').val(response.data.invoiceno);
                $('#eddescribe').val(response.data.description);
                $('#edquantity').val(response.data.quantity);
                $('#edgross').val(response.data.gross);
                $('#edweight').val(response.data.weight);
                $('#edrate').val(response.data.rate);
                $('#edweight1').val(response.data.weight1);
                $('#edrate1').val(response.data.rate1);
                $('#edweight2').val(response.data.weight2);
                $('#edrate2').val(response.data.rate2);
                $('#edamount').val(response.data.amount);
                $('#edotherchg').val(response.data.othercharge);
                $('#edgst_types').val(response.data.gst);
                if (response.data.gst == "State") {
                  $("#edstates").hide();
                  $("#edsgst").show();
                  $("#edcgst").show();
                } else {
                  $("#edstates").show();
                  $("#edsgst").hide();
                  $("#edcgst").hide();
                }

                var typess = $("#edtypes").val();
                if (typess == "Air") {
                  $("#edweights1").show();
                  $("#edweight30").show();
                  $("#edweight50").show();
                  $("#edrates1").show();
                  $("#edrate30").show();
                  $("#edrate50").show();
                } else if (typess == "Train") {

                  $("#edweights1").show();
                  $("#edweight30").hide();
                  $("#edweight50").hide();
                  $("#edrates1").show();
                  $("#edrate30").hide();
                  $("#edrate50").hide();
                } else {
                  $("#edweights1").show();
                  $("#edweight30").hide();
                  $("#edweight50").hide();
                  $("#edrates1").show();
                  $("#edrate30").hide();
                  $("#edrate50").hide();
                }

                $('#edpaymentmode').val(response.data.paymentmode);
                $('#edpaid').val(response.data.paid);

              }
            });
          });

          $("#bookupdation").click(function(e) {
            e.preventDefault();
            var ids = $('#ed_bookid').val();
            var creationdate = $('#edcreationdate').val();
            var runningdate = $('#edrunningdate').val();
        var value = $('#edpartyname').val();
            var partyid = $('#ed_parties [value="' + value + '"]').data('value');
            // alert(partyid)
            var type = $('#edtypes').val();
            var route = $('#edroute').val();
            var origin = $('#edorigin').val();
            var destination = $('#eddestination').val();
            var coraddress = $('#edcoraddress').val();
            var conaddress = $('#edconaddress').val();
            var pod = $('#edpod').val();
            var area = $('#edarea').val();
            var trainname = $('#edtrainname').val();

            var transports = $('#edtransport').val();

            var packs = $('#edpacks').val();
            var invoiceno = $('#edinvoiceno').val();
            var describe = $('#eddescribe').val();
            var quantity = $('#edquantity').val();
            var gross = $('#edgross').val();
            var weight = $('#edweight').val();
            var rate = $('#edrate').val();
            var weight1 = $('#edweight1').val();
            var rate1 = $('#edrate1').val();
            var weight2 = $('#edweight2').val();
            var rate2 = $('#edrate2').val();
            var docs = $('#eddocs').val();
            var amount = $('#edamount').val();
            var othercharge = $('#edotherchg').val();
            var paymentmode = $('#edpaymentmode').val();
            var gst_types = $('#edgst_types').val();
            if (gst_types == "State") {
              $("#edigstamt").val(0);
              $("#edcgstamt").val();
              $("#edsgstamt").val();
            } else if (gst_types == "Interstate") {
              $("#edigstamt").val();
              $("#edcgstamt").val(0);
              $("#edsgstamt").val(0);
            }
            var igstamt = $("#edigstamt").val();
            var cgstamt = $("#edcgstamt").val();
            var sgstamt = $("#edsgstamt").val();

            var paid = $('#edpaid').val();
            $.ajax({
              url: 'ajax/ajax_request.php?action=bookupdation',
              type: 'POST',
              dataType: "JSON",
              data: {
                'action': "bookupdation",
                'ids': ids,
                'creationdate': creationdate,
                'rundate':runningdate,
                'partyid': partyid,
                'type': type,
                'route': route,
                'origin': origin,
                'destination': destination,
                'area': area,
                'coraddress': coraddress,
                'conaddress': conaddress,
                'pod': pod,
                'trainname': trainname,
                'transport': transports,
                'pack': packs,
                'invoiceno': invoiceno,
                'describe': describe,
                'quantity': quantity,
                'gross': gross,
                'weight': weight,
                'rate': rate,
                'weight1': weight1,
                'rate1': rate1,
                'weight2': weight2,
                'rate2': rate2,
                'docs': docs,
                'amount': amount,
                'othercharge': othercharge,
                'gst_types': gst_types,
                'igst': igstamt,
                'sgst': sgstamt,
                'cgst': cgstamt,
                'paymentmode': paymentmode,
                'paid': paid
              },
              success: function(response) {
                console.log(response.data)
                if (response.msg == "Success") {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'User Updated',
                    showConfirmButton: false,
                    timer: 3000
                  }).then(function() {
                    window.location.href = 'booking.php';
                  })
                } else {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'User Update Failed',
                    showConfirmButton: false,
                    timer: 3000
                  }).then(function() {
                    window.location.href = 'booking.php';
                  })
                }
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
  } else {
    header("location:login.php");
  }
    ?>