<div>
 <table class="table" id="example">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Driver Name</th>
			<th>Driver Address</th>
			<th>Bus No</th>
			<th>Trip Name</th>
			<th>Driver D.O.B</th>
			<th>Driver Phone</th>
			<th>Driver License No</th>
			<th>Khallasi Name</th>
			<th>Khallasi Phone No</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if($driver_list_data){
			$i = 1;
			foreach($driver_list_data as $data_key){
				?>
					<tr>
						<td><?php echo $i; ?></a></td>
						<td><?php echo $data_key->driver_name; ?></td>
						<td><?php echo $data_key->driver_address; ?></td>
						<td><?php echo $data_key->BusNo; ?></td>
						<td><?php echo $data_key->Trip_Nm; ?></td>
						<td><?php echo date('d-M-Y',strtotime($data_key->driver_dob)); ?></td>
						<td><?php echo $data_key->driver_ph_no; ?></td>
						<td><?php echo $data_key->driver_license_no; ?></td>
						<td><?php echo $data_key->khallasi_nm; ?></td>
						<td><?php echo $data_key->khallasi_ph_no; ?></td>
					</tr>
				<?php
				$i++;
			}
		}
	?>
	</tbody>
 </table>
</div>
<div class="inner-block"></div>
<script type="text/javascript">
$(document).ready(function() {
$("#msg").fadeOut(8000);
$('#example').DataTable({
	dom: 'Bfrtip',
	buttons: [
		{
			extend: 'excelHtml5',
			title: 'Driver List Bus No Wise And Without Bus',
		},
		{
			extend: 'csvHtml5',
			title: 'Driver List Bus No Wise And Without Bus',
		},
	]
});
});

</script>