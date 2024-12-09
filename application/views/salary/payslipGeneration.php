 <style type="text/css">
   .error{
    color: red;
   }
   .box-header>.box-tools {
        position: relative;
       
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
      }
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.thead-color{
background: #337ab7 !important; color: white !important;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    font-size: 12px;
    padding: 5px;
    white-space: nowrap;
  }

 </style>
 <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('employee/employee'); ?>">Monthly Entries</a> <i class="fa fa-angle-right"></i> Payslip Generation</li>
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
                 <form id="searchForm">
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>End Date of Month</label><span class="req"> *</span>
                            <input type="text" name="date" class="form-control datepicker" id="date" autocomplete="off" >
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label></label>
                            <button type="button" class="btn btn-success form-control search_btn" onclick="getEmployeeData()"><i class="fa fa-search"></i> Search</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <hr>
                    <div class="table-responsive details-table" style="height: 500px;display: none;">
                      <table class="table table-striped table-bordered dataTable">
                        <thead id="header-fixed">
                          <tr> 
                           <th colspan="6" class="text-center thead-color"></th>
                            <th colspan="7" class="text-center thead-color">Allowance</th>
                            <th class="text-center thead-color"></th>
                            <th colspan="12" class="text-center thead-color">Deduction</th>
                            <th class="text-center thead-color"></th>
                            <th colspan="6" class="text-center thead-color">Arrear</th>
                            <th class="text-center thead-color"></th>
                          </tr>
                          <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th class="thead-color">S.No</th>
                            <th class="thead-color">Employee ID</th>  
                            <th class="thead-color">Employee NAME</th>  
                            <th class="thead-color">W.<br>Days</th>  
                            <th class="thead-color">Pr.<br> Days</th>   
                            <th class="thead-color">Actual<br>Basic</th>   
                            <th class="thead-color">Basic<br>Payable</th>   
                            <th class="thead-color">DA</th>   
                            <th class="thead-color">HRA</th>   
                            <th class="thead-color">TA</th>   
                            <th class="thead-color">Fixed <br>Allow.</th>   
                            <th class="thead-color">Shift <br>Allow.</th>   
                            <th class="thead-color">Gross <br>Payable</th>   
                            <th class="thead-color">EPF</th>   
                            <th class="thead-color">FPF</th>   
                            <th class="thead-color">VPF</th>   
                            <th class="thead-color">ESI</th>   
                            <th class="thead-color">Prof. Tax</th>   
                            <th class="thead-color">LIC</th> 
                            <th class="thead-color">HR</th> 
                            <th class="thead-color">Group <br>Ins.<br>Amt</th>   
                            <th class="thead-color">Staff<br> Welfare<br>Fund</th>   
                            <th class="thead-color">TDS</th>   
                            <th class="thead-color">Medical</th>   
                            <th class="thead-color">Adv.<br>Salary</th>   
                            <th class="thead-color">Total <br>Deduction</th>   
                            <th class="thead-color">Basic</th>   
                            <th class="thead-color">DA</th>   
                            <th class="thead-color">HRA</th>     
                            <th class="thead-color">TA</th>   
                            <th class="thead-color">Fixed <br>Allow.</th>   
                            <th class="thead-color">Shift <br>Allow.</th>   
                            <th class="thead-color">Payable<br>Amount</th>   
                          </tr>
                        </thead>

                         <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><i class="fa fa-inr"></i> <span id="grossSalary"></span></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><i class="fa fa-inr"></i> <span id="totaldeduction"></span></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><i class="fa fa-inr"></i> <span id="payableamount"></span></th>
                            </tr>
                        </tfoot>
                      </table>
                    </div>
                    <br>
                      <button type="button" class="btn btn-danger pull-left details-table" style="display: none;" onclick="updationLock()"><i class="fa fa-lock"></i> Updation Lock</button>

                    <button type="button" class="btn btn-success pull-right details-table" style="display: none;" onclick="generatePaySlip()"><i class="fa fa-save"></i> Generate</button>
              </div>
            </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div><br><br>

<!--Pay Control Modal-->
<div class="modal fade" id="payControlModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pay Control Master</h4>
      </div>
      <form id="detailsForm">
        <input type="hidden" name="employee_id_pf" id="employee_id_pf">
        <div class="modal-body">
          <table class="table table-striped table-hover table-bordered">
            <tr>
              <th>EMPID :</th>
              <td><span class="empid_pf_modal"></span></td>
            </tr>
            <tr>
              <th>Employee Name :</th>
              <td><span class="emp_name_pf_modal"></span></td>
            </tr>
            <tr>
              <th><span class="field_name_pf"></span></th>
              <td><input type="text" class="form-control field_input_pf"></td>
            </tr>
          </table>
          <br>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="update_btn_paycontrol">Update</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!--Pay Control Modal-->
<div class="modal fade" id="lockModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <h4 class="modal-title">Unlock</h4>
      </div>
      <form id="otpform">
        <div class="modal-body">
          <table class="table table-striped table-hover table-bordered">
            <tr>
              <th>Mobile No :</th>
              <td><?php echo $schoolSetting['School_MobileNo']; ?></td>
            </tr>
            <tr>
              <th>OTP :</th>
              <td><input type="number" class="form-control" min="1" maxlength="6" minlength="6" required="" name="otptext"></td>
            </tr>
          </table>
          <br>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="verifyOTP()">Unlock</button>
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

  //add checkbox
    $('#checkAll').click(function(){
        
          if($(this).prop("checked")) {
            if(confirm('Do you want to generate all employee pay slip'))
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
    $('#otpform').validate({ // initialize the plugin
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});


function getEmployeeData()
{
  $("#searchForm").validate();
  if ($('#searchForm').valid())
  {
    var date = $('#date').val();
    $('.dataTable').dataTable({
      "ajax": {
            "url": '<?= base_url('payroll/salary/payslip_gen/getEmployeeData'); ?>',
            "type": "POST",
            "data": {date:date},
        },
        'order':[],
        "bDestroy": true,
         "ordering": false,
         "paging": false,
         select: true,
          dom: 'Bfrtip',
          buttons: [
              {
                extend: 'excelHtml5',
                title: 'Monthly Payslip Generation',
                              
              },
          ],
          "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;  
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ?  i : 0;
            };

            // total_salary over all pages
            // gross_salary = api.column( 12 ).data().reduce( function (a, b) {
            //     return intVal(a) + intVal(b);
            // },0 );

            //  total_deduction = api.column(25).data().reduce( function (a, b) {
            //     return intVal(a) + intVal(b);
            // },0 );

            //   payable_amount = api.column(32).data().reduce( function (a, b) {
            //     return intVal(a) + intVal(b);
            // },0 );


            // total_page_salary over this page
            gross_page_salary = api.column( 13, { page: 'current'} ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

            total_deduction_page = api.column( 26, { page: 'current'} ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

            payable_amount_page = api.column( 33, { page: 'current'} ).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

           



            gross_page_salary = parseFloat(gross_page_salary);
            // gross_salary = parseFloat(gross_salary);

             total_deduction_page = parseFloat(total_deduction_page);
            // total_deduction = parseFloat(total_deduction);

            payable_amount_page = parseFloat(payable_amount_page);
            // payable_amount = parseFloat(payable_amount);
            // Update footer
            $('#grossSalary').html(gross_page_salary.toFixed(2));               
            $('#totaldeduction').html(total_deduction_page.toFixed(2));               
            $('#payableamount').html(payable_amount_page.toFixed(2));               
        },      
    });
    $('.details-table').show();
  }
}

function payControl(emp_id,val,name,column_name)
{
  $.ajax({
    url: "<?php echo base_url('payroll/salary/payslip_gen/getSingleEmployeeData'); ?>",
    type: "POST",
    data: {emp_id:emp_id},
    dataType: 'json',
    beforeSend:function()
    {
      $('.loader').show();
      $('body').css('opacity', '0.5');
    },
    success: function(response){
      $('.loader').hide();
      $('body').css('opacity', '1.0');
      $('#payControlModal').modal({
        backdrop: 'static',
        keyboard: false
      });

        $('#employee_id_pf').val(response.id);
        $('.empid_pf_modal').html(response.EMPID);
        $('.emp_name_pf_modal').html(response.EMP_FNAME +' '+response.EMP_MNAME+' '+response.EMP_LNAME);
        $('.field_name_pf').html(name);
         $('.field_input_pf').attr("name",column_name);
        $('.field_input_pf').val(val);
    }
  });
  
}


//creating new shift
 $("#update_btn_paycontrol").on("click", function(event){

    var check_val = $('.field_input_pf').val();
    if(check_val != '')
    {
      var column_name =  $(".field_input_pf").attr("name");
      var input_val = $('.field_input_pf').val();
      var emp_id = $('#employee_id_pf').val();
        event.preventDefault();
         $.ajax({
          url: "<?php echo base_url('payroll/salary/payslip_gen/updateSinglePayControlData'); ?>",
          type: "POST",
          data: {column_name:column_name,input_val:input_val,emp_id:emp_id},
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
              $('#payControlModal').modal('hide');
              swal({title: "Updated Successfully", text: "Updated Successfully", type: "success"});     
              getEmployeeData();
            }
            else
            {
                swal({title: "Updation Failed!", text: "Updation Failed!", type: "error"});     
            }
          }
        });
    }
    else
    {
      alert('please fill all fields');
    }
});


 function generatePaySlip()
{
  var month = '<?php echo $current_month; ?>';
  var year = '<?php echo $current_year; ?>';
  var total_days = '<?php echo $total_days; ?>';
  var emp_id = [];
  $.each($("input[name='emp_data']:checked"), function(){            
      emp_id.push($(this).val());
  });
  if(emp_id != '')
  {
    if(confirm("Do you want to generate payslip?"))
    {
     $.ajax({
        url: "<?php echo base_url('payroll/salary/payslip_gen/generateMonthlyPayslip'); ?>",
        type: "POST",
        data: {emp_id:emp_id,month:month,year:year,total_days:total_days},
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
            swal({title: "Payslip Generated Successfully", text: "Payslip Generated Successfully", type: "success"});   
            getEmployeeData();
          }
          else
          {
            swal({title: "Payslip Generation Failed !", text: "Payslip Generation Failed !", type: "error"});   
          }
        }
      });
  }
   }
   else
   {
      alert('Please Select Employee First');
   }
}


$(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});

function updationLock()
{
  var month = '<?php echo $current_month; ?>';
  var year = '<?php echo $current_year; ?>';
  var emp_id = [];
  $.each($("input[name='emp_data']:checked"), function(){            
      emp_id.push($(this).val());
  });
  if(emp_id != '')
  {
    if(confirm("Do you want to Lock Updation? You are not able to update payslip after updation lock."))
    {
      $.ajax({
        url: "<?php echo base_url('payroll/salary/payslip_gen/updationLock'); ?>",
        type: "POST",
        data: {emp_id:emp_id,month:month,year:year},
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
            swal({title: "Updation Lock Successfully", text: "Updation Lock Successfully", type: "success"});   
            getEmployeeData();
          }
          else
          {
            swal({title: "Failed !", text: "Failed !", type: "error"});   
          }
        }
      });
    }
  }
  else
  {
    alert('Please Select Employee First');
  }
}


function checkPayslipGenerated()
{
  var current_year = "<?php echo $current_year; ?>";
  var current_month = "<?php echo $current_month; ?>";
  $.ajax({
    url:'<?php echo base_url('payroll/salary/payslip_gen/checkPayslipGenerated'); ?>',
    data:{current_month:current_month,current_year:current_year},
    type:"post",
    dataType:"json",
    success:function(response)
    {
      if(response.msg == 2)
      {
        swal({title: "Please generate payslip first", text: "Please generate payslip first", type: "warning"});
      }
      else
      {
        window.open("<?php echo base_url('payroll/salary/payslip_gen/generatePayslipPDF'); ?>", "_blank");
      }
    }
  });
}


// $(document).ready(function(){

//   var check = '<?php echo $this->session->userdata('unlocksuccess'); ?>';
//   if(check != 1)
//   {
//     $('#lockModal').modal({
//         backdrop: 'static',
//         keyboard: false
//       });
//       var mobile = '<?php echo $schoolSetting['School_MobileNo']; ?>';
//       $.post("<?php echo base_url('payroll/salary/payslip_gen/sendSMS'); ?>", {mobile: mobile}, function(result){
        
//       });
//     }
// });

 function verifyOTP()
 {
  $("#otpform").validate();
  if ($('#otpform').valid())
  {
    var otp = '<?php echo $this->session->userdata('msgpayslip'); ?>';
    $.ajax({
      url:'<?php echo base_url('payroll/salary/payslip_gen/verifyOTP'); ?>',
      data:$('#otpform').serialize(),
      type:"post",
      dataType:"json",
      success:function(response)
      {
        if(response.msg == 1)
        {
          location.reload();
        }
        else
        {
          alert('OTP is not valid. Please enter valid OTP');
        }
      }
    });
  }

}
  </script>
