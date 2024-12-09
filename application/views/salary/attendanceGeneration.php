<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    font-size: 11px;
  }
  .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
  .error{
    color: red;
   }
.loader {
  position: fixed;
  top: 50%;
  left: 50%;
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
  z-index: 999;
}
.thead-color{
background: #337ab7 !important; color: white !important;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@media print {
  .hide-print {
    display: none;
  }
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('employee/employee'); ?>">Monthly Entries</a> <i class="fa fa-angle-right"></i> Attendance Generation</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg')){
                      echo $this->session->flashdata('msg');
                    } ?>
                    <div class="alert alert-warning">* Warning: Please Generate Only Previous Month Attendance Not Current Month or Future Month Attendance</div>
                    <form id="searchForm" method="post" action="<?= base_url('payroll/salary/attendance_gen'); ?>">
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Shift</label><span class="req"> *</span>
                            <select class="form-control" name="shift" id="shift">
                              <option value="">Select Shift</option>
                              <?php foreach ($shiftList as $key => $value) { ?>
                                <option value="<?php echo $value['ID']; ?>" <?php if(set_value('shift') == $value['ID']){echo "selected"; } ?>><?php echo $value['SHIFT_NAME'].' '.$value['START_TIME'].' TO '.$value['STOP_TIME']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>End Date of Month</label><span class="req"> *</span>
                            <input type="text" name="date" class="form-control datepicker" id="date" autocomplete="off" value="<?php echo set_value('date'); ?>">
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Weekend Date</label><span class="req"> *</span> <a href="#" data-toggle="tooltip" title="You can select Multiple Weekend Date" data-placement="right"> <i class="fa fa-question-circle"></i></a>
                            <input type="text" name="weekend" class="form-control mutlidatepicker" id="weekend" autocomplete="off" value="<?php echo set_value('weekend'); ?>">
                          </div>
                        </div> 
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label></label>
                            <button type="submit" class="btn btn-success form-control search_btn" name="search"><i class="fa fa-search"></i> Search</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <hr>
                    <?php if(isset($result)){ ?>
                      <div class="row text-center monthly_attendance">
                        <div class="col-sm-12">
                          <strong><?php echo date('M', strtotime(date($current_year.'-'. $current_month .'-d'))).'-'.$current_year; ?> Attendance Generation</strong>
                        </div>
                      </div>
                      <hr>
                      <div class="row monthly_attendance">
                        <div class="col-sm-12 text-center">
                          Present : <span class="label label-success">P</span>, 
                          Early Leave From Work : <span class="label label-danger">P</span>, 
                          Half Day : <span class="label label-success">HF</span>, 
                          Leave Without Pay : <span class="label label-info">LWP</span>, 
                          Leave : <span class="label label-success">CL, ML, EL, DDL</span>, 
                          Holiday : <span style="background-color:#ffd3f1 !important;padding: 5px !important;font-weight:bold !important;">H</span>, 
                        </div>
                      </div>
                      <hr>
                      <div class="row monthly_attendance">
                        <div class="col-sm-12 text-center">
                          TWD = Total Working Days, TPD = Total Present Days, TAD = Total Absent Days
                        </div>
                      </div><hr>
                      <div  id="printableArea" class="monthly_attendance">
                        <form id="attendanceList" onsubmit="return checkEmpData()" action="<?php echo base_url('payroll/salary/attendance_gen/generateMonthlyAttendance'); ?>" method="post">
                          <input type="hidden" name="shift_id" id="selected_shift_id" value="<?php echo $shift_id; ?>">
                          <input type="hidden" name="weekend_set" id="weekend_set" value="<?php echo $all_weekend_date; ?>">
                          <input type="hidden" name="current_year" value="<?php echo $current_year; ?>">
                          <input type="hidden" name="current_month" value="<?php echo $current_month; ?>">
                          <input type="hidden" name="total_days" value="<?php echo $total_days; ?>">
                          <div class="table-responsive" style="height: 500px;">
                            <table class="table table-bordered dataTable table-striped table-hover">
                              <thead>
                                <tr>
                                  <th><input type="checkbox" id="checkAll"></th>
                                  <th class="text-center thead-color">EMPID</th>
                                  <th class="text-center thead-color">Employee NAME</th>                      
                                  <th class="text-center thead-color">TWD</th>   
                                  <th class="text-center thead-color">TPD</th>   
                                  <th class="text-center thead-color">TAD</th>   
                                  <?php for ($i=1; $i <= $total_days; $i++) { 
                                    $date = $current_year.'-'.$current_month.'-'.$i;
                                    ?>
                                    <th class="text-center thead-color"><?php echo $i.'<br> '.date("D", strtotime($date)); ?></th>
                                  <?php } ?>                   
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($result as $key => $value) {  ?>
                                    <tr>
                                      <td><input type='checkbox' name='emp_id[]' class='checkEmp' value="<?php echo $value['id']; ?>" onclick='checkEmp()'></td>
                                      <td><?php echo $value['emp_id']; ?></td>
                                      <td><?php echo $value['emp_name']; ?></td>
                                      <td class="text-center"><?php echo $value['total_days']; ?></td>
                                      <td class="text-center"><?php echo $value['total_present']; ?></td>
                                      <td class="text-center"><?php echo $value['total_days'] - $value['total_present']; ?></td>

                                      <?php for ($i=0; $i < $total_days; $i++) { 
                                        $j = $i + 1;
                                        if($j < 10)
                                        {
                                          $j = '0'.$j;
                                        }
                                        $date = $current_year.'-'.$current_month.'-'.$j;
                                        ?>

                                         <td class="result_output_<?php echo $value['id'].'_'.$i; ?>"><?php if($value[$i] === 'P') { ?>

                                            <span class='label label-success' data-toggle='tooltip' title="<?php echo $date."Present"; ?>"  onclick='funApprove(<?php echo $value['id'].',"'.$date.'",'.'"Present"'; ?>)'><?php echo $value[$i]; ?></span>

                                        <?php }elseif($value[$i] === 'ELW') { ?>

                                            <span class='label label-danger' data-toggle='tooltip' title="<?php echo $date; ?> Early Leave From Work"  onclick='funApprove(<?php echo $value['id'].',"'.$date.'",'.'"Early Leave From Work"'; ?>)'><?php echo $value[$i]; ?></span>

                                        <?php  }elseif($value[$i] === 'HF') { ?>

                                            <span class="label label-success" data-toggle='tooltip' title="<?php echo $date; ?> Half Day"  onclick='funApprove(<?php echo $value['id'].',"'.$date.'",'.'"Half Day"'; ?>)'><?php echo $value[$i]; ?></span>

                                        <?php  }elseif($value[$i] === 'H') { ?>

                                            <span style="background-color:#ffd3f1 !important;padding: 5px !important;font-weight:bold !important;"  data-toggle='tooltip' title="<?php echo $date; ?> Holiday"  onclick='funApprove(<?php echo $value['id'].',"'.$date.'",'.'"Holiday"'; ?>)'><?php echo $value[$i]; ?></span>

                                        <?php }elseif($value[$i] === 'LWP') { ?>

                                            <span class='label label-info' data-toggle='tooltip' title="<?php echo $date; ?> Leave Without Pay"  onclick='funApprove(<?php echo $value['id'].',"'.$date.'",'.'"Leave Without Pay"'; ?>)'><?php echo $value[$i]; ?></span>

                                        <?php }elseif($value[$i] === 'EL' || $value[$i] === 'CL' || $value[$i] === 'ML' || $value[$i] === 'DDL') {?>

                                            <span class='label label-success' data-toggle='tooltip' title="<?php echo $date; ?> Leave"  onclick='funApprove(<?php echo $value['id'].',"'.$date.'",'.'"Leave"'; ?>)'><?php echo $value[$i]; ?></span>

                                        <?php }elseif($value[$i] === 'AB') { ?>

                                            <span style="color:#a80d0d !important;font-weight:bold !important;" data-toggle='tooltip' title="<?php echo $date; ?> Absent"  onclick='funApprove(<?php echo $value['id'].',"'.$date.'",'.'"Absent"'; ?>)'><?php echo $value[$i]; ?></span>

                                        <?php } ?></td>
                                      <?php } ?> 
                                    </tr>
                                <?php } ?>
                              </tbody>
                            </table>   
                          </div> 
                          <br>
                          <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Generate</button>
                        </form>
                      </div>
                    <?php } ?>
                  </div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div>
<br><br>

<!--edit Modal-->
<div class="modal fade" id="approvalModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Details</h4>
      </div>
      <form id="detailsForm">
        <input type="hidden" name="employee_id" id="employee_id">
        <input type="hidden" name="selected_date_input" id="selected_date_input">
        <div class="modal-body">
          <table class="table table-striped table-hover table-bordered">
            <tr>
              <th>Attendance Date :</th>
              <td><span class="custom_date_modal"></span></td>
            </tr>
            <tr>
              <th>EMPID :</th>
              <td><span class="empid_modal"></span></td>
            </tr>
            <tr>
              <th>Employee Name :</th>
              <td><span class="emp_name_modal"></span></td>
            </tr>
            <tr>
              <th>Attendance Status :</th>
              <td style="background: black;color: white;"><span class="atten_status_modal"></span></td>
            </tr>
            <tr>
              <th>Minimum Working Hours For Full Day :</th>
              <td><span class="min_hour_full"></span></td>
            </tr>
            <tr>
              <th>Minimum Working Hours For Half Day :</th>
              <td><span class="min_hours_half"></span></td>
            </tr>
            <tr>
              <th>Working Hours :</th>
              <td><span class="working_hour"></span></td>
            </tr>
          </table>
          <br>
          <div class="row"> 
            <div class="col-sm-12">
              <div class="form-group">
              <label>Pay Type</label><span class="req">*</span>
              <div class="pay_type_row">
                
              </div>
            </div>
            </div> 
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="update_btn">Update</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="loader"></div>
 <script type="text/javascript">
$('.loader').hide();

$('.dataTable').dataTable({
      "bDestroy": true,
       "ordering": false,
       "paging": false,
        dom: 'Bfrtip',
        buttons: [
            {
              extend: 'excelHtml5',
              title: 'Monthly Attendance Generation',
                            
            },
        ],
    });

 //add checkbox
    $('#checkAll').click(function(){
        
          if($(this).prop("checked")) {
            if(confirm('Do you want to generate all employee attendance'))
            {
              $(".checkEmp").prop("checked", true);
            }
            else
            {
              $(this).prop("checked",false);
            }
          } else {
              $(".checkEmp").prop("checked", false);
          }              
    });

    function checkEmp()
    {
        if($(".checkEmp").length == $(".checkEmp:checked").length) {
            $("#checkAll").prop("checked", true);
        }else {
            $("#checkAll").prop("checked", false);            
        }
    }

    function checkAllCheckBox()
    {
      if($(".checkEmp").length == $(".checkEmp:checked").length) {
          $("#checkAll").prop("checked", true);
      }else {
          $("#checkAll").prop("checked", false);            
      }
    }


var st_date = '<?php echo $current_year.'-'.$current_month.'-1'; ?>';
var end_dt = '<?php echo $current_year.'-'.$current_month.'-'.$total_days; ?>';
var startDate = new Date(st_date);
var endDate = new Date(end_dt);

$(".datepicker").datepicker({
 format: 'dd-M-yyyy',
    autoclose: true,
   startDate: startDate,
   endDate: endDate
});

$('.mutlidatepicker').datepicker({
  multidate: true,
  format: 'dd-M-yyyy',
  startDate: startDate,
   endDate: endDate,
});


//validation
$(document).ready(function () {
    $('#detailsForm').validate({ // initialize the plugin
        rules: {
            pay_type: {
                required: true
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

//validation
$(document).ready(function () {
    $('#searchForm').validate({ // initialize the plugin
        rules: {
            shift: {
                required: true
            },
            date: {
                required: true
            },
            weekend: {
                required: true
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});


$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});

 $( document ).ajaxComplete(function() {
            // Required for Bootstrap tooltips in DataTables
            $('[data-toggle="tooltip"]').tooltip({
                "html": true,
                "delay": {"show": 10, "hide": 0},
            });
        });

 $('.select2').select2();


function funApprove(emp_id,selected_date,status)
{
  var shift_id = $('#selected_shift_id').val();
  var month = '<?php echo $current_month; ?>';
  var year = '<?php echo $current_year; ?>';
  $.ajax({
      url: "<?php echo base_url('payroll/salary/attendance_gen/checkAttendanceGenerated'); ?>",
      type: "POST",
      data: {emp_id:emp_id,selected_date:selected_date,shift_id:shift_id,month:month,year:year},
      dataType: 'json',
      beforeSend:function()
      {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(response.msg == 2)
        {
          swal({title: "Please Generate Attendance First", text: "Please Generate Attendance First", type: "info"});
        }
        else
        {
          $('#approvalModal').modal({
            backdrop: 'static',
            keyboard: false
          });

          $('.custom_date_modal').html(selected_date);
          $('.empid_modal').html(response.EMPID);
          $('#employee_id').val(response.id);
          $('#selected_date_input').val(selected_date);
          $('.emp_name_modal').html(response.EMP_FNAME +' '+response.EMP_MNAME+' '+response.EMP_LNAME);
          $('.atten_status_modal').html(status);
          $('.min_hours_half').html(response.shift.MIN_HRS_HALF);
          $('.min_hour_full').html(response.shift.MIN_HRS_FULL);
          $('.working_hour').html(response.work_dur.tot_duration);

          $('.pay_type_row').html('<div class="form-group">'+
                '<div class="row alert alert-danger">'+
                  '<div class="col-sm-4">'+
                    '<label>'+
                      '<input type="radio" class="flat-red pay_type" name="pay_type" value="P">Full Day'+
                    '</label>'+
                  '</div>'+
                  '<div class="col-sm-4">'+
                    '<label>'+
                      '<input type="radio" class="flat-red pay_type" name="pay_type" value="HF">Half Day'+
                    '</label>'+
                  '</div>'+
                  '<div class="col-sm-4">'+
                    '<label>'+
                      '<input type="radio" class="flat-red pay_type" name="pay_type" value="LWP">No Pay'+
                    '</label>'+
                  '</div>'+
              '</div>'+
              '</div>');
          
        }
      }
    });
}

function checkEmpData()
{
  var emp_id = [];
  $.each($("input[name='emp_id[]']:checked"), function(){ 
      emp_id.push($(this).val());
  });
  if(emp_id != '')
  {
    return confirm("Do you want to generate attendance?");
  }
  else
  {
    alert('Please Select Employee First');
    return false;
  }  
}


//update 
 $("#update_btn").on("click", function(event){
  $("#detailsForm").validate();
  if ($('#detailsForm').valid())
  {
  var pay_type = $("input[name='pay_type']:checked").val();
  var shift_id = $('#selected_shift_id').val();
  var employee_id = $('#employee_id').val();
  var selected_date = $('#selected_date_input').val();
  var sel_date = new Date(selected_date);
  var column_name = sel_date.getDate();
  var month = '<?php echo $current_month; ?>';
  var year = '<?php echo $current_year; ?>';
  var leave_attendance_id = $('#leave_attendance_id').val();
    event.preventDefault();
     $.ajax({
      url: "<?php echo base_url('payroll/salary/attendance_gen/updateSingleDate'); ?>",
      type: "POST",
      data: {month:month,year:year,column_name:column_name,pay_type:pay_type,shift_id:shift_id,employee_id:employee_id,leave_attendance_id:leave_attendance_id},
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(response.msg == 1)
        {
          $('#detailsForm')[0].reset();
          $('#approvalModal').modal('hide');
          $('.result_output_'+employee_id+'_'+Number(column_name - 1)).html(pay_type);
          swal({title: "Updated Successfully", text: "Updated Successfully", type: "success"});     
        }
        else
        {
          $('#detailsForm')[0].reset();
            $('#approvalModal').modal('hide');
            swal({title: "Updation Failed!", text: "Updation Failed!", type: "error"});     
        }
      }
    });
   }
});
  </script>