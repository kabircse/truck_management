<script type="text/javascript">
$(document).ready(function(e) {
	$('.productlist').on('change', function(){
		var product_id = $('.productlist').val();
		//alert(product_id);
		if(product_id)
		{
			var url_op = "<?php echo base_url(); ?>"+"inventory/get_product_information";
			$.ajax({        
			   type: "POST",
			   url: url_op,
			   data: 'product_id='+product_id,
			   success: function(msg) {
				   //alert(msg);
					if(msg != 'false')
					{
						var data = JSON.parse(msg);
						$('.new_name').val(data.products_name);
						$('#unitlist option[value="'+data.unit_id+'"]').attr('selected', 'selected');
					}
					else{
						alert('Some Problem Occured During Getting Information. Please Check Clearly');
					}
			   }
			});
		}
		else if(product_id == '')
		{
			var new_name = '';
			$('.new_name').val(new_name);
			$('#unitlist option[value=""]').attr('selected','selected');;
		}
	});
});
</script>

   <section id="widget-grid" class="">
  
      <!-- row -->
      <div class="row">
  
          <!-- NEW WIDGET START -->
          <article class="col-sm-12 col-md-8 col-md-offset-2 col-lg-8">
          	
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
                      <h2>Add Products Into Inventory</h2>
  
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
                                        <form class="form-horizontal" action="<?php echo base_url().'inventory/insert_product_name'; ?>" method="post" >
                                            <fieldset>
                                              
                                              	<div class="form-group">
                                                    <label class="col-md-2 control-label">Product Name</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="text" name="product_name" value="<?php echo set_value('product_name'); ?>">
                                                        <span class="text-danger"><?php echo form_error('product_name'); ?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Unit</label>
                                                    <div class="col-md-6">
                                                        <select class="form-control unit_name" name="unit_name">
                                                            <option value="">-- Select--</option>
                                                              <?php if ($get_creation_data) { ?>
                                                                  <?php foreach ($get_creation_data as $unit) { ?>
                                                                    <option value="<?php echo $unit['unit_id']; ?>"><?php echo $unit['unit_name']; ?></option>
                                                                  <?php } ?>
                                                              <?php }?>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error('unit_name'); ?></span>
                                                        <script type="text/javascript">
                                                        $(document).ready(function(e) {
                                                              $(".unit_name option[value='<?php echo set_value('unit_name') ?>']").attr('selected', 'selected');
                                                           });
                                                        </script>
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
                        </div>
                                  
                       <div class="row">
                          <div class="col-md-12">
                              <form class="form-horizontal" action="<?php echo base_url().'inventory/update_product_name'; ?>" method="post">
                                  <fieldset>
                                      <legend>Edit Product Name</legend>
                                      
                                      <div class="form-group">
                                          <label class="col-md-2 control-label">Product List</label>
                                          <div class="col-md-6">
                                              <select class="form-control productlist" name="productlist">
                                                  <option value="">--Select--</option>
                                                    <?php if ($get_product) { ?>
                                                        <?php foreach ($get_product as $product) { ?>
                                                          <option value="<?php echo $product['id']; ?>"><?php echo $product['products_name']; ?></option>
                                                        <?php } ?>
                                                    <?php }?>
                                              </select>
                                              <span class="text-danger"><?php echo form_error('productlist'); ?></span>
                                              <script type="text/javascript">
                                              $(document).ready(function(e) {
                                                    $(".productlist option[value='<?php echo set_value('productlist') ?>']").attr('selected', 'selected');
                                                 });
                                              </script>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <label class="col-md-2 control-label">New Product Name</label>
                                          <div class="col-md-6">
                                              <input class="form-control new_name" placeholder="Category Name" type="text" name="new_name" value="<?php echo set_value('new_name'); ?>">
                                              <span class="text-danger"><?php echo form_error('new_name'); ?></span>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <label class="col-md-2 control-label">Unit List</label>
                                          <div class="col-md-6">
                                              <select class="form-control unitlist" name="unitlist" id="unitlist">
                                                    <option value="">-- Select--</option>
                                                      <?php if ($get_creation_data) { ?>
                                                          <?php foreach ($get_creation_data as $unit) { ?>
                                                            <option value="<?php echo $unit['unit_id']; ?>"><?php echo $unit['unit_name']; ?></option>
                                                          <?php } ?>
                                                      <?php }?>
                                               </select>
                                              <span class="text-danger"><?php echo form_error('unitlist'); ?></span>
                                              <script type="text/javascript">
                                              $(document).ready(function(e) {
                                                    $(".unitlist option[value='<?php echo set_value('unitlist') ?>']").attr('selected', 'selected');
                                                 });
                                              </script>
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


