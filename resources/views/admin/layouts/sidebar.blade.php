<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ url('/admin') }}" class="d-block">DashBoard</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ url('/admin') }}" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    <p>
                        DashBoard
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fas fa-icons"></i>
                    <p>
                        System Elements
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/admin/category/') }}" class="nav-link">
                            <i class="far fa-file nav-icon"></i>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/product/') }}" class="nav-link">
                            <i class="fa fa-boxes nav-icon"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/tags/') }}" class="nav-link">
                            <i class="fa fa-link nav-icon"></i>
                            <p>Tags</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/cart') }}" class="nav-link">
                            <i class="fa fa-cart-plus nav-icon"></i>
                            <p>Cart - Cart detail</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/customer/') }}" class="nav-link">
                            <i class="fa fa-user-circle nav-icon"></i>
                            <p>Customer</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/widgets/index') }}" class="nav-link">
                    <i class="fas fa-text-width"></i>
                    <p>
                        Widgets
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fas fa-cogs"></i>
                    <p>
                        Settings Options
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-info right">3</span>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('admin/paygates/index') }}" class="nav-link">
                            <i class="fab fa-amazon-pay"></i>
                            <p>Paygates</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/users/index') }}" class="nav-link">
                            <i class="fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/menus/index') }}" class="nav-link">
                            <i class="fas fa-bars"></i>
                            <p>Menus</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/sliders/index') }}" class="nav-link">
                            <i class="fas fa-images"></i>
                            <p>Sliders</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
