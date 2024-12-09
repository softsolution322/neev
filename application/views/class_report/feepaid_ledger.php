<style>
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
		color: red;
		content: "";
	}
</style>

<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">
			<h4><b>Student Fee Paid Details</b></h4>
		</a> <i class=""></i></li>
	<li class="breadcrumb-item" style="float: right;padding:2px"><i class="fa fa-angle-left"></i> <a href="<?php echo base_url('Report/typeofreports'); ?>" style="font-size:18px;">Back </a></li>
</ol>

<div class="loader" style="display:none;"></div>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<form id="form" method="post">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
				<label>Enter Admission Number</label>
				<input list="browsers" name="browser" required class="form-control">
				<datalist id="browsers">
					<?php
					foreach ($stu_adm as $key => $value) {
					?>
						<option value="<?php echo $value->ADM_NO; ?>">
						<?php
					}
						?>
				</datalist>
			</div>
			<br>
			<div class="col-md-4 col-sm-4 col-xs-4 form-group">

				<button onclick="show_student_details()" class="btn btn-success btn-block"><i class="far fa-eye" style="font-size: 16px;" id="eye"></i>&nbsp;<i class="fa fa-circle-o-notch fa-spin" style="display: none;" id="spnr_dsp"></i>&nbsp;All Student Details</button>
			</div>
			<!-- <br> -->
			<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
				
					<button type="submit" class="btn btn-success">DISPLAY</button>
					
				
			</div>
		</div>


	</form>
	<br /><br /><br /><br />
	<div id="load_data" style="overflow:auto;"></div>
</div><br />
<div class="modal fade" id="stu_details">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background: #5785c3; color: #fff; text-align: center;">
				<h4 class="modal-title">Student Details</h4>
				<!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
			</div>
			<style type="text/css">
				.table,
				#thead,
				tr,
				td,
				th {
					text-align: center;
					color: #000 !important;
				}
			</style>
			<!-- Modal body -->

			<div class="modal-body">
				<div style="overflow: auto; height: 350px;">
					<div class="form-group">
						<input type="text" name="" id="myInput" class="form-control" placeholder="search">
					</div>
					<table class="table" width="100%" id="myTable">
						<thead id="thead">
							<tr>
								<th>SlNO.</th>
								<th>Adm No</th>
								<th>Name</th>
								<th>Class/Sec</th>
								<th>Father Name</th>
								<th>Mother Name</th>
							</tr>
						</thead>
						<tbody id="student_data">

						</tbody>
					</table>
				</div>
			</div>


			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>
<script>
	$("#form").on("submit", function(event) {
		event.preventDefault();
		$.ajax({
			url: "<?php echo base_url('Feepaid_ledger/checkdata'); ?>",
			type: "POST",
			data: $('#form').serialize(),
			beforeSend: function() {
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data) {
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				if (data == 1) {
					$.ajax({
						url: "<?php echo base_url('Feepaid_ledger/find_details'); ?>",
						type: "POST",
						data: $('#form').serialize(),
						beforeSend: function() {
							$('.loader').show();
							$('body').css('opacity', '0.5');
						},
						success: function(data) {
							$('.loader').hide();
							$('body').css('opacity', '1.0');
							$("#load_data").show(1000);
							$("#load_data").html(data);
						},
					});
				} else {
					Command: toastr["error"]("No Student Details Found", "Sorry")
					toastr.options = {
						"closeButton": false,
						"debug": false,
						"newestOnTop": false,
						"progressBar": true,
						"positionClass": "toast-top-right",
						"preventDuplicates": false,
						"onclick": null,
						"showDuration": "300",
						"hideDuration": "1000",
						"timeOut": "5000",
						"extendedTimeOut": "1000",
						"showEasing": "swing",
						"hideEasing": "linear",
						"showMethod": "fadeIn",
						"hideMethod": "fadeOut"
					}
					$("#load_data").hide(1000);
				}
			},
		});
		//---------//

	});

	function show_student_details() {
		$("#eye").hide(1000);
		$("#spnr_dsp").show(1000);
		$.ajax({
			url: "<?php echo base_url('Monthly_collection/show_student'); ?>",
			type: "POST",
			success: function(data) {
				var user = JSON.parse(data);
				var html = "";
				var i = 1;
				for (var count = 0; count < user.length; count++) {
					html += "<tr>";
					html += "<td style='cursor: pointer;' onclick=getamd('" + user[count].ADM_NO + "')>" + i + "</td>";
					html += "<td style='cursor: pointer;' onclick=getamd('" + user[count].ADM_NO + "')>" + user[count].ADM_NO + "</td>";
					html += "<td style='cursor: pointer;' onclick=getamd('" + user[count].ADM_NO + "')>" + user[count].FIRST_NM + "</td>";
					html += "<td style='cursor: pointer;' onclick=getamd('" + user[count].ADM_NO + "')>" + user[count].DISP_CLASS + "-" + user[count].DISP_SEC + "</td>";
					html += "<td style='cursor: pointer;' onclick=getamd('" + user[count].ADM_NO + "')>" + user[count].FATHER_NM + "</td>";
					html += "<td style='cursor: pointer;' onclick=getamd('" + user[count].ADM_NO + "')>" + user[count].MOTHER_NM + "</td>";
					html += "</tr>";
					i++;
				}
				$("#stu_details").modal();
				$("#student_data").html(html);
				$("#eye").show(1000);
				$("#spnr_dsp").hide(1000);
			}
		});
	}

	function getamd(val) {
		$("#stu_details").modal('hide');
		var browser = val;
		$.ajax({
			url: "<?php echo base_url('Feepaid_ledger/find_details'); ?>",
			type: "POST",
			data: {
				browser : browser,
			},
			beforeSend: function() {
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data) {
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				$("#load_data").show(1000);
				$("#load_data").html(data);
			},
			error: function(error) {
				alert("Please Check Your Internet Connection");
			}

		});

	}
</script>