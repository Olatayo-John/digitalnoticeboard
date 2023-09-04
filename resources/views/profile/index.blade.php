@extends('admin.layouts.master')
@section('content')
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ url('assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    <style>
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

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="middle-content container-xxl p-0">
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="row mb-3">
                            <div class="col-md-12">

                                <ul class="nav nav-pills" id="animateLine" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="animated-underline-profile-tab"
                                            data-bs-toggle="tab" href="#animated-underline-profile" role="tab"
                                            aria-controls="animated-underline-profile" aria-selected="false"
                                            tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-user">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg> Profile</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="animated-underline-change-password-tab"
                                            data-bs-toggle="tab" href="#animated-underline-change-password" role="tab"
                                            aria-controls="animated-underline-change-password" aria-selected="false"
                                            tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-lock">
                                                <rect x="3" y="11" width="18" height="11"
                                                    rx="2" ry="2"></rect>
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                            </svg> Change Password</button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content" id="animateLineContent-4">
                            <div class="tab-pane fade show active" id="animated-underline-profile" role="tabpanel"
                                aria-labelledby="animated-underline-profile-tab">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                        <div class="info">
                                            <form enctype="multipart/form-data" method="post"
                                                action="{{ route('profile.update') }}">
                                                @csrf
                                                @method('put')

                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-12 col-md-4">

                                                        <input type="hidden" name="userId" value="{{ $user->id }}" />

                                                        <div class="image-upload">
                                                            <input type="file" name="profile_image" id="profile_image"
                                                                accept="image/*">
                                                            <img id="new_profile_image"
                                                                class="img-circle rounded-circle img-fluid"
                                                                src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('storage/default/no_image.jpg') }}"
                                                                style="width: 120px; height: 120px; object-fit: cover;">
                                                            <label for="img-circle" class="overlay-text">
                                                                <i class="fas fa-camera"></i>
                                                                <b>Upload Image</b>
                                                            </label>
                                                        </div>

                                                        @error('profile_image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                    <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">

                                                        <div class="row">
                                                            <div class="col-md-4 form-group">
                                                                <label for="fullName">Full Name<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="name" class="form-control"
                                                                    value="{{ old('name', $user->name) }}">

                                                                @error('name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-4 form-group">
                                                                <label for="email">Email<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="email" class="form-control"
                                                                    value="{{ old('email', $user->email) }}" readonly>

                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-4 form-group">
                                                                <label for="email">Mobile<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="mobile" class="form-control"
                                                                    value="{{ old('contact_mobile', $user->contact_mobile) }}">

                                                                @error('mobile')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-4 form-group">
                                                                <label for="">Gender</label>
                                                                <div>
                                                                    <input class="form-check-input_" type="radio"
                                                                        name="gender" value="male"
                                                                        {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="form-check-radio-male">
                                                                        Male
                                                                    </label>
                                                                    <input class="form-check-input_" type="radio"
                                                                        name="gender" value="female"
                                                                        {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="form-check-radio-female">
                                                                        Female
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 form-group">
                                                                <label for="">DOB</label>
                                                                <input type="date" class="form-control" name="dob"
                                                                    value="{{ old('dob', $user->dob) }}">

                                                                @error('dob')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-4 form-group">
                                                                <label for="">Blood Group</label>
                                                                <select name="blood_group" class="form-control">
                                                                    <option value="">Select</option>
                                                                    @foreach ($bloodGroupList as $bloodGroup)
                                                                        <option value="{{ $bloodGroup->id }}"
                                                                            {{ old('blood_group', $user->blood_group) == $bloodGroup->id ? 'selected' : '' }}>
                                                                            {{ $bloodGroup->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                                @error('blood_group')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-md-6 form-group">
                                                            <label for="">Current Address</label>
                                                            <textarea name="current_address" class="form-control">{{ old('current_address', $user->current_address) }}</textarea>

                                                            @error('current_address')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-6 form-group">
                                                            <label for="">Permanent Address</label>
                                                            <textarea name="permanent_address" class="form-control">{{ old('permanent_address', $user->permanent_address) }}</textarea>

                                                            @error('permanent_address')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group mt-3 text-end">
                                                        <button class="btn btn-primary InFormSubmitBtn" type="submit">Save</button>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="animated-underline-change-password" role="tabpanel"
                                aria-labelledby="animated-underline-change-password-tab">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                                        <div class="section general-info payment-info">
                                            <div class="info">
                                                <form method="post" action="{{ route('profile.change-password') }}">
                                                    @csrf
                                                    <h6 class="">Change Password</h6>
                                                    <div class="row mt-4">
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Current password</label>
                                                                <input type="password"
                                                                    class="form-control add-billing-address-input"
                                                                    name="currentPassword" id="currentPassword">
                                                                @if ($errors->has('currentPassword'))
                                                                    <span
                                                                        class="text-danger">{{ $errors->first('currentPassword') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">New Password</label>
                                                                <input type="password"
                                                                    class="form-control add-billing-address-input"
                                                                    name="newPassword" id="newPassword">
                                                                @if ($errors->has('newPassword'))
                                                                    <span
                                                                        class="text-danger">{{ $errors->first('newPassword') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Confirm Password</label>
                                                                <input type="password"
                                                                    class="form-control add-billing-address-input"
                                                                    name="confirmPassword" id="confirmPassword">
                                                                @if ($errors->has('confirmPassword'))
                                                                    <span
                                                                        class="text-danger">{{ $errors->first('confirmPassword') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button class="btn btn-primary mt-4 InFormSubmitBtn" type="submit">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-12 col-md-12 layout-spacing">
                                        <div class="section general-info">
                                            <div class="info">
                                                <h6 class="">Deactivate Account</h6>
                                                <p>You will not be able to receive messages, notifications for up to 24
                                                    hours.</p>
                                                <div class="form-group mt-4">
                                                    <div
                                                        class="switch form-switch-custom switch-inline form-switch-success mt-1">
                                                        <input class="switch-input" type="checkbox" role="switch"
                                                            id="socialformprofile-custom-switch-success">
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
    <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
@endsection
@section('javascript')
    <script src="{{ url('assets/js/users/account-settings.js') }}"></script>
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
