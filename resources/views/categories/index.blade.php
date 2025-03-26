@extends('layouts.app')

@section('content')
    <h1>Categories</h1>
    <a href="{{ route('platform-admin.categories.create') }}">Create New Category</a>
    <ul>
        @foreach ($categories as $category)
            <li>
                {{ $category->name }} - <a href="{{ route('platform-admin.categories.edit', $category) }}">Edit</a>
                <form action="{{ route('platform-admin.categories.destroy', $category) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
