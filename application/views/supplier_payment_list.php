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
		head,header,aside,title,.action,.action-btn,.pagination,.date_range,.print-back,.menu,#shortcut,#ribbon{
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
										<form class="navbar-form navbar-right" role="search" action="<?php echo base_url() . 'supplier/supplier_payment_search';?>" method="GET">
										  <div class="form-group date_range">
											From: <input type="text" name="start_date" placeholder="Select start date" class="form-control datepicker" data-dateformat="yy-mm-dd" value=""  required="true">
											To:   <input type="text" name="end_date" placeholder="Select end date" class="form-control datepicker" data-dateformat="yy-mm-dd" value=""  required="true">
										  </div>
										  <button type="submit" class="btn btn-success">Search</button>
										</form>
										<br><br>
										<table class="table table-bordered">
											<thead>
												<tr>
													<th class="text-center">No.</th>
													<th class="text-center">Supplier Name</th>
                                                    
													<th class="text-center">Supplier Type</th>
													<th class="text-center">Paid Amount</th>
													<th class="text-center">Remarks</th>
													<th class="text-center">Date</th>
						
													
												</tr>
											</thead>
											<tbody>
											<?php
											$i = 0;
											if($suppliers_payment){
											 foreach ($suppliers_payment as $supplier) {
											 ?>
												<tr>
													<td class="text-center"><?php echo ++$i;?></td>
													<td class="text-center"><a href="<?php echo base_url() . 'supplier/view_supplier_payment/'.$supplier['id']?>"><?php echo $supplier['supplier_name']; ?></a></td>
													<td class="text-center"><?php if($supplier['supplier_type']==1) echo 'Parmanent'; else echo 'Temporary'; ?></td>
													<td class="text-center"><?php echo $supplier['paid_amount']; ?></td>
													<td class="text-center"><?php echo $supplier['remarks']; ?></td>
													<td class="text-center"><?php echo $supplier['date']; ?></td>
                                                    
												</tr>
										 <?php 
										      }
                                           
										}
										else
											echo '<tr><td class="text-danger text-center" colspan="6">There is no data.</td></tr>';
										 ?>
                                              
											</tbody>
										</table>
									<center class="pagination"><?php echo $this->pagination->create_links(); ?></center>
									</div>
									<!-- end widget content -->

								</div>
								<!-- end widget div -->

							</div>
                        
                        </article>
                        </div>
				</section>