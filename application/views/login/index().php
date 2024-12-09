<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/log_images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/log_vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/log_fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/log_vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/log_vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/log_vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/log_css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/log_css/main.css">
<!--===============================================================================================-->
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo base_url(); ?>assets/log_images/School-Management-System.jpg" alt="IMG">
				</div>

				<div class="login100-form validate-form">
				<div class="alert alert-danger" role="alert" id="msg" style="display:none;">
				   <strong>Incorrect Username or Password !!</strong>
				</div>
					<span class="login100-form-title">
						Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Email/Username is required">
						<input class="input100" type="text" onkeyup="this.value = this.value.toUpperCase();" name="username" id="username" placeholder="Email/Username" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fas fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" id="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn bg-dark" onclick="log()">
							Login
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							<!--Create your Account-->
							<!--<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>-->
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->	
	<script src="<?php echo base_url(); ?>assets/log_vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/log_vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url(); ?>assets/log_vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/log_vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/log_vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/log_js/main.js"></script>

</body>
</html>

<script>
  function log(){
	  var username = $("#username").val();
	  var pass     = $("#pass").val();
	  $.ajax({
		  url: "<?php echo base_url(); ?>Login/logg",
		  type: "POST",
		  data: {username:username,pass:pass},
		  success: function(data){
			  if(data == 'Fees'){
				  window.location="<?php echo base_url('Login/fees_dashboard'); ?>";
			  }else if(data == 'Teacher'){
				  window.location="<?php echo base_url('Login/teacher_dashboard'); ?>";
			  }
			  else{
				  $("#msg").show();
				  $("#msg").fadeOut(6000);
			  }
		  }
	  });
  }
</script>