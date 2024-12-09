<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$permission_data = $this->session->userdata('permission_data');
		define("permission_data", $permission_data);
		$login_details = $this->session->userdata('login_details');
		define("login_details", $login_details);
		$role_details = $this->sumit->fetchSingleData('*','role_master',array('ID'=>$login_details['ROLE_ID']));
		define("role_details", $role_details);
		$schoolData = $this->sumit->fetchSingleData('','school_setting',array('S_No'=>1));
		define("schoolData", $schoolData);
		date_default_timezone_set('Asia/Kolkata');

	}

	public function loggedOut()
	{
		$login_details = $this->session->userdata('login_details');
		if(empty($login_details))
		{
			redirect('login');
		}
	}
	public function render_template($page=null, $data=null)
	{
		$data['login_details'] = $this->session->userdata('login_details');
		$this->load->view('payroll_main/header',$data);
		$this->load->view('payroll_main/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view('payroll_main/footer',$data);
	}


	public function teacher_template($page=null, $data=null)
	{
		$data['login_details'] = $this->session->userdata('login_details');
		$this->load->view('teacher_main/header',$data);
		$this->load->view('payroll_main/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view('payroll_main/footer',$data);
	}

	public function fee_template($page=null, $data=null)
	{
		$data['login_details'] = $this->session->userdata('login_details');
		$this->load->view('fees_main/header',$data);
		$this->load->view('payroll_main/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view('payroll_main/footer',$data);
	}
	public function fee_template1($page=null, $data=null)
	{
		$data['login_details'] = $this->session->userdata('login_details');
		$this->load->view('fees_main/header',$data);
		$this->load->view('payroll_main/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view('payroll_main/footer',$data);
	}
	
	public function Parent_templete($page=null, $data=null){
		/* $data['login_details'] = $this->session->userdata('login_details'); */
		$this->load->view('parent_mains/header',$data);
		$this->load->view('parent_mains/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view('parent_mains/footer',$data);
	}

	public function checkLogin()
	{
		$login_details = $this->session->userdata('login_details');
		if(!empty($login_details))
		{
				redirect('payroll/dashboard/emp_dashboard');
		}
	}


	// public function reportCardGenerationforTerm1orTerm2($adm_no,$term,$termId,$round_off)
	// {
	// 	if($term == 1)
	// 	{
	// 		$term = 'TERM-1';
	// 		$examcode = array('1','2','3','4');
	// 	}else
	// 	{
	// 		$term = 'TERM-2';
	// 		$examcode = array('1','2','3','5');
	// 	}

	// 	foreach ($adm_no as $key => $value) {
			
	// 		$stu_data = $this->alam->studentDetailsByAdmissionNo($value,$termId);
	// 		$result[$value] = $stu_data;
	// 		$class = $stu_data['CLASS'];
	// 		$section = $stu_data['SEC'];
	// 		$subjectData = $this->alam->getClassWiseSubject($term,$class,$section);

	// 		foreach ($subjectData as $key2 => $val2) {

	// 			if($val2['opt_code'] == 2)
	// 			{
	// 				$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$value,'Class'=>$class,'SUBCODE'=>$val2['subject_code']));
	// 			}
	// 			else
	// 			{
	// 				$check_student_subject = true;
	// 			}

	// 			if($check_student_subject)
	// 			{
	// 				$sub_code = $val2['subject_code'];
	// 				$pt_type = $val2['pt_type'];
	// 				$final_marks = array();
	// 				$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
	// 				$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];

	// 				foreach ($examcode as $keys => $val) {

	// 					$examC = ($val==1)?"1,7,8":$val;
	// 					$marks =array();
	// 					$tot_per = 0;
	// 					$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC','marks',"admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$term'");
	// 					$wetageMarks = $this->sumit->fetchSingleData('wetage1','exammaster',array('ExamCode'=>$val));

	// 					$absent = array();
	// 					$ab = 0;
	// 					$marks_not_entered = '-';
	// 					$sub_marks = 0;
	// 					if($val == 1)
	// 					{
	// 						if($pt_type == 1)
	// 						{
	// 							$mark = array();
	// 							foreach ($all_marks as $key4 => $value4) {

	// 								$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
	// 								$ab = ($value4['M2']=='AB')?$value4:
	// 								// $absent[$key4] = $value4['M2'];
	// 							}
	// 							// $absent_count = count($absent);
	// 							// $total_ab_count = array_count_values($absent);
	// 							// $total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
	// 							// $ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
	// 							$final_marks[$keys] = ($ab == 'AB')?$ab:number_format(max($mark),2);

	// 						}
	// 						elseif($pt_type == 2)
	// 						{						
	// 							foreach ($all_marks as $key4 => $value4) {

	// 								$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
	// 								$tot_per = $tot_per + $mark[$key4];
	// 								$absent[$key4] = $value4['M2'];
	// 							}
	// 							$absent_count = count($absent);
	// 							$total_ab_count = array_count_values($absent);
	// 							$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
	// 							$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
	// 							$final_marks[$keys] = ($ab == 'AB')?$ab:number_format($tot_per/3,2);
	// 							// $final_marks[$keys] = number_format($tot_per/3,2);
	// 						}
	// 						else
	// 						{
	// 							$mark = array();
	// 							foreach ($all_marks as $key4 => $value4) {

	// 								$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
	// 								$absent[$key4] = $value4['M2'];
	// 							}
	// 							rsort($mark);
	// 							$mark[1] = isset($mark[1])?$mark[1]:0;
	// 							$mark[0] = isset($mark[0])?$mark[0]:0;
	// 							$two_sum = $mark[0] + $mark[1];
	// 							$absent_count = count($absent);
	// 							$total_ab_count = array_count_values($absent);
	// 							$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
	// 							$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
	// 							// $final_marks[$keys] = number_format($two_sum/2,2);
	// 							$final_marks[$keys] = ($ab == 'AB')?$ab:number_format($two_sum/2,2);
	// 						}

	// 					       ($round_off==1)?$final_marks[$keys] = round($final_marks[$keys]):$final_marks[$keys] = $final_marks[$keys];
	// 					}else{
	// 						if(!empty($all_marks))
	// 						{
	// 							$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];

	// 							$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
	// 						}
	// 						else
	// 						{
	// 							$mark = 0;
	// 						}
	// 						if($mark == 'AB' || $mark == '-')
	// 						{
	// 							$final_marks[$keys] = $mark;
	// 						}
	// 						else
	// 						{
	// 							$final_marks[$keys] = ($round_off==1)?round($mark): number_format($mark,2);								
	// 						}
							
	// 					}
	// 				}
	// 				$marks['pt'] = $final_marks[0]; 
	// 				$marks['notebook'] = $final_marks[1];
	// 				$marks['subject_enrichment'] =$final_marks[2];
	// 				$marks['half_yearly'] = $final_marks[3];

	// 				$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
	// 				$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
	// 				$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
	// 				$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];

	// 				$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks;
	// 				$marks['marks_obtained'] = ($round_off==1)?round($marks_obtained): number_format($marks_obtained,2);
	// 				$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained AND CRange <= $marks_obtained");
	// 				$marks['grade'] = $gradeData['Grade'];
	// 				$result[$value]['sub'][$key2]['marks'] = $marks;
	// 			}
	// 		}
	// 	}
	// 	return $result;
	// }
}