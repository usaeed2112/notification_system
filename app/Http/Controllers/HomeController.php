<?php

namespace App\Http\Controllers;

use App\Models\NotificationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userNotifications = Auth::user()->notificationTypes->pluck('id')->toArray();
        $notificationTypes = NotificationType::orderBy('created_at', 'desc')->get();
        return view('home', compact('notificationTypes', 'userNotifications'));
    }
}
