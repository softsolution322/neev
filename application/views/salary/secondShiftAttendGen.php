 <style type="text/css">
   .error{
    color: red;
   }
   .box-header>.box-tools {
        position: relative;
    }
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
 </style>
 <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('employee/employee'); ?>">Monthly Entries</a> <i class="fa fa-angle-right"></i> Second Shift Attendance Generation</li>
</ol>
 <div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
   <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="box box-primary">
              <!-- /.box-header -->
              <div class="box-body">
                <?php if($this->session->flashdata('msg')){ 
                  echo $this->session->flashdata('msg');
                 } ?>
                    <div class="table-responsive">
                      <h4 class="text-center"><strong><?php echo date('M', strtotime(date($current_year.'-'. $current_month .'-d'))).'-'.$current_year; ?> Attendance Generation</strong></h4><hr>
                      <form method="post" action="<?php echo base_url('payroll/salary/second_shift/attendanceGen'); ?>">
                        <input type="hidden" name="current_month" value="<?php echo $current_month; ?>">
                        <input type="hidden" name="current_year" value="<?php echo $current_year; ?>">
                        <table class="table table-striped table-bordered">
                          <thead id="header-fixed">
                            <tr>
                              <th style="background: #337ab7 !important; color: white !important;">EMPID</th>
                              <th style="background: #337ab7 !important; color: white !important;">Employee Name</th>
                              <th style="background: #337ab7 !important; color: white !important;">Designation</th>
                              <th style="background: #337ab7 !important; color: white !important;">No of Classes</th>
                              <th style="background: #337ab7 !important; color: white !important;">Amt Per Class</th>
                              <th style="background: #337ab7 !important; color: white !important;">Total Amt</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if(!empty($empData)) { ?>
                              <?php foreach ($empData as $key => $value) { ?>
                                <tr>
                                  <td><?php echo $value['EMPID']; ?></td>
                                  <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                                  <td><?php echo $value['DESIG']; ?></td>
                                  <td><input type="number" name="no_of_classes_<?php echo $key; ?>" id="no_of_classes_<?php echo $key; ?>" required="" value="<?php echo set_value('no_of_classes_'.$key,$value['no_of_classes']); ?>" onblur="calculateFun('<?php echo $key; ?>')"></td>
                                  <td><input type="text" name="amount_per_class_<?php echo $key; ?>" id="amount_per_class_<?php echo $key; ?>" required="" value="<?php echo set_value('amount_per_class_'.$key,$value['amt_per_class']); ?>" onblur="calculateFun('<?php echo $key; ?>')"></td>
                                  <td><input type="text" name="total_amt_<?php echo $key; ?>" id="total_amt_<?php echo $key; ?>" required="" value="<?php echo set_value('total_amt_'.$key,$value['total_amt']); ?>" readonly=""></td>
                                </tr>
                              <?php } ?>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><button class="btn btn-success pull-right"><i class="fa fa-save" style="color: white;"></i> Save</button></td>
                              </tr>
                            <?php } else { ?>
                              <tr>
                                <td colspan="6" class="text-center">No Data Available</td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </form>
                    </div>
                    <br>
                    <button type="button" class="btn btn-success pull-right details-table" style="display: none;" onclick="generatePaySlip()"><i class="fa fa-save"></i> Generate</button>
              </div>
            </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div><br><br>

<script type="text/javascript">
  function calculateFun(key)
  {
    var no_of_class = $('#no_of_classes_'+key).val();
    var amt_per_class = $('#amount_per_class_'+key).val();
    $('#total_amt_'+key).val(Number(no_of_class) * Number(amt_per_class));
  }
</script>