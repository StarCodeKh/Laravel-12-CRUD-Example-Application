@extends('layouts.master')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Include Bootstrap Icons library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">               
    <!-- DataTables Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-8 col-sm-12 mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="fw-bold py-2">Data Listing</div>
            <div class="p-2">Data Listing - 
                <a href="{{ route('home') }}" class="text-decoration-none fw-semibold">Dashboard</a>
            </div>
        </div>
        <div class="card p-3 shadow-sm">
            <div class="table-responsive">
                <table id="userListing" class="table table-striped nowrap">
                    <thead>
                        <tr>
                            <th class="th-active-fixed">Actions</th>
                            <th>No</th>
                            <th>Name</th>
                            <th>User ID</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Phone</th>
                            <th>Join Date</th>
                            <th>Last Login</th>
                            <th>Role</th>
                            <th>Departement</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- offcanvas -->
@include('data-listing.offcanvas.edit')
@include('data-listing.offcanvas.view')
<!-- Modal -->
@include('data-listing.modal.delete')

@section('script')
    <script>
        $(document).ready(function() {
            const table = $('#userListing').DataTable({
                lengthMenu: [
                    [10, 25, 50, 100, 150],
                    [10, 25, 50, 100, 150]
                ],
                buttons: ['pageLength'],
                pageLength: 10,
                order: [[5, 'desc']],
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('get-data-user.listing') }}",
                },
                columns: [
                    { data: 'action', orderable: false, searchable: false },
                    { data: 'no' },
                    { data: 'name' },
                    { data: 'user_id' },
                    { data: 'email' },
                    { data: 'position' },
                    { data: 'phone_number' },
                    { data: 'join_date' },
                    { data: 'last_login' },
                    { data: 'role_name' },
                    { data: 'department' },
                    { data: 'status' },
                ]
            });
        });
    </script>
@endsection
@endsection
