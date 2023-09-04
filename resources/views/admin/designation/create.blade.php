<!-- -------modal-role-permission edit -->
<div class="modal fade" id="addDesignationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Designation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" id="addDesignationForm">
                                @csrf
                                @method('post')

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control">

                                        <span class="err text-danger" id="nameErr"></span>
                                    </div>

                                    {{-- <div class="form-group col-md-4 mb-3">
                                        <label for="">Reporting Manager</label>
                                        <select name="reporting_manager" id="" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($userList as $user)
                                                <option value="{{ $user['id'] }}">
                                                    {{ $user['name'] }}</option>
                                            @endforeach
                                        </select>

                                        <span class="err text-danger" id="reporting_managerErr"></span>
                                    </div> --}}

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="">Select</option>
                                            @foreach (config('site.status') as $status)
                                                <option value="{{ $status['value'] }}">
                                                    {{ $status['name'] }}</option>
                                            @endforeach
                                        </select>

                                        <span class="err text-danger" id="statusErr"></span>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <button class="btn btn-primary" id="addDesignationFormBtn" type="submit">Add</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- -------modal-user -->
