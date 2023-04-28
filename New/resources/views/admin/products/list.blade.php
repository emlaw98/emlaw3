@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
<div class="search">
    <form action="{{ route('admin.products.search') }}" method="GET" role="search">
        
        <div class="input-group"> 
            <input type="search" name="search" class="form-control" placeholder="Tìm kiếm sản phẩm" aria-label="Input group example" aria-describedby="basic-addon1">
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
<a href="{{ route('admin.products.create') }}" class="btn btn-primary">Tạo sản phẩm</a>
{{--  --}}
<a href="{{ route('admin.dashboard') }} " class="btn btn-warning">Quay lại</a>

<hr>
<table class="table table-bordered">
        <thead>
            <tr><th width="10%" style="text-align: center">Danh mục sản phẩm</th>
                <th width="5%" style="text-align: center">#</th>
                
                <th width="12%" style="text-align: center">Tên sản phẩm</th>
                <th width="" style="text-align: center">Hình ảnh</th>
                <th width="7%" style="text-align: center">Giá</th>    
                <th width="25%" style="text-align: center">Mô tả sản phẩm</th>                          
                <th width="10%" style="text-align: center">Thời gian</th>
                <th width="10%" style="text-align: center">Sửa</th>
                <th width="10%" style="text-align: center">Xoá</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($productList))
                @foreach ($productList as $key => $product)          
                <tr>
                    <td style="text-align: center">{{ $key+1 }}</td>
                    <td rowspan=""><a href="{{ route('admin.categories.products',$product->category->id) }}">{{ $product->category->name }}</a></td>
                    <td>{{ $product->name }}</td>
                    <td><img src="{{ $product->imageUrl() }}" alt="" width="100%"></td>
                    <td style="text-align: center">{{ number_format($product->price) }}</td>
                    <td>{{ $product->description }}</td>
                    <td style="text-align: center">{{ $product->updated_at }}</td>
                    <td style="text-align: center">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class= "btn btn-warning btn-sm" >Sửa</a>
                    </td>
                    <td style="text-align: center">
                        <a onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="{{ route('admin.products.delete', $product->id) }}" class= "btn btn-danger btn-sm" >Xoá</a>
                        {{--  --}}
                    </td>
                </tr>
                @endforeach               
            @else
            <tr>
                <td colspan="7" style="text-align: center; color:red">Không tìm thấy sản phẩm nào</td>
            </tr>
            @endif
        </tbody>
</table>
{{-- {{ $newsList->links() }} --}}
@endsection