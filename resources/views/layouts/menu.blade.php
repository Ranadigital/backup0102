<!-- need to remove -->
<li class="nav-item">
    <a href="{{ url('admin/home') }}" class="nav-link {{ Request::is('admin/home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
@can('deliveryoption_manage')
  <li class="nav-item {{ request()->is('admin/master*') ? 'menu-is-opening menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->is('admin/master*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-table"></i>
      <p> Master <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @can('category_manage')
        <li class="nav-item">
          <a href="{{ url('admin/master/category') }}" class="nav-link {{ request()->is('admin/master/category*') ? 'active' : '' }} ">
            <i class="far fa-circle nav-icon"></i>
            <p>Category</p>
          </a>
        </li>
      @endcan
      @can('subcategory_manage')
        <li class="nav-item">
          <a href="{{ url('admin/master/sub-category') }}" class="nav-link {{ request()->is('admin/master/sub-category*') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Sub Category</p>
          </a>
        </li>
      @endcan
      @can('brand_manage')
        <li class="nav-item">
          <a href="{{ url('admin/master/brand') }}" class="nav-link {{ request()->is('admin/master/brand*') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Brands</p>
          </a>
        </li>
      @endcan
      @can('banner_manage')
        <li class="nav-item">
          <a href="{{ url('admin/master/banner') }}" class="nav-link {{ request()->is('admin/master/banner*') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Banner</p>
          </a>
        </li>
      @endcan
      @can('deliveryoption_manage')
        <li class="nav-item">
          <a href="{{ url('admin/master/delivery-option') }}" class="nav-link {{ request()->is('admin/master/delivery-option*') ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Delivery Option</p>
          </a>
        </li>
      @endcan
    </ul>
  </li>
@endcan
@can('users_manage')
  <li class="nav-item">
      <a href="{{ url('admin/user') }}" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-user"></i>
          <p>User</p>
      </a>
  </li>
@endcan
@can('role_manage1')
<li class="nav-item">
    <a href="{{ url('admin/role') }}" class="nav-link {{ Request::is('admin/role*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Role</p>
    </a>
</li>
@endcan
@can('product_manage')
<li class="nav-item">
    <a href="{{ url('admin/product') }}" class="nav-link {{ Request::is('admin/product*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-columns"></i>
        <p>Product</p>
    </a>
</li>
@endcan
@can('order_manage')
  <li class="nav-item">
    <a href="{{ url('admin/order') }}" class="nav-link {{ Request::is('admin/order*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>Orders</p>
    </a>
</li>
@endcan
@can('users_manage')
  <li class="nav-item">
    <a href="{{ url('admin/logs') }}" class="nav-link {{ Request::is('admin/logs*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>Logs</p>
    </a>
</li>
@endcan
