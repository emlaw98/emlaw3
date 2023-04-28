@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
<div class="search">
    <form action="{{ route('admin.news.search') }}" method="GET" role="search">
        
        <div class="input-group"> 
            <input type="search" name="search" class="form-control" placeholder="Tìm kiếm tin tức" aria-label="Input group example" aria-describedby="basic-addon1">
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
<a href="{{ route('admin.news.create') }}" class="btn btn-primary">Tạo tin mới</a>
<a href=" " class="btn btn-warning">Quay lại</a>

<hr>
<table class="table table-bordered">
        <thead>
            <tr>
                <th width="3%" style="text-align: center">#</th>
                <th width="10%" style="text-align: center">Danh mục</th>
                <th width="20%" style="text-align: center">Tiêu đề</th>
                <th width="" style="text-align: center">Hình ảnh</th>
                <th width="25%" style="text-align: center">Nội dung</th>               
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
                    <td rowspan=""><a href="{{ route('admin.categories.news',$new->category->id) }}">{{ $new->category->name }}</a></td>
                    <td><a href="">{{ $new->title }}</a></td>
                    <td><img src="{{ $new->imageUrl() }}" alt="" width="100%"></td>
                    <td>{{ $new->content }}</td>
                    <td>{{ $new->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin.news.edit', $new->id) }}" class= "btn btn-warning btn-sm" >Sửa</a>
                    </td>
                    <td>
                        <a onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="{{ route('admin.news.delete', $new->id) }}" class= "btn btn-danger btn-sm" >Xoá</a>
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