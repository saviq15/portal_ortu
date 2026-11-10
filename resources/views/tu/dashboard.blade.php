<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Keuangan | SIAKAD Panel</title>

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
            },
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none !important;}</style>
</head>

<body class="bg-slate-50 font-sans text-slate-800 antialiased"
      x-data="{ sidebar: false }"
      @keydown.escape.window="sidebar = false">

<div class="flex min-h-screen">

    {{-- Overlay sidebar (mobile) --}}
    <div x-cloak x-show="sidebar" x-transition.opacity @click="sidebar = false"
         class="fixed inset-0 z-30 bg-slate-900/50 lg:hidden"></div>

    {{-- ===================== SIDEBAR ===================== --}}
    <aside class="fixed inset-y-0 left-0 z-40 flex w-72 flex-col bg-sidebar transition-transform duration-200 lg:sticky lg:top-0 lg:h-screen lg:translate-x-0"
           :class="sidebar ? 'translate-x-0' : '-translate-x-full'">

        {{-- Brand --}}
        <div class="flex items-center gap-3 border-b border-white/10 px-6 py-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo"
                 class="h-14 w-14 shrink-0 rounded-full bg-white object-contain p-0.5 ring-2 ring-gold/60">
            <div class="min-w-0">
                <p class="truncate text-[15px] text-white">SIAKAD Panel</p>
                <p class="truncate text-xs text-slate-400">Portal Tata Usaha</p>
            </div>
        </div>

        {{-- Menu --}}
        <nav class="flex-1 space-y-6 overflow-y-auto px-4 py-6">

            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Keuangan &amp; Administrasi</p>
                <div class="space-y-1">
                    {{-- Menu aktif --}}
                    <a href="{{ route('tu.dashboard') }}" class="flex items-center gap-3 rounded-lg bg-gold px-3 py-2.5 text-sm text-slate-900 shadow-sm">
                        <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                        Beranda TU
                    </a>
                    <a href="{{ route('tu.transaksi-pembayaran') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
                        Transaksi Pembayaran
                    </a>
                    <a href="{{ route ('tu.rekapitulasi-keuangan') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                        Rekapitulasi Keuangan
                    </a>
                </div>
            </div>

            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Pengaturan</p>
                <a href="{{ route('tu.profil-pengguna') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                    <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    Profil Pengguna
                </a>
            </div>
        </nav>

        {{-- Logout --}}
       <div class="border-t border-white/10 p-4">
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                    <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                    </svg>
                Keluar / Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ===================== KONTEN UTAMA ===================== --}}
    <div class="flex min-w-0 flex-1 flex-col">

        {{-- Header --}}
        <header class="sticky top-0 z-20 flex h-16 items-center justify-between gap-3 border-b border-slate-100 bg-white px-4 shadow-sm sm:px-8">
            <div class="flex items-center gap-3">
                <button type="button" @click="sidebar = true" aria-label="Buka menu"
                        class="rounded-lg p-2 text-slate-500 hover:bg-slate-100 lg:hidden">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                </button>
                <h2 class="text-base text-slate-900">Dashboard Keuangan</h2>
            </div>

            <div class="flex items-center gap-3 sm:gap-4">
                <span class="hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700 sm:inline-flex">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Tahun Ajaran 2026/2027
                </span>
                <span class="hidden h-8 w-px bg-slate-200 sm:block"></span>
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-xs font-medium text-slate-700 ring-1 ring-slate-200">NF</div>
                    <div class="hidden leading-tight sm:block">
                        <p class="text-xs text-slate-900">Ibu Nur Fina</p>
                        <p class="text-[10px] text-slate-500">Staf TU</p>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 px-4 py-8 sm:px-8">

            {{-- Judul halaman --}}
            <div>
                <h1 class="text-2xl tracking-tight text-slate-900">Selamat Datang, Ibu Nur Fina!</h1>
                <p class="mt-2 text-sm text-slate-500">Ringkasan transaksi SPP SMK dan Tabungan MI hari ini.</p>
            </div>

            {{-- Kartu ringkasan --}}
            <section class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-3">

                {{-- Pemasukan hari ini --}}
                <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between">
                        <p class="text-[11px] uppercase tracking-wider text-slate-500">Pemasukan Hari Ini</p>
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50 text-brand">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                    </div>
                    <p class="mt-4 text-[28px] leading-none text-brand">Rp 1.450.000</p>
                    <p class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        Dari 6 transaksi
                    </p>
                </div>

                {{-- Tagihan SPP tertunggak --}}
                <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between">
                        <p class="text-[11px] uppercase tracking-wider text-slate-500">Tagihan SPP Tertunggak</p>
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                        </span>
                    </div>
                    <p class="mt-4 text-[28px] leading-none text-red-600">12 Siswa</p>
                    <p class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                        SMK Nusantara
                    </p>
                </div>

                {{-- Total saldo tabungan MI --}}
                <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between">
                        <p class="text-[11px] uppercase tracking-wider text-slate-500">Total Saldo Tabungan MI</p>
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                        </span>
                    </div>
                    <p class="mt-4 text-[28px] leading-none text-emerald-600">Rp 8.200.000</p>
                    <p class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        Akumulasi bulan ini
                    </p>
                </div>
            </section>

            {{-- Transaksi terakhir --}}
            <section class="mt-8">
                <div class="mb-4 flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                    <h3 class="text-lg text-slate-900">Transaksi Terakhir (Hari Ini)</h3>
                    <p class="text-xs text-slate-500">Terakhir diperbarui: Hari ini, 10:15 WIB</p>
                </div>

                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[900px] text-left">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50/60 text-[11px] uppercase tracking-wider text-slate-500">
                                    <th class="py-4 pl-6 pr-4 font-normal lg:pl-[88px]">Waktu</th>
                                    <th class="px-4 py-4 font-normal">Kode Ref</th>
                                    <th class="px-4 py-4 font-normal">Nama Siswa</th>
                                    <th class="px-4 py-4 font-normal">Unit</th>
                                    <th class="px-4 py-4 font-normal">Jenis Transaksi</th>
                                    <th class="px-4 py-4 font-normal">Nominal</th>
                                    <th class="px-4 py-4 text-center font-normal">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-5 pl-6 pr-4 text-slate-700 lg:pl-[88px]">09:15 WIB</td>
                                    <td class="px-4 py-5 text-xs text-slate-500">TRX-001</td>
                                    <td class="px-4 py-5">
                                        <p class="text-slate-900">Ahmad Fauzi</p>
                                        <p class="mt-0.5 text-[11px] text-slate-400">NIS: 20261001</p>
                                    </td>
                                    <td class="px-4 py-5"><span class="inline-flex rounded border border-slate-200 bg-slate-100 px-2.5 py-1 text-xs text-slate-600">SMK Nusantara</span></td>
                                    <td class="px-4 py-5 text-slate-700">SPP Bulan Oktober</td>
                                    <td class="px-4 py-5 text-slate-900">Rp 250.000</td>
                                    <td class="px-4 py-5 text-center">
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Lunas
                                        </span>
                                    </td>
                                </tr>

                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-5 pl-6 pr-4 text-slate-700 lg:pl-[88px]">09:30 WIB</td>
                                    <td class="px-4 py-5 text-xs text-slate-500">TRX-002</td>
                                    <td class="px-4 py-5">
                                        <p class="text-slate-900">Siti Aisyah</p>
                                        <p class="mt-0.5 text-[11px] text-slate-400">NIS: 20262015</p>
                                    </td>
                                    <td class="px-4 py-5"><span class="inline-flex rounded border border-blue-200 bg-blue-50 px-2.5 py-1 text-xs text-blue-700">MI Internasional</span></td>
                                    <td class="px-4 py-5 text-slate-700">Setor Tabungan</td>
                                    <td class="px-4 py-5 text-slate-900">Rp 50.000</td>
                                    <td class="px-4 py-5 text-center">
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Sukses
                                        </span>
                                    </td>
                                </tr>

                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-5 pl-6 pr-4 text-slate-700 lg:pl-[88px]">10:05 WIB</td>
                                    <td class="px-4 py-5 text-xs text-slate-500">TRX-003</td>
                                    <td class="px-4 py-5">
                                        <p class="text-slate-900">Budi Santoso</p>
                                        <p class="mt-0.5 text-[11px] text-slate-400">NIS: 20261002</p>
                                    </td>
                                    <td class="px-4 py-5"><span class="inline-flex rounded border border-slate-200 bg-slate-100 px-2.5 py-1 text-xs text-slate-600">SMK Nusantara</span></td>
                                    <td class="px-4 py-5 text-slate-700">Seragam Olahraga</td>
                                    <td class="px-4 py-5 text-slate-900">Rp 150.000</td>
                                    <td class="px-4 py-5 text-center">
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-xs text-amber-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>Cicilan
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- route('transaksi.index') --}}
                    {{-- Footer tabel --}}
                    <div class="flex flex-col gap-2 border-t border-slate-200 px-6 py-4 text-xs sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-slate-500">Menampilkan 3 transaksi terbaru hari ini</p>
                        <a href="#" class="inline-flex items-center gap-1.5 text-brand transition hover:text-brand-dark">
                            Lihat Semua Transaksi
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </a>
                    </div>
                </div>
            </section>

            {{-- Info bar --}}
            <div class="mt-8 flex flex-col gap-2 border-t border-slate-200 pt-5 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Sistem Pembayaran &amp; Rekapitulasi Keuangan terintegrasi Yayasan Nurun 'Alannur.
                </p>
                <span class="text-slate-400">SIAKAD v2.4.0</span>
            </div>
        </main>
    </div>
</div>

</body>
</html>