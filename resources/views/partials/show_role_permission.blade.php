<!-- -------modal-role-permission show -->
<div class="modal fade" id="showRolePermissionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                            <form action="" method="post" id="showRolePermissionForm">
                                @csrf
                                @method('post')

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Role</label>
                                        <input type="text" class="form-control" name="role" readonly disabled>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">Status</label>
                                        <input type="text" class="form-control" name="status" readonly disabled>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="permissions">Permissions</label>
                                    <table id="permissionListTable" class="table" data-toggle="table">
                                        <thead>
                                            <tr>
                                                <th data-field="role"></th>
                                                <th data-field="list" class="text-center">List</th>
                                                <th data-field="view" class="text-center">View</th>
                                                <th data-field="create" class="text-center">Create</th>
                                                <th data-field="update" class="text-center">Update</th>
                                                <th data-field="delete" class="text-center">Delete</th>
                                            </tr><!-- end tr -->
                                        </thead><!-- end thead -->
                                        <tbody id="permissionsDiv">
                                        </tbody><!-- end tbody -->
                                    </table>
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

