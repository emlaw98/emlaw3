<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;

class HomeController extends Controller
{   
    public function home(){
        $title = 'Trang chủ';
        $categoryList = Categories::Where('category_type', '0')->get();
        return view('user.home.home', compact('title','categoryList'));
    }

    public function products(){
        $title = 'Danh sách sản phẩm';
        $slider = 'Danh sách sản phẩm';
        $products = Products::paginate(10);
        $categoryList = Categories::Where('category_type', '0')->get();
        return view('user.home.product_list',compact('title', 'slider','products','categoryList'));
    }

    public function blog(){
        $title = 'Tin tức';
        $slider = 'Tin tức';
        $news = News::paginate(5);
        return view('user.home.blog',compact('title', 'slider','news'));
    }
    public function productDetails($id){
        $title = 'Chi tiết sản phẩm';
        $slider = 'Chi tiết sản phẩm';
        $product = Products::find($id);
        $categoryList = Categories::Where('category_type', '0')->get();
        return view('user.home.product_details',compact('title', 'slider','product','categoryList'));
    }
    public function productbyCategory($id){
        $category_name = Categories::find($id)->name;
        $title = $category_name;
        $slider = $category_name;
        $products = Products::where('category_id', $id)->get();
        $categoryList = Categories::Where('category_type', '0')->get();
        return view('user.home.product_list',compact('title', 'slider','products','categoryList','category_name'));
    }

    public function searchProduct(Request $request){
        
        if($request->search){
            $title = 'Danh sách sản phẩm';
            $slider = 'Danh sách sản phẩm';
            $categoryList = Categories::Where('category_type', '0')->get();
            $products = Products::Where('name','LIKE','%'.$request->search.'%')->get();
            return view('user.home.product_list',compact('products','title','slider','categoryList'));
        }else{
            return redirect()->back()->with('found','Sản phẩm không tồn tại');
        }
    }

    
}