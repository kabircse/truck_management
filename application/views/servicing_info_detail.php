<script>
    $(function(){
	
	 function fetch_fare(id){
     
           $.post('<?php echo base_url()?>servicing/fetch_suppliers',function(data){
	       
	     $('#supplier'+id).html(data);
	    
	   });
  
        }
	function fetch_parts(id){
     
           $.post('<?php echo base_url()?>servicing/fetch_parts',function(data){
	       
	     $('#parts'+id).html(data);
	    
	   });
  
        }
	
        fetch_fare('1');
	fetch_parts('1');
	
	var num=1;
	$('#num').val(num);
	
	function hide_fields(id){
	    $("#sup"+id).hide();
	    $("#pri"+id).hide();
	    $('#radio'+id).val('inner');
	    
	}
	
	function show_fields(id){
	    $("#sup"+id).show();
	    $("#pri"+id).show();
	    $('#radio'+id).val('outer');
	}
	
	function check_submit(e){
	   
	    
	}
	
	$('.invent').click(function(){
	    var id=$(this).attr('id');
	    id=id.slice(-1);
	    hide_fields(id);
	       
	});
	$('.outer').click(function(){
	    var id=$(this).attr('id');
	    id=id.slice(-1);
	    show_fields(id);
	    
	});
	
	$('#add').click(function(){
	     ++num;
	    $('#num').val(num);
	    $("#form_in").append('<div class="form-group"> \
                                        <label class="col-md-2 control-label">Use of Parts</label>\
                                        <div class="col-md-6"> \
					 <div class="col-md-3"> \
						<label class="radio"> \
							<input type="radio" name="radio'+num+'" id="radio'+num+'"class="outer" checked="checked" value="outer"> \
							<i></i>Outer</label> \
					     <span class="text-danger"></span> \
                                            </div> \
                                            <div class="col-md-3"> \
						<label class="radio"> \
						    <input type="radio" name="radio'+num+'" id="radio'+num+'" class="invent">\
						    <i></i>Inventory</label> \
                                            </div> \
                                        </div> \
                                    </div> \
				    <div id="form_in"> \
                                    <div class="form-group"> \
                                        <label class="col-md-2 control-label">Parts</label> \
                                        <div class="col-md-6"> \
                                        	<select class="form-control" name="use_of_parts" name="parts'+num+'" id="parts'+num+'"> \
                                            	<option value="">Select Please</option> \
                                                <option value="light">Light</option> \
                                            </select> \
                                            <span class="text-danger"></span> \
                                        </div> \
                                    </div> \
                                    <div class="form-group" id="sup'+num+'"> \
                                        <label class="col-md-2 control-label">Supplier</label> \
                                        <div class="col-md-6"> \
                                        	<select class="form-control" name="supplier'+num+'" id="supplier'+num+'"> \
                                            	<option value="">Select Please</option> \
                                                <option value="abcd">abcd</option> \
                                            </select> \
                                            <span class="text-danger"></span> \
                                        </div> \
				    </div> \
                                    <div class="form-group" > \
                                        <label class="col-md-2 control-label">Quantity</label> \
                                        <div class="col-md-4"> \
                                            <input class="form-control" placeholder="" type="text" name="quantity'+num+'" id="quantity'+num+'"> \
                                            <span class="text-danger"></span> \
                                        </div> \
                                    </div> \
                                    <div class="form-group" id="pri'+num+'" > \
                                        <label class="col-md-2 control-label">Price</label> \
                                        <div class="col-md-6"> \
                                            <input class="form-control" placeholder="Price" type="text" name="price'+num+'" id="price'+num+'"> \
                                            <span class="text-danger"></span> \
                                        </div> \
                                    </div>');
	   
	    fetch_fare(num);
	    fetch_parts(num);
	    
	   
	    $('.invent').click(function(){
		var id=$(this).attr('id');
		id=id.slice(-1);
		hide_fields(id);
	       
	    });
	    $('.outer').click(function(){
		var id=$(this).attr('id');
		id=id.slice(-1);
		show_fields(id);
	    
	    });
	    
	});
	
	$('#form').submit(function(e){
	   var i;
	   for(i=1;i<=num;i++){
	    
		if ($("#radio"+i).val()=="outer"){
		   
		   if($("#parts"+i).val()=='') {
		   
		    $("#parts"+i).focus();
		      e.preventDefault();
		   }
		   else if($("#supplier"+i).val()=='') {
		    $("#supplier"+i).focus();
		      e.preventDefault();
		   }
		   else if($("#quantity"+i).val()=='') {
		    $("#quantity"+i).focus();
		      e.preventDefault();
		   }
		   
		   else if($("#price"+i).val()=='') {
		    $("#price"+i).focus();
		      e.preventDefault();
		   }

		}
		else{
		    
		   if($("#parts"+i).val()=='') {
		    $("#parts"+i).focus();
		      e.preventDefault();
		   }
		  else if($("#quantity"+i).val()=='') {
		    $("#quantity"+i).focus();
		      e.preventDefault();
		   }
		}
		
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
                    <header>
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2>Add Servicing Details</h2>
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

                            <form id="form" class="form-horizontal" action="<?php echo base_url() . 'servicing/insert_servicing_detail'; ?>" method="post">
                                <input name="num" id="num" type="hidden" />
								<input name="truck_id" id="truck_id" value="<?php echo $truck_id; ?>" type="hidden"/>
                                <fieldset>
                                    <legend><?php echo $title;?></legend>
				                               
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Use of Parts</label>
                                        <div class="col-md-6">
                                             <div class="col-md-3">
                                            <label class="radio">
                                                <input type="radio" name="radio1" id="radio1" value="outer" class="outer" checked="checked">
                                                <i></i>Outer</label>														
                                            <span class="text-danger"></span>
                                            </div>
                                            <div class="col-md-3">
                                              <label class="radio">
                                                  <input type="radio" name="radio1" id="radio1" class="invent" >
                                                  <i></i>Inventory</label>
                                            </div>
                                           
                                        </div>
                                        
                                    </div>
				   				  <div id="form_in">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Parts</label>
                                        <div class="col-md-6">
                                        	<select class="form-control" name="parts1" id="parts1">
                                            	<option value="">Select Please</option>
                                                <option value="1">Light</option>
                                                
                                            </select>
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="sup1">
                                        <label class="col-md-2 control-label">Supplier</label>
                                        <div class="col-md-6">
                                        	<select class="form-control" name="supplier1" id="supplier1">
                                            	<option value="">Select Please</option>
                                                <option value="1">abcd</option>
                                            </select>
                                            <span class="text-danger"></span>
                                        </div>
				    				</div>
                                    <div class="form-group" >
                                        <label class="col-md-2 control-label">Quantity</label>
                                        <div class="col-md-4">
                                            <input class="form-control" placeholder="" type="text" name="quantity1" id="quantity1">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="pri1">
                                        <label class="col-md-2 control-label">Unit Price</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Price" type="text" name="price1" id="price1">
                                            <span class="text-danger"></span>
                                        </div>
                                        
                                        
                                    </div>
				 				</div>
                                    <div class="form-group">
                                    
                                        <label class="col-md-2 control-label">Remarks</label>
                                        <div class="col-md-6">
                                            <textarea class="custom-scroll" rows="3" cols="38" name="remarks"></textarea>
                                            <span class="text-danger"></span>
                                        </div>
					
										<div class="col-md-2">
                                        	<button class="btn" id="add" type="button" value="Add Another">
                                                      
                                                    <i class="fa fa-plus"></i>
                                                    &nbsp; Add Another
                                             </button>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                       <label class="col-md-2 control-label">Date:</label>
                                         <div class="input-group col-md-6">
                                                <input type="text" name="date" placeholder="Select a date" class="form-control datepicker" data-dateformat="yy/mm/dd" value="<?php echo $this->input->post('date'); ?>">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>   
                                                <span class="text-danger"><?php  echo form_error('date'); ?></span>
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
