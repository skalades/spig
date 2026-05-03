<?php

namespace App\Livewire\Career;

use App\Models\Company;
use App\Models\JobPost;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateJob extends Component
{
    public $title;
    public $slug;
    public $company_id;
    public $description;
    public $requirements;
    public $location;
    public $job_type = 'Full-time';
    public $salary_range;
    public $deadline;

    protected $rules = [
        'title' => 'required|min:5|max:255',
        'slug' => 'required|unique:job_posts,slug',
        'company_id' => 'nullable|exists:companies,id',
        'description' => 'required|min:20',
        'requirements' => 'nullable|min:10',
        'location' => 'required|min:3',
        'job_type' => 'required|in:Full-time,Part-time,Contract,Freelance,Internship',
        'salary_range' => 'nullable|max:255',
        'deadline' => 'nullable|date|after:today',
    ];

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value) . '-' . time();
    }

    public function save()
    {
        $this->validate();

        $job = JobPost::create([
            'user_id' => auth()->id(),
            'company_id' => $this->company_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'requirements' => $this->requirements,
            'location' => $this->location,
            'job_type' => $this->job_type,
            'salary_range' => $this->salary_range,
            'deadline' => $this->deadline,
            'status' => 'open',
        ]);

        // Auto-post to Social Feed
        $companyName = $this->company_id ? Company::find($this->company_id)->name : auth()->user()->name;
        
        $postContent = "Membuka lowongan pekerjaan baru!\n\n";
        $postContent .= "Posisi: **{$this->title}**\n";
        $postContent .= "Oleh: {$companyName}\n";
        $postContent .= "Lokasi: {$this->location}\n";
        $postContent .= "Tipe: {$this->job_type}\n\n";
        $postContent .= "Cek detailnya di portal karir kita!";

        Post::create([
            'user_id' => auth()->id(),
            'content' => $postContent,
            'type' => 'job',
            'metadata' => [
                'title' => $this->title,
                'description' => Str::limit($this->description, 100),
                'url' => route('alumni.jobs.show', $this->slug),
            ],
        ]);

        session()->flash('message', 'Lowongan pekerjaan berhasil diposting!');
        
        return redirect()->route('alumni.jobs.index');
    }

    public function render()
    {
        $myCompanies = Company::where('user_id', auth()->id())->get();
        return view('livewire.career.create-job', [
            'myCompanies' => $myCompanies
        ]);
    }
}
