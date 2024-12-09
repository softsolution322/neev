<div class="col-sm-12">
	<div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
	  <div class="panel-heading"><i class="fa fa-edit"></i> Bus Route Details</div>
	  <div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white; overflow-x: auto;height: auto;" >
		   <table class='table table-bordered table-striped dataTable' id='example'>
				<thead>
				  <tr>
					<th class="thead-color text-center">Sl No</th>
					<th class="thead-color text-center">Stoppage</th>
					<th class="thead-color text-center">Vehicle No.</th>
					<th class="thead-color text-center">Trip No</th>
					<th class="thead-color text-center">Prefrence</th>
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
										<td class="text-center"><?php echo $value->STOPPAGE; ?></td>
										<td class="text-center"><?php echo $value->BusNo; ?></td>
										<td class="text-center"><?php echo $value->Trip_Nm; ?></td>
										<td class="text-center"><?php if($value->Prefer_ID == '1'){echo "Boys";}elseif($value->Prefer_ID == '2'){echo "Girls";}elseif($value->Prefer_ID == '3'){echo "Co.Ed";} ?></td>
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
			title: 'Bus Route Report',
		},
		{
			extend: 'csvHtml5',
			title: 'Bus Route Report',
		},
	]
});
});

</script>