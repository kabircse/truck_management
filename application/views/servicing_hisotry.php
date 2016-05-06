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
										<form class="navbar-form navbar-right" role="search" action="<?php echo base_url() . 'servicing/servicing_search/'.$truck_id;?>" method="GET">
										  <div class="form-group">
											From: <input type="text" name="start_date" placeholder="Select start date" class="form-control datepicker" data-dateformat="yy-mm-dd" value=""  required="true">
											To:   <input type="text" name="end_date" placeholder="Select end date" class="form-control datepicker" data-dateformat="yy-mm-dd" value=""  required="true">
										  </div>
										  <button type="submit" class="btn btn-success">Search</button>
										</form>
										<br><br>
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>SL.</th>
													<th>Supplier Name</th>
													<th>Parts Name</th>
													<th>Quantity</th>
													<th>Unit Price</th>
													<th>Total Price</th>
													<th>Remarks</th>
													<th>Date</th>
						
													
												</tr>
											</thead>
											<tbody>
											<?php
											$i = 0;
											if($results){
											 foreach ($results as $result) {
											 ?>
												<tr>
													<td><?php echo ++$offset;?></td>
													<td><?php echo $result['supplier_name']; ?></td>
													<td><?php echo $result['products_name']; ?></td>
													<td><?php echo $result['quantity']; ?></td>
													<td><?php echo $result['price']; ?></td>
													<td><?php echo $result['quantity']*$result['price']; ?></td>
													<td><?php echo $result['remarks']; ?></td>
													<td><?php echo date('Y-M-d',strtotime($result['date'])); ?></td>
                                                    
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