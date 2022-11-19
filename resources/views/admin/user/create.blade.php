@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h2 class="page-header-title">{{ __('Creat A New User') }}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('Users') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('Create User') }}</a></li>
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

    <form action="{{ url('admin/user') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Add first name...">
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
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Add last name...">
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
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Add email address">
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
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Add phone number">
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
                                        <option value="0">Admin</option>
                                        <option value="1">Staff</option>
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
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
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
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
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
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Add address">
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
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Add city">
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
                                    <input type="text" class="form-control" id="state" name="state" placeholder="Add state">
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
                                    <input type="number" class="form-control" id="postal_code" name="postal_code" placeholder="Add postal code">
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
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->country_name }}">{{ $country->country_name.' ('.$country->code.')' }}</option>
                                        @endforeach
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
                                    <textarea class="form-control" id="admin_comment" name="admin_comment" rows="4" placeholder="Add admin comment"></textarea>
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
                                            <input type="checkbox" class="switch-input" id="is_active" name="is_active" checked>
                                            <span class="switch-toggle-slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="text" hidden id="created_by" name="created_by" value="{{ Auth::user()->role_as }}">
                    </div>
                </div>


                
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="form-title">
                            <h4>{{ __('Password') }}</h4>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="password">
                                        {{ __('Password') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">                                    
                                    <label for="password-confirm">
                                        {{ __('Confirm Password') }}
                                    </label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="cl-lg-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary text-uppercase">
                                        {{ __('Create') }}
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
