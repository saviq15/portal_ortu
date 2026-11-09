<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Data Pengguna | SIAKAD Panel</title>

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
      x-data="penggunaPage()"
      @keydown.escape.window="modal = false; sidebar = false">

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
                <p class="truncate text-base font-bold text-white">SIAKAD Panel</p>
                <p class="truncate text-xs text-slate-400">Yayasan Nurun 'Alannur</p>
            </div>
        </div>

        {{-- Menu --}}
        <nav class="flex-1 space-y-6 overflow-y-auto px-4 py-6">

            <div>
                <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-500">Utama</p>
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                    Dashboard
                </a>
            </div>

            <div>
                <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-500">Data Master</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.kelas.view') }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
                        Data Kelas
                    </a>
                    {{-- Menu aktif --}}
                    <a href="{{ route('admin.pengguna.view') }}"
                       class="flex items-center gap-3 rounded-lg bg-gold px-3 py-2.5 text-sm font-semibold text-slate-900 shadow-sm">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                        Data Pengguna
                    </a>
                </div>
            </div>

            <div>
                <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-500">Pengaturan</p>
                <a href="{{ route('admin.tahun-ajaran') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                    Tahun Ajaran
                </a>
            </div>
        </nav>

        {{-- Logout --}}
        <div class="border-t border-white/10 p-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                    Keluar / Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ===================== KONTEN UTAMA ===================== --}}
    <div class="flex min-w-0 flex-1 flex-col">

        {{-- Header --}}
        <header class="sticky top-0 z-20 flex h-16 items-center justify-between gap-3 bg-white px-4 shadow-sm sm:px-8">
            <div class="flex items-center gap-3">
                <button type="button" @click="sidebar = true" aria-label="Buka menu"
                        class="rounded-lg p-2 text-slate-500 hover:bg-slate-100 lg:hidden">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                </button>
                <h2 class="text-lg font-bold text-slate-900">Manajemen Data Pengguna</h2>
            </div>

            <div class="flex items-center gap-3 sm:gap-4">
                <span class="hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 sm:inline-flex">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Tahun Ajaran 2026/2027 - Ganjil
                </span>
                <span class="hidden h-8 w-px bg-slate-200 sm:block"></span>
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-slate-100 text-xs font-semibold text-slate-600">AY</div>
                    <div class="hidden leading-tight sm:block">
                        <p class="text-xs font-bold text-slate-900">Admin Yayasan</p>
                        <p class="text-[11px] text-slate-500">Super Administrator</p>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 px-4 py-8 sm:px-8">

            {{-- Judul halaman --}}
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Direktori Pendidik &amp; Tenaga Kependidikan</h1>
                <p class="mt-2 text-sm text-slate-500">Kelola akun akses, peran, dan penugasan staf untuk MI Internasional dan SMK Nusantara.</p>
            </div>

            {{-- Bar pencarian & filter --}}
            <div class="mt-8 flex flex-col gap-3 rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-100 sm:flex-row sm:items-center">
                <div class="relative w-full sm:max-w-xs lg:max-w-[320px] lg:flex-1">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    </span>
                    <input type="text" x-model="search" placeholder="Cari nama atau NIP..."
                           class="block w-full rounded-lg border border-slate-200 bg-slate-50/50 py-2.5 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand/20">
                </div>

                <div class="relative w-full sm:w-56">
                    <select x-model="filterPeran"
                            class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-3 pr-9 text-sm text-slate-700 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                        <option value="">-- Semua Peran --</option>
                        <option>Wali Kelas</option>
                        <option>Guru Kejuruan</option>
                        <option>Guru Mapel Umum</option>
                        <option>Tata Usaha / TU</option>
                    </select>
                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                    </span>
                </div>

                <button type="button" @click="modal = true"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 sm:ml-auto">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Tambah Pengguna
                </button>
            </div>

            {{-- Tabel --}}
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[860px] text-left">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/60 text-[11px] font-semibold uppercase tracking-wider text-slate-500">
                                <th class="py-4 pl-6 pr-4 lg:pl-[88px]">Nama Lengkap &amp; NIP</th>
                                <th class="px-4 py-4">Peran Sistem</th>
                                <th class="px-4 py-4">Unit Tugas</th>
                                <th class="px-4 py-4">Status Akun</th>
                                <th class="px-4 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                            <template x-for="u in filtered" :key="u.nip">
                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-4 pl-6 pr-4 lg:pl-[88px]">
                                        <p class="font-medium text-slate-900" x-text="u.nama"></p>
                                        <p class="mt-1 text-xs text-slate-400" x-text="u.nip"></p>
                                    </td>
                                    <td class="px-4 py-4 text-slate-700" x-text="u.peran"></td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex rounded border px-2.5 py-1 text-xs font-medium"
                                              :class="unitClass(u.unit)" x-text="u.unit"></span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-0.5 text-xs font-semibold"
                                              :class="u.status === 'Aktif' ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-slate-200 bg-slate-100 text-slate-600'">
                                            <span class="h-1.5 w-1.5 rounded-full"
                                                  :class="u.status === 'Aktif' ? 'bg-emerald-500' : 'bg-slate-400'"></span>
                                            <span x-text="u.status"></span>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-center gap-3 text-xs">
                                            <button type="button" class="font-medium text-amber-500 hover:text-amber-600">Edit</button>
                                            <span class="h-3 w-px bg-slate-300"></span>
                                            <button type="button" @click="toggleStatus(u)"
                                                    class="font-medium"
                                                    :class="u.status === 'Aktif' ? 'text-red-600 hover:text-red-700' : 'text-emerald-600 hover:text-emerald-700'"
                                                    x-text="u.status === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan'"></button>
                                        </div>
                                    </td>
                                </tr>
                            </template>

                            <tr x-cloak x-show="filtered.length === 0">
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400">Data pengguna tidak ditemukan.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Footer tabel --}}
                <div class="flex flex-col gap-3 border-t border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-sm text-slate-500">Menampilkan 1-4 dari 38 pengguna</p>
                    <div class="flex items-center gap-2">
                        <button type="button" class="rounded-lg border border-slate-200 bg-white px-4 py-1.5 text-sm text-slate-500 transition hover:bg-slate-50">Prev</button>
                        <button type="button" class="rounded-lg border border-slate-200 bg-white px-4 py-1.5 text-sm text-slate-800 transition hover:bg-slate-50">Next</button>
                    </div>
                </div>
            </div>

            {{-- Bar info --}}
            <div class="mt-8 flex flex-col gap-2 rounded-lg border border-slate-200 bg-white px-4 py-3.5 text-[11px] text-slate-500 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-3.5 w-3.5 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                    Data terintegrasi secara terpusat untuk Yayasan Nurun 'Alannur (MI Internasional &amp; SMK Nusantara).
                </p>
                <span class="text-slate-400">Sistem versi 2.4.0</span>
            </div>
        </main>
    </div>
</div>

{{-- ===================== MODAL TAMBAH PENGGUNA BARU ===================== --}}
<div x-cloak x-show="modal" class="fixed inset-0 z-50 flex items-center justify-center p-4"
     role="dialog" aria-modal="true" aria-labelledby="modal-title">

    {{-- Backdrop blur --}}
    <div x-show="modal" x-transition.opacity @click="modal = false"
         class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

    {{-- Panel --}}
    <div x-show="modal"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative flex max-h-[95vh] w-full max-w-lg flex-col overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-slate-100">

        {{-- Header modal --}}
        <div class="flex items-start justify-between border-b border-slate-200 px-6 py-4">
            <div>
                <h3 id="modal-title" class="text-lg font-semibold text-slate-900">Tambah Pengguna Baru</h3>
                <p class="mt-0.5 text-xs text-slate-500">Lengkapi formulir untuk mendaftarkan akun staf atau pendidik baru.</p>
            </div>
            <button type="button" @click="modal = false" aria-label="Tutup"
                    class="rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.pengguna.index') }}" method="POST" @submit.prevent="tambah()" class="flex min-h-0 flex-1 flex-col">
            @csrf

            {{-- Body modal --}}
            <div class="flex-1 space-y-4 overflow-y-auto px-6 py-5">

                {{-- Nama Lengkap & Gelar --}}
                <div>
                    <label for="nama" class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-slate-700">
                        Nama Lengkap &amp; Gelar <span class="text-red-500">*</span>
                    </label>
                    <input id="nama" name="nama" type="text" required x-model="form.nama"
                           placeholder="Contoh: Ustadzah Fatimah, S.Pd"
                           class="block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                </div>

                {{-- NIP / NIK --}}
                <div>
                    <label for="nip" class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-slate-700">
                        Nomor Induk Pegawai (NIP/NIK) <span class="text-red-500">*</span>
                    </label>
                    <input id="nip" name="nip" type="text" required inputmode="numeric" x-model="form.nip"
                           placeholder="Masukkan 16 digit NIP..."
                           class="block w-full rounded-lg border border-slate-200 bg-white px-3.5 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                    <p class="mt-1 text-[11px] text-slate-400">Gunakan format angka tanpa spasi atau karakter tanda baca.</p>
                </div>

                {{-- Unit & Peran (2 kolom) --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="unit" class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-slate-700">
                            Unit Penugasan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="unit" name="unit" required x-model="form.unit"
                                    class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-3.5 pr-10 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                                <option value="">Pilih Unit...</option>
                                <option>MI Internasional</option>
                                <option>SMK Nusantara</option>
                                <option>Yayasan (Pusat)</option>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                            </span>
                        </div>
                    </div>

                    <div>
                        <label for="peran" class="mb-1.5 block text-xs font-medium uppercase tracking-wide text-slate-700">
                            Peran Sistem <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="peran" name="peran" required x-model="form.peran"
                                    class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-3.5 pr-10 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                                <option value="">Pilih Peran...</option>
                                <option>Wali Kelas</option>
                                <option>Guru Kejuruan</option>
                                <option>Guru Mapel Umum</option>
                                <option>Tata Usaha / TU</option>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer modal --}}
            <div class="flex items-center justify-end gap-2.5 border-t border-slate-200 bg-white px-6 py-4">
                <button type="button" @click="modal = false"
                        class="rounded-lg border border-slate-200 bg-white px-5 py-2 text-sm font-medium text-slate-800 transition hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-brand px-5 py-2 text-sm font-semibold text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('penggunaPage', () => ({
            sidebar: false,
            modal: false,
            search: '',
            filterPeran: '',
            form: { nama: '', nip: '', unit: '', peran: '' },

            // Data dummy (frontend saja)
            users: [
                { nama: 'Ustadzah Siti Fatimah', nip: '19900415002', peran: 'Wali Kelas',      unit: 'MI Internasional', status: 'Aktif' },
                { nama: 'Bapak Heri Susanto',     nip: '19850822001', peran: 'Guru Kejuruan',   unit: 'SMK Nusantara',    status: 'Aktif' },
                { nama: 'Ibu Nur Fina',           nip: '19921105003', peran: 'Tata Usaha / TU', unit: 'Yayasan (Pusat)',  status: 'Aktif' },
                { nama: 'Bapak Ahmad Dahlan',     nip: '19780110005', peran: 'Guru Mapel Umum', unit: 'SMK Nusantara',    status: 'Cuti'  },
            ],

            get filtered() {
                const q = this.search.toLowerCase().trim();
                return this.users.filter(u =>
                    (!q || u.nama.toLowerCase().includes(q) || u.nip.includes(q)) &&
                    (!this.filterPeran || u.peran === this.filterPeran)
                );
            },

            unitClass(unit) {
                if (unit === 'MI Internasional') return 'border-amber-200 bg-amber-50 text-brand';
                if (unit === 'SMK Nusantara')    return 'border-blue-200 bg-blue-50 text-blue-700';
                return 'border-purple-200 bg-purple-50 text-purple-700';
            },

            toggleStatus(u) {
                u.status = u.status === 'Aktif' ? 'Nonaktif' : 'Aktif';
            },

            tambah() {
                this.users.unshift({ ...this.form, status: 'Aktif' });
                this.form = { nama: '', nip: '', unit: '', peran: '' };
                this.modal = false;
            },
        }));
    });
</script>
</body>
</html>