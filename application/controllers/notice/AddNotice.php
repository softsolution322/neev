<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addnotice extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){

		if(!in_array('viewNotice', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$class              = login_details['Class_No'];
		$sec                = login_details['Section_No'];
		$data['clasa_no']   = login_details['Class_No'];
		$data['sec_no']     = login_details['Section_No'];
		$data['login_id']   = login_details['user_id'];
		$data['date']       = date('Y-m-d');
		$data['stuData']    = $this->alam->selectA('student','STUDENTID,ADM_NO,FIRST_NM',"CLASS='$class' AND SEC='$sec'");
		$data['noticeData'] = $this->alam->selectA('notice','*,(select CLASS_NM from classes where Class_no=notice.class)disp_class,(select SECTION_NAME from sections where Section_No=notice.sec)disp_sec',"CLASS='$class' AND SEC='$sec' AND sent_status = 'S'");
		$this->render_template('notice/add_notice',$data);
	}
	
	public function saveNotice(){
		$lastData           = $this->alam->orderByDesc();
		$last_id            = isset($lastData[0]['id']) ? $lastData[0]['id'] : 0;
		
		$sent               = $this->input->post('sent');
		$class              = $this->input->post('class');
		$sec                = $this->input->post('sec');
		$date               = $this->input->post('date');
		$category           = $this->input->post('category');
		$notice             = $this->input->post('notice');
		$selectAll          = $this->input->post('selectAll');
		$selectParticultStu = $this->input->post('selectParticultStu[]');
		
		if($selectAll == 1){
				$stuData  = $this->alam->selectA('student','STUDENTID,ADM_NO,FIRST_NM,C_MOBILE,P_MOBILE',"CLASS='$class' AND SEC='$sec'");
		}else{
				$selectParticultStu = implode("','",$selectParticultStu);
			    $stuData  = $this->alam->selectA('student','STUDENTID,ADM_NO,FIRST_NM,C_MOBILE,P_MOBILE',"STUDENTID in ('$selectParticultStu')");	
		}
		
		if(!empty($_FILES['img']['name'])){
		$image              = $_FILES['img']['name']; 
		$expimage           = explode('.',$image);
		$count              = count($expimage);
		$image_ext          = $expimage[$count-1];
		$image_name         = $last_id .'.'.$image_ext;
		$imagepath          = "uploads/notice_img/".$image_name;
		
		move_uploaded_file($_FILES["img"]["tmp_name"],$imagepath);
		}else{
			$imagepath  = '';
		}
		
		$saveDataNotice = array(
			'emp_id'		  => login_details['user_id'],
			'date'            => $date,
			'class'           => $class,
			'sec'             => $sec,
			'notice_category' => $category,
			'notice'          => $notice,
			'img'             => $imagepath,
			'is_allstu'       => $selectAll,
			'sent_type'       => $sent
		);
		
		$this->alam->insert('notice',$saveDataNotice);
		$insertLastId = $this->db->insert_id();
		
		    $mobile  = array();
		    $pmobile = array();
			foreach($stuData as $key => $val){
					$mobile[]  = $val['C_MOBILE'];
					$pmobile[] = $val['P_MOBILE'];
					$saveAllStu = array(
						'notice_tbl_id' => $insertLastId,
						'admno' => $val['ADM_NO']
					);
					$this->alam->insert('notice_adm_wise',$saveAllStu);
					$msg = $notice;
			}
		if($sent == 'sms'){
			$msg = $notice;
			$mobile = implode(',',$mobile);
			$pmobile = implode(',',$pmobile);
			$this->sms_lib->sendSMS($mobile,$msg);
			$this->sms_lib->sendSMS($pmobile,$msg);
		}
        			
		$this->session->set_flashdata('msg','Notice Send Successfully');
		redirect('notice/AddNotice');
	}
	
	public function noticeEdit(){
		$id = $this->input->post('id');
		$noticeData = $this->alam->selectA('notice','notice_category,notice,img,is_allstu,class,sec',"id='$id'");
		
		$notice_category = $noticeData[0]['notice_category'];
		$notice          = $noticeData[0]['notice'];
		$img             = $noticeData[0]['img'];
		$is_allstu       = $noticeData[0]['is_allstu'];
		$class           = $noticeData[0]['class'];
		$sec             = $noticeData[0]['sec'];
		?>
		<form method='post' action='<?php echo base_url('notice/AddNotice/updateNotice'); ?>' enctype='multipart/form-data'>
		<table class='table'>
		<input type='hidden' name='id' value='<?php echo $id; ?>'>
		<input type='hidden' name='imgg' value='<?php echo $img; ?>'>
			<tr>
				<th>Category</th>
				<td>
					<select class='form-control' name='category' required>
						<option value=''>Select</option>
						<option value='School Notice' <?php if('School Notice' == $notice_category){ echo 'selected'; } ?>>School Notice</option>
						<option value='Complaint Notice' <?php if('Complaint Notice' == $notice_category){ echo 'selected'; } ?>>Complaint Notice</option>
						<option value='Fee Defaulter' <?php if('Fee Defaulter' == $notice_category){ echo 'selected'; } ?>>Fee Defaulter</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Notice</th>
				<td>
					<textarea class='form-control' name='notice' required rows='5'><?php echo $notice; ?></textarea>
				</td>
			</tr>
			<tr>
				<th>Attachment</th>
				<td>
				  <input type='file' name='img' class='form-control'>
				</td>
			</tr>
			
			<tr>
				<td colspan='2'><center><button class='btn btn-warning btn-sm'>Update <i class="fa fa-paper-plane" style='color:#fff'></i></button></center></td>
			</tr>
		</table>
		</form>
		<?php
	}
	
	public function updateNotice(){
		
		$category           = $this->input->post('category');
		$notice             = $this->input->post('notice');
		$imgg               = $this->input->post('imgg');
		$id                 = $this->input->post('id');
		
		
		if(!empty($_FILES['img']['name'])){
		$image              = $_FILES['img']['name']; 
		$expimage           = explode('.',$image);
		$count              = count($expimage);
		$image_ext          = $expimage[$count-1];
		$image_name         = $id .'.'.$image_ext;
		$imagepath          = "uploads/notice_img/".$image_name;
		
		move_uploaded_file($_FILES["img"]["tmp_name"],$imagepath);
		}else{
			$imagepath  = $imgg;
		}
		
		$updateDataNotice = array(
			'notice_category' => $category,
			'notice'          => $notice,
			'img'             => $imagepath,
		);
		
		$this->alam->update('notice',$updateDataNotice,"id='$id'");
		
		$this->session->set_flashdata('msg','Notice Updated Successfully');
		redirect('notice/AddNotice');
	}
}
