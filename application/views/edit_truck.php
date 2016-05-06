
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
                        <?php foreach($truck as $tr){?>
                            <form class="form-horizontal" action="<?php echo base_url() . 'truck/update_truck/'.$tr['truck_id']; ?>" method="post">

                                <fieldset>
                                    <legend><?php echo $title;?></legend>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Truck Type</label>
                                        <div class="col-md-6">
                                            <?php
                                            foreach($results as $data)
                                                $type_array[$data['type_id']] = $data['type_name'];
                                                $js = "class='form-control' value='".$tr['type_name']."'";
                                            echo form_dropdown('truck_type',$type_array,'',$js)?>
                                            <span class="text-danger"><?php echo form_error('truck_type')?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="prepend">Truck Number</label>
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Truck Number" class="form-control" name="truck_number" value="<?php echo $tr['truck_number']?>">
                                            <span class="text-danger"><?php echo form_error('truck_number')?></span>
                                        </div>

                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Engine Number</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Engine Number" type="text" name="engine_number" value="<?php echo $tr['engine_number']?>">
                                            <span class="text-danger"><?php echo form_error('engine_number')?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Chesis Number</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Chesis Number" type="text" name="chesis_number" value="<?php echo $tr['chesis_number']?>">
                                            <span class="text-danger"><?php echo form_error('chesis_number')?></span>
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
                        <?php }?>
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
