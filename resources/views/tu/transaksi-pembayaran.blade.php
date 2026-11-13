@extends('layouts.tu')

@php($tuName = \Illuminate\Support\Facades\Auth::user()?->name ?? '-')

@section('title', 'Manajemen Transaksi | SIAKAD Panel')
@section('page_title', 'Manajemen Transaksi')
@section('page_data', 'kasirPage()')
@section('year_label', 'Tahun Ajaran ' . ($tahunAjaran ?? '-'))
@section('profile_badge_class', 'flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-xs font-medium text-white')
@section('profile_name_class', 'text-sm text-slate-900')
@section('profile_role_class', 'text-[11px] text-slate-500')

@section('page_title_prefix')
    <span class="h-5 w-1 rounded-full bg-brand"></span>
@endsection

@section('shell_visibility')
view === 'kasir'
@endsection
@section('shell_class', 'no-print')

@section('content')
<main class="flex-1 px-4 py-8 sm:px-8">

            {{-- Judul halaman --}}
            <div>
                <h1 class="text-2xl tracking-tight text-slate-900">Kasir &amp; Penerimaan Pembayaran</h1>
                <p class="mt-2 text-sm text-slate-500">Input pembayaran SPP, setoran tabungan MI, dan biaya administrasi lainnya secara langsung.</p>
            </div>
            {{-- {{ route('pembayaran.store') }} --}}
            {{-- ============ KARTU INPUT PEMBAYARAN BARU ============ --}}
            <form action="#" method="POST" @submit.prevent="simpan()"
                  class="mt-8 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                @csrf

                <div class="flex items-center justify-between border-b border-slate-100 pb-5">
                    <div class="flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg border border-red-100 bg-red-50 text-brand">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        </span>
                        <div>
                            <h3 class="text-base text-slate-900">Input Pembayaran Baru</h3>
                            <p class="mt-0.5 text-xs text-slate-500">Lengkapi formulir transaksi kasir di bawah ini</p>
                        </div>
                    </div>
                    <span class="hidden rounded border border-slate-100 bg-slate-50 px-3 py-1 text-[11px] text-slate-400 sm:inline-block">Loket Kasir #01</span>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-3">

                    {{-- Cari siswa (combobox) --}}
                    <div class="relative" @click.outside="cbOpen = false">
                        <label for="cari_siswa" class="mb-2 block text-[11px] uppercase tracking-wider text-slate-600">Cari Siswa <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input id="cari_siswa" type="text" x-model="cari" autocomplete="off"
                                   @focus="cbOpen = true" @input="siswa = null; cbOpen = true; errSiswa = false"
                                   placeholder="Pilih Siswa / Cari NIS..."
                                   class="block w-full rounded-lg border bg-white py-3 pl-4 pr-10 text-sm text-slate-800 placeholder-slate-800 transition focus:outline-none focus:ring-2"
                                   :class="errSiswa ? 'border-red-300 focus:border-red-400 focus:ring-red-200' : 'border-slate-300 focus:border-brand focus:ring-brand/20'">
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                            </span>
                        </div>
                        <ul x-cloak x-show="cbOpen" x-transition
                            class="absolute z-20 mt-1 max-h-56 w-full overflow-auto rounded-lg border border-slate-200 bg-white py-1 text-sm shadow-lg">
                            <template x-for="s in hasilCari" :key="s.nis">
                                <li>
                                    <button type="button" @click="pilihSiswa(s)"
                                            class="flex w-full items-center justify-between px-4 py-2 text-left transition hover:bg-slate-50">
                                        <span x-text="s.nama"></span>
                                        <span class="text-[11px] text-slate-400" x-text="s.nis"></span>
                                    </button>
                                </li>
                            </template>
                            <li x-show="hasilCari.length === 0" class="px-4 py-3 text-xs text-slate-400">Siswa tidak ditemukan.</li>
                        </ul>
                        <p x-cloak x-show="errSiswa" class="mt-1.5 text-[11px] text-red-600">Pilih siswa terlebih dahulu.</p>
                    </div>

                    {{-- Jenis pembayaran --}}
                    <div>
                        <label for="jenis" class="mb-2 block text-[11px] uppercase tracking-wider text-slate-600">Jenis Pembayaran <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="jenis" name="jenis" x-model="jenis" required
                                    class="block w-full appearance-none rounded-lg border border-slate-300 bg-white py-3 pl-4 pr-10 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                                <template x-for="j in daftarJenis" :key="j"><option :value="j" x-text="j"></option></template>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                            </span>
                        </div>
                    </div>

                    {{-- Nominal --}}
                    <div>
                        <label for="nominal" class="mb-2 block text-[11px] uppercase tracking-wider text-slate-600">Nominal (Rp) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-sm text-slate-400">Rp</span>
                            <input id="nominal" name="nominal" type="number" min="1000" step="500" x-model="nominal" required
                                   placeholder="Contoh: 250000"
                                   class="block w-full rounded-lg border border-slate-200 bg-slate-50/60 py-3 pl-12 pr-4 text-sm text-slate-800 placeholder-slate-400 transition [appearance:textfield] focus:border-brand focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand/20 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <label for="ket" class="mb-2 block text-[11px] uppercase tracking-wider text-slate-600">Keterangan / Catatan</label>
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center">
                        <input id="ket" name="ket" type="text" x-model="ket"
                               placeholder="Contoh: SPP Bulan Oktober 2026, pembayaran lunas di loket..."
                               class="block w-full flex-1 rounded-lg border border-slate-200 bg-slate-50/60 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand/20">
                        <button type="submit"
                                class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg bg-brand px-6 py-2.5 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/></svg>
                            Simpan &amp; Cetak Kwitansi
                        </button>
                    </div>
                </div>
            </form>

            {{-- ============ KARTU RIWAYAT TRANSAKSI ============ --}}
            <section class="mt-8 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="flex flex-col gap-4 border-b border-slate-100 px-6 py-5 md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg border border-amber-100 bg-amber-50 text-amber-500">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <div>
                            <h3 class="text-base text-slate-900">Riwayat Transaksi Terakhir</h3>
                            <p class="mt-0.5 text-xs text-slate-500">Log mutasi kasir yang baru saja tercatat di sistem</p>
                        </div>
                    </div>

                    <div class="relative w-full md:w-72">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                        </span>
                        <input type="text" x-model="cariTrx" placeholder="Cari kode referensi atau nama..."
                               class="block w-full rounded-lg border border-slate-200 bg-slate-50/60 py-2.5 pl-10 pr-3 text-xs text-slate-800 placeholder-slate-400 transition focus:border-brand focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand/20">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[900px] text-left">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/70 text-[11px] uppercase tracking-wider text-slate-500">
                                <th class="py-4 pl-6 pr-4 font-normal lg:pl-[88px]">Tanggal / Waktu</th>
                                <th class="px-4 py-4 font-normal">Kode Ref</th>
                                <th class="px-4 py-4 font-normal">Nama Siswa</th>
                                <th class="px-4 py-4 font-normal">Jenis Transaksi</th>
                                <th class="px-4 py-4 text-right font-normal">Nominal</th>
                                <th class="px-4 py-4 text-center font-normal">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                            <template x-for="t in riwayat" :key="t.ref">
                                <tr class="transition hover:bg-slate-50/60">
                                    <td class="py-4 pl-6 pr-4 lg:pl-[88px]">
                                        <p class="text-slate-800" x-text="t.label"></p>
                                        <p class="mt-0.5 text-xs text-slate-400" x-text="t.waktu"></p>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex rounded border border-slate-200 bg-slate-100 px-2.5 py-1 text-xs text-slate-600" x-text="t.ref"></span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <p class="text-slate-900" x-text="t.nama"></p>
                                        <span class="mt-1 inline-flex rounded border px-2 py-0.5 text-[11px]"
                                              :class="t.unit === 'SMK Nusantara' ? 'border-blue-200 bg-blue-50 text-blue-700' : 'border-emerald-200 bg-emerald-50 text-emerald-700'"
                                              x-text="t.unit"></span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <p class="text-slate-800" x-text="t.jenis"></p>
                                        <p class="mt-0.5 text-xs" :class="t.nada === 'hijau' ? 'text-emerald-600' : 'text-amber-600'">
                                            <span x-show="t.nada === 'hijau'">&#10003; </span><span x-text="t.detail"></span>
                                        </p>
                                    </td>
                                    <td class="px-4 py-4 text-right text-base text-slate-900" x-text="'Rp ' + rp(t.nominal)"></td>
                                    <td class="px-4 py-4 text-center">
                                        <button type="button" @click="bukaKwitansi(t)"
                                                class="inline-flex items-center gap-1.5 text-xs text-amber-600 transition hover:text-amber-700">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/></svg>
                                            Cetak PDF
                                        </button>
                                    </td>
                                </tr>
                            </template>

                            <tr x-cloak x-show="riwayat.length === 0">
                                <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-400">Transaksi tidak ditemukan.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Footer tabel --}}
                <div class="flex flex-col gap-2 border-t border-slate-200 bg-slate-50/50 px-6 py-4 text-xs sm:flex-row sm:items-center sm:justify-between">
                    <p class="flex items-center gap-2 text-slate-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        <span x-text="'Menampilkan ' + riwayat.length + ' transaksi terbaru.'"></span>
                    </p>
                    <a href="#" class="inline-flex items-center gap-1.5 text-brand transition hover:text-brand-dark">
                        Buka Rekapitulasi Lengkap
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                    </a>
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
     TAMPILAN 2 : KWITANSI PEMBAYARAN (FOTO 2)
     ===================================================================== --}}
<div x-cloak x-show="view === 'kwitansi'" class="print-wrap min-h-screen bg-slate-200 px-4 py-8">

    <template x-if="kw">
        <div class="mx-auto w-full max-w-[768px]">

            <div class="print-sheet overflow-hidden rounded-lg bg-white shadow-lg">

                {{-- Bar atas (tidak ikut tercetak) --}}
                <div class="no-print flex flex-col gap-3 border-b-4 border-slate-800 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <button type="button" @click="tutupKwitansi()"
                            class="inline-flex items-center gap-2 text-sm text-slate-600 transition hover:text-slate-900">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                        &lt; Kembali ke Kasir
                    </button>

                    <span class="hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700 sm:inline-flex">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Format Kwitansi A5 Siap Cetak
                    </span>

                    <button type="button" @click="window.print()"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand px-5 py-2.5 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/></svg>
                        Cetak / Unduh PDF
                    </button>
                </div>

                {{-- Isi kwitansi --}}
                <div class="px-6 pb-8 pt-10 sm:px-10">

                    {{-- Kop --}}
                    <div class="relative flex items-center justify-center border-b-2 border-slate-900 pb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo"
                             class="absolute left-0 top-1/2 hidden h-14 w-14 -translate-y-1/2 object-contain sm:block">
                        <div class="text-center sm:px-20">
                            <h2 class="text-lg uppercase tracking-wide text-slate-900">{{ $namaYayasan ?? '-' }}</h2>
                            <p class="mt-1 text-sm uppercase text-slate-900" x-text="kw.unit"></p>
                            <p class="mt-1 text-[11px] text-slate-700">{{ $alamatSekolah ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Judul --}}
                    <h3 class="mt-6 text-center text-xl uppercase tracking-wide text-slate-900 underline underline-offset-4">Kwitansi Pembayaran</h3>

                    {{-- No. referensi & tanggal --}}
                    <div class="mt-6 flex flex-col gap-1 border-b border-slate-200 pb-3 text-sm sm:flex-row sm:items-end sm:justify-between">
                        <p class="text-slate-600">No. Referensi: <span class="ml-1 text-base tracking-wide text-slate-900" x-text="kw.ref"></span></p>
                        <p class="text-slate-600">Tanggal: <span class="ml-1 text-slate-900" x-text="kw.lengkap"></span></p>
                    </div>

                    {{-- Rincian --}}
                    <dl class="mt-5 space-y-4 text-sm text-slate-900">
                        <div class="grid grid-cols-[130px_1fr] items-start gap-2 sm:grid-cols-[200px_1fr]">
                            <dt class="text-slate-600">Telah terima dari</dt>
                            <dd>: <span class="ml-1 text-base" x-text="kw.nama"></span>
                                <span class="ml-1 text-[13px] text-slate-600" x-text="'(NIS: ' + kw.nis + ' — ' + kw.kelas + ', ' + kw.unit + ')'"></span></dd>
                        </div>
                        <div class="grid grid-cols-[130px_1fr] items-center gap-2 sm:grid-cols-[200px_1fr]">
                            <dt class="text-slate-600">Uang sejumlah</dt>
                            <dd class="flex items-center gap-2">:
                                <span class="block flex-1 rounded border border-slate-200 bg-slate-100 px-4 py-2 italic" x-text="'“' + terbilang(kw.nominal) + '”'"></span>
                            </dd>
                        </div>
                        <div class="grid grid-cols-[130px_1fr] items-start gap-2 sm:grid-cols-[200px_1fr]">
                            <dt class="text-slate-600">Untuk pembayaran</dt>
                            <dd>: <span class="ml-1" x-text="kw.untuk"></span>
                                <span class="ml-1 text-[13px] text-slate-600" x-text="kw.untukKet"></span>
                                <span x-show="kw.ket" class="mt-1 block pl-3 text-[13px] italic text-slate-500" x-text="'Catatan: ' + kw.ket"></span></dd>
                        </div>
                    </dl>

                    {{-- Nominal & tanda tangan --}}
                    <div class="mt-8 flex flex-col gap-8 border-t border-slate-100 pt-6 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="text-[11px] uppercase tracking-wider text-slate-500">Jumlah Nominal:</p>
                            <p class="mt-2 inline-block border-4 border-slate-900 bg-white px-6 py-3 text-2xl text-slate-900" x-text="'Rp ' + rp(kw.nominal) + ',-'"></p>
                            <p class="mt-3 text-[11px] text-slate-500">* Pembayaran telah divalidasi <span x-text="kw.status ?? '-'"></span> oleh sistem kasir TU.</p>
                        </div>

                        <div class="text-center text-sm text-slate-900 sm:w-56">
                            <p>Penerima / Staf TU,</p>
                            <div class="mx-auto mt-4 flex h-6 w-44 items-center justify-center border border-dashed border-slate-300 text-[9px] uppercase tracking-widest text-slate-300">[Tanda Tangan / Stempel]</div>
                            <p class="mt-8 underline">( Ibu {{ $tuName ?? '-' }} )</p>
                            <p class="mt-1 text-[11px] text-slate-500">NIP / ID: {{ $tuId ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Footer kwitansi --}}
                    <div class="mt-8 flex flex-col gap-1 border-t border-slate-200 pt-3 text-[10px] text-slate-400 sm:flex-row sm:justify-between">
                        <p>Dokumen Resmi SIAKAD Panel v{{ $versi ?? '-' }} • Bukti sah pembayaran</p>
                        <p x-text="'Dicetak otomatis pada: ' + kw.cetak"></p>
                    </div>
                </div>
            </div>

            {{-- Petunjuk cetak (tidak ikut tercetak) --}}
            <div class="no-print mt-4 flex flex-col gap-2 px-1 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex flex-wrap items-center gap-1.5">
                    <kbd class="rounded border border-slate-300 bg-white px-2 py-0.5 text-[11px] text-slate-600">Ctrl</kbd>
                    <span>+</span>
                    <kbd class="rounded border border-slate-300 bg-white px-2 py-0.5 text-[11px] text-slate-600">P</kbd>
                    <span class="ml-1">untuk mencetak langsung ke kertas fisik atau menyimpan PDF.</span>
                </p>
                <p>Sistem Informasi Akademik Yayasan Nurun 'Alannur</p>
            </div>
        </div>
    </template>
</div>
@endsection

@push('styles')
<style>
@media print {
            @page { size: A5 portrait; margin: 8mm; }
            html, body { background: #fff !important; }
            .no-print { display: none !important; }
            .print-wrap { padding: 0 !important; background: #fff !important; min-height: 0 !important; }
            .print-sheet { box-shadow: none !important; border-radius: 0 !important; max-width: 100% !important; margin: 0 !important; }
        }
</style>
@endpush

@push('scripts')
<script>
    // Terbilang rupiah (Indonesia)
    function terbilang(n) {
        const s = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
        const t = (x) => {
            if (x < 12)  return s[x];
            if (x < 20)  return t(x - 10) + ' belas';
            if (x < 100) return t(Math.floor(x / 10)) + ' puluh' + (x % 10 ? ' ' + t(x % 10) : '');
            if (x < 200) return 'seratus' + (x - 100 ? ' ' + t(x - 100) : '');
            if (x < 1e3) return t(Math.floor(x / 100)) + ' ratus' + (x % 100 ? ' ' + t(x % 100) : '');
            if (x < 2e3) return 'seribu' + (x - 1e3 ? ' ' + t(x - 1e3) : '');
            if (x < 1e6) return t(Math.floor(x / 1e3)) + ' ribu' + (x % 1e3 ? ' ' + t(x % 1e3) : '');
            if (x < 1e9) return t(Math.floor(x / 1e6)) + ' juta' + (x % 1e6 ? ' ' + t(x % 1e6) : '');
            return t(Math.floor(x / 1e9)) + ' miliar' + (x % 1e9 ? ' ' + t(x % 1e9) : '');
        };
        if (!n) return 'Nol Rupiah';
        return (t(n) + ' rupiah').replace(/\b\w/g, c => c.toUpperCase());
    }

    document.addEventListener('alpine:init', () => {
        Alpine.data('kasirPage', () => ({
            sidebar: false,
            view: 'kasir',   // 'kasir' (foto 1) | 'kwitansi' (foto 2)
            kw: null,

            // Form
            cari: '', cbOpen: false, siswa: null, errSiswa: false,
            jenis: 'SPP Bulanan', nominal: '', ket: '',
            cariTrx: '',

            daftarJenis: @json($jenisPembayaranOptions ?? []),

            daftarSiswa: @json($siswaOptions ?? []),

            transaksi: @json($riwayatTransaksi ?? []),

            get hasilCari() {
                const q = this.cari.toLowerCase().trim();
                return this.daftarSiswa.filter(s => !q || s.nama.toLowerCase().includes(q) || s.nis.includes(q));
            },

            get riwayat() {
                const q = this.cariTrx.toLowerCase().trim();
                return this.transaksi.filter(t =>
                    !q || t.ref.toLowerCase().includes(q) || t.nama.toLowerCase().includes(q) ||
                    t.jenis.toLowerCase().includes(q) || t.nis.includes(q));
            },

            rp(n) { return Number(n).toLocaleString('id-ID'); },
            terbilang(n) { return terbilang(n); },

            pilihSiswa(s) {
                this.siswa = s;
                this.cari = s.nama + ' — ' + s.nis;
                this.cbOpen = false;
                this.errSiswa = false;
            },

            simpan() {
                if (!this.siswa) { this.errSiswa = true; return; }

                const sekarang = new Date();
                const bulan = sekarang.toLocaleDateString('id-ID', { month: 'long' });
                const tahun = sekarang.getFullYear();
                const pad = (x) => String(x).padStart(2, '0');
                const jam = pad(sekarang.getHours()) + ':' + pad(sekarang.getMinutes());
                const tgl = sekarang.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                const tglPendek = pad(sekarang.getDate()) + '/' + pad(sekarang.getMonth() + 1) + '/' + tahun;
                const ta = ' - Tahun Ajaran ' + @json($tahunAjaran ?? '-') + ')';

                let jenis, detail, untuk;
                if (this.jenis === 'SPP Bulanan')      { jenis = 'SPP Bulan ' + bulan; detail = 'Pembayaran Reguler'; untuk = jenis + ' ' + tahun; }
                else if (this.jenis === 'Setor Tabungan') { jenis = 'Setor Tabungan'; detail = 'Buku Tabungan MI #' + this.siswa.nis.slice(-4); untuk = jenis; }
                else if (this.jenis === 'Seragam Olahraga') { jenis = 'Seragam Olahraga'; detail = 'Pembayaran Lunas'; untuk = jenis; }
                else                                    { jenis = 'Uang Kegiatan'; detail = 'Pembayaran Reguler'; untuk = jenis; }

                const angka = this.transaksi.map(t => parseInt(t.ref.replace('TRX-', ''), 10));
                const baru = {
                    ref: 'TRX-' + pad(Math.max(...angka) + 1).padStart(3, '0'),
                    label: 'Hari ini', waktu: jam + ' WIB',
                    lengkap: tgl + ', ' + jam + ' WIB', cetak: tglPendek + ' ' + jam + ' WIB',
                    nis: this.siswa.nis, nama: this.siswa.nama, kelas: this.siswa.kelas, unit: this.siswa.unit,
                    jenis, detail, nada: 'hijau',
                    untuk, untukKet: '(' + detail + ta, ket: this.ket.trim(),
                    nominal: parseInt(this.nominal, 10),
                };

                this.transaksi.unshift(baru);
                this.bukaKwitansi(baru);

                // reset form
                this.siswa = null; this.cari = ''; this.jenis = 'SPP Bulanan'; this.nominal = ''; this.ket = '';
            },

            bukaKwitansi(t)  { this.kw = t; this.view = 'kwitansi'; window.scrollTo(0, 0); },
            tutupKwitansi()  { this.view = 'kasir'; window.scrollTo(0, 0); },
        }));
    });
</script>
@endpush
