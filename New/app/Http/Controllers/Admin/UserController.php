<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $title = 'Quản trị người dùng';

        $users = User::all();

        return view('admin.users.list',compact('title', 'users'));
    }

    public function create(){
        $title = 'Thêm người dùng';

        return view('admin.users.create',compact('title'));
    }
    
    public function store(Request $request){

        $this->validate($request,[
            'fullname'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:6',
            'cfpassword'=> 'required|same:password',
            'is_admin'=> 'required',

        ],[
            'fullname.required' => 'Chưa nhập họ và tên',
            'email.required' => 'Chưa nhập Email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu ít nhất :min kí tự',
            'cfpassword.required' => 'Nhập lại mật khẩu',
            'cfpassword.same' => 'Mật khẩu không khớp',
        ]);

        User::create([
            'fullname'=> $request->fullname,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'is_admin'=> $request->is_admin,
        ]);

        return redirect()-> route('admin.users.index')->with('msg', 'Tạo người dùng thành công');
    }

    public function edit($id){

        $title = 'Sửa thông tin người dùng';

        $user = User::find($id);

        return view('admin.users.edit', compact('user','title'));
    }

    public function update(Request $request,$id){

        $this->validate($request,[
            'fullname'=> 'required',
            'is_admin'=> 'required',
        ],[
            'fullname.required' => 'Chưa nhập họ và tên',
        ]);

        $user = User::find($id);

        $data = [
            'fullname'=> $request->fullname,
            'is_admin'=> $request->is_admin,
        ];
        if($request->password){
            $this->validate($request,[
                'password'=> 'required|min:6',
                'cfpassword'=> 'required|same:password',   
            ],[
                'password.required' => 'Chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất :min kí tự',
                'cfpassword.required' => 'Nhập lại mật khẩu',
                'cfpassword.same' => 'Mật khẩu không khớp',
            ]);
            $data['password'] = bcrypt($request->password);
        };

        
        $user->update($data);
        return redirect()->route('admin.users.index')->with('msg','Cập nhật người dùng thành công');
    }

    public function delete($id){
        User::find($id)->delete();
        return redirect()->route('admin.users.index')->with('msg','Xoá người dùng thành công');
    }
}
