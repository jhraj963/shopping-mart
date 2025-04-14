@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend/styles/product_styles.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/styles/product_responsive.css') }}">
@include('layouts.front_partial.collaps_nav')
<style type="text/css">
	.checked {
  color: orange;
}
</style>


	<!-- Single Product -->

    <div class="single_product">
        <div class="container">
            <div class="row">
                @php
                    $images=json_decode($product->images,true);
                    $color=explode(',',$product->color);
                    $sizes=explode(',',$product->size);
                @endphp
                <!-- Images -->
                <div class="col-lg-2 order-lg-1 order-2">
                    <ul class="image_list">
                        @foreach ($images as $image)
                            <li data-image="{{ asset('files/product/'.$image) }}"><img src="{{ asset('files/product/'.$image) }}" alt=""></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Selected Image -->
                <div class="col-lg-4 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{ asset('files/product/'.$product->thumbnail) }}" alt=""></div>
                </div>

                <!-- Description -->
                <div class="col-lg-4 order-3">
                    <div class="product_description">
                        <div class="product_category">{{ $product->category->category_name }} > {{ $product->subcategory->subcategory_name }}</div>
                        <div class="product_name" style="font-size:21px">{{ $product->name }}</div>
                         <div class="product_category"><b> Brand: {{ $product->brand->brand_name }} </b></div>
                         <div class="product_category"><b> Stock: {{ $product->stock_quantity }} </b></div>
                         <div class="product_category"><b> Unit: {{ $product->unit }} </b></div>
                        <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                        @if($product->discount_price==NULL)
                            <div class="product_price">{{ $setting->currency }}{{ $product->selling_price }}</div>
                        @else
                            <div class="product_price"><span><del class="text-danger">{{ $setting->currency }}{{ $product->selling_price }}</del></span>{{ $setting->currency }}{{ $product->discount_price }}</div>
                        @endif
                        {{--  <div class="product_price" style="margin-top: 25px">$2000</div>  --}}
                        {{--  <div class="product_text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum. laoreet turpis, nec sollicitudin dolor cursus at. Maecenas aliquet, dolor a faucibus efficitur, nisi tellus cursus urna, eget dictum lacus turpis.</p>
                        </div>  --}}
                        <div class="order_info d-flex flex-row">
                            <form action="#">
                                <div class="form-group">
                                    <div class="row">
                                        @isset($product->size)
                                        <div class="col-lg-6">
                                            <label>Select Color</label>
                                            <select class="form-control form-control-sm" name="size">
                                               @foreach($color as $row)
												   <option value="{{ $row }}">{{ $row }}</option>
												@endforeach

                                            </select>
                                        </div>
                                        @endisset

                                        @isset($product->color)
                                        <div class="col-lg-6">
                                            <label>Select Size</label>
                                            <select class="form-control form-control-sm" name="color">
                                                @foreach ($sizes as $size)
                                                    <option>{{ $size }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endisset
                                    </div>
                                </div>
                                <div class="clearfix" style="z-index: 1000;">

                                    <!-- Product Quantity -->
                                    <div class="product_quantity clearfix ml-2">
                                        <span>Quantity: </span>
                                        <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                        <div class="quantity_buttons">
                                            <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                            <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                        </div>
                                    </div>

                                    <!-- Product Color -->
                                    <ul class="product_color">
                                        <li>
                                            <span>Color: </span>
                                            <div class="color_mark_container">
                                                <div id="selected_color" class="color_mark"></div>
                                            </div>
                                            <div class="color_dropdown_button"><i class="fas fa-chevron-down"></i></div>

                                            <ul class="color_list">
                                                <li><div class="color_mark" style="background: #999999;"></div></li>
                                                <li><div class="color_mark" style="background: #b19c83;"></div></li>
                                                <li><div class="color_mark" style="background: #000000;"></div></li>
                                            </ul>
                                        </li>
                                    </ul>

                                </div>

                                <div class="button_container">
                                    <button type="button" class="button cart_button">Add to Cart</button>
                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 order-4 style="border-left: 1px solid grey; padding-left: 10px;">
                        <strong class="text-muted">Pickup Point of this product</strong><br>
				        <i class="fa fa-map"> {{ $product->pickuppoint->pickup_point_name }} </i><hr><br>
                        <strong class="text-muted"> Home Delivery :</strong><br>
				 -> (4-8) days after the order placed.<br>
				 -> Cash on Delivery Available.
				 <hr><br>
				 <strong class="text-muted"> Product Return & Warrenty :</strong><br>
				 -> 7 days return guarranty.<br>
				 -> Warrenty not available.
				 <hr><br>
				    @isset($product->video)
				 <strong>Product Video : </strong>
				 <iframe width="340" height="205" src="https://www.youtube.com/embed/{{ $product->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				    @endisset
                </div>
            </div>
        </div>
    </div>

    </div><br><br>

{{--  Product Description  --}}
   {{--  <div class="row">
        <div class="col-lg-12">
            <div class="card-center">
            <div class="card-header">
            <h4>Product details of {{ $product->name }}</h4>
            </div>
            <div class="card-body">
                    {!! $product->description !!}
            </div>
            </div>
        </div>
    </div><br>  --}}

    {{--  Product Review  --}}

    		<div class="row">
			<div class="col-lg-12">
			 <div class="card">
			  <div class="card-header">
				<h4>Product details of {{ $product->name }}</h4>
			  </div>
				<div class="card-body">
						{!! $product->description !!}
				</div>
			 </div>
			</div>
		</div><br>
		<div class="row">
			<div class="col-lg-12">
			 <div class="card">
			  <div class="card-header">
				<h4>Ratings & Reviews of  {{ $product->name }}</h4>
			  </div>
			  


				<div class="card-body">
					<div class="row">
						<div class="col-lg-3">
							Average Review of  {{ $product->name }}:<br>
						{{--  @if($sum_rating !=NULL)
							@if(intval($sum_rating/$count_rating) == 5)
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							@elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							@elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							@elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							@else
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							@endif
						@endif	  --}}
						</div>
						<div class="col-md-3">
							{{-- all review show --}}
							Total Review Of This Product:<br>
						 	 		  <div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											{{--  <span> Total {{ $review_5 }} </span>  --}}
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											{{--  <span> Total {{ $review_4 }} </span>  --}}
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											{{--  <span> Total {{ $review_3 }} </span>  --}}
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											{{--  <span> Total {{ $review_2 }} </span>  --}}
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											{{--  <span> Total {{ $review_1 }} </span>  --}}
										</div>
										
									
						</div>
						<div class="col-lg-6">
							<form action="{{ route('store.review') }}" method="post">
								@csrf
							  <div class="form-group">
							    <label for="details">Write Your Review</label>
							    <textarea type="text" class="form-control" name="review" required=""></textarea>
							  </div>
								<input type="hidden" name="product_id" value="{{ $product->id }}">
							  <div class="form-group ">
							    <label for="review">Write Your Review</label>
							     <select class="custom-select form-control-sm" name="rating" style="min-width: 120px;">
							     	<option disabled="" selected="">Select Your Review</option>
							     	<option value="1">1 star</option>
							     	<option value="2">2 star</option>
							     	<option value="3">3 star</option>
							     	<option value="4">4 star</option>
							     	<option value="5">5 star</option>
							     </select> 
							     
							  </div>
							  @if(Auth::check())
							  <button type="submit" class="btn btn-sm btn-info"><span class="fa fa-star "></span> submit review</button>
							  @else
							   <p>Please Login First For Submit A Review.</p>
							  @endif
							</form>
						</div>
					</div>
						<br>

					{{-- all review of this product --}}	
						<strong>All review of {{ $product->name }}</strong> <hr>
					<div class="row">
						@foreach($review as $row)
							<div class="card col-lg-5 m-2">
						 	 <div class="card-header">
						 	 		{{ $row->user->name }}  ( {{ date('d F , Y'), strtotime($row->review_date) }} )
						 	 </div>
						 	 <div class="card-body">
						 	 		{{ $row->review }}
						 	 		  @if($row->rating==5)
						 	 		  <div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
										</div>
										@elseif($row->rating==4)
										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
										</div>
										@elseif($row->rating==3)
										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
										</div>
										@elseif($row->rating==2)
										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
										</div>
										@elseif($row->rating==1)
										<div>
											<span class="fa fa-star checked"></span>
										</div>
										 @endif
						 	 </div>
						 </div>
					  @endforeach
					</div>	
				</div>


			 </div>
			</div>
		</div>

	 </div>
	</div>
</div>

	<!-- Related Product -->

    <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Related Products</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">

                        <!-- Recently Viewed Slider -->
                        <div class="owl-carousel owl-theme viewed_slider">

                            @foreach ($related_product as $row)
                            <!-- Recently Viewed Item -->
                                <div class="owl-item">
                                    <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="viewed_image"><img src="{{ asset('files/product/'.$row->thumbnail) }}" alt=""></div>
                                        <div class="viewed_content text-center">
                                            @if($row->discount_price==NULL)
                                                <div class="viewed_price">{{ $setting->currency }}{{ $row->selling_price }}</div>
                                            @else
                                                <div class="viewed_price">{{ $setting->currency }}{{ $row->discount_price }}<span>{{ $setting->currency }}{{ $row->selling_price }}</span></div>
                                            @endif

                                            <div class="viewed_name"><a href="{{ route('product.details',$row->slug) }}">{{ substr($row->name, 0,50) }}</a></div>
                                        </div>
                                        <ul class="item_marks">
                                            <li class="item_mark item_discount">-25%</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

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

                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center">
                                    <img src="{{ asset('frontend/images/brands_1.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center">
                                    <img src="{{ asset('frontend/images/brands_2.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center">
                                    <img src="{{ asset('frontend/images/brands_3.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center">
                                    <img src="{{ asset('frontend/images/brands_4.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center">
                                    <img src="{{ asset('frontend/images/brands_5.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center">
                                    <img src="{{ asset('frontend/images/brands_6.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center">
                                    <img src="{{ asset('frontend/images/brands_7.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center">
                                    <img src="{{ asset('frontend/images/brands_8.jpg') }}" alt="">
                                </div>
                            </div>

                        </div>

                        <!-- Brands Slider Navigation -->
                        <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                    </div>
                </div>
            </div>
        </div>
    </div>


	<!-- Newsletter -->

    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                        <div class="newsletter_title_container">
                            <div class="newsletter_icon">
                                <img src="{{ asset('frontend/images/send.png') }}" alt="">
                            </div>
                            <div class="newsletter_title">Sign up for Newsletter</div>
                            <div class="newsletter_text">
                                <p>...and receive %20 coupon for first shopping.</p>
                            </div>
                        </div>
                        <div class="newsletter_content clearfix">
                            <form action="#" class="newsletter_form">
                                <input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
                                <button class="newsletter_button">Subscribe</button>
                            </form>
                            <div class="newsletter_unsubscribe_link">
                                <a href="#">unsubscribe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('frontend/js/cart_custom.js') }}"></script>
@endsection
