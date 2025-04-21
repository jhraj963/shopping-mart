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
            <h1 class="m-0">Campaign </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add New Campaign</button>
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
                <h3 class="card-title">All Campaing List Here</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm ytable">
                  <thead>
                  <tr>
                    <th>Start Date</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Discount(%)</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>


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



   {{--  Add Sub New Category   --}}

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Campaign</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
           <form action="{{ route('campaign.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf

            <div class="form-group">
                <label for="title">Campaign Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" required>
                <small id="title" class="form-text text-muted">This is Campaign Title</small>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <div class="form-group">
                <label for="discount">Discount (%) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="discount" name="discount" required>
            </div>
            <div class="form-group">
                <label for="discount">status <span class="text-danger">*</span></label>
                <select class="form-control" name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Campaign Image</label>
                <input type="file" class="form-control dropify" id="image" name="image" required>
                <small id="image" class="form-text text-muted">This is Your Campaign Image</small>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><span class="d-none">Loading...</span> Submit</button>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Campaign</h5>
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
$(function childcategory(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('campaign.index') }}",
			columns:[
				{data:'start_date',name:'start_date'},
				{data:'title'  ,name:'title'},
				{data:'image',name:'image', render:function(data, type, full, meta){
                    return "<img src=\""+data+"\" height=\"30\"/>"
                }},
				{data:'discount',name:'discount'},
				{data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});

$('body').on('click','.edit', function(){
         let childcat_id=$(this).data('id');
         $.get("/campaign/edit/"+childcat_id, function(data){
            $("#modal_body").html(data);
         });
    });
</script>
@endsection
