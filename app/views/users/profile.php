<?php require APPROOT . "/views/inc/header.php";  ?>
<?php require APPROOT . "/views/inc/navbar.php";  ?>
<?php require APPROOT . "/views/inc/sidebar.php";  ?>
	
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profile Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=URLROOT?>/pages/home">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-dark card-outline elevation-2">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?=URLROOT?>/public/img/profile/a.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?=$_SESSION['PMP_USER_NAME']?></h3>
                <p class="text-muted text-center"><?=$_SESSION['PMP_USER_EMAIL']?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Membership Type</b> <a class="float-right text-dark"><?=ucfirst($_SESSION['PMP_USER_MEMBERSHIP'])?></a>
                  </li>
                  <li class="list-group-item">
                    <b>User Type</b> <a class="float-right text-dark"><?=ucfirst($_SESSION['PMP_USER_ROLE'])?></a>
                  </li>
                </ul>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-8">
           <!-- /.card -->
            <!-- Change Password Form -->
            <div class="card card-dark card-outline elevation-2">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="javascript:void(0);">
                <div class="card-body">
                <div class="form-group row">
                    <label for="current_password" class="col-sm-4 col-form-label">Current Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="current_password" placeholder="Current Password">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label for="change_password" class="col-sm-4 col-form-label">New Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="change_password" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="change_password_confirm" class="col-sm-4 col-form-label">Confirm New Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="change_password_confirm" placeholder="Confirm Password">
                    </div>
                  </div>

                  <div class="alert alert-danger alert-dismissible" style="display: none;" id="error-message">A</div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-white rounded">
                  <button id="change_password_btn" class="btn btn-outline-dark float-right">Save Changes</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<input type="hidden" value="<?=URLROOT?>" id="urlroot">
<!-- jQuery -->
<script src="<?=URLROOT?>/public/plugins/jquery/jquery.min.js"></script>

<script type="module" src="<?=URLROOT?>/public/custom_js/users/changePassword.js"></script>

<?php require APPROOT . "/views/inc/footer.php"; ?>