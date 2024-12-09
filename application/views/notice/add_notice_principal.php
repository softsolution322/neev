<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Notice</a> <i class="fa fa-angle-right"></i> Add Notice </li>
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
		<form method='post' action='<?php echo base_url('notice/AddNoticePrincipal/saveNotice'); ?>' enctype='multipart/form-data' id='myform' onsubmit='disabled()'>
		<table class='table'>
		<input type='hidden' name='class' value='<?php echo $clasa_no; ?>'>
		<input type='hidden' name='sec' value='<?php echo $sec_no; ?>'>
		<input type='hidden' name='date' value='<?php echo $date; ?>'>
			<tr>
				<th>Sent Type</th>
				<td>
					<select class='form-control' name='sent' required onchange='sentType(this.value)'>
						<option value=''>Select</option>
						<option value='circular'>Circular</option>
						<option value='sms'>SMS</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Category</th>
				<td>
					<select class='form-control' name='category' required onchange='cat()'>
						<option value=''>Select</option>
						<option value='School Notice'>School Notice</option>
						<option value='Complaint Notice'>Complaint Notice</option>
						<option value='Fee Defaulter'>Fee Defaulter</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Notice</th>
				<td>
					<textarea class='form-control' id='txt' maxlength="150" name='notice' required rows='5'></textarea>
					<span id="chars" style='font-size:12px; color:red; display:none'>150 </span> <i style='font-size:12px; color:red; display:none' id='char'>characters remaining</i>
				</td>
			</tr>
			<tr>
				<th>Attachment</th>
				<td><input type='file' name='img' class='form-control' accept="application/pdf, image/jpeg"></td>
			</tr>
			
			<tr>
				<th>Send To</th>
				<td>
					<input type='radio' value='1' name='sendto' onclick='sendTo(this.value)' checked> Teachers
					&nbsp;&nbsp;&nbsp;
					<input value='2' name='sendto' type='radio' onclick='sendTo(this.value)'> Students
			    </td>
			</tr>
			
			<tr id='teacher_tr'>
				<th>Teachers</th>
				<td>
					<select name='teacher[]' class='form-control' id='teachers' style='width:100%'>
						<option value='all_teacher'>All Teachers</option>
						<?php
							if(!empty($teacher_data)){
								foreach($teacher_data as $key => $val){
									?>
										<option value='<?php echo $val['EMPID']; ?>'><?php echo $val['EMP_FNAME'].' '.$val['EMP_MNAME'].' '.$val['EMP_LNAME'].' ('.$val['EMPID'].')'; ?></option>
									<?php
								}
							}
						?>
					</select>
			    </td>
			</tr>
			
			
			<tr id='classSec_tr' style='display:none'>
				<th>Class/Sec</th>
				<td>
					<select name='classSec[]' class='form-control' style='width:100%' id='classsec'>
						<option value='all_classsec'>All Class Section</option>
						<?php
							if(!empty($classSecData)){
								foreach($classSecData as $key => $val){
									?>
										<option value='<?php echo $val['CLASS'].'-'.$val['SEC']; ?>'><?php echo $val['DISP_CLASS'].'-'.$val['DISP_SEC']; ?></option>
									<?php
								}
							}
						?>
					</select>
			    </td>
			</tr>
			
			<tr>
				<td colspan='2'><center><button class='btn btn-success btn-sm'>Send <i class="fa fa-circle-o-notch fa-spin" style='color:#fff; display:none'></i></button></center></td>
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
			<th style='color:#fff !important; background:#5785c3;'>Category</th>
			<th style='color:#fff !important; background:#5785c3;'>Notice</th>
			<th style='color:#fff !important; background:#5785c3;'>Action</th>
		</tr>
	</thead>	
	<tbody>
		<?php
			foreach($noticeData as $key => $val){
				if($val['emp_id'] == $login_id){
				?>
					<tr>
						<td><?php echo $val['date']; ?></td>
						<td><?php echo $val['notice_category']; ?></td>
						<td><?php echo $val['notice']; ?></td>
						<td><a href='#' title='EDIT' onclick='edit(<?php echo $val['id']; ?>)'><i class="fa fa-pencil-square" style=' font-size:20px; color:green'></i></a></td>
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
</div>
<br /><br />


<!-- /.modal -->
<script type="text/javascript">
   $(".alert").fadeOut(3000);
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true });

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
  
  // $(document).ready(function(){
        // $('#teachers').multiselect();
        // $('#classsec').multiselect();
  // });
  $("#teachers").select2();
  $("#classsec").select2();

  $(document).ready(function () {
    $('#myform').validate({ // initialize the plugin
	rules: {
		img: {
		  required: false,
		  extension: "jpeg|pdf|jpg",
		}
	  },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
   });
  
  function sendTo(val){
	  if(val == 2){
		$("#teacher_tr").hide();  
		$("#classSec_tr").show();  
	  }else{
		$("#teacher_tr").show();    
		$("#classSec_tr").hide();    
	  }
  }
  
  
  function SelectTeacher(value){
	  if(value == 0){
		$("#dropdownTeacher").show();
		$("#multiselectTeacher").prop('disabled',false);
	  }else{
		$("#dropdownTeacher").hide();    
		$("#multiselectTeacher").prop('disabled',true);
	  }
  }
  
  function edit(id){
	  $.post("<?php echo base_url('notice/AddNotice/noticeEdit'); ?>",{id:id},function(data){
		  $("#load").html(data);
	  });
  }
	
  var maxLength = 150;
	$('textarea').keyup(function() {
	  var length = $(this).val().length;
	  var length = maxLength-length;
	  $('#chars').text(length);
	});
	
	function sentType(val){
		$("#txt").val('');
		if(val == 'sms'){
			$("#txt").attr('maxlength','150');
			$("#chars").show();
			$("#char").show();
		}else{
			$("#txt").attr('maxlength','10000');
			$("#chars").hide();
			$("#char").hide();
		}
	}
	
	function disabled(){
	  $('.btn').attr('disabled',true);
	  $('.fa-spin').show();
    }
  
  function cat(){
	$('.btn').attr('disabled',false);
	$('.fa-spin').hide();  
  }
</script>