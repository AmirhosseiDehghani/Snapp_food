<div>
    <label for="basic-{{$name}}" class="form-label">{{$label}}</label>
    <div class="input-group mb-3">
        <input type="text" name={{$name}} value="{{$value??''}}" class="form-control" id="basic-name" aria-describedby="basic-addon3">
    </div>
    <div id="basic-name" class="form-text">
        @error($name)
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </div>
    </div> 
</div>