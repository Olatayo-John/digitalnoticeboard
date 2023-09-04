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
                                                                    {{ strtoupper(substr($project->name, 0, 1)) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <div class="text-muted">
                                                                <h5 class="font-size-16 mb-1">{{ $project->name }}</h5>
                                                                <p class="mb-0">{{ $project->client->name }}</p>
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
                                                                    href="{{ route('project.edit', $project->id) }}">
                                                                    Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form method="post"
                                                                    action="{{ route('project.destroy', $project->id) }}"
                                                                    class="deleteProjectForm dropdown-item p-0">
                                                                    @csrf @method('delete')
                                                                    <button class="btn- InFormDeleteBtn"
                                                                        formClass="deleteProjectForm">
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
                                                                    @if ($project->status === $value['value'])
                                                                        <span class="badge {{ $value['class'] }} p-1">
                                                                            {{ $value['name'] }}
                                                                        </span>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li class="py-1">
                                                                @foreach (config('site.priority') as $key => $value)
                                                                    @if ($project->priority === $value['value'])
                                                                        <span
                                                                            class="{{ $value['class'] }} font-weight-bolder">
                                                                            {{ $value['name'] }}
                                                                        </span>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li class="py-1">
                                                                @if ($project->type === '1')
                                                                    Testing
                                                                @elseif ($project->type === '2')
                                                                    Production
                                                                @endif
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
                                                                    <p class="text-muted mb-0">{{ $project->start_date }}
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
                                                                    <p class="text-muted mb-0">{{ $project->due_date }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end row -->
                                                </div>
                                            </div>

                                            <div class="">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-0 font-size-14">
                                                        Created By</h5>

                                                    <p class="text-muted mb-1 font-size-13">
                                                        {{ $project->createdBy->name }}
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
                                                        <a class="nav-link" data-bs-toggle="tab" href="#tasks"
                                                            role="tab">Tasks</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#team"
                                                            role="tab">Members</a>
                                                    </li>
                                                    {{-- <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#activities"
                                                            role="tab">Activities</a>
                                                    </li> --}}
                                                </ul>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-content">

                                        {{-- overview --}}
                                        <div class="tab-pane active" id="overview" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">

                                                    <div class="row pb-3">
                                                        <div class="col-xl-3 col-sm-6">
                                                            <div class="card shadow-none">
                                                                <div class="card-body">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-grow-1 overflow-hidden">
                                                                            <p class="mb-1 text-truncate text-muted">Total
                                                                                Tasks</p>
                                                                            <h5 class="font-size-16 mb-0">
                                                                                {{ count($project->tasks) }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-3 col-sm-6">
                                                            <div class="card shadow-none">
                                                                <div class="card-body">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-grow-1 overflow-hidden">
                                                                            <p class="mb-1 text-truncate text-muted">
                                                                                Members</p>
                                                                            <h5 class="font-size-16 mb-0">
                                                                                {{ count($project->members) }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card border_shadow-none h-100 mb-lg-0">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-4">Objective</h5>

                                                            <div class="text-muted">
                                                                <P>{{ $project->objective }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card border_shadow-none h-100 mb-lg-0">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-4">Notes</h5>

                                                            <div class="text-muted">
                                                                <P>{{ $project->notes }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card border_shadow-none h-100 mb-lg-0">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-4">Remarks</h5>

                                                            <div class="text-muted">
                                                                <P>{{ $project->remarks }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card border_shadow-none h-100 mb-lg-0">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-4">URL</h5>

                                                            <div class="text-muted">
                                                                <P>{{ $project->url }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card border_shadow-none h-100 mb-lg-0">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-4">Credentials</h5>

                                                            <div class="text-muted">
                                                                <P>{{ $project->credentials }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- tasks --}}
                                        <div class="tab-pane" id="tasks" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body pt-0">
                                                    <table id="projectTaskTable"
                                                        class="table table-striped dt-table-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Task</th>
                                                                <th>Assignee</th>
                                                                <th>Status</th>
                                                                <th>Priority</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($project->tasks as $pTask)
                                                                <tr>
                                                                    <td>
                                                                        <a href="{{ route('task.show', $pTask->id) }}"
                                                                            class="font-weight-bolder">
                                                                            {{ $pTask->name }}
                                                                        </a>
                                                                        {{-- <p>{{ $pTask->start_date_time }}</p> --}}
                                                                    </td>
                                                                    <td>
                                                                        @if ($pTask->assignedTo)
                                                                            <a
                                                                                href="{{ route('users.show', $pTask->assignedTo->id) }}">
                                                                                {{ $pTask->assignedTo->name }}
                                                                            </a>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @foreach (config('site.project_status') as $key => $value)
                                                                            @if ($pTask->status === $value['value'])
                                                                                <span
                                                                                    class="badge {{ $value['class'] }} p-1">
                                                                                    {{ $value['name'] }}
                                                                                </span>
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                    <td>
                                                                        @foreach (config('site.priority') as $key => $value)
                                                                            @if ($pTask->priority === $value['value'])
                                                                                <span
                                                                                    class="{{ $value['class'] }} font-weight-bolder">
                                                                                    {{ $value['name'] }}
                                                                                </span>
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- team --}}
                                        <div class="tab-pane" id="team" role="tabpanel">
                                            <div>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @foreach ($project['members'] as $key => $value)
                                                                <div class="col-xl-4 col-sm-6">
                                                                    <div class="card shadow-none">
                                                                        <div class="card-body p-4">
                                                                            <div class="d-flex align-items-start">
                                                                                <div
                                                                                    class="flex-shrink-0 avatar rounded-circle me-3">
                                                                                    <img src="{{ $value->profile_image ? asset('storage/' . $value->profile_image) : asset('storage/default/no_image.jpg') }}"
                                                                                        alt=""
                                                                                        class="img-fluid rounded-circle">
                                                                                </div>
                                                                                <div class="flex-grow-1 overflow-hidden">
                                                                                    <h5
                                                                                        class="font-size-15 mb-1 text-truncate">
                                                                                        <a href="{{ route('users.show', $value->id) }}"
                                                                                            class="text-dark">
                                                                                            {{ $value->name }}
                                                                                        </a>
                                                                                    </h5>
                                                                                    <p
                                                                                        class="text-muted text-truncate mb-0">
                                                                                        {{ $value->userDesignation ? $value->userDesignation->name : '' }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="flex-shrink-0">
                                                                                    {{-- @if ($value->id !== 1) --}}
                                                                                    <div class="dropdown">
                                                                                        <a href="#" role="button"
                                                                                            class="dropdown-toggle"
                                                                                            data-bs-toggle="dropdown"
                                                                                            aria-expanded="false">
                                                                                            <i
                                                                                                class="fa-solid fa-ellipsis"></i>
                                                                                        </a>
                                                                                        <ul class="dropdown-menu">
                                                                                            <li>
                                                                                                <form method="post"
                                                                                                    action="{{ route('project.remove-member') }}"
                                                                                                    class="removeProjectMemberForm dropdown-item p-0">
                                                                                                    @csrf
                                                                                                    @method('post')

                                                                                                    <input type="hidden"
                                                                                                        name="member_id"
                                                                                                        value="{{ $value->id }}">
                                                                                                    <input type="hidden"
                                                                                                        name="project_id"
                                                                                                        value="{{ $project->id }}">
                                                                                                    <button
                                                                                                        class="btn- InFormDeleteBtn"
                                                                                                        formClass="removeProjectMemberForm">
                                                                                                        Remove
                                                                                                    </button>
                                                                                                </form>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                    {{-- @endif --}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- activities --}}
                                        <div class="tab-pane" id="activities" role="tabpanel">
                                            <div>
                                                <div class="card">
                                                    <div class="card-body">

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

    </div>
@endsection

@section('javascript')
    <script src="{{ url('assets/js/users/account-settings.js') }}"></script>
    <script src="{{ url('plugins/src/flatpickr/flatpickr.js') }}"></script>

    <script src="{{ url('plugins/src/flatpickr/custom-flatpickr.js') }}"></script>


    <script>
        function readURL(input, container) {

            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {

                    $("#" + container).attr('src', e.target.result);

                }

                reader.readAsDataURL(input.files[0]);

            }

        }



        $('#new_profile_image').click(function() {

            $('#profile_image').click();

        });



        $(function() {

            $("#profile_image").change(function() {

                var ext = $('#profile_image').val().split('.').pop().toLowerCase();

                if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {

                    $('#profile_image').val(null);

                    $('#error_profile_image').text('Only .jpg, .jpeg, .png image allowed.');

                    return false;

                } else {

                    $('#error_profile_image').html('');

                    var path = readURL(this, "new_profile_image");

                }

            });

            var imgsrc = $('#new_profile_image').attr('src');

        });
    </script>
@endsection('javascript')
