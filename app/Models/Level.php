<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_level', 'user_id', 'level_id');
    }
}
