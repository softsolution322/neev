<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marks_entry extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	
	public function index(){
		$this->teacher_template('marks_entry/marks_entry');
	}
	
	public function half_year(){
		$class_data = $this->dbcon->select('classes','*');
		$array = array('class_data'=>$class_data);
		
		$this->teacher_template('marks_entry/half_yearly',$array);
	}
	
	public function classess(){
		$ret = '';
		$Class_No = '';
		$ExamMode = '';
		$class_nm = $this->input->post('val');
		
		$class_data = $this->dbcon->select('classes','Class_No,ExamMode',"CLASS_NM='$class_nm'");
		
		$Class_No = $class_data[0]->Class_No;
		$ExamMode = $class_data[0]->ExamMode;
		
		$sec_data = $this->dbcon->select('student','distinct(DISP_SEC)',"DISP_CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				 $ret .="<option value=". $data->DISP_SEC .">" . $data->DISP_SEC ."</option>";
			}
		}
		
		$array = array($ret,$Class_No,$ExamMode);
		echo json_encode($array);
	}
	
	public function section(){
		$val      = $this->input->post('val');
		$Class_No = $this->input->post('Class_No');
		
		$exm_typ_data = $this->dbcon->select('maxmarks','distinct(ExamCode),(select ExamName from exammaster where ExamCode=maxmarks.ExamCode)examnm',"ClassCode='$Class_No' AND Term = 'TERM-1'");
		?>
		  <option value=''>Select</option>
		<?php
		if(isset($exm_typ_data)){
			foreach($exm_typ_data as $data){
				?>
				  <option value="<?php echo $data->ExamCode; ?>"><?php echo $data->examnm; ?></option>
				<?php
			}
		}
	}
	
	public function subject(){
		$ret     = '';
		$subcode = '';
		
		$ExamCode = $this->input->post('ExamCode');
		$Class_No  = $this->input->post('Class_No');
		$ExamMode  = $this->input->post('ExamMode');
		
		$sub_data = $this->dbcon->half_year_subject($ExamCode,$Class_No,$ExamMode);
		$subcode .= $sub_data[0]->subject_code;
        $ret .="<option value=''>Select</option>";
		if(isset($sub_data)){
			foreach($sub_data as $data){
				  $ret .="<option value=" .$data->opt_code . " data-id=" .$data->subject_code . ">" .$data->subj_nm ."</option>";
			}
		}
		
		$array = array($ret,$subcode);
		echo json_encode($array);
	}
	
	public function stu_list(){
		$ret = '';
		$MaxMarks = '';
		$opt_code = $this->input->post('opt_code');
		$Class_No = $this->input->post('Class_No');
		$sec      = $this->input->post('sec');
		$sortval  = $this->input->post('sortval');
		$exm_code = $this->input->post('exm_code');
		$ExamMode = $this->input->post('ExamMode');
		$subcode  = $this->input->post('subcode');
		
		$mx_mrk   = $this->dbcon->select('maxmarks','MaxMarks',"ExamCode='$exm_code' AND Term='TERM-1' AND teacher_code='$subcode' AND ClassCode='$Class_No' AND ExamMode='$ExamMode'"); 
		
		$MaxMarks .= "Max Marks ".$mx_mrk[0]->MaxMarks;
		
		if($sortval == 'adm_no'){
			$sorting = 'ADM_NO';
		}elseif($sortval == 'stu_name'){
			$sorting = 'FIRST_NM';
		}else{
			$sorting = 'ROLL_NO';
		}
	    
		if($opt_code != 2){
			$stu_tbl_data = $this->dbcon->half_year_stu_tbl_list($Class_No,$sec,$sorting,$exm_code,$subcode);
			
			$ret .= "<table class='table'>
			    <th style='background:#5785c3; color:#fff!important;'>Admission No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Name</th>
			    <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>marks</th>";
		
			if(isset($stu_tbl_data)){
				$i = 1;
				foreach($stu_tbl_data as $data){
					  $ret .= "<tr>";
					  $ret .= "<td>" . $data->ADM_NO ."</td>";
					  $ret .= "<td style='display:none'><input type='text' id='adm_" .$i. "' value=" . $data->ADM_NO ."></td>";
					  $ret .= "<td>" . $data->FIRST_NM ."</td>";
					  $ret .= "<td>" . $data->ROLL_NO ."</td>";
					  $ret .= "<td style='display:none'><input type='text' id='tmarks_" .$i. "' value=" . $data->mrks2 ."></td>";
					  $ret .= "<td><input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46 || event.charCode == 45 || event.charCode == 97 || event.charCode == 98' onchange='marks(this)' maxlength='5' id='marks_" .$i. "' value=" . $data->mrks2 ."></td>";
					  $ret .="</tr>";
					  $i++;
				}
			}
			  $ret .="</table>";
			  
			  $array = array($ret,$MaxMarks);
			  echo json_encode($array);
			
		}else{
			$stu_tbl_data = $this->dbcon->half_year_stusub_tbl_list($Class_No,$sec,$sorting,$exm_code,$subcode);
			$ret .= "<table class='table'>
			    <th style='background:#5785c3; color:#fff!important;'>Admission No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Name</th>
			    <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>marks</th>";
		
			if(isset($stu_tbl_data)){
				$i = 1;
				foreach($stu_tbl_data as $data){
					  $ret .= "<tr>";
					  $ret .= "<td>" . $data->ADM_NO ."</td>";
					  $ret .= "<td style='display:none'><input type='text' id='adm_" .$i. "' value=" . $data->ADM_NO ."></td>";
					  $ret .= "<td>" . $data->FIRST_NM ."</td>";
					  $ret .= "<td>" . $data->ROLL_NO ."</td>";
					  $ret .= "<td style='display:none'><input type='text' id='tmarks_" .$i. "' value=" . $data->mrks2 ."></td>";
					  $ret .= "<td><input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46 || event.charCode == 45 || event.charCode == 97 || event.charCode == 98' onchange='marks(this)' maxlength='5' id='marks_" .$i. "' value=" . $data->mrks2 ."></td>";
					  $ret .="</tr>";
					  $i++;
				}
			}
			  $ret .="</table>";
			  
			  $array = array($ret,$MaxMarks);
			  echo json_encode($array);
		}
	}
	
	public function sv_nd_upd(){
		$adm_no   = $this->input->post('adm_no');
		$exm_typ  = $this->input->post('exm_typ');
		$subcode  = $this->input->post('subcode');
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$entr_val = strtoupper($this->input->post('entr_val'));
		$mxm      = $this->input->post('mxm');
		
		$chk_data = $this->dbcon->select('marks','count(*)cnt',"admno='$adm_no' AND ExamC='$exm_typ' AND SCode='$subcode' AND Term='TERM-1'");
		$cnt = $chk_data[0]->cnt;
		if($cnt != 0){
			$upd_data = array(
			 'M1' => $mxm,
			 'M2' => $entr_val,
			 'M3' => $entr_val
			);
		
			$this->dbcon->update('marks',$upd_data,"admno='$adm_no' AND ExamC='$exm_typ' AND SCode='$subcode' AND Term='TERM-1'");
			echo $this->db->last_query();
			//echo "Data Update Successfully";
		}else{
			echo "insert";
			$ins_data = array(
			 'admno'   => $adm_no,
			 'ExamC'   => $exm_typ,
			 'SCode'   => $subcode,
			 'M1'      => $mxm,
			 'M2'      => $entr_val,
			 'M3'      => $entr_val,
			 'Classes' => $classs,
			 'Sec'     => $sec,
			 'Term'    => 'TERM-1'
			);
			
			$this->dbcon->insert('marks',$ins_data);
			echo "Data Insert Successfully";
		}
	}
	
	
	
	
	public function second_term(){
		$class_data = $this->dbcon->select('classes','*');
		$array = array('class_data'=>$class_data);
		
		$this->teacher_template('marks_entry/second_term',$array);
	}
	
	public function classess2(){
		$ret = '';
		$Class_No = '';
		$ExamMode = '';
		$class_nm = $this->input->post('val');
		
		$class_data = $this->dbcon->select('classes','Class_No,ExamMode',"CLASS_NM='$class_nm'");
		
		$Class_No = $class_data[0]->Class_No;
		$ExamMode = $class_data[0]->ExamMode;
		
		$sec_data = $this->dbcon->select('student','distinct(DISP_SEC)',"DISP_CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				 $ret .="<option value=". $data->DISP_SEC .">" . $data->DISP_SEC ."</option>";
			}
		}
		
		$array = array($ret,$Class_No,$ExamMode);
		echo json_encode($array);
	}
	
	public function section2(){
		$val      = $this->input->post('val');
		$Class_No = $this->input->post('Class_No');
		
		$exm_typ_data = $this->dbcon->select('maxmarks','distinct(ExamCode),(select ExamName from exammaster where ExamCode=maxmarks.ExamCode)examnm',"ClassCode='$Class_No' AND Term = 'TERM-2'");
		?>
		  <option value=''>Select</option>
		<?php
		if(isset($exm_typ_data)){
			foreach($exm_typ_data as $data){
				?>
				  <option value="<?php echo $data->ExamCode; ?>"><?php echo $data->examnm; ?></option>
				<?php
			}
		}
	}
	
	public function subject2(){
		$ret     = '';
		$subcode = '';
		
		$ExamCode = $this->input->post('ExamCode');
		$Class_No  = $this->input->post('Class_No');
		$ExamMode  = $this->input->post('ExamMode');
		
		$sub_data = $this->dbcon->half_year_subject2($ExamCode,$Class_No,$ExamMode);
		$subcode .= $sub_data[0]->subject_code;
        $ret .="<option value=''>Select</option>";
		if(isset($sub_data)){
			foreach($sub_data as $data){
				  $ret .="<option value=" .$data->opt_code . ">" .$data->subj_nm ."</option>";
			}
		}
		
		$array = array($ret,$subcode);
		echo json_encode($array);
	}
	
	public function stu_list2(){
		$ret = '';
		$MaxMarks = '';
		$opt_code = $this->input->post('opt_code');
		$Class_No = $this->input->post('Class_No');
		$sec      = $this->input->post('sec');
		$sortval  = $this->input->post('sortval');
		$exm_code = $this->input->post('exm_code');
		$ExamMode = $this->input->post('ExamMode');
		$subcode  = $this->input->post('subcode');
		
		$mx_mrk   = $this->dbcon->select('maxmarks','MaxMarks',"ExamCode='$exm_code' AND Term='TERM-2' AND teacher_code='$subcode' AND ClassCode='$Class_No' AND ExamMode='$ExamMode'"); 
		
		$MaxMarks .= "Max Marks ".$mx_mrk[0]->MaxMarks;
		
		if($sortval == 'adm_no'){
			$sorting = 'ADM_NO';
		}elseif($sortval == 'stu_name'){
			$sorting = 'FIRST_NM';
		}else{
			$sorting = 'ROLL_NO';
		}
	    
		if($opt_code != 2){
			$stu_tbl_data = $this->dbcon->half_year_stu_tbl_list2($Class_No,$sec,$sorting,$exm_code,$subcode);
			
			$ret .= "<table class='table'>
			    <th style='background:#5785c3; color:#fff!important;'>Admission No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Name</th>
			    <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>marks</th>";
		
			if(isset($stu_tbl_data)){
				$i = 1;
				foreach($stu_tbl_data as $data){
					  $ret .= "<tr>";
					  $ret .= "<td>" . $data->ADM_NO ."</td>";
					  $ret .= "<td style='display:none'><input type='text' id='adm_" .$i. "' value=" . $data->ADM_NO ."></td>";
					  $ret .= "<td>" . $data->FIRST_NM ."</td>";
					  $ret .= "<td>" . $data->ROLL_NO ."</td>";
					  $ret .= "<td style='display:none'><input type='text' id='tmarks_" .$i. "' value=" . $data->mrks2 ."></td>";
					  $ret .= "<td><input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46 || event.charCode == 45 || event.charCode == 97 || event.charCode == 98' onchange='marks(this)' maxlength='5' id='marks_" .$i. "' value=" . $data->mrks2 ."></td>";
					  $ret .="</tr>";
					  $i++;
				}
			}
			  $ret .="</table>";
			  
			  $array = array($ret,$MaxMarks);
			  echo json_encode($array);
			
		}else{
			$stu_tbl_data = $this->dbcon->half_year_stusub_tbl_list($Class_No,$sec,$sorting,$exm_code,$subcode);
			
			$ret .= "<table class='table'>
			    <th style='background:#5785c3; color:#fff!important;'>Admission No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Name</th>
			    <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>marks</th>";
		
			if(isset($stu_tbl_data)){
				$i = 1;
				foreach($stu_tbl_data as $data){
					  $ret .= "<tr>";
					  $ret .= "<td>" . $data->ADM_NO ."</td>";
					  $ret .= "<td style='display:none'><input type='text' id='adm_" .$i. "' value=" . $data->ADM_NO ."></td>";
					  $ret .= "<td>" . $data->FIRST_NM ."</td>";
					  $ret .= "<td>" . $data->ROLL_NO ."</td>";
					  $ret .= "<td style='display:none'><input type='text' id='tmarks_" .$i. "' value=" . $data->mrks2 ."></td>";
					  $ret .= "<td><input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46 || event.charCode == 45 || event.charCode == 97 || event.charCode == 98' onchange='marks(this)' maxlength='5' id='marks_" .$i. "' value=" . $data->mrks2 ."></td>";
					  $ret .="</tr>";
					  $i++;
				}
			}
			  $ret .="</table>";
			  
			  $array = array($ret,$MaxMarks);
			  echo json_encode($array);
		}
	}
	
	public function sv_nd_upd2(){
		$adm_no   = $this->input->post('adm_no');
		$exm_typ  = $this->input->post('exm_typ');
		$subcode  = $this->input->post('subcode');
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$entr_val = strtoupper($this->input->post('entr_val'));
		$mxm      = $this->input->post('mxm');
		
		$chk_data = $this->dbcon->select('marks','count(*)cnt',"admno='$adm_no' AND ExamC='$exm_typ' AND SCode='$subcode' AND Term='TERM-2'");
		$cnt = $chk_data[0]->cnt;
		if($cnt != 0){
			$upd_data = array(
			 'M1' => $mxm,
			 'M2' => $entr_val,
			 'M2' => $entr_val,
			);
			
			$this->dbcon->update('marks',$upd_data,"admno='$adm_no' AND ExamC='$exm_typ' AND SCode='$subcode' AND Term='TERM-2'");
			echo "Data Update Successfully";
		}else{
			$ins_data = array(
			 'admno'   => $adm_no,
			 'ExamC'   => $exm_typ,
			 'SCode'   => $subcode,
			 'M1'      => $mxm,
			 'M2'      => $entr_val,
			 'M3'      => $entr_val,
			 'Classes' => $classs,
			 'Sec'     => $sec,
			 'Term'    => 'TERM-2'
			);
			
			$this->dbcon->insert('marks',$ins_data);
			echo "Data Insert Successfully";
		}
	}
}