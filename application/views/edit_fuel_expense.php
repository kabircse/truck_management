<script>
    $(function(){
        $('#unit_price').keyup(function(){
            var unit_price = $('#unit_price').val().trim();
            var quantity = $('#quantity').val().trim();
            if (quantity=='') {
               var quantity = '1';
            }
            $('#total_price').val(unit_price*quantity);
        });
        $('#quantity').keyup(function(){
            var unit_price = $('#unit_price').val().trim();
            var quantity = $('#quantity').val().trim();
            if (unit_price=='') {
               var unit_price = '1';
            }
            $('#total_price').val(unit_price*quantity);
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
                        <h2><?php echo $title?></h2>
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
                            <form class="form-horizontal" action="<?php echo base_url() . 'expense/update_fuel_expense/'; ?>" method="post">                              <?php
                                if($fuel_expense){
                                    foreach($fuel_expense as $f_ex){
                                    echo form_hidden('id',$f_ex['id']);
                                ?>
                                <fieldset>
                                    <legend><?php echo $title?></legend>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Supplier Name</label>
                                        <div class="col-md-6">
                                        <?php
                                            $suppliers_array = array(''=>'Select Please');
						    ///if ($suppliers){
                                                            foreach ($suppliers as $supplier)
								$suppliers_array[$supplier['id']] = $supplier['supplier_name'];
							     echo form_dropdown('supplier_id',$suppliers_array,$f_ex['supplier_id'],'class="form-control"');
						    //}
					?>
                                            <span class="text-danger"><?php echo form_error('supplier_id');?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Truck No</label>
                                        <div class="col-md-6">
                                        <?php
                                            $trucks_array = array(''=>'Select Please');
						    ///if ($suppliers){
                                                            foreach ($trucks as $row)
								$trucks_array[$row['truck_id']] = $row['truck_number'];
							     echo form_dropdown('truck_id',$trucks_array,$f_ex['truck_id'],'class="form-control"');
						    //}
					?>
                                            <span class="text-danger"><?php echo form_error('truck_id');?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Chalan No</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Chalan No" type="text"  name="chalan_no" value="<?php echo $f_ex['chalan_no']?>">
                                            <span class="text-danger"><?php echo form_error('chalan_no');?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Quantity</label>
                                        <div class="col-md-3">
                                            <input class="form-control" placeholder="Quantity" id="quantity" type="text" name="quantity" value="<?php echo $f_ex['quantity']?>">
                                            <span class="text-danger"><?php echo form_error('quantity');?></span>
                                        </div>

                                        <label class="col-md-2 control-label">Unit Price</label>
                                        <div class="col-md-3">
                                            <input class="form-control" placeholder="Unit Price" id="unit_price" type="text" name="unit_price" value="<?php echo $f_ex['unit_price']?>">
                                            <span class="text-danger"><?php echo form_error('unit_price');?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Total Price</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Total Price" type="text" id="total_price" name="total_price" value="<?php echo $f_ex['total_price']?>">
                                            <span class="text-danger"><?php echo form_error('total_price');?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="col-md-2 control-label">Date:</label>
                                         <div class="input-group col-md-6">
                                                <input type="text" name="start" placeholder="Select a date" class="form-control datepicker" data-dateformat="dd/mm/yy" value="<?php echo date('d/m/Y',strtotime($f_ex['date']))?>">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <span class="text-danger"><?php echo form_error('start');?></span>
                                        </div>
                                    </div>                                   
                                    <div class="form-actions">
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
                            <?php }
                            }
                            else
                               echo '<span class="text-danger">There is no data.</span>';
                            ?>
                            </form>
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
