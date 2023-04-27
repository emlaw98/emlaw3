@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    
@if (session('msg'))
<div class="alert alert-success">{{ session('msg') }}</div>
@endif
<a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tạo người dùng mới</a>
{{--  --}}
<a href=" " class="btn btn-warning">Quay lại</a>

<hr>
<table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%" style="text-align: center">#</th>
                <th width="25%" style="text-align: center">Họ và tên</th>
                <th width="25%" style="text-align: center">Email</th>
                <th width="10%" style="text-align: center">Quản trị viên</th>
                <th width="10%" style="text-align: center">Thời gian</th>
                <th width="10%" style="text-align: center">Sửa</th>
                <th width="10%" style="text-align: center">Xoá</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($users))
                @foreach ($users as $key => $user)
                <tr>
                    <td style="text-align: center">{{ $key+1 }}</td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->email }}</td>
                    <td style="text-align: center">{{ $user->is_admin ? "x": "" }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td style="text-align: center">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class= "btn btn-warning btn-sm" >Sửa</a>
                        {{--  --}}
                    </td>
                    <td style="text-align: center">
                        <a onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="{{ route('admin.users.delete',$user->id) }}" class= "btn btn-danger btn-sm" >Xoá</a>
                        {{--  --}}
                    </td>
                </tr>
                @endforeach               
            @else
            <tr>
                <td colspan="7" style="text-align: center">Không tìm thấy người dùng</td>
            </tr>
            @endif
        </tbody>
</table>

@endsection