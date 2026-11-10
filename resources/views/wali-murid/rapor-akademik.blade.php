<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rapor Digital Siswa | SIAKAD Panel</title>

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
    <style>
        [x-cloak]{display:none !important;}

        @media print {
            @page { size: A4 portrait; margin: 12mm; }
            html, body { background: #fff !important; }
            .no-print { display: none !important; }
            .print-wrap { padding: 0 !important; background: #fff !important; min-height: 0 !important; }
            .print-sheet { box-shadow: none !important; border-radius: 0 !important; max-width: 100% !important; margin: 0 !important; }
        }
    </style>
</head>

<body class="bg-slate-50 font-sans text-slate-800 antialiased"
      x-data="raporPage()"
      @keydown.escape.window="sidebar = false">

{{-- =====================================================================
     TAMPILAN 1 : LAPORAN HASIL BELAJAR (FOTO 1)
     ===================================================================== --}}
<div x-show="view === 'rapor'" class="flex min-h-screen no-print">

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
                    <a href="{{ route('wali.dashboard') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                        Beranda Utama
                    </a>
                    {{-- Menu aktif --}}
                    <a href="{{ route('wali.rapor-akademik') }}" class="flex items-center gap-3 rounded-lg bg-gold px-3 py-2.5 text-sm text-slate-900 shadow-sm">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        Rapor Akademik
                    </a>
                    <a href="{{ route('wali.kbm-mingguan') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        Jurnal KBM Mingguan
                    </a>
                    <a href="{{ route('wali.jurnal-sikap') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/></svg>
                        Jurnal Sikap &amp; P5
                    </a>
                </div>
            </div>

            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Administrasi</p>
                <a href="{{ route('wali.tagihan-pembayaran') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                    <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                    Tagihan &amp; Pembayaran
                </a>
            </div>

            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Pengaturan</p>
                <a href="{{ route('wali.profil-pengguna') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                    <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    Profil Akun
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
                <span class="h-5 w-1 rounded-full bg-brand"></span>
                <h2 class="text-base text-slate-900">Rapor Digital Siswa</h2>
            </div>

            <div class="flex items-center gap-3 sm:gap-4">
                <span class="hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700 sm:inline-flex">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Tahun Ajaran 2026/2027
                </span>
                <span class="hidden h-8 w-px bg-slate-200 sm:block"></span>
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-xs font-medium text-white">BM</div>
                    <div class="hidden leading-tight sm:block">
                        <p class="text-xs text-slate-900">Bapak Mahmud</p>
                        <p class="text-[10px] text-slate-500">Orang Tua</p>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 px-4 py-8 sm:px-8">

            {{-- Judul + pilihan semester + unduh --}}
            <div class="flex flex-col gap-4 border-b border-slate-200 pb-3 md:flex-row md:items-start md:justify-between">
                <div>
                    <h1 class="text-2xl tracking-tight text-slate-900">Laporan Hasil Belajar (Rapor)</h1>
                    <p class="mt-2 text-sm text-slate-500">Melihat riwayat nilai akademik Ahmad Fauzi.</p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="relative w-full sm:w-60">
                        <select x-model="semester" aria-label="Pilih semester"
                                class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-3 pl-4 pr-10 text-sm text-slate-800 shadow-sm transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <template x-for="s in daftarSemester" :key="s"><option :value="s" x-text="'Semester ' + s"></option></template>
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </span>
                    </div>

                    <button type="button" @click="bukaCetak()"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-5 py-3 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        Unduh Rapor (PDF)
                    </button>
                </div>
            </div>

            {{-- ============ KARTU INFO SISWA ============ --}}
            <section class="mt-6 grid grid-cols-1 gap-y-5 rounded-xl bg-white px-6 py-5 shadow-sm ring-1 ring-slate-200 sm:grid-cols-2 lg:grid-cols-4 lg:gap-y-0">
                <div class="lg:pr-6">
                    <p class="text-[10px] uppercase tracking-wider text-slate-500">Nama Siswa</p>
                    <p class="mt-2 text-base text-slate-900">Ahmad Fauzi</p>
                </div>
                <div class="lg:border-l lg:border-slate-200 lg:px-6">
                    <p class="text-[10px] uppercase tracking-wider text-slate-500">NIS / NISN</p>
                    <p class="mt-2 text-sm text-slate-900">20261001 / 0081234567</p>
                </div>
                <div class="lg:border-l lg:border-slate-200 lg:px-6">
                    <p class="text-[10px] uppercase tracking-wider text-slate-500">Kelas</p>
                    <p class="mt-2 text-sm text-slate-900">X TKJ 1 <span class="text-xs text-slate-500">(SMK Nusantara)</span></p>
                </div>
                <div class="lg:border-l lg:border-slate-200 lg:pl-6">
                    <p class="text-[10px] uppercase tracking-wider text-slate-500">Wali Kelas</p>
                    <p class="mt-2 text-sm text-brand">Bapak Heri Susanto</p>
                </div>
            </section>

            {{-- ============ TABEL NILAI ============ --}}
            <section class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[860px] text-left">
                        <thead>
                            <tr class="bg-sidebar text-[11px] uppercase tracking-wider text-white">
                                <th class="py-5 pl-6 pr-4 font-normal lg:pl-[88px]">Mata Pelajaran</th>
                                <th class="px-4 py-5 text-center font-normal">KKM</th>
                                <th class="px-4 py-5 text-center font-normal leading-snug">Nilai<br>Akhir</th>
                                <th class="px-4 py-5 text-center font-normal">Predikat</th>
                                <th class="py-5 pl-4 pr-6 font-normal">Deskripsi Kemajuan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                            <template x-for="m in nilai" :key="semester + m.mapel">
                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-6 pl-6 pr-4 lg:pl-[88px]">
                                        <span class="flex items-center gap-3">
                                            <span class="h-2 w-2 shrink-0 rounded-full" :class="m.titik"></span>
                                            <span class="max-w-[160px]" x-text="m.mapel"></span>
                                        </span>
                                    </td>
                                    <td class="px-4 py-6 text-center text-slate-500" x-text="m.kkm"></td>
                                    <td class="px-4 py-6 text-center text-lg" :class="predikat(m.nilai).kode === 'A' ? 'text-brand' : 'text-slate-900'" x-text="m.nilai"></td>
                                    <td class="px-4 py-6 text-center">
                                        <span class="inline-flex items-center justify-center gap-1.5 rounded-full border px-3 py-1 text-xs leading-tight"
                                              :class="predikat(m.nilai).kelas">
                                            <svg class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-html="predikat(m.nilai).ikon"></svg>
                                            <span x-text="predikat(m.nilai).label"></span>
                                        </span>
                                    </td>
                                    <td class="py-6 pl-4 pr-6 text-sm leading-relaxed text-slate-800">
                                        <span class="block max-w-[340px]" x-text="m.deskripsi"></span>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                {{-- Footer tabel --}}
                <div class="flex flex-col gap-2 border-t border-slate-200 bg-slate-50/50 px-6 py-4 text-xs sm:flex-row sm:items-center sm:justify-between">
                    <p class="flex items-center gap-2 text-slate-600">
                        <svg class="h-4 w-4 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Dokumen ini diterbitkan secara otomatis oleh sistem. Jika terdapat kekeliruan, harap hubungi Wali Kelas.
                    </p>
                    <p class="text-[11px] text-slate-400">SIAKAD Digital Report v2.4</p>
                </div>
            </section>

            {{-- Info bar --}}
            <div class="mt-6 flex flex-col gap-2 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Sistem Rapor Digital Terintegrasi Yayasan Nurun 'Alannur (MI &amp; SMK)
                </p>
                <span>Terakhir disinkronkan: Hari ini, 10:00 WIB</span>
            </div>
        </main>
    </div>
</div>

{{-- =====================================================================
     TAMPILAN 2 : PRATINJAU CETAK RAPOR A4 (FOTO 2)
     ===================================================================== --}}
<div x-cloak x-show="view === 'cetak'" class="print-wrap min-h-screen bg-slate-200 px-4 py-8">

    <div class="mx-auto w-full max-w-[1024px]">

        <div class="print-sheet overflow-hidden rounded-lg bg-white shadow-lg">

            {{-- Bar atas (tidak ikut tercetak) --}}
            <div class="no-print flex flex-col gap-3 border-b-4 border-slate-800 px-5 py-4 md:flex-row md:items-center md:justify-between">
                <button type="button" @click="tutupCetak()"
                        class="inline-flex items-center gap-2 text-sm text-slate-600 transition hover:text-slate-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                    &lt; Kembali ke Portal Wali Murid
                </button>

                <span class="hidden items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-4 py-1.5 text-xs text-slate-500 md:inline-flex">
                    <svg class="h-3.5 w-3.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Format Rapor Resmi (A4 Standar Kemdikbud)
                </span>

                <button type="button" @click="window.print()"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-5 py-2.5 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/></svg>
                    Simpan sebagai PDF
                </button>
            </div>

            {{-- Isi rapor --}}
            <div class="px-6 pb-10 pt-12 sm:px-12">

                {{-- Kop --}}
                <div class="flex items-center gap-4 border-b-4 border-slate-900 pb-6">
                    <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-full border-2 border-slate-900 bg-white">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-full w-full object-contain p-1">
                    </div>
                    <div class="flex-1 text-center">
                        <h2 class="text-xl uppercase tracking-wide text-slate-900 sm:text-2xl">Yayasan Pendidikan Nurun 'Alannur</h2>
                        <p class="mt-1 text-lg uppercase text-slate-900">SMK Nusantara</p>
                        <p class="mt-1 text-[11px] text-slate-700">Kapencar RT. 10 RW. 09, Kecamatan Kertek, Kabupaten Wonosobo, Jawa Tengah 56371</p>
                    </div>
                    <div class="hidden shrink-0 border border-slate-900 px-5 py-1 text-center text-slate-900 sm:block">
                        <p class="text-[9px] uppercase tracking-wider">Akreditasi</p>
                        <p class="text-sm">A</p>
                    </div>
                </div>

                {{-- Judul --}}
                <div class="mt-8 text-center">
                    <h3 class="text-xl uppercase tracking-wide text-slate-900 underline underline-offset-4">Laporan Hasil Belajar (Rapor)</h3>
                    <p class="mt-2 text-[11px] uppercase tracking-wider text-slate-600">Kurikulum Merdeka — Jenjang Sekolah Menengah Kejuruan</p>
                </div>

                {{-- Identitas --}}
                <div class="mt-8 grid grid-cols-1 gap-x-10 gap-y-2 border-b border-slate-200 pb-5 text-sm text-slate-900 md:grid-cols-2">
                    <dl class="space-y-2">
                        <div class="grid grid-cols-[130px_1fr] gap-1"><dt class="text-slate-600">Nama Peserta Didik</dt><dd>: AHMAD FAUZI</dd></div>
                        <div class="grid grid-cols-[130px_1fr] gap-1"><dt class="text-slate-600">NIS / NISN</dt><dd>: 20261001 / 0081234567</dd></div>
                        <div class="grid grid-cols-[130px_1fr] gap-1"><dt class="text-slate-600">Kelas</dt><dd>: X TKJ 1 (Teknik Komputer &amp; Jaringan)</dd></div>
                    </dl>
                    <dl class="space-y-2">
                        <div class="grid grid-cols-[110px_1fr] gap-1"><dt class="text-slate-600">Semester</dt><dd>: <span x-text="semesterNama"></span></dd></div>
                        <div class="grid grid-cols-[110px_1fr] gap-1"><dt class="text-slate-600">Tahun Ajaran</dt><dd>: <span x-text="tahunAjaran"></span></dd></div>
                        <div class="grid grid-cols-[110px_1fr] gap-1"><dt class="text-slate-600">Wali Kelas</dt><dd>: Bapak Heri Susanto</dd></div>
                    </dl>
                </div>

                {{-- Tabel nilai --}}
                <div class="mt-6 overflow-x-auto">
                    <table class="w-full min-w-[720px] border-collapse border-2 border-slate-900 text-sm text-slate-900">
                        <thead>
                            <tr class="bg-slate-100 text-xs uppercase tracking-wide">
                                <th class="border-2 border-slate-900 px-3 py-3.5 font-normal">No</th>
                                <th class="border-2 border-slate-900 px-3 py-3.5 font-normal">Mata Pelajaran</th>
                                <th class="border-2 border-slate-900 px-3 py-3.5 font-normal">KKM</th>
                                <th class="border-2 border-slate-900 px-3 py-3.5 font-normal leading-snug">Nilai<br>Akhir</th>
                                <th class="border-2 border-slate-900 px-3 py-3.5 font-normal">Predikat</th>
                                <th class="border-2 border-slate-900 px-3 py-3.5 font-normal">Deskripsi Kemajuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(m, i) in nilai" :key="'p' + semester + m.mapel">
                                <tr class="align-top">
                                    <td class="border-2 border-slate-900 px-3 py-3 text-center" x-text="i + 1"></td>
                                    <td class="border-2 border-slate-900 px-3 py-3" x-text="m.mapel"></td>
                                    <td class="border-2 border-slate-900 px-3 py-3 text-center" x-text="m.kkm"></td>
                                    <td class="border-2 border-slate-900 px-3 py-3 text-center text-base" x-text="m.nilai"></td>
                                    <td class="border-2 border-slate-900 px-3 py-3 text-center" x-text="predikat(m.nilai).label"></td>
                                    <td class="border-2 border-slate-900 px-3 py-3 leading-relaxed" x-text="m.deskripsi"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                {{-- Rentang predikat --}}
                <div class="mt-6 flex flex-col gap-2 border border-slate-900 px-4 py-3 text-[11px] text-slate-900 md:flex-row md:flex-wrap md:items-center md:justify-between">
                    <span>Rentang Predikat Kelulusan:</span>
                    <span class="text-slate-700">A (Sangat Baik: 89 - 100)</span>
                    <span class="hidden md:inline">&bull;</span>
                    <span class="text-slate-700">B (Baik: 79 - 88)</span>
                    <span class="hidden md:inline">&bull;</span>
                    <span class="text-slate-700">C (Cukup: 70 - 78)</span>
                    <span class="hidden md:inline">&bull;</span>
                    <span class="text-slate-700">D (Perlu Bimbingan: &lt; 70)</span>
                </div>

                {{-- Tanda tangan --}}
                <div class="mt-12 grid grid-cols-1 gap-10 text-center text-sm text-slate-900 md:grid-cols-3">
                    <div>
                        <p>Mengetahui,</p>
                        <p class="mt-2">Orang Tua / Wali</p>
                        <p class="my-6 text-[11px] text-slate-300">[ Tanda Tangan ]</p>
                        <p class="underline">( BAPAK MAHMUD )</p>
                    </div>
                    <div>
                        <p>Mengetahui,</p>
                        <p class="mt-2">Kepala Sekolah</p>
                        <p class="my-6 text-[11px] text-slate-300">[ Stempel &amp; TTD ]</p>
                        <p class="underline">( ..................................... )</p>
                        <p class="mt-1 text-[11px] text-slate-600">NIP. 19780512 200312 1 002</p>
                    </div>
                    <div>
                        <p x-text="'Wonosobo, ' + dicetak.tanggal"></p>
                        <p class="mt-2">Wali Kelas</p>
                        <p class="my-6 text-[11px] text-slate-300">[ Tanda Tangan ]</p>
                        <p class="underline">( BAPAK HERI SUSANTO )</p>
                        <p class="mt-1 text-[11px] text-slate-600">NIP. 19850314 201101 1 009</p>
                    </div>
                </div>

                {{-- Footer dokumen --}}
                <div class="mt-10 flex flex-col gap-1 border-t border-slate-300 pt-3 text-[10px] text-slate-500 sm:flex-row sm:justify-between">
                    <p>Dokumen Resmi SIAKAD v2.4.0 — Yayasan Pendidikan Nurun 'Alannur</p>
                    <p x-text="'Dicetak otomatis melalui Portal Wali Murid • ' + dicetak.tanggal"></p>
                </div>
            </div>
        </div>

        {{-- Petunjuk (tidak ikut tercetak) --}}
        <div class="no-print mt-4 flex flex-col gap-2 px-1 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
            <p class="flex flex-wrap items-center gap-1.5">
                Gunakan pintasan keyboard
                <kbd class="rounded border border-slate-300 bg-white px-2 py-0.5 text-[11px] text-slate-700">Ctrl + P</kbd>
                untuk mencetak atau mengekspor berkas ke PDF.
            </p>
            <p>Sistem Penilaian Akademik Terpadu (SMK Nusantara &amp; MI Internasional)</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('raporPage', () => ({
            sidebar: false,
            view: 'rapor',   // 'rapor' (foto 1) | 'cetak' (foto 2)

            semester: 'Ganjil 2026/2027',
            daftarSemester: ['Ganjil 2026/2027', 'Genap 2025/2026'],
            dicetak: { tanggal: '' },

            // Data dummy (frontend saja)
            data: {
                'Ganjil 2026/2027': [
                    { mapel: 'Dasar Jaringan',          titik: 'bg-emerald-500', kkm: 75, nilai: 85, deskripsi: 'Ananda Ahmad Fauzi menunjukkan pemahaman yang baik dalam topologi jaringan dasar.' },
                    { mapel: 'Matematika',              titik: 'bg-amber-500',   kkm: 70, nilai: 78, deskripsi: 'Pemahaman logika dasar sudah cukup, perlu peningkatan dalam soal cerita kompleks.' },
                    { mapel: 'Bahasa Indonesia',        titik: 'bg-blue-500',    kkm: 75, nilai: 90, deskripsi: 'Sangat aktif berdiskusi dan mampu menulis laporan praktikum dengan struktur yang tepat.' },
                    { mapel: 'Pendidikan Agama Islam',  titik: 'bg-emerald-500', kkm: 80, nilai: 88, deskripsi: 'Mampu menghafal surat pendek dengan tajwid yang benar.' },
                ],
                'Genap 2025/2026': [
                    { mapel: 'Dasar Jaringan',          titik: 'bg-emerald-500', kkm: 75, nilai: 80, deskripsi: 'Mulai memahami konsep model OSI dan perangkat jaringan dasar.' },
                    { mapel: 'Matematika',              titik: 'bg-amber-500',   kkm: 70, nilai: 72, deskripsi: 'Perlu latihan tambahan pada materi persamaan dan fungsi.' },
                    { mapel: 'Bahasa Indonesia',        titik: 'bg-blue-500',    kkm: 75, nilai: 86, deskripsi: 'Aktif dalam diskusi kelompok dan mampu menyusun teks prosedur.' },
                    { mapel: 'Pendidikan Agama Islam',  titik: 'bg-emerald-500', kkm: 80, nilai: 91, deskripsi: 'Sangat baik dalam hafalan dan praktik ibadah harian.' },
                ],
            },

            get nilai()        { return this.data[this.semester] || []; },
            get semesterNama() { return this.semester.split(' ')[0]; },
            get tahunAjaran()  { return this.semester.split(' ')[1]; },

            // Predikat otomatis dari nilai akhir
            predikat(n) {
                if (n >= 89) return {
                    kode: 'A', label: 'A (Sangat Baik)',
                    kelas: 'border-blue-200 bg-blue-50 text-blue-700',
                    ikon: '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>',
                };
                if (n >= 79) return {
                    kode: 'B', label: 'B (Baik)',
                    kelas: 'border-emerald-200 bg-emerald-50 text-emerald-700',
                    ikon: '<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>',
                };
                if (n >= 70) return {
                    kode: 'C', label: 'C (Cukup)',
                    kelas: 'border-amber-200 bg-amber-50 text-amber-700',
                    ikon: '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>',
                };
                return {
                    kode: 'D', label: 'D (Perlu Bimbingan)',
                    kelas: 'border-red-200 bg-red-50 text-red-600',
                    ikon: '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>',
                };
            },

            bukaCetak() {
                this.dicetak.tanggal = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                this.view = 'cetak';
                window.scrollTo(0, 0);
            },
            tutupCetak() { this.view = 'rapor'; window.scrollTo(0, 0); },
        }));
    });
</script>
</body>
</html>