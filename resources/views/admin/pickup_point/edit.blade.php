<form action="{{ route('pickup.update') }}" method="Post" id="edit_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
        <label for="pickup_point_name">Pickup Point Name </label>
        <input type="text" class="form-control"  name="pickup_point_name" value="{{ $data->pickup_point_name }}">
            <input type="hidden" name="id" value="{{$data->id}}">
        </div>
        <div class="form-group">
        <label for="pickup_point_address">Pickup Point Address </label>
        <input type="text" class="form-control"  name="pickup_point_address" value="{{$data->pickup_point_address}}">
        </div>
        <div class="form-group">
        <label for="pickup_point_phone">Pickup Point Phone 1 </label>
        <input type="text" class="form-control"  name="pickup_point_phone" value="{{ $data->pickup_point_phone }}">
        </div>
        <div class="form-group">
        <label for="pickup_point_phone_two">Pickup Point Phone 2 </label>
        <input type="text" class="form-control"  name="pickup_point_phone_two" value="{{ $data->pickup_point_phone_two }}">
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