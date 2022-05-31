<div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label">Nama Ukuran<span style="color: red;">*</span></label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="name" value="{{ $data->name }}" id="name" required>
    </div>
    <div class="col-sm-3">
        <button class="btn btn-primary" onClick="update({{ $data->id }})">Update</button>
    </div>
</div>  