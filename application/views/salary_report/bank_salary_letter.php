<html>
<head>
  <style>
    @page { margin: 20px 25px 30px 35px; }
    #footer { position: fixed; right: 0px; bottom: 20px; text-align: right;}
        #footer .page:after { content: counter(page, decimal); }

        .table {
          border-collapse: collapse;
          font-size: 10px;
          white-space: nowrap;
        }

        .table, th, td {
          border: 1px solid #abb5c4;
        }
        .name {
          text-align: left;
        }
        .text-right {
          text-align: right;
        }
        .text-center {
          text-align: center;
        }
        .thead-color{
          background: #abb0ac !important;
        }
  </style>
<body>
  <!-- <div id="header">
    <h1>Widgets Express</h1>
  </div> -->
  <div id="footer">
    <p style="float: left;"><?php echo $school_setting['short_nm'].' '.$current_session['Session_Nm']; ?> Bank Salary Letter for <?php echo strtoupper(date('F',strtotime($current_year.'-'.$current_month.'-1'))).' '.$current_year; ?></p>
    <p class="page" style="float: right;">Page </p>
  </div> 
  <div style="clear: all;"></div>
  <div id="content">

    <div style="height: 250px;">
        
    </div>
    <div>
        <strong><span>Ref. No. : <?php echo $school_setting['short_nm'].'/'.$current_session['Session_Nm']; ?>/SALARY/__________________</span><span style="margin-left: 60px;"> Dated: ______/______/20____</span></strong><br>
        <p>To
        <br>The Branch Manager
        <br><?php echo $school_setting['BkName'].'<br>'.$school_setting['BkAddress']; ?>
        <br>_</p>
        <br>
        <strong>Sub. : Salary Bill for the month of <?php echo strtoupper(date('F',strtotime($current_year.'-'.$current_month.'-1'))).' '.$current_year; ?>.</strong>
        <br>
        <p>Dear Sir,</p>
        <p>Please find enclosed herewith an account payee Cheque no. ............................................... dated...................... for Rs......................................................................................................................................................................</p>
        <p>Kindly credit the same in the personal account of the staff as per the list given below & oblidge.</p>
        
    </div><br>
     <table style="width: 100%;" class="table">
        <thead>
          <tr>
            <th class="text-center thead-color">S.No</th>
            <th class="thead-color">Employee Name</th>  
            <th class="text-center thead-color">Bank A/c</th>  
            <th class="text-right thead-color">Payable Amount</th>   
          </tr>
        </thead>
        <tbody>
            <?php 

            $total_amt = 0;
            foreach ($payslipData as $key => $value) {  ?>
                <tr>
                    <td style="text-align: center;"><?php echo $key + 1; ?></td>
                    <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                    <td><?php echo $value['BANK_AC_NO']; ?></td>
                    <td style="text-align: right;"><?php echo number_format((float)$value['payable_amt'], 2, '.', ''); ?></td>
                </tr>
            <?php $total_amt = $total_amt + $value['payable_amt']; } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right thead-color"><b>Grand Total</b></td>
                <td class="text-right thead-color"><b><?php echo number_format((float)$total_amt, 2, '.', ''); ?></b></td>
            </tr>
        </tfoot>
      </table>

      <table style="width: 100%;margin-top: 50px;">
            <th style="border: none;">Prepared By</th>
            <th style="border: none;">Checked By</th>
            <th style="border: none;">Accountant</th>
            <th style="border: none;">Auth. Signatory</th>
        </table>
  </div>
</body>
</html>