<?php

namespace App\Livewire\Business;

use App\Models\Company;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegistrationForm extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $industry_type;
    public $description;
    public $website;
    public $whatsapp_number;
    public $email;
    public $address;
    public $latitude;
    public $longitude;
    public $logo;
    public $services = '';

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'slug' => 'required|unique:companies,slug',
        'industry_type' => 'required',
        'description' => 'nullable|min:10',
        'email' => 'nullable|email',
        'whatsapp_number' => 'nullable|numeric',
        'logo' => 'nullable|image|max:2048', // 2MB Max
    ];

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        $company = Company::create([
            'user_id' => auth()->id(),
            'name' => $this->name,
            'slug' => $this->slug,
            'industry_type' => $this->industry_type,
            'description' => $this->description,
            'website' => $this->website,
            'whatsapp_number' => $this->whatsapp_number,
            'email' => $this->email,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'is_verified' => false,
            'status' => 'pending',
        ]);

        if ($this->logo) {
            $company->addMedia($this->logo->getRealPath())
                ->toMediaCollection('logos');
        }

        // Handle services (simple comma separated for now)
        if ($this->services) {
            $serviceList = explode(',', $this->services);
            foreach ($serviceList as $serviceName) {
                $company->services()->create(['name' => trim($serviceName)]);
            }
        }

        session()->flash('message', 'Perusahaan berhasil didaftarkan! Menunggu verifikasi admin.');
        
        return redirect()->route('alumni.dashboard');
    }

    public function render()
    {
        return view('livewire.business.registration-form');
    }
}
