  <?php
    if($data){
      $stu_aatt = $data[0]->attendance_type;
    }
	if($half_day){
		$half_day = $half_day[0]->Halfday;
	}
	else{
		$half_day = 0;
	}
	if($absent_day){
		$absent_day = $absent_day[0]->Absent;
	}else{
		$absent_day = 0;
	}
	if($present_day){
		$present_day = $present_day[0]->Present;
	}
	else{
		$present_day = 0;
	}
   ?>
  <style>
	 .A {
    background-color: #dd4b39;
  }
  .P {
    background-color: #00a65a;
  }
  .HD {
    background-color: #f39c12;
  }
  .present {
    background-color: #00a65a;
  }
  .absent{
     background-color: #dd4b39;
  }
  .halfday{
     background-color: #f39c12;
  }
  div.legend span {
    color: #1d1b1b !important;
    font-size: 20px !important;
    font-weight: normal !important;
	padding-right:10px;
}
ul.legend li {
    display: inline-block;
    height: 14px !important;
    width: 14px !important;
    margin-left: 5px;
}
.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #3c8cbc;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
.notice_para{
	font-weight: bold;
	font-size: 14px;
}

.download-file-color-change{
    -webkit-animation: color-change 1s infinite;
    -moz-animation: color-change 1s infinite;
    -o-animation: color-change 1s infinite;
    -ms-animation: color-change 1s infinite;
    animation: color-change 1s infinite;
}

@-webkit-keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
@-moz-keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
@-ms-keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
@-o-keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
@keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
  </style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <br>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
     <!--  <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4>Check</h4>

              <p>Attendance</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="<?php echo base_url('Parent_details/stu_attendance'); ?>" class="small-box-footer">Show <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h4>Pay Fee</h4>

              <p>Online</p>
            </div>
            <div class="icon">
              <i class="fa fa-rupee"></i>
            </div>
            <a href="<?php echo base_url('Parent_details/pay_details'); ?>" class="small-box-footer">Show Fees Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div> -->
      <!-- /.row -->
		<div class='row'>
			<div class='col-md-6 col-sm-6 col-lg-6'>
			<div class="box" style="height: 480px;">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-bullhorn"></i> Notice List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	<?php if(!empty($noticeList)){ ?>
	                	<marquee  behavior="scroll" direction="up" scrolldelay="300" onmouseover="this.stop();" onmouseout="this.start();" height="120px">
	                		<?php foreach ($noticeList as $key => $value) { ?>
		                 		<p class="notice_para"><i class="fa fa-hand-o-right"></i> <?php echo $value['notice_details']; ?>
		                 			<?php if($value['notice_img'] != ''){ ?> 
		                 				<a href="<?php echo base_url($value['notice_img']); ?>" class="download-file-color-change" target="_blank"><i class="fa fa-download"></i> Download File</a>
		                 			<?php } ?>
		                 		</p>
		                 	<?php } ?>
			            </marquee>
			        <?php } ?>
                </div>
              </div>
			</div>
			<!-- <div class='col-md-6 col-sm-6 col-lg-6'>
				<div id="piechart_3d" style="width: 100%; height: 100%;"></div>
			</div> -->

			<div class="col-md-6">
              <!-- DIRECT CHAT -->
              <div class="small-box bg-green" >
            <div class="inner">
              <h2><a href="<?php echo base_url('Onparent_details/pay_details'); ?>" style="color:white;">Click Here</a></h2>

              <p>To Pay your Fee</p>
            </div>
            <div class="icon">
              <i class="fa fa-rupee"></i>
            </div>
            <a href="<?php echo base_url('Onparent_details/pay_details'); ?>" class="small-box-footer">Show Fees Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
			  
			  <!-- homework -->

          <!-- small box -->
          
        
			  <!-- end homework -->
            </div>
		</div>
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
    <script type="text/javascript">
	$(function () {
    $('#example2').DataTable()
  })
  $(".full_calendar").zabuto_calendar({
      today: true,
      cell_border: true,
      weekstartson: 0,
      ajax: {
          url: "<?php echo base_url('Parent_details/attendance'); ?>",
          modal: true,
      },
      /* nav_icon: {
        prev: '<i class="fa fa-chevron-circle-left"></i>',
        next: '<i class="fa fa-chevron-circle-right"></i>'
      }, */
      // limit months navigation to a specific range
        legend: [
       {
          type: "block",
          label: "Present",
          classname: "P"
        },
        {
          type: "block",
          label: "Absent",
          classname: "A"
        },
        {
          type: "block",
          label: "Halfday",
          classname: "HD"
        },
      ], 
    });
	
	  google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Present',     <?php echo $present_day; ?>],
          ['Absent',      <?php echo $absent_day; ?>],
          ['Halfday',  	  <?php echo $half_day; ?>],
        ]);

        var options = {
          title: 'Attendance Graph',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
</script>