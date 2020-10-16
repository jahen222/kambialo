<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request)
    {
        \App\User::find(auth()->user()->id)->notifications()->where('id', $request->input('id'))->first()->markAsRead();
    }
}
