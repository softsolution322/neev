<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Notice</a> <i class="fa fa-angle-right"></i> Sent Report Details </li>
</ol>

  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
  <div class="row">
     <div class='col-sm-4'>
	    <table class='table'>
			<tr>
				<th>Date</th>
				<td><input class='dt' id='date' type='text' name='date' autocomplete='off' class='form-control' onchange='dt(this.value)'></td>
			</tr>
			<tr>
				<th>Category </th>
				<td>
					<select class='form-control' id='cat'>
						<option value=''>Select</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><button class='btn btn-success btn-sm' onclick='search()'>Search</button></td>
			</tr>
	    </table>
     </div>
     <div class='col-sm-8'>
		<div class='table-responsive'>
        <table class='table dataTable'>
			<thead>
				<tr>
					<th style='background:#337ab7; color:#fff !important'>Admission No.</th>
					<th style='background:#337ab7; color:#fff !important'>Name</th>
					<th style='background:#337ab7; color:#fff !important'>Date</th>
					<th style='background:#337ab7; color:#fff !important'>Notice Category</th>
					<th style='background:#337ab7; color:#fff !important'>Notice</th>
					<th style='background:#337ab7; color:#fff !important'>Attachement</th>
				</tr>
			</thead>
			<tbody id='load_body'>
				<?php
					if(!empty($noticeData)){
						foreach($noticeData as $key => $val){
							?>
								<tr>
									<td><?php echo $val['admno']; ?></td>
									<td><?php echo $val['firstnm']; ?></td>
									<td><?php echo date('d-M-y',strtotime($val['date'])); ?></td>
									<td><?php echo $val['notice_category']; ?></td>
									<td><?php echo $val['notice']; ?></td>
									<td>
										<?php
											if($val['img'] != ''){
										?>
												<a target='_blank' href="<?php echo base_url($val["img"]); ?>"><i class="fa fa-eye"></i></a>
										<?php } else { ?>
												No Attachement
										<?php } ?>
									</td>
								</tr>
							<?php
						}
					}
				?>
			</tbody>
        </table>
        </div>
	 </div>
  </div>
</div>
<br /><br />


<!-- /.modal -->
<script type="text/javascript">
   $(".alert").fadeOut(3000);
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true });
   $("#multiselect").select2();
	
   $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
	  'pageLength'  : 5,
      aaSorting: [[0, 'asc']]
    })
  });
  
  function dt(val){
	 $.post("<?php echo base_url('notice/NoticeReport/loadCat'); ?>",{date:val},function(data){
		 $("#cat").html(data);
	 });
  }
  
  function search(){
	  var date = $("#date").val();
	  var cat  = $("#cat").val();
	  if(date !='' && cat != ''){
		  $.post("<?php echo base_url('notice/NoticeReport/loadSearchByData'); ?>",{date:date,cat:cat},function(data){
			 $("#load_body").html(data);
		  });
	  }else{
		  $.toast({
                heading: 'Error',
                text: 'Select First',
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
            });
	  }
  }
</script>