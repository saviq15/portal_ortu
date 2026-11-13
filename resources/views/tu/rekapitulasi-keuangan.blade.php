@extends('layouts.tu')

@php($tuName = \Illuminate\Support\Facades\Auth::user()?->name ?? '-')

@section('title', 'Laporan Keuangan | SIAKAD Panel')
@section('page_title', 'Laporan Keuangan')
@section('page_data', 'rekapPage()')
@section('year_label', 'Tahun Ajaran ' . ($tahunAjaran ?? '-'))
@section('profile_badge_class', 'flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-xs font-medium text-white')
@section('profile_name_class', 'text-sm text-slate-900')
@section('profile_role_class', 'text-[11px] text-slate-500')

@section('page_title_prefix')
    <span class="h-5 w-1 rounded-full bg-brand"></span>
@endsection

@section('shell_visibility')
view === 'laporan'
@endsection
@section('shell_class', 'no-print')

@section('content')
<main class="flex-1 px-4 py-8 sm:px-8">

            {{-- Judul halaman --}}
            <div>
                <h1 class="text-2xl tracking-tight text-slate-900">Rekapitulasi Pemasukan &amp; Piutang</h1>
                <p class="mt-2 text-sm text-slate-500">Laporan detail transaksi SPP, tabungan, dan tunggakan per periode.</p>
            </div>

            {{-- ============ BAR FILTER ============ --}}
            <div class="mt-8 flex flex-col gap-4 rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-200 xl:flex-row xl:items-center xl:justify-between">
                <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap">

                    {{-- Bulan --}}
                    <div class="relative w-full sm:w-52">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        </span>
                        <select x-model="bulan" aria-label="Pilih bulan"
                                class="block w-full appearance-none rounded-lg border border-slate-200 bg-slate-50/60 py-2.5 pl-10 pr-9 text-sm text-slate-800 transition focus:border-brand focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <template x-for="b in daftarBulan" :key="b"><option :value="b" x-text="'Bulan ' + b"></option></template>
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </span>
                    </div>

                    {{-- Unit --}}
                    <div class="relative w-full sm:w-56">
                        <select x-model="unit" aria-label="Pilih unit"
                                class="block w-full appearance-none rounded-lg border border-slate-200 bg-slate-50/60 py-2.5 pl-4 pr-9 text-sm text-slate-800 transition focus:border-brand focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <option value="">Semua Unit (MI &amp; SMK)</option>
                            @foreach(($unitOptions ?? []) as $unitOption)
                                <option value="{{ $unitOption }}">{{ $unitOption }}</option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </span>
                    </div>

                    {{-- Jenis transaksi --}}
                    <div class="relative w-full sm:w-56">
                        <select x-model="jenis" aria-label="Pilih jenis transaksi"
                                class="block w-full appearance-none rounded-lg border border-slate-200 bg-slate-50/60 py-2.5 pl-4 pr-9 text-sm text-slate-800 transition focus:border-brand focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <option value="">Semua Jenis Transaksi</option>
                            @foreach(($jenisTransaksiOptions ?? []) as $jenisOption)
                                <option value="{{ $jenisOption }}">{{ $jenisOption }}</option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </span>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <button type="button" @click="unduhExcel()"
                            class="inline-flex items-center justify-center gap-2 rounded-lg border border-emerald-600 bg-white px-5 py-2.5 text-sm text-emerald-700 transition hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        Unduh Excel
                    </button>
                    <button type="button" @click="bukaCetak()"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-5 py-2.5 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/></svg>
                        Cetak PDF
                    </button>
                </div>
            </div>

            {{-- ============ KARTU RINGKASAN ============ --}}
            <section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">

                {{-- Total pemasukan --}}
                <div class="flex items-center justify-between rounded-xl bg-white px-7 py-6 shadow-sm ring-1 ring-slate-200">
                    <div>
                        <p class="text-sm text-slate-600">Total Pemasukan Bulan Ini</p>
                        <p class="mt-1 text-[32px] leading-tight text-slate-900" x-text="'Rp ' + rp(ringkasan.pemasukan)"></p>
                        <p class="mt-1 text-[11px] text-slate-400">Akumulasi seluruh unit &amp; loket</p>
                    </div>
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-emerald-100 bg-emerald-50 text-emerald-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>
                    </span>
                </div>

                {{-- Total piutang --}}
                <div class="flex items-center justify-between rounded-xl border-2 border-red-500 bg-white px-7 py-6 shadow-sm">
                    <div>
                        <p class="text-sm text-slate-600">Total Piutang / Tunggakan SPP</p>
                        <p class="mt-1 text-[32px] leading-tight text-red-500" x-text="'Rp ' + rp(ringkasan.piutang)"></p>
                        <p class="mt-1 text-[11px] text-slate-400" x-text="ringkasan.siswa + ' siswa belum melunasi kewajiban'"></p>
                    </div>
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-red-100 bg-red-50 text-red-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                    </span>
                </div>
            </section>

            {{-- ============ TABEL REKAP ============ --}}
            <section class="mt-8 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[860px] text-left">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/70 text-[11px] uppercase tracking-wider text-slate-500">
                                <th class="py-4 pl-6 pr-4 font-normal lg:pl-[88px]">Tanggal</th>
                                <th class="px-4 py-4 font-normal">Uraian</th>
                                <th class="px-4 py-4 font-normal">Unit</th>
                                <th class="px-4 py-4 font-normal">Pemasukan (Rp)</th>
                                <th class="px-4 py-4 text-center font-normal">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                            <template x-for="r in baris" :key="r.tgl + r.uraian">
                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-[18px] pl-6 pr-4 lg:pl-[88px]" x-text="r.tgl"></td>
                                    <td class="px-4 py-[18px]" x-text="r.uraian"></td>
                                    <td class="px-4 py-[18px]">
                                        <span class="inline-flex rounded border px-2.5 py-1 text-xs"
                                              :class="r.unit === 'SMK Nusantara' ? 'border-blue-200 bg-blue-50 text-blue-700' : 'border-emerald-200 bg-emerald-50 text-emerald-700'"
                                              x-text="r.unit"></span>
                                    </td>
                                    <td class="px-4 py-[18px]" x-text="rp(r.nominal)"></td>
                                    <td class="px-4 py-[18px] text-center">
                                        <span class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-xs"
                                              :class="r.status === 'Tercatat' ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-slate-200 bg-slate-50 text-slate-600'">
                                            <span class="h-1.5 w-1.5 rounded-full" :class="r.status === 'Tercatat' ? 'bg-emerald-500' : 'bg-slate-400'"></span><span x-text="r.status ?? '-'"></span>
                                        </span>
                                    </td>
                                </tr>
                            </template>

                            <tr x-cloak x-show="baris.length === 0">
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400">Tidak ada transaksi pada filter yang dipilih.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Footer tabel --}}
                <div class="flex flex-col gap-2 border-t border-slate-200 bg-slate-50/50 px-4 py-4 text-sm text-slate-600 sm:flex-row sm:items-center sm:justify-between sm:px-4">
                    <p x-text="'Total baris: ' + baris.length + ' | Menampilkan laporan bulan ' + bulanSaja + '.'"></p>
                    <p class="text-slate-800" x-text="'Total Terakumulasi: Rp ' + rp(total)"></p>
                </div>
            </section>

            {{-- Info bar --}}
            <div class="mt-8 flex flex-col gap-2 border-t border-slate-200 pt-5 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Sistem Pembayaran &amp; Rekapitulasi Keuangan terintegrasi {{ $namaYayasan ?? '-' }}.
                </p>
                <span class="text-slate-400">SIAKAD v{{ $versi ?? '-' }}</span>
            </div>
        </main>
@endsection

@section('outside_content')
{{-- =====================================================================
     TAMPILAN 2 : PRATINJAU CETAK A4 (FOTO 2)
     ===================================================================== --}}
<div x-cloak x-show="view === 'cetak'" class="print-wrap min-h-screen bg-slate-200 px-4 py-8">

    <div class="mx-auto w-full max-w-[896px]">

        <div class="print-sheet overflow-hidden rounded-lg bg-white shadow-lg">

            {{-- Bar atas (tidak ikut tercetak) --}}
            <div class="no-print flex flex-col gap-3 border-b-4 border-slate-800 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" @click="tutupCetak()"
                            class="inline-flex items-center gap-2 text-sm text-slate-600 transition hover:text-slate-900">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                        &lt; Kembali ke Laporan
                    </button>
                    <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-[11px] text-slate-600">Mode Pratinjau Cetak (A4 Potret)</span>
                </div>

                <button type="button" @click="window.print()"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-5 py-2.5 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/></svg>
                    Cetak Dokumen PDF
                </button>
            </div>

            {{-- Isi dokumen --}}
            <div class="px-6 pb-10 pt-12 sm:px-12">

                {{-- Kop --}}
                <div class="flex items-center gap-4 border-b-4 border-slate-900 pb-5">
                    <div class="flex h-20 w-20 shrink-0 flex-col items-center justify-center gap-1 border-2 border-slate-900 text-slate-900">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                        <span class="text-[8px] uppercase tracking-wider">Yayasan</span>
                    </div>
                    <div class="flex-1 text-center sm:pr-20">
                        <h2 class="text-xl uppercase tracking-wide text-slate-900">{{ $namaYayasan ?? '-' }}</h2>
                        <p class="mt-1 text-base uppercase text-slate-900">{{ $namaSekolah ?? '-' }}</p>
                        <p class="mt-1 text-[11px] text-slate-700">{{ $alamatSekolah ?? '-' }}</p>
                    </div>
                </div>

                {{-- Judul --}}
                <h3 class="mt-6 text-center text-lg uppercase tracking-wide text-slate-900 underline underline-offset-4">Laporan Rekapitulasi Pemasukan &amp; Piutang</h3>

                <div class="mt-5 space-y-1.5 text-sm text-slate-900">
                    <p>Periode : Bulan <span x-text="bulan"></span></p>
                    <p>Dicetak pada : <span x-text="dicetak.panjang"></span></p>
                </div>

                {{-- Dua kotak ringkasan --}}
                <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="border border-slate-900 px-4 py-5 text-center">
                        <p class="text-sm uppercase tracking-wide text-slate-900">Total Pemasukan</p>
                        <p class="mt-2 text-2xl text-slate-900" x-text="'Rp ' + rp(ringkasan.pemasukan)"></p>
                        <p class="mt-2 text-[11px] text-slate-700">Akumulasi seluruh unit &amp; loket kasir</p>
                    </div>
                    <div class="border border-slate-900 px-4 py-5 text-center">
                        <p class="text-sm uppercase tracking-wide text-slate-900">Total Piutang / Tunggakan</p>
                        <p class="mt-2 text-2xl text-slate-900" x-text="'Rp ' + rp(ringkasan.piutang)"></p>
                        <p class="mt-2 text-[11px] text-slate-700" x-text="ringkasan.siswa + ' siswa belum melunasi kewajiban'"></p>
                    </div>
                </div>

                {{-- Tabel dokumen --}}
                <div class="mt-6 overflow-x-auto">
                    <table class="w-full min-w-[640px] border-collapse border-2 border-slate-900 text-sm text-slate-900">
                        <thead>
                            <tr class="bg-slate-100 text-xs uppercase tracking-wide">
                                <th class="border-2 border-slate-900 px-3 py-2.5 font-normal">Tanggal</th>
                                <th class="border-2 border-slate-900 px-3 py-2.5 text-left font-normal">Uraian</th>
                                <th class="border-2 border-slate-900 px-3 py-2.5 font-normal">Unit</th>
                                <th class="border-2 border-slate-900 px-3 py-2.5 text-right font-normal">Pemasukan (Rp)</th>
                                <th class="border-2 border-slate-900 px-3 py-2.5 font-normal">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="r in baris" :key="'p' + r.tgl + r.uraian">
                                <tr>
                                    <td class="border-2 border-slate-900 px-3 py-3 text-center" x-text="r.tgl"></td>
                                    <td class="border-2 border-slate-900 px-3 py-3" x-text="r.uraian"></td>
                                    <td class="border-2 border-slate-900 px-3 py-3 text-center" x-text="r.unit"></td>
                                    <td class="border-2 border-slate-900 px-3 py-3 text-right" x-text="rp(r.nominal)"></td>
                                    <td class="border-2 border-slate-900 px-3 py-3 text-center" x-text="r.status ?? '-'"></td>
                                </tr>
                            </template>
                            <tr x-cloak x-show="baris.length === 0">
                                <td colspan="5" class="border-2 border-slate-900 px-3 py-6 text-center text-slate-500">Tidak ada transaksi pada filter yang dipilih.</td>
                            </tr>
                            <tr class="bg-slate-50">
                                <td colspan="3" class="border-2 border-slate-900 px-3 py-3 text-right text-xs uppercase tracking-wide">Total Terakumulasi:</td>
                                <td class="border-2 border-slate-900 px-3 py-3 text-right text-base" x-text="'Rp ' + rp(total)"></td>
                                <td class="border-2 border-slate-900 px-2 py-3 text-center text-xs">Sesuai Rekap</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p class="mt-4 text-[11px] text-slate-600">* Catatan: {{ $catatanValidasiLaporan ?? 'Data transaksi di atas telah divalidasi oleh sistem perbendaharaan yayasan dan telah terverifikasi secara berjenjang.' }}</p>

                {{-- Tanda tangan --}}
                <div class="mt-14 grid grid-cols-1 gap-10 text-center text-sm text-slate-900 sm:grid-cols-2">
                    <div>
                        <p>Mengetahui,</p>
                        <p class="mt-3">Kepala Bagian Keuangan</p>
                        <div class="h-24"></div>
                        <p class="underline">( {{ $namaKepalaKeuangan ?? '-' }} )</p>
                        <p class="mt-1 text-[11px] text-slate-600">NIP: {{ $nipKepalaKeuangan ?? '-' }}</p>
                    </div>
                    <div>
                        <p x-text="'{{ $lokasiSekolah ?? '-' }}, ' + dicetak.tanggal"></p>
                        <p class="mt-3">Staf Tata Usaha</p>
                        <div class="mx-auto mt-5 flex h-8 w-28 items-center justify-center border border-dashed border-slate-400 text-[10px] text-slate-500">[ Stempel / TTD ]</div>
                        <div class="h-7"></div>
                        <p class="underline">( Ibu {{ $tuName ?? '-' }} )</p>
                        <p class="mt-1 text-[11px] text-slate-600">ID TU: {{ $tuId ?? '-' }}</p>
                    </div>
                </div>

                {{-- Footer dokumen --}}
                <div class="mt-12 flex flex-col gap-1 border-t border-slate-300 pt-3 text-[10px] text-slate-500 sm:flex-row sm:justify-between">
                    <p>Dokumen Resmi SIAKAD Panel v{{ $versi ?? '-' }} — Rekapitulasi Keuangan {{ $namaYayasan ?? '-' }}</p>
                    <p x-text="'Dicetak otomatis pada: ' + dicetak.pendek"></p>
                </div>
            </div>
        </div>

        {{-- Petunjuk (tidak ikut tercetak) --}}
        <div class="no-print mt-4 grid grid-cols-1 gap-3 px-1 text-xs text-slate-500 sm:grid-cols-2">
            <p>Tekan tombol Cetak Dokumen PDF atau pintasan Ctrl + P untuk menyimpan dalam bentuk PDF fisik.</p>
            <p>Sistem Informasi Akademik &amp; Keuangan — {{ $namaYayasan ?? '-' }}</p>
        </div>
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
        }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('rekapPage', () => ({
            sidebar: false,
            view: 'laporan',   // 'laporan' (foto 1) | 'cetak' (foto 2)

            // Filter
            bulan: @json($bulanTerpilih ?? ''),
            unit: '',
            jenis: '',
            daftarBulan: @json($bulanOptions ?? []),

            dicetak: { panjang: '', tanggal: '', pendek: '' },

            ringkasanBulan: @json($ringkasanKeuangan ?? []),

            data: @json($transaksiKeuangan ?? []),

            get baris() {
                return this.data.filter(r =>
                    r.bulan === this.bulan &&
                    (!this.unit  || r.unit  === this.unit) &&
                    (!this.jenis || r.jenis === this.jenis));
            },

            get total()      { return this.baris.reduce((a, r) => a + r.nominal, 0); },
            get ringkasan()  { return this.ringkasanBulan[this.bulan] || { pemasukan: 0, piutang: 0, siswa: 0 }; },
            get bulanSaja()  { return this.bulan.split(' ')[0]; },

            rp(n) { return Number(n).toLocaleString('id-ID'); },

            bukaCetak() {
                const d = new Date();
                const pad = (x) => String(x).padStart(2, '0');
                const tanggal = d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                const jam = pad(d.getHours()) + ':' + pad(d.getMinutes()) + ' WIB';
                this.dicetak = {
                    tanggal,
                    panjang: tanggal + ', ' + jam,
                    pendek: pad(d.getDate()) + '/' + pad(d.getMonth() + 1) + '/' + d.getFullYear() + ' ' + jam,
                };
                this.view = 'cetak';
                window.scrollTo(0, 0);
            },
            tutupCetak() { this.view = 'laporan'; window.scrollTo(0, 0); },

            // Unduh file CSV (bisa dibuka di Excel), tanpa backend
            unduhExcel() {
                const esc = (s) => '"' + String(s).replace(/"/g, '""') + '"';
                const baris = [
                    ['Tanggal', 'Uraian', 'Unit', 'Pemasukan (Rp)', 'Status'].map(esc).join(';'),
                    ...this.baris.map(r => [r.tgl, r.uraian, r.unit, r.nominal, r.status].map(esc).join(';')),
                    ['', '', 'Total Terakumulasi', this.total, ''].map(esc).join(';'),
                ];
                const blob = new Blob(['\uFEFF' + baris.join('\r\n')], { type: 'text/csv;charset=utf-8;' });
                const a = document.createElement('a');
                a.href = URL.createObjectURL(blob);
                a.download = 'rekap-keuangan-' + this.bulan.toLowerCase().replace(' ', '-') + '.csv';
                document.body.appendChild(a);
                a.click();
                a.remove();
                URL.revokeObjectURL(a.href);
            },
        }));
    });
</script>
@endpush
