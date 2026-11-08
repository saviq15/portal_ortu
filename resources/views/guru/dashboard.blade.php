<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Guru | SIAKAD Panel</title>

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
                <p class="truncate text-xs text-slate-400">Portal Guru &amp; Akademik</p>
            </div>
        </div>

        {{-- Menu --}}
        <nav class="flex-1 space-y-6 overflow-y-auto px-4 py-6">

            {{-- AKADEMIK --}}
            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Akademik</p>
                <div class="space-y-1">
                    {{-- Menu aktif --}}
                    <a href="#" class="flex items-center gap-3 rounded-lg bg-gold px-3 py-2.5 text-sm text-slate-900 shadow-sm">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                        Beranda Guru
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        Jadwal Mengajar
                    </a>
                </div>
            </div>

            {{-- PENILAIAN & JURNAL --}}
            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Penilaian &amp; Jurnal</p>
                <div class="space-y-1">
                    <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"/></svg>
                        Input Nilai
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                        Penilaian Sikap &amp; P5
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Riwayat Jurnal
                    </a>
                </div>
            </div>

            {{-- PENGATURAN --}}
            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Pengaturan</p>
                <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    Profil Pengguna
                </a>
            </div>
        </nav>

        {{-- Logout --}}
        <div class="border-t border-white/10 p-4">
            <a href="#" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                Keluar / Logout
            </a>
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
                <h2 class="text-base text-slate-900">Dashboard Guru</h2>
            </div>

            <div class="flex items-center gap-3 sm:gap-4">
                <span class="hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700 sm:inline-flex">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Tahun Ajaran 2026/2027
                </span>
                <span class="hidden h-8 w-px bg-slate-200 sm:block"></span>
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-50 text-xs font-medium text-blue-700 ring-1 ring-blue-100">HS</div>
                    <div class="hidden leading-tight sm:block">
                        <p class="text-xs text-slate-900">Bapak Heri Susanto</p>
                        <p class="text-[10px] text-slate-500">Guru Kejuruan</p>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 space-y-6 px-4 py-8 sm:px-8">

            {{-- Kartu selamat datang --}}
            <section class="rounded-xl bg-white px-6 py-6 shadow-sm ring-1 ring-slate-200">
                <h1 class="text-2xl tracking-tight text-slate-800">Selamat Datang, Bapak Heri Susanto!</h1>
                <p class="mt-1.5 text-sm text-slate-500">Berikut adalah ringkasan aktivitas akademik dan jadwal mengajar Anda hari ini.</p>
            </section>

            {{-- Kartu ringkasan --}}
            <section class="grid grid-cols-1 gap-6 md:grid-cols-3">

                {{-- Total Kelas Diajar --}}
                <div class="rounded-xl bg-white px-6 py-6 shadow-sm ring-1 ring-slate-200">
                    <p class="text-xs uppercase tracking-wider text-slate-500">Total Kelas Diajar</p>
                    <p class="mt-2 text-4xl text-slate-800">4</p>
                    <div class="mt-4 border-t border-slate-100 pt-4">
                        <p class="text-xs text-slate-500">Kelas X &amp; XI SMK Nusantara</p>
                    </div>
                </div>

                {{-- Beban Jam Pelajaran --}}
                <div class="rounded-xl bg-white px-6 py-6 shadow-sm ring-1 ring-slate-200">
                    <p class="text-xs uppercase tracking-wider text-slate-500">Beban Jam Pelajaran</p>
                    <p class="mt-2 text-4xl text-slate-800">24</p>
                    <div class="mt-4 border-t border-slate-100 pt-4">
                        <p class="text-xs text-slate-500">Jam / Minggu</p>
                    </div>
                </div>

                {{-- Jurnal Belum Diisi --}}
                <div class="rounded-xl bg-white px-6 py-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between gap-2">
                        <p class="text-xs uppercase tracking-wider text-slate-500">Jurnal Belum Diisi</p>
                        <span class="rounded border border-red-200 bg-red-50 px-2 py-0.5 text-[10px] text-red-600">Perlu Tindakan</span>
                    </div>
                    <p class="mt-1 text-4xl text-red-600">2</p>
                    <div class="mt-4 border-t border-slate-100 pt-4">
                        <p class="flex items-center gap-2 text-xs text-red-600">
                            <svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Segera lengkapi nilai hari ini
                        </p>
                    </div>
                </div>
            </section>

            {{-- Jadwal mengajar --}}
            <section>
                <div class="mb-4 mt-8 flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                    <h3 class="text-lg text-slate-800">Jadwal Mengajar Hari Ini (Senin)</h3>
                    <p class="text-xs text-slate-400">Semester Ganjil 2026/2027</p>
                </div>

                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[820px] text-left">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50/60 text-[11px] uppercase tracking-wider text-slate-500">
                                    <th class="py-4 pl-6 pr-4 font-normal lg:pl-[88px]">Waktu</th>
                                    <th class="px-4 py-4 font-normal">Kelas</th>
                                    <th class="px-4 py-4 font-normal">Mata Pelajaran</th>
                                    <th class="px-4 py-4 font-normal">Ruang</th>
                                    <th class="px-4 py-4 text-center font-normal">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-[18px] pl-6 pr-4 lg:pl-[88px]">
                                        <span class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-500"></span>07:30 - 09:00</span>
                                    </td>
                                    <td class="px-4 py-[18px]">X TKJ 1</td>
                                    <td class="px-4 py-[18px] text-slate-700">Dasar Jaringan</td>
                                    <td class="px-4 py-[18px]"><span class="inline-flex rounded border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs text-slate-600">Lab Komputer 1</span></td>
                                    <td class="px-4 py-[18px] text-center">
                                        <a href="#" class="inline-flex items-center gap-1.5 rounded-full bg-brand px-4 py-1.5 text-xs text-white shadow-sm transition hover:bg-brand-dark">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                                            Isi Jurnal
                                        </a>
                                    </td>
                                </tr>

                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-[18px] pl-6 pr-4 lg:pl-[88px]">
                                        <span class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-amber-500"></span>09:30 - 11:00</span>
                                    </td>
                                    <td class="px-4 py-[18px]">XI TKR 1</td>
                                    <td class="px-4 py-[18px] text-slate-700">Mesin Otomotif</td>
                                    <td class="px-4 py-[18px]"><span class="inline-flex rounded border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs text-slate-600">Bengkel Utama</span></td>
                                    <td class="px-4 py-[18px] text-center">
                                        <a href="#" class="inline-flex items-center gap-1.5 rounded-full bg-brand px-4 py-1.5 text-xs text-white shadow-sm transition hover:bg-brand-dark">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                                            Isi Jurnal
                                        </a>
                                    </td>
                                </tr>

                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-[18px] pl-6 pr-4 text-slate-500 lg:pl-[88px]">
                                        <span class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-slate-300"></span>11:00 - 12:30</span>
                                    </td>
                                    <td class="px-4 py-[18px] text-slate-600">X TKJ 2</td>
                                    <td class="px-4 py-[18px] text-slate-500">Dasar Jaringan</td>
                                    <td class="px-4 py-[18px]"><span class="inline-flex rounded border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs text-slate-500">Lab Komputer 2</span></td>
                                    <td class="px-4 py-[18px] text-center">
                                        <span class="inline-flex cursor-not-allowed items-center gap-1.5 rounded-full border border-slate-200 bg-slate-50 px-4 py-1.5 text-xs text-slate-400">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Menunggu Waktu
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            {{-- Info bar --}}
            <div class="flex flex-col gap-2 pt-2 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Jurnal dan Penilaian terintegrasi secara otomatis ke Rapor Digital Siswa Yayasan Nurun 'Alannur.
                </p>
                <span>SIAKAD v2.4.0</span>
            </div>
        </main>
    </div>
</div>

</body>
</html>