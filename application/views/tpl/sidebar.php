<?php 
    $session_data = $this->session->userdata('logged_in');
    $role = $session_data['role']; 

    $shops = $this->session->userdata('shops');
    $warehouses = $this->session->userdata('warehouses');
?>

<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <?php echo form_open('search'); ?>
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </form>
                        </li>
                        <?php if($role == 1 || $role == 2): ?>
                        <li>
                            <a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-product-hunt fa-fw"></i> Products<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/products">Manage Products</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/products/product_categories">Product Categories</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="#"><i class="fa fa-building fa-fw"></i> Inventory<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/inventory/view_locations">Location Inventory</a>
                                </li>
                                <li>
                                    <a href="#">Transfers</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/locations/orders">Location Orders</a>
                                </li>
                            </ul>
                        </li>
                        <?php if($role == 1 || $role == 2 || $role == 3 || $role == 4): ?>
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Sales Orders<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/sales_orders">All Sales Orders</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/sales_orders">Create Sales Order</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/sales_orders">Approve Sales Order</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/sales_orders">Void Sales Order</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php endif; ?>
                        <?php if($role == 1 || $role == 2): ?>
                        <li>
                            <a href="forms.html"><i class="fa fa-truck fa-fw"></i> Suppliers<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo base_url(); ?>index.php/suppliers">All Suppliers</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-users fa-fw"></i> Customers<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/customers/waybill">Waybill</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/customers">View All Customers</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-paper-plane fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#"> Inventory Balance</a>
                                </li>
                                <li>
                                    <a href="#"> Purchases Activity</a>
                                </li>
                                <li>
                                    <a href="#"> Sales Activity</a>
                                </li>
                                <li>
                                    <a href="#"> Sales Return Activity</a>
                                </li>
                                <li>
                                    <a href="#"> Transfer Activity</a>
                                </li>
                                <li>
                                    <a href="#"> Adjustment-In Activity</a>
                                </li>
                                <li>
                                    <a href="#"> Adjustment-Out Activity</a>
                                </li>
                                <li>
                                    <a href="#"> Purchases Return Activity</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cogs fa-fw"></i> Configuration<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/company/company_setup">Company Setup</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>index.php/staff">Staff Management</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>