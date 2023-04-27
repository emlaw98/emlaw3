@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">Vui lòng kiểm tra lại!</div>

    @endif
    <h1>{{ $title }}</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @method('put')
        <div class="mb-3">
            <input type="text" class = "form-control" name="name" placeholder="Category..." value="{{ $category->name }}">
            @error('name')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.categories.index') }}" class= "btn btn-warning">Quay lại</a>
        @csrf
    </form>
@endsection