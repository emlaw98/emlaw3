@extends('admin.layouts.loginlayout')

@section('title')
    {{ $title }}
@endsection

@section('content')
    
    <form action="{{ route('admin.checklogin') }}" method="POST">
        @csrf
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        @if (session('msg'))
                        <div class="alert alert-danger">{{ session('msg') }}</div>
                        @endif
                    <h1>Đăng nhập</h1>
                    <p class="text-muted">Đăng nhập tài khoản của bạn</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend"><span class="input-group-text">
                            <svg class="c-icon">
                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                            </svg></span></div>
                        <input class="form-control" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                        <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend"><span class="input-group-text">
                            <svg class="c-icon">
                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                            </svg></span></div>
                        <input class="form-control" type="password" name="password" placeholder="Mật khẩu">
                        @error('password')
                        <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                        <button class="btn btn-primary px-4" type="submit">Đăng nhập</button>
                        </div>
                        <div class="col-6 text-right">
                        <button class="btn btn-link px-0" type="button">Quên mật khẩu?</button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </form>
@endsection