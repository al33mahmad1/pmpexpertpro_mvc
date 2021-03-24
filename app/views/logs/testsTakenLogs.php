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
            <h1 class="m-0">Assessments Taken Logs</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Assessments Logs</li>
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
         <diiv class="row">
            <div class="col-md-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive  p-0">
                  <table class="table table-striped text-sm table-head-fixed">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Assessment Name</th>
                        <th>Date Accomplished</th>
                        <th>Total Questions</th>
                        <th>Correct Answers</th>
                        <th style="width: 40px">Percentage</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(isset($data['assessmentsHistory']) && $data['assessmentsHistory']):?>
                        <?php $i = 1;?>
                      <?php foreach ($data['assessmentsHistory'] as $assessment):?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=ucfirst($assessment['assessment_name'])?></td>
                        <td><?=timeStampToFormattedDateWithTime($assessment['date_done'])?></td>
                        <td><?=$assessment['totalQuestions']?></td>
                        <td><?=$assessment['score']?></td>
                        <?php
                          $per = ((int)($assessment['totalQuestions']) > 0)?(( 100 / (int)($assessment['totalQuestions'])) * (int)($assessment['score'])) : 0;
                        ?>
                        <?php if($per <= 0):?>
                          <td><span class="badge bg-danger"><?php echo $per;?> %</span></td>
                        <?php elseif($per > 0 && $per < 25):?>
                          <td><span class="badge bg-warning"><?php echo $per;?> %</span></td>
                        <?php elseif($per >= 25 && $per < 50):?>
                          <td><span class="badge bg-info"><?php echo $per;?> %</span></td>
                        <?php elseif($per >= 50 && $per < 75):?>
                          <td><span class="badge bg-info"><?php echo $per;?> %</span></td>
                        <?php elseif($per >= 75 && $per <= 100):?>
                          <td><span class="badge bg-success"><?php echo $per;?> %</span></td>
                        <?php endif;?>
                      </tr>
                      <?php $i++;?>
                      <?php endforeach;?>
                      <?php else:?>
                        <tr>
                            <td colspan="6" style="color:red;">No Exams taken yet.</td>
                        </tr>
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
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!-- jQuery -->
<script src="<?=URLROOT?>/public/plugins/jquery/jquery.min.js"></script>
<?php require APPROOT . "/views/inc/footer.php"; ?>