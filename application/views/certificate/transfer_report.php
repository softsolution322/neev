<?php
error_reporting(0);
if ($tc_details) {
	$adm_date = $tc_details[0]->ADM_DATE;
	$dobb = $tc_details[0]->BIRTH_DT;
	$text019 = $tc_details[0]->text019;
	$text020 = $tc_details[0]->text020;
	$adm_d = date("d-M-Y", strtotime($adm_date));
	$dob_t = date("d-M-Y", strtotime($dobb));
	$text0191 = date("d-M-Y", strtotime($text019));
	$text0201 = date("d-M-Y", strtotime($text020));
}


$dob = $dob_t;
$dob_exp = explode("-", $dobb);
$year = $dob_exp[0];
$day = $dob_exp[2];
$mont_alpha = date('F', strtotime($dob));

$number = $year;
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
$amtinword = $result/* . $points . " Paise" */;

//----------------------------//
$numbers = $day;
$nos = round($numbers);
$points = round($numbers - $nos, 2) * 100;
$hundreds = null;
$digits_1s = strlen($nos);
$is = 0;
$strs = array();
$wordss = array(
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
$digitss = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
while ($is < $digits_1s) {
	$dividers = ($is == 2) ? 10 : 100;
	$numbers = floor($nos % $dividers);
	$nos = floor($nos / $dividers);
	$is += ($dividers == 10) ? 1 : 2;
	if ($numbers) {
		$plurals = (($counters = count($strs)) && $numbers > 9) ? 's' : null;
		$hundreds = ($counters == 1 && $strs[0]) ? ' and ' : null;
		$strs[] = ($numbers < 21) ? $wordss[$numbers] .
			" " . $digitss[$counters] . $plurals . " " . $hundreds
			:
			$wordss[floor($numbers / 10) * 10]
			. " " . $wordss[$numbers % 10] . " "
			. $digitss[$counters] . $plurals . " " . $hundreds;
	} else $strs[] = null;
}
$strs = array_reverse($strs);
$results = implode('', $strs);
$pointss = ($points) ?
	"." . $wordss[$points / 10] . " " .
	$wordss[$points = $points % 10] : '';
$amtinwords = $results;
//----------------------------//
$mont_alpha = $amtinwords . $mont_alpha . " " . $amtinword;

?>

<html>
<title>Transfer Certificate</title>

<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/dash_css/font-awesome.css'); ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Notable' rel='stylesheet' type='text/css'>

	<style>
		table tr th,
		td {
			font-size: 13px !important;
			padding: 3px !important;
			font-family: Times New Roman, serif;
		}

		@page {
			margin: 20px 12px 0px 12px;
		}

		.table,
		tr,
		td,
		th {
			border-top: 1px solid #ffff !important;
		}

		.sign {
			font-family: 'Laila', serif;
		}

		#content {
			border: solid 1px black;
			border-radius: 10px 10px 10px 10px;
			width: 60%;
			height: 5%;
			/* margin-left: 25%;
			margin-right: 25%; */
			background: #dcaf48cf !important;
			font-size: 15px;
			padding-top: 10px;
		}

		#content1 {
			border: solid 1px black;
			border-radius: 10px 10px 10px 10px;
			width: 60%;
			height: 8%;
			margin-left: 25%;
			margin-right: 25%;
			background: #dcaf48cf !important;
			font-size: 15px;
			padding-top: 10px;
		}

		body {
			padding-left: 20px;
			padding-right: 20px;
		}
	</style>
</head>

<body>

	<div style="border:3px solid #000; padding:10px;">
		<div class="row">
			<table style="width: 100%; padding: 0px !important;">
				<tr>
					<td style="width: 10%;" rowspan="2">
						<center>
							<img src="<?php echo base_url('assets/school_logo/1564835888.jpg'); ?>" id="image" style="width:100px;margin-left:50px;">
						</center>
					</td>
					<td style="width: 80%;text-align:center">
						<h5><b style="color:#000;font-weight:bold !important; text-align:center; font-size:24px;"><?php echo $school_setting[0]->School_Name; ?></b></h5>

					</td>
					<td style="width: 10%;"></td>
				</tr>
				<tr>
					<td style="width: 80%;text-align:center">
						<h6 style="color:#000;font-weight:bold !important; text-align:center; font-size:15px;"><?php echo $school_setting[0]->School_Address; ?>&nbsp; (<?php echo $school_setting[0]->School_Session; ?>)</h6>
					</td>
					<td style="width: 10%;"></td>
				</tr>
			</table>
		</div>
		<center>
			<h6><b>
					<div id="content">SCHOOL LEAVING CERTIFICATE</div>
				</b></h6>
		</center></br>
		<p style="font-style: italic;">TC No. : <?php echo $tc_details[0]->TCNO; ?></p>

		<table class='table'>

			<tr>
				<th width='30%'>Name of the Pupil :</th>
				<th width='70%' style="border-bottom: 1px solid black;">&nbsp;<?php echo $tc_details[0]->Name; ?></th>


			</tr>

			<tr>
				<th>Father's Name :</th>
				<th style="border-bottom: 1px solid black;"> &nbsp;<?php echo $tc_details[0]->Father_NM; ?></th>

			</tr>

			<tr>
				<th>Residence :</th>
				<th style="border-bottom: 1px solid black;"> &nbsp;<?php echo $tc_details[0]->textsub1; ?></th>

			</tr>
			<tr>
				<th></th>
				<th style="border-bottom: 1px solid black;"> &nbsp;<?php echo $tc_details[0]->textsub2; ?></th>

			</tr>
			<tr>
				<th width='40%'>Date of the admission in school :</th>
				<th width='60%' style="border-bottom: 1px solid black;"> &nbsp; <?php echo $adm_d; ?></th>

			</tr>

			<tr>
				<th>Number in admission Register :</th>
				<th style="border-bottom: 1px solid black;">&nbsp; <?php echo $tc_details[0]->adm_no; ?></th>

			</tr>
			<tr>
				<th>Date of birth as recorded in Admission Register :</th>
				<th style="border-bottom: 1px solid black;"> &nbsp; <?php echo $dob_t; ?></th>

			</tr>
			<tr>
				<th>(in words) :</th>
				<th style="border-bottom: 1px solid black;">&nbsp;<?php echo $mont_alpha; ?></th>

			</tr>

			<tr>
				<th>Date on which he/she left the school :</th>
				<th style="border-bottom: 1px solid black;"> &nbsp; <?php echo $text0191; ?></th>

			</tr>

			<tr>
				<th>Class in which he/she was then reading :</th>
				<th style="border-bottom: 1px solid black;"> &nbsp;<?php echo $tc_details[0]->current_Class; ?> </th>

			</tr>

			<tr>
				<th>Whether he/she passed the examination for promotion to the next class :</th>
				<th style="border-bottom: 1px solid black;"> &nbsp; <?php echo $tc_details[0]->TEXT08a; ?></th>

			</tr>

			<tr>
				<th>Character :</th>
				<th style="border-bottom: 1px solid black;"> &nbsp; <?php echo $tc_details[0]->combo018; ?></th>

			</tr>

			<tr>
				<th>Reasons for leaving the school :</th>
				<th style="border-bottom: 1px solid black;"> &nbsp;<?php echo $tc_details[0]->text021; ?> </th>

			</tr>

			<tr>
				<th>All sums due by him/her to the school have been paid :</th>
				<th style="border-bottom: 1px solid black;"> &nbsp;<?php echo $tc_details[0]->combo016; ?> </th>

			</tr>
			<tr>
				<th>Date of issue of certificate :</th>
				<th style="border-bottom: 1px solid black;">&nbsp;<?php echo $text0201; ?> </th>

			</tr>

		</table>
		<div class='col-sm-12 col-xs-12'>
			<br><br>
			<table class='table' style="width: 100%;">
				<tr>

					<td width='100%' style="font-style: italic;">
						<center><b>Principal</b></center>
					</td>

				</tr>
				<tr>
				<td width='100%' style="font-style: italic;">
						<center><b>Best of luck for future</b></center>
					</td>
				</tr>
			</table>
		</div>
		<div class='row sign'>

		</div>
	</div>
	<!-- <br> -->
	<center>
		<button class="btn btn-primary" id="printing_button" onclick="printl()">PRINT</button>&nbsp;<a class="btn btn-danger" id="print_cancel" href="<?php echo base_url('Transfer_certificate/transfer_certificate') ?>">BACK</a>
	</center>
</body>

<script type="text/javascript">
		
		window.onafterprint=(event) =>{
			var printButton = document.getElementById("printing_button");
			var print_cancel = document.getElementById('print_cancel');
			printButton.style.visibility = 'visible';
			print_cancel.style.visibility = 'visible';
		}
		function printl() {
			var printButton = document.getElementById("printing_button");
			var print_cancel = document.getElementById('print_cancel');
			print_cancel.style.visibility = 'hidden';
			printButton.style.visibility = 'hidden';
			window.print();
			printButton.style.visibility = 'visible';
			print_cancel.style.visibility = 'visible';
		}
		
		function printl_body() {
			var printButton = document.getElementById("printing_button");
			var print_cancel = document.getElementById('print_cancel');
			print_cancel.style.visibility = 'hidden';
			printButton.style.visibility = 'hidden';
			window.print();
			
		}
		
		$(document).ready(function() {
			/*function disableBack() { window.history.forward() }
			window.onload = disableBack();
			window.onpageshow = function(evt) { if (evt.persisted) disableBack() }*/
			function preventBack() {
				window.history.forward();
			}
			setTimeout("preventBack()", 0);
			window.onunload = function() {
				null
			};
		});
	</script>

</html>