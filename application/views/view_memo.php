<script>
	$(function(){
		$('.print').on('click',function(){
			window.print();
		});
		$('.back').on('click',function(){
			window.history.back();
		});
	});
</script>
<style>
	.action_btn{
		padding-bottom: 3%;
	}
	.invoice_title{
		margin-left: 45%;
		font-variant: small-caps;
		color: green;
		
	}
	.print_btn{
		float: right;
		margin-top: -1%;
	}
	.back_btn{
		float: left;
		margin-top: -1%;
	}
	.invoice{
		float: right;
		margin-top: -10%;
	}
	.print-content{
		margin-left: 5%;
		margin-right: 5%
	}
	.neat_total{
		margin-left: 65%;
	
	}
	.print_data{
		margin-top: 5%;
	}
	.alc{
		text-align: center;
		padding: 2%;
	}
	
	@media print{
		head,header,aside,title,.action_btn,.row,.menu,#shortcut,#ribbon{
			display: none;
		}
	}
</style>
<div class="print-content">
	<div class="action_btn">
		<div class="back_btn">
			<a href="javascript:void(0)" class="btn btn-sm btn-success back"> <i class="glyphicon glyphicon-chevron-left"></i> Back </a>
		</div>
		<div class="print_btn">
			<a href="javascript:void(0)" class="btn btn-sm btn-success print"> <i class="fa fa-print"></i> Print This </a>
		</div>
	</div>
	<div class="invoice_info">
		<div class="invoice_title"><b>INVOICE</b></div>
		<br>
			<div class="address">
				<address>
					<?php if($supplier){?>
					<?php echo $supplier['organization_name']?>,
					<br>
					<strong><?php echo $supplier['supplier_name']?></strong>,
					<br>
					<?php
						if($supplier['supplier_type']==1){
							echo 'Fuel Supplier ,';
						}
						else
							echo 'Inventory Supplier ,';
					?>
					<br>
					<?php echo $supplier['address']?>,
					<br>
					<abbr>Contact No:</abbr> <?php echo $supplier['contact_no'];}?>.
					<br><br>
				</address>
			</div>
			<div class="invoice">
						<strong>INVOICE NO :</strong>
						<span class=""><?php echo nbs(4); echo date('dm-his');?></span>
						<br/>					
						<strong>INVOICE DATE :</strong>
						<span class=""><?php echo $supplier_payment['date'];?></span>
			</div>
	</div>
	<div class="print_data">
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="alc">No.</th>
					<th class="alc">Remarks</th>
					<th class="alc">Amount(Tk.)</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$total = 0.00;
				if($supplier_payment){
					$total = $total+$supplier_payment['paid_amount'];
				?>
				<tr>
					<td class="alc"><strong>1</strong></td>
					<td class="alc"><?php echo $supplier_payment['remarks']?></td>
					<td class="alc"><?php echo $supplier_payment['paid_amount'];?></td>
				</tr>
				
				<?php }?>
					<tr>
						
					</tr>
					<tr>
						<td colspan="2">Total</td>
						<td class="text-center alc"><strong><?php echo $total?></strong></td>
					</tr>
				

			</tbody>
		</table>
		
		<hr><hr>
			<h3 class="neat_total"><strong>Total (Tk): <span class="text-success"><?php echo $supplier_payment['paid_amount'].'.00'?></span></strong></h3>
	</div>
</div>
														