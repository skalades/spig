<?php

namespace App\Livewire\Career;

use App\Models\JobPost;
use Livewire\Component;

class JobDetail extends Component
{
    public JobPost $job;

    public function mount($slug)
    {
        $this->job = JobPost::where('slug', $slug)
            ->with(['user.alumniProfile', 'company'])
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.career.job-detail')
            ->layout('layouts.app');
    }
}
