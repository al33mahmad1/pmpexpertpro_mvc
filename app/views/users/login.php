<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ((isset($data['title']))? $data['title'] : SITENAME . " | Login");?></title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=URLROOT?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?=URLROOT?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=URLROOT?>/public/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->

  <?php if(isset($_GET['q']) && $_GET['q'] == "paid"):?>
    <div class="alert alert-success" id="emailSent"><i class="fa fa-info-circle"></i> &nbsp;We sent you an email!</div>
  <?php endif;?>
  
  <?php if(isset($_GET['q']) && $_GET['q'] == "pwdChanged"):?>
    <div class="alert alert-success" id="passwordUpdated"><i class="fa fa-info-circle"></i> &nbsp;Congratulations! You password is updated.</div>
  <?php endif;?>
  <div class="alert alert-danger alert-dismissible" style="display: none;" id="error-message"></div>
  <div class="alert alert-warning alert-dismissible" style="display: none;" id="error-message-disabled"></div>
  <div class="alert alert-success alert-dismissible" style="display: none;" id="error-message-success"></div>

  <div class="card card-outline card-dark">
    <div class="card-header text-center">
      <a href="<?=WEBSITE_URL?>" class="h4"><?=SITENAME?> LOGIN</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="javascript:void(0);">
        <div class="input-group mb-3">
          <input type="email" id="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row justify-content-right">
          <!-- /.col -->
          <div class="col-12">
            <button id="login" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="<?=URLROOT?>/users/forgotPassword" class="btn btn-block btn-outline-danger">
           I forgot my password
        </a>
      </div>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<input type="hidden" name="hidden" id="urlroot" value="<?=URLROOT?>">

<!-- jQuery -->
<script src="<?=URLROOT?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=URLROOT?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=URLROOT?>/public/dist/js/adminlte.min.js"></script>

<script type="module" src="<?=URLROOT?>/public/custom_js/users/login.js"></script>
<script>

    (function() {
      setTimeout(function() {
          $("#msg-flash").fadeOut("slow");
      }, 6000);
      setTimeout(function() {
          $("#emailSent").fadeOut("slow");
      }, 6000);
      setTimeout(function() {
          $("#passwordUpdated").fadeOut("slow");
      }, 6000);
    }());

    
  </script>
</body>
</html>
