<script>
    $(function(){
	$('.add_payment').submit(function(e){
	    var total_due = $('.total_due').val().trim();
	    var payment_amount = $('.payment_amount').val().trim();
		if ((total_due-payment_amount)<0) {
		    alert('Payment amount can not be more than total due.');
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
    <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-sm-12 col-md-8 col-md-offset-2 col-lg-8">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
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
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
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
                            <p>Supplier Name : <b><?php echo $getSupplier['supplier_name']; ?></b></p>
			    <p>Organization Name : <b><?php echo $getSupplier['organization_name']; ?></b></p>
                            <p>Supplier Type :<b><?php
			    if($getSupplier['supplier_type']==1){
				echo 'Fuel Supplier';
			    }
			    else
				echo 'Inventory Supplier';
			    ?></b></p>
			    <?php if(($getSupplier['total']-$getSupplier['paid'])>0){?>
                            <form class="form-horizontal add_payment" action="<?php echo base_url() . 'supplier/submit_payment'; ?>" method="post">
                                <fieldset>
                                    <legend></legend>
                                    <?php echo form_hidden('supplier_id',$getSupplier['id']);
					echo form_hidden('supplier_type',$getSupplier['supplier_type']);
				    ?>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Total Due</label>
                                        <div class="col-md-6">
                                            <input class="form-control total_due" type="text" name="total_due" readonly="true" value="<?php echo $getSupplier['total']-$getSupplier['paid']?>">
                                            <span class="text-danger"><?php echo form_error('total_due')?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Payment Amount</label>
                                        <div class="col-md-6">
                                            <input class="form-control payment_amount" placeholder="Payment Amount" type="text" name="payment_amount" required="true" value="">
                                            <span class="text-danger"><?php echo form_error('payment_amount')?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Remarks</label>
                                        <div class="col-md-6">
                                            <textarea class="custom-scroll" name="remarks" rows="3" cols="38" required="true" ></textarea>
                                            <span class="text-danger"><?php  echo form_error('remarks'); ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                       <label class="col-md-2 control-label">Date:</label>
                                         <div class="input-group col-md-6">
                                                <input type="text" name="date" placeholder="Select a date" class="form-control datepicker" data-dateformat="yy-mm-dd" value=""  required="true">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>   
                                                <span class="text-danger"><?php  echo form_error('date'); ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-actions submit_btn">
                                        <div class="row">
                                            <div class="col-md-12" align="center">
                                                <a class="btn btn-default" href="">
                                                    Cancel
                                                </a>
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fa fa-save"></i>
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
			    <span class="text-danger">
			    <?php }
			    else
				echo "He has no due.";
			    ?>
			    </span>
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
                <!-- end widget -->
            </article>
            <!-- WIDGET END -->
        </div>              
    </section>
                    
                
                <!-- end widget grid -->

            </div>
            <!-- END MAIN CONTENT -->
