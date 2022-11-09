@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h2 class="page-header-title">{{ __('Room Type List') }}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('Room Type') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('Room Type List') }}</a></li>
                </ol>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a href="{{ url('admin/roomtype/create') }}" class="btn btn-success text-white ml-1">{{ __('Add Room Type') }}</a>
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
                    <h4 class="card-title">Room Type Table</h4>
                </div>
                
                <div class="card-body">
                
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-responsive-sm">
                                <thead class="text-center bg-primary text-white">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($roomtypes as $roomtype)
                                    <tr>
                                        <td>{{ $roomtype->id }}</td>
                                        <td>{{ $roomtype->name }}</td>
                                        <td>{{ $roomtype->slug }}</td>
                                        <td>
                                            @if ($roomtype->is_active == '1')
                                                <span class="badge badge-success text-white">Active</span>
                                            @else
                                                <span class="badge badge-danger">Deactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span>
                                                <a href="{{ url('admin/roomtype/edit/'.$roomtype->id) }}" class="btn btn-square btn-outline-warning">Edit</a>
                                            </span>
                                            <span>
                                                <a href="#" wire:click="deleteRecord({{ $roomtype->id }})" class="btn btn-square btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Delete</a>
                                            </span>
                                            @include('modal.admin.delete')
                                        </td>
                                    </tr>                        
                                    @empty
                                    <tr>
                                        <td colspan="5">
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