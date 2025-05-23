@extends('layouts.admin')

@section('admin_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Ticket List </h1>
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
                <h3 class="card-title">All Ticket List Here</h3>
              </div><br>
              <div class="row p-2">
                <div class="form-group col-3">
                    <label>Ticket Type</label>
                    <select class="form-control submitable" name="type" id="type">
                        <option value="">All</option>
                        <option value="Technical">Technical</option>
                        <option value="Payment">Payment</option>
                        <option value="Affiliate">Affiliate</option>
                        <option value="Return">Return</option>
                        <option value="Refund">Refund</option>
                    </select>
                </div>
                <div class="form-group col-3">
                     <label>Status</label>
                    <select class="form-control submitable" name="status"  id="status">
                        <option value="0">Status</option>
                            <option value="0">Pending</option>
                            <option value="1">Replied</option>
                            <option value="2">Closed</option>
                    </select>
                </div>
                <div class="form-group col-3">
                     <label>Date</label>
                   <input type="date" id="date" class="form-control submitable_input">
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm ytable">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Service</th>
                    <th>Priority</th>
                    <th>Date</th>
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
$(function products(){
		 table=$('.ytable').DataTable({
	    "processing":true,
        "serverSide":true,
        "searching":true,
        "ajax":{
            "url": "{{ route('ticket.index') }}", 
            "data":function(e) {
            e.type =$("#type").val();
            e.status =$("#status").val();
            e.date =$("#date").val();
            }
        },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'name',name:'name'},
				{data:'subject',name:'subject'},
				{data:'service',name:'service'},
				{data:'priority',name:'priority'},
				{data:'date',name:'date'},
				{data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});



    //submitable Filtering
    $(document).on('change','.submitable', function(){
        $('.ytable').DataTable().ajax.reload();
    });

    $(document).on('change','.submitable_input', function(){
        $('.ytable').DataTable().ajax.reload();
    });

</script>
@endsection
