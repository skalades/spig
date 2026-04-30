<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'current_job' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'bio' => 'nullable|string|max:1000',
            'skills' => 'nullable|array',
            'avatar' => 'nullable|image|max:2048',
            'availability_status' => 'nullable|boolean',
        ]);

        $data = $request->except('avatar', 'skills');
        
        // Handle Skills (JSON)
        $data['skills'] = $request->input('skills', []);
        
        // Handle Avatar Upload
        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                Storage::delete('public/' . $profile->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        // Handle Availability Status (Checkbox)
        $data['availability_status'] = $request->has('availability_status');

        $profile->update($data);

        return redirect()->route('alumni.profile.edit')->with('status', 'profile-updated');
    }
}
