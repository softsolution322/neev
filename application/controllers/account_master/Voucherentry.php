<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucherentry extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		// if(!in_array('viewDesignation', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		$data['accountTypeList'] =$this->sumit->fetchAllData('*','accg',array());
		$data['ledgerList'] =$this->sumit->fetchAllData('*','mledger',array());
		$data['narrationList'] =$this->sumit->fetchAllData('*','acnar',array());
		$data['accountGroupList'] =$this->sumit->fetchAllData('*','accscg',array());
		$this->sumit->delete('temp_voucher_db',array('login_id'=>login_details['user_id']));
		$this->render_template('account_master/voucherEntry',$data);
	}

	public function createtempvoucher()
	{
		$res = array();
		$voucher_no = $this->input->post('voucher_no');
		$date = $this->input->post('date');
		$account_type = $this->input->post('account_type');
		$drcr = $this->input->post('drcr');
		$account_head = $this->input->post('account_head');
		$amount = $this->input->post('amount');
		$narration = $this->input->post('narration');

		$data = array(
			'voucher_no'	=>	$voucher_no,
			'date'			=>	date('Y-m-d',strtotime($date)),
			'ac_type'		=>	$account_type,
			'dc'			=>	$drcr,
			'ac_head'		=>	$account_head,
			'amount'		=>	$amount,
			'narration'		=>	$narration,
			'login_id'		=>	login_details['user_id'],
		);

		$create = $this->sumit->createDataReturnID('temp_voucher_db',$data);
		if($create)
		{
			$res['msg'] = 1;
		}
		else
		{
			$res['msg'] = 2;
		}
		echo json_encode($res);
	}

	public function getTempVoucher()
	{
		$result = array();
		$data = $this->account_model->getTemporarryVoucher(login_details['user_id']);

		$result = array();
		$balance = 0;

		foreach ($data as $key => $value) {

			if($value['dc'] == 'D')
			{
				$result['data'][] = array(
					$value['ledger_name'],
					'<div class="text-right">'.$value['amount'].'</div>',
					'',
					$value['narration'],
				);
			}
			else
			{
				$result['data'][] = array(
					$value['ledger_name'],
					'',
					'<div class="text-right">'.$value['amount'].'</div>',
					$value['narration'],
				);
			}
			
			
		}
		echo json_encode($result);
	}

	public function checkCRequalsDR()
	{
		$result = array();
		$data = $this->account_model->getTemporarryVoucher(login_details['user_id']);
		$dr = 0;
		$cr = 0;
		$result = array();

		foreach ($data as $key => $value) {

			if($value['dc'] == 'D')
			{
				$dr += $value['amount'];
			}
			else
			{
				$cr += $value['amount'];
			}			
		}
		$result['dr'] = $dr;
		$result['cr'] = $cr;
		if($dr==$cr)
		{
			$result['msg'] = 1;
		}
		else
		{
			$result['msg'] = 0;
		}
		echo json_encode($result);
	}

	public function saveVoucher()
	{
		$tempVoucherData = $this->account_model->getTemporarryVoucher(login_details['user_id']);
		if(!empty($tempVoucherData))
		{
			$result = array();
			foreach ($tempVoucherData as $key => $value) {
				$result[] = array(
					'VNo' => $value['voucher_no'],
					'TDate' => $value['date'],
					'Nar' => $value['narration'],
					'PR' => $value['dc'],
					'CCode' => $value['ac_head'],
					'Amt' => $value['amount'],
					'SG' => $value['SG'],
					'AG' => $value['ag'],
				);
			}
			$create = $this->sumit->createMultiple('tcash',$result);
			if($create)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Voucher created successfully.</div>');
				 $this->sumit->delete('temp_voucher_db',array('login_id'=>login_details['user_id']));
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-danger">Creation Failed.</div>');
			}
		}
		redirect('account_master/voucherentry');
	}
}
