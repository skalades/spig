<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Company extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    
    const INDUSTRY_TYPES = [
        'engineering' => 'Engineering & Geospatial',
        'it_services' => 'IT & Software Development',
        'creative'    => 'Creative Services (Photo/Video)',
        'consultant'  => 'Professional Consultant',
        'commerce'    => 'Commerce & Retail',
        'other'       => 'Lainnya',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'logo',
        'description',
        'industry_type',
        'website',
        'whatsapp_number',
        'email',
        'address',
        'latitude',
        'longitude',
        'is_verified',
        'status',
        'instagram',
        'linkedin',
        'facebook',
        'settings',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'settings' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(CompanyService::class);
    }

    public function inventories(): HasMany
    {
        return $this->hasMany(RentalInventory::class);
    }

    public function jobPosts(): HasMany
    {
        return $this->hasMany(JobPost::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100)
            ->sharpen(10);

        $this->addMediaConversion('optimized')
            ->format('webp')
            ->quality(80);
    }
    public function projects(): HasMany
    {
        return $this->hasMany(CompanyProject::class);
    }
}
