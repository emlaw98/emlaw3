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
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @method('put')
        <div class="mb-3">
            <label for="">Họ và tên</label>
            <input type="text" class = "form-control" name="fullname" placeholder="Họ và tên..." value="{{ $user->fullname }}">
            @error('fullname')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Email</label>
            <input type="email" class = "form-control" name="email" placeholder="Email..." value="{{ $user->email }}" readonly>
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
            <label for="">Nhập lại mật khẩu</label>
            <input type="password" class = "form-control" name="cfpassword" placeholder="Nhập lại mật khẩu...">
            @error('cfpassword')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div class="mb-3">
            <label for="">Người dùng hay Quản trị viên?</label>
            <br>
            <label class="radio-inline">
                <input name="is_admin" value="0" @if(!$user->is_admin) checked @endif type="radio" >Người dùng
            </label>
            <br>
            <label class="radio-inline">
                <input name="is_admin" value="1" @if($user->is_admin) checked @endif type="radio" >Quản trị viên
            </label>
        <div>


        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.users.index') }}" class= "btn btn-warning">Quay lại</a>
        @csrf
    </form> 
@endsection