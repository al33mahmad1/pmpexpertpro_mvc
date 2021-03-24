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

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mt-3">
        <div class="col-md-12">
            <a href="<?=URLROOT?>/assessments/list" class="btn btn-outline-dark"><i class="fa fa-backward"></i> Back to Exams</a>
        </div>
          <div class="col-sm-12 text-center">
            <h1 class="m-0" style="font-size: 40px; letter-spacing: 7px;"><?=$data['reportData']['assessment_name']?></h1>
            <p>Total # of questions: <?=$data['reportData']['totalQuestions']?></p>
            <p>Correct answers: <?=$data['reportData']['score']?></p>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    

    <!-- Main content -->
    <div class="content">
      <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Bar chart -->
                <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                    Percentage of each Section
                    </h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart" height="150px"></canvas>
                    <input type="hidden" id="hiddenAssessmentId" value="<?=$data['assessmentId']?>">
                    <input type="hidden" id="urlroot" value="<?=URLROOT?>">
                </div>
                <!-- /.card-body-->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div class="row mt-2 pb-5">
            <?php if(isset($data['questions']) && $data['questions']):?>
                <?php $i = 1;?>

                <?php foreach ($data['questions'] as $question):?>
                    <div class="col-lg-12">
                        <div class="card card-dark elevation-2" style="border-left: 3px solid <?php echo ($question['correct_option'] == $data['reportData']['selected_answers'][$question['question_id']])? "#28a745" : "#dc3545" ;?>;">
                        <div class="card-body">
                            <p class="card-text"><?php echo ($question['correct_option'] == $data['reportData']['selected_answers'][$question['question_id']])? "<i class='fa fa-check-circle text-success'></i>" : "<i class='fa fa-times-circle text-danger'></i>" ;?> Q<?=$i?>. <?=$question['question']?></p>

                            <dl class="row">
                                <dd class="col-sm-12"><input <?php echo ($data['reportData']['selected_answers'][$question['question_id']] == "a")? "checked disabled":" disabled";?> type="radio" name="question_<?=$question['question_id']?>" data-question-tag="question_<?=$question['question_id']?>" value="a"> <b style="font-size:18px;">A.</b> <?=$question['a']?></dd>
                                <dd class="col-sm-12"><input <?php echo ($data['reportData']['selected_answers'][$question['question_id']] == "b")? "checked disabled":"disabled";?> type="radio" name="question_<?=$question['question_id']?>" data-question-tag="question_<?=$question['question_id']?>" value="b"> <b style="font-size:18px;">B.</b> <?=$question['b']?></dd>
                                <dd class="col-sm-12"><input <?php echo ($data['reportData']['selected_answers'][$question['question_id']] == "c")? "checked disabled":"disabled";?> type="radio" name="question_<?=$question['question_id']?>" data-question-tag="question_<?=$question['question_id']?>" value="c"> <b style="font-size:18px;">C.</b> <?=$question['c']?></dd>
                                <dd class="col-sm-12"><input <?php echo ($data['reportData']['selected_answers'][$question['question_id']] == "d")? "checked disabled":"disabled";?> type="radio" name="question_<?=$question['question_id']?>" data-question-tag="question_<?=$question['question_id']?>" value="d"> <b style="font-size:18px;">D.</b> <?=$question['d']?></dd>
                            </dl>
                            <p><?php if($data['reportData']['selected_answers'][$question['question_id']] == "none"): ?>
                                <span class='text-danger'>You did not answer this question, Correct answer is <b><?=ucfirst($question['correct_option'])?></b></span>
                              <?php else: ?>
                                <span class='text-success'>You answered <?=ucfirst($data['reportData']['selected_answers'][$question['question_id']])?>, Correct answer is <?=ucfirst($question['correct_option'])?></span>
                                <?php endif;?>
                            </p> 

                            <p>Explanation: </p>
                            <p class="text-muted text-sm"><i><?=$question['reasoning']?></i></p>
                        </div>
                        </div>

                    </div>
                <?php $i++;?>
            <?php endforeach;?>
            
            <div class="col-md-12">
            <hr>
                <a href="<?=URLROOT?>/assessments/list" class="btn btn-outline-dark elevation-2"><i class="fa fa-backward"></i> Back to Exams</a>
            </div>

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
<!-- FLOT CHARTS -->
<script src="<?=URLROOT?>/public/plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?=URLROOT?>/public/plugins/flot/plugins/jquery.flot.resize.js"></script>

<!-- <script src="https://cdnjs.com/libraries/Chart.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
$(document).ready(function() {
    const hiddenAssessmentId = $("#hiddenAssessmentId").val();
    const urlroot = $("#urlroot").val();
    console.log(hiddenAssessmentId);
    console.log(urlroot);
    
    ajaxCall(urlroot +"/assessments/getChatData/", "POST", {hiddenAssessmentId: hiddenAssessmentId}, "json", false)
            .then((data) => {
                console.log("Data: ", data);
                switch (data.status) {
                    case "logout":
                        window.location.href = urlroot + "/users/logout";
                        break;
                    case "error":
                        window.location.href = urlroot + "/assessments/list";
                        break;
                    case "success":
                        var dataArray = [];
                        var labels = [];
                        var colorsArray = [];
                        var stockArray = [];
                        for (const [key, value] of Object.entries(data.data)) {
                            labels.push(key);
                            dataArray.push(value.toFixed(0));
                            colorsArray.push(random_rgba());
                            stockArray.push(random_rgba());

                            // console.log(`${key}: ${value}`);
                        }
                        var ctx = document.getElementById('myChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: dataArray,
                                    backgroundColor: colorsArray,
                                    borderColor: stockArray,
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                legend: {
                                    display: false
                                },
                                scales: {
                                    yAxes: [{
                                        gridLines: {
                                            drawBorder: false,
                                        },
                                        ticks: {
                                            min: 0,
                                            max: 100,
                                            stepSize: 20,
                                        },
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Rating (Scale of 1-100%)',
                                            fontSize: 16
                                        }
                                    }]
                                }
                            }
                        });
                        break;
                    default:
                        window.location.href = urlroot + "/assessments/list/";
                        break;
                }
            })
            .catch((err) => {
                window.location.href = urlroot + "/assessments/list";
                console.log("Error: ", err);
            });
   

    function ajaxCall(url, method, data, responseType="text") {
   
        return new Promise((resolve, reject) => {
            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: responseType,
                success: function(data) {
                    resolve(data);
                },
                error: function(err) {
                    reject(err);
                }
            });
        });
   
    }

    function random_rgba() {
        // var o = Math.round, r = Math.random, s = 255/2;
        // return 'rgba(' + s + ',' + s + ',' + s + ',' + r().toFixed(1) + ')';
        return "rgb(0, 123, 255, 1)";
    }


}); 
</script>
</body>
</html>
