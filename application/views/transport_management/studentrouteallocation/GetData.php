<?php error_reporting(0); ?>
<style>
 .th{
	 background:#5785c3;
	 color:white!important;
 }
</style>

<div>
 <div class='row'>
	<div class="col-md-12">
		<div style="overflow-x: auto;height: 300px;">
		<table class="table table-responsive">
			<tr>
				<th class="th"><input type="checkbox" class="viewCheckAll" id="viewCheckAll"></th>
				<th class="th">Sl No</th>
				<th class="th">Admission No</th>
				<th class="th">Student Name</th>
				<th class="th">Class/Sec</th>
				<th class="th">Status</th>
			</tr>
			<?php
				if($data){
					$i=1;
					foreach($data as $key => $value){
						?>
							<tr>
								<td><input type="checkbox" name="adm_no[]" value="<?php echo $value->ADM_NO; ?>" class="viewCheck"></td>
								<td><?php echo $i; ?></td>
								<td><?php echo $value->ADM_NO; ?></td>
								<td><?php echo $value->FIRST_NM; ?></td>
								<td><?php echo $value->DISP_CLASS."/".$value->DISP_SEC; ?></td>
								<td><?php if($value->route_id > 0){echo "Alloted";}else{echo "Not Alloted";} ?></td>
							</tr>
						<?php
						$i++;
					}
				}
			?>
		</table>
		</div>
		<button type='submit' class="btn btn-success pull-right" name="save">Save</button>
	</div>
 </div>
</div>
<script>
$('#viewCheckAll').click(function(){
        if($(this).prop("checked")) {
            $(".viewCheck").prop("checked", true);
			
        } else {
            $(".viewCheck").prop("checked", false);
			
        }                
    });
	$('.viewCheck').click(function(){
        if($(".viewCheck").length == $(".viewCheck:checked").length) {
            $("#viewCheckAll").prop("checked", true);
        }else {
            $("#viewCheckAll").prop("checked", false);			
        }
    });
</script>