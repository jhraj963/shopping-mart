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
						<div class="cart_title">Shopping Cart</div>
						<div class="cart_items">
							<ul class="cart_list">
                                @foreach ($content as $row)
                                    @php
                                        $product=DB::table('products')->where('id',$row->id)->first();
                                        $colors=explode(',',$product->color);
                                        $sizes=explode(',',$product->size);
                                    @endphp
								<li class="cart_item clearfix">
									<div class="cart_item_image">
                                        {{--  <img src="frontend/images/shopping_cart.jpg" alt="">  --}}
                                        <img src="{{ asset('files/product/' . $row->options->thumbnail) }}" alt="Product Thumbnail" width="100">
                                    </div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Name</div>
											<div class="cart_item_text">{{ $row->name }}</div>
										</div>

                                        @if($row->options->color !=NULL)
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Color</div>
											<div class="cart_item_text">
                                                <select class="custom-select form-control-sm color" data-id="{{$row->rowId}}" name="color" style="min-width: 120px;">
                                                    @foreach($colors as $color)
                                                        <option value="{{ $color }}" @if($color==$row->options->color) selected="" @endif>{{ $color }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
										</div>
                                        @endif

                                       @if($row->options->size !=NULL)
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Size</div>
											<div class="cart_item_text">
                                                <select class="custom-select form-control-sm size" name="size" style="min-width: 120px;" data-id="{{$row->rowId}}">
                                                    @foreach($sizes as $size)
                                                        <option value="{{ $size }}" @if($size==$row->options->size) selected="" @endif>{{ $size }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
										</div>
                                        @endif

										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Quantity</div>
											<div class="cart_item_text">
                                                <input type="number" class="form-control qty" name="qty" style="min-width: 50px;" data-id="{{ $row->rowId }}"  value="{{ $row->qty }}" min="1" required="">
                                            </div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Price</div>
											<div class="cart_item_text">{{ $setting->currency }} {{$row->price }} x {{ $row->qty }}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Total</div>
											<div class="cart_item_text">{{ $setting->currency }} {{ $row->qty * $row->price }}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Action</div>
											<div class="cart_item_text">
                                                <a href="#" data-id="{{ $row->rowId }}" id="removeProduct"> X</a>
                                            </div>
                                        </div>
								</li>
                                @endforeach
							</ul>
						</div>

						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Order Total:</div>
								<div class="order_total_amount">{{ $setting->currency }} {{ Cart::subtotal() }}</div>
							</div>
						</div>

						<div class="cart_buttons">
							<a href="{{route('cart.empty')}}" class="button cart_button_clear btn-danger">Empty Cart</a>
							<button type="button" class="button cart_button_checkout">Add to Cart</button>
						</div>
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
							<div class="newsletter_icon"><img src="images/send.png" alt=""></div>
							<div class="newsletter_title">Sign up for Newsletter</div>
							<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
						</div>
						<div class="newsletter_content clearfix">
							<form action="#" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
								<button class="newsletter_button">Subscribe</button>
							</form>
							<div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    $('body').on('click','#removeProduct', function(){
            let id=$(this).data('id');
            $.ajax({
            url:'{{ url('cartproduct/remove/') }}/'+id,
            type:'get',
            async:false,
            success:function(data){
                toastr.success(data);
                location.reload();
            }
            });
        });

        //qty update with ajax
		 $('body').on('blur','.qty', function(){
		    let qty=$(this).val();
		    let rowId=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/updateqty/') }}/'+rowId+'/'+qty,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });

        //color update with ajax
		 $('body').on('change','.color', function(){
		    let color=$(this).val();
		    let rowId=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/updatecolor/') }}/'+rowId+'/'+color,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });

        //size update with ajax
		 $('body').on('change','.size', function(){
		    let size=$(this).val();
		    let rowId=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/updatesize/') }}/'+rowId+'/'+size,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });


</script>
@endsection
