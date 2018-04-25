<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li @if(Request::is('admin')) class="active" @endif><a href="{{ route('dashboard') }}"><i class="icon-dashboard"></i><span>Bảng điều khiển</span> </a> </li>
        <li class="dropdown {{ Request::route()->getPrefix() == 'admin/categories' ? ' active' : '' }}"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt"></i><span>Danh mục</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
          <li class="{{ Request::is('admin/categories') ? 'active' : '' }}"><a href="{{ route('categories') }}">Tất cả danh mục</a></li>
              <li class="{{ Request::is('admin/categories/edit/0') ? 'active' : '' }}"><a href="{{ route('new_category') }}">Thêm danh mục</a></li>
            </ul>
        </li>
        <li><a href="guidely.html"><i class="icon-facetime-video"></i><span>App Tour</span> </a></li>
        <li><a href="charts.html"><i class="icon-bar-chart"></i><span>Charts</span> </a> </li>
        <li><a href="shortcodes.html"><i class="icon-code"></i><span>Shortcodes</span> </a> </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Drops</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="icons.html">Icons</a></li>
            <li><a href="faq.html">FAQ</a></li>
            <li><a href="pricing.html">Pricing Plans</a></li>
            <li><a href="login.html">Login</a></li>
            <li class="active"><a class="active" href="signup.html">Signup</a></li>
            <li><a href="error.html">404</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->
@yield('toolbar')