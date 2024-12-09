<?php
	if(isset($student_data))
	{
		$admission_no = $student_data[0]->ADM_NO;
		$emp_ward = $student_data[0]->EMP_WARD;
		$class = $student_data[0]->CLASS;
		$hostel = $student_data[0]->HOSTEL;
		$COMPUTER = $student_data[0]->COMPUTER;
		$SESSIONID = $student_data[0]->SESSIONID;

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
	if($ffm)
	{
		$ffm;
	}
  	if($feehead1)
	{
		$feehead1;
	}
	if($feehead2)
	{
		$feehead2;
	}
	if($feehead3)
	{
		$feehead3;
	}
	if($feehead4)
	{
		$feehead4 ;
	}
	if($feehead5)
	{
		$feehead5;
	}
	if($feehead6)
	{
		$feehead6;
	}
	if($feehead7)
	{
		$feehead7;
	}
	if($feehead8)
	{
		$feehead8;
	}
	if($feehead9)
	{
		$feehead9;
	}
	if($feehead10)
	{
		$feehead10;
	}
	if($feehead11)
	{
		$feehead11;
	}
	if($feehead12)
	{
		$feehead12;
	}
	if($feehead13)
	{
		$feehead13;
	}
	if($feehead14)
	{
		$feehead14;
	}
	if($feehead15)
	{
		$feehead15;
	}
	if($feehead16)
	{
		$feehead16;
	}
	if($feehead17)
	{
		$feehead17;
	}
	if($feehead18)
	{
		$feehead18;
	}
	if($feehead19)
	{
		$feehead19;
	}
	if($feehead20)
	{
		$feehead20;
	}
	if($feehead21)
	{
		$feehead21;
	}
	if($feehead22)
	{
		$feehead22;
	}
	if($feehead23)
	{
		$feehead23;
	}
	if($feehead24)
	{
		$feehead24;
	}
	if($feehead25)
	{
		$feehead25;
	}
	if($amt_feehead1)
	{
		$amt_feehead1;
	}
	if($amt_feehead2)
	{
		$amt_feehead2;
	}
	if($amt_feehead3)
	{
		$amt_feehead3;
	}
	if($amt_feehead4)
	{
		$amt_feehead4;
	}
	if($amt_feehead5)
	{
		$amt_feehead5;
	}
	if($amt_feehead6)
	{
		$amt_feehead6;
	}
	if($amt_feehead7)
	{
		$amt_feehead7;
	}
	if($amt_feehead8)
	{
		$amt_feehead8;
	}
	if($amt_feehead9)
	{
		$amt_feehead9;
	}
	if($amt_feehead10)
	{
		$amt_feehead10;
	}
	if($amt_feehead11)
	{
		$amt_feehead11;
	}
	if($amt_feehead12)
	{
		$amt_feehead12;
	}
	if($amt_feehead13)
	{
		$amt_feehead13;
	}
	if($amt_feehead14)
	{
		$amt_feehead14;
	}
	if($amt_feehead15)
	{
		$amt_feehead15;
	}
	if($amt_feehead16)
	{
		$amt_feehead16;
	}
	if($amt_feehead17)
	{
		$amt_feehead17;
	}
	if($amt_feehead18)
	{
		$amt_feehead18;
	}
	if($amt_feehead19)
	{
		$amt_feehead19;
	}
	if($amt_feehead20)
	{
		$amt_feehead20;
	}
	if($amt_feehead21)
	{
		$amt_feehead21;
	}
	if($amt_feehead22)
	{
		$amt_feehead22;
	}
	if($amt_feehead23)
	{
		$amt_feehead23;
	}
	if($amt_feehead24)
	{
		$amt_feehead24;
	}
	if($amt_feehead25)
	{
		$amt_feehead25;
	}
	if($total_amount)
	{
		$total_amount;
	}
?>
<form method='post' action="<?php echo base_url('Online_paymentcal/payment'); ?>" onsubmit="return validation()">
			<input type='hidden' value="<?php echo $rcpt_no; ?>" name='rcpt_no'>
			<input type='hidden' value="<?php echo $ward_type; ?>" name="ward_type">
			<input type='hidden' value="<?php echo $bsn; ?>" name="bsn">
			<input type='hidden' value="<?php echo $bsa; ?>" name="bsa">
			<input type='hidden' value="<?php echo $ffm; ?>" name="ffm">
			<input type='hidden' value="<?php echo $admission_no; ?>" name='adm_no'>
	<div class="row">
				<?php
	    		  if($feehead1!="" && $feehead1!="-")
	    		  {
	    		  	?>
	    		  	  <div class="col-md-3 form-group">
	    			  <label><?php echo $feehead1; ?></label>
	    			  <input type="text" name="feehead1" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead1; ?>" id="feehead1" onchange="amtref()" class="form-control">
	    		      </div>
	    		 <?php
	    		  }
	    		  else
	    		  {

	    		  }
	    		?>
	    		<?php
	    		 if($feehead2!="" && $feehead2!="-")
	    		 {
	    		 	?>
	    		 	<div class="col-md-3 form-group">
	    				<label><?php echo $feehead2; ?></label>
	    				<input type="text" name="feehead2" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead2; ?>" id="feehead2" onchange="amtref()" class="form-control">
	    		    </div>
	    		 	<?php
	    		 } 
	    		 else
	    		 {

	    		 }
	    		?>
	    		<?php
	    		  if($feehead3!="" && $feehead3!="-")
	    		  {
	    		  	?>
	    		  	 <div class="col-md-3 form-group">
	    				<label><?php echo $feehead3; ?></label>
	    				<input type="text" name="feehead3" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead3; ?>" id="feehead3" onchange="amtref()" class="form-control">
	    		     </div>
	    		     <?php
	    		  } 
	    		  else
	    		  {

	    		  }
	    		?>
	    		<?php
	    		  if($feehead4!="" && $feehead4!="-")
	    		  {
	    		  	?>
	    		  	 <div class="col-md-3 form-group">
	    		  	 	<label><?php echo $feehead4; ?></label>
	    		  	 	<input type="text" name="feehead4" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead4; ?>" id="feehead4" onchange="amtref()" class="form-control">
	    		  	 </div>
	    		  	<?php
	    		  } 
	    		  else
	    		  {

	    		  }
	    		?>
	    		<?php
	    		  if($feehead5!="" && $feehead5!="-")
	    		  {
	    		  	?>
	    		  	<div class="col-md-3 form-group">
	    		  		<label><?php echo $feehead5; ?></label>
	    		  		<input type="text" name="feehead5" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead5; ?>" id="feehead5" onchange="amtref()" class="form-control">
	    		  	</div>
	    		  	<?php
	    		  }
	    		  else
	    		  {

	    		  }
	    		?>
	    		<?php
	    		  if($feehead6!="" && $feehead6!="-")
	    		  {
	    		  	?>
	    		  	 <div class="col-md-3 form-group">
	    		  	 	<label><?php echo $feehead6; ?></label>
	    		  	 	<input type="text" name="feehead6" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead6; ?>" id="feehead6" onchange="amtref()" class="form-control">
	    		  	 </div>
	    		  	<?php
	    		  } 
	    		  else
	    		  {

	    		  }
	    		?>
	    		<?php
	    		  if($feehead7!="" && $feehead7!="-")
	    		  {
	    		  	?>
	    		  	 <div class="col-md-3 form-group">
	    		  	 	<label><?php echo $feehead7; ?></label>
	    		  	 	<input type="text" name="feehead7" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead7; ?>" id="feehead7" onchange="amtref()" class="form-control">
	    		  	 </div>
	    		  	<?php
	    		  }
	    		  else
	    		  {

	    		  }
	    		?>
	    		<?php
	    		 if($feehead8!="" && $feehead8!="-")
	    		 {
	    		 	?>
	    		 	<div class="col-md-3 form-group">
	    		 		<label><?php echo $feehead8; ?></label>
	    		 	    <input type="text" name="feehead8" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead8; ?>" id="feehead8" onchange="amtref()" class="form-control">
	    		 	</div>
	    		 	<?php 
	    		 }
	    		 else
	    		 {

	    		 }
	    		?>
	    		<?php
	    		 if($feehead9!="" && $feehead9!="-")
	    		 {
	    		 	?>
	    		 	<div class="col-md-3 form-group">
	    		 		<label><?php echo $feehead9; ?></label>
	    		 		<input type="text" name="feehead9" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead9; ?>" id="feehead9" onchange="amtref()" class="form-control">
	    		 	</div>
	    		 	<?php
	    		 }
	    		 else
	    		 {

	    		 }
	    		?>
	    		<?php
	    		  if($feehead10!="" && $feehead10!="-")
	    		  {
	    		  	?>
	    		  	 <div class="col-md-3 form-group">
	    		  	 	<label><?php echo $feehead10; ?></label>
	    		  	 	<input type="text" name="feehead10" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead10; ?>" id="feehead10" onchange="amtref()" class="form-control">
	    		  	 </div>
	    		  	<?php
	    		  }
	    		  else
	    		  {

	    		  }
	    		?>
	  			<?php
	  			 if($feehead11!="" && $feehead11!="-")
	  			 {
	  			 	?>
	  			 	<div class="col-md-3 form-group">
	  			 		<label><?php echo $feehead11; ?></label>
	  			 		<input type="text" name="feehead11" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead11; ?>" id="feehead11" onchange="amtref()" class="form-control">
	  			 	</div>
	  			 	<?php
	  			 }
	  			 else
	  			 {

	  			 }
	  			?>
	  			<?php
	  			 if($feehead12!="" && $feehead12!="-")
	  			 {
	  			 	?>
	  			 	 <div class="col-md-3 form-group">
	  			 	 	<label><?php echo $feehead12; ?></label>
	  			 	 	<input type="text" name="feehead12" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead12; ?>" id="feehead12" onchange="amtref()" class="form-control">
	  			 	 </div>
	  			 	<?php
	  			 }
	  			 else
	  			 {

	  			 }
	  			?>
	  			<?php
	  			  if($feehead13!="" && $feehead13!="-")
	  			  {
	  			  	?>
	  			  		<div class="col-md-3 form-group">
	  			  			<label><?php echo $feehead13; ?></label>
	  			  			<input type="text" name="feehead13" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead13; ?>" id="feehead13" onchange="amtref()" class="form-control">
	  			  		</div>
	  			  	<?php
	  			  }
	  			  else
	  			  {

	  			  }
	  			?>
	  			<?php
	  			  if($feehead14!="" && $feehead14!="-")
	  			  {
	  			  	?>
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead14; ?></label>
	  			  	 	<input type="text" name="feehead14" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead14; ?>" id="feehead14" onchange="amtref()" class="form-control">
	  			  	 </div>
	  			  	<?php
	  			  }
	  			  else
	  			  {

	  			  }
	  			?>
	  			<?php
	  			  if($feehead15!="" && $feehead15!="-")
	  			  {
	  			  	?>
	  			  	<div class="col-md-3 form-group">
	  			  		<label><?php echo $feehead15; ?></label>
	  			  		<input type="text" name="feehead15" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead15; ?>" id="feehead15" onchange="amtref()" class="form-control">
	  			  	</div>
	  			  	<?php
	  			  }
	  			  else
	  			  {

	  			  }
	  			?>
	  			<?php
	  			 if($feehead16!="" && $feehead16!="-")
	  			 {
	  			 	?>
	  			 	 <div class="col-md-3 form-group">
	  			 	 	<label><?php echo $feehead16; ?></label>
	  			 	 	<input type="text" name="feehead16" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead16; ?>" id="feehead16" onchange="amtref()" class="form-control">
	  			 	 </div>
	  			 	<?php
	  			 }
	  			 else
	  			 {

	  			 }
	  			?>
	  			<?php
	  			 if($feehead17!="" && $feehead17!="-")
	  			 {
	  			 	?>
	  			 	<div class="col-md-3 form-group">
	  			 		<label><?php echo $feehead17; ?></label>
	  			 		<input type="text" name="feehead17" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead17; ?>" id="feehead17" onchange="amtref()" class="form-control">
	  			 	</div>
	  			 	<?php
	  			 }
	  			 else
	  			 {

	  			 }
	  			?>
	  			<?php
	  			 if ($feehead18!="" && $feehead18!="=-") 
	  			 {
	  			 	
	  			 	?>
	  			 	<div class="col-md-3 form-group">
	  			 		<label><?php echo $feehead18; ?></label>
	  			 		<input type="text" name="feehead18" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead18; ?>" id="feehead18" onchange="amtref()" class="form-control">
	  			 	</div>
	  			 	<?php
	  			 }
	  			 else
	  			 {

	  			 }
	  			?>
	  			<?php
	  			  if($feehead19!="" && $feehead19!="-")
	  			  {
	  			  	?>
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead19; ?></label>
	  			  	 	<input type="text" name="feehead19" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead19; ?>" id="feehead19" onchange="amtref()" class="form-control">
	  			  	 </div>
	  			  	<?php
	  			  }
	  			  else
	  			  {

	  			  }
	  			?>
	  			<?php
	  				if($feehead20!="" && $feehead20!="-")
	  				{
	  					?>
	  					 <div class="col-md-3 form-group">
	  					 	<label><?php echo $feehead20; ?></label>
	  					 	<input type="text" name="feehead20" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead20; ?>" id="feehead20" onchange="amtref()" class="form-control">
	  					 </div>
	  					<?php
	  				}
	  				else
	  				{

	  				}
	  			?>
	  			<?php
	  			  if($feehead21!="" && $feehead21!="-")
	  			  {
	  			  	?>
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead21; ?></label>
	  			  	 	<input type="text" name="feehead21" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead21; ?>" id="feehead21" onchange="amtref()" class="form-control">
	  			  	 </div>
	  			  	<?php
	  			  }
	  			  else{

	  			  } 
	  			?>
	  			<?php
	  			 if($feehead22!="" && $feehead22!="-")
	  			 {
	  			 	?>
	  			 	 <div class="col-md-3 form-group">
	  			 	 	<label><?php echo $feehead22; ?></label>
	  			 	 	<input type="text" name="feehead22" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead22; ?>" id="feehead22" onchange="amtref()" class="form-control">
	  			 	 </div>
	  			 	<?php
	  			 }
	  			 else
	  			 {

	  			 }
	  			?>
	  			<?php
	  			 if($feehead23!="" && $feehead23!="-")
	  			 {
	  			 	?>
	  			 	 <div class="col-md-3 form-group">
	  			 	 	<label><?php echo $feehead23; ?></label>
	  			 	 	<input type="text" name="feehead23" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead23; ?>" id="feehead23" onchange="amtref()" class="form-control">
	  			 	 </div>
	  			 	<?php
	  			 }
	  			 else
	  			 {

	  			 }
	  			?>
	  			<?php
	  			  if($feehead24!="" && $feehead24!="-")
	  			  {
	  			  	?>
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead24; ?></label>
	  			  	 	<input type="text" name="feehead24" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead24; ?>" id="feehead24" onchange="amtref()" class="form-control">
	  			  	 </div>
	  			  	<?php
	  			  }
	  			?>
	  			<?php
	  			  if($feehead25!="" && $feehead25!="-")
	  			  {
	  			  	?>
	  			  	 <div class="col-md-3 form-group">
	  			  	 	<label><?php echo $feehead25; ?></label>
	  			  	 	<input type="text" name="feehead25" readonly onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead25; ?>" id="feehead25" onchange="amtref()" class="form-control">
	  			  	 </div>
	  			  	<?php
	  			  }
	  			  else
	  			  {

	  			  }
	  			?>
				<div class="col-md-3">
	  				
	  			</div>
	  			<div class="col-md-3">
	  				
	  			</div>
	  			<div class="col-md-3">

	  			</div>	
			</div>
			<div class="row">
	    		<div class="col-md-9">
	    			
	    		</div>
	    		<div class="col-md-3">
	    			<label>Total Amount</label>
	  				<input type="text" readonly style="text-align: right;" name="totalamount" id="totalamount" value="<?php echo $total_amount; ?>" class="form-control">
	    		</div>
	    	</div>
			<div class='row'>
				<div class='col-md-12 col-sm-12 col-lg-12'>
					<center>
						
					<input type='submit' value='CONFIRM PAYMENT' Class='btn btn-success'> 
					</center>
				</div>
			</div>
			
			
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
        			<input type="text" style="text-align: right;" name="npa" id="npa" value='<?php echo $total_amount; ?>' readonly class="form-control">
        		</div>
        	</div>
        
         <div class="row" id="pay_date">
         	<div class="form-group col-md-12">
         		<label>Payment Date: <span id="paydateerror" class="span"></span></label>
         		<input type="text" name="pd" id="pd" readonly value="<?php echo date('d-m-y'); ?>" class="form-control">
         	</div>
         </div>
         <div class="row" id="button">
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
	
	<!---- Payment gateway ---->
	<?php
	$this->session->set_userdata('adm_no',$admission_no);
	$this->session->set_userdata('total_amountt',$total_amount);
	$this->session->set_userdata('ffms',$ffm);
	?>		
	               
	<input type='hidden' name='fee[1]' value='<?php echo $amt_feehead1; ?>'>
	<input type='hidden' name='fee[2]' value='<?php echo $amt_feehead2; ?>'>
	<input type='hidden' name='fee[3]' value='<?php echo $amt_feehead3; ?>'>
	<input type='hidden' name='fee[4]' value='<?php echo $amt_feehead4; ?>'>
	<input type='hidden' name='fee[5]' value='<?php echo $amt_feehead5; ?>'>
	<input type='hidden' name='fee[6]' value='<?php echo $amt_feehead6; ?>'>
	<input type='hidden' name='fee[7]' value='<?php echo $amt_feehead7; ?>'>
	<input type='hidden' name='fee[8]' value='<?php echo $amt_feehead8; ?>'>
	<input type='hidden' name='fee[9]' value='<?php echo $amt_feehead9; ?>'>
	<input type='hidden' name='fee[10]' value='<?php echo $amt_feehead10; ?>'>
	<input type='hidden' name='fee[11]' value='<?php echo $amt_feehead11; ?>'>
	<input type='hidden' name='fee[12]' value='<?php echo $amt_feehead12; ?>'>
	<input type='hidden' name='fee[13]' value='<?php echo $amt_feehead13; ?>'>
	<input type='hidden' name='fee[14]' value='<?php echo $amt_feehead14; ?>'>
	<input type='hidden' name='fee[15]' value='<?php echo $amt_feehead15; ?>'>
	<input type='hidden' name='fee[16]' value='<?php echo $amt_feehead16; ?>'>
	<input type='hidden' name='fee[17]' value='<?php echo $amt_feehead17; ?>'>
	<input type='hidden' name='fee[18]' value='<?php echo $amt_feehead18; ?>'>
	<input type='hidden' name='fee[19]' value='<?php echo $amt_feehead19; ?>'>
	<input type='hidden' name='fee[20]' value='<?php echo $amt_feehead20; ?>'>
	<input type='hidden' name='fee[21]' value='<?php echo $amt_feehead21; ?>'>
	<input type='hidden' name='fee[22]' value='<?php echo $amt_feehead22; ?>'>
	<input type='hidden' name='fee[23]' value='<?php echo $amt_feehead23; ?>'>
	<input type='hidden' name='fee[24]' value='<?php echo $amt_feehead24; ?>'>
	<input type='hidden' name='fee[25]' value='<?php echo $amt_feehead25; ?>'>
	
			
</form>
<script>
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
