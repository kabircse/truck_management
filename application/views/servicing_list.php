<script>
	$(function(){
		$('.delete_button').on('click',function(e2){
			var cnfrm = confirm('Are you sure ?');
			if (cnfrm==true) {
				
			}
			else
			    e2.preventDefault();
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
			<p align="center"><?php echo $this->session->flashdata('msg')?></p>
		</div>
		<?php }
		?>
	    </div>
	</div>
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
						<h2><?php echo $title;?></h2>
		
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
										<th>Truck Number</th>
										<th>Servicing Categories</th>
										<th>Mechanic Cost</th>
										<th>Garage</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if($servicing_info){
										foreach($servicing_info as $row){?>
											<tr>
												<td><?php echo $i++;?></td>
												<td><?php echo $row['truck_number']?></td>
												<td><?php
													$serv_cat_id = explode(',',$row['servicing_category_id']);
													$count = count($serv_cat_id);
														foreach($serv_cat_id as $id){
															$j = 1;
															foreach($categories as $cat){
																if($id == $cat['id']){
																	echo $cat['name'];
																	$j++;
																}
																if($j<$count)
																	echo ', ';
															}
														}
												?></td>
												<td><?php echo $row['mechanic_cost']?></td>
												<td><?php
													if($row['garage'] == 1)
														echo 'Own Garage';
													else
														echo 'Out Garage';
												?></td>
												<td><?php echo date('d/m/Y',strtotime($row['date']))?></td>
												<td>
												<div class="btn-group">
														<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
															Action <span class="caret"></span>
														</button>
														<ul class="dropdown-menu">
															<li>
																<a class="" href="<?php echo site_url('servicing/add_servicing_detail/'.$row['id']);?>">Add Servicing Details</a>
															</li>
															<li>
																<a class="" href="<?php echo site_url('servicing/servicing_hisotry/'.$row['id']);?>">Servicing History</a>
															</li>
															<li>
																<a href="<?php echo site_url('servicing/edit_servicing_info/'.$row['id']);?>">Edit</a>
															</li>
															<li>
																<a class="delete_button" href="<?php echo site_url('settings/delete_servicing_info/'.$row['id']);?>">Delete</a>
															</li>
														</ul>
													</div>
												</td>
											<?php
											   }
											}
											else
												echo '<td><span class="text-danger">There is no servicing info.</span></td>';
											?>
											</tr>
									</tbody>
							</table>
							<center><?php echo $this->pagination->create_links(); ?></center>
						</div>
						<!-- end widget content -->
					</div>
					<!-- end widget div -->
				</div>                     
			</article>
                </div>
	</section>