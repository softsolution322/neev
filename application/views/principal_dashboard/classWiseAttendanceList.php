<br>
	<div style="padding: 10px; background-color: white; border-top:3px solid #337ab7;">
		<div class="row">
		<div class='col-sm-12'>
			<table class='table table-bordered table-striped'>
				<caption style="text-align: center;background: #337ab7;color: white;">Student Absentee Details</caption>
				<thead>
				   <tr>
				     <th style="background: #bac9e2;" class="text-center">Class - Section</th>
				     <th style="background: #bac9e2;" class="text-center">Total Student</th> 
				     <th style="background: #bac9e2;" class="text-center">Total</th> 
				     <th style="background: #bac9e2;" class="text-center">Boys</th>
				     <th style="background: #bac9e2;" class="text-center">Girls</th>
				   </tr>
				</thead>
				<tbody>
					<?php foreach ($final_stu_att_data as $key => $value) { ?>
						<tr>
							<td class="text-center"><a href="<?php echo base_url('payroll/dashboard/principal_dashboard/totalStuAttendanceData/'.$value['CLASS'].'/'.$value['SEC'].'/'.$value['att_type'].'/'.$value['class_name'].'/'.$value['sec_name']); ?>"><?php echo $value['class_name'].' - '.$value['sec_name'];  ?></a></td>
							<td class="text-center"><?php echo $value['total_stu'];  ?></td>
							<td class="text-center"><?php echo $value['total_attendance'];  ?></td>
							<td class="text-center"><?php echo $value['total_male_attendance']; ?></td>
							<td class="text-center"><?php echo $value['total_female_attendance']; ?></td>
						</tr>
					<?php } ?>
				</tbody>
			 </table>
		</div>
</div>
    </div>
          <br>