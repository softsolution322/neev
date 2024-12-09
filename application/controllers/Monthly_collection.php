<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Monthly_collection extends MY_controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
		$this->load->model('Farheen','farheen');
		$this->load->model('Alam','alam');
	}

	public function month_collection()
	{
		$stu_adm = $this->dbcon->select('student','ADM_NO',"Student_Status='ACTIVE'");
		$array = array(
			'stu_adm' => $stu_adm
		);
		$this->fee_template('Fee_collection/monthly_collection',$array);
	}

	public function monthly_adm_data()
	{
		$adm_no = $this->input->post('val');
		$stu_data = $this->dbcon->select('student','*',"ADM_NO='$adm_no' AND Student_Status='ACTIVE'");
		if(!empty($stu_data)){
			$stu_id = $stu_data[0]->STUDENTID;
		}else{
			$stu_id = "n/a";
		}
		$pre_dues = $this->dbcon->select('previous_year_feegeneration','sum(TOTAL)TOTAL',"ADM_NO='$adm_no'");
		$pre_dues_amt = $pre_dues[0]->TOTAL;
		if($pre_dues_amt == null){
			$pre_dues1 = 0;
		}else{
			$pre_dues1 = $pre_dues_amt;
		}
		
		$cnt=count($stu_data);
		$ar_data = array($cnt,$pre_dues1,$stu_id);
		echo json_encode($ar_data);
	}

	public function show_student()
	{
		$details = $this->dbcon->select('student','ADM_NO,FIRST_NM,DISP_CLASS,DISP_SEC,FATHER_NM,MOTHER_NM',"Student_Status='ACTIVE'");
		echo json_encode($details);
	}

	public function stu_data()
	{
		$adm_no = $this->input->post('val');
		$User_Id = $this->session->userdata('user_id');
		
		$stu_data = $this->dbcon->monthly_collection($adm_no);
		$ward = $stu_data[0]->HOUSENAME;
		if($ward == "NONE" || $ward == "BACHPAN"){
			$master = $this->dbcon->select('master','*',"User_ID='$User_Id' AND Collection_Type='3'");
		}else{
			$master = $this->dbcon->select('master','*',"User_ID='$User_Id' AND Collection_Type='1'");
		}
		$array = array(
			'student_data' => $stu_data,
			'master' => $master
		);
		$this->load->view('Fee_collection/month_collection_data',$array);	
	}
	
	public function stu_data_old()
	{
		$adm_no = $this->input->post('val');
		$User_Id = $this->session->userdata('user_id');

		$stu_data = $this->dbcon->monthly_collection($adm_no);
		$ward = $stu_data[0]->HOUSENAME;
		if ($ward == "NONE" || $ward == "BACHPAN") {
			$master = $this->dbcon->select('master', '*', "User_ID='$User_Id' AND Collection_Type='3'");
		} else {
			$master = $this->dbcon->select('master', '*', "User_ID='$User_Id' AND Collection_Type='1'");
		}

		//----------- GET MONTH PAY DETAILS START-------------//
		$apr_fee = $stu_data[0]->APR_FEE;
		$may_fee = $stu_data[0]->MAY_FEE;
		$jun_fee = $stu_data[0]->JUNE_FEE;
		$jul_fee = $stu_data[0]->JULY_FEE;
		$aug_fee = $stu_data[0]->AUG_FEE;
		$sep_fee = $stu_data[0]->SEP_FEE;
		$oct_fee = $stu_data[0]->OCT_FEE;
		$nov_fee = $stu_data[0]->NOV_FEE;
		$dec_fee = $stu_data[0]->DEC_FEE;
		$jan_fee = $stu_data[0]->JAN_FEE;
		$feb_fee = $stu_data[0]->FEB_FEE;
		$mar_fee = $stu_data[0]->MAR_FEE;
		//----------- GET MONTH PAY DETAILS END-------------//


		//----------- CHECK MONTH DUES DETAILS -------------//
		if($apr_fee == 'NOT ADMITTED'){ $apr_check = 2; }else{
		if ($apr_fee != 'N/A' && $apr_fee != '' && ($may_fee == 'N/A' || $may_fee == '')) {
			$apr_check = $this->check_dues($adm_no,'APR');
		}else{
			if($may_fee != 'N/A' && $may_fee != ''){
				$apr_check = 2;
			}else{
				$apr_check = 1;
			}
		}
		}

		if($may_fee == 'NOT ADMITTED'){ $may_check = 2; }else{
		if ($may_fee != 'N/A' && $may_fee != '' && ($jun_fee == 'N/A' || $jun_fee == '')) {
			$may_check = $this->check_dues($adm_no,'MAY');
		}else{
			if($jun_fee != 'N/A' && $jun_fee != ''){
				$may_check = 2;
			}else{
				$may_check = 1;
			}
		}
		}
		

		if($jun_fee == 'NOT ADMITTED'){ $jun_check = 2; }else{
		if ($jun_fee != 'N/A' && $jun_fee != '' && ($jul_fee == 'N/A' || $jul_fee == '')) {
			$jun_check = $this->check_dues($adm_no,'JUN');
		}else{
			if($jul_fee != 'N/A' && $jul_fee != ''){
				$jun_check = 2;
			}else{
				$jun_check = 1;
			}
		}
		}
		

		if($jul_fee == 'NOT ADMITTED'){ $jul_check = 2; }else{
		if ($jul_fee != 'N/A' && $jul_fee != '' && ($aug_fee == 'N/A' || $aug_fee == '')) {
			$jul_check = $this->check_dues($adm_no,'JUL');
		}else{
			if($aug_fee != 'N/A' && $aug_fee != ''){
				$jul_check = 2;
			}else{
				$jul_check = 1;
			}
		}
		}
		

		if($aug_fee == 'NOT ADMITTED'){ $aug_check = 2; }else{
		if ($aug_fee != 'N/A' && $aug_fee != '' && ($sep_fee == 'N/A' || $sep_fee == '')) {
			$aug_check = $this->check_dues($adm_no,'AUG');
		}else{
			if($sep_fee != 'N/A' && $sep_fee != ''){
				$aug_check = 2;
			}else{
				$aug_check = 1;
			}
		}
		}
		
		
		if($sep_fee == 'NOT ADMITTED'){ $sep_check = 2; }else{
		if ($sep_fee != 'N/A' && $sep_fee != '' && ($oct_fee == 'N/A' || $oct_fee == '')) {
			$sep_check = $this->check_dues($adm_no,'SEP');
		}else{
			if($oct_fee != 'N/A' && $oct_fee != ''){
				$sep_check = 2;
			}else{
				$sep_check = 1;
			}
		}
		}
		
			
		if($oct_fee == 'NOT ADMITTED'){ $oct_check = 2; }else{
		if ($oct_fee != 'N/A' && $oct_fee != '' && ($nov_fee == 'N/A' || $nov_fee == '')) {
			$oct_check = $this->check_dues($adm_no,'OCT');
		}else{
			if($nov_fee != 'N/A' && $nov_fee != ''){
				$oct_check = 2;
			}else{
				$oct_check = 1;
			}
		}
		}

		if($nov_fee == 'NOT ADMITTED'){ $nov_check = 2; }else{
		if ($nov_fee != 'N/A' && $nov_fee != '' && ($dec_fee == 'N/A' || $dec_fee == '')) {
			$nov_check = $this->check_dues($adm_no,'NOV');
		}else{
			if($dec_fee != 'N/A' && $dec_fee != ''){
				$nov_check = 2;
			}else{
				$nov_check = 1;
			}
		}
		}
		
		if($dec_fee == 'NOT ADMITTED'){ $dec_check = 2; }else{
		if ($dec_fee != 'N/A' && $dec_fee != '' && ($jan_fee == 'N/A' || $jan_fee == '')) {
			$dec_check = $this->check_dues($adm_no,'DEC');
		}else{
			if($jan_fee != 'N/A' && $jan_fee != ''){
				$dec_check = 2;
			}else{
				$dec_check = 1;
			}
		}
		}

		
		if($jan_fee == 'NOT ADMITTED'){ $jan_check = 2; }else{
		if ($jan_fee != 'N/A' && $jan_fee != '' && ($feb_fee == 'N/A' || $feb_fee == '')) {
			$jan_check = $this->check_dues($adm_no,'JAN');
		}else{
			if($feb_fee != 'N/A' && $feb_fee != ''){
				$jan_check = 2;
			}else{
				$jan_check = 1;
			}
		}
		}

		
		if($feb_fee == 'NOT ADMITTED'){ $feb_check = 2; }else{
		if ($feb_fee != 'N/A' && $feb_fee != '' && ($mar_fee == 'N/A' || $mar_fee == '')) {
			$feb_check = $this->check_dues($adm_no,'FEB');
		}else{
			if($mar_fee != 'N/A' && $mar_fee != ''){
				$feb_check = 2;
			}else{
				$feb_check = 1;
			}
		}
		}

		if ($mar_fee != 'N/A' && $mar_fee != '') {
			$mar_check = $this->check_dues($adm_no,'MAR');
		}else{
			$mar_check = 1;
		}


		//---ADD APPLICABLE MONTH-----//
		$month_app = array();

		if($apr_check == 1){
			$month_app[] = 'APR';
		}
		if($may_check == 1){
			$month_app[] = 'MAY';
		}
		if($jun_check == 1){
			$month_app[] = 'JUN';
		}
		if($jul_check == 1){
			$month_app[] = 'JUL';
		}
		if($aug_check == 1){
			$month_app[] = 'AUG';
		}
		if($sep_check == 1){
			$month_app[] = 'SEP';
		}
		if($oct_check == 1){
			$month_app[] = 'OCT';
		}
		if($nov_check == 1){
			$month_app[] = 'NOV';
		}
		if($dec_check == 1){
			$month_app[] = 'DEC';
		}
		if($jan_check == 1){
			$month_app[] = 'JAN';
		}
		if($feb_check == 1){
			$month_app[] = 'FEB';
		}
		if($mar_check == 1){
			$month_app[] = 'MAR';
		}

		



		$array = array(
			'student_data' => $stu_data,
			'master' => $master,
			'month_app' => $month_app
		);
		$this->load->view('Fee_collection/month_collection_data', $array);
	}

	public function showledger_monthly_collection()
	{
		$adm = $this->input->post('adm_no');
		$std_ldgr = $this->dbcon->select('daycoll','*',"ADM_NO='$adm'");
		echo json_encode($std_ldgr);
	}
	
	public function check_dues($adm_no, $month_nm)
	{

		$student_data = $this->farheen->select('student', '*', "ADM_NO='$adm_no'");
		$session 	  = $this->farheen->select('session_master', '*', "Active_Status='1'");
		
		if (isset($student_data)) {
			$admission_no = $student_data[0]->ADM_NO;
			$emp_ward     = $student_data[0]->EMP_WARD;
			$class        = $student_data[0]->CLASS;
			$hostel       = $student_data[0]->HOSTEL;
			$COMPUTER     = $student_data[0]->COMPUTER;
			$SESSIONID    = $student_data[0]->SESSIONID;
			$SCHOLAR      = $student_data[0]->SCHOLAR;
			$science	  = $student_data[0]->BUS_NO;
			$stop_amt_code = $student_data[0]->STOPNO;
			$stu_aprfee   = $student_data[0]->APR_FEE;
			@$adm_status   = $student_data[0]->mid_session_admisson_status;
			$Admission_month = $student_data[0]->Admission_month;
		}
		if (isset($session)) {
			$Session_ID = $session[0]->Session_ID;
			$Session_Nm = $session[0]->Session_Nm;
			$Session_Year = $session[0]->Session_Year;
			$Active_Status = $session[0]->Active_Status;
		}

		if ($SCHOLAR == 1) {
			$scholar_data = $this->farheen->select('scholarship', '*', "ADM_NO='$admission_no'");
			$Apply_From = $scholar_data[0]->Apply_From;
			$Apply_From_ID = $scholar_data[0]->AWARDED;
		}
		$cnt = 0;
		$h_fee = 0;
		$t = 0;
		$total_amt = 0;
		$final_amount = array();

		$month = $this->farheen->getmonthno($month_nm);

		

		for ($i = 1; $i <= 25; $i++) {
			$t = 0;
			$h_fee = 0;

			$feehead[$i] 	= $this->farheen->select('feehead', '*', "ACT_CODE='$i' AND ACCG = 1");
			$AccG[$i] 		= $feehead[$i][0]->AccG;
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

			//fetching data from feeclw//
			$feeclw   = $this->farheen->select('fee_clw', '*', "FH='$i' AND CL='$class'");
			$feeclw_AMOUNT[$i]   = $feeclw[0]->AMOUNT;
			$feeclw_EMP[$i]      = $feeclw[0]->EMP;
			$feeclw_CCL[$i]      = $feeclw[0]->CCL;
			$feeclw_SPL[$i]      = $feeclw[0]->SPL;
			$feeclw_EXT[$i]      = $feeclw[0]->EXT;
			$feeclw_INTERNAL[$i] = $feeclw[0]->INTERNAL;

			if ($monthly[$i] == 1) // calculation on the basis of month base //
			{
				$mnth_val = $this->farheen->feehead_mnth($month, $i);
				$fhead_mnth =  $mnth_val[0]->mnth;
				if ($fhead_mnth == 1) {
					if ($CL_BASED[$i] == 1) // calculation on the basis of class base //
					{
						switch ($emp_ward) {
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

						if ($SCHOLAR == 1) // calculation on the basis of the scholarship //
						{
							$scholar = $this->farheen->scholar_data($act_code[$i], $adm_no, $month);
							// echo $this->db->last_query();die;
							@$scholar_val =  $scholar[0]->schl;

							if ($HType[$i] == 'No') {
								$h_fee = $amt_fee;
							} elseif ($HType[$i] == 'COMPUTER') {
								if ($COMPUTER == 1) {
									$h_fee = $amt_fee;
								} else {
									$h_fee = 0;
								}
							} elseif ($HType[$i] == 'BUS') {
								$bus_fee = $this->farheen->getbusamountmonthwise($adm_no, $month);
								$h_fee = $bus_fee[0]->BUSAMOUNT;
							} elseif ($HType[$i] == 'SCIENCE') {
								$h_fee = ($amt_fee * $science);
							} elseif ($HType[$i] == 'LATEFINE') {

								$late_fine = $this->farheen->selectSingleData('latefine_master', '*', "ID='1'");
								$l_status = $late_fine->status;
								$l_collection_mode = $late_fine->collection_mode;
								$l_month_applied = $late_fine->month_applied;
								$l_date_applied = $late_fine->date_applied;
								$l_late_amount = $late_fine->late_amount;
								$current_month = date('m');
								$sys_date = date('d');
								if ($month == 1) {
									$m = 4;
								} elseif ($month == 2) {
									$m = 5;
								} elseif ($month == 3) {
									$m = 6;
								} elseif ($month == 4) {
									$m = 7;
								} elseif ($month == 5) {
									$m = 8;
								} elseif ($month == 6) {
									$m = 9;
								} elseif ($month == 7) {
									$m = 10;
								} elseif ($month == 8) {
									$m = 11;
								} elseif ($month == 9) {
									$m = 12;
								} elseif ($month == 10) {
									$m = 1;
								} elseif ($month == 11) {
									$m = 2;
								} elseif ($month == 12) {
									$m = 3;
								}

								$diff = $current_month - $m;

								if ($l_status == 1) {

									if ($diff > 0) {

										$late_fee = $l_late_amount;
									} elseif ($diff = 0) {

										if ($l_date_applied <= $sys_date) {
											$late_fee = $l_late_amount;
										} else {
											$late_fee = 0;
										}
									} else {

										$late_fee = 0;
									}

									$h_fee = $late_fee;
								} else {
									$h_fee = 0;
								}
							} elseif ($HType[$i] == 'HOSTEL') {
								$h_fee = 0;
							}
							if ($h_fee > 0) {
								if ($scholar_val <= $h_fee) {
									$h_fee = $h_fee - $scholar_val;
								} else {
									$h_fee;
								}
							}
						} else {

							//Non Scholarship 
							if ($HType[$i] == 'No') {
								$h_fee = $amt_fee;
							} elseif ($HType[$i] == 'COMPUTER') {
								if ($COMPUTER == 1) {
									$h_fee = $amt_fee;
								} else {
									$h_fee = 0;
								}
							} elseif ($HType[$i] == 'BUS') {
								$bus_fee = $this->farheen->getbusamountmonthwise($adm_no, $month);
								$h_fee = $bus_fee[0]->BUSAMOUNT;
							} elseif ($HType[$i] == 'SCIENCE') {
								$h_fee = $amt_fee * $science;
							} elseif ($HType[$i] == 'LATEFINE') {
							} elseif ($HType[$i] == 'BOOK') {
								$h_fee = 0;
							} elseif ($HType[$i] == 'DUES') {
								$h_fee = 0;
							} elseif ($HType[$i] == 'HOSTEL') {
								$h_fee = 0;
							}
						}
					} else {
						//Non class base
						switch ($emp_ward) {
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

						if ($SCHOLAR == 1) // calculation on the basis of the scholarship //
						{
							$scholar = $this->farheen->scholar_data($act_code[$i], $adm_no, $month);
							@$scholar_val =  $scholar[0]->schl;

							if ($HType[$i] == 'No') {
								$h_fee = $amt_fee;
							} elseif ($HType[$i] == 'COMPUTER') {
								if ($COMPUTER == 1) {
									$h_fee = $amt_fee;
								} else {
									$h_fee = 0;
								}
							} elseif ($HType[$i] == 'BUS') {
								$bus_fee = $this->farheen->getbusamountmonthwise($adm_no, $month);
								$h_fee = $bus_fee[0]->BUSAMOUNT;
							} elseif ($HType[$i] == 'SCIENCE') {
								$h_fee = ($amt_fee * $science);
							} elseif ($HType[$i] == 'LATEFINE') {

								$late_fine = $this->farheen->selectSingleData('latefine_master', '*', "ID='1'");
								$l_status = $late_fine->status;
								$l_collection_mode = $late_fine->collection_mode;
								$l_month_applied = $late_fine->month_applied;
								$l_date_applied = $late_fine->date_applied;
								$l_late_amount = $late_fine->late_amount;
								$current_month = date('m');
								$sys_date = date('d');
								if ($month == 1) {
									$m = 4;
								} elseif ($month == 2) {
									$m = 5;
								} elseif ($month == 3) {
									$m = 6;
								} elseif ($month == 4) {
									$m = 7;
								} elseif ($month == 5) {
									$m = 8;
								} elseif ($month == 6) {
									$m = 9;
								} elseif ($month == 7) {
									$m = 10;
								} elseif ($month == 8) {
									$m = 11;
								} elseif ($month == 9) {
									$m = 12;
								} elseif ($month == 10) {
									$m = 1;
								} elseif ($month == 11) {
									$m = 2;
								} elseif ($month == 12) {
									$m = 3;
								}

								$diff = $current_month - $m;

								if ($l_status == 1) {

									if ($diff > 0) {

										$late_fee = $l_late_amount;
									} elseif ($diff = 0) {

										if ($l_date_applied <= $sys_date) {
											$late_fee = $l_late_amount;
										} else {
											$late_fee = 0;
										}
									} else {

										$late_fee = 0;
									}

									$h_fee = $late_fee;
								} else {
									$h_fee = 0;
								}
							} elseif ($HType[$i] == 'HOSTEL') {
								$h_fee = 0;
							}
							if ($h_fee > 0) {
								if ($scholar_val <= $h_fee) {
									$h_fee = $h_fee - $scholar_val;
								} else {
									$h_fee;
								}
							}
						} else {    // calculation on the basis of without scholarship //

							if ($HType[$i] == 'No') {
								$h_fee = $amt_fee;
							} elseif ($HType[$i] == 'COMPUTER') {
								if ($COMPUTER == 1) {
									$h_fee = $amt_fee;
								} else {
									$h_fee = 0;
								}
							} elseif ($HType[$i] == 'BUS') {
								$bus_fee = $this->farheen->getbusamountmonthwise($adm_no, $month);
								@$h_fee = $bus_fee[0]->BUSAMOUNT;
							} elseif ($HType[$i] == 'SCIENCE') {
								$h_fee = $amt_fee * $science;
							} elseif ($HType[$i] == 'LATEFINE') {
							} elseif ($HType[$i] == 'BOOK') {
								$h_fee = 0;
							} elseif ($HType[$i] == 'DUES') {
								$h_fee = 0;
							} elseif ($HType[$i] == 'HOSTEL') {
								$h_fee = 0;
							}
						}
					}
				} else {
					// echo 'if month is not Condition for new admission fee';

				}
			} else {
				if ($CL_BASED[$i] == 1) // calculation on the basis of class base //
				{
					switch ($emp_ward) {
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

					if ($SCHOLAR == 1) // calculation on the basis of the scholarship //
					{
						$scholar = $this->farheen->scholar_data($act_code[$i], $adm_no, $month);
						@$scholar_val =  $scholar[0]->schl;

						if ($HType[$i] == 'No') {
							if ($Session_Year == $SESSIONID) {
								if ($month == 1) {

									$h_fee = $amt_fee;
								} else {
									$h_fee = 0;
								}
							}
						} elseif ($HType[$i] == 'COMPUTER') {
							if ($COMPUTER == 1) {
								$h_fee = $amt_fee;
							} else {
								$h_fee = 0;
							}
						} elseif ($HType[$i] == 'BUS') {
							$bus_fee = $this->farheen->getbusamountmonthwise($adm_no, $month);
							$h_fee = $bus_fee[0]->BUSAMOUNT;
						} elseif ($HType[$i] == 'SCIENCE') {
							$h_fee = ($amt_fee * $science);
						} elseif ($HType[$i] == 'LATEFINE') {

							$late_fine = $this->farheen->selectSingleData('latefine_master', '*', "ID='1'");
							$l_status = $late_fine->status;
							$l_collection_mode = $late_fine->collection_mode;
							$l_month_applied = $late_fine->month_applied;
							$l_date_applied = $late_fine->date_applied;
							$l_late_amount = $late_fine->late_amount;
							$current_month = date('m');
							$sys_date = date('d');
							if ($month == 1) {
								$m = 4;
							} elseif ($month == 2) {
								$m = 5;
							} elseif ($month == 3) {
								$m = 6;
							} elseif ($month == 4) {
								$m = 7;
							} elseif ($month == 5) {
								$m = 8;
							} elseif ($month == 6) {
								$m = 9;
							} elseif ($month == 7) {
								$m = 10;
							} elseif ($month == 8) {
								$m = 11;
							} elseif ($month == 9) {
								$m = 12;
							} elseif ($month == 10) {
								$m = 1;
							} elseif ($month == 11) {
								$m = 2;
							} elseif ($month == 12) {
								$m = 3;
							}

							$diff = $current_month - $m;

							if ($l_status == 1) {

								if ($diff > 0) {

									$late_fee = $l_late_amount;
								} elseif ($diff = 0) {

									if ($l_date_applied <= $sys_date) {

										$late_fee = $l_late_amount;
									} else {

										$late_fee = 0;
									}
								} else {

									$late_fee = 0;
								}

								$h_fee = $late_fee;
							} else {
								$h_fee = 0;
							}
						} elseif ($HType[$i] == 'HOSTEL') {
							$h_fee = 0;
						}
						if ($h_fee > 0) {
							if ($scholar_val <= $h_fee) {
								$h_fee = $h_fee - $scholar_val;
							} else {
								$h_fee;
							}
						}
					} else {

						//Non Scholarship 
						if ($HType[$i] == 'No') {
							if ($Session_Year == $SESSIONID) {
								if ($month == 1) {

									$h_fee = $amt_fee;
								} else {
									$h_fee = 0;
								}
							}
						} elseif ($HType[$i] == 'COMPUTER') {
							if ($COMPUTER == 1) {
								$h_fee = $amt_fee;
							} else {
								$h_fee = 0;
							}
						} elseif ($HType[$i] == 'BUS') {
							$bus_fee = $this->farheen->getbusamountmonthwise($adm_no, $month);
							$h_fee = $bus_fee[0]->BUSAMOUNT;
						} elseif ($HType[$i] == 'SCIENCE') {
							$h_fee = $amt_fee * $science;
						} elseif ($HType[$i] == 'LATEFINE') {

							$late_fine = $this->farheen->selectSingleData('latefine_master', '*', "ID='1'");
							$l_status = $late_fine->status;
							$l_collection_mode = $late_fine->collection_mode;
							$l_month_applied = $late_fine->month_applied;
							$l_date_applied = $late_fine->date_applied;
							$l_late_amount = $late_fine->late_amount;
							$current_month = date('m');
							$sys_date = date('d');
							if ($month == 1) {
								$m = 4;
							} elseif ($month == 2) {
								$m = 5;
							} elseif ($month == 3) {
								$m = 6;
							} elseif ($month == 4) {
								$m = 7;
							} elseif ($month == 5) {
								$m = 8;
							} elseif ($month == 6) {
								$m = 9;
							} elseif ($month == 7) {
								$m = 10;
							} elseif ($month == 8) {
								$m = 11;
							} elseif ($month == 9) {
								$m = 12;
							} elseif ($month == 10) {
								$m = 1;
							} elseif ($month == 11) {
								$m = 2;
							} elseif ($month == 12) {
								$m = 3;
							}

							$diff = $current_month - $m;

							if ($l_status == 1) {

								if ($diff > 0) {

									$late_fee = $l_late_amount;
								} elseif ($diff = 0) {

									if ($l_date_applied <= $sys_date) {
										$late_fee = $l_late_amount;
									} else {
										$late_fee = 0;
									}
								} else {

									$late_fee = 0;
								}

								$h_fee = $late_fee;
							} else {
								$h_fee = 0;
							}
						} elseif ($HType[$i] == 'BOOK') {
							$h_fee = 0;
						} elseif ($HType[$i] == 'DUES') {
							$h_fee = 0;
						} elseif ($HType[$i] == 'HOSTEL') {
							$h_fee = 0;
						}
					}
				} else {
					switch ($emp_ward) {
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

					if ($SCHOLAR == 1) // calculation on the basis of the scholarship //
					{
						$scholar = $this->farheen->scholar_data($act_code[$i], $adm_no, $month);
						@$scholar_val =  $scholar[0]->schl;

						if ($HType[$i] == 'No') {
							if ($Session_Year == $SESSIONID) {
								if ($month == 1) {

									$h_fee = $amt_fee;
								} else {
									$h_fee = 0;
								}
							}
						} elseif ($HType[$i] == 'COMPUTER') {
							if ($COMPUTER == 1) {
								$h_fee = $amt_fee;
							} else {
								$h_fee = 0;
							}
						} elseif ($HType[$i] == 'BUS') {
							$bus_fee = $this->farheen->getbusamountmonthwise($adm_no, $month);
							$h_fee = $bus_fee[0]->BUSAMOUNT;
						} elseif ($HType[$i] == 'SCIENCE') {
							$h_fee = ($amt_fee * $science);
						} elseif ($HType[$i] == 'LATEFINE') {

							$late_fine = $this->farheen->selectSingleData('latefine_master', '*', "ID='1'");
							$l_status = $late_fine->status;
							$l_collection_mode = $late_fine->collection_mode;
							$l_month_applied = $late_fine->month_applied;
							$l_date_applied = $late_fine->date_applied;
							$l_late_amount = $late_fine->late_amount;
							$current_month = date('m');
							$sys_date = date('d');
							if ($month == 1) {
								$m = 4;
							} elseif ($month == 2) {
								$m = 5;
							} elseif ($month == 3) {
								$m = 6;
							} elseif ($month == 4) {
								$m = 7;
							} elseif ($month == 5) {
								$m = 8;
							} elseif ($month == 6) {
								$m = 9;
							} elseif ($month == 7) {
								$m = 10;
							} elseif ($month == 8) {
								$m = 11;
							} elseif ($month == 9) {
								$m = 12;
							} elseif ($month == 10) {
								$m = 1;
							} elseif ($month == 11) {
								$m = 2;
							} elseif ($month == 12) {
								$m = 3;
							}

							$diff = $current_month - $m;

							if ($l_status == 1) {

								if ($diff > 0) {

									$late_fee = $l_late_amount;
								} elseif ($diff = 0) {

									if ($l_date_applied <= $sys_date) {

										$late_fee = $l_late_amount;
									} else {

										$late_fee = 0;
									}
								} else {

									$late_fee = 0;
								}

								$h_fee = $late_fee;
							} else {
								$h_fee = 0;
							}
						} elseif ($HType[$i] == 'HOSTEL') {
							$h_fee = 0;
						}
						if ($h_fee > 0) {
							if ($scholar_val <= $h_fee) {
								$h_fee = $h_fee - $scholar_val;
							} else {
								$h_fee;
							}
						}
					} else {

						//Non Scholarship 
						if ($HType[$i] == 'No') {
							if ($Session_Year == $SESSIONID) {
								if ($month == 1) {

									$h_fee = $amt_fee;
								} else {
									$h_fee = 0;
								}
							}
						} elseif ($HType[$i] == 'COMPUTER') {
							if ($COMPUTER == 1) {
								$h_fee = $amt_fee;
							} else {
								$h_fee = 0;
							}
						} elseif ($HType[$i] == 'BUS') {
							$bus_fee = $this->farheen->getbusamountmonthwise($adm_no, $month);
							$h_fee = $bus_fee[0]->BUSAMOUNT;
						} elseif ($HType[$i] == 'SCIENCE') {
							$h_fee = $amt_fee * $science;
						} elseif ($HType[$i] == 'LATEFINE') {

							$late_fine = $this->farheen->selectSingleData('latefine_master', '*', "ID='1'");
							$l_status = $late_fine->status;
							$l_collection_mode = $late_fine->collection_mode;
							$l_month_applied = $late_fine->month_applied;
							$l_date_applied = $late_fine->date_applied;
							$l_late_amount = $late_fine->late_amount;
							$current_month = date('m');
							$sys_date = date('d');
							if ($month == 1) {
								$m = 4;
							} elseif ($month == 2) {
								$m = 5;
							} elseif ($month == 3) {
								$m = 6;
							} elseif ($month == 4) {
								$m = 7;
							} elseif ($month == 5) {
								$m = 8;
							} elseif ($month == 6) {
								$m = 9;
							} elseif ($month == 7) {
								$m = 10;
							} elseif ($month == 8) {
								$m = 11;
							} elseif ($month == 9) {
								$m = 12;
							} elseif ($month == 10) {
								$m = 13;
							} elseif ($month == 11) {
								$m = 14;
							} elseif ($month == 12) {
								$m = 14;
							}

							$diff = $current_month - $m;

							if ($l_status == 1) {

								if ($diff > 0) {

									$late_fee = $l_late_amount;
								} elseif ($diff = 0) {

									if ($l_date_applied <= $sys_date) {
										$late_fee = $l_late_amount;
									} else {
										$late_fee = 0;
									}
								} else {

									$late_fee = 0;
								}

								$h_fee = $late_fee;
							} else {
								$h_fee = 0;
							}
						} elseif ($HType[$i] == 'BOOK') {
							$h_fee = 0;
						} elseif ($HType[$i] == 'DUES') {
							$h_fee = 0;
						} elseif ($HType[$i] == 'HOSTEL') {
							$h_fee = 0;
						}
					}
				}
			}

			if ($cnt == 1) {
				$final_amount[$i] = $h_fee;
			} else {

				$t = $final_amount[$i];
				$final_amount[$i] = $t + $h_fee;
			}
		}

		

		for ($i = 1; $i <= 25; $i++) {
			"feehead" . $i . "->" . $final_amount[$i] . "<br/>";

			$total_amt +=  $final_amount[$i];
		}

		$data = $this->partial($adm_no);

		$tot_amt1  = ($final_amount[1] - $data['totFee1']);
		$tot_amt2  = ($final_amount[2] - $data['totFee2']);
		$tot_amt3  = ($final_amount[3] - $data['totFee3']);
		$tot_amt4  = ($final_amount[4] - $data['totFee4']);
		$tot_amt5  = ($final_amount[5] - $data['totFee5']);
		$tot_amt6  = ($final_amount[6] - $data['totFee6']);
		$tot_amt7  = ($final_amount[7] - $data['totFee7']);
		$tot_amt8  = ($final_amount[8] - $data['totFee8']);
		$tot_amt9  = ($final_amount[9] - $data['totFee9']);
		$tot_amt10 = ($final_amount[10] - $data['totFee10']);
		$tot_amt11 = ($final_amount[11] - $data['totFee11']);
		$tot_amt12 = ($final_amount[12] - $data['totFee12']);
		$tot_amt13 = ($final_amount[13] - $data['totFee13']);
		$tot_amt14 = ($final_amount[14] - $data['totFee14']);
		$tot_amt15 = ($final_amount[15] - $data['totFee15']);
		$tot_amt16 = ($final_amount[16] - $data['totFee16']);
		$tot_amt17 = ($final_amount[17] - $data['totFee17']);
		$tot_amt18 = ($final_amount[18] - $data['totFee18']);
		$tot_amt19 = ($final_amount[19] - $data['totFee19']);
		$tot_amt20 = ($final_amount[20] - $data['totFee20']);
		$tot_amt21 = ($final_amount[21] - $data['totFee21']);
		$tot_amt22 = ($final_amount[22] - $data['totFee22']);
		$tot_amt23 = ($final_amount[23] - $data['totFee23']);
		$tot_amt24 = ($final_amount[24] - $data['totFee24']);
		$tot_amt25 = ($final_amount[25] - $data['totFee25']);

// $total_amount = (($tot_amt1 < 0) ? 0 : $tot_amt1) + (($tot_amt2 < 0) ? 0 : $tot_amt2) + (($tot_amt3 < 0) ? 0 : $tot_amt3) + (($tot_amt4 < 0) ? 0 : $tot_amt4) + (($tot_amt5 < 0) ? 0 : $tot_amt5) + (($tot_amt6 < 0) ? 0 : $tot_amt6) + (($tot_amt7 < 0) ? 0 : $tot_amt7) + (($tot_amt8 < 0) ? 0 : $tot_amt8) + (($tot_amt9 < 0) ? 0 : $tot_amt9) + (($tot_amt10 < 0) ? 0 : $tot_amt10) + (($tot_amt11 < 0) ? 0 : $tot_amt11) + (($tot_amt12 < 0) ? 0 : $tot_amt12) + (($tot_amt13 < 0) ? 0 : $tot_amt13) + (($tot_amt14 < 0) ? 0 : $tot_amt14) + (($tot_amt15 < 0) ? 0 : $tot_amt15) + (($tot_amt16 < 0) ? 0 : $tot_amt16) + (($tot_amt17 < 0) ? 0 : $tot_amt17) + (($tot_amt18 < 0) ? 0 : $tot_amt18) + (($tot_amt19 < 0) ? 0 : $tot_amt19) + (($tot_amt20 < 0) ? 0 : $tot_amt20) + (($tot_amt21 < 0) ? 0 : $tot_amt21) + (($tot_amt22 < 0) ? 0 : $tot_amt22) + (($tot_amt23 < 0) ? 0 : $tot_amt23) + (($tot_amt24 < 0) ? 0 : $tot_amt24) + (($tot_amt25 < 0) ? 0 : $tot_amt25);

		$total_amount = (($tot_amt1 < 0) ? 0 : $tot_amt1) + (($tot_amt2 < 0) ? 0 : $tot_amt2) + (($tot_amt3 < 0) ? 0 : $tot_amt3) + (($tot_amt4 < 0) ? 0 : $tot_amt4) + (($tot_amt5 < 0) ? 0 : $tot_amt5) + (($tot_amt6 < 0) ? 0 : $tot_amt6) + (($tot_amt7 < 0) ? 0 : $tot_amt7) ;


		if($total_amount > 0){
			return 1;
		}else{
			return 2;
		}
	}
	
	public function partial($adm)
	{
		
		$dayCallData = $this->alam->selectA('daycoll', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,sum(Fee4)Fee4,sum(Fee5)Fee5,sum(Fee6)Fee6,sum(Fee7)Fee7,sum(Fee8)Fee8,sum(Fee9)Fee9,sum(Fee10)Fee10,sum(Fee11)Fee11,sum(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,sum(Fee16)Fee16,sum(Fee17)Fee17,sum(Fee18)Fee18,sum(Fee19)Fee19,sum(Fee20)Fee20,sum(Fee21)Fee21,sum(Fee22)Fee22,sum(Fee23)Fee23,sum(Fee24)Fee24,sum(Fee25)Fee25', "ADM_NO='$adm'");

		$dFee1  = $dayCallData[0]['Fee1'];
		$dFee2  = $dayCallData[0]['Fee2'];
		$dFee3  = $dayCallData[0]['Fee3'];
		$dFee4  = $dayCallData[0]['Fee4'];
		$dFee5  = $dayCallData[0]['Fee5'];
		$dFee6  = $dayCallData[0]['Fee6'];
		$dFee7  = $dayCallData[0]['Fee7'];
		$dFee8  = $dayCallData[0]['Fee8'];
		$dFee9  = $dayCallData[0]['Fee9'];
		$dFee10 = $dayCallData[0]['Fee10'];
		$dFee11 = $dayCallData[0]['Fee11'];
		$dFee12 = $dayCallData[0]['Fee12'];
		$dFee13 = $dayCallData[0]['Fee13'];
		$dFee14 = $dayCallData[0]['Fee14'];
		$dFee15 = $dayCallData[0]['Fee15'];
		$dFee16 = $dayCallData[0]['Fee16'];
		$dFee17 = $dayCallData[0]['Fee17'];
		$dFee18 = $dayCallData[0]['Fee18'];
		$dFee19 = $dayCallData[0]['Fee19'];
		$dFee20 = $dayCallData[0]['Fee20'];
		$dFee21 = $dayCallData[0]['Fee21'];
		$dFee22 = $dayCallData[0]['Fee22'];
		$dFee23 = $dayCallData[0]['Fee23'];
		$dFee24 = $dayCallData[0]['Fee24'];
		$dFee25 = $dayCallData[0]['Fee25'];

		$getPrevData = $this->alam->selectA('student', 'APR_FEE', "ADM_NO='$adm'");
		$APR_FEE     = $getPrevData[0]['APR_FEE'];
		$str         = $APR_FEE;
		$Apr_trim    = substr($str, 0, 1);

		if ($Apr_trim == 'P') {
			$tempDayCallData = $this->alam->selectA('temp_daycoll', 'sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,sum(Fee4)Fee4,sum(Fee5)Fee5,sum(Fee6)Fee6,sum(Fee7)Fee7,sum(Fee8)Fee8,sum(Fee9)Fee9,sum(Fee10)Fee10,sum(Fee11)Fee11,sum(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,sum(Fee16)Fee16,sum(Fee17)Fee17,sum(Fee18)Fee18,sum(Fee19)Fee19,sum(Fee20)Fee20,sum(Fee21)Fee21,sum(Fee22)Fee22,sum(Fee23)Fee23,sum(Fee24)Fee24,sum(Fee25)Fee25', "ADM_NO='$adm'");

			$tdFee1  = $tempDayCallData[0]['Fee1'];
			$tdFee2  = $tempDayCallData[0]['Fee2'];
			$tdFee3  = $tempDayCallData[0]['Fee3'];
			$tdFee4  = $tempDayCallData[0]['Fee4'];
			$tdFee5  = $tempDayCallData[0]['Fee5'];
			$tdFee6  = $tempDayCallData[0]['Fee6'];
			$tdFee7  = $tempDayCallData[0]['Fee7'];
			$tdFee8  = $tempDayCallData[0]['Fee8'];
			$tdFee9  = $tempDayCallData[0]['Fee9'];
			$tdFee10 = $tempDayCallData[0]['Fee10'];
			$tdFee11 = $tempDayCallData[0]['Fee11'];
			$tdFee12 = $tempDayCallData[0]['Fee12'];
			$tdFee13 = $tempDayCallData[0]['Fee13'];
			$tdFee14 = $tempDayCallData[0]['Fee14'];
			$tdFee15 = $tempDayCallData[0]['Fee15'];
			$tdFee16 = $tempDayCallData[0]['Fee16'];
			$tdFee17 = $tempDayCallData[0]['Fee17'];
			$tdFee18 = $tempDayCallData[0]['Fee18'];
			$tdFee19 = $tempDayCallData[0]['Fee19'];
			$tdFee20 = $tempDayCallData[0]['Fee20'];
			$tdFee21 = $tempDayCallData[0]['Fee21'];
			$tdFee22 = $tempDayCallData[0]['Fee22'];
			$tdFee23 = $tempDayCallData[0]['Fee23'];
			$tdFee24 = $tempDayCallData[0]['Fee24'];
			$tdFee25 = $tempDayCallData[0]['Fee25'];
		}

		$data['totFee1']  = $dFee1 + @$tdFee1;
		$data['totFee2']  = $dFee2 + @$tdFee2;
		$data['totFee3']  = $dFee3 + @$tdFee3;
		$data['totFee4']  = $dFee4 + @$tdFee4;
		$data['totFee5']  = $dFee5 + @$tdFee5;
		$data['totFee6']  = $dFee6 + @$tdFee6;
		$data['totFee7']  = $dFee7 + @$tdFee7;
		$data['totFee8']  = $dFee8 + @$tdFee8;
		$data['totFee9']  = $dFee9 + @$tdFee9;
		$data['totFee10'] = $dFee10 + @$tdFee10;
		$data['totFee11'] = $dFee11 + @$tdFee11;
		$data['totFee12'] = $dFee12 + @$tdFee12;
		$data['totFee13'] = $dFee13 + @$tdFee13;
		$data['totFee14'] = $dFee14 + @$tdFee14;
		$data['totFee15'] = $dFee15 + @$tdFee15;
		$data['totFee16'] = $dFee16 + @$tdFee16;
		$data['totFee17'] = $dFee17 + @$tdFee17;
		$data['totFee18'] = $dFee18 + @$tdFee18;
		$data['totFee19'] = $dFee19 + @$tdFee19;
		$data['totFee20'] = $dFee20 + @$tdFee20;
		$data['totFee21'] = $dFee21 + @$tdFee21;
		$data['totFee22'] = $dFee22 + @$tdFee22;
		$data['totFee23'] = $dFee23 + @$tdFee23;
		$data['totFee24'] = $dFee24 + @$tdFee24;
		$data['totFee25'] = $dFee25 + @$tdFee25;

		return $data;
	}

}