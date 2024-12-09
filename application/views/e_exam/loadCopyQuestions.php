<table class='table' border='1'>
	<tr>
		<th style='background:#5785c3; color:#fff;'>Que No.</th>
		<th style='background:#5785c3; color:#fff;'>Questions</th>
		<th style='background:#5785c3; color:#fff;'>Max Marks</th>
	</tr>
	<?php
		if(!empty($getQuestionData)){
			foreach($getQuestionData as $key => $val){
				?>
					<tr>
						<td><?php echo $val['que_no']; ?></td>
						<td><?php echo $val['question']; ?></td>
						<td><?php echo $val['max_marks']; ?></td>
					</tr>
				<?php
			}
		}
	?>
</table><br />

<div class='row'>
<div class='col-sm-6'>
	<b>Copy To:</b><br /><br />
	
	<b>Class</b>
	<select class='form-control' name='paste_cls' id='paste_cls' required onchange='clses(this.value)'>
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
	</select><br />
	<b>Section</b>
	<select class='form-control' name='paste_sec' id='paste_sec' required>
		<option value=''>Select</option>
	</select><br />
	
	<b>Exam Date</b>
	<input type='text' name='paste_examDate' id='paste_examDate' class='form-control examDt' required onchange='insertValidation()'><br />
	
	<b>Exam Time</b>
    <input type='text' name='paste_examTime' id='paste_examTime' class='form-control timepicker' required><br />
	
	<b>Exam Time Duration</b>
   <select class='form-control' name='paste_examTimeDuration' id='paste_examTimeDuration' required>
		<option value=''>Select</option>
		<option value='05'>05 Min</option>
		<option value='10'>10 Min</option>
		<option value='15'>15 Min</option>
		<option value='20'>20 Min</option>
		<option value='25'>25 Min</option>
		<option value='30'>30 Min</option>
		<option value='35'>35 Min</option>
		<option value='40'>40 Min</option>
		<option value='45'>45 Min</option>
		<option value='50'>50 Min</option>
		<option value='55'>55 Min</option>
		<option value='60'>60 Min</option>
	</select><br />
	<button class='btn btn-success btn-sm' onclick='pasteDate()' id='btn'><i class="fa fa-circle-o-notch fa-spin" id='process' style='display:none'></i> Paste</button>
</div>
</div>

<script>
	$('.examDt').datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });
	$('.timepicker').timepicker();
	function clses(val){
	  $.post("<?php echo base_url('e_exam/CopyQuestions/loadSec'); ?>",{class_id:val},function(data){
		  $("#paste_sec").html(data);
	  });
    }
	
	function insertValidation(){
		 let paste_cls = $("#paste_cls").val();
		 let paste_sec = $("#paste_sec").val();
		 let subj = $("#subj").val();
		 let paste_examDate = $("#paste_examDate").val();
		 $.ajax({
			 url: "<?php echo base_url('e_exam/CopyQuestions/insertValidation'); ?>",
			 type: "POST",
			 data: {cls:paste_cls,section:paste_sec,subj:subj,examDate:paste_examDate},
			 success: function(ret){
				 if(ret == 1){
					$("#btn").attr('disabled',false); 
				 }else{
					 $.toast({
						heading: 'Error',
						text: 'Exam Already scheduled',
						showHideTransition: 'slide',
						icon: 'error',
						position: 'top-right',
					 });
					$("#paste_cls").val('');
		            $("#paste_sec").val('');
		            $("#paste_examDate").val('');
					$("#btn").attr('disabled',true);
				 }
			 }
		 });
	 }
	
	function pasteDate(){
		$("#process").show();
		$("#btn").prop('disabled',true);
		 var cls      = $("#cls").val();
		 var section  = $("#section").val();
		 var subj     = $("#subj").val();
		 var examDate = $("#examDate").val();  
		 var examTime = $("#examTime").val();
		 
		 var paste_cls      = $("#paste_cls").val();
		 var paste_sec      = $("#paste_sec").val();
		 var paste_examDate = $("#paste_examDate").val();
		 var paste_examTime = $("#paste_examTime").val();
		 var paste_examTimeDuration = $("#paste_examTimeDuration").val();
		 if(paste_cls != '' && paste_sec != '' && paste_examDate != '' && paste_examTime != '' && paste_examTimeDuration != ''){
			$.post("<?php echo base_url('e_exam/CopyQuestions/pasteQuestion'); ?>",{cls:cls,section:section,subj:subj,examDate,examTime,paste_cls:paste_cls,paste_sec:paste_sec,paste_examDate:paste_examDate,paste_examTime:paste_examTime,paste_examTimeDuration:paste_examTimeDuration},function(data){
				  $("#paste_sec").html(data);
				  $("#process").hide();
				  alert('Question Paste Successfully');
				  location.reload();
			 }); 
		 }else{
			 alert('Select Required Fields');
		 }
		 
		 
	}
</script>