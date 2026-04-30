<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AlumniProfile;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->alumniProfile;

        // Stats for Analytics
        $stats = [
            'total_alumni' => \App\Models\User::where('role', 'alumni')->count(),
            'total_projects' => \App\Models\AlumniProject::count(),
            'expertise_dist' => AlumniProfile::select('skills')->get()
                ->flatMap(fn($p) => $p->skills ?? [])
                ->countBy()
                ->toArray(),
        ];

        // Alumni Map Data
        $alumniLocations = AlumniProfile::with('user')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('alumni.dashboard', compact('user', 'profile', 'stats', 'alumniLocations'));
    }
}
