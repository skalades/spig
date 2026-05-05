<?php

namespace App\Livewire\Landing;

use Livewire\Component;

class PartnershipForm extends Component
{
    public $name;
    public $organization;
    public $email;
    public $phone;
    public $message;

    protected $rules = [
        'name' => 'required|min:3',
        'organization' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|min:10',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        \App\Models\Partnership::create([
            'name' => $this->name,
            'organization' => $this->organization,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'organization', 'email', 'phone', 'message']);
        
        $this->dispatch('notify', message: 'Permohonan kemitraan berhasil dikirim. Tim kami akan segera menghubungi Anda.', type: 'success');
    }

    public function render()
    {
        return view('livewire.landing.partnership-form');
    }
}
