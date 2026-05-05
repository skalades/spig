<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\AlumniProfile;
use App\Models\User;
use App\Models\AlumniProject;
use App\Models\Company;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->alumniProfile;

        // Cache stats for 1 hour
        $stats = Cache::remember('alumni_dashboard_stats', 3600, function () {
            $expertiseDist = [];
            
            // Menggunakan cursor() agar tidak memuat semua data ke RAM
            $profiles = AlumniProfile::select('skills')->cursor();
            foreach ($profiles as $p) {
                if (is_array($p->skills)) {
                    foreach ($p->skills as $skill) {
                        $expertiseDist[$skill] = ($expertiseDist[$skill] ?? 0) + 1;
                    }
                }
            }

            return [
                'total_alumni' => User::where('role', 'alumni')->count(),
                'total_projects' => AlumniProject::count(),
                'expertise_dist' => $expertiseDist,
            ];
        });

        return view('alumni.dashboard', compact('user', 'profile', 'stats'));
    }

    public function mapData()
    {
        // Cache map data for 1 hour
        $alumniLocations = Cache::remember('alumni_map_data_v2', 3600, function () {
            $profiles = AlumniProfile::with('user:id,name')
                ->select('id', 'user_id', 'latitude', 'longitude', 'current_job', 'company', 'job_history')
                ->get();
                
            $mapData = [];
            
            foreach ($profiles as $profile) {
                $lat = $profile->latitude;
                $lng = $profile->longitude;
                $type = 'Domisili';
                
                // Cek apakah ada lokasi pekerjaan saat ini
                if (is_array($profile->job_history)) {
                    foreach ($profile->job_history as $job) {
                        if (!empty($job['is_current']) && $job['is_current'] == true && !empty($job['lat']) && !empty($job['lng'])) {
                            $lat = $job['lat'];
                            $lng = $job['lng'];
                            $type = 'Lokasi Kerja';
                            break; // Gunakan pekerjaan saat ini yang pertama ditemukan
                        }
                    }
                }
                
                if ($lat && $lng) {
                    $mapData[] = [
                        'id' => $profile->id,
                        'user_id' => $profile->user_id,
                        'name' => $profile->user->name ?? 'Unknown',
                        'current_job' => $profile->current_job,
                        'company' => $profile->company,
                        'latitude' => $lat,
                        'longitude' => $lng,
                        'type' => $type
                    ];
                }
            }
            
            // Tambahkan data Company (Perusahaan Alumni)
            $companies = Company::whereNotNull('latitude')->whereNotNull('longitude')->get();
            foreach ($companies as $company) {
                $mapData[] = [
                    'id' => 'company_' . $company->id,
                    'user_id' => $company->user_id,
                    'name' => $company->name,
                    'current_job' => $company->industry_type,
                    'industry_type' => $company->industry_type, // Explicitly add industry_type
                    'company' => 'Verified Business',
                    'latitude' => $company->latitude,
                    'longitude' => $company->longitude,
                    'type' => 'Perusahaan',
                    'slug' => $company->slug
                ];
            }
            
            return $mapData;
        });

        return response()->json($alumniLocations);
    }
}
