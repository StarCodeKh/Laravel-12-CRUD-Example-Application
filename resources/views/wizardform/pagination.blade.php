@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-8 col-sm-12 mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="fw-bold py-2">Pagination</div>
            <div class="p-2">Pagination - 
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
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        let data = [], filteredData = [], rowsPerPage = 10, currentPage = 1;
        let sortColumn = null, sortDirection = 'asc';
        const excludedColumns = [];

        function capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        function fetchData() {
            $.getJSON('form/get-data/listing', {
                page: currentPage,
                per_page: rowsPerPage,
                search: $('#searchInput').val(),
                sort_by: sortColumn || 'id',
                sort_dir: sortDirection
            }, function (response) {
                data = response.rows;
                renderTableHeader(response.columns);
                renderTable(data);
                renderPagination(response.total);
            });
        }

        function renderTableHeader(columns) {
            const headerHtml = ['<th>Action</th>', ...Object.entries(columns)
                .filter(([col]) => !excludedColumns.includes(col))
                .map(([col, label]) =>
                    `<th class="sortable" data-sort="${col}">${label}</th>`
                )].join('');
            $('#tableHead').html(headerHtml);
        }

        function renderTable(rows) {
            const html = rows.map(user => {
                const cells = Object.entries(user)
                    .filter(([col]) => !excludedColumns.includes(col))
                    .map(([col, val]) => {
                        if (col === 'status') {
                            return `<td><span class="badge ${val === 'Active' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger'}">${val}</span></td>`;
                        }
                        return `<td>${val}</td>`;
                    }).join('');

                return `<tr>
                    <td>
                        <button class="btn btn-sm btn-info me-1"><i class="bi bi-eye"></i></button>
                        <button class="btn btn-sm btn-primary me-1"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </td>
                    ${cells}
                </tr>`;
            }).join('');

            $('#tableBody').html(html);
        }

        function renderPagination(totalItems) {
            const totalPages = Math.ceil(totalItems / rowsPerPage);
            let start = Math.max(1, currentPage - 2);
            let end = Math.min(totalPages, start + 4);
            if (end - start < 4) start = Math.max(1, end - 4);

            const addBtn = (label, page, disabled = false, active = false) => `
                <li class="page-item ${disabled ? 'disabled' : ''} ${active ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${page}">${label}</a>
                </li>`;

            let pagination = addBtn('«', 1, currentPage === 1) + addBtn('‹', currentPage - 1, currentPage === 1);
            for (let i = start; i <= end; i++) {
                pagination += addBtn(i, i, false, currentPage === i);
            }
            pagination += addBtn('›', currentPage + 1, currentPage === totalPages) + addBtn('»', totalPages, currentPage === totalPages);

            $('#pagination').html(pagination);
            $('#rangeInfo').text(`${(currentPage - 1) * rowsPerPage + 1}–${Math.min(currentPage * rowsPerPage, totalItems)} of ${totalItems} records`);
            $('#totalItems').text(totalItems);
        }

        function sortData(column) {
            sortDirection = sortColumn === column && sortDirection === 'asc' ? 'desc' : 'asc';
            sortColumn = column;

            filteredData.sort((a, b) => {
                let A = a[column], B = b[column];
                if (!isNaN(A) && !isNaN(B)) return sortDirection === 'asc' ? A - B : B - A;
                return sortDirection === 'asc' ? A.toString().localeCompare(B.toString()) : B.toString().localeCompare(A.toString());
            });

            currentPage = 1;
            renderTable(currentPage);
            renderPagination();
            updateSortIcons();
        }

        function updateSortIcons() {
            $('.sortable').removeClass('sorted-asc sorted-desc').each(function () {
                if ($(this).data('sort') === sortColumn) {
                    $(this).addClass(sortDirection === 'asc' ? 'sorted-asc' : 'sorted-desc');
                }
            });
        }

        function applySearch(query) {
            const q = query.toLowerCase();
            filteredData = data.filter(u =>
                Object.values(u).some(val => val.toString().toLowerCase().includes(q))
            );
            currentPage = 1;
            renderTable(currentPage);
            renderPagination();
        }

        // Event Listeners
        $(document).ready(() => {
            fetchData();

            $('#entriesPerPage').on('change', function () {
                rowsPerPage = +this.value;
                currentPage = 1;
                renderTable(currentPage);
                renderPagination();
            });

            $('#jumpPage').on('keypress', function (e) {
                if (e.key === 'Enter') {
                    let page = +$(this).val();
                    let total = Math.ceil(filteredData.length / rowsPerPage);
                    if (page >= 1 && page <= total) {
                        currentPage = page;
                        renderTable(currentPage);
                        renderPagination();
                        $(this).val('');
                    }
                }
            });

            $('#searchInput').on('input', function () {
                currentPage = 1;
                fetchData();
            });
        });

        $(document).on('click', '#pagination .page-link', function (e) {
            e.preventDefault();
            const page = +$(this).data('page');
            if (!isNaN(page)) {
                currentPage = page;
                fetchData();
            }
        });

        $(document).on('click', '.sortable', function () {
            const col = $(this).data('sort');
            if (sortColumn === col) {
                sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                sortColumn = col;
                sortDirection = 'asc';
            }
            fetchData();
        });
    </script>
@endsection
@endsection
