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
                                <h3>Đăng kí tài khoản</h3>
                                    @if (session('msg'))
                                    <div class="alert alert-danger">{{ session('msg') }}</div>
                                    @endif
                                <form class="row contact_form" action="{{ route('user.postRegister') }}" method="POST" novalidate="novalidate">
                                    @csrf
                                    <div class="col-md-12 form-group p_star">
                                        <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}"
                                            placeholder="Họ và tên">
                                        @error('fullname')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}"
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
                                    <div class="col-md-12 form-group p_star">
                                        <input type="password" class="form-control" id="cfpassword" name="cfpassword" value=""
                                            placeholder="Nhập lại mật khẩu">
                                        @error('cfpassword')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="creat_account d-flex align-items-center">
                                            <input type="checkbox" id="f-option" name="selector">
                                            <label for="f-option">Đồng ý điều khoản</label>
                                        </div>
                                        <button type="submit" value="submit" class="btn_3">
                                            đăng kí
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