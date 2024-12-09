<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NoticeReport extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Notice_model','alam');
		$this->load->model('Alam','alamm');
	}
	
	public function index(){

		// if(!in_array('viewNotice', permission_data)){
			// redirect('payroll/dashboard/dashboard');
		// }
		$empid = login_details['user_id'];
		$data['noticeData'] = $this->alam->noticeReport($empid);
		$this->render_template('notice/noticereport',$data);
	}
	
	public function loadCat(){
		$user_id = login_details['user_id'];
		$date = date('Y-m-d',strtotime($this->input->post('date')));
		$dataBydate = $this->alamm->selectA('notice','distinct(notice_category)',"date='$date' AND emp_id = '$user_id'");
		//echo $this->db->last_query();die;
		?>
			<option value=''>Select</option>
		<?php
		if(!empty($dataBydate)){
			foreach($dataBydate as $key => $val){
				?>
					<option value='<?php echo $val['notice_category']; ?>'><?php echo $val['notice_category']; ?></option>
				<?php
			}
		}
	}
	
	public function loadSearchByData(){
		$date = date('Y-m-d',strtotime($this->input->post('date')));
		$cat  = $this->input->post('cat');
		$empid = login_details['user_id'];
		$loadData = $this->alam->noticeReportBySearch($date,$cat,$empid);
		if(!empty($loadData)){
			foreach($loadData as $key => $val){
				?>
					<tr>
						<td><?php echo $val['admno']; ?></td>
						<td><?php echo $val['firstnm']; ?></td>
						<td><?php echo date('d-M-y',strtotime($val['date'])); ?></td>
						<td><?php echo $val['notice_category']; ?></td>
						<td><?php echo $val['notice']; ?></td>
						<td>
							<?php
								if($val['img'] != ''){
							?>
									<a target='_blank' href="<?php echo base_url($val["img"]); ?>"><i class="fa fa-eye"></i></a>
							<?php } else { ?>
									No Attachement
							<?php } ?>
						</td>
					</tr>
				<?php
			}
		}
	}
}
