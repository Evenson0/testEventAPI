@extends('layouts.app')

@section('title', 'Créer un événement')

@section('content')
    <h2>Créer un événement</h2>
    <form method="POST" action="{{ route('events.store') }}">
        @csrf
        <div>
            <label for="title">Titre</label>
            <input id="title" type="text" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="date">Date et heure</label>
            <input id="date" type="datetime-local" name="date" value="{{ old('date') }}" required>
            @error('date')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Créer</button>
    </form>
@endsection
