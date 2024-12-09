<style>
	.breadcrumb>li+li:before {
		content: "";
	}
</style>
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">
			<h4><b>Bus Report</b></h4>
		</a> <i class=""></i></li>
	<li class="breadcrumb-item" style="float: right;padding:2px"><i class="fa fa-angle-left"></i> <a href="<?php echo base_url('Report/typeofreports'); ?>" style="font-size:18px;">Back </a></li>
</ol>
<div class="row">
	<div class="col-md-12 col-lg-12 col-sm-12">
		<div class="row">
			<div class="four-grids">
				<div class="col-md-2 four-grid">
					<a href="<?php echo base_url('Bus_report/stoppage_wise'); ?>">
						<div class="four-agileits">
							<div class="icon">
								<i class="fas fa-address-card" style="font-size:30px; color: #fff;"></i>
							</div>
							<div class="four-text">
								<h3>Stoppage <br />Wise<br />Report</h3>
							</div>

						</div>
					</a>
				</div>
				<div class="col-md-2 four-grid">
					<a href="<?php echo base_url('Bus_report/student_busfacility'); ?>">
						<div class="four-agileinfo">
							<div class="icon">
								<i class="fas fa-address-card" style="font-size:30px; color: #fff;"></i>
							</div>
							<div class="four-text">
								<h3>Bus <br />Facility<br />(Student List)</h3>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-2 four-grid">
					<a href="<?php echo base_url('Bus_report/stoppage_summary'); ?>">
						<div class="four-w3ls">
							<div class="icon">
								<i class="fas fa-address-card" style="font-size:30px; color: #fff;"></i>
							</div>
							<div class="four-text">
								<h3>Bus <br />Stoppage<br />Summary Report</h3>
							</div>
						</div>
					</a>
				</div>
				
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
</br></br></br></br></br></br></br></br></br>