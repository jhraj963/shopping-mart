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
              <li class="breadcrumb-item active">Website Setting</li>
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
                <h3 class="card-title">Website Setting</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('website.setting.update',$setting->id)}}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="currency">Currency</label>
                    <select class="form-control" name="currency">
                        <option value="৳" {{ ($setting->currency == '৳') ? 'selected' : '' }}>Taka</option>
                        <option value="$" {{ ($setting->currency == '$') ? 'selected' : '' }}>USD</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="phone_one">Phone One</label>
                    <input type="text" class="form-control" name="phone_one" value="{{ $setting->phone_one }}">
                  </div>
                  <div class="form-group">
                    <label for="phone_two">Phone Two</label>
                    <input type="text" class="form-control" name="phone_two" value="{{ $setting->phone_two }}">
                  </div>
                  <div class="form-group">
                    <label for="main_email">Main Email</label>
                    <input type="text" class="form-control" name="main_email" value="{{ $setting->main_email }}">
                  </div>
                  <div class="form-group">
                    <label for="support_email">Support Email</label>
                    <input type="text" class="form-control" name="support_email" value="{{ $setting->support_email }}">
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ $setting->address }}">
                  </div>

                  <strong class="text-info">Social Link</strong>

                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" name="facebook" value="{{ $setting->facebook }}">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" name="twitter" value="{{ $setting->twitter }}">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" name="instagram" value="{{ $setting->instagram }}">
                </div>
                <div class="form-group">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" name="linkedin" value="{{ $setting->linkedin }}">
                </div>
                <div class="form-group">
                    <label for="youtube">Youtube</label>
                    <input type="text" class="form-control" name="youtube" value="{{ $setting->youtube }}">
                </div>
                
                  <strong class="text-info">Logo & Favicon</strong>

                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control" name="logo" value="{{ $setting->logo }}">
                    <input type="hidden" name="old_logo" value="{{  $setting->logo }}">
                </div>
                <div class="form-group">
                    <label for="favicon">Favicon</label>
                    <input type="file" class="form-control" name="favicon" value="{{ $setting->favicon }}">
                     <input type="hidden" name="old_favicon" value="{{  $setting->favicon }}">
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
