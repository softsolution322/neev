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
	<style>
		body {
			marging: 0px !important;
			paddging : 0px !important;
		}
		#image{
			height : 100px;
			width : 100px;
			float : right;
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
		.table td, .table th {
			padding: .75rem;
			vertical-align: top;
			border-top: 0px solid #dee2e6;
		}
		.tbl,.tr,.td{
			font-weight:1em;
		}
		.table td, .table th {
			padding: 8px 0px 0px 0px;
			vertical-align: top;
			border-top: 0px solid #dee2e6;
		}
		@page {
    		size: landscape;   / auto is the initial value /
    		margin-top: -10px;    / this affects the margin in the printer settings /
    		margin-bottom: 0;
    		margin-right: 20px;
    		margin-left: 20px;
		}
		.head{
			font-weight: bold;
		}
		.head_name{
			font-style: italic;
			font-weight:bold;
		}
		.th{
			background-color: #5785c3;
		}
		body{
			font-family: Verdana,Geneva,sans-serif;
			font-size:13px;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
	 <div id="border">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-lg-3">
				<img src="<?php echo base_url($school_setting[0]->SCHOOL_LOGO); ?>" id="image">
			</div>
			<div class="col-md-7 col-lg-7 col-sm-7">
				<center><h3><?php echo $school_setting[0]->School_Name; ?></h3></center>
				<center><h5><?php echo $school_setting[0]->School_Address; ?></h5></center>
				<center><h6>SESSION (<?php echo $school_setting[0]->School_Session; ?>)</h6></center>
			</div>
			<div class="col-md-2 col-sm-2 col-lg-2">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-lg-3">
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6">
				<div id="content"><center><b>STUDENT STRENGTH</b></center></div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3">
			</div>
		</div><br />
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
	<table width="100%">
		<tr>
			<td><center><b>Class-Section Wise Student Strength Report</b></center></td>
		</tr>
	</table><br />
		<table width="100%" border="1">
			<thead>
				<tr>
					<th rowspan='2' class='th'>Class/sec</th>
					<th class='th'>Total</th>
					<th colspan='2' class='th'><center>Gender</center></th>
					<th colspan='6' class='th'><center>Category</center></th>
					<th colspan='6' class='th'><center>Ward</center></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th></th>
					<th></th>
					<th>Boys</th>
					<th>Girls</th>
					<th><?php echo $cat[0]->CAT_ABBR; ?></th>
					<th><?php echo $cat[1]->CAT_ABBR; ?></th>
					<th><?php echo $cat[2]->CAT_ABBR; ?></th>
					<th><?php echo $cat[3]->CAT_ABBR; ?></th>
					<th><?php echo $cat[4]->CAT_ABBR; ?></th>
					<th><?php echo $cat[5]->CAT_ABBR; ?></th>
					<th><?php echo $wardd[0]->HOUSENAME; ?></th>
					<th><?php echo $wardd[1]->HOUSENAME; ?></th>
					<th><?php echo $wardd[2]->HOUSENAME; ?></th>
					<th><?php echo $wardd[3]->HOUSENAME; ?></th>
					<th><?php echo $wardd[4]->HOUSENAME; ?></th>
					<th><?php echo $wardd[5]->HOUSENAME; ?></th>
				</tr>
					<?php
						$total = 0;
						$male = 0;
						$female = 0;
						$cat1 = 0;
						$cat2 = 0;
						$cat3 = 0;
						$cat4 = 0;
						$cat5 = 0;
						$cat6 = 0;
						$ward1 = 0;
						$ward2 = 0;
						$ward3 = 0;
						$ward4 = 0;
						$ward5 = 0;
						$ward6 = 0;
						foreach($all_data as $key => $value){
							if($value->DISP_CLASS == null){
								
							}else{
								?>
								<tr>
								<td><?php echo $value->DISP_CLASS."/".$value->DISP_SEC; ?></td>
								<td><?php echo $value->TOTALSTUDENT; ?></td>
								<td><?php echo $value->MALE; ?></td>
								<td><?php echo $value->FEMALE; ?></td>
								<td><?php echo $value->CAT1; ?></td>
								<td><?php echo $value->CAT2; ?></td>
								<td><?php echo $value->CAT3; ?></td>
								<td><?php echo $value->CAT4; ?></td>
								<td><?php echo $value->CAT5; ?></td>
								<td><?php echo $value->CAT6; ?></td>
								<td><?php echo $value->WARD1; ?></td>
								<td><?php echo $value->WARD2; ?></td>
								<td><?php echo $value->WARD3; ?></td>
								<td><?php echo $value->WARD4; ?></td>
								<td><?php echo $value->WARD5; ?></td>
								<td><?php echo $value->WARD6; ?></td>
								</tr>
								<?php
								$total +=$value->TOTALSTUDENT;
							$male += $value->MALE;
							$female += $value->FEMALE;
							$cat1 += $value->CAT1;
							$cat2 += $value->CAT2;
							$cat3 += $value->CAT3;
							$cat4 += $value->CAT4;
							$cat5 += $value->CAT5;
							$cat6 += $value->CAT6;
							$ward1 += $value->WARD1;
							$ward2 += $value->WARD2;
							$ward3 += $value->WARD3;
							$ward4 += $value->WARD4;
							$ward5 += $value->WARD5;
							$ward6 += $value->WARD6;
							}
							?>
							
							<?php
						}
					?>
				<tr>
					<td>Total Strength</td>
					<td><?php echo $total; ?></td>
					<td><?php echo $male; ?></td>
					<td><?php echo $female; ?></td>
					<td><?php echo $cat1; ?></td>
					<td><?php echo $cat2; ?></td>
					<td><?php echo $cat3; ?></td>
					<td><?php echo $cat4; ?></td>
					<td><?php echo $cat5; ?></td>
					<td><?php echo $cat6; ?></td>
					<td><?php echo $ward1; ?></td>
					<td><?php echo $ward2; ?></td>
					<td><?php echo $ward3; ?></td>
					<td><?php echo $ward4; ?></td>
					<td><?php echo $ward5; ?></td>
					<td><?php echo $ward6; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
	 </div><br />
	 <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<center><button class="btn btn-primary" id="printing_button" onclick="printl()"><i class="fa fa-print"></i>&nbsp;PRINT</button>&nbsp;<a class="btn btn-danger" id="print_cancel" href="<?php echo base_url('Student_strength/show_strenght'); ?>">BACK</a></center>
		</div>
	 </div><br /><br />
	</div>
	<script type="text/javascript">
		function printl()
		{
			var printButton = document.getElementById("printing_button");
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