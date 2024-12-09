
<style>
    .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        margin: 0px auto;
        z-index: 999;
        -webkit-animation: spin 2s linear infinite;
        /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Application Form</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="loader" style="display:none;"></div>
<!--four-grids here-->
<div style="padding: 10px; background-color: white">

    <!-- <div class='col-sm-12'>
        <a href="<?php //echo base_url('Student_details/Student_master'); 
                    ?>" class='btn btn-danger pull-right'>BACK</a><br /><br />
    </div><br /> -->
    <form action="<?php echo base_url("Student_details/save_application") ?>" method="post">
        <div class="col">
        <div class="col-md-12">
					<?php
					   if($this->session->flashdata('msg')){
					   	?>
					   	<div class="alert alert-success" role="alert" id="msg" style="padding: 6px 0px;">
			  				<center><strong><?php echo $this->session->flashdata('msg'); ?></strong></center>
						</div>
					   	<?php
					   }
					?>
				</div>
            <!-- <div class="mx-auto col-10 col-md-8 col-lg-6"> -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Student Name</label>
                    <input type="text" class="form-control" id="inputEmail4" name="name" placeholder="Student Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Father Name</label>
                    <input type="text" class="form-control" id="inputPassword4" placeholder="Father Name" name="fname">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Class</label>
                    <!-- <input type="text" class="form-control" id="inputEmail4" name="class" placeholder="class"> -->
                    <select class="form-control" id="inputEmail4" name="class">
                        <option value="">Class</option>
                        <?php foreach ($class as $cls) { ?>
                            <option value="<?php echo $cls->CLASS_NM ?>"><?php echo $cls->CLASS_NM ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputZip">D.O.B</label>
                    <input type="date" class="form-control" id="inputZip" name="age" placeholder="age">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">WhatsApp Number</label>
                    <input type="text" class="form-control" id="inputPassword4" name="number" placeholder="98********" maxlength="10">
                </div>
            </div>


            <div class="form-group col-md-12">
                <label for="inputAddress2">Address 1</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Apartment, studio, or floor" name="add1">
            </div>

            <div class="form-group col-md-12">
                <label for="inputAddress2">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="add2">
            </div>
            <center><button type="submit" class="btn btn-primary" name="submit">Submit</button></center>
            <!-- </div> -->
        </div>
    </form>

</div><br /><br /><br /><br /><br /><br />
<div class="clearfix"></div>

<div class="inner-block">

</div>