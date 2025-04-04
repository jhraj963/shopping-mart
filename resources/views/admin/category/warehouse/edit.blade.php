<div class="card">
    <div class="modal-body">
        <form action="{{ route('warehouse.update') }}" method="POST" id="add-form">
            @csrf
        
        <div class="form-group">
            <label for="warehouse_name">Warehouse Name</label>
            <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" value="{{ $data->warehouse_name }}" required>
        </div>
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="form-group">
            <label for="warehouse_address">Warehouse Address</label>
            <input type="text" class="form-control" id="warehouse_address" name="warehouse_address" value="{{ $data->warehouse_address }}" required>
        </div>
        <div class="form-group">
            <label for="warehouse_phone">Warehouse Phone</label>
            <input type="text" class="form-control" id="warehouse_phone" name="warehouse_phone" value="{{ $data->warehouse_phone }}" required>
        </div>
        <div class="modal-footer">
            <button type="Submit" class="btn btn-primary"> <span class="d-none loader"><i class="fas fa-spinner"></i> Loading..</span> <span class="submit_btn"> Update </span> </button>
            </div>
        </form>
    </div>
</div>