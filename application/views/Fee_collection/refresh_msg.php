
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
  <br><br><br>
	       <h1 style='text-align:center;color:red;'>Thank you for making a payment !!!!!</h1>
    
<br><br><br><br>
	<div class="row">
		<div class="col-md-12">
			<center>
				<a class="btn btn-danger btn-lg" id="print_cancel" href="<?php echo base_url('Monthly_collection/month_collection'); ?>">BACK</a>
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