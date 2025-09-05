<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of events with pagination, search and caching.
     */
    public function index(Request $request)
    {
        $query = Event::query()->withCount('comments');

        // Apply search filter
        if ($search = $request->query('q')) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Use a cache key based on the full URL (including query string)
        $cacheKey = 'events:' . md5($request->fullUrl());

        $events = Cache::remember($cacheKey, 60, function () use ($query) {
            return $query->orderByDesc('date')->paginate(10);
        });

        return EventResource::collection($events);
    }

    /**
     * Display the specified event with its comments count.
     */
    public function show(Event $event)
    {
        $event->loadCount('comments')->load('comments');
        return new EventResource($event);
    }

    /**
     * Store a newly created event.
     */
    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->validated() + ['user_id' => $request->user()->id]);
        return new EventResource($event);
    }

    /**
     * Handle banner upload for a given event.
     */
    public function uploadBanner(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $request->validate([
            'banner' => ['required', 'file', 'mimes:jpg,png,webp', 'max:2048'],
        ]);

        $path = $request->file('banner')->store('events');
        $event->update(['banner_path' => $path]);

        return response()->json([
            'url' => Storage::url($path),
        ]);
    }
}
