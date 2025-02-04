@extends('layouts.app')

@section('content')
    <div>
        <h1>Create New Character</h1>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('characters.store') }}">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>

            <label for="defence">Defence:</label>
            <input type="number" id="defence" name="defence" value="{{ old('defence') }}" required>

            <label for="strength">Strength:</label>
            <input type="number" id="strength" name="strength" value="{{ old('strength') }}" required>

            <label for="accuracy">Accuracy:</label>
            <input type="number" id="accuracy" name="accuracy" value="{{ old('accuracy') }}" required>

            <label for="magic">Magic Power:</label>
            <input type="number" id="magic" name="magic" value="{{ old('magic') }}" required>

            @if(auth()->user()->isAdmin())
                <label for="enemy">Enemy:</label>
                <input type="checkbox" id="enemy" name="enemy" {{ old('enemy') ? 'checked' : '' }}>
            @endif

            <button type="submit">Create Character</button>
        </form>
    </div>
@endsection
