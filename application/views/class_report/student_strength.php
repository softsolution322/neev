<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">
			<h4><b>Student Strength</b></h4>
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

	/* The container */
	.container {
		display: block;
		position: relative;
		padding-left: 35px;
		margin-bottom: 12px;
		cursor: pointer;
		font-size: 16px;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}

	/* Hide the browser's default radio button */
	.container input {
		position: absolute;
		opacity: 0;
		cursor: pointer;
	}

	/* Create a custom radio button */
	.checkmark {
		position: absolute;
		top: 0;
		left: 0;
		height: 15px;
		width: 15px;
		background-color: grey;
		border-radius: 50%;
	}

	/* On mouse-over, add a grey background color */
	.container:hover input~.checkmark {
		background-color: #4CAF50;
	}

	/* When the radio button is checked, add a blue background */
	.container input:checked~.checkmark {
		background-color: #2196F3;
	}

	/* Create the indicator (the dot/circle - hidden when not checked) */
	.checkmark:after {
		content: "";
		position: absolute;
		display: none;
	}

	/* Show the indicator (dot/circle) when checked */
	.container input:checked~.checkmark:after {
		display: block;
	}

	/* Style the indicator (dot/circle) */
	.container .checkmark:after {
		top: 9px;
		left: 9px;
		width: 8px;
		height: 8px;
		border-radius: 50%;
		background: white;
	}

	.loader {
		border: 16px solid #f3f3f3;
		border-radius: 50%;
		border-top: 16px solid #3498db;
		width: 120px;
		height: 120px;
		margin: 0px auto;
		z-index: 999;
		-webkit-animation: spin 2s linear infinite;
		/* Safari */
		animation: spin 2s linear infinite;
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

	/* Safari */
	@-webkit-keyframes spin {
		0% {
			-webkit-transform: rotate(0deg);
		}

		100% {
			-webkit-transform: rotate(360deg);
		}
	}

	@keyframes spin {
		0% {
			transform: rotate(0deg);
		}

		100% {
			transform: rotate(360deg);
		}
	}
	.breadcrumb>li+li:before {
		content: "";
	}
</style>
<div class="loader" style="display:none;"></div>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<form id="data_id">
		<div class='row'>
			<div class='col-md-3 form-group'>
				<fieldset>
					<label class="container">Class Wise
						<input  class="form-check-input" type="radio" onclick="dt(this.value)" value='1' name='disp_mode' id='cw'>
						<span class="checkmark"></span>
					</label>
				</fieldset>
			</div>
			<!-- <div class="col-md-3"> -->
				<!-- <fieldset>
				<label class="container">Class Section Wise
				  <input type="radio" onclick='dt(this.value)' value='2' id='ac' name='disp_mode'>
				  <span class="checkmark"></span>
				</label>
			</fieldset> -->
			<!-- </div> -->
			<!--<div class="col-md-3">
			<fieldset>
				<legend><span id='dt'>Details Type</legend>
				<input type="checkbox" value="religion" name="religion" id="religion">Religion Type Details<br />
				<input type="checkbox" value="category" name="category" id="category">Category Type Details<br />
				<input type="checkbox" value="ward" name="ward" id="ward">Ward Type Details<br />
				
			</fieldset>
		</div>-->
			<div class="col-md-3">
				<button class="btn btn-success">DISPLAY</button>&nbsp;
			</div>
			<br />
		</div>
	</form>
	<div id="load_data"></div>
</div><br />
<script>
	$("#data_id").on("submit", function(event) {
		event.preventDefault();
		var cw = $('#cw').val();
		var ac = $('#ac').val();
		if ($('#cw').is(":checked") || $('#ac').is(":checked")) {
			if ($('#cw').is(":checked")) {
				//=======================//
				$.ajax({
					url: "<?php echo base_url('Student_strength/student_strenghth_class'); ?>",
					type: "POST",
					data: $('#data_id').serialize(),
					beforeSend: function() {
						$('.loader').show();
						$('body').css('opacity', '0.5');
					},
					success: function(data) {
						$('.loader').hide();
						$('body').css('opacity', '1.0');
						$("#load_data").html(data);
					},
				});
			} else if ($('#ac').is(":checked")) {
				$('#dm').css("color", "black");
				$.ajax({
					url: "<?php echo base_url('Student_strength/student_strenghth_all'); ?>",
					type: "POST",
					data: $('#data_id').serialize(),
					beforeSend: function() {
						$('.loader').show();
						$('body').css('opacity', '0.5');
					},
					success: function(data) {
						$('.loader').hide();
						$('body').css('opacity', '1.0');
						$("#load_data").html(data);
					},
				});

			}
		} else {
			alert("Please Select Any One Options");
		}
	});
</script>