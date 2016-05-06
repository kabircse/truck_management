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
                        <h2>Start and End Point</h2>

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

                            <form class="form-horizontal" action="<?php echo base_url() . 'trip/insert_point'; ?>" method="post">

                                <fieldset>
                                    <legend>Start and End Point</legend>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Point Name</label>
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Point Name" class="form-control" name="point_name" value="<?php $this->input->post('point_name');?>">
                                            <span class="text-danger"><?php echo form_error('point_name'); ?></span>
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
     <section id="widget-grid" class="">
                
                <div class="row">
                
                        <!-- NEW WIDGET START -->
                        <article class="col-sm-12 col-md-8 col-md-offset-2 col-lg-8">
                        
                        
                        
                        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-editbutton="false">
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
                                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                    <h2>Goods List</h2>

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
                                        
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Goods Name</th>
                                                    
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php if($points){
                                               foreach($points as $point){ 
                                            ?>
                                                <tr>
                                                    <td><?php echo $point['points_name']; ?></td>

                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                                Action <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="<?php echo base_url().'trip/edit_point/'.$point['id']; ?>">Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a class="delete" href="<?php echo base_url().'trip/delete_point/'.$point['id']; ?>">Delete</a>
                                                                </li>
                                                                
                                                            </ul>
                                                        </div>
                                                    
                                                    </td>
                                                </tr>
                                            <?php 
                                             
                                                  }

                                              }

                                            ?>
                                               
                                            </tbody>
                                        </table>

                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            </div>
                        
                        </article>
                        </div>
                </section>
                    
                
                <!-- end widget grid -->

            </div>
            <!-- END MAIN CONTENT -->