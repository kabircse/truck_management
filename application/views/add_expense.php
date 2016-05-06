	<div class="row">
            <div class="col-md-8 col-md-offset-2">
		<?php
		if($this->session->flashdata('sign')){?>
		<div class="<?php echo $this->session->flashdata('sign')?>">
			<button type="button" class="close" data-dismiss="alert">
				<i class="icon-remove"></i>
			</button>
			<p><?php echo $this->session->flashdata('msg')?></p>
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

                            <form class="form-horizontal" action="<?php echo base_url() . 'expense/submit_expense'; ?>" method="post">

                                <fieldset>
                                    <legend><?php echo $title;?></legend>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Select Category</label>
                                        <div class="col-md-6">
					      <?php
						    $expense_category_array = array(''=>'Select Please');
						    if ($expense_category){
                                                            foreach ($expense_category as $category)
								$expense_category_array[$category['id']] = $category['name'];
							     echo form_dropdown('category_id',$expense_category_array,'','class="form-control"');
						    }
					      ?>
                                            <span class="text-danger">
						<?php echo form_error('category_id')?>
					    </span>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Amount</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="Amount" type="text" name="amount" value="">
                                            <span class="text-danger">
						<?php echo form_error('amount')?>
					    </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    
                                        <label class="col-md-2 control-label">Remarks</label>
                                        <div class="col-md-6">
                                            <textarea class="custom-scroll" name ="remarks" rows="3"></textarea>
                                            <span class="text-danger">
						<?php echo form_error('remarks')?>
					    </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="col-md-2 control-label">Date:</label>
                                         <div class="input-group col-md-6">
                                                <input type="text" name="start" placeholder="Select a date" class="form-control datepicker" data-dateformat="dd/mm/yy" value="">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>   
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
