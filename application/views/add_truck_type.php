<script type="text/javascript">
	$(function(){
		$('#submit_form').submit(function(e){
			var truck_type= $('#truck_type').val().trim();
			if(truck_type !=''){
				$('#submit_form').submit();
			}
			else{
				alert('Empty data can not be submitted.');
				e.preventDefault();
			}
		});
		$('.delete_button').on('click',function(e2){
			var cnfrm = confirm('Are you sure ?');
			if (cnfrm==true) {
				
			}
			else
				e2.preventDefault();
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
                        <h2>Add Truck Type</h2>

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

                            <form class="form-horizontal" id="submit_form" action="<?php echo base_url() . 'truck/submit_truck_type'; ?>" method="post">

                                <fieldset>
                                    <legend>Add Truck Type</legend>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Truck Type</label>
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Truck Type" class="form-control" name="truck_type" id="truck_typeX" value="">
                                            <span class="text-danger">
                                            	<?php echo form_error('truck_type'); ?>
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
                               <div class="row">
                              <div class="col-md-12">
                                  <form class="form-horizontal" action="<?php echo base_url().'truck/update_truck_type'; ?>" method="post">
                                      <fieldset>
                                          <legend>Edit Type</legend>
                                          
                                          <div class="form-group">
                                              <label class="col-md-2 control-label">Type List</label>
                                              <div class="col-md-6">
                                                  <select class="form-control project_category" name="truck_type2">
                                                      <option value="">Please select</option>
                                                        <?php if ($results) { ?>
                                                            <?php foreach ($results as $data) { ?>
                                                              <option value="<?php echo $data['type_id']; ?>"><?php echo $data['type_name']; ?></option>
                                                            <?php } ?>
                                                        <?php }?>
                                                  </select>
                                                   <?php echo form_error('truck_type2'); ?>
                                                  <script type="text/javascript">
							$(document).ready(function(e) {
                                                    	$(".project_category option[value='<?php echo set_value('user_section') ?>']").attr('selected', 'selected');
                                               		 });
                                                  </script>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-2 control-label">New Type Name</label>
                                              <div class="col-md-6">
                                                  <input class="form-control" placeholder="Category Name" type="text" name="new_name" value="<?php echo set_value('new_name'); ?>">
                                                  <span class="text-danger"><?php echo form_error('new_name'); ?></span>
                                              </div>
                                          </div>
                                          </fieldset>
                                          <div class="form-actions">
                                              <div class="row">
                                                  <div class="col-md-12" align="center">
                                                      <button class="btn btn-primary" type="submit">
                                                          <i class="fa fa-save"></i>
                                                          Submit
                                                      </button>
                                                  </div>
                                              </div>
                                          </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                
                                 <legend>Type List</legend>
                                    <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Type Name</th>
                                        <th>Delete</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                          <?php if ($results) { $i = 1; ?>
                                            <?php foreach ($results as $data) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $data['type_name']; ?></td>	
                                                <td><a class="btn btn-danger btn-sm delete_button" href="<?php echo base_url().'truck/delete_truck_type/'.$data['type_id'];?>">Delete</a></td>
                                            </tr>	
                                            <?php $i++; } ?>
                                        <?php }
					else
						echo '<td><span class="text-danger">There is no data in truck type.</span></td>';
					?>
                                    </tr>
                                </tbody>
                            </table>
                                
                                </div>
                            </div>
    
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
