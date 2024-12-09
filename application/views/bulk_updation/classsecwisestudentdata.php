<br>
<style type="text/css">
  .thead-color{
   background: #bac9e2 !important;
  }
</style>
<div class="employee-dashboard">
    <?php if(isset($data)) { ?>
      <div class="row"> 
          <div class="col-sm-12">
            <div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
              <div class="panel-heading"><i class="fa fa-edit"></i> Student Details Update Class Section Wise</div>
              <div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white; overflow-x: auto;height: 500px;">
                  <table class='table table-bordered table-striped dataTable'>
                    <thead>
                      <tr>
						<th class="thead-color text-center">Sl No</th>
                        <th class="thead-color text-center">Admission No</th>
                        <th class="thead-color text-center">Student Name</th>
                        <th class="thead-color text-center">Father Name</th>
                        <th class="thead-color text-center">Mother Name</th>
                        <th class="thead-color text-center">Roll No</th>
                        <th class="thead-color text-center">Date of Birth</th>
                        <th class="thead-color text-center">Primary Mobile</th>
                        <th class="thead-color text-center">Secondary Mobile</th>
                        <th class="thead-color text-center">Admission Date</th>
                        <th class="thead-color text-center">Category</th>
                        <th class="thead-color text-center">Gender</th>
                        <th class="thead-color text-center">Religion</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php
						$i=1;
							foreach($data as $key=>$value){
								?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $value->ADM_NO; ?></td>
										<td class="table_data" onkeypress="return event.charCode>=65 && event.charCode<=90 || event.charCode>=97 && event.charCode<=122 || event.charCode==32 || event.charCode==46" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="FIRST_NM" contenteditable><?php echo $value->FIRST_NM; ?></td>
										<td class="table_data" onkeypress="return event.charCode>=65 && event.charCode<=90 || event.charCode>=97 && event.charCode<=122 || event.charCode==32 || event.charCode==46" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="FATHER_NM" contenteditable><?php echo $value->FATHER_NM; ?></td>
										<td class="table_data" onkeypress="return event.charCode>=65 && event.charCode<=90 || event.charCode>=97 && event.charCode<=122 || event.charCode==32 || event.charCode==46" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="MOTHER_NM" contenteditable><?php echo $value->MOTHER_NM; ?></td>
										<td class="table_data" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="ROLL_NO" contenteditable><?php echo $value->ROLL_NO; ?></td>
										<td><input type="date" id="<?php echo $value->ADM_NO; ?>" onchange="getbirth(this.id)" value="<?php echo date('Y-m-d',strtotime($value->BIRTH_DT)); ?>" ></td>
										<td class="table_data" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="C_MOBILE" contenteditable><?php echo $value->C_MOBILE; ?></td>
										<td class="table_data"  data-row_adm="<?php echo $value->ADM_NO; ?>" data-column_name="P_MOBILE" contenteditable ><?php echo $value->P_MOBILE; ?></td>
										<td><input type="date" id="<?php echo $value->ADM_NO."_I"; ?>" onchange="getadmno(this.id)" value="<?php echo date('Y-m-d',strtotime($value->ADM_DATE)); ?>" ></td>
										<td><select onchange="changecategory(this.id)" id="<?php echo $value->ADM_NO."_CATEGORY"; ?>">
											<option value="">select</option>
											<?php
												foreach($category as $cat=>$catval){
													?>
														<option <?php if($catval->CAT_CODE == $value->CATEGORY){echo "selected";} ?> value="<?php echo $catval->CAT_CODE; ?>"><?php echo $catval->CAT_ABBR; ?></option>
													<?php
												}
											?>
										</select></td>
										<td><select onchange="changegenger(this.id)" id="<?php echo $value->ADM_NO."_GENGER"; ?>">
											<OPTION value="">select</option>
											<OPTION value="1" <?php if($value->SEX == 1){echo "selected";} ?>>MALE</OPTION>
											<OPTION value="2" <?php if($value->SEX == 2){echo "selected";} ?> >FEMALE</OPTION>
										</select></td>
										<td><select onchange="changereligion(this.id)" id="<?php echo $value->ADM_NO."_RELEGION"; ?>" >
											<option value="">select</option>
											<?php
												foreach($religion as $REL=>$RELVAL){
													?>
														<option <?php if($RELVAL->RNo == $value->religion){echo "selected";} ?> value="<?php echo $RELVAL->RNo; ?>"><?php echo $RELVAL->Rname; ?></option>
													<?php
												}
											?>
										</select></td>
									</tr>
								<?php
								$i++;
							}
						?>
                    </tbody>
                  </table>
              </div>
          </div>
          </div>
      </div>
    <?php } ?>
 </div>
<br>
<script>
	$(document).on('blur', '.table_data', function(){
		var adm = $(this).data('row_adm');
		//var fh = $(this).data('row_fh');
		var table_column = $(this).data('column_name');
		var value = $(this).text();
		//alert("adm is:"+adm+"table is:"+table_column+" value"+value);
		$.ajax({
		  url:"<?php echo base_url('bulk_updation/Classsecwise/update_data'); ?>",
		  method:"POST",
		  data:{adm:adm,table_column:table_column, value:value},
		  success:function(data)
		  {
			$.toast({
                heading: 'Success',
                text: 'Saved Successfully',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right',
            });
		  }
		});
  });
  function changereligion(rel_data){
	  var religion_value = $('#'+rel_data).val();
	  var getiddd1 = rel_data.split("_");
	  var finiddd1 = getiddd1[0];
	  if(religion_value == ""){
		  
	  }else{
		  $.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/changereligion'); ?>",
				method : "POST",
				data : {finiddd1:finiddd1,religion_value:religion_value},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("No Category Change");
					}
				},
			});
	  }
  }
  function changecategory(CAT_data){
	  var category_value = $('#'+CAT_data).val();
	  var getiddd = CAT_data.split("_");
	  var finiddd = getiddd[0];
	  if(category_value == ""){
		  
	  }else{
		  $.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/changecategory'); ?>",
				method : "POST",
				data : {finiddd:finiddd,category_value:category_value},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("No Category Change");
					}
				},
			});
	  }
  }
  function changegenger(gen_data){
	  var gender_value = $('#'+gen_data).val();
	  var getidd = gen_data.split("_");
	  var finidd = getidd[0];
	  if(gender_value == ""){
		  
	  }else{
		  $.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/changegender'); ?>",
				method : "POST",
				data : {finidd:finidd,gender_value:gender_value},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("No Gender Change");
					}
				},
			});
	  }
  }
	function getadmno(val1){
		var value1 = $('#'+val1).val();
		var getid = val1.split("_");
		var finid = getid[0];
		if(val1 ==""){
			
		}else{
			$.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/adm_noupdate'); ?>",
				method : "POST",
				data : {finid:finid,value1:value1},
				success:function(data)
				{
					if(data == 1){
					}else{
						alert("Date of Birth Not Change");
					}
				},
			});
		}
	}
	function getbirth(val){
		var value = $('#'+val).val();
		if(val ==""){
			
		}else{
			$.ajax({
				url : "<?php echo base_url('bulk_updation/Classsecwise/birth_data'); ?>",
				method : "POST",
				data : {val:val,value:value},
				success:function(data)
				{
					if(data == 1){
						
					}else{
						alert("Date of Birth Not Change");
					}
				},
			});
		}
	}
</script>