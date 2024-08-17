<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index(Request $request){

        // $events = Event::all();
        $events = Event::with('user')->get(); 
        $userId = Auth::id(); 

        return view ('events', compact('events')); //balikan ko mamaya sa compact
    }

    public function showBuyerEvents() {
        $events = Event::all();
        return view('Event.BuyerEvents', compact('events'));
    }

    

    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        // $validator = Validator::make($request->all(), [
        //     'EventName' => 'required|string|max:255',
        //     'EventDescription' => 'required|string',
        //     'Date' => 'required|date',
        //     'StartTime' => 'required|date_format:H:i',
        //     'EndTime' => 'required|date_format:H:i',
        //     'Location' => 'required|string|max:255',
        //     'Link' => 'nullable|url',
        //     'EventImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // Update event details
        $event->update([
            'EventName' => $request->input('EName'),
            'EventDescription' => $request->input('EDescription'),
            'Date' => $request->input('EDate'),
            'StartTime' => $request->input('EStartTime'),
            'EndTime' => $request->input('EEndTime'),
            'Location' => $request->input('ELocation'),
            'Link' => $request->input('ELink'),
        ]);

        if ($request->hasFile('EventImage')) {
            $imagePath = $request->file('EventImage')->store('public/images');
            $imagePath = str_replace('public/', '', $imagePath);
            $event->update(['EventImage' => $imagePath]);
        }

        return redirect()->back()->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->back()->with('success', 'Event deleted successfully.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data,[
            'EventImage' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'EventName' => ['required', 'string', 'max:255'],
            'EventDescription' => ['required', 'string'],
            'Date' => ['required', 'date'],
            'StartTime' => ['required', 'date_format:H:i'],
            'EndTime' => ['required', 'date_format:H:i', ],
            'Location' => ['required', 'string', 'max:255'],
            'Link' => ['nullable', 'url'],
        ]);
    }

    
    public function showVisitorEvents() {
        $events = Event::all();
        return view('VisitorEvents', compact('events'));
    }
    

    public function showEvents() {
        $events = Event::all();
        return view('VisitorEvents', compact('events'));
    }

    protected function create(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();

        // Check if the user is a seller (user_type = 2)
        if ($user->usertypeID != 2) {
            return back()->withErrors(['error' => 'You are not authorized to create events.']);
        }

        if ($request->hasFile('EventImage')) {
            $imagePath = $request->file('EventImage')->store('public/images');
            $imagePath = str_replace('public/', '', $imagePath); // Remove 'public/' from the path
        } else {
            $imagePath = null;
        }

        // Assign the user's ID to the event being created
        $createEvent = Event::create([
            'UserID' => $user->id, // Assuming your column name is 'UserID' in the Event table
            'EventImage' => $imagePath,
            'EventName' => $request->input('EventName'),
            'EventDescription' => $request->input('EventDescription'),
            'Date' => $request->input('Date'),
            'StartTime' => $request->input('StartTime'),
            'EndTime' => $request->input('EndTime'),
            'Location' => $request->input('Location'),
            'Link' => $request->input('Link'),
        ]);

        if ($createEvent) {
            // Redirect back to the previous page
            return redirect()->back()->with('success', 'Event created successfully.');
        } else {
            return back()->withInput()->withErrors(['error' => 'Failed to create event']);
        }
    }

    public function updateEventStatus()
        {
            $events = Event::all();

            foreach ($events as $event) {
                $eventEndDate = Carbon::parse($event->Date . ' ' . $event->EndTime); // Combine date and end time
                $now = Carbon::now();

                if ($now->gt($eventEndDate)) {
                    $event->Status = 'Ended';
                    $event->save();
                }
            }
        }
    
    public function showGallery()
    {
        $events = Event::all();

        return view('event.galleryseller', compact('events'));
    }

    public function endedEvents()
    {
        // Retrieve only ended events
        $endedEvents = Event::where('Status', 'Ended')->get();
        
        // Return the view for ended events
        return view('event.ended', compact('endedEvents'));
    }
    public function showEndedEvents()
    {
        $now = Carbon::now();
        $endedEvents = Event::where('Date', '<', $now->toDateString())
            ->orWhere(function ($query) use ($now) {
                $query->where('Date', $now->toDateString())
                    ->where('EndTime', '<', $now->toTimeString());
            })
            ->get();

        return view('event.ended', ['endedEvents' => $endedEvents]);
    }

    // Display the events created by the User
    //para sa profile ng seller ito
    public function showSellerEvents() {
        $userId = Auth::id(); 
        $events = Event::where('UserID', $userId)->get(); 

        return view('profile.profile-seller', compact('events')); 
    }
}
