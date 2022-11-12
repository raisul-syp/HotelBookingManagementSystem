<?php

namespace App\Http\Livewire\Admin\Roomtype;

use App\Models\Roomtype;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $roomtype_id;

    public function deleteRecord($roomtype_id)
    {
        $this->roomtype_id = $roomtype_id;
    }

    public function destroyRecord()
    {
        $roomtype =  Roomtype::find($this->roomtype_id);
        // $path = 'uploads/facilities/'.$facility->image;
        // if(File::exists($path)){
        //     File::delete($path);
        // }
        // $facility->delete();
        $roomtype->is_delete = '0';
        $roomtype->update();
        // session()->flash('message','Facility Has Been Deleted Successfully.');
        return redirect('admin/roomtype')->with('message','Room Type Has Been Deleted Successfully.');
        $this->dispatchBrowserEvent('close-modal');
    }
    
    public function render()
    {
        $roomtypes = Roomtype::where('is_delete','1')->orderBy('id','ASC')->paginate(10);
        return view('livewire.admin.roomtype.index',['roomtypes' => $roomtypes]);
    }
}
