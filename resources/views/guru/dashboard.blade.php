@extends('layouts.guru')

@section('title', 'Dashboard Guru | SIAKAD Panel')
@section('page_title', 'Dashboard Guru')
@section('page_data', '{ sidebar: false }')

@section('content')
        <main class="flex-1 space-y-6 px-4 py-8 sm:px-8">

            {{-- Kartu selamat datang --}}
            <section class="rounded-xl bg-white px-6 py-6 shadow-sm ring-1 ring-slate-200">
                <h1 class="text-2xl tracking-tight text-slate-800">Selamat Datang, Bapak {{ $guruName ?? '-' }}!</h1>
                <p class="mt-1.5 text-sm text-slate-500">Berikut adalah ringkasan aktivitas akademik dan jadwal mengajar Anda hari ini.</p>
            </section>

            {{-- Kartu ringkasan --}}
            <section class="grid grid-cols-1 gap-6 md:grid-cols-3">

                {{-- Total Kelas Diajar --}}
                <div class="rounded-xl bg-white px-6 py-6 shadow-sm ring-1 ring-slate-200">
                    <p class="text-xs uppercase tracking-wider text-slate-500">Total Kelas Diajar</p>
                    <p class="mt-2 text-4xl text-slate-800">{{ $totalKelasDiajar ?? 0 }}</p>
                    <div class="mt-4 border-t border-slate-100 pt-4">
                        <p class="text-xs text-slate-500">{{ $ringkasanKelas ?? '-' }}</p>
                    </div>
                </div>

                {{-- Beban Jam Pelajaran --}}
                <div class="rounded-xl bg-white px-6 py-6 shadow-sm ring-1 ring-slate-200">
                    <p class="text-xs uppercase tracking-wider text-slate-500">Beban Jam Pelajaran</p>
                    <p class="mt-2 text-4xl text-slate-800">{{ $bebanJam ?? 0 }}</p>
                    <div class="mt-4 border-t border-slate-100 pt-4">
                        <p class="text-xs text-slate-500">Jam / Minggu</p>
                    </div>
                </div>

                {{-- Jurnal Belum Diisi --}}
                <div class="rounded-xl bg-white px-6 py-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between gap-2">
                        <p class="text-xs uppercase tracking-wider text-slate-500">Jurnal Belum Diisi</p>
                        @if(($jurnalBelumDiisi ?? 0) > 0)
                            <span class="rounded border border-red-200 bg-red-50 px-2 py-0.5 text-[10px] text-red-600">Perlu Tindakan</span>
                        @endif
                    </div>
                    <p class="mt-1 text-4xl {{ ($jurnalBelumDiisi ?? 0) > 0 ? 'text-red-600' : 'text-slate-800' }}">{{ $jurnalBelumDiisi ?? 0 }}</p>
                    <div class="mt-4 border-t border-slate-100 pt-4">
                        <p class="flex items-center gap-2 text-xs {{ ($jurnalBelumDiisi ?? 0) > 0 ? 'text-red-600' : 'text-slate-500' }}">
                            <svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ ($jurnalBelumDiisi ?? 0) > 0 ? ($pesanJurnal ?? 'Segera lengkapi nilai hari ini') : ($pesanJurnal ?? 'Semua jurnal telah dilengkapi') }}
                        </p>
                    </div>
                </div>
            </section>

            {{-- Jadwal mengajar --}}
            <section>
                <div class="mb-4 mt-8 flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                    <h3 class="text-lg text-slate-800">Jadwal Mengajar Hari Ini ({{ $namaHariIni ?? '-' }})</h3>
                    <p class="text-xs text-slate-400">Semester {{ $semester ?? '-' }} {{ $tahunAjaran ?? '-' }}</p>
                </div>

                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[820px] text-left">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50/60 text-[11px] uppercase tracking-wider text-slate-500">
                                    <th class="py-4 pl-6 pr-4 font-normal lg:pl-[88px]">Waktu</th>
                                    <th class="px-4 py-4 font-normal">Kelas</th>
                                    <th class="px-4 py-4 font-normal">Mata Pelajaran</th>
                                    <th class="px-4 py-4 font-normal">Ruang</th>
                                    <th class="px-4 py-4 text-center font-normal">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                                @forelse(($jadwalHariIni ?? []) as $jadwalItem)
                                    @php
                                        $jadwalSelesai = ($jadwalItem->statusWaktu ?? '') === 'selesai';
                                        $bisaIsiJurnal = $jadwalItem->bisaIsiJurnal ?? false;
                                    @endphp
                                    <tr class="transition hover:bg-slate-50/60">
                                        <td class="py-[18px] pl-6 pr-4 {{ $jadwalSelesai ? 'text-slate-500' : '' }} lg:pl-[88px]">
                                            <span class="flex items-center gap-2"><span class="h-2 w-2 rounded-full {{ ($jadwalItem->statusWaktu ?? '') === 'berlangsung' ? 'bg-emerald-500' : (($jadwalItem->statusWaktu ?? '') === 'menunggu' ? 'bg-amber-500' : 'bg-slate-300') }}"></span>{{ $jadwalItem->waktu ?? '-' }}</span>
                                        </td>
                                        <td class="px-4 py-[18px] {{ $jadwalSelesai ? 'text-slate-600' : '' }}">{{ $jadwalItem->kelas ?? '-' }}</td>
                                        <td class="px-4 py-[18px] {{ $jadwalSelesai ? 'text-slate-500' : 'text-slate-700' }}">{{ $jadwalItem->mapel ?? '-' }}</td>
                                        <td class="px-4 py-[18px]"><span class="inline-flex rounded border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs {{ $jadwalSelesai ? 'text-slate-500' : 'text-slate-600' }}">{{ $jadwalItem->ruang ?? '-' }}</span></td>
                                        <td class="px-4 py-[18px] text-center">
                                            @if($bisaIsiJurnal)
                                                <a href="{{ $jadwalItem->aksiUrl ?? '#' }}" class="inline-flex items-center gap-1.5 rounded-full bg-brand px-4 py-1.5 text-xs text-white shadow-sm transition hover:bg-brand-dark">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                                                    Isi Jurnal
                                                </a>
                                            @else
                                                <span class="inline-flex cursor-not-allowed items-center gap-1.5 rounded-full border border-slate-200 bg-slate-50 px-4 py-1.5 text-xs text-slate-400">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    Menunggu Waktu
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400">Belum ada jadwal mengajar hari ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            {{-- Info bar --}}
            <div class="flex flex-col gap-2 pt-2 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Jurnal dan Penilaian terintegrasi secara otomatis ke Rapor Digital Siswa {{ $namaYayasan ?? '-' }}.
                </p>
                <span>SIAKAD v{{ $versi ?? '-' }}</span>
            </div>
        </main>
@endsection
