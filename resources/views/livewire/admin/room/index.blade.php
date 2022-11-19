<div class="card">
    <div class="card-header">
        <h4 class="card-title">Room Table</h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-responsive-sm">
                <thead class="text-center bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Room View</th>
                        <th>Facilities</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($rooms as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->slug }}</td>
                        <td>
                            @if($room->roomViews)
                            @forelse ($room->roomViews as $roomView)
                            <span class="badge badge-pill badge-primary">{{ $roomView->name }}</span>                                            
                            @empty
                                <small class="text-danger">No Views Added!</small>
                            @endforelse
                            @endif
                        </td>
                        <td>
                            @if($room->facilities)
                            @forelse ($room->facilities as $facility)
                                <div class="room-facilities" data-toggle="tooltip" data-placement="top" title="{{ $facility->name }}">
                                @if ($facility->image != null)
                                    <img src="{{ asset('uploads/facilities/'.$facility->image) }}">
                                @endif
                                </div>                                           
                            @empty
                                <small class="text-danger">No Facilities Added!</small>
                            @endforelse
                            @endif
                        </td>
                        <td>{{ $room->quantity }}</td>
                        <td>{{ $room->price }}</td>
                        <td>
                            @if ($room->is_active == '1')
                                <span class="badge badge-success text-white">Active</span>
                            @else
                                <span class="badge badge-danger">Deactive</span>
                            @endif
                        </td>
                        <td>
                            <span data-toggle="tooltip" data-placement="top" title="Edit">
                                <a href="{{ url('admin/room/edit/'.$room->id) }}" class="btn btn-icon btn-square btn-outline-warning list-button"><i class="fa fa-pencil-square-o"></i></a>
                            </span>
                            <span data-toggle="tooltip" data-placement="top" title="Delete">
                                <a href="#" wire:click="deleteRecord({{ $room->id }})" class="btn btn-icon btn-square btn-outline-danger list-button" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o"></i></a>
                            </span>
                            @include('modal.admin.delete')
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <h4 class="mb-0">{{ __('No Records Available!') }}</h4>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-section">
            {{ $rooms->links() }}
        </div>
    </div>
</div>