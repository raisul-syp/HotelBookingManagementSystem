<?php

namespace App\Models;

use App\Models\Roomtype;
use App\Models\RoomImage;
use App\Models\RoomFacility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $table = 'hb_rooms';

    protected $fillable = [
        // 'roomtype_id',
        'name',
        'slug',
        'short_description',
        'long_description',
        'quantity',
        'price',
        // 'room_facility',
        'meta_title',
        'meta_keyword',
        'meta_decription',
        'is_active',
        'is_delete',
        'created_by',
        'updated_by',
    ];

    // public function roomtype()
    // {
    //     return $this->belongsTo(Roomtype::class, 'roomtype_id', 'id');
    // }

    public function roomImages()
    {
        return $this->hasMany(RoomImage::class, 'room_id', 'id');
    }

    // public function roomFacilities()
    // {
    //     return $this->belongsToMany(RoomFacility::class, 'room_id', 'facility_id');
    // }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'hb_room_facilities');
    }
}
