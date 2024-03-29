<?php

namespace App\Http\Controllers;

use App\Models\EventForm;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use App\Models\User;

class EventFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): view
    {
        $events = auth()->user()->eventforms()->latest()->get(['id', 'event_title', 'description', 'start_date', 'google_calendar_id', 'user_id']);
        //dd($events);
        
        return view('myevents', compact('events'));

    // Use eloquent's 'with' method to 'eager-load' every event associated with the user.
    // Use the 'latest' scope to return the records in reverse-chronological order.
    }
    // ABOVE: use Eloquent's with() method to 'eager-load' every event associated user.
    // use the latest() scope to return the records in reverse-chrono order

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * "success" method
     */
    public function success()
    {
        return view('success');
    }

    /**
     * "Create a link" method
     */
    function createLink($url, $text) {
        return '<a href="' . e($url) . '" target="_blank">' . e($text) . '</a>';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'event_title' => 'required|max:200', // Event title is required and maximum of 200 characters.
            'start_date' => 'required|date', // Start date is required and must be a valid date.
            'start_time' => 'required|date_format:H:i', // Start time is required and in HH:mm format.
            'end_date' => 'required|date', // End date is required and must be valid date.
            'end_time' => 'required|date_format:H:i', // End time is required and in HH:mm format.
            'description' => 'required|max:1000', // Description is required and maximum of 1000 characters.
            'location' => 'required|max:200', // Location is required and a maximum of 200 characters.
        ]);
    
        // Store the validated data in the database
        $request->user()->eventforms()->create($validated);
        // user() is from Laravel's built-in authentication system; user must be logged in
        // ->eventforms() has a relationship of "BelongsTo" with the user model
        // ->create($validated) creates a new event form record in the database of authenticated user.

        // Fetch the user's info from the authenticated user
        $user = $request->user();
        $businessName = $user->business_name;
        $publicName = $user->public_name;
        $phoneNumber = $user->phone;
        $contactEmail = $user->contact_email;
        $insta = $user->instagram;
        $twi = $user->twitter;
        $homePage = $user->homepage;
        $selectedcolor = $user->colors;

        // Retrieve the values of link-text and link-url from the request
        $linkText = $request->input('link-text');
        $linkUrl = $request->input('link-url');

        // Add user's info to this list if it exists
        $additionalDescriptionItems = [];
            if ($request->input('location')) {
                $additionalDescriptionItems[] = e($request->input('location'));
            }  
            if ($businessName) {
                $additionalDescriptionItems[] = e($businessName);
            }
            if ($publicName) {
                $additionalDescriptionItems[] = e($publicName);
            }
            if ($phoneNumber) {
                $additionalDescriptionItems[] = e($phoneNumber);
            }
            if ($twi) {
                $additionalDescriptionItems[] = $this->createLink('https://twitter.com/' . $twi, $twi . ' on Twitter');
            }
            if ($insta) {
                $additionalDescriptionItems[] = $this->createLink('https://instagram.com/' . $insta, $insta . ' on Instagram');
            }
            if ($homePage) {
                $additionalDescriptionItems[] = $this->createLink($homePage, __('Homepage'));
            }
            if ($linkText && $linkUrl) {
                $additionalDescriptionItems[] = $this->createLink($linkUrl, __($linkText)); 
            }
            
        // Format this list to be added onto the input('description')
        $additionalDescription = "\n" . implode("\n", $additionalDescriptionItems);

        // Parse date and time input (with Carbon library) from the request and adjust the timezone to Asia/Tokyo
        $startDate = Carbon::parse($request->input('start_date'))->setTimezone('Asia/Tokyo');
        $startTime = Carbon::parse($request->input('start_time'));
        $endDate = Carbon::parse($request->input('end_date'))->setTimezone('Asia/Tokyo');
        $endTime = Carbon::parse($request->input('end_time'));
        
        // Combine date and time components into datetime objects
        $startDateTime = $startDate->copy()->setTime($startTime->hour, $startTime->minute, $startTime->second);
        $endDateTime = $endDate->copy()->setTime($endTime->hour, $endTime->minute, $endTime->second);
        
        /* Static-Based Approach
        Event::create([
            'name' => $request->input('event_title'), 
            'startDateTime' => $startDateTime,
            'endDateTime' => $endDateTime,
            'description' => $request->input('description') . $additionalDescription,
            'colorId' => $selectedcolor,
            'visibility' => 'default',
            'status' => 'confirmed',
        ]); 
        */

        // Instance-Based Approach
        $event = new Event;
        $event->name = $request->input('event_title');
        $event->startDateTime = $startDateTime;
        $event->endDateTime = $endDateTime;
        $event->description = $request->input('description') . $additionalDescription;
        $event->setColorId($selectedcolor);
        
        $newEvent = $event->save();

        // Retrieve Google Calendar event ID
        $googleEventId = $newEvent->id;

        // Retrieve the newly created (latest) EventForm instance
        $eventForm = $request->user()->eventforms()->latest()->first();

        // Assign the Google Calendar ID to the EventForm instance
        $eventForm->google_calendar_id = $googleEventId;
        $eventForm->save();

        // Redirect to a success page or wherever you need to go after storing the data.
        return redirect()->route('eventcreatesuccess');
    }

    /**
     * Display the specified resource.
     */
    public function show(EventForm $eventForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventForm $eventForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventForm $eventForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventForm $eventForm)
    {
        // Check if the authenticated user is the owner of the event
        if (auth()->user()->id !== $eventForm->user_id) {
            abort(403); // Or any other action you want to take if the user is not authorized
        }

        // Delete the event from Google Calendar using Spatie package
        Event::find($eventForm->google_calendar_id)->delete();

        // Update the event in the database (set google_calendar_id to NULL)
        $eventForm->update(['google_calendar_id' => null]);

        // Redirect back or to a specific page after deletion
        return redirect()->back()->with('success', 'Event deleted successfully');
    }
    
}
