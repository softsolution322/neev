<?php
	error_reporting(0);
	if($details_fetch){
		$Birth_Date = $details_fetch[0]->Birth_Date;
		$Birth_Date1 = date('d-M-Y',strtotime($Birth_Date));
	}
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
	<style  media="print">
		body {
			margin: 0px !important;
			padding : 0px !important;
		}
		#border{
			width:100%;
			height: 100%;
			padding : 5px 20px 0px 20px;
			border : solid 3px black;
		}
		#image{
			position:absolute;
			height : 150px;
			width : 150px;
			float : left;
			margin-top:1%;
		}
		#heading{
			float : right;
		}
		#content{
			border: solid 1px black;
			border-radius: 10px;
		}
		.text-content{
			text-align:right;
		}
		
		@page {
    		size: auto;  
    		margin-top: -10px;   
    		margin-bottom: 0;
    		margin-right: 20px;
    		margin-left: 20px;
		}
		.f-s{
			font-size: 26px;
		}
	</style>
</head>
<body>
	</br></br>
	<div class="container-fluid">
	 <div id="border">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-lg-3">
				<img src="<?php echo base_url($school_setting[0]->SCHOOL_LOGO); ?>" id="image">
			</div>
			<div class="col-md-7 col-lg-7 col-sm-7">
	</br>
				<center><h5><b><?php echo $school_setting[0]->School_Name; ?></b></h5></center>
				<center><h6><?php echo $school_setting[0]->School_Address; ?></h6></center>
				<center><h6>Affillated to <?php echo $school_setting[0]->board; ?>, New Delhi (Aff No. :<?php echo $school_setting[0]->School_AfftNo; ?>, School Code: <?php echo $school_setting[0]->School_Code; ?>)Session (<?php echo $school_setting[0]->School_Session; ?>)</h6></center></br></br>
				<!-- <center><h6>Session (<?php echo $school_setting[0]->School_Session; ?>)</h6></center> -->
			</div>
			<div class="col-md-2 col-sm-2 col-lg-2">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-lg-3">
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6">
				<div id="content"><center><b>DATE OF BIRTH CERTIFICATE</b></center></div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3">
			</div>
		</div><br /><br />
		<center><h3><u>TO WHOMSOEVER IT MAY CONCERN</u></h3></center>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<b><i>Certificate No</i>.:- <?php echo $details_fetch[0]->CERT_NO; ?></b>
			</div>
		</div><br />
		<table class="table">
			<!-- <tr>
				<td class="f-s"><p><center><b><i>This is to certify that Date of Birth of Master/Miss </i> <u><?php echo $details_fetch[0]->S_NAME; ?></u></b></center></p></td>
			</tr>
			<tr>
				<td class="f-s"><center><b><i>S/O/D/O</i> &nbsp; <u><?php echo $details_fetch[0]->F_NAME; ?></u></b>&nbsp;<b> & </b>&nbsp; <u><b><?php echo $details_fetch[0]->M_Name; ?></b></u></center></td>
			</tr>
			<tr>
				<td class="f-s"><center><b><i>Admission No.:</i> &nbsp; <u><?php echo $details_fetch[0]->ADM_NO; ?></u></b>&nbsp;<b>, Class </b>&nbsp; <u><b><?php echo $details_fetch[0]->class_name; ?></b></u>&nbsp;<b><i>is </i></b>&nbsp;&nbsp;<u><b><?php echo $Birth_Date1; ?></b></u></center></td>
			</tr>
			<tr>
				<td class="f-s"><center><b><i>as per our School Admission Register.</i></b></center></td>
			</tr> -->
			<!--<tr>
				<td class="f-s"><center><b><i>To the best of my knowledge he/she bears a Good moral character. </i> </b></center></td>
			</tr>
			<tr>
				<td class="f-s"><center><b><i>I wish him/her every success in life. </i> </b></center></td>
			</tr>-->

			<p class="justified" style= font-size:22px>This is to certify that Master/Miss :&nbsp; <b><u><?php echo $details_fetch[0]->S_NAME; ?></u></b>&nbsp;&nbsp;&nbsp;S/O/D/O : &nbsp;&nbsp;<b> <u><?php echo $details_fetch[0]->F_NAME; ?></u></b>&nbsp;&nbsp;<b> & </b>&nbsp;&nbsp; <u><b><?php echo $details_fetch[0]->M_Name; ?></b></u>&nbsp;&nbsp; Admission No.: &nbsp;<b><u><?php echo $details_fetch[0]->ADM_NO; ?></u></b>&nbsp;&nbsp;, Class &nbsp; <u><b><?php echo $details_fetch[0]->class_name; ?></b></u>&nbsp;&nbsp;<i>is </i>&nbsp;&nbsp;<u><b><?php echo $Birth_Date1; ?></b></u>&nbsp;&nbsp;as per our School Admission Register.</p>


		</table><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<div class="row">
			<table width="100%">
				<tr>
					<td><center><b>Issue Date</b></center></td>
					<td><center><b>Dealing Clerk <br /> Signature</b></center></td>
					<td><center><b>Principal <br /> Signature</b></center></td>
				</tr>
			</table>
		</div>
	 </div><br />
	 <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<center><button class="btn btn-primary" id="printing_button" onclick="printl()"><i class="fa fa-print"></i>&nbsp;PRINT</button>&nbsp;<a class="btn btn-danger" id="print_cancel" href="<?php echo base_url('Date_of_birth_certificate/show_dob'); ?>">BACK</a></center>
		</div>
	 </div><br /><br />
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
        function disableBack() { window.history.forward() }
        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    });
	</script>
</body>
</html>