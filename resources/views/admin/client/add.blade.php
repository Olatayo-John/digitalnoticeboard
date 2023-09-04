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
                                    <form action="{{ route('client.store') }}" method="post" enctype="multipart/form-data"
                                        id="createClientForm">
                                        @csrf
                                        @method('post')

                                        <div class="info layout-spacing">
                                            <div class="card p-3">
                                                <h6 class="">Personal Information</h6>

                                                <div class="col-md-12 pt-3">
                                                    <div class="row">

                                                        <div class="form-group col-md-3 mb-3">
                                                            <label for="">Client Type<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="client_type_id" id="client_type_id"
                                                                class="form-control">
                                                                <option value="">Select</option>
                                                                @foreach ($clientTypeList as $clientType)
                                                                    <option value="{{ $clientType->id }}"
                                                                        {{ old('client_type_id') == $clientType->id ? 'selected' : '' }}>
                                                                        {{ $clientType->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="fullName">Client Name<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="name"
                                                                class="form-control"placeholder="Full Name"
                                                                value="{{ old('name') }}">

                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-5 mb-3">
                                                            <div class="form-group">
                                                                <label for="e-text">Profile Image</label>
                                                                <input type="file" name="profile_image"
                                                                    class="form-control">

                                                                <div class="instructions mt-2">
                                                                    @foreach (config('site.image_instructions') as $key => $value)
                                                                        <strong
                                                                            class="text-danger">{{ $value }}</strong><br>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- mobile/email --}}
                                                    <div class="row">
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
                                                            <input id="tel-text" type="number" name="mobile"
                                                                class="form-control" value="{{ old('mobile') }}">

                                                            @error('mobile')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="company_info layout-spacing">
                                            <div class="card p-3">
                                                <h6 class="">Company Information</h6>

                                                <div class="col-md-12 pt-3">

                                                    {{-- company --}}
                                                    <div class="row">
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Company Name<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="company_name" class="form-control"
                                                                value="{{ old('company_name') }}">

                                                            @error('company_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Company Country<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="company_country"
                                                                class="form-control company_country" id="company_country">
                                                                <option value="">Select</option>
                                                                @foreach ($countryList as $key => $value)
                                                                    <option value="{{ $value['countryName'] }}"
                                                                        geonameId="{{ $value['geonameId'] }}"
                                                                        {{ old('company_country') == $value['countryName'] ? 'selected' : '' }}>
                                                                        {{ $value['countryName'] }}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('company_country')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Company State<span
                                                                    class="text-danger">*</span></label>
                                                            <select class="company_state form-control"
                                                                name="company_state">
                                                            </select>

                                                            @error('company_state')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    {{-- business --}}
                                                    <div class="row">
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Business Since<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" name="business_since"
                                                                class="form-control" value="{{ old('business_since') }}">

                                                            @error('business_since')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="social_info layout-spacing">
                                            <div class="card p-3">
                                                <h6 class="">Social Information</h6>

                                                <div class="col-md-12 pt-3">

                                                    {{-- socials --}}
                                                    <div class="row">
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Linkedin</label>
                                                            <input type="text" name="linkedin" class="form-control"
                                                                value="{{ old('linkedin') }}">

                                                            @error('linkedin')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="">Slack</label>
                                                            <input type="text" name="slack" class="form-control"
                                                                value="{{ old('slack') }}">

                                                            @error('slack')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
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

                                        <div class="status_info layout-spacing">
                                            <div class="card p-3">
                                                <h6 class=""></h6>

                                                <div class="col-md-12 pt-3">

                                                    <div class="form-group mb-3">
                                                        <label for="tel-text">Is Active<span
                                                                class="text-danger">*</span></label><br>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input_" type="radio"
                                                                name="is_active" id="flexRadioDefault1" value="1"
                                                                {{ old('is_active') === '1' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input_" type="radio"
                                                                name="is_active" id="flexRadioDefault2" value="0"
                                                                {{ old('is_active') === '0' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                No
                                                            </label>
                                                        </div><br>

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
        function displayCompanyInfo(clientTypeId) {

            if (parseInt(clientTypeId) === 1) {
                $('div.company_info').css('display', 'block');
            } else {
                $('div.company_info').css('display', 'none');
            }
        }

        function getCountryStateList(geoNameId) {
            if (geoNameId) {
                $.ajax({
                    url: "{{ route('client.get-country-state') }}",
                    method: "post",
                    dataType: "json",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        '_method': 'get',
                        'geoNameId': geoNameId
                    },
                    beforeSend: function() {
                        $('.company_state').empty().trigger('change');
                        $(".company_state").select2({
                            placeholder: "Fetching..."
                        });

                        $('.company_country,.company_state').prop('disabled', true);
                    },
                    success: function(res) {
                        const stateList = res;
                        var state = "{{ old('company_state') }}";

                        for (let i = 0; i < stateList.length; i++) {
                            var isSelected = (state === stateList[i]['name']) ? "selected" : "";
                            $(".company_state").append('<option value="' + stateList[i]['name'] +
                                '" geonameId="' + stateList[i]['geonameId'] +
                                '" ' + isSelected + '>' + stateList[
                                    i]['name'] + '</option>');
                        }

                        // $(".company_state").select2();
                        $('.company_country,.company_state').prop('disabled', false);

                    }
                });
            }
        }


        $(document).ready(function() {

            $(".company_country").select2();

            //fetch state
            $(document).on('change', '.company_country', function() {
                var slectedCountry = $('#company_country').find(':selected');
                var geoNameId = slectedCountry.attr('geonameid');
                getCountryStateList(geoNameId);
            });

            $(document).on('change', '#client_type_id', function() {
                var clientTypeId = $(this).val();
                displayCompanyInfo(clientTypeId);
            });

            //on page refresh
            var clientTypeId = $('form#createClientForm select#client_type_id').val();
            displayCompanyInfo(clientTypeId);

            var slectedCountry = $('#company_country').find(':selected');
            var geoNameId = slectedCountry.attr('geonameid');
            getCountryStateList(geoNameId);

        });
    </script>
@endsection('javascript')
