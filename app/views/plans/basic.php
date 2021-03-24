<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo ((isset($data['title']))? $data['title'] : SITENAME . " | Register");?></title>
  <style>
  .hide{display: none;}
  .show{display: block;}
  </style>
  <!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=URLROOT?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=URLROOT?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=URLROOT?>/public/dist/css/adminlte.min.css">
</head>
<body class="bg-light mt-5" style="font-family: 'Poppins', sans-serif; font-size: 14px;">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
    <div class="card card-outline card-dark">
    <div class="card-header text-center">
      <p class="h3"><b>Agile Basic Account for $39</p>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Membership Details</p>
      
      <div class="text-center text-muted">
        <p>Please provide me access to PMP Expert Pro Agile Basic module for just $39.</p>
        <p>I understand that my access to PMP-ACP exam resources are beneficial and help me expose to various test scenarios presented to me by PMPEXPERTPRO.</p>
        <p>I also understand that various combination of complex scenarios that are thrown at me will not only help me gain insight PMP-ACP knowledge but will also help me passing the exam.</p>
        <p>I will have instant access to the site once I register and pay the fees. I will also have accessibility to test materials via Desktop, Laptop, Tablet or Phone.</p>
      </div>

      <div class="text-center">
        <input type="checkbox" id="checkbox" onchange="checkboxChanged();"> &nbsp;AGREE TO <a href="#">REFUND POLICY</a>
      </div>
      
      <div class="social-auth-links text-center hide" id="paypal_btn_div">
         <!-- Set up a container element for the button -->
        <div id="paypal-button-container"></div>
      </div>

      <a href="<?=URLROOT?>/users/login" class="text-center text-sm text-muted" title="Login Now">I already have a membership?</a>
    </div>
  </div>
    </div>
  </div>
</div>
<input type="hidden" id="urlroot" value="<?=URLROOT?>">
<!-- jQuery -->
<script src="<?=URLROOT?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=URLROOT?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=URLROOT?>/public/dist/js/adminlte.min.js"></script>
<!-- Paypal Script -->
<script src="https://www.paypal.com/sdk/js?client-id=AVhlMHiV98Y2m1mgTB3G7I6CTryigzPmRgQZg3fKIFvtl1eSElFFeCHzV0JTsnsrYQj1NxHaSthxdZA7&currency=USD"></script>
<script src="<?=URLROOT?>/public/custom_js/paypal/checkbox.js"></script>
<script src="<?=URLROOT?>/public/custom_js/paypal/basic.js"></script>

</body>
</html>
