<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facility;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\FacilityFormRequest;

class FacilityController extends Controller
{
    public function index()
    {
        return view('admin.facility.index');
    }

    public function create()
    {
        return view('admin.facility.create');
    }

    public function store(FacilityFormRequest $request)
    {
        $validatedData = $request->validated();

        $facility = new Facility;

        $facility->name = $validatedData['name'];
        $facility->slug = Str::slug($validatedData['slug']);
        $facility->description = $validatedData['description'];

        if($request->hasFile('image')){
            $file = $request->file('image');

            $extension = $file->getClientOriginalExtension();
            $filename = $facility->slug.'.'.$extension;
            $file->move('uploads/facilities/',$filename);

            $facility->image = $filename;
        }

        $facility->meta_title = $validatedData['meta_title'];
        $facility->meta_keyword = $validatedData['meta_keyword'];
        $facility->meta_decription = $validatedData['meta_decription'];

        $facility->is_active = $request->is_active == true ? '1':'0';
        
        // $facility->created_by = $validatedData['created_by'];
        // $facility->updated_by = $validatedData['updated_by'];
        $facility->save();

        return redirect('admin/facility')->with('message','Congratulations! New Facility Has Been Created Successfully.');
    }

    public function edit(Facility $facility)
    {
        return view('admin.facility.edit', compact('facility'));
    }

    public function update(FacilityFormRequest $request, $facility)
    {
        $validatedData = $request->validated();
        
        $facility = Facility::findOrFail($facility);

        $facility->name = $validatedData['name'];
        $facility->slug = Str::slug($validatedData['slug']);
        $facility->description = $validatedData['description'];

        // $facility->image = $validatedData['image'];
        if($request->hasFile('image')){
            $path = 'uploads/facilities/'.$facility->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');

            $extension = $file->getClientOriginalExtension();
            $filename = $facility->slug.'.'.$extension;
            $file->move('uploads/facilities/',$filename);

            $facility->image = $filename;
        }

        $facility->meta_title = $validatedData['meta_title'];
        $facility->meta_keyword = $validatedData['meta_keyword'];
        $facility->meta_decription = $validatedData['meta_decription'];

        $facility->is_active = $request->is_active == true ? '1':'0';
        
        // $facility->created_by = $validatedData['created_by'];
        // $facility->updated_by = $validatedData['updated_by'];
        $facility->update();

        return redirect('admin/facility')->with('message','Congratulations! New Facility Has Been Updated Successfully.');
    }
}
