<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Evaluasi Karakter & P5 | SIAKAD Panel</title>

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
      x-data="sikapPage()"
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

            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Akademik</p>
                <div class="space-y-1">
                    <a href="{{ route('guru.dashboard')}}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                        Beranda Guru
                    </a>
                    <a href="{{ route('guru.jadwal-mengajar') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        Jadwal Mengajar
                    </a>
                </div>
            </div>

            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Penilaian &amp; Jurnal</p>
                <div class="space-y-1">
                    <a href="{{ route('guru.input-nilai')}}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"/></svg>
                        Input Nilai
                    </a>
                    {{-- Menu aktif --}}
                    <a href="{{ route('guru.penilaian-sikap') }}" class="flex items-center gap-3 rounded-lg bg-gold px-3 py-2.5 text-sm text-slate-900 shadow-sm">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                        Penilaian Sikap &amp; P5
                    </a>
                    <a href="{{ route('guru.riwayat-jurnal') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Riwayat Jurnal
                    </a>
                </div>
            </div>

            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Pengaturan</p>
                <a href="{{ route('guru.profil-pengguna')}}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    Profil Pengguna
                </a>
            </div>
        </nav>

        {{-- Logout --}}
        <div class="border-t border-white/10 p-4">
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
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
                <h2 class="text-base text-slate-900">Evaluasi Karakter &amp; P5</h2>
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

        <main class="flex-1 px-4 py-8 sm:px-8">

            {{-- Judul halaman --}}
            <div>
                <h1 class="text-2xl tracking-tight text-slate-800">Buku Catatan Sikap &amp; Proyek P5</h1>
                <p class="mt-2 text-sm text-slate-500">Evaluasi perkembangan karakter dan observasi dimensi Profil Pelajar Pancasila.</p>
            </div>
            {{-- {{ route('penilaian-sikap') }} --}}
            {{-- Form (filter + tabel) --}}
            <form action="#" method="POST" @submit.prevent="simpan()">
                @csrf

                {{-- Kartu filter --}}
                <div class="mt-8 flex flex-col gap-4 rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-200 md:flex-row md:items-end md:justify-between">
                    <div class="flex flex-col gap-4 sm:flex-row">
                        {{-- Rombongan belajar --}}
                        <div class="w-full sm:w-56">
                            <label for="kelas" class="mb-1.5 block text-[11px] uppercase tracking-wider text-slate-500">Rombongan Belajar</label>
                            <div class="relative">
                                <select id="kelas" name="kelas" x-model="kelas"
                                        class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-3 pr-9 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                                    <template x-for="k in daftarKelas" :key="k">
                                        <option :value="k" x-text="k"></option>
                                    </template>
                                </select>
                                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                                </span>
                            </div>
                        </div>

                        {{-- Dimensi P5 --}}
                        <div class="w-full sm:w-64">
                            <label for="dimensi" class="mb-1.5 block text-[11px] uppercase tracking-wider text-slate-500">Dimensi P5</label>
                            <div class="relative">
                                <select id="dimensi" name="dimensi" x-model="dimensi"
                                        class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-3 pr-9 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                                    <template x-for="d in daftarDimensi" :key="d">
                                        <option :value="d" x-text="d"></option>
                                    </template>
                                </select>
                                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-5 py-2.5 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        Simpan Evaluasi
                    </button>
                </div>

                {{-- Tabel penilaian sikap --}}
                <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[820px] text-left">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50/60 text-[11px] uppercase tracking-wider text-slate-500">
                                    <th class="w-24 py-4 pl-6 pr-2 text-center font-normal">No</th>
                                    <th class="px-4 py-4 font-normal">Nama Siswa</th>
                                    <th class="px-4 py-4 font-normal">Predikat Sikap</th>
                                    <th class="py-4 pl-4 pr-6 font-normal">Deskripsi Observasi (Opsional)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                                <template x-for="(s, i) in siswa" :key="kelas + s.nis">
                                    <tr class="transition hover:bg-slate-50/40">
                                        <td class="py-4 pl-6 pr-2 text-center text-slate-500" x-text="i + 1"></td>

                                        <td class="px-4 py-4">
                                            <p class="text-slate-900" x-text="s.nama"></p>
                                            <p class="mt-0.5 text-[11px] text-slate-400" x-text="'NIS: ' + s.nis"></p>
                                        </td>

                                        {{-- Predikat sikap --}}
                                        <td class="px-4 py-4">
                                            <div class="relative w-48">
                                                <select x-model="s.predikat" :name="'siswa[' + s.nis + '][predikat]'"
                                                        class="block w-full appearance-none rounded-lg border py-2 pl-3 pr-8 text-xs transition focus:outline-none focus:ring-2"
                                                        :class="warna(s.predikat).select">
                                                    <template x-for="p in predikat" :key="p.kode">
                                                        <option :value="p.kode" x-text="p.label"></option>
                                                    </template>
                                                </select>
                                                <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center"
                                                      :class="warna(s.predikat).icon">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                                                </span>
                                            </div>
                                        </td>

                                        {{-- Deskripsi observasi --}}
                                        <td class="py-4 pl-4 pr-6">
                                            <input type="text" x-model="s.deskripsi" placeholder="Tambahkan catatan..."
                                                   :name="'siswa[' + s.nis + '][deskripsi]'"
                                                   class="block w-full min-w-[260px] max-w-[390px] rounded-lg border border-slate-200 bg-white px-[38px] py-2.5 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                                        </td>
                                    </tr>
                                </template>

                                <tr x-cloak x-show="siswa.length === 0">
                                    <td colspan="4" class="px-6 py-12 text-center text-sm text-slate-400">Belum ada data siswa pada rombongan belajar ini.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Bar info --}}
                    <div class="flex items-center gap-2.5 border-t border-sky-100 bg-sky-50 px-6 py-4 text-xs text-sky-800">
                        <svg class="h-4 w-4 shrink-0 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                        <p>Catatan: Deskripsi observasi akan otomatis masuk ke dalam lampiran Rapor P5 siswa di akhir semester.</p>
                    </div>
                </div>
            </form>

            {{-- Info bar --}}
            <div class="mt-6 flex flex-col gap-2 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Jurnal dan Penilaian terintegrasi secara otomatis ke Rapor Digital Siswa.
                </p>
                <span>SIAKAD v2.4.0</span>
            </div>
        </main>
    </div>
</div>

{{-- Notifikasi simpan (simulasi) --}}
<div x-cloak x-show="toast" x-transition
     class="fixed bottom-6 right-6 z-50 flex items-center gap-2.5 rounded-lg bg-slate-900 px-4 py-3 text-sm text-white shadow-xl">
    <svg class="h-4 w-4 text-emerald-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
    <span x-text="'Evaluasi ' + kelas + ' - ' + dimensi + ' berhasil disimpan.'"></span>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('sikapPage', () => ({
            sidebar: false,
            toast: false,
            toastTimer: null,

            kelas: 'X TKJ 1',
            dimensi: 'Bergotong Royong',
            daftarKelas: ['X TKJ 1', 'X TKJ 2', 'XI TKR 1', 'XI TKR 2'],
            daftarDimensi: [
                'Beriman, Bertakwa kepada Tuhan YME & Berakhlak Mulia',
                'Berkebinekaan Global',
                'Bergotong Royong',
                'Mandiri',
                'Bernalar Kritis',
                'Kreatif',
            ],

            predikat: [
                { kode: 'SB', label: 'Sangat Baik (SB)' },
                { kode: 'B',  label: 'Baik (B)' },
                { kode: 'C',  label: 'Cukup (C)' },
                { kode: 'K',  label: 'Kurang (K)' },
            ],

            // Data dummy (frontend saja)
            data: {
                'X TKJ 1': [
                    { nis: '20261001', nama: 'Ahmad Fauzi',   predikat: 'SB', deskripsi: 'Siswa sangat aktif membantu teman saat praktikum jaringan.' },
                    { nis: '20261002', nama: 'Budi Santoso',  predikat: 'C',  deskripsi: 'Perlu bimbingan lebih dalam pembagian tugas kelompok.' },
                    { nis: '20261003', nama: 'Citra Lestari', predikat: 'B',  deskripsi: '' },
                ],
                'X TKJ 2': [
                    { nis: '20261011', nama: 'Muhammad Rizki', predikat: 'B',  deskripsi: '' },
                    { nis: '20261012', nama: 'Siti Aisyah',    predikat: 'SB', deskripsi: 'Selalu memimpin doa dan menjaga kebersihan lab.' },
                    { nis: '20261013', nama: 'Zainal Abidin',  predikat: 'B',  deskripsi: '' },
                ],
                'XI TKR 1': [
                    { nis: '20251021', nama: 'Hasan Basri',    predikat: 'SB', deskripsi: 'Rajin membantu teman di bengkel.' },
                    { nis: '20251022', nama: 'Nur Khalimah',   predikat: 'B',  deskripsi: '' },
                    { nis: '20251023', nama: 'Fikri Ramadhan', predikat: 'C',  deskripsi: 'Perlu pembiasaan disiplin waktu.' },
                ],
                'XI TKR 2': [
                    { nis: '20251031', nama: 'Abdul Rahman',    predikat: 'B',  deskripsi: '' },
                    { nis: '20251032', nama: 'Fatimah Azzahra', predikat: 'SB', deskripsi: '' },
                ],
            },

            get siswa() {
                return this.data[this.kelas] || [];
            },

            // Warna dropdown mengikuti predikat
            warna(kode) {
                const map = {
                    SB: { select: 'border-emerald-300 bg-emerald-50 text-emerald-700 focus:ring-emerald-200', icon: 'text-emerald-700' },
                    B:  { select: 'border-blue-300 bg-blue-50 text-blue-700 focus:ring-blue-200',             icon: 'text-blue-700' },
                    C:  { select: 'border-amber-300 bg-amber-50 text-amber-700 focus:ring-amber-200',         icon: 'text-amber-700' },
                    K:  { select: 'border-red-300 bg-red-50 text-red-600 focus:ring-red-200',                 icon: 'text-red-600' },
                };
                return map[kode] || map.B;
            },

            simpan() {
                this.toast = true;
                clearTimeout(this.toastTimer);
                this.toastTimer = setTimeout(() => this.toast = false, 3000);
            },
        }));
    });
</script>
</body>
</html>