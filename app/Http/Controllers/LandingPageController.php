<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Stat;
use App\Models\Project;

class LandingPageController extends Controller
{
    public function index()
    {
        $stats = Stat::orderBy('sort_order')->get();
        $projects = Project::orderBy('sort_order')->get();
        $businessCount = \App\Models\Company::count();
        $upcomingEvents = \App\Models\Event::where('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(3)
            ->get();

        return view('welcome', compact('stats', 'projects', 'businessCount', 'upcomingEvents'));
    }
}
