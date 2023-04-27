<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Products;

class HomeController extends Controller
{
    public function home(){
        $title = 'Trang chủ';
        return view('user.home.home', compact('title'));
    }

    public function products(){
        $title = 'Danh sách sản phẩm';
        $slider = 'Danh sách sản phẩm';
        $products = Products::paginate(10);

        return view('user.home.product_list',compact('title', 'slider','products'));
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
        return view('user.home.product_details',compact('title', 'slider','product'));
    }
}