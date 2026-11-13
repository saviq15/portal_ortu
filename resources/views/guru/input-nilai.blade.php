@extends('layouts.guru')

@section('title', 'Jurnal & Penilaian Kelas | SIAKAD Panel')
@section('page_title', 'Jurnal &amp; Penilaian Kelas')
@section('page_data', 'nilaiPage()')

@section('content')
        <main class="flex-1 px-4 py-8 sm:px-8">

            {{-- Judul halaman --}}
            <div>
                <h1 class="text-2xl tracking-tight text-slate-800">Form Input Nilai &amp; Kehadiran</h1>
                <p class="mt-2 text-sm text-slate-500">Masukkan persentase presensi harian, nilai evaluasi materi, serta catatan akademik siswa secara langsung.</p>
            </div>

            {{-- Form (filter + tabel) --}}
            <form action="{{ route('guru.input-nilai') }}" method="POST" @submit.prevent="simpan()">
                @csrf

                {{-- Kartu filter --}}
                <div class="mt-8 flex flex-col gap-4 rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-200 sm:p-4 md:flex-row md:items-end md:justify-between">
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

                        {{-- Mata pelajaran --}}
                        <div class="w-full sm:w-64">
                            <label for="mapel" class="mb-1.5 block text-[11px] uppercase tracking-wider text-slate-500">Mata Pelajaran</label>
                            <div class="relative">
                                <select id="mapel" name="mapel" x-model="mapel"
                                        class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-3 pr-9 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                                    <template x-for="m in daftarMapel" :key="m">
                                        <option :value="m" x-text="m"></option>
                                    </template>
                                </select>
                                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-5 py-2.5 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 md:mb-0">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        Simpan Semua Nilai
                    </button>
                </div>

                {{-- Tabel input nilai --}}
                <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[900px] text-left">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50/60 text-[11px] uppercase tracking-wider text-slate-500">
                                    <th class="w-16 py-4 pl-6 pr-2 font-normal">No</th>
                                    <th class="px-4 py-4 font-normal">Nama Siswa</th>
                                    <th class="px-4 py-4 font-normal">Kehadiran (%)</th>
                                    <th class="px-4 py-4 text-center font-normal leading-snug">Nilai Materi<br><span class="normal-case tracking-normal">(0-100)</span></th>
                                    <th class="px-4 py-4 font-normal">Status</th>
                                    <th class="py-4 pl-4 pr-6 font-normal">Catatan (Opsional)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                                <template x-for="(s, i) in siswa" :key="kelas + s.nis">
                                    <tr class="transition hover:bg-slate-50/40">
                                        <td class="py-4 pl-6 pr-2 text-slate-500" x-text="i + 1"></td>

                                        <td class="px-4 py-4">
                                            <p class="text-slate-900" x-text="s.nama"></p>
                                            <p class="mt-0.5 text-[11px] text-slate-400" x-text="'NIS: ' + s.nis"></p>
                                        </td>

                                        {{-- Kehadiran --}}
                                        <td class="px-4 py-4">
                                            <div class="flex items-center gap-2">
                                                <input type="number" min="0" max="100" x-model="s.kehadiran"
                                                       @input="clamp(s, 'kehadiran')"
                                                       :name="'siswa[' + s.nis + '][kehadiran]'"
                                                       class="w-20 rounded-lg border border-slate-200 bg-white py-2.5 text-center text-sm text-slate-800 shadow-sm transition [appearance:textfield] focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                                                <span class="text-[11px] text-slate-400">%</span>
                                            </div>
                                        </td>

                                        {{-- Nilai materi --}}
                                        <td class="px-4 py-4">
                                            <div class="flex justify-center">
                                                <input type="number" min="0" max="100" x-model="s.nilai"
                                                       @input="hitungStatus(s)"
                                                       :name="'siswa[' + s.nis + '][nilai]'"
                                                       class="w-20 rounded-lg border py-2.5 text-center text-sm shadow-sm transition [appearance:textfield] focus:outline-none focus:ring-2 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                                       :class="belumTuntas(s)
                                                            ? 'border-red-300 bg-red-50 text-red-600 focus:border-red-400 focus:ring-red-200'
                                                            : 'border-slate-200 bg-white text-slate-800 focus:border-brand focus:ring-brand/20'">
                                            </div>
                                        </td>

                                        {{-- Status --}}
                                        <td class="px-4 py-4">
                                            <div class="relative w-36">
                                                <select x-model="s.status" :name="'siswa[' + s.nis + '][status]'"
                                                        class="block w-full appearance-none rounded-lg border py-2 pl-3 pr-8 text-xs transition focus:outline-none focus:ring-2"
                                                        :class="s.status === 'Tuntas'
                                                            ? 'border-emerald-200 bg-emerald-50 text-emerald-700 focus:ring-emerald-200'
                                                            : 'border-red-200 bg-red-50 text-red-600 focus:ring-red-200'">
                                                    @foreach(($statusNilaiOptions ?? ['Tuntas', 'Belum Tuntas']) as $statusNilai)
                                                        <option value="{{ $statusNilai }}">{{ $statusNilai }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center"
                                                      :class="s.status === 'Tuntas' ? 'text-emerald-700' : 'text-red-600'">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                                                </span>
                                            </div>
                                        </td>

                                        {{-- Catatan --}}
                                        <td class="py-4 pl-4 pr-6">
                                            <input type="text" x-model="s.catatan" placeholder="--"
                                                   :name="'siswa[' + s.nis + '][catatan]'"
                                                   class="block w-full min-w-[180px] max-w-[240px] rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-300 shadow-sm transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                                        </td>
                                    </tr>
                                </template>

                                <tr x-cloak x-show="siswa.length === 0">
                                    <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-400">Belum ada data siswa pada rombongan belajar ini.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Bar info --}}
                    <div class="flex items-center gap-2.5 border-t border-sky-100 bg-sky-50 px-6 py-4 text-xs text-sky-700">
                        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                        <p>Pastikan Anda menekan tombol 'Simpan Semua Nilai' sebelum berpindah kelas.</p>
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
    <span x-text="'Nilai ' + kelas + ' - ' + mapel + ' berhasil disimpan.'"></span>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
        Alpine.data('nilaiPage', () => ({
            sidebar: false,
            toast: false,
            toastTimer: null,
            kkm: @json($kkmNilai ?? 70),

            kelas: @json($kelasNilaiTerpilih ?? ''),
            mapel: @json($mataPelajaranNilaiTerpilih ?? ''),
            daftarKelas: @json($kelasOptions ?? []),
            daftarMapel: @json($mataPelajaranOptions ?? []),

            data: @json($nilaiSiswa ?? []),

            get siswa() {
                return this.data[this.kelas] || [];
            },

            // Batasi angka 0-100
            clamp(s, field) {
                if (s[field] === '' || s[field] === null) return;
                const v = parseInt(s[field], 10);
                s[field] = isNaN(v) ? '' : Math.min(100, Math.max(0, v));
            },

            // Status otomatis mengikuti nilai (masih bisa diubah manual lewat dropdown)
            hitungStatus(s) {
                this.clamp(s, 'nilai');
                if (s.nilai === '') return;
                s.status = s.nilai >= this.kkm ? 'Tuntas' : 'Belum Tuntas';
            },

            belumTuntas(s) {
                return s.nilai !== '' && Number(s.nilai) < this.kkm;
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
