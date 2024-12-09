<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_model{

	public function getAttendanceData($id,$date_from = null,$date_to = null)
	{
		$query = $this->db->query("SELECT * FROM emp_attendance WHERE EMPLOYEE_ID=$id AND date(IN_TIME) >= '$date_from' and date(IN_TIME) <= '$date_to'");
		return $query->result_array();
	}

	public function getTodayPresentEmpData($today)
	{
		$query = $this->db->query("SELECT *,(SELECT COUNT(WING_MASTER_ID) FROM employee WHERE WING_MASTER_ID=wm.id)as total_emp, (SELECT COUNT(DISTINCT(employee.EMPID)) FROM employee  INNER JOIN emp_attendance ON employee.id=emp_attendance.EMPLOYEE_ID WHERE employee.WING_MASTER_ID=wm.id AND employee.SEX='1' AND date(emp_attendance.IN_TIME)='$today')as total_male_pre,(SELECT COUNT(DISTINCT(employee.EMPID)) FROM employee  INNER JOIN emp_attendance ON employee.id=emp_attendance.EMPLOYEE_ID WHERE employee.WING_MASTER_ID=wm.id AND employee.SEX='2' AND date(emp_attendance.IN_TIME)='$today' )as total_female_pre,(SELECT COUNT(DISTINCT(employee.EMPID)) FROM employee  INNER JOIN emp_attendance ON employee.id=emp_attendance.EMPLOYEE_ID WHERE employee.WING_MASTER_ID=wm.id AND employee.STAFF_TYPE='1' AND date(emp_attendance.IN_TIME)='$today' )as total_teaching_pre,(SELECT COUNT(DISTINCT(employee.EMPID)) FROM employee  INNER JOIN emp_attendance ON employee.id=emp_attendance.EMPLOYEE_ID WHERE employee.WING_MASTER_ID=wm.id AND employee.STAFF_TYPE='2' AND date(emp_attendance.IN_TIME)='$today')as total_nonteaching_pre FROM `wing_master` as wm");
		return $query->result_array();
	}

	public function getTotalStudentPresentForDash()
	{
		$query = $this->db->query("SELECT DISTINCT CLASS,(SELECT CLASS_NM FROM classes WHERE Class_No=stu.CLASS)class_name,(SELECT SECTION_NAME FROM sections WHERE section_no=stu.SEC)sec_name,SEC, (SELECT COUNT(STUDENTID) FROM student WHERE CLASS = stu.CLASS AND SEC=stu.SEC)as total_stu,(SELECT COUNT(STUDENTID) FROM student WHERE CLASS = stu.CLASS AND SEC=stu.SEC AND SEX='1')as total_male,(SELECT COUNT(STUDENTID) FROM student WHERE CLASS = stu.CLASS AND SEC=stu.SEC AND SEX='2')as total_female,(SELECT attendance_type FROM student_attendance_type WHERE class_code=stu.CLASS)as att_type FROM student stu ORDER BY CLASS");
		return $query->result_array();
	}

	public function getEmployeeDataForPayslip($month,$year)
	{
		$query = $this->db->query("SELECT emp_id,month,year,total_present,total_absent,
									(SELECT EMP_FNAME FROM employee WHERE id=mon_emp.emp_id) emp_fname,
									(SELECT EMP_MNAME FROM employee WHERE id=mon_emp.emp_id) emp_mname,
									(SELECT EMP_LNAME FROM employee WHERE id=mon_emp.emp_id) emp_lname,
									(SELECT print_position FROM DESIG WHERE Sno=(SELECT DESIG FROM employee WHERE id=mon_emp.emp_id))as print_position,
									(SELECT EMPID FROM employee WHERE id=mon_emp.emp_id) employeeid,
									IFNULL((SELECT BASIC FROM employee WHERE id=mon_emp.emp_id),0) actual_basic,
									round(IFNULL((SELECT BASIC FROM employee WHERE id=mon_emp.emp_id),0)/mon_emp.total_working_days * mon_emp.total_present) basic_sal,
									IFNULL((SELECT HRA_RENT FROM pay_control WHERE EMPLOYEE_ID=mon_emp.emp_id),0) hra_rent,
									IFNULL((SELECT HRA_ELECT FROM pay_control WHERE EMPLOYEE_ID=mon_emp.emp_id),0) hra_elect,
									IFNULL((SELECT HRA_SECURITY FROM pay_control WHERE EMPLOYEE_ID=mon_emp.emp_id),0) hra_security,
									IFNULL((SELECT HRA_GARAGE FROM pay_control WHERE EMPLOYEE_ID=mon_emp.emp_id),0) hra_garage,
									IFNULL((SELECT hra_rent + hra_elect + hra_security + hra_garage FROM pay_control WHERE EMPLOYEE_ID=mon_emp.emp_id),0) hra_deduct_amt
									FROM monthly_emp_attend_gen as mon_emp WHERE month='$month' AND year='$year' ORDER BY print_position");
		return $query->result_array();
	}

	public function getSecondShiftAttendanceData($year,$month)
	{
		$query = $this->db->query("SELECT emp.id,emp.EMPID,emp.EMP_FNAME,emp.EMP_MNAME,emp.EMP_LNAME,(SELECT DESIG FROM desig WHERE Sno=emp.						DESIG) AS DESIG, 
								IFNULL((SELECT no_of_classes FROM second_shift_attendance WHERE emp_id=emp.id AND year='$year' AND month='$month'),0) AS no_of_classes,
								IFNULL((SELECT amt_per_class FROM second_shift_attendance WHERE emp_id=emp.id AND year='$year' AND month='$month'),0) AS amt_per_class,
								IFNULL((SELECT total_amt FROM second_shift_attendance WHERE emp_id=emp.id AND year='$year' AND month='$month'),0) AS total_amt
								FROM employee emp WHERE emp.SECOND_SHIFT_ALLOW=1");
		return $query->result_array();
	}

	public function getMonthWiseAttendance($year,$month)
	{
		$query = $this->db->query("SELECT *,(SELECT EMPID FROM employee WHERE id=ma.emp_id)EMPID,(SELECT EMP_FNAME FROM employee WHERE id=ma.emp_id)EMP_FNAME,(SELECT EMP_MNAME FROM employee WHERE id=ma.emp_id)EMP_MNAME,(SELECT EMP_LNAME FROM employee WHERE id=ma.emp_id)EMP_LNAME,(SELECT C_MOBILE FROM employee WHERE id=ma.emp_id)MOBILE,(SELECT C_EMAIL FROM employee WHERE id=ma.emp_id)EMAIL,(SELECT SEX FROM employee WHERE id=ma.emp_id)SEX,(SELECT DESIG FROM desig WHERE Sno=(SELECT DESIG FROM employee WHERE id=ma.emp_id))DESIGNATION_NAME,(SELECT print_position FROM desig WHERE Sno=(SELECT DESIG FROM employee WHERE id=ma.emp_id))print_position FROM `monthly_emp_attend_gen` ma WHERE month='$month' AND year='$year' ORDER BY print_position");
		return $query->result_array();
	}

	public function totalPresentStudent()
	{
		$today = date('Y-m-d');
		$query = $this->db->query("SELECT COUNT(DISTINCT admno)total_present_period_table,(SELECT COUNT(admno) FROM stu_attendance_entry WHERE att_date='$today' AND att_status IN ('P','HD'))total_present_daily_table FROM stu_attendance_entry_periodwise WHERE att_date='$today' AND att_status='P'");
		return $query->row_array();
	}


	public function classnPeriodWiseAttendance($class_code,$sec_code)
	{
		$today = date('Y-m-d');
		$query = $this->db->query("SELECT att_date,admno,(SELECT FIRST_NM FROM student WHERE ADM_NO=sae.admno)FIRST_NM,(SELECT MIDDLE_NM FROM student WHERE ADM_NO=sae.admno)MIDDLE_NM,(SELECT SEX FROM student WHERE ADM_NO=sae.admno)SEX,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=1 AND admno=sae.admno AND date(att_date)=sae.att_date)period1,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=2 AND admno=sae.admno AND date(att_date)=sae.att_date)period2,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=3 AND admno=sae.admno AND date(att_date)=sae.att_date)period3,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=4 AND admno=sae.admno AND date(att_date)=sae.att_date)period4,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=5 AND admno=sae.admno AND date(att_date)=sae.att_date)period5,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=6 AND admno=sae.admno AND date(att_date)=sae.att_date)period6,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=7 AND admno=sae.admno AND date(att_date)=sae.att_date)period7,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE period=8 AND admno=sae.admno AND date(att_date)=sae.att_date)period8 FROM stu_attendance_entry_periodwise sae WHERE date(att_date)='$today' AND class_code='$class_code' AND sec_code='$sec_code'");
		return $query->result_array();
	}

	public function getLeaveCount()
	{
		$query = $this->db->query("SELECT count(*), (SELECT count(*) FROM emp_leave_attendance WHERE STATUS=0)total_pending,(SELECT count(*) FROM emp_leave_attendance WHERE STATUS=1)total_approved,(SELECT count(*) FROM emp_leave_attendance WHERE STATUS=2)total_disapproved FROM `emp_leave_attendance`");
		return $query->row_array();
	}

  }