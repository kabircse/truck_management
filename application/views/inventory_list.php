  <section id="widget-grid" class="">
  
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
    
    
    
    		<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-editbutton="false">
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
                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                <h2>Product List</h2>
  
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
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product Name</th>
                                <th>Stock Quantity</th>
                                <th>Unit</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        	<?php if($get_product) { 
									$i = 1;
									foreach($get_product as $product) {
							?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><a href="<?php echo base_url().'inventory/get_product_report/'.$product['id']; ?>"><?php echo $product['products_name']; ?></a></td>
                                <td><?php echo $product['stock']; ?></td>
                                <td><?php echo $product['unit_name']; ?></td>
                                <td>
                                     <div class="btn-group">
                                          <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                              Action <span class="caret"></span>
                                          </button>
                                          <ul class="dropdown-menu">
                                              <li>
                                                  <a href=""></a>
                                              </li>
                                              <li>
                                                  <a href="<?php echo base_url().'inventory/delete_inventory_product/'.$product['id']; ?>" onclick="return confirm('Are You Sure!!!')">Delete</a>
                                              </li>
                                          </ul>
                                      </div>
                                </td>
                            </tr>
                            <?php } }?>
                        </tbody>
                    </table>
  
                </div>
                <!-- end widget content -->
  
            </div>
            <!-- end widget div -->
  
        </div>
    
    </article>
    </div>
  </section>