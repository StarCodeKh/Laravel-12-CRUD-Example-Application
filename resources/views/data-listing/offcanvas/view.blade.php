<style>
    .offcanvas {
        width: 40% !important;
        box-shadow: -2px 0 10px rgba(229, 226, 226, 0.387);
    }
</style>

<!-- Offcanvas for View User Information -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="viewUser" aria-labelledby="viewUserLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="viewUserLabel">View User Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <form id="">
            <div class="mb-3 text-center">
                <div class="d-flex justify-content-center">
                    <span class="input-group-text p-2 rounded-4">
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
                <input type="text" class="form-control" id="userName" name="userName" value="Soeng Souy" readonly>
            </div>

            <div class="mb-3">
                <label for="userEmail" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="userEmail" name="userEmail" value="soengsouy@example.com" readonly>
            </div>

            <div class="mb-3">
                <label for="userPhone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="userPhone" name="userPhone" value="095454545" readonly>
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" id="position" name="position" value="IT" readonly>
            </div>

            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department" value="IT Department" readonly>
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
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
        </form>
    </div>

    <div class="offcanvas-footer p-3">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
    </div>
</div>
