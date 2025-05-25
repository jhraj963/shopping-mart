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
              <li class="breadcrumb-item active">Payment Gateway Setting</li>
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
            {{--  AamarPay  --}}
          <div class="col-4">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">AamarPay Payment Gateway</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('update.aamarpay') }}" method="Post">
                @csrf
                <input type="hidden" name="id" value="{{ $aamarpay->id }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="mailer">Store ID</label>
                    <input type="text" class="form-control" name="store_id" value="{{ $aamarpay->store_id }}" required>

                  </div>
                  <div class="form-group">
                    <label for="host">Signature Key</label>
                    <input type="text" class="form-control" name="signature_key" value="{{ $aamarpay->signature_key }}" required>
                  </div>
                  <div class="form-group">
                    <input type="checkbox" name="status" value="1" @if($aamarpay->status==1) checked @endif>
                    <label for="host">Live Server</label><br>
                    <small>If Checkbox are not checked, it working for sandbox only.</small>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>

          {{--  SurjoPay  --}}
          <div class="col-4">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">SurjoPay Payment Gateway</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('update.surjopay') }}" method="Post">
                @csrf
                <input type="hidden" name="id" value="{{ $surjopay->id }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="mailer">Store ID</label>
                    <input type="text" class="form-control" name="store_id" value="{{ $surjopay->store_id }}" required>

                  </div>
                  <div class="form-group">
                    <label for="host">Signature Key</label>
                    <input type="text" class="form-control" name="signature_key" value="{{ $surjopay->signature_key }}" required>
                  </div>
                  <div class="form-group">
                    <input type="checkbox" name="status" value="1" @if($surjopay->status==1) checked @endif>
                    <label for="host">Live Server</label><br>
                    <small>If Checkbox are not checked, it working for sandbox only.</small>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>

          {{--  SSLCOMMERZ  --}}
          <div class="col-4">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">SSLCOMMERZ Payment Gateway</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('update.ssl') }}" method="Post">
                @csrf
                <input type="hidden" name="id" value="{{ $ssl->id }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="mailer">Store ID</label>
                    <input type="text" class="form-control" name="store_id" value="{{ $ssl->store_id }}" required>

                  </div>
                  <div class="form-group">
                    <label for="host">Signature Key</label>
                    <input type="text" class="form-control" name="signature_key" value="{{ $ssl->signature_key }}" required>
                  </div>
                  <div class="form-group">
                    <input type="checkbox" name="status" value="1" @if($ssl->status==1) checked @endif>
                    <label for="host">Live Server</label><br>
                    <small>If Checkbox are not checked, it working for sandbox only.</small>
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
