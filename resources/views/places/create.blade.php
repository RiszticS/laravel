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
        <form action="{{ route('places.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name">Név:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="image">Kép feltöltése:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit">Helyszín létrehozása</button>
        </form>
    </div>
@endsection
