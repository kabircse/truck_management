		
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
                                    <h2>Edit Driver</h2>
            
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
            
                                        <form class="form-horizontal" action="<?php echo base_url();?>driver/edit_driver_validation" method="post" enctype="multipart/form-data">
            
                                            <fieldset>
                                                <legend>Edit Driver</legend>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Driver Name</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" placeholder="Driver Name" type="text" name="name" value="<?php echo $driver['name']; ?>">
                                                        <span class="text-danger"><?php  echo form_error('name'); ?></span>
                                                    </div>
                                                </div>
                                                <input name="old_id" value="<?php echo $driver['id']; ?>" type="hidden" />
                                                <div class="form-group">
                                                    <label class="control-label col-md-2" for="prepend">ID</label>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="ID" class="form-control" name="id" value="<?php echo $driver['id']; ?>">
                                                        <span class="text-danger"><?php  echo form_error('id'); ?></span>
                                                    </div>
            
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Phone Number</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" placeholder="Contact Number" type="text" name="phn_number" value="<?php echo $driver['phone_no']; ?>">
                                                        <span class="text-danger"><?php  echo form_error('phn_number'); ?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Address</label>
                                                    <div class="col-md-6">
                                                        <textarea class="form-control" placeholder="Address" rows="4" name="address" ><?php echo $driver['address']; ?></textarea>
                                                        <span class="text-danger"><?php  echo form_error('address'); ?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Picture</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" placeholder="Contact Number" type="file" name="img_file" value="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                
                                                                                    
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12" align="center">
                                                            <a class="btn btn-default" href="<?php echo base_url().'driver/driver_list'; ?>">
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

