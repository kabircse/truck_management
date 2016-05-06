   <section id="widget-grid" class="">
  
      <!-- row -->
      <div class="row">
  
          <!-- NEW WIDGET START -->
          <article class="col-sm-12 col-md-8 col-md-offset-2 col-lg-8">
  
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
                      <h2>Add Inventory products Category</h2>
  
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
  
                          <div class="row">
                              <div class="col-md-12">
                                  <form class="form-horizontal" action="<?php echo base_url().'creation/unit_creation'; ?>" method="post" >
                                      <fieldset>
                                          <legend>Add Unit</legend>
                                          
                                          <div class="form-group">
                                              <label class="col-md-2 control-label">Unit Name</label>
                                              <div class="col-md-6">
                                                  <input class="form-control" type="text" name="unit_name" value="<?php echo set_value('unit_name'); ?>">
                                                  <?php echo form_error('unit_name'); ?>
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
                                  <form class="form-horizontal" action="<?php echo base_url().'creation/edit_unit'; ?>" method="post">
                                      <fieldset>
                                          <legend>Edit Category</legend>
                                          
                                          <div class="form-group">
                                              <label class="col-md-2 control-label">Category List</label>
                                              <div class="col-md-6">
                                                  <select class="form-control unitlist" name="unitlist">
                                                      <option value="">No Parent</option>
                                                        <?php if ($get_creation_data) { ?>
                                                            <?php foreach ($get_creation_data as $unit) { ?>
                                                              <option value="<?php echo $unit['unit_id']; ?>"><?php echo $unit['unit_name']; ?></option>
                                                            <?php } ?>
                                                        <?php }?>
                                                  </select>
                                                   <?php echo form_error('unitlist'); ?>
                                                  <script type="text/javascript">
												  $(document).ready(function(e) {
                                                    	$(".unitlist option[value='<?php echo set_value('unitlist') ?>']").attr('selected', 'selected');
                                               		 });
                                                  </script>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-2 control-label">New Category Name</label>
                                              <div class="col-md-6">
                                                  <input class="form-control" placeholder="New Name" type="text" name="update_unit_name" value="<?php echo set_value('update_unit_name'); ?>">
                                                  <?php echo form_error('update_unit_name'); ?>
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
                                          <?php if ($get_creation_data) { $i = 1; ?>
                                            <?php foreach ($get_creation_data as $unit) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $unit['unit_name']; ?></td>	
                                                <td><a class="btn btn-danger btn-sm delete_button" href="<?php echo base_url().'creation/delete_unit/'.$unit['unit_id']; ?>" onclick="return confirm('Are You Sure, Want to DELETE !!')">Delete</a></td>
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


