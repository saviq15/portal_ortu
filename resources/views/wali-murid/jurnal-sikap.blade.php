@extends('layouts.wali')

@section('title', 'Evaluasi Karakter & P5 | SIAKAD Panel')
@section('page_title', 'Evaluasi Karakter &amp; P5')
@section('page_title_class', 'text-base text-slate-900')
@section('page_data', 'sikapPage()')
@section('escape_action', 'sidebar = false')
@section('year_label', 'Tahun Ajaran 2026/2027')
@section('year_badge_class', 'hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700 sm:inline-flex')
@section('profile_badge_class', 'flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-xs font-medium text-white')
@section('profile_name_class', 'text-xs text-slate-900')
@section('profile_role_class', 'text-[10px] text-slate-500')

@section('page_title_prefix')
    <span class="h-5 w-1 rounded-full bg-brand"></span>
@endsection

@section('shell_visibility')
view === 'jurnal'
@endsection
@section('shell_class', 'no-print')

@section('content')
<main class="flex-1 space-y-6 px-4 py-8 sm:px-8">

            {{-- Judul + unduh --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h1 class="text-2xl tracking-tight text-slate-900">Jurnal Perkembangan Karakter</h1>
                    <p class="mt-2 text-sm text-slate-500">Laporan observasi dimensi Profil Pelajar Pancasila (P5) ananda Ahmad Fauzi.</p>
                </div>
                <button type="button" @click="bukaCetak()"
                        class="inline-flex w-fit items-center justify-center gap-2 rounded-lg bg-brand px-5 py-3 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                    Unduh Jurnal (PDF)
                </button>
            </div>

            {{-- Kartu siswa --}}
            <section class="flex flex-col gap-3 rounded-xl bg-white px-5 py-4 shadow-sm ring-1 ring-slate-200 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full border border-blue-200 bg-blue-50 text-sm text-blue-600">AF</div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <p class="text-sm text-slate-900">Ahmad Fauzi</p>
                            <span class="rounded border border-slate-200 bg-slate-50 px-2 py-0.5 text-[11px] text-slate-600">NIS: 20261001</span>
                        </div>
                        <p class="mt-1 text-[11px] text-slate-500">Kelas X TKJ 1 &bull; SMK Nusantara &bull; Semester Ganjil 2026/2027</p>
                    </div>
                </div>
                <span class="inline-flex w-fit items-center gap-2 rounded-md border border-slate-200 bg-slate-50 px-3.5 py-2 text-xs text-slate-700">
                    <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    Wali Kelas: Bapak Heri Susanto
                </span>
            </section>

            {{-- Daftar dimensi --}}
            <div class="space-y-5">
                <template x-for="d in dimensi" :key="d.nama">
                    <article class="overflow-hidden rounded-xl border-l-4 bg-white px-6 py-5 shadow-sm ring-1 ring-slate-200" :class="d.warna.garis">

                        <div class="flex items-center justify-between gap-3">
                            <h3 class="flex items-center gap-3 text-lg text-slate-900">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg" :class="d.warna.ikon">
                                    <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" x-html="d.svg"></svg>
                                </span>
                                <span x-text="'Dimensi: ' + d.nama"></span>
                            </h3>
                            <span class="inline-flex shrink-0 items-center gap-1.5 rounded-full border px-3 py-1 text-xs" :class="d.warna.lencana">
                                <span class="h-1.5 w-1.5 rounded-full" :class="d.warna.titik"></span>
                                <span x-text="d.predikat"></span>
                            </span>
                        </div>

                        <div class="mt-4 rounded-lg border px-4 py-3.5 text-sm leading-relaxed text-slate-800" :class="d.warna.kotak">
                            <span class="text-slate-900">Deskripsi Observasi:</span> <span x-html="d.deskripsi"></span>
                        </div>

                        <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <p class="flex items-center gap-2 text-[11px] text-slate-400">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span x-text="'Diperbarui oleh: Bapak Heri Susanto - ' + d.tgl"></span>
                            </p>
                            <span class="w-fit rounded px-2.5 py-0.5 text-[11px]" :class="d.warna.status" x-text="d.status"></span>
                        </div>
                    </article>
                </template>
            </div>

            {{-- Info bar --}}
            <div class="flex flex-col gap-2 rounded-lg border border-slate-200 bg-white px-4 py-3.5 text-[11px] text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Jurnal ini merupakan catatan kumulatif selama satu semester berjalan.
                </p>
                <span class="text-slate-400">SIAKAD Digital Assessment v2.4</span>
            </div>
        </main>
@endsection

@section('outside_content')
{{-- =====================================================================
     TAMPILAN 2 : PRATINJAU CETAK JURNAL P5 (FOTO 2)
     ===================================================================== --}}
<div x-cloak x-show="view === 'cetak'" class="print-wrap min-h-screen bg-slate-200 px-4 py-8">

    <div class="mx-auto w-full max-w-[896px]">

        <div class="print-sheet overflow-hidden rounded-lg bg-white shadow-lg">

            {{-- Bar atas (tidak ikut tercetak) --}}
            <div class="no-print flex flex-col gap-3 border-b-4 border-slate-800 px-5 py-4 md:flex-row md:items-center md:justify-between">
                <button type="button" @click="tutupCetak()"
                        class="inline-flex items-center gap-2 text-sm text-slate-600 transition hover:text-slate-900">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                    &lt; Kembali ke Jurnal Sikap &amp; P5
                </button>

                <span class="hidden items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-4 py-1.5 text-xs text-slate-600 md:inline-flex">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Format Laporan Resmi P5 (Standar A4 Kemdikbud)
                </span>

                <button type="button" @click="window.print()"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-5 py-2.5 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/></svg>
                    Simpan sebagai PDF
                </button>
            </div>

            {{-- Isi dokumen --}}
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
                    <div class="hidden shrink-0 border-2 border-slate-900 px-5 py-1.5 text-center text-slate-900 sm:block">
                        <p class="text-[9px] uppercase tracking-wider">Akreditasi</p>
                        <p class="text-xl leading-tight">A</p>
                    </div>
                </div>

                {{-- Judul --}}
                <div class="mt-8 text-center">
                    <h3 class="text-xl uppercase tracking-wide text-slate-900">Jurnal Perkembangan Karakter &amp; P5</h3>
                    <p class="mt-2 text-xs text-slate-600">Laporan Observasi Dimensi Profil Pelajar Pancasila (P5) Semester Ganjil 2026/2027</p>
                </div>

                {{-- Identitas --}}
                <div class="mt-8 grid grid-cols-1 gap-x-10 gap-y-2 border-b border-slate-300 pb-4 text-sm text-slate-900 md:grid-cols-2">
                    <dl class="space-y-2">
                        <div class="grid grid-cols-[150px_1fr] gap-1"><dt class="text-slate-600">Nama Peserta Didik</dt><dd>: Ahmad Fauzi</dd></div>
                        <div class="grid grid-cols-[150px_1fr] gap-1"><dt class="text-slate-600">NIS / NISN</dt><dd>: 20261001 / 0081234567</dd></div>
                    </dl>
                    <dl class="space-y-2">
                        <div class="grid grid-cols-[110px_1fr] gap-1"><dt class="text-slate-600">Kelas</dt><dd>: X TKJ 1 (SMK Nusantara)</dd></div>
                        <div class="grid grid-cols-[110px_1fr] gap-1"><dt class="text-slate-600">Wali Kelas</dt><dd>: Bapak Heri Susanto</dd></div>
                    </dl>
                </div>

                {{-- Kotak dimensi --}}
                <div class="mt-6 space-y-5">
                    <template x-for="(d, i) in dimensi" :key="'p' + d.nama">
                        <div class="avoid-break rounded border border-slate-900 px-4 py-3">
                            <div class="flex flex-col gap-2 border-b border-slate-300 pb-2 sm:flex-row sm:items-center sm:justify-between">
                                <p class="text-base text-slate-900" x-text="(i + 1) + '. Dimensi: ' + d.nama"></p>
                                <span class="w-fit rounded border border-slate-900 px-3 py-0.5 text-sm text-slate-900" x-text="'Predikat: ' + d.predikat"></span>
                            </div>
                            <p class="mt-3 text-sm leading-relaxed text-slate-900" x-text="'Deskripsi Observasi: ' + d.teks"></p>
                            <div class="mt-3 flex flex-col gap-1 border-t border-dashed border-slate-300 pt-2 text-[11px] text-slate-600 sm:flex-row sm:justify-between">
                                <p x-text="'Verifikator: Bapak Heri Susanto (' + d.tgl + ')'"></p>
                                <p x-text="d.cetakStatus"></p>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Keterangan predikat --}}
                <div class="mt-5 flex flex-col gap-2 rounded border border-slate-300 bg-slate-50 px-4 py-3 text-[11px] text-slate-600 md:flex-row md:items-center md:justify-between">
                    <span class="text-slate-900">KETERANGAN PREDIKAT P5:</span>
                    <span class="flex flex-wrap gap-x-5 gap-y-1">
                        <span>SB: Sangat Baik</span><span>B: Baik</span><span>C: Cukup</span><span>MB: Mulai Berkembang</span>
                    </span>
                </div>

                {{-- Tanda tangan --}}
                <div class="avoid-break mt-12 grid grid-cols-1 gap-10 text-center text-sm text-slate-900 sm:grid-cols-2">
                    <div class="sm:pt-5">
                        <p>Mengetahui,</p>
                        <p class="mt-2">Orang Tua / Wali</p>
                        <p class="mb-1 mt-14 text-[11px] text-slate-400">[ Tanda Tangan ]</p>
                        <p class="mx-auto w-44 border-b border-slate-900 pb-0.5">( Bapak Mahmud )</p>
                    </div>
                    <div>
                        <p x-text="'Wonosobo, ' + dicetak"></p>
                        <p class="mt-2">Wali Kelas</p>
                        <p class="mb-1 mt-14 text-[11px] text-slate-400">[ Tanda Tangan / Stempel ]</p>
                        <p class="mx-auto w-44 border-b border-slate-900 pb-0.5">( Bapak Heri Susanto )</p>
                        <p class="mt-1 text-[11px] text-slate-600">NIP. 19850314 201101 1 009</p>
                    </div>
                </div>

                {{-- Footer dokumen --}}
                <div class="mt-10 flex flex-col gap-1 border-t border-slate-300 pt-3 text-[10px] text-slate-500 sm:flex-row sm:justify-between">
                    <p>Dokumen Resmi SIAKAD v2.4.0 — Yayasan Pendidikan Nurun 'Alannur</p>
                    <p x-text="'Dicetak otomatis melalui Portal Wali Murid • ' + dicetak"></p>
                </div>
            </div>
        </div>

        {{-- Petunjuk (tidak ikut tercetak) --}}
        <p class="no-print mt-4 flex flex-wrap items-center justify-center gap-1.5 text-xs text-slate-500">
            Gunakan tombol
            <kbd class="rounded border border-slate-300 bg-white px-2 py-0.5 text-[11px] text-slate-700">Ctrl + P</kbd>
            atau tombol Simpan sebagai PDF di atas untuk mencetak lembar jurnal karakter ini.
        </p>
    </div>
</div>
@endsection

@push('styles')
<style>
@media print {
            @page { size: A4 portrait; margin: 12mm; }
            html, body { background: #fff !important; }
            .no-print { display: none !important; }
            .print-wrap { padding: 0 !important; background: #fff !important; min-height: 0 !important; }
            .print-sheet { box-shadow: none !important; border-radius: 0 !important; max-width: 100% !important; margin: 0 !important; }
            .avoid-break { break-inside: avoid; }
        }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('sikapPage', () => ({
            sidebar: false,
            view: 'jurnal',   // 'jurnal' (foto 1) | 'cetak' (foto 2)
            dicetak: '',

            // Data dummy (frontend saja)
            dimensi: [
                {
                    nama: 'Bergotong Royong', predikat: 'Sangat Baik (SB)', tgl: '20 Okt 2026',
                    status: 'Terverifikasi Tim P5', cetakStatus: 'Terverifikasi Tim P5 Sekolah',
                    teks: 'Ananda Ahmad Fauzi sangat aktif membantu teman sejawat saat praktikum jaringan dan mampu memimpin pembagian tugas kelompok dengan sangat adil.',
                    deskripsi: 'Ananda Ahmad Fauzi sangat aktif membantu teman sejawat saat praktikum jaringan dan mampu memimpin pembagian tugas kelompok dengan sangat adil.',
                    warna: {
                        garis: 'border-l-blue-500', ikon: 'bg-blue-50 text-blue-600',
                        lencana: 'border-blue-200 bg-blue-50 text-blue-700', titik: 'bg-blue-500',
                        kotak: 'border-slate-100 bg-slate-50/70', status: 'bg-emerald-50 text-emerald-700',
                    },
                    svg: '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>',
                },
                {
                    nama: 'Bernalar Kritis', predikat: 'Baik (B)', tgl: '15 Okt 2026',
                    status: 'Terverifikasi Tim P5', cetakStatus: 'Terverifikasi Tim P5 Sekolah',
                    teks: 'Mampu memecahkan masalah dasar pada troubleshooting jaringan secara mandiri, meskipun terkadang masih perlu validasi dari guru pembimbing.',
                    deskripsi: 'Mampu memecahkan masalah dasar pada <span class="text-slate-900">troubleshooting</span> jaringan secara mandiri, meskipun terkadang masih perlu validasi dari guru pembimbing.',
                    warna: {
                        garis: 'border-l-emerald-500', ikon: 'bg-emerald-50 text-emerald-600',
                        lencana: 'border-emerald-200 bg-emerald-50 text-emerald-700', titik: 'bg-emerald-500',
                        kotak: 'border-slate-100 bg-slate-50/70', status: 'bg-emerald-50 text-emerald-700',
                    },
                    svg: '<path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"/>',
                },
                {
                    nama: 'Mandiri', predikat: 'Cukup (C)', tgl: '10 Okt 2026',
                    status: 'Perlu Pendampingan', cetakStatus: 'Perlu Pendampingan Orang Tua',
                    teks: 'Masih perlu bimbingan dan dorongan dalam menyelesaikan tugas individu secara tepat waktu. Diharapkan bimbingan dari orang tua di rumah.',
                    deskripsi: 'Masih perlu bimbingan dan dorongan dalam menyelesaikan tugas individu secara tepat waktu. Diharapkan bimbingan dari orang tua di rumah.',
                    warna: {
                        garis: 'border-l-amber-400', ikon: 'bg-amber-50 text-amber-500',
                        lencana: 'border-amber-200 bg-amber-50 text-amber-700', titik: 'bg-amber-500',
                        kotak: 'border-amber-100 bg-amber-50/60', status: 'bg-amber-50 text-amber-700',
                    },
                    svg: '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>',
                },
            ],

            bukaCetak() {
                this.dicetak = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                this.view = 'cetak';
                window.scrollTo(0, 0);
            },
            tutupCetak() { this.view = 'jurnal'; window.scrollTo(0, 0); },
        }));
    });
</script>
@endpush
