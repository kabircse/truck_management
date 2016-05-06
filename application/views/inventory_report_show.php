    <section id="widget-grid" class="">
      
      <div class="row">
      
              <!-- NEW WIDGET START -->
              <article class="col-sm-12 col-md-12 col-lg-12">
              
              
              
              <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-editbutton="false">

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
                          <h2>Inventory Product IN/OUT Report</h2>

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
                                          <th>Date</th>
                                          <th>product Name</th>
                                          <th>Purchase Price</th>
                                          <th>Quantity</th>
                                          <th>In/Out Status</th>
                                          <th>New/Used Status</th>
                                          <th>Chalan Id</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                    		if ($get_in_out_report) 
											{
                                        		$i = 1;
                                        		foreach ($get_in_out_report as $report) {
                                      ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $report['date']; ?></td>	
                                                <td><?php echo $report['products_name']; ?></td>	
                                                <td><?php echo $report['purchase_price']; ?></td>
                                                <td><?php echo $report['quantity'].' '.$report['unit_name']; ?></td>
                                                <td><?php if($report['in_out_type'] == 1)
															{
     															echo 'In';
															}
															else
															{
																echo 'Out';
															}
                                                    ?>
                                                </td>
                                                <td><?php if($report['is_new'] == 1)
															{
     															echo 'New';
															}
															else
															{
																echo 'Used';
															}
                                                    ?>
                                                </td>	
                                                <td><?php echo $report['chalan_id']; ?></td>
                                            </tr>
                                            <?php
                                        			}
                                    			} else {
                                        	?>
                                        	<tr>
                                            	<td colspan="8">No Data Found</td>
                                        	</tr>
                                           <?php } ?>
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
      <div class="col-md-offset-11 no_print">
      	<a href="<?php echo base_url().'inventory/print_in_out_report/'.$start_date.'/'.$end_date.'/'.$product_id; ?>" class="btn btn-success">Print</a>
          <!--<button class="btn btn-info" id="btnPrint">Print</button>-->
      </div>
      
      <script type="text/javascript">
        $("#btnPrint").on("click", function () {
            window.print();
        });
    </script>