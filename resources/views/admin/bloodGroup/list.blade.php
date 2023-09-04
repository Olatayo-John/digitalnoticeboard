<div>
    <div class="pt-3">
        <button class="btn btn-primary" id="addBloodGroupBtn" type="button">Add</button>
    </div>

    <table id="bloodGroupTable" class="table table-striped dt-table-hover" style="width:100%">
        <thead>
            <tr>
                <th data-field="name" data-sortable="true">Name</th>
                <th data-field="status" data-sortable="true">Status</th>
                <th data-field="action">Action</th>
            </tr><!-- end tr -->
        </thead><!-- end thead -->
        <tbody>
            @foreach ($bloodGroupList as $bloodGroup)
                <tr>
                    <td>{{ $bloodGroup->name }}</td>
                    <td>
                        @foreach (config('site.status') as $key => $value)
                            @if ($bloodGroup->status === $value['value'])
                                <span class="badge {{ $value['class'] }}">
                                    {{ $value['name'] }}
                                </span>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <div class="d-flex">
                            <a bloodGroupId="{{ $bloodGroup->id }}" id="editBloodGroupBtn">
                                <button class="btn-">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path
                                            d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                    </svg>
                                </button>
                            </a>

                            <form method="post" action="{{ route('blood-group.delete', $bloodGroup->id) }}"
                                class="deleteBloodGroupForm">
                                @csrf @method('delete')
                                <button class="btn- InFormDeleteBtn" formClass="deleteBloodGroupForm">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path
                                            d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody><!-- end tbody -->
    </table>
</div>

@include('admin.bloodGroup.create')
@include('admin.bloodGroup.edit')


<script>
    $(document).ready(function() {
        $(document).on('click', '#addBloodGroupBtn', function() {
            $('form#addBloodGroupForm input[name="name"]').val("");
            $('form#addBloodGroupForm select[name="status"]').val("");

            $('form#addBloodGroupForm span.err').text('').hide();

            $('#addBloodGroupModal').modal('show');
        });

        //save new
        $('form#addBloodGroupForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('blood-group.save') }}",
                method: "post",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    clearAlert();

                    $('form#addBloodGroupForm button#addBloodGroupFormBtn').prop('disabled',
                        true);

                    $('form#addBloodGroupForm span.err').text('').hide();
                },
                success: function(res, status) {

                    if (res.status === true) {
                        window.location.reload();
                    }
                },
                error: function(eRes) {
                    const errorKeys = ['name', 'status'];
                    const errors = eRes.responseJSON.errors;

                    $(errorKeys).each(function(key, value) {
                        var errValue = errors['' + value + ''];

                        if ((errValue) && (errValue !== "") && (errValue !==
                                null) && (errValue !== undefined)) {
                            $('form#addBloodGroupForm span#' + value + 'Err')
                                .text(errValue[0]).show();
                        }
                    });
                }
            }).always(function() {
                $('form#addBloodGroupForm button#addBloodGroupFormBtn').prop('disabled', false);
            });
        });

        //show edit
        $(document).on('click', '#editBloodGroupBtn', function(e) {
            e.preventDefault();

            var bloodGroupId = $(this).attr('bloodGroupId');

            $.ajax({
                url: "{{ route('blood-group.show') }}",
                method: "post",
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    '_method': 'get',
                    'bloodGroupId': bloodGroupId
                },
                beforeSend: function() {
                    clearAlert();

                    $('table#bloodGroupTable a#editBloodGroupBtn').css('pointer-events',
                        'none');

                    $('form#addBloodGroupForm input[name="name"]').val("");
                    $('form#addBloodGroupForm select[name="status"]').val("");
                },
                success: function(res, status) {

                    if (res.status === true) {
                        $('form#editBloodGroupForm input[name="id"]').val(res.bloodGroup
                            .id);
                        $('form#editBloodGroupForm input[name="name"]').val(res.bloodGroup
                            .name);
                        $('form#editBloodGroupForm select[name="status"]').val(res
                            .bloodGroup.status);

                        $('#editBloodGroupModal').modal('show');

                        $('table#bloodGroupTable a#editBloodGroupBtn').css('pointer-events',
                            'intial');
                    }
                }
            });
        });

        //save edit
        $('form#editBloodGroupForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('blood-group.update') }}",
                method: "post",
                dataType: 'json',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    clearAlert();

                    $('form#editBloodGroupForm button#editBloodGroupFormBtn').prop(
                        'disabled', true);

                    $('form#editBloodGroupForm span.err').text('').hide();
                },
                success: function(res, status) {

                    if (res.status === true) {
                        $('#editBloodGroupModal').modal('hide');

                        window.location.reload();
                    }
                },
                error: function(eRes) {
                    const errorKeys = ['name', 'status'];
                    const errors = eRes.responseJSON.errors;

                    $(errorKeys).each(function(key, value) {
                        var errValue = errors['' + value + ''];

                        if ((errValue) && (errValue !== "") && (errValue !==
                                null) && (errValue !== undefined)) {
                            $('form#editBloodGroupForm span#' + value + 'Err')
                                .text(errValue[0]).show();
                        }
                    });
                }
            }).always(function() {
                $('form#editBloodGroupForm button#editBloodGroupFormBtn').prop('disabled',
                    false);
            });
        });
    });
</script>
