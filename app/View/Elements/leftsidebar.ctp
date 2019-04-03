 <!-- ========== Left Sidebar Start ========== -->

            <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" src="/img/profile_small.jpg"/>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold"><?php echo $authUser['name']; ?></span>
                                <span class="text-muted text-xs block"><?php echo $job_title; ?></span>
                            </a>
                            <!--<ul class="dropdown-menu animated fadeInRight m-t-xs">-->
                            <!--    <li><a class="dropdown-item" href="profile.html">Profile</a></li>-->
                            <!--    <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>-->
                            <!--    <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>-->
                            <!--    <li class="dropdown-divider"></li>-->
                            <!--    <li><a class="dropdown-item" href="/admins/logout">Logout</a></li>-->
                            <!--</ul>-->
                        </div>
                        <div class="logo-element">
                            <img alt="image" class=" img-responsive"  width="50" src="<?php echo $active_company_dash_logo; ?>"/>
                        </div>
                    </li>
                    <?php if ($userRole == 'admin') { ?>
                    <li class="has_sub">
                        <a href="/admins/dashboard" class="waves-effect"><i class="fa fa-th-large"></i> <span> Dashboard </span> </a>
                    </li>
                    <?php } elseif ($userRole == 'sales_executive') { ?>
                    <li class="has_sub">
                        <a href="/admins/dashboard" class="waves-effect"><i class="fa fa-th-large"></i> <span> Dashboard </span> </a>
                    </li>    
                    <?php } 
                    if ($userRole == 'admin' || $userRole == 'manager' || $userRole == 'sales_executive' ) { ?>
                    <li class="has_sub">
                        <a href="/crm_companies/all_list?type=clients" class="waves-effect"><i class="fa fa-user-md"></i> <span> Clients </span> </a>
                    </li>
                    <?php } ?> 
                    <?php  if ($userRole == 'admin' || $userRole == 'manager' || $userRole == 'sales_executive' ) { ?>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file-pdf-o"></i> <span> Quotations </span> <span class="menu-arrow"></span> </a>
                        <ul class="nav nav-second-level collapse">
                            <?php  if($userRole == 'sales_executive'){?>
                                <li> <a href="/crm_quotations/quote/create">Create</a> </li>
                            <?php } ?>
                            <li><a href="/crm_quotations/all_list?status=pending&&type=0">Pending</a></li>
                            <li><a href="/crm_quotations/all_list?status=moved&&type=0">Moved </a></li>
                            <li><a href="/crm_quotations/all_list?status=approved&&type=0">Approved</a></li>
                            <li><a href="/crm_quotations/all_list?status=processed&&type=0">Processed</a></li> 
                            <li><a href="/crm_quotations/all_list?status=collected&&type=0">Collected</a></li> 
                            <?php  if ($userRole == 'admin'  || $userRole == 'manager') { ?>
                            <li><a href="/crm_quotations/all_list?status=cancelled&&type=0">Collected</a></li> 
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?> 
                    <?php  if ($userRole == 'admin'  || $userRole == 'manager') { ?>
                    <!--DELIVERY RECIEPTS-->
                    <li class="has_sub">
                        <a href="javascript:void(0);"><i class="fa fa-truck"></i><span> Delivery Receipts </span> </a>
                        <ul class="nav nav-second-level collapse">
                            <!--<li><a href="/crm_delivery_receipts/add">Create </a></li>-->
                            <li><a href="/crm_delivery_receipts/all_list?status=pending">Pending</a></li> 
                            <li><a href="/crm_delivery_receipts/all_list?status=delivered">Delivered</a></li> 
                            <li><a href="/crm_delivery_receipts/all_list?status=cancelled">Cancelled</a></li>
                        </ul>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-object-group"></i> <span> Collection </span> <span class="menu-arrow"></span> </a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/crm_collections/all_list?status=pending">Pending</a></li>
                            <li><a href="/crm_collections/all_list?status=accomplished">Accomplished</a></li> 
                        </ul>
                    </li>

                    <!--<li class="has_sub">-->
                    <!--    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file-powerpoint-o"></i> <span> Products </span> <span class="menu-arrow"></span> </a>-->
                    <!--    <ul class="nav nav-second-level collapse">-->
                    <!--        <li><a href="/products/create">Create</a></li>-->
                    <!--        <li><a href="/products/all_list">List</a></li> -->
                    <!--    </ul>-->
                    <!--</li>-->

                    <!--<li class="has_sub">-->
                    <!--    <a href="/admins/add" class="waves-effect"><i class="fa fa-users"></i> <span> Employees </span> </a>-->
                    <!--</li>-->
                    <?php //} ?> 
                    <?php // if ($userRole == 'admin' ) { ?>
                    <li class="has_sub">
                        <a href="/crm_companies/all_list?type=suppliers" class="waves-effect"><i class="fa fa-leanpub"></i> <span> Suppliers </span> </a>
                    </li>  
                    <?php } ?>
                    
                </ul>

            </div>
        </nav>
			<!-- Left Sidebar End -->
