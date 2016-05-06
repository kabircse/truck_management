<title><?php $title; ?></title>
<script type="text/javascript">
    
$(function(){

     $('#total_price').prop('readonly',true);

 $("#unit_price").change(function(){

    if(!isNaN($("#unit_price").val()) && !isNaN($("#quantity").val())){

           var tp=$("#unit_price").val()*$("#quantity").val();
           $('#total_price').val(tp);         
     }
     else{
         $("#unit_price").val('');
         $("#quantity").val('');
         $('#total_price').val('');


     }

 });

 $("#quantity").change(function(){

    if(!isNaN($("#unit_price").val()) && !isNaN($("#quantity").val())){

           var tp=$("#unit_price").val()*$("#quantity").val();
           $('#total_price').val(tp);         
    }

 });

});

</script>
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
                        <h2>Edit Work Order</h2>

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

                          <form class="form-horizontal" action="<?php echo base_url().'work_order/update_work_order/'.$work_order['id'];?>" method="post">

                                <fieldset>
                                    <legend>Edit Work Order</legend>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Client Name</label>
                                        <div class="col-md-6">
                                        <?php 
                                               $options = array(
                                                              ''  => 'Select Please',
                                                              'BAT'    => 'BAT',
                                                              'Others'   => 'Others',
                                                              
                                                            );

                                            $shirts_on_sale = array('small', 'large');

                                            echo form_dropdown('client_name', $options, $work_order['client_name'],'class="form-control"');

                                        ?>
                                            
                                            <span class="text-danger"><?php  echo form_error('client_name'); ?></span>
                                        </div>
                                    </div>
                                    <input name="id" value="<?php echo $work_order['id']; ?>" type="hidden" />
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Order Number</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Order Number" id="order_id" type="text" name="order_id" value="<?php echo $work_order['order_id']; ?>" >
                                            <span class="text-danger"><?php  echo form_error('order_id'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Description</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Description" id="total_fare" type="text" name="description" value="<?php echo $work_order['description']; ?>" >
                                            <span class="text-danger"><?php  echo form_error('description'); ?></span>
                                        </div>
                                    </div>
                                    
                                   
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Quantity</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Quantity" id="quantity" type="text" name="quantity" value="<?php echo $work_order['quantity']; ?>">
                                            <span class="text-danger"><?php  echo form_error('quantity'); ?></span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Unit Price</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Unit Price" id="unit_price" type="text" name="unit_price" value="<?php echo $work_order['unit_price']; ?>">
                                            <span class="text-danger"><?php  echo form_error('unit_price'); ?></span>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Total Price</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Total Price" id="total_price" type="text" name="total_price" value="<?php echo $work_order['total_price']; ?>">
                                            <span class="text-danger"><?php  echo form_error('total_price'); ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="col-md-2 control-label">Purchase Order Date</label>
                                         <div class="input-group col-md-6">
                                                <input type="text" name="order_date" placeholder="Select a date" class="form-control datepicker" data-dateformat="yy/mm/dd" value="<?php echo $work_order['order_date']; ?>">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>   
                                                <span class="text-danger"><?php  echo form_error('order_date'); ?></span>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                       <label class="col-md-2 control-label">Delivery Date</label>
                                         <div class="input-group col-md-6">
                                                <input type="text" name="delivery_date" placeholder="Select a date" class="form-control datepicker" data-dateformat="yy/mm/dd" value="<?php echo $work_order['delivery_date']; ?>">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>   
                                                <span class="text-danger"><?php  echo form_error('delivery_date'); ?></span>
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
