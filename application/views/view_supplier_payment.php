<title><?php $title; ?></title>
<script>
$(function(){
	setTimeout(function(){$(".alert").fadeOut(1500)}, 2000);
	$(".delete").click(function(e){
		var check=confirm('Are you sure?');
		if(!check){
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
								
										<?php
										//echo var_dump($supplier_payments);
										if($supplier_payments){
										foreach ($supplier_payments as $supplier) {
											$supplier_info[] = $supplier['supplier_id'];
											$supplier_info[] = $supplier['supplier_name'];
											$supplier_info[] = $supplier['supplier_type'];
											$supplier_info[] = $supplier['organization_name'];
										}
										
										?>
										<form class="navbar-form navbar-right" role="search" action="<?php echo base_url() . 'supplier/view_supplier_payments';?>" method="GET">
										  <div class="form-group">
											From: <input type="text" name="start_date" placeholder="Select start date" class="form-control datepicker" data-dateformat="yy-mm-dd" value=""  required="true">
											To:   <input type="text" name="end_date" placeholder="Select end date" class="form-control datepicker" data-dateformat="yy-mm-dd" value=""  required="true">
											<input type="hidden" name="id" value="<?php echo $supplier_info[0]?>">
										  </div>
										  <button type="submit" class="btn btn-success">Search</button>
										</form>
										<br><br>
									
										<p>Supplier Name : <b><?php echo  $supplier_info[1]?></b></p>
										<p>Supplier Organization : <b><?php echo  $supplier_info[3]?></b></p>
										<p>Supplier Type :<b><?php
										if($supplier_info[2 ]==1){
										    echo 'Fuel Supplier';
										}
										else
										    echo 'Inventory Supplier';
									}?></b></p>
										<table class="table table-bordered">
											<thead>
												<tr>
													<th class="text-center">No.</th>
													<th class="text-center">Date</th>
													<th class="text-center">Paid Amount</th>
													<th class="text-center">Remarks</th>
													<th class="action">Action</th>
												</tr>
											</thead>
											<tbody>
											<?php
											$i = 0;
											if($supplier_payments){
											 foreach ($supplier_payments as $supplier) {
											 	
											 
											?>
												<tr>
													<td class="text-center"><?php echo ++$i;?></td>
													<td class="text-center"><?php echo $supplier['date']; ?></td>
													<td class="text-center"><?php echo $supplier['paid_amount']; ?></td>
													<td class="text-center"><?php echo $supplier['remarks']; ?></td>
													<td>
														<div class="btn-group action-btn">
															<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																Action <span class="caret"></span>
															</button>
															<ul class="dropdown-menu">
																<li>
																	<a href="<?php echo base_url()."supplier/view_memo/".$supplier['id'];?>">View Memo</a>
																</li>
																<li>
																	<a href="<?php echo base_url()."supplier/delete_payment/".$supplier['id'];?>" class="delete">Delete</a>
																</li>
				
																
															</ul>
														</div>
										    
													</td>
                                                    
												</tr>
											<?php 
												}
                                           
											}
											else
												echo '<tr><td class="text-danger text-center" colspan="6">There is no data.</td></tr>';
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