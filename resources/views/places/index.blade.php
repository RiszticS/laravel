@extends('layouts.app')

@section('content')
    <div>
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <h1>Places</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($places as $place)
                    <tr>
                        <td>{{ $place->name }}</td>
                        <td><img src="{{ $place->image }}" alt="Place Image" style="max-width: 100px;"></td>
                        <td>
                            <a href="{{ route('places.edit', $place->id) }}">Edit</a>
                            <form action="{{ route('places.destroy', $place->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('places.create') }}">Crate a new place</a>
    </div>
@endsection
