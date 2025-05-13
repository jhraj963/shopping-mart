@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{ asset('frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/styles/cart_responsive.css') }}">

<script src="{{ asset('frontend/js/cart_custom.js') }}"></script>

@include('layouts.front_partial.collaps_nav')


<!-- Cart -->

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart_container">
						<div class="cart_title">Your Wishlist</div>
						<div class="cart_items">
							<ul class="cart_list">
                                @foreach ($wishlist as $row)
								<li class="cart_item clearfix">
									<div class="cart_item_image">
                                        <img src="{{ asset('files/product/' . $row->thumbnail) }}" alt="Product Thumbnail" width="100">
                                    </div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_text">{{ $row->name }}</div>
										</div>

										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_text">{{ $row->date }}</div>
										</div>

										<div class="cart_item_price cart_info_col">
                                            <a href="{{ route('product.details',$row->slug) }}"><button type="button" class="btn btn-primary">Add to Cart</button></a>
                                            <a href="{{ route('wishlistproduct.delete',$row->id) }}"><button type="button" class="btn btn-danger">Remove</button></a>
										</div>
									</div>
								</li>
                                @endforeach
							</ul>
						</div>

						<div class="cart_buttons">
							<a href="{{ route('clear.wishlist') }}" class="button cart_button_clear btn-info">Clear Wishlist</a>
							<a href="{{url('/')}}" class="button cart_button_clear btn-danger">Back To Home</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection
