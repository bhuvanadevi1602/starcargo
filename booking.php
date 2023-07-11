<?php
session_start();
error_reporting(0);
$user_name = $_SESSION['user_name'];
include('include/config.php');
$dates=date("Y-m-d");
// print_r($user_name);die();
if($user_name!="") { 
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
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalLarge" style="float:right">
                                                        Add Booking
                                                    </button>
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
                                <h4 class="card-title"style="color:#22b783;">Customer Details</h4>
                                     </div><!--end card-header-->
                                     
                                     
                            <div class="card-body">
                                <form class="row g-3 needs-validation" novalidate method="POST">
                                    
                                    <div class="col-md-3">
                                      <label for="validationCustom01" class="form-label">Date</label>
                                      <input type="date" class="form-control" id="creationdate" name="creationdate" value="<?=$dates?>" required>
                                      <div class="invalid-feedback">
                                        Please provide a valid Date.
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
                                      <div class="invalid-feedback">
                                        Please select a valid state.
                                      </div>
                                    </div>
                                    
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
</datalist> <div class="invalid-feedback">
                                        Please provide a valid Destination.
                                      </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                      <label for="validationCustom03" class="form-label">Consignor Address</label>
                                      <input type="text" class="form-control" id="coraddress" name="coraddress" required>
                                      <div class="invalid-feedback">
                                        Please provide a valid Address.
                                      </div>
                                    </div>
                                    <div class="col-md-3">
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
                                    </div>
                                    <div class="col-md-3">
                                      <label for="validationCustom05" class="form-label">Zip</label>
                                      <input type="number" class="form-control" id="corzip" name="corzip" required>
                                      <div class="invalid-feedback">
                                        Please provide a valid zip.
                                      </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-md-6">
                                      <label for="validationCustom03" class="form-label">Consignee Address</label>
                                      <input type="text" class="form-control" id="conaddress" name="conaddress" required>
                                      <div class="invalid-feedback">
                                        Please provide a valid Address.
                                      </div>
                                    </div>
                                    <div class="col-md-3">
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
                                    </div>
                                    <div class="col-md-3">
                                      <label for="validationCustom05" class="form-label">Zip</label>
                                      <input type="number" class="form-control" id="conzip" name="conzip" required>
                                      <div class="invalid-feedback">
                                        Please provide a valid zip.
                                      </div>
                                    </div>

                                    <div class="col-md-1">
                                    </div>

                                    <div class="col-md-5">
                                      <label for="validationCustom05" class="form-label">Area</label>
                                      <input type="text" class="form-control" id="area" name="area" required>
                                      <div class="invalid-feedback">
                                        Please provide a valid zip.
                                      </div>
                                    </div>

                                    <div class="col-md-1">
                                    </div>

                                    <div class="col-md-4" id="validationCustom05">
                                                                <label for="validationCustom05" class="form-label">Transport</label>
                                                                <div class="col-md-12 mt-1">

                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input sample" type="checkbox" id="transport" name="transport" value="HAR">
                                                                        <label class="form-check-label" for="inlineCheckbox1">HAR</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input sample" type="checkbox" id="transport" name="transport" value="SAR">
                                                                        <label class="form-check-label" for="inlineCheckbox2">SAR</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input sample" type="checkbox" id="transport" name="transport" value="AMR">
                                                                        <label class="form-check-label" for="inlineCheckbox3">AMR</label>
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
                                <h4 class="card-title"style="color:#ff9f43;">Package Details</h4>
                                     </div><!--end card-header-->
                                      
                                    <div class="col-md-2">
                                      <label for="validationCustom04" class="form-label">Types of packing</label>
                                      <!-- <select class="form-select" id="validationCustom04" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option>...</option>
                                      </select> -->
                                      <input class="form-control"  list="pack" name="packs" id="packs">

<datalist id="pack">
  <option>Type Here</option>
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
                                    
                                    <div class="col-md-5"></div>
                                    <div class="col-md-3" style="text-align:center;">
                                            <label for="validationCustom05" class="form-label"style="font-weight:1000;color:#6d81f5;">Amount</label>
                                            <div class="col-sm-12">
                                                <input class="form-control form-control-lg" type="text" name="amount"  id="amount" placeholder="0.00" style="text-align:center;font-weight: 800;font-size: 2.5rem;">
                                            </div>
                                        </div>

                                        <div class="col-md-2" style="text-align:center;position: relative;top:50px !important">
                                            <div class="col-sm-12">
                                                <input type="checkbox" name="gst" id="gst" value="GST"> GST
                                            </div>
                                        </div>
                                        
                                   <div class="col-md-2">
                                      <label for="validationCustom04" class="form-label">Payment Type</label>
                                      <select class="form-select" id="paymentmode" name="paymentmode" required style="position: relative;top:15px!important">
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
                                    <div class="col-md-3"style="text-align:center;">
                                            <label for="validationCustom05" class="form-label"style="font-weight:1000;color:#6d81f5;">Payment</label>
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
                                         <th>Origin</th>
                                         <th>Destination</th>
                                            <th>Consignor Address</th>
                                            <th>Consignee Address</th>
                                            <th>Amount</th>
                                            <th>GST</th>
                                            <th>Payment</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                          $i=0;
                                            $sqlbook="select * from booking";
                                            $exebook=$con->prepare($sqlbook);
                                            $exebook->execute();
                                            $resultbook=$exebook->fetchAll(PDO::FETCH_ASSOC);
                                            foreach($resultbook as $book)
                                          {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?=$i?></td>
                                                <td><?=$book['creationdate']?></td>
                                                <td><?=$book['origin']?></td>
                                                <td><?=$book['destination']?></td>
                                                <td><?=$book['coraddress']?></td>
                                                <td><?=$book['conaddress']?></td>
                                                <td><?=$book['amount']?></td>
                                                <td><?=$book['gst']?></td>
                                                <td><?=$book['payment']?></td>
                                                <td>
                                                <button type="button" class="btn btn-primary btn-sm edit_" data-bs-toggle="modal" data-bs-target="#editbooking" ids="<?= $book['id'] ?>">
                                  <i class="fa fa-pen"></i>
                                </button>
                                                </td>
                                                <td>
                                                <form method="POST" action="">
                                  <input type="hidden" name="delid" id="delid" value="<?= $res['id'] ?>" />
                                  <!-- <input type="submit" class="btn btn-danger btn-sm userdeletion" name="userdeletion" id="userdeletion" value="Delete"> -->
                                  <button type="submit" class="btn btn-danger btn-sm userdeletion" name="userdeletion" id="userdeletion">
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
            
           <script src="assets/pages/form-validation.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script src="assets/plugins/datatables/simple-datatables.js"></script>
    <script src="assets/pages/datatable.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
<script>
   $(document).ready(function() {
              $("input[type='checkbox']").click(function() {
                    var gst = $("input[id='gst']:checked").val();
                if (gst == "GST") {
                  var amount=$("#amount").val();
                  var gstamt=(amount*5)/100;
                        $("#paid").val(gstamt);
                        }
                        else{
                          var amount=$("#amount").val();
                          $("#paid").val(amount);
                       }
                      })
                    });

                    $("#amount").keyup(function(){
                      var gst = $("input[id='gst']:checked").val();
                      if (gst == "GST") {
                  var amount=$("#amount").val();
                  var gstamt=(amount*5)/100;
                        $("#paid").val(gstamt);
                        }
                        else{
                          var amount=$("#amount").val();
                          $("#paid").val(amount);
                       }
                      });

      $("#bookcreation").click(function(e) {
          e.preventDefault();
          var creationdate = $('#creationdate').val();
          var state = $('#state').val();
          var origin = $('#origin').val();
          var destination = $('#destination').val();
          var coraddress = $('#coraddress').val();
          var corstate = $('#corstate').val();
          var corzip = $('#corzip').val();
          var conaddress = $('#conaddress').val();
          var constate = $('#constate').val();
          var conzip = $('#conzip').val();
          var area = $('#area').val();

          var transport=[];
              $.each($("input[name='transport']:checked"), function(){
                transport.push($(this).val());
              });
              transports = transport.toString();
            
          var packs = $('#packs').val();
          var invoiceno = $('#invoiceno').val();
          var describe = $('#describe').val();
          var quantity = $('#quantity').val();
          var gross = $('#gross').val();
          var weight = $('#weight').val();
          var amount = $('#amount').val();
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
              'state': state,
              'origin': origin,
              'destination': destination,
              'coraddress': coraddress,
              'corstate': corstate,
              'corzip': corzip,
              'conaddress': conaddress,
              'constate': constate,
              'conzip': conzip,
              'area': area,
              'transport': transports,
              'pack': packs,
              'invoiceno': invoiceno,
              'describe': describe,
              'quantity': quantity,
              'gross': gross,
              'weight': weight,
              'amount': amount,
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

  </script>

</body>
</html>
<?php
include('footer.php');
}
else{
    header("location:login.php");
}
?> 