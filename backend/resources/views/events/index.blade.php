@extends('layouts.app')

@section('title', 'Liste des événements')

@section('content')
    <h2>Événements</h2>
    @can('create', App\Models\Event::class)
        <a href="{{ route('events.create') }}">Créer un événement</a>
    @endcan
    <div class="event-list">
        @forelse ($events as $event)
            <x-event-card :event="$event" />
        @empty
            <p>Aucun événement trouvé.</p>
        @endforelse
    </div>
    {{ $events->links() }}
@endsection
