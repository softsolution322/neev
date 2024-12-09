<?php
defined('BASEPATH');

class Admission_registar extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->loggedOut();
		$this->load->model('Mymodel', 'dbcon');
	}
	public function show_registar_student()
	{
		$class = $this->dbcon->select('classes', '*');
		$sec = $this->dbcon->select('sections', '*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('admission_registar/student_registar', $array);
	}
	public function student_register_class()
	{
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');
		// echo $sec;die;
		$session_master = $this->dbcon->select('session_master', '*', "Active_Status=1");
		$year = $session_master[0]->Session_Year;
		$student = $this->dbcon->select('student st', 'ADM_NO,ROLL_NO,FIRST_NM,BIRTH_DT,FATHER_NM,MOTHER_NM,ADM_DATE,(SELECT CLASS_NM FROM classes WHERE classes.Class_No=st.ADM_CLASS)ADM_CLASS_id,(SELECT stoppage FROM stoppage WHERE stoppage.STOPNO=st.STOPNO)other_stop', "DISP_CLASS='$classs' AND DISP_SEC='$sec' AND SESSIONID='$year'");
		// echo $this->db->last_query();die;
		$array = array(
			'student' => $student
		);

		$this->load->view('admission_registar/show_data_class_wise', $array);
	}
	public function student_details_date_wise()
	{
		$date1 = $this->input->post('date1');
		$date2 = $this->input->post('date2');
		$session_master = $this->dbcon->select('session_master', '*', "Active_Status=1");
		$year = $session_master[0]->Session_Year;
		$student = $this->dbcon->select('student st', 'ADM_NO,ROLL_NO,FIRST_NM,BIRTH_DT,FATHER_NM,MOTHER_NM,ADM_DATE,(SELECT CLASS_NM FROM classes WHERE classes.Class_No=st.ADM_CLASS)ADM_CLASS_id,(SELECT stoppage FROM stoppage WHERE stoppage.STOPNO=st.STOPNO)other_stop', "ADM_DATE BETWEEN '$date1' AND '$date2'");

		$array = array(
			'student' => $student
		);

		$this->load->view('admission_registar/show_data_class_wise', $array);
	}

	public function admission_form()
	{

		$data['class'] = $this->db->query('SELECT * FROM CLASSES')->result();
		$data['school_setting'] = $this->db->query('SELECT * FROM school_setting')->result();

		$this->load->view('admission_registar/admission_form', $data);
	}

	public function save_admission_form()
	{
		$stu_name = $this->input->post('childName');
		$f_name = $this->input->post('parentfName');
		$m_name = $this->input->post('parentmName');
		$email = $this->input->post('email');
		$class = $this->input->post('classs');
		$phone = $this->input->post('phone');
		$per_add = $this->input->post('paddress');
		$comm_add = $this->input->post('caddress');
		$date = date('Y-m-d');

		$array = array(
			'name' => $stu_name,
			'submit_date' => $date,
			'father_name' => $f_name,
			'mother_name' => $m_name,
			'email' => $email,
			'class' => $class,
			'number' => $phone,
			'address1' => $comm_add,
			'address2' => $per_add,
			'status' => '1',
			
		);
		
		
		if ($this->dbcon->insert('application', $array)) {
			echo '<script>alert("Thank You for Your Response! You will be contacted within 24-48 hrs.")</script>';
			redirect('Admission_registar/admission_form');
		}else{
			echo '2';
		}
	}
}
