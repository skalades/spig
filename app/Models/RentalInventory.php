<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class RentalInventory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'company_id',
        'item_name',
        'category',
        'description',
        'daily_rate',
        'status',
        'image_path',
    ];

    public function getFormattedRateAttribute(): string
    {
        return 'Rp ' . number_format($this->daily_rate, 0, ',', '.');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->sharpen(10);

        $this->addMediaConversion('optimized')
            ->format('webp')
            ->quality(80);
    }
}
