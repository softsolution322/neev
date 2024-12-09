<br>
<style type="text/css">
	.thead-color{
		background: #bac9e2 !important;
	}
</style>
	<div style="padding: 10px; background-color: white; border-top:3px solid #337ab7;">
		<div class="row"> 
          	<div class="col-sm-12">
          		<table class='table table-bordered table-striped'>
          			<caption style="text-align: center;background: #337ab7;color: white;">Employee Present Details</caption>
					<thead>
					   <tr>
					     <th class="text-center thead-color">Wing Type</th>
					     <th class="text-center thead-color">Total Employee</th> 
					     <th class="text-center thead-color">Male</th>
					     <th class="text-center thead-color">Female</th>
					     <th class="text-center thead-color">Teaching</th>
					     <th class="text-center thead-color">Non-Teaching</th>
					   </tr>
					</thead>
					<tbody>
						<?php foreach ($todayPresentEmp as $key => $value) { ?>
							<tr>
								<td><?php echo $value['NAME'];  ?></td>
								<td class="text-center"><?php echo $value['total_emp'];  ?></td>
								<td class="text-center"><?php echo $value['total_male_pre']; ?></td>
								<td class="text-center"><?php echo $value['total_female_pre']; ?></td>
								<td class="text-center"><?php echo $value['total_teaching_pre']; ?></td>
								<td class="text-center"><?php echo $value['total_nonteaching_pre']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
          	</div>
        </div>
    </div>
          <br>