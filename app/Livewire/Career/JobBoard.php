<?php

namespace App\Livewire\Career;

use App\Models\JobPost;
use Livewire\Component;
use Livewire\WithPagination;

class JobBoard extends Component
{
    use WithPagination;

    public $search = '';
    public $type = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'type' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $jobs = JobPost::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('location', 'like', '%' . $this->search . '%');
            })
            ->when($this->type, function ($query) {
                $query->where('job_type', $this->type);
            })
            ->with(['user.alumniProfile', 'company'])
            ->latest()
            ->paginate(10);

        return view('livewire.career.job-board', [
            'jobs' => $jobs
        ]);
    }
}
