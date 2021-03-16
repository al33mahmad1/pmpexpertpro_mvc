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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=URLROOT?>/pages/home">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if(isAdmin()):?>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=$data['totalAssessmentsInSystem']?></h3>

                <p>Total Assessments In system</p>
              </div>
              <div class="icon">
                <i class="ion ion-plus"></i>
              </div>
              <a href="<?=URLROOT?>/assessments/list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=$data['totalUsersInSystem']?></h3>

                <p>Clients Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?=URLROOT?>/users/list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
           <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=$data['totalQuestionInAgileCategory']?></h3>

                <p>Questions in Agile</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?=URLROOT?>/questions/list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=$data['totalQuestionInScrumCategory']?></h3>

                <p>Questions in Scrum</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?=URLROOT?>/questions/list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main Row -->
        <!-- row -->
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Membership Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive  p-0"  style="height: 250px;">
                <table class="table table-striped text-sm table-head-fixed">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th style="width: 40px">Fee</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($data['membershipTable']) && $data['membershipTable']):?>
                      <?php $i = 1;?>
                    <?php foreach ($data['membershipTable'] as $membership):?>
                    <tr>
                      <td><?=$i?></td>
                      <td><?=ucfirst($membership['membership_name'])?></td>
                      <td><?=$membership['description']?></td>
                      <td class="text-md"><span class="badge bg-success">$ <?=$membership['membership_fee']?></span></td>
                    </tr>
                    <?php $i++;?>
                    <?php endforeach;?>
                    <?php endif;?>
                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Assessments Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive  p-0"  style="height: 250px;">
                <table class="table table-striped text-sm table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Category Name</th>
                      <th style="width: 40px">Questions Count</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($data['assessmentsTable']) && $data['assessmentsTable']):?>
                      <?php $i = 1;?>
                    <?php foreach ($data['assessmentsTable'] as $membership):?>
                    <tr>
                      <td><?=$i?></td>
                      <td><?=ucfirst($membership['assessment_name'])?></td>
                      <td><?=ucfirst($membership['assessment_category_name'])?></td>
                      <td class="text-center"><?=$membership['question_count']?></td>
                    </tr>
                    <?php $i++;?>
                    <?php endforeach;?>
                    <?php endif;?>
                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

        </div>
        <!-- /.row -->
        <?php else:?>
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?=ucfirst($_SESSION['PMP_USER_MEMBERSHIP'])?></h3>

                  <p>Membership Type</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bookmark"></i>
                </div>
              </div>
            </div>
          
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?=$data['yourAssessments']?></h3>

                  <p><?=ucfirst($_SESSION['PMP_USER_MEMBERSHIP'])?> Assessments</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?=$data['totalAssessmentsPending']?></h3>

                  <p>Assessments Pending</p>
                </div>
                <div class="icon">
                  <i class="ion ion-happy"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?=$data['totalAssessmentsAccomplished']?></h3>

                  <p>Assessments Accomplished</p>
                </div>
                <div class="icon">
                  <i class="ion ion-calendar"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main Row -->
          <!-- row -->
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Membership Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive  p-0"  style="height: 250px;">
                  <table class="table table-striped text-sm table-head-fixed">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th style="width: 40px">Fee</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(isset($data['membershipTable']) && $data['membershipTable']):?>
                        <?php $i = 1;?>
                      <?php foreach ($data['membershipTable'] as $membership):?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=ucfirst($membership['membership_name'])?></td>
                        <td><?=$membership['description']?></td>
                        <td><span class="badge bg-danger">$ <?=$membership['membership_fee']?></span></td>
                      </tr>
                      <?php $i++;?>
                      <?php endforeach;?>
                      <?php endif;?>
                    </tbody>

                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Assessments Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive  p-0"  style="height: 250px;">
                  <table class="table table-striped text-sm table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Category Name</th>
                        <th style="width: 40px">Questions Count</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(isset($data['assessmentsTable']) && $data['assessmentsTable']):?>
                        <?php $i = 1;?>
                      <?php foreach ($data['assessmentsTable'] as $membership):?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=ucfirst($membership['assessment_name'])?></td>
                        <td><?=ucfirst($membership['assessment_category_name'])?></td>
                        <td class="text-center"><?=$membership['question_count']?></td>
                      </tr>
                      <?php $i++;?>
                      <?php endforeach;?>
                      <?php endif;?>
                    </tbody>

                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>

          </div>
          <!-- /.row -->
        <?php endif;?>

        <!-- /.Main Row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<!-- jQuery -->
<script src="<?=URLROOT?>/public/plugins/jquery/jquery.min.js"></script>

<?php require APPROOT . "/views/inc/footer.php"; ?>