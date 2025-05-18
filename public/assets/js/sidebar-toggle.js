$(function () {
    const submenuKey = 'openSubmenus';
    const $sidebar = $('.sidebar');
    const $logoText = $('.logo-text').not('.sk');
    const $logoTextSK = $('.logo-text.sk');

    // Sidebar toggle
    $('.toggle-btn').on('click', function () {
        $sidebar.toggleClass('collapsed');

        if ($sidebar.hasClass('collapsed')) {
            const openSubmenus = $('.collapse.show').map(function () {
                const $submenu = $(this);
                const id = $submenu.attr('id');
                $submenu.collapse('hide');
                $(`a[href="#${id}"]`).attr('aria-expanded', 'false');
                return id;
            }).get();

            sessionStorage.setItem(submenuKey, JSON.stringify(openSubmenus));
            $logoText.hide();
            $logoTextSK.show();
        } else {
            const savedSubmenus = JSON.parse(sessionStorage.getItem(submenuKey) || '[]');
            savedSubmenus.forEach(id => {
                const $submenu = $('#' + id);
                $submenu.collapse('show');
                $(`a[href="#${id}"]`).attr('aria-expanded', 'true');
            });
            $logoText.show();
            $logoTextSK.hide();
        }
    });

    // Handle submenu caret and sidebar auto-expand
    $('a[data-bs-toggle="collapse"]').each(function () {
        const $link = $(this);
        const targetId = $link.attr('href');
        const $submenu = $(targetId);
        const $caret = $link.find('.toggle-caret');

        // Initial caret state
        $caret.toggleClass('fa-caret-down', $submenu.hasClass('show'));
        $caret.toggleClass('fa-caret-right', !$submenu.hasClass('show'));

        // Update on show/hide
        $submenu.on('show.bs.collapse', function () {
            $caret.removeClass('fa-caret-right').addClass('fa-caret-down');
            $link.attr('aria-expanded', 'true');
        }).on('hide.bs.collapse', function () {
            $caret.removeClass('fa-caret-down').addClass('fa-caret-right');
            $link.attr('aria-expanded', 'false');
        });

        // Auto-expand sidebar if collapsed
        $link.on('click', function (e) {
            if ($sidebar.hasClass('collapsed')) {
                e.preventDefault();
                $sidebar.removeClass('collapsed');
                $logoText.show();
                $logoTextSK.hide();

                setTimeout(() => {
                    $submenu.collapse('show');
                    $link.attr('aria-expanded', 'true');
                }, 200);
            }
        });
    });

    // Restore logo state on page load
    if ($sidebar.hasClass('collapsed')) {
        $logoText.hide();
        $logoTextSK.show();
    } else {
        $logoText.show();
        $logoTextSK.hide();
    }
});
