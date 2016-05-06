<title><?php $title; ?></title>
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
                        <h2>Edit Supplier Info</h2>

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

                            <form class="form-horizontal" action="<?php echo base_url() . 'work_order/insert_payment'; ?>" method="post">

                                <fieldset>
                                    <legend>Payment</legend>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Work Order</label>
                                        <div class="col-md-6">
                                        <?php
                                         $option=array(
                                             
                                             $work_order['id'] => $work_order['order_id'],
                                             

                                            );
                                         echo form_dropdown('work_order',$option,$work_order['id'],'class="form-control" readonly="true"');

                                        ?>
                                             <span class="text-danger"><?php  echo form_error('type'); ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Total Price</label>
                                        <div class="col-md-6">
                                            
                                            <input class="form-control" type="text" name="total_price" value="<?php echo $work_order['total_price']; ?> " readonly="true" />
                                            <span class="text-danger"><?php  echo form_error('name'); ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Total Paid</label>
                                        <div class="col-md-6">
                                            <?php if($payments!=0){
                                             $paid=$payments['paid_amount'];
                                            }
                                            else{
                                              $paid=0;
                                            }
                                            ?>
                                            <input class="form-control" type="text" name="paid" value="<?php echo $paid; ?> " readonly="true" />
                                            <span class="text-danger"><?php  echo form_error('name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Amount</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Amount" type="text" name="amount" value="<?php echo $this->input->post('amount'); ?>">
                                            <span class="text-danger"><?php  echo form_error('amount'); ?></span>
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
