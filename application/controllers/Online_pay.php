<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Online_pay extends MY_Controller{
	public function __construct(){
		parent:: __construct();
	    $this->load->model('Mymodel','dbcon');
	}
	public function pay_details(){
		$mon[0] 	   		= $this->input->post('apr');
		$mon[1]      	    = $this->input->post('may');
		$mon[2]       		= $this->input->post('jun');
		$mon[3]       		= $this->input->post('jul');
		$mon[4]      		= $this->input->post('aug');
		$mon[5]       		= $this->input->post('sep');
		$mon[6]       		= $this->input->post('oct');
		$mon[7]      	    = $this->input->post('nov');
		$mon[8]       		= $this->input->post('dec');
		$mon[9]       		= $this->input->post('jan');
		$mon[10]       		= $this->input->post('feb');
		$mon[11]       		= $this->input->post('mar');
		$ffm       			= $this->input->post('ffm');
		$rcpt_no   		= $this->input->post('rcpt_no');
		
		$rect_no = array();
		$cnt_mon = count($mon);
		
		for($i=0; $i<$cnt_mon;$i++){
		  if($mon[$i] == null){
			  $rect_no[] = 'N/A';
			}
		  else{
			 $rect_no[] =  $rcpt_no;
			}
		}
		if($mon[0]=='APR')
		{
			if($mon[0]=='APR')
			{
				$apr_recpt = $rcpt_no;
			}
			else
			{
				$apr_recpt = 'N/A';
			}
			if($mon[1]=='MAY')
			{
				$may_recpt = $rcpt_no;
			}
			else
			{
				$may_recpt = 'N/A';
			}
			if($mon[2]=='JUN')
			{
				$jun_recpt = $rcpt_no;
			}
			else
			{
				$jun_recpt = 'N/A';
			}
			if($mon[3]=='JUL')
			{
				$jul_recpt = $rcpt_no;
			}
			else
			{
				$jul_recpt = 'N/A';
			}
			if($mon[4]=='AUG')
			{
				$aug_recpt = $rcpt_no;
			}
			else
			{
				$aug_recpt = 'N/A';
			}
			if($mon[5]=='SEP')
			{
				$sep_recpt = $rcpt_no;
			}
			else
			{
				$sep_recpt = 'N/A';
			}
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			
			$data = array(
				'APR_FEE' => $apr_recpt,
				'MAY_FEE' => $may_recpt,
				'JUNE_FEE' => $jun_recpt,
				'JULY_FEE' => $jul_recpt,
				'AUG_FEE' => $aug_recpt,
				'SEP_FEE' => $sep_recpt,
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[1]=='MAY')
		{
			if($mon[1]=='MAY')
			{
				$may_recpt = $rcpt_no;
			}
			else
			{
				$may_recpt = 'N/A';
			}
			if($mon[2]=='JUN')
			{
				$jun_recpt = $rcpt_no;
			}
			else
			{
				$jun_recpt = 'N/A';
			}
			if($mon[3]=='JUL')
			{
				$jul_recpt = $rcpt_no;
			}
			else
			{
				$jul_recpt = 'N/A';
			}
			if($mon[4]=='AUG')
			{
				$aug_recpt = $rcpt_no;
			}
			else
			{
				$aug_recpt = 'N/A';
			}
			if($mon[5]=='SEP')
			{
				$sep_recpt = $rcpt_no;
			}
			else
			{
				$sep_recpt = 'N/A';
			}
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'MAY_FEE' => $may_recpt,
				'JUNE_FEE' => $jun_recpt,
				'JULY_FEE' => $jul_recpt,
				'AUG_FEE' => $aug_recpt,
				'SEP_FEE' => $sep_recpt,
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[2]=='JUN')
		{
			if($mon[2]=='JUN')
			{
				$jun_recpt = $rcpt_no;
			}
			else
			{
				$jun_recpt = 'N/A';
			}
			if($mon[3]=='JUL')
			{
				$jul_recpt = $rcpt_no;
			}
			else
			{
				$jul_recpt = 'N/A';
			}
			if($mon[4]=='AUG')
			{
				$aug_recpt = $rcpt_no;
			}
			else
			{
				$aug_recpt = 'N/A';
			}
			if($mon[5]=='SEP')
			{
				$sep_recpt = $rcpt_no;
			}
			else
			{
				$sep_recpt = 'N/A';
			}
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'JUNE_FEE' => $jun_recpt,
				'JULY_FEE' => $jul_recpt,
				'AUG_FEE' => $aug_recpt,
				'SEP_FEE' => $sep_recpt,
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[3]=='JUL')
		{
			if($mon[3]=='JUL')
			{
				$jul_recpt = $rcpt_no;
			}
			else
			{
				$jul_recpt = 'N/A';
			}
			if($mon[4]=='AUG')
			{
				$aug_recpt = $rcpt_no;
			}
			else
			{
				$aug_recpt = 'N/A';
			}
			if($mon[5]=='SEP')
			{
				$sep_recpt = $rcpt_no;
			}
			else
			{
				$sep_recpt = 'N/A';
			}
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'JULY_FEE' => $jul_recpt,
				'AUG_FEE' => $aug_recpt,
				'SEP_FEE' => $sep_recpt,
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[4]=='AUG')
		{
			if($mon[4]=='AUG')
			{
				$aug_recpt = $rcpt_no;
			}
			else
			{
				$aug_recpt = 'N/A';
			}
			if($mon[5]=='SEP')
			{
				$sep_recpt = $rcpt_no;
			}
			else
			{
				$sep_recpt = 'N/A';
			}
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'AUG_FEE' => $aug_recpt,
				'SEP_FEE' => $sep_recpt,
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[5]=='SEP')
		{
			if($mon[5]=='SEP')
			{
				$sep_recpt = $rcpt_no;
			}
			else
			{
				$sep_recpt = 'N/A';
			}
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'SEP_FEE' => $sep_recpt,
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[6]=='OCT')
		{
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[7]=='NOV')
		{
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[8]=='DEC')
		{
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
				);
		}
		ELSE IF($mon[9]=='JAN')
		{
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[10]=='FEB')
		{
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[11]=='MAR')
		{
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE
		{
			
		}
		echo "<pre>";
		print_r($rect_no);
		print_r($data);
		echo $ffm;
		echo "<br>";
		echo "<a href=".base_url('Parent_details/pay_details').">BACK</a>";
		exit;
	}
}