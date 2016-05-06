<script>
    $(function(){
	$(".servicing_cat").select2();
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
        <section id="widget-grid" class=""></section>
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
                            <form class="form-horizontal" action="<?php echo base_url() . 'servicing/submit_servicing_info'; ?>" method="post">
				
                                <fieldset>
                                    <legend><?php echo $title?></legend>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Truck No</label>
                                        <div class="col-md-6">
					<?php
					if($trucks){
					   $truck_array = array(''=>'Select Please');
					    foreach($trucks as $truck)
						$truck_array[$truck['truck_id']] = $truck['truck_number'];
						echo form_dropdown('truck_id',$truck_array,'','class="form-control"');
					}?>
                                            <span class="text-danger"><?php echo form_error('truck_id')?></span>
                                        </div>
                                    </div>
				    
				    <div class="form-group">
                                        <label class="col-md-2 control-label">Servicing Category</label>
                                        <div class="col-md-6">
					    <?php if($servicing_category){
					    //$servicing_category_array = array(''=>'Select Please');
					    foreach($servicing_category as $serv_cat)
						$servicing_category_array[$serv_cat['id']] = $serv_cat['name'];
						echo form_dropdown('servicing_cat[]',$servicing_category_array,'',' placeholder="Select Please" class="col-md-10 servicing_cat" multiple="multiple" class="form-control" ');
					}?>
                                            <span class="text-danger"><?php echo form_error('servicing_cat')?></span>
                                        </div>
                                    </div>
                                    
				    <div class="form-group">
					 <label class="col-md-2 control-label">Mechanic Cost</label>
					 <div class="col-md-6">
					     <input class="form-control" placeholder="Mechanic Cost" type="text" name="mechanic_cost" value="" required="true">
					     <span class="text-danger">
						 <?php echo form_error('mechanic_cost')?>
					     </span>
					 </div>
				     </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Garage</label>
                                        <div class="col-md-6">
                                            <label class="radio-inline"><input class="form-control" type="radio" name="garage" value="1" checked='1'>Own garage</label>
					    <label class="radio-inline"><input class="form-control" type="radio" name="garage" value="2">Out garage</label>
                                            <span class="text-danger"></span>
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
