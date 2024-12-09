<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">List of Driver</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="loader" style="display:none;"></div>
<style>
	 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
	  {
		color: black;
	  }
	  /* The container */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: grey;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #4CAF50;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  margin: 0px auto;
  z-index:999;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
<form id="data_id">
	<div class='row'>
		<!--<div class='col-md-3 form-group'>
			<fieldset>
				<legend id='dm'>Display Mode</legend>
				<label class="container">All
				  <input type="radio" value='1'  name='disp_mode' id='all'>
				  <span class="checkmark"></span>
				</label>
				<label class="container">Bus No Wise
				  <input type="radio" value='2' onclick="bnww()" id='bnw' name='disp_mode'>
				  <span class="checkmark"></span>
				</label>
			</fieldset>
		</div>-->
		<div class="col-md-6">
			<fieldset>
				<legend><span id='class1'>Bus No</legend>
				<div class='row'>
					<div class='col-md-12'>
						<select class='form-control' name='bnw' id='bnw' >
							<option value='%'>All Bus</option>
							<?php
								if($busnomaster)
								{
									foreach($busnomaster as $value)
									{
										?>
											<option value='<?php echo $value->BusCode; ?>'><?php echo $value->BusNo; ?></option>
										<?php
									}
								}
							?>
						</select>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="col-md-6">
			<fieldset>
				<legend><span id='class1'>Select Trip</legend>
				<select class='form-control' id='trip' name='trip'>
					<option value="%">All Trip</option>
					<?php
						foreach($trip as $key=>$tripvalue){
							?>
								<option value='<?php echo $tripvalue->Trip_ID; ?>'><?php echo $tripvalue->Trip_Nm; ?></option>
							<?php
						}
					?>
				</select>
			</fieldset>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
			<center><button class='btn btn-success btn-sm'>Display</button></center>
		</div>
	</div>
</form>
<div id="load_data" class='col-md-12 col-sm-12'>
</div>
</div><br />
<!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />-->
<script>
$("#data_id").on("submit", function (event) {
event.preventDefault();
	// var all = $('#all').val();
	// var bnw = $('#bnw').val();
	//if( $('#all').is(":checked") || $('#bnw').is(":checked") ){
		//if( $('#all').is(":checked") ){
			//$('#dm').css("color","black");
			//=======================//
				$.ajax({
					url : "<?php echo base_url('TransportReport/Transportreport/all_details'); ?>",
					type: "POST",
					data: $('#data_id').serialize(),
					beforeSend:function(){
						$('.loader').show();
						$('body').css('opacity', '0.5');
					},
					success: function(data){
						$('.loader').hide();
						$('body').css('opacity', '1.0');
						//alert(data);
						$("#load_data").html(data);
					},
				});
		//}
		// else if($('#bnw').is(":checked")){
			// $('#dm').css("color","black");
				// $.ajax({
					// url : "<?php echo base_url('TransportReport/Transportreport/busnowise'); ?>",
					// type: "POST",
					// data: $('#data_id').serialize(),
					// beforeSend:function(){
						// $('.loader').show();
						// $('body').css('opacity', '0.5');
					// },
					// success: function(data){
						// $('.loader').hide();
						// $('body').css('opacity', '1.0');
						//alert(data);
						// $("#load_data").html(data);
					// },
				// });
		// }
	// }
	// else
	// {
		// $('#dm').css("color","red");
	// }
});
</script>