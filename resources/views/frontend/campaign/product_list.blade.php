@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('frontend/styles/product_styles.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/styles/product_responsive.css') }}">
<script src="{{ asset('frontend/js/cart_custom.js') }}"></script>
<link rel="stylesheet" href="{{ asset('frontend/styles/shop_styles.css') }}">

@include('layouts.front_partial.collaps_nav')

<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">Campaign Products</h2>
    </div>
</div>


<!-- Shop -->

<div class="shop">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">

                <!-- Shop Content -->

                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        <div class="shop_product_count"><span>{{ count($products) }}</span> products found</div>
                        <div class="shop_sorting">
                            <span>Sort by:</span>
                            <ul>
                                <li>
                                    <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                    <ul>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
                                        <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product_grid">
                        <div class="product_grid_border"></div>

                        <!-- Product Item -->
                        @foreach ($products as $row)
                            <div class="product_item is_new">
                                <div class="product_border"></div>
                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('files/product/'.$row->thumbnail) }}" alt="{{ $row->name }}"></div>
                                <div class="product_content"></br>

                                    <div class="product_price">{{ $setting->currency }}{{ $row->price }}</div>

                                    <div class="product_name"><div><a href="{{ route('product.details',$row->slug) }}" tabindex="0">{{ $row->name }}</a></div></div>
                                </div>
                                <a href="{{ route('add.wishlist',$row->product_id) }}"><div class="product_fav"><i class="fas fa-heart"></i></div> </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Shop Page Navigation -->
                    <div class="shop_page_nav d-flex flex-row">
                        <ul class="page_nav d-flex flex-row">
                            {{ $products->links() }}
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


<!-- Brands -->

<div class="brands">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="brands_slider_container">

                    <!-- Brands Slider -->

                    <div class="owl-carousel owl-theme brands_slider">

                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_1.jpg" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_2.jpg" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_3.jpg" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_4.jpg" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_5.jpg" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_6.jpg" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_7.jpg" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_8.jpg" alt=""></div></div>

                    </div>

                    <!-- Brands Slider Navigation -->
                    <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



@endsection
