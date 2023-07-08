<?php
session_start();
$user_name = $_SESSION['user_name'];
include('include/config.php');
// print_r($user_name);die();
if($user_name!="") { 
include('header.php');
?>
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
                                    <li class="breadcrumb-item"><a href="#">Unikit</a></li>
                                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                    <li class="breadcrumb-item active">Datatables</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Datatables</h4>
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
                                <h4 class="card-title">Customers Details </h4>
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
                                <form class="row g-3 needs-validation" novalidate>
                                    <div class="col-md-4">
                                      <label for="validationCustom01" class="form-label">Date</label>
                                      <input type="date" class="form-control" id="validationCustom01"  required>
                                      <div class="invalid-feedback">
                                        Please provide a valid Date.
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <label for="validationCustom01" class="form-label">Party Name</label>
                                      <input type="text" class="form-control" id="validationCustom01"  required>
                                      <div class="invalid-feedback">
                                       Please provide a valid Party Name.
                                      </div>
                                    </div>
                                      <div class="col-md-3">
                                      <label for="validationCustom03" class="form-label">Mobile</label>
                                      <input type="number" class="form-control" id="validationCustom03" required>
                                      <div class="invalid-feedback">
                                        Please provide a valid Mobile.
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <label for="validationCustom02" class="form-label">Address</label>
                                      <input type="text" class="form-control" id="validationCustom02"  required>
                                      <div class="invalid-feedback">
                                        Please provide a valid Address.
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <label for="validationCustom04" class="form-label">State</label>
                                      <select class="form-select" id="validationCustom04" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option>...</option>
                                      </select>
                                      <div class="invalid-feedback">
                                        Please select a valid state.
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <label for="validationCustom05" class="form-label">Zip</label>
                                      <input type="number" class="form-control" id="validationCustom05" required>
                                      <div class="invalid-feedback">
                                        Please provide a valid zip.
                                      </div>
                                    </div>
                                    
                                    <div class="col-md-3" id="validationCustom05" >
                                            <label for="validationCustom05" class="form-label">Tranport Mode</label>
                                            <div class="col-md-12" >

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sample" type="checkbox" id="inlineCheckbox1" value="option1">
                                                    <label class="form-check-label" for="inlineCheckbox1">Air</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sample" type="checkbox" id="inlineCheckbox2" value="option2">
                                                    <label class="form-check-label" for="inlineCheckbox2">Train</label>
                                                </div>
                                              <div class="invalid-feedback">
                                        Please provide a valid zip.
                                      </div>
                                            </div>

                                        </div><!--end row-->  
                                  

                             
                                    
                                          <div class="col-md-3">
                                      <label for="validationCustom03" class="form-label">Air Prize</label>
                                      <input type="number" class="form-control" id="validationCustom03" required>
                                      <div class="invalid-feedback">
                                        Please provide a valid Air Prize.
                                      </div>
                                    </div>    <div class="col-md-3">
                                      <label for="validationCustom03" class="form-label">Trian Prize</label>
                                      <input type="number" class="form-control" id="validationCustom03" required>
                                      <div class="invalid-feedback">
                                        Please provide a valid Trian Prize.
                                      </div>
                                    </div>
                                    
                                    
                                       <div class="col-md-12" id="validationCustom05" >
                                            <label for="validationCustom05" class="form-label">Destination</label>
                                            <div class="col-md-12" >

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sample" type="checkbox" id="inlineCheckbox1" value="option1">
                                                    <label class="form-check-label" for="inlineCheckbox1">Delhi</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sample" type="checkbox" id="inlineCheckbox2" value="option2">
                                                    <label class="form-check-label" for="inlineCheckbox2">Agra</label>
                                                </div> 
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sample" type="checkbox" id="inlineCheckbox3" value="option1">
                                                    <label class="form-check-label" for="inlineCheckbox3">Delhi</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input sample" type="checkbox" id="inlineCheckbox3" value="option2">
                                                    <label class="form-check-label" for="inlineCheckbox4">Agra</label>
                                                </div>
                                              <div class="invalid-feedback">
                                        Please provide a valid zip.
                                      </div>
                                            </div>

                                        </div><!--end row-->  
                                    
                                    
                                    
                                    <div class="col-12">
                                      <button class="btn btn-primary" type="submit">Create Party</button>
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
                                            <th>Name</th>
                                            <th>Ext.</th>
                                            <th>City</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                                            <th>Completion</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Unity Pugh</td>
                                                <td>9958</td>
                                                <td>Curicó</td>
                                                <td>2005/02/11</td>
                                                <td>37%</td>
                                            </tr>
                                            <tr>
                                                <td>Theodore Duran</td><td>8971</td><td>Dhanbad</td><td>1999/04/07</td><td>97%</td>
                                            </tr>
                                            <tr>
                                                <td>Kylie Bishop</td><td>3147</td><td>Norman</td><td>2005/09/08</td><td>63%</td>
                                            </tr>
                                            <tr>
                                                <td>Willow Gilliam</td><td>3497</td><td>Amqui</td><td>2009/29/11</td><td>30%</td>
                                            </tr>
                                            <tr>
                                                <td>Blossom Dickerson</td><td>5018</td><td>Kempten</td><td>2006/11/09</td><td>17%</td>
                                            </tr>
                                            <tr>
                                                <td>Elliott Snyder</td><td>3925</td><td>Enines</td><td>2006/03/08</td><td>57%</td>
                                            </tr>
                                            <tr>
                                                <td>Castor Pugh</td><td>9488</td><td>Neath</td><td>2014/23/12</td><td>93%</td>
                                            </tr>
                                            <tr>
                                                <td>Pearl Carlson</td><td>6231</td><td>Cobourg</td><td>2014/31/08</td><td>100%</td>
                                            </tr>
                                            <tr>
                                                <td>Deirdre Bridges</td><td>1579</td><td>Eberswalde-Finow</td><td>2014/26/08</td><td>44%</td>
                                            </tr>
                                            <tr>
                                                <td>Daniel Baldwin</td><td>6095</td><td>Moircy</td><td>2000/11/01</td><td>33%</td>
                                            </tr>  
                                            <tr>
                                                <td>Pearl Carlson</td><td>6231</td><td>Cobourg</td><td>2014/31/08</td><td>100%</td>
                                            </tr>                                                                                        
                                        </tbody>
                                      </table>
                                         <button type="button" class="btn btn-sm btn-de-primary csv">Export CSV</button>
                                    <button type="button" class="btn btn-sm btn-de-primary sql">Export SQL</button>
                                    <button type="button" class="btn btn-sm btn-de-primary txt">Export TXT</button>
                                    <button type="button" class="btn btn-sm btn-de-primary json">Export JSON</button>
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
         
             <script src="assets/pages/form-validation.js"></script>
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
}
else{
    header("location:login.php");
}
?> 