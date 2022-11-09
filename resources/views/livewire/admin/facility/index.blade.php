<div class="card">
    <div class="card-header">
        <h4 class="card-title">Facility Table</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-responsive-sm">
                <thead class="text-center bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($facilities as $facility)
                    <tr>
                        <td>{{ $facility->id }}</td>
                        <td>
                            @if ($facility->image != null)
                                <img src="{{ asset('uploads/facilities/'.$facility->image) }}" class="data-table-image">
                            @endif
                        </td>
                        <td>{{ $facility->name }}</td>
                        <td>{{ $facility->slug }}</td>
                        <td>
                            @if ($facility->is_active == '1')
                                <span class="badge badge-success text-white">Active</span>
                            @else
                                <span class="badge badge-danger">Deactive</span>
                            @endif
                        </td>
                        <td>
                            <span>
                                <a href="{{ url('admin/facility/edit/'.$facility->id) }}" class="btn btn-square btn-outline-warning">Edit</a>
                            </span>
                            <span>
                                <a href="#" wire:click="deleteRecord({{ $facility->id }})" class="btn btn-square btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Delete</a>
                            </span>
                            @include('modal.admin.delete')
                        </td>
                    </tr>                        
                    @empty
                    <tr>
                        <td colspan="7">
                            <h4 class="mb-0">{{ __('No Records Available!') }}</h4>
                        </td>
                    </tr>                        
                    @endforelse

                    {{-- @foreach ($facilities as $facility)
                        <tr>
                            <td>{{ $facility->id }}</td>
                            <td>
                                @if ($facility->image != null)
                                    <img src="{{ asset('uploads/facilities/'.$facility->image) }}" class="data-table-image">
                                @endif
                            </td>
                            <td>{{ $facility->name }}</td>
                            <td>{{ $facility->slug }}</td>
                            <td>
                                @if ($facility->is_active == '1')
                                    <span class="badge badge-success text-white">Active</span>
                                @else
                                    <span class="badge badge-danger">Deactive</span>
                                @endif
                            </td>
                            <td>
                                <span>
                                    <a href="{{ url('admin/facility/edit/'.$facility->id) }}" class="btn btn-square btn-outline-warning">Edit</a>
                                </span>
                                <span>
                                    <a href="#" wire:click="deleteRecord({{ $facility->id }})" class="btn btn-square btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Delete</a>
                                </span>
                                @include('modal.admin.delete')
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <h4>{{ __('No Records Available!') }}</h4>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>

        <div class="pagination-section">
            {{ $facilities->links() }}
        </div>
    </div>
</div>

