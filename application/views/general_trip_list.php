<script>
$(function(){

setTimeout(function(){$(".alert").fadeOut(1500)}, 2000);

$(".delete").click(function(e){
	var check=confirm('Are you sure?');

	if(!check){
		e.preventDefault();
	}

 });

});
</script>
<?php 
  if (isset($this->session->userdata['msg']) && $this->session->userdata['msg']) {

?>            

            <div class="<?php echo $this->session->userdata['type']; ?>">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="icon-remove"></i>
                                    </button>
                                   <?php echo $this->session->userdata['msg'];
                                   $data['type']='';
                                   $data['msg']='';
                                   $this->session->set_userdata($data); 
                                   ?>
            </div>
 <?php 
          
    }

  ?>

<section id="widget-grid" class="">
				
					<!-- row -->
					<div class="row">
				
						<!-- NEW WIDGET START -->
						
						<!-- WIDGET END -->
				
					</div>				
				</section>
                
                
                
                
                <section id="widget-grid" class="">
                
                <div class="row">
				
						<!-- NEW WIDGET START -->
						<article class="col-sm-12 col-md-12  col-lg-12">
                        
                        
                        
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
									<h2>General Trip List</h2>

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
													<th>SL</th>
													<th>Work Order</th>
													<th>Truck Number</th>
													<th><center>Booked for</th>
													<th>Total Load</th>
													<th>Total Fare</th>
													<th>Remarks</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												  if($trips){
													foreach($trips as $trip){
														
													
												?>
												<tr>    <td><?php echo ++$offset;?></td>
													<td><?php echo $trip['order_id'];?></td>
													<td><?php echo $trip['truck_number'];?></td>
													<td><center><?php echo date('Y-M-d(H:m)',$trip['start_time']); ?> To <?php echo date('Y-M-d(H:m)',$trip['end_time']); ?></center></td>
													<td><?php echo $trip['total_load'];?></td>
													<td><?php echo $trip['total_fare'];?></td>
													<td><?php echo $trip['remarks'];?></td>
													<?php if($trip['is_final']==0){ ?>
													<td>
														<div class="btn-group">
															<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																Action <span class="caret"></span>
															</button>
															<ul class="dropdown-menu">
																<li>
																	<a href="<?php echo base_url().'trip/edit_general_trip/'.$trip['trip_id'];?>" >Edit</a>
																</li>
																<li>
																	<a class="delete" href="<?php echo base_url().'trip/delete_general_trip/'.$trip['trip_id'];?>">Delete</a>
																</li>
																<li>
																	<a class="delete" href="<?php echo base_url().'trip/general_trip_finalize/'.$trip['trip_id'];?>">Finalize</a>
																</li>
																
															</ul>
														</div>
                                                    
                                                                                                        </td>
													<?php
													}
													?>
												</tr>
												<?php
												     }
													
												  }
												?>
                                                                                               
											</tbody>
										</table>

									</div>
									<center><?php echo $this->pagination->create_links(); ?></center>
									<!-- end widget content -->

								</div>
								<!-- end widget div -->

							</div>
                        
                        </article>
                        </div>
				</section>