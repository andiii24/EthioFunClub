<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genealogy extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }
    public function level()
    {
        return $this->hasMany(Level::class, 'level_id', 'id');
    }
}
