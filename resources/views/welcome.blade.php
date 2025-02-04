@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <h1>Welcome to Our Application!</h1>
        <p>Thank you for joining us. Our application allows you to create and manage characters for interactive
            storytelling.</p>

        <h2>Main Features:</h2>
        <ol>
            <li><strong>Character Management:</strong> Create new characters, view, edit, or delete them from your own
                character dashboard.</li>
            <li><strong>Interactive Stories:</strong> Use characters to create interactive stories and follow how events
                unfold based on character actions.</li>
            <li><strong>Administrator Privileges:</strong> If you have administrator privileges, you'll have access to all
                characters and their management.</li>
        </ol>

        <h2>Help and Support:</h2>
        <p>If you have any questions or encounter any issues with the application, don't hesitate to contact us. Our support
            team is ready to assist you in any way.</p>

        <p>Thank you for being with us, and we wish you an enjoyable time creating!</p>
    </div>

    <h2>Statistics</h2>
    <ul>
        <li>Total characters created: {{ $totalCharacters }}</li>
        <li>Total contests held: {{ $totalContests }}</li>
    </ul>
    </div>
@endsection
