<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign_class_teacher extends My_controller {
	public function __construct(){
		parent :: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$data['class_data']   = $this->alam->select('classes','*');
		$data['teacher_data'] = $this->alam->select('employee','EMPID,EMP_FNAME,EMP_MNAME,EMP_LNAME,STAFF_TYPE',"STAFF_TYPE='1'");
		$this->teacher_template('teacher/assign_class_teacher',$data);
	}
	
	public function section(){
		$classs   = $this->input->post('classs');
		$sec_data = $this->alam->select('student','distinct(DISP_SEC),SEC',"CLASS='$classs' AND Student_Status='ACTIVE'");
		?>
		  <option value=''>Select</option>
		<?php
		foreach($sec_data as $data){
			?>
			  <option value='<?php echo $data->SEC; ?>'><?php echo $data->DISP_SEC; ?></option>
			<?php
		}
	}
	
	public function save_assign_class_teacher(){
		$emp_id     = $this->input->post('emp_id');
		$class_teac = $this->input->post('class_teac');
		$class_id   = $this->input->post('class_id');
		$sec_id     = $this->input->post('sec_id');
		
		if($class_teac == 'Y'){
			$data  = array(
			'Class_tech_sts' => 1,
			'Class_No' => $class_id,
            'Section_No' => $sec_id			
			);
			$this->alam->update('login_details',$data,"user_id='$emp_id'");
		}
	}
}
  
