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
                    {{ __('Dashboard') }}
                    <a href="{{ route('write.review') }}" style="float:right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                </div>

                <div class="card-body">
                   <h4>Your Defaul Shipping Credintials.</h4><br>
                   <div>
                   	  <form action="{{ route('store.website.review') }}" method="post">
                        @csrf
                   	    <div class="form-group">
                   	      <label for="exampleInputEmail1">Shipping Name</label>
                   	      <input type="text" class="form-control" name="shipping_name" value="">
                   	    </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                            <label for="exampleInputEmail1">Shipping Phone</label>
                            <input type="text" class="form-control" name="shipping_phone" value="">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="exampleInputEmail1">Shipping Email</label>
                                <input type="text" class="form-control" name="shipping_email" value="">
                            </div>
                        </div>
                   	    <div class="form-group">
                   	      <label for="exampleInputEmail1">Shipping Address</label>
                   	      <input type="text" class="form-control" name="shipping_address" value="">
                   	    </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                            <label for="exampleInputEmail1">Shipping Country</label>
                            <input type="text" class="form-control" name="shipping_country" value="">
                            </div>
                            <div class="form-group col-lg-4">
                            <label for="exampleInputEmail1">Shipping City</label>
                            <input type="text" class="form-control" name="shipping_city" value="">
                            </div>
                            <div class="form-group col-lg-4">
                            <label for="exampleInputEmail1">Shipping Zipcode</label>
                            <input type="text" class="form-control" name="shipping_zipcode" value="">
                            </div>
                        </div>
                        <br>
                   	    <button type="submit" class="btn btn-primary">Submit</button>
                   	  </form>
                   </div>
                </div>
                <hr>
                <div class="card-body">
                    <h4>Change Your Password.</h4><br>
                    <div>
                          <form action="{{ route('customer.password.change') }}" method="post">
                         @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Old Password</label>
                                <input type="password" class="form-control" name="old_password" value="" required="">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">New Password</label>
                              <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" value="" required="">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" value="" required="">
                            </div>
                         <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection
