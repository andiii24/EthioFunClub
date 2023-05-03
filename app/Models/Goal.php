<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $fillable = ['is_achieved'];

    public function user()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }
}
