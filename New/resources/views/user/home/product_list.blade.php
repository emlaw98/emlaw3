@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('sliderarea')
@include('user.auth.sliderarea')
@endsection

@section('content')
<section class="product_list section_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="product_sidebar">
                    <div class="single_sedebar">
                        <form action="{{ route('searchProduct') }}" method="GET" role="search">
                            <input type="text" id="search" name="search" placeholder="Tìm kiếm sản phẩm" value="{{ old('search') }}">
                            <i class="ti-search"></i>
                        </form>
                    </div>
                    <div class="single_sedebar">
                        @if(!empty($category_name))
                            <div class="select_option">
                                <div class="select_option_list">{{ $category_name }}<i class="right fas fa-caret-down"></i> </div>
                                <div class="select_option_dropdown">
                                    @foreach ($categoryList as $category)
                                    <p><a href="{{ route('productbyCategory',$category->id) }}">{{ $category->name }}</a></p>
                                    @endforeach
                                </div>
                            </div>
                        @else
                        <div class="select_option">
                            <div class="select_option_list">Danh mục sản phẩm <i class="right fas fa-caret-down"></i> </div>
                            <div class="select_option_dropdown">
                                @foreach ($categoryList as $category)
                                <p><a href="{{ route('productbyCategory',$category->id) }}">{{ $category->name }}</a></p>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="product_list">
                    <div class="row">
                        @if($products)
                        @foreach ($products as $product)
                        <div class="col-lg-6 col-sm-6">
                            <div class="single_product_item">
                                <img width="100%" src="{{ $product->imageUrl() }}" alt="" class="img-fluid">
                                <h3> <a href="{{ route('productDetails',$product->id) }}">{{ $product->name }}</a> </h3>
                                <p style="text-align:center">{{ $product->price }} VNĐ</p>
                            </div>
                        </div>
                        @endforeach                         
                        @endif
                </div>
                @if (session('found'))
                    <div class="alert alert-danger">{{ session('found') }}</div>
                @endif
            </div>
        </div>
    </div>
</section>
</section>
@endsection