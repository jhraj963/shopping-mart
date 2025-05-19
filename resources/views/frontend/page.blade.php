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
        <h2 class="home_title">{{ $page->page_title }}</h2>
    </div>
</div>

<!-- Shop -->

<div class="shop">
    <div class="container">
        <div class="row">
                {!! $page->page_description !!}
        </div>
    </div>
</div>


@endsection