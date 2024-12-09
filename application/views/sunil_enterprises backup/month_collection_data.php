<?php
 if($master)
 	{
 		$CounterNo = $master[0]->CounterNo;
		$ReceiptNo = $master[0]->ReceiptNo;
		$add_reciptno = ($ReceiptNo+1);
		$length = strlen($ReceiptNo);
		
			$reciptno = $CounterNo.$ReceiptNo;
		
 	}
 	if($student_data)
 	{
 		$adm_date = $student_data[0]->ADM_DATE;
 		$adm_no = $student_data[0]->ADM_NO;
 		$FIRST_NM = $student_data[0]->FIRST_NM;
 		$STUDENTID = $student_data[0]->STUDENTID;
 		$FATHER_NM = $student_data[0]->FATHER_NM;
 		$MOTHER_NM = $student_data[0]->MOTHER_NM;
 		$DISP_CLASS = $student_data[0]->DISP_CLASS;
 		$DISP_SEC = $student_data[0]->DISP_SEC;
 		$ROLL_NO = $student_data[0]->ROLL_NO;
 		$EMP_WARD = $student_data[0]->HOUSENAME;
 		$STOPNO = $student_data[0]->STOPPAGE;
 		//$STOPNO_AMT = $student_data[0]->AMT;
 		$APR_FEE = $student_data[0]->APR_FEE;
 		$MAY_FEE = $student_data[0]->MAY_FEE;
 		$JUNE_FEE = $student_data[0]->JUNE_FEE;
 		$JULY_FEE = $student_data[0]->JULY_FEE;
 		$AUG_FEE = $student_data[0]->AUG_FEE;
 		$SEP_FEE = $student_data[0]->SEP_FEE;
 		$OCT_FEE = $student_data[0]->OCT_FEE;
 		$NOV_FEE = $student_data[0]->NOV_FEE;
 		$DEC_FEE = $student_data[0]->DEC_FEE;
 		$JAN_FEE = $student_data[0]->JAN_FEE;
 		$FEB_FEE = $student_data[0]->FEB_FEE;
 		$MAR_FEE = $student_data[0]->MAR_FEE;

 		$clssec = $DISP_CLASS."-".$DISP_SEC;


 	}
?>
<form id='student_details'>
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xl-3 form-group">
			<label>Receipt No.</label>
			<input type="text" class="form-control" readonly name="rcpt_no" id="rcpt_no" value="<?php echo $reciptno; ?>">
		</div>
		<div class="col-xs-3 col-md-3 col-lg-3 form-group">
			<label>Receipt Date</label>
			<input type="text" class="form-control" name="date1" id="date1" readonly value="<?php echo date("Y-M-d");?>" required>
		</div>
		<div class="col-md-3 col-sm-3 col-xl-3 form-group">
			<label>Admission Number</label>
			<input type="text" name="adm_no" id="adm_no" readonly class="form-control" value="<?php echo $adm_no; ?>">
		</div>
		<div class="col-md-3 col-xl-3 col-sm-3 form-group">
			<label>Admission Date</label>
			<input type="text" readonly name="adm_date" id="adm_date" value="<?php echo $adm_date; ?>" class="form-control">
		</div>
		<div class="col-xl-3 col-sm-3 col-md-3 form-group">
			<label>Student Name</label>
			<input type="text" name="stu_name" id="stu_name" class="form-control" readonly value="<?php echo $FIRST_NM; ?>">
		</div>
		<div class="col-md-3 col-sm-3 col-md-3 form-group">
			<label>Student Id</label>
			<input type="text" name="stu_id" id="stu_id" class="form-control" readonly value="<?php echo $STUDENTID; ?>">
		</div>
		<div class="col-md-3 col-sm-3 col-xl-3 form-group">
			<label>Father Name</label>
			<input type="text" name="fname" id="fname" class="form-control" readonly value="<?php echo $FATHER_NM; ?>">
		</div>
		<div class="col-xl-3 col-md-3 col-sm-3 form-group">
			<label>Mother Name</label>
			<input type="text" name="mname" id="mname" class="form-control" readonly value="<?php echo $MOTHER_NM; ?>">
		</div>
		<div class="col-sm-3 col-md-3 col-xl-3 form-group">
			<label>Class/Sec</label>
			<input type="text" name="clssec" id="clssec" class="form-control" readonly value="<?php echo $clssec; ?>">
		</div>
		<div class="col-md-3 col-xl-3 col-sm-3 form-group">
			<label>Roll No</label>
			<input type="text" name="roll" id="roll" class="form-control" readonly value="<?php echo $ROLL_NO; ?>">
		</div>
		<div class="col-sm-3 col-md-3 col-md-3 form-group">
			<label>Ward Type</label>
			<input type="text" name="ward_type" id="ward_type" class="form-control" readonly value="<?php echo $EMP_WARD; ?>">
		</div>
		<div class="col-md-3 col-sm-3 col-xl-3 form-group">
			<label>Bus Stoppage Name</label>
			<input type="text" name="bsn" id="bsn" class="form-control" readonly value="<?php echo $STOPNO; ?>">
		</div>
		<!--<div class="col-xl-3 col-md-3 col-sm-3 form-group">
			<label>Bus Stoppage Amount</label>
			<input type="text" name="bsa" id="bsa" class="form-control" readonly value="<?php //echo $STOPNO_AMT; ?>">
		</div>-->
		<div class="col-xs-9 col-md-9 col-lg-9 form-group">
			<label>Fee For</label>
			<input type="text" class="form-control" value="MISL.-SUNIL_ENTERPRISES_SALE" readonly name="fee_for">
		</div>
		<div class="col-sm-3 col-md-3 col-xl-3 form-group">
			<br />
			<span class="btn btn-success" onclick="show_ledger()"><i class="fa fa-circle-o-notch fa-spin" style="display: none;" id="show_details_l"></i>&nbsp;Show Ledger</span>
			<input type="hidden" readonly name="month_count" id="month_count" class="form-control">
		</div>
		
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xl-12">
			<center>
				<button type="submit" class="btn btn-success" onclick='get_payment_details()' id="get_details_pay"><i class="fa fa-circle-o-notch fa-spin" style="display: none;" id="get_details_p"></i>&nbsp;Get Deatils</button>
			</center>
		</div>
	</div><br />
</form>
			<div id="load_calulation">
				
			</div>
<!--</form>-->

<!-- The Modal -->
  <div class="modal fade" id="myleadger">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header" style="background: #5785c3; color: #fff; text-align: center;">
          <h4 class="modal-title">STUDENT LEDGER</h4>
          <!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
        </div>
        <style type="text/css">
        	.table,#thead,tr,td,th
        	{
        		text-align: center;
        		color: #000!important;
        	}
        </style>
        <!-- Modal body -->
        <div class="modal-body">
          <div style="overflow: auto; height: 250px;">
          	<table class="table">
          		<thead id="thead">
          			<tr>
          				<th width="10%">SlNO.</th>
          				<th width="25%">Receipt NO</th>
          				<th width="30%">Receipt Date</th>
          				<th width="20%">Period</th>
          				<th width="15%">Total</th>
          			</tr>
          		</thead>
          		<tbody id="ledger_data">
          			
          		</tbody>
          </table>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

<script type="text/javascript">
	function show_ledger()
	{
		var adm_no = $('#adm_no').val();
		$('#show_details_l').show(1000);
		$.ajax({
	 			url:"<?php echo base_url('Monthly_collection/showledger_monthly_collection'); ?>",
	 			type:"POST",
	 			data:{adm_no:adm_no},
	 			success:function(data)
	 			{
	 				
	 				if(data!="[]")
	 				{
	 					var html = "";
	 					var user = JSON.parse(data);
	 					var i=1;
	 					for(var count=0; count < user.length; count++)
	 					{
		 					html+="<tr>";
		 					html+="<td>"+i+"</td>"
		 					html+="<td>"+user[count].RECT_NO+"</td>";
		 					html+="<td>"+user[count].RECT_DATE+"</td>";
		 					html+="<td>"+user[count].PERIOD+"</td>";
		 					html+="<td>"+user[count].TOTAL+"</td></tr>";
		 					i++;
	 					}
	 					$("#myleadger").modal();
	 					$('#ledger_data').html(html);
						$('#show_details_l').hide(1000);
	 				}
	 				else
	 				{
	 					var html ="";
	 					html+="<tr>";
	 					html+="<td colspan='5'><h3>No Data Found</h3></td>";
	 					html+="</tr>";
	 					$("#myleadger").modal();
	 					$('#ledger_data').html(html);
						$('#show_details_l').hide(1000);
	 				}
	 				
	 			}

	 		});
	}	
	$("#student_details").on("submit", function (event) {
	event.preventDefault();
		$('#get_details_p').show(1000);
		$.ajax({
			url: "<?php echo base_url('Enterprises_calculation/get_pay_details'); ?>",
			type: "POST",
			data: $("#student_details").serialize(),
			success: function(data){
				$('#load_calulation').show(2000);
				$('#load_calulation').html(data);
				$('#get_details_p').hide(1000);
			}
		});
	});
</script>