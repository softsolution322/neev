<?php
	if($school_setting)
	{
		$school_logo = $school_setting[0]->SCHOOL_LOGO;
		$school_name = $school_setting[0]->School_Name;
		$school_add  = $school_setting[0]->School_Address;
		$school_aff  = $school_setting[0]->School_AfftNo;
		$school_email = $school_setting[0]->School_Email;
		$school_phone = $school_setting[0]->School_PhoneNo;
		$school_mobile = $school_setting[0]->School_MobileNo;
		$school_web = $school_setting[0]->School_Webaddress;
	}
	if($receipt_details)
	{
		$RECT_NO = $receipt_details[0]->RECT_NO;
		$RECT_DATE = $receipt_details[0]->RECT_DATE;
		$STU_NAME = $receipt_details[0]->STU_NAME;
		$CLASS = $receipt_details[0]->CLASS;
        $SEC = $receipt_details[0]->SEC;
        $ROLL_NO = $receipt_details[0]->ROLL_NO;
		$Payment_Mode = $receipt_details[0]->Payment_Mode;
		$PERIOD = $receipt_details[0]->PERIOD;
		$ADM_NO = $receipt_details[0]->ADM_NO;
		$TOTAL = $receipt_details[0]->TOTAL;
		$Fee1 = $receipt_details[0]->Fee1;
		$Fee2 = $receipt_details[0]->Fee2;
		$Fee3 = $receipt_details[0]->Fee3;
		$Fee4 = $receipt_details[0]->Fee4;
		$Fee5 = $receipt_details[0]->Fee5;
		$Fee6 = $receipt_details[0]->Fee6;
		$Fee7 = $receipt_details[0]->Fee7;
		$Fee8 = $receipt_details[0]->Fee8;
		$Fee9 = $receipt_details[0]->Fee9;
		$Fee10 = $receipt_details[0]->Fee10;
		$Fee11 = $receipt_details[0]->Fee11;
		$Fee12 = $receipt_details[0]->Fee12;
		$Fee13 = $receipt_details[0]->Fee13;
		$Fee14 = $receipt_details[0]->Fee14;
		$Fee15 = $receipt_details[0]->Fee15;
		$Fee16 = $receipt_details[0]->Fee16;
		$Fee17 = $receipt_details[0]->Fee17;
		$Fee18 = $receipt_details[0]->Fee18;
		$Fee19 = $receipt_details[0]->Fee19;
		$Fee20 = $receipt_details[0]->Fee20;
		$Fee21 = $receipt_details[0]->Fee21;
		$Fee22 = $receipt_details[0]->Fee22;
		$Fee23 = $receipt_details[0]->Fee23;
		$Fee24 = $receipt_details[0]->Fee24;
		$Fee25 = $receipt_details[0]->Fee25;
		$CHQ_NO = $receipt_details[0]->CHQ_NO;
	}
	
   $number = $TOTAL;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
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
  $amtinword="Rupees ".$result . "Only" /* . $points . " Paise" */;
	
	if($student_details)
	{
		$father_name = $student_details[0]->FATHER_NM;
		$mother_name = $student_details[0]->MOTHER_NM;
	}
	$count_length = strlen($PERIOD);
	IF($count_length > 28)
	{
		$FIRSTEXP = explode("-",$PERIOD);
		$first = $FIRSTEXP[0];
		$last  = substr($PERIOD,-3);
		$FEE_FOR = $first." TO ".$last;
	}
	ELSE
	{
		$FEE_FOR = $PERIOD;
	}
	if($feehead1)
		{
			$feehead1 = $feehead1[0]->FEE_HEAD;
		}
		if($feehead2)
		{
			$feehead2 = $feehead2[0]->FEE_HEAD;
		}
		if($feehead3)
		{
			$feehead3 = $feehead3[0]->FEE_HEAD;
		}
		if($feehead4)
		{
			$feehead4 = $feehead4[0]->FEE_HEAD;
		}
		if($feehead5)
		{
			$feehead5 = $feehead5[0]->FEE_HEAD;
		}
		if($feehead6)
		{
			$feehead6 = $feehead6[0]->FEE_HEAD;
		}
		if($feehead7)
		{
			$feehead7 = $feehead7[0]->FEE_HEAD;
		}
		if($feehead8)
		{
			$feehead8 = $feehead8[0]->FEE_HEAD;
		}
		if($feehead9)
		{
			$feehead9 = $feehead9[0]->FEE_HEAD;
		}
		if($feehead10)
		{
			$feehead10 = $feehead10[0]->FEE_HEAD;
		}
		if($feehead11)
		{
			$feehead11 = $feehead11[0]->FEE_HEAD;
		}
		if($feehead12)
		{
			$feehead12 = $feehead12[0]->FEE_HEAD;
		}
		if($feehead13)
		{
			$feehead13 = $feehead13[0]->FEE_HEAD;
		}
		if($feehead14)
		{
			$feehead14 = $feehead14[0]->FEE_HEAD;
		}
		if($feehead15)
		{
			$feehead15 = $feehead15[0]->FEE_HEAD;
		}
		if($feehead16)
		{
			$feehead16 = $feehead16[0]->FEE_HEAD;
		}
		if($feehead17)
		{
			$feehead17 = $feehead17[0]->FEE_HEAD;
		}
		if($feehead18)
		{
			$feehead18 = $feehead18[0]->FEE_HEAD;
		}
		if($feehead19)
		{
			$feehead19 = $feehead19[0]->FEE_HEAD;
		}
		if($feehead20)
		{
			$feehead20 = $feehead20[0]->FEE_HEAD;
		}
		if($feehead21)
		{
			$feehead21 = $feehead21[0]->FEE_HEAD;
		}
		if($feehead22)
		{
			$feehead22 = $feehead22[0]->FEE_HEAD;
		}
		if($feehead23)
		{
			$feehead23 = $feehead23[0]->FEE_HEAD;
		}
		if($feehead24)
		{
			$feehead24 = $feehead24[0]->FEE_HEAD;
		}
		if($feehead25)
		{
			$feehead25 = $feehead25[0]->FEE_HEAD;
		}

		$Date = explode("-",$RECT_DATE);
		$yy = $Date[0];
		$mm = $Date[1];
		$dd = $Date[2];
		$date_format = $dd."-".$mm."-".$yy;
?>
<style>
		body{
			font-family: Verdana,Geneva,sans-serif !important;
		}
		*{
			font-size: 11px;
		}
		/* .qty{
			text-align: right;
			font-weight: bold;
		} */
		.amt{
			text-align: right;
			font-weight: bold;
			font-size:13px;
		}
		.Particulars{
			font-weight: bold;
			font-size:13px;
		}
		.slno{
			font-weight: bold;
			font-size:13px;
		}
		.fee_data{
			text-align:center;
		}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sunil Enterprises Bill</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style type="text/css">
  	body {
			marging: 0px !important;
			paddging : 0px !important;
		}
  	@page {
    		size: auto;   / auto is the initial value /
    		margin: 0px;    / this affects the margin in the printer settings /
		}
		*{
			font-size: 11px;
		}
		.qty{
			text-align: right;
			font-weight: bold;
		}
		.amt{
			text-align: right;
			font-weight: bold;
		}
		.Particulars{
			font-weight: bold;
		}
		.slno{
			font-weight: bold;
		}
		.hr1{
			border : .5px solid black;
		}
		
  </style>
</head>
<body>
  
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-lg-6">
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4">
						<table width="100%">
							<tr>
								<th ><center><b style="font-size: 29px !important;">Sunil Enterprises</b></center></th>
							</tr>
							<tr>
								<td><center><b style="font-size: 9px;">
								<hr class="hr1">
								Near Bharti Hospital, Below Over Bridge, New Anantpur, Ranchi</b></center></td>
							</tr>
							<tr>
								<td><center><b style="font-size: 10px;">Ph.: +919631088704
								</b></center></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<table width="100%">
							<tr>
								<td colspan="6"><center><B>OFFICE COPY</B></center></td>
							</tr>
							<tr>
								<td><b>Receipt No.</b></td>
								<td colspan="2">: <?php echo $RECT_NO; ?></td>
								<td><b>Date</b></td>
								<td colspan="2">: <?php echo date('d-M-Y',strtotime($RECT_DATE)); ?></td>
							</tr>
							<tr>
								<td colspan='2'><b>School Name</b></td>
								<td colspan="4">: <?php echo $school_name; ?></td>
							</tr>
							<tr>
								<td><b>Roll No.</b></td>
								<td>: <?php echo $ROLL_NO; ?></td>
								<td><b>Class</b></td>
								<td>: <?php echo $CLASS; ?></td>
								<td><b>Sec</b></td>
								<td>: <?php echo $SEC; ?></td>
							</tr>
							<tr>
								<td colspan="3"><b>Name of Purchaser</b></td>
								<td colspan="3">: <?php echo $STU_NAME; ?></td>
							</tr>
							<tr>
								<td colspan="2"><b>Payment Mode</b></td>
								<td colspan="3">: <?php echo $Payment_Mode; ?></td>
							</tr>
							<tr>
								<td><b>DD/Cheque No.</b></td>
								<td colspan="5">: <?php echo $CHQ_NO; ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="slno" style="background:black; text-align:center; color:white; font-size:10px;">Sl No</td>
					<td class="Particulars" style="background:black; color:white; font-size:10px;" colspan="2">Particulars</td>
					
					<td class="amt" style="background:black; color:white; font-size:10px;">Amount (&#8377;)</td>
				</tr>
				<tr>
					<td class="slno" width="14%" style="text-align:center;">
						<table width="100%" padding: 0px;">
                    		<?php
                    		  $i=1;
                    		   if($Fee1>0)
                    		   {
                    		   		?>
                    		   			<tr class="fee_data">
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    		<?php
                    		   if($Fee2>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    		<?php
                    		   if($Fee3>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    		<?php
                    		   if($Fee4>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    		<?php
                    		   if($Fee5>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    		<?php
                    		   if($Fee6>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee7>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee8>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee9>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee10>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee11>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee12>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee13>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee14>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee15>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee16>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee17>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee18>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee19>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee20>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee21>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee22>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee23>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee24>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee25>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    		<?php
						  if($Fee1>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
                    	</table>
					</td>
					<td class="Particulars" colspan="2">
						<table width="100%" style="padding-left: 5px;">
                    		<?php
						  if($Fee1>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td ><?php echo $feehead1; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead2; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead3; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead4; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead5; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead6; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead7; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead8; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead9; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead10; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead11; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead12; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead13; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead14; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead15; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead16; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead17; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee18>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead18; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee19>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead19; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee20>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead20; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee21>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead21; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee22>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead22; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee23>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead23; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee24>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead24; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee25>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead25; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee1>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee2>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee3>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee4>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee5>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee6>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee7>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee8>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee9>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee10>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee11>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee12>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee13>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee14>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee15>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee16>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
                    	</table>
					</td>
					<td class="amt" width="25%">
						<table width="100%" style="text-align: right; padding: 2px;">
						<?php
						  if($Fee1>0)
						  {
						  	?>
						  	<tr>
						  		<td class="fee_data"><?php echo $Fee1.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {

						  }
						?>
						<?php
						  if($Fee2>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee2.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee3>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee3.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee4>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee4.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee5>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee5.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee6>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee6.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee7>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee7.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee8>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee8.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee9>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee9.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee10>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee10.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee11>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee11.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee12>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee12.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee13>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee13.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee14>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee14.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee15>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee15.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee16>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee16.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee17>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee17.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee18>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee18.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee19>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee19.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee20>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee20.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee21>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee21.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee22>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee22.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee23>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee23.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee24>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee24.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee25>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee25.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee1>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
					</table>
					</td>
				</tr>
				<tr>
					<td colspan="3" style="text-align: right; font-size:13px; font-weight: bold; background:black; color:white;">Grand Total (&#8377;) &nbsp;</td>
					<td class="amt"><?php echo $TOTAL.".00"; ?></td>
				</tr>
				<tr>
					<td width="14%"><b style="font-size:9px;">In Word</b></td>
					<td colspan="4">: <b style="font-size:9px;"><?php echo $amtinword; ?></b></td>
				</tr>
				<tr>
					<td colspan="3"><br /><b style="font-size:10px;">Material Once Sold Will Be Not Exchanged</b></td>
					<td colspan="3" style="text-align:center;"><br /><b>Authorised Signature</b></td>
				</tr>
			</table>
		</div>
		
		<div class="col-md-6 col-sm-6 col-lg-6">
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4">
						<table width="100%">
							<tr>
								<th ><center><b style="font-size: 29px !important;">Sunil Enterprises</b></center></th>
							</tr>
							<tr>
								<td><center><b style="font-size: 9px;">
								<hr class="hr1">
								Near Bharti Hospital, Below Over Bridge, New Anantpur, Ranchi</b></center></td>
							</tr>
							<tr>
								<td><center><b style="font-size: 10px;">Ph.: +919631088704
								</b></center></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<table width="100%">
							<tr>
								<td colspan="6"><center><B>PARENT'S COPY</B></center></td>
							</tr>
							<tr>
								<td><b>Receipt No.</b></td>
								<td colspan="2">: <?php echo $RECT_NO; ?></td>
								<td><b>Date</b></td>
								<td colspan="2">: <?php echo date('d-M-Y',strtotime($RECT_DATE)); ?></td>
							</tr>
							<tr>
								<td colspan='2'><b>School Name</b></td>
								<td colspan="4">: <?php echo $school_name; ?></td>
							</tr>
							<tr>
								<td><b>Roll No.</b></td>
								<td>: <?php echo $ROLL_NO; ?></td>
								<td><b>Class</b></td>
								<td>: <?php echo $CLASS; ?></td>
								<td><b>Sec</b></td>
								<td>: <?php echo $SEC; ?></td>
							</tr>
							<tr>
								<td colspan="3"><b>Name of Purchaser</b></td>
								<td colspan="3">: <?php echo $STU_NAME; ?></td>
							</tr>
							<tr>
								<td colspan="2"><b>Payment Mode</b></td>
								<td colspan="3">: <?php echo $Payment_Mode; ?></td>
							</tr>
							<tr>
								<td><b>DD/Cheque No.</b></td>
								<td colspan="5">: <?php echo $CHQ_NO; ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="slno" style="background:black; text-align:center; color:white; font-size:10px;">Sl No</td>
					<td class="Particulars" style="background:black; color:white; font-size:10px;" colspan="2">Particulars</td>
					
					<td class="amt" style="background:black; color:white; font-size:10px;">Amount (&#8377;)</td>
				</tr>
				<tr>
					<td class="slno" width="14%" style="text-align:center;">
						<table width="100%" padding: 0px;">
                    		<?php
                    		  $i=1;
                    		   if($Fee1>0)
                    		   {
                    		   		?>
                    		   			<tr class="fee_data">
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    		<?php
                    		   if($Fee2>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    		<?php
                    		   if($Fee3>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    		<?php
                    		   if($Fee4>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    		<?php
                    		   if($Fee5>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    		<?php
                    		   if($Fee6>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee7>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee8>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee9>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee10>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee11>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee12>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee13>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee14>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee15>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee16>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee17>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee18>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee19>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee20>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee21>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee22>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee23>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee24>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    			<?php
                    		   if($Fee25>0)
                    		   {
                    		   		?>
                    		   			<tr>
                    		   				<td class="fee_data"><?php echo $i; ?></td>
                    		   			</tr>
                    		   		<?php
                    		   		$i++;
                    		   }
                    		   else
                    		   {

                    		   }
                    		?>
                    		<?php
						  if($Fee1>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
                    	</table>
					</td>
					<td class="Particulars" colspan="2">
						<table width="100%" style="padding-left: 5px;">
                    		<?php
						  if($Fee1>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td ><?php echo $feehead1; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead2; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead3; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead4; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead5; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead6; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead7; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead8; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead9; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead10; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead11; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead12; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead13; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead14; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead15; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead16; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead17; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee18>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead18; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee19>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead19; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee20>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead20; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee21>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead21; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee22>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead22; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee23>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead23; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee24>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead24; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee25>0)
						  {
						  	?>
						  	 <tr>
						  	 	<td><?php echo $feehead25; ?></td>
						  	 </tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee1>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee2>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee3>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee4>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee5>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee6>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee7>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee8>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee9>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee10>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee11>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee12>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee13>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee14>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee15>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php 
						  }
						?>
						<?php
						  if($Fee16>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
                    	</table>
					</td>
					<td class="amt" width="25%">
						<table width="100%" style="text-align: right; padding: 2px;">
						<?php
						  if($Fee1>0)
						  {
						  	?>
						  	<tr>
						  		<td class="fee_data"><?php echo $Fee1.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {

						  }
						?>
						<?php
						  if($Fee2>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee2.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee3>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee3.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee4>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee4.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee5>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee5.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee6>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee6.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee7>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee7.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee8>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee8.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee9>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee9.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee10>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee10.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee11>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee11.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee12>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee12.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee13>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee13.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee14>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee14.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee15>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee15.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee16>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee16.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee17>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee17.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee18>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee18.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee19>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee19.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee20>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee20.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee21>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee21.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee22>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee22.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee23>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee23.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee24>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee24.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee25>0)
						  {
						  	?>
						  	<tr>
						  		<td><?php echo $Fee25.".00"; ?></td>
						  	</tr>
						  	<?php
						  }
						  else
						  {
						  	
						  }
						?>
						<?php
						  if($Fee1>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee2>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee3>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee4>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee5>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee6>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee7>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee8>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee9>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee10>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee11>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee12>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee13>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee14>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee15>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee16>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
						<?php
						  if($Fee17>0)
						  {

						  }
						  else
						  {
						  	?>
						  	<tr>
						  		<td><br></td>
						  	</tr>
						  	<?php
						  }
						?>
					</table>
					</td>
				</tr>
				<tr>
					<td colspan="3" style="text-align: right; font-size:13px; font-weight: bold; background:black; color:white;">Grand Total (&#8377;) &nbsp;</td>
					<td class="amt"><?php echo $TOTAL.".00"; ?></td>
				</tr>
				<tr>
					<td width="14%"><b style="font-size:9px;">In Word</b></td>
					<td colspan="4">: <b style="font-size:9px;"><?php echo $amtinword; ?></b></td>
				</tr>
				<tr>
					<td colspan="3"><br /><b style="font-size:10px;">Material Once Sold Will Be Not Exchanged</b></td>
					<td colspan="3" style="text-align:center;"><br /><b>Authorised Signature</b></td>
				</tr>
			</table>
		</div>
	</div><br><br><br>
	<div class="row">
		<div class="col-md-12">
			<center>
				<button class="btn btn-primary" id="printing_button" onclick="printl()">Print</button>&nbsp;<a class="btn btn-danger" id="print_cancel" href="<?php echo base_url('Sunil_enterprises/month_collection'); ?>">BACK</a>
			</center>
		</div>
	</div>   
</div>
<script type="text/javascript">
	function printl()
	{
		var printButton = document.getElementById("printing_button");
		var print_cancel = document.getElementById('print_cancel');
		print_cancel.style.visibility = 'hidden';
		printButton.style.visibility = 'hidden';
		window.print();
		printButton.style.visibility = 'visible';
		print_cancel.style.visibility = 'visible';
	}
	 $(document).ready(function() {
	/*function disableBack() { window.history.forward() }
	window.onload = disableBack();
	window.onpageshow = function(evt) { if (evt.persisted) disableBack() }*/
	function preventBack(){window.history.forward();}
	setTimeout("preventBack()", 0);
	window.onunload=function(){null};
});
</script>

</body>
</html>