<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Student Route Allocation</a> <i class="fa fa-angle-right"></i> Assign Route</li>
</ol>
<div style="padding-left: 25px; background-color: white;padding-top: 5px;padding-top: 20px;">
<?php
	if($this->session->flashdata('msg')):
?>
	<div class="alert alert-success" role="alert" id="msg">
		<strong><?php echo $this->session->flashdata('msg'); ?></strong>
	</div>  
<?php endif; ?>	
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-4">
              <form role="form" action="<?php echo base_url('Add_bus_route/savedata'); ?>" method="post" id="createForm">
                <div class="box box-primary">
                  <div class="box-header with-border" style="background-color:#5785c3; color:white;">
                    <p class="box-title" style="font-weight: bold;"><center>Assign Route Stoppage Wise</center></p>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                          <div class="form-group">
                            <label class="control-label">Select Vehicle No.</label><span class="req"> *</span>
                            <select class="form-control" name="vehicleno" id="vehicleno" onchange="gettripmaster()" required="true">
                              <option value="">Select</option>
                              <?php foreach ($busnomaster as $key => $value) {
									if($value->BusNo != '-'){
									?>
									<option value="<?php echo $value->BusCode; ?>"><?php echo $value->BusNo; ?></option>
									<?php									
									}
									
							  ?>
                                
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Select Trip</label><span class="req"> *</span>
                            <select class="form-control" name="trip_id" id="tripid" required onchange="getpreference()">
								
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Select Preference</label><span class="req"> *</span>
                            <select class="form-control" name="preference" id="preference" onchange="GetStoppage()" required="true">
                              
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Select Stoppage</label><span class="req"> *</span>
                            <select class="form-control" onchange="getAllDetails()" name="stoppage" id="stoppage" required="true">
                              
                            </select>
                          </div>

                          
                        </div>
                      </div>
              </form>
            </div>
            <div class="col-sm-8">
                <div class="box box-primary">
                  <div class="box-header with-border" style="background-color:#5785c3; color:white;">
					<p class="box-title" style="font-weight: bold;"><center>Bus Capacity: <span id='bc'>0</span>,&nbsp; Student Alloted: <span id='sall'>0</span></center></p>
                  </div>
                  <!-- /.box-header -->
				  <form id="form">
                  <div class="box-body" id="getdata">
                    
					
                  </div>
				  <input type="hidden" name="route_id" id="route_id">
				  </form>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>

      </div>
    </div>
  </div>
</div><br>
<script type="text/javascript">
	$(document).ready(function(){
		load_data();
	});
	function load_data()
	{
		var trip_id = $("#tripid").val();
		var vehicleno = $('#vehicleno').val();
		var preference = $('#preference').val();
		var stoppage = $('#stoppage').val();
		$.ajax({
			url:"<?php echo base_url('Studentrouteallocation/load_data'); ?>",
			method:"POST",
			data:{vehicleno:vehicleno,trip_id:trip_id,preference:preference,stoppage:stoppage},
			success:function(data){
				$('#getdata').html(data);
			}
		});
	}
function gettripmaster(){
	var vehicleno = $('#vehicleno').val();
	var div_data = '<option value="">Select</option>';
  if(vehicleno != '')
  {
    $.ajax({
      url:'<?php echo base_url('Studentrouteallocation/gettripid'); ?>',
      data:{vehicleno:vehicleno},
      method:"post",
      dataType:"json",
      success:function(response)
      {
		  $("#bc").text(response[0]);
        $.each(response[1], function(key,val){
          div_data += '<option value="'+val.Trip_ID+'">'+val.Trip_Nm+'</option>';
        });
        $('#tripid').html(div_data);
      }
    }); 
  }
  else
  {
    $('#tripid').html(div_data);
  }
}
function getpreference(){
	var trip_id = $("#tripid").val();
	var vehicleno = $('#vehicleno').val();
	if(trip_id != ''){
		$.ajax({
		  url:'<?php echo base_url('Studentrouteallocation/getpreference'); ?>',
		  data:{vehicleno:vehicleno,trip_id:trip_id},
		  method:"post",
		  success:function(response)
		  {
			 $("#preference").html(response);
		  }
		});
		
	}else{
	}
}
function GetStoppage(){
	var trip_id = $("#tripid").val();
	var vehicleno = $('#vehicleno').val();
	var preference = $('#preference').val();
	var div_data = '<option value="">Select</option>';
	if(trip_id != ''){
		$.ajax({
		  url:'<?php echo base_url('Studentrouteallocation/GetStoppage'); ?>',
		  data:{vehicleno:vehicleno,trip_id:trip_id,preference:preference},
		  method:"post",
		  dataType:"JSON",
		  success:function(response)
		  {
			 $.each(response, function(key,val){
				div_data += '<option value="'+val.STOPNO+'">'+val.STOPPAGE+'</option>';
			});
			$('#stoppage').html(div_data);
		  }
		});
		
	}else{
	}
}
function getAllDetails(){
	var trip_id = $("#tripid").val();
	var vehicleno = $('#vehicleno').val();
	var preference = $('#preference').val();
	var stoppage = $('#stoppage').val();
	if(stoppage != ''){
		$.ajax({
		  url:'<?php echo base_url('Studentrouteallocation/getAllDetails'); ?>',
		  data:{vehicleno:vehicleno,trip_id:trip_id,preference:preference,stoppage:stoppage},
		  method:"post",
		  dataType:"JSON",
		  success:function(response)
		  {
			$("#sall").text(response[1]);
			$("#route_id").val(response[0]);
			load_data();
		  }
		});
		
	}else{
	}
	
}
$("#form").on("submit", function (event) {
    event.preventDefault();
	if($(".viewCheck").is(':checked')){
		$.ajax({
		url:"<?php echo base_url('Studentrouteallocation/save_data'); ?>",
		method:"POST",
		data:new FormData(this),
		contentType:false,
		cache:false,
		processData:false,
		beforeSend:function(){
			showLoader();
		},
		success:function(data){
			hideLoader();
			//$('#file').val('');
			load_data();
			alert(data);
		}
	})
	}
	else{
		alert("Please Select Student for Route Allocation");
	}
 });
</script>