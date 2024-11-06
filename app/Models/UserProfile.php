<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = ['facebook','twitter','skype','bio','profile_image','user_id'];

    public function getFeaturedAttribute($image){
        return asset($image);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
