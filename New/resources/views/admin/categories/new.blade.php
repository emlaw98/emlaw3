@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">Tất cả danh mục</a>
      </li>
    <li class="nav-item">
      <a class="nav-link " href="{{ route('admin.categories.product') }}">Danh mục sản phẩm</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="{{ route('admin.categories.new') }}">Danh mục tin tức</a>
    </li>
  </ul>
  <div class="search">
    @if (session('found'))
    <div class="alert alert-danger">{{ session('found') }}</div>
    @endif
    <form action="{{ route('admin.categories.searchNewCategory') }}" method="GET" role="search">
        
        <div class="input-group"> 
            <input type="search" name="search" class="form-control" placeholder="Tìm kiếm danh mục" aria-label="Input group example" aria-describedby="basic-addon1">
            <span class="input-group-text" id="basic-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
              </svg>
              </span>
          </div>
        
    </form>
    </div>

    <hr>
    
@if (session('msg'))
<div class="alert alert-success">{{ session('msg') }}</div>
@endif
<a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Tạo danh mục</a>
{{--  --}}
<a href="{{ route('admin.dashboard') }}" class="btn btn-warning">Quay lại</a>

<hr>
<table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%" style="text-align: center">#</th>
                <th width="15%" style="text-align: center">Tên danh mục</th>            
                <th width="10%" style="text-align: center">Thời gian</th>
                <th width="10%" style="text-align: center">Sửa</th>
                <th width="10%" style="text-align: center">Xoá</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($categoryList))
                @foreach ($categoryList as $key => $category)
                <tr>
                    @if($category->category_type ==1)
                    <td style="text-align: center">{{ $stt = $stt +1 }}</td>
                    <td><a href="">{{ $category->name }}</a></td>
                    <td style="text-align: center">{{ $category->updated_at }}</td>
                    <td style="text-align: center">
                        <a  href="{{ route('admin.categories.edit', $category->id) }}" class= "btn btn-warning btn-sm" >Sửa</a>
                    </td>
                    <td style="text-align: center">
                        <a  onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="{{ route('admin.categories.delete', $category->id) }}" class= "btn btn-danger btn-sm" >Xoá</a>
                    </td>
                    @endif
                </tr>
                @endforeach               
            @else
            <tr>
                <td colspan="7" style="text-align: center; color:red">Không tìm thấy danh mục</td>
            </tr>
            @endif
        </tbody>
</table>
{{-- {{ $categoryList->links() }} --}}
@endsection