<style type="text/css">
  .table>thead>tr>th,
  .table>tbody>tr>th,
  .table>tfoot>tr>th,
  .table>thead>tr>td,
  .table>tbody>tr>td,
  .table>tfoot>tr>td {
    color: black;
  }

  .loader {
    position: fixed;
    top: 50%;
    left: 50%;
    border: 16px solid #f3f3f3;
    /* Light grey */
    border-top: 16px solid #3498db;
    /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  .absent {
    background-color: #ff8793;
  }

  .present {
    background-color: #a3dba2;
  }

  /* .late_in {
    background-color: #ffb37c;
  }
  .before_out {
    background-color: #458ac6;
    color: white;
  }
  .late_in_before_out {
    background-color: #d61515;
    color: white;
  }*/
  .holiday {
    background-color: #e9eda6;
  }

  div.zabuto_calendar ul.legend>span {
    color: black;
    font-size: 15px;
    font-weight: bold;
  }

  .error {
    color: red;
  }

  .custom-box {
    padding: 5px 0;
  }

  .panel-heading {
    background: #417396 !important;
    font-weight: bold;
  }

  .panel:hover,
  .panel-heading:hover {
    background: #2c4e66 !important;
  }
</style>

<div class='row'>
  <center>
    <a href="<?php echo base_url('payroll/dashboard/principal_dashboard/presentStudent'); ?>">
      <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
        <div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
          <div class="panel-heading">Student</div>
          <div class="panel-body">
            <table style="width: 100%;padding: 2px;">
              <tr>
                <td>Total :</td>
                <td class="text-right"><?php echo count($student); ?></td>
              </tr>
              <tr>
                <td>Present :</td>
                <td class="text-right"> <?php echo $tot_present_stu =  $totalStudentPresent['total_present_period_table'] + $totalStudentPresent['total_present_daily_table']; ?> </td>
              </tr>
              <tr>
                <td>Absent : </td>
                <td class="text-right"><?php echo count($student) - $tot_present_stu; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </a>

    <a href="<?php echo base_url('Report/daily_monthlycollecion'); ?>">
      <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
        <div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
          <div class="panel-heading">Fees Collection</div>
          <div class="panel-body">
            <table style="width: 100%;padding: 2px;">
              <tr>
                <td>Today Collection :</td>
                <td class="text-right"><?php echo ($todaycollection['total_amt'] == '') ? 0 : $todaycollection['total_amt']; ?></td>
              </tr>
              <tr>
                <td>.</td>
              </tr>
              <tr>
                <td>.</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </a>

</div>
<div class="row">
  <div class="col-md-12 col-lg-12 col-sm-12">
    <div class="row">

      <div class="four-grids">
        <div class="col-md-4 four-grid">
          <a href="<?php echo base_url('Student_report/show_studentpanel2'); ?>">
            <div class="four-agileits">
              <div class="icon">
                <i class="fa fa-file" style="font-size:30px; color: #fff;"></i>
              </div>
              <div class="four-text">
                <h3>Master <br />Data </h3>
                <!-- <h4> 24,420  </h4> -->

              </div>

            </div>
          </a>
        </div>
        <div class="col-md-4 four-grid">
          <a href="<?php echo base_url('Student_report/application_report'); ?>">
            <div class="four-agileinfo">
              <div class="icon">
                <i class="fa fa-file" style="font-size:30px; color: #fff;"></i>
              </div>
              <div class="four-text">
                <h3>Student <br /> Registration</h3>
              </div>

            </div>
          </a>
        </div>
        <!-- <div class="col-md-3 four-grid">
          <a href="<?php echo base_url('Student_report/stu_atten'); ?>">
            <div class="four-agileits">
              <div class="icon">
                <i class="fa fa-file" style="font-size:30px; color: #fff;"></i>
              </div>
              <div class="four-text">
                <h3>Student Daily <br />Attendance </h3>

              </div>

            </div>
          </a>
        </div> -->
        <div class="col-md-4 four-grid">
          <!-- <a href="<?php //echo base_url('Student_report/show_studentpanel3'); 
                        ?>"> -->
          <a href="<?php echo base_url('Monthly_collection/month_collection'); ?>">
            <div class="four-agileits">
              <div class="icon">
                <i class="fa fa-file" style="font-size:30px; color: #fff;"></i>
              </div>
              <div class="four-text">
                <h3>Fee <br /> Collection</h3>
              </div>

            </div>
          </a>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-lg-12 col-sm-12">
    <div class="row">
      <div class="four-grids">

        <div class="col-md-4 four-grid">
          <a href="<?php echo base_url('Report/typeofreports'); ?>">
            <div class="four-agileits">
              <div class="icon">
                <i class="fa fa-file" style="font-size:30px; color: #fff;"></i>
              </div>
              <div class="four-text">
                <h3> <br />Reports </h3>
                <!-- <h4> 24,420  </h4> -->

              </div>

            </div>
          </a>
        </div>
        <!-- <div class="col-md-3 four-grid">
          <a href="<?php echo base_url('Sunil_enterprises/month_collection'); ?>">
            <div class="four-agileinfo">
              <div class="icon">
                <i class="fa fa-file" style="font-size:30px; color: #fff;"></i>
              </div>
              <div class="four-text">
                <h3> <br />Article Sold</h3>
              </div>

            </div>
          </a>
        </div> -->
        <div class="col-md-4 four-grid">
          <a href="<?php echo base_url('Fees_collection/misc_collection'); ?>">
            <div class="four-agileinfo">
              <div class="icon">
                <i class="fa fa-file" style="font-size:30px; color: #fff;"></i>
              </div>
              <div class="four-text">
                <h3>Miscellaneous <br /> Collection</h3>
                <!-- <h4> 24,420  </h4> -->

              </div>

            </div>
          </a>
        </div>
        <div class="col-md-4 four-grid">
          <a href="<?php echo base_url('Student_report/certificate_master'); ?>">
            <div class="four-agileits">
              <div class="icon">
                <i class="fa fa-file" style="font-size:30px; color: #fff;"></i>
              </div>
              <div class="four-text">
                <h3>Certificates <br /></h3></br>
              </div>

            </div>
          </a>
        </div>
      </div>
      <!-- <div class="col-md-3 four-grid">
						<a href="<?php echo base_url('Fees_collection/misc_collection'); ?>">
						<div class="four-agileinfo">
							<div class="icon">
								<i class="fas fa-rupee-sign" style="font-size:30px; color: #fff;"></i>
							</div>
							<div class="four-text">
								<h3>Miscellaneous <br /> Collection</h3><br>
								<!-- <h4>15,520</h4> -->

      <!-- </div>
							
						</div></a>
         -->
      <!-- </div> -->
      </br></br></br>
    </div>
    </br></br>
  </div>
</div>