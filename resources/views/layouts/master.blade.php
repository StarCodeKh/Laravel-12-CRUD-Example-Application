<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://www.souysoeng.com/favicon.ico' rel='icon' type='image/x-icon'/>
    <title>{{ config('app.name', 'StarCodeKh') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Include Bootstrap Icons library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">               
    <!-- DataTables Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">

    <!-- Style Custome -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    @yield('style')
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <!-- Sidebar -->
        @include('layouts.sidebar')
    </div>
    
    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>

    <!-- imessage -->
    <script src="{{ asset('assets/js/imessage.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/js/language-switch.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let messages = {
                success: "{{ session('success') }}",
                error: "{{ session('error') }}",
                warning: "{{ session('warning') }}",
                info: "{{ session('info') }}"
            };

            Object.keys(messages).forEach(type => {
                if (messages[type]) {
                    new Message('imessage').show(messages[type], type === "error" ? "fail" : type, "top-center");
                }
            });
        });
    </script>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const logoText = document.querySelector('.logo-text');
            const logoTextSK = document.querySelector('.logo-text.sk');

            sidebar.classList.toggle('collapsed');
            logoText.style.display = 'none';

            if (sidebar.classList.contains('collapsed')) {
                setTimeout(function() {
                    logoText.style.display = 'none';
                    logoTextSK.style.display = 'block';
                }, 200);
            } else {
                setTimeout(function() {
                    logoText.style.display = 'block';
                    logoTextSK.style.display = 'none';
                }, 200);
            }
        }
    </script>

    @yield('script')
    
</body>
</html>
