<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    use HasFactory;

    protected $table = 'hb_room_images';

    protected $fillable = [
        'room_id',
        'image',
    ];
}
