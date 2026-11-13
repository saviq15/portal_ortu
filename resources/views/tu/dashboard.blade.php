@extends('layouts.tu')

@php
    $tuName = \Illuminate\Support\Facades\Auth::user()?->name ?? '-';
@endphp

@section('title', 'Dashboard Keuangan | SIAKAD Panel')
@section('page_title', 'Dashboard Keuangan')
@section('page_data', '{ sidebar: false }')
@section('year_label', 'Tahun Ajaran ' . ($tahunAjaran ?? '-'))
@section('profile_badge_class', 'flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-xs font-medium text-slate-700 ring-1 ring-slate-200')
@section('profile_name_class', 'text-xs text-slate-900')
@section('profile_role_class', 'text-[10px] text-slate-500')

@section('content')
<main class="flex-1 px-4 py-8 sm:px-8">

            {{-- Judul halaman --}}
            <div>
                <h1 class="text-2xl tracking-tight text-slate-900">Selamat Datang, Ibu {{ $tuName ?? '-' }}!</h1>
                <p class="mt-2 text-sm text-slate-500">Ringkasan transaksi SPP SMK dan Tabungan MI hari ini.</p>
            </div>

            {{-- Kartu ringkasan --}}
            <section class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-3">

                {{-- Pemasukan hari ini --}}
                <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between">
                        <p class="text-[11px] uppercase tracking-wider text-slate-500">Pemasukan Hari Ini</p>
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50 text-brand">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                    </div>
                    <p class="mt-4 text-[28px] leading-none text-brand">Rp {{ number_format($pemasukanHariIni ?? 0, 0, ',', '.') }}</p>
                    <p class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        Dari {{ $jumlahTransaksiHariIni ?? 0 }} transaksi
                    </p>
                </div>

                {{-- Tagihan SPP tertunggak --}}
                <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between">
                        <p class="text-[11px] uppercase tracking-wider text-slate-500">Tagihan SPP Tertunggak</p>
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                        </span>
                    </div>
                    <p class="mt-4 text-[28px] leading-none text-red-600">{{ $jumlahSiswaTertunggak ?? 0 }} Siswa</p>
                    <p class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                        {{ $namaSekolah ?? '-' }}
                    </p>
                </div>

                {{-- Total saldo tabungan MI --}}
                <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between">
                        <p class="text-[11px] uppercase tracking-wider text-slate-500">Total Saldo Tabungan MI</p>
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                        </span>
                    </div>
                    <p class="mt-4 text-[28px] leading-none text-emerald-600">Rp {{ number_format($saldoTabunganMi ?? 0, 0, ',', '.') }}</p>
                    <p class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        Akumulasi bulan ini
                    </p>
                </div>
            </section>

            {{-- Transaksi terakhir --}}
            <section class="mt-8">
                <div class="mb-4 flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                    <h3 class="text-lg text-slate-900">Transaksi Terakhir (Hari Ini)</h3>
                    <p class="text-xs text-slate-500">Terakhir diperbarui: {{ $waktuPembaruanTransaksi ?? '-' }}</p>
                </div>

                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[900px] text-left">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50/60 text-[11px] uppercase tracking-wider text-slate-500">
                                    <th class="py-4 pl-6 pr-4 font-normal lg:pl-[88px]">Waktu</th>
                                    <th class="px-4 py-4 font-normal">Kode Ref</th>
                                    <th class="px-4 py-4 font-normal">Nama Siswa</th>
                                    <th class="px-4 py-4 font-normal">Unit</th>
                                    <th class="px-4 py-4 font-normal">Jenis Transaksi</th>
                                    <th class="px-4 py-4 font-normal">Nominal</th>
                                    <th class="px-4 py-4 text-center font-normal">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                                @if(count($transaksiHariIni ?? []) > 0)
                                @foreach($transaksiHariIni as $transaksi)
                                    @php
                                        $statusTransaksi = $transaksi->status ?? '';
                                        $statusSukses = in_array($statusTransaksi, ['Lunas', 'Sukses'], true);
                                    @endphp
                                    <tr class="transition hover:bg-slate-50/60">
                                        <td class="py-5 pl-6 pr-4 text-slate-700 lg:pl-[88px]">{{ $transaksi->waktu ?? '-' }}</td>
                                        <td class="px-4 py-5 text-xs text-slate-500">{{ $transaksi->kodeReferensi ?? '-' }}</td>
                                        <td class="px-4 py-5">
                                            <p class="text-slate-900">{{ $transaksi->namaSiswa ?? '-' }}</p>
                                            <p class="mt-0.5 text-[11px] text-slate-400">NIS: {{ $transaksi->nis ?? '-' }}</p>
                                        </td>
                                        <td class="px-4 py-5">
                                            <span class="inline-flex rounded border px-2.5 py-1 text-xs {{ ($transaksi->unit ?? '') === 'MI Internasional' ? 'border-blue-200 bg-blue-50 text-blue-700' : 'border-slate-200 bg-slate-100 text-slate-600' }}">{{ $transaksi->unit ?? '-' }}</span>
                                        </td>
                                        <td class="px-4 py-5 text-slate-700">{{ $transaksi->jenis ?? '-' }}</td>
                                        <td class="px-4 py-5 text-slate-900">Rp {{ number_format($transaksi->nominal ?? 0, 0, ',', '.') }}</td>
                                        <td class="px-4 py-5 text-center">
                                            <span class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-xs {{ $statusSukses ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : ($statusTransaksi === 'Cicilan' ? 'border-amber-200 bg-amber-50 text-amber-700' : 'border-slate-200 bg-slate-100 text-slate-600') }}">
                                                <span class="h-1.5 w-1.5 rounded-full {{ $statusSukses ? 'bg-emerald-500' : ($statusTransaksi === 'Cicilan' ? 'bg-amber-500' : 'bg-slate-400') }}"></span>{{ $transaksi->status ?? '-' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center text-sm text-slate-400">Belum ada transaksi hari ini.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- route('transaksi.index') --}}
                    {{-- Footer tabel --}}
                    <div class="flex flex-col gap-2 border-t border-slate-200 px-6 py-4 text-xs sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-slate-500">Menampilkan {{ $jumlahTransaksiTerbaru ?? 0 }} transaksi terbaru hari ini</p>
                        <a href="#" class="inline-flex items-center gap-1.5 text-brand transition hover:text-brand-dark">
                            Lihat Semua Transaksi
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </a>
                    </div>
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
