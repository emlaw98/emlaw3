@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    
@if (session('msg'))
<div class="alert alert-success">{{ session('msg') }}</div>
@endif
<a href="{{ route('admin.categories.news.create') }}" class="btn btn-primary">Tạo tin mới</a>
{{--  --}}
<a href=" " class="btn btn-warning">Quay lại</a>

<hr>
<table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%" style="text-align: center">#</th>
                <th width="15%" style="text-align: center">Tiêu đề</th>
                <th width="" style="text-align: center">Hình ảnh</th>
                <th width="35%" style="text-align: center">Nội dung</th>               
                <th width="10%" style="text-align: center">Thời gian</th>
                <th width="10%" style="text-align: center">Sửa</th>
                <th width="10%" style="text-align: center">Xoá</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($newsList))
                @foreach ($newsList as $key => $new)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td><a href="">{{ $new->title }}</a></td>
                    {{-- {{ route('admin.categories.{{ $category->url }}') }} --}}
                    <td><img src="{{ $new->imageUrl() }}" alt="" width="100%"></td>
                    <td>{{ $new->content }}</td>
                    <td>{{ $new->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin.categories.news.edit', $new->id) }}" class= "btn btn-warning btn-sm" >Sửa</a>
                    </td>
                    <td>
                        <a onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="{{ route('admin.categories.news.delete', $new->id) }}" class= "btn btn-danger btn-sm" >Xoá</a>
                        {{--  --}}
                    </td>
                </tr>
                @endforeach               
            @else
            <tr>
                <td colspan="7" style="text-align: center; color:red">Không tìm thấy tin tức</td>
            </tr>
            @endif
        </tbody>
</table>
{{-- {{ $newsList->links() }} --}}
@endsection