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
			<p><?php echo $this->session->flashdata('msg')?></p>
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
						<h2>Truck List</h2>
		
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
										<th class="text-center">Category</th>
										<th class="text-center">Amount</th>
										<th class="text-center">Remarks</th>
                                        <th class="text-center">Date</th>
										<th class="text-center action">action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									
									if($expenses){
										foreach($expenses as $expense){?>
											<tr>
												<td class="text-center"><?php echo $i++;?></td>
												<td class="text-center"><?php echo $expense['category_name']?></td>
												<td class="text-center"><?php echo $expense['amount']?></td>
												<td class="text-center"><?php echo $expense['remarks']?></td>
                                                <td class="text-center"><?php echo $expense['date']?></td>
												
												<td class="action-btn">
													<div class="btn-group">
														<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
															Action <span class="caret"></span>
														</button>
														<ul class="dropdown-menu">
															<li>
																<a href="<?php echo site_url('expense/edit_expense/'.$expense['id']);?>">Edit</a>
															</li>
															<li>
																<a class="delete_button" href="<?php echo site_url('expense/delete_expense/'.$expense['id']);?>">Delete</a>
															</li>
													
														</ul>
													</div>
												</td>
										<?php
										}
											}
											else
												echo '<td><span class="text-danger">There is no expense info.</span></td>';
											?>
									</tr>
								</tbody>
							</table>
							<center><?php echo $this->pagination->create_links(); ?></center></tr>
						</div>
						<!-- end widget content -->
					</div>
					<!-- end widget div -->
				</div>                     
			</article>
                </div>
	</section>