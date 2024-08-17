<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $currentUserId = auth()->id();
        return view('gallery', compact('events', 'currentUserId'));
    }

    public function indexGallery()
    {
        $events = Event::all();
        return view('galleryBuyer', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gallery' => 'required|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'EventID' => 'required|exists:events,id' // Validate that EventID exists in the events table

        ]);

        $userId = auth()->id();

        $eventId = $request->input('EventID');

        foreach ($request->file('gallery') as $image) {
            $originalName = $image->getClientOriginalName();
            $path = $image->storeAs('Eventgallery', $originalName, 'public'); 

        // $event = Event::findOrFail($request->input('EventID')); // Find the event by EventID


            Gallery::create([
                // 'EventID' => $request->input('EventID'), 
                // 'path' => $path,
                // // 'UserID' => $event->UserID,
                // 'UserID' => auth()->id(),
                'EventID' => $eventId,
                'path' => $path,
                'UserID' => auth()->id(),

            ]); 
        }

        return redirect()->back()->with('success', 'Images uploaded successfully.');
    }

    public function showEventImages($eventId)
    {
        // Fetch the event using the correct column name
        $event = Event::where('EventID', $eventId)->first();
        
        if (!$event) {
            // Handle the case where the event is not found
            abort(404, 'Event not found');
        }
        
        $images = Gallery::where('EventID', $eventId)->get();
        
        return view('view', compact('event', 'images'));
    }


    public function getEventImages($eventId)
    {
        $images = Gallery::where('EventID', $eventId)->get(['path']);
        return response()->json(['images' => $images]);
    }

    public function showImages($eventId)
    {
        $event = Event::findOrFail($eventId);
        $images = Gallery::where('EventID', $eventId)->get();
        dd($event);

        return view('view', compact('event', 'images'));
    }

    public function view()
    {
        $events = Event::all();
        return view('view', compact('events'));
    }
}
