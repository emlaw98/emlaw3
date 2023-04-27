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

    <form action="{{ route('admin.categories.products.store') }}" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="text" class = "form-control" name="name" placeholder="Tên sản phẩm..." value="{{ old('name') }}">
            @error('name')
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
            <input type="text" class = "form-control" name="price" placeholder="Giá..." value="{{ old('price') }}">
            @error('price')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <textarea type="text" class = "form-control" name="description" placeholder="Mô tả sản phẩm..." value="{{ old('description') }} cols="30 rows="10"></textarea>
            @error('description')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
        <a href="{{ route('admin.categories.index') }}" class= "btn btn-warning">Quay lại</a>
        @csrf
    </form>
@endsection