<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CopyQuestions extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){

		if(!in_array('viewHomework', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}
        
		$class              = login_details['Class_No'];
		$sec                = login_details['Section_No'];
		$user_id            = login_details['user_id'];
		
		$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id' order by Class_no");
		$this->render_template('e_exam/copyQuestions',$data);
	}
	
	public function loadSec(){
		$user_id  = login_details['user_id'];
		$class_id = $this->input->post('class_id');
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class_id'");
		?>
			<option value=''>Select</option>
		<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['section_no']; ?>'><?php echo $val['secnm']; ?></option>
			<?php
		}
	}
	
	public function loadSubj(){
		$user_id  = login_details['user_id'];
		$cls      = $this->input->post('cls');
		$sec_id   = $this->input->post('sec_id');
		
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm',"Main_Teacher_Code='$user_id' AND Class_No = '$cls' AND section_no = '$sec_id'");
		?>
			<option value=''>Select</option>
		<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['subject_code']; ?>'><?php echo $val['subjnm']; ?></option>
			<?php
		}
	}
	
	public function getExamDate(){
		$cls      = $this->input->post('cls');
		$section  = $this->input->post('section');
		$subj     = $this->input->post('subj');
		$examDateData = $this->alam->selectA('e_exam_questions','classes,sec,subject,examDate',"classes='$cls' AND sec='$section' AND subject='$subj' GROUP BY classes,sec,subject,examDate");
		
        ?>
			<option value=''>Select</option>
		<?php
		foreach($examDateData as $key => $val){
			?>
				<option value='<?php echo $val['examDate']; ?>'><?php echo $val['examDate']; ?></option>
			<?php
		}
		
	}
	
	public function getExamTime(){
		$cls      = $this->input->post('cls');
		$section  = $this->input->post('section');
		$subj     = $this->input->post('subj');
		$examDate = $this->input->post('examDate');
		$examTimeData = $this->alam->selectA('e_exam_questions','classes,sec,subject,examTime',"classes='$cls' AND sec='$section' AND subject='$subj' AND examDate='$examDate' GROUP BY classes,sec,subject,examTime");
		
        ?>
			<option value=''>Select</option>
		<?php
		foreach($examTimeData as $key => $val){
			?>
				<option value='<?php echo $val['examTime']; ?>'><?php echo $val['examTime']; ?></option>
			<?php
		}
	}
	
	public function getQuestions(){
		$user_id  = login_details['user_id'];
		$cls      = $this->input->post('cls');
		$section  = $this->input->post('section');
		$subj     = $this->input->post('subj');
		$examDate = $this->input->post('examDate');
		$examTime = $this->input->post('examTime');
		
		$data['getQuestionData'] = $this->alam->selectA('e_exam_questions','id,que_no,question,que_img,max_marks',"classes='$cls' AND sec='$section' AND subject='$subj' AND examDate='$examDate'");
		
		$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id' order by Class_no");
		$this->load->view('e_exam/loadCopyQuestions',$data);		
	}
	
	public function insertValidation(){
		$cls      = $this->input->post('cls');
		$section  = $this->input->post('section');
		$subj     = $this->input->post('subj');
		$examDate = date('d-M-Y',strtotime($this->input->post('examDate')));
		
		$chkData = $this->alam->selectA('e_exam_questions','count(*)cnt',"classes='$cls' AND sec='$section' AND examDate='$examDate' AND subject='$subj'");
		$cnt = $chkData[0]['cnt'];
		
		if($cnt == 0){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	public function pasteQuestion(){
		$user_id  = login_details['user_id'];
		$cls      = $this->input->post('cls');
		$section  = $this->input->post('section');
		$subj     = $this->input->post('subj');
		$examDate = $this->input->post('examDate');
		$examTime = $this->input->post('examTime');
		
		$paste_cls = $this->input->post('paste_cls');
		$paste_sec = $this->input->post('paste_sec');
		$paste_examDate = $this->input->post('paste_examDate');
		$paste_examTime = $this->input->post('paste_examTime');
		$paste_examTimeDuration = $this->input->post('paste_examTimeDuration');
		
		$getQuestionData = $this->alam->selectA('e_exam_questions','subject,question_type,que_no,question,que_img,max_marks,ans_key',"classes='$cls' AND sec='$section' AND subject='$subj' AND examDate='$examDate' AND examTime='$examTime'");
		
		foreach($getQuestionData as $key => $val){
			$save = array(
				'classes' => $paste_cls, 
				'sec' => $paste_sec, 
				'subject' => $subj, 
				'question_type' => $val['question_type'], 
				'que_no' => $val['que_no'],
				'question' => $val['question'], 
				'que_img' => $val['que_img'], 
				'max_marks' => $val['max_marks'],
				'examDate' => $paste_examDate, 
				'examTime' => $paste_examTime, 
				'examTimeDuration' => $paste_examTimeDuration, 
				'empid' => $user_id, 
				'exam_display_status' => 1, 
				'ans_key' => $val['ans_key']
			);
			$this->alam->insert('e_exam_questions',$save);
		}
	}
}
