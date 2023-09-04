@extends('admin.layouts.master')

@section('content')
    <!--  BEGIN CUSTOM STYLE FILE  -->

    <link href="{{ url('assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ url('assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="../src/assets/css/dark/users/account-setting.css" rel="stylesheet" type="text/css" />


    <!--  END CUSTOM STYLE FILE  -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ url('plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('plugins/src/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
    <!-- END THEME GLOBAL STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ url('assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ url('assets/css/dark/scrollspyNav.css" rel="stylesheet') }}" type="text/css" />
    <link href="{{ url('plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <!--  END CUSTOM STYLE FILE  -->

    <style>
        h6 {
            font-weight: bolder
        }

        #profile_image {

            opacity: 0 !important;

        }

        #new_profile_image {

            cursor: pointer !important;

        }

        .image-upload {

            margin: auto;

            position: relative;

            width: 120px;

        }

        .image-upload input {

            cursor: pointer;

            display: block;

            height: 120px;

            opacity: 0;

            position: absolute;

            top: 0;

            width: 120px;

            z-index: 100;

        }

        .image-upload img {

            border-radius: 50%;

            height: 120px;

            object-fit: cover;

            width: 120px;

        }

        .overlay-text {

            align-items: center;

            background: rgba(0, 0, 0, 0.5);
            /* Black see-through */

            border-radius: 50%;

            bottom: 0;

            color: white;

            display: flex;

            flex-direction: column;

            justify-content: center;

            height: 120px;

            margin: 0;

            opacity: 0;

            position: absolute;

            text-align: center;

            text-transform: uppercase;

            transition: .5s ease;

            width: 120px;

        }

        .overlay-text i {

            font-size: 23px;

        }

        .overlay-text b {

            font-family: 'Rubik Regular', Helvetica, sans-serif;

            font-size: 13px;

            font-weight: 500;

            margin-top: 10px;

        }

        .image-upload:hover .overlay-text {

            opacity: 1;

        }
    </style>

    <div id="content" class="main-content">

        <div class="layout-px-spacing">
            <div class="middle-content container-xxl p-0">
                <div class="account-settings-container layout-top-spacing">
                    <div class="tab-content" id="animateLineContent-4">
                        <div class="tab-pane fade show active" id="animated-underline-profile" role="tabpanel"
                            aria-labelledby="animated-underline-profile-tab">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form method="post" action="{{ route('project.update', $project->id) }}">
                                        @csrf
                                        @method('put')

                                        <div class="info layout-spacing">
                                            <div class="card p-3">
                                                <h6 class="mb-3">Project Information</h6>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Project Name<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="name" class="form-control"
                                                                value="{{ old('name', $project->name) }}">

                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Client<span
                                                                    class="text-danger">*</span></label>
                                                                <select class="client_id form-control" name="client_id">
                                                                <option value="">Select</option>
                                                                @foreach ($clientList as $client)
                                                                    <option value="{{ $client->id }}"
                                                                        {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>
                                                                        {{ $client->name }}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('client_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="">Status<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="status" id="" class="form-control">
                                                                    <option value="">Select</option>
                                                                    @foreach (config('site.project_status') as $pstatus)
                                                                        <option value="{{ $pstatus['value'] }}"
                                                                            {{ old('status', $project->status) == $pstatus['value'] ? 'selected' : '' }}>
                                                                            {{ $pstatus['name'] }}</option>
                                                                    @endforeach
                                                                </select>

                                                                @error('status')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">Priority<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="priority" id="" class="form-control">
                                                                    <option value="">Select</option>
                                                                    @foreach (config('site.priority') as $ppriority)
                                                                        <option value="{{ $ppriority['value'] }}"
                                                                            {{ old('priority', $project->priority) == $ppriority['value'] ? 'selected' : '' }}>
                                                                            {{ $ppriority['name'] }}</option>
                                                                    @endforeach
                                                                </select>

                                                                @error('priority')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Type<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="type" id="" class="form-control">
                                                                <option value="">Select</option>
                                                                @foreach (config('site.project_type') as $ptype)
                                                                    <option value="{{ $ptype['value'] }}"
                                                                        {{ old('type', $project->type) == $ptype['value'] ? 'selected' : '' }}>
                                                                        {{ $ptype['name'] }}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('type')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label for="">Members<span
                                                                    class="text-danger">*</span></label>
                                                            <select class="members form-control" name="members[]"
                                                                multiple="multiple">
                                                                <option value="">Select</option>
                                                                @foreach ($userList as $key => $value)
                                                                    <option value="{{ $value->id }}"
                                                                        {{ $project['members'] && in_array($value->id, $project['members']->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                                        {{ $value->name }}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('members')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Start Date<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" name="start_date" class="form-control"
                                                                value="{{ old('start_date', $project->start_date) }}">

                                                            @error('start_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Due Date<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" name="due_date" class="form-control"
                                                                value="{{ old('due_date', $project->due_date) }}">

                                                            @error('due_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="info_two layout-spacing">
                                            <div class="card p-3">
                                                <h6 class="mb-3"></h6>

                                                <div class="row">

                                                    <div class="form-group">
                                                        <label for="">Objective</label>
                                                        <textarea name="objective" id="objectiveEditor" class="form-control">{{ old('objective', $project->objective) }}</textarea>

                                                        @error('objective')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Notes</label>
                                                        <textarea name="notes" id="notesEditor" class="form-control">{{ old('notes', $project->notes) }}</textarea>

                                                        @error('notes')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Remarks</label>
                                                        <textarea name="remarks" id="remarksEditor" class="form-control">{{ old('remarks', $project->remarks) }}</textarea>

                                                        @error('remarks')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Credentials</label>
                                                        <textarea name="credentials" id="credentialsEditor" class="form-control">{{ old('credentials', $project->credentials) }}</textarea>

                                                        @error('credentials')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">URL</label>
                                                        <input type="text" class="form-control" name="url"
                                                            value="{{ old('url', $project->url) }}">

                                                        @error('url')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary InFormSubmitBtn" type="submit">Update</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

@section('javascript')
    <script src="{{ url('assets/js/users/account-settings.js') }}"></script>
    <script src="{{ url('plugins/src/flatpickr/flatpickr.js') }}"></script>

    <script src="{{ url('plugins/src/flatpickr/custom-flatpickr.js') }}"></script>


    <script>
        $(document).ready(function() {

            $('.members,.client_id').select2();
        });
    </script>
@endsection('javascript')
