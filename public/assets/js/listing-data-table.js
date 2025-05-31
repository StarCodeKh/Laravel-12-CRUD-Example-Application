// listing.js
let data = [],
    rowsPerPage = 10,
    currentPage = 1,
    sortColumn = null,
    sortDirection = 'asc',
    excludedColumns = [],
    listingUrl = $('meta[name="listing-url"]').attr('content');

function setListingUrl(url) {
    listingUrl = url;
    currentPage = 1;
    fetchData();
}

function fetchData() {
    $.getJSON(listingUrl, {
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
        updateSortIcons();
    });
}

function renderTableHeader(columns) {
    const entries = Object.entries(columns).filter(([col]) => !excludedColumns.includes(col));
    const lastIndex = entries.length - 1;

    const headerHtml = entries.map(([col, label], index) =>
        `<th class="sortable ${index === lastIndex ? 'fixed-last' : ''}" data-sort="${col}">${label}</th>`
    ).join('');

    $('#tableHead').html(headerHtml);
}

function renderTable(rows) {
    const html = rows.map(user => {
        const entries = Object.entries(user).filter(([col]) => !excludedColumns.includes(col));
        const lastIndex = entries.length - 1;

        const cells = entries.map(([col, val], index) =>
            `<td class="${index === lastIndex ? 'fixed-last' : ''}">${val}</td>`
        ).join('');

        return `<tr>${cells}</tr>`;
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

function updateSortIcons() {
    $('.sortable').removeClass('sorted-asc sorted-desc').each(function () {
        if ($(this).data('sort') === sortColumn) {
            $(this).addClass(sortDirection === 'asc' ? 'sorted-asc' : 'sorted-desc');
        }
    });
}

// Event Listeners
$(document).ready(() => {
    fetchData();

    $('#entriesPerPage').on('change', function () {
        rowsPerPage = +this.value;
        currentPage = 1;
        fetchData();
    });

    $('#jumpPage').on('keypress', function (e) {
        if (e.key === 'Enter') {
            let page = +$(this).val();
            if (page >= 1) {
                currentPage = page;
                fetchData();
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
