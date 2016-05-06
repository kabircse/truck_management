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
                        <h2>Add Supplier Info</h2>

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

                            <form class="form-horizontal" action="<?php echo base_url() . 'supplier/insert_supplier'; ?>" method="post">

                                <fieldset>
                                    <legend>Add Supplier Info</legend>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Supplier Type</label>
                                        <div class="col-md-6">
                                            <select name = 'type' class= "form-control">
                                                <option value=''>--Select--</option>
                                                <option value='1'>Fuel Supplier </option>
                                                <option value='2'>Inventory Supplier</option>
                                                
                                            </select>
                                             <span class="text-danger"><?php  echo form_error('type'); ?></span>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Supplier Name</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Name" type="text" name="name" value="<?php echo $this->input->post('name'); ?>">
                                            <span class="text-danger"><?php  echo form_error('name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Organization Name</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Organization Name" type="text" name="org_name" value="<?php echo $this->input->post('org_name'); ?>">
                                            <span class="text-danger"><?php  echo form_error('org_name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    
                                        <label class="col-md-2 control-label">Address</label>
                                        <div class="col-md-6">
                                            <textarea class="custom-scroll" rows="3" name="address" ><?php echo $this->input->post('address'); ?></textarea>
                                           <span class="text-danger"><?php  echo form_error('name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Contact No.</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Contact No." type="text" name="contact_no" value="<?php echo $this->input->post('contact_no'); ?>">
                                            <span class="text-danger"><?php  echo form_error('contact_no'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Email</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Email" type="text" name="email" value="<?php echo $this->input->post('email'); ?>">
                                            <span class="text-danger"><?php  echo form_error('email'); ?></span>
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
