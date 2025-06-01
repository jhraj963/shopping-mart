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
				<div class="col-lg-8">
					<div class="cart_container">
						<div class="cart_title">Checkout Now</div>
						<form action="{{ route('order.place') }}" method="post" id="order-place">
                            @csrf
                          <div class="row p-4">
                            <div class="form-group col-lg-6">
                              <label>Customer Name <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="c_name" required="" >
                            </div>
                            <div class="form-group col-lg-6">
                              <label>Customer Phone <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" value="{{ Auth::user()->phone }}" name="c_phone" required="" >
                            </div>
                            <div class="form-group col-lg-6">
                              <label> Country <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="c_country" required="" >
                            </div>
                            <div class="form-group col-lg-6">
                              <label>Shipping Address <span class="text-danger">*</span> </label>
                              <input type="text" class="form-control" name="c_address" required="" >
                            </div>
                            
                            <div class="form-group col-lg-6">
                              <label>Email Address</label>
                              <input type="text" class="form-control" name="c_email" >
                            </div>
                            <div class="form-group col-lg-6">
                              <label>Zip Code</label>
                              <input type="text" class="form-control" name="c_zipcode" required="">
                            </div>
                            <div class="form-group col-lg-6">
                              <label>City Name</label>
                              <input type="text" class="form-control" name="c_city" required="">
                            </div>
                            <div class="form-group col-lg-6">
                              <label>Extra Phone</label>
                              <input type="text" class="form-control" name="c_extra_phone">
                            </div>
                              <br>
                                   <div class="form-group col-lg-4">
                                     <label>Paypal</label>
                                     <input type="radio"  name="payment_type" value="Paypal">
                                   </div>
                                   <div class="form-group col-lg-4">
                                     <label>Bkash/Rocket/Nagad/Upay </label>
                                     <input type="radio"  name="payment_type" checked="" value="AamarPay" >
                                   </div>
                                   <div class="form-group col-lg-4">
                                     <label>Hand Cash</label>
                                     <input type="radio"  name="payment_type" value="Hand Cash" >
                                   </div>
                                   
                          </div>
                          <div class="form-group pl-2">
                                <button type="submit" class="btn btn-warning">Order Place</button>
                          </div>

                          <span class="visually-hidden pl-2 d-none progress">Progressing.....</span>

                        </form>

						
					</div>
				</div>
                
                
                <div class="col-lg-4" >
                    <!-- Order Total -->
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Sub Total:</div>
                                <div class="order_total_amount">{{ $setting->currency }} {{ Cart::subtotal() }}</div>
                            </div>
                        </div>

                        {{--  apply Coupon  --}}
                            @if(Session::has('coupon'))
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title"><a href="{{ route('remove.coupon') }}" class="badge rounded-pill bg-danger text-white">Remove Coupon</a> Name({{ Session::get('coupon')['name'] }}):</div>
                                <div class="order_total_amount">{{ $setting->currency }} {{ Session::get('coupon')['discount'] }}</div>
                            </div>
                        </div>
                                @else
                            @endif
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Tax:</div>
                                <div class="order_total_amount">{{ $setting->currency }} 0.00</div>
                            </div>
                        </div>
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Shipping Charge:</div>
                                <div class="order_total_amount">{{ $setting->currency }} 0.00</div>
                            </div>
                        </div>

                            @if(Session::has('coupon'))
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Total Amount:</div>
                                <div class="order_total_amount">{{ $setting->currency }} {{ Session::get('coupon')['after_discount'] }}</div>
                            </div>
                        </div>
                            @else
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Total Amount:</div>
                                <div class="order_total_amount">{{ $setting->currency }} {{ Cart::subtotal() }}</div>
                            </div>
                        </div>
                            @endif

                        <div class="order_total mt-4 p-3" style="background-color: #f3f3f3; border: 1px solid #e1e1e1;">
                            <div class="order_total_content text-md-right">
                                @if(!Session::has('coupon'))
                                <form action="{{ route('apply.coupon') }}" method="post" class="w-100 text-left">
                                    @csrf
                                    <div style="font-weight: 600; font-size: 16px;" class="mb-2">Apply Coupon</div>
                                    <div class="form-group mb-2">
                                        <input type="text" name="coupon" class="form-control" required="" placeholder="Coupon Code" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-sm">Apply</button>
                                    </div>
                                </form>
                                @else
                                <strong class="badge bg-success">Coupon Successfully Applied</strong>
                                
                                @endif
                            </div>
                        </div></br></br>

                        {{--  <div class="cart_buttons">
                            <a href="{{ route('checkout') }}" type="button" class="btn btn-warning">Payment Now</a>
                        </div>  --}}
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
