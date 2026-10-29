<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | Sistem Informasi Laporan Siswa</title>

    {{-- Jika proyek sudah memakai Vite + Tailwind, ganti CDN di bawah dengan: @vite('resources/css/app.css') --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Roboto', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
                    colors: {
                        brand: { DEFAULT: '#7F1D1D', dark: '#661717' },
                    },
                },
            },
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-800 antialiased">

    <main class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-10">

        {{-- Dekorasi: lingkaran putus-putus + watermark logo samar --}}
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 flex items-center justify-center">
            <div class="relative flex h-[520px] w-[520px] items-center justify-center rounded-full border-2 border-dashed border-slate-200 sm:h-[640px] sm:w-[640px]">
                <img src="{{ asset('images/logo.png') }}" alt=""
                     class="h-72 w-72 object-contain opacity-[0.05] sm:h-96 sm:w-96">
            </div>
        </div>

        <div class="relative z-10 w-full max-w-[400px]">

            {{-- Kartu Login --}}
            <div class="rounded-2xl bg-white px-6 py-10 shadow-xl shadow-slate-200/70 ring-1 ring-slate-100 sm:px-9">

                {{-- Logo & Judul --}}
                <div class="flex flex-col items-center text-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Sekolah"
                         class="h-[72px] w-[72px] object-contain">
                    <h1 class="mt-6 text-xl font-bold tracking-tight text-slate-900">
                        Sistem Informasi Laporan Siswa
                    </h1>
                    <p class="mt-2 text-xs text-slate-500">
                        Portal Terpadu MI Internasional &amp; SMK Nusantara
                    </p>
                </div>

                {{-- Pesan error --}}
                @if ($errors->any())
                    <div class="mt-6 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="#" class="mt-8"></form>
                    @csrf

                    {{-- ID Pengguna / NIP --}}
                    <div>
                        <label for="id_pengguna" class="mb-2 block text-xs font-semibold text-slate-800">
                            ID Pengguna / NIP
                        </label>
                        <div class="relative">
                            <input id="id_pengguna" name="id_pengguna" type="text"
                                   value="{{ old('id_pengguna') }}"
                                   placeholder="Masukkan ID Pengguna atau NIP"
                                   autocomplete="username" required
                                   class="block w-full rounded-lg border border-slate-200 bg-white py-2.5 pl-3 pr-10 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 @error('id_pengguna') border-red-400 @enderror">
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.118a7.5 7.5 0 0115 0A17.933 17.933 0 0112 21.75a17.933 17.933 0 01-7.5-1.632z"/>
                                </svg>
                            </span>
                        </div>
                    </div>

                    {{-- Kata Sandi --}}
                    <div class="mt-4">
                        <label for="password" class="mb-2 block text-xs font-semibold text-slate-800">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <input id="password" name="password" type="password"
                                   placeholder="••••••••"
                                   autocomplete="current-password" required
                                   class="block w-full rounded-lg border border-slate-200 bg-white py-2.5 pl-3 pr-10 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 @error('password') border-red-400 @enderror">
                            <button type="button" id="togglePassword"
                                    aria-label="Tampilkan atau sembunyikan kata sandi"
                                    class="absolute inset-y-0 right-3 flex items-center text-slate-400 transition hover:text-slate-600">
                                {{-- gembok tertutup --}}
                                <svg id="lockClosed" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                                </svg>
                                {{-- gembok terbuka --}}
                                <svg id="lockOpen" class="hidden h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Info hak akses --}}
                    <p class="mt-5 flex items-center gap-1.5 text-[11px] text-slate-400">
                        <svg class="h-3.5 w-3.5 shrink-0 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Hak akses terdeteksi otomatis oleh sistem
                    </p>

                    {{-- Tombol Masuk --}}
                    <button type="submit"
                            class="group mt-7 flex w-full items-center justify-center gap-2 rounded-lg bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 active:scale-[0.99]">
                        Masuk ke Sistem
                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </button>
                </form>

                {{-- Bantuan --}}
                <div class="mt-8 border-t border-slate-100 pt-6 text-center text-xs text-slate-500">
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/>
                        </svg>
                        Butuh bantuan?
                        <a href="#" class="font-semibold text-slate-800 hover:text-brand hover:underline">Hubungi Administrator</a>
                    </span>
                </div>
            </div>

            {{-- Footer --}}
            <p class="mt-6 text-center text-[11px] text-slate-400">
                &copy; {{ date('Y') }} Yayasan Nurun 'Alannur. All rights reserved.
            </p>
        </div>
    </main>

    <script>
        // Tampilkan / sembunyikan kata sandi (gembok tertutup <-> terbuka)
        const toggleBtn  = document.getElementById('togglePassword');
        const pwdInput   = document.getElementById('password');
        const lockClosed = document.getElementById('lockClosed');
        const lockOpen   = document.getElementById('lockOpen');

        toggleBtn.addEventListener('click', () => {
            const show = pwdInput.type === 'password';
            pwdInput.type = show ? 'text' : 'password';
            lockClosed.classList.toggle('hidden', show);
            lockOpen.classList.toggle('hidden', !show);
        });
    </script>
</body>
</html>