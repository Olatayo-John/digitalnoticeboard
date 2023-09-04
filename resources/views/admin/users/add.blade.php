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

    <div id="content" class="main-content">

        <div class="layout-px-spacing">
            <div class="middle-content container-xxl p-0">
                <div class="account-settings-container layout-top-spacing">
                    <div class="tab-content" id="animateLineContent-4">
                        <div class="tab-pane fade show active" id="animated-underline-profile" role="tabpanel"
                            aria-labelledby="animated-underline-profile-tab">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data"
                                        id="createUserForm">
                                        @csrf
                                        @method('post')

                                        <div class="info layout-spacing">
                                            <div class="card p-3">
                                                <h6 class="">Personal Information</h6>

                                                <div class="col-md-12 pt-3">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-group">
                                                                <label for="fullName">Full Name<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="name"
                                                                    class="form-control"placeholder="Full Name"
                                                                    value="{{ old('name') }}">

                                                                @error('name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-group">
                                                                <label for="e-text">Profile Image</label>
                                                                <input type="file" name="profile_image"
                                                                    class="form-control">

                                                                @error('profile_image')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror

                                                                <div class="instructions mt-2">
                                                                    @foreach (config('site.image_instructions') as $key => $value)
                                                                        <strong
                                                                            class="text-danger">{{ $value }}</strong><br>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- gender/dob/mobile/email --}}
                                                    <div class="row">
                                                        <div class="col form-group mb-3">
                                                            <label for="profession">Gender</label>
                                                            <div>
                                                                <input class="form-check-input_" type="radio"
                                                                    name="gender" value="male" id="form-check-radio-male"
                                                                    checked="">
                                                                <label class="form-check-label" for="form-check-radio-male">
                                                                    Male
                                                                </label>
                                                                <input class="form-check-input_" type="radio"
                                                                    name="gender" value="female"
                                                                    id="form-check-radio-female">
                                                                <label class="form-check-label"
                                                                    for="form-check-radio-female">
                                                                    Female
                                                                </label>
                                                            </div>

                                                            @error('gender')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col form-group mb-3">
                                                            <label for="profession">DOB</label>
                                                            <input type="date" class="form-control" name="dob"
                                                                value="{{ old('dob') }}">

                                                            @error('dob')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class=" col form-group mb-3">
                                                            <label for="">Email</label>
                                                            <input type="email" name="email" class="form-control"
                                                                value="{{ old('email') }}">

                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col form-group mb-3">
                                                            <label for="tel-text">Mobile<span
                                                                    class="text-danger">*</span></label>
                                                            <input id="tel-text" type="number" name="contact_mobile"
                                                                class="form-control" value="{{ old('contact_mobile') }}" maxlength="10">

                                                            @error('contact_mobile')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    {{-- address --}}
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mb-3">
                                                            <label for="">Permanent Address</label>
                                                            <textarea name="permanent_address" class="form-control">{{ old('permanent_address') }}</textarea>

                                                            @error('permanent_address')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-6 mb-3">
                                                            <label for="">Current Address</label>
                                                            <textarea name="current_address" class="form-control">{{ old('current_address') }}</textarea>

                                                            @error('current_address')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="company_info layout-spacing">
                                            <div class="card p-3">
                                                <h6 class="">Employee Information</h6>

                                                <div class="col-md-12 pt-3">

                                                    <div class="row">
                                                        <div class="form-group col-md-6 mb-3">
                                                            <label for="">Employee Code<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="emp_code" class="form-control"
                                                                value="{{ old('emp_code') }}">

                                                            @error('emp_code')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-6 mb-3">
                                                            <label for="tel-text">Upload
                                                                Resume<span class="text-danger">*</span></label>
                                                            <input class="form-control file-upload-input" type="file"
                                                                id="formFile" name="resume">

                                                            @error('resume')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                            <div class="instructions mt-2">
                                                                @foreach (config('site.resume_instructions') as $key => $value)
                                                                    <strong
                                                                        class="text-danger">{{ $value }}</strong><br>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- email/ctc --}}
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mb-3">
                                                            <label for="">Official Email</label>
                                                            <input type="email" name="official_email"
                                                                class="form-control" value="{{ old('official_email') }}">

                                                            @error('official_email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-6 mb-3">
                                                            <label for="">CTC</label>
                                                            <input type="number" name="ctc" class="form-control"
                                                                value="{{ old('ctc') }}">

                                                            @error('ctc')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- managers --}}
                                                    <div class="row">
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Qualification</label>
                                                            <input type="text" name="qualification"
                                                                class="form-control" value="{{ old('qualification') }}">

                                                            @error('qualification')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Designation<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="designation" class="form-control designation" id="designation"
                                                                class="form-control">
                                                                <option value="">Select</option>
                                                                @foreach ($designationList as $designation)
                                                                    <option value="{{ $designation->id }}"
                                                                        {{ old('designation') == $designation->id ? 'selected' : '' }}>
                                                                        {{ $designation->name }}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('designation')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Reporting Manager<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="reporting_manager" class="form-control reporting_manager" id="reporting_manager"
                                                                class="form-control">
                                                                <option value="">Select</option>
                                                                @foreach ($userList as $rpUser)
                                                                    <option value="{{ $rpUser->id }}"
                                                                        {{ old('reporting_manager') == $rpUser->id ? 'selected' : '' }}>
                                                                        {{ $rpUser->name }}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('reporting_manager')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    {{-- dates --}}
                                                    <div class="row">
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Joining Date</label>
                                                            <input type="date" name="joining_date"
                                                                class="form-control" value="{{ old('joining_date') }}">

                                                            @error('joining_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Leaving Date</label>
                                                            <input type="date" name="leaving_date"
                                                                class="form-control" value="{{ old('leaving_date') }}">

                                                            @error('leaving_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">F&F Date</label>
                                                            <input type="date" name="fandf_date" class="form-control"
                                                                value="{{ old('fandf_date') }}">

                                                            @error('fandf_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="company_info layout-spacing">
                                            <div class="card p-3">
                                                <h6 class="">Social Information</h6>

                                                <div class="col-md-12 pt-3">

                                                    {{-- socials --}}
                                                    <h6 class="">Personal</h6>
                                                    <div class="row">
                                                        <div class="form-group col-md-3 mb-3">
                                                            <label for="">Linkedin</label>
                                                            <input type="text" name="linkedin" class="form-control"
                                                                value="{{ old('linkedin') }}">

                                                            @error('linkedin')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-3 mb-3">
                                                            <label for="">Slack</label>
                                                            <input type="text" name="slack" class="form-control"
                                                                value="{{ old('slack') }}">

                                                            @error('slack')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-3 mb-3">
                                                            <label for="">GitHub</label>
                                                            <input type="text" name="github" class="form-control"
                                                                value="{{ old('github') }}">

                                                            @error('github')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-3 mb-3">
                                                            <label for="">Skype</label>
                                                            <input type="text" name="skype" class="form-control"
                                                                value="{{ old('skype') }}">

                                                            @error('skype')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <h6 class="">Official</h6>
                                                    <div class="row">
                                                        <div class="form-group col mb-3">
                                                            <label for="">Linkedin</label>
                                                            <input type="text" name="linkedin" class="form-control"
                                                                value="{{ old('linkedin') }}">

                                                            @error('linkedin')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col mb-3">
                                                            <label for="">Slack</label>
                                                            <input type="text" name="slack" class="form-control"
                                                                value="{{ old('slack') }}">

                                                            @error('slack')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col mb-3">
                                                            <label for="">GitHub</label>
                                                            <input type="text" name="github" class="form-control"
                                                                value="{{ old('github') }}">

                                                            @error('github')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col mb-3">
                                                            <label for="">Skype</label>
                                                            <input type="text" name="skype" class="form-control"
                                                                value="{{ old('skype') }}">

                                                            @error('skype')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="company_info layout-spacing">
                                            <div class="card p-3">
                                                <h6 class="">Emergency Information</h6>

                                                <div class="col-md-12 pt-3">
                                                    {{-- contact 1 --}}
                                                    <div class="row">
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Contact Name</label>
                                                            <input type="text" name="contact_one_name"
                                                                class="form-control"
                                                                value="{{ old('contact_one_name') }}">

                                                            @error('contact_one_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Mobile</label>
                                                            <input type="number" name="contact_one_mobile"
                                                                class="form-control"
                                                                value="{{ old('contact_one_mobile') }}">

                                                            @error('contact_one_mobile')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Relationship</label>
                                                            <input type="text" name="contact_one_relationship"
                                                                class="form-control"
                                                                value="{{ old('contact_one_relationship') }}">

                                                            @error('contact_one_relationship')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- contacty 2 --}}
                                                    <div class="row">
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Contact Name</label>
                                                            <input type="text" name="contact_two_name"
                                                                class="form-control"
                                                                value="{{ old('contact_two_name') }}">

                                                            @error('contact_two_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Mobile</label>
                                                            <input type="number" name="contact_two_mobile"
                                                                class="form-control"
                                                                value="{{ old('contact_two_mobile') }}">

                                                            @error('contact_two_mobile')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Relationship</label>
                                                            <input type="text" name="contact_two_relationship"
                                                                class="form-control"
                                                                value="{{ old('contact_two_relationship') }}">

                                                            @error('contact_two_relationship')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- blood group --}}
                                                    <div class="row">
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="profession">Blood Group</label>
                                                            <select name="blood_group" class="form-control">
                                                                <option value="">Select</option>
                                                                @foreach ($bloodGroupList as $bloodGroup)
                                                                    <option value="{{ $bloodGroup->id }}"
                                                                        {{ old('blood_group') == $bloodGroup->id ? 'selected' : '' }}>
                                                                        {{ $bloodGroup->name }}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('blood_group')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="status_info layout-spacing">
                                            <div class="card p-3">
                                                <h6 class=""></h6>

                                                <div class="col-md-12 pt-3">
                                                    {{-- password --}}
                                                    <div class="row">
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="e-text">Password<span
                                                                    class="text-danger">*</span></label>
                                                            <input id="e-text" type="password" name="password"
                                                                class="form-control">

                                                            @error('password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-6 form-group mb-3">
                                                            <label for="tel-text">Confirm Password<span
                                                                    class="text-danger">*</span></label>
                                                            <input id="e-text" type="password"
                                                                name="password_confirmation" class="form-control">

                                                            @error('password_confirmation')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="instructions mb-3">
                                                        @foreach (config('site.password_instructions') as $key => $value)
                                                            <strong class="text-danger">{{ $value }}</strong><br>
                                                        @endforeach
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="tel-text">Is Active<span
                                                                class="text-danger">*</span></label><br>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input_" type="radio"
                                                                name="is_active" id="flexRadioDefault1" value="1"
                                                                checked>
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input_" type="radio"
                                                                name="is_active" id="flexRadioDefault2" value="0">
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                No
                                                            </label>
                                                        </div>

                                                        @error('is_active')
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
        function getReportingManagers(designationId) {
            designationId = "";

            if ((designationId !== "") && (designationId !== null) && (designationId !== undefined)) {
                $.ajax({
                    url: "{{ route('designation.show') }}",
                    method: "post",
                    dataType: "json",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        '_method': 'get',
                        'designationId': designationId,
                    },
                    beforeSend: function() {
                        $('form#createUserForm select#reporting_manager').children()
                            .remove();

                        $('form#createUserForm select#reporting_manager').append(
                            '<option value="">Select</option>');
                    },
                    success: function(res, status) {

                        if (status === 'success') {

                            //show reporing manager list
                            $('form#createUserForm select#reporting_manager').append('<option value="' + res
                                .designation['reporting_manager']['id'] + '">' + res.designation[
                                    'reporting_manager'
                                ]['name'] + '</option>');
                        }
                    },
                    error: function(eRes) {
                        const errorKeys = ['designationId'];
                        const errors = eRes.responseJSON.errors;

                        if (errors)
                            $(errorKeys).each(function(key, value) {
                                var errValue = errors['' + value + ''];

                                if ((errValue) && (errValue !== "") && (errValue !==
                                        null) && (errValue !== undefined)) {
                                    $('form#createUserForm span#' + value +
                                            'Err')
                                        .text(errValue[0]).show();
                                }
                            });
                    }
                });
            }
        }

        //on page refresh
        var designationId = $('form#createUserForm select#designation').val();
        getReportingManagers(designationId);

        //on change designation
        $(document).ready(function() {

            $('.reporting_manager,.designation').select2();

            $(document).on('change', 'form#createUserForm select#designation', function(e) {
                e.preventDefault();

                var designationId = $(this).val();
                getReportingManagers(designationId);
            });
        });
    </script>
@endsection('javascript')
