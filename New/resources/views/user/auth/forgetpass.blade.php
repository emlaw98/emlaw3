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
                                <h2>Bạn đã có tài khoản?</h2>
                                <p>Vui lòng đăng nhập</p>
                                <a href="{{ route('user.login') }}" class="btn_3">Đăng nhập</a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_form">
                            <div class="login_part_form_iner">
                                <h3>Quên mật khẩu</h3>
                                <p>Vui lòng nhập email đã đăng kí để lấy lại mật khẩu</p>
                                    @if (session('msg'))
                                    <div class="alert alert-success">{{ session('msg') }}</div>
                                    @endif
                                    
                                <form class="row contact_form" action="{{ route('user.postForgetpass') }}" method="POST" novalidate="novalidate">
                                    @csrf
                                    <div class="col-md-12 form-group p_star">
                                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                            placeholder="Email">
                                        @error('email')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <button type="submit" value="submit" class="btn_3">
                                            Gửi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection