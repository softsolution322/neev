<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Date of Birth Certificate</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<form id="form">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-lg-4 form-group">
				<label>Admission No.</label>
				<input type="text" class="form-control" id="adm_no" name="adm_no" autocomplete="off" required>
			</div>             
			<div class="col-md-4 col-sm-4 col-lg-4 form-group">
				<label>Certificate No.</label>
				<input type="text" value="<?php echo $dbo; ?>" class="form-control" id="tcn" name="tcn" readonly>
			</div>             
			<div class="col-md-2 col-sm-2 col-lg-2">
			<br />
				<button class='btn btn-success btn-sm'>SUBMIT</button>
			</div>
			<div class="col-md-2 col-sm-2 col-lg-2">
				<br />
				<p class="btn btn-success btn-sm" onclick="show_all()">Show All Certificate</P>
			</div>
			<div class="col-md-12 col-sm-12 col-lg-12">
			<a class="btn btn-danger pull-right" id="print_cancel" href="<?php echo base_url('Student_report/certificate_master'); ?>">BACK</a></center>
			</div>
		</div>
	</form>
	<div id="load_data"></div>
</div><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
<script>
	$("#form").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
		url: "<?php echo base_url('Date_of_birth_certificate/birth_fetch_details'); ?>",
		type: "POST",
		data: $("#form").serialize(),
		success: function(data){
			var user = JSON.parse(data);
			var data_cnt = user[0];
			if(data_cnt == 1){
				var chk_details = user[1];
				if(chk_details == 1){
					var adm_no = user[2];
					if( confirm("Date Of Birth Certificate Alredy Generated Want To Re-Print") ){
						window.location="<?php echo base_url('Date_of_birth_certificate/re_print_dob/'); ?>"+adm_no;
					}
				}
				else{
					$.ajax({
						url: "<?php echo base_url('Date_of_birth_certificate/re_dob_data'); ?>",
						type: "POST",
						data : $("#form").serialize(),
						success:function(data){
							$("#load_data").html(data);
						},
					});
				}
			}
			else{
				alert("Sorry No Data Found !");
			}
		},
		error : function(handel){
			alert("data No Found");
		},
	});
 });
 
function show_all(){
	var adm = $('#adm_no').val();
	$.ajax({
		url: "<?php echo base_url('Date_of_birth_certificate/show_all_bona_details'); ?>",
		type: "POST",
		data: {adm:adm},
		success:function(data){
			$('#load_data').html(data);
		},
	});
 }
</script>