<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

<form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data" id="add-form">
        @csrf
    <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $data->category_name }}">
        <small id="category_name" class="form-text text-muted">This is Your Category</small>
    </div>
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="form-group">
        <label for="icon">Category Icon</label>
        <input type="file" class="dropify" id="icon" name="icon" >
        <input type="hidden" name="old_icon" value="{{ $data->icon }}">
    </div>
    <div class="form-group">
        <label for="home_page">Show On Hompage</label>
        <select class="form-control" name="home_page">
            <option value="1" @if($data->home_page==1) selected @endif>YES</option>
            <option value="0" @if($data->home_page==0) selected @endif>NO</option>
        </select>
        <small id="home_page" class="form-text text-muted">If YES, is will show on Hompage </small>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
<script type="text/javascript">
	$('.dropify').dropify();

</script>
