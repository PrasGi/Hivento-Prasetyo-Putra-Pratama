<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'image' => 'image|file',
            'name_event' => 'required|string|max:100',
            'describe_event' => 'required|string|max:255',
            'file' => 'required|file|max:5120'
        ]);

        $validateData['statusEvent_id'] = 2;
        if ($request->file('image')) $validateData['image'] = $request->file('image')->store('image-event');
        if ($request->file('file')) $validateData['file'] = $request->file('file')->store('file-event');
        $validateData['user_id'] = auth()->user()->id;

        if (Event::create($validateData)) return response()->json(['message' => 'Success add data']);

        return response()->json(['message' => 'Failed add data']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return $event;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validateData = $request->validate([
//            'image' => 'image|file', // kenapa eror kalo dipakekin ini?
            'name_event' => 'required|string|max:100',
            'describe_event' => 'required|string|max:255',
            'file' => 'required|file|max:5120'
        ]);

        if ($request->file('image')) {
            if ($event->image) Storage::delete($event->image);

            $event->image = $request->file('image')->store('image-event');
        } else {
            if ($event->image) Storage::delete($event->image);
        }

        $event->name_event = $request->name_event;
        $event->describe_event = $request->describe_event;
        $event->user_id = auth()->user()->id;

        if ($request->file('file')){
            Storage::delete($event->file);
            $event->file = $request->file('file')->store('file-event');
        }

        if ($event->save()) return response()->json(['message' => 'Success update data']);

        return response()->json(['message' => 'Failed update data'], 401);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if ($event->image) Storage::delete($event->image);

        if ($event->file) Storage::delete($event->file);

        if ($event->delete()) response()->json(['message' => 'Success destroy data']);

        response()->json(['message' => 'Failed destroy data']);
    }
}
