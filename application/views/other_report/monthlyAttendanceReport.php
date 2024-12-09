 <style type="text/css">
     .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
  .table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    color: black;
    font-size: 11px;
}
table {
  font-size: 11px;
}
.thead-color{
    background: #abb0ac !important;
    font-weight: bold;
  }

 </style>
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    <h1 style="text-align: center;">Monthly Attendance Register</h1><hr>
   <form id="searchForm" method="post" action="<?php echo base_url('payroll_other_report/attendance_report'); ?>">
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label>Month and Year</label><span class="req"> *</span>
              <input type="text" name="date" class="form-control datepicker" id="date" autocomplete="off" value="<?php echo set_value('date'); ?>" required="">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label></label>
              <button type="submit" class="btn btn-success form-control" name="search"><i class="fa fa-search"></i> Search</button>
            </div>
          </div>
        </div>
      </form>
      <hr>
     
      <?php if(isset($contentShow)){ ?>
        <center>
            <a href="<?php echo base_url('payroll_other_report/attendance_report/generateMonthlyAttenReportPDF/'.$year.'/'.$month); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate and View Report</a>
        </center>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
              <thead>
                <tr>
                  <th class="text-center thead-color">S.No</th>
                  <th class="text-center thead-color">Employee Name</th>  
                  <th class="text-center thead-color">Designation</th>  
                  <th class="text-center thead-color">Working<br>Days</th>  
                  <th class="text-center thead-color">Present<br>Days</th>  
                  <th class="text-center thead-color">Absent<br>Days</th>  
                  <?php for ($i=1; $i <= $total_days; $i++) { 
                    $date = $year.'-'.$month.'-'.$i;
                    ?>
                    <th class="text-center thead-color"><?php echo $i.'<br> '.date("D", strtotime($date)); ?></th>
                  <?php } ?>    
                </tr>
              </thead>
              <tbody>
                  <?php 
                  foreach ($attendaceData as $key => $value) {  ?>
                      <tr>
                          <td class="text-center"><?php echo $key + 1; ?></td>
                          <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                          <td><?php echo $value['DESIGNATION_NAME']; ?></td>
                          <td class="text-center"><?php echo $value['total_working_days']; ?></td>
                          <td class="text-center"><?php echo sprintf('%g',$value['total_present']); ?></td>
                          <td class="text-center"><?php echo sprintf('%g',$value['total_absent']); ?></td>
                          <?php for ($i=1; $i <= $total_days; $i++) { ?>
                            <?php 
                              if($value[$i.'c'] == 'P' || $value[$i.'c'] =='HF'||$value[$i.'c'] == 'ELW')
                              {
                                echo '<td class="text-center"><strong><span style="color:#418530;">'.$value[$i.'c'].'</span></strong></td>';
                              }elseif($value[$i.'c'] == 'CL' || $value[$i.'c'] =='ML'||$value[$i.'c'] == 'EL'||$value[$i.'c'] == 'DDL'||$value[$i.'c'] == 'LWP')
                              {
                                echo '<td class="text-center" style="background:#cae3e1;"><strong><span style="color:#8a3e46;">'.$value[$i.'c'].'</span></strong></td>';
                              }
                              elseif($value[$i.'c']=='H')
                              {
                                echo '<td class="text-center thead-color"><strong><span style="color:#000000;">'.$value[$i.'c'].'</span></strong></td>';
                              }
                              else
                              {
                                echo '<td class="text-center"><strong><span style="color:#de162a;">'.$value[$i.'c'].'</span></strong></td>';
                              }

                             ?>
                          <?php } ?> 
                      </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
          <div>
            <table class="table">
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
          </div>
          <br>
          <br>
      <?php }else{  ?>

        <?php if($this->session->flashdata('msg')){
          echo $this->session->flashdata('msg');
        } } ?>
</div><br>
<script type="text/javascript">
        $(function () {
        $('.datatable').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : true,
          'pageLength'  : 25,
          dom: 'Bfrtip',
          buttons: [
              {
                extend: 'excelHtml5',
                title: 'Employee Report',
                              
              },
          ],
        })
      });

    $('.datepicker').datepicker({
      format: "M-yyyy",
      autoclose: true,
      startView: "months", 
    minViewMode: "months"
    });
</script>