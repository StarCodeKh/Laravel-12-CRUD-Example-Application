<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'StarCodeKh') }}</title>
    <link href='https://www.souysoeng.com/favicon.ico' rel='icon' type='image/x-icon'/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Style Custome -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        .min-vh-75 {
            min-height: 75vh;
        }
    </style>
</head>
<body>
    <div id="app" class="flex-grow-1" style="background-image: radial-gradient(circle, #aca4a675 0%, #b294954e 100%);">
        <!-- Main Content -->
        <main class="d-flex justify-content-center align-items-center min-vh-75">
            @yield('content')
        </main>
    </div>
    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- imessage -->
    <script src="{{ asset('assets/js/imessage.js') }}"></script>
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
    @yield('script')
    
</body>
</html>
