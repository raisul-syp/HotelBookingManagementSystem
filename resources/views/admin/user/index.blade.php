@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h2 class="page-header-title">{{ __('User List') }}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('Users') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('User List') }}</a></li>
                </ol>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a href="{{ url('admin/user/create') }}" class="btn btn-success text-white mr-1">{{ __('Add User') }}</a>
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
                    <h4 class="card-title">Room Table</h4>
                </div>
            
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm">
                            <thead class="text-center bg-primary text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Date Of Birth</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        @if ($user->userImages)
                                        <img src="{{ asset('uploads/users/profilePhoto/'.$user->userImages->profile_photo) }}" alt="{{ $user->first_name }}" class="user-list-img">
                                        @else
                                        <img src="{{ asset('admin/images/no-photo.png') }}" alt="No Image Found" class="user-list-img">
                                        @endif
                                    </td>
                                    <td>{{ $user->first_name.' '.$user->last_name }}</td>
                                    <td>
                                        @if ($user->role_as == '0')
                                        <span class="text-primary text-uppercase font-weight-bold">Admin</span>
                                        @else
                                        <span class="text-success text-uppercase font-weight-bold">Staff</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->userDetails)
                                        {{ $user->userDetails->date_of_birth}}
                                        @else
                                        <small class="text-danger">No Data</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->userDetails)
                                        {{ $user->userDetails->gender}}
                                        @else
                                        <small class="text-danger">No Data</small>
                                        @endif
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->userDetails)
                                        {{ $user->userDetails->phone}}
                                        @else
                                        <small class="text-danger">No Data</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->is_active == '1')
                                            <span class="badge badge-success text-white">Active</span>
                                        @else
                                            <span class="badge badge-danger">Deactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span data-toggle="tooltip" data-placement="top" title="Edit">
                                            <a href="{{ url('admin/user/edit/'.$user->id) }}" class="btn btn-icon btn-square btn-outline-warning list-button"><i class="fa fa-pencil-square-o"></i></a>
                                        </span>
                                        <span data-toggle="tooltip" data-placement="top" title="Change Password">
                                            <a href="{{ url('admin/user/changepassword/'.$user->id) }}" class="btn btn-icon btn-square btn-outline-info list-button"><i class="fa fa-key"></i></a>
                                        </span>
                                        <span data-toggle="tooltip" data-placement="top" title="Delete">
                                            <a href="#" wire:click="deleteRecord({{ $user->id }})" class="btn btn-icon btn-square btn-outline-danger list-button" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o"></i></a>
                                        </span>
                                        @include('modal.admin.delete')
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9">
                                        <h4 class="mb-0">{{ __('No Records Available!') }}</h4>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
            
                    {{-- <div class="pagination-section">
                        {{ $rooms->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
