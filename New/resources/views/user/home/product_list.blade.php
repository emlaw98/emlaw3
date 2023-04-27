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
                        <form action="#">
                            <input type="text" name="#" placeholder="Search keyword">
                            <i class="ti-search"></i>
                        </form>
                    </div>
                    <div class="single_sedebar">
                        <div class="select_option">
                            <div class="select_option_list">Category <i class="right fas fa-caret-down"></i> </div>
                            <div class="select_option_dropdown">
                                <p><a href="#">Category 1</a></p>
                                <p><a href="#">Category 2</a></p>
                                <p><a href="#">Category 3</a></p>
                                <p><a href="#">Category 4</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="single_sedebar">
                        <div class="select_option">
                            <div class="select_option_list">Type <i class="right fas fa-caret-down"></i> </div>
                            <div class="select_option_dropdown">
                                <p><a href="#">Type 1</a></p>
                                <p><a href="#">Type 2</a></p>
                                <p><a href="#">Type 3</a></p>
                                <p><a href="#">Type 4</a></p>
                            </div>
                        </div>
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
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</section>
@endsection