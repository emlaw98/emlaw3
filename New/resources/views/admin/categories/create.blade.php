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

    <form action="{{ route('admin.categories.store') }}" method="POST">
        <div class="mb-3">
        <select name="category_type" class="browser-default custom-select">
            <option selected value="">Loại danh mục...</option>
                <option value="0">Sản phẩm</option>
                <option value="1">Tin tức</option>
          </select>
            @error('category_type')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <hr>
        <div class="mb-3">
            <input type="text" class = "form-control" name="name" placeholder="Tên danh mục...">
            @error('name')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Tạo</button>
        <a href="{{ route('admin.categories.index') }}" class= "btn btn-warning">Quay lại</a>
        @csrf
    </form>
@endsection