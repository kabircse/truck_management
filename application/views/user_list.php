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
										<th>Name</th>
										<th>Email</th>
										<th>User Type</th>
										<th>Registration Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if($users){
										foreach($users as $row){?>
											<tr>
												<td><?php echo $i++;?></td>
												<td><?php echo $row['name']?></td>
												<td><?php echo $row['email']?></td>
												<td><?php
													if($row['user_type']==1)
														$user = 'Admin';
													else
														$user = 'Normal';
													echo $user;?></td>
												<td><?php echo date('d/m/Y',strtotime($row['date']))?></td>
												<td><?php
													if($row['is_active']==1)
														$status = 'Active';
													else
														$status = 'Deactive';
													echo $status?></td>
												<td>
													<div class="btn-group">
														<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
															Action <span class="caret"></span>
														</button>
														<ul class="dropdown-menu">
															<li>
															<?php if($row['is_active']==1){?>
																<a class="deactive_button" href="<?php echo site_url('settings/deactivate_user/'.$row['id']);?>">Deactive</a>
															<?php }
															else {?>
																<a class="active_button" href="<?php echo site_url('settings/activate_user/'.$row['id']);?>">Active</a>
																<?php }?>
															</li>
																														<li>
																<a href="<?php echo site_url('settings/edit_user/'.$row['id']);?>">Edit</a>
															</li>
															<li>
																<a class="delete_button" href="<?php echo site_url('settings/delete_user/'.$row['id']);?>">Delete</a>
															</li>
														</ul>
													</div>
												</td>
											<?php
											   }
											}
											else
												echo '<td><span class="text-danger">There is no user.</span></td>';
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