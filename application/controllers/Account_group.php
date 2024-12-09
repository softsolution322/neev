<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_group extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function account_master(){
		$data['account_master'] = $this->dbcon->select('accg','*');
		$this->fee_template('account_group/master_show',$data);
	}
	public function edit_account($id){
		$data['edit_data'] = $this->dbcon->select('accg','*',"CAT_CODE='$id'");
		$this->fee_template('account_group/edit_account',$data);
	}
	public function account_update(){
		$id = $this->input->post('upd_id');
		$array = array(
			'CAT_ABBR' => strtoupper($this->input->post('ATABBR')),
			'CAT_DESC' => strtoupper($this->input->post('ATN'))
		);
		if($this->dbcon->update('accg',$array,"CAT_CODE='$id'")){
			$this->session->set_flashdata('msg',"Successfully Updated");
			redirect('Account_group/account_master');
		}
		else{
			$this->session->set_flashdata('msg',"Failed Updated");
			redirect('Account_group/account_master');
		}
	}
	public function add_account(){
		$this->fee_template('account_group/add_account');
	}
	public function account_save(){
		$data = $this->dbcon->max_no('accg','CAT_CODE');
		$max_no = $data[0]->CAT_CODE + 1;
		
		$data = array(
		 'CAT_CODE' => $max_no,
		 'CAT_ABBR' => strtoupper($this->input->post('account_abbr')),
		 'CAT_DESC' => strtoupper($this->input->post('account_name'))
		);

		$this->dbcon->insert('accg',$data);
		$this->session->set_flashdata('msg',"Successfully Added");
		redirect('Account_group/account_master');
	}
}