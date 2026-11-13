@extends('layouts.guru')

@section('title', 'Evaluasi Karakter & P5 | SIAKAD Panel')
@section('page_title', 'Evaluasi Karakter &amp; P5')
@section('page_data', 'sikapPage()')

@section('content')
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
                <span>SIAKAD v{{ $versi ?? '-' }}</span>
            </div>
        </main>
@endsection

@section('outside_content')
{{-- Notifikasi simpan (simulasi) --}}
<div x-cloak x-show="toast" x-transition
     class="fixed bottom-6 right-6 z-50 flex items-center gap-2.5 rounded-lg bg-slate-900 px-4 py-3 text-sm text-white shadow-xl">
    <svg class="h-4 w-4 text-emerald-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
    <span x-text="'Evaluasi ' + kelas + ' - ' + dimensi + ' berhasil disimpan.'"></span>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
        Alpine.data('sikapPage', () => ({
            sidebar: false,
            toast: false,
            toastTimer: null,

            kelas: @json($kelasSikapTerpilih ?? ''),
            dimensi: @json($dimensiSikapTerpilih ?? ''),
            daftarKelas: @json($kelasOptions ?? []),
            daftarDimensi: @json($dimensiOptions ?? []),
            predikat: @json($predikatOptions ?? []),
            data: @json($catatanSikap ?? []),

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
@endpush
