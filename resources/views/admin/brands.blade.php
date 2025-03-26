@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pending Brand Applications</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Brand Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>License</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->email }}</td>
                    <td>{{ $brand->phone }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $brand->license) }}" target="_blank">View License</a>
                    </td>
                    <td>
                        <form action="{{ route('platform-admin.brands.approve', $brand->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('platform-admin.brands.reject', $brand->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
