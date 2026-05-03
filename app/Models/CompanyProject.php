<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyProject extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'client_name',
        'project_date',
        'url',
    ];

    protected $casts = [
        'project_date' => 'date',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(250)
            ->sharpen(10);
    }
}
