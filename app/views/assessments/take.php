<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$data['title']?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=URLROOT?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=URLROOT?>/public/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">
<div class="sticky-top float-right px-3">
    <p class="text-bold" id="running_time_top">29m : 59s</p>
</div>

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mt-3">
          <div class="col-sm-12 text-center">
            <h1 class="m-0" style="font-size: 40px; letter-spacing: 7px;"><?=$data['assessmentName']?></h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
            <h1 class="m-0 text-muted" style="letter-spacing: 3px;" id="running_time">29m : 59s</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row mt-2 pb-5">
            <?php if(isset($data['assessment']) && $data['assessment']):?>
                <?php $i = 1;?>
                <form action="javascript:void(0)">

                <?php foreach ($data['assessment'] as $assessment):?>
                    <div class="col-lg-12">
                    <?php echo flash('error');?>

                        <div class="card card-dark elevation-2" style="border-left: 3px solid #343a40;">
                        <div class="card-body">
                            <p class="card-text">Q<?=$i?>. <?=$assessment['question']?></p>

                            <dl class="row">
                                <dd class="col-sm-12"><input type="radio" name="question_<?=$assessment['question_id']?>" data-question-tag="question_<?=$assessment['question_id']?>" value="a"> <b style="font-size:18px;">A.</b> <?=$assessment['a']?></dd>
                                <dd class="col-sm-12"><input type="radio" name="question_<?=$assessment['question_id']?>" data-question-tag="question_<?=$assessment['question_id']?>" value="b"> <b style="font-size:18px;">B.</b> <?=$assessment['b']?></dd>
                                <dd class="col-sm-12"><input type="radio" name="question_<?=$assessment['question_id']?>" data-question-tag="question_<?=$assessment['question_id']?>" value="c"> <b style="font-size:18px;">C.</b> <?=$assessment['c']?></dd>
                                <dd class="col-sm-12"><input type="radio" name="question_<?=$assessment['question_id']?>" data-question-tag="question_<?=$assessment['question_id']?>" value="d"> <b style="font-size:18px;">D.</b> <?=$assessment['d']?></dd>
                            </dl>
                            
                        </div>
                        </div>

                    </div>
                <?php $i++;?>
            <?php endforeach;?>
            
            <div class="col-md-12">
                <input type="hidden" name="hiddenAssessmentId" id="hiddenAssessmentId" value="<?=$data['assessmentId']?>">
                <input type="hidden" name="totalQuestions" id="totalQuestions" value="<?=--$i?>">
                <input type="hidden" name="urlroot" id="urlroot" value="<?=URLROOT?>">
                <button id="submit_test" class="btn btn-dark elevation-2">Submit Exam</button>
            </div>

            </form>

            <?php endif;?>

          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?=URLROOT?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=URLROOT?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=URLROOT?>/public/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=URLROOT?>/public/dist/js/demo.js"></script>

<script src="<?=URLROOT?>/public/custom_js/assessment/take.js"></script>
<script>
  $(document).ready(function(){
    setTimeout(() => {
      $('#msg-flash').hide('slow');
    }, 5000);
  });
</script>
</body>
</html>
