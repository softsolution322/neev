<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Enterprises_calculation extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function get_pay_details()
	{
		$adm_no  	= $this->input->post('adm_no');
		$rcpt_no 	= $this->input->post('rcpt_no');
		$ward_type  = $this->input->post('ward_type');
		$bsn		= $this->input->post('bsn');
		$bsa		= $this->input->post('bsa');
		$fee_for	= $this->input->post('fee_for');
		$date 		= $this->input->post('date1');
		//fetching data from the data base//
		$student_data = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$session 	  = $this->dbcon->select('session_master','*',"Active_Status='1'");
		$payment_mode = $this->dbcon->select('payment_mode','*');
		$bank		  = $this->dbcon->select('bank_master','*');
		$feehead_data =  $this->dbcon->select('feehead','*');
		//end of fetching of data//
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
		}
		IF(isset($stop_amt_code))
		{
			$stop_amt = $this->dbcon->select('stop_amt','*',"STOP_NO='$stop_amt_code'");
			$stoppage_amounts = $stop_amt[0]->AMT;
		}
		/* getting session year from database */
		if(isset($session))
		{
			$Session_ID = $session[0]->Session_ID;
			$Session_Nm = $session[0]->Session_Nm;
			$Session_Year = $session[0]->Session_Year;
			$Active_Status = $session[0]->Active_Status;
		}
		/* ending session data from database*/
		
		for($i=1;$i<=25;$i++)
		{
			$feehead[$i] 	= $this->dbcon->select('feehead','*',"ACT_CODE='$i'");
			$act_code[$i] 	= $feehead[$i][0]->ACT_CODE;
			$fee_head[$i] 	= $feehead[$i][0]->FEE_HEAD;
			$monthly[$i] 	= $feehead[$i][0]->MONTHLY;
			$CL_BASED[$i]	= $feehead[$i][0]->CL_BASED;
			$AccG[$i]		= $feehead[$i][0]->AccG;
			$AMOUNT[$i]		= $feehead[$i][0]->AMOUNT;
			$EMP[$i]		= $feehead[$i][0]->EMP;
			$CCL[$i]			= $feehead[$i][0]->CCL;
			$SPL[$i]			= $feehead[$i][0]->SPL;
			$EXT[$i]			= $feehead[$i][0]->EXT;
			$INTERNAL[$i]		= $feehead[$i][0]->INTERNAL;
			$HType[$i]			= $feehead[$i][0]->HType;
			$APR[$i]			= $feehead[$i][0]->APR;
			$may[$i]			= $feehead[$i][0]->may;
			$JUN[$i]			= $feehead[$i][0]->JUN;
			$JUL[$i]			= $feehead[$i][0]->JUL;
			$AUG[$i]			= $feehead[$i][0]->AUG;
			$SEP[$i]			= $feehead[$i][0]->SEP;
			$OCT[$i]			= $feehead[$i][0]->OCT;
			$NOV[$i]			= $feehead[$i][0]->NOV;
			$DECM[$i]			= $feehead[$i][0]->DECM;
			$JAN[$i]			= $feehead[$i][0]->JAN;
			$FEB[$i]			= $feehead[$i][0]->FEB;
			$MAR[$i]			= $feehead[$i][0]->MAR;
			
			// fetching data from the database //
			$feeclw   = $this->dbcon->select('fee_clw','*',"FH='$i' AND CL='$class'");
			$feeclw_AMOUNT[$i]   = $feeclw[0]->AMOUNT;
			$feeclw_EMP[$i]      = $feeclw[0]->EMP;
			$feeclw_CCL[$i]      = $feeclw[0]->CCL;
			$feeclw_SPL[$i]      = $feeclw[0]->SPL;
			$feeclw_EXT[$i]      = $feeclw[0]->EXT;
			$feeclw_INTERNAL[$i] = $feeclw[0]->INTERNAL;
			// end of the fetching data form the feeclw //
			
			if($monthly[$i]==1) // calculation for the month base fee which is old student //
			{
				if($CL_BASED[$i]==1) // calculation on the basis of class base //
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
						$amt_fee = $feeclw_CCL[$i];
						break;
						case 5:
						$amt_fee = $feeclw_SPL[$i];
						break;
						case 6:
						$amt_fee = $feeclw_EXT[$i];
						break;
						default:
						$amt_fee = 0;
						break;
									
					}
					// Checking the head type of the student //
					if($HType[$i]=='No')
					{
						$h_fee = $amt_fee;
					}
					elseif($HType[$i]=='COMPUTER')
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
					elseif($HType[$i]=='SCIENCE')
					{
						$h_fee = $amt_fee*$science;
					}
					elseif($HType[$i]=='BUS')
					{
						$h_fee = $stoppage_amounts;
					}
					ELSEIF($HType[$i]=='HOSTEL')
					{
						IF($hostel==1)
						{
							$h_fee = $amt_fee;
						}
						ELSE
						{
							$h_fee = 0;
						}
					}
					ELSEIF($HType[$i]=='BOOK')
					{
						$h_fee = $amt_fee;
					}
					ELSE
					{
						$h_fee = 0;
					}
					$amt_feehead[$i] = $h_fee;
					// End Of Checking Head Type //
				}
				else // calculation on the basis of without class base //
				{
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
					// Checking the head type of the student //
					if($HType[$i]=='No')
					{
						$h_fee = $amt_fee;
					}
					elseif($HType[$i]=='COMPUTER')
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
					elseif($HType[$i]=='SCIENCE')
					{
						$h_fee = $amt_fee*$science;
					}
					elseif($HType[$i]=='BUS')
					{
						$h_fee = $stoppage_amounts;
					}
					ELSEIF($HType[$i]=='HOSTEL')
					{
						IF($hostel==1)
						{
							$h_fee = $amt_fee;
						}
						ELSE
						{
							$h_fee = 0;
						}
					}
					ELSEIF($HType[$i]=='BOOK')
					{
						$h_fee = $amt_fee;
					}
					ELSE
					{
						$h_fee = 0;
					}
					
					$amt_feehead[$i] = $h_fee;
				}
			}
			else // calculation for the new student where fee type for one month //
			{
				if($CL_BASED[$i]==1) // calculation on the basis of class base //
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
						$amt_fee = $feeclw_CCL[$i];
						break;
						case 5:
						$amt_fee = $feeclw_SPL[$i];
						break;
						case 6:
						$amt_fee = $feeclw_EXT[$i];
						break;
						default:
						$amt_fee = 0;
						break;
									
					}
					// Checking the head type of the student //
					if($HType[$i]=='No')
					{
						$h_fee = $amt_fee;
					}
					elseif($HType[$i]=='COMPUTER')
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
					elseif($HType[$i]=='SCIENCE')
					{
						$h_fee = $amt_fee*$science;
					}
					elseif($HType[$i]=='BUS')
					{
						$h_fee = $stoppage_amounts;
					}
					ELSEIF($HType[$i]=='HOSTEL')
					{
						IF($hostel==1)
						{
							$h_fee = $amt_fee;
						}
						ELSE
						{
							$h_fee = 0;
						}
					}
					ELSEIF($HType[$i]=='BOOK')
					{
						$h_fee = $amt_fee;
					}
					ELSE
					{
						$h_fee = 0;
					}
					$amt_feehead[$i] = $h_fee;
					// End Of Checking Head Type //
				}
				else // calculation on the basis of without class base //
				{
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
					// Checking the head type of the student //
					if($HType[$i]=='No')
					{
						$h_fee = $amt_fee;
					}
					elseif($HType[$i]=='COMPUTER')
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
					elseif($HType[$i]=='SCIENCE')
					{
						$h_fee = $amt_fee*$science;
					}
					elseif($HType[$i]=='BUS')
					{
						$h_fee = $stoppage_amounts;
					}
					ELSEIF($HType[$i]=='HOSTEL')
					{
						IF($hostel==1)
						{
							$h_fee = $amt_fee;
						}
						ELSE
						{
							$h_fee = 0;
						}
					}
					ELSEIF($HType[$i]=='BOOK')
					{
						$h_fee = $amt_fee;
					}
					ELSE
					{
						$h_fee = 0;
					}
					
					$amt_feehead[$i] = $h_fee;
				}
			}
		}
		if($AccG[1] == 2)
		{
			$amt_feehead11 = $amt_feehead[1];
		}else{
			$amt_feehead11 = 0;
		}
		if($AccG[2] == 2)
		{
			$amt_feehead21 = $amt_feehead[2];
		}
		else{
			$amt_feehead21 = 0;
		}
		if($AccG[3] == 2)
		{
			$amt_feehead31 = $amt_feehead[3];
		}
		else{
			$amt_feehead31 = 0;
		}
		if($AccG[4] == 2)
		{
			$amt_feehead41 = $amt_feehead[4];
		}
		else{
			$amt_feehead41 = 0;
		}
		if($AccG[5] == 2)
		{
			$amt_feehead51 = $amt_feehead[5];
		}
		else{
			$amt_feehead51 = 0;
		}
		if($AccG[6] == 2)
		{
			$amt_feehead61 = $amt_feehead[6];
		}
		else{
			$amt_feehead61 = 0;
		}
		if($AccG[7] == 2)
		{
			$amt_feehead71 = $amt_feehead[7];
		}
		else{
			$amt_feehead71 = 0;
		}
		if($AccG[8] == 2)
		{
			$amt_feehead81 = $amt_feehead[8];
		}
		else{
			$amt_feehead81 = 0;
		}
		if($AccG[9] == 2)
		{
			$amt_feehead91 = $amt_feehead[9];
		}
		else{
			$amt_feehead91 = 0;
		}
		if($AccG[10] == 2)
		{
			$amt_feehead101 = $amt_feehead[10];
		}
		else{
			$amt_feehead101 = 0;
		}
		if($AccG[11] == 2)
		{
			$amt_feehead111 = $amt_feehead[11];
		}
		else{
			$amt_feehead111 = 0;
		}
		if($AccG[12] == 2)
		{
			$amt_feehead121 = $amt_feehead[12];
		}
		else{
			$amt_feehead121 = 0;
		}
		if($AccG[13] == 2)
		{
			$amt_feehead131 = $amt_feehead[13];
		}
		else{
			$amt_feehead131 = 0;
		}
		if($AccG[14] == 2)
		{
			$amt_feehead141 = $amt_feehead[14];
		}
		else{
			$amt_feehead141 = 0;
		}
		if($AccG[15] == 2)
		{
			$amt_feehead151 = $amt_feehead[15];
		}
		else{
			$amt_feehead151 = 0;
		}
		if($AccG[16] == 2)
		{
			$amt_feehead161 = $amt_feehead[16];
		}
		else{
			$amt_feehead161 = 0;
		}
		if($AccG[17] == 2)
		{
			$amt_feehead171 = $amt_feehead[17];
		}
		else{
			$amt_feehead171 = 0;
		}
		if($AccG[18] == 2)
		{
			$amt_feehead181 = $amt_feehead[18];
		}
		else{
			$amt_feehead181 = 0;
		}
		if($AccG[19] == 2)
		{
			$amt_feehead191 = $amt_feehead[19];
		}
		else{
			$amt_feehead191 = 0;
		}
		if($AccG[20] == 2)
		{
			$amt_feehead201 = $amt_feehead[20];
		}
		else{
			$amt_feehead201 = 0;
		}
		if($AccG[21] == 2)
		{
			$amt_feehead211 = $amt_feehead[21];
		}
		else{
			$amt_feehead211 = 0;
		}
		if($AccG[22] == 2)
		{
			$amt_feehead221 = $amt_feehead[22];
		}
		else{
			$amt_feehead221 = 0;
		}
		if($AccG[23] == 2)
		{
			$amt_feehead231 = $amt_feehead[23];
		}
		else{
			$amt_feehead231 = 0;
		}
		if($AccG[24] == 2)
		{
			$amt_feehead241 = $amt_feehead[24];
		}
		else{
			$amt_feehead241 = 0;
		}
		if($AccG[25] == 2)
		{
			$amt_feehead251 = $amt_feehead[25];
		}
		else{
			$amt_feehead251 = 0;
		}
		$fee_cal = array(
				'1' => $amt_feehead[1],
				'2' => $amt_feehead[2],
				'3' => $amt_feehead[3],
				'4' => $amt_feehead[4],
				'5' => $amt_feehead[5],
				'6' => $amt_feehead[6],
				'7' => $amt_feehead[7],
				'8' => $amt_feehead[8],
				'9' => $amt_feehead[9],
				'10' => $amt_feehead[10],
				'11' => $amt_feehead[11],
				'12' => $amt_feehead[12],
				'13' => $amt_feehead[13],
				'14' => $amt_feehead[14],
				'15' => $amt_feehead[15],
				'16' => $amt_feehead[16],
				'17' => $amt_feehead[17],
				'18' => $amt_feehead[18],
				'19' => $amt_feehead[19],
				'20' => $amt_feehead[20],
				'21' => $amt_feehead[21],
				'22' => $amt_feehead[22],
				'23' => $amt_feehead[23],
				'24' => $amt_feehead[24],
				'25' => $amt_feehead[25]
		);
		$array = array(
				'adm_no' 	=> $admission_no,
				'fee_cal' =>$fee_cal,
				'payment_mode'  => $payment_mode,
				'bank'			=> $bank,
				'rcpt_no'		=> $rcpt_no,
				'student_data'	=> $student_data,
				'ward_type'     => $ward_type,
				'bsn'           => $bsn,
				'bsa'			=> $bsa,
				'fee_for'		=> $fee_for,
				'date'			=> $date,
				'feehead_data'  => $feehead_data
			);
			// echo "<pre>";
			// print_r($array);die;
			$this->load->view('sunil_enterprises/feehaead_calculation_monthwise',$array);
	}
}