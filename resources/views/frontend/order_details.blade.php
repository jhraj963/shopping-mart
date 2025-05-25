@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('frontend/styles/product_styles.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/styles/product_responsive.css') }}">
<script src="{{ asset('frontend/js/cart_custom.js') }}"></script>
<link rel="stylesheet" href="{{ asset('frontend/styles/shop_styles.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/styles/order_tracking.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@include('layouts.front_partial.collaps_nav')

<!-- Home -->

{{--  <div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">Order Details</h2>
    </div>
</div>  --}}

<!-- Shop -->

<div class="container-fluid my-5 d-sm-flex justify-content-center">
    <div class="card px-2">
        <div class="card-header bg-white">
          <div class="row justify-content-between">
            <div class="col">
                <p class="text-muted"> Order ID  <span class="font-weight-bold text-dark">{{ $order->order_id  }}</span></p> 
                <p class="text-muted"> Place On <span class="font-weight-bold text-dark">{{ $order->date }}</span> </p></div>
                <div class="flex-col my-auto">
                    {{--  <h6 class="ml-auto mr-3">
                        <a href="#">View Details</a>
                    </h6>  --}}
                </div>
          </div>
        </div>
        <div class="card-body">
            <div class="media flex-column flex-sm-row">
                <div class="media-body ">
                    <h4>Orders Details</h4>
                        <div>
                            <table class="table table-success">
                                <thead>
                                    <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order_details as $key=>$row)
                                    <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $row->product_name  }}</td>
                                    <td>{{ $row->color }} </td>
                                    <td>{{ $row->size }}</td>
                                    <td>{{ $row->quantity }}</td>
                                    <td>{{ $row->single_price }} {{ $setting->currency }}</td>
                                    <td>{{ $row->subtotal_price }} {{ $setting->currency }}</td>
                                    </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                        <h5>More Information</h5>
                        <table class="table table-info">
                            <thead>
                                <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                               
                                <td>{{ $order->c_name  }}</td>
                                <td>{{ $order->c_phone  }}</td>
                                <td>{{ $order->subtotal  }} {{ $setting->currency }}</td>
                                <td>{{ $order->total  }} {{ $setting->currency }}</td>
                                <td>
                                    @if($order->status==0)
                                      <span class="badge badge-danger">Order Pending</span>
                                   @elseif($order->status==1)
                                      <span class="badge badge-info">Order Recieved</span>
                                   @elseif($order->status==2)
                                      <span class="badge badge-primary">Order Shipped</span>
                                   @elseif($order->status==3)
                                      <span class="badge badge-success">Order Done</span> 
                                   @elseif($order->status==4)
                                      <span class="badge badge-warning">Order Return</span>   
                                   @elseif($order->status==5)  
                                      <span class="badge badge-danger">Order Cancel</span>
                                   @endif
                                </td>
    
                                </tr>
                              
                            </tbody>
                        </table>
                </div>
            </div>
        </div>

        <div class="row px-3">
            @php
            $status = $order->status;
         @endphp
            <div class="col">
                <ul id="progressbar">
                    <li class="step0 {{ $status >= 0 ? 'active' : 'text-muted' }}" id="step1">PENDING</li>
                    <li class="step0 {{ $status >= 1 ? 'active' : 'text-muted' }}" id="step2">RECEIVED</li>
                    <li class="step0 {{ $status >= 2 ? 'active' : 'text-muted' }}" id="step3">SHIPPED</li>
                    <li class="step0 {{ $status >= 3 ? 'active' : 'text-muted' }}" id="step4">DELIVERED</li>
                    <li class="step0 {{ $status >= 4 ? 'active' : 'text-muted' }}" id="step4">RETURNED</li>
                    {{--  <li class="step0 {{ $status == 4 ? 'active' : ($status > 4 ? 'text-muted' : '') }}" id="step5">RETURNED</li>  --}}
                    <li class="step0 {{ $status == 5 ? 'active' : 'text-muted' }}" id="step6">CANCELLED</li>
                  </ul>                  
            </div>
        </div>
         <div class="card-footer  bg-white px-sm-3 pt-sm-4 px-0">
            <div class="row text-center  ">
                <div class="col my-auto  border-line "><h5 >Track</h5></div>
                <div class="col  my-auto  border-line "><h5>Cancel</h5></div>
                <div class="col my-auto   border-line "><h5>Pre-pay</h5></div>
                <div class="col  my-auto mx-0 px-0 "><img class="img-fluid cursor-pointer" src="https://img.icons8.com/ios/50/000000/menu-2.png" width="30" height="30"></div>
            </div>
        </div>
    </div>
</div>



@endsection