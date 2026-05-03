<?php

namespace App\Livewire\Alumni;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RecommendedAlumni extends Component
{
    public function render()
    {
        $recommendations = \Illuminate\Support\Facades\Cache::remember('recommended_alumni_' . Auth::id(), 1800, function () {
            return User::where('id', '!=', Auth::id())
                ->where('role', 'alumni')
                ->with('alumniProfile')
                ->inRandomOrder()
                ->limit(3)
                ->get();
        });

        return view('livewire.alumni.recommended-alumni', [
            'recommendations' => $recommendations
        ]);
    }
}
