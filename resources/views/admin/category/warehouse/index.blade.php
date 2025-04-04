@extends('layouts.admin')

@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Ware House </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add New Category</button>
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
                <h3 class="card-title">All WareHouse List Here</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm ytable">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Warehouse Name</th>
                    <th>Warehouse Address</th>
                    <th>Warehouse Phone</th>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Child Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
           <form action="{{ route('warehouse.store') }}" method="POST" id="add-form">
                @csrf
          
            <div class="form-group">
                <label for="warehouse_name">Warehouse Name</label>
                <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" required>
            </div>
            <div class="form-group">
                <label for="warehouse_address">Warehouse Address</label>
                <input type="text" class="form-control" id="warehouse_address" name="warehouse_address" required>
            </div>
            <div class="form-group">
                <label for="warehouse_phone">Warehouse Phone</label>
                <input type="text" class="form-control" id="warehouse_phone" name="warehouse_phone" required>
            </div>
            <div class="modal-footer">
                <button type="Submit" class="btn btn-primary"> <span class="d-none loader"><i class="fas fa-spinner"></i> Loading..</span> <span class="submit_btn"> Submit </span> </button>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Child Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="modal_body">

        </div>

        </div>
    </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
$(function childcategory(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('warehouse.index') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'warehouse_name'  ,name:'warehouse_name'},
				{data:'warehouse_address',name:'warehouse_address'},
				{data:'warehouse_phone',name:'warehouse_phone'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});

  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
    $.get("warehouse/edit/"+id, function(data){
        $("#modal_body").html(data);
    });
  });

  //form submit
  $('#add-form').on('submit',function(){
      $('.loader').removeClass('d-none');
      $('.submit_btn').addClass('d-none');
  });
</script>
@endsection
