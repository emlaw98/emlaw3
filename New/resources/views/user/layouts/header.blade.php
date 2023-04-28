<header>
  <!-- Header Start -->
 <div class="header-area">
      <div class="main-header ">
          <div class="header-top top-bg d-none d-lg-block">
             <div class="container-fluid">
                 <div class="col-xl-12">
                      <div class="row d-flex justify-content-between align-items-center">
                          <div class="header-info-left d-flex">
                              <div class="flag">
                                  <img src="/assets/img/icon/header_icon.png" alt="">
                              </div>
                              <div class="select-this">
                                  <form action="#">
                                      <div class="select-itms">
                                          <select name="select" id="select1">
                                              <option value="">USA</option>
                                              <option value="">SPN</option>
                                              <option value="">CDA</option>
                                              <option value="">USD</option>
                                          </select>
                                      </div>
                                  </form>
                              </div>
                          </div>
                          <div class="header-info-right">
                             <ul>                                          
                                 <li><a href="cart.html">Giỏ hàng</a></li>
                                 <li><a href="checkout.html">Thanh toán</a></li>
                                 @if (Auth::check()) {
                                 <li class="c-header-nav-item dropdown"><button style="font-size:85%" class="btn header-btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Xin chào {{ auth()->user()->fullname }}
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-right pt-0">
                                    <div class="dropdown-header bg-light py-2"><strong>Tài khoản</strong></div>
                                      <a href="{{ route('user.profile') }}"><button class="dropdown-item" type="button">Thông tin tài khoản</button></a>
                                      <a href="{{ route('user.logout') }}"><button class="dropdown-item" type="button"> Đăng xuất</button></a>
                                  </div>
                                </li>
                                }@else{
                                <li><a href="{{ route('user.login') }}" class="btn header-btn">Đăng nhập</a></li>
                                }
                                @endif
                             </ul>
                          </div>
                      </div>
                 </div>
             </div>
          </div>
         <div class="header-bottom  header-sticky">
              <div class="container-fluid">
                  <div class="row align-items-center">
                      <!-- Logo -->
                      <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                          <div class="logo">
                            <a href="{{ route('home') }}"><img src="/assets/img/logo/logo.png" alt=""></a>
                          </div>
                      </div>
                      <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                          <!-- Main-menu -->
                          <div class="main-menu f-right d-none d-lg-block">
                              <nav>                                                
                                  <ul id="navigation">                                                                                                                                     
                                      <li><a href="{{ route('home') }}">Trang chủ</a></li>
                                      <li><a>Danh mục sản phẩm</a>
                                        <ul class="submenu">
                                            <li><a href="{{ route('products') }}"> Danh sách sản phẩm</a></li>
                                            
                                            @foreach ($categoryList as $category)
                                                <li><a href="{{ route('productbyCategory',$category->id) }}"> {{ $category->name }}</a></li>  
                                            @endforeach
                                        </ul>
                                    </li>
                                      <li><a href="{{ route('blog') }}">Tin tức</a>
                                      </li>
                                      <li><a href="#">Về chúng tôi</a></li>
                                      <li><a href="contact.html">Liên hệ</a></li>
                                  </ul>
                              </nav>
                          </div>
                      </div> 
                      <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
                          <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">
                              <li class="d-none d-xl-block">
                                <form action="{{ route('searchProduct') }}" method="GET" role="search">
                                  <div class="form-box f-right ">
                                      <input type="text" id="search" name="search" placeholder="Tìm kiếm sản phẩm" value="{{ old('search') }}">
                                      <div class="search-icon">
                                          <i class="fas fa-search special-tag"></i>
                                      </div>
                                  </div>
                                </form>
                               </li>
                              <li class=" d-none d-xl-block">
                                  <div class="favorit-items">
                                      <i class="far fa-heart"></i>
                                  </div>
                              </li>
                              <li>
                                  <div class="shopping-card">
                                      <a href="{{ route('user.showCart') }}"><i class="fas fa-shopping-cart"></i></a>
                                  </div>
                                </li>
                                
                                
                          </ul>
                      </div>
                      <!-- Mobile Menu -->
                      <div class="col-12">
                          <div class="mobile_menu d-block d-lg-none"></div>
                      </div>
                  </div>
              </div>
         </div>
      </div>
 </div>
  <!-- Header End -->
</header>