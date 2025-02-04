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
        <h1>{{ $character->name }}</h1>
        <p><strong>Defence:</strong> {{ $character->defence }}</p>
        <p><strong>Strength:</strong> {{ $character->strength }}</p>
        <p><strong>Accuracy:</strong> {{ $character->accuracy }}</p>
        <p><strong>Magic Power:</strong> {{ $character->magic }}</p>
        <h2>Mérkőzések</h2>
        @if ($character->contests->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Enemy</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($character->contests as $contest)
                        <tr>
                            <td><a href="">{{ $contest->location }}</a></td>
                            <td>{{ $contest->enemy }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Nincsenek mérkőzések.</p>
        @endif

        <div>
            <a href="{{ route('characters.edit', $character->id) }}">Edit</a>
            <form action="{{ route('characters.destroy', $character->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
            <a href="">Start New Contest</a>
        </div>

    </div>
@endsection
