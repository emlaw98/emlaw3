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
                        <div class="login_part_form">
                            <div class="login_part_form_iner">
                                <h3>Thay đổi mật khẩu</h3>
                                    @if (session('msg'))
                                    <div class="alert alert-success">{{ session('msg') }}</div>
                                    @endif
                                    
                                <form class="row contact_form" action="{{ route('user.postgetpassword',$user->id) }}" method="POST" novalidate="novalidate">
                                    @method('put')
                                    @csrf
                                    <div class="col-md-12 form-group p_star">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Mật khẩu mới">
                                        @error('password')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="password" class="form-control" id="cfpassword" name="cfpassword"
                                            placeholder="Xác nhận mật khẩu mới">
                                        @error('cfpassword')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <button type="submit" value="submit" class="btn_3">
                                            Lưu
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