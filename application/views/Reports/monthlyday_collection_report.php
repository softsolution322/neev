<?php
//echo '<pre>';
//print_r($feehead1);die;
if ($feehead1) {
	 $AccG1 = $feehead1[0]->AccG;
	 $feehead1 = $feehead1[0]->FEE_HEAD;
	 
}
if ($feehead2) {
	$AccG2 	=	$feehead2[0]->AccG;
	$feehead2 = $feehead2[0]->FEE_HEAD;
	
}
if ($feehead3) {
	$AccG3 	=	$feehead3[0]->AccG;
	$feehead3 = $feehead3[0]->FEE_HEAD;
	
}
if ($feehead4) {
	$AccG4 	=	$feehead4[0]->AccG;
	$feehead4 = $feehead4[0]->FEE_HEAD;
	
}
if ($feehead5) {
	$AccG5 	=	$feehead5[0]->AccG;
	$feehead5 = $feehead5[0]->FEE_HEAD;
	
}
if ($feehead6) {
	$AccG6 	=	$feehead6[0]->AccG;
	$feehead6 = $feehead6[0]->FEE_HEAD;
	
}
if ($feehead7) {
	$AccG7 	=	$feehead7[0]->AccG;
	$feehead7 = $feehead7[0]->FEE_HEAD;
	
}
if ($feehead8) {
	$AccG8 	=	$feehead8[0]->AccG;
	$feehead8 = $feehead8[0]->FEE_HEAD;
	
}
if ($feehead9) {
	$AccG9 	=	$feehead9[0]->AccG;
	$feehead9 = $feehead9[0]->FEE_HEAD;
	
}
if ($feehead10) {
	$AccG10 	=	$feehead10[0]->AccG;
	$feehead10 = $feehead10[0]->FEE_HEAD;
	
}
if ($feehead11) {
	$AccG11	 	=	$feehead11[0]->AccG;
	$feehead11 = $feehead11[0]->FEE_HEAD;
	
}
if ($feehead12) {
	$AccG12 	=	$feehead12[0]->AccG;
	$feehead12 = $feehead12[0]->FEE_HEAD;
	
}
if ($feehead13) {
	$AccG13 	=	$feehead13[0]->AccG;
	$feehead13 = $feehead13[0]->FEE_HEAD;
	
}
if ($feehead14) {
	$AccG14 	=	$feehead14[0]->AccG;
	$feehead14 = $feehead14[0]->FEE_HEAD;
	
}
if ($feehead15) {
	$AccG15 	=	$feehead15[0]->AccG;
	$feehead15 = $feehead15[0]->FEE_HEAD;
	
}
if ($feehead16) {
	$AccG16 	=	$feehead16[0]->AccG;
	$feehead16 = $feehead16[0]->FEE_HEAD;
	
}
if ($feehead17) {
	$AccG17 	=	$feehead17[0]->AccG;
	$feehead17 = $feehead17[0]->FEE_HEAD;
	
}
if ($feehead18) {
	$AccG18 	=	$feehead18[0]->AccG;
	$feehead18 = $feehead18[0]->FEE_HEAD;
	
}
if ($feehead19) {
	$AccG19 	=	$feehead19[0]->AccG;
	$feehead19 = $feehead19[0]->FEE_HEAD;
	
}
if ($feehead20) {
	$AccG20 	=	$feehead20[0]->AccG;
	$feehead20 = $feehead20[0]->FEE_HEAD;
	
}
if ($feehead21) {
	$AccG21 	=	$feehead21[0]->AccG;
	$feehead21 = $feehead21[0]->FEE_HEAD;
	
}
if ($feehead22) {
	$AccG22 	=	$feehead22[0]->AccG;
	$feehead22 = $feehead22[0]->FEE_HEAD;
	
}
if ($feehead23) {
	$AccG23 	=	$feehead23[0]->AccG;
	$feehead23 = $feehead23[0]->FEE_HEAD;
	
}
if ($feehead24) {
	$AccG24 	=	$feehead24[0]->AccG;
	$feehead24 = $feehead24[0]->FEE_HEAD;
	
}
if ($feehead25) {
	$AccG25 	=	$feehead25[0]->AccG;
	$feehead25 = $feehead25[0]->FEE_HEAD;
	
}
?>
<div class='row'>
	<div class='col-md-12 col-xl-12 col-sm-12'>
		<div style='overflow:auto;'>
			<table id='example'>
				<thead>
					<tr>
						<th style='color:white!important;'>S.NO</th>
						<th style='color:white!important;'>Receipt Number</th>
						<th style='color:white!important;'>Receipt Date</th>
						<th style='color:white!important;'>Student Name</th>
						<th style='color:white!important;'>Adm No</th>
						<th style='color:white!important;'>Class/Sec</th>
						<th style='color:white!important;'>Roll No</th>
						<th style='color:white!important; width:30%!important;'>Month Details</th>
						<th style='color:white!important;'>Total Amount</th>
						<?php if (($feehead1 != '' && $feehead1 != '-') && $AccG1 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead1; ?></th>
						<?php } ?>
						<?php if (($feehead2 != '' && $feehead2 != '-')  && $AccG2 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead2; ?></th>
						<?php } ?>
						<?php if (($feehead3 != '' && $feehead3 != '-')  && $AccG3 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead3; ?></th>
						<?php } ?>
						<?php if (($feehead4 != '' && $feehead4 != '-')  && $AccG4 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead4; ?></th>
						<?php } ?>
						<?php if (($feehead5 != '' && $feehead5 != '-')  && $AccG5 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead5; ?></th>
						<?php } ?>
						<?php if (($feehead6 != '' && $feehead6 != '-')   && $AccG6 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead6; ?></th>
						<?php } ?>
						<?php if (($feehead7 != '' && $feehead7 != '-')  && $AccG7 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead7; ?></th>
						<?php } ?>
						<?php if (($feehead8 != '' && $feehead8 != '-')  && $AccG8 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead8; ?></th>
						<?php } ?>
						<?php if (($feehead9 != '' && $feehead9 != '-')  && $AccG9 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead9; ?></th>
						<?php } ?>
						<?php if (($feehead10 != '' && $feehead10 != '-')  && $AccG10 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead10; ?></th>
						<?php } ?>
						<?php if (($feehead11 != '' && $feehead11 != '-')  && $AccG11 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead11; ?></th>
						<?php } ?>
						<?php if (($feehead12 != '' && $feehead12 != '-')  && $AccG12 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead12; ?></th>
						<?php } ?>
						<?php if (($feehead13 != '' && $feehead13 != '-')  && $AccG13 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead13; ?></th>
						<?php } ?>
						<?php if (($feehead14 != '' && $feehead14 != '-')  && $AccG14 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead14; ?></th>
						<?php } ?>
						<?php if (($feehead15 != '' && $feehead15 != '-')  && $AccG15 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead15; ?></th>
						<?php } ?>
						<?php if (($feehead16 != '' && $feehead16 != '-')  && $AccG16 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead16; ?></th>
						<?php } ?>
						<?php if (($feehead17 != '' && $feehead17 != '-')  && $AccG17 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead17; ?></th>
						<?php } ?>
						<?php if (($feehead18 != '' && $feehead18 != '-')  && $AccG18 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead18; ?></th>
						<?php } ?>
						<?php if (($feehead19 != '' && $feehead19 != '-')  && $AccG19 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead19; ?></th>
						<?php } ?>
						<?php if (($feehead20 != '' && $feehead20 != '-')  && $AccG20 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead20; ?></th>
						<?php } ?>
						<?php if (($feehead21 != '' && $feehead21 != '-')  && $AccG21 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead21; ?></th>
						<?php } ?>
						<?php if (($feehead22 != '' && $feehead22 != '-')  && $AccG22 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead22; ?></th>
						<?php } ?>
						<?php if (($feehead23 != '' && $feehead23 != '-')  && $AccG23 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead23; ?></th>
						<?php } ?>
						<?php if (($feehead24 != '' && $feehead24 != '-')  && $AccG24 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead24; ?></th>
						<?php } ?>
						<?php if (($feehead25 != '' && $feehead25 != '-')  && $AccG25 != 2) { ?>
							<th style='color:white!important;'><?php echo $feehead25; ?></th>
						<?php } ?>
						<th style='color:white!important;'>CHQ_DD_CARD_NUMBER</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($data1) {
						$i = 1;
						foreach ($data1 as $data_type) {
					?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $data_type->RECT_NO; ?></td>
								<td><?php echo date('d-M-Y', strtotime($data_type->RECT_DATE)); ?></td>
								<td><?php echo $data_type->STU_NAME; ?></td>
								<td><?php echo $data_type->ADM_NO; ?></td>
								<td><?php echo $data_type->CLASS . "/" . $data_type->SEC; ?></td>
								<td><?php echo $data_type->ROLL_NO; ?></td>
								<td style='width:50%;'><?php echo $data_type->PERIOD; ?></td>
								<td><?php echo $data_type->TOTAL; ?></td>
								<?php if (($feehead1 != '' && $feehead1 != '-') && $AccG1 != 2) { ?>
									<td><?php echo $data_type->Fee1; ?></td>
								<?php } ?>
								<?php if (($feehead2 != '' && $feehead2 != '-') && $AccG2 != 2) { ?>
									<td><?php echo $data_type->Fee2; ?></td>
								<?php } ?>
								<?php if (($feehead3 != '' && $feehead3 != '-') && $AccG3 != 2) { ?>
									<td><?php echo $data_type->Fee3; ?></td>
								<?php } ?>
								<?php if (($feehead4 != '' && $feehead4 != '-') && $AccG4 != 2) { ?>
									<td><?php echo $data_type->Fee4; ?></td>
								<?php } ?>
								<?php if (($feehead5 != '' && $feehead5 != '-') && $AccG5 != 2) { ?>
									<td><?php echo $data_type->Fee5; ?></td>
								<?php } ?>
								<?php if (($feehead6 != '' && $feehead6 != '-') && $AccG6 != 2) { ?>
									<td><?php echo $data_type->Fee6; ?></td>
								<?php } ?>
								<?php if (($feehead7 != '' && $feehead7 != '-') && $AccG7 != 2) { ?>
									<td><?php echo $data_type->Fee7; ?></td>
								<?php } ?>
								<?php if (($feehead8 != '' && $feehead8 != '-') && $AccG8 != 2) { ?>
									<td><?php echo $data_type->Fee8; ?></td>
								<?php } ?>
								<?php if (($feehead9 != '' && $feehead9 != '-') && $AccG9 != 2) { ?>
									<td><?php echo $data_type->Fee9; ?></td>
								<?php } ?>
								<?php if (($feehead10 != '' && $feehead10 != '-') && $AccG10 != 2) { ?>
									<td><?php echo $data_type->Fee10; ?></td>
								<?php } ?>
								<?php if (($feehead11 != '' && $feehead11 != '-') && $AccG11 != 2) { ?>
									<td><?php echo $data_type->Fee11; ?></td>
								<?php } ?>
								<?php if (($feehead12 != '' && $feehead12 != '-') && $AccG12 != 2) { ?>
									<td><?php echo $data_type->Fee12; ?></td>
								<?php } ?>
								<?php if (($feehead13 != '' && $feehead13 != '-') && $AccG13 != 2) { ?>
									<td><?php echo $data_type->Fee13; ?></td>
								<?php } ?>
								<?php if (($feehead14 != '' && $feehead14 != '-') && $AccG14 != 2) { ?>
									<td><?php echo $data_type->Fee14; ?></td>
								<?php } ?>
								<?php if (($feehead15 != '' && $feehead15 != '-') && $AccG15 != 2) { ?>
									<td><?php echo $data_type->Fee15; ?></td>
								<?php } ?>
								<?php if (($feehead16 != '' && $feehead16 != '-') && $AccG16 != 2) { ?>
									<td><?php echo $data_type->Fee16; ?></td>
								<?php } ?>
								<?php if (($feehead17 != '' && $feehead17 != '-') && $AccG17 != 2) { ?>
									<td><?php echo $data_type->Fee17; ?></td>
								<?php } ?>
								<?php if (($feehead18 != '' && $feehead18 != '-') && $AccG18 != 2) { ?>
									<td><?php echo $data_type->Fee18; ?></td>
								<?php } ?>
								<?php if (($feehead19 != '' && $feehead19 != '-') && $AccG19 != 2) { ?>
									<td><?php echo $data_type->Fee19; ?></td>
								<?php } ?>
								<?php if (($feehead20 != '' && $feehead20 != '-') && $AccG20 != 2) { ?>
									<td><?php echo $data_type->Fee20; ?></td>
								<?php } ?>
								<?php if (($feehead21 != '' && $feehead21 != '-') && $AccG21 != 2) { ?>
									<td><?php echo $data_type->Fee21; ?></td>
								<?php } ?>
								<?php if (($feehead22 != '' && $feehead22 != '-') && $AccG22 != 2) { ?>
									<td><?php echo $data_type->Fee22; ?></td>
								<?php } ?>
								<?php if (($feehead23 != '' && $feehead23 != '-') && $AccG23 != 2) { ?>
									<td><?php echo $data_type->Fee23; ?></td>
								<?php } ?>
								<?php if (($feehead24 != '' && $feehead24 != '-') && $AccG24 != 2) { ?>
									<td><?php echo $data_type->Fee24; ?></td>
								<?php } ?>
								<?php if (($feehead25 != '' && $feehead25 != '-') && $AccG25 != 2) { ?>
									<td><?php echo $data_type->Fee25; ?></td>
								<?php } ?>
								
								<td><?php echo $data_type->Payment_Mode; ?></td>
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
<script>
	$(document).ready(function() {
		$('#example').DataTable({
			dom: 'Bfrtip',
			buttons: [
				/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
				{
					extend: 'excelHtml5',
					title: 'Monthly Collection Reports',

				},
				/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
				/* {
                extend: 'pdfHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			]
		});
	});
</script>