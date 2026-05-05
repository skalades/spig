<?php

namespace App\Observers;

use App\Models\JobPost;
use App\Models\Post;

class JobPostObserver
{
    /**
     * Handle the JobPost "created" event.
     */
    public function created(JobPost $jobPost): void
    {
        // Otomatis buat postingan ke feed jika statusnya 'open'
        if ($jobPost->status === 'open') {
            $companyName = $jobPost->company ? $jobPost->company->name : 'Independent';
            
            Post::create([
                'user_id' => $jobPost->user_id,
                'type' => 'job',
                'content' => "Halo rekan-rekan! Ada lowongan kerja baru untuk posisi **{$jobPost->title}** di **{$companyName}**. Silakan cek detailnya di Career Hub!",
                'metadata' => [
                    'job_id' => $jobPost->id,
                    'job_title' => $jobPost->title,
                    'company_name' => $companyName,
                    'location' => $jobPost->location,
                    'job_type' => $jobPost->job_type,
                    'slug' => $jobPost->slug,
                ]
            ]);
        }
    }
}
