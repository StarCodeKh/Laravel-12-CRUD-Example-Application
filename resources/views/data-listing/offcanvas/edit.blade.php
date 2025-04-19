<!-- Offcanvas for Editing User Information -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Edit User Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <form id="editUserForm" action="{{ route('update-user') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 text-center">
                <input type="file" id="e_image_upload" name="profile_image" accept="image/*" class="d-none">
                <input type="hidden" id="e_hidden_image" name="hidden_image">
                <div class="d-flex justify-content-center">
                    <span class="input-group-text p-2 rounded-4" id="e_image_upload_trigger" style="cursor: pointer;">
                        <img id="e_image-circle-preview" src="" alt="User Image" class="rounded-circle d-none" width="60" height="60">
                        <h4 class="fw-bold mb-0" id="e_image-circle"></h4>
                    </span>
                </div>
            </div>

            <div class="mb-3">
                <label for="userID" class="form-label">User ID</label>
                <input type="text" class="form-control" id="e_user_id" name="user_id" readonly>
            </div>
            <div class="mb-3">
                <label for="userName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="e_name" name="name" placeholder="Enter full name" required>
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="e_email" name="email" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label for="userPhone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="e_phone_number" name="phone_number" placeholder="Enter phone number">
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" id="e_position" name="position" placeholder="Enter position">
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="e_department" name="department" placeholder="Enter department">
            </div>

            <div class="mb-3">
                <label for="userRole" class="form-label">User Role</label>
                <select class="form-select" id="e_role_name" name="role_name">
                    <option value="Admin">Admin</option>
                    <option value="Editor">Editor</option>
                    <option value="User">User</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="userStatus" class="form-label">Status</label>
                <select class="form-select" id="e_status" name="status">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                    <option value="Pending">Pending</option>
                    <option value="Suspended">Suspended</option>
                </select>
            </div>
        </form>
    </div>

    <div class="offcanvas-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        <button type="submit" class="btn btn-primary" form="editUserForm">Save Changes</button>
    </div>
</div>
