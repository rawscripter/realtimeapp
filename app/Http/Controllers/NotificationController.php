<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class NotificationController extends Controller {

    public function __construct()
    {
        $this->middleware('jwt');
    }


    public function getNotification()
    {
        return [
            'read' => NotificationResource::collection(auth()->user()->readNotifications),
            'unRead' => NotificationResource::collection(auth()->user()->unreadNotifications),
        ];
    }

    public function markAsRead(Request $request)
    {
        auth()->user()->unreadNotifications->where('id', $request->id)->markAsRead();

    }
}
