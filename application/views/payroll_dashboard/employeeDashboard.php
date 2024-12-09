<!-- Link to Bootstrap and Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style type="text/css">
  
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'San Francisco', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
    background-color: #f8f9fa;
    color: #333;
  }

  .container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
  }

  .panel {
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    background-color: #ffffff;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
  }

  .panel:hover {
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px);
  }

  .panel-heading {
    background-color: #4B49AC;
    color: #fff;
    font-weight: bold;
    padding: 15px 20px;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    font-size: 16px;
  }

  .panel-body {
    padding: 20px;
    font-size: 14px;
    color: #5a5a5a;
  }

  .panel-body table td {
    padding: 10px 5px;
  }

  .panel-footer {
    background-color: #f5f5f5;
    padding: 15px;
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
    font-size: 14px;
    color: #888;
  }

  .loader {
    position: fixed;
    top: 50%;
    left: 50%;
    border: 16px solid #f3f3f3;
    border-top: 16px solid #007aff;
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
    background-color: #f44336;
    color: #fff;
  }

  .present {
    background-color: #4caf50;
    color: #fff;
  }

  .holiday {
    background-color: #ffeb3b;
    color: #333;
  }

  .four-grids {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }

  .four-grid {
    width: 32%;
    border-radius: 12px;
    background-color: #28a745;
    color: white;
    padding: 20px;
    transition: transform 0.3s ease;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .four-grid:hover {
    transform: scale(1.05);
  }

  .four-grid .icon {
    font-size: 40px;
    margin-bottom: 15px;
  }

  .four-grid .four-text {
    font-size: 18px;
    font-weight: bold;
  }

  .four-text h3 {
    font-size: 18px;
    font-weight: bold;
  }

  .text-right {
    text-align: right;
  }

  @media (max-width: 768px) {
    .four-grids {
      flex-direction: column;
      align-items: center;
    }

    .four-grid {
      width: 100%;
      margin-bottom: 20px;
    }
  }
	a{
	 text-decoration: none;
	}
</style>

<div class="container">
  <!-- First Row with Panels -->
  <div class="row">
    <div class="col-md-6">
      <a href="<?php echo base_url('payroll/dashboard/principal_dashboard/presentStudent'); ?>">
        <div class="panel">
          <div class="panel-heading">Student</div>
          <div class="panel-body">
            <table style="width: 100%;">
              <tr>
                <td>Total :</td>
                <td class="text-right"><?php echo count($student); ?></td>
              </tr>
              <tr>
                <td>Present :</td>
                <td class="text-right"><?php echo $tot_present_stu = $totalStudentPresent['total_present_period_table'] + $totalStudentPresent['total_present_daily_table']; ?></td>
              </tr>
              <tr>
                <td>Absent : </td>
                <td class="text-right"><?php echo count($student) - $tot_present_stu; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-6">
      <a href="<?php echo base_url('Report/daily_monthlycollecion'); ?>">
        <div class="panel">
          <div class="panel-heading">Fees Collection</div>
          <div class="panel-body">
            <table style="width: 100%;">
              <tr>
                <td>Today Collection :</td>
                <td class="text-right"><?php echo ($todaycollection['total_amt'] == '') ? 0 : $todaycollection['total_amt']; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </a>
    </div>
  </div>

  <!-- Four-Grid Layout Section -->
  <div class="four-grids">
    <div style="background-color: #98BDFF;" class="four-grid">
      <a href="<?php echo base_url('Student_report/show_studentpanel2'); ?>">
        <div class="icon">
          <i class="bi bi-person-circle"></i>
        </div>
        <div class="four-text">
          <h3>Master Data</h3>
        </div>
      </a>
    </div>
    <div style="background-color: #7978E9" class="four-grid">
      <a href="<?php echo base_url('Student_report/application_report'); ?>">
        <div class="icon">
          <i class="bi bi-journal-text"></i>
        </div>
        <div class="four-text">
          <h3>Student Registration</h3>
        </div>
      </a>
    </div>
    <div style="background-color: #F3797E;" class="four-grid">
      <a href="<?php echo base_url('Monthly_collection/month_collection'); ?>">
        <div class="icon">
          <i class="bi bi-credit-card"></i>
        </div>
        <div class="four-text">
          <h3>Fee Collection</h3>
        </div>
      </a>
    </div>
  </div>

  <div class="four-grids">
    <div style="background-color: #98BDFF;" class="four-grid">
      <a href="<?php echo base_url('Report/typeofreports'); ?>">
        <div class="icon">
          <i class="bi bi-file-earmark-text"></i>
        </div>
        <div class="four-text">
          <h3>Reports</h3>
        </div>
      </a>
    </div>
    <div style="background-color: #7978E9" class="four-grid">
      <a href="<?php echo base_url('Fees_collection/misc_collection'); ?>">
        <div class="icon">
          <i class="bi bi-file-earmark-spreadsheet"></i>
        </div>
        <div class="four-text">
          <h3>Miscellaneous Collection</h3>
        </div>
      </a>
    </div>
    <div style="background-color: #F3797E;" class="four-grid">
      <a href="<?php echo base_url('Student_report/certificate_master'); ?>">
        <div class="icon">
          <i class="bi bi-file-earmark-medical"></i>
        </div>
        <div class="four-text">
          <h3>Certificates</h3>
        </div>
      </a>
    </div>
  </div>
</div>

<!-- Bootstrap JS and Bootstrap Icons -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>