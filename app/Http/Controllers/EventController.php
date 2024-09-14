<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request){

        $userId = Auth::id();
        $events = Event::with('user')->get();
    
        $visibleEvents = $events->filter(function ($event) use ($userId) {
            return in_array($event->Status, ['Approved', 'OnGoing']) ||
                   ($userId == $event->UserID && in_array($event->Status, ['Pending', 'Rejected']));
        });
    
        $hasVisibleEvents = $events->contains(function ($event) {
            return in_array($event->Status, ['Approved', 'OnGoing']);
        });
    
        return view('events', [
            'events' => $visibleEvents,
            'userId' => $userId,
            'hasVisibleEvents' => $hasVisibleEvents,
        ]);
    }

    public function showBuyerEvents() {
        $events = Event::all();
        
        return view('Event.BuyerEvents', compact('events'));
    }

    

    public function update(Request $request, $id)
    {
        try{
        $event = Event::find($id);

        $request->validate([
            'EventImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);

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

        $originalImageName = $event->OriginalEventImageName;

        if ($request->hasFile('EventImage')) {
            $file = $request->file('EventImage');
            $imagePath = $file->store('public/Event');
            $originalImageName = $file->getClientOriginalName();
            $imagePath = str_replace('public/', '', $imagePath);
            $event->update(['EventImage' => $imagePath]);

            $event->update([
                'EventImage' => $imagePath,
                'OriginalEventImageName' => $originalImageName,
            ]);
        }

            return back()->with('message', 'Event Updated Successfully')->with('type', 'success');
        
        } catch (\Exception $e) {
            return back()->with('message', 'An error occurred while updating the event')->with('type', 'error');
        }    
    }

    public function destroy(Event $event)
    {
        try{
        $event->delete();

        return back()->with('message', 'Event deleted successfully!')->with('type', 'success');

        } catch (\Exception $e) {
            return back()->with('message', 'An error occurred while deleting the event')->with('type', 'error');
        }
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
        try{
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        // Check if the user is a seller (user_type = 2)
        if ($user->usertypeID != 2) {
            return back()->withErrors(['error' => 'You are not authorized to create events.']);
        }

        if ($request->hasFile('EventImage')) {
            $file = $request->file('EventImage',);
            $originalImageName = $file->getClientOriginalName();
            $imagePath = $file->storeAs('EventImage', $originalImageName, 'public');
        } 

        // Assign the user's ID to the event being created
        $createEvent = Event::create([
            'UserID' => $user->id, // Assuming your column name is 'UserID' in the Event table
            'EventImage' => $imagePath,
            'OriginalEventImageName' => $originalImageName, // Save original image name
            'EventName' => $request->input('EventName'),
            'EventDescription' => $request->input('EventDescription'),
            'Date' => $request->input('Date'),
            'StartTime' => $request->input('StartTime'),
            'EndTime' => $request->input('EndTime'),
            'Location' => $request->input('Location'),
            'Link' => $request->input('Link'),
        ]);

         return back()->with('message', 'Event created successfully!')->with('type', 'success');

        } catch (\Exception $e) {
            return back()->with('message', 'Error creating the event, your file might not be supported')->with('type', 'error');
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
        dd($events); // Check the output

        return view('profile.profile-seller', compact('events')); 
    }


public function store(Request $request)
{
    $validatedData = $request->validate([
        'EventImage' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        'EventName' => 'required|string|max:255',
        'EventDescription' => 'required|string|max:500',
        'Date' => 'required|date|after_or_equal:today',
        'StartTime' => 'required|date_format:H:i',
        'EndTime' => 'required|date_format:H:i|after:StartTime',
        'Location' => 'required|string|max:255',
        'Link' => 'required|url',
    ]);

    // Handle file upload
    if ($request->hasFile('EventImage')) {
        $imagePath = $request->file('EventImage')->store('event_images', 'public');
    } else {
        $imagePath = null;
    }

    // Create event
    Event::create([
        'image_path' => $imagePath,
        'name' => $request->EventName,
        'description' => $request->EventDescription,
        'date' => $request->Date,
        'start_time' => $request->StartTime,
        'end_time' => $request->EndTime,
        'location' => $request->Location,
        'registration_link' => $request->Link,
    ]);

    return redirect()->route('profile.profile-seller')->with('success', 'Event created successfully!');
}

}
