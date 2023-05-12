<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'user_id','serial_num'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if ($product->user_id) {
                $product->user->products()->delete();
            }
            $product->user_id = auth()->id();
        });
    }
}
