<?php

namespace App\Livewire\Public;

use Livewire\Component;

class CompanyDetail extends Component
{
    public \App\Models\Company $company;

    public function mount($slug)
    {
        $this->company = \App\Models\Company::where('slug', $slug)
            ->with(['services', 'inventories', 'jobPosts', 'projects'])
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.public.company-detail', [
            'isOwner' => false,
        ])
        ->layout('components.layout');
    }
}
