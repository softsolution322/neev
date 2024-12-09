<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homeworklist extends MY_controller {
	public function __construct(){
		parent:: __construct();
	}

	public function index()
	{
		$adm_no = $this->session->userdata('adm');
		$data['categoryList'] = $this->sumit->fetchAllData('*','homework_cat_master',array());
		$data['subjectList'] = $this->notice_model->getHomeworkSubjectinParent($adm_no);

		$where = "haw.admno='$adm_no'";
		if(isset($_POST['search']))
		{
			$category = $this->input->post('category');
			$subject = $this->input->post('subject');
			$status = $this->input->post('status');

			if($category != '')
			{
				$where = "haw.admno='$adm_no' AND h.homework_category='$category'";
			}

			if($subject != '')
			{
				$where = "haw.admno='$adm_no' AND h.subject='$subject'";
			}

			if($status != '')
			{
				$where = "haw.admno='$adm_no' AND haw.homework_status='$status'";
			}

			if($category != '' && $status != '')
			{
				$where = "haw.admno='$adm_no' AND h.homework_category='$category' AND haw.homework_status='$status'";
			}

			if($subject != '' && $status != '')
			{
				$where = "haw.admno='$adm_no' AND h.subject='$subject' AND haw.homework_status='$status'";
			}

			if($category != '' && $subject != '')
			{
				$where = "haw.admno='$adm_no' AND h.homework_category='$category' AND h.subject='$subject'";
			}

			if($category != '' && $subject != '' && $status != '')
			{
				$where = "haw.admno='$adm_no' AND h.homework_category='$category' AND h.subject='$subject' AND haw.homework_status='$status'";
			}

		}
		$data['homeworkList'] = $this->notice_model->getHomeworkList($where);
		$this->Parent_templete('parents_dashboard/homeworkList',$data);
	}
}