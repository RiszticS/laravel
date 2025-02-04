@extends('layouts.app')

@section('content')
    <h1>Characters</h1>
    @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Defense</th>
                <th>Strength</th>
                <th>Accuracy</th>
                <th>Magic Power</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($characters as $character)
                <tr>
                    <td>{{ $character->name }}</td>
                    <td>{{ $character->defence }}</td>
                    <td>{{ $character->strength }}</td>
                    <td>{{ $character->accuracy }}</td>
                    <td>{{ $character->magic}}</td>
                    <td>
                        <a href="{{ route('characters.show', ['id' => $character->id]) }}">Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('characters.create') }}">Create a new character</a>
@endsection
