<div>
    <div class="pt-3">
        <button class="btn btn-primary" id="addTechnologyBtn" type="button">Add</button>
    </div>

    <table id="technologyTable" class="table table-striped dt-table-hover" style="width:100%">
        <thead>
            <tr>
                <th data-field="name" data-sortable="true">Name</th>
                <th data-field="status" data-sortable="true">Status</th>
                <th data-field="action">Action</th>
            </tr><!-- end tr -->
        </thead><!-- end thead -->
        <tbody>
            @foreach ($technologyList as $technology)
                <tr>
                    <td>{{ $technology->name }}</td>
                    <td>
                        @foreach (config('site.status') as $key => $value)
                            @if ($technology->status === $value['value'])
                                <span class="badge {{ $value['class'] }}">
                                    {{ $value['name'] }}
                                </span>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <div class="d-flex">
                            <a technologyId="{{ $technology->id }}" id="editTechnologyBtn">
                                <button class="btn-">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path
                                            d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                    </svg>
                                </button>
                            </a>

                            <form method="post" action="{{ route('technology.delete', $technology->id) }}"
                                class="deleteTechForm">
                                @csrf @method('delete')
                                <button class="btn- InFormDeleteBtn" formClass="deleteTechForm">
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

@include('admin.technology.create')
@include('admin.technology.edit')


<script>
    $(document).ready(function() {
        $(document).on('click', '#addTechnologyBtn', function() {
            $('form#addTechnologyForm input[name="name"]').val("");
            $('form#addTechnologyForm select[name="status"]').val("");

            $('form#addTechnologyForm span.err').text('').hide();

            $('#addTechnologyModal').modal('show');
        });

        //save new
        $('form#addTechnologyForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('technology.save') }}",
                method: "post",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    clearAlert();

                    $('form#addTechnologyForm button#addTechnologyFormBtn').prop('disabled',
                        true);

                    $('form#addTechnologyForm span.err').text('').hide();
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
                            $('form#addTechnologyForm span#' + value + 'Err')
                                .text(errValue[0]).show();
                        }
                    });
                }
            }).always(function() {
                $('form#addTechnologyForm button#addTechnologyFormBtn').prop('disabled', false);
            });
        });

        //show edit
        $(document).on('click', '#editTechnologyBtn', function(e) {
            e.preventDefault();

            var technologyId = $(this).attr('technologyId');

            $.ajax({
                url: "{{ route('technology.show') }}",
                method: "post",
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    '_method': 'get',
                    'technologyId': technologyId
                },
                beforeSend: function() {
                    clearAlert();

                    $('table#technologyTable a#editTechnologyBtn').css('pointer-events',
                        'none');

                    $('form#addTechnologyForm input[name="name"]').val("");
                    $('form#addTechnologyForm select[name="status"]').val("");
                },
                success: function(res, status) {

                    if (res.status === true) {
                        $('form#editTechnologyForm input[name="id"]').val(res.technology
                            .id);
                        $('form#editTechnologyForm input[name="name"]').val(res.technology
                            .name);
                        $('form#editTechnologyForm select[name="status"]').val(res
                            .technology.status);

                        $('#editTechnologyModal').modal('show');

                        $('table#technologyTable a#editTechnologyBtn').css('pointer-events',
                            'initial');
                    }
                }
            });
        });

        //save edit
        $('form#editTechnologyForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('technology.update') }}",
                method: "post",
                dataType: 'json',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    clearAlert();

                    $('form#editTechnologyForm button#editTechnologyFormBtn').prop(
                        'disabled', true);

                    $('form#editTechnologyForm span.err').text('').hide();
                },
                success: function(res, status) {

                    if (res.status === true) {
                        $('#editTechnologyModal').modal('hide');

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
                            $('form#editTechnologyForm span#' + value + 'Err')
                                .text(errValue[0]).show();
                        }
                    });
                }
            }).always(function() {
                $('form#editTechnologyForm button#editTechnologyFormBtn').prop('disabled',
                    false);
            });
        });
    });
</script>
