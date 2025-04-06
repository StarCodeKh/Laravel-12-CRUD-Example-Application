$(document).ready(function() {
    let lang = localStorage.getItem('lang') || 'kh';
    if (lang === 'en') {
        $('#language-flag').attr('src', 'https://flagcdn.com/w40/us.png').attr('alt', 'en');
    } else {
        $('#language-flag').attr('src', 'https://flagcdn.com/w40/kh.png').attr('alt', 'kh');
    }
    $('#language-switch').on('click', function(e) {
        e.preventDefault();

        let currentAlt = $('#language-flag').attr('alt');
        if (currentAlt === 'kh') {
            $('#language-flag').attr('src', 'https://flagcdn.com/w40/us.png').attr('alt', 'en');
            localStorage.setItem('lang', 'en');
        } else {
            $('#language-flag').attr('src', 'https://flagcdn.com/w40/kh.png').attr('alt', 'kh');
            localStorage.setItem('lang', 'kh');
        }
    });
});