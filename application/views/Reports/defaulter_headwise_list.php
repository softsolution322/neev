<?php
	if($feehead)
	{
		$head1 = $feehead[0]->SHNAME;
		$head2 = $feehead[1]->SHNAME;
		$head3 = $feehead[2]->SHNAME;
		$head4 = $feehead[3]->SHNAME;
		$head5 = $feehead[4]->SHNAME;
		$head6 = $feehead[5]->SHNAME;
		$head7 = $feehead[6]->SHNAME;
		$head8 = $feehead[7]->SHNAME;
		$head9 = $feehead[8]->SHNAME;
		// $head10 = $feehead[9]->SHNAME;
		// $head11 = $feehead[10]->SHNAME;
		// $head12 = $feehead[11]->SHNAME;
		// $head13 = $feehead[12]->SHNAME;
		// $head14 = $feehead[13]->SHNAME;
		// $head15 = $feehead[14]->SHNAME;
		// $head16 = $feehead[15]->SHNAME;
		// $head17 = $feehead[16]->SHNAME;
		// $head18 = $feehead[17]->SHNAME;
		// $head19 = $feehead[18]->SHNAME;
		// $head20 = $feehead[19]->SHNAME;
		// $head21 = $feehead[20]->SHNAME;
		$head22 = $feehead[21]->SHNAME;
		$head23 = $feehead[22]->SHNAME;
		// $head24 = $feehead[23]->SHNAME;
		// $head25 = $feehead[24]->SHNAME;
	}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html"><h4><b>Defaulter Head Wise List Of Student</b></h4></a> <i class=""></i></li>
</ol>
<style>
	 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
	  {
		color: black;
		font-size: 12px;
	  }
	  .loader {
	  margin: auto;
	  width: 30%;
	  padding: 50px;
	  }
</style>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
<form id="data_id">
	<div class='row'>
		<div class='col-md-3 form-group'>
			<fieldset>
				<legend id='dm'>Display Mode</legend>
				<input type='radio' name='disp_mode' id='cw' onclick="dt(this.value)" value='1'> Class Wise &nbsp;<input type='radio' onclick='dt(this.value)' value='2' id='ac' name='disp_mode'> All Classes
			</fieldset>
		</div>
		<div class="col-md-3 form-group">
			<fieldset>
				<legend id='vut'>View upto</legend>
				<select class='form-control' name='viewupto' id="viewupto">
					<option value=''>select</option>
					<?php
					if($month_master)
					{
						foreach($month_master as $month_m)
						{
							?>
							<option value='<?php echo $month_m->Month_NM; ?>'><?php echo $month_m->Month_NM; ?></option>
							<?php
						}
					}
					?>
				</select>
			</fieldset>
		</div>
		<div class="col-md-3">
			<fieldset>
				<legend><span id='class1'>Class</span>/<span id='sec1'>Sec</span> Wise</legend>
				<div class='row'>
					<div class='col-md-6'>
						<select class='form-control' name='classs' id='classs' disabled >
							<option value=''>select Class</option>
							<?php
								if($class)
								{
									foreach($class as $class_code)
									{
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
								if($sec)
								{
									foreach($sec as $sec_code)
									{
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
		<div class="col-md-3">
		<br /><br />
			<button class='btn btn-success btn-sm btn-block'>Display</button>
		</div>
	</div>
</form>
		<div style='overflow:auto;'>
		<table class="table table-stripped table-bordered" style='color: black' id="myTable">
	      <thead>
	        <tr>
	          <th style="background: #337ab7; color: white !important; font-size:14px !important">SNO</th>
	          <th style="background: #337ab7; color: white !important; font-size:14px !important">NAME</th>
	          <th style="background: #337ab7; color: white !important; font-size:14px !important">ADM_NO</th>
	          <th style="background: #337ab7; color: white !important; font-size:14px !important">ROLL NO</th>
			  <th style="background: #337ab7; color: white !important; font-size:14px !important">Class/Sec</th>
			  <th style="background: #337ab7; color: white !important; font-size:14px !important">MONTH UPTO</th>
	          <th style="background: #337ab7; color: white !important; font-size:14px !important">PREVIOUS YEAR DUES</th>
	         <th style="background: #337ab7; color: white !important; font-size:14px !important">CURRENT YEAR DUES</th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head1; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head2; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head3; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head4; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head5; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head6; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head7; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head8; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head9; ?></th>
			 <!-- <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head10; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head11; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head12; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head13; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head14; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head15; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head16; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head17; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head18; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head19; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head20; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head21; ?></th> -->
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head22; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php echo $head23; ?></th>
			 <!-- <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head24; ?></th>
			 <th style="background: #337ab7; color: white !important; font-size:14px !important"><?php //echo $head25; ?></th> -->
	         <th style="background: #337ab7; color: white !important; font-size:14px !important">TOTAL AMOUNT</th>
	        </tr>
	      </thead>
		  
	    </table>
		<div id='loader' class='loader' style='display:none'>
           <img src="<?php echo base_url()?>assets/log_image/tenor.gif" width="180px" height="100px">
           </div>
	      <div id="vis_det" class="table-responsive">		
		  
		  </div>
		</div>
	
</div><br />
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
 function dt(val)
 {
	 if(val==1)
	 {
		$('#classs').prop('disabled', false);
		$('#sec').prop('disabled', false);
	 }
	 else{
		$('#classs').prop('disabled',true);
		$('#sec').prop('disabled', true);
	 }
 }
	$("#data_id").on("submit", function (event) {
		event.preventDefault();
		var cw = $('#cw').val();
		var ac = $('#ac').val();
		var viewupto = $('#viewupto').val();
		var classs = $('#classs').val();
		var sec = $('#sec').val();
		if( $('#cw').is(":checked") || $('#ac').is(":checked") )
		{
			if( $('#cw').is(":checked") )
			{
				$dlt = 'Class Wise';
				$('#dm').css("color","black");
				if(viewupto!='')
				{
					$('#vut').css("color","black");
					if(classs!='')
					{
						$('#class1').css("color","black");
						if(sec!='')
						{
							
							$('#sec1').css("color","black");
							$('#sec1').css("color","black");
							$('#loader').show();
				
						    $.ajax({
							url : "<?php echo base_url('Defaulter_headwise_list/defaulter_classwise') ?>",
							type: "POST",
							data: {viewupto:viewupto,classs:classs,sec:sec},
							success: function(data)
							{
							   $('#loader').hide();
							   $('#vis_det').html(data);
							   $('#myTable').hide();
							   
							}, 
						});  
							
						}
						else
						{
							$('#sec1').css("color","red");
						}
					}
					else
					{
						$('#class1').css("color","red");
					}
				}
				else
				{
					$('#vut').css("color","red");
					alert("Please Generate Fee For Respective Month or select Month");
				}
			}
			else if( $('#ac').is(":checked") )
			{
				$('#dm').css("color","black");
				if(viewupto!='')
				{
					$('#loader').show();
				
				    $.ajax({
					url : "<?php echo base_url('Defaulter_headwise_list/defaulter_allclasswise') ?>",
					type: "POST",
					data: {viewupto:viewupto,classs:classs,sec:sec},
					success: function(data)
					{
					   $('#loader').hide();
					   $('#vis_det').html(data);
					   $('#myTable').hide();
					   
					}, 
				});  
				}
				else
				{
					$('#vut').css("color","red");
					alert("Please Generate Fee For Respective Month or select Month");
				}
				
			}
			else{
				alert("Please Checked Class Wise Or All Classes");
			}
		}
		else
		{
			$('#dm').css("color","red");
		}
	});
</script>