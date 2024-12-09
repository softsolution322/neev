 <html>
<head>
  <style>
        .table {
          border-collapse: collapse;
          font-size: 13px;
        }

        .table, th, td {
          border: 1px solid #abb5c4;
        }

        .detailstables tr td,.detailstables tr th{
          border: none;
          font-size: 13px;
        }

        .detailstables2 tr td,.detailstables2 tr th{
          border: none;
          font-size: 12px;
        }
        .name {
          text-align: left;
        }
        body{
          font-family: "Arial", Helvetica, sans-serif;
        }
    @page { margin: 20px 30px 40px 30px; }
  </style>
</head>
<body>
  <div id="content">
    <div style="text-align: center;">
      <span style="font-size: 35px;font-weight: bold;"><?php echo $school_setting['School_Name'] ?> </span>
      <br><span><?php echo $school_setting['School_Address'] ?> </span><hr>
      <?php echo "PAYSLIP FOR THE MONTH OF ".date('M',strtotime($year.'-'.$month.'-1')).'-'.$year; ?>
      <hr>
    </div><br>
          <div>
            <table style="width: 100%;" class="detailstables">
              <tr>
                <td>EMPLOYEE NAME</td>
                <td> : </td>
                <th><?php echo $payslipData['EMP_FNAME'].' '.$payslipData['EMP_MNAME'].' '.$payslipData['EMP_LNAME']; ?></th>
                <td>DESIGNATION</td>
                <td> : </td>
                <th><?php echo $payslipData['DESIG']; ?></th>
              </tr>
              <tr>
                <td>FATHER / HUSBAND NAME</td>
                <td> : </td>
                <th><?php if($payslipData['FATHERS_NAME']){
                  echo $payslipData['FATHERS_NAME'];
                }else{
                  echo $payslipData['G_NAME'];
                } ?></th>
                <td>DT. OF JOIN</td>
                <td> : </td>
                <th><?php echo date('d-M-Y',strtotime($payslipData['D_O_J'])); ?></th>
              </tr>
              <tr>
                <td>BANK A/C No.</td>
                <td> : </td>
                <th><?php echo $payslipData['BANK_AC_NO']; ?></th>
                <td>BASIC & OTHERS</td>
                <td> : </td>
                <th><?php echo $payslipData['basic_salary']; ?></th>
              </tr>
              <tr>
                <td>PAN NUMBER</td>
                <td> : </td>
                <th><?php echo $payslipData['PAN_NUMBER']; ?></th>
                <td>ALLW. & OTHERS</td>
                <td> : </td>
                <th><?php echo $allowance = $payslipData['da_pay'] + $payslipData['hra_pay'] + $payslipData['ta_pay'] + $payslipData['fixed_allowance'] + $payslipData['shift_allowance'] + $payslipData['total_amount'] + $payslipData['arrear_basic'] + $payslipData['arrear_da'] + $payslipData['arrear_hra'] + $payslipData['arrear_ta'] + $payslipData['arrear_fixed_allow'] + $payslipData['arrear_shift_allow']; ?></th>
              </tr>
            </table>
            <br><br>
            <table class="table" style="width: 100%">
              <tr>
                <th style="text-align: center;">PAYABLE AMOUNT</th>
                <th style="text-align: center;">DEDUCTIONS</th>
                <th style="text-align: center;">LEAVE DETAILS</th>
              </tr>
              <tr>
                <td style="vertical-align: top;">
                  <table class="detailstables2" style="width: 100%">
                    <tr>
                      <td>Basic & Others</td>
                      <td style="text-align: right;"><?php echo $payslipData['basic_salary']; ?></td>
                    </tr>
                    <tr>
                      <td>Allowance & Others</td>
                      <td style="text-align: right;"><?php echo $allowance; ?></td>
                    </tr>
                  </table>
                </td>
                <td style="vertical-align: top;">
                  <table class="detailstables2" style="width: 100%">
                    <tr>
                      <td>Prov. Fund</td>
                      <td style="text-align: right;"><?php echo $payslipData['pf_own_deduct']; ?></td>
                    </tr>
                    <tr>
                      <td>ESIC</td>
                      <td style="text-align: right;"><?php echo $payslipData['esi_deduct']; ?></td>
                    </tr>
                    <tr>
                      <td>TDS</td>
                      <td style="text-align: right;"><?php echo $payslipData['tds_deduct']; ?></td>
                    </tr>
                    <tr>
                      <td>Advance Recovery</td>
                      <td style="text-align: right;"><?php echo $payslipData['advance_salary_deduct']; ?></td>
                    </tr>
                    <tr>
                      <td>Misc. Deduction</td>
                      <td style="text-align: right;"><?php echo $misc_deduction = $payslipData['fpf_deduct'] + $payslipData['vpf_deduct'] + $payslipData['prof_tax'] + $payslipData['lic'] + $payslipData['hra_rent_deduct'] + $payslipData['hra_security_deduct'] + $payslipData['hra_garage_deduct'] + $payslipData['hra_elect_deduct'] + $payslipData['group_insurance_amt'] + $payslipData['staff_welfare_fund'] + $payslipData['medical_deduct']; ?></td>
                    </tr>
                  </table>
                </td>
                <td>                 
                  <table class="detailstables2" style="width: 100%">
                    <tr>
                      <th style="border-bottom: 1px solid black;">Leave Type</th>
                      <th style="border-bottom: 1px solid black;text-align: right;">Availed</th>
                    </tr>
                    <tr>
                      <td>Casual Leave</td>
                      <td style="text-align: center;text-align: right;"><?php  echo $count_attendata['CL'] =isset($count_attendata['CL'])?$count_attendata['CL']:0; ?></td>
                    </tr>
                    <tr>
                      <td>Medical Leave</td>
                      <td style="text-align: center;text-align: right;"><?php echo $count_attendata['ML'] =isset($count_attendata['ML'])?$count_attendata['ML']:0; ?></td>
                    </tr>
                    <tr>
                      <td>Earned Leave</td>
                      <td style="text-align: center;text-align: right;"><?php echo $count_attendata['EL'] = isset($count_attendata['EL'])?$count_attendata['EL']:0; ?></td>
                    </tr>
                    <tr>
                      <td>Deffered Day Leave</td>
                      <td style="text-align: center;text-align: right;"><?php echo $count_attendata['DDL'] = isset($count_attendata['DDL'])?$count_attendata['DDL']:0; ?></td>
                    </tr>
                    <tr>
                      <td>Leave Without Pay</td>
                      <td style="text-align: center;text-align: right;"><?php echo $count_attendata['LWP'] = isset($count_attendata['LWP'])?$count_attendata['LWP']:0; ?></td>
                    </tr>
                    <tr>
                      <th style="border-bottom: 1px solid black;border-top: 1px solid black;padding: 5px 0px;">Leave Availed During Month</th>
                      <th style="border-bottom: 1px solid black;border-top: 1px solid black;text-align: right;padding: 5px 0px;"><?php echo $count_attendata['CL'] +$count_attendata['EL'] +$count_attendata['ML'] +$count_attendata['DDL'] +$count_attendata['LWP']; ?></th>
                    </tr>
                    <tr style="margin-top: 5px;">
                      <th colspan="2" style="border-bottom: 1px solid black;border-top: 1px solid black;padding: 5px 0px;">Working Days : <?php echo sprintf('%g',$payslipData['total_working_days']); ?> &nbsp; &nbsp;  Days Worked : <?php echo sprintf('%g',$payslipData['total_present']); ?></th>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td style="padding: 10px 0px;">
                  <table class="detailstables2" style="width: 100%">
                    <tr>
                      <td>Gross Payable (Rs.)</td>
                      <td style="text-align: right;"><?php echo $payslipData['gross_salary']; ?></td>
                    </tr>
                  </table>
                </td>
                <td>
                  <table class="detailstables2" style="width: 100%">
                    <tr>
                      <td>Gross Deduction (Rs.)</td>
                      <td style="text-align: right;"><?php echo $payslipData['total_deduction']; ?></td>
                    </tr>
                  </table>
                </td>
                <td>
                  <table class="detailstables2" style="width: 100%">
                    <tr>
                      <td>Net Payable Amount (Rs.)</td>
                      <td style="text-align: right;font-weight: bold;"><?php echo $payslipData['payable_amt']; ?></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="padding: 10px 0px;">CTC for the Month : Rs. <?php echo $payslipData['payable_amt']; ?></td>
              </tr>
            </table>
            <br>
            <br>

            <p style="text-align: center;">
              ***************************************************************************************<br>This is computer generated statement, hence signature not required.</p>
          </div>
  </div>
  </body>
</html>