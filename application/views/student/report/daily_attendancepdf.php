
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
            <center><span style="font-size:22px !important;">Daily Attendance Report</span></center>
        </td>
    </tr>
     <tr>
        <td id="last-header" style="font-size:20px;">
            <center>Class: (<?php echo $clssec[0]->DISP_CLASS .') for Date : '. $dt ; ?></center>
        </td>
      
    </tr>
</table><br /><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
    <tr>
        <th style="background:#5785c3; color:#fff">Adm. No.</th>
        <th style="background:#5785c3; color:#fff">Stu Name</th>
        <th style="background:#5785c3; color:#fff">Roll No.</th>
        <!--<th style="background:#5785c3; color:#fff">Class</th>
	<th style="background:#5785c3; color:#fff">Sec</th>-->
        <th style="background:#5785c3; color:#fff">Attendance</th>
        <!--<th style="background:#5785c3; color:#fff">Mobile</th>-->
    </tr>

     <tbody>
        <?php
        if ($fetch_data) {
            foreach ($fetch_data as $data) {
        ?>
                <tr>
                    <td><?php echo $data->admno; ?></td>
                    <td><?php echo $data->stunm; ?></td>
                    <td><?php echo $data->roll; ?></td>
                    <!--<td><?php //echo $data['DISP_CLASS']; 
                            ?></td>
				<td><?php //echo $data['DISP_SEC']; 
                    ?></td>-->
                    <?php
                    if ($data->att_status == 'P') {
                    ?>
                        <td style="color:green;"><b><?php echo $data->att_status; ?></b></td>
                    <?php
                    } else if ($data->att_status == 'A') {
                    ?>
                        <td style="color:red;"><b><?php echo $data->att_status; ?></b></td>
                    <?php
                    } else {
                    ?>
                        <td style="color:orange; cursor:pointer"><b data-toggle="tooltip" data-placement="bottom" title='<?php echo $data->remarks; ?>'><?php echo $data->att_status; ?></b></td>
                    <?php
                    }
                    ?>
                    <!--<td><?php //echo $data['C_MOBILE']; 
                            ?></td>-->
                </tr>
        <?php
            }
        }
        ?>
        </tbody>


</table>