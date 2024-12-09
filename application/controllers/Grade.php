<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grade extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$this->teacher_template('marks_entry/coscho_term');
	}
	
	public function cosoc($trm){
	    $class_data = $this->alam->select('classes','*');
		$array = array('class_data'=>$class_data,'trm'=>$trm);
		
		$this->teacher_template('marks_entry/co_scholastic_grade',$array);
	}
	
	public function classess(){
		$ret = '';
		$class_nm = $this->input->post('val');
		$sec_data = $this->alam->select_order_by('student','distinct(DISP_SEC),SEC','DISP_SEC',"CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
			}
		}
		
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function stu_list(){
		$classs      = $this->input->post('classs');
		$disp_classs = $this->input->post('disp_classs');
		$sec         = $this->input->post('sec');
		$trm         = $this->input->post('trm');
		
		$data        = $this->alam->co_scholastic_grade_data($classs,$sec,$trm);
		
		?>
		  <table class='table'>
		    <tr>
			  <th style="background:#5785c3; color:#fff!important;">Adm No</th>
			  <th style="background:#5785c3; color:#fff!important;">Student</th>
			  <th style="background:#5785c3; color:#fff!important;">Roll No</th>
			  <th style="background:#5785c3; color:#fff!important;">WORK EDUCATION GRADE</th>
			  <th style="background:#5785c3; color:#fff!important;">ART EDUCATION GRADE</th>
			  <th style="background:#5785c3; color:#fff!important;">HEALTH & PHYSICAL EDUCATION GRADE</th>
		    </tr>
			<?php
			if(isset($data)){
				foreach($data as $co_data){
					?>
					<tr>
					
						<td><?php echo $co_data->ADM_NO; ?></td>
						<td><?php echo $co_data->FIRST_NM; ?></td>
						<td><?php echo $co_data->ROLL_NO; ?></td>
						<?php
						  if($disp_classs == 'IX' || $disp_classs == 'X'){
						?>
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill1; ?>" style="width:50px;" onchange="co_sch(1,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill2; ?>" style="width:50px;" onchange="co_sch(2,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill3; ?>" style="width:50px;" onchange="co_sch(3,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<?php } else{ ?>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill1; ?>" style="width:50px;" onchange="co_sch(1,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill2; ?>" style="width:50px;" onchange="co_sch(2,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill3; ?>" style="width:50px;" onchange="co_sch(3,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<?php } ?>
					</tr>	
					<?php
				}
			}
			?>
			</table>
		    <?php
	}
	
	public function save_upd(){
		$adm_no   = $this->input->post('adm_no');
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$skill_id = $this->input->post('skill_id');
		$grade    = strtoupper($this->input->post('grade'));
		$trm      = $this->input->post('trm');
		
		$co_sch_data = $this->alam->select('co_scholastic_grade','count(*)cnt',"Adm_no='$adm_no'AND Class='$classs' AND Sec='$sec' AND Term='$trm' AND SkillCode='$skill_id'");
		$cnt = $co_sch_data[0]->cnt;
		if($cnt == 1){
			$upd_data = array(
			'Grade' => $grade
			);
			
			$this->alam->update('co_scholastic_grade',$upd_data,"Adm_no='$adm_no'AND Class='$classs' AND Sec='$sec' AND Term='$trm' AND SkillCode='$skill_id'");
		}else{
			$ins_data = array(
			'Adm_no' => $adm_no,
			'Class' => $classs,
			'Sec' => $sec,
			'Term' => $trm,
			'SkillCode' => $skill_id,
			'Grade' => $grade,
			);
			
			$this->alam->insert('co_scholastic_grade',$ins_data);
		}
	}
	
	public function discipline_term(){
		$this->teacher_template('marks_entry/discipline_term');
	}
	
	public function displin_grd($trm){
		$class_data = $this->alam->select('classes','*');
		$array = array('class_data'=>$class_data,'trm'=>$trm);
		
		$this->teacher_template('marks_entry/discipline_grade',$array);
	}
	
	public function classess_discipline(){
		$ret = '';
		$class_nm = $this->input->post('val');
		$sec_data = $this->alam->select_order_by('student','distinct(DISP_SEC),SEC','DISP_SEC',"CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
			}
		}
		
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function stu_list_discipline(){
		$classs      = $this->input->post('classs');
		$disp_classs = $this->input->post('disp_classs');
		$sec         = $this->input->post('sec');
		$trm         = $this->input->post('trm');
		
		$data        = $this->alam->discipline_grade($classs,$sec,$trm);
		
		?>
		  <table class='table'>
		    <tr>
			  <th style="background:#5785c3; color:#fff!important;">Adm No</th>
			  <th style="background:#5785c3; color:#fff!important;">Student</th>
			  <th style="background:#5785c3; color:#fff!important;">Roll No</th>
			  <th style="background:#5785c3; color:#fff!important;">Discipline Grade</th>
		    </tr>
			<?php
			if(isset($data)){
				foreach($data as $co_data){
					?>
					<tr>
					
						<td><?php echo $co_data->ADM_NO; ?></td>
						<td><?php echo $co_data->FIRST_NM; ?></td>
						<td><?php echo $co_data->ROLL_NO; ?></td>
						<?php
						  if($disp_classs == 'IX' || $disp_classs == 'X'){
						?>
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill1; ?>" style="width:50px;" onchange="discipline_grd('<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<?php } else{ ?>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill1; ?>" style="width:50px;" onchange="discipline_grd('<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<?php } ?>
					</tr>	
					<?php
				}
			}
			?>
			</table>
		    <?php
	}
	
	public function save_upd_discipline(){
		$adm_no   = $this->input->post('adm_no');
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$grade    = strtoupper($this->input->post('grade'));
		$trm      = $this->input->post('trm');
		
		$co_sch_data = $this->alam->select('discipline_grades','count(*)cnt',"Adm_no='$adm_no'AND Class='$classs' AND Sec='$sec' AND Term='$trm'");
		$cnt = $co_sch_data[0]->cnt;
		if($cnt == 1){
			$upd_data = array(
			'Grade' => $grade
			);
			
			$this->alam->update('discipline_grades',$upd_data,"Adm_no='$adm_no'AND Class='$classs' AND Sec='$sec' AND Term='$trm'");
		}else{
			$ins_data = array(
			'Adm_no' => $adm_no,
			'Class' => $classs,
			'Sec' => $sec,
			'Term' => $trm,
			'Grade' => $grade
			);
			
			$this->alam->insert('discipline_grades',$ins_data);
		}
	}
	
	public function discipline_grade_skill_wise_term(){
		$this->teacher_template('marks_entry/discipline_grade_skill_wise_term');
	}
	
	public function discipline_grade_skill_wise($trm){
		$class_data = $this->alam->select('classes','*');
		$array = array('class_data'=>$class_data,'trm'=>$trm);
		
		$this->teacher_template('marks_entry/discipline_grade_skill_wise',$array);
	}
	
	public function classess_disci_skill_wise(){
		$ret = '';
		$class_nm = $this->input->post('val');
		$sec_data = $this->alam->select_order_by('student','distinct(DISP_SEC),SEC','DISP_SEC',"CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
			}
		}
		
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function stu_list_disci_skill_wise(){
		$classs      = $this->input->post('classs');
		$disp_classs = $this->input->post('disp_classs');
		$sec         = $this->input->post('sec');
		$trm         = $this->input->post('trm');
		
		$data        = $this->alam->discipline_grade_skill_wise($classs,$sec,$trm);
		
		?>
		  <table class='table'>
		    <tr>
			  <th style="background:#5785c3; color:#fff!important;">Adm No</th>
			  <th style="background:#5785c3; color:#fff!important;">Student</th>
			  <th style="background:#5785c3; color:#fff!important;">Roll No</th>
			  <th style="background:#5785c3; color:#fff!important;">Attendance Grade</th>
			  <th style="background:#5785c3; color:#fff!important;">Sincerity Grade</th>
			  <th style="background:#5785c3; color:#fff!important;">Behaviour Grade</th>
			  <th style="background:#5785c3; color:#fff!important;">Values Grade</th>
		    </tr>
			<?php
			if(isset($data)){
				foreach($data as $co_data){
					?>
					<tr>
					
						<td><?php echo $co_data->ADM_NO; ?></td>
						<td><?php echo $co_data->FIRST_NM; ?></td>
						<td><?php echo $co_data->ROLL_NO; ?></td>
						<?php
						  if($disp_classs == 'IX' || $disp_classs == 'X'){
						?>
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill1; ?>" style="width:50px;" onchange="co_sch(1,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill2; ?>" style="width:50px;" onchange="co_sch(2,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill3; ?>" style="width:50px;" onchange="co_sch(3,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill4; ?>" style="width:50px;" onchange="co_sch(4,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<?php } else{ ?>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill1; ?>" style="width:50px;" onchange="co_sch(1,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill2; ?>" style="width:50px;" onchange="co_sch(2,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill3; ?>" style="width:50px;" onchange="co_sch(3,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45' maxlength='1' value="<?php echo $co_data->skill4; ?>" style="width:50px;" onchange="co_sch(4,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<?php } ?>
					</tr>	
					<?php
				}
			}
			?>
			</table>
		    <?php
	}
	
	public function save_upd_disc_skill_wise(){
		$adm_no   = $this->input->post('adm_no');
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$skill_id = $this->input->post('skill_id');
		$grade    = strtoupper($this->input->post('grade'));
		$trm      = $this->input->post('trm');
		
		$co_sch_data = $this->alam->select('discipline_grades','count(*)cnt',"Adm_no='$adm_no'AND Class='$classs' AND Sec='$sec' AND Term='$trm' AND SkillCode='$skill_id'");
		$cnt = $co_sch_data[0]->cnt;
		if($cnt == 1){
			$upd_data = array(
			'Grade' => $grade
			);
			
			$this->alam->update('discipline_grades',$upd_data,"Adm_no='$adm_no'AND Class='$classs' AND Sec='$sec' AND Term='$trm' AND SkillCode='$skill_id'");
		}else{
			$ins_data = array(
			'Adm_no' => $adm_no,
			'Class' => $classs,
			'Sec' => $sec,
			'Term' => $trm,
			'SkillCode' => $skill_id,
			'Grade' => $grade,
			);
			
			$this->alam->insert('discipline_grades',$ins_data);
		}
	}
}