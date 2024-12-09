<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Online_paymentcal extends MY_Controller{
	public function __construct(){     
		parent:: __construct();
	    $this->load->model('Farheen','farheen');
	}
	public function show_student()
	{
	    $adm_no  	= $this->input->post('adm');
		//$ward_type  = $this->input->post('ward_type');
		//$bsn		= $this->input->post('bsn');
		//$bsa		= $this->input->post('bsa');
		//$ffm		= $this->input->post('ffm');
		
		$mnth = serialize($this->input->post('chkbox'));
		$month_data = unserialize($mnth);
		
		$student_data = $this->farheen->select('student','*',"ADM_NO='$adm_no'");
		$session 	  = $this->farheen->select('session_master','*',"Active_Status='1'");
		$payment_mode = $this->farheen->select('payment_mode','*');
		$bank		  = $this->farheen->select('bank_master','*');
		
		if(isset($student_data))
		{
			$admission_no = $student_data[0]->ADM_NO;
			$emp_ward     = $student_data[0]->EMP_WARD;
			$class        = $student_data[0]->CLASS;
			$hostel       = $student_data[0]->HOSTEL;
			$COMPUTER     = $student_data[0]->COMPUTER;
			$SESSIONID    = $student_data[0]->SESSIONID;
			$SCHOLAR      = $student_data[0]->SCHOLAR;
			$science	  = $student_data[0]->BUS_NO;
			$stop_amt_code= $student_data[0]->STOPNO;
			$stu_aprfee   = $student_data[0]->APR_FEE;
			$adm_status   = $student_data[0]->mid_session_admisson_status;
			$Admission_month = $student_data[0]->Admission_month;
			
			if(isset($session))
		{
			$Session_ID = $session[0]->Session_ID;
			$Session_Nm = $session[0]->Session_Nm;
			$Session_Year = $session[0]->Session_Year;
			$Active_Status = $session[0]->Active_Status;
		}
			
			if($SCHOLAR==1)
		  {
			$scholar_data = $this->farheen->select('scholarship','*',"ADM_NO='$admission_no'");
		    $Apply_From = $scholar_data[0]->Apply_From;
			$Apply_From_ID = $scholar_data[0]->AWARDED;
		  }
		  $cnt=0;
		  $h_fee = 0;
		  $t=0;
		  $total_amt=0;
		  $final_amount = array();
			$monthh = array();
			foreach($month_data as $key => $value)
		    {
				
			     $month = $value;
				 $monthh[] = $value;
				 $mnt = implode("','",$monthh);
				
				$mnth_det = $this->db->query("select month_name from month_master where id IN('$mnt')")->result();
				//print_r($mnth_det);
				$mnttr = array();
				
		    foreach($mnth_det as $key => $val)
			{
				
				$mnttr[].=$val->month_name;
				
		    }
				$mntt = implode("-",$mnttr);
				
			 $cnt++;
		for($i=1;$i<=25;$i++)
		{
			$t=0;
			$h_fee = 0;
		    $feehead[$i] 	= $this->farheen->select('feehead','*',"ACT_CODE='$i' AND AccG=1");
			@$act_code[$i] 	= $feehead[$i][0]->ACT_CODE;
			@$fee_head[$i] 	= $feehead[$i][0]->FEE_HEAD;
			@$monthly[$i] 	= $feehead[$i][0]->MONTHLY;
			@$CL_BASED[$i]	= $feehead[$i][0]->CL_BASED;
			@$AMOUNT[$i]		= $feehead[$i][0]->AMOUNT;
			@$EMP[$i]		= $feehead[$i][0]->EMP;
			@$CCL[$i]			= $feehead[$i][0]->CCL;
			@$SPL[$i]			= $feehead[$i][0]->SPL;
			@$EXT[$i]			= $feehead[$i][0]->EXT;
			@$INTERNAL[$i]		= $feehead[$i][0]->INTERNAL;
			@$HType[$i]			= $feehead[$i][0]->HType;
			@$APR[$i]			= $feehead[$i][0]->APR;
			@$may[$i]			= $feehead[$i][0]->may;
			@$JUN[$i]			= $feehead[$i][0]->JUN;
			@$JUL[$i]			= $feehead[$i][0]->JUL;
			@$AUG[$i]			= $feehead[$i][0]->AUG;
			@$SEP[$i]			= $feehead[$i][0]->SEP;
			@$OCT[$i]			= $feehead[$i][0]->OCT;
			@$NOV[$i]			= $feehead[$i][0]->NOV;
			@$DECM[$i]			= $feehead[$i][0]->DECM;
			@$JAN[$i]			= $feehead[$i][0]->JAN;
			@$FEB[$i]			= $feehead[$i][0]->FEB;
			@$MAR[$i]			= $feehead[$i][0]->MAR;
			@$Annual[$i]         = $feehead[$i][0]->Annual;
			
			$feehead1 = $this->db->query("select * from feehead order by ACT_CODE asc")->result();
			//fetching data from feeclw//
		    $feeclw   = $this->farheen->select('fee_clw','*',"FH='$i' AND CL='$class'");
			$feeclw_AMOUNT[$i]   = $feeclw[0]->AMOUNT;
			$feeclw_EMP[$i]      = $feeclw[0]->EMP;
			$feeclw_CCL[$i]      = $feeclw[0]->CCL;
			$feeclw_SPL[$i]      = $feeclw[0]->SPL;
			$feeclw_EXT[$i]      = $feeclw[0]->EXT;
			$feeclw_INTERNAL[$i] = $feeclw[0]->INTERNAL;
			
			if($monthly[$i] == 1) // calculation on the basis of month base //
			{	
			  $mnth_val = $this->farheen->feehead_mnth($month,$i);
			  $fhead_mnth =  $mnth_val[0]->mnth;
			  if($fhead_mnth == 1)
			  {
				  if($CL_BASED[$i] == 1) // calculation on the basis of class base //
				  {
					switch($emp_ward)
						{
							case 1:
							$amt_fee = $feeclw_AMOUNT[$i];
							break;
							case 2:
							$amt_fee = $feeclw_EMP[$i];
							break;
							case 3:
							$amt_fee = $feeclw_CCL[$i];
							break;
							case 4:
							$amt_fee = $feeclw_SPL[$i];
							break;
							case 5:
							$amt_fee = $feeclw_EXT[$i];
							break;
							case 6:
							$amt_fee = $feeclw_INTERNAL[$i];
							break;
							default:
							$amt_fee = 0;
							break;
										
						}
						
						if($SCHOLAR==1) // calculation on the basis of the scholarship //
						{
							$scholar = $this->farheen->scholar_data($act_code[$i],$adm_no,$Apply_From_ID);
							@$scholar_val =  $scholar[0]->schl;
							
							if($HType[$i] == 'No')
								{
									$h_fee = $amt_fee ;
								}
								elseif($HType[$i] == 'COMPUTER')
								{
									if($COMPUTER==1)
										{
											$h_fee = $amt_fee ;
										}
										else
										{
											$h_fee = 0;
										}
								}
								elseif($HType[$i] == 'BUS')
								{
									$bus_fee = $this->farheen->getbusamountmonthwise($adm_no,$month);
									$h_fee = $bus_fee[0]->BUSAMOUNT;
								}
								elseif($HType[$i] == 'SCIENCE')
								{
									$h_fee = ($amt_fee*$science) ;
								}
								elseif($HType[$i] == 'LATEFINE')
								{
									
									$late_fine = $this->farheen->selectSingleData('latefine_master','*',"ID='1'");
									$l_status = $late_fine->status;
									$l_collection_mode = $late_fine->collection_mode;
									$l_month_applied = $late_fine->month_applied;
									$l_date_applied = $late_fine->date_applied;
									$l_late_amount = $late_fine->late_amount;
									$current_month = date('m');
									$sys_date = date('d');
									if($month==1)
									{
										$m=4;
									}elseif($month==2)
									{
										$m=5;
									}elseif($month==3)
									{
										$m=6;
									}
									elseif($month==4)
									{
										$m=7;
									}elseif($month==5)
									{
										$m=8;
									}elseif($month==6)
									{
										$m=9;
									}elseif($month==7)
									{
										$m=10;
									}
									elseif($month==8)
									{
										$m=11;
									}
									elseif($month==9)
									{
										$m=12;
									}
									elseif($month==10)
									{
										$m=1;
									}
									elseif($month==11)
									{
										$m=2;
									}
									elseif($month==12)
									{
										$m=3;
									}
									
									$diff=$current_month-$m;
									
									if($l_status == 1)
									{
										
										if($diff<0)
										{
											
											$late_fee = $l_late_amount;
										}
										elseif($diff=0)
										{
											
											if($l_date_applied<=$sys_date)
											{
										
											   $late_fee = $l_late_amount;
											}
											else
											{	
												
												 $late_fee = 0;
											}
										}								
										else
										{
											
											 $late_fee = 0;
										}
										
										   $h_fee=$late_fee;
										
									}
									else
									{
										$h_fee = 0;
									} 
								}
								
								elseif($HType[$i] == 'HOSTEL')
								{
									$h_fee = 0;
								}
								if($h_fee>0){
								if($scholar_val<=$h_fee)
								{
										$h_fee = $h_fee -$scholar_val;
								}
								else{
										$h_fee;
									}								
			                 	}
								
						}
						else
						{
							
							//Non Scholarship 
								if($HType[$i] == 'No')
								{
									$h_fee = $amt_fee;
								}
								elseif($HType[$i] == 'COMPUTER')
								{
									if($COMPUTER==1)
										{
											$h_fee = $amt_fee;
										}
										else
										{
											$h_fee = 0;
										}
								}
								elseif($HType[$i] == 'BUS')
								{
									$bus_fee = $this->farheen->getbusamountmonthwise($adm_no,$month);
									$h_fee = $bus_fee[0]->BUSAMOUNT;
									
								}
								elseif($HType[$i] == 'SCIENCE')
								{
									$h_fee = $amt_fee*$science;
								}
								elseif($HType[$i] == 'LATEFINE')
								{
									
									$late_fine = $this->farheen->selectSingleData('latefine_master','*',"ID='1'");
									$l_status = $late_fine->status;
									$l_collection_mode = $late_fine->collection_mode;
									$l_month_applied = $late_fine->month_applied;
									$l_date_applied = $late_fine->date_applied;
									$l_late_amount = $late_fine->late_amount;
									$current_month = date('m');
									$sys_date = date('d');
									if($month==1)
									{
										$m=4;
									}elseif($month==2)
									{
										$m=5;
									}elseif($month==3)
									{
										$m=6;
									}
									elseif($month==4)
									{
										$m=7;
									}elseif($month==5)
									{
										$m=8;
									}elseif($month==6)
									{
										$m=9;
									}elseif($month==7)
									{
										$m=10;
									}
									elseif($month==8)
									{
										$m=11;
									}
									elseif($month==9)
									{
										$m=12;
									}
									elseif($month==10)
									{
										$m=1;
									}
									elseif($month==11)
									{
										$m=2;
									}
									elseif($month==12)
									{
										$m=3;
									}
									
									$diff=$current_month-$m;
									
									if($l_status == 1)
									{
										
										if($diff<0)
										{
											
											$late_fee = $l_late_amount;
										}
										elseif($diff=0)
										{
											
											if($l_date_applied<=$sys_date)
											{
											   $late_fee = $l_late_amount;
											}
											else
											{	
												 $late_fee = 0;
											}
										}								
										else
										{
											
											 $late_fee = 0;
										}
										
										   $h_fee=$late_fee;
										
									}
									else
									{
										$h_fee = 0;
									} 
								}
								elseif($HType[$i] == 'BOOK')
								{
									$h_fee = 0;
								}
								elseif($HType[$i] == 'DUES')
								{
									$h_fee = 0;
								}
								elseif($HType[$i] == 'HOSTEL')
								{
									$h_fee = 0;
								}
						}
						
				}
				else
				{
					//Non class base
					switch($emp_ward)
						{
							case 1:
							$amt_fee = $AMOUNT[$i];
							break;
							case 2:
							$amt_fee = $EMP[$i];
							break;
							case 3:
							$amt_fee = $CCL[$i];
							break;
							case 4:
							$amt_fee = $SPL[$i];
							break;
							case 5:
							$amt_fee = $EXT[$i];
							break;
							case 6:
							$amt_fee = $INTERNAL[$i];
							break;
							default:
							$amt_fee = 0;
							break;
										
						}
						
						if($SCHOLAR==1) // calculation on the basis of the scholarship //
						{
							$scholar = $this->farheen->scholar_data($act_code[$i],$adm_no,$Apply_From_ID);
							@$scholar_val =  $scholar[0]->schl;
							
							if($HType[$i] == 'No')
								{
									$h_fee = $amt_fee ;
								}
								elseif($HType[$i] == 'COMPUTER')
								{
									if($COMPUTER==1)
										{
											$h_fee = $amt_fee ;
										}
										else
										{
											$h_fee = 0;
										}
								}
								elseif($HType[$i] == 'BUS')
								{
									$bus_fee = $this->farheen->getbusamountmonthwise($adm_no,$month);
									$h_fee = $bus_fee[0]->BUSAMOUNT;
								}
								elseif($HType[$i] == 'SCIENCE')
								{
									$h_fee = ($amt_fee*$science) ;
								}
								elseif($HType[$i] == 'LATEFINE')
								{
									
									$late_fine = $this->farheen->selectSingleData('latefine_master','*',"ID='1'");
									$l_status = $late_fine->status;
									$l_collection_mode = $late_fine->collection_mode;
									$l_month_applied = $late_fine->month_applied;
									$l_date_applied = $late_fine->date_applied;
									$l_late_amount = $late_fine->late_amount;
									$current_month = date('m');
									$sys_date = date('d');
									if($month==1)
									{
										$m=4;
									}elseif($month==2)
									{
										$m=5;
									}elseif($month==3)
									{
										$m=6;
									}
									elseif($month==4)
									{
										$m=7;
									}elseif($month==5)
									{
										$m=8;
									}elseif($month==6)
									{
										$m=9;
									}elseif($month==7)
									{
										$m=10;
									}
									elseif($month==8)
									{
										$m=11;
									}
									elseif($month==9)
									{
										$m=12;
									}
									elseif($month==10)
									{
										$m=1;
									}
									elseif($month==11)
									{
										$m=2;
									}
									elseif($month==12)
									{
										$m=3;
									}
									
									$diff=$current_month-$m;
									
									if($l_status == 1)
									{
										
										if($diff<0)
										{
											
											$late_fee = $l_late_amount;
										}
										elseif($diff=0)
										{
											
											if($l_date_applied<=$sys_date)
											{
											   $late_fee = $l_late_amount;
											}
											else
											{	
												 $late_fee = 0;
											}
										}								
										else
										{
											
											 $late_fee = 0;
										}
										
										   $h_fee=$late_fee;
										
									}
									else
									{
										$h_fee = 0;
									} 
								}
								
								elseif($HType[$i] == 'HOSTEL')
								{
									$h_fee = 0;
								}
								if($h_fee>0){
								if($scholar_val<=$h_fee)
								{
										$h_fee = $h_fee - $scholar_val;
								}
								else{
										$h_fee;
									}								
			                 	}
								
						}
						else{    // calculation on the basis of without scholarship //
							
							if($HType[$i] == 'No')
								{
									$h_fee = $amt_fee;
								}
								elseif($HType[$i] == 'COMPUTER')
								{
									if($COMPUTER==1)
										{
											$h_fee = $amt_fee;
										}
										else
										{
											$h_fee = 0;
										}
								}
								elseif($HType[$i] == 'BUS')
								{
									$bus_fee = $this->farheen->getbusamountmonthwise($adm_no,$month);
									@$h_fee = $bus_fee[0]->BUSAMOUNT;
								}
								elseif($HType[$i] == 'SCIENCE')
								{
									$h_fee = $amt_fee*$science;
								}
								elseif($HType[$i] == 'LATEFINE')
								{
									
									$late_fine = $this->farheen->selectSingleData('latefine_master','*',"ID='1'");
									$l_status = $late_fine->status;
									$l_collection_mode = $late_fine->collection_mode;
									$l_month_applied = $late_fine->month_applied;
									$l_date_applied = $late_fine->date_applied;
									$l_late_amount = $late_fine->late_amount;
								    $current_month = date('m');
									$sys_date = date('d');
									if($month==1)
									{
										$m=4;
									}elseif($month==2)
									{
										$m=5;
									}elseif($month==3)
									{
										$m=6;
									}
									elseif($month==4)
									{
										$m=7;
									}elseif($month==5)
									{
										$m=8;
									}elseif($month==6)
									{
										$m=9;
									}elseif($month==7)
									{
										$m=10;
									}
									elseif($month==8)
									{
										$m=11;
									}
									elseif($month==9)
									{
										$m=12;
									}
									elseif($month==10)
									{
										$m=1;
									}
									elseif($month==11)
									{
										$m=2;
									}
									elseif($month==12)
									{
										$m=3;
									}
									
									$diff=$current_month-$m;
									
									if($l_status == 1)
									{
										
										if($diff<0)
										{
											
											$late_fee = $l_late_amount;
										}
										elseif($diff=0)
										{
											
											if($l_date_applied<=$sys_date)
											{
											   $late_fee = $l_late_amount;
											}
											else
											{	
												 $late_fee = 0;
											}
										}								
										else
										{
											
											 $late_fee = 0;
										}
										
										   $h_fee=$late_fee;
										
									}
									else
									{
										$h_fee = 0;
									} 
								}
								elseif($HType[$i] == 'BOOK')
								{
									$h_fee = 0;
								}
								elseif($HType[$i] == 'DUES')
								{
									$h_fee = 0;
								}
								elseif($HType[$i] == 'HOSTEL')
								{
									$h_fee = 0;
								}
							
						}
					
				}
			  }
			  else
			  {
				 // echo 'if month is not Condition for new admission fee';
				 
			  }
				
			
			}
			else
			{
				if($CL_BASED[$i] == 1) // calculation on the basis of class base //
				{
					switch($emp_ward)
						{
							case 1:
							$amt_fee = $feeclw_AMOUNT[$i];
							break;
							case 2:
							$amt_fee = $feeclw_EMP[$i];
							break;
							case 3:
							$amt_fee = $feeclw_CCL[$i];
							break;
							case 4:
							$amt_fee = $feeclw_SPL[$i];
							break;
							case 5:
							$amt_fee = $feeclw_EXT[$i];
							break;
							case 6:
							$amt_fee = $feeclw_INTERNAL[$i];
							break;
							default:
							$amt_fee = 0;
							break;
										
						}
						
						if($SCHOLAR==1) // calculation on the basis of the scholarship //
						{
							$scholar = $this->farheen->scholar_data($act_code[$i],$adm_no,$Apply_From_ID);
							@$scholar_val =  $scholar[0]->schl;
							
							if($HType[$i] == 'No')
								{
									if($Session_Year==$SESSIONID)
									{
									if($fhead_mnth == 1)
			                        {
									
									$h_fee = $amt_fee;
									}
									else
									{
									  $h_fee = 0;
									}
									}
								}
								elseif($HType[$i] == 'COMPUTER')
								{
									if($COMPUTER==1)
										{
											$h_fee = $amt_fee ;
										}
										else
										{
											$h_fee = 0;
										}
								}
								elseif($HType[$i] == 'BUS')
								{
									$bus_fee = $this->farheen->getbusamountmonthwise($adm_no,$month);
									$h_fee = $bus_fee[0]->BUSAMOUNT;
								}
								elseif($HType[$i] == 'SCIENCE')
								{
									$h_fee = ($amt_fee*$science) ;
								}
								elseif($HType[$i] == 'LATEFINE')
								{
									
									$late_fine = $this->farheen->selectSingleData('latefine_master','*',"ID='1'");
									$l_status = $late_fine->status;
									$l_collection_mode = $late_fine->collection_mode;
									$l_month_applied = $late_fine->month_applied;
									$l_date_applied = $late_fine->date_applied;
									$l_late_amount = $late_fine->late_amount;
									$current_month = date('m');
									$sys_date = date('d');
									if($month==1)
									{
										$m=4;
									}elseif($month==2)
									{
										$m=5;
									}elseif($month==3)
									{
										$m=6;
									}
									elseif($month==4)
									{
										$m=7;
									}elseif($month==5)
									{
										$m=8;
									}elseif($month==6)
									{
										$m=9;
									}elseif($month==7)
									{
										$m=10;
									}
									elseif($month==8)
									{
										$m=11;
									}
									elseif($month==9)
									{
										$m=12;
									}
									elseif($month==10)
									{
										$m=1;
									}
									elseif($month==11)
									{
										$m=2;
									}
									elseif($month==12)
									{
										$m=3;
									}
									
									$diff=$current_month-$m;
									
									if($l_status == 1)
									{
										
										if($diff<0)
										{
											
											$late_fee = $l_late_amount;
										}
										elseif($diff=0)
										{
											
											if($l_date_applied<=$sys_date)
											{
										
											   $late_fee = $l_late_amount;
											}
											else
											{	
												
												 $late_fee = 0;
											}
										}								
										else
										{
											
											 $late_fee = 0;
										}
										
										   $h_fee=$late_fee;
										
									}
									else
									{
										$h_fee = 0;
									} 
								}
								
								elseif($HType[$i] == 'HOSTEL')
								{
									$h_fee = 0;
								}
								if($h_fee>0){
								if($scholar_val<=$h_fee)
								{
										$h_fee = $h_fee -$scholar_val;
								}
								else{
										$h_fee;
									}								
			                 	}
								
						}
						else
						{
							
							//Non Scholarship 
								if($HType[$i] == 'No')
								{
									if($Session_Year==$SESSIONID)
									{
									if($fhead_mnth == 1)
			                        {
									
									$h_fee = $amt_fee;
									}
									else
									{
									  $h_fee = 0;
									}
									}
									
								}
								elseif($HType[$i] == 'COMPUTER')
								{
									if($COMPUTER==1)
										{
											$h_fee = $amt_fee;
										}
										else
										{
											$h_fee = 0;
										}
								}
								elseif($HType[$i] == 'BUS')
								{
									$bus_fee = $this->farheen->getbusamountmonthwise($adm_no,$month);
									$h_fee = $bus_fee[0]->BUSAMOUNT;
								}
								elseif($HType[$i] == 'SCIENCE')
								{
									$h_fee = $amt_fee*$science;
								}
								elseif($HType[$i] == 'LATEFINE')
								{
									
									$late_fine = $this->farheen->selectSingleData('latefine_master','*',"ID='1'");
									$l_status = $late_fine->status;
									$l_collection_mode = $late_fine->collection_mode;
									$l_month_applied = $late_fine->month_applied;
									$l_date_applied = $late_fine->date_applied;
									$l_late_amount = $late_fine->late_amount;
									$current_month = date('m');
									$sys_date = date('d');
									if($month==1)
									{
										$m=4;
									}elseif($month==2)
									{
										$m=5;
									}elseif($month==3)
									{
										$m=6;
									}
									elseif($month==4)
									{
										$m=7;
									}elseif($month==5)
									{
										$m=8;
									}elseif($month==6)
									{
										$m=9;
									}elseif($month==7)
									{
										$m=10;
									}
									elseif($month==8)
									{
										$m=11;
									}
									elseif($month==9)
									{
										$m=12;
									}
									elseif($month==10)
									{
										$m=1;
									}
									elseif($month==11)
									{
										$m=2;
									}
									elseif($month==12)
									{
										$m=3;
									}
									
									$diff=$current_month-$m;
									
									if($l_status == 1)
									{
										
										if($diff<0)
										{
											
											$late_fee = $l_late_amount;
										}
										elseif($diff=0)
										{
											
											if($l_date_applied<=$sys_date)
											{
											   $late_fee = $l_late_amount;
											}
											else
											{	
												 $late_fee = 0;
											}
										}								
										else
										{
											
											 $late_fee = 0;
										}
										
										   $h_fee=$late_fee;
										
									}
									else
									{
										$h_fee = 0;
									} 
								}
								elseif($HType[$i] == 'BOOK')
								{
									$h_fee = 0;
								}
								elseif($HType[$i] == 'DUES')
								{
									$h_fee = 0;
								}
								elseif($HType[$i] == 'HOSTEL')
								{
									$h_fee = 0;
								}
						}
				}
				else{
					
				}
			}
			
			if($cnt==1)
				{
				$final_amount[$i]=$h_fee;	
				}
				else{
					$t=$final_amount[$i];
					$final_amount[$i]=$t+$h_fee;
				}
			
		     }
			}
			
			for($i=1;$i<=25;$i++)
			{
				"feehead".$i."->".$final_amount[$i]."<br/>";
				
				$total_amt +=  $final_amount[$i];
			}
			
			$total_amount = $final_amount[1]+$final_amount[2]+$final_amount[3]+$final_amount[4]+$final_amount[5]+$final_amount[6]+$final_amount[7]+$final_amount[8]+$final_amount[9]+$final_amount[10]+$final_amount[11]+$final_amount[12]+$final_amount[13]+$final_amount[14]+$final_amount[15]+$final_amount[16]+$final_amount[17]+$final_amount[18]+$final_amount[19]+$final_amount[20]+$final_amount[21]+$final_amount[22]+$final_amount[23]+$final_amount[24]+$final_amount[25];
   
			$this->session->set_userdata('total_amountt',$total_amount);
            $this->session->set_userdata('adm_no',$adm_no);
			$this->session->set_userdata('ffms',$mntt);
			$fee_amount = array(
			'amt_feehead1' => $final_amount[1],
			
			'amt_feehead2' => $final_amount[2],
			'amt_feehead3' => $final_amount[3],
			'amt_feehead4' => $final_amount[4],
			'amt_feehead5' => $final_amount[5],
			'amt_feehead6' => $final_amount[6],
			'amt_feehead7' => $final_amount[7],
			'amt_feehead8' => $final_amount[8],
			'amt_feehead9' => $final_amount[9],
			'amt_feehead10' => $final_amount[10],
			'amt_feehead11' => $final_amount[11],
			'amt_feehead12' => $final_amount[12],
			'amt_feehead13' => $final_amount[13],
			'amt_feehead14' => $final_amount[14],
			'amt_feehead15' => $final_amount[15],
			'amt_feehead16' => $final_amount[16],
			'amt_feehead17' => $final_amount[17],
			'amt_feehead18' => $final_amount[18],
			'amt_feehead19' => $final_amount[19],
			'amt_feehead20' => $final_amount[20],
			'amt_feehead21' => $final_amount[21],
			'amt_feehead22' => $final_amount[22],
			'amt_feehead23' => $final_amount[23],
			'amt_feehead24' => $final_amount[24],
			'amt_feehead25' => $final_amount[25],
		);
			$array = array(
				
				'fee_amount' => $fee_amount,
				'total_amount'  => $total_amount,
				'student_details' => $student_data,
				'ffm'			=> $mntt,
				'feehead' => $feehead1
			);
			
			$this->Parent_templete('parents_dashboard/onpay_details',$array);
		}
	}
	
	public function payment()
	{
		$st_class = $this->input->post('st_class');
	    $fee1 = $this->input->post('fee[1]');
		$fee2 = $this->input->post('fee[2]');
		$fee3 = $this->input->post('fee[3]');
		$fee4 = $this->input->post('fee[4]');
		$fee5 = $this->input->post('fee[5]');
		$fee6 = $this->input->post('fee[6]');
		$fee7 = $this->input->post('fee[7]');
		$fee8 = $this->input->post('fee[8]');
		$fee9 = $this->input->post('fee[9]');
		$fee10 = $this->input->post('fee[10]');
		$fee11 = $this->input->post('fee[11]');
		$fee12 = $this->input->post('fee[12]');
		$fee13 = $this->input->post('fee[13]');
		$fee14 = $this->input->post('fee[14]');
		$fee15 = $this->input->post('fee[15]');
		$fee16 = $this->input->post('fee[16]');
		$fee17 = $this->input->post('fee[17]');
		$fee18 = $this->input->post('fee[18]');
		$fee19 = $this->input->post('fee[19]');
		$fee20 = $this->input->post('fee[20]');
		$fee21 = $this->input->post('fee[21]');
		$fee22 = $this->input->post('fee[22]');
		$fee23 = $this->input->post('fee[23]');
		$fee24 = $this->input->post('fee[24]');
		$fee25 = $this->input->post('fee[25]');
		
		$ffm = $this->session->userdata('ffms');
		$adm_no = $this->session->userdata('adm_no');
		$substr1 = substr($ffm,0,3);
		
		$exitsData = $this->farheen->select('daycoll','count(*)cnt',"ADM_NO='$adm_no' AND PERIOD LIKE '%$substr1%' and substr(period,1,3)<>'PRE'");
		$cnt = $exitsData[0]->cnt;
		
		if($cnt == 0)
		{
	    
		$this->session->set_userdata('merchant_id','251444');
		$this->session->set_userdata('currency','INR');
		$this->session->set_userdata('redirect_url','http://bachpananantpur.org/bachpan_erp/Onparent_details/respon');
		$this->session->set_userdata('cancel_url','http://bachpananantpur.org/bachpan_erp/Onparent_details/pay_details');
		$this->session->set_userdata('language','EN');
		
		$tid = strtotime('now').rand(0,1000);
		$this->session->set_userdata('tid',$tid);
		//$adm_no = $this->session->userdata('adm_no');
		$data['tid'] = $this->session->userdata('tid');
		$data['adm_no'] = $this->session->userdata('adm_no');
		$data['total_amountt'] = $this->session->userdata('total_amountt');
		
		$data['merchant_id'] = $this->session->userdata('merchant_id');
		$data['currency'] = $this->session->userdata('currency');
		$data['redirect_url'] = $this->session->userdata('redirect_url');
		$data['cancel_url'] = $this->session->userdata('cancel_url');
		$data['language'] = $this->session->userdata('language');
		$stu_det = $this->db->query("select FATHER_NM,PERM_ADD,P_PIN,P_CITY,P_STATE,P_MOBILE,P_EMAIL from student where ADM_NO='$adm_no'")->result();
		
         $stu_detail = $this->db->query("select * from student where ADM_NO='$adm_no' and Student_Status='ACTIVE'")->result();
		
		$today_date = date('Y-m-d H:i:s');
		$ins_data = array(
			
			'order_id' => $tid,
			'merchant_id' => $data['merchant_id'],
			'pay_amount' => $data['total_amountt'],
			'trans_date' => $today_date,
			'payment_status' => 'req_sent',
			
			'STU_NAME' => $stu_detail[0]->FIRST_NM.' '.$stu_detail[0]->MIDDLE_NM,
			'STUDENTID' => $stu_detail[0]->STUDENTID,
			'ADM_NO' => $adm_no,
			'CLASS' => $stu_detail[0]->DISP_CLASS,
			'SEC' => $stu_detail[0]->DISP_SEC,
			'ROLL_NO' => $stu_detail[0]->ROLL_NO,
			'PERIOD' => $ffm,
			'TOTAL' => $data['total_amountt'],
			'fee1' => $fee1,
			'fee2' => $fee2,
			'fee3' => $fee3,
			'fee4' => $fee4,
			'fee5' => $fee5,
			'fee6' => $fee6,
			'fee7' => $fee7,
			'fee8' => $fee8,
			'fee9' => $fee9,
			'fee10' => $fee10,
			'fee11' => $fee11,
			'fee12' => $fee12,
			'fee13' => $fee13,
			'fee14' => $fee14,
			'fee15' => $fee15,
			'fee16' => $fee16,
			'fee17' => $fee17,
			'fee18' => $fee18,
			'fee19' => $fee19,
			'fee20' => $fee20,
			'fee21' => $fee21,
			'fee22' => $fee22,
			'fee23' => $fee23,
			'fee24' => $fee24,
			'fee25' => $fee25,
		    'Collection_Mode' => 3,
			'Payment_Mode' => 'ONLINE',
			'Bank_Name' => 'CC Avenue',
            'User_Id'         => $adm_no,
             'CHQ_NO' => $tid,
             'Narr' => 'N/A',
             'TAmt' => 0,
             'Fee_Book_No' => 0,
			);
		
			$this->farheen->insert('online_transaction',$ins_data);
	
		$this->Parent_templete('paykit/ccavRequestHandler');
		}
		else
		{
			echo "<h2 style='text-align:center;color:red;'>Fee for this month is already paid for selected student !!!!!</h2>";
    
			die();
		}
	}
}