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
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_form">
                            <div class="login_part_form_iner">
                                <h3>Thông tin tài khoản</h3>
                                @if (session('msg'))
                                    <div class="alert alert-danger">{{ session('msg') }}</div>
                                    @endif
                                    @if (session('done'))
                                    <div class="alert alert-success">{{ session('done') }}</div>
                                    @endif
                                <form class="row contact_form" action="{{ route('user.updateprofile') }}" method="POST" novalidate="novalidate">
                                    @csrf
                                    @method('put')
                                    <div class="col-md-12 form-group p_star">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}"
                                            placeholder="Email" disabled>
                                        @error('email')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <label for="">Họ và tên</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" value="{{ auth()->user()->fullname }}"
                                            placeholder="Họ và tên">
                                        @error('fullname')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <label for="">Mật khẩu</label>
                                        <input type="password" class="form-control" id="password" name="password" value="{{ auth()->user()->password }}"
                                            placeholder="Mật khẩu">
                                        @error('password')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <label for="">Nhập lại mật khẩu</label>
                                        <input type="password" class="form-control" id="cfpassword" name="cfpassword" value="{{ auth()->user()->password }}"
                                            placeholder="Nhập lại mật khẩu">
                                        @error('cfpassword')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="creat_account d-flex align-items-center">
                                            <input type="checkbox" id="f-option" name="selector">
                                            <label for="f-option">Ghi nhớ</label>
                                        </div>
                                        <button type="submit" value="submit" class="btn_3">
                                            Lưu thông tin
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