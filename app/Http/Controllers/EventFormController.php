<?php

namespace App\Http\Controllers;

use App\Models\EventForm;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EventFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():view
    {
        return view(eventforms.index);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        // Redirect to a success page or wherever you need to go after storing the data.
        return redirect()->route('success.route.name');
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
