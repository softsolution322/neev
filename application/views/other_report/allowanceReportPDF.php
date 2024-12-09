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
    <div style="text-align: center;">Monthly Allowance Report (<?php echo date('F',strtotime($year.'-'.$month.'-1')).'-'.$year; ?>)</div>
  </header>
   <div id="footer">
      <p class="page">Page </p>
    </div> 
  <div id="content">
    <div>
      <table style="width: 100%;" class="table">
        <thead>
          <tr>
            <th class="text-center thead-color" colspan="10"></th>
            <th class="text-center thead-color" colspan="6">Arrear Salary</th>
          </tr>
          <tr>
            <th class="thead-color text-right">S.No</th>
            <th class="thead-color">Employee Name</th>  
            <th class="thead-color">Designation</th>  
            <th class="thead-color text-center">Basic<br>Salary</th>  
            <th class="thead-color text-center">DA</th>  
            <th class="thead-color text-center">HRA</th>  
            <th class="thead-color text-center">TA</th>  
            <th class="thead-color text-center">Fixed<br>Allow.</th>  
            <th class="thead-color text-center">Shift<br>Allow.</th>  
            <th class="thead-color text-center">2<super>nd</super><br>Shift</th>  
            <th class="thead-color text-center">Basic</th>
            <th class="thead-color text-center">DA</th>
            <th class="thead-color text-center">HRA</th>
            <th class="thead-color text-center">TA</th>
            <th class="thead-color text-center">Fixed<br>Allow.</th>
            <th class="thead-color text-center">Shift<br>Allow.</th>
          </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($resultData as $key => $value) {  ?>
                <tr>
                    <td class="text-center"><?php echo $key + 1; ?></td>
                    <td><?php 
                    $full_name = $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME'];
                    echo strlen($full_name) > 21 ? substr($full_name,0,21)."..." : $full_name;?></td>
                    <td><?php echo $value['DESIG']; ?></td>
                    <td class="text-right"><?php echo $value['basic_salary']; ?></td>
                    <td class="text-right"><?php echo $value['da_pay']; ?></td>
                    <td class="text-right"><?php echo $value['hra_pay']; ?></td>
                    <td class="text-right"><?php echo $value['ta_pay']; ?></td>
                    <td class="text-right"><?php echo $value['fixed_allowance']; ?></td>
                    <td class="text-right"><?php echo $value['shift_allowance']; ?></td>
                    <td class="text-right"><?php echo $value['total_amount']; ?></td>
                    <td class="text-right"><?php echo $value['arrear_basic']; ?></td>
                    <td class="text-right"><?php echo $value['arrear_da']; ?></td>
                    <td class="text-right"><?php echo $value['arrear_hra']; ?></td>
                    <td class="text-right"><?php echo $value['arrear_ta']; ?></td>
                    <td class="text-right"><?php echo $value['arrear_fixed_allow']; ?></td>
                    <td class="text-right"><?php echo $value['arrear_shift_allow']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  </body>
</html>