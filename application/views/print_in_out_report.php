							<h3 align="center">Product IN/OUT Report</h3>
                            <table class="table table-bordered" align="center" border="1">
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
                                    		if($get_in_out_report) 
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
                              <div class="col-md-offset-11 no_print">
                                  <button class="btn btn-info" id="btnPrint">Print</button>
                              </div>
                              <script type="text/javascript">
								  $("#btnPrint").on("click", function () {
									  window.print();
								  });
							  </script>