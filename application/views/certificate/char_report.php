<?php
error_reporting(0);
if ($details_fetch) {
	$Adm_Date = $details_fetch[0]->Adm_Date;
	$End_DATE = $details_fetch[0]->End_DATE;
	$adm_date1 = date('d-M-Y', strtotime($Adm_Date));
	$End_DATE1 = date('d-M-Y', strtotime($End_DATE));
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
	<style media="print">
		body {
			margin: 0px !important;
			padding: 0px !important;
		}

		#border {
			width: 100%;
			height: 100%;
			padding: 5px 20px 0px 20px;
			border: solid 3px black;
		}

		#image {
			position: absolute;
			height: 150px;
			width: 150px;
			float: left;
			margin-top: 3%;
		}

		#heading {
			float: right;
		}

		#content {
			border: solid 1px black;
			border-radius: 10px;
		}

		.text-content {
			text-align: right;
		}

		@page {
			size: 'A4';
			margin-top: -1px;
			margin-bottom: 0;
			margin-right: 20px;
			margin-left: 20px;
		}

		.f-s {
			font-size: 26px;
		}

		.justified {
			text-align: justify;
		}
	</style>
</head>

<body>
	</br>
	<div class="container-fluid">
		<div id="border">
			<div class="row">
			<table style="width: 100%; padding: 0px !important;">
				<tr>
					<td style="width: 10%;" rowspan="2">
						<center>
							<img src="<?php echo base_url('assets/school_logo/1564835888.jpg'); ?>" id="image" style="width:150px;margin-left:50px;">
						</center>
					</td>
					<td style="width: 80%;text-align:center">
						<b style="color:#000;font-weight:bold !important; text-align:center; font-size:36px;"><?php echo $school_setting[0]->School_Name; ?></b>

					</td>
					<td style="width: 10%;"></td>
				</tr>
				<tr>
					<td style="width: 80%;text-align:center">
						<h6 style="color:#000;font-weight:bold !important; text-align:center; font-size:24px;"><?php echo $school_setting[0]->School_Address; ?>&nbsp; (<?php echo $school_setting[0]->School_Session; ?>)</h6>
					</td>
					<td style="width: 10%;"></td>
				</tr>
			</table>
		</div>
			</div></br></br>
			<div class="row">
				<div class="col-md-3 col-sm-3 col-lg-3">
				</div>
				<div class="col-md-6 col-sm-6 col-lg-6">
					<div id="content">
						<center><b>CHARACTER CERTIFICATE</b></center>
					</div></br>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3">
				</div>
			</div><br />
			<center>
				<h3><u>TO WHOMSOEVER IT MAY CONCERN</u></h3>
			</center></br>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<b><i>Certificate No</i>.:- <?php echo $details_fetch[0]->CERT_NO; ?></b>
				</div>
			</div><br />
			<table class="table">

				<!-- <p><center>This is to certify that Master/Miss : &nbsp;&nbsp;&nbsp;&nbsp; <b><u><?php echo $details_fetch[0]->S_NAME; ?></u></b></center></p>
			
			
				<p class="f-s"><center>S/O/D/O : &nbsp;&nbsp;&nbsp;&nbsp;<b> <u><?php echo $details_fetch[0]->F_NAME; ?></u></b>&nbsp;&nbsp;<b> & </b>&nbsp;&nbsp; <u><b><?php echo $details_fetch[0]->M_Name; ?></b></u></center></p>
			
		
				<p class="f-s"><center>Admission No.: &nbsp;&nbsp;&nbsp;&nbsp; <b><u><?php echo $details_fetch[0]->ADM_NO; ?></u></b>&nbsp;&nbsp;, Class &nbsp;&nbsp; <u><b><?php echo $details_fetch[0]->class_name; ?></b></u>&nbsp;&nbsp;is a</center></p>
			
			
				<p class="f-s"><center>bonafide student of this school from : &nbsp; <b><u><?php echo $adm_date1; ?></u></b>&nbsp; To &nbsp; <u><b><?php echo $End_DATE1; ?></b></u></center></p>
			
			
				<p class="f-s"><center>To the best of my knowledge he/she bears a Good Moral Character.  </center></p>
			
			
				<p class="f-s"><center><i>I wish him/her every success in life. </i> </center></p>
			 -->
				<p class="justified" style=font-size:22px>This is to certify that Master/Miss :&nbsp; <b><u><?php echo $details_fetch[0]->S_NAME; ?></u></b>&nbsp;&nbsp;&nbsp;S/O/D/O : &nbsp;&nbsp;&nbsp;&nbsp;<b> <u><?php echo $details_fetch[0]->F_NAME; ?></u></b>&nbsp;&nbsp;<b> & </b>&nbsp;&nbsp; <u><b><?php echo $details_fetch[0]->M_Name; ?></b></u>&nbsp;&nbsp; Admission No.: &nbsp;<b><u><?php echo $details_fetch[0]->ADM_NO; ?></u></b>&nbsp;&nbsp;, Class &nbsp; <u><b><?php echo $details_fetch[0]->class_name; ?></b></u>&nbsp;&nbsp;is a bonafide student of this school from : &nbsp; <b><u><?php echo $adm_date1; ?></u></b>&nbsp; To &nbsp; <u><b><?php echo $End_DATE1; ?></b></u>&nbsp;&nbsp;To the best of my knowledge he/she bears a Good Moral Character.&nbsp;&nbsp;<i>I wish him/her every success in life. </i></p>







			</table><br /><br /><br /><br /><br />
			<div class="row">
				<table width="100%">
					<tr>
						<td>
							<center><b>Issue Date</b></center>
						</td>
						<td>
							<center><b>Dealing Clerk <br /> Signature</b></center>
						</td>
						<td>
							<center><b>Principal <br /> Signature</b></center>
						</td>
					</tr>
				</table>
			</div>
		</div><br />
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<center><button class="btn btn-primary" id="printing_button" onclick="printl()"><i class="fa fa-print"></i>&nbsp;PRINT</button>&nbsp;<a class="btn btn-danger" id="print_cancel" href="<?php echo base_url('Certificate/char_show'); ?>">BACK</a></center>
			</div>
		</div><br /><br />
	</div>
	<script type="text/javascript">
		function printl() {
			var printButton = document.getElementById("printing_button");
			var print_cancel = document.getElementById('print_cancel');
			print_cancel.style.visibility = 'hidden';
			printButton.style.visibility = 'hidden';
			window.print();
			printButton.style.visibility = 'visible';
			print_cancel.style.visibility = 'visible';
		}
		$(document).ready(function() {
			function disableBack() {
				window.history.forward()
			}
			window.onload = disableBack();
			window.onpageshow = function(evt) {
				if (evt.persisted) disableBack()
			}

			function preventBack() {
				window.history.forward();
			}
			setTimeout("preventBack()", 0);
			window.onunload = function() {
				null
			};
		});
	</script>
</body>

</html>