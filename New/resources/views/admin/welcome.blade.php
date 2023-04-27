@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <h1 style="text-align:center">Xin chào bạn đến với trang quản trị viên</h1>
@endsection