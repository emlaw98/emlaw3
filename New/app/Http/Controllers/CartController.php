<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;
use App\Cart;

class CartController extends Controller
{
    public function addCart(Request $request ,$id){
        $product = Products::find($id);
        if($product != null){
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->addCart($product , $id);
        $request->session()->put('Cart', $newCart);
    }   
        $categoryList = Categories::Where('category_type', '0')->get();
        $title = 'Giỏ hàng';
        $slider = 'Giỏ hàng';
        return view('user.cart.cart', compact('title','slider','categoryList','newCart'));

    }
    public function showCart(){
        $categoryList = Categories::Where('category_type', '0')->get();
        $title = 'Giỏ hàng';
        $slider = 'Giỏ hàng';
        return view('user.cart.cart', compact('title','slider','categoryList'));
    }

    public function updateCart(Request $request ,$id){
        $product = Products::find($id);
        if($product != null){
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->addCart($product , $id);
        $request->session()->put('Cart', $newCart);
    }   
        $categoryList = Categories::Where('category_type', '0')->get();
        $title = 'Giỏ hàng';
        $slider = 'Giỏ hàng';
        return view('user.cart.cart', compact('title','slider','categoryList','newCart'));

    }
}
