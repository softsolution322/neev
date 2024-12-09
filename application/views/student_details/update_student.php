<?php
	error_reporting(0);
  if($student_detail){
  $ID = $student_detail[0]->ID;
  $ADM_CLASS = $student_detail[0]->ADM_CLASS;
  $ADM_SEC = $student_detail[0]->ADM_SEC;
  $CURRENT_CLASS_CODE = $student_detail[0]->CURRENT_CLASS_CODE;
  $CURRENT_SEC_CODE = $student_detail[0]->CURRENT_SEC_CODE;
  $CATEGORY_CODE = $student_detail[0]->CATEGORY_CODE;
  $HOUSE_CODE = $student_detail[0]->HOUSE_CODE;
  $EMP_CODE = $student_detail[0]->EMP_CODE;
  $STOPPAGE_CODE = $student_detail[0]->STOPPAGE_CODE;
  $RELIGION_CODE = $student_detail[0]->RELIGION_CODE;
  $ADMISSION_NO = $student_detail[0]->ADMISSION_NO;
  $ADMISSION_DATE = $student_detail[0]->ADMISSION_DATE;
  $STUDENT_NAME = $student_detail[0]->STUDENT_NAME;
  $CLASS_NAME = $student_detail[0]->CLASS_NAME;
  $SECTION_NAME = $student_detail[0]->SECTION_NAME;
  $ROLL_NO = $student_detail[0]->ROLL_NO;
  $GENDER = $student_detail[0]->GENDER;
  $DATE_OF_BIRTH = $student_detail[0]->DATE_OF_BIRTH;
  $HOUSE_NAME = $student_detail[0]->HOUSE_NAME;
  $EMPLOYEE_WARD = $student_detail[0]->EMPLOYEE_WARD;
  $BUSSTOPAGE = $student_detail[0]->BUSSTOPAGE;
  $BLOOD_GROUP = $student_detail[0]->BLOOD_GROUP;
  $ACCOUNT_NUMBER = $student_detail[0]->ACCOUNT_NUMBER;
  $AADHAR_NUMBER = $student_detail[0]->AADHAR_NUMBER;
  $RELIGION = $student_detail[0]->RELIGION;
  $SCIENCE_FEE = $student_detail[0]->SCIENCE_FEE;
  $HOSTEL_STATUS =$student_detail[0]->HOSTEL_STATUS;
  $COUMPUTER_STATUS = $student_detail[0]->COUMPUTER_STATUS;
  $FREESHIP_STATUS = $student_detail[0]->FREESHIP_STATUS;
  $FREESHIP_MONTH =$student_detail[0]->FREESHIP_MONTH;
  $HANDICAP = $student_detail[0]->HANDICAP;
  $HANDICAP_NATURE = $student_detail[0]->HANDICAP_NATURE;
  $FATHERNAME = $student_detail[0]->FATHERNAME;
  $MOTHERNAME = $student_detail[0]->MOTHERNAME;
  $PERADD = $student_detail[0]->PERADD;
  $PERCITY = $student_detail[0]->PERCITY;
  $PERSTATE = $student_detail[0]->PERSTATE;
  $PERNATION = $student_detail[0]->PERNATION;
  $PERPIN = $student_detail[0]->PERPIN;
  $PERPHONE1 = $student_detail[0]->PERPHONE1;
  $PERPHONE2 = $student_detail[0]->PERPHONE2;
  $PERMOBILE = $student_detail[0]->PERMOBILE;
  $PERFAX = $student_detail[0]->PERFAX;
  $PEREMAIL = $student_detail[0]->PEREMAIL;
  $CROSSADD = $student_detail[0]->CROSSADD;
  $CROSSCITY = $student_detail[0]->CROSSCITY;
  $CROSSSTATE = $student_detail[0]->CROSSSTATE;
  $CROSSPIN = $student_detail[0]->CROSSPIN;
  $CROSSNATION = $student_detail[0]->CROSSNATION;
  $CROSSMOBILE = $student_detail[0]->CROSSMOBILE;
  $CROSSPHONE1 = $student_detail[0]->CROSSPHONE1;
  $CROSSPHONE2 = $student_detail[0]->CROSSPHONE2;
  $CROSSFAX = $student_detail[0]->CROSSFAX;
  $CROSSEMAIL = $student_detail[0]->CROSSEMAIL;
  $SUBJECT1 = $student_detail[0]->SUBJECT1;
  $SUBJECT2 = $student_detail[0]->SUBJECT2;
  $SUBJECT3 = $student_detail[0]->SUBJECT3;
  $SUBJECT4 = $student_detail[0]->SUBJECT4;
  $SUBJECT5 = $student_detail[0]->SUBJECT5;
  $SUBJECT6 = $student_detail[0]->SUBJECT6;
  $CBSEREGISTRATION = $student_detail[0]->CBSEREGISTRATION;
  $CBSEROLL = $student_detail[0]->CBSEROLL;
  $LAST_SCHOOL =$student_detail[0]->LAST_SCHOOL;
  $LSCH_ADD = $student_detail[0]->LSCH_ADD;
  $STUDENT_IMAGE = $student_detail[0]->STUDENT_IMAGE;
  }

  if($GENDER==1)
  {
    $gender_type='MALE';
  }else{
    $gender_type="FEMALE";
  }
  
 $Science_subject = $SCIENCE_FEE." SUBJECT";
 
 if($father_detail)
 {
  $ED_QUA =$father_detail[0]->ED_QUA;
  $OCCUPATION = $father_detail[0]->OCCUPATION;
  $DESIG = $father_detail[0]->DESIG;
  $MTH_INCOME = $father_detail[0]->MTH_INCOME;
  $ADDRESS = $father_detail[0]->ADDRESS;
  $FMOBILE =$father_detail[0]->MOBILE;
  $FEMAIL =$father_detail[0]->EMAIL;
  $CITY = $father_detail[0]->CITY;
  $PIN = $father_detail[0]->PIN;
  $STATEE =$father_detail[0]->STATE;
  $FDOB = $father_detail[0]->DOB;
 }
 if($mother_detail){
  $MED_QUA =$mother_detail[0]->ED_QUA;
  $MOCCUPATION = $mother_detail[0]->OCCUPATION;
  $MDESIG = $mother_detail[0]->DESIG;
  $MMTH_INCOME = $mother_detail[0]->MTH_INCOME;
  $MADDRESS = $mother_detail[0]->ADDRESS;
  $MMOBILE =$mother_detail[0]->MOBILE;
  $MEMAIL =$mother_detail[0]->EMAIL;
  $MCITY = $mother_detail[0]->CITY;
  $MPIN = $mother_detail[0]->PIN;
  $MSTATEE =$mother_detail[0]->STATE;
	 $MDOB = $mother_detail[0]->DOB;
}
if($sibling_details){
  $Name1 =$sibling_details[0]->Name1;
  $Sex1 =$sibling_details[0]->Sex1;
  $DOB1 =$sibling_details[0]->DOB1;
  $Adm1 =$sibling_details[0]->Adm1;
  $Name2 =$sibling_details[0]->Name2;
  $DOB2 =$sibling_details[0]->DOB2;
  $Sex2 =$sibling_details[0]->Sex2;
  $Adm2 =$sibling_details[0]->Adm2;
  $Name3 =$sibling_details[0]->Name3;
  $DOB3 =$sibling_details[0]->DOB3;
  $Sex3 =$sibling_details[0]->Sex3;
  $Adm3 =$sibling_details[0]->Adm3;
  $Name4 =$sibling_details[0]->Name4;
  $DOB4 =$sibling_details[0]->DOB4;
  $Sex4 =$sibling_details[0]->Sex4;
  $Adm4 =$sibling_details[0]->Adm4;
}
?>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Update Student Details</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style type="text/css">
  body{
   font-family: Verdana,Geneva,sans-serif; 
  }
</style>
<form method="post" action="<?php echo base_url('Student_details/re_update'); ?>" id="form" onsubmit="return validation()" enctype="multipart/form-data">
		<div style="padding: 10px; background-color: white">
			<div class="row">
				<div class="col-md-9">
					<?php
					   if($this->session->flashdata('msg')){
					   	?>
					   	<div class="alert alert-success" role="alert" id="msg" style="padding: 5px 0px;">
			  				<center><strong><?php echo $this->session->flashdata('msg'); ?></strong></center>
						</div>
					   	<?php
					   }
					?>
				</div>
        <div class="col-md-2">
          <center><input type="submit" name="submit" value="Update" class="btn btn-success"></center><br>
        </div>
				<div class="col-sm-1">		
		  <a href="<?php echo base_url('Student_details/show_student_details/'.$ID); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br />
        </div><br />
			</div>
		 <div class="row" id="row">
            <div class="col">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist" id="ul">
                        <li class="nav-item active" id="li">
                            <a class="nav-link " data-toggle="tab" href="#tab1" role="tab">Student Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">Parent Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab4" role="tab">Sibling Details</a>
                            
                        </li>
				</ul>

                    <div class="tab-content">
                     <div class="tab-pane fade active in cont" id="tab1">
                       <br>
                        <h2 class="text-center" style="color:black;padding-top:10px"><b><i>Student Information</i></b></h2>        
                         <br>
                          <div class="row">
                            <div class="col-md-2 col-sm-2 col-lg-2">
                              <?php
                                if($STUDENT_IMAGE!='')
                                {
                                  ?>
                                  <img style="height: auto; width: 100%;" src="<?php echo base_url($STUDENT_IMAGE); ?>" id="uploaded_image"><br>
                                 <input type="file" name="reupload" id="id_image" onchange="reupload(this.files[0].size)"><br>
                                 <span class="span" id="img_error"></span>
                                  <?php

                                }
                                else
                                {
                                  ?>
                                  <img src="<?php echo base_url('assets/student_photo/default.jpg'); ?>" style="height: auto; width: 100%;" id="uploaded_image" ><br>
                                  <input type="file" name="reupload" id="id_image" onchange="reupload(this.files[0].size)"><br>
                                  <span class="span" id="img_error"></span>
                                  <?php

                                }
                              ?>
                            </div>
                                <div class="col-md-10 col-sm-10 col-lg-10">
                                         <div class="form-row">
                                            <div class="form-group col-md-4">
                                               <label>Student Id</label>
                                                   <input type="text" name="sti" id="stdid" class="form-control" value="<?php echo $ID; ?>" readonly>
                                            </div>                    
                                            <div class="form-group col-md-4">
                                                <label>Admission Number</label>
                                                <input type="text" name="adn" id="adm_no" class="form-control" value="<?php echo $ADMISSION_NO; ?>" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                              <label>Admission Date</label>
                                              <input type="date" name="ad" class="form-control" value="<?php echo date('Y-m-d',strtotime($ADMISSION_DATE)) ?>">
                                            </div>
                                            
                                         </div>
                                         <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Student Full Name</label>
                                                <input type="text" style="text-transform:uppercase;" name="sfn" class="form-control" value="<?php echo $STUDENT_NAME; ?>" required>
                                            </div>  
                                        </div>
                                </div>
                                   
                               </div>
                       <div class="form-row">
                        <div class="form-group col-md-6">
                           <div class="row">
                            <div class="col-sm-6">
                              <label>Admission in Class</label>
                              <select name="admclass" id="admclass" class="form-control" readonly>
                                <?php
                                if($class)
                                {
                                  foreach ($class as $class_details) 
                                  {
                                    ?>
                                    <option value="<?php echo $class_details->Class_No;?>" <?php if($ADM_CLASS==$class_details->Class_No) { echo "selected";} ?> ><?php echo $class_details->CLASS_NM; ?></option>
                                    <?php
                                  }
                                }
                                ?>
                              </select>
                            </div>
                            <div class="col-sm-6">
                              <label>Admission in Section</label>
                              <select name="admsec" id="admsec" class="form-control" class="form-control" readonly>
                               <?php
                               if($section){
                                foreach ($section as $section_details) {
                                  ?>
                                  <option value="<?php echo $section_details->section_no; ?>" <?php if($ADM_SEC==$section_details->section_no) {echo "selected";} ?> ><?php echo $section_details->SECTION_NAME; ?></option>
                                  <?php
                                }
                               }
                               ?>
                              </select>
                            </div>
                             
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="row">
                              <div class="col-sm-6">
							   <label>Current Class</label>
                                <select name="curclass" id="curclass" class="form-control" required>
                                  <?php
                                if($class)
                                {
                                  foreach ($class as $class_data) 
                                  {
                                    ?>
                                    <option value="<?php echo $class_data->Class_No; ?>" <?php if($CURRENT_CLASS_CODE==$class_data->Class_No) {echo "selected";} ?> ><?php echo $class_data->CLASS_NM; ?></option>
                                    <?php
                                  }
                                }
                                ?>
                                </select>
                              </div>
                              <div class="col-sm-6">
                                <label>Current Section</label>
                                <select name="cursec" id="cursec" class="form-control" required>
                                  <?php
                               if($section){
                                foreach ($section as $section_data) {
                                  ?>
                                  <option value="<?php echo $section_data->section_no; ?>" <?php if($CURRENT_SEC_CODE==$section_data->section_no) {echo "selected";} ?> ><?php echo $section_data->SECTION_NAME; ?></option>
                                  <?php
                                }
                               }
                               ?>
                                </select>
                              </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Roll No.</label>
                            <input type="text"  class="form-control" value="<?php echo $ROLL_NO; ?>" name="roll" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gender</label>
                            <select name="sex" id="sex" class="form-control">
                              <option value="1" <?php if($GENDER==1){ echo "selected";} ?>>MALE</option>
                              <option value="0"<?php if($GENDER==0){ echo "selected";} ?>>FEMALE</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Date of Birth</label>
                          <input type="date" name="dob" class="form-control" value="<?php echo date('Y-m-d',strtotime($DATE_OF_BIRTH)) ?>">
                          
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Category</label>
                            <select name="category" id="category" class="form-control" required>
                              <?php
                              if($category){
                                foreach ($category as $category_data) {
                                  ?>
                                  <option value="<?php echo $category_data->CAT_CODE; ?>" <?php if($CATEGORY_CODE==$category_data->CAT_CODE) { echo "selected"; }?> ><?php echo $category_data->CAT_ABBR; ?></option>
                                  <?php
                                }
                              }
                              ?>
                            </select>
                        </div>
						<div class="form-group col-md-6">
                        <label>Ward Type</label>
                        <select id="ward" required name="ward" class="form-control">
                          <?php
                          if($eward){
                            foreach ($eward as $ward_data) {
                              ?>
                              <option value="<?php echo $ward_data->HOUSENO; ?>" <?php if($EMP_CODE==$ward_data->HOUSENO) { echo "selected"; } ?> ><?php echo $ward_data->HOUSENAME; ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-row">
                      
                      <div class="form-group col-md-6">
                        <label>Bus Stoppage</label>
                        <select id="BUSSTOPAGE" required name="BUSSTOPAGE" class="form-control">
                          <?php
                          if($stoppage){
                            foreach ($stoppage as $stoppage_data) {
                              ?>
                              <option value="<?php echo $stoppage_data->STOPNO; ?>" <?php if($STOPPAGE_CODE==$stoppage_data->STOPNO) {echo "selected";} ?>><?php echo $stoppage_data->STOPPAGE; ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select> 
                      </div>
					  <div class="form-group col-md-6">
                        <label>Blood Group</label>
                         <select class="form-control" id="blood_group" name="blood_group" required>
                            <option value="NONE" <?php if($BLOOD_GROUP=='NONE'){echo "selected";} ?>>Select Blood Group</option>
                            <option value="A+" <?php if($BLOOD_GROUP=="A+") {echo "selected";} ?> >A+</option>
                            <option value="A-" <?php if($BLOOD_GROUP=="A-") {echo "selected";} ?> >A-</option>
                            <option value="B+" <?php if($BLOOD_GROUP=="B+") {echo "selected";} ?> >B+</option>
                            <option value="B-" <?php if($BLOOD_GROUP=="B-") {echo "selected";} ?> >B-</option>
                            <option value="O+" <?php if($BLOOD_GROUP=="O+") {echo "selected";} ?> >O+</option>
                            <option value="O-" <?php if($BLOOD_GROUP=="O-") {echo "selected";} ?> >O-</option>
                            <option value="AB+" <?php if($BLOOD_GROUP=="AB+") {echo "selected";} ?> >AB+</option>
                            <option value="AB-" <?php if($BLOOD_GROUP=="AB-") {echo "selected";} ?>>AB-</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-row">
                      
					  <div class="form-group col-md-4">
                        <label>Religion</label>
                        <select name="religionn" required id="religion" class="form-control">
                          <?php
                          if($religion){
                            foreach ($religion as $religion_data) {
                              ?>
                              <option value="<?php echo $religion_data->RNo; ?>" <?php if($RELIGION_CODE==$religion_data->RNo) {echo "selected";} ?>><?php echo $religion_data->Rname; ?></option>
                              <?php
                            }
                          }
                          ?>
                        </select> 
                      </div>
                       <div class="form-group col-md-4">
                        <label>Aadhaar No.</label>
                        <input type="text" required name="aadhar_no" class="form-control" value="<?php echo $AADHAR_NUMBER; ?>">
                      </div>
					  <div class="form-group col-md-4">
                        <label>Freeship</label>
                        <input type="radio" name="radio3" value="1" <?php if($FREESHIP_STATUS==1) {echo "checked";} ?> onclick="freship(this.value)">Yes
                        <input type="radio" name="radio3" value="0" <?php if($FREESHIP_STATUS==0) {echo "checked";} ?> onclick="freship(this.value)">No<br>
                        <select class="form-control" name="freeship" id="freeship" <?php if($FREESHIP_STATUS != 1){echo "disabled";}?>>
                            <option value="N/A">select</option>
                            <?php
                            if($month){
                            	foreach ($month as $month_data) {
                            	?>
                            	<option value="<?php echo $month_data->month_name; ?>" <?php if($FREESHIP_MONTH==$month_data->month_name) {echo "selected";} ?> ><?php echo $month_data->month_name; ?></option>
                            	<?php
                            	 }
                             }
                            ?>
                        </select>
                      </div>
                    </div>
					<div class = 'row'>
						<div class="form-group col-md-4">
							<br>
                        <label>Food</label>
                        <input type="radio" name="radio2" value="1" <?php if($COUMPUTER_STATUS==1) {echo "checked";} ?>>Yes
                        <input type="radio" name="radio2" value="0" <?php if($COUMPUTER_STATUS==0) {echo "checked";} ?>>No
                      </div>
					</div>
              </div>
            <div class="tab-pane" id="tab2">
             <br>
             <h2 class="text-center" style="color:black;padding-top:10px"><b><i>Parent's Details</i></b></h2>
             <br>
             <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6">
                    <h3 class="text-center text-info">Father's Details</h3>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" style="text-transform:uppercase;" name="fname" class="form-control" value="<?php echo $FATHERNAME; ?>" required>    
                    
					 </div>
					    <div class="form-group">
                        <label>Father Date of Birth</label>
                        <input type="date"class="form-control" id="fdob" name="fdob" value="<?php echo $FDOB; ?>">
                    </div>
                    <div class="form-group">
                        <label>Educational Qualification</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="fedu" value="<?php echo $ED_QUA; ?>">  
                    </div>
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="foccupation" value="<?php echo $OCCUPATION; ?>" >  
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="fdesignation" value="<?php echo $DESIG; ?>">   
                    </div>
                    <div class="form-group">
                        <label>Monthly Income</label>
                        <input type="text" style="text-transform:uppercase;" class="form-control" name="fincome" value="<?php echo $MTH_INCOME; ?>">
                    </div>
					 <div class="form-group">
                            <label>Father Mobile No.</label>
                            <input type="text" style="text-transform:uppercase;" name="fmobile" id="fmobile" class="form-control" value="<?php echo $FMOBILE; ?>">
                        </div>
					 <div class="form-group">
                            <label>Father Email</label>
                            <input type="text" style="text-transform:uppercase;" name="femail" id="femail" class="form-control" value="<?php echo $FEMAIL; ?>">
                        </div>
					<h3 class="text-info text-center">Correspondence Address</h3>
                        
                        <div class="form-group">
                            <label>Address</label><br>
                            <input type="text" style="text-transform:uppercase;" name="cross_add" id="crossaddress" class="form-control" value="<?php echo $CROSSADD; ?>">
                        </div> 
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" style="text-transform:uppercase;" id="crosscity" name="cross_city" class="form-control" value="<?php echo $CROSSCITY; ?>">
                        </div>
                        <div class="form-group">
                            <label>PinCode</label>
                            <input type="text" style="text-transform:uppercase;" id="crosspin" name="cross_pin" class="form-control" value="<?php echo $CROSSPIN; ?>">
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" style="text-transform:uppercase;" name="crossstate" id="crossstate" class="form-control" value="<?php echo $CROSSSTATE; ?>">
                        </div>
                        
                  
                        
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <h3 class="text-center text-info">Mother's Details</h3>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" style="text-transform:uppercase;" name="mname" class="form-control" value="<?php echo $MOTHERNAME; ?>" required>
                        
                    </div>
					 
					    <div class="form-group">
                        <label> Mother Date of Birth</label>
                        <input type="date"class="form-control" id="mdob" name="mdob" value="<?php echo $MDOB; ?>">
                    </div>
                    <div class="form-group">
                        <label>Educational Qualification</label>
                        <input type="text" style="text-transform:uppercase;" name="medu" class="form-control" value="<?php echo $MED_QUA; ?>">
                    </div>
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" style="text-transform:uppercase;" name="moccu" class="form-control" value="<?php echo $MOCCUPATION; ?>">
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" style="text-transform:uppercase;" name="mdesignation" class="form-control" value="<?php echo $MDESIG; ?>">
                    </div>
                    <div class="form-group">
                        <label>Monthly Income</label>
                        <input type="text" style="text-transform:uppercase;" name="mincome" class="form-control" value="<?php echo $MMTH_INCOME; ?>"> 
                    </div>
					 <div class="form-group">
                            <label>Mother Mobile No.</label>
                            <input type="text" style="text-transform:uppercase;" name="mmobile" id="mmobile" class="form-control" value="<?php echo $MMOBILE; ?>">
                        </div>
					 <div class="form-group">
                            <label>Mother Email</label>
                            <input type="text" style="text-transform:uppercase;" name="memail" id="memail" class="form-control" value="<?php echo $MEMAIL; ?>">
                        </div>
					<h3 class="text-info text-center">Permanent Address</h3>
                        <div class="form-group">
                            <label>Address&nbsp;&nbsp;<span class="span"><input type="checkbox" id="getaddress" onclick="filladdress()">Check If Same</span></label><br>
                            <input type="text" style="text-transform:uppercase;" id="peradd" name="peradd" class="form-control" value="<?php echo $PERADD; ?>">
                        </div> 
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" style="text-transform:uppercase;" name="percity" class="form-control" value="<?php echo $PERCITY; ?>">
                        </div>
                        <div class="form-group">
                            <label>PinCode</label>
                            <input type="text" style="text-transform:uppercase;" id="perpin" name="per_pin" class="form-control" value="<?php echo $PERPIN; ?>">
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" style="text-transform:uppercase;" name="perstate" id="perstate" class="form-control" value="<?php echo $PERSTATE; ?>">
                        </div>
                       
                        
                </div>  
             </div>                   
            </div>

            <div class="tab-pane" id="tab4">
                <br>
            <h2 class="text-center" style="color:black;padding-top:10px"><b><i>Sibling Details</i></b></h2>
             <br>

             <div class="row">
                 <div class="col-sm-6 col-md-6 col-lg-6"><br>
                    <h4 class="text-center text-info">First Sibling Details</h4>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?php echo $Name1; ?>" >
                    </div>
                    <div class="form-group">
                        <label>Sex</label>
                        <input type="text" name="first_sex" class="form-control" value="<?php echo $Sex1; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="first_dob" class="form-control" value="<?php echo date('Y-m-d',strtotime($DOB1)) ?>">
                    </div>
                    <div class="form-group">
                        <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                        <input type="text" name="first_adm" class="form-control" value="<?php echo $Adm1; ?>">
                        
                    </div>
                 </div>
                 <br>
                 <div class="col-sm-6 col-md-6 col-lg-6">
                    <h4 class="text-center text-info">Second Sibling Details</h4>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="second_name" class="form-control" value="<?php echo $Name2; ?>">
                    </div>
                    <div class="form-group">
                        <label>Sex</label>
                        <input type="text" name="second_sex" class="form-control" value="<?php echo $Sex2; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="second_dob" class="form-control" value="<?php echo date('Y-m-d',strtotime($DOB2)) ?>">
                    </div>
                    <div class="form-group">
                    <label>Admission No. </label><br><span class="text-danger"> (Only if in this School)</span><br>
                        <input type="text" name="second_adm" class="form-control" value="<?php echo $Adm2;?>">  
                    </div>
                        
                    
                 </div>
             </div>
            
            </div>
            <!-- SUBJECT DETAILS OF STUDENT-->
            <div class="tab-pane" id="tab5">
             
            </div>
           <br>
            <!-- <div class="col-sm-12">
              
           </div> -->
        </div>
      </div>
    </div>
  </div>
		</div>
    </form><br /><br />
        <div class="clearfix"></div>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script>
		 function filladdress(){
    if($('#getaddress').is(':checked'))
    {
        var crossaddress = $('#crossaddress').val();
        var crosscity = $('#crosscity').val();
        var crosspin = $('#crosspin').val();
        var crossstate = $('#crossstate').val();
        var crosscountry = $('#crosscountry').val();
        var crossmoblile = $('#crossmoblile').val();
        var crossphone = $('#crossphone').val();
        var crossphone2 = $('#crossphone2').val();
        var crossfax = $('#crossfax').val();
        var crossemail = $('#crossemail').val();
        //alert(''+crossstate);

        $('#peradd').val(crossaddress);
        $('#percity').val(crosscity);
        $('#perpin').val(crosspin);
        $('#perstate').val(crossstate);
        $('#percountry').val(crosscountry);
        $('#permobile').val(crossmoblile);
        $('#perphone').val(crossphone);
        $('#perphone2').val(crossphone2);
        $('#perfax').val(crossfax);
        $('#peremail').val(crossemail);
    }else{

        var blank=$('#hidden').val();
        $('#peradd').val(blank);
        $('#percity').val(blank);
        $('#perpin').val(blank);
        $('#perstate').val(blank);
        $('#percountry').val(blank);
        $('#permobile').val(blank);
        $('#perphone').val(blank);
        $('#perphone2').val(blank);
        $('#perfax').val(blank);
        $('#peremail').val(blank);
    }
   }
		$("#msg").fadeOut(15000);
		
		$("#feedetails").click(function(){
			var val = $('#feedetails').is(':checked');
			if(val == true){
				$("#april").prop('', false);
                $("#may").prop('', false);
                $("#june").prop('', false);
                $("#july").prop('', false);
                $("#august").prop('', false);
                $("#september").prop('', false);
                $("#october").prop('', false);
                $("#november").prop('', false);
                $("#december").prop('', false);
                $("#january").prop('', false);
                $("#february").prop('', false);
                $("#march").prop('', false);
			}else{
				$("#april").prop('', true);
                $("#may").prop('', true);
                $("#june").prop('', true);
                $("#july").prop('', true);
                $("#august").prop('', true);
                $("#september").prop('', true);
                $("#october").prop('', true);
                $("#november").prop('', true);
                $("#december").prop('', true);
                $("#january").prop('', true);
                $("#february").prop('', true);
                $("#march").prop('', true);
			}
		});

		function validation(){
			var chk = document.getElementById('feedetails');
			if(chk.checked){
				return true;
			}else{
				document.getElementById('fee_error').style.color = 'red';
				document.getElementById('fee_error').style.fontSize = 'larger';
				return false;
			}
		}
		
		function freship(val){
			if(val == 0){
				$("#freeship").prop('disabled',true);
			}else{
				$("#freeship").prop('disabled',false);
			}
		}
		
		function handicapp(val){
			if(val==0){
				$("#handi_nature").prop('disabled',true);
			}else{
				$("#handi_nature").prop('disabled',false);
			}
		}
    function readURL(input) {
    var size = input.files[0].size;
    var type = input.value.split('.').pop().toLowerCase();
     if(size<=102400)
     {
       document.getElementById('img_error').innerHTML="";
             if(type=='jpg' || type=='jpeg' || type=='png')
             {
              document.getElementById('img_error').innerHTML="";
               if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#uploaded_image').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }

       }
       else
       {
        document.getElementById('img_error').innerHTML=" * Please Upload photo jpg,jpeg,png format only";
          $('#id_image').val('');
          return false;

       }

     }
     else
     {
          document.getElementById('img_error').innerHTML=" * Upload file Not More Than 100 kb";
          $('#id_image').val('');
          return false;
     }
}

$("#id_image").change(function(){
    readURL(this);
});
		</script>
<div class="inner-block">
</div>