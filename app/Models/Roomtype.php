<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Roomtype extends Model
{
    use HasFactory;

    protected $table = 'hb_roomtype';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'meta_title',
        'meta_keyword',
        'meta_decription',
        'is_active',
        'is_delete',
        'created_by',
        'updated_by',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'roomtype_id', 'id'); 
    }
}
