@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('sliderarea')
    @include('user.home.sliderareahome')
@endsection

@section('content')
<section class="category-area section-padding30">
    <div class="container-fluid">
        <!-- Section Tittle -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center mb-85">
                    <h2>Cửa hàng theo thể loại</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="single-category mb-30">
                    <div class="category-img">
                        <img src="/assets/img/categori/cat1.jpg" alt="">
                        <div class="category-caption">
                            <h2>Phụ nữ</h2>
                            <span class="best"><a href="#">Best New Deals</a></span>
                            <span class="collection">New Collection</span>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-xl-4 col-lg-6">
                <div class="single-category mb-30">
                    <div class="category-img text-center">
                        <img src="assets/img/categori/cat2.jpg" alt="">
                        <div class="category-caption">
                            <span class="collection">Discount!</span>
                            <h2>Winter Cloth</h2>
                           <p>New Collection</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="single-category mb-30">
                    <div class="category-img">
                        <img src="assets/img/categori/cat3.jpg" alt="">
                        <div class="category-caption">
                            <h2>Thời Trang Nam</h2>
                            <span class="best"><a href="#">Best New Deals</a></span>
                            <span class="collection">New Collection</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection