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
      <div style="text-align: center;">Monthly Attendance Report (<?php echo date('F',strtotime($year.'-'.$month.'-1')).'-'.$year; ?>)</div>
    </header>
   <div id="footer">
      <p class="page">Page </p>
    </div> 
  <div id="content">
          <div>
            <table class="table" style="width: 100%;">
              <thead>
                <tr>
                  <th class="thead-color text-center">S.No</th>
                  <th class="thead-color">Employee Name</th> 
                  <th class="thead-color">Designation</th>  
                  <th class="thead-color text-center">Working<br>Days</th>  
                  <th class="thead-color text-center">Present<br>Days</th>  
                  <th class="thead-color text-center">Absent<br>Days</th>  
                  <?php for ($i=1; $i <= $total_days; $i++) { 
                    $date = $year.'-'.$month.'-'.$i;
                    ?>
                    <th  class="thead-color text-center"><?php echo $i.'<br> '.date("D", strtotime($date)); ?></th>
                  <?php } ?>    
                </tr>
              </thead>
              <tbody>
                  <?php
                  foreach ($attendaceData as $key => $value) {  ?>
                      <tr>
                          <td class="text-center"><?php echo $key + 1; ?></td>
                          <td><?php  
                          $full_name = $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME'];
                           echo strlen($full_name) > 21 ? substr($full_name,0,21)."..." : $full_name;?></td>
                          <td><?php echo $value['DESIGNATION_NAME']; ?></td>
                          <td class="text-center"><?php echo $value['total_working_days']; ?></td>
                          <td class="text-center"><?php echo sprintf('%g',$value['total_present']); ?></td>
                          <td class="text-center"><?php echo sprintf('%g',$value['total_absent']); ?></td>
                          <?php for ($i=1; $i <= $total_days; $i++) { ?>
                           <?php 
                              if($value[$i.'c'] == 'P' || $value[$i.'c'] =='HF'||$value[$i.'c'] == 'ELW')
                              {
                                echo '<td class="text-center"><span style="color:#418530;">'.$value[$i.'c'].'</span></td>';
                              }elseif($value[$i.'c'] == 'CL' || $value[$i.'c'] =='ML'||$value[$i.'c'] == 'EL'||$value[$i.'c'] == 'DDL'||$value[$i.'c'] == 'LWP')
                              {
                                echo '<td class="text-center" style="background:#cae3e1;"><span style="color:#8a3e46;">'.$value[$i.'c'].'</span></td>';
                              }
                              elseif($value[$i.'c']=='H')
                              {
                                echo '<td class="text-center thead-color"><span style="color:#000000;">'.$value[$i.'c'].'</span></td>';
                              }
                              else
                              {
                                echo '<td class="text-center"><span style="color:#de162a;">'.$value[$i.'c'].'</span></td>';
                              }

                             ?>
                          <?php } ?> 
                      </tr>
                  <?php 
                } ?>
              </tbody>
            </table>
          </div>
          <br>
          <div>
            <center>
            <table>
              <tr>
                <td>
                <strong>P</strong> = Present, 
                <strong>HF</strong> = Half Day,
                <strong>ELW</strong> = Early Leave from Work, 
                <strong>CL</strong> = Casual Leave, 
                <strong>ML</strong> = Medical Leave,
                <strong>EL</strong> = Earned Leave, 
                <strong>DDL</strong> = Deferred Day Leave, 
                <strong>H</strong> = Holiday, 
                <strong>AB</strong> = Absent</td>
              </tr>
            </table>
          </center>
          </div>
</div>
</body>
</html>