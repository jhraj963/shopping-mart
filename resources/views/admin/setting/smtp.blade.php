@extends('layouts.admin')

@section('admin_content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">SMTP Mail</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">SMTP Mail Setting</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('smtp.setting.update', $smtp->id)}}" method="Post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="mailer">Mail Mailer</label>
                    <input type="text" class="form-control" name="mailer" value="{{ $smtp->mailer }}" placeholder="Mail Mailer">
                     <small>Example: smtp</small>
                  </div>
                  <div class="form-group">
                    <label for="host">Mail Host</label>
                    <input type="text" class="form-control" name="host" value="{{ $smtp->host }}" placeholder="Mail Host">
                  </div>
                  <div class="form-group">
                    <label for="port">Mail Port</label>
                    <input type="text" class="form-control" name="port" value="{{ $smtp->port }}" placeholder="Mail Port">
                  </div>
                  <div class="form-group">
                    <label for="user_name">Mail Username</label>
                    <input type="text" class="form-control" name="user_name" value="{{ $smtp->user_name }}" placeholder="Mail Username">
                  </div>
                  <div class="form-group">
                    <label for="password">Mail Password</label>
                    <input type="text" class="form-control" name="password" value="{{ $smtp->password }}" placeholder="Mail Password">
                    <small>Example: shop,bazar,dog,t-shirt</small>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
