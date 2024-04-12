<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'path',
        'gallery_id',
        'url',
        'type',
        'created_by',
        'updated_by'
    ];
}
