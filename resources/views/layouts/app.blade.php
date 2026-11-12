<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIAKAD Panel')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Roboto', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
                    colors: {
                        brand:   { DEFAULT: '#7F1D1D', dark: '#661717' },
                        sidebar: '#1E2433',
                        gold:    '#D4AF37',
                    },
                },
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/layout-base.css') }}" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none !important;}</style>
    @stack('styles')
</head>

<body class="bg-slate-50 font-sans text-slate-800 antialiased"
      x-data="@yield('page_data', '{ sidebar: false }')"
      @keydown.escape.window="@yield('escape_action', 'sidebar = false')">
    <div class="app-shell @yield('shell_class')" @yield('shell_attributes')>
        @yield('sidebar')

        <div class="app-main @yield('main_class')">
            @yield('topbar')
            <div class="app-content-scroll">
                @yield('content')
            </div>
        </div>
    </div>

    @yield('outside_content')
    @stack('scripts')
</body>
</html>
