<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    protected $fillable = [
        'name',
        'organization',
        'email',
        'phone',
        'message',
        'status',
    ];
}
