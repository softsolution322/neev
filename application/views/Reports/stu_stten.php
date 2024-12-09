<!-- <ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.html">
			<h4><b>Student Daily Attendance</h4>
		</a> <i class=""></i></li>
</ol> -->
<style type="text/css">
	/* body {
		font-family: 'Aldrich', sans-serif;
	} */

	.breadcrumb>li+li:before {
		content: "";
	}
</style>
<!--four-grids here-->

<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">Student Daily Attendance</a> <i class="fa fa-angle-right"></i></li>
	<li class="breadcrumb-item" style="float: right;padding:2px"><i class="fa fa-angle-left"></i> <a href="<?php echo base_url('payroll/dashboard/emp_dashboard'); ?>" style="font-size:18px;">Back </a></li>
</ol>
<div class="loader" style="display:none;"></div>
<div style="padding: 15px; background-color: white;  border-top:3px solid #5785c3;">
	<div class="row">
		<div class="four-grids">
			<div class="col-md-2 four-grid">
				<a href="<?php echo base_url('student/master/Student_attendance_type'); ?>">
					<div class="four-agileits">
						<div class="icon">
							<i class="fa fa-file" style="font-size:30px; color: #fff;"></i>
						</div>
						<div class="four-text">
							<h3>Student Attendance <br /> Type</h3>
							<!-- <h4> 24,420  </h4> -->

						</div>

					</div>
				</a>
			</div>
			<div class="col-md-2 four-grid">
				<a href="<?php echo base_url('student/Student_attendance'); ?>">
					<div class="four-agileinfo">
						<div class="icon">
							<i class="fa fa-file" style="font-size:30px; color: #fff;"></i>
						</div>
						<div class="four-text">
							<h3>Daily <br /> Attendance &nbsp;&nbsp;</h3>
						</div>

					</div>
				</a>
			</div>
			<div class="col-md-2 four-grid">
				<a href="<?php echo base_url('student/report/Report/daily_wise'); ?>">
					<div class="four-wthree">
						<div class="icon">
							<i class="fas fa-address-card" style="font-size:30px; color: #fff;"></i>
						</div>
						<div class="four-text">
							<h3> Daily Attendance<br />Report</h3>
						</div>

					</div>
				</a>
			</div>

			<div class="col-md-2 four-grid">
				<a href="<?php echo base_url('student/report/Report/monthly_wise'); ?>">
					<div class="four-agileinfo">
						<div class="icon">
							<i class="fas fa-address-card" style="font-size:30px; color: #fff;"></i>
						</div>
						<div class="four-text">
							<h3>Monthly Attendance <br />Report</h3>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-2 four-grid">
				<a href="<?php echo base_url('student/report/report/DailyReport'); ?>">
					<div class="four-agileinfo">
						<div class="icon">
							<i class="fas fa-address-card" style="font-size:30px; color: #fff;"></i>
						</div>
						<div class="four-text">
							<h3>Class Wise Attendance sheet</h3>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-2 four-grid">
				<a href="<?php echo base_url('student/report/attendancepercentagereport'); ?>">
					<div class="four-agileits">
						<div class="icon">
							<i class="fas fa-address-card" style="font-size:30px; color: #fff;"></i>
						</div>
						<div class="four-text">
							<h3>Attendance Percentage Report</h3>
						</div>

					</div>
				</a>
			</div>
		</div>
	</div>
</div>
<br />