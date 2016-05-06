<script type="text/javascript">
$(document).ready(function(e) {	
	$('.delete_button').click(function(){
		var r=confirm("Do you want to delete this item?");
		if (r == true)
		{
			return true;
		}
		else
		{
			return false;
		} 	
	});
});
</script>

<!-- widget grid -->
      <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-sm-12 col-md-12  col-lg-12">
            	<div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <?php
                    if (isset($flag) && $flag) {
                        if ($flag == 'failed') {
                            ?>
                            <div class="alert alert-danger">
                                Insert Error.
                            </div>
                         <?php } elseif ($flag == 'deleted') {
                            ?>
                            <div class="alert alert-success">
                                Successfully Deleted.
                            </div>
                        <?php } elseif ($flag == 'success') {
                            ?>
                            <div class="alert alert-success">
                                Successfully Inserted.
                            </div>
                            
                            <?php } elseif ($flag == 'updated') {
                            ?>
                            <div class="alert alert-success">
                                Successfully Updated.
                            </div>
                            <?php
                        }
                    }
                    ?>
                	</div>
                </div>

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
                    <!-- widget options:
                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                    data-widget-colorbutton="false"
                    data-widget-editbutton="false"
                    data-widget-togglebutton="false"
                    data-widget-deletebutton="false"
                    data-widget-fullscreenbutton="false"
                    data-widget-custombutton="false"
                    data-widget-collapsed="true"
                    data-widget-sortable="false"

                    -->
                    <header>
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2>Add Servicing Category</h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body">

                            <form class="form-horizontal" action="<?php echo base_url().'servicing/insert_servicing_category'; ?>" method="post">

                                <fieldset>
                                    <legend>Add Servicing Category</legend>
                                    	<div class="form-group">
                                              <label class="col-md-2 control-label">Parent Category</label>
                                              <div class="col-md-6">
                                                  <select class="form-control" name="parent_category">
                                                      <option value="0">No Parent</option>
                                                        <?php if ($categories) { ?>
                                                            <?php foreach ($categories as $category) { ?>
                                                              <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                                            <?php } ?>
                                                        <?php }?>
                                                  </select>
                                                  <span class="text-danger"><?php echo form_error('parent_category'); ?></span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-2 control-label">Category Name</label>
                                              <div class="col-md-6">
                                                  <input class="form-control" placeholder="" type="text" name="category_name" value="<?php echo set_value('category_name'); ?>">
                                                  <span class="text-danger"><?php echo form_error('category_name'); ?></span>
                                              </div>
                                          </div>
                                    
                                
                            				<div class="form-actions">
                                              <div class="row">
                                                  <div class="col-md-12" align="center">
                                                      <button class="btn btn-primary" type="submit">
                                                          <i class="fa fa-save"></i>
                                                          Submit
                                                      </button>
                                                  </div>
                                              </div>
                                          </div>
                                          </fieldset>
                                     </form>
                                </div>
                                
                           <div class="row">
                              <div class="col-md-12">
                                  <form class="form-horizontal" action="<?php echo base_url().'servicing/update_servicing_category'; ?>" method="post">
                                      <fieldset>
                                          <legend>Edit Category</legend>
                                          
                                          <div class="form-group">
                                              <label class="col-md-2 control-label">Category List</label>
                                              	<div class="col-md-6">
                                                  <select class="form-control project_category" name="project_category">
                                                      <option value="">No Parent</option>
                                                        <?php if ($categories) { ?>
                                                            <?php foreach ($categories as $category) { ?>
                                                              <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                                            <?php } ?>
                                                        <?php }?>
                                                  </select>
                                                  <?php echo form_error('project_category'); ?>
                                                  <script type="text/javascript">
												  $(document).ready(function(e) {
                                                    	$(".project_category option[value='<?php echo set_value('project_category') ?>']").attr('selected', 'selected');
                                               		 });
                                                  </script>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-2 control-label">New Category Name</label>
                                              <div class="col-md-6">
                                                  <input class="form-control" placeholder="Category Name" type="text" name="new_name" value="<?php echo set_value('new_name'); ?>">
                                                  <?php echo form_error('new_name'); ?>
                                              </div>
                                          </div>
                                          </fieldset>
                                          <div class="form-actions">
                                              <div class="row">
                                                  <div class="col-md-12" align="center">
                                                      <button class="btn btn-primary" type="submit">
                                                          <i class="fa fa-save"></i>
                                                          Submit
                                                      </button>
                                                  </div>
                                              </div>
                                          </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                
                                 <legend>Category List</legend>
                                    <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Category Name</th>
                                        <th>Delete</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                          <?php if ($categories) { $i = 1; ?>
                                            <?php foreach ($categories as $category) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $category['name']; ?></td>	
                                                <td><a class="btn btn-danger btn-sm delete_button" href="<?php echo base_url().'servicing/delete_servicing_category/'.$category['id']; ?>">Delete</a></td>
                                            </tr>	
                                            <?php $i++; } ?>
                                        <?php }?>
                                    </tr>
                                </tbody>
                            </table>
                                
                                </div>
                            </div>
    
                        </div>
                        <!-- end widget content -->
    
                    </div>
                    <!-- end widget div -->
    
                </div>
                <!-- end widget -->
    
            </article>
            <!-- WIDGET END -->
    
        </div>				
    </section>
    
    <!-- widget grid -->
    
    <!-- end widget grid -->

</div>
<!-- END MAIN CONTENT -->