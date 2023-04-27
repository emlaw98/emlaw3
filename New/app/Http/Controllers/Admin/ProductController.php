<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(){
        $title = 'Sản phẩm';

        $productList = Products::paginate(20);

        return view('admin.categories.products.list',compact('title','productList'));
    }

    public function create(){
        $title = 'Tạo sản phẩm';
        return view('admin.categories.products.create',compact('title',));
    }
    
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:products',
            'image' => 'required',
            'price' => 'required|integer',
            'description' => 'required'
        ],[
            'name.required' => 'Chưa nhập tên sản phẩm',
            'name.unique' => 'Sản phẩm đã tồn tại',
            'image.required' => 'Chưa nhập hình ảnh',
            'price.required' => 'Chưa nhập giá sản phẩm',
            'price.integer' => 'Giá sản phẩm phải là một số',
            'description.required' => 'Chưa nhập mô tả sản phẩm' 
        ]);
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            if(strcasecmp($extension,'jpg')===0
            || strcasecmp($extension,'jepg')===0
            || strcasecmp($extension,' png')===0){
                $image = Str::random(5)."_".$filename;
                while (file_exists("image/products/".$image)){
                    $image = Str::random(5)."_".$filename;  
            }
            $file->move("image/products/",$image);
            }
        }
        $data = [
            'name' => $request->name,
            'image' => $image,
            'price' => $request->price,
            'description' => $request->description,
        ];
        Products::create($data);
        return redirect()->route('admin.categories.products.index')->with('msg', 'Tạo sản phẩm thành công');
    }

    public function edit($id){
        $title = 'Sửa sản phẩm';

        $product = Products::find($id);

        return view('admin.categories.products.edit',compact('title','product'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|unique:products,name,'.$id,
            'price' => 'required|integer',
            'description' => 'required'
        ],[
            'name.required' => 'Chưa nhập tên sản phẩm',
            'name.unique' => 'Sản phẩm đã tồn tại',
            'price.required' => 'Chưa nhập giá sản phẩm',
            'price.integer' => 'Giá sản phẩm phải là một số',
            'description.required' => 'Chưa nhập mô tả sản phẩm' 
        ]);
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            if(strcasecmp($extension,'jpg')===0
            || strcasecmp($extension,'jepg')===0
            || strcasecmp($extension,' png')===0){
                $image = Str::random(5)."_".$filename;
                while (file_exists("image/products/".$image)){
                    $image = Str::random(5)."_".$filename;  
            }
            $file->move("image/products/",$image);
            }
        }
        $data = [
            'name' => $request->name,
            
            'price' => $request->price,
            'description' => $request->description,
        ];
        if($request->image){
            $data['image'] = $image;
        };
        $product = Products::find($id);
        $product->update($data);
        return redirect()->route('admin.categories.products.index')->with('msg', 'Sửa sản phẩm thành công');
    }

    public function delete($id){
        Products::find($id)->delete();
        return redirect()->route('admin.categories.products.index')->with('msg', 'Xoá sản phẩm thành công');
    }
}
