@extends('layouts.dashboard')

@section('title', $category->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection
@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td><img src="{{ asset('storage/'.$product->image) }}" height="50px"
                    width="50px" alt=""></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->store->name }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->created_at }}</td>
            </tr>
        @empty
            <tr>
                <td colspan='5'>No Products Defined.</td>
            </tr>
        @endforelse
    </tbody>
    </thead>
</table>
{{ $products->links() }}
@endsection
