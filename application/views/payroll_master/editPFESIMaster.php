<style type="text/css">
   .error{
    color: red;
   }
</style>
 <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('payroll/master/pfesi'); ?>">PFESI Master</a> <i class="fa fa-angle-right"></i> Edit PFESI Master</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
   <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <form role="form" action="<?php echo base_url('payroll/master/pfesi/update/').$singleData['id']; ?>" method="post" id="myform">
            <div class="box box-primary">
              <!-- /.box-header -->
              <div class="box-body">
                <?php if($this->session->flashdata('msg')){ 
                  echo $this->session->flashdata('msg');
                 } ?>
                 <div class="alert alert-danger">* Note : % (Percentage of basic pay)</div>
                  <div class="row">
                    <div class="col-sm-2">
                      
                      <div class="form-group">
                        <label>Effective Date</label><span class="req">*</span>
                        <input type="text" name="effective_date" class="form-control datepicker" value="<?php echo set_value('effective_date',$singleData['ST_DATE']); ?>" readonly="">
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Employee PF Rate (%)</label>
                        <input type="text" name="employee_pf_rate" class="form-control" value="<?php echo set_value('employee_pf_rate',$singleData['OWN_RATE']); ?>" autocomplete="off">
                      </div>
                    </div>      
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Employer PF Rate (%)</label>
                        <input type="text" name="employer_pf_rate" class="form-control" value="<?php echo set_value('employer_pf_rate',$singleData['EMP_RATE']); ?>"  autocomplete="off">
                      </div>
                    </div>  
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>ESI Limit (Rs.)</label>
                        <input type="text" name="esi_limit" class="form-control" value="<?php echo set_value('esi_limit',$singleData['ESI_LIMIT']); ?>"  autocomplete="off">
                      </div>
                    </div>  
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>ESI Applied</label>
                        <select class="form-control" name="esi_applied">
                          <option value="1" <?php if(set_value('esi_applied',$singleData['ESI_Applied'])=='1'){echo "selected"; } ?>>True</option>
                          <option value="0" <?php if(set_value('esi_applied',$singleData['ESI_Applied'])=='1'){echo "selected"; } ?>>False</option>
                        </select>
                      </div>
                    </div>              
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Pension Rate (%)</label>
                        <input type="text" name="pension_rate" class="form-control" value="<?php echo set_value('pension_rate',$singleData['PEN_RATE']); ?>"  autocomplete="off">
                      </div>
                    </div>    
                   <!--  <div class="col-sm-3">
                      <div class="form-group">
                        <label>Pay Limit (Rs.)</label>
                        <input type="text" name="pay_limit" class="form-control" autocomplete="off"  value="<?php echo set_value('pay_limit',$singleData['PAY_LIMIT']); ?>">
                      </div>
                    </div>     -->
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>ESI Own Rate(Rs.)</label>
                        <input type="text" name="esi_own_rate" class="form-control" autocomplete="off" value="<?php echo set_value('esi_own_rate',$singleData['ESI_OWN_RATE']); ?>">
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>ESI EMP Rate (%)</label>
                        <input type="text" name="esi_emp_rate" class="form-control" autocomplete="off" value="<?php echo set_value('esi_emp_rate',$singleData['ESI_EMP_RATE']); ?>">
                      </div>
                    </div>      
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>DA Rate (%)</label>
                        <input type="text" name="da_rate" class="form-control" autocomplete="off" value="<?php echo set_value('da_rate',$singleData['da_rate']); ?>">
                      </div>
                    </div>    
                  </div>        
                  <div class="row">
                    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>TA Rate Slab1 (<i class="fa fa-inr"></i>)</label>
                        <input type="text" name="ta_rate_slab1" class="form-control" autocomplete="off" value="<?php echo set_value('ta_rate_slab1',$singleData['ta_rate_slab1']); ?>">
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>TA Rate Slab2 (<i class="fa fa-inr"></i>)</label>
                        <input type="text" name="ta_rate_slab2" class="form-control" autocomplete="off" value="<?php echo set_value('ta_rate_slab2',$singleData['ta_rate_slab2']); ?>">
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>TA Rate Slab3 (<i class="fa fa-inr"></i>)</label>
                        <input type="text" name="ta_rate_slab3" class="form-control" autocomplete="off" value="<?php echo set_value('ta_rate_slab3',$singleData['ta_rate_slab3']); ?>">
                    </div>              
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Special Allowance</label>
                        <input type="text" name="spcial_allowance" class="form-control" autocomplete="off" value="<?php echo set_value('spcial_allowance',$singleData['special_allowance']); ?>">
                      </div>
                    </div>  
                  </div>
                  <div class="row">
                     
                     <div class="col-sm-3">
                      <div class="form-group">
                        <label>FPF (%)</label>
                        <input type="text" name="fpf" class="form-control" autocomplete="off" value="<?php echo set_value('fpf',$singleData['fpf']); ?>">
                      </div>
                    </div>    
                  <!--   <div class="col-sm-3">
                      <div class="form-group">
                        <label>VPF (%)</label>
                        <input type="text" name="vpf" class="form-control" autocomplete="off" value="<?php echo set_value('vpf',$singleData['vpf']); ?>">
                      </div>
                    </div>     -->      
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Staff Welfare Fund</label>
                        <input type="text" name="staff_welfare_fund" class="form-control" autocomplete="off" value="<?php echo set_value('staff_welfare_fund',$singleData['staff_welfare_fund']); ?>">
                      </div>
                    </div>  
                    <div class="col-sm-3">
                        <div class="form-group">
                          <label>HRA Allowance (%)</label>
                          <input type="text" name="hra_allowance" class="form-control" autocomplete="off" value="<?php echo set_value('hra_allowance',$singleData['HRA_Rate']); ?>">
                        </div>
                      </div>    
                  </div>
              </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-black pull-right">Update</button>
            </div>
            </div>
          </form>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div><br><br>
  <script type="text/javascript">
       //Date picker
    $('.datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
    });


//validation
$(document).ready(function () {

    $('#myform').validate({ // initialize the plugin
        rules: {
            effective_date: {
               required: true,
            },
            employer_pf_rate: {
              required: true,
              regexs: /^[0-9.]{1,40}$/
            },
            employee_pf_rate: {
              required: true,
              regexs: /^[0-9.]{1,40}$/
            },
            esi_limit: {
              required: true,
              regexs: /^[0-9.]{1,40}$/
            },
            esi_applied: {
              required: true,
              regexs: /^[0-9.]{1,40}$/
            },
            pension_rate: {
              required: true,
              regexs: /^[0-9.]{1,40}$/
            },
            esi_own_rate: {
              required: true,
              regexs: /^[0-9.]{1,40}$/
            },
            esi_emp_rate: {
              required: true,
              regexs: /^[0-9.]{1,40}$/
            },
            da_rate: {
               required: true,
              regexs: /^[0-9.]{1,40}$/
            },
            ta_rate_slab1: {
               required: true,
              regexs: /^[0-9.]{1,40}$/
            },
            ta_rate_slab2: {
                required: true,
              regexs: /^[0-9.]{1,40}$/
            },
            ta_rate_slab3: {
                required: true,
              regexs: /^[0-9.]{1,40}$/
            },
            spcial_allowance:{
              required: true,
              regexs: /^[0-9.]{1,40}$/
            },
            fpf:{
              required: true,
              regexs: /^[0-9.]{1,40}$/
            },
            staff_welfare_fund: {
                required: true,
                regexs: /^[0-9.]{1,40}$/
            },
            hra_allowance: {
                required: true,
                 regexs: /^[0-9.]{1,40}$/
            },
        },
        submitHandler: function (form) { // for demo 
                     if ($(form).valid()) 
                         form.submit(); 
                     return false; // prevent normal form posting
        }
    });
});

//pan number validation
$.validator.addMethod(
        "regexs",
        function(value, element, regexp) {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        },
        "Please do not enter any special character"
);
  </script>