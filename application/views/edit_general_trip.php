<script>
$(function(){

setTimeout(function(){$(".alert").fadeOut(1500)}, 2000);

$(".delete").click(function(e){
	var check=confirm('Are you sure?');

	if(!check){
		e.preventDefault();
	}

 });

});
</script>
<?php 
  if (isset($this->session->userdata['msg']) && $this->session->userdata['msg']) {

?>            

            <div class="<?php echo $this->session->userdata['type']; ?>">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="icon-remove"></i>
                                    </button>
                                   <?php echo $this->session->userdata['msg'];
                                   $data['type']='';
                                   $data['msg']='';
                                   $this->session->set_userdata($data); 
                                   ?>
            </div>
 <?php 
          
    }

  ?>


<script>
$(function(){
      function fetch_available_trucks(){
        
        if ($('#start_date').val!='' && $('#end_date').val!='' && $('#start_time').val!='' && $('#end_tme').val!=''){
       
           $.post('<?php echo base_url();?>trip/fetch_available_trucks',{truck:$('#tr').val(),sd:$('#start_date').val(),ed:$('#end_date').val(),st:$('#start_time').val(),et:$('#end_time').val()},function(data){
              $("#truck").html(data);
	       $("#truck").val($("#tr").val());
            });
        }
      }
      function check_time(){
        if ($('#start_date').val!='' && $('#end_date').val()!='' && $('#start_time').val()!='' && $('#end_tme').val()!=''){  
           if ($('#start_date').val() == $('#end_date').val()) {
            $.post('<?php echo base_url();?>trip/check_time',{sd:$('#start_date').val(),ed:$('#end_date').val(),st:$('#start_time').val(),et:$('#end_time').val()},function(data){
               
               if (data=='invalid') {
                
                //alert('Check Your time');
                $('#end_time').val('');
               }
              
              });
          }
        } 
      }

  
  
      $('#start_date').change(function(){
        
          if ($('#start_date').val()!='') {
          
            $('#end_date').prop('disabled',false);
            $('#end_time').prop('disabled',false);
            
          }
          else{
            $('#end_date').prop('disabled',true);
            $('#end_time').prop('disabled',true);
          }
           
           check_time();
      });
  
      $('#end_date').change(function(){
        if ($('#start_date').val() > $('#end_date').val()) {
             alert("End date cannot be greater than Start date");
             $('#end_date').val('');
           //  $('#end_date').focus();
          }
          else{
            check_time();
            fetch_available_trucks();
          }
        
      });
      
      $('#start_time').change(function(){
        check_time();
         
      });
      $('#end_time').change(function(){
        check_time();
         
      });
 


    $("#start_point").change(function(){
        if($("#start_point").val()!=''){
          $("#end_point").removeAttr('disabled');  
         $.post('<?php echo base_url();?>trip/get_end_points',{start:$('#start_point').val()},function(data){
          
            $("#end_point").html(data);    
    
        
    
         });
    
        }
        else{
             $("#end_point").prop('disabled',true);
        }
  
    });
    
    $('#goods').change(function(){
      free_load();
      });
    
  
  
    $("#total_load").keyup(function(){
        
        fetch_fare();
       
      });

});
</script>

<!-- widget grid -->
                <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-sm-12 col-md-10  col-lg-12">

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
                        <h2>Edit General Trip</h2>

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
                          
                            <input name="tr" id="tr" value="<?php echo $trip['tid']?>" type="hidden" />
                            <form class="form-horizontal" action="<?php echo base_url() . 'trip/update_general_trip/'.$trip['trip_id']; ?>" method="post">

                                <fieldset>
					  				<input name="id" value="<?php echo $trip['trip_id'];?>" type="hidden">
                                    <legend>Edit General Trip</legend>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Work Order</label>
                                        <div class="col-md-3">
                                            <?php
                                             $data=array(
                                                  '' => "Select Please",
                                                              );
                                             foreach ($work_orders as $order) {
                                                 $data[$order['id']]=$order['order_id'];
                                             }
                                             echo form_dropdown('work_order',$data,$trip['work_order_id'],'class="form-control"');
                                             ?>

                                           <span class="text-danger"><?php echo form_error('work_order');?></span>
                                        </div>
                                    </div>
 
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Start Date</label>
                                        <div class="col-md-2">
                                            <input type="text" name="start_date" id="start_date" placeholder="Select a date" class="form-control datepicker" data-dateformat="yy/mm/dd" value="<?php echo date('Y-m-d',$trip['start_time']); ?>" />
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                            <span class="text-danger"><?php echo form_error('start_date'); ?></span>
                                            
                                        </div>
                                        <div class="col-md-2">
                                          <input class="form-control" id="start_time" name="start_time" type="text" placeholder="Select time" value="<?php echo date('g:i A',$trip['start_time']);?>" />
                                          <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                          <span class="text-danger"><?php echo form_error('start_time'); ?></span>
                                        </div>
                                        <label class="col-md-1 control-label">End Date</label>
                                        <div class="col-md-2">
                                           <input type="text" name="end_date" id="end_date" placeholder="Select a date" class="form-control datepicker" data-dateformat="yy/mm/dd" value="<?php echo date('Y-m-d',$trip['end_time']); ?>" />
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                            <span class="text-danger"><?php echo form_error('end_date'); ?></span>  
                                        </div>
                                        <div class="col-md-2">
                                          <input class="form-control" id="end_time" name="end_time" type="text" placeholder="Select time" value="<?php echo date('g:i A',$trip['end_time']); ?>" />
                                           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                           <span class="text-danger"><?php echo form_error('end_time'); ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Truck</label>
                                        <div class="col-md-3">
                                          <?php
                                             $data=array(
						 $trip['tid'] =>$trip['truck_number'],
                                                );
                                             echo form_dropdown('truck',$data,$this->input->post('truck'),'class="form-control" id="truck"');
  

                                          ?>
                                            <span class="text-danger"><?php echo form_error('truck');?></span>
                                        </div>
                                    </div>  

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Start Point</label>
                                        <div class="col-md-3">
                                        <?php
                                          $data=array(

                                                   '' => "Select Please"
                                              );
                                           foreach ($points as $point) {
                                                $data[$point['id']]=$point['points_name'];
                                            } 

                                            echo form_dropdown('start_point',$data,$trip['start_point'],'class="form-control" id="start_point" ');
 
                                        ?>
                                           <span class="text-danger"><?php echo form_error('start_point'); ?></span>  
                                        </div>
                                        <label class="col-md-1 control-label">End Point</label>
                                        <div class="col-md-3">
                                        	<?php
                                                   $data=array(

                                                       '' => "Select Please"
                                                  );

                                                  foreach ($points as $point) {
                                                    $data[$point['id']]=$point['points_name'];
                                                    } 

                                                echo form_dropdown('end_point',$data,$trip['end_point'],'class="form-control" id="end_point" ');
 
                                            ?>
                                             <span class="text-danger"><?php echo form_error('end_point');?></span>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label class="col-md-2 control-label select">Goods</label>
					<div class="col-md-3">
                                           <input class="form-control" placeholder=""  id="goods" name="goods" value="<?php echo $trip['goods']; ?> " autocomplete='off' />
                                            <span class="text-danger"><?php echo form_error('goods'); ?></span>
                                        </div>

                                    </div>
                                       
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Total Load</label>
                                        <div class="col-md-3">
                                           <input class="form-control" placeholder="/Kg"  id="total_load" name="total_load" value="<?php echo $trip['total_load']; ?> " autocomplete='off' />
                                            <span class="text-danger"><?php echo form_error('total_load'); ?></span>
                                        </div>
                                    </div>

				    <div class="form-group">
                                        <label class="col-md-2 control-label">Total Fare</label>
                                        <div class="col-md-3">
                                             <input class="form-control no_edit" placeholder="Total Fare" type="text" name="total_fare" id="total_fare" value="<?php echo $trip['total_fare']; ?> ">
                                            <span class="text-danger"><?php echo form_error('total_fare'); ?></span>
                                        </div>
                                        
                                    </div>
                                  
                                    
                                    <div class="form-group">
                                    
                                        <label class="col-md-2 control-label">Remarks</label>
                                        <div class="col-md-6">
                                            <textarea class="custom-scroll col-md-5" name="remarks"><?php echo $trip['remarks']; ?></textarea>
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    
                                    

                                     <div class="form-group">
                                       <label class="col-md-2 control-label">Date:</label>
                                         <div class="input-group col-md-3">
                                                <input type="text" name="submit_date" placeholder="Select a date" class="form-control datepicker" data-dateformat="yy/mm/dd" value="<?php echo $trip['entry_date']; ?> ">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <span class="text-danger"><?php echo form_error('submit_date'); ?></span>
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