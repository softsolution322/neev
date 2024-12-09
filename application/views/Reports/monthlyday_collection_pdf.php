<?php
error_reporting(0);
if ($feehead1) {
	$feehead1 = $feehead1[0]->SHNAME;
}
if ($feehead2) {
	$feehead2 = $feehead2[0]->SHNAME;
}
if ($feehead3) {
	$feehead3 = $feehead3[0]->SHNAME;
}
if ($feehead4) {
	$feehead4 = $feehead4[0]->SHNAME;
}
if ($feehead5) {
	$feehead5 = $feehead5[0]->SHNAME;
}
if ($feehead6) {
	$feehead6 = $feehead6[0]->SHNAME;
}
if ($feehead7) {
	$feehead7 = $feehead7[0]->SHNAME;
}
if ($feehead8) {
	$feehead8 = $feehead8[0]->SHNAME;
}
if ($feehead9) {
	$feehead9 = $feehead9[0]->SHNAME;
}
if ($feehead10) {
	$feehead10 = $feehead10[0]->SHNAME;
}
if ($feehead11) {
	$feehead11 = $feehead11[0]->SHNAME;
}
if ($feehead12) {
	$feehead12 = $feehead12[0]->SHNAME;
}
if ($feehead13) {
	$feehead13 = $feehead13[0]->SHNAME;
}
if ($feehead14) {
	$feehead14 = $feehead14[0]->SHNAME;
}
if ($feehead15) {
	$feehead15 = $feehead15[0]->SHNAME;
}
if ($feehead16) {
	$feehead16 = $feehead16[0]->SHNAME;
}
if ($feehead17) {
	$feehead17 = $feehead17[0]->SHNAME;
}
if ($feehead18) {
	$feehead18 = $feehead18[0]->SHNAME;
}
if ($feehead19) {
	$feehead19 = $feehead19[0]->SHNAME;
}
if ($feehead20) {
	$feehead20 = $feehead20[0]->SHNAME;
}
if ($feehead21) {
	$feehead21 = $feehead21[0]->SHNAME;
}
if ($feehead22) {
	$feehead22 = $feehead22[0]->SHNAME;
}
if ($feehead23) {
	$feehead23 = $feehead23[0]->SHNAME;
}
if ($feehead24) {
	$feehead24 = $feehead24[0]->SHNAME;
}
if ($feehead25) {
	$feehead25 = $feehead25[0]->SHNAME;
}
if ($School_setting) {
	$School_Name = $School_setting[0]->School_Name;
	$School_Address = $School_setting[0]->School_Address;
	$School_Session = $School_setting[0]->School_Session;
}
if ($account) {
	foreach ($account as $account_data) {
		if ($account_data->CAT_CODE == 1) {
			$account1 = $account_data->CAT_ABBR;
		} else {
		}
		if ($account_data->CAT_CODE == 2) {
			$account2 = $account_data->CAT_ABBR;
		} else {
		}
		if ($account_data->CAT_CODE == 3) {
			$account3 = $account_data->CAT_ABBR;
		} else {
		}
		if ($account_data->CAT_CODE == 4) {
			$account4 = $account_data->CAT_ABBR;
		} else {
		}
		if ($account_data->CAT_CODE == 5) {
			$account5 = $account_data->CAT_ABBR;
		}
	}
}
if ($feecollectiontype == 'All') {
	$fee = 'All Type of Collections';
} elseif ($feecollectiontype == 'PRE') {
	$fee = 'Previous Year Collections';
} elseif ($feecollectiontype == 'Monthly') {
	$fee = 'Monthly Collections';
} elseif ($feecollectiontype == 'MISL') {
	$fee = 'Miscellaneous Collections';
} elseif ($feecollectiontype == 'NONE') {
	$fee = 'Collection Without Admission';
} else {
	$fee = '';
}
if ($collectioncounter == '%') {
	$counter = 'All Users';
} else {
	$counter = $collectioncounter;
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Monthly Collection Report</title>
	<style>
		table {
			border-collapse: collapse;
		}

		* {
			font-size: 12px;
			font-weight: bold;
		}

		table tr th,
		td {
			font-size: 11px !important;
			padding: 3px !important;

		}

		@page {
			margin: 5px 5px 5px 20px;
		}
	</style>
</head>

<body>
	<div>
		<span style='float:right; font-size:15px;'>Report Generation Date:<?php echo date('d-M-Y'); ?></span>
		<center>
			<h1 style='font-size:30px;'><?php echo $School_Name; ?></h1><br><br>
			<p style='font-size:22px; position:relative; top:-15px;'><?php echo $School_Address; ?></p><br><br><br>
			<p style='font-size:22px; position:relative; top:-25px;'>Session (<?php echo $School_Session; ?>)</p><br><br><br><br>
		</center>
	</div><br><br><br><br><br><br><br><br>
	<table width='100%' style='margin-bottom:5px;border-bottom:1px solid black'>
		<tr>
			<th style='font-size:18px!important;'>Fee Collection Type:- <?php echo $fee; ?></th>
			<th width='50%' style='font-size:18px!important;'>
				<center>Monthly Collection Report from <?php echo date('d-M-Y', strtotime($date_type)) . ' to ' . date('d-M-Y', strtotime($date_type_from)); ?></center><br>
			</th>
			<th style='font-size:18px!important;'>Collected By:- <?php echo $counter; ?></th>
		</tr>
	</table>


	<table border='1'>
		<thead>
			<tr>
				<th>S.NO</th>
				<th>Receipt Number</th>
				<th>Receipt Date</th>
				<th>Student Name</th>
				<th>Adm No</th>
				<th>Class/Sec</th>
				<th>Roll No</th>
				<th>Month Details</th>
				<th>Total Amount</th>
				<?php if ($feehead1 != '' && $feehead1 != '-') { ?>
					<th><?php echo $feehead1; ?></th>
				<?php } ?>
				<?php if ($feehead2 != '' && $feehead2 != '-') { ?>
					<th><?php echo $feehead2; ?></th>
				<?php } ?>
				<?php if ($feehead3 != '' && $feehead3 != '-') { ?>
					<th><?php echo $feehead3; ?></th>
				<?php } ?>
				<?php if ($feehead4 != '' && $feehead4 != '-') { ?>
					<th><?php echo $feehead4; ?></th>
				<?php } ?>
				<?php if ($feehead5 != '' && $feehead5 != '-') { ?>
					<th><?php echo $feehead5; ?></th>
				<?php } ?>
				<?php if ($feehead6 != '' && $feehead6 != '-') { ?>
					<th><?php echo $feehead6; ?></th>
				<?php } ?>
				<?php if ($feehead7 != '' && $feehead7 != '-') { ?>
					<th><?php echo $feehead7; ?></th>
				<?php } ?>
				<?php if ($feehead8 != '' && $feehead8 != '-') { ?>
					<th><?php echo $feehead8; ?></th>
				<?php } ?>
				<?php if ($feehead9 != '' && $feehead9 != '-') { ?>
					<th><?php echo $feehead9; ?></th>
				<?php } ?>
				<?php if ($feehead10 != '' && $feehead10 != '-') { ?>
					<th><?php echo $feehead10; ?></th>
				<?php } ?>
				<?php if ($feehead11 != '' && $feehead11 != '-') { ?>
					<th><?php echo $feehead11; ?></th>
				<?php } ?>
				<?php if ($feehead12 != '' && $feehead12 != '-') { ?>
					<th><?php echo $feehead12; ?></th>
				<?php } ?>
				<?php if ($feehead13 != '' && $feehead13 != '-') { ?>
					<th><?php echo $feehead13; ?></th>
				<?php } ?>
				<?php if ($feehead14 != '' && $feehead14 != '-') { ?>
					<th><?php echo $feehead14; ?></th>
				<?php } ?>
				<?php if ($feehead15 != '' && $feehead15 != '-') { ?>
					<th><?php echo $feehead15; ?></th>
				<?php } ?>
				<?php if ($feehead16 != '' && $feehead16 != '-') { ?>
					<th><?php echo $feehead16; ?></th>
				<?php } ?>
				<?php if ($feehead17 != '' && $feehead17 != '-') { ?>
					<th><?php echo $feehead17; ?></th>
				<?php } ?>
				<?php if ($feehead18 != '' && $feehead18 != '-') { ?>
					<th><?php echo $feehead18; ?></th>
				<?php } ?>
				<?php if ($feehead19 != '' && $feehead19 != '-') { ?>
					<th><?php echo $feehead19; ?></th>
				<?php } ?>
				<?php if ($feehead20 != '' && $feehead20 != '-') { ?>
					<th><?php echo $feehead20; ?></th>
				<?php } ?>
				<?php if ($feehead21 != '' && $feehead21 != '-') { ?>
					<th><?php echo $feehead21; ?></th>
				<?php } ?>
				<?php if ($feehead22 != '' && $feehead22 != '-') { ?>
					<th><?php echo $feehead22; ?></th>
				<?php } ?>
				<?php if ($feehead23 != '' && $feehead23 != '-') { ?>
					<th><?php echo $feehead23; ?></th>
				<?php } ?>
				<?php if ($feehead24 != '' && $feehead24 != '-') { ?>
					<th><?php echo $feehead24; ?></th>
				<?php } ?>
				<?php if ($feehead25 != '' && $feehead25 != '-') { ?>
					<th><?php echo $feehead25; ?></th>
				<?php } ?>
				<th>Payment Mode</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ($data1) {
				$t = 0;
				$f1 = 0;
				$f2 = 0;
				$f3 = 0;
				$f4 = 0;
				$f5 = 0;
				$f6 = 0;
				$f7 = 0;
				$f8 = 0;
				$f9 = 0;
				$f10 = 0;
				$f11 = 0;
				$f12 = 0;
				$f13 = 0;
				$f14 = 0;
				$f15 = 0;
				$f16 = 0;
				$f17 = 0;
				$f18 = 0;
				$f19 = 0;
				$f20 = 0;
				$f21 = 0;
				$f22 = 0;
				$f23 = 0;
				$f24 = 0;
				$f25 = 0;
				

				$i = 1;
				$card = 0;
				$cash = 0;
				$cheque = 0;
				$cancel = 0;
				$online = 0;
				foreach ($data1 as $data_type) {
			?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $data_type->RECT_NO; ?></td>
						<td><?php echo $data_type->RECT_DATE; ?></td>
						<td><?php echo $data_type->STU_NAME; ?></td>
						<td><?php echo $data_type->ADM_NO; ?></td>
						<td><?php echo $data_type->CLASS . "/" . $data_type->SEC; ?></td>
						<td><?php echo $data_type->ROLL_NO; ?></td>
						<td><?php echo $data_type->PERIOD; ?></td>
						<td><?php echo $data_type->TOTAL; ?></td>
						<?php if ($feehead1 != '' && $feehead1 != '-') { ?>
									<td><?php echo $data_type->Fee1; ?></td>
								<?php } ?>
								<?php if ($feehead2 != '' && $feehead2 != '-') { ?>
									<td><?php echo $data_type->Fee2; ?></td>
								<?php } ?>
								<?php if ($feehead3 != '' && $feehead3 != '-') { ?>
									<td><?php echo $data_type->Fee3; ?></td>
								<?php } ?>
								<?php if ($feehead4 != '' && $feehead4 != '-') { ?>
									<td><?php echo $data_type->Fee4; ?></td>
								<?php } ?>
								<?php if ($feehead5 != '' && $feehead5 != '-') { ?>
									<td><?php echo $data_type->Fee5; ?></td>
								<?php } ?>
								<?php if ($feehead6 != '' && $feehead6 != '-') { ?>
									<td><?php echo $data_type->Fee6; ?></td>
								<?php } ?>
								<?php if ($feehead7 != '' && $feehead7 != '-') { ?>
									<td><?php echo $data_type->Fee7; ?></td>
								<?php } ?>
								<?php if ($feehead8 != '' && $feehead8 != '-') { ?>
									<td><?php echo $data_type->Fee8; ?></td>
								<?php } ?>
								<?php if ($feehead9 != '' && $feehead9 != '-') { ?>
									<td><?php echo $data_type->Fee9; ?></td>
								<?php } ?>
								<?php if ($feehead10 != '' && $feehead10 != '-') { ?>
									<td><?php echo $data_type->Fee10; ?></td>
								<?php } ?>
								<?php if ($feehead11 != '' && $feehead11 != '-') { ?>
									<td><?php echo $data_type->Fee11; ?></td>
								<?php } ?>
								<?php if ($feehead12 != '' && $feehead12 != '-') { ?>
									<td><?php echo $data_type->Fee12; ?></td>
								<?php } ?>
								<?php if ($feehead13 != '' && $feehead13 != '-') { ?>
									<td><?php echo $data_type->Fee13; ?></td>
								<?php } ?>
								<?php if ($feehead14 != '' && $feehead14 != '-') { ?>
									<td><?php echo $data_type->Fee14; ?></td>
								<?php } ?>
								<?php if ($feehead15 != '' && $feehead15 != '-') { ?>
									<td><?php echo $data_type->Fee15; ?></td>
								<?php } ?>
								<?php if ($feehead16 != '' && $feehead16 != '-') { ?>
									<td><?php echo $data_type->Fee16; ?></td>
								<?php } ?>
								<?php if ($feehead17 != '' && $feehead17 != '-') { ?>
									<td><?php echo $data_type->Fee17; ?></td>
								<?php } ?>
								<?php if ($feehead18 != '' && $feehead18 != '-') { ?>
									<td><?php echo $data_type->Fee18; ?></td>
								<?php } ?>
								<?php if ($feehead19 != '' && $feehead19 != '-') { ?>
									<td><?php echo $data_type->Fee19; ?></td>
								<?php } ?>
								<?php if ($feehead20 != '' && $feehead20 != '-') { ?>
									<td><?php echo $data_type->Fee20; ?></td>
								<?php } ?>
								<?php if ($feehead21 != '' && $feehead21 != '-') { ?>
									<td><?php echo $data_type->Fee21; ?></td>
								<?php } ?>
								<?php if ($feehead22 != '' && $feehead22 != '-') { ?>
									<td><?php echo $data_type->Fee22; ?></td>
								<?php } ?>
								<?php if ($feehead23 != '' && $feehead23 != '-') { ?>
									<td><?php echo $data_type->Fee23; ?></td>
								<?php } ?>
								<?php if ($feehead24 != '' && $feehead24 != '-') { ?>
									<td><?php echo $data_type->Fee24; ?></td>
								<?php } ?>
								<?php if ($feehead25 != '' && $feehead25 != '-') { ?>
									<td><?php echo $data_type->Fee25; ?></td>
								<?php } ?>
								<td><?php echo $data_type->Payment_Mode; ?></td>

					</tr>
			<?php
					$i++;
					$t = $t + $data_type->TOTAL;
					$f1 = $f1 + $data_type->Fee1;
					$f2 = $f2 + $data_type->Fee2;
					$f3 = $f3 + $data_type->Fee3;
					$f4 = $f4 + $data_type->Fee4;
					$f5 = $f5 + $data_type->Fee5;
					$f6 = $f6 + $data_type->Fee6;
					$f7 = $f7 + $data_type->Fee7;
					$f8 = $f8 + $data_type->Fee8;
					$f9 = $f9 + $data_type->Fee9;
					$f10 = $f10 + $data_type->Fee10;
					$f11 = $f11 + $data_type->Fee11;
					$f12 = $f12 + $data_type->Fee12;
					$f13 = $f13 + $data_type->Fee13;
					$f14 = $f14 + $data_type->Fee14;
					$f15 = $f15 + $data_type->Fee15;
					$f16 = $f16 + $data_type->Fee16;
					$f17 = $f17 + $data_type->Fee17;
					$f18 = $f18 + $data_type->Fee18;
					$f19 = $f19 + $data_type->Fee19;
					$f20 = $f20 + $data_type->Fee20;
					$f21 = $f21 + $data_type->Fee21;
					$f22 = $f22 + $data_type->Fee22;
					$f23 = $f23 + $data_type->Fee23;
					$f24 = $f24 + $data_type->Fee24;
					$f24 = $f25 + $data_type->Fee25;


					if ($data_type->Payment_Mode == 'CASH') {
						$cash = $cash + $data_type->TOTAL;
					} elseif ($data_type->Payment_Mode == 'CARD SWAP') {
						$card = $card + $data_type->TOTAL;
					} elseif ($data_type->Payment_Mode == 'UPI') {
						$cheque = $cheque + $data_type->TOTAL;
					} elseif ($data_type->Payment_Mode == 'ONLINE' || $data_type->Payment_Mode == 'Online') {
						$online = $online + $data_type->TOTAL;
					} else {
					}
					if ($data_type->PERIOD == 'CANCELLED') {
						$cancel = $cancel + 1;
					}
				}
				$number = $t;
				$no = round($number);
				$point = round($number - $no, 2) * 100;
				$hundred = null;
				$digits_1 = strlen($no);
				$i = 0;
				$str = array();
				$words = array(
					'0' => '', '1' => 'One', '2' => 'Two',
					'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
					'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
					'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
					'13' => 'Thirteen', '14' => 'Fourteen',
					'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
					'18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
					'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
					'60' => 'Sixty', '70' => 'Seventy',
					'80' => 'Eighty', '90' => 'Ninety'
				);
				$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
				while ($i < $digits_1) {
					$divider = ($i == 2) ? 10 : 100;
					$number = floor($no % $divider);
					$no = floor($no / $divider);
					$i += ($divider == 10) ? 1 : 2;
					if ($number) {
						$plural = (($counter = count($str)) && $number > 9) ? '' : null;
						$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
						$str[] = ($number < 21) ? $words[$number] .
							" " . $digits[$counter] . $plural . " " . $hundred
							:
							$words[floor($number / 10) * 10]
							. " " . $words[$number % 10] . " "
							. $digits[$counter] . $plural . " " . $hundred;
					} else $str[] = null;
				}
				$str = array_reverse($str);
				$result = implode('', $str);
				$points = ($point) ?
					"." . $words[$point / 10] . " " .
					$words[$point = $point % 10] : '';
				$amtinword = "Rupees " . $result . "Only" /* . $points . " Paise" */;
			}
			?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>Grand Total</td>
				<td><?php echo $t; ?></td>
				<?php if ($feehead1 != '' && $feehead1 != '-') { ?>
									<td><?php echo $f1; ?></td>
								<?php } ?>
								<?php if ($feehead2 != '' && $feehead2 != '-') { ?>
									<td><?php echo $f2; ?></td>
								<?php } ?>
								<?php if ($feehead3 != '' && $feehead3 != '-') { ?>
									<td><?php echo $f3; ?></td>
								<?php } ?>
								<?php if ($feehead4 != '' && $feehead4 != '-') { ?>
									<td><?php echo $f4; ?></td>
								<?php } ?>
								<?php if ($feehead5 != '' && $feehead5 != '-') { ?>
									<td><?php echo $f5; ?></td>
								<?php } ?>
								<?php if ($feehead6 != '' && $feehead6 != '-') { ?>
									<td><?php echo $f6; ?></td>
								<?php } ?>
								<?php if ($feehead7 != '' && $feehead7 != '-') { ?>
									<td><?php echo $f7; ?></td>
								<?php } ?>
								<?php if ($feehead8 != '' && $feehead8 != '-') { ?>
									<td><?php echo $f8; ?></td>
								<?php } ?>
								<?php if ($feehead9 != '' && $feehead9 != '-') { ?>
									<td><?php echo $f9; ?></td>
								<?php } ?>
								<?php if ($feehead10 != '' && $feehead10 != '-') { ?>
									<td><?php echo $f10; ?></td>
								<?php } ?>
								<?php if ($feehead11 != '' && $feehead11 != '-') { ?>
									<td><?php echo $f11; ?></td>
								<?php } ?>
								<?php if ($feehead12 != '' && $feehead12 != '-') { ?>
									<td><?php echo $f12; ?></td>
								<?php } ?>
								<?php if ($feehead13 != '' && $feehead13 != '-') { ?>
									<td><?php echo $f13; ?></td>
								<?php } ?>
								<?php if ($feehead14 != '' && $feehead14 != '-') { ?>
									<td><?php echo $f14; ?></td>
								<?php } ?>
								<?php if ($feehead15 != '' && $feehead15 != '-') { ?>
									<td><?php echo $f15; ?></td>
								<?php } ?>
								<?php if ($feehead16 != '' && $feehead16 != '-') { ?>
									<td><?php echo $f16; ?></td>
								<?php } ?>
								<?php if ($feehead17 != '' && $feehead17 != '-') { ?>
									<td><?php echo $f17; ?></td>
								<?php } ?>
								<?php if ($feehead18 != '' && $feehead18 != '-') { ?>
									<td><?php echo $f18; ?></td>
								<?php } ?>
								<?php if ($feehead19 != '' && $feehead19 != '-') { ?>
									<td><?php echo $f19; ?></td>
								<?php } ?>
								<?php if ($feehead20 != '' && $feehead20 != '-') { ?>
									<td><?php echo $f20; ?></td>
								<?php } ?>
								<?php if ($feehead21 != '' && $feehead21 != '-') { ?>
									<td><?php echo $f21; ?></td>
								<?php } ?>
								<?php if ($feehead22 != '' && $feehead22 != '-') { ?>
									<td><?php echo $f22; ?></td>
								<?php } ?>
								<?php if ($feehead23 != '' && $feehead23 != '-') { ?>
									<td><?php echo $f23; ?></td>
								<?php } ?>
								<?php if ($feehead24 != '' && $feehead24 != '-') { ?>
									<td><?php echo $f24; ?></td>
								<?php } ?>
								<?php if ($feehead25 != '' && $feehead25 != '-') { ?>
									<td><?php echo $f25; ?></td>
								<?php } ?>
				<td></td>
			</tr>
		</tbody>
	</table>
	<div style='page-break-after: always;'></div>
	<p style='font-size:20px!important;'>Collection Statement Summary</p><br><br><br>
	<div style="height:300px; width:800px; position:relative; top:-10px;">
		<table>
			<tr>
				<td style='font-size:18px!important;'>Total Cancelled Receipt</td><br>
				<td style='font-size:18px!important;'>:&nbsp;<?php echo $cancel; ?></td>
			</tr>
			<tr>
				<td style='font-size:18px!important;'>Total Collection</td>
				<td style='font-size:18px!important;'>:&nbsp;<?php echo $t; ?></td>
			</tr>
			<tr>
				<td style='font-size:18px!important;'>Amount (In Words)</td>
				<td style='font-size:18px!important;'>:&nbsp;<?php echo $amtinword; ?></td>
			</tr>
		</table>
		<hr>
		<caption style='font-size:18px!important;'>Amount Collection By Card/Cash/UPI/Online</caption><br><br>
		<table border="1" width="100%">
			
			<tr>
				<th style='font-size:18px!important;'>CASH</th>
				<th style='font-size:18px!important;'>CARD</th>
				<th style='font-size:18px!important;'>UPI</th>
				<th style='font-size:18px!important;'>ONLINE</th>
			</tr>
			<tr>
				<td style='font-size:18px!important;'><?php echo $cash; ?></td>
				<td style='font-size:18px!important;'><?php echo $card; ?></td>
				<td style='font-size:18px!important;'><?php echo $cheque; ?></td>
				<td style='font-size:18px!important;'><?php echo $online; ?></td>
			</tr>
		</table>
		<table>
			<tr>
				<td style='font-size:18px!important;'>Cash at Bank</td>
				<td style='font-size:18px!important;'>: Rs__________________________________________</td>
			</tr>
			<tr>
				<td style='font-size:18px!important;'>Cash in Hand</td>
				<td style='font-size:18px!important;'>: Rs__________________________________________</td>
			</tr>
			<tr>
				<td style='font-size:18px!important;'>Date of Deposit</td>
				<td style='font-size:18px!important;'>: __________/__________/_________</td>
			</tr>
		</table>
	</div>
	<div style="height:300px; width:700px; position:relative; float:right; top:-309px;">
		<div style='border:1px solid black;'>
			<br />
			<table>
				<tr>
					<td style='font-size:18px!important;'>Rs.____________________________________</td>
				</tr>
				<tr>
					<td style='font-size:18px!important;'>In Custody of :______________________</td>
				</tr>
				<tr>
					<td><br />
					<td>
				</tr>
				<tr>
					<td style='font-size:18px!important;'>
						<center>Signature</center>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<br /><br />
	<table width="100%">
		<tr>
			<td style='font-size:15px!important;'>
				<center>Prepared By</center>
			</td>
			<!-- <td style='font-size:15px!important;'><center>Checked By</center></td> -->
			<td style='font-size:15px!important;'>
				<center>Accountant</center>
			</td>
			<td style='font-size:15px!important;'>
				<center>Principal Signature</center>
			</td>
		</tr>
	</table>
</body>

</html>