@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection
@section('content')
    <div>
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
    </div>
    <br>

    <x-alert type='success' />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')"/>
        <select name="status" class="form-control mx-2" id="">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
            <option value="draft" @selected(request('status') == 'draft')>Draft</option>
        </select>
        <button class="btn btn-dark mx-2">Fillter</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Store</th>
                <th>Status</th>
                <th>Created At</th>
                <th colspan='2'></th>
            </tr>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td><img src="{{ $product->image }}" height="50px"
                        width="50px" alt="Product Image"></td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.products.edit', [$product->id]) }}" class="btn btn-sm-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.products.destroy', [$product->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submet" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan='9  '>No Products Defined.</td>
                </tr>
            @endforelse
        </tbody>
        </thead>
    </table>
    {{ $products->withQueryString()->appends(['search' => 1])->links() }}
@endsection
