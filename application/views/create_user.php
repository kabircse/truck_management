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
						<span class="widget-icon"> <i class="fa fa-eye"></i></span>
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
							<div class="widget-body no-padding">
								<form class="form-horizontal" action="<?php echo base_url() . 'settings/submit_user'; ?>" method="post">
									<fieldset>
									    <legend><?php echo $title;?></legend>
									    <div class="form-group">
										<label class="col-md-2 control-label">Name</label>
										<div class="col-md-6">
										    <input class="form-control" placeholder="Name" type="text" name="name" value="<?php echo set_value('name')?>" required="true">
										    <span class="text-danger">
											<?php echo form_error('name')?>
										    </span>
										</div>
									    </div>
									    <div class="form-group">
										<label class="col-md-2 control-label">User Name</label>
										<div class="col-md-6">
										    <input class="form-control" placeholder="User Name" type="text" name="user_name" value="<?php echo set_value('user_name')?>" required="true">
										    <span class="text-danger">
											<?php echo form_error('user_name')?>
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
									     <div class="form-group">
										<label class="col-md-2 control-label">Password</label>
										<div class="col-md-6">
										    <input class="form-control" placeholder="Password" type="password" name="password" value="<?php echo set_value('password')?>" required="true">
										    <span class="text-danger">
											<?php echo form_error('password')?>
										    </span>
										</div>
									    </div>
									   <div class="form-group">
										<label class="col-md-2 control-label">Confirm Password</label>
										<div class="col-md-6">
										    <input class="form-control" placeholder="Confirm Password" type="password" name="cnf_password" value="<?php echo set_value('cnf_password')?>" required="true">
										    <span class="text-danger">
											<?php echo form_error('cnf_password')?>
										    </span>
										</div>
									    </div>
									   <div class="form-group">
										<label class="col-md-2 control-label">User Type</label>
										<div class="col-md-6">
										    <select class="form-control" name="user_type">
											<option value="">Select Please</option>
											<option value="1">Admin</option>
											<option value="2">Normal</option>
										    </select>
										    <span class="text-danger">
											<?php echo form_error('user_type')?>
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
		</section>                
<!-- END MAIN CONTENT -->