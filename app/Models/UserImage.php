<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserImage extends Model
{
    use HasFactory;

    protected $table = 'hb_user_images';

    protected $fillable = [
        'user_id',
        'profile_photo',
        'cover_photo',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
