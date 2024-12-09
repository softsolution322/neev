 <style type="text/css">
     .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    color: black;
    font-size: 11px;
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
    <b>Monthly Salary Bill Report</b>
      <hr>
     <form id="searchForm" method="post" action="<?php echo base_url('salary_report/salary_bill'); ?>">
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
        <center>
          <a href="<?php echo base_url('salary_report/salary_bill/generateSalaryPDFReport/'.$year.'/'.$month); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate or Print Report</a>
          <a href="<?php echo base_url('salary_report/salary_bill/generateSalaryRegisterPDFReport/'.$year.'/'.$month); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate Salary Register Report</a></center>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
              <thead id="header-fixed">
                <tr> 
                 <th colspan="5" class="text-center thead-color"></th>
                  <th colspan="7" class="text-center thead-color">Allowance</th>
                  <th colspan="6" class="text-center thead-color">Arrear</th>
                  <th class="text-center thead-color"></th>
                  <th colspan="12" class="text-center thead-color">Deduction</th>
                  <th class="text-center thead-color"></th>
                  <th class="text-center thead-color"></th>
                </tr>
                <tr>
                  <th class="text-center thead-color">S.No</th>
                  <th class="text-center thead-color">Employee Name</th>   
                  <th class="text-center thead-color">Designation</th>  
                  <th class="text-center thead-color">Working<br> Days</th>  
                  <th class="text-center thead-color">Present<br> Days</th>   
                  <th class="text-center thead-color">Actual<br>Basic</th>   
                  <th class="text-center thead-color">Basic<br>Payable</th>   
                  <th class="text-center thead-color">DA</th>   
                  <th class="text-center thead-color">HRA</th>   
                  <th class="text-center thead-color">TA</th>   
                  <th class="text-center thead-color">Fixed<br>Allow.</th>   
                  <th class="text-center thead-color">Shift<br>Allow.</th>   
                  <th class="text-center thead-color">Basic</th>   
                  <th class="text-center thead-color">DA</th>   
                  <th class="text-center thead-color">HRA</th>     
                  <th class="text-center thead-color">TA</th>   
                  <th class="text-center thead-color">Fixed<br>Allow.</th>   
                  <th class="text-center thead-color">Shift<br>Allow.</th>   
                  <th class="text-center thead-color">Gross<br>Payable</th>   
                  <th class="text-center thead-color">EPF</th>   
                  <th class="text-center thead-color">FPF</th>   
                  <th class="text-center thead-color">VPF</th>   
                  <th class="text-center thead-color">ESI</th>   
                  <th class="text-center thead-color">Prof.<br>Tax</th>   
                  <th class="text-center thead-color">LIC</th> 
                  <th class="text-center thead-color">House<br>Rent</th> 
                  <th class="text-center thead-color">Group<br>Ins.<br> Amt</th>   
                  <th class="text-center thead-color">Staff<br>Wel.<br>Fund</th>   
                  <th class="text-center thead-color">TDS</th>   
                  <th class="text-center thead-color">Medical</th>   
                  <th class="text-center thead-color">Advance<br>Salary</th>   
                  <th class="text-center thead-color">Total<br>Deduction</th>   
                  <th class="text-center thead-color">Payable<br>Amount</th>   
                </tr>
              </thead>
              <tbody>
                  <?php 
                  foreach ($resultList as $key => $value) {  ?>
                      <tr>
                        <td style="text-align: center;"><?php echo $key + 1; ?></td>
                        <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
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