<style type="text/css">
  .table-header{
      background: #c3c7c4;
    }
    @media only screen and (max-width: 800px) {
  
  /* Force table to not be like tables anymore */
  #no-more-tables table, 
  #no-more-tables thead, 
  #no-more-tables tbody, 
  #no-more-tables th, 
  #no-more-tables td, 
  #no-more-tables tr { 
    display: block; 
  }
 
  /* Hide table headers (but not display: none;, for accessibility) */
  #no-more-tables thead tr { 
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
 
  #no-more-tables tr { border: 1px solid #ccc; }
 
  #no-more-tables td { 
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee; 
    position: relative;
    padding-left: 50%; 
    white-space: normal;
    text-align:left;
  }
 
  #no-more-tables td:before { 
    /* Now like a table header */
    position: absolute;
    /* Top/left values mimic padding */
    top: 6px;
    left: 6px;
    width: 45%; 
    padding-right: 10px; 
    white-space: nowrap;
    text-align:left;
    font-weight: bold;
  }
 
  /*
  Label the data
  */
  #no-more-tables td:before { content: attr(data-title); }
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Homework List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-clipboard"></i> Home</a></li>
        <li class="active">Homework</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-filter"></i> Filter</h3>
        </div>
        <!-- /.box-header -->
        <form action="<?php echo base_url('parent_dashboard/homeworklist'); ?>" method="post">
          <div class="box-body" >
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Category</label>
                  <select class="form-control" name="category">
                    <option value="">Select</option>
                    <?php foreach ($categoryList as $key => $value) { ?>
                      <option value="<?php echo $value['id']; ?>" <?php if(set_value('category')==$value['id']){ echo "selected"; } ?>><?php echo $value['category']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Subject</label>
                  <select class="form-control" name="subject">
                    <option value="">Select</option>
                    <?php foreach ($subjectList as $key => $value) { ?>
                      <option value="<?php echo $value['subject_id']; ?>" <?php if(set_value('subject')==$value['subject_id']){ echo "selected"; } ?>><?php echo $value['subject_name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="">Select</option>
                    <option value="Y" <?php if(set_value('status')=='Y'){ echo "selected"; } ?>>Complete</option>
                    <option value="N" <?php if(set_value('status')=='N'){ echo "selected"; } ?>>Incomplete</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="box box-footer">
            <button class="btn btn-success pull-right" name="search"><i class="fa fa-search"></i> Search</button>
          </div>
        </form>
      </div>

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-clipboard"></i> Homework List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
          <div class="row">
            <div class="col-sm-12">
              <div class="table-responsive" id="no-more-tables">
                <table class="table table-striped table-bordered datatable">
                  <thead class="table-header">
                    <tr>
                      <th>S.No</th>
                      <th>Homework date</th>
                      <th>Subject</th>
                      <th>Homework Category</th>
                      <th>Submission Date</th>
                      <th>Description</th>
                      <th>Remarks</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i =0; foreach ($homeworkList as $key => $value) { ?>
                      <tr>
                        <td data-title="S.No"><?php echo ++$i; ?></td>
                        <td data-title="Homework Date"><?php echo date('d-M-Y',strtotime($value['date'])); ?></td>
                        <td data-title="Subject"><?php echo $value['subject_name']; ?></td>
                        <td data-title="Homework Category"><?php echo $value['homework_category_name']; ?></td>
                        <td data-title="Submission Date"><?php echo date('d-M-Y',strtotime($value['submission_date'])); ?></td>
                        <td data-title="Description"><?php echo ($value['remarks']=='')?'-':$value['remarks']; ?></td>
                        <td data-title="Remarks"><?php echo ($value['teacher_remarks'] == '')?'-':$value['teacher_remarks']; ?></td>
                        <td data-title="Status"><?php
                          if($value['homework_status'] == 'Y')
                          {
                            echo "<span class='label label-success'>Complete</span>";
                          }
                          else
                          {
                            echo "<span class='label label-warning'>Incomplete</span>";
                          }
                        ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
	$(function () {
    $('.datatable').DataTable( {
      responsive: true
    });
  })
</script>