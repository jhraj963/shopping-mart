@extends('layouts.admin')

@section('admin_content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Blog Category </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">Add New Category</button>
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
                <h3 class="card-title">All Blog Categroeis List Here</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Category Name</th>
                    <th>Categorry Slug</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $key=>$row )
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $row->category_name }}</td>
                        <td>{{ $row->category_slug }}</td>
                        <td>
                            <a href="" class="btn btn-info btn-sm  edit" data-id="{{ $row->id }}" data-toggle="modal" data-target="#editModal">Edit <i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('blog.category.delete', $row->id) }}" class="btn btn-danger btn-sm" id="delete">Delete <i class="fa-solid fa-delete-left"></i></a>
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



   {{--  Add New Category   --}}

    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
           <form action="{{ route('blog.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
                <small id="category_name" class="form-text text-muted">This is Your Category</small>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
             </div>
            </form>
        </div>

        </div>
    </div>
    </div>

       {{--  Edit Category   --}}

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="modal_body">

        </div>

        </div>
    </div>
    </div>

//Dropify
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
<script type="text/javascript">
	$('.dropify').dropify();

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    $('body').on('click','.edit', function(){
         let cat_id=$(this).data('id');
         $.get("blog-category/edit/"+cat_id, function(data){
        $("#modal_body").html(data);
         });
    });
</script>
@endsection
