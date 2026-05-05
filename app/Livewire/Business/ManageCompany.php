<?php

namespace App\Livewire\Business;

use App\Models\Company;
use App\Models\CompanyService;
use App\Models\RentalInventory;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageCompany extends Component
{
    use WithFileUploads;

    public Company $company;

    // Item form state
    public $isAddingItem = false;
    public $item_name;
    public $category = 'Total Station';
    public $item_description;
    public $daily_rate;
    public $status = 'available';
    public $item_image;
    
    // Company settings state
    public $instagram;
    public $linkedin;
    public $facebook;
    public $description;
    public $website;
    public $email;
    public $whatsapp_number;
    public $address;
    public $latitude;
    public $longitude;
    public $industry_type;
    public $settings = [
        'show_rental' => false,
        'show_portfolio' => true,
    ];

    // Project Management
    public $isAddingProject = false;
    public $project_title, $project_description, $client_name, $project_date, $project_url, $project_image;


    public function mount()
    {
        // For simplicity, just get the first company owned by the user
        $this->company = Company::where('user_id', auth()->id())->firstOrFail();
        
        $this->instagram = $this->company->instagram;
        $this->linkedin = $this->company->linkedin;
        $this->facebook = $this->company->facebook;
        $this->description = $this->company->description;
        $this->website = $this->company->website;
        $this->email = $this->company->email;
        $this->whatsapp_number = $this->company->whatsapp_number;
        $this->address = $this->company->address;
        $this->latitude = $this->company->latitude;
        $this->longitude = $this->company->longitude;
        $this->industry_type = $this->company->industry_type;
        $this->settings = array_merge($this->settings, $this->company->settings ?? []);
    }

    public function updateCompany()
    {
        $this->validate([
            'description' => 'nullable|string|max:1000',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'industry_type' => 'required|string',
            'settings.show_rental' => 'boolean',
            'settings.show_portfolio' => 'boolean',
        ]);

        $this->company->update([
            'description' => $this->description,
            'website' => $this->website,
            'email' => $this->email,
            'whatsapp_number' => $this->whatsapp_number,
            'address' => $this->address,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'facebook' => $this->facebook,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'industry_type' => $this->industry_type,
            'settings' => $this->settings,
        ]);

        $this->dispatch('notify', ['message' => 'Informasi perusahaan berhasil diperbarui', 'type' => 'success']);
    }

    public function toggleAddProject()
    {
        $this->isAddingProject = !$this->isAddingProject;
        $this->resetProjectForm();
    }

    private function resetProjectForm()
    {
        $this->project_title = '';
        $this->project_description = '';
        $this->client_name = '';
        $this->project_date = '';
        $this->project_url = '';
        $this->project_image = null;
    }

    public function saveProject()
    {
        $this->validate([
            'project_title' => 'required|string|max:255',
            'project_description' => 'nullable|string',
            'client_name' => 'nullable|string|max:255',
            'project_date' => 'nullable|date',
            'project_url' => 'nullable|url|max:255',
            'project_image' => 'nullable|image|max:2048',
        ]);

        $project = $this->company->projects()->create([
            'title' => $this->project_title,
            'description' => $this->project_description,
            'client_name' => $this->client_name,
            'project_date' => $this->project_date ?: null,
            'url' => $this->project_url,
        ]);

        if ($this->project_image) {
            $project->addMedia($this->project_image->getRealPath())
                ->usingFileName($this->project_image->getClientOriginalName())
                ->toMediaCollection('projects');
        }

        $this->isAddingProject = false;
        $this->resetProjectForm();
        $this->company->load('projects');
        $this->dispatch('notify', ['message' => 'Proyek portofolio berhasil ditambahkan', 'type' => 'success']);
    }

    public function deleteProject($id)
    {
        $this->company->projects()->findOrFail($id)->delete();
        $this->company->load('projects');
        $this->dispatch('notify', ['message' => 'Proyek berhasil dihapus', 'type' => 'success']);
    }

    public function toggleAddItem()
    {
        $this->isAddingItem = !$this->isAddingItem;
        $this->resetItemForm();
    }

    public function resetItemForm()
    {
        $this->reset(['item_name', 'category', 'item_description', 'daily_rate', 'status', 'item_image']);
    }

    public function saveInventoryItem()
    {
        $this->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|string',
            'daily_rate' => 'required|numeric',
            'status' => 'required|in:available,rented,maintenance',
            'item_image' => 'nullable|image|max:5120', // 5MB Max
        ]);

        $item = $this->company->inventories()->create([
            'item_name' => $this->item_name,
            'category' => $this->category,
            'description' => $this->item_description,
            'daily_rate' => $this->daily_rate,
            'status' => $this->status,
        ]);

        if ($this->item_image) {
            $item->addMedia($this->item_image->getRealPath())
                 ->toMediaCollection('inventories');
        }

        $this->company->refresh();
        $this->toggleAddItem();
        $this->dispatch('notify', ['message' => 'Item inventaris berhasil ditambahkan', 'type' => 'success']);
    }

    public function deleteItem($itemId)
    {
        $item = RentalInventory::where('company_id', $this->company->id)->findOrFail($itemId);
        $item->delete();
        $this->company->refresh();
        $this->dispatch('notify', ['message' => 'Item inventaris berhasil dihapus', 'type' => 'success']);
    }

    public function deleteService($serviceId)
    {
        $service = CompanyService::where('company_id', $this->company->id)->findOrFail($serviceId);
        $service->delete();
        $this->company->refresh();
    }

    public function render()
    {
        return view('livewire.business.manage-company')
            ->layout('layouts.app');
    }
}
