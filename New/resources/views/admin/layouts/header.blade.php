<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
      <svg class="c-icon c-icon-lg">
        <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
      </svg>
    </button><a class="c-header-brand d-lg-none" href="#">
      <svg width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="/assets/brand/coreui.svg#full"></use>
      </svg></a>
    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
      <svg class="c-icon c-icon-lg">
        <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
      </svg>
    </button>
    <ul class="c-header-nav d-md-down-none">
      <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Dashboard</a></li>
      <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Cài đặt</a></li>
    </ul>
    <ul class="c-header-nav ml-auto mr-4">
      <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
          <svg class="c-icon">
            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
          </svg></a></li>
      <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
          <svg class="c-icon">
            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
          </svg></a></li>
      <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
          <svg class="c-icon">
            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
          </svg></a></li>
      <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <div class="c-avatar"><img class="c-avatar-img" src="/assets/img/avatars/6.jpg" alt="user@email.com"></div>
        </a>
        <div class="dropdown-menu dropdown-menu-right pt-0">
          <div class="dropdown-header bg-light py-2"><strong>Tài khoản</strong></div>
            <a class="dropdown-item" href="{{ route('admin.profile') }}">
            <svg class="c-icon mr-2">
              <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
            </svg> Thông tin tài khoản</a>
            <a class="dropdown-item" href="{{ route('admin.logout') }}">
            <svg class="c-icon mr-2">
              <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
            </svg> Đăng xuất</a>
        </div>
      </li>
    </ul>
    <div class="c-subheader px-3">
      <!-- Breadcrumb-->
      <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
        <!-- Breadcrumb Menu-->
      </ol>
    </div>
  </header>