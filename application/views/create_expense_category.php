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
	<div class="row">
            <div class="col-md-8 col-md-offset-2">
		<?php
		if($this->session->flashdata('sign')){?>
		<div class="<?php echo $this->session->flashdata('sign')?>">
			<button type="button" class="close" data-dismiss="alert">
				<i class="icon-remove"></i>
			</button>
			<p><?php echo $this->session->flashdata('msg')?></p>
		</div>
		<?php }
		?>
	    </div>
	</div>
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
                      <h2><?php echo $title?></h2>
  
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
                                  <form class="form-horizontal" action="<?php echo base_url().'expense/submit_expense_category'; ?>" method="post" >
                                      <fieldset>
                                          <legend>Add Expense Category</legend>
                                          
                                          <div class="form-group">
                                              <label class="col-md-2 control-label">Parent Category</label>
                                              <div class="col-md-6">
					      <?php
						    $expense_category_array = array('0'=>'No Parent');
						    if ($expense_category){
                                                            foreach ($expense_category as $category)
								$expense_category_array[$category['id']] = $category['name'];
							     echo form_dropdown('parent_category',$expense_category_array,'','class="form-control"');
						    }
					      ?>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-2 control-label">Category Name</label>
                                              <div class="col-md-6">
                                                  <input class="form-control" type="text" name="category_name" value="<?php echo set_value('category_name'); ?>">
                                                  <span class="text-danger">
							<?php echo form_error('category_name'); ?>
						  </span>
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
                                  <form class="form-horizontal" action="<?php echo base_url().'expense/update_expense_category'?>" method="post">
                                      <fieldset>
                                          <legend>Edit Expense Category</legend>
                                          
                                          <div class="form-group">
                                              <label class="col-md-2 control-label">Category List</label>
                                              <div class="col-md-6">
					      <?php
						    $expense_category_array = array('0'=>'No parent');
						    if ($expense_category){
                                                            foreach ($expense_category as $category)
								$expense_category_array[$category['id']] = $category['name'];
							     echo form_dropdown('parent_category2',$expense_category_array,'','class="form-control"'.set_value('category_name2'));
						    }
					      ?>
                                                   <span class="text-danger">
							<?php echo form_error('revenue_category2'); ?>
						   </span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-2 control-label">New Category Name</label>
                                              <div class="col-md-6">
                                                  <input class="form-control" placeholder="Category Name" type="text" name="new_name" value="<?php echo set_value('new_name'); ?>">
                                                  <span class="text-danger">
							<?php echo form_error('new_name'); ?>
						   </span>
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
                                          <?php if ($expense_category) { $i = 1; ?>
                                            <?php foreach ($expense_category as $category) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $category['name']; ?></td>	
                                                <?php if($category['is_delete']==0){
						    ?>
						    <td><a class="btn btn-danger btn-sm delete_button" href="<?php echo base_url().'expense/delete_expense_category/'.$category['id']; ?>">Delete</a></td>
						<?php }
						    else
						      echo '<td>-</td>';
						?>
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

