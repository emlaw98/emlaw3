@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    
@if (session('msg'))
<div class="alert alert-success">{{ session('msg') }}</div>
@endif
<a href="{{ route('admin.categories.products.create') }}" class="btn btn-primary">Tạo sản phẩm</a>
{{--  --}}
<a href="{{ route('admin.categories.index') }} " class="btn btn-warning">Quay lại</a>

<hr>
<table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%" style="text-align: center">#</th>
                <th width="15%" style="text-align: center">Tên sản phẩm</th>
                <th width="" style="text-align: center">Hình ảnh</th>
                <th width="10%" style="text-align: center">Giá</th>    
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
                    <td><a href="">{{ $product->name }}</a></td>
                    {{-- {{ route('admin.categories.{{ $category->url }}') }} --}}
                    <td><img src="{{ $product->imageUrl() }}" alt="" width="100%"></td>
                    <td style="text-align: center"><a href="">{{ $product->price }}</a></td>
                    <td>{{ $product->description }}</td>
                    <td style="text-align: center">{{ $product->updated_at }}</td>
                    <td style="text-align: center">
                        <a href="{{ route('admin.categories.products.edit', $product->id) }}" class= "btn btn-warning btn-sm" >Sửa</a>
                    </td>
                    <td style="text-align: center">
                        <a onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="{{ route('admin.categories.products.delete', $product->id) }}" class= "btn btn-danger btn-sm" >Xoá</a>
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