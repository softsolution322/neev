<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Add Student</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 10px; background-color: white">
		<div class="row">
				<div class="col-md-12">
					<?php
					   if($this->session->flashdata('msg')){
					   	?>
					   	<div class="alert alert-success" role="alert" id="msg" style="padding: 6px 0px;">
			  				<center><strong><?php echo $this->session->flashdata('msg'); ?></strong></center>
						</div>
					   	<?php
					   }
					?>
				</div>
			</div>
        <div class='col-sm-12'>		
		  <a href="<?php echo base_url('Student_details/Scholarship'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
        </div>
		 <form action="<?php echo htmlspecialchars(base_url('Student_details/save_scholarship')); ?>" method="post" onsubmit="return validation()">
		   <table class="table table-bordered" id="class_table" style="border-top:3px solid #5785c3;">
			<tr>
			  <td class="text-center"><b>Admission No.</b></td>
			  <td><input type="text" name="adm_no" id="adm_no" class="form-control" oninput="dataswap(this.value)" autocomplete="off"></td>
			</tr>
			<tr>
				<td colspan="2"><center><input type="reset" name="reset" value="RESET" class="btn" style="background-color:#FF5733;"></center></td>
			</tr>
		  </table>
		  <br /><br />
		   <!-- <div id="pageloader">
		   </div> -->
		   <div class="form-group col-md-4">
            <label>Admission No.</label>
            <input type="text" name="admission" id="admission" class="form-control" readonly="true">
           </div>
           <div class="form-group col-md-4">
           	 <label>Name</label>
           	 <input type="text" name="name" id="name" class="form-control" readonly="true">
           </div>
           <div class="form-group col-md-4">
           	<label>Roll No.</label>
           	<input type="text" name="roll" id="roll" class="form-control" readonly="true">
           </div>
           <div class="form-group col-md-4">
           	<label>Class/Sec</label>
           	<input type="text" name="clssec" id="clssec" class="form-control" readonly="true">
           </div>
           <div class="form-group col-md-4">
           	 <label>Scholarship Apply From</label>
           	 <select class="form-control" id="saf" name="saf" disabled>
           	 	<option value="">Select Month</option>
           	 	<?php
           	 	if($month)
           	 	{
           	 		foreach($month as $month_data)
           	 		{
           	 			?>
           	 			<option value="<?php echo $month_data->month_name; ?>"><?php echo $month_data->month_name; ?></option>
           	 			<?php
           	 		}
           	 	}
           	 	?>
           	 </select>
           </div>
           <div class="form-group col-md-4">
           	 <label>Scholarship Given By</label>
           	 <select class="form-control" name="sgb" id="sgb" disabled>
           	 	<option value="">Select</option>
				<option value="Management">Management</option>
				<option value="Land Doner">Land Doner</option>
				<option value="Others">Others</option>
			</select>
           </div>
           <hr style="border: .5px solid black;">
           <div class="row">
           	 <div class="col-md-12">
           	 	Fee-Head Details In ( <span style='font-size:20px;'>&#8377;</span> )
           	 </div>
           </div><br />
		   <?php
			if($feehead){
				$v =0;
				foreach($feehead as $key=>$value){
					$v = $key+1;
					if($value->FEE_HEAD!="" && $value->FEE_HEAD!="-"){
						?>
							<div class="form-group col-md-3">
								<label><?php echo $value->FEE_HEAD; ?></label>
								<input type="text" value='0' class="form-control" name="feehead<?php echo $v; ?>" id="feehead<?php echo $v; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode==46' placeholder="Amount" disabled style="text-align: right;" autocomplete="off">
							</div>
						<?php
					}
					else{
						?>
						<input type="hidden" value='0' class="form-control" name="feehead<?php echo $v; ?>" id="feehead<?php echo $v; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode==46' placeholder="Amount" disabled style="text-align: right;" autocomplete="off">
						<?php
					}
				}
			}
		   ?>
           
		<div class="form-group col-md-9">
			<br />
			<center><input type="submit" name="submit" id="submit" value="SAVE" class="btn btn-success" disabled="true"></center>
		</div>
		  </form>
</div><br /><br />
		
		 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p id="first"></p>
          <p id="second"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <div class="clearfix"></div><br />
<!-- script-for sticky-nav -->
		<script>
			function dataswap(val)
			{
			  $.ajax({
			  	url:"<?php echo base_url(); ?>Student_details/Scholarship_add",
					type: "POST",
					data: {value:val},
					success: function(data){
						var user = JSON.parse(data);
						if(user[1]==1)
						{
							    $('#myModal').modal();
								$('#myModal').find('.modal-header').css({"color":"red","text-align":"center","font-size":"30px"});
								$('#myModal').find('.modal-header').html("Warning !");
								$('#myModal').find('.modal-body').html("This Student Already Facilitate For Scholarship.");
								//$('#adm_no option[value=""]').prop('selected',true);
								$('#adm_no').val("");
								$('#saf option[value=""]').prop('selected',true);
								$('#sgb option[value=""]').prop('selected',true);
								$("#admission").val("0");
								$("#name").val("0");
								$("#roll").val("0");
								$("#clssec").val("0");
								$("#feehead1").val("0");
								$("#feehead2").val("0");
								$("#feehead3").val("0");
								$("#feehead4").val("0");
								$("#feehead5").val("0");
								$("#feehead6").val("0");
								$("#feehead7").val("0");
								$("#feehead8").val("0");
								$("#feehead9").val("0");
								$("#feehead10").val("0");
								$("#feehead11").val("0");
								$("#feehead12").val("0");
								$("#feehead13").val("0");
								$("#feehead14").val("0");
								$("#feehead15").val("0");
								$("#feehead16").val("0");
								$("#feehead17").val("0");
								$("#feehead18").val("0");
								$("#feehead19").val("0");
								$("#feehead20").val("0");
								$("#feehead21").val("0");
								$("#feehead22").val("0");
								$("#feehead23").val("0");
								$("#feehead23").val("0");
								$("#feehead24").val("0");
								$("#feehead25").val("0");
								$("#saf").prop('disabled',true);
								$("#sgb").prop('disabled',true);
								$("#feehead1").prop('disabled',true);
								$("#feehead2").prop('disabled',true);
								$("#feehead3").prop('disabled',true);
								$("#feehead4").prop('disabled',true);
								$("#feehead5").prop('disabled',true);
								$("#feehead6").prop('disabled',true);
								$("#feehead7").prop('disabled',true);
								$("#feehead8").prop('disabled',true);
								$("#feehead9").prop('disabled',true);
								$("#feehead10").prop('disabled',true);
								$("#feehead11").prop('disabled',true);
								$("#feehead12").prop('disabled',true);
								$("#feehead13").prop('disabled',true);
								$("#feehead14").prop('disabled',true);
								$("#feehead15").prop('disabled',true);
								$("#feehead16").prop('disabled',true);
								$("#feehead17").prop('disabled',true);
								$("#feehead18").prop('disabled',true);
								$("#feehead19").prop('disabled',true);
								$("#feehead20").prop('disabled',true);
								$("#feehead21").prop('disabled',true);
								$("#feehead22").prop('disabled',true);
								$("#feehead23").prop('disabled',true);
								$("#feehead23").prop('disabled',true);
								$("#feehead24").prop('disabled',true);
								$("#feehead25").prop('disabled',true);
								$("#submit").prop('disabled',true);
						}
						else
						{
							$("#admission").val(user[0]);
							$("#name").val(user[2]);
							$("#roll").val(user[4]);
							$("#clssec").val(user[3]);
							$("#saf").prop('disabled',false);
							$("#sgb").prop('disabled',false);
							$("#feehead1").prop('disabled',false);
							$("#feehead2").prop('disabled',false);
							$("#feehead3").prop('disabled',false);
							$("#feehead4").prop('disabled',false);
							$("#feehead5").prop('disabled',false);
							$("#feehead6").prop('disabled',false);
							$("#feehead7").prop('disabled',false);
							$("#feehead8").prop('disabled',false);
							$("#feehead9").prop('disabled',false);
							$("#feehead10").prop('disabled',false);
							$("#feehead11").prop('disabled',false);
							$("#feehead12").prop('disabled',false);
							$("#feehead13").prop('disabled',false);
							$("#feehead14").prop('disabled',false);
							$("#feehead15").prop('disabled',false);
							$("#feehead16").prop('disabled',false);
							$("#feehead17").prop('disabled',false);
							$("#feehead18").prop('disabled',false);
							$("#feehead19").prop('disabled',false);
							$("#feehead20").prop('disabled',false);
							$("#feehead21").prop('disabled',false);
							$("#feehead22").prop('disabled',false);
							$("#feehead23").prop('disabled',false);
							$("#feehead23").prop('disabled',false);
							$("#feehead24").prop('disabled',false);
							$("#feehead25").prop('disabled',false);
							$("#submit").prop('disabled',false);
						}
					}
			  });
			}

			function validation()
			{
				var saf = document.getElementById('saf').selectedIndex;
				var sgb = document.getElementById('sgb').selectedIndex;
				if(saf!="" && sgb!="")
				{
					return true;
				}
				else
				{
					$('#myModal').modal();
					$('#myModal').find('.modal-header').css({"color":"red","text-align":"center","font-size":"30px"});
					$('#myModal').find('.modal-header').html("Warning !");
					$('#myModal').find('.modal-body').html("Please Select Scholarship Apply From And Scholarship Given By");
					document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
					return false;
				}

			}
		</script>
<div class="inner-block">

</div>