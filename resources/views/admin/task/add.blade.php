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
                                    <form method="post" action="{{ route('task.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')

                                        <input type="hidden" name="assigned_by" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">

                                        <div class="info layout-spacing">
                                            <div class="card p-3">
                                                <h6 class="mb-3">Task Information</h6>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Task Name<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="name" class="form-control"
                                                                value="{{ old('name') }}">

                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Project<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="project_id" id="project_id"
                                                                class="form-control project_id">
                                                                <option value="">Select</option>
                                                                @foreach ($projectList as $pList)
                                                                    <option value="{{ $pList->id }}"
                                                                        {{ old('project_id') == $pList->id ? 'selected' : '' }}>
                                                                        {{ $pList->name }}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('project_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Assign To<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="assigned_to" id="assigned_to"
                                                                class="form-control assigned_to">
                                                                <option value="">Select</option>
                                                                @foreach ($userList as $uList)
                                                                    <option value="{{ $uList->id }}"
                                                                        {{ old('assigned_to') == $uList->id ? 'selected' : '' }}>
                                                                        {{ $uList->name }}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('assigned_to')
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
                                                                            {{ old('status') == $pstatus['value'] ? 'selected' : '' }}>
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
                                                                            {{ old('priority') == $ppriority['value'] ? 'selected' : '' }}>
                                                                            {{ $ppriority['name'] }}</option>
                                                                    @endforeach
                                                                </select>

                                                                @error('priority')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label for="">Start Date<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="datetime-local" name="start_date_time"
                                                                class="form-control"
                                                                value="{{ old('start_date_time') }}">

                                                            @error('start_date_time')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Due Date<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="datetime-local" name="end_date_time"
                                                                class="form-control" value="{{ old('end_date_time') }}">

                                                            @error('end_date_time')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="tel-text">Billable</label><br>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input_" type="radio"
                                                                    name="billable" id="flexRadioDefault1"
                                                                    value="1">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    Yes
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input_" type="radio"
                                                                    name="billable" id="flexRadioDefault2"
                                                                    value="0">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    No
                                                                </label>
                                                            </div>

                                                            @error('is_active')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">File</label>
                                                            <input type="file" multiple class="form-control"
                                                                name="file[]">

                                                            @error('file')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                            <div class="instructions mt-2">
                                                                @foreach (config('site.project_instructions') as $key => $value)
                                                                    <strong
                                                                        class="text-danger">{{ $value }}</strong><br>
                                                                @endforeach
                                                            </div>
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
                                                        <label for="">Description</label>
                                                        <textarea name="description" id="objectiveEditor" class="form-control">{{ old('description') }}</textarea>

                                                        @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Notes</label>
                                                        <textarea name="notes" id="notesEditor" class="form-control">{{ old('notes') }}</textarea>

                                                        @error('notes')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Remarks</label>
                                                        <textarea name="remarks" id="remarksEditor" class="form-control">{{ old('remarks') }}</textarea>

                                                        @error('remarks')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary InFormSubmitBtn" type="submit">Create</button>
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
            $('.project_id,.assigned_to').select2();
        });
    </script>
@endsection('javascript')
