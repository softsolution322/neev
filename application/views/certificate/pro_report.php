<?php
	error_reporting(0);
	if($details_fetch){
		$Birth_Date = $details_fetch[0]->Birth_Date;
		$Issue_DATE = $details_fetch[0]->Issued_Date;
		$birth_date1 = date('d-M-Y',strtotime($Birth_Date));
		$Issue_DATE1 = date('d-M-Y',strtotime($Issue_DATE));
	}

    $dob = $birth_date1;
        $dob_exp = explode("-",$Birth_Date);
		$year = $dob_exp[0];
		$day = $dob_exp[2];
		$mont_alpha = date('F',strtotime($dob));

$number = $year;
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
        $plural = (($counter = count($str)) && $number > 9) ? '' : null;
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
  $amtinword= $result/* . $points . " Paise" */;
  
  //----------------------------//
		$numbers = $day;
	   $nos = round($numbers);
	   $points = round($numbers - $nos, 2) * 100;
	   $hundreds = null;
	   $digits_1s = strlen($nos);
	   $is = 0;
	   $strs = array();
	   $wordss = array('0' => '', '1' => 'One', '2' => 'Two',
		'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
		'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
		'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
		'13' => 'Thirteen', '14' => 'Fourteen',
		'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
		'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
		'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
		'60' => 'Sixty', '70' => 'Seventy',
		'80' => 'Eighty', '90' => 'Ninety');
	   $digitss = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
	   while ($is < $digits_1s) {
		 $dividers = ($is == 2) ? 10 : 100;
		 $numbers = floor($nos % $dividers);
		 $nos = floor($nos / $dividers);
		 $is += ($dividers == 10) ? 1 : 2;
		 if ($numbers) {
			$plurals = (($counters = count($strs)) && $numbers > 9) ? 's' : null;
			$hundreds = ($counters == 1 && $strs[0]) ? ' and ' : null;
			$strs [] = ($numbers < 21) ? $wordss[$numbers] .
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
	  $amtinwords= $results;
  //----------------------------//
	$mont_alpha = $amtinwords.$mont_alpha." ".$amtinword;
    
?>

<html>
  <title>Provisional Certificate</title>
  <head>
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/dash_css/font-awesome.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Notable' rel='stylesheet' type='text/css'>
	
	<style> 
	  table tr th,td{
		font-size:16px!important;
		padding:3.5px!important;
		  font-family:Times New Roman, serif;
	}
	@page { 
		margin: 40px 12px 0px 12px; 	
	}
	.table,tr,td,th{
	  border-top:1px solid #ffff !important;
	}
	.sign{
		font-family: 'Laila', serif;
	}
		#content{
			border: solid 1px black;
			border-radius: 10px 10px 10px 10px;
			width : 60%;
			height : 3%;
			margin-left: 25% !imprtant;
			margin-right: 25% !imprtant;
			background:#dcaf48cf !important;
			font-size:15px;
			padding-top:10px;
		}
		#content1{
			border: solid 1px black;
			border-radius: 10px 10px 10px 10px;
			width : 60%;
			height : 8%;
			margin-left: 25% !imprtant;
			margin-right: 25% !imprtant;
			background:#dcaf48cf !important;
			font-size:15px;
			padding-top:10px;
		}
	body{
		padding-left:20px;
		padding-right:20px;
	}	
	
	</style>
  </head>
   <body>
       
               <div style="border:3px solid #000; padding:10px;">
				  <div class="row">
			<div class="col-md-2 col-sm-2 col-lg-2">
				<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="image" style="width:100px;">
			</div>
			<div class="col-md-8 col-lg-8 col-sm-8">
				<center><h5><b style="color:#000;font-weight:bold !important; text-align:center; font-size:22px;"><?php echo $school_setting[0]->School_Name; ?></b></h5>
				<h6 style="color:#000;font-weight:bold !important; text-align:center; font-size:15px;"><?php echo $school_setting[0]->School_Address; ?></h6>
				
				<h6 style="color:#000;font-weight:bold !important; text-align:center; font-size:13px;">Session (<?php echo $school_setting[0]->School_Session; ?>)</h6></center>
			</div>
			<div class="col-md-2 col-sm-2 col-lg-2">
			</div>
		</div>
				  <center><h6><b><div id="content">PROVISIONAL SCHOOL LEAVING CERTIFICATE</div></b></h6></center>
		   <p style="font-style: italic;">Certificate No. : <?php echo $details_fetch[0]->CERT_NO; ?></p>
		   
				  <table class='table'>
				    
					<tr>	
					  <th width='30%'>Student's Name</th>
					  <th width='70%' style="border-bottom: 1px solid black;">:&nbsp;<?php echo $details_fetch[0]->S_NAME; ?></th>
						        
					  
					</tr>
					
					<tr>
						<th>Mother's Name</th>
						<th style="border-bottom: 1px solid black;">: &nbsp;<?php echo $details_fetch[0]->M_Name; ?></th>
						
					</tr>
					
					<tr>
					  <th>Father's Name</th>
					  <th style="border-bottom: 1px solid black;">: &nbsp;<?php echo $details_fetch[0]->F_NAME; ?></th>
					  
					</tr>
					  
					  <tr>
					  <th width='40%'>Class in which he/she is studying</th>
					  <th width='60%' style="border-bottom: 1px solid black;">: &nbsp; <?php echo $details_fetch[0]->class_name; ?></th>
					  
					</tr>
					  
					  <tr>
					  <th>Date of Birth as recorded in the admission register</th>
					  <th style="border-bottom: 1px solid black;">: &nbsp; <?php echo $birth_date1; ?></th>
					  
					</tr>
					  <tr>
					  <th>(in words)</th>
					  <th style="border-bottom: 1px solid black;">: &nbsp;<?php echo $mont_alpha; ?></th>
					  
					</tr>
					  
					  <tr>
					  <th>Session</th>
					  <th style="border-bottom: 1px solid black;">: &nbsp; <?php echo $school_setting[0]->School_Session; ?></th>
					  
					</tr>
					
				  </table>
				 
				    <div class='col-sm-12 col-xs-12'>
					 
				   <table class='table' >
					<tr>
					  <th width='40%' style="font-style: italic;"><b>Issue Date</b></th>
					  <th width='10%' style="color:white;">:___________________________</th>
					  <td width='50%' style="font-style: italic;"><b>Principal's Signature</b></td>
					  
				    </tr>
					<tr>
					<td><b><?php echo $Issue_DATE1; ?></b></td>
					<th width='10%' style="color:white;">:___________________________</th>
					<td></td>
				</tr>
				  </table>
	            </div>
				<div class='row sign'>
				
	            </div>
				</div>
	   <br>
	  <div style="border:3px solid #000; padding:10px;">
				  <div class="row">
			<div class="col-md-2 col-sm-2 col-lg-2">
				<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="image" style="width:100px;">
			</div>
			<div class="col-md-8 col-lg-8 col-sm-8">
				<center><h5><b style="color:#000;font-weight:bold !important; text-align:center; font-size:22px;"><?php echo $school_setting[0]->School_Name; ?></b></h5>
				<h6 style="color:#000;font-weight:bold !important; text-align:center; font-size:15px;"><?php echo $school_setting[0]->School_Address; ?></h6>
				
				<h6 style="color:#000;font-weight:bold !important; text-align:center; font-size:13px;">Session (<?php echo $school_setting[0]->School_Session; ?>)</h6></center>
			</div>
			<div class="col-md-2 col-sm-2 col-lg-2">
			</div>
		</div>
				  <center><h6><b><div id="content1">PROVISIONAL SCHOOL LEAVING CERTIFICATE</div></b></h6></center>
		   <p style="font-style: italic;">Certificate No. : <?php echo $details_fetch[0]->CERT_NO; ?></p>
		   
				  <table class='table'>
				    
					<tr>	
					  <th width='30%'>Student's Name</th>
					  <th width='70%' style="border-bottom: 1px solid black;">:&nbsp;<?php echo $details_fetch[0]->S_NAME; ?></th>
						        
					  
					</tr>
					
					<tr>
						<th>Mother's Name</th>
						<th style="border-bottom: 1px solid black;">: &nbsp;<?php echo $details_fetch[0]->M_Name; ?></th>
						
					</tr>
					
					<tr>
					  <th>Father's Name</th>
					  <th style="border-bottom: 1px solid black;">: &nbsp;<?php echo $details_fetch[0]->F_NAME; ?></th>
					  
					</tr>
					  
					  <tr>
					  <th width='40%'>Class in which he/she is studying</th>
					  <th width='60%' style="border-bottom: 1px solid black;">: &nbsp; <?php echo $details_fetch[0]->class_name; ?></th>
					  
					</tr>
					  
					  <tr>
					  <th>Date of Birth as recorded in the admission register</th>
					  <th style="border-bottom: 1px solid black;">: &nbsp; <?php echo $birth_date1; ?></th>
					  
					</tr>
					  <tr>
					  <th>(in words)</th>
					  <th style="border-bottom: 1px solid black;">: &nbsp;<?php echo $mont_alpha; ?></th>
					  
					</tr>
					  
					  <tr>
					  <th>Session</th>
					  <th style="border-bottom: 1px solid black;">: &nbsp; <?php echo $school_setting[0]->School_Session; ?></th>
					  
					</tr>
					
				  </table>
				 
				    <div class='col-sm-12 col-xs-12'>
					 
				   <table class='table' >
					<tr>
					  <th width='40%' style="font-style: italic;"><b>Issue Date</b></th>
					  <th width='10%' style="color:white;">:___________________________</th>
					  <td width='50%' style="font-style: italic;"><b>Principal's Signature</b></td>
					  
				    </tr>
					<tr>
					<td><b><?php echo $Issue_DATE1; ?></b></td>
					<th width='10%' style="color:white;">:___________________________</th>
					<td></td>
				</tr>
				  </table>
	            </div>
				<div class='row sign'>
				
	            </div>
				</div>
				  
</body>
  </html>