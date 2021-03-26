<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=SITENAME?> | Forgot Password</title>

  <style>
      .hide {display: none;}
      .show {display: block;}
  </style>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=URLROOT?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=URLROOT?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=URLROOT?>/public/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="<?=URLROOT?>/public/custom_css/otp/otp-css.css"></link>

</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <h4 class="text-muted">FORGOT PASSWORD</h4>
        </div>

        <div class="alert alert-danger hide" id="email_err">Invalid email address, please enter valid one!</div>

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

            <form>

                <div class="show" id="email_div">

                    <div class="input-group mb-3">
                    <input type="email" id="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-12">
                        <button type="submit" id="continue_btn" class="btn btn-primary btn-block">Request new password</button>
                    </div>
                    <!-- /.col -->
                    </div>
                </div>

                
            <div class="hide" id="password_div">
                <div class="input-group mb-4">
                <input type="password" name="password" id="password" class="form-control" placeholder="New Password" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                </div>

                <div class="input-group mb-4">
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block mt-3" id="password_continue_btn">Continue</button>
                    </div>
                </div>
            </div>

            </form>

            <p class="mt-3 mb-1">
                <a href="<?=URLROOT?>/users/login">Login</a>
            </p>
            
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
<!-- /.login-box -->

<input type="hidden" id="urlroot" value="<?=URLROOT?>">

<!-- Take OTP Modal -->
<!-- <div class="modal fade" id="OTP_Model-a" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="OTP_Model" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button type="button" class="close float-right text-right mr-2 d-inline" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-body p-5">
      <div class="row">
        <div class="col-md-12">

            <div class="mb-3 text-center">
                <h3>Please enter the 4-digit verification code we sent via Email</h3>
                <span>(Please check your spam folders if you didn't find that!)</span>
            </div>
            
            <div class="input-group mb-2">
                <input type="text" id="otp_code"  class="nospaces form-control" placeholder="* * * *" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="4" minlength="4">
            </div>
            <p class="otp_err text-danger mb-3" id="otp_err"></p>

            <div class="input-group mb-3">
                <button id="submit_otp_btn" class="btn btn-dark form-control">VERIFY</button>
            </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div> -->


<!-- Take OTP Modal -->
<div class="modal fade" id="OTP_Model" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="OTP_Model" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <button type="button" class="close float-right text-right mr-2 d-inline" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      <div class="modal-body p-5">
      <div class="row">
        <div class="col-md-12">

            <div class="mb-3 text-center">
                <h3>Please enter the 4-digit verification code we sent via Email</h3>
                <span>(Please check your spam folders if you didn't find that!)</span>
            </div>

            <div class="confirmation_code split_input large_bottom_margin" data-multi-input-code="true">
    			<div class="confirmation_code_group">
					<div class="split_input_item input_wrapper"><input onkeyup="goToNextInput(event, 1)" id="otp_code_1" type="text" class="inline_input" maxlength="1"></div>
					<div class="split_input_item input_wrapper"><input onkeyup="goToNextInput(event, 2)" id="otp_code_2" type="text" class="inline_input" maxlength="1"></div>
					<div class="split_input_item input_wrapper"><input onkeyup="goToNextInput(event, 3)" id="otp_code_3" type="text" class="inline_input" maxlength="1"></div>
					<div class="split_input_item input_wrapper"><input onkeyup="goToNextInput(event, 4)" id="otp_code_4" type="text" class="inline_input" maxlength="1"></div>
				</div>
			</div>
            <!-- <div class="input-group mb-2">
                <input type="text" id="otp_code"  class="nospaces form-control" placeholder="* * * *" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="4" minlength="4">
            </div> -->
            <p class="otp_err text-danger mb-3" id="otp_err"></p>

            <div class="input-group mb-3">
                <button id="submit_otp_btn" class="btn btn-dark form-control">VERIFY</button>
            </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="<?=URLROOT?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=URLROOT?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=URLROOT?>/public/dist/js/adminlte.min.js"></script>

<script src="<?php echo URLROOT;?>/public/custom_js/users/forgotPassword.js"></script>

<script>
    function goToNextInput(e, i) {
        var key = e.which;
        if (key != 9 && (key < 48 || key > 57)) {
            e.preventDefault();
            $("#otp_code_"+ i).val("");
            return false;
        }

        if (key === 9) {
            return true;
        }

        $("#otp_code_"+ (parseInt(i) + 1)).select().focus();
    }
</script>
</body>
</html>
