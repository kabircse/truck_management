<title><?php $title; ?></title>

<aside id="left-panel">
    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it --> 

            <a href="javascript:void(0);" id="show-shortcut">
<!--                <img src="<?php echo base_url(); ?>assets/img/avatars/sunny.png" alt="me" class="online" /> -->
                <span>
                    <?php 
                    $session = $this->session->userdata('check');
                    echo $session['name'];
                    ?>
                </span>
                <i class="fa fa-angle-down"></i>
            </a> 

        </span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive

    To make this navigation dynamic please make sure to link the node
    (the reference to the nav > ul) after page load. Or the navigation
    will not initialize.
    -->
    <nav>
            <!-- NOTE: Notice the gaps after each icon usage <i></i>..
            Please note that these links work a bit different than
            traditional hre="" links. See documentation for details.
        -->

        <ul>
					<li>
						<a href="<?php echo base_url().'dashboard'; ?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
					</li>
                    
                    <li>
						<a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">Driver Info.</span></a>
						<ul>
							<li>
								<a href="<?php echo base_url().'driver/add_driver'; ?>">Add Driver</a>
							</li>
							<li>
								<a href="<?php echo base_url().'driver/driver_list'; ?>">Driver List</a>
							</li>
							
                            
						</ul>
					</li>
					
					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">Truck Info.</span></a>
						<ul>
                        	<li>
								<a href="<?php echo base_url().'truck/add_truck_type'; ?>">Truck Type</a>
							</li>
							<li>
								<a href="<?php echo base_url().'truck/add_truck'; ?>">Add Truck </a>
							</li>
							<li>
								<a href="<?php echo base_url().'truck/truck_list'; ?>">Truck List</a>
							</li>
							
                            
						</ul>
					</li>


					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">Work Order</span></a>
						<ul>
                        	<li>
								<a href="<?php echo base_url().'work_order/add_work_order'; ?>">Add work order</a>
							</li>
							<li>
								<a href="<?php echo base_url().'work_order/work_order_list'; ?>">Work order List</a>
							</li>
							
                            
						</ul>
					</li>
                    
                    <li>
						<a href="#"><i class="fa fa-lg fa-fw fa-dashboard"></i> <span class="menu-item-parent">Trip Fare.</span></a>
						<ul>
						<li>
								<a href="<?php echo base_url().'trip/add_transport_goods_category'; ?>">Add Transport Goods Category</a>
							</li>
							<li>
								<a href="<?php echo base_url().'trip/transport_goods_list'; ?>">Transport Goods List</a>
							</li>
							<li>
								<a href="<?php echo base_url().'trip/add_point'; ?>">Start & End Point</a>
							</li>
							<li>
								<a href="<?php echo base_url().'trip/add_trip_fare'; ?>">Add Trip Fare</a>
							</li>
                            <li>
								<a href="<?php echo base_url().'trip/trip_fare_list'; ?>">Trip Fare List</a>
							</li>
							
						</ul>
					</li>
                    
                    <li>
						<a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Trip Info.</span></a>
						<ul>
						        <li>
								<a href="<?php echo base_url().'trip/add_general_trip'; ?>">Add General Trip</a>
							</li>
							<li>
								<a href="<?php echo base_url().'trip/general_trip_list'; ?>">General Trip List</a>
							</li>
                            
							<li>
								<a href="<?php echo base_url().'trip/add_trip_bat'; ?>">Add Trip for BAT</a>
							</li>
							
							<li>
								<a href="<?php echo base_url().'trip/bat_trip_list'; ?>">BAT Trip List</a>
							</li>
                            <li>
								<a href="<?php echo base_url().'trip/trip_expense_catgory'; ?>">Trip Expense Category</a>
							</li>
							
						</ul>
					</li>
                    

                    <li>
						<a href="#"><i class="fa fa-lg fa-fw fa-usd"></i> <span class="menu-item-parent">Regular Expense</span></a>
						<ul>
							<li>
								<a href="<?php echo base_url().'expense/create_expense_category'; ?>">Create Expense Category</a>
							</li>
                            <li>
								<a href="<?php echo base_url().'expense/add_expense'; ?>">Add Expense</a>
							</li>
                            <li>
								<a href="<?php echo base_url().'expense/expense_list'; ?>">Expense List</a>
							</li>
							<li>
								<a href="<?php echo base_url().'expense/fuel_expense'; ?>">Fuel</a>
							</li>
						</ul>
					</li>
                    
                    <?php /*?><li>
						<a href="#"><i class="fa fa-lg fa-fw fa-euro"></i> <span class="menu-item-parent">Extra Income</span></a>
						<ul>
							<li>
								<a href="<?php echo base_url().'income/create_income_category'; ?>">Create Ex.Income Category</a>
							</li>
							<li>
								<a href="<?php echo base_url().'income/add_income'; ?>">Add Ex.Income</a>
							</li>
                            <li>
								<a href="<?php echo base_url().'income/income_list'; ?>">Income List</a>
							</li>
							
						</ul>
					</li><?php */?>

					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Inventory</span></a>
						<ul>
							<?php /*?><li>
								<a href="<?php echo base_url().'inventory/add_inventory_category'; ?>">Inventory Category</a>
							</li><?php */?>
                            
                            <li>
								<a href="<?php echo base_url().'inventory/add_product'; ?>">Add product</a>
							</li>
                            
							<li>
								<a href="<?php echo base_url().'inventory/inventory_in'; ?>">Inventory In</a>
							</li>
                            
                            <li>
								<a href="<?php echo base_url().'inventory/inventory_list'; ?>">Inventory List</a>
							</li>
						</ul>
					</li>
                    
                    <li>
						<a href="#"><i class="fa fa-lg fa-fw fa-edit"></i> <span class="menu-item-parent">Creation</span></a>
						<ul>
							<li>
								<a href="<?php echo base_url().'creation/unit'; ?>">Unit</a>
							</li>
							
						</ul>
					</li>
                    
                    
                    <li>
						<a href="#"><i class="fa fa-lg fa-fw fa-money"></i> <span class="menu-item-parent">Client</span></a>
						<ul>
							<li>
								<a href="<?php echo base_url().'client/add_client'; ?>">Add Client</a>
							</li>
							<li>
								<a href="<?php echo base_url().'client/client_list'; ?>">Client List</a>
							</li>
							
						</ul>
					</li>
                    
                    <li>
						<a href="#"><i class="fa fa-lg fa-fw fa-plus"></i> <span class="menu-item-parent">Suppiler</span></a>
						<ul>
							
						<li>
								<a href="<?php echo base_url().'supplier/add_supplier'; ?>">Add Suppiler</a>
							</li>
							<li>
								<a href="<?php echo base_url().'supplier/supplier_list'; ?>">Suppiler List</a>
							</li>
														<li>
								<a href="<?php echo base_url().'supplier/supplier_payment_list'; ?>">Supplier Payment List</a>
							</li>
							
						</ul>
					</li>
                    <li>
						<a href="#"><i class="fa fa-lg fa-fw fa-plus"></i> <span class="menu-item-parent">Servicing</span></a>
						<ul>
							<li>
								<a href="<?php echo base_url().'servicing/add_servicing_category'; ?>">Add Servicing Category</a>
							</li>
                            <li>
								<a href="<?php echo base_url().'servicing/servicing_info'; ?>">Add Servicing Info</a>
							</li>
							<li>
								<a href="<?php echo base_url().'servicing/servicing_list'; ?>">Servicing List</a>
							</li>
							
						</ul>
					</li>
                   
                     <li>
						<a href="#"><i class="fa fa-lg fa-fw fa-wrench"></i> <span class="menu-item-parent">Settings</span></a>
						<ul>
							<li>
								<a href="<?php echo base_url().'settings/create_user'; ?>">Create User</a>
							</li>
                            <li>
								<a href="<?php echo base_url().'settings/user_list'; ?>">User List</a>
							</li>
							
						</ul>
					</li>
				</ul>
    </nav>
    <span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i> </span>
</aside>
<!-- END NAVIGATION -->

<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">

        <span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"><i class="fa fa-refresh"></i></span> </span>

        <!-- breadcrumb -->
        <!--	<ol class="breadcrumb">
                        <li>
                                Forms
                        </li>
                        <li>
                                Bootstrap Form Elements
                        </li>
                </ol> -->
        <!-- end breadcrumb -->

        <!-- You can also add more buttons to the
        ribbon for further usability

        Example below:

        <span class="ribbon-button-alignment pull-right">
        <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
        <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
        <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
        </span> -->
    </div>
    <!-- END RIBBON -->

			<!-- MAIN CONTENT -->
			<div id="content">

				<div class="row menu">
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
						<h1 class="page-title txt-color-blueDark">
							<i class="fa fa-pencil-square-o fa-fw "></i> 
								<?php echo $title;?>
						</h1>
					</div>
					
				</div>
