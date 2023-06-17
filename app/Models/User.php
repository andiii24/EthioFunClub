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
        'level',
        'level_payment',
        'password_reset',
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
    public function descendants()
    {
        return $this->hasMany(User::class, 'upid')->with('descendants');
    }
    public function minChildLevel()
    {
        // dd($this->children()->min('level'));
        return $this->children()->min('level');
    }
    public function leftChild()
    {
        return $this->belongsTo(User::class, 'left_child_id');
    }

    public function middleChild()
    {
        return $this->belongsTo(User::class, 'middle_child_id');
    }

    public function rightChild()
    {
        return $this->belongsTo(User::class, 'right_child_id');
    }

    public function incrementParentLevel()
    {

        $parent = $this->parentUser;
        if ($parent) {
            $leftChildId = $parent->left_child_id;
            $middleChildId = $parent->middle_child_id;
            $rightChildId = $parent->right_child_id;

            if ($leftChildId && $middleChildId && $rightChildId) {

                $ot = $parent->minChildLevel();
                $parent->level = $ot + 1;
                $level = $parent->level;
                if ($level >= 3) {
                    $parent->level_payment = 1;
                }
                $parent->save();
                $parent->incrementParentLevel();
            }
        }
    }
}
