<script>
	$(function(){
		$('.delete_button').on('click',function(e2){
			var cnfrm = confirm('Are you sure ?');
			if (cnfrm==true) {
				
			}
			else
			    e2.preventDefault();
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
						<h2><?php echo $title;?></h2>
		
					</header>
					<div class="print-back">
						<div class="back_btn pull-left">
							<a href="javascript:void(0)" class="btn btn-sm btn-success back"> <i class="glyphicon glyphicon-chevron-left"></i> Back </a>
						</div>
						<div class="print_btn pull-right">
							<a href="javascript:void(0)" class="btn btn-sm btn-success print"> <i class="fa fa-print"></i> Print This </a>
						</div>
					</div>
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
										<th class="text-center">No</th>
										<th class="text-center">Truck Type</th>
										<th class="text-center">Truck Number</th>
										<th class="text-center">Engine Number</th>
										<th class="text-center">Chesis Number</th>
										<th class="text-center action">action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									//$i = 1;
									if($truck_list){
										foreach($truck_list as $truck){?>
											<tr>
												<td class="text-center"><?php echo $i++;?>
												<td class="text-center"><?php echo $truck['type_name']?></td>
												<td class="text-center"><?php echo $truck['truck_number']?></td>
												<td class="text-center"><?php echo $truck['engine_number']?></td>
												<td class="text-center"><?php echo $truck['chesis_number']?></td>
												<td>
													<div class="btn-group action-btn">
														<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
															Action <span class="caret"></span>
														</button>
														<ul class="dropdown-menu">
															<li>
																<a href="<?php echo site_url('truck/edit_truck/'.$truck['truck_id']);?>">Edit</a>
															</li>
															<li>
																<a class="delete_button" href="<?php echo site_url('truck/delete_truck/'.$truck['truck_id']);?>">Delete</a>
															</li>
															<li>
																<a class="" href="<?php echo site_url('truck/fuel_report/'.$truck['truck_id']);?>">Fuel Report</a>
															</li>
														</ul>
													</div>
												</td>
											</tr>
											<?php
											   }
											}
											else
												echo '<tr><td colspan="5"><span class="text-danger">There is no truck info.</span></td></tr>';
											?>
											
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