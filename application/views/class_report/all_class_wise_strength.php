<form method="post" action="<?php echo base_url('Student_strength/all_class_wise_pdf'); ?>">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
			<center>
				<input type="hidden" name="religion" value="<?php echo $religion; ?>">
				<input type="hidden" name="ward" value="<?php echo $ward; ?>">
				<input type="hidden" name="category" value="<?php echo $category; ?>">
				<button class="btn"><i class="fa fa-file-pdf-o"></i> PRINT</button>
			</center>
		</div>
	</div>
</form>
<style>
	#cap{
		color:black;
		font-weight:bold;
	}
	tr,td{
		font-size:13px;
	}
	body{
		font-family: Verdana,Geneva,sans-serif;
	}
</style>
<table class="table" id="example" border="1">
	<caption id="cap"><center>Class-Section Wise Student Strength Report</center></caption>
	<thead>
		<tr>
			<th rowspan='2'>Class/sec</th>
			<th>Total</th>
			<th colspan='2'><center>Gender</center></th>
			<th colspan='6'><center>Category</center></th>
			<th colspan='6'><center>Ward</center></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td></td>
			<td>Boys</td>
			<td>Girls</td>
			<td><?php echo $cat[0]->CAT_ABBR; ?></td>
			<td><?php echo $cat[1]->CAT_ABBR; ?></td>
			<td><?php echo $cat[2]->CAT_ABBR; ?></td>
			<td><?php echo $cat[3]->CAT_ABBR; ?></td>
			<td><?php echo $cat[4]->CAT_ABBR; ?></td>
			<td><?php echo $cat[5]->CAT_ABBR; ?></td>
			<td><?php echo $wardd[0]->HOUSENAME; ?></td>
			<td><?php echo $wardd[1]->HOUSENAME; ?></td>
			<td><?php echo $wardd[2]->HOUSENAME; ?></td>
			<td><?php echo $wardd[3]->HOUSENAME; ?></td>
			<td><?php echo $wardd[4]->HOUSENAME; ?></td>
			<td><?php echo $wardd[5]->HOUSENAME; ?></td>
		</tr>
			<?php
				$total = 0;
				$male = 0;
				$female = 0;
				$cat1 = 0;
				$cat2 = 0;
				$cat3 = 0;
				$cat4 = 0;
				$cat5 = 0;
				$cat6 = 0;
				$ward1 = 0;
				$ward2 = 0;
				$ward3 = 0;
				$ward4 = 0;
				$ward5 = 0;
				$ward6 = 0;
				foreach($all_data as $key => $value){
					if($value->DISP_CLASS == null){
						
					}else{
						?>
						<tr>
						<td><?php echo $value->DISP_CLASS."/".$value->DISP_SEC; ?></td>
						<td><?php echo $value->TOTALSTUDENT; ?></td>
						<td><?php echo $value->MALE; ?></td>
						<td><?php echo $value->FEMALE; ?></td>
						<td><?php echo $value->CAT1; ?></td>
						<td><?php echo $value->CAT2; ?></td>
						<td><?php echo $value->CAT3; ?></td>
						<td><?php echo $value->CAT4; ?></td>
						<td><?php echo $value->CAT5; ?></td>
						<td><?php echo $value->CAT6; ?></td>
						<td><?php echo $value->WARD1; ?></td>
						<td><?php echo $value->WARD2; ?></td>
						<td><?php echo $value->WARD3; ?></td>
						<td><?php echo $value->WARD4; ?></td>
						<td><?php echo $value->WARD5; ?></td>
						<td><?php echo $value->WARD6; ?></td>
						</tr>
						<?php
						$total +=$value->TOTALSTUDENT;
						$male += $value->MALE;
						$female += $value->FEMALE;
						$cat1 += $value->CAT1;
						$cat2 += $value->CAT2;
						$cat3 += $value->CAT3;
						$cat4 += $value->CAT4;
						$cat5 += $value->CAT5;
						$cat6 += $value->CAT6;
						$ward1 += $value->WARD1;
						$ward2 += $value->WARD2;
						$ward3 += $value->WARD3;
						$ward4 += $value->WARD4;
						$ward5 += $value->WARD5;
						$ward6 += $value->WARD6;
					}
					?>
					
					<?php
				}
			?>
			<tr>
				<td>Total Strength</td>
				<td><?php echo $total; ?></td>
				<td><?php echo $male; ?></td>
				<td><?php echo $female; ?></td>
				<td><?php echo $cat1; ?></td>
				<td><?php echo $cat2; ?></td>
				<td><?php echo $cat3; ?></td>
				<td><?php echo $cat4; ?></td>
				<td><?php echo $cat5; ?></td>
				<td><?php echo $cat6; ?></td>
				<td><?php echo $ward1; ?></td>
				<td><?php echo $ward2; ?></td>
				<td><?php echo $ward3; ?></td>
				<td><?php echo $ward4; ?></td>
				<td><?php echo $ward5; ?></td>
				<td><?php echo $ward6; ?></td>
			</tr>
	</tbody>
</table>