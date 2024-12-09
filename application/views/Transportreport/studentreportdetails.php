<div class="col-sm-12">
	<div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
	  <div class="panel-heading"><i class="fa fa-edit"></i> Bus Route Details</div>
	  <div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white; overflow-x: auto;height: auto;" >
		   <table class='table table-bordered table-striped dataTable' id='example'>
				<thead>
				  <tr>
					<th class="thead-color text-center">Sl No</th>
					<th class="thead-color text-center">Admission No</th>
					<th class="thead-color text-center">Student Name</th>
					<th class="thead-color text-center">Class/Sec</th>
					<th class="thead-color text-center">Stoppage</th>
				  </tr>
				</thead>
				<tbody>
					<?php 
						if($busroute){
							$i=1;
							foreach($busroute as $key=>$value){
								?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td class="text-center"><?php echo $value->ADM_NO; ?></td>
										<td class="text-center"><?php echo $value->FIRST_NM; ?></td>
										<td class="text-center"><?php echo $value->DISP_CLASS."/".$value->DISP_SEC; ?></td>
										<td class="text-center"><?php echo $value->STOPPAGE; ?></td>
									</tr>
								<?php
								$i++;
							}
						}
					?>
					
				</tbody>
		   </table>
	  </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
$("#msg").fadeOut(8000);
$('#example').DataTable({
	dom: 'Bfrtip',
	buttons: [
		{
			extend: 'excelHtml5',
			title: 'Student Route Allocation Report',
		},
		{
			extend: 'csvHtml5',
			title: 'Student Route Allocation Report',
		},
	]
});
});

</script>