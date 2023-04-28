<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Categories;

class AuthUserController extends Controller
{
    public function login(){
        $title = 'Đăng nhập';
        $slider = 'Đăng nhập';
        $categoryList = Categories::Where('category_type', '0')->get();
        if(Auth::check()){
            return redirect()->route('home');
        };
        return view('user.auth.login', compact('title','slider','categoryList'));
    }

    public function checklogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => 'Bạn chưa nhập Email',
            'email.email' => 'Email không đúng định dạng',         
            'password.required' => 'Bạn chưa nhập mật khẩu',
        ]);
        if(Auth::attempt(['email' => $request->email,'password' => $request->password])){
            return redirect()->back();
        };
        return redirect()->route('user.login')->with('msg', 'Sai thông tin email hoặc mật khẩu!');
    }

    public function register(){
        $title = 'Đăng kí';
        $slider = 'Đăng kí';
        $categoryList = Categories::Where('category_type', '0')->get();
        return view('user.auth.register',compact('title','slider','categoryList'));
    }

    public function postRegister(Request $request){

        $this->validate($request,[
            'fullname'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:6',
            'cfpassword'=> 'required|same:password',
        ],[
            'fullname.required' => 'Bạn chưa nhập họ và tên',
            'email.required' => 'Bạn chưa nhập Email',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không đúng định dạng',         
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min'=> 'Mật khẩu phải chứa ít nhất 6 kí tự',
            'cfpassword.required'=> 'Bạn chưa nhập lại mật khẩu',
            'cfpassword.same' => 'Mật khẩu không khớp'

        ]);

        User::create([
            'fullname'=> $request->fullname,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
        ]);

        return redirect()-> route('user.auth.login')->with('done', 'Đăng kí thành công vui lòng đăng nhập');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }

    public function forgetpassword() {
        $title = 'Quên mật khẩu';
        $slider = 'Quên mật khẩu';
        $categoryList = Categories::Where('category_type', '0')->get();
        
        return view('user.auth.forgetpass',compact('title','slider','categoryList'));
    }

    public function postForgetpassword(Request $request) {
        $request ->validate([
            'email'=> 'required|exists:users',
        ],[
            'email.required' => 'Vui lòng nhập email!',
            'email.exists' => 'Email không tồn tại!'
        ]);
        $user = User::where('email', $request->email)->first();
        Mail::send('user.emails.forgetpassword',compact('user'), function($email) use ($user) {
            $email->subject('ESTORE - Lấy lại mật khẩu');
            $email->to($user->email,$user->fullname,$user->id);
        });
            return redirect()->back()->with('msg','Vui lòng kiểm tra Email để đổi mật khẩu!');       
    }


    public function getPassword($id){
        $slider = "Thay đổi mật khẩu";
        $title = "Thay đổi mật khẩu";
        $categoryList = Categories::Where('category_type', '0')->get();
        $user = User::find($id);
        return view('user.auth.getpassword',compact('user','title','slider','categoryList'));
    }

    public function postgetPassword(Request $request,$id){
        $this->validate($request,[
            'password'=> 'required|min:6',
            'cfpassword'=> 'required|same:password',
        ],[  
            'password.min'=> 'Mật khẩu phải chứa ít nhất 6 kí tự',       
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'cfpassword.required'=> 'Bạn chưa nhập lại mật khẩu',
            'cfpassword.same' => 'Mật khẩu không khớp'

        ]);

        $user = User::find($id);
        $data['password'] = bcrypt($request->password);
        $user->update($data);
        return redirect()->route('user.login')->with('done', 'Đổi mật khẩu thành công!');
    }
    
    public function profile(){
        
        $title = 'Thông tin tài khoản';
        $slider = 'Thông tin tài khoản';
        $categoryList = Categories::Where('category_type', '0')->get();
        
        return view('user.auth.profile',compact('title','slider','categoryList'));
    }

    public function updateprofile(Request $request){
        
        $user = Auth::user();

        $this->validate($request,[
            'fullname'=> 'required',
        ],[
            'fullname.required' => 'Bạn chưa nhập họ và tên',        

        ]);

        $data =[
            'fullname'=> $request->fullname,
            
        ];
        if($request->password){
            $this->validate($request,[
            'password'=> 'min:6',
            'cfpassword'=> 'same:password',
            ],[
                'password.min'=> 'Mật khẩu phải chứa ít nhất 6 kí tự',
                'cfpassword.same' => 'Mật khẩu không khớp'
            ]);
            $data['password'] = $request->password;
        };
        $user->update($data);

        return redirect()-> route('user.profile')->with('done', 'Cập nhật thành công');
    }
    
}
