<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['is_read', 'message_body', 'subject', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
