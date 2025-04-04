@extends('layouts.admin')

@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Coupon </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add New Coupon</button>
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
                <h3 class="card-title">All Coupons List Here</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped ytable">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Coupon Code</th>
                    <th>Coupon Amount</th>
                    <th>Coupon Date</th>
                    <th>Coupon Status</th>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Coupon</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
           <form action="#" method="POST">
                @csrf
            <div class="form-group">
                <label for="coupon_code">Coupon Code</label>
                <input type="text" class="form-control" id="coupon_code" name="coupon_code" required>
            </div>
            <div class="form-group">
                <label for="coupon_code">Coupon Type</label>
                <select class="form-control" name="type">
                    <option value="1">Fixed</option>
                    <option value="2">Percentage</option>
                </select>
            </div>
            <div class="form-group">
                <label for="coupon_amount">Coupon Amount</label>
                <input type="text" class="form-control" id="coupon_amount" name="coupon_amount" required>
            </div>
            <div class="form-group">
                <label for="valid_date">Valid Date</label>
                <input type="date" class="form-control" id="valid_date" name="valid_date" required>
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><span class="d-none"> Loading...</span>  Submit</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">

$(function childcategory(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('coupon.index') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'coupon_code'  ,name:'coupon_code'},
				{data:'coupon_amount',name:'coupon_amount'},
				{data:'valid_date',name:'valid_date'},
				{data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});

    {{--  $('body').on('click','.edit', function(){
         let subcat_id=$(this).data('id');
         $.get("subcategory/edit/"+subcat_id, function(data){
            $("#modal_body").html(data);
         });
    });  --}}


{{--  For Delete  --}}

 $(document).on("click", "#delete_coupon", function(e){
             e.preventDefault();
             var link = $(this).attr("href");
                swal({
                  title: "Are you Want to delete?",
                  text: "Once Delete, This will be Permanently Delete!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                       window.location.href = link;
                  } else {
                    swal("Safe Data!");
                  }
                });
            });
</script>
@endsection
