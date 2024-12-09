
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
            <center>Class/Sec(<?php echo $resultList[0]['disp_class'] . '/' . $resultList[0]['disp_sec'] .')'; ?><center>
        </td>

    </tr>
</table><br /><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
    <tr>
        <th class="thead-color text-center">SNo</th>
        <th class="thead-color text-center">ADM NO</th>
        <th class="thead-color text-center">Roll No</th>
        <th class="thead-color">Name</th>
        <th class="thead-color text-center">Working Days</th>
        <th class="thead-color text-center">Present Days</th>
        <th class="thead-color text-center">Percentage (%)</th>
    </tr>

    <tbody>
        <?php foreach ($resultList as $key => $value) {  ?>
            <tr>
                <td class="text-center"><?php echo $key + 1; ?></td>
                <td class="text-center"><?php echo $value['admno']; ?></td>
                <td class="text-center"><?php echo $value['roll_no']; ?></td>
                <td><?php echo $value['stu_name']; ?></td>
                <td class="text-center"><?php echo $totalAttendance['total_attendance']; ?></td>
                <td class="text-center"><?php echo $value['total_attendance']; ?></td>
                <td class="text-center">
                    <?php
                    if ($totalAttendance['total_attendance'] == 0) {
                        $total_percentage = 0;
                    } else {
                        $total_percentage = ($value['total_attendance'] * 100) / $totalAttendance['total_attendance'];
                    }
                    if ($total_percentage < 75) { ?>
                        <span style="color: red;font-weight: bold;">
                            <?php echo rtrim(rtrim(number_format($total_percentage, 2), "0"), ".");  ?>
                        </span>
                    <?php } else {
                        echo rtrim(rtrim(number_format($total_percentage, 2), "0"), ".");
                    } ?>
                </td>

            </tr>
        <?php } ?>
    </tbody>


</table>