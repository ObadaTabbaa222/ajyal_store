@if($errors->any())

<div class="alert alert-danger">
    <h3>Error Occured!</h3>
</div>

@endif
{{----------------Name Field----------------}}
<div class="form-group">
    <x-form.input  label='Product Name'  name='name' :value="$product->name"/>
</div>
{{----------------Category Field----------------}}
<div class="form-group">
    <label for="">Product Category</label>
    <select name="category_id" id=""  @class([
        'form-control',
        'form-select',
        'is-invalid' => $errors->has('parent_id')
    ])>
        <option value="">Primary Category</option>
        @foreach (App\Models\Category::all()  as $category)
            <option value="{{ $category->id }}" >{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
{{----------------Store Field----------------}}
<div class="form-group">
    <label for="">Product Store</label>
    <select name="store_id" id=""  @class([
        'form-control',
        'form-select',
        'is-invalid' => $errors->has('parent_id')
    ])>
        @foreach (App\Models\Store::all()  as $store)
            <option value="{{ $store->id }}" >{{ $store->name }}</option>
        @endforeach
    </select>
    @error('store_id')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
{{----------------Description Field----------------}}
<div class="form-group">
    <x-form.textarea lable="Description" name="description" :value="$product->description" />
</div>
{{----------------Image Field----------------}}
<div class="form-group">
    <x-form.input lable='Image' type="file" name="image" />
</div>
@if($product->image)
    <img src="{{ asset('storage/'.$product->image) }}" height=50px width=50px alt="">
@endif
{{----------------Price Field----------------}}
<div class="form-group">
    <x-form.input  label='Product Price'  name='price' :value="$product->price"/>
</div>
{{----------------Compare Price Field----------------}}
<div class="form-group">
    <x-form.input  label='Product Price'  name='compare_price' :value="$product->cmpare_price"/>
</div>
{{----------------Status Field----------------}}
<div class='form-group'>
    <x-form.radio name='status' :checked='$product->status' :options="[ 'active'=>'Active', 'archived'=>'Archived', 'draft'=>'Draft']" />
</div>
{{----------------Save/Update----------------}}
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'Save' }}</button>
</div>
