 <html>
<head>
  <style>
    @page { margin: 120px 25px 50px 25px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px;}
    #footer { position: fixed; right: 0px; bottom: 10px; text-align: right;}
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
    <div style="text-align: center;">Monthly Deduction Report (<?php echo date('F',strtotime($year.'-'.$month.'-1')).'-'.$year; ?>)</div>
  </header>
   <div id="footer">
      <p class="page">Page </p>
    </div> 
  <div id="content">
    <div>
      <table style="width: 100%;" class="table">
        <thead>
          <tr>
            <th colspan="3" class="thead-color text-center"></th>
            <th colspan="13" class="thead-color text-center">Deduction</th>
          </tr>
          <tr>
            <th class="text-center thead-color">S.No</th>
            <th class="thead-color">Employee Name</th>   
            <th class="thead-color">Designation</th>  
            <th class="thead-color text-center">Basic<br>Salary</th>  
            <th class="thead-color text-center">PF</th>  
            <th class="thead-color text-center">FPF</th>  
            <th class="thead-color text-center">VPF</th>  
            <th class="thead-color text-center">ESI</th>  
            <th class="thead-color text-center">Prof.<br>Tax</th>  
            <th class="thead-color text-center">LIC</th>  
            <th class="thead-color text-center">HR</th>
            <th class="thead-color text-center">Group<br>Ins.<br>Amt.</th>
            <th class="thead-color text-center">Staff<br>Welf.<br>Fund</th>
            <th class="thead-color text-center">TDS</th>
            <th class="thead-color text-center">Medical</th>
            <th class="thead-color text-center">Adv.<br>Salary</th>
          </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($resultData as $key => $value) {  ?>
                <tr>
                    <td style="text-align: center;"><?php echo $key + 1; ?></td>
                    <td><?php $full_name = $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME'];
                    echo strlen($full_name) > 21 ? substr($full_name,0,21)."..." : $full_name;?></td>
                    <td><?php echo $value['DESIG']; ?></td>
                    <td class="text-right"><?php echo $value['basic_salary']; ?></td>
                    <td class="text-right"><?php echo $value['pf_own_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['fpf_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['vpf_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['esi_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['prof_tax']; ?></td>
                    <td class="text-right"><?php echo $value['lic']; ?></td>
                    <td class="text-right"><?php echo $value['hra_rent_deduct'] + $value['hra_security_deduct'] + $value['hra_garage_deduct'] + $value['hra_elect_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['group_insurance_amt']; ?></td>
                    <td class="text-right"><?php echo $value['staff_welfare_fund']; ?></td>
                    <td class="text-right"><?php echo $value['tds_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['medical_deduct']; ?></td>
                    <td class="text-right"><?php echo $value['advance_salary_deduct']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  </body>
</html>