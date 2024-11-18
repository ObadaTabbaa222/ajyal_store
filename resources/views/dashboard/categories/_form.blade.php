@if($errors->any())

<div class="alert alert-danger">
    <h3>Error Occured!</h3>
</div>

@endif
{{----------------Name Field----------------}}
<div class="form-group">
    <x-form.input  label='Category Name'  name='name' :value="$cat->name"/>
</div>
{{----------------Parent Field----------------}}
<div class="form-group">
    <label for="">Category Parent</label>
    <select name="parent_id" id=""  @class([
        'form-control',
        'form-select',
        'is-invalid' => $errors->has('parent_id')
    ])>
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id',$cat->parent_id) == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
    @error('parent_id')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
{{----------------Description Field----------------}}
<div class="form-group">
    <x-form.textarea lable="Description" name="description" :value="$cat->description" />
</div>
{{----------------Image Field----------------}}
<div class="form-group">
    <x-form.input lable='Image' type="file" name="image" />
</div>
@if($cat->image)
    <img src="{{ asset('storage/'.$cat->image) }}" height=50px width=50px alt="">
@endif
{{----------------Status Field----------------}}
<div class='form-group'>
    <x-form.radio name='status' :checked='$cat->status' :options="[ 'active'=>'Active', 'archived'=>'Archived']" />
</div>
{{----------------Save/Update----------------}}
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'Save' }}</button>
</div>
