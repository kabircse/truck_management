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
										<th>Quantity</th>
										<th>Unit Price</th>
										<th>Total Price</th>
										<th>Supplier</th>
										<th>Chalan No</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if($fuel_expenses){
										foreach($fuel_expenses as $expense){?>
											<tr>
												<td><?php echo $i++;?></td>
												<td><?php echo $expense['truck_number']?></td>
												<td><?php echo $expense['quantity']?></td>
												<td><?php echo $expense['unit_price']?></td>
												<td><?php echo $expense['total_price']?></td>
												<td><?php echo $expense['chalan_no']?></td>
												<td><?php echo $expense['supplier_name']?></td>
												<td><?php echo date('d/m/Y',strtotime($expense['date']))?></td>
												<td>
													<div class="btn-group">
														<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
															Action <span class="caret"></span>
														</button>
														<ul class="dropdown-menu">
															<li>
																<a href="<?php echo site_url('expense/edit_fuel_expense/'.$expense['id']);?>">Edit</a>
															</li>
															<li>
																<a class="delete_button" href="<?php echo site_url('expense/delete_fuel_expense/'.$expense['id']);?>">Delete</a>
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
							<center><?php echo $this->pagination->create_links(); ?></center>
						</div>
						<!-- end widget content -->
					</div>
					<!-- end widget div -->
				</div>                     
			</article>
                </div>
	</section>