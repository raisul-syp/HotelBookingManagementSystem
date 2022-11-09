<?php

namespace App\Http\Livewire\Admin\Facility;

use Livewire\Component;
use App\Models\Facility;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $facility_id;

    public function deleteRecord($facility_id)
    {
        $this->facility_id = $facility_id;
    }

    public function destroyRecord()
    {
        $facility =  Facility::find($this->facility_id);
        // $path = 'uploads/facilities/'.$facility->image;
        // if(File::exists($path)){
        //     File::delete($path);
        // }
        // $facility->delete();
        $facility->is_delete = '0';
        $facility->update();
        // session()->flash('message','Facility Has Been Deleted Successfully.');
        return redirect('admin/facility')->with('message','Facility Has Been Deleted Successfully.');
        $this->dispatchBrowserEvent('close-modal');
    }
    
    public function render()
    {
        $facilities = Facility::where('is_delete','1')->orderBy('id','ASC')->paginate(10);
        return view('livewire.admin.facility.index',['facilities' => $facilities]);
    }
}
