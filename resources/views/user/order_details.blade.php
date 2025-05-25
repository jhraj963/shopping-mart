@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('user.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   
                </div>

                <div class="card-body">
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
                 </div>
                 <div class="card-body mt-2">
                    <h5>More Information</h5>
                    <table class="table table-info">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Total</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                           
                            <td>{{ $order->c_name  }}</td>
                            <td>{{ $order->c_phone  }}</td>
                            <td>{{ $order->subtotal  }} {{ $setting->currency }}</td>
                            <td>{{ $order->total  }} {{ $setting->currency }}</td>
                            <td>{{ $order->order_id  }}</td>
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
                            <td>{{ date('d F Y'),strtotime($order->c_name) }}</td>

                            </tr>
                          
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
