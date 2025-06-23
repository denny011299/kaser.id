<!-- Left Sidebar Start -->
            <div class="app-sidebar-menu">
                <div class="h-100" data-simplebar>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <div class="logo-box">
                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="24">
                                </span>
                            </a>
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="24">
                                </span>
                            </a>
                        </div>

                        <ul id="side-menu">

                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="/admin">
                                    <i data-feather="home"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                            <li class="menu-title">Master</li>

                            <li>
                                <a href="#sidebarProduct" data-bs-toggle="collapse">
                                    <i data-feather="archive"></i>
                                    <span> Product </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarProduct">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/category" class="tp-link">Category</a>
                                        </li>
                                        <li>
                                            <a href="/admin/product_variant" class="tp-link">Product Variants</a>
                                        </li>
                                        <li>
                                            <a href="/admin/product_unit" class="tp-link">Product Units</a>
                                        </li>
                                        <li>
                                            <a href="/admin/supplies" class="tp-link">Supplies</a>
                                        </li>
                                        <li>
                                            <a href="/admin/product" class="tp-link">Product</a>
                                        </li>
                                        <li>
                                            <a href="auth-confirm-mail.html" class="tp-link">Barcode Management</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarSupplier" data-bs-toggle="collapse">
                                    <span class="mdi mdi-domain me-1" style="font-size: 16pt"></span>
                                    <span> Supplier </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSupplier">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/supplier" class="tp-link">Supplier</a>
                                        </li>
                                        <li>
                                            <a href="/admin/purchase_order" class="tp-link">Purchase Order</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarCustomer" data-bs-toggle="collapse">
                                    <span class="mdi mdi-account-group-outline me-1" style="font-size: 16pt"></span>
                                    <span> Customer </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCustomer">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/customer" class="tp-link">Customer</a>
                                        </li>   
                                        <li>
                                            <a href="/admin/invoice" class="tp-link">Invoice</a>
                                        </li>
                                        <li>
                                            <a href="/admin/invoice" class="tp-link">Sales Order</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarVoucher" data-bs-toggle="collapse">
                                    <i data-feather="percent"></i>
                                    <span> Promotion </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarVoucher">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/voucher" class="tp-link">Discount/Voucher</a>
                                        </li>
                                        <li>
                                            <a href="/admin/bundling" class="tp-link">Bundling Product</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarInventory" data-bs-toggle="collapse">
                                    <span class="mdi mdi-package-variant-closed-check me-1" style="font-size: 16pt"></span>
                                    <span> Inventory </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarInventory">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/manageSupplies" class="tp-link">Manage Supplies</a>
                                        </li>
                                        <li>
                                            <a href="/admin/manage_product" class="tp-link">Manage Product</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarStaff" data-bs-toggle="collapse">
                                    <span class="mdi mdi-account-group me-1" style="font-size: 16pt"></span>
                                    <span> Staff </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarStaff">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/CategoryStaff" class="tp-link">Category Staff</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                        </ul>
            
                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
            </div>
            <!-- Left Sidebar End -->