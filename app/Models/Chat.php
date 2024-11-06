<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public function friend_one_id()
    {
        return $this->belongsTo(User::class, 'friend_one_id');
    }
public function friend_two_id()
    {
        return $this->belongsTo(User::class, 'friend_two_id');
    }
}
