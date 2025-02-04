@extends('layouts.app')

@section('content')
    <div>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('places.update', $place->id) }}">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Név:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $place->name) }}" required>
            </div>
            <div>
                <label for="image">Kép feltöltése:</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <button type="submit">Helyszín módosítása</button>
        </form>
    </div>
@endsection
