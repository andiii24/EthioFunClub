<?php
namespace App\Models;

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
        'right_child_id',
        'middle_child_id',
        'left_child_id',
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

    public function parentUser()
    {
        return $this->belongsTo(User::class, 'upid');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'upid');
    }

    public function leftChild()
    {
        return $this->hasOne(User::class, 'left_child_id');
    }

    public function middleChild()
    {
        return $this->hasOne(User::class, 'middle_child_id');
    }

    public function rightChild()
    {
        return $this->hasOne(User::class, 'right_child_id');
    }

    public function incrementParentLevel()
    {
        $parentUser = $this->parentUser;
        if ($parentUser) {
            // Check if all the parent user's siblings have three children with the desired level
            $siblings = $parentUser->children();
            $siblingsCount = $siblings->count();
            $validSiblingsCount = $siblings->whereHas('children', function ($query) {
                $query->where('level', '>=', $this->level);
            })->count();

            if ($validSiblingsCount >= $siblingsCount && $siblingsCount > 0) {
                // Increment the level of the parent user
                $parentUser->level += 1;
                $parentUser->save();
                $parentUser->incrementParentLevel(); // Call the function for the parent user
            }
        }
    }
}
