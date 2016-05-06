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
                        <h2>Add Client Info</h2>

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

                            <form class="form-horizontal" action="<?php echo base_url() . 'client/submit_client'; ?>" method="post">

                                <fieldset>
                                    <legend>Add Client Info</legend>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Client Type</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="client_type">
                                            	<option value="">--Select Please--</option>
                                                <option value="1">BAT</option>
                                                <option value="2">Others</option>
                                            </select>
                                            <span class="text-danger">
												<?php echo form_error('client_type')?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Client Name</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Name" type="text" name="client_name" value="<?php echo set_value('client_name')?>" required="true">
                                            <span class="text-danger">
												<?php echo form_error('client_name')?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Organization Name</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Organization Name" type="text" name="org_name" value="<?php echo set_value('org_name')?>" required="true">
                                            <span class="text-danger">
												<?php echo form_error('org_name')?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    
                                        <label class="col-md-2 control-label">Address</label>
                                        <div class="col-md-6">
                                            <textarea class="custom-scroll" placeholder="Address" name="address" rows="3" required="true"><?php echo set_value('address')?></textarea>
                                            <span class="text-danger">
												<?php echo form_error('address')?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Contact No.</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Contact No." type="text" name="contact_no" value="<?php echo set_value('contact_no')?>" required="true">
                                            <span class="text-danger">
												<?php echo form_error('contact_no')?>
					    					</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Email</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Email" type="email" name="email" value="<?php echo set_value('email')?>" required="true">
                                            <span class="text-danger">
												<?php echo form_error('email')?>
					    					</span>
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
    <!-- end widget grid -->
</div>
<!-- END MAIN CONTENT -->
