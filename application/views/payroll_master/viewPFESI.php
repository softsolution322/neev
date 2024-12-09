<style type="text/css">
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('payroll/master/pfesi'); ?>">PFESI Master</a> <i class="fa fa-angle-right"></i> View PFESI Master</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
   <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="box box-primary">
              <!-- /.box-header -->
              <div class="box-body">
                <?php if($this->session->flashdata('msg')){ 
                  echo $this->session->flashdata('msg');
                 } ?>
                <div class="table-responsive">
                  <table class="table table-stripped table-bordered dataTable">
                    <thead>
                      <tr>
                        <th style="background: #337ab7; color: white !important;">Effective Date</th>
                        <th style="background: #337ab7; color: white !important;">Employee PF Rate</th>
                        <th style="background: #337ab7; color: white !important;">Employer PF Rate</th>
                        <th style="background: #337ab7; color: white !important;">Pension Rate</th>
                        <!-- <th style="background: #337ab7; color: white !important;">Pay Limit</th> -->
                        <th style="background: #337ab7; color: white !important;">ESI Own Rate</th>
                        <th style="background: #337ab7; color: white !important;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($pfesi_details as $key => $value) { ?>
                        <tr>
                          <td><?php echo $effective_date = date("d-M-Y", strtotime($value['ST_DATE'])); ?></td>
                          <td><?php echo $value['OWN_RATE']; ?></td>
                          <td><?php echo $value['EMP_RATE']; ?></td>
                          <td><?php echo $value['PEN_RATE']; ?></td>
                          <!-- <td><?php echo $value['PAY_LIMIT']; ?></td> -->
                          <td><?php echo $value['ESI_OWN_RATE']; ?></td>
                          <td>
                            <a href="#" onclick="getSingleData('<?php echo $value['id']; ?>')" class="btn-xs btn-black"><i class="fa fa-bars"></i> View</a> &nbsp; &nbsp; 

                            <a href="<?php echo base_url('payroll/master/pfesi/update/').$value['id']; ?>" class="btn-xs btn-danger"><i class="fa fa-edit"></i> Edit</a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div>
  <br><br>

    <div class="modal fade" id="pfesiModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">PF ESI Details</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>
                <th>Effective Date</th>
                <td><span id="effective_date"></span></td>
              </tr>
              <tr>
                <th>Employee PF Rate (%)</th>
                <td><span id="employee_pf_rate"></span></td>
              </tr>
              <tr>
                <th>Employer PF Rate (%)</th>
                <td><span id="employer_pf_rate"></span></td>
              </tr>
              <tr>
                <th>Pension Rate (%)</th>
                <td><span id="pension_rate"></span></td>
              </tr>
              <tr>
                <th>Pay Limit (Rs.)</th>
                <td><span id="pay_limit"></span></td>
              </tr>
              <tr>
                <th>ESI Own Rate (%)</th>
                <td><span id="esi_own_rate"></span></td>
              </tr>
              <tr>
                <th>ESI Employee Rate (%)</th>
                <td><span id="esi_employee_rate"></span></td>
              </tr>
              <tr>
                <th>ESI Limit (Rs.)</th>
                <td><span id="esi_limit"></span></td>
              </tr>
              <tr>
                <th>ESI Applied</th>
                <td><span id="esi_applied"></span></td>
              </tr>
              <tr>
                <th>DA Rate</th>
                <td><span id="da_rate"></span></td>
              </tr>
              <tr>
                <th>TA Rate Slab1</th>
                <td><span id="ta_rate_slab1"></span></td>
              </tr>
              <tr>
                <th>TA Rate Slab2</th>
                <td><span id="ta_rate_slab2"></span></td>
              </tr>
              <tr>
                <th>TA Rate Slab3</th>
                <td><span id="ta_rate_slab3"></span></td>
              </tr>
              <tr>
                <th>Special Allowance</th>
                <td><span id="special_allowance"></span></td>
              </tr>
              <tr>
                <th>FPF (%)</th>
                <td><span id="fpf"></span></td>
              </tr>
              <!-- <tr>
                <th>VPF (%)</th>
                <td><span id="vpf"></span></td>
              </tr> -->
              <tr>
                <th>Staff Welfare Fund</th>
                <td><span id="staff_welfare_fund"></span></td>
              </tr>
              <tr>
                <th>HRA Rate (%)</th>
                <td><span id="hra_rate"></span></td>
              </tr>

            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  <script type="text/javascript">

    //open modal and fetch single data
    function getSingleData(id)
    {
      $.ajax({
        url: "<?= base_url(); ?>payroll/master/pfesi/getSingleData",
        data: {id:id},
        type: "post",
        async: false,
        dataType: 'json',
        success: function(response){
            $('#pfesiModal').modal({
                backdrop: 'static',
                keyboard: false,
                show:true
            });

            $('#effective_date').html(response.ST_DATE);
            $('#employee_pf_rate').html(response.OWN_RATE);
            $('#employer_pf_rate').html(response.EMP_RATE);
            $('#pension_rate').html(response.PEN_RATE);
            $('#pay_limit').html(response.PAY_LIMIT);
            $('#esi_own_rate').html(response.ESI_OWN_RATE);
            $('#esi_employee_rate').html(response.ESI_EMP_RATE);
            $('#esi_limit').html(response.ESI_LIMIT);
            if(response.ESI_Applied == 1)
            {
              $('#esi_applied').html('True');
            }
            else
            {
              $('#esi_applied').html('False');
            }
            $('#da_rate').html(response.da_rate);
            $('#ta_rate_slab1').html(response.ta_rate_slab1);
            $('#ta_rate_slab2').html(response.ta_rate_slab2);
            $('#ta_rate_slab3').html(response.ta_rate_slab3);
            $('#special_allowance').html(response.special_allowance);
            $('#fpf').html(response.fpf);
            // $('#vpf').html(response.vpf);
            $('#staff_welfare_fund').html(response.staff_welfare_fund);
            $('#hra_rate').html(response.HRA_Rate);

          },
         error: function()
         {
          alert("error");
         }
      });
    }
  </script>
   <script type="text/javascript">

     $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });
  </script>