@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="d-flex justify-content-between mb-3">
            <div class="fw-bold">File Listing</div>
            <div>
                <a href="{{ route('home') }}" class="fw-semibold text-decoration-none">Dashboard</a>
            </div>
        </div>
        <div class="card p-3 shadow-sm">
            <div class="table-responsive">
                <table id="fileListing" class="table table-striped nowrap w-100">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>No</th>
                            <th>File Name</th>
                            <th>Upload Name</th>
                            <th>Date Uploaded</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="modalDeleteFile" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('delete-file') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Delete File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    Are you sure you want to delete <strong id="d_name" class="text-danger"></strong>?
                </div>
                <input type="hidden" id="d_filename" name="filename">
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function() {
        const table = $('#fileListing').DataTable({
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            buttons: ['pageLength'],
            pageLength: 10,
            order: [[4, 'desc']],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('get-data-file.listing') }}",
            columns: [
                { data: 'action', orderable: false, searchable: false },
                { data: 'id' },
                { data: 'filename' },
                { data: 'upload_name' },
                { data: 'uploaded_at' },
            ]
        });

        $(document).on('click', '.fileDelete', function() {
            const filename = $(this).data('filename');
            $('#d_filename').val(filename);
            $('#d_name').text(filename);
            $('#modalDeleteFile').modal('show');
        });
    });
</script>
@endsection