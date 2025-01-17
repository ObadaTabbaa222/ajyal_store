@extends('layouts.dashboard')

@section('title', 'Product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection
@section('content')

<form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @include('dashboard.products._form')
</form>

@endsection
