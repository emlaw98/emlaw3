<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        $title = 'Đăng nhập';

        return view('admin.login.login',compact('title'));
    }

    public function checklogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Vui lòng nhập địa chỉ email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập password',
        ]);
        if(Auth::attempt(['email' => $request->email,'password' => $request->password])){
            return redirect()->route('admin.dashboard')->with('msg', 'Đăng nhập thành công');
        }else{
            return redirect()->route('admin.login')->with('msg', 'Email hoặc mật khẩu không chính xác');
        };
            
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function profile(){
        $title = 'Tài khoản của tôi';
        return view('admin.login.profile',compact('title'));
    }

    public function updateprofile(Request $request){
        $this->validate($request,[
            'fullname'=> 'required',
        ]);

        $user = Auth::user();

        $data = [
            'fullname'=> $request->fullname,
        ];
        if($request->password){
            $this->validate($request,[
                'password'=> 'required|min:6',
                'cfpassword'=> 'required|same:password',   
            ]);
            $data['password'] = bcrypt($request->password);
        };

        
        $user->update($data);
        return redirect()->route('admin.dashboard')->with('msg','Cập nhật thành công');
    }
}
