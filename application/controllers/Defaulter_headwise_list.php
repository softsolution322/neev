<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Defaulter_headwise_list extends MY_Controller{
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
		
		$feehead = $this->db->query("select FEE_HEAD from feehead order by ACT_CODE asc")->result();
		
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
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">SNO</th>
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">NAME</th>
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">ADM_NO</th>
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">ROLL NO</th>
			  <th style="background: #337ab7; color: white !important;font-size:14px !important">Class/Sec</th>
			  <th style="background: #337ab7; color: white !important;font-size:14px !important">MONTH UPTO</th>
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">PREVIOUS YEAR DUES</th>
	         <th style="background: #337ab7; color: white !important;font-size:14px !important">CURRENT YEAR DUES</th>
			 <?php
			    foreach($feehead as $key => $value)
				{
					$fee_heads = $value->FEE_HEAD;
					?>
					<th style="background: #337ab7; color: white !important;font-size:14px !important"><?php echo $fee_heads; ?></th>
					<?php
				}
			 ?>
			 
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
	   
	   $grand_tot_fee1 =0;
	   $grand_tot_fee2 =0;
	   $grand_tot_fee3 =0;
	   $grand_tot_fee4 =0;
	   $grand_tot_fee5 =0;
	   $grand_tot_fee6 =0;
	   $grand_tot_fee7 =0;
	   $grand_tot_fee8 =0;
	   $grand_tot_fee9 =0;
	   $grand_tot_fee10 =0;
	   $grand_tot_fee11 =0;
	   $grand_tot_fee12 =0;
	   $grand_tot_fee13 =0;
	   $grand_tot_fee14 =0;
	   $grand_tot_fee15 =0;
	   $grand_tot_fee16 =0;
	   $grand_tot_fee17 =0;
	   $grand_tot_fee18 =0;
	   $grand_tot_fee19 =0;
	   $grand_tot_fee20 =0;
	   $grand_tot_fee21 =0;
	   $grand_tot_fee22 =0;
	   $grand_tot_fee23 =0;
	   $grand_tot_fee24 =0;
	   $grand_tot_fee25 =0;
	   
	   
	   
	   $c=1;
	   $pre=0;
	    for($i=0;$i<$student_cnt;$i++)
		{
			$str_month = '';
			$month_print = '';
			$adm_no = $student[$i]->ADM_NO;
			$class_sec = $student[$i]->DISP_CLASS ."-".$student[$i]->DISP_SEC;
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
					$unpaid_month = $this->farheen->select('feegeneration','sum(TOTAL)total,sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no' AND Month_NM in($str_month)");
					$unpaid_mnth = $unpaid_month[0]->total;
					
				}
				
				$total_amount = $previous_duess + $unpaid_mnth;
				
				 if($total_amount>0)
				 {
				 $grand_tot_prev= $grand_tot_prev+$previous_duess;
                 $grand_tot_currnt=$grand_tot_currnt+$unpaid_mnth;
                 $grand_tot=$grand_tot+$total_amount;	

                 // Sumup of all feehead //
				 $grand_tot_fee1=$grand_tot_fee1+$unpaid_month[0]->Fee1;
				 $grand_tot_fee2=$grand_tot_fee2+$unpaid_month[0]->Fee2;
				 $grand_tot_fee3=$grand_tot_fee3+$unpaid_month[0]->Fee3;
				 $grand_tot_fee4=$grand_tot_fee4+$unpaid_month[0]->Fee4;
				 $grand_tot_fee5=$grand_tot_fee5+$unpaid_month[0]->Fee5;
				 $grand_tot_fee6=$grand_tot_fee6+$unpaid_month[0]->Fee6;
				 $grand_tot_fee7=$grand_tot_fee7+$unpaid_month[0]->Fee7;
				 $grand_tot_fee8=$grand_tot_fee8+$unpaid_month[0]->Fee8;
				 $grand_tot_fee9=$grand_tot_fee9+$unpaid_month[0]->Fee9;
				 $grand_tot_fee10=$grand_tot_fee10+$unpaid_month[0]->Fee10;
				 $grand_tot_fee11=$grand_tot_fee11+$unpaid_month[0]->Fee11;
				 $grand_tot_fee12=$grand_tot_fee12+$unpaid_month[0]->Fee12;
				 $grand_tot_fee13=$grand_tot_fee13+$unpaid_month[0]->Fee13;
				 $grand_tot_fee14=$grand_tot_fee14+$unpaid_month[0]->Fee14;
				 $grand_tot_fee15=$grand_tot_fee15+$unpaid_month[0]->Fee15;
				 $grand_tot_fee16=$grand_tot_fee16+$unpaid_month[0]->Fee16;
				 $grand_tot_fee17=$grand_tot_fee17+$unpaid_month[0]->Fee17;
				 $grand_tot_fee18=$grand_tot_fee18+$unpaid_month[0]->Fee18;
				 $grand_tot_fee19=$grand_tot_fee19+$unpaid_month[0]->Fee19;
				 $grand_tot_fee20=$grand_tot_fee20+$unpaid_month[0]->Fee20;
				 $grand_tot_fee21=$grand_tot_fee21+$unpaid_month[0]->Fee21;
				 $grand_tot_fee22=$grand_tot_fee22+$unpaid_month[0]->Fee22;
				 $grand_tot_fee23=$grand_tot_fee23+$unpaid_month[0]->Fee23;
				 $grand_tot_fee24=$grand_tot_fee24+$unpaid_month[0]->Fee24;
				 $grand_tot_fee25=$grand_tot_fee25+$unpaid_month[0]->Fee25;
				
		?>			
		   <tr>
			   <td><?php echo $c; ?></td>
			   <td><?php echo $student[$i]->FIRST_NM; ?></td>
			   <td><?php echo $student[$i]->ADM_NO; ?></td>
			   <td><?php echo $student[$i]->ROLL_NO; ?></td>
			   <td><?php echo $class_sec; ?></td>
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
			   <td>
			   <?php
			    echo $student[$i]->previous_dues;
		       ?>
			   </td>
			   <td><?php echo $unpaid_mnth;?></td>
			   <td><?php echo $unpaid_month[0]->Fee1;?></td>
			   <td><?php echo $unpaid_month[0]->Fee2;?></td>
			   <td><?php echo $unpaid_month[0]->Fee3;?></td>
			   <td><?php echo $unpaid_month[0]->Fee4;?></td>
			   <td><?php echo $unpaid_month[0]->Fee5;?></td>
			   <td><?php echo $unpaid_month[0]->Fee6;?></td>
			   <td><?php echo $unpaid_month[0]->Fee7;?></td>
			   <td><?php echo $unpaid_month[0]->Fee8;?></td>
			   <td><?php echo $unpaid_month[0]->Fee9;?></td>
			   <td><?php echo $unpaid_month[0]->Fee10;?></td>
			   <td><?php echo $unpaid_month[0]->Fee11;?></td>
			   <td><?php echo $unpaid_month[0]->Fee12;?></td>
			   <td><?php echo $unpaid_month[0]->Fee13;?></td>
			   <td><?php echo $unpaid_month[0]->Fee14;?></td>
			   <td><?php echo $unpaid_month[0]->Fee15;?></td>
			   <td><?php echo $unpaid_month[0]->Fee16;?></td>
			   <td><?php echo $unpaid_month[0]->Fee17;?></td>
			   <td><?php echo $unpaid_month[0]->Fee18;?></td>
			   <td><?php echo $unpaid_month[0]->Fee19;?></td>
			   <td><?php echo $unpaid_month[0]->Fee20;?></td>
			   <td><?php echo $unpaid_month[0]->Fee21;?></td>
			   <td><?php echo $unpaid_month[0]->Fee22;?></td>
			   <td><?php echo $unpaid_month[0]->Fee23;?></td>
			   <td><?php echo $unpaid_month[0]->Fee24;?></td>
			   <td><?php echo $unpaid_month[0]->Fee25;?></td>
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
	   <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b style="font-size:16px;color:red;font-weight: 900;">GRAND TOTAL</b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_prev;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_currnt;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee1;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee2;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee3;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee4;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee5;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee6;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee7;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee8;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee9;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee10;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee11;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee12;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee13;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee14;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee15;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee16;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee17;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee18;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee19;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee20;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee21;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee22;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee23;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee24;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee25;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot;?></b></td>
            </tr>
        </tfoot>
	  </table></br>
	  
	  <script>
	  $('#example').DataTable({
        dom: 'Bfrtip',
		footer: true,
        buttons: [
			 
			{
                extend: 'excelHtml5',
				title: 'Class wise Fee Head Wise Defaulter Reports',
                
            },
			 {
                extend: 'csvHtml5',
				title: 'Class wise Fee Head Wise Defaulter Reports',
                
            }, 
			{
                extend: 'pdfHtml5',
				title: 'Class wise Fee Head Wise Defaulter Reports',
                
            },
			
        ]
     });
	  </script>
	  <?php
	}
	
	public function defaulter_allclasswise()
	{
		$viewupto = $this->input->post('viewupto');
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');
		$student = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC,ifnull((Select sum(total) from previous_year_feegeneration where adm_no=st.ADM_NO),0) as previous_dues from student as st where student_status='ACTIVE' order by class,sec,first_Nm asc")->result();
		
		$feehead = $this->db->query("select FEE_HEAD from feehead where accg=1 order by ACT_CODE asc")->result();
		
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
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">SNO</th>
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">NAME</th>
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">ADM_NO</th>
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">ROLL NO</th>
			  <th style="background: #337ab7; color: white !important;font-size:14px !important">Class/Sec</th>
			  <th style="background: #337ab7; color: white !important;font-size:14px !important">MONTH UPTO</th>
	          <th style="background: #337ab7; color: white !important;font-size:14px !important">PREVIOUS YEAR DUES</th>
	         <th style="background: #337ab7; color: white !important;font-size:14px !important">CURRENT YEAR DUES</th>
			 <?php
			    foreach($feehead as $key => $value)
				{
					$fee_heads = $value->FEE_HEAD;
					?>
					<th style="background: #337ab7; color: white !important;font-size:14px !important"><?php echo $fee_heads; ?></th>
					<?php
				}
			 ?>
			 
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
	   
	   $grand_tot_fee1 =0;
	   $grand_tot_fee2 =0;
	   $grand_tot_fee3 =0;
	   $grand_tot_fee4 =0;
	   $grand_tot_fee5 =0;
	   $grand_tot_fee6 =0;
	   $grand_tot_fee7 =0;
	   $grand_tot_fee8 =0;
	   $grand_tot_fee9 =0;
	//    $grand_tot_fee10 =0;
	//    $grand_tot_fee11 =0;
	//    $grand_tot_fee12 =0;
	//    $grand_tot_fee13 =0;
	//    $grand_tot_fee14 =0;
	//    $grand_tot_fee15 =0;
	//    $grand_tot_fee16 =0;
	//    $grand_tot_fee17 =0;
	//    $grand_tot_fee18 =0;
	//    $grand_tot_fee19 =0;
	//    $grand_tot_fee20 =0;
	//    $grand_tot_fee21 =0;
	   $grand_tot_fee22 =0;
	   $grand_tot_fee23 =0;
	//    $grand_tot_fee24 =0;
	//    $grand_tot_fee25 =0;
	   
	   $c=1;
	   $pre=0;
	    for($i=0;$i<$student_cnt;$i++)
		{
			$str_month = '';
			$month_print = '';
			$adm_no = $student[$i]->ADM_NO;
			$class_sec = $student[$i]->DISP_CLASS ."-".$student[$i]->DISP_SEC;
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
					$unpaid_month = $this->farheen->select('feegeneration','sum(TOTAL)total,sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25',"ADM_NO='$adm_no' AND Month_NM in($str_month)");
					$unpaid_mnth = $unpaid_month[0]->total;
					
				}
				
				$total_amount = $previous_duess + $unpaid_mnth;
				
				 if($total_amount>0)
				 {
				 $grand_tot_prev= $grand_tot_prev+$previous_duess;
                 $grand_tot_currnt=$grand_tot_currnt+$unpaid_mnth;
                 $grand_tot=$grand_tot+$total_amount;	

                 // Sumup of all feehead //
				 $grand_tot_fee1=$grand_tot_fee1+$unpaid_month[0]->Fee1;
				 $grand_tot_fee2=$grand_tot_fee2+$unpaid_month[0]->Fee2;
				 $grand_tot_fee3=$grand_tot_fee3+$unpaid_month[0]->Fee3;
				 $grand_tot_fee4=$grand_tot_fee4+$unpaid_month[0]->Fee4;
				 $grand_tot_fee5=$grand_tot_fee5+$unpaid_month[0]->Fee5;
				 $grand_tot_fee6=$grand_tot_fee6+$unpaid_month[0]->Fee6;
				 $grand_tot_fee7=$grand_tot_fee7+$unpaid_month[0]->Fee7;
				 $grand_tot_fee8=$grand_tot_fee8+$unpaid_month[0]->Fee8;
				 $grand_tot_fee9=$grand_tot_fee9+$unpaid_month[0]->Fee9;
				//  $grand_tot_fee10=$grand_tot_fee10+$unpaid_month[0]->Fee10;
				//  $grand_tot_fee11=$grand_tot_fee11+$unpaid_month[0]->Fee11;
				//  $grand_tot_fee12=$grand_tot_fee12+$unpaid_month[0]->Fee12;
				//  $grand_tot_fee13=$grand_tot_fee13+$unpaid_month[0]->Fee13;
				//  $grand_tot_fee14=$grand_tot_fee14+$unpaid_month[0]->Fee14;
				//  $grand_tot_fee15=$grand_tot_fee15+$unpaid_month[0]->Fee15;
				//  $grand_tot_fee16=$grand_tot_fee16+$unpaid_month[0]->Fee16;
				//  $grand_tot_fee17=$grand_tot_fee17+$unpaid_month[0]->Fee17;
				//  $grand_tot_fee18=$grand_tot_fee18+$unpaid_month[0]->Fee18;
				//  $grand_tot_fee19=$grand_tot_fee19+$unpaid_month[0]->Fee19;
				//  $grand_tot_fee20=$grand_tot_fee20+$unpaid_month[0]->Fee20;
				//  $grand_tot_fee21=$grand_tot_fee21+$unpaid_month[0]->Fee21;
				 $grand_tot_fee22=$grand_tot_fee22+$unpaid_month[0]->Fee22;
				 $grand_tot_fee23=$grand_tot_fee23+$unpaid_month[0]->Fee23;
				//  $grand_tot_fee24=$grand_tot_fee24+$unpaid_month[0]->Fee24;
				//  $grand_tot_fee25=$grand_tot_fee25+$unpaid_month[0]->Fee25;
				
		?>			
		   <tr>
			   <td><?php echo $c; ?></td>
			   <td><?php echo $student[$i]->FIRST_NM; ?></td>
			   <td><?php echo $student[$i]->ADM_NO; ?></td>
			   <td><?php echo $student[$i]->ROLL_NO; ?></td>
			   <td><?php echo $class_sec; ?></td>
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
			   <td>
			   <?php
			    echo $student[$i]->previous_dues;
		       ?>
			   </td>
			   <td><?php echo $unpaid_mnth;?></td>
			   <td><?php echo $unpaid_month[0]->Fee1;?></td>
			   <td><?php echo $unpaid_month[0]->Fee2;?></td>
			   <td><?php echo $unpaid_month[0]->Fee3;?></td>
			   <td><?php echo $unpaid_month[0]->Fee4;?></td>
			   <td><?php echo $unpaid_month[0]->Fee5;?></td>
			   <td><?php echo $unpaid_month[0]->Fee6;?></td>
			   <td><?php echo $unpaid_month[0]->Fee7;?></td>
			   <td><?php echo $unpaid_month[0]->Fee8;?></td>
			   <td><?php echo $unpaid_month[0]->Fee9;?></td>
			   <!-- <td><?php //echo $unpaid_month[0]->Fee10;?></td>
			   <td><?php //echo $unpaid_month[0]->Fee11;?></td>
			   <td><?php //echo $unpaid_month[0]->Fee12;?></td>
			   <td><?php //echo $unpaid_month[0]->Fee13;?></td>
			   <td><?php //echo $unpaid_month[0]->Fee14;?></td>
			   <td><?php //echo $unpaid_month[0]->Fee15;?></td>
			   <td><?php //echo $unpaid_month[0]->Fee16;?></td>
			   <td><?php //echo $unpaid_month[0]->Fee17;?></td>
			   <td><?php //echo $unpaid_month[0]->Fee18;?></td>
			   <td><?php //echo $unpaid_month[0]->Fee19;?></td>
			   <td><?php //echo $unpaid_month[0]->Fee20;?></td>
			   <td><?php //echo $unpaid_month[0]->Fee21;?></td> -->
			   <td><?php echo $unpaid_month[0]->Fee22;?></td>
			   <td><?php echo $unpaid_month[0]->Fee23;?></td>
			   <!-- <td><?php //echo $unpaid_month[0]->Fee24;?></td>
			   <td><?php //echo $unpaid_month[0]->Fee25;?></td> -->
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
	   <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b style="font-size:16px;color:red;font-weight: 900;">GRAND TOTAL</b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_prev;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_currnt;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee1;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee2;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee3;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee4;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee5;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee6;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee7;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee8;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee9;?></b></td>
				<!-- <td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee10;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee11;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee12;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee13;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee14;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee15;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee16;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee17;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee18;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee19;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee20;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee21;?></b></td> -->
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee22;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_fee23;?></b></td>
				<!-- <td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee24;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php //echo $grand_tot_fee25;?></b></td> -->
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot;?></b></td>
            </tr>
        </tfoot>
	  </table></br>
	  
	  <script>
	  $('#example').DataTable({
        dom: 'Bfrtip',
		footer: true,
        buttons: [
			 
			{
                extend: 'excelHtml5',
				title: 'All Class wise Fee Head Wise Defaulter Reports',
                
            },
			 {
                extend: 'csvHtml5',
				title: 'All Class wise Fee Head Wise Defaulter Reports',
                
            }, 
			{
                extend: 'pdfHtml5',
				title: 'All Class wise Fee Head Wise Defaulter Reports',
                
            },
			
        ]
     });
	  </script>
	  <?php
	}
}	
