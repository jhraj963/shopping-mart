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
        <h2 class="home_title">Track Your Order Now</h2>
    </div>
</div>

<!-- Shop -->

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="card col-lg-8">
                <form action="{{ route('check.order')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Order ID</label>
                        <input type="text" name="order_id" class="form-control" required placeholder="Write Your Order ID"><br>
                        <button class="btn btn-info"> Track Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection