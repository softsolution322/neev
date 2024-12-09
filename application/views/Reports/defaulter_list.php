<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">
			<h4><b>Defaulter List Of Student</b></h4>
		</a> <i class=""></i></li>
	<li class="breadcrumb-item" style="float: right;padding:2px"><i class="fa fa-angle-left"></i> <a href="<?php echo base_url('Report/typeofreports'); ?>" style="font-size:18px;">Back </a></li>
</ol>
<style>
	.table>thead>tr>th,
	.table>tbody>tr>th,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		color: black;
	}

	.table thead tr th {
		background: #337ab7;
		color: #fff !important;
	}

	.table>thead>tr>th,
	.table>tbody>tr>th,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		white-space: nowrap !important;
	}

	.loader {
		margin: auto;
		width: 30%;
		padding: 50px;
	}

	.my-button {
		width: 80px;
		/* set the width */
		height: 35px;
		/* set the height */
		background-color: green;
		color: white;
	}

	.back-button {
		width: 80px;
		/* set the width */
		height: 35px;
		/* set the height */
		color: white;
	}

	.breadcrumb>li+li:before {
		content: "";
	}
</style>

<body onload="hide()">


	<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
		<form id="data_id">
			<div class='row'>
				<div class='col-md-3 form-group'>
					<fieldset>
						<label id='dm'><b>Display Mode</b></label><br>
						<input type='radio' name='disp_mode' id='cw' onclick="dt(this.value)" value='1'> Class Wise &nbsp;
						<input type='radio' onclick='dt(this.value)' value='2' id='ac' name='disp_mode'> All Classes
						</br>
						<div class="col-md-6">
							<select class='form-control' name='classs' id='classs' disabled hidden>
								<option value=''>select Class</option>
								<?php
								if ($class) {
									foreach ($class as $class_code) {
								?>
										<option value='<?php echo $class_code->Class_No; ?>'><?php echo $class_code->CLASS_NM; ?></option>
								<?php
									}
								}
								?>
							</select>
						</div>
						<div class="col-md-3">
							<!-- <select class='form-control' name='sec' id='sec' disabled>
							<option value='1'>A</option>
							
						</select> -->
							<input type="hidden" name="sec" id="sec" value='<?php echo '1' ?>'>
						</div>

					</fieldset>
				</div>
				<div class="col-md-3 form-group">
					<div class="col-md-6">
						<fieldset>
							<label id='vut'><b>Month upto</b></label>
							<select class='form-control' name='viewupto' id="viewupto">
								<option value=''>select</option>
								<?php
								if ($month_master) {
									foreach ($month_master as $month_m) {
								?>
										<option value='<?php echo $month_m->Month_NM; ?>'><?php echo $month_m->Month_NM; ?></option>
								<?php
									}
								}
								?>
							</select>
						</fieldset>
					</div>

				</div>

				<!-- <div class="col-md-4">
			<fieldset>
				<legend><span id='class1'>Class</span>/<span id='sec1'>Sec</span> Wise</legend>
				<div class='row'>
					<div class='col-md-6'>
						<select class='form-control' name='classs' id='classs' disabled >
							<option value=''>select Class</option>
							<?php
							if ($class) {
								foreach ($class as $class_code) {
							?>
											<option value='<?php echo $class_code->Class_No; ?>'><?php echo $class_code->CLASS_NM; ?></option>
										<?php
									}
								}
										?>
						</select>
					</div>
					<div class='col-md-6'>
						<select class='form-control' name='sec' id='sec' disabled>
							<option value=''>Select Sec</option>
							<?php
							if ($sec) {
								foreach ($sec as $sec_code) {
							?>
											<option value='<?php echo $sec_code->section_no; ?>'><?php echo $sec_code->SECTION_NAME; ?></option>
										<?php
									}
								}
										?>
						</select>
					</div>
				</div>
			</fieldset>
		</div>
		 -->
				<div class="col-md-3">
					<br />
					
						<button class="btn btn-success">DISPLAY</button>
					
				</div>

			</div>
			</br>
		</form>

		<table class="table table-stripped table-bordered" style='color: black' id="myTable">
			<thead>
				<tr>
					<th style="background: #337ab7; color: white !important;">SNO</th>
					<th style="background: #337ab7; color: white !important;">NAME</th>
					<th style="background: #337ab7; color: white !important;">ADM_NO</th>
					<th style="background: #337ab7; color: white !important;">ROLL NO</th>
					<th style="background: #337ab7; color: white !important;">Class</th>
					<th style="background: #337ab7; color: white !important;">DUES UPTO</th>
					<!-- <th style="background: #337ab7; color: white !important;">PREVIOUS YEAR DUES</th>
	         <th style="background: #337ab7; color: white !important;">CURRENT YEAR DUES</th> -->
					<th style="background: #337ab7; color: white !important;">TOTAL AMOUNT</th>
				</tr>
			</thead>
		</table>
		<div id='loader' class='loader' style='display:none'>
			<img src="<?php echo base_url() ?>assets/log_image/tenor.gif" width="180px" height="100px">
		</div>
		<div id="vis_det" class="table-responsive">

		</div>

	</div><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</body>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
<script>
	function hide() {
		let val = document.getElementById("ac");
		if (val == 1) {
			$('#classs').show();
			$('#sec').show();
			$('#classs').prop('disabled', false);
			$('#sec').prop('disabled', false);
		} else {
			$('#classs').hide();
			$('#sec').hide();
		}
	}

	function dt(val) {

		if (val == 1) {
			$('#classs').show();
			$('#sec').show();
			$('#classs').prop('disabled', false);
			$('#sec').prop('disabled', false);
		} else {
			$('#classs').hide();
			$('#sec').hide();
		}
	}
	$("#data_id").on("submit", function(event) {
		event.preventDefault();
		var cw = $('#cw').val();
		var ac = $('#ac').val();
		var viewupto = $('#viewupto').val();
		var classs = $('#classs').val();
		var sec = $('#sec').val();
		if ($('#cw').is(":checked") || $('#ac').is(":checked")) {
			if ($('#cw').is(":checked")) {
				$dlt = 'Class Wise';
				$('#dm').css("color", "black");
				if (viewupto != '') {
					$('#vut').css("color", "black");
					if (classs != '') {
						$('#class1').css("color", "black");
						if (sec != '') {
							$('#sec1').css("color", "black");
							$('#loader').show();

							$.ajax({
								url: "<?php echo base_url('Defaulter_list/defaulter_classwise') ?>",
								type: "POST",
								data: {
									viewupto: viewupto,
									classs: classs,
									sec: sec
								},
								success: function(data) {
									$('#loader').hide();
									$('#vis_det').html(data);
									$('#myTable').hide();

								},
							});

						} else {
							$('#sec1').css("color", "red");
						}
					} else {
						$('#class1').css("color", "red");
					}
				} else {
					$('#vut').css("color", "red");
					alert("Please Generate Fee For Respective Month or select Month");
				}
			} else if ($('#ac').is(":checked")) {
				$('#dm').css("color", "black");
				if (viewupto != '') {
					$('#loader').show();

					$.ajax({
						url: "<?php echo base_url('Defaulter_list/defaulter_allclasswise') ?>",
						type: "POST",
						data: {
							viewupto: viewupto,
							classs: classs,
							sec: sec
						},
						success: function(data) {
							$('#loader').hide();
							$('#vis_det').html(data);
							$('#myTable').hide();

						},
					});
				} else {
					$('#vut').css("color", "red");
					alert("Please Generate Fee For Respective Month or select Month");
				}
			} else {
				alert("Please Checked Class Wise Or All Classes");
			}
		} else {
			$('#dm').css("color", "red");
		}
	});
</script>