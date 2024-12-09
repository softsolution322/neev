<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Defaulter_list extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Farheen','farheen');
	}
	public function defaulter_classwise()
	{
		$viewupto = $this->input->post('viewupto');
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');

		$student = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC,ifnull((Select sum(total) from previous_year_feegeneration where adm_no=st.ADM_NO),0) as previous_dues from student as st where CLASS='$classs' AND SEC='$sec' and student_status='ACTIVE' order by FIRST_NM asc")->result();
		
		$student_cnt = count($student);
		
		if($viewupto=='APR')
		{
			$monthin = array('APR');
			$loop_cnt = 1;
		}
		elseif($viewupto=='MAY')
		{
			$monthin = array('APR','MAY');
			$loop_cnt = 2;
		}
		elseif($viewupto=='JUN')
		{
			$monthin = array('APR','MAY','JUN');
			$loop_cnt = 3;
		}
		elseif($viewupto=='JUL')
		{
			$monthin = array('APR','MAY','JUN','JUL');
			$loop_cnt = 4;
		}
		elseif($viewupto=='AUG')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG');
			$loop_cnt = 5;
		}
		elseif($viewupto=='SEP')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP');
			$loop_cnt = 6;
		}
		elseif($viewupto=='OCT')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT');
			$loop_cnt = 7;
		}
		elseif($viewupto=='NOV')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV');
			$loop_cnt = 8;
		}
		elseif($viewupto=='DEC')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
			$loop_cnt = 9;
		}
		elseif($viewupto=='JAN')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN');
			$loop_cnt = 10;
		}
		elseif($viewupto=='FEB')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB');
			$loop_cnt = 11;
		}
		elseif($viewupto=='MAR')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB','MAR');
			$loop_cnt = 12;
		}
		else{
			
		}
		
		 ?>
		<table class='table table-bordered' id='example'>
		  <thead>
			  <tr>
	          <th style="background: #337ab7; color: white !important;">SNO</th>
	          <th style="background: #337ab7; color: white !important;">NAME</th>
	          <th style="background: #337ab7; color: white !important;">ADM_NO</th>
	          <th style="background: #337ab7; color: white !important;">ROLL NO</th>
			  <!-- <th style="background: #337ab7; color: white !important;">Class</th> -->
			  <th style="background: #337ab7; color: white !important;">DUES UPTO</th>
	          <!-- <th style="background: #337ab7; color: white !important;">PREVIOUS YEAR DUES</th>
	         <th style="background: #337ab7; color: white !important;">CURRENT YEAR DUES</th> -->
	         <th style="background: #337ab7; color: white !important; ">TOTAL AMOUNT</th>
			 
	        </tr>
		  </thead>
	  <tbody>
	 
	  <?php
	   $month_print = '';
	   $str_month = '';
	   $mon = '';
	   $total_amount = 0;
	   $unpaid_mnth = 0;
	   $previous_duess = 0;
	   $grand_tot=0;
	   $grand_tot_prev=0;
	   $grand_tot_currnt=0;
	   $c=1;
	   $pre=0;
	    for($i=0;$i<$student_cnt;$i++)
		{
			$str_month = '';
			$month_print = '';
			$adm_no = $student[$i]->ADM_NO;
			// $class_sec = $student[$i]->DISP_CLASS ."-".$student[$i]->DISP_SEC;
			    $MON_FEE[0] = $student[$i]->APR_FEE;
				$MON_FEE[1] = $student[$i]->MAY_FEE;
				$MON_FEE[2] = $student[$i]->JUNE_FEE;
				$MON_FEE[3] = $student[$i]->JULY_FEE;
				$MON_FEE[4] = $student[$i]->AUG_FEE;
				$MON_FEE[5] = $student[$i]->SEP_FEE;
				$MON_FEE[6] = $student[$i]->OCT_FEE;
				$MON_FEE[7] = $student[$i]->NOV_FEE;
				$MON_FEE[8] = $student[$i]->DEC_FEE;
				$MON_FEE[9] = $student[$i]->JAN_FEE;
				$MON_FEE[10] = $student[$i]->FEB_FEE;
				$MON_FEE[11] = $student[$i]->MAR_FEE;
				@$previous_duess = $student[$i]->previous_dues;
					
		        for($l=0;$l<$loop_cnt;$l++)
				{
					if($MON_FEE[$l]=='N/A' OR  $MON_FEE[$l]=='')
					{
						$month_print.= $monthin[$l].',';
						if($str_month!=''){
						  $str_month = $str_month.",'". $monthin[$l]."'";
							
						}else{
							$str_month ="'".$monthin[$l]."'";
						}
					}
					
				}
				if(!empty($str_month))
				{
					$unpaid_month = $this->farheen->select('feegeneration','sum(TOTAL)total',"ADM_NO='$adm_no' AND Month_NM in($str_month)");
					$unpaid_mnth = $unpaid_month[0]->total;
					
				}
				
				$total_amount = $previous_duess + $unpaid_mnth;
				
				if($total_amount>0)
				{
				 $grand_tot_prev= $grand_tot_prev+$previous_duess;
                 $grand_tot_currnt=$grand_tot_currnt+$unpaid_mnth;
                 $grand_tot=$grand_tot+$total_amount;				 
				
		?>			
		   <tr>
			   <td><?php echo $c; ?></td>
			   <td><?php echo $student[$i]->FIRST_NM; ?></td>
			   <td><?php echo $student[$i]->ADM_NO; ?></td>
				<td> <?php
                                        if($student[$i]->ROLL_NO  ==  0){
                                            echo '--';
                                        }else{
                                            echo $student[$i]->ROLL_NO;
                                        }
                                        ?></td>
			   <!-- <td><?php //echo $class_sec; ?></td> -->
			   <td><?php  
			   if($previous_duess>0)
			   {
				   $mntt = 'PREV.DUES'.','.$month_print;
				   $month_upto = rtrim($mntt,',');
				   echo $month_upto;
			   }
			   else{
				   $month_upto = rtrim($month_print,',');
				   echo $month_upto;
			   }
			  
			   ?></td>
			   <!-- <td>
			   <?php
			    //echo $student[$i]->previous_dues;
		       ?>
			   </td>
			   <td><?php //echo $unpaid_mnth;?></td> -->
			   <td><?php echo $total_amount;?></td>
			   
		   </tr>
		   <?php
		   $c++;	
		   }
             
             $total_amount = 0;
             $unpaid_mnth = 0;	
             $previous_duess = 0;			 
	   }
	   ?>
	   </tbody>
	   <tfoot style="background:#337ab7;">
            <tr>
               
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b style="font-size:16px;color:dark;font-weight: 900;"> TOTAL</b></td>
				
				<td><b style="font-size:16px;color:dark;font-weight: 900;"><?php echo $grand_tot;?></b></td>
            </tr>
        </tfoot>
	  </table></br>
	
		<a href="<?php echo base_url('Defaulter_list/defaulter_classwise_PDF/'.$viewupto.'/'.$classs.'/'.$sec)?>";>
		<center>
		<button class='btn btn-success'><i class="fa fa-file-pdf-o"></i> Download </button>
		</center>
		</a>
			
	  
	  <script>
	  $('#example').DataTable({
        dom: 'Bfrtip',
		footer: true,
        buttons: [
			 
			// {
            //     extend: 'excelHtml5',
			// 	title: 'Class wise Defaulter Reports',
                
            // },
			//  {
            //     extend: 'csvHtml5',
			// 	title: 'Class wise Defaulter Reports',
                
            // // }, 
			// {
            //     extend: 'pdfHtml5',
			// 	title: 'Class wise Defaulter Reports',
                
            // },
			
        ]
     });
	  </script>
	  <?php
	}

	public function defaulter_classwise_PDF($view, $cls, $sec)
	{
		// echo "<pre>";print_r($_POST);die;
		$data['School_setting'] = $School_setting = $this->farheen->select('school_setting', '*');

		$data['viewupto'] = $viewupto = $view;
		$data['classsyty'] = $classs = $cls;

		$data['sec'] = $sec = $sec;
		$data['classs']=$this->db->query("SELECT class_nm FROM classes WHERE Class_No=$classs")->result();
		$data['student'] = $student = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC,C_MOBILE,ifnull((Select sum(total) from previous_year_feegeneration where adm_no=st.ADM_NO),0) as previous_dues from student as st where CLASS='$classs' AND SEC='$sec' and student_status='ACTIVE' order by FIRST_NM asc")->result();

		$data['student_cnt'] = $student_cnt = count($student);

		if ($viewupto == 'APR') {
			$monthin = array('APR');
			$loop_cnt = 1;
		} elseif ($viewupto == 'MAY') {
			$monthin = array('APR', 'MAY');
			$loop_cnt = 2;
		} elseif ($viewupto == 'JUN') {
			$monthin = array('APR', 'MAY', 'JUN');
			$loop_cnt = 3;
		} elseif ($viewupto == 'JUL') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL');
			$loop_cnt = 4;
		} elseif ($viewupto == 'AUG') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG');
			$loop_cnt = 5;
		} elseif ($viewupto == 'SEP') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP');
			$loop_cnt = 6;
		} elseif ($viewupto == 'OCT') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT');
			$loop_cnt = 7;
		} elseif ($viewupto == 'NOV') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV');
			$loop_cnt = 8;
		} elseif ($viewupto == 'DEC') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
			$loop_cnt = 9;
		} elseif ($viewupto == 'JAN') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN');
			$loop_cnt = 10;
		} elseif ($viewupto == 'FEB') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB');
			$loop_cnt = 11;
		} elseif ($viewupto == 'MAR') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB', 'MAR');
			$loop_cnt = 12;
		} else {
		}
		$data['monthin'] = $monthin;
		$data['loop_cnt'] = $loop_cnt;
		// echo "<pre>";
		// print_r($data);
		// die;
		$this->load->view('Reports/defaulter_classwisePDF', $data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("defaulter_list_class_wise.pdf", array("Attachment" => 0));
	}
	
	public function defaulter_allclasswise()
	{
		$viewupto = $this->input->post('viewupto');
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');
		$student = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC,ifnull((Select sum(total) from previous_year_feegeneration where adm_no=st.ADM_NO),0) as previous_dues from student as st where student_status='ACTIVE' order by class,sec,first_Nm asc")->result();
		
		$student_cnt = count($student);
		
		if($viewupto=='APR')
		{
			$monthin = array('APR');
			$loop_cnt = 1;
		}
		elseif($viewupto=='MAY')
		{
			$monthin = array('APR','MAY');
			$loop_cnt = 2;
		}
		elseif($viewupto=='JUN')
		{
			$monthin = array('APR','MAY','JUN');
			$loop_cnt = 3;
		}
		elseif($viewupto=='JUL')
		{
			$monthin = array('APR','MAY','JUN','JUL');
			$loop_cnt = 4;
		}
		elseif($viewupto=='AUG')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG');
			$loop_cnt = 5;
		}
		elseif($viewupto=='SEP')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP');
			$loop_cnt = 6;
		}
		elseif($viewupto=='OCT')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT');
			$loop_cnt = 7;
		}
		elseif($viewupto=='NOV')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV');
			$loop_cnt = 8;
		}
		elseif($viewupto=='DEC')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
			$loop_cnt = 9;
		}
		elseif($viewupto=='JAN')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN');
			$loop_cnt = 10;
		}
		elseif($viewupto=='FEB')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB');
			$loop_cnt = 11;
		}
		elseif($viewupto=='MAR')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB','MAR');
			$loop_cnt = 12;
		}
		else{
			
		}
		
		 ?>
		<table class='table table-bordered' id='example'>
		  <thead>
			  <tr>
	          <th style="background: #337ab7; color: white !important;">SNO</th>
	          <th style="background: #337ab7; color: white !important;">NAME</th>
	          <th style="background: #337ab7; color: white !important;">ADM_NO</th>
	          <th style="background: #337ab7; color: white !important;">ROLL NO</th>
			  <th style="background: #337ab7; color: white !important;">Class</th>
			  <th style="background: #337ab7; color: white !important;">DUES UPTO</th>
	          <!-- <th style="background: #337ab7; color: white !important;">PREVIOUS YEAR DUES</th>
	         <th style="background: #337ab7; color: white !important;">CURRENT YEAR DUES</th> -->
	         <th style="background: #337ab7; color: white !important;">TOTAL AMOUNT</th>
			 
	        </tr>
		  </thead>
	  <tbody>
	 
	  <?php
	   $month_print = '';
	   $str_month = '';
	   $mon = '';
	   $total_amount = 0;
	   $unpaid_mnth = 0;
	   $previous_duess = 0;
	   $grand_tot=0;
	   $grand_tot_prev=0;
	   $grand_tot_currnt=0;
	   $c=1;
	   $pre=0;
	    for($i=0;$i<$student_cnt;$i++)
		{
			$str_month = '';
			$month_print = '';
			$str_month = '';
			$adm_no = $student[$i]->ADM_NO;
			$class = $student[$i]->DISP_CLASS ;
			    $MON_FEE[0] = $student[$i]->APR_FEE;
				$MON_FEE[1] = $student[$i]->MAY_FEE;
				$MON_FEE[2] = $student[$i]->JUNE_FEE;
				$MON_FEE[3] = $student[$i]->JULY_FEE;
				$MON_FEE[4] = $student[$i]->AUG_FEE;
				$MON_FEE[5] = $student[$i]->SEP_FEE;
				$MON_FEE[6] = $student[$i]->OCT_FEE;
				$MON_FEE[7] = $student[$i]->NOV_FEE;
				$MON_FEE[8] = $student[$i]->DEC_FEE;
				$MON_FEE[9] = $student[$i]->JAN_FEE;
				$MON_FEE[10] = $student[$i]->FEB_FEE;
				$MON_FEE[11] = $student[$i]->MAR_FEE;
			    @$previous_duess = $student[$i]->previous_dues;
					
		        for($l=0;$l<$loop_cnt;$l++)
				{
					if($MON_FEE[$l]=='N/A' OR  $MON_FEE[$l]=='')
					{
						$month_print.= $monthin[$l].',';
						if($str_month!=''){
						  $str_month = $str_month.",'". $monthin[$l]."'";
							
						}else{
							$str_month ="'".$monthin[$l]."'";
						}
					}
					
				}
				if(!empty($str_month))
				{
					$unpaid_month = $this->farheen->select('feegeneration','sum(TOTAL)total',"ADM_NO='$adm_no' AND Month_NM in($str_month)");
					$unpaid_mnth = $unpaid_month[0]->total;
					
				}
				
				 $total_amount = $previous_duess + $unpaid_mnth;
				
				if($total_amount>0)
				{
				   $grand_tot_prev= $grand_tot_prev+$previous_duess;
                   $grand_tot_currnt=$grand_tot_currnt+$unpaid_mnth;
                  $grand_tot=$grand_tot+$total_amount;				 
				
		?>			
		   <tr>
			   <td><?php echo $c; ?></td>
			   <td><?php echo $student[$i]->FIRST_NM; ?></td>
			   <td><?php echo $student[$i]->ADM_NO; ?></td>
			   <td><?php
                                        if($student[$i]->ROLL_NO  ==  0){
                                            echo '--';
                                        }else{
                                            echo $student[$i]->ROLL_NO;
                                        }
                                        ?></td>
			   <td><?php echo $class; ?></td>
			   <td><?php  
			   if($previous_duess>0)
			   {
				   $mntt = 'PREV.DUES'.','.$month_print;
				   $month_upto = rtrim($mntt,',');
				   echo $month_upto;
			   }
			   else{
				   $month_upto = rtrim($month_print,',');
				   echo $month_upto;
			   }
			  
			   ?></td>
			   <!-- <td>
			   <?php
			    //echo $student[$i]->previous_dues;
		       ?>
			   </td>
			   <td><?php //echo $unpaid_mnth;?></td> -->
			   <td><?php echo $total_amount;?></td>
			   
		   </tr>
		   <?php
		   $c++;
		   }
             	
             $total_amount = 0;
             $unpaid_mnth = 0;	
             $previous_duess = 0;			 
	   }
	   ?>
	   </tbody>
	   <tfoot style="background:#337ab7;">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b style="font-size:16px;color:dark;font-weight: 900;"> TOTAL</b></td>
				<!-- <td><b style="font-size:16px;color:dark;font-weight: 900;"><?php //echo $grand_tot_prev;?></b></td>
				<td><b style="font-size:16px;color:dark;font-weight: 900;"><?php //echo $grand_tot_currnt;?></b></td> -->
				<td><b style="font-size:16px;color:dark;font-weight: 900;"><?php echo $grand_tot;?></b></td>
            </tr>
        </tfoot>
	  </table></br>

	  <a href="<?php echo base_url('Defaulter_list/defaulter_allclasswisePDF/'.$viewupto)?>";>
		<center>
		<button class='btn btn-success'><i class="fa fa-file-pdf-o"></i> Download </button>
		</center>
		</a>
			
	  
	  <script>
	  $('#example').DataTable({
        dom: 'Bfrtip',
		footer: true,
        buttons: [
			 
				// {
				//     extend: 'excelHtml5',
				// 	title: 'All class wise Defaulter Reports',
					
				// },
				//  {
				//     extend: 'csvHtml5',
				// 	title: 'All class wise Defaulter Reports',
					
				// }, 
			// {
            //     extend: 'pdfHtml5',
			// 	title: 'All class wise Defaulter Reports',
                
            // },
			
        ]
     });
	  </script>
	  <?php
	}
	public function defaulter_allclasswisePDF($view)
	{
		$data['School_setting'] = $School_setting = $this->farheen->select('school_setting', '*');

		$data['viewupto'] = $viewupto = $view;
		$data['classs'] = $classs = $cls;
		$data['sec'] = $sec = $sec;
		$student = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC,C_MOBILE,ifnull((Select sum(total) from previous_year_feegeneration where adm_no=st.ADM_NO),0) as previous_dues from student as st where student_status='ACTIVE' order by class,sec,first_Nm asc")->result();
		// echo $this->db->last_query();
		// die;

		$data['student'] = $student;
		$data['student_cnt'] = $student_cnt = count($student);
		
		
		if($viewupto=='APR')
		{
			$monthin = array('APR');
			$loop_cnt = 1;
		}
		elseif($viewupto=='MAY')
		{
			$monthin = array('APR','MAY');
			$loop_cnt = 2;
		}
		elseif($viewupto=='JUN')
		{
			$monthin = array('APR','MAY','JUN');
			$loop_cnt = 3;
		}
		elseif($viewupto=='JUL')
		{
			$monthin = array('APR','MAY','JUN','JUL');
			$loop_cnt = 4;
		}
		elseif($viewupto=='AUG')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG');
			$loop_cnt = 5;
		}
		elseif($viewupto=='SEP')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP');
			$loop_cnt = 6;
		}
		elseif($viewupto=='OCT')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT');
			$loop_cnt = 7;
		}
		elseif($viewupto=='NOV')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV');
			$loop_cnt = 8;
		}
		elseif($viewupto=='DEC')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
			$loop_cnt = 9;
		}
		elseif($viewupto=='JAN')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN');
			$loop_cnt = 10;
		}
		elseif($viewupto=='FEB')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB');
			$loop_cnt = 11;
		}
		elseif($viewupto=='MAR')
		{
			$monthin = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB','MAR');
			$loop_cnt = 12;
		}
		else{
			
		}
		$data['monthin'] = $monthin;
		$data['loop_cnt'] = $loop_cnt;
		// echo "<pre>";
		// print_r($data);
		// die;
		$this->load->view('Reports/defaulter_allclasswisePDF', $data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("defaulter_list_allclass_wise.pdf", array("Attachment" => 0));

	}
}	
