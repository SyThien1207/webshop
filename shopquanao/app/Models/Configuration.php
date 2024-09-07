<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_website',
        'description',
        'address',
        'link_map',
        'phone',
        'email',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'logo',
        'favicon',
        'status',
    ];
}