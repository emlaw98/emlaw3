@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <h1 style="text-align:center; color:rgb(0, 204, 255)">Xin chào {{ auth()->user()->fullname }} đến với trang quản trị viên</h1>
@endsection