@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('sliderarea')
@include('user.auth.sliderarea')
@endsection

@section('content')
<div class="product_image_area">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="product_img_slide owl-carousel">
            <div class="single_product_img">
              <img src="{{ $product->imageUrl() }}" alt="#" class="img-fluid">
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="single_product_text text-center">
            <h3>{{ $product->name }}</h3>
            <p>
                {{ $product->description }}
            </p>
            <div class="card_area">
                <div class="product_count_area">
                    <p>Số lượng</p>
                    <div class="product_count d-inline-block">
                        <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                        <input class="product_count_item input-number" type="text" value="1" min="0" max="10">
                        <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                    </div>
                    <p>{{ $product->price }} VNĐ</p>
                </div>
              <div class="add_to_cart">
                  <a href="{{ route('user.addCart',$product->id) }}" class="btn_3">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection