<form action="{{ route('childcategory.update') }}" method="POST" id="add-form">
    @csrf
    <div class="form-group">
        <label for="category_name">Category / Sub Category  Name</label>
        <select class="form-control" name="subcategory_id" required>
            @foreach ($category as $row)
                @php
                    $subcategory=DB::table('subcategories')->where('category_id',$row->id)->get();
                @endphp
            <option disabled="" style="color:rgb(140, 234, 24)">{{ $row->category_name }}</option>
                @foreach ($subcategory as $row)
                        <option value="{{$row->id}}" @if($row->id==$data->subcategory_id) selected @endif>👉{{$row->subcategory_name }}</option>
                @endforeach
            @endforeach
        </select>
    </div>
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="form-group">
        <label for="category_name">Child Category Name</label>
        <input type="text" class="form-control" id="childcategory_name" name="childcategory_name" required value="{{ $data->childcategory_name }}">
        <small id="category_name" class="form-text text-muted">This is Your Child Category</small>
    </div>
    <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><span class="d-none">Loading...</span> Update</button>
    </div>
</form>
