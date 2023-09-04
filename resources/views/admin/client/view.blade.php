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
                                <div class="col-12 col-lg-12 col-xl-12 d-flex">
                                    <div class="card w-100 rounded-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <div class="card mt-n5">
                                                            <div class="card-body text-center">

                                                                <div class="profileImageDiv mx-auto mb-4">
                                                                    <img src="{{ $client->profile_image ? asset('storage/' . $client->profile_image) : asset('storage/default/no_image.jpg') }}"
                                                                        alt=""
                                                                        class="rounded-circle img-thumbnail w-50">
                                                                </div>
                                                                <h5 class="mb-1">{{ $client->name }}</h5>



                                                            </div>

                                                        </div>
                                                        <!-- end card -->

                                                        <div class="card mt-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title mb-4">Social Information</h5>

                                                                <div>
                                                                    <ul class="list-unstyled mb-0 text-muted">
                                                                        <li>
                                                                            <div class="d-flex align-items-center py-2">
                                                                                <div class="flex-grow-1">
                                                                                    <i
                                                                                        class="fab fa-linkedin font-size-18"></i>
                                                                                    {{ $client->linkedin }}
                                                                                </div>

                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="d-flex align-items-center py-2">
                                                                                <div class="flex-grow-1">
                                                                                    <i
                                                                                        class="fab fa-slack font-size-18"></i>
                                                                                    {{ $client->slack }}
                                                                                </div>

                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="d-flex align-items-center py-2">
                                                                                <div class="flex-grow-1">
                                                                                    <i
                                                                                        class="fab fa-skype font-size-18"></i>
                                                                                    {{ $client->skype }}
                                                                                </div>

                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!-- end card body -->
                                                        </div>

                                                    </div>
                                                    <!-- end col -->

                                                    <div class="col-xl-8">
                                                        <div class="">
                                                            <div class="row">
                                                                <div class="col-lg-12">

                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title mb-4">Personal Information
                                                                            </h5>

                                                                            <ul class="list-unstyled mb-0">
                                                                                <!-- end li -->
                                                                                <li class="py-1">
                                                                                    <div class="d-flex align-items-center">

                                                                                        <div class="flex-grow-1">
                                                                                            <h5 class="mb-0 font-size-14">
                                                                                                Email</h5>

                                                                                            <p
                                                                                                class="text-muted mb-1 font-size-13">
                                                                                                {{ $client->email }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <!-- end li -->
                                                                                <li class="pt-1">
                                                                                    <div class="d-flex align-items-center">

                                                                                        <div class="flex-grow-1">
                                                                                            <h5 class="mb-0 font-size-14">
                                                                                                Mobile</h5>

                                                                                            <p
                                                                                                class="text-muted mb-1 font-size-13">
                                                                                                {{ $client->mobile }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="pt-1">
                                                                                    <div class="d-flex align-items-center">

                                                                                        <div class="flex-grow-1">
                                                                                            <h5 class="mb-0 font-size-14">
                                                                                                Type</h5>

                                                                                            <p
                                                                                                class="text-muted mb-1 font-size-13">
                                                                                                {{ $client->clientType->name }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <!-- end li -->
                                                                            </ul>
                                                                        </div>
                                                                        <!-- end card body -->
                                                                    </div>
                                                                    <!-- end card -->

                                                                    @if ($client->clientType->name === 'Company')
                                                                        <div class="card mt-3">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title mb-4">Business
                                                                                    Information</h5>

                                                                                <ul class="list-unstyled mb-0">
                                                                                    <li class="pb-1">
                                                                                        <div
                                                                                            class="d-flex align-items-center">

                                                                                            <div class="flex-grow-1">

                                                                                                <h5
                                                                                                    class="mb-0 font-size-14">
                                                                                                    Company Name</h5>

                                                                                                <p
                                                                                                    class="text-muted mb-1 font-size-13">
                                                                                                    {{ $client->company_name }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                    <!-- end li -->
                                                                                    <!-- end li -->
                                                                                    <li class="py-1">
                                                                                        <div
                                                                                            class="d-flex align-items-center">

                                                                                            <div class="flex-grow-1">
                                                                                                <h5
                                                                                                    class="mb-0 font-size-14">
                                                                                                    Company Country</h5>

                                                                                                <p
                                                                                                    class="text-muted mb-1 font-size-13">
                                                                                                    {{ $client->company_country }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                    <!-- end li -->
                                                                                    <li class="pt-1">
                                                                                        <div
                                                                                            class="d-flex align-items-center">

                                                                                            <div class="flex-grow-1">
                                                                                                <h5
                                                                                                    class="mb-0 font-size-14">
                                                                                                    Company State</h5>

                                                                                                <p
                                                                                                    class="text-muted mb-1 font-size-13">
                                                                                                    {{ $client->company_state }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li class="pt-1">
                                                                                        <div
                                                                                            class="d-flex align-items-center">

                                                                                            <div class="flex-grow-1">
                                                                                                <h5
                                                                                                    class="mb-0 font-size-14">
                                                                                                    Business Since</h5>

                                                                                                <p
                                                                                                    class="text-muted mb-1 font-size-13">
                                                                                                    {{ $client->business_since }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                    <!-- end li -->
                                                                                </ul>
                                                                            </div>
                                                                            <!-- end card body -->
                                                                        </div>
                                                                    @endif

                                                                    <div class="card mt-3">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title mb-4">Projects</h5>

                                                                            <ul class="list-unstyled mb-0">
                                                                                @foreach ($client['projects'] as $key => $value)
                                                                                    <li>
                                                                                        <div
                                                                                            class="d-flex align-items-center py-2">
                                                                                            <a
                                                                                                href="{{ route('project.show', $value['id']) }}">
                                                                                                <strong>
                                                                                                    {{ $value['name'] }}
                                                                                                </strong>
                                                                                            </a>

                                                                                            @foreach (config('site.project_status') as $configPStatus)
                                                                                                @if ($value->status === $configPStatus['value'])
                                                                                                    <span
                                                                                                        class="ml-auto badge {{ $configPStatus['class'] }} p-1">
                                                                                                        {{ $configPStatus['name'] }}
                                                                                                    </span>
                                                                                                @endif
                                                                                            @endforeach

                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                            </div><!-- end row -->
                                                        </div>
                                                    </div><!-- end col -->
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
