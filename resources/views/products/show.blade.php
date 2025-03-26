@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Price:</strong> ${{ $product->price }}</p>
    <p><strong>Category:</strong> {{ $product->category->name }}</p>
    <p><strong>Brand:</strong> {{ $product->brand->name }}</p>
    <a href="{{ route('products.index') }}">Back to Products</a>
@endsection
