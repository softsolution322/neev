 <html>
<head>
  <style>
    @page { margin: 120px 25px 60px 10px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px;}
    #footer { position: fixed; right: 0px; bottom: 10px; text-align: right;}
    #footer .page:after { content: counter(page, decimal); }

        .table {
          border-collapse: collapse;
          font-size: 12px;
           white-space: nowrap;
        }

        .table, th, td {
          border: 1px solid #abb5c4;
        }
        .name {
          text-align: left;
        }
         .text-center{
          text-align: center;
          font-weight: bold;
        }
         .text-right{
          text-align: right;
        }
        .thead-color{
          background: #abb0ac !important;
        }
  </style>
</head>
<body>
  <header id="header">
      <div style="text-align: center;">
        <span style="font-size: 25px;font-weight: bold;"><?php echo $school_setting['School_Name'] ?> </span>
        <br><span><?php echo $school_setting['School_Address'] ?> </span><br>
      </div>
      <div style="text-align: center;">Monthly Salary Register (<?php echo date('F',strtotime($year.'-'.$month.'-1')).'-'.$year; ?>)</div>
    </header>
   <div id="footer">
      <p class="page">Page </p>
    </div> 
    <div id="content">
          <div>
            <table style="width: 100%;" class="table">
              <thead id="header-fixed">
                <tr> 
                 <th colspan="5" class="text-center thead-color"></th>
                  <th colspan="7" class="text-center thead-color">Allowance</th>
                  <th colspan="6" class="text-center thead-color">Arrear</th>
                  <th class="text-center thead-color"></th>
                  <th colspan="12" class="text-center thead-color">Deduction</th>
                  <th class="text-center thead-color"></th>
                  <th class="text-center thead-color"></th>
                  <th class="text-center thead-color"></th>
                </tr>
                <tr>
                  <th class="text-center thead-color">S.No</th>
                  <th class="text-center thead-color">Employee Name</th>  
                  <th class="text-center thead-color">Designation</th>  
                  <th class="text-center thead-color">W.<br>Days</th>  
                  <th class="thead-color text-center">Pr.<br>Days</th>   
                  <th class="thead-color text-center">Actual<br>Basic</th>   
                  <th class="thead-color text-center">Basic<br>Payable</th>   
                  <th class="thead-color text-center">DA</th>   
                  <th class="thead-color text-center">HRA</th>   
                  <th class="thead-color text-center">TA</th>   
                  <th class="thead-color text-center">Fixed<br>Allow.</th>   
                  <th class="thead-color text-center">Shift<br>Allow.</th>   
                  <th class="thead-color text-center">Basic</th>   
                  <th class="text-center thead-color">DA</th>   
                  <th class="thead-color text-center">HRA</th>     
                  <th class="thead-color text-center">TA</th>   
                  <th class="thead-color text-center">Fixed<br>Allow.</th>   
                  <th class="thead-color text-center">Shift<br>Allow.</th>   
                  <th class="thead-color text-center">Gross<br>Payable</th>   
                  <th class="thead-color text-center">EPF</th>   
                  <th class="thead-color text-center">FPF</th>   
                  <th class="thead-color text-center">VPF</th>   
                  <th class="thead-color text-center">ESI</th>   
                  <th class="thead-color text-center">Prof.<br>Tax</th>   
                  <th class="thead-color text-center">LIC</th> 
                  <th class="text-center thead-color">House<br>Rent</th> 
                  <th class="text-center thead-color">Group<br>Ins<br>Amt</th>   
                  <th class="text-center thead-color">Staff<br>Wel<br>Fund</th>   
                  <th class="text-center thead-color">TDS</th>   
                  <th class="text-center thead-color">Medical</th>   
                  <th class="text-center thead-color">Adv.<br>Salary</th>   
                  <th class="text-center thead-color">Total<br>Ded.</th>   
                  <th class="text-center thead-color">Payable<br>Amt</th>   
                  <th class="text-center thead-color"></th>   
                </tr>
              </thead>
              <tbody>
                  <?php 
                  $total_basic = 0;
                  $total_gross_sal = 0;
                  $total_deduction = 0;
                  $total_payable = 0;
                  foreach ($resultList as $key => $value) {  ?>
                    <?php 
                    $total_basic = $total_basic + $value['basic_salary'];
                    $total_gross_sal = $total_gross_sal + $value['gross_salary'];
                    $total_deduction = $total_deduction + $value['total_deduction'];
                    $total_payable = $total_payable + $value['payable_amt'];
                    ?>  
                      <tr>
                        <td style="text-align: center;"><?php echo $key + 1; ?></td>
                        <td style="padding: 50px 0px;"><?php $full_name = $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME'];
                           echo strlen($full_name) > 21 ? substr($full_name,0,21)."..." : $full_name;?>
                        </td>
                        <td><?php echo $value['DESIG']; ?></td>
                        <td class="text-center"><?php echo sprintf('%g',$value['total_working_days']); ?></td>
                        <td class="text-center"><?php echo sprintf('%g',$value['total_present']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['actual_basic']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['basic_salary']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['da_pay']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['hra_pay']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['ta_pay']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['fixed_allowance']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['total_amount']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['arrear_basic']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['arrear_da']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['arrear_hra']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['arrear_ta']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['arrear_fixed_allow']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['arrear_shift_allow']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['gross_salary']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['pf_own_deduct']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['fpf_deduct']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['vpf_deduct']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['esi_deduct']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['prof_tax']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['lic']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',($value['hra_rent_deduct'] + $value['hra_security_deduct'] + $value['hra_garage_deduct']+ $value['hra_elect_deduct'])); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['group_insurance_amt']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['staff_welfare_fund']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['tds_deduct']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['medical_deduct']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['advance_salary_deduct']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['total_deduction']); ?></td>
                        <td class="text-right"><?php echo sprintf('%g',$value['payable_amt']); ?></td>
                        <td class="text-right" width="40px">----------------</td>
                      </tr>
                  <?php } ?>
              </tbody>
             <!--  <tfoot>
                <tr>
                  <td  class="text-right thead-color" colspan="6">Grand Total</td>
                  <td class="text-right thead-color"><?php echo $total_basic; ?></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"><?php echo $total_gross_sal; ?></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"></td>
                  <td class="text-right thead-color"><?php echo $total_deduction; ?></td>
                  <td class="text-right thead-color"><?php echo $total_payable; ?></td>
                </tr>
              </tfoot> -->
            </table>
          </div>
  </div>
  </body>
</html>