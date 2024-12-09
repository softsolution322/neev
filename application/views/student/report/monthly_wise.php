<style type="text/css">
 
</style>
<?php
$month = date('m');
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('punching/manualpunch'); ?>">Student</a> <i class="fa fa-angle-right"></i> Monthly Wise </li>
</ol>
<!-- Content Wrapper. Contains page content -->
<div style="padding: 15px; background-color: white;border-top: 3px solid #5785c3;">
	<div class='row'>
	  <div class='col-sm-3'>
	     <table class='table'>
		    <!--<tr>
			  <td colspan='2'>
			   <input type='radio' name='class' value='1' checked onclick='cls(1)'> <b>Class/Sec</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			   <input type='radio' name='class' value='2' onclick='cls(2)'> <b>Class</b>
			  </td>
		    </tr>-->
			<tr>
			  <th>Month</th>
			  <td>
			    <select name='month' id='month' class='form-control'>
				  <option value=''>Select</option>
				  <?php
				    if(isset($month_data)){
						foreach($month_data as $data){
							?>
							  <option value='<?php echo $data->month_code; ?>' <?php if($month == $data->month_code){ echo "selected"; }?>><?php echo $data->month_name; ?></option>
							<?php
						}
					}
				  ?>
			    </select>
			  </td>
			</tr>

			<!--<tr>
			  <th>Attendance Type</th>
			  <td>
			    <select name='att_type' id='att_type' class='form-control' onchange='att_typee(this.value)'>
				  <option value=''>Select</option>
				  <option value='1'>Day Wise</option>
				  <option value='2'>Period Wise</option>
			    </select>
			  </td>
			</tr>-->
			
			<tr>
			  <th>Class</th>
			  <td>
			    <select name='classs' id='classs' class='form-control' onchange='classes(this.value)'>
				  <option value=''>Select</option>
				  <?php
				    if(isset($class_data)){
						foreach($class_data as $data){
				  ?>
				  <option value='<?php echo $data->class_code; ?>'><?php echo $data->class_nm; ?></option>
				  <?php	
						}
					}
				  ?>
			    </select>
			  </td>
			</tr>
			
			<tr id="sec_id">
			  <th>Section</th>
			  <td>
			    <select name='sec' id='sec' class='form-control' onchange='section(this.value)'>
				  <option value=''>Select</option>
			    </select>
			  </td>
			</tr>
			
			<!--<tr>
			  <th>Report Type</th>
			  <td>
			    <select name='report_type' id='report_type' class='form-control' onchange="rpt_typ(this.value)" disabled>
				  <option value=''>Select</option>
				  <option value='P'>Present</option>
				  <option value='A'>Absent</option>
				  <option value='HD'>Half Day</option>
				  <option value='all'>All</option>
			    </select>
			  </td>
			</tr>-->
		 </table>
	  </div>
	  <div class='col-sm-9'>
	    <div id='month_report_data' class='table-responsive'></div>
	  </div>
	</div><br /><br />
	<a class="btn btn-danger " id="" href="<?php echo base_url('Student_report/stu_atten'); ?>">BACK</a>
</div>
<br /><br /><br /><br /><br /><br /><br /><br /><br />



<!-- /.modal -->
<div class="loader"></div>
<script type="text/javascript">
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose:true });
	
	// $(function () {
		// $('.dataTable').DataTable({
		  // 'paging'      : true,
		  // 'lengthChange': false,
		  // 'searching'   : true,
		  // 'ordering'    : false,
		  // 'info'        : true,
		  // 'autoWidth'   : true,
		  // aaSorting: [[0, 'asc']]
		// })
	  // });
  
  function cls(val){
	 if(val == 2){
		 $("#sec_id").hide();
		 $("#sec_id").prop('disabled',true);
	 }else{
		 $("#sec_id").show();
		 $("#sec_id").prop('disabled',false);
	 } 
  }
  
  function classes(val){
  $.post("<?php echo base_url('student/report/Report/monthly_classes'); ?>",{val:val},function(data){
	  var fill = $.parseJSON(data);
	   $("#sec").html(fill[0]);
	  });
  }
  
  function section(val){
	  $('body').css('opacity','0.5'); 
	  var month  = $("#month").val(); 
	  var classs = $("#classs").val(); 
	  var sec    = $("#sec").val(); 
	  $.ajax({
		  url: "<?php echo base_url('student/report/Report/month_wise_report'); ?>",
		  type: "POST",
		  data: {month:month,classs:classs,sec:sec},
		  success: function(data){
             $("#month_report_data").html(data);
			 $('body').css('opacity','100'); 
		  }
	  })
  }
</script>