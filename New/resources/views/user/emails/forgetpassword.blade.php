
<div style="width: 600px">
    <div  style="text-align: center">
        <h1>Xin chào {{ $user->fullname }}!</h1>
        <p>Rất tiếc khi biết bạn đang gặp sự cố khi đăng nhập. Chúng tôi nhận được thông báo rằng bạn đã quên mật khẩu của mình. 
        Nếu đây là bạn, bạn có thể đặt lại mật khẩu ngay bây giờ.</p>
        <a type="button" href= "{{ route('user.getpassword',$user->id) }}" class="btn btn-primary">Đặt lại mật khẩu</a>
    {{--  --}}
    </div>
</div>
<link href="/css/style.css" rel="stylesheet">