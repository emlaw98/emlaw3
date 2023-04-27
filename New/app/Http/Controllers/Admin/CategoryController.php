<?php

namespace App\Http\Controllers\Admin;
use App\Models\Categories;
use Illuminate\Support;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $title = 'Danh mục';
        $categoryList = Categories::paginate(5);
        return view('admin.categories.list',compact('title','categoryList'));
    }

    public function create(){
        $title = 'Thêm danh mục';
        return view('admin.categories.create',compact('title'));
    }
    
    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:3|unique:categories',
        ],[
            'name.required' => 'Chưa nhập danh mục!',
            'name.unique' => 'Danh mục đã tồn tại!',
            'name.min' => 'Danh mục phải ít nhất :min kí tự!',
        ]);
        Categories::create([
            'name'=> $request->name,
        ]);
        return redirect()-> route('admin.categories.index')->with('msg', 'Tạo danh mục thành công');
    }

    public function edit($id){
        $title = 'Sửa danh mục';

        $category = Categories::find($id);

        return view('admin.categories.edit',compact('title','category'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|min:3|unique:categories,name,'.$id,
        ],[
            'name.required' => 'Chưa nhập danh mục!',
            'name.unique' => 'Danh mục đã tồn tại!',
            'name.min' => 'Danh mục phải ít nhất :min kí tự!',
        ]);
        $category = Categories::find($id);

        $data = [
            'name' => $request->name,
        ];
        $category->update($data);

        return redirect()->route('admin.categories.index')->with('msg', 'Cập nhật danh mục thành công');
    }
    public function delete($id){
        Categories::find($id)->delete();
        return redirect()->route('admin.categories.index')->with('msg','Xoá danh mục thành công');

    }
}
