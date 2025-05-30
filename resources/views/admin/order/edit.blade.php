<form action="{{ route('update.order.status') }}" method="Post" id="edit_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
        <label for="c_name">Customer Name </label>
        <input type="text" class="form-control"  name="c_name" value="{{ $order->c_name }}">
            <input type="hidden" name="id" value="{{$order->id}}">
        </div>
        <div class="form-group">
        <label for="c_email">Email </label>
            <input type="text" class="form-control"  name="c_email" value="{{ $order->c_email }}">
        </div>
        <div class="form-group">
        <label for="pickup_point_address"> Address </label>
        <input type="text" class="form-control"  name="c_address" value="{{$order->c_address}}">
        </div>
        <div class="form-group">
        <label for="pickup_point_phone"> Phone </label>
        <input type="text" class="form-control"  name="c_phone" value="{{ $order->c_phone }}">
        </div>
        <div class="form-group">
        <label for="pickup_point_phone_two">Order Status</label>
        <select class="form-control" name="status">
                <option value="0" @if($order->status==0) selected @endif>Pending</option>
                <option value="1" @if($order->status==1) selected @endif>Received</option>
                <option value="2" @if($order->status==2) selected @endif>Shipped</option>
                <option value="3" @if($order->status==3) selected @endif>Complete</option>
                <option value="4" @if($order->status==4) selected @endif>Return</option>
                <option value="5" @if($order->status==5) selected @endif>Cancel</option>
        </select>
        </div>

    <div class="modal-footer">
    <button type="Submit" class="btn btn-primary"> Update</button>
    </div>
</form>

<script type="text/javascript">
    $('#edit_form').submit(function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var request =$(this).serialize();
        $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){  
            toastr.success(data);
            $('#edit_form')[0].reset();
            $('#editModal').modal('hide');
            table.ajax.reload();
            }
        });
        });
</script>