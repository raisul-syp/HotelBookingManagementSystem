@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h2 class="page-header-title">{{ __('Edit User') }}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('Users') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('Edit User') }}</a></li>
                </ol>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a href="{{ url('admin/user') }}" class="btn btn-dark text-white">{{ __('Back To List') }}</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    @include('alertMessage.admin.error')
                @endforeach
            @endif
        </div>
    </div>

    <form action="{{ url('admin/user/edit/'.$user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="form-title">
                            <h4>{{ __('User Details') }}</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="first_name">
                                        {{ __('First Name') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" placeholder="Add first name...">
                                    @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="last_name">
                                        {{ __('Last Name') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" placeholder="Add last name...">
                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="email">
                                        {{ __('Email') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email ?? '' }}" placeholder="Add email address">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="phone">
                                        {{ __('Phone Number') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->userDetails->phone ?? '' }}" placeholder="Add phone number">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="role_as">
                                        {{ __('User Role') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <select class="form-control js-basic-single" name="role_as" id="role_as">
                                        <option selected disabled>-- Select Role --</option>
                                        <option value="0" {{ old('role_as', $user->role_as) == '0' ? 'selected' : '' }}>Admin</option>
                                        <option value="1" {{ old('role_as', $user->role_as) == '1' ? 'selected' : '' }}>Staff</option>
                                    </select>
                                    @error('role_as')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="gender">
                                        {{ __('Gender') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <select class="form-control js-basic-single" name="gender" id="gender">
                                        <option selected disabled>-- Select Gender --</option>
                                        @if ($user->userDetails)
                                        <option value="Male" {{ old('gender', $user->userDetails->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $user->userDetails->gender) == 'Female' ? 'selected' : '' }}>Female</option>    
                                        @else
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>                                            
                                        @endif
                                    </select>
                                    @error('gender')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label" for="date_of_birth">
                                        {{ __('Date Of Birth') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $user->userDetails->date_of_birth ?? '' }}">
                                    @error('date_of_birth')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="address">
                                        {{ __('Address') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->userDetails->address ?? '' }}" placeholder="Add address">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-label" for="city">
                                        {{ __('City') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ $user->userDetails->city ?? '' }}" placeholder="Add city">
                                    @error('city')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-label" for="state">
                                        {{ __('State') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{ $user->userDetails->state ?? '' }}" placeholder="Add state">
                                    @error('state')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-label" for="postal_code">
                                        {{ __('Postal Code') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="number" class="form-control" id="postal_code" name="postal_code" value="{{ $user->userDetails->postal_code ?? '' }}" placeholder="Add postal code">
                                    @error('postal_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-label" for="country">
                                        {{ __('Country') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <select class="form-control js-basic-single" name="country" id="country">
                                        <option selected disabled>-- Select Country --</option>
                                        @if ($user->userDetails)
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->country_name }}" {{ old('country', $user->userDetails->country) == $country->country_name ? 'selected' : '' }}>{{ $country->country_name.' ('.$country->code.')' }}</option>
                                            @endforeach
                                        @else                                        
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->country_name }}">{{ $country->country_name.' ('.$country->code.')' }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('country')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="admin_comment">
                                        {{ __('Admin Comment') }}
                                    </label>
                                    <textarea class="form-control" id="admin_comment" name="admin_comment" rows="4" placeholder="Add admin comment">{{ $user->userDetails->admin_comment ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="form-title">
                            <h4>{{ __('User Images') }}</h4>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="profile_photo">
                                        {{ __('Profile Photo') }}
                                    </label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="profile_photo" name="profile_photo">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    <div class="user-image-preview">
                                        {{-- <img src="{{ asset('uploads/users/profilePhoto/'.$user->userImages->profile_photo) }}" alt=""> --}}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="cover_photo">
                                        {{ __('Cover Photo') }}
                                    </label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="cover_photo" name="cover_photo">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    <div class="user-image-preview">
                                        {{-- <img src="{{ asset('uploads/users/coverPhoto/'.$user->userImages->cover_photo) }}" alt=""> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group row mb-0">
                                    <div class="col-sm-3 col-form-label text-right" for="is_active">{{ __('Active Status') }}</div>
                                    <div class="col-sm-9">
                                        <label class="switch switch-square">
                                            <input type="checkbox" class="switch-input" id="is_active" name="is_active" {{ $user->is_active == '1' ? 'checked':'' }}>
                                            <span class="switch-toggle-slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="text" hidden id="updated_by" name="updated_by" value="{{ Auth::user()->role_as }}">

                        <div class="row">
                            <div class="cl-lg-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary text-uppercase text-right">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
