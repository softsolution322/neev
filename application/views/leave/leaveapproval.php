<?php
  $data_id = $this->session->userdata('login_details');
  $log_id = $data_id['user_id'];
  $role_id = $data_id['ROLE_ID'];
?>
<style type="text/css">
 .nav > li > a {
    font-weight: 500;
    padding: 8px 76px 10px 36px;
    font-size: 0.85em;
    border-bottom: 1px solid #E9E9E9;
    font-size: 15px;
}

.nav > li > a:hover, .nav > li > a:focus {
    background: #337ab7 !important;
	color: #fff !important;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #fff;
    cursor: default;
    background-color: #337ab7;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
}

.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
 .btn-danger{
	 background: red !important;
 } 
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('punching/manualpunch'); ?>">Employee</a> <i class="fa fa-angle-right"></i> Leave Approval</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
  <!--<div class='row'>
    <table class='table'>
	  <tr>
	    <td><b>From Date</b> <input type="date" id="from_date" class="form-control"></td>
	    <td><b>To Date</b> <input type="date" id="to_date" class="form-control"></td>
	    <td><br /><button class='btn btn-success' onclick='date_srch()'>Search</button></td>
	  </tr>
    </table>
  </div>-->
  <div class="row">
    <div class="col-sm-12">
      <ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#pending">Pending Approval</a></li>
		<li><a data-toggle="tab" href="#approved">Approved</a></li>
		<li><a data-toggle="tab" href="#disapproved">Disapproved</a></li>
	  </ul>

		  <div class="tab-content">
		    <!-----pending------> 
			<div id="pending" class="tab-pane fade in active table-responsive"><br />
			  <table class='table dataTable'>
			   <thead>
			    <tr>
				  <th style="background: #337ab7 !important; color: white !important;">Emp Id</th>
				  <th style="background: #337ab7 !important; color: white !important;">Emp Name</th>
				  <th style="background: #337ab7 !important; color: white !important;">Designation</th>
				  <th style="background: #337ab7 !important; color: white !important;">Apply Date</th>
				  <th style="background: #337ab7 !important; color: white !important;">Leave Type</th>
				  <th style="background: #337ab7 !important; color: white !important;">From Date</th>
				  <th style="background: #337ab7 !important; color: white !important;">To Date </th>
				  <th style="background: #337ab7 !important; color: white !important;">Against Date (From - To)</th>
				  <th style="background: #337ab7 !important; color: white !important;">total Days</th>
				  <th style="background: #337ab7 !important; color: white !important;">Reason</th>
				  <th style="background: #337ab7 !important; color: white !important;">Action</th>
			    </tr>
			   </thead>
               <tbody>
                <?php
				  if(isset($empLeave)){
					  foreach($empLeave as $data){
						  if($role_id == 5 || $role_id == 6){//for wing
							  if($log_wing_id == $data->wing_id){
						?>
						  <tr>
						    <td><?php echo $data->EMPLOYEE_ID ." -". $data->wing_id; ?></td>
						    <td><?php echo $data->empfnm ." ". $data->empmnm ." ". $data->emplnm; ?></td>
							<td><?php echo $data->designm; ?></td>
							<td><?php echo $data->APPLY_DATE; ?></td>
							<td><?php echo $leaveTypeList[$data->LEAVE_TYPE]; ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_FROM)); ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_TO)); ?></td>
							<td>
                              <?php 
                              if($data->AGAINST_DATE_FROM != '0000-00-00' || $data->AGAINST_DATE_FROM != '')
                              {
                                echo date('d-M-Y',strtotime($data->AGAINST_DATE_FROM)).' - ' .date('d-M-Y',strtotime($data->AGAINST_DATE_TO)); 

                              } ?>    
                            </td>
							<td><?php echo $data->TOTAL_DAYS; ?></td>
							<td><?php echo $leaveReasonList[$data->REASON]; ?></td>
							<td><button class='btn btn-success btn-xs' onclick="leave(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID; ?>','<?php echo $log_id; ?>','<?php echo $data->LEAVE_TYPE; ?>',<?php echo $data->TOTAL_DAYS; ?>)"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
						  </tr>
                        <?php
							  }						
					      }else{
							?>
							 <tr>
								<td><?php echo $data->EMPLOYEE_ID ." -". $data->wing_id; ?></td>
								<td><?php echo $data->empfnm ." ". $data->empmnm ." ". $data->emplnm; ?></td>
								<td><?php echo $data->designm; ?></td>
								<td><?php echo $data->APPLY_DATE; ?></td>
								<td><?php echo $leaveTypeList[$data->LEAVE_TYPE]; ?></td>
								<td><?php echo date('d-M-Y',strtotime($data->DATE_FROM)); ?></td>
								<td><?php echo date('d-M-Y',strtotime($data->DATE_TO)); ?></td>
								<td>
	                              <?php 
	                              if($data->AGAINST_DATE_FROM != '0000-00-00' || $data->AGAINST_DATE_FROM != '')
	                              {
	                                echo date('d-M-Y',strtotime($data->AGAINST_DATE_FROM)).' - ' .date('d-M-Y',strtotime($data->AGAINST_DATE_TO)); 

	                              } ?>    
	                            </td>
								<td><?php echo $data->TOTAL_DAYS; ?></td>
								<td><?php echo $leaveReasonList[$data->REASON]; ?></td>
								<td><button class='btn btn-success btn-xs' onclick="leave(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID; ?>','<?php echo $log_id; ?>','<?php echo $data->LEAVE_TYPE; ?>',<?php echo $data->TOTAL_DAYS; ?>)"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
							  </tr>
							<?php
						  }
					  }
				  }
				?>			   
               </tbody>			   
			  </table>
			  <!--------approval modal------------>
				  <div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
					  <div class="modal-content">
						<div class="modal-header" style="background:#5785c3; color:#fff;">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4 class="modal-title"><label id='emp_id'></label></h4>
						</div>
						<div class="modal-body">
						  <table class='table'>
						    <tr>
							  <td><b>Leave</b></td>
							  <td>
							    <input type="radio" name="leave" value='1'> Approved &nbsp;&nbsp;
							    <input type="radio" name="leave" value='2'> Disapproved
							  </td>
						    </tr>
							<tr>
							  <td><b>Leave type</b></td>
							  <td>
							    <select id="lv_type" name="lv_type" class='form-control' onchange="getTotalRestLeave()">
								 <option value=''>Select</option>
							     <?php
								    foreach($leaveTypeList as $key => $data ){
										?>
										 <option value='<?php echo $key; ?>'><?php echo $data; ?></option>
										<?php
									}
								 ?>
							    </select>
							  </td>
							</tr>
							<tr>
							  <td><b>Apply Total Days</b></td>
							  <td><input type="text" class='form-control' name='tot_days' id='tot_days' readonly></td>
							</tr>
							<tr id="total_rest_leave_row" style="display: none;">
								<td><b>Total Leave Balance <br>(without applied above leave)</b></td>
								<td><input type="text" class="form-control" id="total_rest_leave" readonly="" value="0"></td>
							</tr>
							<tr>
							  <td><b>Remarks</b></td>
							  <td><textarea name='remarks' id="remarks" class='form-control'></textarea></td>
							</tr>
							<input type="hidden" id="updid">
							<input type="hidden" id="login_id">
						  </table>
						</div>
						<div class="modal-footer">
						  <button type="button" id="save_btn" class="btn btn-success btn-sm" onclick="leave_save()">SAVE</button>
						  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
						</div>
					  </div>
					</div>
				  </div>
			  <!-------end approval modal--------->
			</div>
			<!-----end pending------> 
			
			<!-----approved------>
			<div id="approved" class="tab-pane fade table-responsive"><br />
			<table class='table dataTable'>
             <thead>			
			  <tr>
			    <th style="background: #337ab7 !important; color: white !important;">Emp Id</th>
				<th style="background: #337ab7 !important; color: white !important;">Emp Name</th>
				<th style="background: #337ab7 !important; color: white !important;">Designation</th>
				<th style="background: #337ab7 !important; color: white !important;">Apply Date</th>
				<th style="background: #337ab7 !important; color: white !important;">Leave Type</th>
				<th style="background: #337ab7 !important; color: white !important;">From Date</th>
				<th style="background: #337ab7 !important; color: white !important;">To Date </th>
				<th style="background: #337ab7 !important; color: white !important;">Against Date (From - To)</th>
				<th style="background: #337ab7 !important; color: white !important;">total Days</th>
				<th style="background: #337ab7 !important; color: white !important;">Reason</th>
				<th style="background: #337ab7 !important; color: white !important;">Approved By</th>
				<th style="background: #337ab7 !important; color: white !important;">Action</th>
			  </tr>
			 </thead>
             <tbody>
              <?php
			    if(isset($empApporoved)){
					foreach($empApporoved as $data){
						if($role_id == 5 || $role_id == 6){//for wing
						  if($log_wing_id == $data->wing_id){
						?>
						 <tr>
							<td><?php echo $data->EMPLOYEE_ID; ?></td>
							<td><?php echo $data->empnm; ?></td>
							<td><?php echo $data->designm; ?></td>
							<td><?php echo $data->APPLY_DATE; ?></td>
							<td><?php echo $leaveTypeList[$data->LEAVE_TYPE]; ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_FROM)); ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_TO)); ?></td>
							<td>
                              <?php 
                              if($data->AGAINST_DATE_FROM != '0000-00-00' || $data->AGAINST_DATE_FROM != '')
                              {
                                echo date('d-M-Y',strtotime($data->AGAINST_DATE_FROM)).' - ' .date('d-M-Y',strtotime($data->AGAINST_DATE_TO)); 

                              } ?>    
                            </td>
							<td><?php echo $data->TOTAL_DAYS; ?></td>
							<td><?php echo $leaveReasonList[$data->REASON]; ?></td>
							<td><?php echo $data->ADMIN_ID ." <span style='color:blue; font-weight:bold;'>(". $data->rolenm .")</span>" ?></td>
							<?php
							  if($role_id == 6){
								if($data->roleid == 6){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveApporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php								
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}  
							  }elseif($role_id == 5){
								if($data->roleid == 6 || $data->roleid == 5){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveApporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php	
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}   
							  }else{
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveApporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php	
							  }
							?>
							<!--<td><button class='btn btn-danger btn-xs' onclick="leaveApporoved(<?php //echo $data->ID; ?>,'<?php //echo $data->EMPLOYEE_ID?>','<?php //echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>-->
						 </tr>
						<?php
						  }
						}else{
						  ?>
						  <tr>
							<td><?php echo $data->EMPLOYEE_ID; ?></td>
							<td><?php echo $data->empnm; ?></td>
							<td><?php echo $data->designm; ?></td>
							<td><?php echo $data->APPLY_DATE; ?></td>
							<td><?php echo $leaveTypeList[$data->LEAVE_TYPE]; ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_FROM)); ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_TO)); ?></td>
							<td>
                              <?php 
                              if($data->AGAINST_DATE_FROM != '0000-00-00' || $data->AGAINST_DATE_FROM != '')
                              {
                                echo date('d-M-Y',strtotime($data->AGAINST_DATE_FROM)).' - ' .date('d-M-Y',strtotime($data->AGAINST_DATE_TO)); 

                              } ?>    
                            </td>
							<td><?php echo $data->TOTAL_DAYS; ?></td>
							<td><?php echo $leaveReasonList[$data->REASON]; ?></td>
							<td><?php echo $data->ADMIN_ID ." <span style='color:blue; font-weight:bold;'>(". $data->rolenm .")</span>" ?></td>
							<?php
							  if($role_id == 6){
								if($data->roleid == 6){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveApporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php								
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}  
							  }elseif($role_id == 5){
								if($data->roleid == 6 || $data->roleid == 5){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveApporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php	
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}   
							  }else{
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveApporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php	
							  }
							?>
							<!--<td><button class='btn btn-danger btn-xs' onclick="leaveApporoved(<?php //echo $data->ID; ?>,'<?php //echo $data->EMPLOYEE_ID?>','<?php //echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>-->
						 </tr>
						  <?php
						}
					}
				}
			  ?>			 
             </tbody>			 
			</table>
            
			 <!--------approval modal------------>
				  <div class="modal fade" id="leave_approved" role="dialog">
					<div class="modal-dialog">
					  <div class="modal-content">
						<div class="modal-header" style="background:#5785c3; color:#fff;">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4 class="modal-title"><label id='lv_apro_emp_id'></label></h4>
						</div>
						<div class="modal-body">
						  <table class='table'>
						    <tr>
							  <td><b>Leave</b></td>
							  <td>
							    <input type="radio" name="leave" value='2'> Disapproved
							  </td>
						    </tr>
							<tr>
							  <td><b>Remarks</b></td>
							  <td><textarea name='remarks' id="lv_apro_remarks" class='form-control'></textarea></td>
							</tr>
							<input type="hidden" id="lv_apro_updid">
							<input type="hidden" id="lv_apro_login_id">
						  </table>
						</div>
						<div class="modal-footer">
						  <button type="button" class="btn btn-success btn-sm" onclick="leave_approve_save()">SAVE</button>
						  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
						</div>
					  </div>
					</div>
				  </div>
			  <!-------end approval modal--------->
       			
			</div>
			<!-----end approved------>
			
			<!-------disapproved-------->
			<div id="disapproved" class="tab-pane fade table-responsive"><br />
			  <table class='table dataTable'>
             <thead>			
			  <tr>
			    <th style="background: #337ab7 !important; color: white !important;">Emp Id</th>
				<th style="background: #337ab7 !important; color: white !important;">Emp Name</th>
				<th style="background: #337ab7 !important; color: white !important;">Designation</th>
				<th style="background: #337ab7 !important; color: white !important;">Apply Date</th>
				<th style="background: #337ab7 !important; color: white !important;">Leave Type</th>
				<th style="background: #337ab7 !important; color: white !important;">From Date</th>
				<th style="background: #337ab7 !important; color: white !important;">To Date </th>
				<th style="background: #337ab7 !important; color: white !important;">Against Date (From - To)</th>
				<th style="background: #337ab7 !important; color: white !important;">total Days</th>
				<th style="background: #337ab7 !important; color: white !important;">Reason</th>
				<th style="background: #337ab7 !important; color: white !important;">Disapproved By</th>
				<th style="background: #337ab7 !important; color: white !important;">Action</th>
			  </tr>
			 </thead>
             <tbody>
              <?php
			    if(isset($empDisapporoved)){
					foreach($empDisapporoved as $data){
						if($role_id == 5 || $role_id == 6){//for wing
						if($log_wing_id == $data->wing_id){
						?>
						 <tr>
							<td><?php echo $data->EMPLOYEE_ID; ?></td>
							<td><?php echo $data->empnm; ?></td>
							<td><?php echo $data->designm; ?></td>
							<td><?php echo $data->APPLY_DATE; ?></td>
							<td><?php echo $leaveTypeList[$data->LEAVE_TYPE]; ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_FROM)); ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_TO)); ?></td>
							<td>
                              <?php 
                              if($data->AGAINST_DATE_FROM != '0000-00-00' || $data->AGAINST_DATE_FROM != '')
                              {
                                echo date('d-M-Y',strtotime($data->AGAINST_DATE_FROM)).' - ' .date('d-M-Y',strtotime($data->AGAINST_DATE_TO)); 

                              } ?>    
                            </td>
							<td><?php echo $data->TOTAL_DAYS; ?></td>
							<td><?php echo $leaveReasonList[$data->REASON]; ?></td>
							<td><?php echo $data->ADMIN_ID ." <span style='color:blue; font-weight:bold;'>(". $data->rolenm .")</span>" ?></td>
							<?php
							  if($role_id == 6){
								if($data->roleid == 6){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveDisapporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php								
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}  
							  }elseif($role_id == 5){
								if($data->roleid == 6 || $data->roleid == 5){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveDisapporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php	
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}   
							  }else{
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveDisapporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php	
							  }
							?>
							<!--<td><button class='btn btn-danger btn-xs' onclick="leaveDisapporoved(<?php //echo $data->ID; ?>,'<?php //echo $data->EMPLOYEE_ID?>','<?php //echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>-->
						 </tr>
						<?php
						}
						}else{
							?>
							<tr>
							<td><?php echo $data->EMPLOYEE_ID; ?></td>
							<td><?php echo $data->empnm; ?></td>
							<td><?php echo $data->designm; ?></td>
							<td><?php echo $data->APPLY_DATE; ?></td>
							<td><?php echo $leaveTypeList[$data->LEAVE_TYPE]; ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_FROM)); ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_TO)); ?></td>
							<td>
                              <?php 
                              if($data->AGAINST_DATE_FROM != '0000-00-00' || $data->AGAINST_DATE_FROM != '')
                              {
                                echo date('d-M-Y',strtotime($data->AGAINST_DATE_FROM)).' - ' .date('d-M-Y',strtotime($data->AGAINST_DATE_TO)); 

                              } ?>    
                            </td>
							<td><?php echo $data->TOTAL_DAYS; ?></td>
							<td><?php echo $leaveReasonList[$data->REASON]; ?></td>
							<td><?php echo $data->ADMIN_ID ." <span style='color:blue; font-weight:bold;'>(". $data->rolenm .")</span>" ?></td>
							<?php
							  if($role_id == 6){
								if($data->roleid == 6){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveDisapporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php								
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}  
							  }elseif($role_id == 5){
								if($data->roleid == 6 || $data->roleid == 5){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveDisapporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php	
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}   
							  }else{
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveDisapporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php	
							  }
							?>
							<!--<td><button class='btn btn-danger btn-xs' onclick="leaveDisapporoved(<?php //echo $data->ID; ?>,'<?php //echo $data->EMPLOYEE_ID?>','<?php //echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>-->
						 </tr>
							<?php
						}
					}
				}
			  ?>			 
             </tbody>			 
			</table>
            
			 <!--------approval modal------------>
				  <div class="modal fade" id="leave_disapproved" role="dialog">
					<div class="modal-dialog">
					  <div class="modal-content">
						<div class="modal-header" style="background:#5785c3; color:#fff;">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4 class="modal-title"><label id='lv_disapro_emp_id'></label></h4>
						</div>
						<div class="modal-body">
						  <table class='table'>
						    <tr>
							  <td><b>Leave</b></td>
							  <td>
							    <input type="radio" name="leave" value='1'> Approved
							  </td>
						    </tr>
							<tr>
							  <td><b>Remarks</b></td>
							  <td><textarea name='remarks' id="lv_disapro_remarks" class='form-control'></textarea></td>
							</tr>
							<input type="hidden" id="lv_disapro_updid">
							<input type="hidden" id="lv_disapro_login_id">
						  </table>
						</div>
						<div class="modal-footer">
						  <button type="button" class="btn btn-success btn-sm" onclick="leave_disapprove_save()">SAVE</button>
						  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
						</div>
					  </div>
					</div>
				  </div>
			  <!-------end approval modal--------->
			</div>
			<!-------end disapproved-------->
		  </div>
    </div>
  </div>
</div>
<br><br>


<!-- /.modal -->
<div class="loader"></div>
<script type="text/javascript">
   $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      aaSorting: [[0, 'asc']]
    })
  });
  
  function leave(ID,emp_id,login_id,lv_type,tot_days){
	  $("#emp_id").text(emp_id);
	  $("#updid").val(ID);
	  $("#login_id").val(login_id);
	  $("#lv_type").val(lv_type);
	  $("#tot_days").val(tot_days);
	  $("#myModal").modal('show');
  }
  
  function leave_save(){
	var updid    = $("#updid").val();  
	var login_id = $("#login_id").val();  
	var leave    = $("input[name='leave']:checked").val();
	var lv_type  = $("#lv_type").val(); 
	var remarks  = $("#remarks").val();
	
    if(leave != undefined){	
		$.post("<?php echo base_url('leave/Leaveapproval/leave_approval_sv_upd'); ?>",{updid:updid,login_id:login_id,leave:leave,lv_type:lv_type,remarks:remarks},function(data){
			$("#myModal").modal('hide');
			$("input[name='leave']:checked").prop('checked',false);
			$("#remarks").val('');
			alert('Leave Update');
			location.reload();
		});
	}else{
		alert('Leave Check First');
	}
  }
  
  function leaveApporoved(id,emp_id,login_id){
	  $("#lv_apro_updid").val(id);
	  $("#lv_apro_emp_id").text(emp_id);
	  $("#lv_apro_login_id").val(login_id);
	  $("#leave_approved").modal('show');
  }
  
  function leave_approve_save(){
	  var lv_apro_updid = $("#lv_apro_updid").val();
	  var lv_apro_login_id = $("#lv_apro_login_id").val();
	  var leave = $("input[name='leave']:checked").val();
	  var lv_apro_remarks = $("#lv_apro_remarks").val();
	  
	  if(leave != undefined){	
		$.post("<?php echo base_url('leave/Leaveapproval/leave_disapproval_sv_upd'); ?>",{lv_apro_updid:lv_apro_updid,lv_apro_login_id:lv_apro_login_id,leave:leave,lv_apro_remarks:lv_apro_remarks},function(data){
			$("#leave_approved").modal('hide');
			$("input[name='leave']:checked").prop('checked',false);
			$("#lv_apro_remarks").val('');
			alert('Leave Update');
			location.reload();
		});
		}else{
			alert('Leave Check First');
		}
  }
  
  function leaveDisapporoved(id,emp_id,login_id){
	  $("#lv_disapro_updid").val(id);
	  $("#lv_disapro_emp_id").text(emp_id);
	  $("#lv_disapro_login_id").val(login_id);
	  $("#leave_disapproved").modal('show');  
  }
  
  function leave_disapprove_save(){
	  var lv_disapro_updid = $("#lv_disapro_updid").val();
	  var lv_disapro_login_id = $("#lv_disapro_login_id").val();
	  var leave = $("input[name='leave']:checked").val();
	  var lv_disapro_remarks = $("#lv_disapro_remarks").val();
	  
	  if(leave != undefined){	
		$.post("<?php echo base_url('leave/Leaveapproval/leave_reapproval_sv_upd'); ?>",{lv_disapro_updid:lv_disapro_updid,lv_disapro_login_id:lv_disapro_login_id,leave:leave,lv_disapro_remarks:lv_disapro_remarks},function(data){
			$("#leave_disapproved").modal('hide');
			$("input[name='leave']:checked").prop('checked',false);
			$("#lv_disapro_remarks").val('');
			alert('Leave Update');
			location.reload();
		});
		}else{
			alert('Leave Check First');
		} 
  }
  function getTotalRestLeave()
  {
    var leave_type = $('#lv_type').val();
    var tot_days   = $('#tot_days').val();
    var emp_id = $('#emp_id').text();
    $('#save_btn').prop('disabled',false);
    if(emp_id != '')
    {
      if(leave_type == 4)
      {
        $('#total_rest_leave_row').hide(1000);
        $('.mutlidatepicker').daterangepicker();
      }
      else
      {
        $.ajax({
            url: "<?php echo base_url('leave/applyleave/getTotalLeaveAtApproval'); ?>",
            data: {leave_type:leave_type,emp_id:emp_id},
            type: "POST",
            dataType: 'json',
            beforeSend:function()
            {
              $('.loader').show();
              $('body').css('opacity', '0.5');
            },
            success: function (result) {
              $('.loader').hide();
              $('body').css('opacity', '1.0');
              $('#total_rest_leave_row').show(1000);
              $('#total_rest_leave').val(result);
			  if(result < tot_days){
				  $('#save_btn').prop('disabled',true);
			  }else{
				  $('#save_btn').prop('disabled',false); 
			  }
              if(result > 0)
              {
                 $('.mutlidatepicker').daterangepicker({
                  dateLimit: {
                        'days': Number(result)-1
                    }
                });
              }
              else
              {
                $('#formid').on('keyup keypress', function(e) {
                    var keyCode = e.keyCode || e.which;
                    if (keyCode === 13) { 
                      e.preventDefault();
                      return false;
                    }
                  });
                $('#save_btn').prop('disabled',true);
              }
            }
        });
      }
    }
    else
    {
      alert("Please Select Employee First");
      $('#leave_type').val('');
    }
  }
  
  function date_srch(){
	var from_date = $("#from_date").val();  
	var to_date   = $("#to_date").val(); 
  
    $.ajax({
		url: "<?php echo base_url('leave/Leaveapproval/pendingleave_datewise'); ?>",
		type: "POST",
		data: {from_date:from_date,to_date:to_date},
		success: function(data){
			alert(data);
		}
	});  
  }
</script>