@extends('layouts.guru')

@section('title', 'Pengaturan Akun | SIAKAD Panel')
@section('page_title', 'Pengaturan Akun')
@section('page_data', 'profilPage()')

@section('content')
        <main class="flex-1 px-4 py-8 sm:px-8">

            {{-- Judul halaman --}}
            <div>
                <h1 class="text-2xl tracking-tight text-slate-900">Profil Pengguna &amp; Keamanan</h1>
                <p class="mt-2 text-sm text-slate-500">Kelola informasi data diri, kontak, dan kata sandi akun Anda.</p>
            </div>

            <div class="mt-8 grid grid-cols-1 items-start gap-6 lg:grid-cols-[1.3fr_1fr]">
                {{-- {{ route('profil-pengguna') }} --}}
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
                {{-- "{{ route('password.update') }}" --}}
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
@endsection

@section('outside_content')
{{-- Notifikasi (simulasi) --}}
<div x-cloak x-show="toast" x-transition
     class="fixed bottom-6 right-6 z-50 flex items-center gap-2.5 rounded-lg bg-slate-900 px-4 py-3 text-sm text-white shadow-xl">
    <svg class="h-4 w-4 text-emerald-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
    <span x-text="pesan"></span>
</div>
@endsection

@push('scripts')
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
@endpush
