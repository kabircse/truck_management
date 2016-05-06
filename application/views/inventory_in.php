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
<!-- widget grid -->
      <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-md-12 col-md-8 col-md-offset-1 col-lg-10">
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
                        <h2>Inventory IN</h2>

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

                            <form class="form-horizontal" role="form" action="<?php echo base_url().'inventory/addtoCart'; ?>" method="post">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="form-field-8"> Name </label>
            
                                    <div class="col-md-5">
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
                                    <label class="col-md-4 control-label">Quantity</label>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" name="quantity" value="<?php echo set_value('quantity'); ?>">
                                        <span class="text-danger"><?php echo form_error('quantity'); ?></span>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control unitlist" name="unitlist" id="unitlist" disabled="disabled">
                                              <option value="">-- Select--</option>
                                                <?php if ($get_creation_data) { ?>
                                                    <?php foreach ($get_creation_data as $unit) { ?>
                                                      <option value="<?php echo $unit['unit_id']; ?>"><?php echo $unit['unit_name']; ?></option>
                                                    <?php } ?>
                                                <?php }?>
                                         </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Purchase Price</label>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" name="price" value="<?php echo set_value('price'); ?>">
                                        <span class="text-danger"><?php echo form_error('price'); ?></span>
                                    </div>
                                </div>
                                
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"  align="center">
                                        <button class="btn btn-info" type="submit" name="submit" value="Submit!">
                                            <i class="icon-ok bigger-110"></i>
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="col-xs-12">
                            <h3 class="header smaller lighter grey">Product In Cart</h3>
                            <div class="table-responsive">
                                <table id="sample-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Unit Price</th>
                                            <th>Unit</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
        
                                    <tbody>
                                        <?php foreach ($this->cart->contents() as $cart) { ?>
        
                                            <tr>
                                                <td><?php echo $cart['name']; ?></td>
                                                <td><?php echo $cart['options']['unit_price'] . ' ' . 'Tk'; ?></td>
                                                <td><?php echo $cart['options']['quantity']; ?></td>
                                                <td><?php echo $cart['options']['unit']; ?></td>
                                                <td><?php echo $cart['options']['price'] . ' ' . 'Tk'; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url() . 'inventory/deleteCart/'.$cart['rowid'] ?>">
                                                    	<button class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure !!')">
                                                            <i class="icon-trash bigger-100"></i>
                                                            Delete
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <form class="form-horizontal" role="form" action="<?php echo base_url() . 'inventory/insert_entry'; ?>" method="post">
                              
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Chalan No:</label>
                                  <div class="col-md-3">
                                      <input class="form-control" type="text" name="chalan" value="<?php echo set_value('chalan'); ?>">
                                      <span class="text-danger"><?php echo form_error('chalan'); ?></span>
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                 <label class="col-md-4 control-label">Date:</label>
                                   <div class="col-md-3">
                                          <input type="text" name="date" placeholder="Select a date" class="form-control datepicker" data-dateformat="yy-mm-dd" value="<?php echo set_value('date'); ?>">
                                          <span class="text-danger"><?php echo form_error('date'); ?></span> 
                                            
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                 <label class="col-md-4 control-label">New/Old:</label>
                                   <div class="col-md-3">
                                      <select class="form-control is_new" name="is_new">
                                           <option value="">--Select--</option>
                                           <option value="1">New Item</option>
                                           <option value="0">Used Item</option> 
                                      </select>
                                      <span class="text-danger"><?php echo form_error('is_new'); ?></span>
                                      <script type="text/javascript">
                                      $(document).ready(function(e) {
                                            $(".is_new option[value='<?php echo set_value('is_new') ?>']").attr('selected', 'selected');
                                         });
                                      </script>
                                   </div>
                              </div>
                              
                              <div class="form-group">
                                  <label class="col-md-4 control-label" for="form-field-8">Supplier Name:</label>
          
                                  <div class="col-md-4">
                                      <select class="form-control supplierlist" name="supplierlist">
                                          <option value="">--Select--</option>
                                            <?php if ($get_supplier) { ?>
                                                <?php foreach ($get_supplier as $supplier) { ?>
                                                  <option value="<?php echo $supplier['id']; ?>"><?php echo $supplier['supplier_name']; ?></option>
                                                <?php } ?>
                                            <?php }?>
                                      </select>
                                      <span class="text-danger"><?php echo form_error('supplierlist'); ?></span>
                                      <script type="text/javascript">
                                      $(document).ready(function(e) {
                                            $(".supplierlist option[value='<?php echo set_value('supplierlist') ?>']").attr('selected', 'selected');
                                         });
                                      </script>
                                   </div>
                              </div>
                              
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Remarks:</label>
                                  <div class="col-md-3">
                                      <textarea name="remarks" rows="3"><?php echo set_value('remarks'); ?></textarea>
                                      <span class="text-danger"><?php echo form_error('remarks'); ?></span>
                                  </div>
                              </div>
                              
                              <div class="clearfix form-actions">
                                  <div class="col-md-offset-3 col-md-9" align="center">
                                      <button class="btn btn-info" type="submit" name="submit" value="Submit!">
                                          <i class="icon-ok bigger-110"></i>
                                          Submit
                                      </button>
                                  </div>
                              </div>
                          </form>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
                <!-- end widget -->
            </article>
            <!-- WIDGET END -->
        </div>				
    </section>
                    
				
				<!-- end widget grid -->

			</div>
			<!-- END MAIN CONTENT -->
