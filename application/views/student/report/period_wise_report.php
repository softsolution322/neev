<style>
  button.dt-button, div.dt-button, a.dt-button {
	  padding:2px;
  }
  .dataTables_paginate .paginate_button.current {
	 padding:2px;  
  }
  .table > thead > tr > th,
  .table > tbody > tr > th,
  .table > tfoot > tr > th,
  .table > thead > tr > td,
  .table > tbody > tr > td,
  .table > tfoot > tr > td {
    white-space: nowrap !important;
  }
</style>
<table class='table' id='example'>
<thead>
  <tr>
	<th style="background:#5785c3; color:#fff">Adm No.</th>
	<th style="background:#5785c3; color:#fff">Stu Name</th>
	<th style="background:#5785c3; color:#fff">Roll</th>
	<th style="background:#5785c3; color:#fff">Class</th>
	<th style="background:#5785c3; color:#fff">Sec</th>
	<th style="background:#5785c3; color:#fff">P1</th>
	<th style="background:#5785c3; color:#fff">P2</th>
	<th style="background:#5785c3; color:#fff">P3</th>
	<th style="background:#5785c3; color:#fff">P4</th>
	<th style="background:#5785c3; color:#fff">P5</th>
	<th style="background:#5785c3; color:#fff">P6</th>
	<th style="background:#5785c3; color:#fff">P7</th>
	<th style="background:#5785c3; color:#fff">P8</th>
	<th style="background:#5785c3; color:#fff">Mobile</th>
  </tr>
</thead>  
<tbody>
   <?php
     if(isset($fetch_data)){
		 foreach($fetch_data as $data){
			 ?>
			   <tr>
			     <td><?php echo $data->admno; ?></td>
			     <td><?php echo $data->stunm; ?></td>
			     <td><?php echo $data->roll; ?></td>
			     <td><?php echo $data->classnm; ?></td>
			     <td><?php echo $data->secnm; ?></td>
			     
				    <?php
					 if($data->P1 == 'P'){
					?>
				    <td style='color:green'><b><?php echo $data->P1; ?></b></td>
					<?php
					 }else{
					 ?>
					 <td style='color:red'><b><?php echo $data->P1; ?></b></td>
                     <?php					 
					 }
					?>
					
					<?php
					 if($data->P2 == 'P'){
					?>
				    <td style='color:green'><b><?php echo $data->P2; ?></b></td>
					<?php
					 }else{
					 ?>
					 <td style='color:red'><b><?php echo $data->P2; ?></b></td>
                     <?php					 
					 }
					?>
					
					<?php
					 if($data->P3 == 'P'){
					?>
				    <td style='color:green'><b><?php echo $data->P3; ?></b></td>
					<?php
					 }else{
					 ?>
					 <td style='color:red'><b><?php echo $data->P3; ?></b></td>
                     <?php					 
					 }
					?>
					
					<?php
					 if($data->P4 == 'P'){
					?>
				    <td style='color:green'><b><?php echo $data->P4; ?></b></td>
					<?php
					 }else{
					 ?>
					 <td style='color:red'><b><?php echo $data->P4; ?></b></td>
                     <?php					 
					 }
					?>
					
					<?php
					 if($data->P5 == 'P'){
					?>
				    <td style='color:green'><b><?php echo $data->P5; ?></b></td>
					<?php
					 }else{
					 ?>
					 <td style='color:red'><b><?php echo $data->P5; ?></b></td>
                     <?php					 
					 }
					?>
					
					<?php
					 if($data->P6 == 'P'){
					?>
				    <td style='color:green'><b><?php echo $data->P6; ?></b></td>
					<?php
					 }else{
					 ?>
					 <td style='color:red'><b><?php echo $data->P6; ?></b></td>
                     <?php					 
					 }
					?>
					
					<?php
					 if($data->P7 == 'P'){
					?>
				    <td style='color:green'><b><?php echo $data->P7; ?></b></td>
					<?php
					 }else{
					 ?>
					 <td style='color:red'><b><?php echo $data->P7; ?></b></td>
                     <?php					 
					 }
					?>
					
					<?php
					 if($data->P8 == 'P'){
					?>
				    <td style='color:green'><b><?php echo $data->P8; ?></b></td>
					<?php
					 }else{
					 ?>
					 <td style='color:red'><b><?php echo $data->P8; ?></b></td>
                     <?php					 
					 }
					?>
				 
			    
			     <td><b><?php echo $data->cmob; ?></b></td>
			   </tr>
			 <?php
		 }
	 }
   ?>
</tbody>  
</table>

<script>
   $('[data-toggle="tooltip"]').tooltip();   
   $('#example').DataTable({
		dom: 'Bfrtip',
		buttons: [
			// {
				// extend: 'copyHtml5',
				// title: 'Student Details',
				// exportOptions: {
					// columns: [ 0, 1, 2, 3, 4, 5 , 6, 7]
				// }
			// },
			{
				extend: 'excelHtml5',
				title: 'Student Details',
			},
			// {
				// extend: 'csvHtml5',
				// title: 'Student Details',
				// exportOptions: {
					// columns: [ 0, 1, 2, 3, 4, 5 , 6, 7]
				// }
			// },
			{
				extend: 'pdfHtml5',
				title: 'Student Details',
			},
		]
	});
</script>