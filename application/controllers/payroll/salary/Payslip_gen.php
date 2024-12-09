<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payslip_gen extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	}
	
	public function index(){

		if(!in_array('viewPayslipGen', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$active_month = $this->sumit->fetchSingleData('*','month_master',array('active_month'=>1));
		$data['shiftList'] = $this->sumit->fetchAllData('*','shift_master',array());
		$session_year = explode('-', $current_session['Session_Nm']);
		$current_year = $session_year[0];

		if($active_month['month_code'] < 4)
		{
			$current_year = $session_year[1];
		}
		$data['schoolSetting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		$data['total_days'] = cal_days_in_month(CAL_GREGORIAN, $active_month['month_code'], $current_year);
		$data['current_year'] = $current_year;
		$data['current_month'] = $active_month['month_code'];

		$this->render_template('salary/payslipGeneration',$data);
	}


	public function getEmployeeData($pdf=0)
	{
		$result = array();
		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$active_month = $this->sumit->fetchSingleData('*','month_master',array('active_month'=>1));
		$session_year = explode('-', $current_session['Session_Nm']);
		$current_year = $session_year[0];

		if($active_month['month_code'] < 4)
		{
			$current_year = $session_year[1];
		}
		$total_days = cal_days_in_month(CAL_GREGORIAN, $active_month['month_code'], $current_year);
		$data['total_days'] = $total_days;
		$data = $this->attendance->getEmployeeDataForPayslip($active_month['month_code'],$current_year);
		$pf_master_details = $this->sumit->fetchLastData('*','masterpf',array(),'id');
		
		foreach ($data as $key => $value) {

			$check_payslip_data = $this->sumit->checkData('*','payslip_dbo',array('emp_id'=>$value['emp_id'],'payslip_month'=>$active_month['month_code'],'payslip_year'=>$current_year,'update_lock'=>1));

			if($check_payslip_data)
			{
				$employeeData = $this->sumit->fetchSingleData('*','employee',array('id'=>$value['emp_id']));
				$payslip_Data = $this->sumit->fetchSingleData('*','payslip_dbo',array('emp_id'=>$value['emp_id'],'payslip_month'=>$active_month['month_code'],'payslip_year'=>$current_year));
				$actual_basic = $payslip_Data['actual_basic'];
				$basic_sal = $payslip_Data['basic_salary'];

				$da = ($basic_sal * $payslip_Data['da_percent'])/100;
				$hra_amt_allowance = 0;
				$hra_amt_deduction = 0;
				$ta_amount = 0;
				if($payslip_Data['total_present'] > 0)
				{
					if($payslip_Data['hra_app'] == 2)
					{
						$hra_amt_allowance = ($actual_basic * $payslip_Data['hra_rate_percent'])/100;
					}
					elseif($payslip_Data['hra_app'] == 2)
					{
						$hra_amt_deduction = $payslip_Data['hra_rent_deduct'] + $payslip_Data['hra_security_deduct'] + $payslip_Data['hra_garage_deduct'] + $payslip_Data['hra_elect_deduct'];;
					}

					if($payslip_Data['ta_allowance_applied'] == 1)
					{
						$ta_amount = $payslip_Data['ta_pay'];
					}

				}

				$fixed_allowance = $payslip_Data['fixed_allowance'];
				$shift_allowance = 0;
				if($payslip_Data['no_of_classes'] > 0)
				{
					$second_shift_amt = $this->sumit->fetchSingleData('*','second_shift_attendance',array('emp_id'=>$value['emp_id'],'year'=>$current_year,'month'=>$active_month['month_code']));
					$shift_allowance = $second_shift_amt['total_amt'];
				}

				$arrear_salary = $payslip_Data['arrear_basic'] + $payslip_Data['arrear_da'] + $payslip_Data['arrear_hra'] + $payslip_Data['arrear_ta'] + $payslip_Data['arrear_fixed_allow'] + $payslip_Data['arrear_shift_allow'];

				$gross_payable = $basic_sal + $da + $hra_amt_allowance + $ta_amount + $fixed_allowance + $shift_allowance + $arrear_salary;
				/**==============================================================
						Deduction part Calculation
				==============================================================**/
				$employee_pf = 0;
				if($payslip_Data['pf_app'] == 1)
				{
					$employee_pf = (($basic_sal + $da) * $payslip_Data['pf_own_rate']) / 100;
				}
				$fpf = $payslip_Data['fpf_deduct'];
				$vpf = $payslip_Data['vpf_deduct'];
				$lic = $payslip_Data['lic'];
				$medical_deduction = $payslip_Data['medical_deduct'];
				$tds = $payslip_Data['tds_deduct'];
				$prof_tax = $payslip_Data['prof_tax'];
				$staff_welfare_fund = $payslip_Data['staff_welfare_fund'];

				/**================================================
						ESI Calculation
				=================================================**/
				$esi_limit = $payslip_Data['esi_limit'];
				$employee_esi_rate = $payslip_Data['esi_own_rate'];
				$employer_esi_rate = $payslip_Data['esi_emp_rate'];
				$esi_amt = 0;
				if($payslip_Data['esi_app'] == 1)
				{
					$esi_amt = ($gross_payable * $employee_esi_rate) / 100;
					//esi amount changed just like 148.12 = 149 , 142.56 = 143
					$esi_amt_int = (int)$esi_amt;
					if($esi_amt > $esi_amt_int)
					{
						$esi_amt = $esi_amt_int + 1;
					}
				}

				$group_insurance_amt = 0;
				if($payslip_Data['group_ins_app'] == 1)
				{
					$group_insurance_amt = $payslip_Data['group_insurance_amt'];
				}

				$salary_advance_deduction_amt = $payslip_Data['advance_salary_deduct'];

				$total_deduction = $employee_pf + $fpf + $vpf + $prof_tax + $lic + $hra_amt_deduction + $group_insurance_amt + $staff_welfare_fund + $tds + $medical_deduction + $salary_advance_deduction_amt + $esi_amt;

				$payable_sal = round($gross_payable - $total_deduction); 
				if($payable_sal < 0)
				{
					$payable_sal = '<span style="font-weight:bold;color:red;">'.$payable_sal.'</span>';
				}

				$result['data'][] = array(
					" ",
					$key + 1,
					$employeeData['EMPID'],
					strtoupper($employeeData['EMP_FNAME'].' '.$employeeData['EMP_MNAME'].' '.$employeeData['EMP_LNAME']),
					sprintf('%g',$total_days),
					sprintf('%g',$payslip_Data['total_present']),
					$actual_basic,
					$basic_sal,
					$da,
					$hra_amt_allowance,
					$ta_amount,
					$fixed_allowance,
					$shift_allowance,
					$gross_payable,
					$employee_pf,
					$fpf,
					$vpf,
					$esi_amt, //esi amount changed just like 148.12 = 149 , 142.56 = 143
					$prof_tax,
					$lic,
					$payslip_Data['hra_rent_deduct'] +$payslip_Data['hra_security_deduct']+$payslip_Data['hra_garage_deduct']+$payslip_Data['hra_elect_deduct'],
					// round($payslip_Data['hra_rent_deduct']),
					// round($payslip_Data['hra_security_deduct']),

					// round($payslip_Data['hra_garage_deduct']),

					// round($payslip_Data['hra_elect_deduct']),

					$group_insurance_amt,
					$staff_welfare_fund,
					$tds,
					$medical_deduction,
					$salary_advance_deduction_amt,
					$total_deduction,
					$payslip_Data['arrear_basic'],

					$payslip_Data['arrear_da'],

					$payslip_Data['arrear_hra'],

					$payslip_Data['arrear_ta'],

					$payslip_Data['arrear_fixed_allow'],

					$payslip_Data['arrear_shift_allow'],
					$payable_sal,
				);
			}
			else
			{
				$employeeData = $this->sumit->fetchSingleData('*','employee',array('id'=>$value['emp_id'],'STATUS'=>1));
				$actual_basic = round($value['actual_basic']);
				$basic_sal = round(($actual_basic / $total_days) * $value['total_present']);
				$pay_control = $this->sumit->fetchSingleData('*','pay_control',array('EMPLOYEE_ID'=>$value['emp_id']));
				$da = round(($basic_sal * $pf_master_details['da_rate'])/100);
				$hra_amt_allowance = 0;
				$hra_amt_deduction = 0;
				$ta_amount = 0;
				if($value['total_present'] > 0)
				{
					if($employeeData['HRA_APP'] == 2)
					{
						$hra_amt_allowance = round(($actual_basic * $pf_master_details['HRA_Rate'])/100);
					}
					elseif($employeeData['HRA_APP'] == 1)
					{
						$hra_amt_deduction = round($value['hra_deduct_amt']);
					}

					if($employeeData['TA_ALLOWANCE_APP'] == 1)
					{
						$ta_amount = round($pf_master_details['ta_rate_slab'.$employeeData['TA_SLAB']]);
					}

				}
				$fixed_allowance = round($pay_control['FIXED_ALLOW']);
				$shift_allowance = 0;
				if($employeeData['SECOND_SHIFT_ALLOW'] == 1)
				{
					$second_shift_amt = $this->sumit->fetchSingleData('*','second_shift_attendance',array('emp_id'=>$value['emp_id'],'year'=>$current_year,'month'=>$active_month['month_code']));
					$shift_allowance = round($second_shift_amt['total_amt']);
				}

				$arrear_salary = round($pay_control['ARREAR_BASIC'] + $pay_control['ARREAR_DA'] + $pay_control['ARREAR_HRA'] + $pay_control['ARREAR_TA'] + $pay_control['ARREAR_FIXED_ALLOW'] + $pay_control['ARREAR_SHIFT_ALLOW']);

				$gross_payable = $basic_sal + $da + $hra_amt_allowance + $ta_amount + $fixed_allowance + $shift_allowance + $arrear_salary;
				/**==============================================================
						Deduction part Calculation
				==============================================================**/
				$employee_pf = 0;
				if($employeeData['PF_APP'] == 1)
				{
					$employee_pf = round((($basic_sal + $da) * $pf_master_details['OWN_RATE']) / 100);
				}
				$fpf = round($pay_control['FPF']);
				$vpf = round($pay_control['VPF']);
				$lic = round($pay_control['LIC']);
				$medical_deduction = round($pay_control['MEDICAL_DEDUCT']);
				$tds = round($pay_control['TDS']);
				$prof_tax = round($pay_control['PROF_TAX']);
				$staff_welfare_fund = round($pf_master_details['staff_welfare_fund']);

				/**================================================
						ESI Calculation
				=================================================**/
				$esi_limit = $pf_master_details['ESI_LIMIT'];
				$employee_esi_rate = $pf_master_details['ESI_OWN_RATE'];
				$employer_esi_rate = $pf_master_details['ESI_EMP_RATE'];
				$esi_amt = 0;
				if($employeeData['ESI_APP'] == 1)
				{
					$esi_amt = ($gross_payable * $employee_esi_rate) / 100;
					//esi amount changed just like 148.12 = 149 , 142.56 = 143
					$esi_amt_int = (int)$esi_amt;
					if($esi_amt > $esi_amt_int)
					{
						$esi_amt = $esi_amt_int + 1;
					}
				}

				$group_insurance_amt = 0;
				if($employeeData['GROUP_INS_POLI'] == 1)
				{
					$group_insurance_amt = round($employeeData['INS_POLNO'] / 12);
				}

				$adv_salary_total_amt = $pay_control['TOTAL_DUE_AMT'];
				$no_of_installment =  $pay_control['NO_OF_INSTALLMENT'];
				$salary_advance_deduction_amt = 0;
				if($no_of_installment != 0 || $adv_salary_total_amt != 0)
				{
					$salary_advance_deduction_amt = round($adv_salary_total_amt / $no_of_installment);
					if($salary_advance_deduction_amt > $gross_payable)
					{
						$salary_advance_deduction_amt = 0;
					}
				}

				$total_deduction = $employee_pf + $fpf + $vpf + $prof_tax + $lic + $hra_amt_deduction + $group_insurance_amt + $staff_welfare_fund + $tds + $medical_deduction + $salary_advance_deduction_amt + $esi_amt;

				$payable_sal = round($gross_payable - $total_deduction); 
				if($payable_sal < 0)
				{
					$payable_sal = '<span style="font-weight:bold;color:red;">'.$payable_sal.'</span>';
				}


				$result['data'][] = array(
				"<input type='checkbox' name='emp_data' class='checkEmp' value='".$value['emp_id']."' onclick='checkEmp()'>",
				$key + 1,
				$value['employeeid'],
				strtoupper($value['emp_fname'].' '.$value['emp_mname'].' '.$value['emp_lname']),
				$total_days,
				$value['total_present'],
				$actual_basic,
				$basic_sal,
				'<span data-toggle="tooltip" title="DA" onclick="pfMaster('.$pf_master_details['id'].','.$value['emp_id'].','."'".$da."',"."'DA'".","."'da_rate'".')">'.$da.'</span>',
				$hra_amt_allowance,
				$ta_amount,
				'<span data-toggle="tooltip" title="Fixed Allowance" onclick="payControl('.$value['emp_id'].','."'".$fixed_allowance."',"."'Fixed Allowance'".","."'FIXED_ALLOW'".')">'.$fixed_allowance.'</span>',
				$shift_allowance,
				$gross_payable,
				$employee_pf,
				$fpf,
				$vpf,
				$esi_amt, //esi amount changed just like 148.12 = 149 , 142.56 = 143
				$prof_tax,
				'<span data-toggle="tooltip" title="LIC" onclick="payControl('.$value['emp_id'].','."'".$lic."',"."'LIC'".","."'LIC'".')">'.$lic.'</span>',
				round($value['hra_rent'] + $value['hra_security'] + $value['hra_garage'] + $value['hra_elect']),
				// '<span data-toggle="tooltip" title="HRA Rent" onclick="payControl('.$value['emp_id'].','."'".round($value['hra_rent'])."',"."'HRA Rent'".","."'HRA_RENT'".')">'.round($value['hra_rent']).'</span>',

				// '<span data-toggle="tooltip" title="Security Rent" onclick="payControl('.$value['emp_id'].','."'".round($value['hra_security'])."',"."'Security Rent'".","."'HRA_SECURITY'".')">'.round($value['hra_security']).'</span>',

				// '<span data-toggle="tooltip" title="Garage Rent" onclick="payControl('.$value['emp_id'].','."'".round($value['hra_garage'])."',"."'Garage Rent'".","."'HRA_GARAGE'".')">'.round($value['hra_garage']).'</span>',

				// '<span data-toggle="tooltip" title="Electricity Rent" onclick="payControl('.$value['emp_id'].','."'".round($value['hra_elect'])."',"."'Electricity Rent'".","."'HRA_ELECT'".')">'.round($value['hra_elect']).'</span>',

				$group_insurance_amt,
				$staff_welfare_fund,
				'<span data-toggle="tooltip" title="TDS" onclick="payControl('.$value['emp_id'].','."'".$tds."',"."'TDS'".","."'TDS'".')">'.$tds.'</span>',
				'<span data-toggle="tooltip" title="Medical" onclick="payControl('.$value['emp_id'].','."'".$medical_deduction."',"."'Medical'".","."'MEDICAL_DEDUCT'".')">'.$medical_deduction.'</span>',
				$salary_advance_deduction_amt,
				$total_deduction,
				'<span data-toggle="tooltip" title="Arrear Basic" onclick="payControl('.$value['emp_id'].','."'".round($pay_control['ARREAR_BASIC'])."',"."'Arrear Basic'".","."'ARREAR_BASIC'".')">'.round($pay_control['ARREAR_BASIC']).'</span>',

				'<span data-toggle="tooltip" title="Arrear DA" onclick="payControl('.$value['emp_id'].','."'".round($pay_control['ARREAR_DA'])."',"."'Arrear Basic'".","."'ARREAR_DA'".')">'.round($pay_control['ARREAR_DA']).'</span>',

				'<span data-toggle="tooltip" title="Arrear HRA" onclick="payControl('.$value['emp_id'].','."'".round($pay_control['ARREAR_HRA'])."',"."'Arrear Basic'".","."'ARREAR_HRA'".')">'.round($pay_control['ARREAR_HRA']).'</span>',

				'<span data-toggle="tooltip" title="Arrear TA" onclick="payControl('.$value['emp_id'].','."'".round($pay_control['ARREAR_TA'])."',"."'Arrear Basic'".","."'ARREAR_TA'".')">'.round($pay_control['ARREAR_TA']).'</span>',

				'<span data-toggle="tooltip" title="Arrear Fixed Allowance" onclick="payControl('.$value['emp_id'].','."'".round($pay_control['ARREAR_FIXED_ALLOW'])."',"."'Arrear  Fixed Allowance'".","."'ARREAR_FIXED_ALLOW'".')">'.round($pay_control['ARREAR_FIXED_ALLOW']).'</span>',

				'<span data-toggle="tooltip" title="Arrear Shift Allowance" onclick="payControl('.$value['emp_id'].','."'".round($pay_control['ARREAR_SHIFT_ALLOW'])."',"."'Arrear Shift Allowance'".","."'ARREAR_SHIFT_ALLOW'".')">'.round($pay_control['ARREAR_SHIFT_ALLOW']).'</span>',
				$payable_sal,
			);
			}
			// print_r($adv_salary_total_amt);exit();
			
		}
		if($pdf == 1)
		{
			return $result;
		}
		echo json_encode($result);
	}

	public function getSingleEmployeeData()
	{
		$emp_id = $this->input->post('emp_id');
		$emloyeeData = $this->sumit->fetchSingleData('*','employee',array('id'=>$emp_id));
		echo json_encode($emloyeeData);
	}

	public function updateSinglePayControlData()
	{
		$response = array();
		
		$column_name = $this->input->post('column_name');
		$val = $this->input->post('input_val');
		$emp_id = $this->input->post('emp_id');

		$data = array(
			'EMPLOYEE_ID'=> $emp_id,
			$column_name => $val);

		$check_data = $this->sumit->checkData('*','pay_control',array('EMPLOYEE_ID'=>$emp_id));
		if($check_data)
		{
			$process = $this->sumit->update('pay_control',$data,array('EMPLOYEE_ID'=>$emp_id));
		}
		else
		{
			$process = $this->sumit->createData('pay_control',$data);
		}
		if($process)
		{
			$response['msg'] = 1;
		}
		else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}

	public function generateMonthlyPayslip()
	{
		$process = 0;
		$response = array();
		$emp_id = $this->input->post('emp_id');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$total_days = $this->input->post('total_days');
		$pf_master_details = $this->sumit->fetchLastData('*','masterpf',array(),'id');

		foreach ($emp_id as $key => $value) {

			$employeeData = $this->sumit->fetchSingleData('*','employee',array('id'=>$value,'STATUS'=>1));
			$emp_atten_data = $this->sumit->fetchSingleData('total_working_days,total_present,total_absent','monthly_emp_attend_gen',array('emp_id'=>$value,'month'=>$month,'year'=>$year));
			$actual_basic = round($employeeData['BASIC']);
			$basic_sal = round(($actual_basic / $emp_atten_data['total_working_days']) * $emp_atten_data['total_present']);
			$pay_control = $this->sumit->fetchSingleData('*','pay_control',array('EMPLOYEE_ID'=>$value));

			$da = round(($basic_sal * $pf_master_details['da_rate'])/100);
			$hra_amt_allowance = 0;
			$hra_amt_deduction = 0;
			$ta_amount = 0;
			if($emp_atten_data['total_present'] > 0)
			{
				if($employeeData['HRA_APP'] == 2)
				{
					$hra_amt_allowance = round(($actual_basic * $pf_master_details['HRA_Rate'])/100);
				}
				elseif($employeeData['HRA_APP'] == 1)
				{
					$hra_amt_deduction = round($pay_control['HRA_RENT'] + $pay_control['HRA_ELECT'] + $pay_control['HRA_SECURITY'] + $pay_control['HRA_GARAGE']);
				}

				if($employeeData['TA_ALLOWANCE_APP'] == 1)
				{
					$ta_amount = round($pf_master_details['ta_rate_slab'.$employeeData['TA_SLAB']]);
				}

			}

			$fixed_allowance = round($pay_control['FIXED_ALLOW']);
			$shift_allowance = 0;
			$second_shift_amt['no_of_classes'] = 0;
			$second_shift_amt['amt_per_class'] = 0;
			$second_shift_amt['total_amt'] = 0;
			if($employeeData['SECOND_SHIFT_ALLOW'] == 1)
			{
				$second_shift_amt = $this->sumit->fetchSingleData('*','second_shift_attendance',array('emp_id'=>$value,'year'=>$year,'month'=>$month));
				if(empty($second_shift_amt))
				{
					$second_shift_amt['no_of_classes'] = 0;
					$second_shift_amt['amt_per_class'] = 0;
					$second_shift_amt['total_amt'] = 0;
				}
				$shift_allowance = round($second_shift_amt['total_amt']);
			}

			$arrear_salary = round($pay_control['ARREAR_BASIC'] + $pay_control['ARREAR_DA'] + $pay_control['ARREAR_HRA'] + $pay_control['ARREAR_TA'] + $pay_control['ARREAR_FIXED_ALLOW'] + $pay_control['ARREAR_SHIFT_ALLOW']);

			$gross_payable = $basic_sal + $da + $hra_amt_allowance + $ta_amount + $fixed_allowance + $shift_allowance + $arrear_salary;

			/**==============================================================
					Deduction part Calculation
			==============================================================**/
			$employee_pf = 0;
			if($employeeData['PF_APP'] == 1)
			{
				$employee_pf = round((($basic_sal + $da) * $pf_master_details['OWN_RATE']) / 100);
			}
			$fpf = round($pay_control['FPF']);
			$vpf = round($pay_control['VPF']);
			$lic = round($pay_control['LIC']);
			$medical_deduction = round($pay_control['MEDICAL_DEDUCT']);
			$tds = round($pay_control['TDS']);
			$prof_tax = round($pay_control['PROF_TAX']);
			$staff_welfare_fund = round($pf_master_details['staff_welfare_fund']);

			/**================================================
					ESI Calculation
			=================================================**/
			$esi_limit = $pf_master_details['ESI_LIMIT'];
			$employee_esi_rate = $pf_master_details['ESI_OWN_RATE'];
			$employer_esi_rate = $pf_master_details['ESI_EMP_RATE'];
			$esi_amt = 0;
			if($employeeData['ESI_APP'] == 1)
			{
				$esi_amt = ($gross_payable * $employee_esi_rate) / 100;
				//esi amount changed just like 148.12 = 149 , 142.56 = 143
				$esi_amt_int = (int)$esi_amt;
				if($esi_amt > $esi_amt_int)
				{
					$esi_amt = $esi_amt_int + 1;
				}
			}

			$group_insurance_amt = 0;
			if($employeeData['GROUP_INS_POLI'] == 1)
			{
				$group_insurance_amt = round($employeeData['INS_POLNO'] / 12);
			}

			$adv_salary_total_amt = $pay_control['TOTAL_DUE_AMT'];
			$no_of_installment =  $pay_control['NO_OF_INSTALLMENT'];
			$salary_advance_deduction_amt = 0;
			if($no_of_installment != 0 || $adv_salary_total_amt != 0)
			{
				$salary_advance_deduction_amt = round($adv_salary_total_amt / $no_of_installment);
				if($salary_advance_deduction_amt > $gross_payable)
				{
					$salary_advance_deduction_amt = 0;
				}
			}

			$total_deduction = $employee_pf + $fpf + $vpf + $prof_tax + $lic + $hra_amt_deduction + $group_insurance_amt + $staff_welfare_fund + $tds + $medical_deduction + $salary_advance_deduction_amt + $esi_amt;

			if($employeeData['TA_SLAB'] == '')
			{
				$employeeData['TA_SLAB'] = 0;
			}
			$payable_sal = round($gross_payable - $total_deduction); 
			$data = array(

				'emp_id'				=> $value,
				'total_working_days'	=> $emp_atten_data['total_working_days'],
				'total_present'			=> $emp_atten_data['total_present'],
				'payslip_year'			=> $year,
				'payslip_month'			=> $month,
				'actual_basic'			=> $actual_basic,
				'basic_salary'			=> $basic_sal,
				'da_percent'			=> $pf_master_details['da_rate'],
				'da_pay'				=> $da,
				'pension_rate'			=> $pf_master_details['PEN_RATE'],
				'hra_app'				=> $employeeData['HRA_APP'],
				'hra_rate_percent'		=> $pf_master_details['HRA_Rate'],
				'hra_pay'				=> $hra_amt_allowance,
				'ta_allowance_applied'	=> $employeeData['TA_ALLOWANCE_APP'],
				'ta_level'				=> $employeeData['TA_SLAB'],
				'ta_pay'				=> $ta_amount,
				'fixed_allowance'		=> $fixed_allowance,
				// 'shift_allowance'		=> $shift_allowance,
				'no_of_classes'			=> $second_shift_amt['no_of_classes'],
				'amt_per_class'			=> $second_shift_amt['amt_per_class'],
				'total_amount'			=> $second_shift_amt['total_amt'],
				'gross_salary'			=> $gross_payable,
				'pf_app'				=> $employeeData['PF_APP'],
				'pf_own_rate'			=> $pf_master_details['OWN_RATE'],
				'pf_emp_rate'			=> $pf_master_details['EMP_RATE'],
				'pf_own_deduct'			=> $employee_pf,
				'fpf_deduct'			=> $fpf,
				'vpf_deduct'			=> $vpf,
				'esi_app'				=> $employeeData['ESI_APP'],
				'esi_own_rate'			=> $pf_master_details['ESI_OWN_RATE'],
				'esi_emp_rate'			=> $pf_master_details['ESI_EMP_RATE'],
				'esi_limit'				=> $pf_master_details['ESI_LIMIT'],
				'esi_deduct'			=> $esi_amt,
				'prof_tax'				=> $prof_tax,
				'lic'					=> $lic,
				'hra_rent_deduct'		=> round($pay_control['HRA_RENT']),
				'hra_security_deduct'	=> round($pay_control['HRA_SECURITY']),
				'hra_garage_deduct'		=> round($pay_control['HRA_GARAGE']),
				'hra_elect_deduct'		=> round($pay_control['HRA_ELECT']),
				'group_ins_app'			=> $employeeData['GROUP_INS_POLI'],
				'group_insurance_amt'	=> $group_insurance_amt,
				'staff_welfare_fund'	=> $staff_welfare_fund,
				'tds_deduct'			=> $tds,
				'medical_deduct'		=> $medical_deduction,
				'advance_salary_deduct'	=> $salary_advance_deduction_amt,
				'total_deduction'		=> $total_deduction,
				'arrear_basic'			=> $pay_control['ARREAR_BASIC'],
				'arrear_da'				=> round($pay_control['ARREAR_DA']),
				'arrear_hra'			=> round($pay_control['ARREAR_HRA']),
				'arrear_ta'				=> round($pay_control['ARREAR_TA']),
				'arrear_fixed_allow'	=> round($pay_control['ARREAR_FIXED_ALLOW']),
				'arrear_shift_allow'	=> round($pay_control['ARREAR_SHIFT_ALLOW']),
				'payable_amt'			=> $payable_sal,
			);

			$check_prev_data = $this->sumit->checkData('emp_id','payslip_dbo',array('emp_id'=>$value,'payslip_month'=>$month,'payslip_year'=>$year));
			if($check_prev_data)
			{
				$process = $this->sumit->update('payslip_dbo',$data,array('emp_id'=>$value,'payslip_month'=>$month,'payslip_year'=>$year,'update_lock'=>0));
			}
			else
			{
				$process = $this->sumit->createData('payslip_dbo',$data);
				if($process)
				{
					$advance_sal_data = array(
						'EMPLOYEE_ID'		=>	$value,
						'AMOUNT'			=>	round($salary_advance_deduction_amt),
						'DATE'				=>	date('Y-m-d'),
						'NO_OF_INSTALLMENT'	=>	1,
						'STATUS'			=>	2,
					);
					if($advance_sal_data['AMOUNT'] > 0)
					{
						$create = $this->sumit->createData('advance_salary_history',$advance_sal_data);
						$total_due_amt = $pay_control['TOTAL_DUE_AMT'] - round($salary_advance_deduction_amt);
						$final_no_of_installment = $pay_control['NO_OF_INSTALLMENT'] - 1;
						$this->sumit->update('pay_control',array('TOTAL_DUE_AMT'=>$total_due_amt,'NO_OF_INSTALLMENT'=>$final_no_of_installment),array('EMPLOYEE_ID'=>$value));
					}
				}
			}
		}
		if($process)
		{
			$response['msg'] = 1;
		}
		else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}


	public function updationLock()
	{
		$response = array();
		$emp_id = $this->input->post('emp_id');
		$month = $this->input->post('month');
		$year = $this->input->post('year');

		foreach ($emp_id as $key => $value) {
			
			$update = $this->sumit->update('payslip_dbo',array('update_lock'=>1),array('emp_id'=>$value,'payslip_month'=>$month,'payslip_year'=>$year));
			if($update)
			{
				$response['msg'] = 1;
			}
			else
			{
				$response['msg'] = 2;
			}
		}
		echo json_encode($response);
	}

	public function checkPayslipGenerated()
	{
		$response = array();
		$month = $this->input->post('current_month');
		$year = $this->input->post('current_year');
		$checkData = $this->sumit->checkData('*','payslip_dbo',array('payslip_month'=>$month,'payslip_year'=>$year));
		if($checkData)
		{
			$response['msg'] = 1;
		}else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}

	public function sendSMS()
	{
		$mobile = $this->input->post('mobile');
		$otp = rand(100000,999999);
		$message = "OTP For Payslip Unlock is ".$otp;
		$this->session->set_userdata('msgpayslip',$otp);
		$this->sms_lib->sendSMS($mobile,$message);
	}

	public function verifyOTP()
	{
		$response = array();
		$otp = $this->input->post('otptext');
		$session_otp = $this->session->userdata('msgpayslip');
		if($otp == $session_otp)
		{
			$this->session->set_userdata('unlocksuccess','1');
			$response['msg'] = 1;
		}
		else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}
}
