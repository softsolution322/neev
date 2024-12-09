 <style type="text/css">
     .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    color: black;
    font-size: 12px;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
.thead-color{
  background: #abb0ac !important;
}
 </style>
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    <b>Monthly Salary Slip</b>
      <hr>
     <form id="searchForm" method="post" action="<?php echo base_url('salary_report/monthly_salary_slip'); ?>">
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
      <?php if(isset($resultList) && !empty($resultList)){ ?>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
              <thead id="header-fixed">
                <tr>
                  <th class="thead-color">Employee Name</th>
                  <th class="thead-color">Designation</th>
                  <th class="thead-color">Basic Pay</th>
                  <th class="thead-color">PF Joining Date</th>
                  <th class="thead-color">PF A/c No</th>
                  <th class="thead-color text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php 
                  foreach ($resultList as $key => $value) {  $eps_wages=0; ?>
                      <tr>
                        <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                        <td><?php echo $value['DESIG']; ?></td>
                        <td class="text-right"><?php echo $value['BASIC']; ?></td>
                        <td class="text-center"><?php 
                        if($value['PF_JOIN_DT'] != '')
                        {
                          echo date('d-M-Y',strtotime($value['PF_JOIN_DT']));
                        }
                         ?></td>
                        <td class="text-center"><?php echo $value['PF_AC_NO']; ?></td>
                        <td class="text-center">
                          <a href="<?php echo base_url('salary_report/monthly_salary_slip/generateSalarySlipPDF/'.$value['emp_id'].'/'.$year.'/'.$month); ?>" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-file-pdf-o" style="color: white;"></i> Generate Salary Slip</a>
                        </td>
                      </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
          <br>
      <?php } else { ?>
        <div class="row">
          <div class="col-sm-12">
            <?php if($this->session->flashdata('msg')){
              echo $this->session->flashdata('msg');
            } ?>
          </div>
        </div>
      <?php } ?>
          <br>
          <br>
</div>


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
                title: 'Montly PF Statement',
                              
              },
              {
                extend: 'pdfHtml5',
                title: 'Montly PF Statement',
                              
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