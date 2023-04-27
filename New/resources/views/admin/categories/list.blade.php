@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    
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
                    <td style="text-align: center">{{ $key+1 }}</td>
                    <td><a href="">{{ $category->name }}</a></td>
                    <td style="text-align: center">{{ $category->updated_at }}</td>
                    <td style="text-align: center">
                        <a  href="{{ route('admin.categories.edit', $category->id) }}" class= "btn btn-warning btn-sm" >Sửa</a>
                    </td>
                    <td style="text-align: center">
                        <a  onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="{{ route('admin.categories.delete', $category->id) }}" class= "btn btn-danger btn-sm" >Xoá</a>
                        {{--  --}}
                    </td>
                </tr>
                @endforeach               
            @else
            <tr>
                <td colspan="7" style="text-align: center; color:red">Không tìm thấy danh mục</td>
            </tr>
            @endif
        </tbody>
</table>
{{-- {{ $newsList->links() }} --}}
@endsection