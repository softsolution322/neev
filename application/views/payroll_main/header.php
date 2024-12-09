<!DOCTYPE HTML>
<html>

<head>
	<title>Dashboard - <?php echo $this->session->userdata('userlevel'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>

	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url(); ?>assets/dash_css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- Custom CSS -->
	<link href="<?php echo base_url(); ?>assets/dash_css/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dash_css/morris.css" type="text/css" />
	<!-- Font Awesome Icons -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

	<!-- Bootstrap Datepicker and Timepicker CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">

	<!-- jQuery and JavaScript Libraries -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

	<!-- Other external scripts for calendar, validation, and table functionality -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/myStyle.css" rel="stylesheet">

	<style>
		body {
			font-family: 'Verdana', sans-serif !important;
		}

		.profile_img img {
			width: 40px;
			height: 40px;
			border-radius: 50%;
		}

		.user-name p {
			line-height: 40px;
			font-size: 14px;
		}

		.profile_details .dropdown-menu {
			font-size: 14px;
		}

		.header-main {
			background-color: #f8f9fa;
			padding: 20px 30px;
			border-bottom: 1px solid #ddd;
		}

		.logo-w3-agile h1 {
			font-size: 16px;
			font-weight: bold;
		}

		.dropdown-toggle {
			display: flex;
			align-items: center;
		}

		.profile_details_drop .fa {
			margin-left: 10px;
		}

		.dropdown-menu li a {
			padding: 10px 15px;
			display: flex;
			align-items: center;
		}

		.dropdown-menu li a:hover {
			background-color: #f1f1f1;
		}

		.dropdown-menu li a i {
			margin-right: 10px;
		}
		
	</style>
</head>

<body>
	<divclass="page-container">
		<div class="left-content">
			<div class="mother-grid-inner">
				<!-- Header Section -->
				<div class="header-main">
					<div class="row">

						<!-- Profile Section -->
						<div style="background-color: rgb(75, 73, 172)" class="col-sm-12 profile_details w3l pull-right">
							<ul>
								<li class="dropdown profile_details_drop">
									
										<a style="color:#f1f1f1; padding: 5px 5px; border-radius: 5px; text-decoration: none; font-size: 30px" href="<?php echo base_url(); ?>">
											<?php echo role_details['NAME'] . ' Dashboard (' . schoolData['short_nm'] . ' ' . schoolData['School_Session'] . ')'; ?>
										</a>
									
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<div class="user-name">
                                          <p style="color:#f1f1f1;font-size: 18px "; font-size: 18px"><?php echo greet_user($this->session->userdata('emp_name')); ?></p>
                                        </div>
						
									</a>
									
									<ul class="dropdown-menu drp-mnu">
										<li>
											<a href="#" onclick="changePassword('<?php echo $this->session->userdata('user_id'); ?>')">
												<i class="fa fa-key"></i> Change Password
											</a>
										</li>
										<li>
											<a href="<?php echo base_url('payroll/dashboard/dashboard/profile'); ?>">
												<i class="fa fa-user"></i> Profile
											</a>
										</li>
										<li>
											<a href="<?php echo base_url('Login/logout'); ?>">
												<i class="fa fa-sign-out"></i> Logout
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<!-- End Header Section -->

				<!-- Main Content Here -->
				<!-- Add your page content here -->
			</div>
		</div>
		</div>
</body>
	<?php
	function greet_user($name) {
    $hour = date('H');
    if ($hour >= 5 && $hour < 12) {
        return "Good Morning, $name!";
    } elseif ($hour >= 12 && $hour < 17) {
        return "Good Afternoon, $name!";
    } elseif ($hour >= 17 && $hour < 21) {
        return "Good Evening, $name!";
    } else {
        return "Good Night, $name!";
    }
}
	?>

</html>