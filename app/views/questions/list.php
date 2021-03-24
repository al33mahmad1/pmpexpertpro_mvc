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

    <div class="row mx-2">
      <div class="col-12">
            <div class="alert alert-danger alert-dismissible hide" id="error_message"></div>
            <div class="alert alert-success alert-dismissible hide" id="success_message"></div>
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
              <div class="card-body p-2">
                <table class="table table-bordered table-hover text-sm" id="datatable">
                  <thead>
                    <tr>
                      <th></th>
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
                    <tr id="table_main_row_<?=$question['question_id']?>" data-question-id="<?=$question['question_id']?>" data-question-reason="<?=$question['reasoning']?>" data-question-assessment-name="<?=$question['assessment_name']?>" data-question-assessment-category-name=<?=ucfirst($question['assessment_category_name'])?> data-question-section-name="<?=$question['section_name']?>">
                        <td class="details-control"></td>
                        <td><?php echo $question['question'];?></td>
                        <td class="<?php echo ($question['correct_option'] == "a")?"text-success": "text-danger";?>"><?php echo $question['a'];?></td>
                        <td class="<?php echo ($question['correct_option'] == "b")?"text-success": "text-danger";?>"><?php echo $question['b'];?></td>
                        <td class="<?php echo ($question['correct_option'] == "c")?"text-success": "text-danger";?>"><?php echo $question['c'];?></td>
                        <td class="<?php echo ($question['correct_option'] == "d")?"text-success": "text-danger";?>"><?php echo $question['d'];?></td>
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

  <input type="hidden" name="urlroot" id="urlroot" value="<?=URLROOT; ?>" />

   <!-- Delete Restaurant Confirmation Modal -->
   <div class="modal fade" id="delete_question_modal" tabindex="-1" role="dialog" aria-labelledby="delete_question_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-globalfoods" id="exampleModalLabel"><i class="fa fa-exclamation-triangle text-warning"></i> &nbsp;Delete Question</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-5 text-center">

          <p><b>You're about to delete this question?</b></p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger" onclick="deleteQuestion()" id="delete_question_yes_btn" data-question-id="">Yes Proceed</button>
        </div>
      </div>
    </div>
  </div>
<!-- jQuery -->
<script src="<?=URLROOT?>/public/plugins/jquery/jquery.min.js"></script>

<script async>
 function format(question_id, reasoning, assessment_name, assessment_category_name, section_name) {
      
    var html = '<div class="row">'+
    `                          <div class="col-md-12">`+
    `                            <p><b>Reasoning: </b>${reasoning}</p>`+
    `                          </div>`+
    `                          <div class="col-md-6">`+
    `                            <dl class="row">`+
    `                                <dt class="col-sm-3">Assessment Name</dt>`+
    `                                <dd class="col-sm-9">${assessment_name}</dd>`+
    `                                <dt class="col-sm-3">Assessment Category</dt>`+
    `                                <dd class="col-sm-9">${assessment_category_name}</dd>`+
    `                                <dt class="col-sm-3">Section Name</dt>`+
    `                                <dd class="col-sm-9">${section_name}</dd>`+
    `                            </dl>`+
    `                          </div>`+
    `                          <div class="col-md-6">`+
    `                            <button class="btn btn-outline-danger btn-sm float-right ml-2 show_delete_question_modal_btn" onclick="openModal(${question_id});" data-question-id="${question_id}">Delete</button>`+
    `                            <button class="btn btn-outline-primary btn-sm float-right ml-2" onclick="editQuestion(${question_id});" data-question-id="${question_id}">Edit</button>`+
    `                          </div>`;
    return html;
  }
  $(document).ready(function () {
      var table = $('#datatable').DataTable({});

      // Add event listener for opening and closing details
      $('#datatable').on('click', 'td.details-control', function () {
          var tr = $(this).closest('tr');
          var row = table.row(tr);

          if (row.child.isShown()) {
              // This row is already open - close it
              row.child.hide();
              tr.removeClass('shown');
          } else {
              // Open this row
              row.child(format(tr.data('question-id'), tr.data('question-reason'), tr.data('question-assessment-name'), tr.data('question-assessment-category-name'), tr.data('question-section-name'))).show();
              tr.addClass('shown');
          }
      });
  });

</script>
<script src="<?=URLROOT?>/public/custom_js/question/deleteQuestion.js" defer></script>
<?php require APPROOT . "/views/inc/footer.php"; ?>