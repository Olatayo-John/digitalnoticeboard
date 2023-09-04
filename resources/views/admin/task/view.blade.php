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
        .profileImageDiv img {
            max-width: 200px;
            max-height: 200px;
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

        .font-size-14 {
            font-size: 14px !important;
        }

        .font-size-18 {
            font-size: 18px;
            margin-right: 10px;
        }

        .list-unstyled .flex-grow-1 {
            display: flex;
            align-items: baseline;
        }

        .list-unstyled .flex-grow-1 p {
            margin-left: 15px;
            width: 70%;
        }

        .list-unstyled .flex-grow-1 h5 {
            width: 30%;
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

                                    <div class="card">
                                        <div class="card-body pb-0">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar">
                                                                <div
                                                                    class="avatar-title bg-primary-subtle text-primary font-size-18 rounded">
                                                                    {{ strtoupper(substr($task->name, 0, 1)) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <div class="text-muted">
                                                                <h5 class="font-size-16 mb-1">{{ $task->name }}</h5>
                                                                <a href="{{ route('project.show', $task->project->id) }}">
                                                                    <p class="mb-0">{{ $task->project->name }}</p>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="dropdown">
                                                        <a href="#" role="button" class="dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('task.edit', $task->id) }}">
                                                                    Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form method="post"
                                                                    action="{{ route('task.destroy', $task->id) }}"
                                                                    class="deleteTaskForm dropdown-item p-0">
                                                                    @csrf @method('delete')
                                                                    <button class="btn- InFormDeleteBtn"
                                                                        formClass="deleteTaskForm">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <div class="mt-3">
                                                        <ul class="text-muted">
                                                            <li class="py-1">
                                                                @foreach (config('site.project_status') as $key => $value)
                                                                    @if ($task->status === $value['value'])
                                                                        <span class="badge {{ $value['class'] }} p-1">
                                                                            {{ $value['name'] }}
                                                                        </span>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li class="py-1">
                                                                @foreach (config('site.priority') as $key => $value)
                                                                    @if ($task->priority === $value['value'])
                                                                        <span
                                                                            class="{{ $value['class'] }} font-weight-bolder">
                                                                            {{ $value['name'] }}
                                                                        </span>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-lg-7">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-sm-6">
                                                            <div class="d-flex align-items-center mt-4">
                                                                <div class="flex-shrink-0 me-3">
                                                                    <i
                                                                        class="uil uil-calendar-alt text-primary font-size-22"></i>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <h5 class="font-size-12 mb-1">Start Date</h5>
                                                                    <p class="text-muted mb-0">{{ $task->start_date_time }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end col -->

                                                        <div class="col-lg-4 col-sm-6">
                                                            <div class="d-flex align-items-center mt-4">
                                                                <div class="flex-shrink-0 me-3">
                                                                    <i
                                                                        class="uil uil-check-circle text-primary font-size-22"></i>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <h5 class="font-size-12 mb-1">Due Date</h5>
                                                                    <p class="text-muted mb-0">{{ $task->end_date_time }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end row -->
                                                </div>
                                            </div>

                                            <div class="">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-0 font-size-14">
                                                        Assigned To</h5>

                                                    <p class="text-muted mb-1 font-size-13">
                                                        {{ $task->assignedTo ? $task->assignedTo->name : '' }}
                                                    </p>
                                                </div>

                                                <div class="flex-grow-1 mt-3">
                                                    <h5 class="mb-0 font-size-14">
                                                        Assigned By</h5>

                                                    <p class="text-muted mb-1 font-size-13">
                                                        {{ $task->assignedBy ? $task->assignedBy->name : '' }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-bs-toggle="tab" href="#overview"
                                                            role="tab">Overview</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#files"
                                                            role="tab">Files</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-content">

                                        <div class="tab-pane active" id="overview" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">

                                                    <div class="card border_shadow-none h-100 mb-lg-0">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-4">Description</h5>

                                                            <div class="text-muted">
                                                                <P>{{ $task->description }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card border_shadow-none h-100 mb-lg-0">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-4">Notes</h5>

                                                            <div class="text-muted">
                                                                <P>{{ $task->notes }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card border_shadow-none h-100 mb-lg-0">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-4">Remarks</h5>

                                                            <div class="text-muted">
                                                                <P>{{ $task->remarks }}</p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="files" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body row">
                                                    @if ($task->file)
                                                        @php
                                                            $allFiles = explode(',', $task->file);
                                                        @endphp

                                                        @foreach ($allFiles as $key => $value)
                                                            @if ($value)
                                                                <div class="d-flex col-md-2 mb-4" style="flex-direction: column;text-align: center">
                                                                    <a href="{{ Storage::url($value) }}" target="_blank"
                                                                        class="fileLink">
                                                                        @if (Str::endsWith($value, ['pdf']))
                                                                            <i
                                                                                class="fa-solid fa-file-pdf text-danger"></i>
                                                                        @endif

                                                                        @if (Str::endsWith($value, ['xlsx', 'xls']))
                                                                            <i
                                                                                class="fa-solid fa-file-excel text-success"></i>
                                                                        @endif

                                                                        @if (Str::endsWith($value, ['docx', 'doc']))
                                                                            <i
                                                                                class="fa-solid fa-file-word text-primary"></i>
                                                                        @endif

                                                                        @if (Str::endsWith($value, ['jpg', 'jpeg', 'png']))
                                                                            <i
                                                                                class="fa-solid fa-file-image text-dark"></i>
                                                                        @endif

                                                                        @if (Str::endsWith($value, ['txt']))
                                                                            <i class="fa-solid fa-file text-dark"></i>
                                                                        @endif
                                                                    </a>

                                                                    <form method="post" action="{{ route('task.remove-image') }}" class="deleteTaskImageForm">
                                                                        @csrf
                                                                        @method('post')
                                                                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                                        <input type="hidden" name="image" value="{{ $value }}">

                                                                        <button
                                                                            class="btn btn-outline-danger btn-sm btn-block InFormDeleteBtn" formClass="deleteTaskImageForm" type="submit" style="padding: 5px">Delete</button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
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
@endsection('javascript')
