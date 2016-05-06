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

							<p>Truck Number : <b><?php echo  $truck['truck_number'];?></b></p>
							<p>Truck Type : <b><?php echo  $truck['type_name'];?></b></p>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Supplier Name</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Unit Price</th>
										<th class="text-center">Total Price</th>
										<th class="text-center">Date</th>
										
									</tr>
								</thead>
								<tbody>
									<?php
									
									if($fuel_list){
										foreach($fuel_list as $truck){?>
											<tr>
												<td class="text-center"><?php echo $i++;?>
												<td class="text-center"><?php echo $truck['supplier_name']?></td>
												<td class="text-center"><?php echo $truck['quantity']?></td>
												<td class="text-center"><?php echo $truck['unit_price']?></td>
												<td class="text-center"><?php echo $truck['total_price']?></td>
												<td class="text-center"><?php echo $truck['date']?></td>
												
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