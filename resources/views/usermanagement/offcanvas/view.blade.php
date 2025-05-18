<!-- Offcanvas for View User Information -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="viewUser" aria-labelledby="viewUserLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="viewUserLabel">View User Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <div class="mb-3 text-center">
            <div class="d-flex justify-content-center">
                <span class="input-group-text p-2 rounded-4" id="e_image_upload_trigger" style="cursor: pointer;">
                    <img id="v_image-circle-preview" src="" alt="User Image" class="rounded-circle d-none" width="60" height="60">
                    <h4 class="fw-bold mb-0" id="v_image-circle"></h4>
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="userID" class="form-label">User ID</label>
            <input type="text" class="form-control" id="v_user_id" name="user_id" readonly>
        </div>
        <div class="mb-3">
            <label for="userName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="v_name" name="name" readonly>
        </div>
        <div class="mb-3">
            <label for="userEmail" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="v_email" name="email" readonly>
        </div>
        <div class="mb-3">
            <label for="userPhone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="v_phone_number" name="phone_number" readonly>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" id="v_position" name="position" readonly>
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <input type="text" class="form-control" id="v_department" name="department" readonly>
        </div>

        <div class="mb-3">
            <label for="userRole" class="form-label">User Role</label>
            <select class="form-select" id="v_role_name" name="role_name" disabled>
                <option value="Admin">Admin</option>
                <option value="Editor">Editor</option>
                <option value="User">User</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="userStatus" class="form-label">Status</label>
            <select class="form-select" id="v_status" name="status" disabled>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Pending">Pending</option>
                <option value="Suspended">Suspended</option>
            </select>
        </div>
    </div>

    <div class="offcanvas-footer p-3">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
    </div>
</div>
