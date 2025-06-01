@extends('layouts.admin')

@section('admin_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Orders </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Orders List Here</h3>
              </div><br>
              <div class="row p-2">

                <div class="form-group col-3">
                     <label>Payment Type</label>
                    <select class="form-control submitable" name="payment_type"  id="payment_type">
                        <option value="">All</option>
                        <option value="Hand Cash">Hand Cash</option>
                        <option value="Aamarpay">Aamarpay</option>
                        <option value="Paypal">Paypal</option>
                    </select>
                </div>
                <div class="form-group col-3">
                    <label>Date</label>
                        <input type="date" name="date" id="date" class="form-control submitable_input">
                </div>
                <div class="form-group col-3">
                     <label>Status</label>
                    <select class="form-control submitable" name="status"  id="status">
                        <option value="0,1,2,3,4,5">All</option>
                            <option value="0">Pending</option>
                            <option value="1">Received</option>
                            <option value="2">Shipped</option>
                            <option value="3">Complete</option>
                            <option value="4">Return</option>
                            <option value="5">Cancel</option>
                    </select>
                </div>
                <div class="form-group col-3">


                </div>
              </div>
              <div>
                <button type="button" class="btn btn-warning print" style="float:right;">Print</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm ytable">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>E-mail</th>
                    <th>Subtotal ({{ $setting->currency }})</th>
                    <th>Total ({{ $setting->currency }})</th>
                    <th> Method</th>
                    <th>Order No</th>
                    <th> Date</th>
                    <th>Status</th>
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script type="text/javascript">
$(function products(){
		 table=$('.ytable').DataTable({
	    "processing":true,
        "serverSide":true,
        "searching":true,
        "ajax":{
            "url": "{{ route('order.report.index') }}",
            "data":function(e) {
            e.status =$("#status").val();
            e.date =$("#date").val();
            e.payment_type =$("#payment_type").val();
            }
        },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'c_name'  ,name:'c_name'},
				{data:'c_phone',name:'c_phone'},
				{data:'c_email',name:'c_email'},
				{data:'subtotal',name:'subtotal'},
				{data:'total',name:'total'},
				{data:'payment_type',name:'payment_type'},
				{data:'order_id',name:'order_id'},
				{data:'date',name:'date'},
				{data:'status',name:'status'},

			]
		});
	});




//submitable Filtering
$(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
});
//submitable Filtering
$(document).on('blur','.submitable_input', function(){
    $('.ytable').DataTable().ajax.reload();
});


// For Print

$('.print').on('click', function (e) {
    e.preventDefault();
    $('.loader').removeClass('d-none');
    $.ajax({
        url:"{{ route('report.order.print') }}",
        type:'get',
        data: {status : $('#status').val(), date: $('#date').val() , payment_type: $('#payment_type').val()},
        success:function(data){
            $('.loader').addClass('d-none');
            $(data).printThis({
                debug: false,
                importCSS: true,
                importStyle: true,
                removeInline: false,
                printDelay: 500,
                header : null,
                footer : null,
            });
        }
    });
});

</script>
@endsection
