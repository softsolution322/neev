<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Class Assessment</a> <i class="fa fa-angle-right"></i> Copy Questions </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
  <div class="row">
    <div class='col-sm-12'>
	    <?php
			  if($this->session->flashdata('msg')){
				  ?>
				    <div class="alert alert-success">
					   <?php echo $this->session->flashdata('msg'); ?>
					</div>
				  <?php
			  }
		?>
		<form id='addQuestionFormChk' action='<?php echo base_url('e_exam/AddQuestions/saveQuestion'); ?>' method='post' autocomplete='off' enctype='multipart/form-data'>
		<table class='table'>
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
				
				<th>Section</th>
				<td>
					<select class='form-control' name='sec' id='section' required onchange='sectn(this.value)'>
						<option value=''>Select</option>
					</select>
				</td>
				
				<th>Subject</th>
				<td>
					<select class='form-control' name='subject' required id='subj' onchange='getExamDate()'>
						<option value=''>Select</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Exam Date</th>
				<td>
					<select name='examDate' id='examDate' class='form-control' required onchange='getExamTime()'>
						<option value=''>Select</option>
					</select>
				</td>
				
				<th>Exam Time</th>
				<td>
					<select name='examTime' id='examTime' class='form-control' required onchange='getQuestions()'>
						<option value=''>Select</option>
					</select>
				</td>
			</tr>
		</table>
		</form>
	</div>
	</div><br /><br />
	
	<div class='row'>
		<div class='col-sm-12' id='load'>
		</div>
	</div>
	
	</div><br />
	
<script type="text/javascript">
   $(".alert").fadeOut(3000);
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });
   $('.examDt').datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });
   //$('.timepicker').pickatime({});
   $('.timepicker').timepicker();
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
  
  function clses(val){
	  $.post("<?php echo base_url('e_exam/CopyQuestions/loadSec'); ?>",{class_id:val},function(data){
		  $("#section").html(data);
	  });
  }
  
  function sectn(val){
	  var cls = $("#cls").val();
	  $.post("<?php echo base_url('e_exam/CopyQuestions/loadSubj'); ?>",{sec_id:val,cls:cls},function(data){
		  $("#subj").html(data);
	  });
  }
  
  function getExamDate(){
	 var cls     = $("#cls").val();
	 var section = $("#section").val();
	 var subj    = $("#subj").val();
	 $.post("<?php echo base_url('e_exam/CopyQuestions/getExamDate'); ?>",{cls:cls,section:section,subj:subj},function(data){
		  $("#examDate").html(data);
	 }); 
  }
  
  function getExamTime(){
	 var cls      = $("#cls").val();
	 var section  = $("#section").val();
	 var subj     = $("#subj").val();
	 var examDate = $("#examDate").val();
	 $.post("<?php echo base_url('e_exam/CopyQuestions/getExamTime'); ?>",{cls:cls,section:section,subj:subj,examDate:examDate},function(data){
		  $("#examTime").html(data);
	 });  
  }
  
  function getQuestions(){
	 var cls      = $("#cls").val();
	 var section  = $("#section").val();
	 var subj     = $("#subj").val();
	 var examDate = $("#examDate").val();  
	 var examTime = $("#examTime").val();
	 
	 $.post("<?php echo base_url('e_exam/CopyQuestions/getQuestions'); ?>",{cls:cls,section:section,subj:subj,examDate:examDate,examTime:examTime},function(data){
		  $("#load").html(data);
	 });	
  }
</script>