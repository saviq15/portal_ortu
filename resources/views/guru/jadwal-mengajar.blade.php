@extends('layouts.guru')

@section('title', 'Jadwal Mengajar Guru | SIAKAD Panel')
@section('page_title', 'Jadwal Mengajar Guru')
@section('page_data', 'jadwalPage()')
@section('shell_class', 'guru-app-shell no-print')
@section('shell_attributes')
x-show="view === 'jadwal'"
@endsection

@section('content')
        <main class="flex-1 px-4 py-8 sm:px-8">

            {{-- Judul halaman --}}
            <div>
                <h1 class="text-2xl tracking-tight text-slate-800">Jadwal Mengajar Bapak Heri Susanto</h1>
                <p class="mt-2 text-sm text-slate-500">Daftar kelas, mata pelajaran, dan waktu mengajar Anda selama satu minggu.</p>
            </div>

            {{-- Bar filter --}}
            <div class="mt-8 flex flex-col gap-3 rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-200 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <label for="hari" class="text-xs text-slate-600">Pilih Hari:</label>
                    <div class="relative w-48">
                        <select id="hari" x-model="hari"
                                class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2 pl-3 pr-9 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <option value="">Semua Hari</option>
                            <option>Senin</option>
                            <option>Selasa</option>
                            <option>Rabu</option>
                            <option>Kamis</option>
                            <option>Jumat</option>
                            <option>Sabtu</option>
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </span>
                    </div>
                </div>

                <button type="button" @click="bukaCetak()"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-5 py-2 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/></svg>
                    Cetak Jadwal
                </button>
            </div>

            {{-- Tabel jadwal --}}
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[820px] text-left">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/60 text-[11px] uppercase tracking-wider text-slate-500">
                                <th class="py-4 pl-6 pr-4 font-normal lg:pl-[88px]">Hari</th>
                                <th class="px-4 py-4 font-normal">Waktu</th>
                                <th class="px-4 py-4 font-normal">Kelas</th>
                                <th class="px-4 py-4 font-normal">Mata Pelajaran</th>
                                <th class="px-4 py-4 font-normal">Ruang</th>
                                <th class="px-4 py-4 font-normal">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                            <template x-for="j in filtered" :key="j.hari + j.waktu + j.kelas">
                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-[18px] pl-6 pr-4 lg:pl-[88px]" x-text="j.hari"></td>
                                    <td class="px-4 py-[18px] text-slate-600" x-text="j.waktu"></td>
                                    <td class="px-4 py-[18px]" x-text="j.kelas"></td>
                                    <td class="px-4 py-[18px]" x-text="j.mapel"></td>
                                    <td class="px-4 py-[18px]">
                                        <span class="inline-flex rounded border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs text-slate-600" x-text="j.ruang"></span>
                                    </td>
                                    <td class="px-4 py-[18px]">
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-0.5 text-xs text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Aktif
                                        </span>
                                    </td>
                                </tr>
                            </template>

                            <tr x-cloak x-show="filtered.length === 0">
                                <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-400">Tidak ada jadwal mengajar pada hari ini.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Footer tabel --}}
                <div class="flex flex-col gap-2 border-t border-slate-200 px-6 py-3.5 text-xs sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-slate-500">Total: 5 sesi mengajar terjadwal (24 Jam Pelajaran / minggu)</p>
                    <p class="flex items-center gap-2 text-emerald-600">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        Semua jadwal terverifikasi bagian kurikulum
                    </p>
                </div>
            </div>

            {{-- Info bar --}}
            <div class="mt-6 flex flex-col gap-2 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Jurnal dan Penilaian terintegrasi secara otomatis ke Rapor Digital Siswa Yayasan Nurun 'Alannur.
                </p>
                <span>SIAKAD v2.4.0</span>
            </div>
        </main>
@endsection

@section('outside_content')
{{-- =====================================================================
     TAMPILAN 2 : CETAK DOKUMEN A4 (FOTO 2)
     ===================================================================== --}}
<div x-cloak x-show="view === 'cetak'" class="print-wrap min-h-screen bg-slate-200 px-4 py-8">

    <div class="print-sheet mx-auto w-full max-w-[896px] overflow-hidden rounded-lg bg-white shadow-lg">

        {{-- Bar atas (tidak ikut tercetak) --}}
        <div class="no-print flex flex-col gap-3 border-b-4 border-slate-800 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
            <button type="button" @click="tutupCetak()"
                    class="inline-flex items-center gap-2 text-sm text-slate-600 transition hover:text-slate-900">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                &lt; Kembali ke Jadwal
            </button>

            <div class="flex items-center gap-4">
                <span class="hidden items-center gap-2 text-xs text-slate-500 sm:inline-flex">
                    <svg class="h-4 w-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                    Format A4 Siap Cetak
                </span>
                <button type="button" @click="window.print()"
                        class="inline-flex items-center gap-2 rounded-lg bg-brand px-5 py-2 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/></svg>
                    Cetak Dokumen
                </button>
            </div>
        </div>

        {{-- Isi dokumen --}}
        <div class="px-6 pb-10 pt-12 sm:px-12">

            {{-- Kop surat --}}
            <div class="flex flex-col gap-4 border-b-2 border-slate-900 pb-5 sm:flex-row sm:items-start sm:justify-between">
                <div class="flex items-start gap-4">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-full border-2 border-slate-900 bg-slate-100">
                        <img src="{{ asset('images/logo.png') }}" alt="LOGO" class="h-full w-full object-contain p-0.5"
                             onerror="this.replaceWith(Object.assign(document.createElement('span'),{className:'text-[10px] tracking-wider text-slate-700',textContent:'LOGO'}))">
                    </div>
                    <div>
                        <h2 class="text-xl uppercase tracking-tight text-slate-900">Yayasan Nurun 'Alannur</h2>
                        <p class="mt-0.5 text-sm text-slate-900">SMK Nusantara</p>
                        <p class="mt-1 text-[11px] text-slate-600">Kapencar RT. 10 RW. 09, Kecamatan Kertek, Kabupaten Wonosobo, Jawa Tengah 56371</p>
                    </div>
                </div>
                <div class="text-left sm:text-right">
                    <p class="text-sm uppercase text-slate-900">Tahun Ajaran 2026/2027</p>
                    <p class="mt-1 text-xs text-slate-600">Semester Ganjil</p>
                    <p class="mt-1 text-[11px] text-slate-500">Status: Terverifikasi Kurikulum</p>
                </div>
            </div>

            {{-- Judul dokumen --}}
            <div class="mt-8 text-center">
                <h3 class="text-xl uppercase tracking-wide text-slate-900 underline underline-offset-4">Jadwal Mengajar Guru</h3>
                <p class="mt-2 text-sm text-slate-900">Nama: Bapak Heri Susanto | NIP: 198010202005011001</p>
            </div>

            {{-- Tabel dokumen --}}
            <div class="mt-8 overflow-x-auto">
                <table class="w-full min-w-[640px] border-collapse border-2 border-slate-900 text-sm text-slate-900">
                    <thead>
                        <tr class="bg-slate-100 text-xs uppercase tracking-wide">
                            <th class="border-2 border-slate-900 px-3 py-2.5 font-normal">Hari</th>
                            <th class="border-2 border-slate-900 px-3 py-2.5 font-normal">Waktu</th>
                            <th class="border-2 border-slate-900 px-3 py-2.5 font-normal">Kelas</th>
                            <th class="border-2 border-slate-900 px-3 py-2.5 font-normal">Mata Pelajaran</th>
                            <th class="border-2 border-slate-900 px-3 py-2.5 font-normal">Ruang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="j in jadwal" :key="'p' + j.hari + j.waktu + j.kelas">
                            <tr>
                                <td class="border-2 border-slate-900 px-3 py-3 text-center" x-text="j.hari"></td>
                                <td class="border-2 border-slate-900 px-3 py-3 text-center text-xs" x-text="j.waktu"></td>
                                <td class="border-2 border-slate-900 px-3 py-3 text-center" x-text="j.kelas"></td>
                                <td class="border-2 border-slate-900 px-4 py-3" x-text="j.mapel"></td>
                                <td class="border-2 border-slate-900 px-3 py-3 text-center" x-text="j.ruang"></td>
                            </tr>
                        </template>
                        <tr class="bg-slate-50">
                            <td colspan="5" class="border-2 border-slate-900 px-3 py-2 text-xs text-slate-600">
                                * Total beban mengajar: 5 sesi per minggu (24 Jam Pelajaran ekuivalen).
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Tanda tangan --}}
            <div class="mt-12 grid grid-cols-1 gap-10 text-center text-sm text-slate-900 sm:grid-cols-2">
                <div>
                    <p>Mengetahui,</p>
                    <p class="mt-3">Kepala Sekolah</p>
                    <div class="h-24"></div>
                    <p class="underline">(.....................................)</p>
                    <p class="mt-1 text-[11px] text-slate-500">NIP. ................................</p>
                </div>
                <div>
                    <p>Wonosobo, 29 Oktober 2026</p>
                    <p class="mt-3">Guru Mata Pelajaran</p>
                    <div class="h-24"></div>
                    <p class="underline">Bapak Heri Susanto</p>
                    <p class="mt-1 text-[11px] text-slate-500">NIP. 198010202005011001</p>
                </div>
            </div>

            {{-- Footer dokumen --}}
            <div class="mt-12 flex flex-col gap-1 border-t border-slate-300 pt-3 text-[10px] text-slate-500 sm:flex-row sm:justify-between">
                <p>Dicetak melalui SIAKAD Panel Yayasan Nurun 'Alannur</p>
                <p>Dokumen Resmi Akademik &bull; Halaman 1 dari 1</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
@media print {
            @page { size: A4; margin: 12mm; }
            html, body { background: #fff !important; }
            .no-print { display: none !important; }
            .print-sheet { box-shadow: none !important; border-radius: 0 !important; max-width: 100% !important; margin: 0 !important; }
            .print-wrap { padding: 0 !important; background: #fff !important; }
        }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
        Alpine.data('jadwalPage', () => ({
            sidebar: false,
            view: 'jadwal',   // 'jadwal' (foto 1) | 'cetak' (foto 2)
            hari: '',

            // Data dummy (frontend saja)
            jadwal: [
                { hari: 'Senin',  waktu: '07:30 - 09:00', kelas: 'X TKJ 1',  mapel: 'Dasar Jaringan', ruang: 'Lab Komputer 1' },
                { hari: 'Senin',  waktu: '09:30 - 11:00', kelas: 'XI TKR 1', mapel: 'Mesin Otomotif', ruang: 'Bengkel Utama'  },
                { hari: 'Senin',  waktu: '11:00 - 12:30', kelas: 'X TKJ 2',  mapel: 'Dasar Jaringan', ruang: 'Lab Komputer 2' },
                { hari: 'Selasa', waktu: '07:30 - 09:00', kelas: 'X TKJ 1',  mapel: 'Dasar Jaringan', ruang: 'Lab Komputer 1' },
                { hari: 'Kamis',  waktu: '09:30 - 11:00', kelas: 'XI TKR 2', mapel: 'Mesin Otomotif', ruang: 'Bengkel Utama'  },
            ],

            get filtered() {
                return this.jadwal.filter(j => !this.hari || j.hari === this.hari);
            },

            bukaCetak()  { this.view = 'cetak';  window.scrollTo(0, 0); },
            tutupCetak() { this.view = 'jadwal'; window.scrollTo(0, 0); },
        }));
    });
</script>
@endpush
