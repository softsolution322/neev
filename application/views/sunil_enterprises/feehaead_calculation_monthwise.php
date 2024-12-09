<?php
	if(isset($student_data))
	{
		$admission_no = $student_data[0]->ADM_NO;
		$emp_ward = $student_data[0]->EMP_WARD;
		$class = $student_data[0]->CLASS;
		$hostel = $student_data[0]->HOSTEL;
		$COMPUTER = $student_data[0]->COMPUTER;
		$SESSIONID = $student_data[0]->SESSIONID;
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

	}
	if($date)
	{
		$date;
	}
	if($rcpt_no)
	{
		$rcpt_no;
	}
	if($ward_type)
	{
		$ward_type;
	}
	if($bsn)
	{
		$bsn;
	}
	if($bsa)
	{
		$bsa;
	}
	if($fee_for)
	{
		$fee_for;
	}
	foreach($fee_cal as $key => $value){
		?>
			<input type="hidden" id="f_<?php echo $key; ?>" value="<?php echo $value; ?>">
		<?php
	}
?>
<form method='post' action="<?php echo base_url('Sunil_payment_details/monthly_pay_details'); ?>" onsubmit="return validation()">
			<input type='hidden' value="<?php echo $rcpt_no; ?>" name='rcpt_no'>
			<input type='hidden' value="<?php echo $ward_type; ?>" name="ward_type">
			<input type='hidden' value="<?php echo $bsn; ?>" name="bsn">
			<input type='hidden' value="<?php echo $date; ?>" name="date">
			<input type='hidden' value="<?php echo $bsa; ?>" name="bsa">
			<input type='hidden' value="<?php echo $fee_for; ?>" name="fee_for">
			<input type='hidden' value="<?php echo $admission_no; ?>" name='adm_no'>
			
			<table class="table table-border" id="example">
				<tr>
					<th>Select Item</th>
					<th>Item Name</th>
					<th>Qty</th>
					<th>Price</th>
				</tr>
				<?php
					foreach($feehead_data as $key => $value){
						$i = $key+1;
						if($value->FEE_HEAD!="" && $value->FEE_HEAD!="-"){
							if($value->AccG == 2){
							?>
							<tr>
								<td><input name='chknm' id='fh_<?php echo $i; ?>' type="checkbox" onclick="fee(this)"></td>
								<td><?php echo $value->FEE_HEAD; ?></td>
								<td><input readonly type="text" onkeypress="return event.charCode>=48 && event.charCode<=57" min="0" name="item_qty<?php echo $i; ?>" value="0" onchange="valchange(this)" class="form-control" id="itemqty_<?php echo $i; ?>"></td>
								<td><input type="text" name="feehead<?php echo $i; ?>" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="0" id="feehead_<?php echo $i; ?>" style="text-align: right;" onchange="amtref()" class="form-control"></td>
							</tr>
							<?php
							}else{
							?>
								<input type="hidden" name="feehead<?php echo $i; ?>" value="0" id="feehead<?php echo $i; ?>" onchange="amtref()">
							<?php
							}
						}else{
							?>
							<input type="hidden" name="feehead<?php echo $i; ?>" value="0" id="feehead<?php echo $i; ?>" onchange="amtref()">
							<?php
						}
					}
				?>
				<tr>
					<td colspan="3" style="text-align:right;"><b>GRAND TOTAL</b></td>
					<td>
					<input type="text" readonly style="text-align: right;" name="totalamount" id="totalamount" value="0" class="form-control">
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<center>
							<p class='btn btn-success' onclick='payment_popup()'>Confirm Payment</p>
						</center>
					</td>
				</tr>
			</table>
			
			
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #5785c3; color: #fff; font-weight: bold;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><CENTER>PAYMENT CONFIRMATION</CENTER></h4>
        </div>
        <div class="modal-body">
        	<div class="row">
        		<div class="form-group col-md-12">
        			<label>Net Payable Amount:</label>
        			<input type="text" style="text-align: right;" name="npa" id="npa" readonly class="form-control">
        		</div>
        	</div>
         <div class="row">
         	<div class="col-md-12 form-group">
         		<label>Payment Mode:<span id="payerror" class="span"></span></label>
         		<select onchange="payment_modee(this.value)" name="pay_mod" class="form-control" id="payment_type">
         			<option value="">Select Option</option>
         			<?php
         			  if($payment_mode)
         			  {
         			  	foreach($payment_mode as $pay_data)
         			  	{
         			  		?>
         			  		<option value="<?php echo $pay_data->payment_mode; ?>"><?php echo $pay_data->payment_mode; ?></option>
         			  		<?php
         			  	}
         			  }
         			?>
         		</select>
         	</div>
         </div>
         <div class="row" id="bank_details" style="display: none;">
         	<div class="col-md-12">
         		BANK DETAILS
         	</div>
         </div>
         <div class="row" style="display: none;" id="card_show">
         		<div class="col-md-12 form-group">
         			<label>Card Number:<span id="carderror" class="span"></span></label>
         			<input type="text" minlength="16" maxlength="16" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Enter Card Number" autocomplete="off" name="card_name" id="card_name" class="form-control">
         		</div>
         	</div>
         	<div class="row" style="display: none;" id="cheque_show">
         		<div class="col-md-12 form-group">
         			<label>Cheque Number: <span id="cheque" class="span"></span></label>
         			<input type="text" placeholder="Enter Cheque" autocomplete="off" name="chque_name" id="chque_name" class="form-control">
         		</div>
         	</div>
			 <div class="row" style="display: none;" id="transation_show">
         		<div class="col-md-12 form-group">
         			<label>Transation id: <span id="cheque" class="span"></span></label>
         			<input type="text" placeholder="Enter transation id" autocomplete="off" name="transation_name" id="transation_name" class="form-control">
         		</div>
         	</div>
         <div class="row" style="display: none;" id="bank_show">
         		<div class="col-md-12 form-group">
         			<label>Bank Name:<span id="bankname" class="span"></span></label>
         			<select id="bank_name" name="bank_name" class="form-control">
         				<option value="">select bank</option>
         				<?php
         					if($bank)
         					{
         						foreach($bank as $bank_data)
         						{
         							?>
         							 <option value="<?php echo $bank_data->Bank_Name; ?>"><?php echo $bank_data->Bank_Name; ?></option>
         							<?php
         						}
         					}
         				?>
         			</select>
         		</div>
         </div>
         <div class="row" id="pay_date" style="display: none;">
         	<div class="form-group col-md-12">
         		<label>Payment Date: <span id="paydateerror" class="span"></span></label>
         		<input type="text" name="pd" id="pd" readonly value="<?php echo $date; ?>" class="form-control">
         	</div>
         </div>
         <div class="row" id="button" style="display: none;">
         	<div class="form-group col-md-12">
         		<center><input type="submit" name="submit" value="CONFIRM PAYMENT" class="btn btn-success"></center>
         	</div>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	<input type='hidden' id='pay_mod'>
			
</form>
<script>
 function fee(val){
	 var str = val.id;
	 var strid = str.split("_");
	 var finid = strid[1];
	 var getval = $("#f_"+finid).val();
	 if($("#fh_"+finid).is(":checked")){
		$("#itemqty_"+finid).val(1);
		$("#feehead_"+finid).val(getval);
        $("#itemqty_"+finid).prop('readonly',false);
		var total_amt = parseInt($("#totalamount").val());
		var amt = parseInt($("#feehead_"+finid).val());
		var total = total_amt+amt;
		$('#totalamount').val(total);
		$("#npa").val(total);
		
	 }
	 else{
		var amt = parseInt($("#feehead_"+finid).val());
		$("#itemqty_"+finid).val(0);
		$("#feehead_"+finid).val(0);  
		$("#itemqty_"+finid).prop('readonly',true);
		var total_amt = parseInt($("#totalamount").val());
		var total = total_amt-amt;
		$('#totalamount').val(total);
		$("#npa").val(total);
	 }
		
	 
 }
 function valchange(val){
	 var vl = val.id;
	 var strid = vl.split("_");
	 var finid = strid[1];
	 var qty = $("#itemqty_"+finid).val();
	if(qty == ''){
		$("#itemqty_"+finid).val(0);
		$("#feehead_"+finid).val(0);
		$("#totalamount").val(0);
		$("#npa").val(0);
	}
	else{
	 var amt = $("#f_"+finid).val();
	 var t_m = parseInt($("#feehead_"+finid).val());
	 var mul_total = amt*qty;
	 var get_total = parseInt($("#totalamount").val());
	 var ruf_total = get_total-t_m;
	 var fin_total = mul_total+ruf_total;
	 $("#feehead_"+finid).val(mul_total);
	 $("#totalamount").val(fin_total);
	 $("#npa").val(fin_total);
	}
	 
 }
 function payment_popup()
 {
	 $('#myModal').modal(2000);
 }
 function payment_modee(val)
{
	$('#pay_mod').val(val);
	if(val=='CASH')
	 {
	 	$("#pay_date").show();
	 	$("#button").show();
	 	$("#bank_details").hide();
	 	$("#cheque_show").hide();
	 	$("#card_show").hide();
	 	$("#bank_show").hide();
		$("#card_name").prop('required',false);
		$("#bank_name").prop('required',false);
		$("#chque_name").prop('required',false);
	 }
	 else if(val=='CARD SWAP')
	 {
	 	$("#bank_details").show();
	 	$("#cheque_show").hide();
	 	$("#pay_date").show();
	 	$("#card_show").show();
	 	$("#bank_show").show();
	 	$("#button").show();
		$("#card_name").prop('required',true);
		$("#bank_name").prop('required',true);
	 }
	 else if(val=="CHEQUE")
	 {
	 	$("#bank_details").show();
	 	$("#card_show").hide();
	 	$("#pay_date").show();
	 	$("#cheque_show").show();
	 	$("#bank_show").show();
	 	$("#button").show();
		$("#chque_name").prop('required',true);
		$("#bank_name").prop('required',true);
	 }
	 else if(val=='UPI')
	 {
	 	$("#transation_show").show();
	 	$("#cheque_show").hide();
	 	$("#pay_date").show();
	 	$("#card_show").hide();
	 	$("#bank_show").hide();
	 	$("#button").show();
		$("#transation_name").prop('required',true);
	 }
	 else
	 {
	 	$("#bank_details").hide();
	 	$("#card_show").hide();
	 	$("#bank_show").hide();
	 	$("#cheque_show").hide();
	 	$("#card_deatis").hide();
	 	$("#pay_date").hide();
	 	$("#button").hide();
	 }
}

</script>
