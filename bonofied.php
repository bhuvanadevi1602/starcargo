<?php
session_start();
error_reporting(0);
$user_name = $_SESSION['user_name'];
include('include/config.php');
$dates = date("Y-m-d");
// print_r($user_name);die();
if ($user_name != "") {
  $types=$_SESSION['types'];
  $roles=$_SESSION['role'];
  include('header.php');
?>
  <!DOCTYPE html>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <!-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalLarge" style="float:right">
                  Add Booking
                </button> -->
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
                            <form class="row g-3 needs-validation" novalidate method="POST">

                              <div class="col-md-3">
                                <label for="validationCustom01" class="form-label">Date</label>
                                <input type="date" class="form-control" id="creationdate" name="creationdate" value="<?= $dates ?>" required>
                                <div class="invalid-feedback">
                                  Please provide a valid Date.
                                </div>
                              </div>
                              <div class="col-md-3">
                                <label for="validationCustom02" class="form-label">Type</label>
                                <select name="types" id="types" class="form-control">
                                  <option>Select Types</option>
                                  <option>Air</option>
                                  <option>Train</option>
                                </select>
                                <div class="invalid-feedback">
                                  Please provide a valid types.
                                </div>
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

                                <div class="invalid-feedback">
                                  Please provide a valid Orgin.
                                </div>
                              </div>

                              <div class="col-md-3">
                                <label for="validationCustom02" class="form-label">Destination</label>
                                <input list="destinations" class="form-control" name="destination" id="destination">
                                <datalist id="destinations">
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
                                <div class="invalid-feedback">
                                  Please provide a valid Destination.
                                </div>
                              </div>

                              <div class="col-md-12">
                                <label for="validationCustom05" class="form-label">Area</label>
                                <textarea class="form-control" id="area" name="area" required></textarea>
                                <div class="invalid-feedback">
                                  Please provide a valid zip.
                                </div>
                              </div>


                              <div class="col-md-4">
                                <label for="validationCustom03" class="form-label">Consignor</label>
                                <input type="text" class="form-control" id="coraddress" name="coraddress" required>
                                <div class="invalid-feedback">
                                  Please provide a valid Address.
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



                              <div class="col-md-4">
                                <label for="validationCustom03" class="form-label">Consignee</label>
                                <input type="text" class="form-control" id="conaddress" name="conaddress" required>
                                <div class="invalid-feedback">
                                  Please provide a valid Address.
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

                              <div class="col-md-4" id="validationCustom05">
                                <label for="validationCustom05" class="form-label">Transport</label>
                                <div class="col-md-12 mt-1">
                                  <div class="form-check form-check-inline">
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
                                  </div>
                                  <div class="invalid-feedback">
                                    Please provide a valid zip.
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
                                <div class="invalid-feedback">
                                  Please select a valid Packing.
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="validationCustom03" class="form-label">Party Invice No</label>
                                <input type="text" class="form-control" id="invoiceno" name="invoiceno" required>
                                <div class="invalid-feedback">
                                  Please provide a valid Party Invice No.
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="validationCustom05" class="form-label">Said to Content</label>
                                <input type="text" class="form-control" id="describe" name="describe" required>
                                <div class="invalid-feedback">
                                  Please provide a valid Said to Content.
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="validationCustom05" class="form-label">Quantity</label>
                                <input type="text" class="form-control" id="quantity" name="quantity" required>
                                <div class="invalid-feedback">
                                  Please provide a valid Quantity.
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="validationCustom05" class="form-label">Gross Weight</label>
                                <input type="text" class="form-control" id="gross" name="gross" required>
                                <div class="invalid-feedback">
                                  Please provide a valid Gross Weight.
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="validationCustom05" class="form-label">Charged Weight</label>
                                <input type="text" class="form-control" id="weight" name="weight" required>
                                <div class="invalid-feedback">
                                  Please provide a valid Charged Weight.
                                </div>
                              </div>

                              <div class="col-md-2">
                                <label for="validationCustom05" class="form-label">Doc Charge</label>
                                <input type="text" class="form-control" id="docs" name="docs" required value="50">
                                <div class="invalid-feedback">
                                  Please provide a valid Rate.
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="validationCustom05" class="form-label">Rate</label>
                                <input type="text" class="form-control" id="rate" name="rate" required>
                                <div class="invalid-feedback">
                                  Please provide a valid Rate.
                                </div>
                              </div>
                              <div class="col-md-2" style="text-align:center;">
                                <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">Amount</label>
                                <div class="col-sm-12">
                                  <input class="form-control" type="text" name="amount" id="amount">
                                  <!-- placeholder="0.00" style="text-align:center;font-weight: 800;font-size: 2.5rem;"  form-control-lg-->
                                </div>
                              </div>

                              <div class="col-md-2">
                                <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">GST Amount</label>
                                <div class="col-sm-12">
                                  <input type="text" name="gsts" id="gsts" value="5" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-2" style="text-align:center;position: relative;top:35px !important">
                                <input type="checkbox" name="gst" id="gst" value="GST"><span> GST(<span id="gstp">5%</span>)
                              </div>

                              <div class="col-md-2">
                                <label for="validationCustom04" class="form-label">Payment Type</label>
                                <select class="form-select" id="paymentmode" name="paymentmode" required style="position: relative;top:5px!important">
                                  <option selected disabled value="">Choose...</option>
                                  <option value="Bill">Bill</option>
                                  <option value="Cash">Cash</option>
                                  <option value="To Pay">To Pay</option>
                                </select>
                                <div class="invalid-feedback">
                                  Please select a valid Packing.
                                </div>
                              </div>

                              <div class="col-md-9"></div>
                              <div class="col-md-3" style="text-align:center;">
                                <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">Payment</label>
                                <div class="col-sm-12">
                                  <input class="form-control form-control-lg" type="text" name="paid" id="paid" placeholder="0.00" style="text-align:center;font-weight: 800;font-size: 2.5rem;">
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

              </div><!--end card-header-->
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="datatable_1">
                    <thead class="thead-light">
                      <tr>
                        <th>S.No</th>
                        <th data-type="date" data-format="YYYY/DD/MM">Date</th>
                        <th>Type</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Consignor Address</th>
                        <th>Consignee Address</th>
                        <th>Transport</th>
                        <th>Amount</th>
                        <th>GST</th>
                        <th>Payment</th>
                        <th colspan="2">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      if($roles=="Super Admin" && $types=="") {
                        $sqlbook = "select * from booking";
                      $exebook = $con->prepare($sqlbook);
                      $exebook->execute();
                      $resultbook = $exebook->fetchAll(PDO::FETCH_ASSOC);
                      }
                      else if($roles=="Admin" && ($types=="Air" || $types=="Train")) {
                        $sqlbook = "select * from booking where type=:types";
                        $exebook = $con->prepare($sqlbook);
                        $data=[':types'=>$types];
                      $exebook->execute($data);
                       $resultbook = $exebook->fetchAll(PDO::FETCH_ASSOC);
                      }
                      else if($roles=="Admin" && $types=="Train") {
                        $sqlbook = "select * from booking where type=:types";
                        $exebook = $con->prepare($sqlbook);
                        $data=[':types'=>$types];
                        $exebook->execute($data);
                       $resultbook = $exebook->fetchAll(PDO::FETCH_ASSOC);
                      }
                      foreach ($resultbook as $book) {
                        $i++;
                      ?>
                        <tr>
                          <td><?= $i ?></td>
                          <td><?= $book['creationdate'] ?></td>
                          <td><?= $book['type'] ?></td>
                         <td><?= $book['origin'] ?></td>
                          <td><?= $book['destination'] ?></td>
                          <td><?= $book['coraddress'] ?></td>
                          <td><?= $book['conaddress'] ?></td>
                          <td><?= $book['transport'] ?></td>
                          <td><?= $book['amount'] ?></td>
                          <td><?= ($book['gst'] != "") ? $book['gst'] : "-" ?></td>
                          <td><?= $book['paid'] ?></td>
                          <td>
                            <button type="button" class="btn btn-primary btn-sm edit_book" data-bs-toggle="modal" data-bs-target="#editbooking" ids="<?= $book['id'] ?>">
                              <i class="fa fa-pen"></i>
                            </button>
                          </td>
                          <td>
                            <form method="POST" action="">
                              <input type="hidden" name="bookdid" id="bookdid" value="<?= $book['id'] ?>" />
                              <button type="submit" class="btn btn-danger btn-sm bookingdeletion" name="bookingdeletion" id="bookingdeletion">
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
      <div class="modal fade bd-example-modal-lg" id="editbooking" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title m-0" id="myLargeModalLabel">Edit Booking</h6>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
              <div class="row">

                <div class="card-body">
                  <form class="row g-3 needs-validation" novalidate method="POST">
                    <input type="hidden" name="ed_bookid" id="ed_bookid" />
                    <div class="col-md-3">
                      <label for="validationCustom01" class="form-label">Date</label>
                      <input type="date" class="form-control" id="ed_creationdate" name="ed_creationdate" value="<?= $dates ?>" required>
                      <div class="invalid-feedback">
                        Please provide a valid Date.
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationCustom02" class="form-label">Type</label>
                      <select name="ed_types" id="ed_types" class="form-control">
                        <option>Select Types</option>
                        <option>Air</option>
                        <option>Train</option>
                      </select>
                      <div class="invalid-feedback">
                        Please provide a valid types.
                      </div>
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
                      <input list="origins" class="form-control" name="ed_origin" id="ed_origin">
                      <datalist id="origins">
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

                      <div class="invalid-feedback">
                        Please provide a valid Orgin.
                      </div>
                    </div>

                    <div class="col-md-3">
                      <label for="validationCustom02" class="form-label">Destination</label>
                      <input list="edorigins" class="form-control" name="ed_destination" id="ed_destination">
                      <datalist id="edorigins">
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
                        <div class="invalid-feedback">
                          Please provide a valid Destination.
                        </div>
                    </div>

                    <div class="col-md-12">
                      <label for="validationCustom05" class="form-label">Area</label>
                      <textarea class="form-control" id="ed_area" name="ed_area" required></textarea>
                      <div class="invalid-feedback">
                        Please provide a valid zip.
                      </div>
                    </div>


                    <div class="col-md-3">
                      <label for="validationCustom03" class="form-label">Consignor</label>
                      <input type="text" class="form-control" id="ed_coraddress" name="ed_coraddress" required>
                      <div class="invalid-feedback">
                        Please provide a valid Address.
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
                      <label for="validationCustom03" class="form-label">Consignee</label>
                      <input type="text" class="form-control" id="ed_conaddress" name="ed_conaddress" required>
                      <div class="invalid-feedback">
                        Please provide a valid Address.
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

                    <div class="col-md-6" id="validationCustom05">
                      <label for="validationCustom05" class="form-label">Transport</label>
                      <div class="col-md-12 mt-1">
                        <input type="hidden" id="edtransports" name="edtransports" value="">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input sample" type="checkbox" id="mar" name="edtransport" value="MAR">
                          <label class="form-check-label" for="inlineCheckbox1">MAR</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input sample" type="checkbox" id="sar" name="edtransport" value="SAR">
                          <label class="form-check-label" for="inlineCheckbox2">SAR</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input sample" type="checkbox" id="amt" name="edtransport" value="AMT">
                          <label class="form-check-label" for="inlineCheckbox3">AMT</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input sample" type="checkbox" id="others" name="edtransport" value="Others">
                          <label class="form-check-label" for="inlineCheckbox4">Others</label>
                        </div>
                        <div class="invalid-feedback">
                          Please provide a valid zip.
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
                      <input class="form-control" list="pack" name="ed_packs" id="ed_packs">

                      <datalist id="pack">
                        <option>G/B</option>
                        <option>P/B</option>
                        <option>Box</option>
                      </datalist>
                      <div class="invalid-feedback">
                        Please select a valid Packing.
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="validationCustom03" class="form-label">Party Invice No</label>
                      <input type="text" class="form-control" id="ed_invoiceno" name="ed_invoiceno" required>
                      <div class="invalid-feedback">
                        Please provide a valid Party Invice No.
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="validationCustom05" class="form-label">Said to Content</label>
                      <input type="text" class="form-control" id="ed_describe" name="ed_describe" required>
                      <div class="invalid-feedback">
                        Please provide a valid Said to Content.
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="validationCustom05" class="form-label">Quantity</label>
                      <input type="text" class="form-control" id="ed_quantity" name="ed_quantity" required>
                      <div class="invalid-feedback">
                        Please provide a valid Quantity.
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="validationCustom05" class="form-label">Gross Weight</label>
                      <input type="text" class="form-control" id="ed_gross" name="ed_gross" required>
                      <div class="invalid-feedback">
                        Please provide a valid Gross Weight.
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="validationCustom05" class="form-label">Charged Weight</label>
                      <input type="text" class="form-control" id="ed_weight" name="ed_weight" required>
                      <div class="invalid-feedback">
                        Please provide a valid Charged Weight.
                      </div>
                    </div>

                    <div class="col-md-2">
                      <label for="validationCustom05" class="form-label">Doc Charge</label>
                      <input type="text" class="form-control" id="ed_docs" name="ed_docs" required value="50">
                      <div class="invalid-feedback">
                        Please provide a valid Rate.
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="validationCustom05" class="form-label">Rate</label>
                      <input type="text" class="form-control" id="ed_rate" name="ed_rate" required>
                      <div class="invalid-feedback">
                        Please provide a valid Rate.
                      </div>
                    </div>
                    <div class="col-md-2" style="text-align:center;">
                      <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">Amount</label>
                      <div class="col-sm-12">
                        <input class="form-control" type="text" name="ed_amount" id="ed_amount">
                        <!-- placeholder="0.00" style="text-align:center;font-weight: 800;font-size: 2.5rem;"  form-control-lg-->
                      </div>
                    </div>

                    <div class="col-md-2">
                      <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">GST Amount</label>
                      <div class="col-sm-12">
                        <input type="text" name="ed_gsts" id="ed_gsts" value="5" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-2" style="text-align:center;position: relative;top:35px !important">
                      <input type="checkbox" name="ed_gst" id="ed_gst" value="GST"><span> GST(<span id="gstp">5%</span>)
                    </div>

                    <div class="col-md-2">
                      <label for="validationCustom04" class="form-label">Payment Type</label>
                      <select class="form-select" id="ed_paymentmode" name="ed_paymentmode" required style="position: relative;top:5px!important">
                        <option selected disabled value="">Choose...</option>
                        <option value="Bill">Bill</option>
                        <option value="Cash">Cash</option>
                        <option value="To Pay">To Pay</option>
                      </select>
                      <div class="invalid-feedback">
                        Please select a valid Packing.
                      </div>
                    </div>

                    <div class="col-md-9"></div>
                    <div class="col-md-3" style="text-align:center;">
                      <label for="validationCustom05" class="form-label" style="font-weight:1000;color:#6d81f5;">Payment</label>
                      <div class="col-sm-12">
                        <input class="form-control form-control-lg" type="text" name="ed_paid" id="ed_paid" placeholder="0.00" style="text-align:center;font-weight: 800;font-size: 2.5rem;">
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


      <script src="assets/pages/form-validation.js"></script>
      <!-- App js -->
      <script src="assets/js/app.js"></script>
      <script src="assets/plugins/datatables/simple-datatables.js"></script>
      <script src="assets/pages/datatable.init.js"></script>

      <!-- App js -->
      <script src="assets/js/app.js"></script>
      <script>
        $(document).ready(function() {
          $("#gsts").keyup(function() {
            var gstv = $("#gsts").val();
            $("#gstp").text(gstv + "%");

            var gst = $("input[id='gst']:checked").val();
            if (gst != '') {
              var gsts = $("#gsts").val();
              if (gst == "GST") {
                var amount = $("#amount").val();
                var gsttot = ((amount * gsts) / 100);
                var gstamt = parseFloat(amount) + parseFloat(gsttot);
                $("#paid").val(gstamt);
              } else {
                var amount = $("#amount").val();
                $("#paid").val(amount);
              }

              var rates = $("#rate").val();
              var weights = $("#weight").val();
              var tot = rates * weights;
              // alert(tot)
              var doc = $("#docs").val();
              var tots = parseFloat(tot) + parseFloat(doc);
              $("#amount").val(tots);
            }
          });


          $("#ed_gsts").keyup(function() {
            var gstv = $("#ed_gsts").val();
            $("#ed_gstp").text(gstv + "%");

            var gst = $("input[id='ed_gst']:checked").val();
            if (gst != '') {
              var gsts = $("#ed_gsts").val();
              if (gst == "GST") {
                var amount = $("#ed_amount").val();
                var gsttot = ((amount * gsts) / 100);
                var gstamt = parseFloat(amount) + parseFloat(gsttot);
                $("#ed_paid").val(gstamt);
              } else {
                var amount = $("#ed_amount").val();
                $("#ed_paid").val(amount);
              }

              var rates = $("#ed_rate").val();
              var weights = $("#ed_weight").val();
              var tot = rates * weights;
              // alert(tot)
              var doc = $("#ed_docs").val();
              var tots = parseFloat(tot) + parseFloat(doc);
              $("#ed_amount").val(tots);
            }
          });

          $("#docs").keyup(function() {
            var gstv = $("#gsts").val();
            $("#gstp").text(gstv + "%");

            var gst = $("input[id='gst']:checked").val();
            if (gst != '') {
              var gsts = $("#gsts").val();
              if (gst == "GST") {
                var amount = $("#amount").val();
                var gsttot = ((amount * gsts) / 100);
                var gstamt = parseFloat(amount) + parseFloat(gsttot);
                $("#paid").val(gstamt);
              } else {
                var amount = $("#amount").val();
                $("#paid").val(amount);
              }

              var rates = $("#rate").val();
              var weights = $("#weight").val();
              var tot = rates * weights;
              // alert(tot)
              var doc = $("#docs").val();
              var tots = parseFloat(tot) + parseFloat(doc);
              $("#amount").val(tots);
            }
          });

          $("#ed_docs").keyup(function() {
            var gstv = $("#ed_gsts").val();
            $("#ed_gstp").text(gstv + "%");

            var gst = $("input[id='ed_gst']:checked").val();
            if (gst != '') {
              var gsts = $("#ed_gsts").val();
              if (gst == "GST") {
                var amount = $("#ed_amount").val();
                var gsttot = ((amount * gsts) / 100);
                var gstamt = parseFloat(amount) + parseFloat(gsttot);
                $("#ed_paid").val(gstamt);
              } else {
                var amount = $("#ed_amount").val();
                $("#ed_paid").val(amount);
              }

              var rates = $("#ed_rate").val();
              var weights = $("#ed_weight").val();
              var tot = rates * weights;
              // alert(tot)
              var doc = $("#ed_docs").val();
              var tots = parseFloat(tot) + parseFloat(doc);
              $("#ed_amount").val(tots);
            }
          });

          $("input[type='checkbox']").click(function() {
            var gst = $("input[id='gst']:checked").val();
            var gsts = $("#gsts").val();
            if (gst == "GST") {
              var amount = $("#amount").val();
              var gsttot = ((amount * gsts) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot);
              $("#paid").val(gstamt);
            } else {
              var amount = $("#amount").val();
              $("#paid").val(amount);
            }


            var edgst = $("input[id='gst']:checked").val();
            var gsts = $("#gsts").val();
            if (edgst == "GST") {
              var edamount = $("#amount").val();
              var edgsttot = ((edamount * gsts) / 100);
              var edgstamt = parseFloat(edamount) + parseFloat(edgsttot);
              $("#paid").val(edgstamt);
            } else {
              var edamount = $("#amount").val();
              $("#paid").val(edamount);
            }

          });

          $("input[type='checkbox']").click(function() {
            var gst = $("input[id='ed_gst']:checked").val();
            var gsts = $("#ed_gsts").val();
            if (gst == "GST") {
              var amount = $("#ed_amount").val();
              var gsttot = ((amount * gsts) / 100);
              var gstamt = parseFloat(amount) + parseFloat(gsttot);
              $("#ed_paid").val(gstamt);
            } else {
              var amount = $("#ed_amount").val();
              $("#ed_paid").val(amount);
            }


            var edgst = $("input[id='ed_gst']:checked").val();
            var gsts = $("#ed_gsts").val();
            if (edgst == "GST") {
              var edamount = $("#ed_amount").val();
              var edgsttot = ((edamount * gsts) / 100);
              var edgstamt = parseFloat(edamount) + parseFloat(edgsttot);
              $("#ed_paid").val(edgstamt);
            } else {
              var edamount = $("#ed_amount").val();
              $("#ed_paid").val(edamount);
            }

          });

          $("#amount").keyup(function() {
            var gst = $("input[id='gst']:checked").val();
            var gsts = $("#gsts").val();
            if (gst == "GST") {
              var amount = $("#amount").val();
              var gsttot = (amount * gsts) / 100;
              var gstamt = parseFloat(amount) + parseFloat(gsttot);
              $("#paid").val(gstamt);
            } else {
              var amount = $("#amount").val();
              $("#paid").val(amount);
            }
          });

          $("#ed_amount").keyup(function() {
            var gst = $("input[id='ed_gst']:checked").val();
            var gsts = $("#ed_gsts").val();
            if (gst == "GST") {
              var amount = $("#ed_amount").val();
              var gsttot = (amount * gsts) / 100;
              var gstamt = parseFloat(amount) + parseFloat(gsttot);
              $("#ed_paid").val(gstamt);
            } else {
              var amount = $("#ed_amount").val();
              $("#ed_paid").val(amount);
            }
          });

          $("#weight").keyup(function() {
            var rates = $("#rate").val();
            var weights = $("#weight").val();
            var tot = rates * weights;
            var doc = $("#docs").val();
            var tots = parseFloat(tot) + parseFloat(doc);
            $("#amount").val(tots);
          });

          $("#ed_weight").keyup(function() {
            var rates = $("#ed_rate").val();
            var weights = $("#ed_weight").val();
            var tot = rates * weights;
            var doc = $("#ed_docs").val();
            var tots = parseFloat(tot) + parseFloat(doc);
            $("#ed_amount").val(tots);

            var gst = $("input[id='ed_gst']:checked").val();
            if (gst != '') {
              var gsts = $("#ed_gsts").val();
              if (gst == "GST") {
                var amount = $("#ed_amount").val();
                var gsttot = ((amount * gsts) / 100);
                var gstamt = parseFloat(amount) + parseFloat(gsttot);
                $("#ed_paid").val(gstamt);
              } else {
                var amount = $("#amount").val();
                $("#ed_paid").val(amount);
              }

              var rates = $("#ed_rate").val();
              var weights = $("#ed_weight").val();
              var tot = rates * weights;
              // alert(tot)
              var doc = $("#ed_docs").val();
              var tots = parseFloat(tot) + parseFloat(doc);
              $("#ed_amount").val(tots);
            }

          });

          $("#docs").keyup(function() {
            var rates = $("#rate").val();
            var weights = $("#weight").val();
            var tot = rates * weights;
            var doc = $("#docs").val();
            var tots = parseFloat(tot) + parseFloat(doc);
            $("#amount").val(tots);
          });

          $("#ed_docs").keyup(function() {
            var rates = $("#ed_rate").val();
            var weights = $("#ed_weight").val();
            var tot = rates * weights;
            var doc = $("#ed_docs").val();
            var tots = parseFloat(tot) + parseFloat(doc);
            $("#ed_amount").val(tots);
          });

          $("#rate").keyup(function() {
            var rates = $("#rate").val();
            var weights = $("#weight").val();
            var tot = rates * weights;
            // alert(tot)
            var doc = $("#docs").val();
            var tots = parseFloat(tot) + parseFloat(doc);
            $("#amount").val(tots);
          });

          $("#ed_rate").keyup(function() {
            var rates = $("#ed_rate").val();
            var weights = $("#ed_weight").val();
            var tot = rates * weights;
            // alert(tot)
            var doc = $("#ed_docs").val();
            var tots = parseFloat(tot) + parseFloat(doc);
            $("#ed_amount").val(tots);
          });


          $("#bookcreation").click(function(e) {
            e.preventDefault();
            var creationdate = $('#creationdate').val();
            var type = $('#types').val();
            var origin = $('#origin').val();
            var destination = $('#destination').val();
            var area = $('#area').val();
            var coraddress = $('#coraddress').val();
            var conaddress = $('#conaddress').val();

            var transport = [];
            $.each($("input[name='transport']:checked"), function() {
              transport.push($(this).val());
            });
            transports = transport.toString();


            var packs = $('#packs').val();
            var invoiceno = $('#invoiceno').val();
            var describe = $('#describe').val();
            var quantity = $('#quantity').val();
            var gross = $('#gross').val();
            var weight = $('#weight').val();
            var docs = $('#docs').val();
            var rate = $('#rate').val();
            var amount = $('#amount').val();
            var gsts = $('#gsts').val();
            var gst = $('#gst').val();
            var paymentmode = $('#paymentmode').val();
            var paid = $('#paid').val();

            $.ajax({
              url: 'ajax/ajax_request.php?action=bookcreation',
              type: 'POST',
              dataType: "JSON",
              data: {
                'action': "bookcreation",
                'creationdate': creationdate,
                'type': type,
                'origin': origin,
                'destination': destination,
                'area': area,
                'coraddress': coraddress,
                'conaddress': conaddress,
                'transport': transports,
                'pack': packs,
                'invoiceno': invoiceno,
                'describe': describe,
                'quantity': quantity,
                'gross': gross,
                'weight': weight,
                'docs': docs,
                'rate': rate,
                'amount': amount,
                'gsts': gsts,
                'gst': gst,
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
                    timer: 1500
                  }).then(function() {
                    window.location.href = 'booking.php';
                  })
                } else {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Booking Failed',
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function() {
                    window.location.href = 'booking.php';
                  })
                }
              }
            });
          });
          $(".bookingdeletion").click(function(e) {
            e.preventDefault();
            var bookdid = $("#bookdid").val();
            //  alert(userdid)
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
                    timer: 2000
                  }).then(function() {
                    window.location.href = 'booking.php';
                  })
                } else {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Booking Delete Failed',
                    showConfirmButton: false,
                    timer: 2000
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
            // alert(bookeid)
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
                $('#ed_types').val(response.data.type);
                $('#ed_origin').val(response.data.origin);
                $('#ed_destination').val(response.data.destination);
                $('#ed_coraddress').val(response.data.coraddress);
                $('#ed_conaddress').val(response.data.conaddress);
                $('#ed_area').val(response.data.area);

                $("#edtransports").val(response.data.transport);
                var transport = $("#edtransports").val();
                var commas = transport.split(',');
                var desti = [];
                for (var i = 0; i < commas.length; i++) {
                  desti.push(commas[i]);
                }

                $.each(desti, function(index, value) {
                  // alert( index + ": " + value );
                  let val = value.toLowerCase();
                  $('#' + val).prop('checked', true);
                });


                $('#ed_packs').val(response.data.pack);
                $('#ed_rate').val(response.data.rate);
                $('#ed_invoiceno').val(response.data.invoiceno);
                $('#ed_describe').val(response.data.description);
                $('#ed_quantity').val(response.data.quantity);
                $('#ed_gross').val(response.data.gross);
                $('#ed_weight').val(response.data.weight);
                $('#ed_amount').val(response.data.amount);
                if (response.data.gst == "GST") {
                  $('#ed_gst').prop('checked', true);
                } else {
                  $('#ed_gst').prop('checked', false);
                }
                $('#ed_paymentmode').val(response.data.paymentmode);
                $('#ed_paid').val(response.data.paid);

              }
            });
          });

          $("#bookupdation").click(function(e) {
            e.preventDefault();
            var ids = $('#ed_bookid').val();
            var creationdate = $('#ed_creationdate').val();
            var type = $('#ed_types').val();
            var origin = $('#ed_origin').val();
            var destination = $('#ed_destination').val();
            var coraddress = $('#ed_coraddress').val();
            var conaddress = $('#ed_conaddress').val();
            var area = $('#ed_area').val();

            var transport = [];
            $.each($("input[name='edtransport']:checked"), function() {
              transport.push($(this).val());
            });
            transports = transport.toString();

            var packs = $('#ed_spacks').val();
            var invoiceno = $('#ed_invoiceno').val();
            var describe = $('#ed_describe').val();
            var quantity = $('#ed_quantity').val();
            var gross = $('#ed_gross').val();
            var weight = $('#ed_weight').val();
            var docs = $('#ed_docs').val();
            var rate = $('#ed_rate').val();
            var amount = $('#ed_amount').val();
            var gsts = $('#ed_gsts').val();
            var paymentmode = $('#ed_paymentmode').val();
            var paid = $('#ed_paid').val();

            var edgst = $("input[id='ed_gst']:checked").val();
            if (edgst == "GST") {
              gst = "GST";
            } else {
              gst = "";
            }

            $.ajax({
              url: 'ajax/ajax_request.php?action=bookupdation',
              type: 'POST',
              dataType: "JSON",
              data: {
                'action': "bookupdation",
                'ids': ids,
                'creationdate': creationdate,
                'type': type,
                'origin': origin,
                'destination': destination,
                'area': area,
                'coraddress': coraddress,
                'conaddress': conaddress,
                'transport': transports,
                'pack': packs,
                'invoiceno': invoiceno,
                'describe': describe,
                'quantity': quantity,
                'gross': gross,
                'weight': weight,
                'docs': docs,
                'rate': rate,
                'amount': amount,
                'gsts': gsts,
                'gst': gst,
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
                    timer: 2000
                  }).then(function() {
                    window.location.href = 'booking.php';
                  })
                } else {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'User Update Failed',
                    showConfirmButton: false,
                    timer: 2000
                  }).then(function() {
                    window.location.href = 'booking.php';
                  })
                }
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