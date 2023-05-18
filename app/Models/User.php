<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'password',
        'role',
        'upid',
        'parent_id',
        'middle_id',
        'right_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static $phoneRules = [
        'phone' => 'required|unique:users|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
    ];
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function leftChild()
    {
        return $this->hasOne(User::class, 'left_id');
    }

    public function middleChild()
    {
        return $this->hasOne(User::class, 'middle_id');
    }

    public function rightChild()
    {
        return $this->hasOne(User::class, 'right_id');
    }

}
