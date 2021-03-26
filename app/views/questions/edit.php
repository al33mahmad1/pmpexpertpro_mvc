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
            <h1 class="m-0 font-poppins">Edit Question</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=URLROOT?>/pages/home">Home</a></li>
              <li class="breadcrumb-item active">Questions</li>
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

    <div class="row mx-2">
      <div class="col-12">
            <div class="alert alert-danger alert-dismissible hide" id="error_message"></div>
            <div class="alert alert-success alert-dismissible hide" id="success_message"></div>
      </div><!-- /.col -->
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row pt-2 justify-content-center">
            <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible hide" id="error_message"></div>
            <?php flash("error");?>
            <div class="card card-white elevation-5 mb-5">
                <!-- <div class="card-header">
                <h3 class="card-title text-globalfoods"><i class="nav-icon fas fa-question"></i> &nbsp; <b>What's your restaurant's address?</b></h3>
                </div> -->
                <div class="card-body bg-white rounded">

                <div class="row">
                    <!-- Assess ID Select -->
                    <div class="col-md-6">
                        <!-- Country -->
                        <label for="assessment_id" class="assessment_id">Select Exam*</label>
                        <div class="input-group">
                            <select id="assessment_id" class="form-control select2bs4">
                                <?php if(isset($data['assessments']) && $data['assessments']):?>
                                    <?php foreach($data['assessments'] as $assessment):?>
                                        <option <?php echo ($data['question']['assessment_id'] == $assessment['assessment_id'])? "selected" : "" ;?> value="<?php echo $assessment['assessment_id']?> "<?php echo (isset($data['data']['country']) && $data['data']['country']=="Afghanistan")?"selected":"";?>><?=$assessment['assessment_name']?></option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>
                        </div>
                        <p class="p-error" id="assessment_id_err"></p>
                    </div>

                     <!-- Section ID Select -->
                     <div class="col-md-6">
                        <!-- Country -->
                        <label for="section_id" class="category_id">Select Question Section*</label>
                        <div class="input-group">
                            <select id="section_id" class="form-control select2bs4">
                            <?php if(isset($data['sections']) && $data['sections']):?>
                                    <?php foreach($data['sections'] as $section):?>
                                        <option <?php echo ($data['question']['section_id'] == $section['section_id'])? "selected" : "" ;?> value="<?php echo $section['section_id']?> "<?php echo (isset($data['data']['sectionId']) && $data['data']['sectionId']=="")?"selected":"";?>><?=ucfirst($section['section_name'])?></option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>
                        </div>
                        <p class="p-error" id="section_id_err"></p>
                    </div>
                    <!-- Question Statement -->
                    <div class="col-md-12">
                        <hr>
                        <label for="question_statement" class="question_statement">Question Statement*</label>
                        <div class="input-group">
                            <textarea class="form-control" id="question_statement" name="questionStatement" rows="3"><?php echo (isset($data['question']['question']))? $data['question']['question'] : "" ; ?></textarea>
                        </div>
                        <br>
                        <p class="p-error" id="question_statement_err"></p>
                    </div>

                    <div class="col-md-6">
                        <label for="option_a" class="option_a">Option A</label>
                        <div class="input-group mb-3">
                            <input type="text" id="option_a" class="form-control" placeholder="Option A" value="<?php echo (isset($data['question']['a']))? $data['question']['a'] : "" ; ?>">
                        </div>
                        <p class="p-error" id="option_a_err"></p>
                    </div>

                    <div class="col-md-6">
                        <label for="option_b" class="option_b">Option B</label>
                        <div class="input-group mb-3">
                            <input type="text" id="option_b" class="form-control" placeholder="Option B" value="<?php echo (isset($data['question']['b']))? $data['question']['b'] : "" ; ?>">
                        </div>
                        <p class="p-error" id="option_b_err"></p>
                    </div>

                    <div class="col-md-6">
                        <label for="option_c" class="option_c">Option C</label>
                        <div class="input-group mb-3">
                            <input type="text" id="option_c" class="form-control" placeholder="Option C" value="<?php echo (isset($data['question']['c']))? $data['question']['c'] : "" ; ?>">
                        </div>
                        <p class="p-error" id="option_c_err"></p>
                    </div>

                    <div class="col-md-6">
                        <label for="option_d" class="option_d">Option D</label>
                        <div class="input-group mb-3">
                            <input type="text" id="option_d" class="form-control" placeholder="Option D" value="<?php echo (isset($data['question']['d']))? $data['question']['d'] : "" ; ?>">
                        </div>
                        <p class="p-error" id="option_d_err"></p>
                    </div>

                    <div class="col-md-12">
                        <label for="correct_option" class="correct_option">Correct Option</label>
                        <div class="input-group mb-3">
                            <select id="correct_option" class="form-control select2bs4">
                                <option <?php echo ($data['question']['correct_option'] == 'a')? "selected" : "" ;?> value='a'>A</option>
                                <option <?php echo ($data['question']['correct_option'] == 'b')? "selected" : "" ;?> value='b'>B</option>
                                <option <?php echo ($data['question']['correct_option'] == 'c')? "selected" : "" ;?> value='c'>C</option>
                                <option <?php echo ($data['question']['correct_option'] == 'd')? "selected" : "" ;?> value='d'>D</option>
                            </select>
                        </div>
                        <p class="p-error" id="correct_option_err"></p>
                    </div>
                     <!-- Question reasoning -->
                     <div class="col-md-12">
                        <hr>
                        <label for="question_reasoning" class="question_reasoning">Question Reasoning*</label>
                        <div class="input-group">
                            <textarea class="form-control" id="question_reasoning" name="questionReasoning" rows="3"><?php echo (isset($data['question']['reasoning']))? $data['question']['reasoning'] : "" ; ?></textarea>
                        </div>
                        <br>
                        <p class="p-error" id="question_reasoning_err"></p>
                    </div>

                </div>

                <!-- Button -->
                <input type="hidden" id="question_id" name="question_id" value="<?=$data['question']['question_id'];?>">
                <input type="hidden" id="urlroot" name="urlroot" value="<?php echo URLROOT;?>">
                <button id="edit_question_btn" class="btn btn-dark float-right">Edit Question</button>
                </div>
            </div>
            </div>
        </div>

      </div>
    </section>
    <!-- /.Main content -->
  </div>
<!-- jQuery -->
<script src="<?=URLROOT?>/public/plugins/jquery/jquery.min.js"></script>
<script type="module" src="<?=URLROOT?>/public/custom_js/question/editQuestion.js"></script>
<?php require APPROOT . "/views/inc/footer.php"; ?>