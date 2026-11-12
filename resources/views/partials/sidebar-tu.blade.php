<aside class="tu-sidebar" :class="{ 'is-open': sidebar }">
    <div class="tu-sidebar-brand">
        @if (is_file(public_path('images/logo.png')) && filesize(public_path('images/logo.png')) > 0)
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="tu-sidebar-logo">
        @else
            <span class="tu-sidebar-logo tu-sidebar-logo-fallback" aria-label="Logo SIAKAD">
                <svg class="h-8 w-8 text-sidebar" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75l7.5 3.75v9L12 20.25 4.5 16.5v-9L12 3.75z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75v16.5m7.5-12.75L12 11.25 4.5 7.5"/>
                </svg>
            </span>
        @endif
        <div class="min-w-0">
            <p class="truncate text-[15px] text-white">SIAKAD Panel</p>
            <p class="truncate text-xs text-slate-400">Portal Tata Usaha</p>
        </div>
    </div>

    <nav class="tu-sidebar-nav">
        <div class="tu-sidebar-sections">
            <div>
                <p class="tu-sidebar-label">Keuangan &amp; Administrasi</p>
                <div class="tu-sidebar-items">
                    <a href="{{ route('tu.dashboard') }}"
                       class="tu-menu-item {{ request()->routeIs('tu.dashboard') ? 'is-active' : '' }}">
                        <svg class="tu-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                        Beranda TU
                    </a>
                    <a href="{{ route('tu.transaksi-pembayaran') }}"
                       class="tu-menu-item {{ request()->routeIs('tu.transaksi-pembayaran', 'tu.tagihan', 'tu.pembayaran') ? 'is-active' : '' }}">
                        <svg class="tu-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
                        Transaksi Pembayaran
                    </a>
                    <a href="{{ route('tu.rekapitulasi-keuangan') }}"
                       class="tu-menu-item {{ request()->routeIs('tu.rekapitulasi-keuangan') ? 'is-active' : '' }}">
                        <svg class="tu-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                        Rekapitulasi Keuangan
                    </a>
                </div>
            </div>

            <div>
                <p class="tu-sidebar-label">Pengaturan</p>
                <div class="tu-sidebar-items">
                    <a href="{{ route('tu.profil-pengguna') }}"
                       class="tu-menu-item {{ request()->routeIs('tu.profil-pengguna') ? 'is-active' : '' }}">
                        <svg class="tu-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        Profil Pengguna
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="tu-sidebar-logout">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="tu-menu-item tu-logout-item">
                <svg class="tu-menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                Keluar / Logout
            </button>
        </form>
    </div>
</aside>
