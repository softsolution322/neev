<?php
error_reporting(0);
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Assign Vehicle </a> <i class="fa fa-angle-right"></i></li>
</ol>
<style type="text/css">
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  margin: 0px auto;
  z-index:999;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div class="loader" style="display:none;"></div>
<!-- Content Wrapper. Contains page content -->
<div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
<div class="col-sm-3"></div>
		<div class='col-sm-6'>
		   <?php
		     if($this->session->flashdata('msg')):
		   ?>
		    <div class="alert alert-success" role="alert" id="msg">
			  <strong><?php echo $this->session->flashdata('msg'); ?></strong>
			</div>  
		   <?php endif; ?>	  
		</div>
        <div class='col-sm-3'>		
		  <a href="<?php echo base_url('Driver_master/index'); ?>" class='btn btn-warning pull-right'>Back</a><br /><br /><br />
        </div>
	<form action="<?php echo base_url('Driver_master/save_driver'); ?>" method="post">
	<input type='hidden' name='id_name' value="<?php echo $details->Driver_ID; ?>">
	<div class="row">
		<div class="col-sm-3">
		  <div class="form-group">
			<label>Select Vehicle No.</label><span class="span">*</span>
			<select class="form-control" name="vn" onchange='selectvechice(this.value)' id='vn' required>
				<option value="">Select</option>
				<?php
					foreach($bus_master as $key=>$value){
						?>
						<option <?php if($value->BusCode == $details->BusCode){echo "selected";} ?> value='<?php echo $value->BusCode; ?>'><?php echo $value->BusNo; ?></option>
						<?php
					}
				?>
			</select>
		  </div>
		</div>
		<div class="col-sm-3">
		  <div class="form-group">
			<label>Select Trip</label><span class="span">*</span>
			<select class="form-control" onchange='selecttrip(this.value)' name="tm" id='strip' disabled='true' required>
				<option value="">Select</option>
				<?php
					foreach($bus_trip_master as $trip=>$tripvalue){
						?>
						<option <?php if($tripvalue->Trip_ID == $details->trip_id){echo "selected";} ?> value='<?php echo $tripvalue->Trip_ID; ?>'><?php echo $tripvalue->Trip_Nm; ?></option>
						<?php
					}
				?>
			</select>
		  </div>
		</div>
		<div class="col-sm-6">
		  <div class="form-group">
			<label>Driver Name</label><span class="span">*</span>
			<input type='hidden' id='dnhf' name='dnhf'>
			<select class='form-control' onchange='getdirverdetails()' disabled='true' name='dempid' id='dn' required>
				<option value=''>select</option>
				<?php
					foreach($driver as $key1=>$value1){
						?>
							<option value='<?php echo $value1->EMPID; ?>'><?php echo $value1->EMP_FNAME." ".$value1->EMP_MNAME." ".$value1->EMP_LNAME; ?></option>
						<?php
					}
				?>
			</select>
		  </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label>Driver Date of Birth</label><span class="span">*</span>
				<input type="date" name="ddb" readonly id='ddb' class="form-control" required>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Driver Phone No.</label><span class="span">*</span>
				<input type="number" readonly id='dpn' name="dpn" min="1" class="form-control" >
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Driver Address</label><span class="span">*</span>
				<input type="text" required id='da' name="da" class="form-control" >
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label>Driver License No.</label><span class="span">*</span>
				<input type="text" name="dln"  class="form-control" required>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Khallasi Name</label><span class="span">*</span>
				<select name='kn' onchange='checkkhallasi(this.value)' class='form-control' id='kn' required>
					<option value=''>select</option>
					<?php
						foreach($khallasi as $key2=>$value2){
							?>
								<option value='<?php echo $value2->EMPID; ?>'><?php echo $value2->EMP_FNAME." ".$value2->EMP_MNAME." ".$value2->EMP_LNAME; ?></option>
							<?php
						}
					?>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Khallasi Phone No.</label><span class="span">*</span>
				<input type="text" name="kph" id='kph' readonly class="form-control">
				<input type='hidden' id='kname' name='kname'>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Incharge Name</label><span class="span">*</span>
				<select class="form-control" required name="in" onchange='getinchargenumber(this.value)'>
					<option value="">select</option>
					<?php
						foreach($incharge as $in=>$inval){
							?>
								<option <?php if($inval->Incharge_Id == $details->incharge_id){echo "selected";} ?> value="<?php echo $inval->Incharge_Id ?>"><?php echo $inval->Incharge_nm; ?></option>
							<?php
						}
					?>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Incharge Phone No.</label><span class="span">*</span>
				<input type="number" readonly id='incharge_ph' name="ipn" min='1' class="form-control">
			</div>
		</div>
	</div>
	<button class='pull-right btn btn-success'>Save</button>
	</form>
</div><br></br>
<div class="clearflex"></div>
<script>
	function selectvechice(val){
		if(val!=null){
			$('#strip').prop('disabled',false);
		}else{
			$('#strip').prop('disabled',true);
		}
	}
	function selecttrip(val){
		if(val!=null){
			$('#dn').prop('disabled',false);
		}else{
			$('#dn').prop('disabled',true);
		}
	}
	function getdirverdetails(){
		var vechiclename = $('#vn').val();
		var strip = $('#strip').val();
		var val = $('#dn').val();
		//alert("vechiclename is "+vechiclename+" trip is "+strip+" emp code is "+val);
		$.ajax({
			url: "<?php echo base_url('Driver_master/getdetailsCHECK'); ?>",
			type: "POST",
			data: {val:val,vechiclename:vechiclename,strip:strip},
			beforeSend:function(){
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data){
				var user = JSON.parse(data);
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				var cnt = user[0];
				if(cnt >=1){
					alert(user[1]+" is already assign with selected trip and vehicle no.");
					$('#dn option[value=""]').prop('selected',true);
					
				}else{
					$.ajax({
					url: "<?php echo base_url('Driver_master/getdetailsaftercheck'); ?>",
					type: "POST",
					data: {val:val},
					beforeSend:function(){
						$('.loader').show();
						$('body').css('opacity', '0.5');
					},
					success: function(data){
						var user = JSON.parse(data);
						$('.loader').hide();
						$('body').css('opacity', '1.0');
							$('#dpn').val(user[0].C_MOBILE);
							if(user[0].C_ADD == null){
								var fadd = '';
							}
							else{
								var fadd = user[0].C_ADD;
							}
							if(user[0].C_CITY == null){
								var ladd = '';
							}
							else{
								var ladd = user[0].C_CITY;
							}
							$('#da').val(fadd+" "+ladd);
							$('#ddb').val(user[0].D_O_B);
							if(user[0].EMP_FNAME == null){
								var fname = '';
							}else{
								var fname = user[0].EMP_FNAME;
							}
							if(user[0].EMP_MNAME == null){
								var Mname = '';
							}else{
								var Mname = user[0].EMP_MNAME;
							}
							if(user[0].EMP_LNAME == null){
								var Lname = '';
							}else{
								var Lname = user[0].EMP_LNAME;
							}
							$('#dnhf').val(fname+" "+Mname+" "+Lname);
						},
					});
				}
			},
		});
		
	}
	function checkkhallasi(val){
		var vechiclename = $('#vn').val();
		var strip = $('#strip').val();
		if(val !='' && vechiclename !='' && strip !=''){
			$.ajax({
			url: "<?php echo base_url('Driver_master/checkkhallasi'); ?>",
			type: "POST",
			data: {val:val,vechiclename:vechiclename,strip:strip},
			beforeSend:function(){
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data){
					$('.loader').hide();
					$('body').css('opacity', '1.0');
					if(data >= 1){
						$('#kph').val('');
						$('#kn option[value=""]').prop('selected',true);
						alert('This Khallasi is already assign on selected vehicle and selected trip.');
					}else{
						$.ajax({
						url: "<?php echo base_url('Driver_master/getkhallasidetails'); ?>",
						type: "POST",
						data: {val:val},
						beforeSend:function(){
							$('.loader').show();
							$('body').css('opacity', '0.5');
						},
						success: function(data){
							var user = JSON.parse(data);
							$('.loader').hide();
							$('body').css('opacity', '1.0');
							$('#kph').val(user[0].C_MOBILE);
							if(user[0].EMP_FNAME == null){
								var fname = '';
							}else{
								var fname = user[0].EMP_FNAME;
							}
							if(user[0].EMP_MNAME == null){
								var Mname = '';
							}else{
								var Mname = user[0].EMP_MNAME;
							}
							if(user[0].EMP_LNAME == null){
								var Lname = '';
							}else{
								var Lname = user[0].EMP_LNAME;
							}
							$('#kname').val(fname+" "+Mname+" "+Lname);
							
						},
					});
					}
				},
			});
		}else{
			alert("Please select vehicle and trip first");
			$('#kn option[value=""]').prop('selected',true);
		}
	}
	function getinchargenumber(val){
		$.ajax({
			url: "<?php echo base_url('Driver_master/changeinchargephone'); ?>",
			type: "POST",
			data: {val:val},
			beforeSend:function(){
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data){
				var user = JSON.parse(data);
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				$('#incharge_ph').val(user[0]);
				$('#incharge_id').val(user[1]);
			},
		});
	}
</script>