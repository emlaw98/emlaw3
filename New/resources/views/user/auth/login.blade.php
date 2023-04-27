@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('sliderarea')
    @include('user.auth.sliderarea')
@endsection

@section('content')
        
        <section class="login_part section_padding ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_text text-center">
                            <div class="login_part_text_iner">
                                <h2>Lần đầu ghé cửa hàng?</h2>
                                <p>Chúng tôi luôn mang đến quý khách những sản phẩm với chất lượng và giá thành tốt nhất!</p>
                                <a href="{{ route('user.register') }}" class="btn_3">Đăng kí ngay</a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_form">
                            <div class="login_part_form_iner">
                                <h3>Chào mừng quay trở lại! <br>
                                    Vui lòng đăng nhập</h3>
                                    @if (session('msg'))
                                    <div class="alert alert-danger">{{ session('msg') }}</div>
                                    @endif
                                    @if (session('done'))
                                    <div class="alert alert-success">{{ session('done') }}</div>
                                    @endif
                                <form class="row contact_form" action="{{ route('user.checklogin') }}" method="POST" novalidate="novalidate">
                                    @csrf
                                    <div class="col-md-12 form-group p_star">
                                        <input type="text" class="form-control" id="email" name="email" value=""
                                            placeholder="Email">
                                        @error('email')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="password" class="form-control" id="password" name="password" value=""
                                            placeholder="Mật khẩu">
                                        @error('password')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="creat_account d-flex align-items-center">
                                            <input type="checkbox" id="f-option" name="selector">
                                            <label for="f-option">Ghi nhớ</label>
                                        </div>
                                        <button type="submit" value="submit" class="btn_3">
                                            đăng nhập
                                        </button>
                                        <a class="lost_pass" href="{{ route('user.forgetpass') }}">Quên mật khẩu</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection