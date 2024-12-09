<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Homework</a> <i class="fa fa-angle-right"></i> Add Homework </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
  <div class="row">
    <div class='col-sm-4'>
	    <?php
			  if($this->session->flashdata('msg')){
				  ?>
				    <div class="alert alert-success">
					   <?php echo $this->session->flashdata('msg'); ?>
					</div>
				  <?php
			  }
		?>
		<div id='load'>
		<form method='post' action='<?php echo base_url('homework/Homework/saveHomework'); ?>' enctype='multipart/form-data' id='myform' onsubmit='disabled()'>
		<table class='table'>
		<!--<input type='hidden' name='class' value='<?php //echo $clasa_no; ?>'>
		<input type='hidden' name='sec' value='<?php //echo $sec_no; ?>'>-->
		<input type='hidden' name='date' value='<?php echo $date; ?>'>
			<tr>
				<th>Category</th>
				<td>
					<select class='form-control' name='category' required onchange='sub_date()'>
						<option value=''>Select</option>
						<?php
							if(!empty($homeworkCatMaster)){
								foreach($homeworkCatMaster as $key => $val){
									?>
										<option value='<?php echo $val['id']; ?>'><?php echo $val['category']; ?></option>
									<?php
								}
							}
						?>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Class</th>
				<td>
					<select class='form-control' name='class' id='cls' required onchange='clses(this.value)'>
						<option value=''>Select</option>
						<?php
							if($classData){
								foreach($classData as $key => $val){
									?>
										<option value='<?php echo $val['Class_no']; ?>'><?php echo $val['classnm']; ?></option>
									<?php
								}
							}
						?>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Section</th>
				<td>
					<select class='form-control' name='sec' id='section' required onchange='sectn(this.value)'>
						<option value=''>Select</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Subject</th>
				<td>
					<select class='form-control' name='subject' required id='subj'>
						<option value=''>Select</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Remarks</th>
				<td>
					<textarea class='form-control' name='notice' required rows='5'></textarea>
				</td>
			</tr>
			<tr>
				<th>Attachment</th>
				<td><input type='file' name='img[]' class='form-control' accept="application/pdf, image/jpeg, image/jpg, image/png" multiple></td>
			</tr>
			
			<tr>
				<th>Submission Date</th>
				<td><input type='text' name='submission_date' class='form-control dt'autocomplete='off' required readonly="" onchange='sub_date()'></td>
			</tr>
			
			<tr>
				<th>All Students</th>
				<td>
					<input type='radio' value='1' name='selectAll' onclick='SelectAll(this.value)' checked>YES
					&nbsp;&nbsp;&nbsp;
					<input value='0' name='selectAll' type='radio' onclick='SelectAll(this.value)'>NO
			    </td>
			</tr>
			
			<tr id='dropdown' style='display:none;'>
				<th></th>
				<td>
					<select id="multiselect" multiple="multiple" class='form-control' style='width:100%' name='selectParticultStu[]' disabled>
						<option value="">Select</option>
						<?php
							foreach($stuData as $key => $val){
								?>
									<option value='<?php echo $val['STUDENTID']; ?>'><?php echo $val['ADM_NO'].' ('.$val['FIRST_NM'].')'?></option>
								<?php
							}
						?>
                    </select>
				</td>
			</tr>
			
			<tr>
				<td colspan='2'><center><button class='btn btn-success btn-sm'>Send <i class="fa fa-paper-plane" style='color:#fff'></i></button></center></td>
			</tr>
		</table>
		</form>
		</div>
	</div>
	
    <div class='col-sm-8'>
    <div class='table-responsive'>
	<table class='table dataTable'>
	<thead>
		<tr>
			<th style='color:#fff !important; background:#5785c3;'>Date</th>
			<th style='color:#fff !important; background:#5785c3;'>Subject</th>
			<th style='color:#fff !important; background:#5785c3;'>Class</th>
			<th style='color:#fff !important; background:#5785c3;'>Sec</th>
			<th style='color:#fff !important; background:#5785c3;'>Category</th>
			<th style='color:#fff !important; background:#5785c3;'>Remarks</th>
			<th style='color:#fff !important; background:#5785c3;'>Action</th>
		</tr>
	</thead>	
	<tbody>
		<?php
		    $tDate = strtotime(date('Y-m-d'));
			foreach($homeworkData as $key => $val){
				if($val['emp_id'] == $login_id){
				?>
					<tr>
						<td><?php echo $val['date']; ?></td>
						<td><?php echo $val['subject']; ?></td>
						<td><?php echo $val['disp_class']; ?></td>
						<td><?php echo $val['disp_sec']; ?></td>
						<td><?php echo $val['catnm']; ?></td>
						<td><?php echo $val['remarks']; ?></td>
						<td>
							<?php
								if($tDate <= strtotime($val['submission_date'])){
								?>
								<a href='#' title='EDIT' onclick='edit(<?php echo $val['id']; ?>)'><i class="fa fa-pencil-square" style=' font-size:20px; color:green'></i></a>
							<?php }else{ ?>
								<a href='#' title='EDIT' onclick="expired()"><i class="fa fa-pencil-square" style=' font-size:20px; color:green'></i></a>
							<?php } ?>
						</td>
					</tr>
				<?php
				}
			}
		?>
	</tbody>	
	</table>
	</div>
	</div>
	</div>
	</div><br />
	
<script type="text/javascript">
   $(".alert").fadeOut(3000);
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });
   $("#multiselect").select2();
	
   $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      aaSorting: [[0, 'asc']]
    })
  });
  function SelectAll(value){
	  if(value == 0){
		$("#dropdown").show();
		$("#multiselect").prop('disabled',false);
	  }else{
		$("#dropdown").hide();    
		$("#multiselect").prop('disabled',true);
	  }
  }

  function edit(id){
	  $.post("<?php echo base_url('homework/Homework/noticeEdit'); ?>",{id:id},function(data){
		  $("#load").html(data);
	  });
  }
  
  function clses(val){
	  $.post("<?php echo base_url('homework/Homework/loadSec'); ?>",{class_id:val},function(data){
		  $("#section").html(data);
	  });
  }
  
  function sectn(val){
	  var cls = $("#cls").val();
	  $.post("<?php echo base_url('homework/Homework/loadSubj'); ?>",{sec_id:val,cls:cls},function(data){
		  $("#subj").html(data);
	  });
  }
  
	$(document).ready(function () {
    $('#myform').validate({ // initialize the plugin
	rules: {
		img: {
		  required: false,
		  extension: "jpeg|pdf|jpg|png",
		}
	  },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
   });
   
   function expired(){
   $.toast({
		heading: 'Warning',
		text: 'Submission Date Expired',
		showHideTransition: 'slide',
		icon: 'warning',
		position: 'top-right',
	});
   }
   
   function disabled(){
		$(".btn").attr('disabled',true);
	}
	
   function sub_date(){
	   $(".btn").attr('disabled',false);
   }	
</script>