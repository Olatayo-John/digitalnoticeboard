@extends('admin.layouts.master')
@section('content')
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="middle-content container-xxl p-0">

                <!-- BREADCRUMB -->
                <div class="page-meta">
                    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <a href="{{ route('users.create') }}"><button
                                    class="btn btn-primary mb-2 me-4 _effect--ripple waves-effect waves-light">Add
                                    User</button></a>
                        </ol>
                    </nav>
                </div>
                <!-- /BREADCRUMB -->

                <div class="row layout-top-spacing_">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing_">
                        <div class="widget-content widget-content-area br-8">
                            <table id="zero-config" class="table table-striped dt-table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Personal Information</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Joining Date</th>
                                        <th>Leaving Date</th>
                                        <th>Status</th>
                                        <th>Skill</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="usr-img-frame me-2 rounded-circle">
                                                        <img alt="avatar" class="img-fluid rounded-circle"
                                                            src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('storage/default/no_image.jpg') }}">
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <a href="{{ route('users.show', $user->id) }}"
                                                                class="align-self-center mb-0 admin-name">
                                                                <strong>{{ $user->name }} - {{ $user->emp_code }}</strong>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            {{ $user->userDesignation ? 'Designation - ' . $user->userDesignation->name : '' }}
                                                        </div>
                                                        <div>
                                                            {{ $user->userReportingManager ? 'Reporting Manager - ' . $user->userReportingManager->name : '' }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->contact_mobile }}</td>
                                            <td>{{ $user->joining_date }}</td>
                                            <td>{{ $user->leaving_date }}</td>
                                            <td>
                                                @foreach (config('site.status') as $key => $value)
                                                    @if ($user->is_active === $value['value'])
                                                        <span class="badge {{ $value['class'] }}">
                                                            {{ $value['name'] }}
                                                        </span>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <a userId="{{ $user->id }}" id="viewUserTechBtn">
                                                    <button class="btn-">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                            viewBox="0 0 448 512">
                                                            <path
                                                                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                                                        </svg>
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex">

                                                    <a href="{{ route('users.show', $user->id) }}">
                                                        <button class="btn-">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                                viewBox="0 0 576 512">
                                                                <path
                                                                    d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                                            </svg>
                                                        </button>
                                                    </a>

                                                    @if ($user->id !== 1)
                                                        <a href="{{ route('users.edit', $user->id) }}">
                                                            <button class="btn-">
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                                    viewBox="0 0 512 512">
                                                                    <path
                                                                        d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                                                </svg>
                                                            </button>
                                                        </a>
                                                    @endif

                                                    @if ($user->id !== 1)
                                                        <form method="post"
                                                            action="{{ route('users.destroy', $user->id) }}"
                                                            class="deleteUserForm">
                                                            @csrf @method('delete')
                                                            <button class="btn- InFormDeleteBtn" formClass="deleteUserForm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                                    viewBox="0 0 448 512">
                                                                    <path
                                                                        d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                            <?php
                                            $timezone = Session::get('timezone');
                                            $dateCreated = \Helper::ConvertGMTToLocalTimezone($user->created_at, $timezone);
                                            $createdAt = $dateCreated->format('d/m/Y h:i A');
                                            $dateUpdated = \Helper::ConvertGMTToLocalTimezone($user->updated_at, $timezone);
                                            $updatedAt = $dateUpdated->format('d/m/Y h:i A');
                                            ?>
                                            {{-- <td>{{ $createdAt }}</td>
                                            <td>{{ $updatedAt }}</td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        @include('admin.users.partials.user_technology_list')

        <script>
            $(document).ready(function() {

                // $('.technology_id').select2();

                //show user-tech
                $(document).on('click', '#viewUserTechBtn', function(e) {
                    e.preventDefault();

                    var userId = $(this).attr('userId');

                    $.ajax({
                        url: "{{ route('users-technology') }}",
                        method: "post",
                        dataType: 'json',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'get',
                            'userId': userId
                        },
                        beforeSend: function() {
                            clearAlert();

                            $('table#zero-config a#viewUserTechBtn').css('pointer-events', 'none');

                            $('form#addUserTechForm input[name="user_id"]').val('');
                            $('form#addUserTechForm div#techWrapper').children().remove();
                        },
                        success: function(res, status) {

                            if (res.status === true) {

                                if (res.user) {
                                    var dbTechs = res.technologies;
                                    var userTechs = res.user.technologies;

                                    $('form#addUserTechForm input[name="user_id"]').val(res.user
                                        .id);

                                    if (dbTechs) {
                                        var dbTechsSelectOptions = "";
                                        for (let j = 0; j < dbTechs.length; j++) {
                                            dbTechsSelectOptions += '<option value="' + dbTechs[j][
                                                'id'
                                            ] + '">' + dbTechs[j]['name'] + '</option>';
                                        }
                                    }

                                    for (let i = 0; i < userTechs.length; i++) {

                                        $('form#addUserTechForm div#techWrapper').append(
                                            '<div class="row techDiv" techDivRowId="' + i +
                                            '"><div class="form-group col mb-3"><label for="">Technology</label><select name="technology_id[' +
                                            userTechs[i]['pivot']['id'] +
                                            ']" id="technology_id" class="form-control technology_id"><option value="" selected>Select</option>' +
                                            dbTechsSelectOptions +
                                            '</select><span class="err text-danger" id="technology_id_' +
                                            userTechs[i]['pivot']['id'] +
                                            '"></span> </div><div class="form-group col mb-3"><label for="">Experience</label><input type="number" class="form-control" name="experience[' +
                                            userTechs[i]['pivot']['id'] + ']" value="' +
                                            userTechs[i]['pivot']['experience'] +
                                            '"><span class="err text-danger" id="experience_' +
                                            userTechs[i]['pivot']['id'] +
                                            '"></span></div><div class="form-group col-md-1 m-auto"><a id="deleteUserTechBtn" techDivRowId="' +
                                            i +
                                            '"><button class="btn-"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" /></svg></button></a></div></div>'
                                        );

                                        // $('.technology_id').select2();

                                        $('form#addUserTechForm div#techWrapper div[techDivRowId="' +
                                            i + '"] select option[value=' + userTechs[i][
                                                'pivot'
                                            ]['technology_id'] + ']').attr(
                                            "selected", "selected");

                                        $('button.addTechBtn').attr('cid', i);
                                    }

                                    // bug in select2 --pending
                                    // $('.technology_id').each(function(index,element){
                                    //     // console.log(this);
                                    //     $(this).select2();
                                    // });

                                    $('#viewUserTechModal').modal('show');

                                    $('table#zero-config a#viewUserTechBtn').css('pointer-events',
                                        'initial');
                                }
                            }
                        }
                    });
                });

                //save edit
                $('form#addUserTechForm').on('submit', function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);

                    $.ajax({
                        url: "{{ route('users-technology.update') }}",
                        method: "post",
                        dataType: 'json',
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            clearAlert();

                            $('form#addUserTechForm button#addUserTechFormBtn').prop('disabled',
                                true);

                            $('form#addUserTechForm span.err').text('').hide();

                        },
                        success: function(res, status) {

                            if (res.status === true) {

                                $('#viewUserTechModal').modal('hide');

                                $('.alertDivAjaxSucc div.alertMsgDiv').append(
                                    '<p class="alertMsg">' + res.msg + '</p>');
                                $('.alertDivAjaxSucc').show();

                                gsapAlert();
                            }
                        },
                        error: function(eRes) {
                            const errors = eRes.responseJSON.errors;
                            const errorKeys = Object.keys(errors);
                            var alertMsgArr = [];

                            $(errorKeys).each(function(key, value) {
                                var errValue = errors['' + value + ''];

                                if ((errValue) && (errValue !== "") && (errValue !==
                                        null) && (errValue !== undefined)) {

                                    value = value.replace('.', '_');
                                    var errorSpanEl = document.getElementById(value);

                                    if (errorSpanEl) {
                                        $('form#addUserTechForm span#' + value + '').text(
                                            errValue[0]).show();
                                    } else {
                                        alertMsgArr.push(errValue[0]);
                                    }
                                }
                            });

                            if (alertMsgArr && parseInt(alertMsgArr.length) > 0) {
                                $(alertMsgArr).each(function(key, value) {
                                    $('.alertDivAjaxErr div.alertMsgDiv').append(
                                        '<p class="alertMsg">' + value + '</p>');
                                });
                                $('.alertDivAjaxErr').show();

                                gsapAlert();
                            }
                        }
                    }).always(function() {
                        $('form#addUserTechForm button#addUserTechFormBtn').prop('disabled', false);
                    });
                });

                //add more technologies
                $(document).on('click', 'button.addTechBtn', function(e) {
                    e.preventDefault();

                    var cid = $(this).attr('cid');
                    var nid = parseInt(cid) + parseInt(1);
                    var uniquePerRow = "";

                    $.ajax({
                        url: "{{ route('technology.list') }}",
                        method: "post",
                        dataType: 'json',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'get',
                        },
                        beforeSend: function() {
                            clearAlert();

                            $('form#addUserTechForm button#addTechBtn').prop('disabled', true);
                        },
                        success: function(res) {

                            if (res.technologies) {
                                var dbTechsSelectOptions = "";
                                for (let j = 0; j < res.technologies.length; j++) {
                                    dbTechsSelectOptions += '<option value="' + res.technologies[j][
                                        'id'
                                    ] + '">' + res.technologies[j]['name'] + '</option>';
                                }
                            }

                            $('form#addUserTechForm div#techWrapper').append(
                                '<div class="row techDiv" techDivRowId="' + nid +
                                '"><div class="form-group col mb-3"><label for="">Technology</label><select name="technology_id[' +
                                uniquePerRow +
                                ']" id="technology_id" class="form-control technology_id"><option value="" selected>Select</option>' +
                                dbTechsSelectOptions +
                                '</select><span class="err text-danger" id="technology_id_' +
                                uniquePerRow +
                                '"></span> </div><div class="form-group col mb-3"><label for="">Experience</label><input type="number" class="form-control" name="experience[' +
                                uniquePerRow +
                                ']"><span class="err text-danger" id="experience_' +
                                uniquePerRow +
                                '"></span></div><div class="form-group col-md-1 m-auto"><a id="deleteUserTechBtn" techDivRowId="' +
                                nid +
                                '"><button class="btn-"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" /></svg></button></a></div></div>'
                            );

                            var btn_id = parseInt(nid) + parseInt(1);
                            $('button.addTechBtn').attr('cid', btn_id);

                            $('form#addUserTechForm button#addTechBtn').prop('disabled', false);

                            $('.technology_id').select2();

                        }
                    });
                });

                //remove tech row
                $(document).on('click', '#deleteUserTechBtn', function(e) {
                    e.preventDefault();

                    var techDivRowId = $(this).attr('techDivRowId');

                    if (techDivRowId) {
                        $('form#addUserTechForm div#techWrapper div[techDivRowId="' + techDivRowId + '"]')
                            .remove();
                    }
                });

                document.querySelector('div#zero-config_wrapper div.toolbar').innerHTML =
                    '<form method="post" action="" class="form-inline_ row">@csrf @method('get') <div class="col"><select class="form-control reporting_manager" name="reporting_manager"><option value="">Reporting Manager</option>@foreach ($userList as $userL)<option value="{{ $userL->id }}" {{ request('reporting_manager') == $userL->id ? 'selected' : '' }}>{{ $userL->name }} - {{ $userL->emp_code }}</option>@endforeach</select></div><div class="col"><select class="form-control designation" name="designation"><option value="">Designation</option>@foreach ($designationList as $designation)<option value="{{ $designation->id }}" {{ request('designation') == $designation->id ? 'selected' : '' }}>{{ $designation->name }}</option>@endforeach</select></div><div class="col"><select class="form-control" name="is_active"><option value="">Status</option>@foreach (config('site.status') as $uStatus)<option value="{{ $uStatus['value'] }}" {{ request('is_active') == $uStatus['value'] ? 'selected' : '' }}>{{ $uStatus['name'] }}</option>@endforeach</select></div><div class="col m-auto"><button class="btn btn-primary btn-sm" type="submit">Filter</button></div></form><hr_>';

                $('.reporting_manager,.designation').select2();
            });
        </script>
    @endsection
