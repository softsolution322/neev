 <br />
 <table class="table table-bordered" id="example">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Admission No</th>
			<th>Roll</th>
			<th>Student Name</th>
			<th>Date of Birth</th>
			<th>Father Name</th>
			<th>Mother Name</th>
			<th>Admission Date</th>
			<th>Admission Class</th>
			<th>Stoppage</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if($student){
			$i = 1;
			foreach($student as $data_key){
				?>
					<tr>
						<td><?php echo $i; ?></a></td>
						<td><?php echo $data_key->ADM_NO; ?></td>
						<td><?php echo $data_key->ROLL_NO; ?></td>
						<td><?php echo $data_key->FIRST_NM; ?></td>
						<td><?php echo date('d-M-Y',strtotime($data_key->BIRTH_DT)); ?></td>
						<td><?php echo $data_key->FATHER_NM; ?></td>
						<td><?php echo $data_key->MOTHER_NM; ?></td>
						<td><?php echo date('d-M-Y',strtotime($data_key->ADM_DATE)); ?></td>
						<td><?php echo $data_key->ADM_CLASS_id; ?></td>
						<td><?php echo $data_key->other_stop; ?></td>
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
			title: 'Student Registar Details',
		},
		{
			extend: 'csvHtml5',
			title: 'Student Registar Details',
		},
		{
			extend: 'pdfHtml5',
			title: 'Student Registar Details',
			orientation: 'landscape',
		},
	]
});
});

</script>