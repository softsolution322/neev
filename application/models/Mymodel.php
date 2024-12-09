<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_model{

	public function select($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result();
	}
	public function del($table,$where=''){
		$this->db->where($where);
		$this->db->delete($table);
		$query = $this->db->get();
		return true;
	}
	public function select_order_by($table,$data,$column,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		$this->db->order_by($column, "asc");
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result();
	}
	public function empty_table($table){
		$this->db->empty_table($table);
		return true;
	}
	public function checkData($data,$tablename,$where)
	{
		$query = $this->db->select($data)
						->where($where)
						-> get($tablename);
			if($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
	}
	public function createMultiple($tablename,$data)
	{
		$query = $this->db->insert_batch($tablename, $data);
		return true;
	}
	public function selectSingleData($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function selectmultiDataArray($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function select_distinct($table,$data,$where=''){
		$this->db->distinct();
		$this->db->select($data);
		$this->db->from($table);
		$this->db->order_by($data, "asc");
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function max_no($table,$field){
		$this->db->select_max($field);
		$this->db->from($table);
		$query = $this->db->get();
		return $query->result();
	}

	public function insert($data,$table){
		$this->db->insert($data,$table);
		return true;
	}

	public function update($table,$data,$where=''){
		$this->db->where($where);
		$this->db->update($table,$data);
		return true;
	}
	public function icard($adm_no){
		$query = $this->db->query("SELECT ADM_NO,BIRTH_DT,FIRST_NM,FATHER_NM,MOTHER_NM,(SELECT STOPPAGE FROM stoppage WHERE stoppage.STOPNO=st.STOPNO)STOPPAGE_AMT,student_image,DISP_CLASS,DISP_SEC,ROLL_NO,C_MOBILE,CORR_ADD FROM `student` st WHERE ADM_NO='$adm_no'");
		return $query->row();
	}
	public function class_wise_ledger($class,$sec,$order){
		$query = $this->db->query("SELECT ADM_NO,FIRST_NM,ROLL_NO,EMP_WARD, (select HOUSENAME from eward where HOUSENO=student.EMP_WARD)housenm,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.APR_FEE)APR_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.APR_FEE)APR_FEE_DATE,(SELECT TOTAL FROM daycoll WHERE RECT_NO=student.APR_FEE)APR_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAY_FEE)MAY_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.MAY_FEE)MAY_FEE_DATE,(SELECT TOTAL FROM daycoll WHERE RECT_NO=student.MAY_FEE)MAY_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JUNE_FEE)JUNE_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.JUNE_FEE)JUNE_FEE_DATE,(SELECT TOTAL FROM daycoll WHERE RECT_NO=student.JUNE_FEE)JUNE_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JULY_FEE)JULY_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.JULY_FEE)JULY_FEE_DATE,(SELECT TOTAL FROM daycoll WHERE RECT_NO=student.JULY_FEE)JULY_FEE_AMT, (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.AUG_FEE)AUG_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.AUG_FEE)AUG_FEE_DATE,(SELECT TOTAL FROM daycoll WHERE RECT_NO=student.AUG_FEE)AUG_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.SEP_FEE)SEP_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.SEP_FEE)SEP_FEE_DATE,(SELECT TOTAL FROM daycoll WHERE RECT_NO=student.SEP_FEE)SEP_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.OCT_FEE)OCT_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.OCT_FEE)OCT_FEE_DATE,(SELECT TOTAL FROM daycoll WHERE RECT_NO=student.OCT_FEE)OCT_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.NOV_FEE)NOV_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.NOV_FEE)NOV_FEE_DATE,(SELECT TOTAL FROM daycoll WHERE RECT_NO=student.NOV_FEE)NOV_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.DEC_FEE)DEC_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.DEC_FEE)DEC_FEE_DATE,(SELECT TOTAL FROM daycoll WHERE RECT_NO=student.DEC_FEE)DEC_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JAN_FEE)JAN_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.JAN_FEE)JAN_FEE_DATE,(SELECT TOTAL FROM daycoll WHERE RECT_NO=student.JAN_FEE)JAN_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.FEB_FEE)FEB_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.FEB_FEE)FEB_FEE_DATE,(SELECT TOTAL FROM daycoll WHERE RECT_NO=student.FEB_FEE)FEB_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAR_FEE)MAR_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.MAR_FEE)MAR_FEE_DATE,(SELECT TOTAL FROM daycoll WHERE RECT_NO=student.MAR_FEE)MAR_FEE_AMT FROM `student` WHERE `CLASS` = '$class' AND `SEC` = '$sec' AND Student_Status='ACTIVE' ORDER BY $order");
		return $query->result();
	}
	public function bus_wise_ledger($class,$sec,$order,$fee){
		$query = $this->db->query("SELECT ADM_NO,FIRST_NM,ROLL_NO,EMP_WARD, (select HOUSENAME from eward where HOUSENO=student.EMP_WARD)housenm,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.APR_FEE)APR_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.APR_FEE)APR_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.APR_FEE)APR_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAY_FEE)MAY_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.MAY_FEE)MAY_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.MAY_FEE)MAY_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JUNE_FEE)JUNE_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.JUNE_FEE)JUNE_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.JUNE_FEE)JUNE_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JULY_FEE)JULY_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.JULY_FEE)JULY_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.JULY_FEE)JULY_FEE_AMT, (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.AUG_FEE)AUG_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.AUG_FEE)AUG_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.AUG_FEE)AUG_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.SEP_FEE)SEP_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.SEP_FEE)SEP_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.SEP_FEE)SEP_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.OCT_FEE)OCT_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.OCT_FEE)OCT_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.OCT_FEE)OCT_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.NOV_FEE)NOV_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.NOV_FEE)NOV_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.NOV_FEE)NOV_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.DEC_FEE)DEC_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.DEC_FEE)DEC_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.DEC_FEE)DEC_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JAN_FEE)JAN_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.JAN_FEE)JAN_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.JAN_FEE)JAN_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.FEB_FEE)FEB_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.FEB_FEE)FEB_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.FEB_FEE)FEB_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAR_FEE)MAR_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.MAR_FEE)MAR_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.MAR_FEE)MAR_FEE_AMT FROM `student` WHERE `CLASS` = '$class' AND `SEC` = '$sec' AND Student_Status='ACTIVE' ORDER BY $order");
		return $query->result();
	}
	public function category_data($class,$sec){
		$query = $this->db->query("SELECT DISTINCT DISP_CLASS,DISP_SEC,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY = 1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')CAT1,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')CAT2,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=3 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')CAT3,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=4 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')CAT4,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=1 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')BOY_CAT1,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=1 AND student.SEX=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')GIRL_CAT1,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=2 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')BOY_CAT2,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=2 AND student.SEX=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')GIRL_CAT2,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=3 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')BOY_CAT3,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=3 AND student.SEX=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')GIRLS_CAT3,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=4 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')BOY_CAT4,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=4 AND student.SEX=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')GIRL_CAT4,(SELECT COUNT(CATEGORY) FROM student WHERE student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_BOYS,(SELECT COUNT(CATEGORY) FROM student WHERE student.SEX=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_GIRLS,(SELECT COUNT(CATEGORY) FROM student WHERE student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL FROM `student` st WHERE DISP_CLASS='$class' AND DISP_SEC='$sec' AND Student_Status='ACTIVE'");
		return $query->result();
	}
	public function category_data_all(){
		$query = $this->db->query("SELECT DISTINCT DISP_CLASS,DISP_SEC,(SELECT COUNT(*) FROM student WHERE student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.SEX='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')MALE,(SELECT COUNT(*) FROM student WHERE student.SEX=2 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')FEMALE,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT1,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT2,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='3' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT3,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='4' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT4,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='5' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT5 FROM `student` st WHERE Student_Status='ACTIVE' ORDER by CLASS");
		return $query->row();
	}
	public function religion_data($class,$sec){
		$query = $this->db->query("SELECT DISTINCT DISP_CLASS,DISP_SEC,(SELECT COUNT(religion) FROM student WHERE student.religion=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_HINDU,(SELECT COUNT(religion) FROM student WHERE student.religion=1 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_HINDI,(SELECT COUNT(religion) FROM student WHERE student.religion=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MUSLIM,(SELECT COUNT(religion) FROM student WHERE student.religion=2 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_MUSLIM,(SELECT COUNT(religion) FROM student WHERE student.religion=3 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_CHRISTIAN,(SELECT COUNT(religion) FROM student WHERE student.religion=3 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_CHRISTIAN,(SELECT COUNT(religion) FROM student WHERE student.religion=4 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_SIKH,(SELECT COUNT(religion) FROM student WHERE student.religion=4 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_SIKH,(SELECT COUNT(religion) FROM student WHERE student.religion=5 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_BUDDHIST,(SELECT COUNT(religion) FROM student WHERE student.religion=5 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_BUDDHIST,(SELECT COUNT(religion) FROM student WHERE student.religion=6 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_JAIN,(SELECT COUNT(religion) FROM student WHERE student.religion=6 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_JAIN,(SELECT COUNT(religion) FROM student WHERE student.religion=7 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_OTHER,(SELECT COUNT(religion) FROM student WHERE student.religion=7 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_OTHER,(SELECT COUNT(religion) FROM student WHERE student.religion=8 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_OTHER2,(SELECT COUNT(religion) FROM student WHERE student.religion=8 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_OTHER2 FROM `student` st WHERE DISP_CLASS='$class' AND DISP_SEC='$sec' AND Student_Status='ACTIVE'");
		return $query->result();
	}
	public function religion_data_all($class){
		$query = $this->db->query("SELECT DISTINCT DISP_CLASS,(SELECT COUNT(religion) FROM student WHERE student.religion=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_HINDU,(SELECT COUNT(religion) FROM student WHERE student.religion=1 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_HINDI,(SELECT COUNT(religion) FROM student WHERE student.religion=2 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MUSLIM,(SELECT COUNT(religion) FROM student WHERE student.religion=2 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_MUSLIM,(SELECT COUNT(religion) FROM student WHERE student.religion=3 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_CHRISTIAN,(SELECT COUNT(religion) FROM student WHERE student.religion=3 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_CHRISTIAN,(SELECT COUNT(religion) FROM student WHERE student.religion=4 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_SIKH,(SELECT COUNT(religion) FROM student WHERE student.religion=4 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_SIKH,(SELECT COUNT(religion) FROM student WHERE student.religion=5 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_BUDDHIST,(SELECT COUNT(religion) FROM student WHERE student.religion=5 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_BUDDHIST,(SELECT COUNT(religion) FROM student WHERE student.religion=6 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_JAIN,(SELECT COUNT(religion) FROM student WHERE student.religion=6 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_JAIN,(SELECT COUNT(religion) FROM student WHERE student.religion=7 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_OTHER,(SELECT COUNT(religion) FROM student WHERE student.religion=7 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_OTHER,(SELECT COUNT(religion) FROM student WHERE student.religion=8 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_OTHER2,(SELECT COUNT(religion) FROM student WHERE student.religion=8 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_OTHER2 FROM `student` st WHERE CLASS='$class' AND Student_Status='ACTIVE' ORDER by CLASS");
		return $query->row();
	}
	public function ward_data($class,$sec){
		$query = $this->db->query("SELECT DISTINCT DISP_CLASS,DISP_SEC,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_WARD1,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=1 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_WARD1,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_WARD2,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=2 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_WARD2,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=3 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_WARD3,(SELECT COUNT(religion) FROM student WHERE student.EMP_WARD=3 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_WARD3,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=4 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_WARD4,(SELECT COUNT(religion) FROM student WHERE student.EMP_WARD=4 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_WARD4,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=5 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_WARD5,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=5 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_WARD5,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=6 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_WARD6,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=6 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_WARD6 FROM student st WHERE DISP_CLASS='$class' AND DISP_SEC='$sec' AND Student_Status='ACTIVE'");
		return $query->result();
	}
	public function all_strength(){
		$query = $this->db->query("SELECT class,sec, DISP_CLASS,DISP_SEC,(SELECT COUNT(*) FROM student WHERE student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.SEX='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)MALE,(SELECT COUNT(*) FROM student WHERE student.SEX='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)FEMALE,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)WARD1,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)WARD2,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='3' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)WARD3,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='4' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)WARD4,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='5' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)WARD5,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='6' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)WARD6,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)CAT1,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)CAT2,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='3' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)CAT3,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='4' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)CAT4,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='5' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)CAT5,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='6' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)CAT6 FROM student st WHERE Student_Status='ACTIVE' group by  class,sec, DISP_CLASS,DISP_SEC");
		return $query->result();
	}
	public function classwise_strength(){
		$query = $this->db->query("SELECT CLASS,DISP_CLASS,(SELECT COUNT(*) FROM student WHERE student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.SEX='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')MALE,(SELECT COUNT(*) FROM student WHERE student.SEX='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')FEMALE,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')WARD1,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')WARD2,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='3' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')WARD3,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='4' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')WARD4,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='5' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')WARD5,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='6' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')WARD6,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT1,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT2,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='3' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT3,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='4' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT4,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='5' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT5,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='6' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT6 FROM student st WHERE Student_Status='ACTIVE' GROUP BY CLASS,DISP_CLASS");
		return $query->result();
	}
	public function bus($id){
		$query = $this->db->query("select distinct bmstr.BusNo from STOPPAGE as stpg join busnomaster as bmstr on stpg.BUS_NO=bmstr.BusCode where stpg.BUS_NO='$id'");
		return $query->result();

	}
	public function period_wise_data($adm_no,$start_date,$end_date){
		$query = $this->db->query("SELECT DISTINCT att_date,admno,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=1 AND att_date=adf.att_date)P1,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=2 AND att_date=adf.att_date)P2,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=3 AND att_date=adf.att_date)P3,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=4 AND att_date=adf.att_date)P4,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=5 AND att_date=adf.att_date)P5,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=6 AND att_date=adf.att_date)P6,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=6 AND att_date=adf.att_date)P6,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=7 AND att_date=adf.att_date)P7,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=8 AND att_date=adf.att_date)P8 FROM `stu_attendance_entry_periodwise` adf WHERE admno='$adm_no' AND att_date BETWEEN '$start_date' AND '$end_date' ORDER by att_date desc");
		return $query->result();
	}
	public function show_student($id){
		$query = $this->db->query("SELECT student.student_transport_facility_id,student.route_id,student.ADM_CLASS AS ADM_CLASS,student.STUDENTID AS ID,student.HOSTEL AS HOSTEL_STATUS,student.COMPUTER AS COUMPUTER_STATUS,student.FREESHIP AS FREESHIP_STATUS,student.LETTERNO AS FREESHIP_MONTH,student.math_lab AS HANDICAP,student.ADM_NO AS ADMISSION_NO,student.ADM_DATE AS ADMISSION_DATE,student.FIRST_NM AS STUDENT_NAME,classes.CLASS_NM AS CLASS_NAME,sections.SECTION_NAME AS SECTION_NAME,student.ADM_SEC AS ADM_SEC,student.DISP_CLASS AS CURRENT_CLASS,student.DISP_SEC AS CURRENT_SECTION,student.ROLL_NO AS ROLL_NO,student.SEX AS GENDER,student.BIRTH_DT AS DATE_OF_BIRTH,category.CAT_ABBR CATEGORY,house.HOUSENAME AS HOUSE_NAME,eward.HOUSENAME AS EMPLOYEE_WARD,stoppage.STOPPAGE AS BUSSTOPAGE,student.BLOOD_GRP AS BLOOD_GROUP,student.Fee_Book_No AS ACCOUNT_NUMBER,student.Bus_Book_No AS AADHAR_NUMBER,student.student_image AS STUDENT_IMAGE,religion.Rname AS RELIGION,student.BUS_NO AS SCIENCE_FEE,student.FATHER_NM AS FATHERNAME,student.MOTHER_NM AS MOTHERNAME,student.PERM_ADD AS PERADD,student.P_CITY AS PERCITY,student.P_STATE AS PERSTATE,student.p_NATION AS PERNATION,student.P_PIN AS PERPIN,student.P_PHONE1 AS PERPHONE1,student.P_PHONE2 AS PERPHONE2,student.P_FAXNO AS PERFAX,student.P_MOBILE AS PERMOBILE,student.p_EMAIL AS PEREMAIL,student.CORR_ADD AS CROSSADD,student.C_CITY AS CROSSCITY,student.C_STATE AS CROSSSTATE,student.C_NATION AS CROSSNATION,student.C_PIN AS CROSSPIN,student.LAST_SCH AS LAST_SCHOOL,student.LSCH_ADD AS LSCH_ADD,student.C_MOBILE AS CROSSMOBILE,student.C_PHONE1 AS CROSSPHONE1,student.C_PHONE2 AS CROSSPHONE2,student.C_FAXNO AS CROSSFAX,student.C_EMAIL AS CROSSEMAIL,student.SUBJECT1 AS SUBJECT1,student.SUBJECT2 AS SUBJECT2,student.SUBJECT3 AS SUBJECT3,student.SUBJECT4 AS SUBJECT4,student.SUBJECT5 AS SUBJECT5,student.SUBJECT6 AS SUBJECT6,student.CBSE_REG AS CBSEREGISTRATION,student.CBSE_ROLL AS CBSEROLL,student.APR_FEE AS APRILFEE,student.MAY_FEE AS MAYFEE,student.JUNE_FEE AS JUNEFEE,student.JULY_FEE AS JULYFEE,student.AUG_FEE AS AUGUSTFEE,student.SEP_FEE AS SEPTEMBERFEE,student.OCT_FEE AS OCTOBERFEE,student.NOV_FEE AS NOVEMBERFEE,student.DEC_FEE AS DECEMBERFEE,student.JAN_FEE AS JANUARYFEE,student.FEB_FEE AS FEBRUARYFEE,student.MAR_FEE AS MARCHFEE,student.oldadmno AS HANDICAP_NATURE,student.CLASS AS CURRENT_CLASS_CODE,student.SEC AS CURRENT_SEC_CODE,student.CATEGORY AS CATEGORY_CODE,student.HOUSE_CODE AS HOUSE_CODE,student.EMP_WARD AS EMP_CODE,student.STOPNO AS STOPPAGE_CODE,student.religion AS RELIGION_CODE FROM (((((((student LEFT JOIN classes ON student.ADM_CLASS=classes.Class_No)LEFT JOIN sections ON student.ADM_SEC=sections.section_no)LEFT JOIN category ON student.CATEGORY=category.CAT_CODE)LEFT JOIN house ON student.HOUSE_CODE=house.HOUSENO)LEFT JOIN eward ON student.EMP_WARD=eward.HOUSENO)LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN religion ON student.religion=religion.RNo) WHERE student.STUDENTID='$id'");
		return $query->result();

	}

	public function student_information($class,$sec,$short_by){
		$query = $this->db->query("SELECT student.ADM_CLASS AS ADM_CLASS,student.STUDENTID AS ID,student.HOSTEL AS HOSTEL_STATUS,student.COMPUTER AS COUMPUTER_STATUS,student.FREESHIP AS FREESHIP_STATUS,student.LETTERNO AS FREESHIP_MONTH,student.math_lab AS HANDICAP,student.ADM_NO AS ADMISSION_NO,student.ADM_DATE AS ADMISSION_DATE,student.FIRST_NM AS STUDENT_NAME,classes.CLASS_NM AS CLASS_NAME,sections.SECTION_NAME AS SECTION_NAME,student.ADM_SEC AS ADM_SEC,student.DISP_CLASS AS CURRENT_CLASS,student.DISP_SEC AS CURRENT_SECTION,student.ROLL_NO AS ROLL_NO,student.SEX AS GENDER,student.BIRTH_DT AS DATE_OF_BIRTH,category.CAT_ABBR CATEGORY,house.HOUSENAME AS HOUSE_NAME,eward.HOUSENAME AS EMPLOYEE_WARD,stoppage.STOPPAGE AS BUSSTOPAGE,student.BLOOD_GRP AS BLOOD_GROUP,student.Fee_Book_No AS ACCOUNT_NUMBER,student.Bus_Book_No AS AADHAR_NUMBER,student.student_image AS STUDENT_IMAGE,religion.Rname AS RELIGION,student.BUS_NO AS SCIENCE_FEE,student.FATHER_NM AS FATHERNAME,student.MOTHER_NM AS MOTHERNAME,student.PERM_ADD AS PERADD,student.P_CITY AS PERCITY,student.P_STATE AS PERSTATE,student.p_NATION AS PERNATION,student.P_PIN AS PERPIN,student.P_PHONE1 AS PERPHONE1,student.P_PHONE2 AS PERPHONE2,student.P_FAXNO AS PERFAX,student.P_MOBILE AS PERMOBILE,student.p_EMAIL AS PEREMAIL,student.CORR_ADD AS CROSSADD,student.C_CITY AS CROSSCITY,student.C_STATE AS CROSSSTATE,student.C_NATION AS CROSSNATION,student.C_PIN AS CROSSPIN,student.LAST_SCH AS LAST_SCHOOL,student.LSCH_ADD AS LSCH_ADD,student.C_MOBILE AS CROSSMOBILE,student.C_PHONE1 AS CROSSPHONE1,student.C_PHONE2 AS CROSSPHONE2,student.C_FAXNO AS CROSSFAX,student.C_EMAIL AS CROSSEMAIL,student.SUBJECT1 AS SUBJECT1,student.SUBJECT2 AS SUBJECT2,student.SUBJECT3 AS SUBJECT3,student.SUBJECT4 AS SUBJECT4,student.SUBJECT5 AS SUBJECT5,student.SUBJECT6 AS SUBJECT6,student.CBSE_REG AS CBSEREGISTRATION,student.CBSE_ROLL AS CBSEROLL,student.APR_FEE AS APRILFEE,student.MAY_FEE AS MAYFEE,student.JUNE_FEE AS JUNEFEE,student.JULY_FEE AS JULYFEE,student.AUG_FEE AS AUGUSTFEE,student.SEP_FEE AS SEPTEMBERFEE,student.OCT_FEE AS OCTOBERFEE,student.NOV_FEE AS NOVEMBERFEE,student.DEC_FEE AS DECEMBERFEE,student.JAN_FEE AS JANUARYFEE,student.FEB_FEE AS FEBRUARYFEE,student.MAR_FEE AS MARCHFEE,student.oldadmno AS HANDICAP_NATURE,student.CLASS AS CURRENT_CLASS_CODE,student.SEC AS CURRENT_SEC_CODE,student.CATEGORY AS CATEGORY_CODE,student.HOUSE_CODE AS HOUSE_CODE,student.EMP_WARD AS EMP_CODE,student.STOPNO AS STOPPAGE_CODE,student.religion AS RELIGION_CODE FROM (((((((student LEFT JOIN classes ON student.ADM_CLASS=classes.Class_No)LEFT JOIN sections ON student.ADM_SEC=sections.section_no)LEFT JOIN category ON student.CATEGORY=category.CAT_CODE)LEFT JOIN house ON student.HOUSE_CODE=house.HOUSENO)LEFT JOIN eward ON student.EMP_WARD=eward.HOUSENO)LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN religion ON student.religion=religion.RNo) WHERE student.class='$class' AND student.SEC='$sec' AND Student_Status='ACTIVE' ORDER BY $short_by");
		return $query->result();

	}

	public function student_informationall($short_by){
		$query = $this->db->query("SELECT student.ADM_CLASS AS ADM_CLASS,student.STUDENTID AS ID,student.HOSTEL AS HOSTEL_STATUS,student.COMPUTER AS COUMPUTER_STATUS,student.FREESHIP AS FREESHIP_STATUS,student.LETTERNO AS FREESHIP_MONTH,student.math_lab AS HANDICAP,student.ADM_NO AS ADMISSION_NO,student.ADM_DATE AS ADMISSION_DATE,student.FIRST_NM AS STUDENT_NAME,classes.CLASS_NM AS CLASS_NAME,sections.SECTION_NAME AS SECTION_NAME,student.ADM_SEC AS ADM_SEC,student.DISP_CLASS AS CURRENT_CLASS,student.DISP_SEC AS CURRENT_SECTION,student.ROLL_NO AS ROLL_NO,student.SEX AS GENDER,student.BIRTH_DT AS DATE_OF_BIRTH,category.CAT_ABBR CATEGORY,house.HOUSENAME AS HOUSE_NAME,eward.HOUSENAME AS EMPLOYEE_WARD,stoppage.STOPPAGE AS BUSSTOPAGE,student.BLOOD_GRP AS BLOOD_GROUP,student.Fee_Book_No AS ACCOUNT_NUMBER,student.Bus_Book_No AS AADHAR_NUMBER,student.student_image AS STUDENT_IMAGE,religion.Rname AS RELIGION,student.BUS_NO AS SCIENCE_FEE,student.FATHER_NM AS FATHERNAME,student.MOTHER_NM AS MOTHERNAME,student.PERM_ADD AS PERADD,student.P_CITY AS PERCITY,student.P_STATE AS PERSTATE,student.p_NATION AS PERNATION,student.P_PIN AS PERPIN,student.P_PHONE1 AS PERPHONE1,student.P_PHONE2 AS PERPHONE2,student.P_FAXNO AS PERFAX,student.P_MOBILE AS PERMOBILE,student.p_EMAIL AS PEREMAIL,student.CORR_ADD AS CROSSADD,student.C_CITY AS CROSSCITY,student.C_STATE AS CROSSSTATE,student.C_NATION AS CROSSNATION,student.C_PIN AS CROSSPIN,student.LAST_SCH AS LAST_SCHOOL,student.LSCH_ADD AS LSCH_ADD,student.C_MOBILE AS CROSSMOBILE,student.C_PHONE1 AS CROSSPHONE1,student.C_PHONE2 AS CROSSPHONE2,student.C_FAXNO AS CROSSFAX,student.C_EMAIL AS CROSSEMAIL,student.SUBJECT1 AS SUBJECT1,student.SUBJECT2 AS SUBJECT2,student.SUBJECT3 AS SUBJECT3,student.SUBJECT4 AS SUBJECT4,student.SUBJECT5 AS SUBJECT5,student.SUBJECT6 AS SUBJECT6,student.CBSE_REG AS CBSEREGISTRATION,student.CBSE_ROLL AS CBSEROLL,student.APR_FEE AS APRILFEE,student.MAY_FEE AS MAYFEE,student.JUNE_FEE AS JUNEFEE,student.JULY_FEE AS JULYFEE,student.AUG_FEE AS AUGUSTFEE,student.SEP_FEE AS SEPTEMBERFEE,student.OCT_FEE AS OCTOBERFEE,student.NOV_FEE AS NOVEMBERFEE,student.DEC_FEE AS DECEMBERFEE,student.JAN_FEE AS JANUARYFEE,student.FEB_FEE AS FEBRUARYFEE,student.MAR_FEE AS MARCHFEE,student.oldadmno AS HANDICAP_NATURE,student.CLASS AS CURRENT_CLASS_CODE,student.SEC AS CURRENT_SEC_CODE,student.CATEGORY AS CATEGORY_CODE,student.HOUSE_CODE AS HOUSE_CODE,student.EMP_WARD AS EMP_CODE,student.STOPNO AS STOPPAGE_CODE,student.religion AS RELIGION_CODE FROM (((((((student LEFT JOIN classes ON student.ADM_CLASS=classes.Class_No)LEFT JOIN sections ON student.ADM_SEC=sections.section_no)LEFT JOIN category ON student.CATEGORY=category.CAT_CODE)LEFT JOIN house ON student.HOUSE_CODE=house.HOUSENO)LEFT JOIN eward ON student.EMP_WARD=eward.HOUSENO)LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN religion ON student.religion=religion.RNo) WHERE  Student_Status='ACTIVE' ORDER BY $short_by");
		return $query->result();

	}

	public function tc_issue($id){
		$query = $this->db->query("SELECT student.ADM_DATE,student.SUBJECT1,student.SUBJECT2,student.SUBJECT3,student.SUBJECT4,student.SUBJECT5,student.SUBJECT6,student.FIRST_NM,student.MOTHER_NM,student.FATHER_NM,student.FIRST_NM,student.DISP_CLASS,student.NATION,student.BIRTH_DT,classes.CLASS_NM AS ADM_CLASSS,student.CBSE_REG,student.CBSE_ROLL,student.ADM_NO,category.CAT_ABBR,student.CORR_ADD FROM ((student LEFT JOIN category ON category.CAT_CODE=student.CATEGORY) LEFT JOIN classes ON student.ADM_CLASS=classes.Class_No) WHERE student.ADM_NO='$id'");
		return $query->row();
	}
	
	public function tc_issue_back($id,$back_database){
		$query = $this->db->query("SELECT student.FIRST_NM,student.MOTHER_NM,student.FATHER_NM,student.DISP_CLASS,student.SUBJECT1,student.SUBJECT2,student.SUBJECT3,student.SUBJECT4,student.SUBJECT5,student.SUBJECT6,student.ADM_DATE,student.FIRST_NM,student.NATION,student.BIRTH_DT,classes.CLASS_NM AS ADM_CLASSS,student.CBSE_REG,student.CBSE_ROLL,student.ADM_NO,category.CAT_ABBR FROM (($back_database.student LEFT JOIN $back_database.category ON category.CAT_CODE=student.CATEGORY) LEFT JOIN $back_database.classes ON student.ADM_CLASS=classes.Class_No) WHERE student.ADM_NO='$id'");
		return $query->row();
	}
	
	public function subjwiseallco($class){
		$query = $this->db->query("SELECT cswsa.subj_nm,cswsa.opt_code,cswsa.Class_No,cswsa.subject_code,cswsa.sorting_no FROM `class_section_wise_subject_allocation` as cswsa left join marks on Class_No=marks.Classes AND cswsa.subject_code=marks.SCode where cswsa.Class_No = '$class' AND cswsa.applicable_exam = '1' group by cswsa.subj_nm,cswsa.opt_code,cswsa.Class_No,cswsa.subject_code,cswsa.sorting_no order by cswsa.sorting_no");
		return $query->result();
	}

	public function subjcnt($subjname,$classs){
		$query = $this->db->query("SELECT DISTINCT subj_nm,opt_code FROM `class_section_wise_subject_allocation` where Class_No = '$classs' AND subj_nm = '$subjname' AND applicable_exam = '1'");
		return $query->result();
	}
	
	public function stu_list_subj_allocation($classs,$sec){
		$query = $this->db->query("SELECT stu.ADM_no,stu.FIRST_NM,stu.ROLL_NO,(select SUBCODE from studentsubject where Adm_no=stu.adm_no)subcodee,(SELECT SubName FROM subjects WHERE SubCode = (select SUBCODE from studentsubject where Adm_no=stu.adm_no))subnm FROM `student` as stu  WHERE stu.`CLASS` = '$classs' AND stu.`SEC` = '$sec' AND stu.`Student_Status` = 'ACTIVE' ORDER by ROLL_NO");
		return $query->result();
	}

	public function feeclw($id)
	{
		$query = $this->db->query("SELECT fee_clw.FH,fee_clw.CL,classes.CLASS_NM,fee_clw.AMOUNT,fee_clw.EMP,fee_clw.CCL,fee_clw.SPL,fee_clw.EXT,fee_clw.INTERNAL FROM ( fee_clw LEFT JOIN classes ON fee_clw.CL=classes.Class_No )WHERE fee_clw.FH='$id' ORDER BY fee_clw.CL");
		return $query->result();
	}
	
	public function max_mrks_allco_trem($classes,$trm,$board){
		$query = $this->db->query("SELECT ExamCode,(select ExamName from exammaster where ExamCode=maxmarks.ExamCode)exmnm,teacher_code,(select SubName from subjects where SubCode=maxmarks.teacher_code)subnm,teacher_code,MaxMarks FROM `maxmarks` where ClassCode = '$classes' AND Term = '$trm' AND ExamMode = '$board' ORDER BY ExamCode");
		return $query->result();
	}
	
	public function max_mrks_allco_exam($classcode,$term,$exammode,$examcode){
		$query = $this->db->query("SELECT ExamCode,(select ExamName from exammaster where ExamCode=maxmarks.ExamCode)exmnm,teacher_code,(select SubName from subjects where SubCode=maxmarks.teacher_code)subnm,teacher_code,MaxMarks FROM `maxmarks` where ClassCode = '$classcode' AND Term = '$term' AND ExamMode = '$exammode' AND ExamCode = '$examcode' ORDER BY teacher_code");
		return $query->result();
	}
	
	
	public function max_mrks_allco_exam_prep($classcode,$term,$examcode){
		$query = $this->db->query("SELECT examcode,(select examname from exammasterprep where examcode=maxmarks_all.examcode)exmnm,subject,(select SubName from subjects where SubCode=maxmarks_all.subject)subnm,subject,subj_skill_mstr_id,(select skill_name from subject_skill_master where id=maxmarks_all.subj_skill_mstr_id)skillnm,maxmarks FROM `maxmarks_all` where class_code = '$classcode' AND term = '$term' AND examcode = '$examcode' ORDER BY subject");
		return $query->result();
	}
	
	public function half_year_subject($ExamCode,$Class_No,$ExamMode){
		$query = $this->db->query("Select distinct(subj_nm),opt_code,subject_code from class_section_wise_subject_allocation where `class_no`='$Class_No' AND `Subject_Code` in(Select teacher_code FROM `maxmarks` WHERE ClassCode = '$Class_No' AND ExamMode = '$ExamMode' AND term = 'TERM-1' AND ExamCode = '$ExamCode')");
		return $query->result();
	}
	
	public function half_year_subject2($ExamCode,$Class_No,$ExamMode){
		$query = $this->db->query("Select distinct(subj_nm),opt_code,subject_code from class_section_wise_subject_allocation where `class_no`='$Class_No' AND `Subject_Code` in(Select teacher_code FROM `maxmarks` WHERE ClassCode = '$Class_No' AND ExamMode = '$ExamMode' AND term = 'TERM-2' AND ExamCode = '$ExamCode')");
		return $query->result();
	}
	
	public function half_year_stu_tbl_list($Class_No,$sec,$sortval,$exm_code,$subcode){
		$query = $this->db->query("SELECT st.`ADM_NO`,st.`FIRST_NM`,st.`ROLL_NO`,(SELECT M2 from marks where admno=st.ADM_NO AND Classes=st.CLASS and Sec=st.SEC and ExamC='$exm_code' and SCode='$subcode' and term='TERM-1')mrks2 FROM `student` as st where st.`CLASS`='$Class_No' AND st.`SEC`='$sec' AND st.`Student_Status`='ACTIVE' order by st.$sortval");
		return $query->result();
	}
	
	public function half_year_stu_tbl_list2($Class_No,$sec,$sortval,$exm_code,$subcode){
		$query = $this->db->query("SELECT st.`ADM_NO`,st.`FIRST_NM`,st.`ROLL_NO`,(SELECT M2 from marks where admno=st.ADM_NO AND Classes=st.CLASS and Sec=st.SEC and ExamC='$exm_code' and SCode='$subcode' and term='TERM-2')mrks2 FROM `student` as st where st.`CLASS`='$Class_No' AND st.`SEC`='$sec' AND st.`Student_Status`='ACTIVE' order by st.$sortval");
		return $query->result();
	}
	
	public function half_year_stusub_tbl_list($Class_No,$sec,$sortval,$exm_code,$subcode){
		$query = $this->db->query("SELECT st.ADM_NO,st.FIRST_NM,st.ROLL_NO,(SELECT M2 from marks where admno=st.ADM_NO AND Classes=st.CLASS and Sec=st.SEC and ExamC='$exm_code' and SCode='$subcode' and term='TERM-1')mrks2 FROM `student` as st join studentsubject as ss on st.ADM_NO=ss.Adm_no where st.`CLASS`='$Class_No' AND st.`SEC`='$sec' AND st.`Student_Status`='ACTIVE' order by st.$sortval");
		return $query->result();
	}
	
	public function half_year_stusub_tbl_list2($Class_No,$sec,$sortval,$exm_code,$subcode){
		$query = $this->db->query("SELECT st.ADM_NO,st.FIRST_NM,st.ROLL_NO,(SELECT M2 from marks where admno=st.ADM_NO AND Classes=st.CLASS and Sec=st.SEC and ExamC='$exm_code' and SCode='$subcode' and term='TERM-2')mrks2 FROM `student` as st join studentsubject as ss on st.ADM_NO=ss.Adm_no where st.`CLASS`='$Class_No' AND st.`SEC`='$sec' AND st.`Student_Status`='ACTIVE' order by st.$sortval");
		return $query->result();
	}
	
	
	public function misc_collection($admno)
	{
		$query = $this->db->query("SELECT student.ADM_DATE,student.ROLL_NO,student.DISP_CLASS,student.DISP_SEC,stoppage.STOPPAGE,stop_amt.AMT,student.FIRST_NM,student.FATHER_NM,student.STUDENTID,eward.HOUSENAME FROM(((student LEFT JOIN eward on student.EMP_WARD=eward.HOUSENO) LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN stop_amt ON student.STOPNO=stop_amt.STOP_NO)WHERE student.ADM_NO='$admno'");
		return $query->result();
	}

	public function monthly_collection($admno)
	{
		$query = $this->db->query("SELECT student.ADM_DATE,student.ADM_NO,student.FIRST_NM,student.STUDENTID,student.FATHER_NM,student.MOTHER_NM,student.DISP_CLASS,student.DISP_SEC,student.ROLL_NO,eward.HOUSENAME,stoppage.STOPPAGE,stop_amt.AMT,student.APR_FEE,student.MAY_FEE,student.JUNE_FEE,student.JULY_FEE,student.AUG_FEE,student.SEP_FEE,student.OCT_FEE,student.NOV_FEE,student.DEC_FEE,student.JAN_FEE,student.FEB_FEE,student.MAR_FEE FROM(((student LEFT JOIN eward ON student.EMP_WARD=eward.HOUSENO) LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN stop_amt ON student.STOPNO=stop_amt.STOP_NO) WHERE student.ADM_NO='$admno'");
		return $query->result();
	}
	public function bus_master_show(){
		$query = $this->db->query("SELECT stoppage.STOPNO,stoppage.STOPPAGE,stop_amt.AMT,stop_amt.APR_FEE,stop_amt.MAY_FEE,stop_amt.JUN_FEE,stop_amt.JUL_FEE,stop_amt.AUG_FEE,stop_amt.SEP_FEE,stop_amt.OCT_FEE,stop_amt.NOV_FEE,stop_amt.DEC_FEE,stop_amt.JAN_FEE,stop_amt.FEB_FEE,stop_amt.MAR_FEE FROM (stoppage LEFT JOIN stop_amt ON stoppage.STOPNO=stop_amt.STOP_NO) ORDER BY stoppage.STOPNO");
		return $query->result();
	}
	public function edit_busmaster($id){
		$query = $this->db->query("SELECT stoppage.STOPNO,stoppage.STOPPAGE,stop_amt.AMT,stop_amt.APR_FEE,stop_amt.MAY_FEE,stop_amt.JUN_FEE,stop_amt.JUL_FEE,stop_amt.AUG_FEE,stop_amt.SEP_FEE,stop_amt.OCT_FEE,stop_amt.NOV_FEE,stop_amt.DEC_FEE,stop_amt.JAN_FEE,stop_amt.FEB_FEE,stop_amt.MAR_FEE FROM (stoppage LEFT JOIN stop_amt ON stoppage.STOPNO=stop_amt.STOP_NO) WHERE stoppage.STOPNO='$id'");
		return $query->result();
	}
	public function del_pre_fee_generation($mon,$adm){
		$query = $this->db->query("DELETE FROM previous_year_feegeneration WHERE Month_NM='$mon' AND ADM_NO='$adm'");
		return true;
	}
	public function del_pre_fee_generation_online($adm){
		$query = $this->db->query("DELETE FROM previous_year_feegeneration WHERE ADM_NO='$adm'");
		return true;
	}
	public function dist_data($table,$column){
		$query = $this->db->query("SELECT DISTINCT($column) FROM `$table` ORDER BY $column");
		return $query->result();
	}
	public function driver_master_details(){
		$query = $this->db->query("SELECT driver_master.Driver_ID,driver_master.BusCode,busnomaster.BusNo,driver_master.driver_name,driver_master.driver_address,driver_master.driver_dob,driver_master.driver_ph_no,driver_master.driver_license_no,driver_master.trip_id,bus_trip_master.Trip_Nm,driver_master.khallasi_nm,driver_master.khallasi_ph_no,bus_incharge_master.Incharge_nm,bus_incharge_master.Incharge_ph_no,driver_master.incharge_id FROM(((driver_master LEFT JOIN busnomaster ON driver_master.BusCode=busnomaster.BusCode) LEFT JOIN bus_incharge_master ON bus_incharge_master.Incharge_Id=driver_master.incharge_id) LEFT JOIN bus_trip_master ON bus_trip_master.Trip_ID=driver_master.trip_id)");
		return $query->result();
	}
	public function edit_driver($id)
	{
		$query = $this->db->query("SELECT driver_master.Driver_ID,driver_master.driver_empid,driver_master.khallasi_empid,driver_master.BusCode,busnomaster.BusNo,driver_master.driver_name,driver_master.driver_address,driver_master.driver_dob,driver_master.driver_ph_no,driver_master.driver_license_no,driver_master.trip_id,bus_trip_master.Trip_Nm,driver_master.khallasi_nm,driver_master.khallasi_ph_no,bus_incharge_master.Incharge_nm,bus_incharge_master.Incharge_ph_no,driver_master.incharge_id FROM(((driver_master LEFT JOIN busnomaster ON driver_master.BusCode=busnomaster.BusCode) LEFT JOIN bus_incharge_master ON bus_incharge_master.Incharge_Id=driver_master.incharge_id) LEFT JOIN bus_trip_master ON bus_trip_master.Trip_ID=driver_master.trip_id) WHERE driver_master.Driver_ID='$id'");
		return $query->row();
	}
	public function senior_rectno(){
		$query = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(RECT_NO),3) AS UNSIGNED)+1) MAX_NUMBER FROM daycoll WHERE RECT_NO RLIKE 'ST'");
		return $query->result();
	}
	public function recpt_numeric_Details_ONLIE($counter){
		$query = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(RECT_NO),3) AS UNSIGNED)+1) MAX_NUMBER FROM daycoll WHERE RECT_NO RLIKE '$counter'");
		return $query->result();
	}
	public function recpt_numeric_Details($counter){
		$query = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(RECT_NO),2) AS UNSIGNED)+1) MAX_NUMBER FROM daycoll WHERE RECT_NO RLIKE '$counter'");
		return $query->result();
	}
	public function getbusstoppagedetails($buscode,$tripid,$preferid){
		$query = $this->db->query("SELECT bus_route_master.Route_Id,stoppage.STOPPAGE,bus_trip_master.Trip_Nm,bus_route_master.Prefer_ID FROM ((bus_route_master LEFT JOIN stoppage ON bus_route_master.STOPNO=stoppage.STOPNO) LEFT JOIN bus_trip_master ON bus_route_master.Trip_ID=bus_trip_master.Trip_ID) WHERE bus_route_master.BusCode LIKE '$buscode' AND bus_route_master.Trip_ID LIKE '$tripid' AND bus_route_master.Prefer_ID LIKE '$preferid'");
		return $query->result();
	}
	public function getbusmasterdetails($id){
		$query = $this->db->query("SELECT bus_route_master.Route_Id,bus_route_master.BusCode,bus_route_master.Trip_ID,bus_route_master.Prefer_ID,bus_route_master.STOPNO,busnomaster.BusNo FROM bus_route_master LEFT JOIN busnomaster ON busnomaster.BusCode=bus_route_master.BusCode WHERE bus_route_master.Route_Id='$id'");
		return $query->result();
	}
	public function gettripdetails($id){
		$query = $this->db->query("SELECT bus_trip_master.Trip_ID,bus_trip_master.Trip_Nm FROM bus_route_master LEFT JOIN bus_trip_master ON bus_route_master.Trip_ID=bus_trip_master.Trip_ID WHERE STOPNO='$id'");
		return $query->result();
	}
	public function getvehicle($trip,$stopno){
		$query = $this->db->query("SELECT busnomaster.BusCode,busnomaster.BusNo FROM bus_route_master LEFT JOIN busnomaster ON bus_route_master.BusCode=busnomaster.BusCode WHERE bus_route_master.STOPNO='$stopno' AND bus_route_master.Trip_ID='$trip'");
		return $query->result();
	}
	public function getbusamountmonthwise($month,$adm,$monthno){
		//$query = $this->db->query("SELECT (SELECT $month FROM stop_amt WHERE STOP_NO=sbd.NEW_STOPNO) AS BUSAMOUNT FROM student_transport_facility AS sbd WHERE sbd.ADM_NO='$adm' AND sbd.FROM_APPLICABLE_MONTH_CODE<='$monthno' AND sbd.TO_APPLICABLE_MONTH_CODE>='$monthno' ORDER BY sbd.ID");
		$query = $this->db->query("SELECT (SELECT $month FROM stop_amt WHERE STOP_NO=sbd.NEW_STOPNO) AS BUSAMOUNT FROM student_transport_facility AS sbd WHERE sbd.ADM_NO='$adm' AND sbd.FROM_APPLICABLE_MONTH_CODE<='$monthno' AND sbd.TO_APPLICABLE_MONTH_CODE>='$monthno' ORDER BY sbd.ID");
		return $query->result();
	}
	public function getbusamountmonthwise_new($stopnos){
		//$query = $this->db->query("SELECT (SELECT $month FROM stop_amt WHERE STOP_NO=sbd.NEW_STOPNO) AS BUSAMOUNT FROM student_transport_facility AS sbd WHERE sbd.ADM_NO='$adm' AND sbd.FROM_APPLICABLE_MONTH_CODE<='$monthno' AND sbd.TO_APPLICABLE_MONTH_CODE>='$monthno' ORDER BY sbd.ID");
		$query = $this->db->query("SELECT amt FROM stop_amt WHERE STOP_NO=$stopnos");
		return $query->result();
	}
	public function GetTrip($id){
		$query = $this->db->query("SELECT bus_trip_master.Trip_ID,bus_trip_master.Trip_Nm FROM bus_route_master LEFT JOIN bus_trip_master ON bus_route_master.Trip_ID=bus_trip_master.Trip_ID WHERE bus_route_master.BusCode='$id' GROUP BY bus_trip_master.Trip_ID,bus_trip_master.Trip_Nm");
		return $query->result();
	}
	public function GetStoppage($buscode,$trip,$preferid){
		$query = $this->db->query("SELECT stoppage.STOPPAGE,stoppage.STOPNO FROM `bus_route_master` LEFT JOIN stoppage ON bus_route_master.STOPNO=stoppage.STOPNO WHERE bus_route_master.BusCode='$buscode' AND bus_route_master.Trip_ID='$trip' AND bus_route_master.Prefer_ID='$preferid'");
		return $query->result();
	}
	public function update_merge_data($data){
		$query = $this->db->query("UPDATE excel_data inner join daycoll on excel_data.ADM_NO=daycoll.ADM_NO set excel_data.narr='1' where excel_data.period LIKE '%$data%' AND DAYCOLL.PERIOD LIKE '%$data%' AND MID(DAYCOLL.PERIOD,1,3)<>'PRE' AND MID(DAYCOLL.PERIOD,1,4)<>'MISL'");
		return true;
	}
	public function CopyData(){
		$query = $this->db->query("INSERT INTO daycoll SELECT * FROM excel_data WHERE Narr='N/A'");
		return true;
	}
	public function Driver_data_trip_wise($id,$code){
		$query = $this->db->query("SELECT driver_master.driver_name,driver_master.driver_address,busnomaster.BusNo,bus_trip_master.Trip_Nm,driver_master.driver_dob,driver_master.driver_ph_no,driver_master.driver_license_no,driver_master.khallasi_nm,driver_master.khallasi_ph_no FROM ((`driver_master` LEFT JOIN bus_trip_master ON driver_master.trip_id=bus_trip_master.Trip_ID) LEFT JOIN busnomaster ON driver_master.BusCode=busnomaster.BusCode) WHERE driver_master.trip_id LIKE '$id' AND driver_master.BusCode LIKE '$code'");
		return $query->result();
	}
	public function Driver_data_busnowise_wise($id){
		$query = $this->db->query("SELECT driver_master.driver_name,driver_master.driver_address,busnomaster.BusNo,bus_trip_master.Trip_Nm,driver_master.driver_dob,driver_master.driver_ph_no,driver_master.driver_license_no,driver_master.khallasi_nm,driver_master.khallasi_ph_no FROM ((`driver_master` LEFT JOIN bus_trip_master ON driver_master.trip_id=bus_trip_master.Trip_ID) LEFT JOIN busnomaster ON driver_master.BusCode=busnomaster.BusCode) WHERE driver_master.BusCode LIKE '$id'");
		return $query->result();
	}
	public function GetBusMaster(){
		$query = $this->db->query("SELECT busnomaster.BusCode,busnomaster.BusNo FROM bus_route_master LEFT JOIN busnomaster ON busnomaster.BusCode=bus_route_master.BusCode GROUP BY busnomaster.BusCode");
		return $query->result();
	}
	public function GetStoppageMaster(){
		$query = $this->db->query("SELECT busnomaster.BusCode,busnomaster.BusNo FROM bus_route_master INNER JOIN busnomaster ON bus_route_master.BusCode=busnomaster.BusCode GROUP BY busnomaster.BusCode");
		return $query->result();
	}
	public function GetTrip_BusRouteReport($id){
		$query = $this->db->query("SELECT bus_trip_master.Trip_ID,bus_trip_master.Trip_Nm FROM bus_route_master LEFT JOIN bus_trip_master ON bus_trip_master.Trip_ID=bus_route_master.Trip_ID WHERE bus_route_master.BusCode='$id' GROUP BY bus_route_master.Trip_ID");
		return $query->result();
	}
	public function StoppageRouteMaster($buscode,$trip,$prefrence){
		$query = $this->db->query("SELECT stoppage.STOPPAGE,busnomaster.BusNo,bus_trip_master.Trip_Nm,bus_route_master.Prefer_ID FROM (((bus_route_master LEFT JOIN stoppage ON bus_route_master.STOPNO=stoppage.STOPNO) LEFT JOIN busnomaster ON bus_route_master.BusCode=busnomaster.BusCode) LEFT JOIN bus_trip_master ON bus_trip_master.Trip_ID=bus_route_master.Trip_ID) WHERE bus_route_master.BusCode LIKE '$buscode' AND bus_route_master.Trip_ID LIKE '$trip' AND bus_route_master.Prefer_ID LIKE '$prefrence'  ORDER BY bus_route_master.STOPNO");
		return $query->result();
	}
	public function GetStoppagedata($buscode,$trip,$prefrence){
		$query = $this->db->query("SELECT stoppage.STOPPAGE,stoppage.STOPNO FROM stoppage LEFT JOIN bus_route_master ON bus_route_master.STOPNO=stoppage.STOPNO WHERE bus_route_master.BusCode='$buscode' AND bus_route_master.Trip_ID='$trip' AND bus_route_master.Prefer_ID='$prefrence'");
		return $query->result();
	}
	public function Getstudentdetails($stoppage){
		$query = $this->db->query("SELECT student.ADM_NO,student.FIRST_NM,student.DISP_CLASS,student.DISP_SEC,stoppage.STOPPAGE FROM ((student LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO)LEFT JOIN bus_route_master ON student.STOPNO=bus_route_master.STOPNO) WHERE student.Student_Status='ACTIVE' AND bus_route_master.STOPNO LIKE '$stoppage'");
		return $query->result();
	}
	public function Student_ledgerdata($adm){
		$query = $this->db->query("SELECT month_master.id,feegeneration.Month_NM,feegeneration.STU_NAME,feegeneration.STUDENTID,feegeneration.ADM_NO,feegeneration.CLASS,feegeneration.SEC,feegeneration.ROLL_NO,feegeneration.TOTAL,feegeneration.Fee1,feegeneration.Fee2,feegeneration.Fee3,feegeneration.Fee4,feegeneration.Fee5,feegeneration.Fee6,feegeneration.Fee7,feegeneration.Fee8,feegeneration.Fee9,feegeneration.Fee10,feegeneration.Fee11,feegeneration.Fee12,feegeneration.Fee13,feegeneration.Fee14,feegeneration.Fee15,feegeneration.Fee16,feegeneration.Fee17,feegeneration.Fee18,feegeneration.Fee19,feegeneration.Fee20,feegeneration.Fee21,feegeneration.Fee22,feegeneration.Fee23,feegeneration.Fee24,feegeneration.Fee25 FROM feegeneration LEFT JOIN month_master ON feegeneration.Month_NM=month_master.month_name WHERE feegeneration.ADM_NO='$adm' ORDER BY month_master.id");
		return $query->result();
	}
	public function Previous_year_duesmonth($adm){
		$query = $this->db->query("SELECT month_master.id,previous_year_feegeneration.Month_NM,previous_year_feegeneration.STU_NAME,previous_year_feegeneration.STUDENTID,previous_year_feegeneration.ADM_NO,previous_year_feegeneration.CLASS,previous_year_feegeneration.SEC,previous_year_feegeneration.ROLL_NO,previous_year_feegeneration.TOTAL,previous_year_feegeneration.Fee1,previous_year_feegeneration.Fee2,previous_year_feegeneration.Fee3,previous_year_feegeneration.Fee4,previous_year_feegeneration.Fee5,previous_year_feegeneration.Fee6,previous_year_feegeneration.Fee7,previous_year_feegeneration.Fee8,previous_year_feegeneration.Fee9,previous_year_feegeneration.Fee10,previous_year_feegeneration.Fee11,previous_year_feegeneration.Fee12,previous_year_feegeneration.Fee13,previous_year_feegeneration.Fee14,previous_year_feegeneration.Fee15,previous_year_feegeneration.Fee16,previous_year_feegeneration.Fee17,previous_year_feegeneration.Fee18,previous_year_feegeneration.Fee19,previous_year_feegeneration.Fee20,previous_year_feegeneration.Fee21,previous_year_feegeneration.Fee22,previous_year_feegeneration.Fee23,previous_year_feegeneration.Fee24,previous_year_feegeneration.Fee25 FROM previous_year_feegeneration LEFT JOIN month_master ON previous_year_feegeneration.Month_NM=month_master.month_name WHERE previous_year_feegeneration.ADM_NO='$adm' ORDER BY month_master.id");
		return $query->result();
	}
}