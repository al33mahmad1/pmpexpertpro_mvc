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
            <h1 class="m-0">Clients</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=URLROOT?>/pages/home">Home</a></li>
              <li class="breadcrumb-item active">Clients List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <div class="row mx-2">
      <div class="col-12">
        <?php flash('error');?>
      </div><!-- /.col -->
    </div>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
         <!-- /.row -->
         <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Registered Clients</h3>


                <!-- <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User</th>
                      <th>email</th>
                      <th>Role</th>
                      <th>Membership</th>
                      <th>Member Since</th>
                      <!-- <th>Reason</th> -->
                    </tr>
                  </thead>
                  <?php if(isset($data['users']) && $data['users']):?>
                    <?php $i=1;?>
                  <tbody>
                  <?php foreach ($data['users'] as $user):?>
                    <tr  data-widget="expandable-table" aria-expanded="false">
                        <td><?php echo $i;?></td>
                        <td><?php echo $user['name'];?></td>
                        <td><?php echo $user['email'];?></td>
                        <td><?php echo ucfirst($user['role_name']);?></td>
                        <td><?php echo ucfirst($user['membership_name']);?></td>
                        <td><?php echo timeStampToFormattedDate($user['created_at']);?></td>
                    </tr>
                    <tr class="expandable-body">
                      <td colspan="6">
                        <div class="row">
                          <div class="col-md-6">
                          </div>
                          <div class="col-md-6">
                            <a href="<?=URLROOT?>/logs/loginLogs/<?=$user['id']?>" class="btn btn-outline-warning btn-sm ml-1 float-right">View Login Logs</a>
                            <a href="<?=URLROOT?>/logs/testLogs/<?=$user['id']?>" class="btn btn-outline-dark btn-sm ml-1 float-right">View Tests Logs</a>
                            <a href="<?=URLROOT?>/logs/resultVisitLogs/<?=$user['id']?>" class="btn btn-outline-primary btn-sm ml-1 float-right">View Results Visit Logs</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php $i++;?>
                    <?php endforeach;?>
                  </tbody>
                  <?php else:?>
                    <tbody>
                        <tr>
                            <td colspan="10" style="color:red;">No Clients.</td>
                        </tr>
                  </tbody>
                  <?php endif;?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!-- jQuery -->
<script src="<?=URLROOT?>/public/plugins/jquery/jquery.min.js"></script>
<?php require APPROOT . "/views/inc/footer.php"; ?>