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
              <li class="breadcrumb-item active">SEO Page</li>
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
                <h3 class="card-title">Your SEO Setting</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('seo.setting.update',$data->id)}}" method="Post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title" value="{{ $data->meta_title }}" placeholder="Meta Title">
                  </div>
                  <div class="form-group">
                    <label for="meta_author">Meta Author</label>
                    <input type="text" class="form-control" name="meta_author" value="{{ $data->meta_author }}" placeholder="Meta Title">
                  </div>
                  <div class="form-group">
                    <label for="meta_tag">Meta Tags</label>
                    <input type="text" class="form-control" name="meta_tag" value="{{ $data->meta_tag }}" placeholder="Meta Title">
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea type="text" class="form-control" name="meta_description" value="{{ $data->meta_description }}" placeholder="meta_description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="meta_keyword">Meta Keyword</label>
                    <input type="text" class="form-control" name="meta_keyword" value="{{ $data->meta_keyword }}" placeholder="meta_keyword">
                    <small>Example: shop,bazar,dog,t-shirt</small>
                  </div>

                  <strong class="text-center text-success">Others</strong><br>
                    <div class="form-group">
                    <label for="alexa_verification">Alexa Verification</label>
                    <input type="text" class="form-control" name="alexa_verification" value="{{ $data->alexa_verification }}" placeholder="Alexa Verification">
                    <small>Put Here Only Verfication Code</small>
                  </div>
                   <div class="form-group">
                    <label for="google_verification">Google Verification</label>
                    <input type="text" class="form-control" name="google_verification" value="{{ $data->google_verification }}" placeholder="Google Verification">
                    <small>Put Here Only Verfication Code</small>
                  </div>
                   <div class="form-group">
                    <label for="google_analytics">Google Analytics</label>
                    <input type="text" class="form-control" name="google_analytics" value="{{ $data->google_analytics }}" placeholder="Google Analytics">
                  </div>
                   <div class="form-group">
                    <label for="google_adsense">Google Adsense</label>
                   <input type="text" class="form-control" name="google_adsense" value="{{ $data->google_adsense }}" placeholder="Google Adsense">
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
