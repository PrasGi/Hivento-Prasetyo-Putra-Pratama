<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventActionController extends Controller
{
    public function approve(Event $event){
        $event->statusEvent_id = 1;

        if ($event->save()) return response()->json(['message' => "Success approve event"]);

        return response()->json(['message' => "Failed approve event"]);
    }

    public function pending(Event $event){
        $event->statusEvent_id = 2;

        if ($event->save()) return response()->json(['message' => "Success pending event"]);

        return response()->json(['message' => "Failed pending event"]);
    }

    public function rejected(Event $event){
        $event->statusEvent_id = 3;

        if ($event->save()) return response()->json(['message' => "Success rejected event"]);

        return response()->json(['message' => "Failed rejected event"]);
    }
}
