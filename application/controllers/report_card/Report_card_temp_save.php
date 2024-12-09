<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_card_temp_save extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function save_temp_tbl(){
		error_reporting(0);
	    $this->alam->delete('temp_report_card');
		for($i=0; $i<count($this->input->post('adm_no[]')); $i++){
			$adm_no = $this->input->post('adm_no')[$i];
			$data = array(
		      'adm_no'       => $this->input->post('adm_no')[$i],
		      'classes'      => $this->input->post('class')[$i],
		      'sec'          => $this->input->post('sec')[$i],
		      'term'          => $this->input->post('term'),
		      'first_nm'     => $this->input->post('first_nm')[$i],
		      'roll_no'      => $this->input->post('roll_no')[$i],
		      'tot_wet_mrk'  => $this->input->post('tot_wet_mrk')[$i],
		      'tot_per'      => $this->input->post('tot_per')[$i],
		      'tot_grd'      => $this->input->post('tot_grd')[$i],
		      'attendance'   => $this->input->post('attendance')[$i],
		    );
			
			for($j=0; $j<count($this->input->post('subj_nm[]')); $j++){
				$data1['subj'.($j + 1).'_nm'] = $this->input->post('subj_nm')[$j];
				$data1['subj'.($j + 1).'_mo'] = $this->input->post('tot_mo')[$adm_no][$j];
				$data1['subj'.($j + 1).'_per'] = $this->input->post('tot_mo')[$adm_no][$j];
				$data1['subj'.($j + 1).'_grd'] = $this->input->post('grd')[$adm_no][$j];
			}
			
			$finData = array_merge($data,$data1);
			// echo "<pre>";
			// print_r($finData);
			
            $this->alam->insert('temp_report_card',$finData);
		}
		$this->render_template('report_card/view_all_reports');
	}
	
	public function topper_list(){
		$data['school_photo'] = $this->alam->selectA('school_photo','*');
		$data['school_setting'] = $this->alam->selectA('school_setting','*');
		$data['topper_list'] = $this->alam->topper_list();
		$this->load->view('report_card/topper_list_pdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Topper_List.pdf", array("Attachment"=>0));
	}
}