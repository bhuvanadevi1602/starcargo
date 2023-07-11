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
                  Create User
                </button>
                <!--Start modal-header-->
                <div class="modal fade bd-example-modal-lg" id="exampleModalLarge" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title m-0" id="myLargeModalLabel">Create User</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div><!--end modal-header-->
                      <div class="modal-body">
                        <div class="row">


                          <div class="card-header">
                            <h4 class="card-title">Create User</h4>


                          </div><!--end card-header-->
                          <div class="card-body">
                            <form class="row g-3 needs-validation" novalidate action="" method="POST">
                              <div class="col-md-6">
                                <label for="creationdate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="creationdate" name="creationdate" value="<?= $dates ?>" required>
                                <div class="invalid-feedback">
                                  Please provide a creattion date
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label for="username" class="form-label">User Name</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                                <div class="valid-feedback">
                                  Please provide a valid User Name.
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div class="valid-feedback">
                                  Please provide a valid password.
                                </div>
                              </div>


                              <div class="col-md-6">
                                <label for="role" class="form-label">User Role</label>
                                <select class="form-select" id="role" required name="role">
                                  <option selected disabled value="">Choose...</option>
                                  <!-- <option>Super Admin</option> -->
                                  <option>Admin</option>
                                  <option>User</option>
                                </select>
                                <div class="invalid-feedback">
                                  Please provide a valid role.
                                </div>
                              </div>


                              <div class="col-12 text-center">
                                <input type="submit" name="usercreation" id="usercreation" class="btn btn-primary" value="Create User">
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


                <div class="modal fade bd-example-modal-lg" id="edituser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title m-0" id="myLargeModalLabel">Edit User</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div><!--end modal-header-->
                      <div class="modal-body">
                        <div class="row">


                          <div class="card-header">
                            <h4 class="card-title">Create User</h4>
                          </div><!--end card-header-->
                          <div class="card-body">
                            <form class="row g-3 needs-validation" novalidate action="" method="POST">
                              <input type="hidden" name="ed_userid" id="ed_userid" />
                              <div class="col-md-6">
                                <label for="creationdate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="ed_creationdate" name="ed_creationdate" value="<?= $dates ?>" required>
                                <div class="invalid-feedback">
                                  Please provide a creattion date
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label for="username" class="form-label">User Name</label>
                                <input type="text" class="form-control" id="ed_username" name="ed_username" required>
                                <div class="valid-feedback">
                                  Please provide a valid User Name.
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="ed_password" name="ed_password" required>
                                <div class="valid-feedback">
                                  Please provide a valid password.
                                </div>
                              </div>


                              <div class="col-md-6">
                                <label for="role" class="form-label">User Role</label>
                                <select class="form-select" id="ed_role" required name="ed_role">
                                  <option selected disabled value="">Choose...</option>
                                  <option>Super Admin</option>
                                  <option>Admin</option>
                                  <option>User</option>
                                </select>
                                <div class="invalid-feedback">
                                  Please provide a valid role.
                                </div>
                              </div>


                              <div class="col-12 text-center">
                                <input type="submit" name="ed_usercreation" id="ed_usercreation" class="btn btn-primary" value="Update User">
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
                        <th>Username</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th data-type="date" data-format="YYYY/DD/MM">Creation Date</th>
                        <th colspan="2">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $usersql = "select * from user";
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
                            <td><?= $res['username'] ?></td>
                            <td><?= $res['password'] ?></td>
                            <td><?= $res['role'] ?></td>
                            <td><?= $res['creationdate'] ?></td>
                            <td>
                              <?php if ($res['role'] != 'Super Admin') { ?>
                                <button type="button" class="btn btn-primary btn-sm edit_user" data-bs-toggle="modal" data-bs-target="#edituser" ids="<?= $res['id'] ?>">
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
                                  <input type="hidden" name="delid" id="delid" value="<?= $res['id'] ?>" />
                                  <!-- <input type="submit" class="btn btn-danger btn-sm userdeletion" name="userdeletion" id="userdeletion" value="Delete"> -->
                                  <button type="submit" class="btn btn-danger btn-sm userdeletion" name="userdeletion" id="userdeletion">
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
        $(".edit_user").click(function(e) {
          e.preventDefault();
          var usereid = $(this).attr("ids");
          $("#ed_userid").val(usereid);
          $.ajax({
            url: 'ajax/ajax_request.php?action=userfetch',
            type: 'POST',
            dataType: "JSON",
            data: {
              'action': "userfetch",
              'ids': usereid
            },
            success: function(response) {
              $("#ed_creationdate").val(response.data.creationdate);
              $("#ed_username").val(response.data.username);
              $("#ed_password").val(response.data.password);
              $("#ed_role").val(response.data.role);
            }
          });
        });

        $("#usercreation").click(function(e) {
          e.preventDefault();
          var creationdate = $('#creationdate').val();
          var username = $('#username').val();
          var password = $('#password').val();
          var role = $('#role').val();
          $.ajax({
            url: 'ajax/ajax_request.php?action=usercreation',
            type: 'POST',
            dataType: "JSON",
            data: {
              'action': "usercreation",
              'creationdate': creationdate,
              'username': username,
              'password': password,
              'role': role,
            },
            success: function(response) {
              if (response.msg == "Success") {
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'User Created',
                  showConfirmButton: false,
                  timer: 1500
                }).then(function() {
                  window.location.href = 'user.php';
                })
              } else {
                Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'User Create Failed',
                  showConfirmButton: false,
                  timer: 1500
                }).then(function() {
                  window.location.href = 'user.php';
                })
              }
            }
          });
        });

        $(".userdeletion").click(function(e) {
          e.preventDefault();
          var userdid = $("#delid").val();
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
                  timer: 1500
                }).then(function() {
                  window.location.href = 'user.php';
                })
              } else {
                Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'User Delete Failed',
                  showConfirmButton: false,
                  timer: 1500
                }).then(function() {
                  window.location.href = 'user.php';
                })
              }
            }
          });
        });
        
        $("#ed_usercreation").click(function(e) {
          e.preventDefault();
          var ids = $('#ed_userid').val();
          var creationdate = $('#ed_creationdate').val();
          var username = $('#ed_username').val();
          var password = $('#ed_password').val();
          var role = $('#ed_role').val();
          $.ajax({
            url: 'ajax/ajax_request.php?action=userupdation',
            type: 'POST',
            dataType: "JSON",
            data: {
              'action': "userupdation",
              'ids': ids,
              'creationdate': creationdate,
              'username': username,
              'password': password,
              'role': role,
            },
            success: function(response) {
              console.log(response.data)
              if (response.msg == "Success") {
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'User Updated',
                  showConfirmButton: false,
                  timer: 1500
                }).then(function() {
                  window.location.href = 'user.php';
                })
              } else {
                Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'User Update Failed',
                  showConfirmButton: false,
                  timer: 1500
                }).then(function() {
                  window.location.href = 'user.php';
                })
              }
            }
          });
        });

    

      });
    </script>