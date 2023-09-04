@extends('admin.layouts.master')

@section('content')
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="middle-content container-xxl p-0">
                <div class="account-settings-container layout-top-spacing">
                    <div class="tab-content" id="animateLineContent-4">
                        <div class="tab-pane fade show active" id="animated-underline-profile" role="tabpanel"
                            aria-labelledby="animated-underline-profile-tab">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">General</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="smtp-tab" data-bs-toggle="tab"
                                                data-bs-target="#smtp" type="button" role="tab" aria-controls="smtp"
                                                aria-selected="true">SMTP</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="bloodGroup-tab" data-bs-toggle="tab"
                                                data-bs-target="#bloodGroup" type="button" role="tab"
                                                aria-controls="bloodGroup" aria-selected="false">Blood Group</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="designation-tab" data-bs-toggle="tab"
                                                data-bs-target="#designation" type="button" role="tab"
                                                aria-controls="designation" aria-selected="false">Designation</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="technology-tab" data-bs-toggle="tab"
                                                data-bs-target="#technology" type="button" role="tab"
                                                aria-controls="technology" aria-selected="false">Technologies</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="myTabContent">
                                        {{-- general tab --}}
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">

                                            <form action="{{ route('setting-general.update') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('put')

                                                <div class="row mt-3">
                                                    <div class="form-group col-md-4">
                                                        <label for="">Site Name</label>
                                                        <input type="text" name="site_name" class="form-control"
                                                            value="{{ old('site_name', $keyedSettings['site_name']['meta_value']) }}">

                                                        @error('site_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="">Site Keywords</label>
                                                        <input type="text" name="site_keywords" class="form-control"
                                                            value="{{ old('site_keywords', $keyedSettings['site_keywords']['meta_value']) }}">

                                                        @error('site_keywords')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="">Site Logo</label>
                                                        <input type="file" name="site_logo" class="form-control">

                                                        @error('site_logo')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <label for="">About Us</label>
                                                    <textarea class="form-control" name="about_us" placeholder="Enter About Us" id="about-us-editor" rows="3">{{ old('about_us', $keyedSettings['about_us']['meta_value']) }}</textarea>

                                                    @error('about_us')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mt-3">
                                                    <label for="">Terms & Conditons</label>
                                                    <textarea class="form-control" name="terms_condition" placeholder="Enter Terms & Conditions" id='tc-editor'
                                                        rows="3">{{ old('terms_condition', $keyedSettings['terms_condition']['meta_value']) }}</textarea>

                                                    @error('terms_condition')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mt-3">
                                                    <label for="">Privacy Policy</label>
                                                    <textarea class="form-control" name="privacy_policy" placeholder="Enter Privacy & Policy" id="pp-editor"
                                                        rows="3">{{ old('privacy_policy', $keyedSettings['privacy_policy']['meta_value']) }}</textarea>

                                                    @error('privacy_policy')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mt-3">
                                                    <button class="btn btn-primary InFormSubmitBtn" type="submit">Save</button>
                                                </div>

                                            </form>
                                        </div>

                                        {{-- smtp tab --}}
                                        <div class="tab-pane fade" id="smtp" role="tabpanel"
                                            aria-labelledby="smtp-tab">

                                            <form action="{{ route('setting-smtp.update') }}" method="post">
                                                @csrf
                                                @method('put')

                                                <div class="row">
                                                    <div class="col-md-4 form-group mt-3">
                                                        <label for="">Type</label>
                                                        <input type="text" name="mail_type" class="form-control"
                                                            placeholder="Enter Mail Type e.g smtp"
                                                            value="{{ old('mail_type', $keyedSettings['mail_type']['meta_value']) }}">

                                                        @error('mail_type')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 form-group mt-3">
                                                        <label for="">Host</label>
                                                        <input type="text" name="mail_host" class="form-control"
                                                            placeholder="Enter Mail Host"
                                                            value="{{ old('mail_host', $keyedSettings['mail_host']['meta_value']) }}">

                                                        @error('mail_host')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 form-group mt-3">
                                                        <label for="">Port</label>
                                                        <input type="text" name="mail_port"
                                                            class="form-control"placeholder="Enter Mail Port"
                                                            value="{{ old('mail_port', $keyedSettings['mail_port']['meta_value']) }}">

                                                        @error('mail_port')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label for="">Mail Username</label>
                                                        <input type="email" name="mail_username" class="form-control"
                                                            placeholder="Enter Mail Username"
                                                            value="{{ old('mail_username', $keyedSettings['mail_username']['meta_value']) }}">

                                                        @error('mail_username')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 form-group mt-3">
                                                        <label for="">Mail Password</label>
                                                        <input type="password" name="mail_password" class="form-control"
                                                            placeholder="Enter Mail Password"
                                                            value="{{ old('mail_password', $keyedSettings['mail_password']['meta_value']) }}">

                                                        @error('mail_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <button class="btn btn-primary InFormSubmitBtn" type="submit">Save</button>
                                                </div>

                                            </form>
                                        </div>

                                        {{-- blood group tab --}}
                                        <div class="tab-pane fade" id="bloodGroup" role="tabpanel"
                                            aria-labelledby="bloodGroup-tab">
                                            @include('admin.bloodGroup.list')
                                        </div>

                                        {{-- designation tab --}}
                                        <div class="tab-pane fade" id="designation" role="tabpanel"
                                            aria-labelledby="designation-tab">
                                            @include('admin.designation.list')
                                        </div>

                                        {{-- technologies --}}
                                        <div class="tab-pane fade" id="technology" role="tabpanel"
                                            aria-labelledby="technology-tab">
                                            @include('admin.technology.list')
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
