<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use App\Models\AlumniProfile;

class AlumniDirectoryController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'alumni')->with('alumniProfile');

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by availability
        if ($request->filled('available')) {
            $query->whereHas('alumniProfile', function ($q) {
                $q->where('availability_status', true);
            });
        }

        // Filter by skill
        if ($request->filled('skill')) {
            $skill = $request->skill;
            $query->whereHas('alumniProfile', function ($q) use ($skill) {
                $q->whereJsonContains('skills', $skill);
            });
        }

        $alumnis = $query->paginate(12)->withQueryString();

        // Get all unique skills for filter dropdown
        $allSkills = Cache::remember('all_skills_list', 3600, function () {
            $skills = [];
            $profiles = AlumniProfile::select('skills')->cursor();
            foreach ($profiles as $p) {
                if (is_array($p->skills)) {
                    foreach ($p->skills as $s) {
                        if (!in_array($s, $skills)) {
                            $skills[] = $s;
                        }
                    }
                }
            }
            sort($skills);
            return $skills;
        });

        return view('alumni.directory.index', compact('alumnis', 'allSkills'));
    }

    public function show($id)
    {
        $alumni = User::where('role', 'alumni')->with('alumniProfile')->findOrFail($id);
        
        // Prepare career map data
        $careerData = [];
        if ($alumni->alumniProfile && is_array($alumni->alumniProfile->job_history)) {
            foreach ($alumni->alumniProfile->job_history as $index => $job) {
                if (!empty($job['lat']) && !empty($job['lng'])) {
                    $careerData[] = [
                        'id' => $index + 1,
                        'company' => $job['company'] ?? 'Perusahaan',
                        'position' => $job['position'] ?? 'Posisi',
                        'year' => ($job['start_year'] ?? '') . ' - ' . ($job['end_year'] ?? 'Sekarang'),
                        'lat' => (float) $job['lat'],
                        'lng' => (float) $job['lng'],
                        'is_current' => !empty($job['is_current']) && $job['is_current'] == true
                    ];
                }
            }
        }

        return view('alumni.profile.show', compact('alumni', 'careerData'));
    }
}
