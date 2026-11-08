<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pengaturan Akun | SIAKAD Panel</title>

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
      x-data="profilPage()"
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
                    <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                        Beranda Guru
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        Jadwal Mengajar
                    </a>
                </div>
            </div>

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

            <div>
                <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Pengaturan</p>
                {{-- Menu aktif --}}
                <a href="#" class="flex items-center gap-3 rounded-lg bg-gold px-3 py-2.5 text-sm text-slate-900 shadow-sm">
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
                <h2 class="text-base text-slate-900">Pengaturan Akun</h2>
            </div>

            <div class="flex items-center gap-3 sm:gap-4">
                <span class="hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700 sm:inline-flex">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Tahun Ajaran 2026/2027
                </span>
                <span class="hidden h-8 w-px bg-slate-200 sm:block"></span>
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-50 text-xs font-medium text-indigo-600 ring-1 ring-indigo-100">HS</div>
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
                <h1 class="text-2xl tracking-tight text-slate-900">Profil Pengguna &amp; Keamanan</h1>
                <p class="mt-2 text-sm text-slate-500">Kelola informasi data diri, kontak, dan kata sandi akun Anda.</p>
            </div>

            <div class="mt-8 grid grid-cols-1 items-start gap-6 lg:grid-cols-[1.3fr_1fr]">

                {{-- ============ KARTU DATA PRIBADI ============ --}}
                <form action="#" method="POST" @submit.prevent="simpanProfil()"
                      class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    @csrf

                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <h3 class="text-lg text-slate-900">Data Pribadi</h3>
                        <span class="rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-0.5 text-[11px] text-emerald-700">Akun Terverifikasi</span>
                    </div>

                    {{-- Kartu identitas --}}
                    <div class="mt-6 flex items-center gap-4 rounded-lg border border-slate-100 bg-slate-50/70 px-5 py-4">
                        <div class="flex h-[60px] w-[60px] shrink-0 items-center justify-center rounded-full bg-slate-200 text-xl text-slate-500 ring-4 ring-white">HS</div>
                        <div>
                            <p class="text-base text-slate-900">Bapak Heri Susanto</p>
                            <p class="mt-0.5 text-xs text-slate-600">Guru Kejuruan - SMK Nusantara</p>
                            <p class="mt-1 flex items-center gap-1.5 text-xs text-slate-400">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                NUPTK Aktif Kemendikbudristek
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-x-4 gap-y-5 sm:grid-cols-2">

                        {{-- Nama lengkap (terkunci) --}}
                        <div>
                            <label for="nama" class="mb-2 block text-xs text-slate-700">Nama Lengkap</label>
                            <div class="relative">
                                <input id="nama" name="nama" type="text" value="Bapak Heri Susanto" readonly
                                       class="block w-full cursor-not-allowed rounded-lg border border-slate-200 bg-slate-50 py-3 pl-4 pr-10 text-sm text-slate-700 focus:outline-none">
                                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                                </span>
                            </div>
                            <p class="mt-2 text-[11px] leading-relaxed text-slate-400">Hubungi admin akademik untuk ubah nama resmi.</p>
                        </div>

                        {{-- NIP (terkunci) --}}
                        <div>
                            <label for="nip" class="mb-2 block text-xs text-slate-700">Nomor Induk Pegawai (NIP)</label>
                            <div class="relative">
                                <input id="nip" name="nip" type="text" value="19850822001" readonly
                                       class="block w-full cursor-not-allowed rounded-lg border border-slate-200 bg-slate-50 py-3 pl-4 pr-10 text-sm text-slate-700 focus:outline-none">
                                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                                </span>
                            </div>
                            <p class="mt-2 text-[11px] leading-relaxed text-slate-400">Data pokok kepegawaian terintegrasi dapodik.</p>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="mb-2 block text-xs text-slate-700">Alamat Email</label>
                            <input id="email" name="email" type="email" x-model="profil.email" required
                                   class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <p class="mt-2 text-[11px] leading-relaxed text-slate-400">Email aktif untuk notifikasi nilai &amp; jadwal.</p>
                        </div>

                        {{-- Telepon --}}
                        <div>
                            <label for="telepon" class="mb-2 block text-xs text-slate-700">Nomor Telepon / WhatsApp</label>
                            <input id="telepon" name="telepon" type="tel" inputmode="numeric" x-model="profil.telepon" required
                                   class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <p class="mt-2 text-[11px] leading-relaxed text-slate-400">Digunakan untuk koordinasi cepat wali kelas.</p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-xs text-slate-500" x-text="'Terakhir diperbarui: ' + profil.diperbarui"></p>
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-6 py-2.5 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                {{-- ============ KARTU UBAH KATA SANDI ============ --}}
                <form action="#" method="POST" @submit.prevent="simpanSandi()"
                      class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    @csrf

                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <h3 class="text-lg text-slate-900">Ubah Kata Sandi</h3>
                        <span class="rounded border border-amber-200 bg-amber-50 px-2 py-0.5 text-[11px] text-amber-700">Keamanan</span>
                    </div>

                    <div class="mt-6 space-y-5">

                        {{-- Sandi lama --}}
                        <div>
                            <label for="sandi_lama" class="mb-2 block text-xs text-slate-700">Kata Sandi Saat Ini</label>
                            <input id="sandi_lama" name="sandi_lama" type="password" x-model="sandi.lama" required
                                   autocomplete="current-password" placeholder="Masukkan kata sandi lama..."
                                   class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                        </div>

                        {{-- Sandi baru --}}
                        <div>
                            <label for="sandi_baru" class="mb-2 block text-xs text-slate-700">Kata Sandi Baru</label>
                            <input id="sandi_baru" name="sandi_baru" type="password" x-model="sandi.baru" required minlength="8"
                                   autocomplete="new-password" placeholder="Minimal 8 karakter..."
                                   class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <p class="mt-2 text-[11px] text-slate-400">Kombinasikan huruf besar, angka, dan simbol.</p>
                        </div>

                        {{-- Konfirmasi --}}
                        <div>
                            <label for="sandi_konfirmasi" class="mb-2 block text-xs text-slate-700">Konfirmasi Kata Sandi Baru</label>
                            <input id="sandi_konfirmasi" name="sandi_konfirmasi" type="password" x-model="sandi.konfirmasi" required
                                   autocomplete="new-password" placeholder="Ulangi kata sandi baru..."
                                   class="block w-full rounded-lg border bg-white px-4 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:outline-none focus:ring-2"
                                   :class="tidakCocok ? 'border-red-300 focus:border-red-400 focus:ring-red-200' : 'border-slate-300 focus:border-brand focus:ring-brand/20'">
                            <p x-cloak x-show="tidakCocok" class="mt-2 text-[11px] text-red-600">Konfirmasi kata sandi belum sama dengan kata sandi baru.</p>
                        </div>

                        {{-- Peringatan --}}
                        <div class="flex items-start gap-2.5 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-xs leading-relaxed text-amber-900">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                            <p>Setelah kata sandi diperbarui, sesi aktif di perangkat lain akan otomatis keluar demi keamanan.</p>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end border-t border-slate-100 pt-5">
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-6 py-2.5 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/></svg>
                            Perbarui Sandi
                        </button>
                    </div>
                </form>
            </div>

            {{-- Info bar --}}
            <div class="mt-8 flex flex-col gap-2 border-t border-slate-200 pt-5 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Sistem Otentikasi dan Keamanan terintegrasi terpusat Yayasan Nurun 'Alannur.
                </p>
                <span class="text-slate-400">SIAKAD v2.4.0</span>
            </div>
        </main>
    </div>
</div>

{{-- Notifikasi (simulasi) --}}
<div x-cloak x-show="toast" x-transition
     class="fixed bottom-6 right-6 z-50 flex items-center gap-2.5 rounded-lg bg-slate-900 px-4 py-3 text-sm text-white shadow-xl">
    <svg class="h-4 w-4 text-emerald-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
    <span x-text="pesan"></span>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('profilPage', () => ({
            sidebar: false,
            toast: false,
            pesan: '',
            toastTimer: null,

            // Data dummy (frontend saja)
            profil: {
                email: 'heri.susanto@smknusantara.sch.id',
                telepon: '081234567890',
                diperbarui: '15 Oktober 2026',
            },
            sandi: { lama: '', baru: '', konfirmasi: '' },

            get tidakCocok() {
                return this.sandi.konfirmasi !== '' && this.sandi.konfirmasi !== this.sandi.baru;
            },

            simpanProfil() {
                this.profil.diperbarui = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                this.notif('Data pribadi berhasil diperbarui.');
            },

            simpanSandi() {
                if (this.tidakCocok) return;
                this.sandi = { lama: '', baru: '', konfirmasi: '' };
                this.notif('Kata sandi berhasil diperbarui.');
            },

            notif(teks) {
                this.pesan = teks;
                this.toast = true;
                clearTimeout(this.toastTimer);
                this.toastTimer = setTimeout(() => this.toast = false, 3000);
            },
        }));
    });
</script>
</body>
</html>