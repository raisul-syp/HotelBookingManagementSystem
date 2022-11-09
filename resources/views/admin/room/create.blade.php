@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h2 class="page-header-title">{{ __('Create A New Room') }}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('Rooms') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('Add Room') }}</a></li>
                </ol>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a href="{{ url('admin/room') }}" class="btn btn-dark text-white">{{ __('Back To List') }}</a>
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

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ url('admin/room') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="form-title">
                            <h4>{{ __('Room Form') }}</h4>
                        </div>
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#room_info">
                                    <span>
                                        <strong>
                                            <i class="ti-info"></i>
                                            <span class="ml-2">{{ __('Room Info') }}</span>
                                        </strong>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#room_facility">
                                    <span>
                                        <strong>
                                            <i class="ti-info"></i>
                                            <span class="ml-2">{{ __('Facilities') }}</span>
                                        </strong>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#room_image">
                                    <span>
                                        <strong>
                                            <i class="ti-image"></i>
                                            <span class="ml-2">{{ __('Images') }}</span>
                                        </strong>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#room_seo">
                                    <span>
                                        <strong>
                                            <i class="ti-search"></i>
                                            <span class="ml-2">{{ __('SEO') }}</span>
                                        </strong>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane fade active show" id="room_info" role="tabpanel">
                                {{-- <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right" for="roomtype_id">
                                        {{ __('Room Type') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-10 selects-contant">
                                        <select class="form-control js-basic-single" name="roomtype_id" id="roomtype_id">
                                            @foreach ($roomtypes as $roomtype)
                                            <option value="{{ $roomtype->id }}">{{ $roomtype->name }}</option>                                                
                                            @endforeach
                                        </select>                 
                                        @error('roomtype_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right" for="name">
                                        {{ __('Name') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Add Name...">                        
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right" for="slug">
                                        {{ __('Slug') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Add Slug...">                        
                                        @error('slug')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right" for="short_description">
                                        {{ __('Short Description') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="short_description" name="short_description" rows="3" placeholder="Add Short Description..."></textarea>               
                                        @error('short_description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right" for="long_description">{{ __('Long Description') }}</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="long_description" name="long_description" rows="5" placeholder="Add Long Description..."></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right" for="quantity">{{ __('Quantity') }}</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Add Quantity...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right" for="price">{{ __('Price') }}</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="price" name="price" placeholder="Add Price...">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-2 col-form-label text-right" for="is_active">{{ __('Status') }}</div>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="room_facility" role="tabpanel">
                                <div class="form-group row mb-0">
                                    <div class="col-sm-2 col-form-label text-right" for="facilities">
                                        {{ __('Facility') }}
                                    </div>
                                    <div class="col-sm-10">
                                        @forelse ($facilities as $facilityItem)
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" name="facilities[]" value="{{ $facilityItem->id }}">
                                            <label class="form-check-label">{{ $facilityItem->name }}</label>
                                        </div> 
                                        @empty
                                        <h6>No Facilities Found!</h6>
                                        @endforelse
                                    </div>
                                </div>


                                
                                {{-- <div class="form-group row mb-0">
                                    <div class="col-sm-2 col-form-label text-right" for="room_facility">
                                        {{ __('Facility') }}
                                    </div>
                                    <div class="col-sm-10">
                                        @forelse ($facilities as $facilityItem)
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" name="room_facility[]" id="room_facility{{ $facilityItem->id }}" value="{{ $facilityItem->id }}">
                                            <label class="form-check-label" for="room_facility{{ $facilityItem->id }}">{{ $facilityItem->name }}</label>
                                        </div> 
                                        @empty
                                        <h6>No Facilities Found!</h6>
                                        @endforelse
                                    </div>
                                </div> --}}
                            </div>
                            <div class="tab-pane fade" id="room_image" role="tabpanel">
                                <div class="form-group row mb-0">
                                    <div class="col-sm-2 col-form-label text-right" for="image">{{ __('Image') }}</div>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image[]" multiple>
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="room_seo" role="tabpanel">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right" for="meta_title">
                                        {{ __('Meta Title') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Add Meta Title...">                        
                                        @error('meta_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label text-right" for="meta_keyword">
                                        {{ __('Meta Keyword') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Add Meta Keyword...">                        
                                        @error('meta_keyword')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-sm-2 col-form-label text-right" for="meta_decription">{{ __('Meta Decription') }}</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="meta_decription" name="meta_decription" rows="4" placeholder="Add Meta Description..."></textarea>
                                    </div>
                                </div>
                                
                                <input type="text" hidden id="created_by" name="created_by" value="{{ Auth::user()->role_as }}">  
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary text-uppercase text-right">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection