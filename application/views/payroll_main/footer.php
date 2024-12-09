<style type="text/css">
	.error{
		color: red !important;
	}
</style>

<div class="modal fade" id="changePasswordModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <form id="changePasswordForm">
      	<input type="hidden" name="empid_change_pass" id="empid_change_pass">
        <div class="modal-body">
          <div class="row"> 
            <div class="col-sm-12">
              <div class="form-group">
                <label>Password</label><span class="req">*</span>
                <input type="password" name="password" class="form-control" autocomplete="off" required="" id="password">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Confirm Password</label><span class="req">*</span>
                <input type="password" name="password" class="form-control" autocomplete="off" required="" id="conf_password">
              </div>
            </div>   
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveChangePassword()">Save</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
	function changePassword(empid)
	{
	  $('#changePasswordModal').modal({
	    backdrop: 'static',
	    keyboard: false
	  });
	  $('#empid_change_pass').val(empid);
	}

	function saveChangePassword()
	{
		$("#changePasswordForm").validate();
  		if ($('#changePasswordForm').valid())
  		{
			var password = $('#password').val();
			var conf_password = $('#conf_password').val();
			var empid_change_pass = $('#empid_change_pass').val();
			if(confirm('Do you want to change password'))
			{
				if(password != conf_password)
				{
					alert('Password and confirm password are not same');
				}
				else
				{
					$.ajax({
						url:"<?php echo base_url('login/changePassword'); ?>",
						method:"post",
						data:{empid_change_pass:empid_change_pass,password:password,conf_password:conf_password},
						dataType:"json",
						success:function(response)
						{
							if(response.msg == 1)
					        {
					          $('#changePasswordForm')[0].reset();
					          $('#changePasswordModal').modal('hide');
					          swal({title: "Password Changed Successfully", text: "Password Changed Successfully", type: "success"},
					             function(){ 
					                 location.reload();
					             }
					          );          
					        }
					        else
					        {
					        	swal({title: "Failed !", text: "Failed !", type: "error"},
					             function(){ 
					                 location.reload();
					             }
					          );    
					        }
						}
					});
				}
			}
			else
			{
				return false;
			}
		}
	}

	$(document).ready(function () {

    $('#changePasswordForm').validate({ // initialize the plugin
        submitHandler: function (form) { // for demo 
                     if ($(form).valid()) 
                         form.submit(); 
                     return false; // prevent normal form posting
        }
    });
});

</script>

<div class="copyrights">
<div class='row'>
  <div class="col-sm-8"><p>&nbsp;&nbsp;<img src="<?php echo base_url('assets/dash_images/mica_img.png'); ?>" style="width:50px;" class="img-fluid"> &nbsp;© All Rights Reserved | Design by  <a href="http://micaeduco.com/" target="_blank">MICA EDUCATIONAL COMP (P) LTD</a>&nbsp;&nbsp; <p></div>
  
  <div class="col-sm-4" style="line-height:50px;"><p>Powered By : <a href="#">Soft Solution</a>
</p></p></div>
</div>
</div>	
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->