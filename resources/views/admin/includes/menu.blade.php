<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
        </a>
    </li>
    <li class="nav-item {{ Request::route()->getPrefix() == 'admin/categories' ? ' active' : '' }}" data-toggle="tooltip" data-placement="right" title="Danh mục">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Danh mục</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li class="{{ Request::is('admin/categories') ? 'active' : '' }}">
                <a href="{{ route('categories') }}">Tất cả danh mục</a>
            </li>
            <li class="{{ Request::is('admin/categories/edit/0') ? 'active' : '' }}">
                <a href="{{ route('new_category') }}">Thêm danh mục</a>
            </li>
        </ul>
    </li>
</ul>
<ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>