<?php

namespace App\Livewire\Business;

use App\Models\Company;
use Livewire\Component;

class CompanyDetail extends Component
{
    public Company $company;

    public function mount($slug)
    {
        $this->company = Company::where('slug', $slug)
            ->with(['services', 'inventories', 'jobPosts'])
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.business.company-detail', [
            'isOwner' => auth()->id() === $this->company->user_id,
        ])
        ->layout('layouts.app');
    }
}
