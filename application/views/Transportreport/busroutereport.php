<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Bus Route Report</a> <i class="fa fa-angle-right"></i></li>
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
	<div class="row">
		<form id="form">
			<div class="col-md-4 col-sm-4 form-group">
				<label>Select Vehicle No</label>
				<select class="form-control" onchange="Gettrip()" required name="vehicleno" id="vehicleno">
					<option value="">select</option>
					<?php
						foreach($stoppage as $key=>$value){
							?>
							<option value="<?php echo $value->BusCode; ?>"><?php echo $value->BusNo; ?></option>
							<?php
						}
					?>
				</select>
			</div>
			<div class="col-md-4 col-sm-4 form-group">
				<label>Select Trip No</label>
				<select class="form-control" onchange='GetPrefrence()' required name="trip" id="trip">
					
				</select>
			</div>
			<div class="col-md-4 col-sm-4 form-group">
				<label>Select Prefrence</label>
				<select class="form-control" onchange="Getfindata()" required name="prefrence" id="prefrence">
					
				</select>
			</div>
			<!--<div class="col-md-3 col-sm-3 form-group">
				<br>
				<input type='submit' class='btn btn-success'>
			</div>-->
			<div class='row'>
				<div id="getdata" class='col-md-12 col-sm-12'>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$(document).ready(function() {
	load_data();
	
});
function load_data(){
	var vehicleno = $("#vehicleno").val();
	var trip = $("#trip").val();
	var prefrence = $("#prefrence").val();
	$.ajax({
		url:"<?php echo base_url('TransportReport/Busroutereport/load_data'); ?>",
		method:"POST",
		data:{vehicleno:vehicleno,trip:trip,prefrence:prefrence},
		success:function(data){
			//alert(data);
			$('#getdata').html(data);
		}
	});
}
function Gettrip(){
	var vehicleno = $('#vehicleno').val();
	var div_data = '<option value="">Select</option>';
  if(vehicleno != '')
  {
    $.ajax({
      url:'<?php echo base_url('TransportReport/Busroutereport/gettripid'); ?>',
      data:{vehicleno:vehicleno},
      method:"post",
      dataType:"json",
      success:function(response)
      {
		  $("#bc").text(response);
        $.each(response, function(key,val){
          div_data += '<option value="'+val.Trip_ID+'">'+val.Trip_Nm+'</option>';
        });
        $('#trip').html(div_data);
		load_data();
      }
    }); 
  }
  else
  {
    $('#trip').html(div_data);
  }
}
function GetPrefrence(){
	var vehicleno = $('#vehicleno').val();
	var trip = $('#trip').val();
	var div_data = '<option value="">Select</option>';
  if(vehicleno != '')
  {
    $.ajax({
      url:'<?php echo base_url('TransportReport/Busroutereport/getpreference'); ?>',
      data:{vehicleno:vehicleno,trip:trip},
      method:"post",
      //dataType:"json",
      success:function(response)
      {
        $('#prefrence').html(response);
		load_data();
      }
    }); 
  }
  else
  {
    $('#prefrence').html(response);
  }
}
function Getfindata(){
	load_data();
}
</script>