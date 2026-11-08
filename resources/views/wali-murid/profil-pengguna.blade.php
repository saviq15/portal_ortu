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
                <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white">
                    <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                    Tagihan &amp; Pembayaran
                </a>
            </div>

            <div>
                <p class="px-3 text-[11px] font-medium uppercase tracking-wider text-slate-400">Pengaturan</p>
                {{-- Menu aktif: tinggi 44px, turun 24px dari label, sedikit lebih lebar --}}
                <a href="#" class="-mr-1 mt-6 flex items-center gap-3 rounded-xl bg-gold px-4 py-2.5 text-base leading-6 text-slate-900 shadow-sm">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
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
                <span class="h-4 w-1 rounded-full bg-brand"></span>
                <h2 class="text-base text-slate-900">Pengaturan Akun</h2>
            </div>

            <div class="flex items-center gap-3 sm:gap-4">
                <span class="hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700 sm:inline-flex">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Tahun Ajaran 2026/2027
                </span>
                <span class="hidden h-8 w-px bg-slate-200 sm:block"></span>
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-900 text-[11px] font-medium text-white">BM</div>
                    <div class="hidden leading-tight sm:block">
                        <p class="text-xs text-slate-900">Bapak Mahmud</p>
                        <p class="text-[10px] text-slate-500">Orang Tua</p>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 px-4 py-8 sm:px-8">

            {{-- Judul halaman --}}
            <div>
                <h1 class="text-2xl tracking-tight text-slate-900">Profil Wali Murid &amp; Keamanan</h1>
                <p class="mt-1 text-sm text-slate-500">Kelola informasi data diri, kontak darurat, dan kata sandi akun Anda.</p>
            </div>

            <div class="mt-6 grid grid-cols-1 items-start gap-6 lg:grid-cols-2">

                {{-- ============ KARTU DATA PRIBADI ============ --}}
                <form action="#" method="POST" @submit.prevent="simpanProfil()"
                      class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    @csrf

                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <h3 class="flex items-center gap-2.5 text-lg leading-6 text-slate-900">
                            <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"/></svg>
                            Data Pribadi
                        </h3>
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-0.5 text-[11px] text-emerald-700">
                            <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                            Akun Terverifikasi
                        </span>
                    </div>

                    {{-- Kartu identitas --}}
                    <div class="mt-5 flex items-center gap-4 rounded-lg border border-slate-100 bg-slate-50/70 px-5 py-4">
                        <div class="flex h-[60px] w-[60px] shrink-0 items-center justify-center rounded-full bg-slate-200 text-xl text-slate-500 ring-4 ring-white">BM</div>
                        <div>
                            <p class="text-lg leading-7 text-slate-900">Bapak Mahmud</p>
                            <p class="text-xs text-slate-600">Orang Tua / Wali Siswa</p>
                            <span class="mt-1.5 inline-flex items-center gap-1.5 rounded border border-amber-300 bg-amber-50 px-2 py-0.5 text-[11px] text-amber-800">
                                <svg class="h-3 w-3 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                                Wali dari: Ahmad Fauzi (X TKJ 1)
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">

                        {{-- Nama lengkap --}}
                        <div>
                            <label for="nama" class="mb-1.5 block text-xs text-slate-700">Nama Lengkap</label>
                            <input id="nama" name="nama" type="text" x-model="profil.nama" required
                                   class="block h-[38px] w-full rounded-lg border border-slate-300 bg-white px-3.5 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                        </div>

                        {{-- Hubungan (terkunci) --}}
                        <div>
                            <label for="hubungan" class="mb-1.5 block text-xs text-slate-600">Hubungan dengan Siswa</label>
                            <input id="hubungan" name="hubungan" type="text" value="Ayah Kandung" readonly
                                   class="block h-[38px] w-full cursor-not-allowed rounded-lg border border-slate-200 bg-slate-100 px-3.5 text-sm text-slate-600 focus:outline-none">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="mb-1.5 block text-xs text-slate-700">Alamat Email</label>
                            <input id="email" name="email" type="email" x-model="profil.email" required
                                   class="block h-[38px] w-full rounded-lg border border-slate-300 bg-white px-3.5 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                        </div>

                        {{-- Telepon --}}
                        <div>
                            <label for="telepon" class="mb-1.5 block text-xs text-slate-700">Nomor Telepon / WhatsApp</label>
                            <input id="telepon" name="telepon" type="tel" inputmode="numeric" x-model="profil.telepon" required
                                   class="block h-[38px] w-full rounded-lg border border-slate-300 bg-white px-3.5 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                        </div>

                        {{-- Alamat --}}
                        <div class="sm:col-span-2">
                            <label for="alamat" class="mb-1.5 block text-xs text-slate-700">Alamat Rumah</label>
                            <textarea id="alamat" name="alamat" rows="2" x-model="profil.alamat" required
                                      class="block w-full resize-none rounded-lg border border-slate-300 bg-white px-3.5 py-2 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20"></textarea>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col gap-3 border-t border-slate-100 pt-4 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-xs text-slate-400" x-text="'Terakhir diperbarui: ' + profil.diperbarui"></p>
                        <button type="submit"
                                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-brand px-6 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
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
                        <h3 class="flex items-center gap-2.5 text-lg leading-6 text-slate-900">
                            <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                            Ubah Kata Sandi
                        </h3>
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-200 bg-amber-50 px-2.5 py-0.5 text-[11px] text-amber-700">
                            <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM13.707 8.207a1 1 0 00-1.414-1.414L9 10.086 7.707 8.793a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Keamanan Akun
                        </span>
                    </div>

                    <div class="mt-5 space-y-4">

                        {{-- Sandi lama --}}
                        <div>
                            <label for="sandi_lama" class="mb-1.5 block text-xs text-slate-700">Kata Sandi Saat Ini</label>
                            <div class="relative">
                                <input id="sandi_lama" name="sandi_lama" :type="lihat.lama ? 'text' : 'password'" x-model="sandi.lama" required
                                       autocomplete="current-password" placeholder="Masukkan kata sandi lama..."
                                       class="block h-10 w-full rounded-lg border border-slate-300 bg-white pl-3.5 pr-10 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                                <button type="button" @click="lihat.lama = !lihat.lama" aria-label="Tampilkan atau sembunyikan kata sandi"
                                        class="absolute inset-y-0 right-3 flex items-center text-slate-400 transition hover:text-slate-600">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </button>
                            </div>
                        </div>

                        {{-- Sandi baru --}}
                        <div>
                            <label for="sandi_baru" class="mb-1.5 block text-xs text-slate-700">Kata Sandi Baru</label>
                            <input id="sandi_baru" name="sandi_baru" type="password" x-model="sandi.baru" required minlength="8"
                                   autocomplete="new-password" placeholder="Minimal 8 karakter..."
                                   class="block h-[43px] w-full rounded-lg border border-slate-300 bg-white px-3.5 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <p class="mt-1 text-[11px] text-slate-500">Gunakan kombinasi minimal 8 karakter dengan huruf, angka, dan simbol.</p>
                        </div>

                        {{-- Konfirmasi --}}
                        <div>
                            <label for="sandi_konfirmasi" class="mb-1.5 block text-xs text-slate-700">Konfirmasi Kata Sandi Baru</label>
                            <div class="relative">
                                <input id="sandi_konfirmasi" name="sandi_konfirmasi" :type="lihat.konfirmasi ? 'text' : 'password'" x-model="sandi.konfirmasi" required
                                       autocomplete="new-password" placeholder="Ulangi kata sandi baru..."
                                       class="block h-10 w-full rounded-lg border bg-white pl-3.5 pr-10 text-sm text-slate-800 placeholder-slate-400 transition focus:outline-none focus:ring-2"
                                       :class="tidakCocok ? 'border-red-300 focus:border-red-400 focus:ring-red-200' : 'border-slate-300 focus:border-brand focus:ring-brand/20'">
                                <button type="button" @click="lihat.konfirmasi = !lihat.konfirmasi" aria-label="Tampilkan atau sembunyikan kata sandi"
                                        class="absolute inset-y-0 right-3 flex items-center text-slate-400 transition hover:text-slate-600">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </button>
                            </div>
                            <p x-cloak x-show="tidakCocok" class="mt-1.5 text-[11px] text-red-600">Konfirmasi kata sandi belum sama dengan kata sandi baru.</p>
                        </div>

                        {{-- Tips keamanan --}}
                        <div class="!mt-5 flex items-start gap-3 rounded-lg border border-amber-200 bg-amber-50/70 px-4 py-3.5 text-xs leading-relaxed text-amber-900">
                            <svg class="mt-0.5 h-[18px] w-[18px] shrink-0 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                            <p class="max-w-[345px]">Tips Keamanan: Jangan berikan kata sandi Anda kepada siapa pun termasuk staf sekolah. Kata sandi yang kuat membantu menjaga privasi data akademik dan administrasi ananda Ahmad Fauzi.</p>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end border-t border-slate-100 pt-4">
                        <button type="submit"
                                class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-brand px-6 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/></svg>
                            Perbarui Sandi
                        </button>
                    </div>
                </form>
            </div>

            {{-- Info bar --}}
            <div class="mt-8 flex flex-col gap-2 border-t border-slate-200 pt-4 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Sistem Otentikasi &amp; Keamanan Portal Terpadu Yayasan Nurun 'Alannur (MI &amp; SMK)
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
                nama: 'Bapak Mahmud',
                email: 'mahmud.ortu@email.com',
                telepon: '081298765432',
                alamat: 'Jl. Merdeka No. 45, Banyumas',
                diperbarui: '25 Oktober 2026',
            },
            sandi: { lama: '', baru: '', konfirmasi: '' },
            lihat: { lama: false, konfirmasi: false },

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