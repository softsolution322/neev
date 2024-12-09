<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_gen extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	}
	
	public function index(){

		if(!in_array('viewMonthlyEmpAtten', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$result = array();
		$employee = array();
		$atten = array();
		$all_weekend_date = array();
		$final_result = array();
		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$active_month = $this->sumit->fetchSingleData('*','month_master',array('active_month'=>1));
		$data['shiftList'] = $this->sumit->fetchAllData('*','shift_master',array());
		$session_year = explode('-', $current_session['Session_Nm']);
		$current_year = $session_year[0];

		if($active_month['month_code'] < 4)
		{
			$current_year = $session_year[1];
		}

		if($active_month['month_code'] <= 9)
		{
			$active_month['month_code'] = '0'.$active_month['month_code'];
		}

		$data['total_days'] = cal_days_in_month(CAL_GREGORIAN, $active_month['month_code'], $current_year);
		$data['current_year'] = $current_year;
		$month = $active_month['month_code'];
		$data['current_month'] = $month;

		if(isset($_POST['search']))
		{
			ignore_user_abort(1);
			set_time_limit(300);
			$shift_id = $this->input->post('shift');
			$data['shift_id'] = $shift_id;
			$date = $this->input->post('date');
			$date_exp = explode('-', $date);
			$gender = $this->custom_lib->getGender();
			$leave_type = $this->custom_lib->shortLeaveRequestType();
			//getting weekend date and changing all weekend date format
			$weekend = $this->input->post('weekend');
			$weekend_exp = explode(',', $weekend);
			foreach ($weekend_exp as $key => $value) {
				$all_weekend_date[] = date('Y-m-d',strtotime($value));
			}

			$data['all_weekend_date'] = $weekend;
			$shift_details = $this->sumit->fetchSingleData('*','shift_master',array('ID'=>$shift_id));

			$check_already_gen = $this->sumit->checkData('id','monthly_emp_attend_gen',array('month'=>$active_month['month_code'],'year'=>$current_year,'shift_id'=>$shift_id));
			//fetching all employee data and finding emp data according to given shift
			if($check_already_gen)
			{
				$emp_data = $this->sumit->fetchTwoJoin('employee.id,employee.EMPID,employee.EMP_FNAME,employee.EMP_MNAME,employee.EMP_LNAME,employee.SHIFT,employee.SEX,monthly_emp_attend_gen.total_working_days,monthly_emp_attend_gen.total_present,monthly_emp_attend_gen.total_absent','monthly_emp_attend_gen','employee','monthly_emp_attend_gen.emp_id = employee.id',array('monthly_emp_attend_gen.month'=>$month,'monthly_emp_attend_gen.year'=>$current_year));
			}
			else
			{
				$emp_data = $this->sumit->fetchAllData("id,EMPID,EMP_FNAME,EMP_MNAME,EMP_LNAME,SHIFT,SEX",'employee',array('STATUS'=>1));

			}
			foreach ($emp_data as $key => $value) {
				$shift_val = explode('-', $value['SHIFT']);
				if(in_array($shift_id, $shift_val))
				{
					$employee[] = $value;
				}
			}

			foreach ($employee as $key => $value) {

				$total_present = 0;
				$total_absent = 0;
				
				for ($i=1; $i <= $date_exp[0]; $i++) { 
					$j = $i;
					if($i <= 9)
					{
						$j = '0'.$i;
					}
					$custom_date = $current_year.'-'.$active_month['month_code'].'-'.$j;

					//check if already attendance generated
					$check_already_generated = $this->sumit->fetchSingleData('*','monthly_emp_attend_gen',array('emp_id'=>$value['id'],'month'=>$active_month['month_code'],'year'=>$current_year,'shift_id'=>$shift_id,$i.'c!='=>''));
					if(!empty($check_already_generated))
					{
						if($check_already_generated[$i.'c'] == 'H')
						{
							$total_present = $total_present + 1;
							$atten[$value['id']][$i] = 'H';
						}
						elseif($check_already_generated[$i.'c'] == 'P')
						{
							$total_present = $total_present + 1;
							$atten[$value['id']][$i] = 'P';
						}
						elseif($check_already_generated[$i.'c'] == 'HF')
						{
							$total_present = $total_present + 0.5;
							$atten[$value['id']][$i] = 'HF';
						}
						elseif($check_already_generated[$i.'c'] == 'LWP')
						{
							$atten[$value['id']][$i] = 'LWP';
						}
						elseif($check_already_generated[$i.'c'] == 'CL' || $check_already_generated[$i.'c'] == 'EL' || $check_already_generated[$i.'c'] == 'ML' || $check_already_generated[$i.'c'] == 'DDL')
						{
							$total_present = $total_present + 1;
							$atten[$value['id']][$i] = $check_already_generated[$i.'c'];
						}
						elseif($check_already_generated[$i.'c'] == 'ELW')
						{
							$total_present = $total_present + 1;
							$atten[$value['id']][$i] = 'ELW';
						}
						else
						{
							$atten[$value['id']][$i] = 'AB';
						}
					}
					else
					{
						$atten[$value['id']][$i] = 'AB';
						$holiday_check = $this->sumit->fetchSingleData('ID,NAME','holiday_master',"date(FROM_DATE) <= '$custom_date' AND date(TO_DATE) >='$custom_date' AND APPLIED_FOR IN (0,1)");
						if(!empty($holiday_check) || in_array($custom_date, $all_weekend_date))
						{
							$present_check = $this->sumit->fetchSingleData('*','emp_attendance',array('EMPLOYEE_ID'=>$value['id'],'date(IN_TIME)'=>$custom_date));
							if(!empty($present_check))
							{
								$total_work_duration = $this->sumit->fetchSingleData('SEC_TO_TIME(SUM(TIME_TO_SEC(TOTAL_DURATION))) tot_duration','emp_attendance',array('EMPLOYEE_ID'=>$value['id'],'date(IN_TIME)'=>$custom_date));
								if(strtotime($total_work_duration['tot_duration']) >= strtotime($present_check['MIN_HRS_FULL']))
								{					
									$atten[$value['id']][$i] = 'P';
									$total_present = $total_present + 1;
								}
								elseif(strtotime($total_work_duration['tot_duration']) == strtotime($present_check['MIN_HRS_HALF']))
								{
									$atten[$value['id']][$i] = 'HF';
									$total_present = $total_present + 0.5;
								}
								else
								{
									$atten[$value['id']][$i] = 'ELW';
									$total_present = $total_present + 1;
								}
							}
							else
							{
								// if(($i ==1) || $i ==$date_exp[0])
								// {
								// 	$total_present = $total_present + 1;
								// 	$atten[$value['id']][$i] = '<span style="background-color:#ffd3f1 !important;padding: 5px !important;font-weight:bold !important;"  data-toggle="tooltip" title="'.$custom_date.' Holiday"  onclick="funApprove('.$value['id'].','."'".$custom_date."',"."'Holiday'".')">H</span>';
								// }
								
								// else
								// {
									$prev_date = date("Y-m-d", strtotime( $custom_date . "-1 day"));
									$next_date = date("Y-m-d", strtotime( $custom_date . "+1 day"));
									$check_pre_prev_day = $this->sumit->fetchSingleData('*','emp_attendance',array('EMPLOYEE_ID'=>$value['id'],'date(IN_TIME)'=>$prev_date));
									$check_pre_next_day = $this->sumit->fetchSingleData('*','emp_attendance',array('EMPLOYEE_ID'=>$value['id'],'date(IN_TIME)'=>$prev_date));
									if(!empty($check_pre_next_day) || !empty($check_pre_prev_day))
									{
										$atten[$value['id']][$i] = 'H';
										$total_present = $total_present + 1;
									}
								// }
									
							}
						}
						else
						{
							$present_check = $this->sumit->fetchSingleData('*','emp_attendance',array('EMPLOYEE_ID'=>$value['id'],'date(IN_TIME)'=>$custom_date));
							if(!empty($present_check))
							{
								$total_work_duration = $this->sumit->fetchSingleData('SEC_TO_TIME(SUM(TIME_TO_SEC(TOTAL_DURATION))) tot_duration','emp_attendance',array('EMPLOYEE_ID'=>$value['id'],'date(IN_TIME)'=>$custom_date));
								if(strtotime($total_work_duration['tot_duration']) >= strtotime($present_check['MIN_HRS_FULL']))
								{					
									$atten[$value['id']][$i] = 'P';
									$total_present = $total_present + 1;
								}
								elseif(strtotime($total_work_duration['tot_duration']) == strtotime($present_check['MIN_HRS_HALF']))
								{
									$atten[$value['id']][$i] = 'HF';
									$total_present = $total_present + 0.5;
								}
								else
								{
									$atten[$value['id']][$i] = 'ELW';
									$total_present = $total_present + 1;
								}
							}
							else
							{
								$leave_check = $this->sumit->fetchSingleData('*','emp_leave_attendance',array('EMPLOYEE_ID'=>$value['EMPID'],'date(DATE_FROM) <='=>$custom_date,'date(DATE_TO) >='=>$custom_date,'STATUS'=>1));

								if(!empty($leave_check))
								{
									if($leave_check['LEAVE_TYPE'] != 4)
									{
										$atten[$value['id']][$i] = $leave_type[$leave_check['LEAVE_TYPE']];
										$total_present = $total_present + 1;
									}
									else
									{
										$atten[$value['id']][$i] = $leave_type[$leave_check['LEAVE_TYPE']];
									}
								}
							}
						}
					}

				}
				$result['data'][] = array(
					'id'	=> $value['id'],
					'emp_id' => $value['EMPID'],
					'emp_name' => strtoupper($value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']),
					'total_days' => $date_exp[0],
					'total_present' => $total_present,
				);
				$final_result[$key] = array_merge($result['data'][$key],$atten[$value['id']]);
			}
			$data['result'] = $final_result;
		}

		$this->render_template('salary/attendanceGeneration',$data);
	}

	public function generateMonthlyAttendance()
	{
		if(!in_array('viewMonthlyEmpAtten', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		ignore_user_abort(1);
		set_time_limit(1800);
		$process = 0;
		$emp_id = $this->input->post('emp_id');
		$shift_id = $this->input->post('shift_id');
		$shift_details = $this->sumit->fetchSingleData('*','shift_master',array('ID'=>$shift_id));
		$month = $this->input->post('current_month');
		$year = $this->input->post('current_year');
		$total_days = $this->input->post('total_days');
		$leave_type = $this->custom_lib->shortLeaveRequestType();

		// getting weekend date and changing all weekend date format
		$all_weekend_date = array();
		$weekend = $this->input->post('weekend_set');
		$weekend_exp = explode(',', $weekend);
		foreach ($weekend_exp as $key => $value) {
			$all_weekend_date[] = date('Y-m-d',strtotime($value));
		}
		$data = array();
		foreach ($emp_id as $key => $value) {

			$total_present = 0;
			$total_absent = 0;

			$employee = $this->sumit->fetchSingleData('*','employee',array('id'=>$value,'STATUS'=>1));
			$data = array(
				'emp_id' 	=> $value,
				'shift_id'	=> $shift_id,
				'month'		=> $month,
				'year'		=> $year,
			);
			
			for ($i=1; $i <= $total_days ; $i++) { 

				$j = $i;
				if($i <= 9)
				{
					$j = '0'.$i;
				}
				$custom_date = $year.'-'.$month.'-'.$j;
				$atten[$value][$i] = 'AB';

				$holiday_check = $this->sumit->fetchSingleData('*','holiday_master',"date(FROM_DATE) <= '$custom_date' AND date(TO_DATE) >='$custom_date' AND APPLIED_FOR IN (0,1)");
				if(!empty($holiday_check) || in_array($custom_date, $all_weekend_date))
				{
					$present_check = $this->sumit->fetchSingleData('*','emp_attendance',array('EMPLOYEE_ID'=>$value,'date(IN_TIME)'=>$custom_date));
					if(!empty($present_check))
					{
						$total_work_duration = $this->sumit->fetchSingleData('SEC_TO_TIME(SUM(TIME_TO_SEC(TOTAL_DURATION))) tot_duration','emp_attendance',array('EMPLOYEE_ID'=>$value,'date(IN_TIME)'=>$custom_date));
						if(strtotime($total_work_duration['tot_duration']) >= strtotime($present_check['MIN_HRS_FULL']))
						{
							$total_present = $total_present + 1;						
							$atten[$value][$i] = 'P';
						}
						elseif(strtotime($total_work_duration['tot_duration']) == strtotime($present_check['MIN_HRS_HALF']))
						{
							$total_present = $total_present + 0.5;
							$atten[$value][$i] = 'HF';
						}
						else
						{
							$total_present = $total_present + 1;
							$atten[$value][$i] = 'ELW';
						}
					}
					else
					{
						// if(($i ==1) || $i ==$date_exp[0])
						// {
						// 	$total_present = $total_present + 1;
						// 	$atten[$value][$i] = 'H';
						// }
						
						// else
						// {
							$prev_date = date("Y-m-d", strtotime( $custom_date . "-1 day"));
							$next_date = date("Y-m-d", strtotime( $custom_date . "+1 day"));
							$check_pre_prev_day = $this->sumit->fetchSingleData('*','emp_attendance',array('EMPLOYEE_ID'=>$value,'date(IN_TIME)'=>$prev_date));
							$check_pre_next_day = $this->sumit->fetchSingleData('*','emp_attendance',array('EMPLOYEE_ID'=>$value,'date(IN_TIME)'=>$prev_date));
							if(!empty($check_pre_next_day) || !empty($check_pre_prev_day))
							{
								$total_present = $total_present + 1;
								$atten[$value][$i] = 'H';
							}
						// }
							
					}
				}
				else
				{
					$present_check = $this->sumit->fetchSingleData('*','emp_attendance',array('EMPLOYEE_ID'=>$value,'date(IN_TIME)'=>$custom_date));
					if(!empty($present_check))
					{
						$total_work_duration = $this->sumit->fetchSingleData('SEC_TO_TIME(SUM(TIME_TO_SEC(TOTAL_DURATION))) tot_duration','emp_attendance',array('EMPLOYEE_ID'=>$value,'date(IN_TIME)'=>$custom_date));
						if(strtotime($total_work_duration['tot_duration']) >= strtotime($present_check['MIN_HRS_FULL']))
						{					
							$total_present = $total_present + 1;
							$atten[$value][$i] = 'P';
						}
						elseif(strtotime($total_work_duration['tot_duration']) == strtotime($present_check['MIN_HRS_HALF']))
						{
							$total_present = $total_present + 0.5;
							$atten[$value][$i] = 'HF';
						}
						else
						{
							$total_present = $total_present + 1;
							$atten[$value][$i] = 'ELW';
						}
					}
					else
					{
						$leave_check = $this->sumit->fetchSingleData('*','emp_leave_attendance',array('EMPLOYEE_ID'=>$employee['EMPID'],'date(DATE_FROM) <='=>$custom_date,'date(DATE_TO) >='=>$custom_date,'STATUS'=>1));
						if(!empty($leave_check))
						{
							if($leave_check['LEAVE_TYPE'] != 4)
							{
								$total_present = $total_present + 1;
								$atten[$value][$i] = $leave_type[$leave_check['LEAVE_TYPE']];
							}
							else
							{
								$atten[$value][$i] = $leave_type[$leave_check['LEAVE_TYPE']];
							}
						}
					}
				}

				$data[$i.'c'] = $atten[$value][$i];
				//update lock of all table one by one
				$update_emp_attend = $this->sumit->update('emp_attendance',array('UPDATE_LOCK'=>1),array('EMPLOYEE_ID'=>$value,'date(IN_TIME)'=>$custom_date));
				$update_emp_leave_attend = $this->sumit->update('emp_leave_attendance',array('UPDATE_LOCK'=>1),array('EMPLOYEE_ID'=>$employee['EMPID'],'date(DATE_FROM) <='=>$custom_date,'date(DATE_TO) >='=>$custom_date));
				$update_holiday = $this->sumit->update('holiday_master',array('UPDATE_LOCK'=>1),array('date(FROM_DATE) <='=>$custom_date,'date(TO_DATE) >='=>$custom_date));
			}
			$data['total_working_days'] = $total_days;
			$data['total_present'] = $total_present;
			$data['total_absent'] = $total_days - $total_present;

			$check_prev_data = $this->sumit->checkData('*','monthly_emp_attend_gen',array('emp_id'=>$value,'month'=>$month,'year'=>$year,'shift_id'=>$shift_id));

			if($check_prev_data)
			{
				// $process = $this->sumit->update('monthly_emp_attend_gen',$data,array('emp_id'=>$value,'month'=>$month,'year'=>$year,'shift_id'=>$shift_id));
				$process = true;
			}
			else
			{
				$process = $this->sumit->createData('monthly_emp_attend_gen',$data);
			}
		}
		if($process)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Attendance Generated Successfully</div>');
		}
		// else
		// {
		// 	$response['msg'] = 2;
		// }
		redirect('payroll/salary/Attendance_gen');
	}

	public function checkAttendanceGenerated()
	{
		$response = array();
		$shift_id = $this->input->post('shift_id');
		$emp_id = $this->input->post('emp_id');
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		$custom_date = $this->input->post('selected_date');
		$check_prev_data = $this->sumit->checkData('*','monthly_emp_attend_gen',array('emp_id'=>$emp_id,'month'=>$month,'year'=>$year,'shift_id'=>$shift_id));
		if($check_prev_data)
		{
			$response = $this->sumit->getSingleEmployee($emp_id);
			$response['shift'] = $this->sumit->fetchSingleData('*','shift_master',array('ID'=>$shift_id));
			$response['work_dur'] = $this->sumit->fetchSingleData('SEC_TO_TIME(SUM(TIME_TO_SEC(TOTAL_DURATION))) tot_duration','emp_attendance',array('EMPLOYEE_ID'=>$emp_id,'date(IN_TIME)'=>$custom_date));
			$leave_arr = $this->sumit->fetchSingleData('*','emp_leave_attendance',array('EMPLOYEE_ID'=>$response['EMPID'],'date(DATE_FROM) <='=>$custom_date,'date(DATE_TO) >='=>$custom_date));
			// if(empty($leave_arr))
			// {
			// 	$response['leave'] = array('STATUS'=>NULL);
			// }
			// else
			// {
			// 	$response['leave'] = $leave_arr;
			// }
		}
		else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}

	public function updateSingleDate()
	{
		$response = array();
		
		$pay_type = $this->input->post('pay_type');
		$column_name = $this->input->post('column_name');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$shift_id = $this->input->post('shift_id');
		$employee_id = $this->input->post('employee_id');
		$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

		$col_name = $column_name.'c';
		$data = array(
			$col_name => $pay_type,
		);
		$update = $this->sumit->update('monthly_emp_attend_gen',$data,array('emp_id'=>$employee_id,'month'=>$month,'year'=>$year,'shift_id'=>$shift_id));

		$single_row_data = $this->sumit->fetchSingleData('*','monthly_emp_attend_gen',array('emp_id'=>$employee_id,'month'=>$month,'year'=>$year,'shift_id'=>$shift_id));

		//code for 30,28,29 days
		for($i=$total_days+1; $i<=31; $i++)
		{
			if($single_row_data[$i.'c'] == '')
			{
				unset($single_row_data[$i.'c']);
			}
		}
		$counting_data = array_count_values($single_row_data);

		if(!isset($counting_data['HF']))
		{
			$counting_data['HF'] = 0;
		}
		if(!isset($counting_data['P']))
		{
			$counting_data['P'] = 0;
		}
		if(!isset($counting_data['H']))
		{
			$counting_data['H'] = 0;
		}
		if(!isset($counting_data['CL']))
		{
			$counting_data['CL'] = 0;
		}
		if(!isset($counting_data['ML']))
		{
			$counting_data['ML'] = 0;
		}
		if(!isset($counting_data['DDL']))
		{
			$counting_data['DDL'] = 0;
		}
		if(!isset($counting_data['EL']))
		{
			$counting_data['EL'] = 0;
		}
		if(!isset($counting_data['ELW']))
		{
			$counting_data['ELW'] = 0;
		}

		$total_present = ($counting_data['HF'] * 0.5) + $counting_data['P'] + $counting_data['ELW'] + $counting_data['H'] + $counting_data['CL'] + $counting_data['ML'] + $counting_data['EL'];
		$total_absent = $total_days - $total_present;
		$data_result = array(
			'total_present'	=> $total_present,
			'total_absent'	=> $total_absent,
		);
		$update = $this->sumit->update('monthly_emp_attend_gen',$data_result,array('emp_id'=>$employee_id,'month'=>$month,'year'=>$year,'shift_id'=>$shift_id));
		if($update)
		{
			$response['msg'] = 1;
		}
		else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}
}
