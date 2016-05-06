<script>
$(function(){

 $("#end_point").prop('readonly',true);

  $("#start_point").change(function(){
    if($("#start_point").val()!=''){
      $("#end_point").removeAttr('disabled');  
     $.post('<?php echo base_url();?>trip/get_end_points',{start:$('#start_point').val()},function(data){
        //alert(data);
        $("#end_point").html(data);    

    

     });

    }
    else{
         $("#end_point").prop('disabled',true);
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
                        <h2>Edit Trip Fare</h2>

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

                            <form class="form-horizontal" action="<?php echo base_url() . 'trip/update_trip_fare/'.$trip['id']; ?>" method="post">

                                <fieldset>
                                    <legend>Edit Trip Fare</legend>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Start Point</label>
                                        <div class="col-md-6">
                                        	
                                                <?php 
                                                    $data=array(
                                                              '' =>'Select Please'
                                                        );

                                                 foreach ($points as $point){

                                                     ////echo "<option value='".$point['id']."'>".$point['points_name']."</option>";
                                                     $data[$point['id']] =$point['points_name'];

                                                  }

                                                  echo form_dropdown('start_point',$data,$trip["start_point"],'class="form-control" id="start_point"');
                                                ?>
                                           
                                            <span class="text-danger"><?php echo form_error('start_point');?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">End Point</label>
                                        <div class="col-md-6">
                                        	 <?php 
                                                    $data=array(
                                                              '' =>'Select Please'
                                                        );

                                                 foreach ($points as $point){

                                                     ////echo "<option value='".$point['id']."'>".$point['points_name']."</option>";
                                                     $data[$point['id']] =$point['points_name'];

                                                  }

                                                  echo form_dropdown('end_point',$data,$trip["end_point"],'class="form-control" id="end_point"');
                                                ?>
                                           
                                            <span class="text-danger"><?php echo form_error('end_point');?></span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Goods</label>
                                        <div class="col-md-6">
                                            <?php 
                                                    $data=array(
                                                              '' =>'Select Please'
                                                        );

                                                 foreach ($goods as $good){

                                                     ////echo "<option value='".$point['id']."'>".$point['points_name']."</option>";
                                                     $data[$good['id']] =$good['goods_name'];

                                                  }

                                                  echo form_dropdown('goods',$data,$trip["goods"],'class="form-control" id="end_point"');
                                                ?>
                                            <span class="text-danger"><?php echo form_error('goods');?></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Standard Load</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="/Kg" type="text" name="st_load" value="<?php echo $trip['st_load'];?>">
                                            <span class="text-danger"><?php echo form_error('st_load');?></span>
                                        </div>
                                    </div>


                                   
                                    <div id="extra">
                                     <div class="form-group">
                                        <label class="col-md-2 control-label">Extra Load</label>
                                        <div class="col-md-3">
                                            <input class="form-control" placeholder="/Kg" type="text" name="extra_load" value="<?php  echo $trip['extra_load_unit'];?>">
                                            <span class="text-danger"><?php echo form_error('extra_load');?></span>
                                     </div>


                                   
                                        <label class="col-md-2 control-label">Extra Charge</label>
                                        <div class="col-md-3">
                                           <input type="text" placeholder="Taka" class="form-control" name="extra_charge" value="<?php echo $trip['extra_load_charge']; ?>">
                                                <span class="text-danger"><?php echo form_error('extra_charge');?></span>   
                                        </div>
                                     </div>
                                   </div>


                                   <div class="form-group">
                                        <label class="col-md-2 control-label">Fixed Fare</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Fare" id="fixed_fare" type="text" name="fixed_fare" value="<?php echo $trip['fare']; ?>" />
                                            <span class="text-danger"><?php echo form_error('fare');?></span>
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
