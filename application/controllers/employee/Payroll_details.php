<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_details extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function update($id = null)
	{
		if(!in_array('editEmployee', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		if($id == null)
		{
			redirect('employee/employee');
		}

		//start checking both wing_master_id is same or not
		$session_data = $this->session->userdata('login_details');

		if($session_data['ROLE_ID'] == 4 || $session_data['ROLE_ID'] == 1)
		{
			
		}
		else
		{
			$login_emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$view_emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('id'=>$id));
			if($login_emp['WING_MASTER_ID'] != $view_emp['WING_MASTER_ID'])
			{
				redirect('employee/employee');
			}
		}
		//end checking both wing_master_id is same or not
		$singleData = $this->sumit->getSingleEmployee($id);
		$data['singleData'] = $singleData;
		$data['taslab'] = $this->custom_lib->getTASlab();
		$data['relationType'] = $this->custom_lib->getRelationType();
		$data['level_no'] = $this->sumit->fetchDataGroupByWithOrder('level_no','level_no',array(),'seventh_pay',('level_no'));
		$this->render_template('employee/payrollDetails',$data);
	}

	public function updateProcess($id=null)
	{
		if(!in_array('editEmployee', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		if($id == null)
		{
			redirect('employee/employee');
		}
		$pf_joining_date = $this->input->post('pf_joining_date');
		$pf_joining_date = date('Y-m-d',strtotime($pf_joining_date));

		$data = array(
				'LEVEL_NO'			=> $this->input->post('level_no'),
				'LEVEL_YEAR'		=> $this->input->post('level_year'),
				'BASIC'				=> $this->input->post('basic_pay'),
				'GRADEPAY'			=> $this->input->post('grade_pay'),
				'PF_APP'			=> $this->input->post('pf_applied'),
				'PF_AC_NO'			=> $this->input->post('pf_ac_no'),
				'LAST_PFNO'			=> $this->input->post('prev_pf_ac_no'),
				'PF_JOIN_DT'		=> $pf_joining_date,
				'UANNO'				=> strtoupper($this->input->post('uan_no')),
				'NOMINEE1'			=> $this->input->post('nominee_name'),
				'RELATIONTYPE'		=> $this->input->post('relation'),
				'ESI_APP'			=> $this->input->post('esi_applied'),
				'ESI_AC_NO'			=> $this->input->post('esi_ac_no'),
				'HRA_APP'			=> $this->input->post('hra_applied'),
				'EPS_AC_NO'			=> $this->input->post('eps_ac_no'),
				'TA_ALLOWANCE_APP'	=> $this->input->post('ta_allowance_applied'),
				'TA_SLAB'			=> $this->input->post('ta_slab'),
				'GROUP_INS_POLI'	=> $this->input->post('group_insurance_policy'),
				'INS_POLNO'			=> $this->input->post('group_insurance_policy_slab'),
				'BANK_AC_NO'		=> $this->input->post('bank_ac'),
				'QUATER_NO'			=> $this->input->post('quater_no'),
				'QUATER_TYPE'		=> $this->input->post('quater_type'),
				'QUATER_AREA'		=> $this->input->post('quater_area'),
				// 'QUARTER_RENT'		=> $this->input->post('quater_rent'),
				'SECOND_SHIFT_ALLOW'=> $this->input->post('2nd_shift_allowance'),
				'SPECIAL_ALLOW'		=> $this->input->post('special_allowance'),
				'VPF'				=> $this->input->post('vpf'),
			);
			$data = html_escape($data);
			$update = $this->sumit->update('employee',$data,array('id'=>$id));
			if($update)
			{
				$check_pay_control = $this->sumit->checkData('*','pay_control',array('EMPLOYEE_ID'=>$id));
				$data_rent = array(
					'EMPLOYEE_ID'	=> $id,
					'HRA_RENT'		=> $this->input->post('house_rent'),
					'HRA_ELECT'		=> $this->input->post('electricity_rent'),
					'HRA_SECURITY'	=> $this->input->post('security_rent'),
					'HRA_GARAGE'	=> $this->input->post('garage_rent'),
				);
				if($check_pay_control)
				{
					$this->sumit->update('pay_control',$data_rent,array('EMPLOYEE_ID'=>$id));
				}
				else
				{
					$this->sumit->createData('pay_control',$data_rent);
				}
				$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
			}
			redirect('employee/employee');
	}
}
