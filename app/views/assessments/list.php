<?php require APPROOT . "/views/inc/header.php";  ?>
<?php require APPROOT . "/views/inc/navbar.php";  ?>
<?php require APPROOT . "/views/inc/sidebar.php";  ?>

<link rel="stylesheet" href="<?=URLROOT?>/public/custom_css/assessment/assessment.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Assessments</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=URLROOT?>/pages/home">Home</a></li>
              <li class="breadcrumb-item active">Assessments</li>
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

    <div class="alert alert-danger alert-dismissible mx-3 hide" id="error_message"></div>
    <div class="alert alert-success alert-dismissible mx-3 hide" id="success_message"></div>

    <?php if(isAdmin()):?>
    <div class="row mx-2 mb-2">
      <div class="col-12">
      <button class="btn btn-dark btn-sm float-right" id="add_assessment_show_modal_btn">Add new assessment</button>
      </div><!-- /.col -->
    </div>
    <?php endif;?>



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
            
        <div class="row">
          <div class="col-12">
            <div class="card">
             
              <!-- card-body -->
              <div class="card-body p-2">

                <div class="row mb-3">
                  <div class="col-md-12 text-center">
                    <h1>Welcome</h1>
                  </div>
                </div>

                <!-- Small boxes (Stat box) -->
                <div class="row justify-content-center">

                <?php if(isset($data['assessments']) && $data['assessments']):?>
                  <?php foreach ($data['assessments'] as $assessment):?>

                    <div class="col-md-3 col-sm-4 col-lg-3 col-xs-4 px-5 py-3 mb-5 text-center rounded hover-affect">
                      <h4 class="text-gray"><?php echo $assessment['assessment_name'];?></h4>
                      <div class="bg-white">
                        <div class="icon text-center px-2 py-1">
                          <a class="<?php echo ($assessment['assessment_t_id'] == NULL)? "give_test_first_time": "retake_test";?>" type="button" data-assessment-id="<?=$assessment['assessment_id']?>" data-assessment-category-id="<?=$assessment['assessment_category_id']?>" data-exam-name="<?=$assessment['assessment_name']?>" data-assessment-t-id="<?php echo ($assessment['assessment_t_id'] == NULL)? false: $assessment['assessment_t_id'] ;?>" data-date-taken="<?php echo ($assessment['assessment_t_id'] == NULL)? "": timeStampToFormattedDate($assessment['date_done']);?>">
                            <img src="<?=URLROOT?>/public/img/assess/<?php echo ($assessment['assessment_t_id'] == NULL)? "pend": "done";?>.png" width="85%" height="150px" alt="">
                          </a>
                        </div>
                      </div>
                    </div>
                    <?php endforeach;?>
                  <?php endif;?>

                </div>
                <!-- /.row -->
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

  <input type="hidden" id="urlroot" value="<?=URLROOT?>">

  <!-- First Time TakeTest Modal -->
  <div class="modal fade" id="takeTestModal" tabindex="-1" role="dialog" aria-labelledby="takeTestModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="close float-right text-right mr-2 d-inline" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-body" id="map_content" style="width: 100%;">
            <div class="row py-4 justify-content-center">
                <div class="col-md-8">
                    <h1 class="text-center" id="first_time_take_test_heading" style="color: black;">Exam</h1>
                    <p class="text-center text-success mt-3 font-menu" id="invalidPromoCode_error_text">You've not taken this assessment yet</p>
                    <button type="button" id="first_time_test_button_start_btn" class="btn btn-success btn-sm btn-block mt-5 shadow">Start Assessment</button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Already Test Taken Modal -->
  <div class="modal fade" id="takeTestAgainModal" tabindex="-1" role="dialog" aria-labelledby="takeTestAgainModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="close float-right text-right mr-2 d-inline" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-body" style="width: 100%;">
            <div class="row py-4 justify-content-center">
                <div class="col-md-8">
                    <h1 id="second_time_take_test_heading" class="text-center" style="color: black;">Exam 01</h1>
                    <p class="text-center text-success mt-3 font-menu" id="invalidPromoCode_error_text">You've taken this assessment</p>
                    <p class="text-center text-success mt-3 font-menu" id="invalidPromoCode_error_text">On <span id="taken_date"></span></p>
                    <a href="" type="button" id="second_time_show_report_button" class="btn btn-outline-success btn-sm btn-block mt-2 shadow">View Score</a>
                    <p class="text-center text-success mt-3 font-menu" id="invalidPromoCode_error_text">or</p>
                    <button type="button" id="second_time_test_button_start_btn" class="btn btn-success btn-sm btn-block mt-2 shadow" data-dismiss="modal">Redo Assessment</button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add new Assessment Modal -->
  <div class="modal fade" id="add_assessment_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="add_assessmentModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="nav-icon fas fa-plus"></i> &nbsp;&nbsp; Add Assessment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
              <!-- Assessment name -->
              <p class="p-error" id="assessment_name_err"></p>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="nav-icon fas fa-utensils"></i></span>
                  </div>
                  <input type="text" id="assessment_name" class="form-control" placeholder="Assessment Name">
              </div>

              <!-- Select category -->
              <p class="p-error" id="assessment_category_err"></p>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-flag"></i></span>
                  </div>
                  <select class="form-control select2bs4" id="assessment_category">
                  </select>
              </div>

              <div class="input-group mb-3">
                  <button id="add_assessment_btn" class="btn btn-dark rounded form-control"><span id="add_res_show_hide_text" class="show">Add Assessment</span><span id="loading_show_hide_text" class="hide"><i class="fas fa-cog fa-spin"></i> Processing Request <span class="loader__dot">. </span><span class="loader__dot">. </span><span class="loader__dot">.</span></span></button>
              </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>

<!-- jQuery -->
<script src="<?=URLROOT?>/public/plugins/jquery/jquery.min.js"></script>
<script src="<?=URLROOT?>/public/custom_js/assessment/assessment.js"></script>
<script type="module" src="<?=URLROOT?>/public/custom_js/assessment/addAssessment.js"></script>

<?php require APPROOT . "/views/inc/footer.php"; ?>