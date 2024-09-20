<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class GalleryController extends Controller
{
    public function index()
    {
        $now = now(); // Current date and time
        $events = Event::where('Status', 'approved')
                        ->where(function($query) use ($now) {
                            $query->where('Date', '<', $now->format('Y-m-d'))
                                ->orWhere(function($query) use ($now) {
                                    $query->where('Date', '=', $now->format('Y-m-d'))
                                            ->where('EndTime', '<=', $now->format('H:i:s'));
                                });
                        })
                        ->get();
        $currentUserId = auth()->id();
        return view('event.galleryseller', compact('events', 'currentUserId'));
    }
    

    public function indexGallery()
    {
        $events = Event::where('Status', 'Approved')->get();
        return view('event.gallerybuyer', compact('events'));
    }

    public function store(Request $request)
    {
        try{
        $request->validate([
            'gallery' => 'required|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'EventID' => 'required|exists:events,EventID'

        ]);
        

        $userId = auth()->id();

        $eventId = $request->input('EventID');

        // Maximum of 12 images per event
        $existingImageCount = Gallery::where('EventID', $eventId)->count();

        $newImagesCount = count($request->file('gallery'));
        if ($existingImageCount + $newImagesCount > 12) {
            return back()->with('message', 'You can only upload a maximum of 12 images per event.')->with('type', 'error');
        }

        foreach ($request->file('gallery') as $image) {
            $originalName = $image->getClientOriginalName();
            $path = $image->storeAs('Eventgallery', $originalName, 'public'); 

        // $event = Event::findOrFail($request->input('EventID')); // Find the event by EventID


            Gallery::create([
                'EventID' => $eventId,
                'path' => $path,
                'UserID' => auth()->id(),

            ]); 
        }

        return back()->with('message', 'Images uploaded successfully.')->with('type', 'success');
    } catch (\Exception $e) {
        return back()->with('message', 'An error occurred while uploading.')->with('type', 'error');
    }
    }
    

    public function destroy($idgallery)
    {
        try {
            $gallery = Gallery::findOrFail($idgallery);
            
            $gallery->delete();
    
            return back()->with('message', 'Image deleted successfully!')->with('type', 'success');
        } catch (\Exception $e) {
            return back()->with('message', 'An error occurred while deleting the image')->with('type', 'error');
        }
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
        $events = Event::all();
        
        return view('event.viewgallery', compact('event', 'images'));
    }



    public function showEventImagesBuyer($eventId)
    {
        // Fetch the event using the correct column name
        $event = Event::where('EventID', $eventId)->first();
        
        if (!$event) {
            // Handle the case where the event is not found
            abort(404, 'Event not found');
        }
        
        $images = Gallery::where('EventID', $eventId)->get();
        $events = Event::all();
        
        return view('event.viewgallerybuyer', compact('event', 'images'));
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

        return view('event.viewgallery', compact('event', 'images'));
    }

    public function view()
    {
        $events = Event::all();
        return view('event.viewgallery', compact('events'));
    }
    
    
    
    
}

