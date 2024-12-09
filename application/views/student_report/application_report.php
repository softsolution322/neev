<style>
    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        white-space: nowrap !important;
    }

    .breadcrumb>li+li:before {
        content: "";
    }

    #message {
        width: 100%;
        height: 5%;
        background-color: #90EE90;
        color: white;
        text-align: center;
        padding: 10px;
        border-radius: 5px;
    }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Application Form</a> <i class="fa fa-angle-right"></i></li>
    <li class="breadcrumb-item" style="float: right;padding:2px"><i class="fa fa-angle-left"></i> <a href="<?php echo base_url('payroll/dashboard/emp_dashboard'); ?>" style="font-size:18px;">Back </a></li>
</ol>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;" class='table-responsive'>
    <center>
        <div id='message' hidden>Updated Successfully</div>
    </center>
    <table class="table table-bordered table-striped" style='width:100%' id='example'>
        <thead>
            <tr>
                <th style='width:10%'>Sl No.</th>
                <th style='width:10%'>Application Date</th>
                <th style='width:20%'>Student Name</th>
                <th style='width:20%'>Father Name</th>
                <th style='width:5%'>Class</th>
                <th style='width:10%'>Mobile Number</th>
                <th style='width:5%'>Date of Birth</th>
                <th style='width:20%'>Address</th>
                <th style='width:20%'>Status</th>
                <th style='width:10%'>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($data as $key => $value) {
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo date('d-m-Y',strtotime($value->submit_date)); ?></td>
                    <td><?php echo $value->name; ?></td>
                    <td><?php echo $value->father_name; ?></td>
                    <td><?php echo $value->class; ?></td>
                    <td><?php echo $value->number; ?></td>
                    <td><?php echo date_format(date_create($value->dob), 'd-m-Y'); ?></td>
                    <td><?php echo $value->address2; ?></td>
                    <td><?php if ($value->status == '1') {
                            echo "<span class='badge bg-primary text-light' id='status1'>PENDING</span>";
                        } elseif ($value->status == '2') {
                            echo "<span class='badge bg-danger text-light' id='status2'>NOT INTERESTED</span>";
                        } else {
                            echo "<span class='badge bg-warning text-light' id='status3'>CALL BACK</span>";
                            echo "<span id='call_back_msg'><br>" . $value->callback_msg . "</span>";
                        } ?></td>
                    <td>
                        <?php if ($value->status == '1') { ?>
                            <!-- <button class="btn btn-primary btn-sm pendingbtn" id="status11">pending</button> -->
                            <button class="btn btn-danger btn-sm" id="status12"><a href="" onclick='notinterestedbtn1(<?php echo $value->app_id; ?>)' style='color:white'>not interested</a></button>
                            <button class="btn btn-warning btn-sm" id="status13"><a href="" onclick='callbackBtn1(<?php echo $value->app_id; ?>)' style='color:white'>call back</a></button>
                        <?php } elseif ($value->status == '2') { ?>
                            <!-- <button class="btn btn-primary btn-sm" disabled id="status21"><a href="" class="text-white">pending</a></button> -->
                            <!-- <button class="btn btn-danger btn-sm" disabled id="status22"><a href="" class="text-white">not interested</a></button> -->
                            <!-- <button id="" class="btn btn-warning btn-sm" disabled id="status23">call back</button> -->
                        <?php } else { ?>
                            <!-- <button class="btn btn-primary btn-sm" id="status31"><a href="" class="text-white">pending</a></button> -->
                            <button class="btn btn-danger btn-sm" id="status32"><a href="" class="text-white" onclick='notinterestedbtn3(<?php echo $value->app_id; ?>)'>not interested</a></button>
                            <!-- <button id="" class="btn btn-warning btn-sm" id="status33">call back</button> -->
                        <?php } ?>
                    </td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>

</div>
<br>


<!-- Modal HTML markup -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id='callback_form'>
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center">Call Back</h3>
                </div>
                <div class="modal-body">
                    <!-- Add your modal content here -->
                    <h2>Message</h2>
                    <input type="hidden" name="app_id_msg" id="app_id_msg" value=''>
                    <textarea name="msg" id="" cols="60" rows="5"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<script type="text/javascript">
    function notinterestedbtn1(val) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('Student_report/delete_admission_form'); ?>",
            type: "POST",
            data: {
                val: val
            },
            success: function(data) {
                $('#status1').replaceWith("<span class='badge bg-danger text-light' id='status2'>NOT INTERESTED</span>");
                $('#status12').hide();
                $('#status13').hide();

                setTimeout(function() {
                    fadeOutEffect();
                    setInterval(function() {
                        win_reload()
                    }, 1000);
                }, 200);
            }

        })
    }


    function notinterestedbtn3(val) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('Student_report/delete_admission_form'); ?>",
            type: "POST",
            data: {
                val: val
            },
            success: function(data) {

                $('#status3').replaceWith("<span class='badge bg-danger text-light' id='status2'>NOT INTERESTED</span>");
                $('#status32').hide();
                $('#message').removeAttr('hidden', 'hidden');
                setTimeout(function() {
                    fadeOutEffect();
                    setInterval(function() {
                        win_reload()
                    }, 1000);
                }, 5000);
            }
        })
    }


    function callbackBtn1(val) {
        event.preventDefault();
        $('#myModal').modal('show');
        $('#app_id_msg').val(val);
    }

    $('#callback_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('Student_report/save_callback_msg'); ?>",
            type: "POST",
            data: $('#callback_form').serialize(),
            success: function(data) {
                $('#status1').replaceWith("<span class='badge bg-warning text-light' id='status3'>CALL BACK</span><br><span id='call_back_msg'>" + data + '</span>');
                $('#status13').hide();
                $('#myModal').modal('hide');

                $('#message').removeAttr('hidden', 'hidden');
                setTimeout(function() {
                    fadeOutEffect();
                    setInterval(function() {
                        win_reload()
                    }, 1000);
                }, 5000);
            }
        });
    });

    function win_reload() {
        window.location.reload(true);
    }

    function fadeOutEffect() {
        var fadeTarget = document.getElementById("message");
        var fadeEffect = setInterval(function() {
            if (!fadeTarget.style.opacity) {
                fadeTarget.style.opacity = 1;
            }
            if (fadeTarget.style.opacity > 0) {
                fadeTarget.style.opacity -= 0.1;
            } else {
                clearInterval(fadeEffect);
            }
        }, 200);
    }
</script>