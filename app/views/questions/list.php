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
            <h1 class="m-0">Questions</h1>
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


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
         <!-- /.row -->
         <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Question</h3>

                <div class="card-tools">
                  <a class="btn btn-dark btn-sm"href="<?=URLROOT?>/questions/add">Add new question</a>
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-bordered table-hover text-sm">
                  <thead>
                    <tr>
                      <th>Question Statement</th>
                      <th>A</th>
                      <th>B</th>
                      <th>C</th>
                      <th>D</th>
                    </tr>
                  </thead>
                  <?php if(isset($data['questions']) && $data['questions']):?>
                  <tbody>
                  <?php foreach ($data['questions'] as $question):?>
                    <tr  data-widget="expandable-table" aria-expanded="false">
                        <td><?php echo $question['question'];?></td>
                        <td class="<?php echo ($question['correct_option'] == "a")?"text-success": "text-danger";?>"><?php echo $question['a'];?></td>
                        <td class="<?php echo ($question['correct_option'] == "b")?"text-success": "text-danger";?>"><?php echo $question['b'];?></td>
                        <td class="<?php echo ($question['correct_option'] == "c")?"text-success": "text-danger";?>"><?php echo $question['c'];?></td>
                        <td class="<?php echo ($question['correct_option'] == "d")?"text-success": "text-danger";?>"><?php echo $question['d'];?></td>
                    </tr>
                    <tr class="expandable-body">
                      <td colspan="6">
                        <div class="row">
                          <div class="col-md-12">
                            <p><b>Reasoning: </b><?=$question['reasoning']?></p>
                          </div>
                          <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-3">Assessment Name</dt>
                                <dd class="col-sm-9"><?=$question['assessment_name']?></dd>
                                <dt class="col-sm-3">Assessment Category</dt>
                                <dd class="col-sm-9"><?=ucfirst($question['assessment_category_name'])?></dd>
                                <dt class="col-sm-3">Section Name</dt>
                                <dd class="col-sm-9"><?=$question['section_name']?></dd>
                            </dl>
                          </div>

                          <div class="col-md-6">
                          <button class="btn btn-outline-danger btn-sm float-right ml-2">Delete</button>
                            <button class="btn btn-outline-primary btn-sm float-right ml-2">Edit</button>
                          </div>
                        </div>
                      </td>
                    </tr>
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