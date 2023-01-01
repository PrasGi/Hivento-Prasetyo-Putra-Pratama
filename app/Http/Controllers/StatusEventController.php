<?php

namespace App\Http\Controllers;

use App\Models\StatusEvent;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class StatusEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StatusEvent::all();
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
            'name_status' => 'required|string|unique:status_events'
        ]);

        if (StatusEvent::create($validateData)) return response()->json(['message' => 'Success add data']);

        return response()->json(['message' => 'Failed add data']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatusEvent  $status
     * @return \Illuminate\Http\Response
     */
    public function show(StatusEvent $status)
    {
        return $status;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatusEvent  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusEvent $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StatusEvent  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusEvent $status)
    {
        if (isEmpty($status)){
            if ($request->name_status != $status->name_status){
                $validateData = $request->validate([
                    'name_status' => 'required|string|unique:status_events'
                ]);
                $status->name_status = $request->name_status;

                if ($status->save()) return response()->json(['message' => 'Update data success']);
            }

            return response()->json(['message' => 'Data is same']);
        }

        return response()->json(['message' => 'No have data']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusEvent  $statusEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusEvent $status)
    {
        if ($status->delete()) return response()->json(['message' => 'Delete data success']);

        return response()->json(['message' => 'Delete data failed'], 404);
    }
}
