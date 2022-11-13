<?php

namespace App\Http\Livewire\Admin\Room;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $room_id;

    public function deleteRecord($room_id)
    {
        $this->room_id = $room_id;
    }

    public function destroyRecord()
    {
        $room =  Room::find($this->room_id);
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
    
    public function render()
    {
        $rooms = Room::where('is_delete','1')->orderBy('id','ASC')->paginate(10);
        return view('livewire.admin.room.index',['rooms' => $rooms]);
    }
}
