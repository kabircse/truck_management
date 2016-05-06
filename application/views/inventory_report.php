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
                        <h2>Product Report</h2>

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

                            <form class="form-horizontal" action="<?php echo base_url() . 'inventory/submit_date_for_report/'.$product_id; ?>" method="post">

                                <fieldset>
                                    <div class="form-group">
                                       <label class="col-md-4 control-label">Start Date:</label>
                                         <div class="col-md-4">
                                                <input type="text" name="start_date" placeholder="Select a date" class="form-control datepicker" data-dateformat="yy-mm-dd" value="<?php echo set_value('start_date'); ?>">
                                                  
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                       <label class="col-md-4 control-label">End Date:</label>
                                         <div class="col-md-4">
                                                <input type="text" name="end_date" placeholder="Select a date" class="form-control datepicker" data-dateformat="yy-mm-dd" value="<?php echo set_value('end_date'); ?>">
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
