<style type="text/css">
 .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
	 color: #000;
	 white-space: nowrap !important;
 }
</style>
<?php
$date = date('d-M-Y');
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('punching/manualpunch'); ?>">Teacher</a> <i class="fa fa-angle-right"></i> Assign Class Teacher </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding: 15px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
   <div class="col-sm-3">
   <form id="form"> 
    <table class='table'>
	  <tr>
	    <th>Teacher</th>
		<td>
		  <select class='form-control' name='teacher' id='teacher' required>
		    <option value=''>Select</option>
			<?php
			  foreach($teacher_data as $data){
				  ?>
				   <option value='<?php echo $data->EMPID; ?>'><?php echo $data->EMP_FNAME ." ". $data->EMP_MNAME ." ". $data->EMP_LNAME?></option>
				  <?php
			  }
			?>
		  </select>
		</td>
	  </tr>
	  <tr>
	    <th>Class Teacher</th>
		<td>
		  <input type='radio' name='class_teacher' value='Y' onclick='cls_tchr(this.value)'> Yes
           &nbsp;&nbsp;		  
		  <input type='radio' name='class_teacher' value='N' checked onclick='cls_tchr(this.value)'> No
		</td>
	  </tr>
	  <tr class='class_sec' style="display:none;">
	    <th>Class</th>
		<td>
		  <select class='form-control' name='classs' id="classs" onchange='cls()' required disabled>
		    <option value=''>Select</option>
			<?php
			  foreach($class_data as $data){
				  ?>
				   <option value='<?php echo $data->Class_No; ?>'><?php echo $data->CLASS_NM; ?></option>
				  <?php
			  }
			?>
		  </select>
		</td>
	  </tr>
	  <tr class='class_sec' style="display:none;">
	    <th>Sec</th>
		<td>
		  <select class='form-control' name='sec' id='sec' required disabled>
		    <option value=''>Select</option>
		  </select>
		</td>
	  </tr>
	  <tr>
	    <td colspan='2' align='center'><button type='button' class='btn btn-success' onclick='assign_class_teacher_save()'>SAVE</button></td>
	  </tr>
    </table>
	</form>
   </div>
   
   <div class='col-sm-9'>
     <div id="load_data" style='height:350px; overflow:auto;'>
	    
	 </div>
   </div>
  </div>
</div>
<br /><br />


<!-- /.modal -->
<div class="loader"></div>
<script type="text/javascript">
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
  
  function cls(){
	  var classs = $("#classs").val();
	  $.post("<?php echo base_url('teacher/Assign_class_teacher/section'); ?>",{classs:classs},function(data){
		  $("#sec").html(data);
	  });
  }
  
  function cls_tchr(val){
	 if(val == 'Y'){
		 $(".class_sec").show();
		 $("#classs").prop('disabled',false);
		 $("#sec").prop('disabled',false);
	 }else{
		 $(".class_sec").hide();
		 $("#classs").prop('disabled',true);
		 $("#sec").prop('disabled',true);
	 }
  }
  
  function assign_class_teacher_save(){
	  if(!$('#form')[0].checkValidity()){
		  $(this).show();
		  $("#form")[0].reportValidity();
		  return false;
	  }else{
		  var emp_id     = $("#teacher").val();
		  var class_teac = $("input[name='class_teacher']:checked").val();
		  var class_id   = $("#classs").val();
		  var sec_id     = $("#sec").val();
		  $.post("<?php echo base_url('teacher/Assign_class_teacher/save_assign_class_teacher'); ?>",{emp_id:emp_id,class_teac:class_teac,class_id:class_id,sec_id:sec_id},function(data){
			  alert(data);
		  });
	  }
  }
</script>