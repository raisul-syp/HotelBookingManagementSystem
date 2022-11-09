<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Facility;
use App\Models\Roomtype;
use App\Models\RoomImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\RoomFormRequest;
use App\Models\RoomFacility;
use Illuminate\Validation\Rules\Exists;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all()->where('is_delete','1');
        return view('admin.room.index', compact('rooms'));
    }

    public function create()
    {
        // $roomtypes = Roomtype::all()->where('is_active','1')->where('is_delete','1');
        $facilities = Facility::all()->where('is_active','1')->where('is_delete','1');
        return view('admin.room.create', compact('facilities'));
    }

    public function store(RoomFormRequest $request)
    {
        $validatedData = $request->validated();

        // $roomtype = Roomtype::findOrFail($validatedData['roomtype_id']);

        $room = new Room();
        
        $room->name = $validatedData['name'];
        $room->slug = $validatedData['slug'];
        $room->short_description = $validatedData['short_description'];
        $room->long_description = $validatedData['long_description'];
        $room->quantity = $validatedData['quantity'];
        $room->price = $validatedData['price'];
        // $room->room_facility = implode(',', (array) $validatedData['room_facility']);

        $room->meta_title = $validatedData['meta_title'];
        $room->meta_keyword = $validatedData['meta_keyword'];
        $room->meta_decription = $validatedData['meta_decription'];

        $room->is_active = $request->is_active == true ? '1':'0';
        $room->created_by = $validatedData['created_by'];
        $room->save();

        $facilities = RoomFacility::find($request->facilities);
        $room->roomFacilities()->sync($facilities);


        if($request->hasFile('image')){
            $uploadPath = 'uploads/rooms/';
            $i = 1;

            foreach($request->file('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $filename =  $room->slug.'-'.time().'-'.$i++.'.'.$extension;
                $imageFile->move($uploadPath,$filename);
                $finalImagePathName = $uploadPath.$filename;

                $room->roomImages()->create([
                    'room_id' => $room->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }


        // if($request->facilities){
        //     foreach($request->facilities as $facility){
        //         $room->roomFacilities()->create([
        //             'room_id' => $room->id,
        //             'facility_id' => $facility,
        //         ]);
        //     }
        // }

        return redirect('admin/room')->with('message','Congratulations! New Room Has Been Created Successfully.');
    }

    public function edit(int $room_id)
    {
        $roomtypes = Roomtype::all()->where('is_active','1')->where('is_delete','1');
        $room = Room::findOrFail($room_id);
        return view('admin.room.edit', compact('room','roomtypes'));
    }

    public function update(RoomFormRequest $request, int $room_id)
    {
        $validatedData = $request->validated();

        $room = Roomtype::findOrFail($validatedData['roomtype_id'])->rooms()->where('id',$room_id)->first();

        if($room){
            $room->update([
                'roomtype_id' => $validatedData['roomtype_id'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'short_description' => $validatedData['short_description'],
                'long_description' => $validatedData['long_description'],
                'quantity' => $validatedData['quantity'],
                'price' => $validatedData['price'],
    
                'meta_title' => $validatedData['meta_title'],
                'meta_keyword' => $validatedData['meta_keyword'],
                'meta_decription' => $validatedData['meta_decription'],
                
                'is_active' => $request->is_active == true ? '1':'0',
                'updated_by' => $validatedData['updated_by'],
            ]);


            if($request->hasFile('image')){
                $uploadPath = 'uploads/rooms/';
    
                $i = 1;
                foreach($request->file('image') as $imageFile){
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename =  $room->slug.'-'.time().'-'.$i++.'.'.$extension;
                    $imageFile->move($uploadPath,$filename);
                    $finalImagePathName = $uploadPath.$filename;
    
                    $room->roomImages()->create([
                        'room_id' => $room->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }

            return redirect('admin/room')->with('message','Congratulations! New Room Has Been Updated Successfully.');
        }
        else{
            return redirect('admin/room')->with('message','Sorry! No Room ID Found.');
        }
    }

    // public function destroyImage(int $room_image_id)
    // {
    //     $roomImage = RoomImage::findOrFail($room_image_id);
    //     if(File::exists($roomImage->image)){
    //         File::delete($roomImage->image);
    //     }
    //     $roomImage->delete();
        
    //     return redirect('admin/room')->with('message','Congratulations! New Room Has Been Updated Successfully.');
    // }
}
