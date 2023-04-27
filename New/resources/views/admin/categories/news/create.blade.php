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

    <form action="{{ route('admin.categories.news.store') }}" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="text" class = "form-control" name="title" placeholder="Tiêu đề..." value="{{ old('title') }}">
            @error('title')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <input type="file" class = "form-control" name="image" placeholder="Chọn hình ảnh..." value="{{ old('image') }}" accept="image/*">
            @error('image')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <textarea type="text" class = "form-control" name="content" placeholder="Nội dung..." value="{{ old('content') }} cols="30 rows="10"></textarea>
            @error('content')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Tạo tin tức</button>
        <a href="{{ route('admin.categories.index') }}" class= "btn btn-warning">Quay lại</a>
        @csrf
    </form>
@endsection