<?php

namespace App\Http\Controllers\Admin;
use App\Models\Categories;
use Illuminate\Support;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\News;

class CategoryController extends Controller
{
    public function index(){
        $title = 'Danh mục';
        $stt = 0;
        $categoryList = Categories::all();
        return view('admin.categories.list',compact('title','categoryList','stt'));
    }

    public function categories_product(){
        $title = 'Danh mục sản phẩm';
        $stt = 0;
        $categoryList = Categories::all();
        return view('admin.categories.product',compact('title','categoryList','stt'));
    }

    public function categories_new(){
        $title = 'Danh mục tin tức';
        $stt = 0;
        $categoryList = Categories::all();
        return view('admin.categories.new',compact('title','categoryList','stt'));
    }

    public function create(){
        $title = 'Thêm danh mục';
        return view('admin.categories.create',compact('title'));
    }
    
    public function store(Request $request){
        $request->validate([
            'category_type' => 'required',
            'name' => 'required|min:3|unique:categories',
            
        ],[
            'category_type.required' => 'Chưa chọn loại danh mục!',
            'name.required' => 'Chưa nhập danh mục!',
            'name.unique' => 'Danh mục đã tồn tại!',
            'name.min' => 'Danh mục phải ít nhất :min kí tự!',
        ]);
        Categories::create([
            'category_type' => $request->category_type,
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
        return redirect()->back()->with('msg','Xoá danh mục thành công');

    }

    public function search(Request $request){
        
        if($request->search){
            $title = 'Danh mục';
            $stt = 0;
            $categoryList = Categories::Where('name','LIKE','%'.$request->search.'%')->get()->all();
            return view('admin.categories.list',compact('categoryList','title','stt'));
        }else{
            return redirect()->back()->with('found','Danh mục không tồn tại');
        }
    }

    public function searchProductCategory(Request $request){
        
        if($request->search){
            $title = 'Danh mục sản phẩm';
            $stt = 0;
            $categoryList = Categories::Where('name','LIKE','%'.$request->search.'%')->get()->all();
            return view('admin.categories.product',compact('categoryList','title','stt'));
        }else{
            return redirect()->back()->with('found','Danh mục không tồn tại');
        }
    }

    public function searchNewCategory(Request $request){
        
        if($request->search){
            $title = 'Danh mục tin tức';
            $stt = 0;
            $categoryList = Categories::Where('name','LIKE','%'.$request->search.'%')->get()->all();
            return view('admin.categories.new',compact('categoryList','title','stt'));
        }else{
            return redirect()->back()->with('found','Danh mục không tồn tại');
        }
    }

    public function products($id){
        $title = 'Sản phẩm';
        $productList = Products::Where('category_id',$id)->get()->all();
        return view('admin.products.list',compact('productList','title'));
    }

    public function news($id){
        $title = 'Tin tức';
        $newsList = News::Where('category_id',$id)->get()->all();
        return view('admin.news.list',compact('newsList','title'));
    }
}
