<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_details extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function Student_master(){
		$data = $this->dbcon->select('student','STUDENTID,ADM_NO,DISP_CLASS,ROLL_NO,DISP_SEC,DISP_SEC,FATHER_NM,MOTHER_NM,FIRST_NM',"Student_Status='ACTIVE'");
		$array = array('data'=>$data);
		$this->fee_template('student_details/student_master',$array);
	}
	public function show_student_details($id){
		//echo $id;
		$data = $this->dbcon->show_student($id);
		$adm = $data[0]->ADMISSION_NO;
		// echo $adm;
		$father = $this->dbcon->select('parents','*',"STDID='$id' AND PTYPE='F'");
		$mother = $this->dbcon->select('parents','*',"STDID='$id' AND PTYPE='M'");
		$sibling_details = $this->dbcon->select('childhist','*',"StId='$id' AND AdmNo='$adm'");
		$temp_daycoll = $this->dbcon->select_order_by('temp_daycoll','*','RECT_DATE',"ADM_NO='$adm' AND SEC='Z'");
		$daycoll = $this->dbcon->select_order_by('daycoll','*', 'RECT_DATE',"ADM_NO='$adm'");
	//$str=$this->db->last_query();
//echo $str;
//die;
		//echo '<pre>'; print_r($mother);
		
		$feehead = $this->dbcon->select('feehead','*');
		$arr_mrg = array_merge($temp_daycoll,$daycoll);
		$array = array(
			'student_detail' => $data,
			'father_detail'  => $father,
			'mother_detail'  => $mother,
			'sibling_details' =>$sibling_details,
			'arr_mrg' => $arr_mrg,
			'feehead' => $feehead
		);
		//print_r("<pre>");print_r($array);exit();
		$this->fee_template('student_details/show_student_details',$array);

	}
	public function add_student(){
		$class = $this->dbcon->select('classes','*');
		$section = $this->dbcon->select('sections','*');
		$category = $this->dbcon->select('category','*');
		$house = $this->dbcon->select('house','*');
		$ward = $this->dbcon->select('eward','*');
		$stopage = $this->dbcon->select('stoppage','*');
		$religion = $this->dbcon->select('religion','*');
		$subject = $this->dbcon->select('subjects','*');
		$adm_no = $this->dbcon->select('adm_no','*');
		$array = array(
			'class' =>$class,
			'section' =>$section,
			'category' =>$category,
			'house' =>$house,
			'eward' =>$ward,
			'stopage' =>$stopage,
			'religion' =>$religion,
			'subject' =>$subject,
			'admission' =>$adm_no
		);
		
		$this->fee_template('student_details/add_new_student',$array);
	}
	public function stopage(){
	  $value = $this->input->post('value');
	  $data  = $this->dbcon->select('stoppage','BUS_NO',"STOPNO='$value'");
	  $busno = $data[0]->BUS_NO;
	  $dataa = $this->dbcon->select('busnomaster','BusNo',"BusCode='$busno'");
	  if($dataa){
		echo $no   = $dataa[0]->BusNo;  
	  }
	}

	public function add_record(){
		$fname      = $this->input->post('sfn');
		$full_name  = $fname;
		$FREESHIP   = $this->input->post('radio3');
		$class_code = $this->input->post('admclass');
		$current_class = $this->input->post('curtclass');
		$sec_code   = $this->input->post('admsec');
		$cur_sec   = $this->input->post('curtsec');
		$adm_no     = $this->input->post('std_adn');
		$std_id     = $this->input->post('std_id');
		$fdob =  $this->input->post('fdob');
		$mdob = $this->input->post('mdob');
		$pf='F';
		$pm='M';
		$nation='INDIA';
		
		//rowhit
		$current_year = date('Y');
		$academic_year = '2425';
		$last_adm_no = $this->dbcon->select('student', 'ADM_NO', "ADM_NO LIKE '$academic_year%' ORDER BY ADM_NO DESC LIMIT 1");
		if ($last_adm_no) {
			$last_student_no = intval(substr($last_adm_no[0]->ADM_NO, -3)); // Get the last 3 digits and convert to integer
			$next_student_no = str_pad($last_student_no + 1, 3, '0', STR_PAD_LEFT); // Increment and pad with zeros
		} else {
			$next_student_no = '001'; // Start from 001 if no records exist
		}
		$adm_no = $academic_year . $next_student_no;
		
		
		if($FREESHIP==1)
		{
			$FREESHIP_letterno = strtoupper($this->input->post('freeship'));	
			$FREESHIP_t = 'FREESHIP';
		}
		else
		{
			$FREESHIP_letterno ="N/A";
			$FREESHIP_t = '';

		}
		if(!empty($_FILES['upload_img']['name'])){
		$image              = $_FILES['upload_img']['name']; 
		$expimage           = explode('.',$image);
		$count              = count($expimage);
		$image_ext          = $expimage[$count-1];
		$image_name         = $std_id .'.'.$image_ext;
		$imagepath          = "assets/student_photo/".$image_name;
		
		move_uploaded_file($_FILES["upload_img"]["tmp_name"],$imagepath);
		}else{
			$imagepath  = '';
		}
		
		$class = $this->dbcon->select('classes','*',"Class_No='$current_class'");
		$class_name = $class[0]->CLASS_NM;
		$section = $this->dbcon->select('sections','*',"section_no='$cur_sec'");
		$section_name = $section[0]->SECTION_NAME;
	
		//================CHECKING ADMISSION IN MID SESSION==================//
			$adm_mid_ses = $this->input->post('midses');
			$month1 = $this->input->post('admfrom');
			if(!empty($month1)){
				$va = $month1;
			}else{
				$va = 1;
			}
			$get_mon_data = $this->dbcon->select('month_master','*');
			if($adm_mid_ses == 1){
				foreach($get_mon_data as $key=>$value){
					if ($value->month_code == 1 || $value->month_code == 2 || $value->month_code == 3)
					{
						$mnth_cde = $value->month_code + 12;
					}else{
						$mnth_cde = $value->month_code;
					}
					if($month1 > $mnth_cde){
						if($value->month_name == "JUN"){
							$month_status['JUNE_FEE'] = "NOT ADMITTED";
						}else if($value->month_name == "JUL"){
							$month_status['JULY_FEE'] = "NOT ADMITTED";
						}else{
							$month_status[$value->month_name.'_FEE'] = "NOT ADMITTED";
						}
					}else{
						if($value->month_name == "JUN"){
							$month_status['JUNE_FEE'] = "N/A";
						}else if($value->month_name == "JUL"){
							$month_status['JULY_FEE'] = "N/A";
						}else{
							$month_status[$value->month_name.'_FEE'] = "N/A";
						}
					}
				}
			}else{
				if($FREESHIP==1){
						foreach($get_mon_data as $key=>$value){
						if($value->month_name == "JUN"){
							$month_status['JUNE_FEE'] = "FREESHIP";
						}else if($value->month_name == "JUL"){
							$month_status['JULY_FEE'] = "FREESHIP";
						}else{
							$month_status[$value->month_name.'_FEE'] = "FREESHIP";
						}
					}
				}else{
						foreach($get_mon_data as $key=>$value){
						if($value->month_name == "JUN"){
							$month_status['JUNE_FEE'] = "N/A";
						}else if($value->month_name == "JUL"){
							$month_status['JULY_FEE'] = "N/A";
						}else{
							$month_status[$value->month_name.'_FEE'] = "N/A";
						}
					}
				}
				
			}
		//===================================================================//
		
		$session_master = $this->dbcon->select('session_master','*',"Active_Status='1'");
		$session_year = $session_master[0]->Session_Year;
		$logged_in_user = $this->session->userdata('username');
	    	// $datas = $this->upload->data();
			// $image = 'assets/student_photo/'.$datas['orig_name'];
			$student_details= array(
		        'STUDENTID'     => $std_id,
		        'ADM_DATE'      => $this->input->post('std_adm_date'),
		        'ADM_NO'        => $adm_no,
		        'BIRTH_DT'      => $this->input->post('dob'),
		        'FIRST_NM'      => strtoupper($full_name),
		        'BLOOD_GRP'     => $this->input->post('blood_group'),
		        'CATEGORY'      => $this->input->post('category'),
		        'SEX'           => strtoupper($this->input->post('sex')),
		        'NATION'        => $nation,
		        'EMP_WARD'      => $this->input->post('ward'),
		        'FATHER_NM'     => strtoupper($this->input->post('fathername')),
		        'MOTHER_NM'     => strtoupper($this->input->post('mothername')),
		        'LAST_SCH'      => "N/A",
		        'LSCH_ADD'      => "N/A",
		        'ADM_CLASS'     => $this->input->post('admclass'),
		        'ADM_SEC'       => $this->input->post('admsec'),
		        'PERM_ADD'      => strtoupper($this->input->post('peradd')),
		        'P_CITY'        => strtoupper($this->input->post('percity')),
		        'P_STATE'       => $this->input->post('perstate'),
		        //'P_NATION'      => $this->input->post('percountry'),
		        //'P_PIN'         => $this->input->post('perpin'),
		        //'P_PHONE1'      => $this->input->post('perphone'),
		        //'P_PHONE2'      => $this->input->post('perphone2'),
		        //'P_FAXNO'       => $this->input->post('perfax'),
		        //'P_MOBILE'      => $this->input->post('permobile'),
		        //'P_EMAIL'       => $this->input->post('peremail'),
		        'CORR_ADD'      => strtoupper($this->input->post('crossaddress')),
		        'C_CITY'        => strtoupper($this->input->post('crosscity')),
		        'C_STATE'       => $this->input->post('crossstate'),
		        //'C_NATION'      => $this->input->post('crosscountry'),
		        'C_PIN'         => $this->input->post('crosspin'),
		        //'C_PHONE1'      => $this->input->post('crossphone'),
		        //'C_PHONE2'      => $this->input->post('crossphone2'),
		        //'C_FAXNO'       => $this->input->post('crossfax'),
		        //'C_MOBILE'      => $this->input->post('crossmoblile'),
		        //'C_EMAIL'       => $this->input->post('crossemail'),
		        'HOUSE_CODE'    => 1,
		        'CLASS'         => $this->input->post('curtclass'),
		        'DISP_CLASS'    => $class_name,
		        'SEC'           => $this->input->post('curtsec'),
		        'DISP_SEC'      => $section_name,
		        'ROLL_NO'       => 0,
		        'STOPNO'        => $this->input->post('busstopage'),
		        'religion'      => $this->input->post('religion'),
		        'Fee_Book_No'   => 1,
		        'Bus_Book_No'   => $this->input->post('aadhar'),
		        'CBSE_REG'      => "N/A",
		        'CBSE_ROLL'     => "N/A",
		        'SUBJECT1'      => "N/A",
		        'SUBJECT2'      => "N/A",
		        'SUBJECT3'      => "N/A",
		        'SUBJECT4'      => "N/A",
		        'SUBJECT5'      => "N/A",
		        'SUBJECT6'      => "N/A",
		        'Student_Status'=> "ACTIVE",
		        'BUS_NO'        => 0,
		        'HOSTEL'        => 0,
		        'COMPUTER'      => 0,
		        'FREESHIP'      => 0,
		        'LETTERNO'      => $FREESHIP_letterno,
		        'math_lab'      => 0,
		        'oldadmno'      => 'N/A',
		        'APR_FEE'       => $month_status['APR_FEE'],
		        'MAY_FEE'       => $month_status['MAY_FEE'],
		        'JUNE_FEE'      => $month_status['JUNE_FEE'],
		        'JULY_FEE'      => $month_status['JULY_FEE'],
		        'AUG_FEE'       => $month_status['AUG_FEE'],
		        'SEP_FEE'       => $month_status['SEP_FEE'],
		        'OCT_FEE'       => $month_status['OCT_FEE'],
		        'NOV_FEE'       => $month_status['NOV_FEE'],
		        'DEC_FEE'       => $month_status['DEC_FEE'],
		        'JAN_FEE'       => $month_status['JAN_FEE'],
		        'FEB_FEE'       => $month_status['FEB_FEE'],
		        'MAR_FEE'       => $month_status['MAR_FEE'],
				'SESSIONID'     => $session_year,
		        'student_image' => $imagepath,
				'Parent_password' => $adm_no,
				'mid_session_admisson_status' => $adm_mid_ses,
				'Admission_month' => $va,
				'userlog'        => $logged_in_user
          );
		      $parent_father = array(
		        'STDID'      => $std_id,
		        'ED_QUA'     => strtoupper($this->input->post('father_qualification')),
		        'OCCUPATION' => strtoupper($this->input->post('father_occupation')),
		        'DESIG'      => strtoupper($this->input->post('father_designation')),
		        'MTH_INCOME' => $this->input->post('father_income'),
		        'MOBILE'     => $this->input->post('fmobile'),
				'EMAIL'     => $this->input->post('femail'),
		        'ADDRESS'    => strtoupper($this->input->post('father_address')),
		        'CITY'       => strtoupper($this->input->post('father_city')),
		        'PIN'        => $this->input->post('father_pin'),
		        'STATE'      => strtoupper($this->input->post('father_state')),
		        'PTYPE'      => $pf,
				 'DOB'   => strtoupper($this->input->post('fdob'))
		    );
		    
		    $parent_mother = array(
		        'STDID'      => $std_id,
		        'ED_QUA'     => strtoupper($this->input->post('medu')),
		        'OCCUPATION' => strtoupper($this->input->post('moccupation')),
		        'DESIG'      => strtoupper($this->input->post('mdesignation')),
		        'MTH_INCOME' => $this->input->post('mincome'),
		        'MOBILE'     => $this->input->post('mmobile'),
				'EMAIL'     => $this->input->post('memail'),
		        'ADDRESS'    => strtoupper($this->input->post('maddress')),
		        'CITY'       => strtoupper($this->input->post('mcity')),
		        'PIN'        => $this->input->post('mpin'),
		        'STATE'      => strtoupper($this->input->post('mstate')),
		        'PTYPE'      => $pm,
				'DOB'       => strtoupper($this->input->post('mdob'))
		    );

		    $sibling_history = array(
		        'StId'   => $std_id ,
		        'AdmNo'  => $adm_no,
		        'Name1'  => strtoupper($this->input->post('sibling1')),
		        'DOB1'   => $this->input->post('siblingdob'),
		        'Sex1'   => strtoupper($this->input->post('sibling_gender')),
		        'Adm1'   => $this->input->post('siblingadmission'),
		        'Name2'  => strtoupper($this->input->post('sibling2')),
		        'DOB2'   => $this->input->post('second_sibling_dob'),
		        'Sex2'   => strtoupper($this->input->post('second_sibling_gender')),
		        'Adm2'   => $this->input->post('second_sibling_adm'),
		        'Name3'  => strtoupper($this->input->post('sibling3')),
		        'DOB3'   => $this->input->post('third_sibling_dob'),
		        'Sex3'   => strtoupper($this->input->post('third_sibling_gender')),
		        'Adm3'   => $this->input->post('third_sibling_adm'),
		        'Name4'  => strtoupper($this->input->post('sibling4')),
		        'DOB4'   => $this->input->post('fourth_sibling_dob'),
		        'Sex4'   => strtoupper($this->input->post('fourth_sibling_gender')),
		        'Adm4'   => $this->input->post('fourth_sibling_adm')
		    );
			// echo "<pre>";
			// print_r($student_details);
			 print_r($parent_father);
			 print_r($parent_mother);
			// print_r($sibling_history);
			// exit;
		   //$this->dbcon->insert('parents',$parent_mother);
			//echo $this->db->last_query();die;
		   //$this->dbcon->insert('parents',$parent_mother)
		    $new_id = $adm_no+1;
		    
		    $new_adm = array('ADM_NO' => $new_id);
		
			if($this->dbcon->insert('student',$student_details) && $this->dbcon->insert('parents',$parent_father) && $this->dbcon->insert('parents',$parent_mother) && $this->dbcon->insert('childhist',$sibling_history) && $this->dbcon->update('ADM_NO',$new_adm,"ID='1'")){
				$this->session->set_flashdata('msg',"Successfull Added");
				redirect('Student_details/Student_master');
			}else{
				$this->session->set_flashdata('msg',"Student Record Not Added");
				redirect('Student_details/Student_master');
			}
			
		    
	    
}

  public function update_fee_details(){
  	$adm_no = $this->input->post('adn');
	$details=  $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
	$id = $details[0]->STUDENTID;
	  $logged_in_user = $this->session->userdata('username');
	 
  	$update = array(
  		'APR_FEE'  => strtoupper($this->input->post('april')),
  		'MAY_FEE'  => strtoupper($this->input->post('may')),
  		'JUNE_FEE' => strtoupper($this->input->post('june')),
  		'JULY_FEE' => strtoupper($this->input->post('july')),
  		'AUG_FEE'  => strtoupper($this->input->post('august')),
  		'SEP_FEE'  => strtoupper($this->input->post('september')),
  		'OCT_FEE'  => strtoupper($this->input->post('october')),
  		'NOV_FEE'  => strtoupper($this->input->post('november')),
  		'DEC_FEE'  => strtoupper($this->input->post('december')),
  		'JAN_FEE'  => strtoupper($this->input->post('january')),
  		'FEB_FEE'  => strtoupper($this->input->post('february')),
  		'MAR_FEE'  => strtoupper($this->input->post('march')),
		'userlog'        => $logged_in_user

  	);
  	$this->dbcon->update('student',$update,"ADM_NO='$adm_no'");
  	$this->session->set_flashdata('msg',"Fee Details update Successfull");
  	redirect(base_url('Student_details/show_student_details/'.$id));
  }
  public function update_student_details($id){
	  
  	    $data = $this->dbcon->show_student($id);
		$adm = $data[0]->ADMISSION_NO;
		$father = $this->dbcon->select('parents','*',"STDID='$id' AND PTYPE='F'");
	  
		$mother = $this->dbcon->select('parents','*',"STDID='$id' AND PTYPE='M'");
		$calss = $this->dbcon->select('classes','*');
		$section = $this->dbcon->select('sections','*');
		$category = $this->dbcon->select('category','*');
		$house = $this->dbcon->select('house','*');
		$ward = $this->dbcon->select('eward','*');
		$stopage = $this->dbcon->select('stoppage','*');
		$religion = $this->dbcon->select('religion','*');
		$state = $this->dbcon->select('state','*');
		$subject = $this->dbcon->select('subjects','*');
		$month = $this->dbcon->select('month_master','*');
		$sibling_details = $this->dbcon->select('childhist','*',"StId='$id' AND AdmNo='$adm'");
	  
		$array = array(
			'student_detail' => $data,
			'father_detail'  => $father,
			'mother_detail'  => $mother,
			'sibling_details' =>$sibling_details,
			'class' => $calss,
			'section' => $section,
			'category' => $category,
			'house' => $house,
			'eward' => $ward,
			'stoppage' => $stopage,
			'religion' => $religion,
			'state' =>$state,
			'subject' => $subject,
			'month'  => $month
		);
	  //echo '<pre>';print_r($array);die;
    $this->fee_template('student_details/update_student',$array);
  }
  public function re_update(){
  	$cur_class_code = $this->input->post('curclass');
  	$cur_sec_code = $this->input->post('cursec');
	$student_id = $this->input->post('sti');
  	$student_admission = $this->input->post('adn');
  	$current_class = $this->dbcon->select('classes','*',"Class_No='$cur_class_code'");
  	$class_name = $current_class[0]->CLASS_NM;

  	$current_sec = $this->dbcon->select('sections','*',"section_no='$cur_sec_code'");
  	$section_name = $current_sec[0]->SECTION_NAME;
	  
	  $logged_in_user = $this->session->userdata('username');

  	$freeship = $this->input->post('radio3');
  	$freeship_type = $this->input->post('freeship');
	//--student_detail --//
		$student_data = $this->dbcon->select('student','*',"ADM_NO='$student_admission'");
		$APR_FEE = $student_data[0]->APR_FEE;
		$MAY_FEE = $student_data[0]->MAY_FEE;
		$JUNE_FEE = $student_data[0]->JUNE_FEE;
		$JULY_FEE = $student_data[0]->JULY_FEE;
		$AUG_FEE = $student_data[0]->AUG_FEE;
		$SEP_FEE = $student_data[0]->SEP_FEE;
		$OCT_FEE = $student_data[0]->OCT_FEE;
		$NOV_FEE = $student_data[0]->NOV_FEE;
		$DEC_FEE = $student_data[0]->DEC_FEE;
		$JAN_FEE = $student_data[0]->JAN_FEE;
		$FEB_FEE = $student_data[0]->FEB_FEE;
		$MAR_FEE = $student_data[0]->MAR_FEE;
	//--end of fetching student_detail -->

  	if($freeship==1)
  	{
  		if($freeship_type=='APR'){
  			$apr = 'FREESHIP';
  			$may = 'FREESHIP';
  			$jun = 'FREESHIP';
  			$jul = 'FREESHIP';
  			$aug = 'FREESHIP';
  			$sep = 'FREESHIP';
  			$oct = 'FREESHIP';
  			$nov = 'FREESHIP';
  			$dec = 'FREESHIP';
  			$jan = 'FREESHIP';
  			$feb = 'FREESHIP';
  			$mar = 'FREESHIP';
  		}
  		elseif($freeship_type=='MAY'){
  			$apr = $APR_FEE;
  			$may = 'FREESHIP';
  			$jun = 'FREESHIP';
  			$jul = 'FREESHIP';
  			$aug = 'FREESHIP';
  			$sep = 'FREESHIP';
  			$oct = 'FREESHIP';
  			$nov = 'FREESHIP';
  			$dec = 'FREESHIP';
  			$jan = 'FREESHIP';
  			$feb = 'FREESHIP';
  			$mar = 'FREESHIP';

  		}
  		elseif($freeship_type=='JUN'){
  			$apr = $APR_FEE;
  			$may = $MAY_FEE;
  			$jun = 'FREESHIP';
  			$jul = 'FREESHIP';
  			$aug = 'FREESHIP';
  			$sep = 'FREESHIP';
  			$oct = 'FREESHIP';
  			$nov = 'FREESHIP';
  			$dec = 'FREESHIP';
  			$jan = 'FREESHIP';
  			$feb = 'FREESHIP';
  			$mar = 'FREESHIP';
  		}
  		elseif($freeship_type=='JUL'){
  			$apr = $APR_FEE;
  			$may = $MAY_FEE;
  			$jun = $JUNE_FEE;
  			$jul = 'FREESHIP';
  			$aug = 'FREESHIP';
  			$sep = 'FREESHIP';
  			$oct = 'FREESHIP';
  			$nov = 'FREESHIP';
  			$dec = 'FREESHIP';
  			$jan = 'FREESHIP';
  			$feb = 'FREESHIP';
  			$mar = 'FREESHIP';
  		}
  		elseif($freeship_type=='AUG'){
  			$apr = $APR_FEE;
  			$may = $MAY_FEE;
  			$jun = $JUNE_FEE;
  			$jul = $JULY_FEE;
  			$aug = 'FREESHIP';
  			$sep = 'FREESHIP';
  			$oct = 'FREESHIP';
  			$nov = 'FREESHIP';
  			$dec = 'FREESHIP';
  			$jan = 'FREESHIP';
  			$feb = 'FREESHIP';
  			$mar = 'FREESHIP';
  		}
  		elseif($freeship_type=='SEP'){
  			$apr = $APR_FEE;
  			$may = $MAY_FEE;
  			$jun = $JUNE_FEE;
  			$jul = $JULY_FEE;
  			$aug = $AUG_FEE;
  			$sep = 'FREESHIP';
  			$oct = 'FREESHIP';
  			$nov = 'FREESHIP';
  			$dec = 'FREESHIP';
  			$jan = 'FREESHIP';
  			$feb = 'FREESHIP';
  			$mar = 'FREESHIP';
  		}
  		elseif($freeship_type=='OCT'){
  			$apr = $APR_FEE;
  			$may = $MAY_FEE;
  			$jun = $JUNE_FEE;
  			$jul = $JULY_FEE;
  			$aug = $AUG_FEE;
  			$sep = $SEP_FEE;
  			$oct = 'FREESHIP';
  			$nov = 'FREESHIP';
  			$dec = 'FREESHIP';
  			$jan = 'FREESHIP';
  			$feb = 'FREESHIP';
  			$mar = 'FREESHIP';
  		}elseif($freeship_type=='NOV'){
  			$apr = $APR_FEE;
  			$may = $MAY_FEE;
  			$jun = $JUNE_FEE;
  			$jul = $JULY_FEE;
  			$aug = $AUG_FEE;
  			$sep = $SEP_FEE;
  			$oct = $OCT_FEE;
  			$nov = 'FREESHIP';
  			$dec = 'FREESHIP';
  			$jan = 'FREESHIP';
  			$feb = 'FREESHIP';
  			$mar = 'FREESHIP';
  		}
  		elseif($freeship_type=='DEC'){
  			$apr = $APR_FEE;
  			$may = $MAY_FEE;
  			$jun = $JUNE_FEE;
  			$jul = $JULY_FEE;
  			$aug = $AUG_FEE;
  			$sep = $SEP_FEE;
  			$oct = $OCT_FEE;
  			$nov = $NOV_FEE;
  			$dec = 'FREESHIP';
  			$jan = 'FREESHIP';
  			$feb = 'FREESHIP';
  			$mar = 'FREESHIP';
  		}
  		elseif($freeship_type=='JAN'){
  			$apr = $APR_FEE;
  			$may = $MAY_FEE;
  			$jun = $JUNE_FEE;
  			$jul = $JULY_FEE;
  			$aug = $AUG_FEE;
  			$sep = $SEP_FEE;
  			$oct = $OCT_FEE;
  			$nov = $NOV_FEE;
  			$dec = $DEC_FEE;
  			$jan = 'FREESHIP';
  			$feb = 'FREESHIP';
  			$mar = 'FREESHIP';
  		}
  		elseif($freeship_type=='FEB'){
  			$apr = $APR_FEE;
  			$may = $MAY_FEE;
  			$jun = $JUNE_FEE;
  			$jul = $JULY_FEE;
  			$aug = $AUG_FEE;
  			$sep = $SEP_FEE;
  			$oct = $OCT_FEE;
  			$nov = $NOV_FEE;
  			$dec = $DEC_FEE;
  			$jan = $JAN_FEE;
  			$feb = 'FREESHIP';
  			$mar = 'FREESHIP';
  		}
  		elseif ($freeship_type=='MAR') 
  		{
  			$apr = $APR_FEE;
  			$may = $MAY_FEE;
  			$jun = $JUNE_FEE;
  			$jul = $JULY_FEE;
  			$aug = $AUG_FEE;
  			$sep = $SEP_FEE;
  			$oct = $OCT_FEE;
  			$nov = $NOV_FEE;
  			$dec = $DEC_FEE;
  			$jan = $JAN_FEE;
  			$feb = $FEB_FEE;
  			$mar = 'FREESHIP';
  		}
  		else
  		{
  			$apr = $APR_FEE;
  			$may = $MAY_FEE;
  			$jun = $JUNE_FEE;
  			$jul = $JULY_FEE;
  			$aug = $AUG_FEE;
  			$sep = $SEP_FEE;
  			$oct = $OCT_FEE;
  			$nov = $NOV_FEE;
  			$dec = $DEC_FEE;
  			$jan = $JAN_FEE;
  			$feb = $FEB_FEE;
  			$mar = $MAR_FEE;
  		}

  	}
  	else
  	{
  			$freeship_type='N/A';
			$apr = $APR_FEE;
  			$may = $MAY_FEE;
  			$jun = $JUNE_FEE;
  			$jul = $JULY_FEE;
  			$aug = $AUG_FEE;
  			$sep = $SEP_FEE;
  			$oct = $OCT_FEE;
  			$nov = $NOV_FEE;
  			$dec = $DEC_FEE;
  			$jan = $JAN_FEE;
  			$feb = $FEB_FEE;
  			$mar = $MAR_FEE;
  	}

  	$FREE = $this->input->post('radio4');
  	$FREE_TYPE = strtoupper($this->input->post('handicap'));

  	if($FREE==1){
  		$FREE_TYPE1 = $FREE_TYPE;
  	}
  	else
  	{
  		$FREE_TYPE1 = 'N/A';
  	}
	  
	  $current_image = $student_data[0]->student_image;
  	
	
	if(!empty($_FILES['reupload']['name'])){
		$image              = $_FILES['reupload']['name']; 
		$expimage           = explode('.',$image);
		$count              = count($expimage);
		$image_ext          = $expimage[$count-1];
		$image_name         = $student_id .'.'.$image_ext;
		$imagepath          = "assets/student_photo/".$image_name;
		
		move_uploaded_file($_FILES["reupload"]["tmp_name"],$imagepath);
		}else{
			$imagepath  = $current_image;
		}


	$student_details = array(
   	'STUDENTID'      => $student_id,
   	'ADM_DATE'       => $this->input->post('ad'),
   	'ADM_NO'         => $student_admission,
   	'FIRST_NM' 	  	 => strtoupper($this->input->post('sfn')),
   	'ADM_CLASS'      => $this->input->post('admclass'),
   	'ADM_SEC'        => $this->input->post('admsec'),
   	'CLASS'          => $cur_class_code,
   	'DISP_CLASS'     => $class_name,
   	'SEC'            => $cur_sec_code,
   	'DISP_SEC'       => $section_name,
   	'EMP_WARD' 		 => $this->input->post('ward'),
	'ROLL_NO'        => $this->input->post('roll'),
   	'SEX'            => $this->input->post('sex'),
   	'BIRTH_DT'       => $this->input->post('dob'),
   	'CATEGORY'       => $this->input->post('category'),
   	'STOPNO'         => $this->input->post('BUSSTOPAGE'),
   	'BLOOD_GRP'      => $this->input->post('blood_group'),
   	'Bus_Book_No'    => $this->input->post('aadhar_no'),
   	'religion'       => $this->input->post('religionn'),
   	'FREESHIP'       => $freeship,
   	'LETTERNO'       => $freeship_type,
	'COMPUTER'		 => $this->input->post('radio2'),
   	'APR_FEE'        => $apr,
   	'MAY_FEE'        => $may,
   	'JUNE_FEE'       => $jun,
   	'JULY_FEE'       => $jul,
   	'AUG_FEE'        => $aug,
   	'SEP_FEE'        => $sep,
   	'OCT_FEE'        => $oct,
   	'NOV_FEE'        => $nov,
   	'DEC_FEE'        => $dec,
   	'JAN_FEE'        => $jan,
   	'FEB_FEE'        => $feb,
   	'MAR_FEE'        => $mar,
   	'FATHER_NM'      => strtoupper($this->input->post('fname')),
   	'MOTHER_NM'      => strtoupper($this->input->post('mname')),
   	'PERM_ADD'       => strtoupper($this->input->post('peradd')),
   	'P_CITY'         => strtoupper($this->input->post('percity')),
   	'P_STATE'        => strtoupper($this->input->post('perstate')),
   	'P_PIN'          => $this->input->post('per_pin'),
   	'CORR_ADD'       => strtoupper($this->input->post('cross_add')),
   	'C_CITY'         => strtoupper($this->input->post('cross_city')),
   	'C_PIN'          => $this->input->post('cross_pin'),
   	'C_STATE'        => strtoupper($this->input->post('crossstate')),
   	'CBSE_REG'       => strtoupper($this->input->post('cbsereg')),
   	'CBSE_ROLL'      => strtoupper($this->input->post('cbseroll')),
   	'student_image'  => $imagepath,
    'userlog'        => $logged_in_user

   );
	
   $student_father = array(
   	'STDID' => $student_id, 
   	'ED_QUA' => strtoupper($this->input->post('fedu')),
   	'OCCUPATION' => strtoupper($this->input->post('foccupation')),
   	'DESIG' => strtoupper($this->input->post('fdesignation')),
   	'MTH_INCOME' => $this->input->post('fincome'),
   	'MOBILE'     => $this->input->post('fmobile'),
	'EMAIL'     => $this->input->post('femail'),
   	'ADDRESS' => strtoupper($this->input->post('faddress')),
   	'CITY' => strtoupper($this->input->post('fcity')),
   	'STATE' => strtoupper($this->input->post('fstate')),
   	'PIN' => $this->input->post('fpin'),
   	'PTYPE' => "F",
	'DOB'   => strtoupper($this->input->post('fdob'))
   );

   $student_mother = array(
   	'STDID' => $student_id, 
   	'ED_QUA' => strtoupper($this->input->post('medu')),
   	'OCCUPATION' => strtoupper($this->input->post('moccu')),
   	'DESIG' => strtoupper($this->input->post('mdesignation')),
   	'MTH_INCOME' => $this->input->post('mincome'),
    'MOBILE'     => $this->input->post('mmobile'),
	'EMAIL'     => $this->input->post('memail'),
   	'ADDRESS' => strtoupper($this->input->post('maddress')),
   	'CITY' => strtoupper($this->input->post('mcity')),
   	'STATE' => strtoupper($this->input->post('mstate')),
   	'PIN' => $this->input->post('mpin'),
   	'PTYPE' => "M",
	'DOB'   => strtoupper($this->input->post('mdob'))
   );

   $childhist = array(
   	'StId' => $student_id,
   	'AdmNo' => $student_admission,
   	'Name1' =>strtoupper($this->input->post('first_name')),
   	'DOB1' =>$this->input->post('first_dob'),
   	'Sex1' =>$this->input->post('first_sex'),
   	'Adm1' =>$this->input->post('first_adm'),
   	'Name2' =>strtoupper($this->input->post('second_name')),
   	'DOB2' =>$this->input->post('second_dob'),
   	'Sex2' =>$this->input->post('second_sex'),
   	'Adm2' =>$this->input->post('second_adm'),
   	'Name3' =>strtoupper($this->input->post('third_name')),
   	'DOB3' =>  $this->input->post('third_dob'),
   	'Sex3' =>  $this->input->post('third_sex'),
   	'Adm3' =>  $this->input->post('third_adm'),
   	'Name4' => $this->input->post('fourth_name'),
   	'DOB4' =>  $this->input->post('fourth_dob'),
   	'Sex4' =>  $this->input->post('fourth_sex'),
   	'Adm4' =>  $this->input->post('fourth_adm')
   );
   $this->dbcon->update('student',$student_details,"ADM_NO='$student_admission'");
   $father_details = $this->dbcon->select('parents','*',"STDID='$student_id' AND PTYPE='F'");
   $f_cnt = count($father_details);
   if($f_cnt == 1){
	   $this->dbcon->update('parents',$student_father,"STDID='$student_id' AND PTYPE='F'");
   }else{
	  $this->dbcon->insert('parents',$student_father);
   }
   $mother_details = $this->dbcon->select('parents','*',"STDID='$student_id' AND PTYPE='F'");
   $m_cnt = count($father_details);
   if($m_cnt == 1){
	   $this->dbcon->update('parents',$student_mother,"STDID='$student_id' AND PTYPE='M'");
   }else{
	  $this->dbcon->insert('parents',$student_mother);
   }
   $child_details = $this->dbcon->select('childhist','*',"StId='$student_id' AND AdmNo='$student_admission'");
   $c_cnt = count($child_details);
   if($c_cnt == 1){
	   $this->dbcon->update('childhist',$childhist,"StId='$student_id' AND AdmNo='$student_admission'");
   }else{
	  $this->dbcon->insert('childhist',$childhist);
   }
   $this->session->set_flashdata('msg',"Successfully Updated");
   redirect(base_url('Student_details/show_student_details/'.$student_id));

   
   
  
  }

  public function Scholarship(){
	  
  	$data = $this->dbcon->select('scholarship','*');
  	$fee_head1 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='1'");
  	$fee_head2 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='2'");
  	$fee_head3 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='3'");
  	$fee_head4 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='4'");
  	$fee_head5 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='5'");
  	$fee_head6 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='6'");
  	$fee_head7 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='7'");
  	$fee_head8 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='8'");
  	$fee_head9 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='9'");
  	$fee_head10 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='10'");
  	$fee_head11 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='11'");
  	$fee_head12 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='12'");
  	$fee_head13 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='13'");
  	$fee_head14 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='14'");
  	$fee_head15 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='15'");
  	$fee_head16 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='16'");
  	$fee_head17 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='17'");
  	$fee_head18 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='18'");
  	$fee_head19 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='19'");
  	$fee_head20 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='20'");
  	$fee_head21 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='21'");
  	$fee_head22 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='22'");
  	$fee_head23 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='23'");
  	$fee_head24 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='24'");
  	$fee_head25 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='25'");
  	$scholarship = array(
  		'scholarship' =>$data,
  		'fee_head1' => $fee_head1,
  		'fee_head2' => $fee_head2,
  		'fee_head3' => $fee_head3,
  		'fee_head4' => $fee_head4,
  		'fee_head5' => $fee_head5,
  		'fee_head6' => $fee_head6,
  		'fee_head7' => $fee_head7,
  		'fee_head8' => $fee_head8,
  		'fee_head9' => $fee_head9,
  		'fee_head10' => $fee_head10,
  		'fee_head11' => $fee_head11,
  		'fee_head12' => $fee_head12,
  		'fee_head13' => $fee_head13,
  		'fee_head14' => $fee_head14,
  		'fee_head15' => $fee_head15,
  		'fee_head16' => $fee_head16,
  		'fee_head17' => $fee_head17,
  		'fee_head18' => $fee_head18,
  		'fee_head19' => $fee_head19,
  		'fee_head20' => $fee_head20,
  		'fee_head21' => $fee_head21,
  		'fee_head22' => $fee_head22,
  		'fee_head23' => $fee_head23,
  		'fee_head24' => $fee_head24,
  		'fee_head25' => $fee_head25
  	);
  	$this->fee_template('student_details/scholarship_master',$scholarship);
  }

  public function scholarship_student($val){
  	$month = $this->dbcon->select('month_master','*');
  	$class = $this->dbcon->select('classes','*');
  	$sec = $this->dbcon->select('sections','*');
  	$fee_head1 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='1'");
  	$fee_head2 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='2'");
  	$fee_head3 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='3'");
  	$fee_head4 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='4'");
  	$fee_head5 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='5'");
  	$fee_head6 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='6'");
  	$fee_head7 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='7'");
  	$fee_head8 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='8'");
  	$fee_head9 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='9'");
  	$fee_head10 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='10'");
  	$fee_head11 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='11'");
  	$fee_head12 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='12'");
  	$fee_head13 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='13'");
  	$fee_head14 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='14'");
  	$fee_head15 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='15'");
  	$fee_head16 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='16'");
  	$fee_head17 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='17'");
  	$fee_head18 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='18'");
  	$fee_head19 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='19'");
  	$fee_head20 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='20'");
  	$fee_head21 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='21'");
  	$fee_head22 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='22'");
  	$fee_head23 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='23'");
  	$fee_head24 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='24'");
  	$fee_head25 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='25'");
  	$scholarship = $this->dbcon->select('scholarship','*',"ADM_NO='$val'");
  	$data = array(
  		'month' => $month,
  		'class' => $class,
  		'sec'   => $sec,
  		'fee_head1' => $fee_head1,
  		'fee_head2' => $fee_head2,
  		'fee_head3' => $fee_head3,
  		'fee_head4' => $fee_head4,
  		'fee_head5' => $fee_head5,
  		'fee_head6' => $fee_head6,
  		'fee_head7' => $fee_head7,
  		'fee_head8' => $fee_head8,
  		'fee_head9' => $fee_head9,
  		'fee_head10' => $fee_head10,
  		'fee_head11' => $fee_head11,
  		'fee_head12' => $fee_head12,
  		'fee_head13' => $fee_head13,
  		'fee_head14' => $fee_head14,
  		'fee_head15' => $fee_head15,
  		'fee_head16' => $fee_head16,
  		'fee_head17' => $fee_head17,
  		'fee_head18' => $fee_head18,
  		'fee_head19' => $fee_head19,
  		'fee_head20' => $fee_head20,
  		'fee_head21' => $fee_head21,
  		'fee_head22' => $fee_head22,
  		'fee_head23' => $fee_head23,
  		'fee_head24' => $fee_head24,
  		'fee_head25' => $fee_head25,
  		'scholarship' => $scholarship
  	);
  	$this->fee_template('student_details/scholarship_details',$data);
  }

  public function scholarship_update(){
  	$admno = $this->input->post('admno1');
	  $logged_in_user = $this->session->userdata('username');
  	$update_scholarship = array(
  		'ADM_NO' => $admno,
  		'Apply_From' => $this->input->post('saf'),
  		'Owned_By' => $this->input->post('sgb'),
  		'S1' => $this->input->post('regform'),
  		'S2' => $this->input->post('af'),
  		'S3' => $this->input->post('adf'),
  		'S4' => $this->input->post('rs'),
  		'S5' => $this->input->post('bf'),
  		'S6' => $this->input->post('ef'),
  		'S7' => $this->input->post('hqf'),
  		'S8' => $this->input->post('pf'),
  		'S9' => $this->input->post('asf'),
  		'S10'=> $this->input->post('tf'),
  		'S11'=> $this->input->post('sf'),
  		'S12'=> $this->input->post('cf'),
  		'S13'=> $this->input->post('tb'),
  		'S14'=> $this->input->post('ic'),
  		'S15'=> $this->input->post('lf'),
  		'S16'=> $this->input->post('srf'),
  		'S17'=> $this->input->post('dry'),
  		'S17'=> $this->input->post('dry'),
  		'S18'=> $this->input->post('blt'),
  		'S19'=> $this->input->post('tie'),
  		'S20'=> $this->input->post('cdbf'),
  		'S21'=> $this->input->post('misc'),
  		'S22'=> $this->input->post('others'),
  		'S23'=> $this->input->post('books'),
  		'S24'=> $this->input->post('feeopt'),
  		'S25'=> $this->input->post('feeopt1'),
		'userlog' => $logged_in_user
  	);
  	$this->dbcon->update('scholarship',$update_scholarship,"ADM_NO='$admno'");
  	$this->session->set_flashdata('msg','Successfully Updated');
  	redirect(base_url('Student_details/scholarship_student/'.$admno));
  }

  public function add_scholarship(){
  	$adm = $this->dbcon->select('student','ADM_NO');
  	$month = $this->dbcon->select('month_master','*');
	$feehead = $this->dbcon->select('feehead','*');
  	// $fee_head1 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='1'");
  	// $fee_head2 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='2'");
  	// $fee_head3 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='3'");
  	// $fee_head4 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='4'");
  	// $fee_head5 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='5'");
  	// $fee_head6 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='6'");
  	// $fee_head7 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='7'");
  	// $fee_head8 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='8'");
  	// $fee_head9 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='9'");
  	// $fee_head10 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='10'");
  	// $fee_head11 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='11'");
  	// $fee_head12 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='12'");
  	// $fee_head13 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='13'");
  	// $fee_head14 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='14'");
  	// $fee_head15 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='15'");
  	// $fee_head16 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='16'");
  	// $fee_head17 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='17'");
  	// $fee_head18 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='18'");
  	// $fee_head19 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='19'");
  	// $fee_head20 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='20'");
  	// $fee_head21 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='21'");
  	// $fee_head22 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='22'");
  	// $fee_head23 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='23'");
  	// $fee_head24 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='24'");
  	// $fee_head25 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='25'");
  	$array = array(
  		'admno' =>$adm,
  		'month' => $month,
		'feehead' => $feehead
  		// 'fee_head1' => $fee_head1,
  		// 'fee_head2' => $fee_head2,
  		// 'fee_head3' => $fee_head3,
  		// 'fee_head4' => $fee_head4,
  		// 'fee_head5' => $fee_head5,
  		// 'fee_head6' => $fee_head6,
  		// 'fee_head7' => $fee_head7,
  		// 'fee_head8' => $fee_head8,
  		// 'fee_head9' => $fee_head9,
  		// 'fee_head10' => $fee_head10,
  		// 'fee_head11' => $fee_head11,
  		// 'fee_head12' => $fee_head12,
  		// 'fee_head13' => $fee_head13,
  		// 'fee_head14' => $fee_head14,
  		// 'fee_head15' => $fee_head15,
  		// 'fee_head16' => $fee_head16,
  		// 'fee_head17' => $fee_head17,
  		// 'fee_head18' => $fee_head18,
  		// 'fee_head19' => $fee_head19,
  		// 'fee_head20' => $fee_head20,
  		// 'fee_head21' => $fee_head21,
  		// 'fee_head22' => $fee_head22,
  		// 'fee_head23' => $fee_head23,
  		// 'fee_head24' => $fee_head24,
  		// 'fee_head25' => $fee_head25
  	);
  	$this->fee_template('student_details/add_scholarship',$array);
  }

  public function Scholarship_add()
  {
  	$data = $this->input->post('value');
  	$student_data = $this->dbcon->select('student','*',"ADM_NO='$data'");
  	$adm = $this->dbcon->select('scholarship','ADM_NO',"ADM_NO='$data'");
  	$name = $student_data[0]->FIRST_NM;
  	$class = $student_data[0]->DISP_CLASS;
  	$sec = $student_data[0]->DISP_SEC;
  	$roll = $student_data[0]->ROLL_NO;
  	$clssec = $class."-".$sec;
  	$cnt = count($adm);
  	$array = array($data,$cnt,$name,$clssec,$roll,$adm);
  	echo json_encode($array);
  }

  public function save_scholarship()
  {
  	$admission = $this->input->post('admission');
  	$student = $this->dbcon->select('student','*',"ADM_NO='$admission'");
  	$std_id = $student[0]->STUDENTID;
  	$classec = $this->input->post('clssec');
  	$septrater = explode("-", $classec);
  	$class = $septrater[0];
  	$sec = $septrater[1];
	$fee1 = $this->input->post('feehead1');
	$fee2 = $this->input->post('feehead2');
	$fee3 = $this->input->post('feehead3');
	$fee4 = $this->input->post('feehead4');
	$fee5 = $this->input->post('feehead5');
	$fee6 = $this->input->post('feehead6');
	$fee7 = $this->input->post('feehead7');
	$fee8 = $this->input->post('feehead8');
	$fee9 = $this->input->post('feehead9');
	$fee10 = $this->input->post('feehead10');
	$fee11 = $this->input->post('feehead11');
	$fee12 = $this->input->post('feehead12');
	$fee13 = $this->input->post('feehead13');
	$fee14 = $this->input->post('feehead14');
	$fee15 = $this->input->post('feehead15');
	$fee16 = $this->input->post('feehead16');
	$fee17 = $this->input->post('feehead17');
	$fee18 = $this->input->post('feehead18');
	$fee19 = $this->input->post('feehead19');
	$fee20 = $this->input->post('feehead20');
	$fee21 = $this->input->post('feehead21');
	$fee22 = $this->input->post('feehead22');
	$fee23 = $this->input->post('feehead23');
	$fee24 = $this->input->post('feehead24');
	$fee25 = $this->input->post('feehead25');
$logged_in_user = $this->session->userdata('username');
  	$array = array(
  		'ADM_NO' => $admission,
  		'STU_NAME' => strtoupper($this->input->post('name')),
  		'STUDENTID' => $std_id,
  		'CLASS' => $class,
  		'SEC' => $sec,
  		'ROLL_NO' => $this->input->post('roll'),
  		'S1' => $this->input->post('feehead1'),
  		'S2' => $this->input->post('feehead2'),
  		'S3' => $this->input->post('feehead3'),
  		'S4' => $this->input->post('feehead4'),
  		'S5' => $this->input->post('feehead5'),
  		'S6' => $this->input->post('feehead6'),
  		'S7' => $this->input->post('feehead7'),
  		'S8' => $this->input->post('feehead8'),
  		'S9' => $this->input->post('feehead9'),
  		'S10'=> $this->input->post('feehead10'),
  		'S11'=> $this->input->post('feehead11'),
  		'S12'=> $this->input->post('feehead12'),
  		'S13'=> $this->input->post('feehead13'),
  		'S14'=> $this->input->post('feehead14'),
  		'S15'=> $this->input->post('feehead15'),
  		'S16'=> $this->input->post('feehead16'),
  		'S17'=> $this->input->post('feehead17'),
  		'S18'=> $this->input->post('feehead18'),
  		'S19'=> $this->input->post('feehead19'),
  		'S20'=> $this->input->post('feehead20'),
  		'S21'=> $this->input->post('feehead21'),
  		'S22'=> $this->input->post('feehead22'),
  		'S23'=> $this->input->post('feehead23'),
  		'S24'=> $this->input->post('feehead24'),
  		'S25'=> $this->input->post('feehead25'),
  		'Apply_From' => $this->input->post('saf'),
  		'Owned_By' => $this->input->post('sgb'),
		'userlog'        => $logged_in_user
  	);
	$array1 = array(
		'SCHOLAR' => 1
	);
	if($fee1 > 0 || $fee2 > 0 || $fee3 > 0 || $fee4 > 0 || $fee5 > 0 || $fee6 > 0|| $fee7 > 0 || $fee8 > 0 || $fee9 > 0 || $fee10 > 0 || $fee11 > 0 || $fee12 > 0 || $fee13 > 0 || $fee14 > 0 || $fee15 > 0 || $fee16 > 0 || $fee17 > 0 || $fee18 > 0 || $fee19 > 0 || $fee20 > 0 || $fee21 > 0 || $fee22 > 0 || $fee23 > 0 || $fee24 > 0 || $fee25 > 25){
		$this->dbcon->update('student',$array1,"ADM_NO='$admission'");
		$this->dbcon->insert('scholarship',$array);
		$this->session->set_flashdata('msg',"Scholarship Given Successfully");
		redirect('Student_details/Scholarship/');
	}else{
		$this->session->set_flashdata('msg',"Please Enter Amount in any One Head");
		redirect('Student_details/add_scholarship');
	}
	

  	
  }
  public function checkadm(){
	 $adm = $this->input->post('val');
	 $data = $this->dbcon->select('student','*',"ADM_NO='$adm'");
	 $cnt = count($data);
	 echo $cnt;
  }
  public function delete_student_details($id){
	  $logged_in_user = $this->session->userdata('username');
	  $arr = array(
		'Student_Status' => 'UNACTIVE',
		  'userlog'        => $logged_in_user
	  );
	  if($this->dbcon->update('student',$arr,"STUDENTID='$id'")){
		  $this->session->set_flashdata('msg',"Student Deleted Successfully");
		  redirect('Student_details/Student_master');
	  }else{
		  $this->session->set_flashdata('msg',"Student Not Deleted Successfully");
		  redirect('Student_details/Student_master');
	  }
  }
  public function application_form()
	{
		$class['class'] = $this->dbcon->select('classes', '*');
		// print_r($class);die;
		$this->fee_template('student_details/application_form', $class);
	}

	public function save_application()
	{
		// print_r($_POST);die;
		// extract($_POST);
		$name = $this->input->post('name');
		$fname = $this->input->post('fname');
		$class = $this->input->post('class');
		$age = $this->input->post('age');
		$number = $this->input->post('number');
		$add1 = $this->input->post('add1');
		$add2 = $this->input->post('add2');

		$q = "INSERT INTO `application` (`Name`, `Father_name`, `class`, `age`, `number`, `address1`, `address2`)
		VALUES ('$name', '$fname', '$class', '$age', '$number', '$add1', '$add2')";

		$result = $this->db->query($q);
		if ($result) {
			$this->session->set_flashdata('msg', 'Your contact information is received successfully');
			redirect('Student_details/application_form');
		} else {
			echo "Error description: " . $this->db->error();
		}
		
	}
	
	public function add_photo($student_id) {
		// Get student details using your existing dbcon model
		$data['student'] = $this->dbcon->select('student', '*', "STUDENTID='$student_id'")[0];
		
		// Create student_photos table if it doesn't exist
		$this->create_photos_table();
		
		// Get existing photos
		$data['photos'] = $this->db->where('student_id', $student_id)
								  ->order_by('uploaded_at', 'DESC')
								  ->get('student_photos')
								  ->result();
		
		// Load view using your existing template method
		$this->fee_template('student_details/photo_gallery', $data);
	}

	
	private function create_photos_table() {
		if (!$this->db->table_exists('student_photos')) {
			$this->db->query("
				CREATE TABLE student_photos (
					id INT PRIMARY KEY AUTO_INCREMENT,
					student_id VARCHAR(20) NOT NULL,
					photo_path VARCHAR(255) NOT NULL,
					uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
				)
			");
		}
	}

	public function upload_photo($student_id) {
		
		$upload_path = './uploads/student_photos/';
		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0777, true);
		}
		
		
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = 2048; // 2MB max
		$config['encrypt_name'] = TRUE;
		
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('photo')) {
			$error = $this->upload->display_errors();
			$this->session->set_flashdata('error', $error);
		} else {
			$upload_data = $this->upload->data();
			$photo_path = 'uploads/student_photos/' . $upload_data['file_name'];
			
			// Save to database
			$data = array(
				'student_id' => $student_id,
				'photo_path' => $photo_path
			);
			$this->db->insert('student_photos', $data);
			
			$this->session->set_flashdata('success', 'Photo uploaded successfully');
		}
		
		redirect('Student_details/add_photo/' . $student_id);
	}

	public function delete_photo($photo_id, $student_id) {
		// Get photo details
		$photo = $this->db->where('id', $photo_id)
						  ->get('student_photos')
						  ->row();
		
		// Delete file from server
		if ($photo && file_exists('./' . $photo->photo_path)) {
			unlink('./' . $photo->photo_path);
		}
		
		// Delete from database
		$this->db->where('id', $photo_id)->delete('student_photos');
		
		$this->session->set_flashdata('success', 'Photo deleted successfully');
		redirect('Student_details/add_photo/' . $student_id);
	}

}
