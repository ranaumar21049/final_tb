@extends('layouts.app')

@section('content')
    <h1>Edit Category</h1>
    <form action="{{ route('platform-admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $category->name }}" required>
        <textarea name="description">{{ $category->description }}</textarea>
        <button type="submit">Update</button>
    </form>
@endsection
