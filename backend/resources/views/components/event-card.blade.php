@props(['event'])
<div class="event-card">
    <h3>{{ $event->title }}</h3>
    <p>{{ $event->date->format('d/m/Y H:i') }}</p>
    @if ($event->description)
        <p>{{ $event->description }}</p>
    @endif
    <p>Commentaires : {{ $event->comments_count ?? $event->commentsCount }}</p>
</div>
