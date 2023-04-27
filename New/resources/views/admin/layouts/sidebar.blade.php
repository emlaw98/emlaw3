<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
      <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="/assets/brand/coreui.svg#full"></use>
      </svg>
      <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
        <use xlink:href="/assets/brand/coreui.svg#signet"></use>
      </svg>
    </div>
    <ul class="c-sidebar-nav">
      <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
          </svg>Dashboard<span class="badge badge-info">Mới</span></a></li>
      <li class="c-sidebar-nav-title">Administrator</li>
      
      <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle">
        <svg class="c-sidebar-nav-icon">
          <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
        </svg> Danh mục</a>
      <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.categories.news.index') }}"><span class="c-sidebar-nav-icon"></span> Tin tức</a></li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.categories.products.index') }}"><span class="c-sidebar-nav-icon"></span> Sản phẩm</a></li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.categories.index') }}"><span class="c-sidebar-nav-icon"></span> Cài đặt...</a></li>
      </ul>
      </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.users.index') }}">
        <svg class="c-sidebar-nav-icon">
          <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
        </svg>Người dùng</a>
    </li>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
  </div>