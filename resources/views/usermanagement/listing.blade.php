@extends('layouts.master')

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
@include('usermanagement.offcanvas.edit')
@include('usermanagement.offcanvas.view')
<!-- Modal -->
@include('usermanagement.modal.delete')

@section('script')
    @include('usermanagement.include.script')
@endsection
@endsection
