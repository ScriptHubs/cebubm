<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function storeEvent(Request $request)
    {
        $data = $request->only('name', 'description', 'date_from', 'date_to');

        // Save the poster image if provided
        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');
            $path = $poster->store('posters', 'public'); // Store the image in the 'public/storage/posters' directory
            $data['poster'] = $path;
        }

        Events::create($data);
    }

    public function showEventAbout()
    {
        // Get the last event record from the database
        $event = Events::where('active', true)
            ->orderBy('event_date_from', 'desc')
            ->first();

        return view('landing.about', compact('event'));
    }

    public function showEventEvents()
    {
        // Get the last event record from the database
        $event = Events::where('active', true)
            ->orderBy('event_date_from', 'desc')
            ->first();

        return view('landing.events', compact('event'));
    }

    public function showEventIndex()
    {
        // Get the last event record from the database
        $event = Events::where('active', true)
            ->orderBy('event_date_from', 'desc')
            ->first();

        return view('landing.index', compact('event'));
    }
}
