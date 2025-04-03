@extends('layouts.admin')

@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Pages </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <a href="{{ route('create.page') }}" class="btn btn-primary"> Add New Pages</a>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Pages List Here</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Page Name</th>
                    <th>Page Title</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($page as $key=>$row )
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $row->page_name }}</td>
                        <td>{{ $row->page_title }}</td>
                        <td>
                            <a href="{{ route('page.edit', $row->id) }}" class="btn btn-info btn-sm  edit">Edit <i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('page.delete', $row->id) }}" class="btn btn-danger btn-sm" id="delete">Delete <i class="fa-solid fa-delete-left"></i></a>
                        </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
        </div>
        </div>
    </div>
    </section>
    </div>
    </div>

@endsection
