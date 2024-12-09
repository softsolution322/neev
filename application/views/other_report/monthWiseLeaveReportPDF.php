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
      <div style="text-align: center;">Monthly Leave Report (<?php echo date('F',strtotime($year.'-'.$month.'-1')).'-'.$year; ?>)</div>
    </header>
   <div id="footer">
      <p class="page">Page </p>
    </div> 
  <div id="content">  
    <div>
      <table class="table" style="width: 100%;">
        <thead>
          <tr>
            <th class="text-center thead-color">S.No</th>
            <th class="thead-color">Employee Name</th>  
            <th class="thead-color">Designation</th>  
            <th class="thead-color text-center">Working<br> Days</th>  
            <th class="thead-color text-center">Present<br> Days</th>  
            <?php for ($i=1; $i <= $total_days; $i++) { 
              $date = $year.'-'.$month.'-'.$i;
              ?>
              <th class="thead-color text-center"><?php echo $i.'<br> '.date("D", strtotime($date)); ?></th>
            <?php } ?>    
          </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($attendaceData as $key => $value) {  ?>
                <tr>
                    <td class="text-center"><?php echo $key + 1; ?></td>
                    <td><?php $full_name = $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME'];
                           echo strlen($full_name) > 21 ? substr($full_name,0,21)."..." : $full_name;?>
                    </td>
                    <td><?php echo $value['DESIGNATION_NAME']; ?></td>
                    <td class="text-center"><?php echo $value['total_working_days']; ?></td>
                    <td class="text-center"><?php echo $value['total_present']; ?></td>
                    <?php for ($i=1; $i <= $total_days; $i++) { ?>
                      <td class="text-center"><?php if($value[$i.'c'] == 'CL' || $value[$i.'c'] == 'ML' || $value[$i.'c'] == 'EL' || $value[$i.'c'] == 'DDL')
                      {
                        echo $value[$i.'c'];
                      }else{
                              echo '-';
                            } ?></td>
                    <?php } ?> 
                </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>

</div>
</body>
</html>