<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keuangan Siswa | SIAKAD Panel</title>

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
      x-data="tagihanPage()"
      @keydown.escape.window="sidebar = false; modal = false">

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
                <p class="truncate text-xs text-gold">Portal Wali Murid</p>
            </div>
        </div>

        {{-- Menu --}}
        <nav class="flex-1 space-y-6 overflow-y-auto px-4 py-6">

            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Informasi Siswa</p>
                <div class="space-y-1">
                    <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                        Beranda Utama
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        Rapor Akademik
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        Jurnal KBM Mingguan
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/></svg>
                        Jurnal Sikap &amp; P5
                    </a>
                </div>
            </div>

            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Administrasi</p>
                {{-- Menu aktif --}}
                <a href="#" class="flex items-center gap-3 rounded-lg bg-gold px-3 py-2.5 text-sm font-medium text-slate-900 shadow-sm">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                    Tagihan &amp; Pembayaran
                </a>
            </div>

            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Pengaturan</p>
                <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                    <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    Profil Akun
                </a>
            </div>
        </nav>

        {{-- Logout --}}
        <div class="border-t border-white/10 p-4">
            <a href="#" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
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
                <span class="h-5 w-1 rounded-full bg-brand"></span>
                <h2 class="text-base font-bold text-slate-900">Keuangan Siswa</h2>
            </div>

            <div class="flex items-center gap-3 sm:gap-4">
                <span class="hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700 sm:inline-flex">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Tahun Ajaran 2026/2027
                </span>
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-xs font-bold text-white">BM</div>
                    <div class="hidden leading-tight sm:block">
                        <p class="text-xs font-bold text-slate-900">Bapak Mahmud</p>
                        <p class="text-[10px] text-slate-500">Orang Tua</p>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 space-y-6 px-4 py-8 sm:px-8">

            {{-- Judul + tombol hubungi --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-slate-900">Informasi Tagihan &amp; Riwayat Pembayaran</h1>
                    <p class="mt-2 text-sm text-slate-500">Pantau status keuangan dan unduh kuitansi resmi sekolah.</p>
                </div>
                <button type="button" @click="bukaModal()"
                        class="inline-flex w-fit items-center justify-center gap-2 rounded-lg bg-green-600 px-5 py-2.5 text-sm font-bold text-white shadow-md shadow-green-600/30 transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/></svg>
                    Hubungi Tata Usaha
                </button>
            </div>

            {{-- Kartu siswa --}}
            <section class="flex flex-col gap-3 rounded-xl bg-white px-5 py-4 shadow-sm ring-1 ring-slate-200 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-blue-200 bg-blue-50 text-xs font-bold text-blue-600">AF</div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <p class="text-sm font-bold text-slate-900">Ahmad Fauzi</p>
                            <span class="rounded border border-slate-200 bg-slate-50 px-2 py-0.5 text-[11px] text-slate-500">NIS: 20261001</span>
                        </div>
                        <p class="mt-1 text-[11px] text-slate-500">Kelas X TKJ 1 &bull; SMK Nusantara &bull; Semester Ganjil 2026/2027</p>
                    </div>
                </div>
                <span class="inline-flex w-fit items-center gap-2 rounded-md border border-emerald-300 bg-emerald-50 px-3.5 py-1.5 text-xs font-bold text-emerald-700">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Status Administrasi: Tertib Administrasi
                </span>
            </section>

            {{-- Dua kartu ringkasan --}}
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                {{-- Status SPP --}}
                <div class="flex flex-col rounded-xl border-2 border-green-500 bg-white p-6 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-medium uppercase tracking-wider text-slate-600">Status SPP Saat Ini</p>
                            <p class="mt-3 flex items-center gap-2 text-xl font-bold text-green-600">
                                LUNAS (Bulan Oktober 2026)
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                            </p>
                            <p class="mt-2 text-sm text-slate-600">Terima kasih, tidak ada tunggakan SPP berjalan.</p>
                        </div>
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-green-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        </span>
                    </div>
                    <div class="mt-auto flex flex-col gap-1 border-t border-slate-100 pt-4 text-[11px] sm:flex-row sm:items-center sm:justify-between" style="margin-top:1.5rem">
                        <p class="text-slate-500">Periode SPP berikutnya: <span class="font-bold text-slate-900">November 2026</span></p>
                        <p class="font-bold text-green-600">Jatuh Tempo: 10 Nov 2026</p>
                    </div>
                </div>

                {{-- Tagihan lainnya --}}
                <div class="flex flex-col rounded-xl border border-l-4 border-slate-200 border-l-slate-300 bg-white p-6 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-medium uppercase tracking-wider text-slate-600">Tagihan Lainnya</p>
                            <p class="mt-3 text-xl font-bold text-slate-900">Rp 0</p>
                            <p class="mt-2 max-w-sm text-sm text-slate-600">Tagihan seragam, buku, dan administrasi lainnya telah selesai.</p>
                        </div>
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375"/></svg>
                        </span>
                    </div>
                    <div class="mt-auto flex flex-col gap-1 border-t border-slate-100 pt-4 text-[11px] sm:flex-row sm:items-center sm:justify-between" style="margin-top:1.5rem">
                        <p class="text-slate-500">Biaya Tambahan Semester: <span class="font-bold text-slate-900">Nihil</span></p>
                        <p class="text-slate-600">Terverifikasi Bagian Keuangan</p>
                    </div>
                </div>
            </section>

            {{-- Riwayat transaksi --}}
            <section class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">

                <div class="flex flex-col gap-3 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <h3 class="flex items-center gap-2.5 text-base font-bold text-slate-900">
                        <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Riwayat Transaksi Terakhir
                    </h3>
                    <div class="flex items-center gap-2.5 text-xs text-slate-500">
                        <label for="tahun">Filter:</label>
                        <select id="tahun" x-model="tahun"
                                class="rounded-md border border-slate-200 bg-white py-2 pl-3 pr-8 text-xs text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <option>Tahun 2026</option>
                            <option>Tahun 2025</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[860px] text-left">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/70 text-[11px] font-medium uppercase tracking-wider text-slate-600">
                                <th class="py-4 pl-6 pr-4 lg:pl-[88px]">Tanggal<br>Transaksi</th>
                                <th class="px-4 py-4">Kode<br>Kuitansi</th>
                                <th class="px-4 py-4">Uraian Pembayaran</th>
                                <th class="px-4 py-4">Nominal</th>
                                <th class="px-4 py-4">Status</th>
                                <th class="px-4 py-4 text-center">Bukti</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-800">
                            <template x-for="t in transaksi" :key="t.kode">
                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-5 pl-6 pr-4 lg:pl-[88px]" x-text="t.tgl"></td>
                                    <td class="px-4 py-5">
                                        <span class="inline-flex rounded border border-slate-200 bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-700" x-text="t.kode"></span>
                                    </td>
                                    <td class="px-4 py-5"><span class="block max-w-[200px]" x-text="t.uraian"></span></td>
                                    <td class="px-4 py-5 font-bold text-slate-900" x-text="'Rp ' + rp(t.nominal)"></td>
                                    <td class="px-4 py-5">
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-0.5 text-[11px] font-medium text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Lunas
                                        </span>
                                    </td>
                                    <td class="px-4 py-5 text-center">
                                        <button type="button" @click="unduh(t)"
                                                class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-600 transition hover:text-amber-700">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                            Unduh Kuitansi
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            <tr x-cloak x-show="transaksi.length === 0">
                                <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-400">Belum ada transaksi pada tahun ini.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col gap-1 border-t border-slate-200 bg-slate-50/50 px-6 py-4 text-xs sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-slate-500" x-text="'Menampilkan ' + transaksi.length + ' transaksi terakhir (' + tahun + ')'"></p>
                    <p class="font-medium text-slate-900" x-text="'Total Transaksi Selesai: Rp ' + rp(total)"></p>
                </div>
            </section>

            {{-- Bar info --}}
            <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50/70 px-5 py-4 text-xs text-slate-700">
                <svg class="h-5 w-5 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Semua pembayaran diverifikasi secara otomatis oleh sistem Tata Usaha Yayasan Nurun 'Alannur.
            </div>

            {{-- Info bar bawah --}}
            <div class="flex flex-col gap-2 pt-2 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Sistem Pembayaran Terpadu Yayasan Nurun 'Alannur (MI &amp; SMK)
                </p>
                <span>SIAKAD v2.4.0</span>
            </div>
        </main>
    </div>
</div>

{{-- =====================================================================
     MODAL : PUSAT LAYANAN TATA USAHA (FOTO 2)
     ===================================================================== --}}
<div x-cloak x-show="modal" class="fixed inset-0 z-50 flex items-center justify-center p-4"
     role="dialog" aria-modal="true" aria-labelledby="judul-modal">

    <div x-show="modal" x-transition.opacity @click="modal = false"
         class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

    <div x-show="modal"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative flex max-h-[95vh] w-full max-w-lg flex-col overflow-hidden rounded-2xl border-t-4 border-slate-900 bg-white shadow-2xl ring-1 ring-slate-100">

        <div class="flex items-start justify-between border-b border-slate-100 px-6 py-5">
            <div>
                <h3 id="judul-modal" class="text-lg font-bold text-slate-900">Pusat Layanan Tata Usaha</h3>
                <p class="mt-1 max-w-sm text-sm text-slate-500">Hubungi staf administrasi untuk konfirmasi pembayaran atau kendala administrasi.</p>
            </div>
            <button type="button" @click="modal = false" aria-label="Tutup"
                    class="rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="#" method="POST" @submit.prevent="kirim()" class="flex min-h-0 flex-1 flex-col">
            @csrf
            <div class="flex-1 overflow-y-auto px-6 py-5">

                {{-- Kartu loket --}}
                <div class="flex items-center gap-4 rounded-lg border border-slate-200 bg-slate-50/70 px-4 py-4">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-slate-900 text-gold">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21"/></svg>
                    </span>
                    <div class="leading-snug">
                        <p class="text-sm font-bold text-slate-900">Loket Keuangan &amp; Administrasi</p>
                        <p class="mt-0.5 text-[11px] text-slate-600">Jam Operasional: Senin - Sabtu (07:30 - 14:00 WIB)</p>
                        <p class="mt-1 flex items-center gap-1.5 text-[11px] font-bold text-green-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                            Telp / WhatsApp Resmi: +62 812-3456-7890
                        </p>
                    </div>
                </div>

                {{-- WhatsApp --}}
                <a href="#"
                   class="mt-3 flex items-center justify-center gap-2 rounded-lg bg-green-600 px-4 py-3 text-sm font-bold text-white transition hover:bg-green-700">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3a9 9 0 00-7.78 13.5L3 21l4.65-1.2A9 9 0 1012 3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 8.5c0 3.5 2.5 6 6 6l1-1.5-2-1-1 .75a4 4 0 01-1.75-1.75l.75-1-1-2L9 8.5z"/></svg>
                    Chat Langsung via WhatsApp Loket TU
                </a>

                {{-- Pemisah --}}
                <div class="my-4 flex items-center gap-3">
                    <span class="h-px flex-1 bg-slate-200"></span>
                    <span class="text-[11px] font-medium uppercase tracking-wider text-slate-500">atau kirim pesan sistem</span>
                    <span class="h-px flex-1 bg-slate-200"></span>
                </div>

                {{-- Perihal --}}
                <label for="perihal" class="mb-1.5 block text-[11px] font-bold uppercase tracking-wider text-slate-800">Perihal / Kendala *</label>
                <select id="perihal" name="perihal" required x-model="form.perihal"
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                    <option value="">Pilih perihal...</option>
                    <option>Konfirmasi pembayaran SPP</option>
                    <option>Kuitansi belum diterima</option>
                    <option>Permohonan keringanan / cicilan</option>
                    <option>Koreksi data tagihan</option>
                    <option>Lainnya</option>
                </select>

                {{-- Pesan --}}
                <label for="pesan" class="mb-1.5 mt-4 block text-[11px] font-bold uppercase tracking-wider text-slate-800">Pesan / Keterangan *</label>
                <textarea id="pesan" name="pesan" rows="4" required x-model="form.pesan"
                          placeholder="Tuliskan pesan atau detail kendala keuangan ananda Ahmad Fauzi..."
                          class="block w-full resize-none rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20"></textarea>
            </div>

            <div class="flex justify-end gap-2.5 bg-slate-50 px-6 py-4">
                <button type="button" @click="modal = false"
                        class="rounded-lg border border-slate-200 bg-white px-5 py-2 text-sm font-medium text-slate-800 transition hover:bg-slate-50">Tutup</button>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-brand px-5 py-2 text-sm font-bold text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                    Kirim Pesan ke TU
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Notifikasi (simulasi) --}}
<div x-cloak x-show="toast" x-transition
     class="fixed bottom-6 right-6 z-[60] flex items-center gap-2.5 rounded-lg bg-slate-900 px-4 py-3 text-sm text-white shadow-xl">
    <svg class="h-4 w-4 text-emerald-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
    <span x-text="pesanToast"></span>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('tagihanPage', () => ({
            sidebar: false,
            modal: false,
            form: { perihal: '', pesan: '' },
            toast: false, pesanToast: '', toastTimer: null,

            tahun: 'Tahun 2026',

            // Data dummy (frontend saja)
            data: {
                'Tahun 2026': [
                    { tgl: '25 Okt 2026', kode: 'TRX-001', uraian: 'SPP Bulan Oktober 2026',       nominal: 250000 },
                    { tgl: '25 Sep 2026', kode: 'TRX-089', uraian: 'SPP Bulan September 2026',     nominal: 250000 },
                    { tgl: '15 Jul 2026', kode: 'TRX-105', uraian: 'Biaya Daftar Ulang & Seragam', nominal: 1500000 },
                ],
                'Tahun 2025': [
                    { tgl: '24 Mei 2025', kode: 'TRX-052', uraian: 'SPP Bulan Mei 2025',   nominal: 250000 },
                    { tgl: '23 Apr 2025', kode: 'TRX-041', uraian: 'SPP Bulan April 2025', nominal: 250000 },
                ],
            },

            get transaksi() { return this.data[this.tahun] || []; },
            get total()     { return this.transaksi.reduce((a, t) => a + t.nominal, 0); },

            rp(n) { return Number(n).toLocaleString('id-ID'); },

            bukaModal() { this.form = { perihal: '', pesan: '' }; this.modal = true; },

            kirim() {
                if (!this.form.perihal || !this.form.pesan.trim()) return;
                this.modal = false;
                this.notif('Pesan terkirim ke Tata Usaha. Mohon tunggu balasan staf.');
            },

            // Unduh kuitansi sederhana (berkas teks), tanpa backend
            unduh(t) {
                const isi = [
                    'KUITANSI PEMBAYARAN',
                    "Yayasan Pendidikan Nurun 'Alannur - SMK Nusantara",
                    '------------------------------------------',
                    'No. Referensi : ' + t.kode,
                    'Tanggal       : ' + t.tgl,
                    'Diterima dari : Ahmad Fauzi (NIS: 20261001)',
                    'Untuk         : ' + t.uraian,
                    'Jumlah        : Rp ' + this.rp(t.nominal) + ',-',
                    'Status        : Lunas',
                ].join('\r\n');
                const a = document.createElement('a');
                a.href = URL.createObjectURL(new Blob([isi], { type: 'text/plain;charset=utf-8' }));
                a.download = 'kuitansi-' + t.kode + '.txt';
                document.body.appendChild(a); a.click(); a.remove();
                URL.revokeObjectURL(a.href);
                this.notif('Kuitansi ' + t.kode + ' berhasil diunduh.');
            },

            notif(teks) {
                this.pesanToast = teks;
                this.toast = true;
                clearTimeout(this.toastTimer);
                this.toastTimer = setTimeout(() => this.toast = false, 3500);
            },
        }));
    });
</script>
</body>
</html>