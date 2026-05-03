<?php

namespace App\Livewire\Business;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class DirectoryIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $industry = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'industry' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingIndustry()
    {
        $this->resetPage();
    }

    public function render()
    {
        $companies = Company::query()
            ->where('status', 'approved')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->industry, function ($query) {
                $query->where('industry_type', $this->industry);
            })
            ->with(['services', 'user.alumniProfile'])
            ->latest()
            ->paginate(12);

        return view('livewire.business.directory-index', [
            'companies' => $companies
        ]);
    }
}
