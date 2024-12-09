<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MarksReportstudent extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');		
		$this->load->model('Alam','alam');		
	}
	
	public function index(){	
		$array['class_no']   	= $this->pawan->selectA('classes','*');						
        $this->render_template('e_exam/marks_report_student',$array);		
	}
	
	public function Class_sec(){
		 $class_no	=$this->input->post('class_code');
		 $data = $this->pawan->section_name_cwisw($class_no);
		 ?>


		<select id="section_id" name='section_id' style="padding:2px; width:174px;">
			    <option value=''>Select</option>
				<?php
				  if(isset($data)){
					  foreach($data as $dt){
						?>
						<option value="<?php echo $dt->section_no; ?>"><?php echo $dt->section_nm; ?></option>
						<?php
					  }
				  }
				?>
		</select>
			  <?php 
	}
	
	public function subject_nam(){
		 $class_no	=$this->input->post('class_code');
		 $sec_no	=$this->input->post('sec_no');
		 $data1 = $this->pawan->subject_name_cwisw($class_no);
		 print_r($data1);
		 ?>


		<select id="subject_nam" name='subject' style="padding:2px; width:174px;" onchange='section_sec(this.value)'>
			    <option value=''>Select</option>
				<?php
				  if(isset($data1)){
					  
					  foreach($data1 as $dt1){
						  
						?>
						<option value="<?php echo $dt1->subject; ?>"><?php echo $dt1->sub_name; ?></option>
						<?php
					  }
				  }
				?>
		</select>
			  <?php 
	}
	
	
	
	public function examDate(){		
		  $class_no			= $this->input->post('class_code');
		  $section_no		= $this->input->post('sec_no');
		  $subject_nam		= $this->input->post('subject_ids');
		  $exmdat			= $this->pawan->selectA('e_exam_questions','examDate',"classes='$class_no' and sec='$section_no' and subject='$subject_nam' group by examDate");
		  //echo $this->db->last_query();die;
		  ?>
		  <select id="exam_date" name='exam_date' style="padding:2px; width:174px;" >
			    <option value=''>Select</option>
				<?php
				  if(!empty($exmdat)){
					  
					  foreach($exmdat as $key => $vals){
						  
						?>
						<option value="<?php echo $vals['examDate']; ?>"><?php echo $vals['examDate']; ?></option>
						<?php
					  }
				  }
				?>
		</select>
			  <?php
		 
	}
	
	public function generateMarksReport(){
		 $classes	  	= $this->input->post('classes');
		 $section_id  	= $this->input->post('section_id');
		 $subject	  	= $this->input->post('subject');
		 $exam_date		= date('Y-m-d',strtotime($this->input->post('exam_date')));
		 $exam_date2	= date('d-M-Y',strtotime($this->input->post('exam_date')));
		
		 $exam_date	= $exam_date;
		 $cls	=$this->pawan->selectA('classes','CLASS_NM',"Class_No='$classes'");
		 $classess	=	$cls[0]['CLASS_NM'];
		 $sec	=$this->pawan->selectA('sections','SECTION_NAME',"section_no='$section_id'");
		  $section	=	$sec[0]['SECTION_NAME'];
		 $sub	=$this->pawan->selectA('subjects','SubName',"SubCode='$subject'");
		 $Sujects	=	$sub[0]['SubName'];
		 $stuList = $this->alam->selectA('student',"ADM_NO,FIRST_NM,ROLL_NO,
		 (SELECT sum(ob_marks)as marks_obt FROM e_exam_answers WHERE e_exam_answers.admno=student.ADM_NO AND e_exam_answers.subj_id='$subject' and date(created_at)='$exam_date' )obt_marks,
		 (SELECT count(ob_marks) FROM e_exam_answers WHERE e_exam_answers.admno=student.ADM_NO AND e_exam_answers.subj_id='$subject' and ob_marks>0 and date(created_at)='$exam_date')totcorrect,
		 (select count(id) FROM e_exam_questions WHERE classes='$classes' and sec='$section_id' and subject='$subject' and examDate='$exam_date2')totalqus","CLASS='$classes' and SEC='$section_id' ORDER BY obt_marks DESC");
		// echo $this->db->last_query();
		
   $schoolset	=$this->pawan->selectA('school_setting','*');
	?>
		<input type="button" value="Print" class="btn btn-success btn-sm" onclick="printDiv()"><br><br>
		<div id="GFG">
		<table class='table' width="100%" cellspacing="0">
			<tr>					
					<td style="background:#5785c3; color:#fff!important;border-left: 1px solid;border-bottom:1px solid"><img src='<?php echo base_url(); ?><?=$schoolset[0]['SCHOOL_LOGO'];?>' class='img-responsive'></td><td style="background:#5785c3; color:#fff!important;border-right: 1px solid;border-bottom:1px solid" colspan="5"><center style="font-size:30px"><strong><?=$schoolset[0]['School_Name'];?><br /><?=$schoolset[0]['School_Address'];?></strong><center></td>
					</tr>
					<tr>					
					<td style="background:#5785c3; color:#fff!important;border-left: 1px solid;border-bottom:1px solid" colspan="2">Class : <?=$classess;?>-<?=$section;?>&nbsp;&nbsp;</td>
					<td style="background:#5785c3; color:#fff!important;border-bottom:1px solid;text-align:center">
					<?=$Sujects;?></td>
					<td style="background:#5785c3; color:#fff!important;border-right: 1px solid;border-bottom:1px solid;"  colspan='3'><span style="float: right;">Exam Date:&nbsp;<?=date('d-M-Y',strtotime($exam_date));?></span>
					</td>
					</tr>
				<tr>					
					
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Reg. No.</strong></td>					
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Name of Student</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Total Question</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Total Corrected</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Total Incorrect</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Marks Obtained</strong></td>
					
				</tr>
				<?php
				$c=0;
		
				foreach($stuList as $key=>$val){
				?>
				<tr>				
				
				<td style="border: 1px solid ;"><?=$val['ADM_NO'];?></td>				
				<td style="border: 1px solid ;"><?=$val['FIRST_NM'];?></td>
				<td style="border: 1px solid ;"><?=$val['totalqus'];?></td>
				<td style="border: 1px solid ;"><?=$val['totcorrect'];?></td>
				<td style="border: 1px solid ;"><?=$val['totalqus']-$val['totcorrect'];?></td>
				<td style="border: 1px solid ;"><?if(!empty($val['obt_marks'])){echo $val['obt_marks'];}else{ echo "<span style='color:red'>Not Appeared</span>";}?></td>
				</tr>
	<?php	}?>
</table>

  
</div> 
		
<?php		
		
		
	}
}
