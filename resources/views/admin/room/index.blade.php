@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h2 class="page-header-title">{{ __('Room List') }}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('Rooms') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('Room List') }}</a></li>
                </ol>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a href="{{ url('admin/room/create') }}" class="btn btn-success text-white mr-1">{{ __('Add Room') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            @if (session('message'))
                @include('alertMessage.admin.success')
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
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
                                    <th>Name</th>
                                    <th>Slug</th>
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
                                    {{-- <td>
                                        @if ($facility->image != null)
                                            <img src="{{ asset('uploads/facilities/'.$facility->image) }}" class="data-table-image">
                                        @endif
                                    </td> --}}
                                    <td>{{ $room->name }}</td>
                                    <td>{{ $room->slug }}</td>
                                    <td>
                                        @if ($room->facility)
                                            {{ $room->facility->name }}
                                        @else
                                            No Category                                
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
                                        <span>
                                            <a href="{{ url('admin/room/edit/'.$room->id) }}" class="btn btn-square btn-outline-warning">Edit</a>
                                        </span>
                                        <span>
                                            <a href="#" wire:click="deleteRecord({{ $room->id }})" class="btn btn-square btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Delete</a>
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
                        {{-- {{ $rooms->links() }} --}}
                    </div>
                </div>
            </div>
            {{-- <livewire:admin.room.index /> --}}
        </div>
    </div>
</div>
@endsection