<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = 'hb_user_info';

    protected $fillable = [
        'user_id',
        'gender',
        'date_of_birth',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'admin_comment',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
