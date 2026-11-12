<aside class="admin-sidebar" :class="{ 'is-open': sidebar }">
    <div class="admin-sidebar-brand">
        @if (is_file(public_path('images/logo.png')) && filesize(public_path('images/logo.png')) > 0)
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="admin-sidebar-logo">
        @else
            <span class="admin-sidebar-logo admin-sidebar-logo-fallback" aria-label="Logo SIAKAD">
                <svg class="h-8 w-8 text-sidebar" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75l7.5 3.75v9L12 20.25 4.5 16.5v-9L12 3.75z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75v16.5m7.5-12.75L12 11.25 4.5 7.5"/>
                </svg>
            </span>
        @endif
        <div class="min-w-0">
            <p class="truncate text-base font-bold text-white">SIAKAD Panel</p>
            <p class="truncate text-xs text-slate-400">Yayasan Nurun 'Alannur</p>
        </div>
    </div>

    <nav class="admin-sidebar-nav">
        <div class="admin-sidebar-sections">
            <div>
                <p class="admin-sidebar-label">Utama</p>
                <div class="admin-sidebar-items">
                    <a href="{{ route('admin.dashboard') }}"
                       class="admin-menu-item {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                        <svg class="admin-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                        Dashboard
                    </a>
                </div>
            </div>

            <div>
                <p class="admin-sidebar-label">Data Master</p>
                <div class="admin-sidebar-items">
                    <a href="{{ route('admin.kelas.view') }}"
                       class="admin-menu-item {{ request()->routeIs('admin.kelas.*') ? 'is-active' : '' }}">
                        <svg class="admin-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
                        Data Kelas
                    </a>
                    <a href="{{ route('admin.pengguna.view') }}"
                       class="admin-menu-item {{ request()->routeIs('admin.pengguna.*') ? 'is-active' : '' }}">
                        <svg class="admin-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                        Data Pengguna
                    </a>
                </div>
            </div>

            <div>
                <p class="admin-sidebar-label">Pengaturan</p>
                <div class="admin-sidebar-items">
                    <a href="{{ route('admin.tahun-ajaran') }}"
                       class="admin-menu-item {{ request()->routeIs('admin.tahun-ajaran') ? 'is-active' : '' }}">
                        <svg class="admin-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        Tahun Ajaran
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="admin-sidebar-logout">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="admin-menu-item admin-logout-item">
                <svg class="admin-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                Keluar / Logout
            </button>
        </form>
    </div>
</aside>
