<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accountgroup extends MY_Controller {

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
		
		$data['accountGroupList'] =$this->sumit->fetchAllData('*','accscg',array());
		$this->render_template('account_master/accountGroupMaster',$data);
	}

	public function create()
	{
		$data = array(
			'cat_code'		=> $this->input->post('group_no'),
			'CAT_ABBR'		=> strtoupper($this->input->post('name')),
			'CAT_DESC'		=> strtoupper($this->input->post('details')),
			'CAT_Amt'		=> $this->input->post('budget_amount'),
		);

		$insert = $this->sumit->createData('accscg',$data);
		if($insert)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Added Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
		}
		redirect('account_master/accountgroup');
	}

	public function update()
	{
		$cat_code = $this->input->post('group_no');
		$data = array(
			'cat_code'		=> $cat_code,
			'CAT_ABBR'		=> strtoupper($this->input->post('name')),
			'CAT_DESC'		=> strtoupper($this->input->post('details')),
			'CAT_Amt'		=> $this->input->post('budget_amount'),
		);

		$updated = $this->sumit->update('accscg',$data,array('cat_code'=>$cat_code));
		if($updated)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
		}
		redirect('account_master/accountgroup');
	}

	public function checkGroupNo()
	{
		$group_no = $this->input->post('group_no');
		$check = $this->sumit->checkData('*','accscg',array('cat_code'=>$group_no));
		if($check)
		{
			echo json_encode('Group No already exist');
		}
		else
		{
			echo json_encode('true');
		}
	}

	public function getSingleData()
	{
		$group_no = $this->input->post('group_no');
		$data = $this->sumit->fetchSingleData('*','accscg',array('cat_code'=>$group_no));
		echo json_encode($data);
	}
}
