<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

<form action="{{ route('brand.update') }}" method="POST" enctype="multipart/form-data" id="add-form">
        @csrf

    <div class="form-group">
        <label for="category_name">Brand Name</label>
        <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{ $data->brand_name }}" required>
        <small id="category_name" class="form-text text-muted">This is Your Brand Name</small>
    </div>
        <input type="hidden" name="id" value="{{$data->id}}">
    <div class="form-group">
        <label for="category_name">Brand Logo</label>
        <input type="file" class="form-control dropify" id="brand_logo" name="brand_logo">
        <input type="hidden" name="old_logo" value="{{ $data->brand_logo }}">
        <small id="category_name" class="form-text text-muted">This is Your Brand Logo</small>
    </div>
      <div class="form-group">
                <label for="category_name">Show on Home Page</label>
                <select class="form-control" name="front_page">
                    <option value="1" @if($data->front_page==1) selected="" @endif>YES</option>
                    <option value="0" @if($data->front_page==0) selected="" @endif>NO</option>
                </select>
                <small id="category_name" class="form-text text-muted">If YES, it will show on Your Home Page </small>
            </div>
    <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><span class="d-none">Loading...</span> Update</button>
    </div>
</form>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
<script type="text/javascript">
	$('.dropify').dropify();

</script>
