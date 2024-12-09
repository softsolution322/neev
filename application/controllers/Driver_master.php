<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver_master extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$data['driver_master'] = $this->dbcon->driver_master_details();
		$this->fee_template('transport_management/driver_master/index',$data);
	}
	public function edit_details($id){
		$details['details'] = $this->dbcon->edit_driver($id);
		$details['driver'] = $this->dbcon->select('employee','*',"DESIG='29'");
		$details['khallasi'] = $this->dbcon->select('employee','*',"DESIG='16'");
		$details['incharge'] = $this->dbcon->select('bus_incharge_master','*');
		$details['bus_trip_master'] = $this->dbcon->select('bus_trip_master','*');
		$details['bus_master'] = $this->dbcon->select('busnomaster','BusNo,BusCode');
		// echo "<pre>";
		// print_r($details);
		// exit;
		$this->fee_template('transport_management/driver_master/edit_master',$details);
	}
	
	public function changeinchargephone(){
		$id = $this->input->post('val');
		$ph = $this->dbcon->select('bus_incharge_master','*',"Incharge_Id='$id'");
		$phno = $ph[0]->Incharge_ph_no;
		$id = $ph[0]->Incharge_Id;
		$array = array($phno,$id);
		echo json_encode($array);
	}
	public function view_bus($id){
		$data['bus_master'] = $this->dbcon->select('busnomaster','*',"BusCode='$id'");
		$this->fee_template('transport_management/bus_details/bus_view',$data);
	}
	public function checkbusno(){
		$data = $this->input->post('val');
		$val = $this->dbcon->select('busnomaster','BusNo',"BusNo='$data'");
		echo count($val);
	}
	
	public function update_save(){
		$id = $this->input->post('id_name');
		$array = array(
			'BusCode' 			=> $this->input->post('vn'),
			'driver_empid' 		=> $this->input->post('dempid'),
			'driver_name' 		=> strtoupper($this->input->post('dnhf')),
			'driver_address'	=> strtoupper($this->input->post('da')),
			'driver_dob' 		=> $this->input->post('ddb'),
			'driver_ph_no' 		=> $this->input->post('dpn'),
			'driver_license_no' => $this->input->post('dln'),
			'trip_id' 			=> $this->input->post('tm'),
			'khallasi_empid' 	=> $this->input->post('kn'),
			'khallasi_nm' 		=> strtoupper($this->input->post('kname')),
			'khallasi_ph_no' 	=> $this->input->post('kph'),
			'incharge_id' 		=> $this->input->post('in'),
		);
		// echo "<pre>";
		// print_r($array);
		// exit;
		$this->dbcon->update('driver_master',$array,"Driver_ID='$id'");
		$this->session->set_flashdata('msg','Successfully Updated');
		redirect('Driver_master/index');
	}
	public function add_driver(){
		$details['incharge'] = $this->dbcon->select('bus_incharge_master','*');
		$details['bus_trip_master'] = $this->dbcon->select('bus_trip_master','*');
		$details['bus_master'] = $this->dbcon->select('busnomaster','BusNo,BusCode');
		//dirver code is 29 in designation table and khallasi code is 16//
		$details['driver'] = $this->dbcon->select('employee','*',"DESIG='29'");
		$details['khallasi'] = $this->dbcon->select('employee','*',"DESIG='16'");
		$this->fee_template('transport_management/driver_master/add_driver',$details);
	}
	public function getdetailsCHECK(){
		$vechiclename = $this->input->post('vechiclename');
		$strip = $this->input->post('strip');
		$val = $this->input->post('val');
		
		$data = $this->dbcon->select('driver_master','*',"BusCode='$vechiclename' AND trip_id='$strip' AND driver_empid='$val'");
		$cnt = count($data);
		
		if(empty($data[0]->driver_name)){
			$names = "N/A";
		}else{
			$names = $data[0]->driver_name;
		}
		$array = array($cnt,$names);
		echo json_encode($array);
	}
	public function getdetailsaftercheck(){
		$val = $this->input->post('val');
		$employee = $this->dbcon->select('employee','*',"EMPID='$val'");
		echo json_encode($employee);
	}
	public function checkkhallasi(){
		$val = $this->input->post('val');
		$vechiclename = $this->input->post('vechiclename');
		$strip = $this->input->post('strip');
		$data =  $this->dbcon->select('driver_master','*',"BusCode='$vechiclename' AND trip_id='$strip' AND khallasi_empid='$val'");
		echo count($data);
	}
	public function getkhallasidetails(){
		$val = $this->input->post('val');
		$employee = $this->dbcon->select('employee','*',"EMPID='$val'");
		echo json_encode($employee);
	}
	public function save_driver(){
		$data = $this->dbcon->max_no('driver_master','Driver_ID');
		$max_no = $data[0]->Driver_ID + 1;
		$array = array(
			'Driver_ID'			=> $max_no,
			'BusCode' 			=> $this->input->post('vn'),
			'driver_empid' 		=> $this->input->post('dempid'),
			'driver_name' 		=> strtoupper($this->input->post('dnhf')),
			'driver_address'	=> strtoupper($this->input->post('da')),
			'driver_dob' 		=> $this->input->post('ddb'),
			'driver_ph_no' 		=> $this->input->post('dpn'),
			'driver_license_no' => $this->input->post('dln'),
			'trip_id' 			=> $this->input->post('tm'),
			'khallasi_empid' 	=> $this->input->post('kn'),
			'khallasi_nm' 		=> strtoupper($this->input->post('kname')),
			'khallasi_ph_no' 	=> $this->input->post('kph'),
			'incharge_id' 		=> $this->input->post('in'),
		);
		// echo "<pre>";
		// print_r($array);
		// exit;
		$this->dbcon->insert('driver_master',$array);
		$this->session->set_flashdata('msg',"Successfully Added");
		redirect('Driver_master/index');
		
	}
}