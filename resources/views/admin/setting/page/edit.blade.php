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
              <li class="breadcrumb-item active">Page Edit</li>
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
                <h3 class="card-title">Page Update</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('page.update', $page->id) }}" method="Post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Page Position</label>
                    <select class="form-control" name="page_position">
                        <option value="1" @if($page->page_position==1) selected @endif>Line One</option>
                                                {{--  Ternary Optretor  --}}
                        <option value="2" {{ ($page->page_position==2) ? "selected" : "" }}>Line Two</option> 
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Page Name</label>
                    <input type="text" class="form-control" name="page_name" id="page_name" value="{{ $page->page_name }}" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword2">Page Title</label>
                    <input type="text" class="form-control" name="page_title" id="page_title" value="{{ $page->page_title }}">
                  </div>


                  <div class="form-group">
                    <label for="exampleInputPassword3">Page Description</label>
                    <textarea class="form-control textarea" name="page_description">value="{{ $page->page_description }}"</textarea>
                    <small>This Data Will Show On Your Website</small>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-warning">Page Update</button>
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
