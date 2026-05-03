<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class AlumniProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->alumniProfile ?? AlumniProfile::create(['user_id' => $user->id]);
        
        return view('alumni.profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->alumniProfile;

        $request->validate([
            'name' => 'required|string|max:255',
            'current_job' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'bio' => 'nullable|string|max:1000',
            'skills' => 'nullable|array',
            'avatar' => 'nullable|image|max:2048',
            'availability_status' => 'nullable|boolean',
            // Extended Fields
            'angkatan' => 'nullable|string|max:10',
            'nim' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:20',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'kategori_keterserapan' => 'nullable|string|max:255',
            'cakupan_keterserapan' => 'nullable|string|max:255',
            'sektor' => 'nullable|string|max:255',
            // Job History
            'job_history' => 'nullable|array',
            'job_history.*.company' => 'nullable|string|max:255',
            'job_history.*.position' => 'nullable|string|max:255',
            'job_history.*.start_year' => 'nullable|string|max:4',
            'job_history.*.end_year' => 'nullable|string|max:10',
            'job_history.*.lat' => 'nullable|numeric|between:-90,90',
            'job_history.*.lng' => 'nullable|numeric|between:-180,180',
            'job_history.*.is_current' => 'nullable|boolean',
        ]);

        // Update User Model (Name)
        $user->update(['name' => $request->name]);

        $data = $request->except('avatar', 'skills', 'name', 'job_history');
        
        // Handle Skills (JSON)
        $data['skills'] = $request->input('skills', []);

        // Handle Job History (Clean up empty entries and parse boolean)
        $jobHistory = collect($request->input('job_history', []))->filter(function ($job) {
            return !empty($job['company']) && !empty($job['position']);
        })->map(function ($job) {
            $job['is_current'] = isset($job['is_current']) ? (bool) $job['is_current'] : false;
            return $job;
        })->values()->toArray();
        $data['job_history'] = $jobHistory;
        
        // Handle Avatar Upload with Compression
        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                Storage::delete('public/' . $profile->avatar);
            }
            
            $file = $request->file('avatar');
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file->getRealPath());
            
            // Resize max width 800px and compress to JPEG 75%
            $image->scaleDown(width: 800);
            $encoded = $image->toJpeg(75);
            
            $filename = 'avatars/' . uniqid() . '.jpg';
            Storage::disk('public')->put($filename, $encoded->toString());
            
            $data['avatar'] = $filename;
        }

        // Handle Availability Status (Checkbox)
        $data['availability_status'] = $request->has('availability_status');

        $profile->update($data);

        return redirect()->route('alumni.profile.edit')->with('status', 'profile-updated');
    }
}
