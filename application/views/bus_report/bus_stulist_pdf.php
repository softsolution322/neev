<style>
	#table2 {
		border-collapse: collapse;
	}
	#table3 {
		border-collapse: collapse;
	}
	#img{
		float:left;
		height:120px;
		width:120px;
		margin-left: 150px !important;
	}
	#tp-header{
		font-size:30px;
	}
	#mid-header{
		font-size:26px;
	}
	#last-header{
		font-size:22px;
	}
	.th{
		background-color: #5785c3 !important;
		color : #fff !important;
		font-size:18px;
	}
	.tt{
		font-size:15px;
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
<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="img">
<table width="100%" style="float:right;">
	<tr>
		<td id="tp-header"><center><?php echo $school_setting[0]->School_Name; ?><center></td>
	</tr>
	<tr>
		<td id="mid-header"><center><?php echo $school_setting[0]->School_Address; ?><center></td>
	</tr>
	<tr>
		<td id="last-header"><center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)<center></td>
	</tr>
	<tr>
		<td><center><span style="font-size:22px !important;">List of Students with Bus Facility for : <?php echo $data[0]->DISP_CLASS; ?>-<?php echo $data[0]->DISP_SEC; ?></span></center></td>
		
	</tr>
	
</table><br /><br /><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th class="th">Sl No.</th>
		    <th class="th">Admission No.</th>
			<th class="th">Student Name</th>
			<th class="th">Roll No.</th>
	        <th class="th">Contact No.</th>
			<th class="th">Stoppage Name</th>
			<th class="th">Amount</th>
		</tr>
		
	</thead>
	<tbody>
		<?php
			$i=1;
			foreach($data as $key=>$value){
				?>
				<tr>
					<td class="tt"><?php echo $i; ?></td>
				    <td class="tt"><?php echo $value->ADM_NO; ?></td>
					<td class="tt"><?php echo $value->FIRST_NM; ?></td>
					<td class="tt"><?php echo $value->ROLL_NO; ?></td>
					<td class="tt"><?php echo $value->C_MOBILE; ?></td>
					<td class="tt"><?php echo $value->stopname; ?></td>
					<td class="tt"><?php echo $value->stp_amt; ?></td>
				</tr>
				<?php
				$i++;
			}
		?>
	</tbody>
</table>