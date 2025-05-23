@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('user.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <h3>Your Ticket Details</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <strong>Subject: {{ $ticket->subject }}</strong><br>
                            <strong>Service: {{ $ticket->service }}</strong><br>
                            <strong>Priority: {{ $ticket->priority }}</strong><br>
                            <strong>Message: {{ $ticket->message }}</strong><br>
                        </div>
                        <div class="col-md-4">
                           <a href="{{ asset($ticket->image) }}" target="_blank"> <img src="{{ asset($ticket->image) }}" style="height: 100px; width:120px;"></a>
                        </div>
                    </div>
                </div>

                <div class="card p-2 mt-2">
                    <strong>All Reply Message.</strong><br>
                    <div class="card-body" style="height: 450px; overflow-y: scroll;">
                    {{--  @isset($replies)
                       @foreach($replies as $row)  --}}
                        <div class="card">
                          <div class="card-header  ">
                           <i class="fa fa-user">{{ Auth::user()->name }}</i>
                          </div>
                          <div class="card-body">
                            <blockquote class="blockquote mb-0">
                              <p>Akljlkjlk</p>
                              <footer class="blockquote-footer"></footer>
                            </blockquote>
                          </div>
                        </div>

                        <div class="card mt-1 ml-4">
                          <div class="card-header  ">
                            <span style="float:right;"><i class="fa fa-user">Admin</i></span>
                          </div>
                          <div class="card-body">
                            <blockquote class="blockquote mb-0">
                              <p>Akljlkjlk</p>
                              <footer class="blockquote-footer"></footer>
                            </blockquote>
                          </div>
                        </div>
                      {{--  @endforeach
                    @endisset  --}}
                    </div>
                </div>

                <div class="card-body">
                   <h4>Reply Message...</h4><br>
                   <div>
                   	  <form action="{{ route('store.ticket') }}" method="post" enctype="multipart/form-data">
                        @csrf
                   	    <div class="form-group">
                   	      <label for="exampleInputPassword1">Message</label>
                   	      <textarea class="form-control" name="message" required=""></textarea>
                   	    </div>
                   	    <div>
                   	    	<label for="exampleInputPassword1">Image</label>
                   	    	<input type="file" class="form-control" name="image">
                   	    </div><br>
                   	    <button type="submit" class="btn btn-info">Submit Ticket</button>
                   	  </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection
