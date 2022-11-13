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
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;

class RoomController extends Controller
{
    public function index()
    {
        return view('admin.room.index');
    }

    public function create()
    {
        $facilities = Facility::all()->where('is_active','1')->where('is_delete','1');
        $views = Roomtype::all()->where('is_active','1')->where('is_delete','1');
        return view('admin.room.create', compact('facilities','views'));
    }

    public function store(RoomFormRequest $request)
    {
        $validatedData = $request->validated();

        $room = new Room();

        $room->name = $validatedData['name'];
        $room->slug = $validatedData['slug'];
        $room->short_description = $validatedData['short_description'];
        $room->long_description = $validatedData['long_description'];
        $room->quantity = $validatedData['quantity'];
        $room->price = $validatedData['price'];

        $room->meta_title = $validatedData['meta_title'];
        $room->meta_keyword = $validatedData['meta_keyword'];
        $room->meta_decription = $validatedData['meta_decription'];

        $room->is_active = $request->is_active == true ? '1':'0';
        $room->created_by = $validatedData['created_by'];
        $room->save();

        $facilities = Facility::find($request->facilities);
        $room->facilities()->sync($facilities);

        $views = Roomtype::find($request->roomViews);
        $room->roomViews()->sync($views);

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

        return redirect('admin/room')->with('message','Congratulations! New Room Has Been Created Successfully.');
    }

    public function edit(int $room_id)
    {
        // $roomtypes = Roomtype::all()->where('is_active','1')->where('is_delete','1');
        $room = Room::findOrFail($room_id);
        $facilities = Facility::all()->where('is_active','1')->where('is_delete','1');
        $roomFacilities = $room->facilities();
        $views = Roomtype::all()->where('is_active','1')->where('is_delete','1');
        $roomViews = $room->roomViews();
        return view('admin.room.edit', compact('room','facilities','roomFacilities','views','roomViews'));
    }

    public function update(RoomFormRequest $request, int $room_id)
    {
        $validatedData = $request->validated();

        $room = Room::findOrFail($room_id);

        $room->name = $validatedData['name'];
        $room->slug = $validatedData['slug'];
        $room->short_description = $validatedData['short_description'];
        $room->long_description = $validatedData['long_description'];
        $room->quantity = $validatedData['quantity'];
        $room->price = $validatedData['price'];

        $room->meta_title = $validatedData['meta_title'];
        $room->meta_keyword = $validatedData['meta_keyword'];
        $room->meta_decription = $validatedData['meta_decription'];

        $room->is_active = $request->is_active == true ? '1':'0';
        $room->updated_by = $validatedData['updated_by'];
        $room->update();

        $facilities = Facility::find($request->facilities);
        $room->facilities()->sync($facilities);

        $views = Roomtype::find($request->roomViews);
        $room->roomViews()->sync($views);

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



    public function deleteRecord($room_id)
    {
        $this->room_id = $room_id;
    }

    public function destroyRecord()
    {
        $room =  Facility::find($this->room_id);
        // $path = 'uploads/facilities/'.$facility->image;
        // if(File::exists($path)){
        //     File::delete($path);
        // }
        // $facility->delete();
        $room->is_delete = '0';
        $room->update();
        // session()->flash('message','Facility Has Been Deleted Successfully.');
        return redirect('admin/room')->with('message','Room Has Been Deleted Successfully.');
        $this->dispatchBrowserEvent('close-modal');
    }
}
