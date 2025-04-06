$(function () {
    const $body = $('body');
    const $darkModeToggle = $('#darkModeToggle');
    const $elements = $('.card, .table, .form-control, .form-select, .offcanvas, .offcanvas-header, .offcanvas-footer, .nav-tabs .nav-link, .dt-paging');
    
    const toggleDarkMode = (isDarkMode) => {
        $body.toggleClass('bg-dark text-light', isDarkMode);
        $elements.toggleClass('bg-dark text-light border-light', isDarkMode);
        $('.table').toggleClass('table-dark', isDarkMode);
        $('.pagination').toggleClass('pagination-dark', isDarkMode);
        $darkModeToggle.html(isDarkMode ? '<i class="fas fa-sun fs-5"></i>' : '<i class="fas fa-moon fs-5"></i>');
        localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
    };

    $darkModeToggle.on('click', () => toggleDarkMode(!$body.hasClass('bg-dark')));

    if (localStorage.getItem('theme') === 'dark') toggleDarkMode(true);
    else $darkModeToggle.html('<i class="fas fa-moon fs-5"></i>');
});
