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
    public function index():view
    {
        return view('eventforms.index');
    }

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
    
        // Your logic to store the validated data in the database can go here.
        $request->user()->eventforms()->create($validated);
        // user() is from Laravel's built-in authentication system; user must be logged in
        // ->eventforms() has a relationship of "BelongsTo" with the user model
        // ->create($validated) creates a new event form record in the database of authenticated user.


        // Fetch the user's phone number from the authenticated user
        $user = $request->user();
        $businessName = $user->business_name;
        $publicName = $user->public_name;
        $phoneNumber = $user->phone;
        $contactEmail = $user->contact_email;
        $insta = $user->instagram;
        $twi = $user->twitter;
        $homePage = $user->homepage;
        $selectedcolor = $user->colors;

        // Create Additional Description
        /*$additionalDescription =
            "\n" .
            e($request->input('location')) . "\n" . 
            e($businessName) . "\n" .
            e($publicName) . "\n" .
            e($phoneNumber) . "\n" .
            e($contactEmail) . "\n" .
            '<a href="https://twitter.com/' . e($twi) . '" target="_blank">' . e($twi) . ' on Twitter</a>' . "\n" .
            '<a href="https://instagram.com/' . e($insta) . '" target="_blank">' . e($insta) . ' on Instagram</a>' . "\n" .
            '<a href="https://' . e($homePage) . '" target="_blank">' . __('Homepage') . '</a>';
        */
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
            if ($twi) {
                $additionalDescriptionItems[] = $this->createLink('https://twitter.com/' . $twi, $twi . ' on Twitter');
            }
            if ($insta) {
                $additionalDescriptionItems[] = $this->createLink('https://instagram.com/' . $insta, $insta . ' on Instagram');
            }
            if ($homePage) {
                $additionalDescriptionItems[] = $this->createLink($homePage, __('Homepage'));
            }
        $additionalDescription = "\n" . implode("\n", $additionalDescriptionItems);

        // Parse date and time input (with Carbon library) from the request and adjust the timezone to Asia/Tokyo
        $startDate = Carbon::parse($request->input('start_date'))->setTimezone('Asia/Tokyo');
        $startTime = Carbon::parse($request->input('start_time'));
        $endDate = Carbon::parse($request->input('end_date'))->setTimezone('Asia/Tokyo');
        $endTime = Carbon::parse($request->input('end_time'));
        
        // Combine date and time components into datetime objects
        $startDateTime = $startDate->copy()->setTime($startTime->hour, $startTime->minute, $startTime->second);
        $endDateTime = $endDate->copy()->setTime($endTime->hour, $endTime->minute, $endTime->second);
        
        Event::create([
            'name' => $request->input('event_title'), 
            'startDateTime' => $startDateTime,
            'endDateTime' => $endDateTime,
            'description' => $request->input('description') . $additionalDescription,
            'colorId' => $selectedcolor,
            'visibility' => 'default',
            'status' => 'confirmed',
        ]);


        // Redirect to a success page or wherever you need to go after storing the data.
        return redirect()->route('eventcreatesuccess');

        // NOTE TO SELF: pseudocode - if user has not select a color, create an event with color 18 (charcoal)
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
        //
    }
}
