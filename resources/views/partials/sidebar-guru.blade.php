<aside class="guru-sidebar" :class="{ 'is-open': sidebar }">
    <div class="guru-sidebar-brand">
        @if (is_file(public_path('images/logo.png')) && filesize(public_path('images/logo.png')) > 0)
            <img src="{{ asset('images/logo.png') }}" alt="Logo"
                 class="guru-sidebar-logo">
        @else
            <span class="guru-sidebar-logo guru-sidebar-logo-fallback" aria-label="Logo SIAKAD">
                <svg class="h-8 w-8 text-sidebar" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75l7.5 3.75v9L12 20.25 4.5 16.5v-9L12 3.75z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75v16.5m7.5-12.75L12 11.25 4.5 7.5"/>
                </svg>
            </span>
        @endif
        <div class="min-w-0">
            <p class="truncate text-[15px] text-white">SIAKAD Panel</p>
            <p class="truncate text-xs text-slate-400">Portal Guru &amp; Akademik</p>
        </div>
    </div>

    <nav class="guru-sidebar-nav">
        <div class="guru-sidebar-sections">
            <div>
                <p class="guru-sidebar-label">Akademik</p>
                <div class="guru-sidebar-items">
                    <a href="{{ route('guru.dashboard') }}"
                       class="guru-menu-item {{ request()->routeIs('guru.dashboard') ? 'is-active' : '' }}">
                        <svg class="guru-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                        Beranda Guru
                    </a>
                    <a href="{{ route('guru.jadwal-mengajar') }}"
                       class="guru-menu-item {{ request()->routeIs('guru.jadwal-mengajar') ? 'is-active' : '' }}">
                        <svg class="guru-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        Jadwal Mengajar
                    </a>
                </div>
            </div>

            <div>
                <p class="guru-sidebar-label">Penilaian &amp; Jurnal</p>
                <div class="guru-sidebar-items">
                    <a href="{{ route('guru.input-nilai') }}"
                       class="guru-menu-item {{ request()->routeIs('guru.input-nilai') ? 'is-active' : '' }}">
                        <svg class="guru-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"/></svg>
                        Input Nilai
                    </a>
                    <a href="{{ route('guru.penilaian-sikap') }}"
                       class="guru-menu-item {{ request()->routeIs('guru.penilaian-sikap') ? 'is-active' : '' }}">
                        <svg class="guru-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                        Penilaian Sikap &amp; P5
                    </a>
                    <a href="{{ route('guru.riwayat-jurnal') }}"
                       class="guru-menu-item {{ request()->routeIs('guru.riwayat-jurnal') ? 'is-active' : '' }}">
                        <svg class="guru-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Riwayat Jurnal
                    </a>
                </div>
            </div>

            <div>
                <p class="guru-sidebar-label">Pengaturan</p>
                <div class="guru-sidebar-items">
                    <a href="{{ route('guru.profil-pengguna') }}"
                       class="guru-menu-item {{ request()->routeIs('guru.profil-pengguna') ? 'is-active' : '' }}">
                        <svg class="guru-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        Profil Pengguna
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="guru-sidebar-logout">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="guru-menu-item guru-logout-item">
                <svg class="guru-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                Keluar / Logout
            </button>
        </form>
    </div>
</aside>
