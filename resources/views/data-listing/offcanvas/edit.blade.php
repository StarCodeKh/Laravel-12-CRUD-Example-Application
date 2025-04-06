<style>
    .offcanvas {
        width: 40% !important;
        box-shadow: -2px 0 10px rgba(229, 226, 226, 0.387);
    }
</style>

<!-- Offcanvas for Editing User Information -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Edit User Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="editUserForm">
            <div class="mb-3 text-center">
                <div class="d-flex justify-content-center">
                    <span class="input-group-text p-2 rounded-4">
                        {{-- <img src="profile.jpg" alt="User Profile" class="rounded-circle" style="width: 50px; height: 50px;"> --}}
                        <h4 class="fw-bold mb-0">SS</h4>
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <label for="userID" class="form-label">User ID</label>
                <input type="text" class="form-control" id="userID" name="userID" value="Kh-00001" readonly>
            </div>
            <div class="mb-3">
                <label for="userName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter full name" value="Soeng Souy" required>
            </div>

            <div class="mb-3">
                <label for="userEmail" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="Enter email" value="soengsouy@example.com" required>
            </div>

            <div class="mb-3">
                <label for="userPhone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="userPhone" name="userPhone" placeholder="Enter phone number" value="095454545">
            </div>
            
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="tel" class="form-control" id="position" name="position" placeholder="Enter position" value="IT">
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="tel" class="form-control" id="department" name="department" placeholder="Enter department" value="IT Department">
            </div>

            <div class="mb-3">
                <label for="userRole" class="form-label">User Role</label>
                <select class="form-select" id="userRole" name="userRole">
                    <option value="admin">Admin</option>
                    <option value="editor">Editor</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="userRole" class="form-label">Status</label>
                <select class="form-select" id="userRole" name="userRole">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
        </form>
    </div>
    <div class="offcanvas-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        <button type="submit" class="btn btn-primary" form="editUserForm">Save Changes</button>
    </div>
</div>