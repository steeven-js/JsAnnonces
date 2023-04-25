@extends('layout/dashboard')

@section('main')
    <form method="POST" action="{{ route('admin.category.update', $category->id) }}">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $category->name }}" required>

        <button type="submit">Save</button>
    </form>
@endsection
