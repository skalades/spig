<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniProfile extends Model
{
    protected $fillable = [
        'user_id',
        'avatar',
        'current_job',
        'company',
        'address',
        'latitude',
        'longitude',
        'bio',
        'skills',
        'availability_status',
        'privacy_settings',
        // Tracer Study & Extended Fields
        'angkatan', 'nim', 'whatsapp', 'linkedin', 'instagram',
        'kategori_keterserapan', 'cakupan_keterserapan', 'sektor',
        'job_history',
    ];

    protected $casts = [
        'skills' => 'array',
        'privacy_settings' => 'array',
        'job_history' => 'array',
        'availability_status' => 'boolean',
        'latitude' => 'double',
        'longitude' => 'double',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
