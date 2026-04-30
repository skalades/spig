<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniProject extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'latitude',
        'longitude',
        'project_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
