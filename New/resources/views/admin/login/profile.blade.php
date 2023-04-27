@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
    <div class="alert alert-danger">{{ session('msg') }}</div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">Vui lòng kiểm tra lại!</div>

    @endif
    <h1>{{ $title }}</h1>
    <form action="{{ route('admin.profile.update') }}" method="POST">
        @method('put')
        <div class="mb-3">
            <label for="">Họ và tên</label>
            <input type="text" class = "form-control" name="fullname" placeholder="Họ và tên..." value="{{ auth()->user()->fullname }}">
            @error('fullname')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Email</label>
            <input type="email" class = "form-control" name="email" placeholder="Email..." value="{{ auth()->user()->email }}" readonly>
            @error('email')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Mật khẩu</label>
            <input type="password" class = "form-control" name="password" placeholder="Mật khẩu...">
            @error('password')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Xác nhận mật khẩu</label>
            <input type="password" class = "form-control" name="cfpassword" placeholder="Xác nhận mật khẩu...">
            @error('cfpassword')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.users.index') }}" class= "btn btn-warning">Quay lại</a>
        @csrf
    </form> 
@endsection