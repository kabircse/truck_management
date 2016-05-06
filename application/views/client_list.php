<script>
	$(function(){
		$('.delete').on('click',function(e){
			var cnfrm = confirm('Are you sure ?');
			if (cnfrm==true) {
				$('form').submit();
			}
			else{
				e.preventDefault();
			}
		});
		$('.print').on('click',function(){
			window.print();
		});
		$('.back').on('click',function(){
			window.history.back();
		});
	});
</script>
<style>
	.alc{
		text-align: center;
		padding: 2%;
	}
	@media print{
		head,header,aside,title,.action,.action-btn,.print-back,.menu,#shortcut,#ribbon{
			display: none;
		}
	}
</style>
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
									<h2><?php echo $title?></h2>
									

								</header>

								<!-- widget div-->
								
								<div class="print-back">
									<div class="back_btn pull-left">
										<a href="javascript:void(0)" class="btn btn-sm btn-success back"> <i class="glyphicon glyphicon-chevron-left"></i> Back </a>
									</div>
									<div class="print_btn pull-right">
										<a href="javascript:void(0)" class="btn btn-sm btn-success print"> <i class="fa fa-print"></i> Print This </a>
									</div>
								</div>
									<!-- widget edit box -->
									<div class="jarviswidget-editbox">
										<!-- This area used as dropdown edit box -->

									</div>
									<!-- end widget edit box -->

									<!-- widget content -->
									<div class="widget-body">
									<?php if($clients){
									?>
										<table class="table table-bordered">
											<thead>
												<tr>
													<th class="text-center">No.</th>
													<th class="text-center">Client Name</th>
													<th class="text-center">Organization Name</th>
													<th class="text-center">Client Type</th>
													<th class="text-center">Address</th>
													<th class="text-center">Contact No</th>
													<th class="text-center">Email</th>
													<th class="action">action</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($clients as $row){
											if($row['client_type']==1)
												$type = 'BAT';
											else if($row['client_type']==1)
												$type = 'Others';
											
											?>
											
												<tr>
													<td class="text-center"><?php echo $i++; ?></td>
													<td class="text-center"><?php echo $row['client_name']; ?></td>
													<td class="text-center"><?php echo $row['organization_name']; ?></td>
													<td class="text-center"><?php echo $type; ?></td>
													<td class="text-center"><?php echo $row['address']; ?></td>
													<td class="text-center"><?php echo $row['contact_no']; ?></td>
													<td class="text-center"><?php echo $row['email']; ?></td>
							<td>
                                                    	<div class="btn-group action-btn">
											<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
												Action <span class="caret"></span>
											</button>
											<ul class="dropdown-menu">
												<li>
													<a href="<?php echo site_url('/client/edit_client/'.$row['id'])?>">Edit</a>
												</li>
												<li>
													<a class="delete" href="<?php echo site_url('/client/delete_client/'.$row['id'])?>">Delete</a>
												</li>
												
											</ul>
										</div>
                                                    
                                                    </td>
						</tr>
						<?php }
						?>
					</tbody>
				</table>
				<center><?php echo $this->pagination->create_links(); ?></center>
				<span class="text-danger">
				<?php }
				else
					echo "There is no client info";
				?>
				</span>
			</div>
			<!-- end widget content -->
			</div>
		<!-- end widget div -->               
        </article>
	</div>
</section>