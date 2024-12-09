<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classsecwise extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->render_template('bulk_updation/classsecwise',$array);
	}
	public function find_sec(){
		$val = $this->input->post('val');
		$data = $this->dbcon->select_distinct('student','DISP_SEC,SEC',"CLASS='$val' AND Student_Status='ACTIVE'");
		?>
		  <option value=''>Select Section</option>
		<?php
		foreach($data as $dt){
			?>
			  <option value='<?php echo $dt->SEC; ?>'><?php echo $dt->DISP_SEC; ?></option>
			<?php
		}
	}
	public function find_detailsstudentinformation(){
		$class		= $this->input->post('class_name');
		$sec 		= $this->input->post('sec_name');
		$short_by 	= $this->input->post('short_by');
		$data['data'] = $this->dbcon->select('student','*',"CLASS='$class' AND SEC='$sec' AND Student_Status='ACTIVE' ORDER BY $short_by");
		$data['category'] = $this->dbcon->select('category','*');
		$data['religion'] = $this->dbcon->select('religion','*');
		$data['class'] = $class;
		$data['sec'] = $sec;
		$data['short_by'] = $short_by;
		// echo "<pre>";
		// print_r($data);
		// exit;
		if(!empty($data['data'])){
			$this->load->view('bulk_updation/classsecwisestudentdata',$data);
		}
		else{
			echo "<center><h1>Sorry No Student Found.</h1></center>";
		}
		
		
	}
	public function update_data(){
		$stdid = $this->input->post('adm');
		$col_name = $this->input->post('table_column');
		if($col_name == 'P_MOBILE'){
			$value = $this->input->post('value');
		}else{
			$value = strtoupper($this->input->post('value'));
		}
		$data = array($this->input->post('table_column') => $value );
		$this->dbcon->update('student',$data,"ADM_NO='$stdid'");
	}
	public function birth_data(){
		$stu_id = $this->input->post('val');
		$value = $this->input->post('value');
		$array = array(
			'BIRTH_DT' => $value
		);
		if($this->dbcon->update('student',$array,"ADM_NO='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
		
	}
	public function adm_noupdate(){
		$stu_id = $this->input->post('finid');
		$value = $this->input->post('value1');
		$array = array(
			'ADM_DATE' => $value
		);
		if($this->dbcon->update('student',$array,"ADM_NO='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
	public function changegender(){
		$stu_id = $this->input->post('finidd');
		$value = $this->input->post('gender_value');
		$array = array(
			'SEX' => $value
		);
		if($this->dbcon->update('student',$array,"ADM_NO='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
	public function changecategory(){
		$stu_id = $this->input->post('finiddd');
		$value = $this->input->post('category_value');
		$array = array(
			'CATEGORY' => $value
		);
		if($this->dbcon->update('student',$array,"ADM_NO='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
	public function changereligion(){
		$stu_id = $this->input->post('finiddd1');
		$value = $this->input->post('religion_value');
		$array = array(
			'religion' => $value
		);
		if($this->dbcon->update('student',$array,"ADM_NO='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
}