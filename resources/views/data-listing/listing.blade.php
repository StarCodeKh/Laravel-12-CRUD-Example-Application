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
                <table id="example" class="table table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Last Login</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-info btn-sm" data-bs-toggle="offcanvas" data-bs-target="#viewUser" aria-controls="viewUser">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteUser">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <td>KH-00001</td>
                            <td>Soeng Souy</td>
                            <td>soengsouy@example.com</td>
                            <td>System Architect</td>
                            <td>2011-04-25</td>
                            <td><span class="badge bg-success-subtle text-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteUser">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <td>KH-00002</td>
                            <td>StarCode Kh</td>
                            <td>starcodekh@example.com</td>
                            <td>Software Engineer</td>
                            <td>2015-07-12</td>
                            <td><span class="badge bg-success-subtle text-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <td>KH-00003</td>
                            <td>Jane Smith</td>
                            <td>janesmith@example.com</td>
                            <td>Product Manager</td>
                            <td>2018-03-19</td>
                            <td><span class="badge bg-danger-subtle text-danger">Inactive</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <td>KH-00004</td>
                            <td>Michael Brown</td>
                            <td>michael.brown@example.com</td>
                            <td>HR Specialist</td>
                            <td>2016-05-20</td>
                            <td><span class="badge bg-success-subtle text-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <td>KH-00005</td>
                            <td>Sarah White</td>
                            <td>sarah.white@example.com</td>
                            <td>Marketing Manager</td>
                            <td>2017-02-13</td>
                            <td><span class="badge bg-success-subtle text-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <td>KH-00006</td>
                            <td>David Lee</td>
                            <td>david.lee@example.com</td>
                            <td>Content Strategist</td>
                            <td>2019-08-25</td>
                            <td><span class="badge bg-danger-subtle text-danger">Inactive</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <td>KH-00007</td>
                            <td>Emma Wilson</td>
                            <td>emma.wilson@example.com</td>
                            <td>Project Manager</td>
                            <td>2020-11-03</td>
                            <td><span class="badge bg-success-subtle text-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                        </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <td>KH-00008</td>
                            <td>Lucas Green</td>
                            <td>lucas.green@example.com</td>
                            <td>Data Scientist</td>
                            <td>2021-06-16</td>
                            <td><span class="badge bg-success-subtle text-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <td>KH-00009</td>
                            <td>Olivia Taylor</td>
                            <td>olivia.taylor@example.com</td>
                            <td>UI/UX Designer</td>
                            <td>2022-01-09</td>
                            <td><span class="badge bg-danger-subtle text-danger">Inactive</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <td>KH-00010</td>
                            <td>William Harris</td>
                            <td>william.harris@example.com</td>
                            <td>Business Analyst</td>
                            <td>2023-04-22</td>
                            <td><span class="badge bg-success-subtle text-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <td>KH-00011</td>
                            <td>William Harris</td>
                            <td>william.harris@example.com</td>
                            <td>Business Analyst</td>
                            <td>2023-04-22</td>
                            <td><span class="badge bg-success-subtle text-success">Active</span></td>
                        </tr>
                    </tbody>
                    
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>

<script>
    $('#example').DataTable({
        "paging": true,
        "searching": true,
        "info": true
    });
</script>

@endsection
