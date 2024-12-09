<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MarksReportstudentanskey extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');		
		$this->load->model('Alam','alam');		
	}
	
	public function index(){	
		$array['class_no']   	= $this->pawan->selectA('classes','*');						
        $this->render_template('e_exam/marks_report_student_key',$array);		
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
   $qus		=$this->pawan->selectA('e_exam_questions','que_no,id,ans_key',"classes='$classes' and sec='$section_id' and subject='$subject' and examDate='$exam_date2' order by que_no ASC");
		$cont		=$this->pawan->selectA('e_exam_questions','count(id) as adn',"classes='$classes' and sec='$section_id' and subject='$subject' and examDate='$exam_date2'");
		
		$maxnum		=$this->pawan->selectA('e_exam_questions','SUM(max_marks) as max',"classes='$classes' and sec='$section_id' and subject='$subject' and examDate='$exam_date2' order by que_no ASC");
	
	?>
		<input type="button" value="Print" class="btn btn-success btn-sm" onclick="printDiv()"><br><br>
		<div id="GFG" class="table-responsive">
		<table class='table' width="100%" cellspacing="0" style="font-size:10px;">
			<tr >					
					<td style="background:#5785c3; color:#fff!important;border-left: 1px solid;border-bottom:1px solid"><img src='<?php echo base_url(); echo $schoolset[0]['SCHOOL_LOGO'];?>' class='img-responsive'></td><td style="background:#5785c3; color:#fff!important;border-right: 1px solid;border-bottom:1px solid" colspan="<?=$cont[0]['adn']+4?>"><center style="font-size:30px"><strong><?=$schoolset[0]['School_Name'];?><br /><?=$schoolset[0]['School_Address'];?></strong></center></td>
			</tr>
					<tr>					
					<td colspan="<?=$cont[0]['adn']-5?>" style="background:#5785c3; color:#fff!important;border-left: 1px solid;border-bottom:1px solid" colspan="2">Class : <?=$classess;?>-<?=$section;?>&nbsp;&nbsp;</td>
					<td style="background:#5785c3; color:#fff!important;border-bottom:1px solid;text-align:center">
					<?=$Sujects;?></td>
					<td colspan="9" style="background:#5785c3; color:#fff!important;border-right: 1px solid;border-bottom:1px solid;"  colspan='3'><span style="float: right;">Exam Date:&nbsp;<?=date('d-M-Y',strtotime($exam_date));?></span>
					</td>
					</tr>
				<tr>					
					
					
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Sl. No.</strong></td>	
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Reg. No.</strong></td>					
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Name of Student</strong></td>
					<?php
					
					foreach($qus as $key=>$val){
				?>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Q.<?=$val['que_no']?></strong></td>
					
				<?php }?>
						<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Max Marks</strong></td>					
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Marks Obtained</strong></td>
				</tr>
				<tr>					
					
					
					<td colspan="3" style='background:#3366FF; color:#fff!important;border: 1px solid;'><strong>ANSWER KEY</strong></td>	
					
					<?php
					
					foreach($qus as $key=>$val){
				?>
					<td style='background:#3366FF; color:#fff!important;border: 1px solid;'><strong><?=$val['ans_key']?></strong></td>
					
				<?php }?>
						<td style='background:#3366FF; color:#fff!important;border: 1px solid;'><strong><?=$maxnum[0]['max']?></strong></td>					
					<td style='background:#3366FF; color:#fff!important;border: 1px solid;'><strong>-</strong></td>
				</tr>
				
				<?php
				$c=0;
		
				foreach($stuList as $key=>$val){
				?>
				<tr>				
				<td style="border: 1px solid ;"><?=++$c;?></td>
				<td style="border: 1px solid ;"><?=$val['ADM_NO'];?></td>				
				<td style="border: 1px solid ;"><?=$val['FIRST_NM'];?></td>
				<?php
				$ADM=$val['ADM_NO'];
				$obt_marks=$this->pawan->selectA('e_exam_answers','SUM(ob_marks) as obmarks',"date(created_at)='$exam_date' and class_no='$classes' and sec_no='$section_id' AND admno='$ADM'");
					foreach($qus as $key=>$val){
					
					$ANSID=$this->pawan->ans_key($val['id'],$classes,$section_id,$ADM,$subject);
					$STUANS=(!empty($ANSID[0]->ans))?$ANSID[0]->ans:'';
					$ANSKEY=$val['ans_key'];
					if($STUANS!='')
					{
					if($ANSKEY==$STUANS){
				?>
				
					<td style='border: 1px solid;'><strong><?=$STUANS;?></strong></td>
					
				<?php }else{ 
				echo "<td style='background:red; color:#fff!important;border: 1px solid;'><strong>$STUANS</strong></td>";
				}
				}else{
				echo "<td style='border: 1px solid;'><strong><?=$STUANS;?></strong></td>";
				}
				
				 }?>
				
					
						<td style='border: 1px solid;'><strong><?=$maxnum[0]['max']?></strong></td>					
					<td style='border: 1px solid;'><strong><?php if(empty($obt_marks[0]['obmarks'])){ echo 'NOT APPEARED';}else{ echo $obt_marks[0]['obmarks'];}?></strong></td>
				
				</tr>
	<?php	}?>
</table>


  
</div> 
		
<?php		
		
		
	}
}
