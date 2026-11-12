<aside class="wali-sidebar" :class="{ 'is-open': sidebar }">
    <div class="wali-sidebar-brand">
        @if (is_file(public_path('images/logo.png')) && filesize(public_path('images/logo.png')) > 0)
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="wali-sidebar-logo">
        @else
            <span class="wali-sidebar-logo wali-sidebar-logo-fallback" aria-label="Logo SIAKAD">
                <svg class="h-8 w-8 text-sidebar" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75l7.5 3.75v9L12 20.25 4.5 16.5v-9L12 3.75z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75v16.5m7.5-12.75L12 11.25 4.5 7.5"/>
                </svg>
            </span>
        @endif
        <div class="min-w-0">
            <p class="truncate text-[15px] text-white">SIAKAD Panel</p>
            <p class="truncate text-xs text-gold">Portal Wali Murid</p>
        </div>
    </div>

    <nav class="wali-sidebar-nav">
        <div class="wali-sidebar-sections">
            <div>
                <p class="wali-sidebar-label">Informasi Siswa</p>
                <div class="wali-sidebar-items">
                    <a href="{{ route('wali.dashboard') }}"
                       class="wali-menu-item {{ request()->routeIs('wali.dashboard') ? 'is-active' : '' }}">
                        <svg class="wali-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                        Beranda Utama
                    </a>
                    <a href="{{ route('wali.rapor-akademik') }}"
                       class="wali-menu-item {{ request()->routeIs('wali.rapor-akademik') ? 'is-active' : '' }}">
                        <svg class="wali-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        Rapor Akademik
                    </a>
                    <a href="{{ route('wali.kbm-mingguan') }}"
                       class="wali-menu-item {{ request()->routeIs('wali.kbm-mingguan') ? 'is-active' : '' }}">
                        <svg class="wali-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        Jurnal KBM Mingguan
                    </a>
                    <a href="{{ route('wali.jurnal-sikap') }}"
                       class="wali-menu-item {{ request()->routeIs('wali.jurnal-sikap') ? 'is-active' : '' }}">
                        <svg class="wali-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/></svg>
                        Jurnal Sikap &amp; P5
                    </a>
                </div>
            </div>

            <div>
                <p class="wali-sidebar-label">Administrasi</p>
                <div class="wali-sidebar-items">
                    <a href="{{ route('wali.tagihan-pembayaran') }}"
                       class="wali-menu-item {{ request()->routeIs('wali.tagihan-pembayaran', 'wali.tagihan') ? 'is-active' : '' }}">
                        <svg class="wali-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                        Tagihan &amp; Pembayaran
                    </a>
                </div>
            </div>

            <div>
                <p class="wali-sidebar-label">Pengaturan</p>
                <div class="wali-sidebar-items">
                    <a href="{{ route('wali.profil-pengguna') }}"
                       class="wali-menu-item {{ request()->routeIs('wali.profil-pengguna') ? 'is-active' : '' }}">
                        <svg class="wali-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        Profil Akun
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="wali-sidebar-logout">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="wali-menu-item wali-logout-item">
                <svg class="wali-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                Keluar / Logout
            </button>
        </form>
    </div>
</aside>
