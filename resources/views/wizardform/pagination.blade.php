@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-8 col-sm-12 mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="fw-bold py-2">Pagination</div>
            <div class="p-2">
                Pagination -
                <a href="{{ route('home') }}" class="text-decoration-none fw-semibold">Dashboard</a>
            </div>
        </div>
        <div class="card p-3 shadow-sm">
            <div class="table-responsive">
                <!-- Top: Search + Show Entries -->
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <!-- Left: Show entries -->
                    <div class="d-flex align-items-center gap-2">
                        <label for="entriesPerPage" class="form-label mb-0 small">Show</label>
                        <select id="entriesPerPage" class="form-select form-select-sm">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        <span class="small">entries</span>
                    </div>

                    <!-- Right: Search input -->
                    <div class="d-flex align-items-center gap-2">
                        <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search...">
                    </div>
                </div>

                <!-- Table -->
                <div id="tableScrollWrapper">
                    <table class="table table-striped nowrap">
                        <thead>
                            <tr id="tableHead">
                                <!-- Generated dynamically -->
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- Generated dynamically -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination + Go to + Info -->
                <nav class="container-fluid">
                    <div class="row align-items-center justify-content-between flex-wrap gap-2">
                        <!-- Left: Range Info -->
                        <div class="col-auto">
                            <div class="small text-muted" id="rangeInfo"></div>
                        </div>

                        <!-- Center: Pagination + Go to input -->
                        <div class="col">
                            <div class="d-flex justify-content-center align-items-center flex-wrap gap-3">
                                <ul class="pagination mb-0" id="pagination">
                                    <!-- Filled by JS -->
                                </ul>
                                <div class="d-flex align-items-center gap-2">
                                    <input type="number" id="jumpPage" class="form-control form-control-sm" min="1" style="width: 60px !important;">
                                    <span class="text-muted small">of <span id="totalItems"></span> records</span>
                                </div>
                            </div>
                            <!-- Laravel Route URL -->
                            <meta name="listing-url" content="{{ route('form.get-data.listing') }}">
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/listing-data-table.js') }}"></script>
@endsection