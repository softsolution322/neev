<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">
			<h4><b>Transfer Certificate</b></h4>
		</a> <i class=""></i></li>
	<li class="breadcrumb-item" style="float: right;padding:2px"><i class="fa fa-angle-left"></i> <a href="<?php echo base_url('Student_report/certificate_master'); ?>" style="font-size:18px;">Back </a></li>
</ol>
<style>
.breadcrumb>li+li:before {
		content: "";
	}	
</style>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<form id="form">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-lg-4 form-group">
				<label>Admission No.</label>
				<input list="browsers" name="adm_no" class="form-control">
 						<datalist id="browsers">
 							<?php
								foreach ($adm as $admdata) {
								?>
 								<option value="<?php echo $admdata->ADM_NO; ?>"><?php echo $admdata->FIRST_NM; ?>
 								<?php
								}
									?>
 						</datalist>
			</div>             
			<div class="col-md-4 col-sm-4 col-lg-4 form-group">
				<label>Transfer Certificate No.</label>
				<input type="text" value="<?php echo $tc_number; ?>" class="form-control" id="tcn" name="tcn" readonly>
			</div>             
			<div class="col-md-4 col-sm-4 col-lg-4">
			<br />
				<button class='btn btn-success btn-sm'>SUBMIT</button>
			</div>
			
		</div>
	</form>
	<div id="load_data"></div>
</div><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></br></br>
<script>
	$("#form").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
		url: "<?php echo base_url('Transfer_certificate/details_show'); ?>",
		type: "POST",
		data: $("#form").serialize(),
		success: function(data){
			var user = JSON.parse(data);
			var data_cnt = user[0];
			if(data_cnt == 1){
				var tc_issue = user[2];
				if(tc_issue == 1)
				{
					alert("Tc Already Issue");
					return false;
				}
				else
				{
					var defaulter = user[1];
				if(defaulter > 0){
					if( confirm("Student Comes Under Defaulter List")){
							$.ajax({
							url: "<?php echo base_url('Transfer_certificate/student_details'); ?>",
							type: "POST",
							data: $("#form").serialize(),
							success:function(data){
							$("#load_data").html(data);
						},
					});
					}
					else{
						
					}
				}
				else{
					$.ajax({
					url: "<?php echo base_url('Transfer_certificate/student_details'); ?>",
					type: "POST",
					data: $("#form").serialize(),
					success:function(data){
						$("#load_data").html(data);
					},
				});
				}
				}
				
			}else{
				alert ("Sorry No Data Found");
				return false;
			}
		},
		error : function(handel){
			alert("data No Found");
		},
	});
 });
</script>