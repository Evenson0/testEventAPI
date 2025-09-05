<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventWebController extends Controller
{
    public function index()
    {
        $events = Event::withCount('comments')->orderByDesc('date')->paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }
}
