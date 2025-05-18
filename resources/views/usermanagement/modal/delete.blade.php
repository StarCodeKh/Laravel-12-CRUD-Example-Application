<!-- Modal for Delete User Confirmation -->
<div class="modal fade" id="modalDeleteUser" tabindex="-1" aria-labelledby="modalDeleteUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('delete-user') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteUserLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Are you sure you want to delete the user <strong class="text-danger" id="d_name"></strong>?
                </div>
                <input type="hidden" id="d_user_id" name="user_id">
                <input type="hidden" id="d_image-circle" name="avatar">
                
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-danger" id="confirmDeleteUser">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>