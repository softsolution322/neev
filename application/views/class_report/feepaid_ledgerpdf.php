<style>
	#table2 {
		border-collapse: collapse;
	}
	#table3 {
		border-collapse: collapse;
	}
	#img{
		float:left;
		height:130px;
		width:130px;
		margin-left: 150px !important;
	}
	#tp-header{
		font-size:20px;
	}
	#mid-header{
		font-size:18px;
	}
	#last-header{
		font-size:16px;
	}
	.th{
		background-color: #5785c3 !important;
		color : #fff !important;
	}
	.tt{
		font-size:13px;
	}
	
</style>
<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="img">

			<h1 id = "tp-header" ><center><?php echo $school_setting[0]->School_Name; ?><center></h1><br /><br />
			<h2 id = "mid-header"><center><?php echo $school_setting[0]->School_Address; ?><center></h2><br />
			<h2 id = "last-header"><center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)<center></h2>
			
			<br /><br /><br /><br /><br /><br /><br /><br />
<center><span style="font-size:22px !important;">Fee Paid Details</span></center>
<hr>
<br />
<table width="100%" id="table3">
			<tr>
				<td>Admission No.</td>
				<td>: <?php echo $Adm_no; ?></td>
				<td>Student Name</td>
				<td>: <?php echo $student_name; ?></td>
				<td>Roll No.</td>
				<td>: <?php echo $ROLL_NO; ?></td>
			</tr>
			<tr>
				<td>Father Name</td>
				<td colspan='5'>: <?php echo $FATHER_NM; ?></td>
			</tr>
			<tr>
				<td>Class</td>
				<td>: <?php echo $class; ?></td>
				<td>Sec</td>
				<td>: <?php echo $sec; ?></td>
				<td>Ward</td>
				<td>: <?php echo $eward; ?></td>
			</tr>
			
</table><br />
<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th class="th">Reciept No.</th>
			<th class="th">Reciept Date</th>
			<th class="th">Particular</th>
			<th class="th">Total Amount</th>
		</tr>
		
	</thead>
	<tbody>
		<?php
			foreach($arr_mrg as $key=> $value){
				?>
					<tr>
						<td class="t"><?php echo $value->RECT_NO; ?></td>
						<td class="t"><?php echo date("d-M-Y",strtotime($value->RECT_DATE)); ?></td>
						<td class="t"><?php echo $value->PERIOD; ?></td>
						<td class="t"><?php echo $value->TOTAL."/-"; ?></td>
					</tr>
				<?php
				foreach($feehead as $key1=>$value1){
					$fh = $key1+1;
					$fee = "Fee".$fh;
					if($value->$fee > 0){
						?>
							<tr>
								<td class="tt"></td>
								<td class="tt"></td>
								<td class="tt"><?php echo $value1->FEE_HEAD.":-".$value->$fee."/-"; ?></td>
								<td class="tt"></td>
							</tr>
						<?php
					}
				}
			}
		?>
	</tbody>
</table>