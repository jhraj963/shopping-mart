<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

<form action="{{ route('campaign.update') }}" method="POST" enctype="multipart/form-data" id="add-form">
        @csrf

    <div class="form-group">
        <label for="category_name">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}" >
    </div>
        <input type="hidden" name="id" value="{{$data->id}}">
    <div class="form-group">
        <label for="start_date">Start Date <span class="text-danger">*</span></label>
        <input type="date" class="form-control" id="start_date" value="{{$data->start_date}}" name="start_date" >
    </div>
    <div class="form-group">
        <label for="end_date">End Date <span class="text-danger">*</span></label>
        <input type="date" class="form-control" id="end_date" value="{{$data->end_date}}" name="end_date" >
    </div>
    <div class="form-group">
        <label for="discount">Discount (%) <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="discount" value="{{$data->discount}}" name="discount" >
    </div>
    <div class="form-group">
        <label for="discount">status <span class="text-danger">*</span></label>
        <select class="form-control" name="status">
            <option value="1" @if($data->status==1) selected="" @endif>Active</option>
            <option value="0" @if($data->status==0) selected="" @endif>Inactive</option>
        </select>
    </div>
    <div class="form-group">
        <label for="category_name">Campaign Image</label>
        <input type="file" class="form-control dropify" id="image" name="image">
        <input type="hidden" name="old_image" value="{{ $data->image }}">
        <small id="category_name" class="form-text text-muted">This is Your Brand Logo</small>
    </div>
    <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><span class="d-none">Loading...</span> Update</button>
    </div>
</form>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
<script type="text/javascript">
	$('.dropify').dropify();

</script>
