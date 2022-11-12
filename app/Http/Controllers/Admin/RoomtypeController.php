<?php

namespace App\Http\Controllers\Admin;

use App\Models\Roomtype;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomtypeFormRequest;

class RoomtypeController extends Controller
{
    public function index()
    {
        return view('admin.roomtype.index');
    }

    public function create()
    {
        return view('admin.roomtype.create');
    }

    public function store(RoomtypeFormRequest $request)
    {
        $validatedData = $request->validated();

        $roomtype = new Roomtype();

        $roomtype->name = $validatedData['name'];
        $roomtype->slug = Str::slug($validatedData['slug']) ;
        $roomtype->description = $validatedData['description'];
        $roomtype->meta_title = $validatedData['meta_title'];
        $roomtype->meta_keyword = $validatedData['meta_keyword'];
        $roomtype->meta_decription = $validatedData['meta_decription'];
        $roomtype->is_active =  $request->is_active == true ? '1':'0';
        $roomtype->created_by = $validatedData['created_by'];
        $roomtype->save();

        return redirect('admin/roomtype')->with('message','Congratulations! New Room Type Has Been Created Successfully.');
    }

    public function edit(Roomtype $roomtype)
    {
        return view('admin.roomtype.edit', compact('roomtype'));
    }

    public function update(RoomtypeFormRequest $request, $roomtype)
    {
        $validatedData = $request->validated();
        
        $roomtype = Roomtype::findOrFail($roomtype);

        $roomtype->name = $validatedData['name'];
        $roomtype->slug = Str::slug($validatedData['slug']);
        $roomtype->description = $validatedData['description'];
        $roomtype->meta_title = $validatedData['meta_title'];
        $roomtype->meta_keyword = $validatedData['meta_keyword'];
        $roomtype->meta_decription = $validatedData['meta_decription'];
        $roomtype->is_active = $request->is_active == true ? '1':'0'; 
        $roomtype->updated_by = $validatedData['updated_by'];
        $roomtype->update();

        return redirect('admin/roomtype')->with('message','Congratulations! Room Type Has Been Updated Successfully.');
    }
}
