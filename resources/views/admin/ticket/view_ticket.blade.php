@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript" src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<style type="text/css">
  .bootstrap-tagsinput .tag {
    background: #428bca;;
    border: 1px solid white;
    padding: 1 6px;
    padding-left: 2px;
    margin-right: 2px;
    color: white;
    border-radius: 4px;
  }
</style>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reply Customer Ticket</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ticket Reply</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <h3>Your Ticket Details</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <strong>User: {{ $ticket->name }}</strong><br>
                            <strong>Subject: {{ $ticket->subject }}</strong><br>
                            <strong>Service: {{ $ticket->service }}</strong><br>
                            <strong>Priority: {{ $ticket->priority }}</strong><br>
                            <strong>Message: {{ $ticket->message }}</strong><br>
                        </div>
                        <div class="col-md-4">
                           <a href="{{ asset($ticket->image) }}" target="_blank"> <img src="{{ asset($ticket->image) }}" style="height: 100px; width:120px;" alt="No Image"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
     
       	<div class="row">
          <!-- left column -->
       
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Reply Ticket Message</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('admin.store.reply' )}}" method="post" enctype="multipart/form-data">
                        @csrf
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Message <span class="text-danger">*</span> </label>
                      <textarea type="text" class="form-control" name="message" required=""></textarea>
                      <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Image</label>
                      <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group col-lg-6">
                        <button class="btn btn-info ml-2" type="submit">Reply</button>
                    </div>
                  </div>
                  <a href="{{ route('admin.close.ticket',$ticket->id) }}" class="btn btn-danger" style="float:right;"> Close Ticket </a>
                    </form>
                </div>
               
            </div>
           </div>
        
            <!-- /.card -->
          <!-- right column -->
            @php 
                $replies=DB::table('replies')->where('ticket_id',$ticket->id)->orderBy('id','DESC')->get();
            @endphp
          <div class="col-md-6">
            <!-- Form Element sizes -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">All Replies</h3>
                  </div>
              <div class="card-body" style="height: 450px; overflow-y: scroll;">
                
            @isset($replies)	
                @foreach($replies as $row)
                 <div class="card mt-1 @if($row->user_id==0) ml-4 @endif">
                   <div class="card-header @if($row->user_id==0) bg-info @else bg-danger @endif ">
                    <i class="fa fa-user"></i> @if($row->user_id==0) Admin @else {{ $ticket->name }} @endif
                   </div>
                   <div class="card-body">
                     <blockquote class="blockquote mb-0">
                       <p>{{ $row->message }}</p>
                       <footer class="blockquote-footer">{{ date('d F Y'),strtotime($row->reply_date) }}</footer>
                     </blockquote>
                   </div>
                 </div>
               @endforeach	
             @endisset

              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
           
           </div>
           
         </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@endsection