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
									<h2>Supplier List</h2>

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
													<th>No.</th>
													<th>Supplier Name</th>
													<th>Organization Name</th>
													<th>Supplier Type</th>
													<th>Address</th>
													<th>Contact No</th>
													<th>Total</th>
													<th>Due</th>
													<th>action</th>
												</tr>
											</thead>
											<tbody>
											<?php
											$i=0;
											if($suppliers){
											 foreach ($suppliers as $supplier) {
											 	# code...
											 
											?>
												<tr>
													<td><?php echo ++$i;?></td>
													<td><a href="<?php echo base_url() . 'supplier/view_supplier_payment/'.$supplier['id']?>"><?php echo $supplier['supplier_name']; ?></a></td>
													<td><?php echo $supplier['organization_name']; ?></td>
													<td><?php if($supplier['supplier_type']==1) echo 'Fuel Supplier'; else echo 'Inventory Supplier'; ?></td>
													<td><?php echo $supplier['address']; ?></td>
													<td><?php echo $supplier['contact_no']; ?></td>
													<td><?php echo $supplier['total']; ?></td>
													<td><?php echo ($supplier['total']-$supplier['paid']); ?></td>
                                                    
									<td>
										<div class="btn-group">
											<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
												Action <span class="caret"></span>
											</button>
											<ul class="dropdown-menu">
												<li>
													<a href="<?php echo base_url()."supplier/add_payment/".$supplier['id'];?>">Add Payment</a>
												</li>
												<li>
													<a href="<?php echo base_url()."supplier/view_supplier_payment/".$supplier['id'];?>">View Payment</a>
												</li>
												<li>
													<a href="<?php echo base_url()."supplier/edit_supplier/".$supplier['id'];?>">Edit</a>
												</li>
												<li>
													<a href="<?php echo base_url()."supplier/delete_supplier/".$supplier['id'];?>" class="delete">Delete</a>
												</li>

												
											</ul>
										</div>
                                                    
									</td>
												</tr>
										 <?php 
										      }
                                           
                                           }
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