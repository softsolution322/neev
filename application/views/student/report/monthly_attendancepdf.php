<style>
    #table2 {
        border-collapse: collapse;
    }

    #table3 {
        border-collapse: collapse;
    }

    #img {
        float: left;
        height: 100px;
        width: 100px;
        margin-left: 150px !important;
    }

    #tp-header {
        font-size: 30px;
    }

    #mid-header {
        font-size: 26px;
    }

    #last-header {
        font-size: 22px;
    }

    .th {
        background-color: #5785c3 !important;
        color: #fff !important;
        font-size: 12px;
    }

    .tt {
        font-size: 10px;
    }

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        white-space: nowrap !important;
    }
</style>

<!-- <img src="<?php //echo $school_setting[0]->SCHOOL_LOGO; 
                ?>" id="img"> -->
<table width="100%" style="float:right;">
    <tr>
        <td id="tp-header">
            <center><?php echo $school_setting[0]->School_Name; ?></center>
        </td>
    </tr>
    <tr>
        <td id="mid-header">
            <center><?php echo $school_setting[0]->School_Address; ?></center>
        </td>
    </tr>

    <tr>
        <td>
            <center><span style="font-size:22px !important;">Monthly Attendance Report</span></center>
        </td>
    </tr>
    <tr>
        <td id="last-header" style="font-size:20px;">
            <center>Class/Sec(<?php echo $clssec[0]->DISP_CLASS . '/' . $clssec[0]->DISP_SEC . ') Date : ' . $dt; ?><center>
        </td>

    </tr>
</table><br /><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
    <tr>
        <th style="background:#5785c3; color:#fff">Adm No.</th>
        <th style="background:#5785c3; color:#fff">Stu Name</th>
        <th style="background:#5785c3; color:#fff">Roll</th>
        <th style="background:#5785c3; color:#fff">Class</th>
        <th style="background:#5785c3; color:#fff">Sec</th>
        <th style="background:#5785c3; color:#fff">Mobile</th>
        <?php for ($i = 1; $i <= $total_days; $i++) {
            $date = $current_year . '-' . $mnth . '-' . $i;
        ?>
            <th style="background: #5785c3 !important; color: white !important;"><?php echo $i . '<br> ' . date("D", strtotime($date)); ?></th>
        <?php } ?>
    </tr>

    <tbody>
  <?php
    foreach($resultList as $key => $value){ ?>
		<tr>
		  <td><?php echo $value['admno']; ?></td>
		  <td><?php echo $value['name']; ?></td>
		  <td><?php echo $value['roll']; ?></td>
		  <td><?php echo $value['class']; ?></td>
		  <td><?php echo $value['sec']; ?></td>
		  <td><?php echo $value['mobile']; ?></td>
		  <?php for ($k=1; $k <= $total_days; $k++) { ?>
			  <td>
			  	<?php 
			  		if($value[$k]['status'] == 'H')
			  		{
			  			echo '<strong><span style="color:#ad7e44;">'.$value[$k]['status'].'</span></strong>'; 
			  		}
			  		elseif($value[$k]['status'] == 'P' || $value[$k]['status'] == 'HD')
			  		{
			  			echo '<strong><span style="color:green;">'.$value[$k]['status'].'</span></strong>';
			  		}
			  		elseif($value[$k]['status'] == 'A')
			  		{
			  			echo '<strong><span style="color:red;">'.$value[$k]['status'].'</span></strong>';
			  		}else
			  		{
			  			echo '<strong>'.$value[$k]['status'].'</strong>';
			  		}
			  	?></td>
		  <?php } ?> 
		</tr>
	<?php }
  ?>
</tbody> 



</table>