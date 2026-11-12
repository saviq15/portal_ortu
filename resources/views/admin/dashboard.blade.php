@extends('layouts.admin')

@section('title', 'Dashboard Admin | SIAKAD Panel')
@section('page_title', 'Dashboard Admin')
@section('page_data', '{ sidebar: false }')
@section('escape_action', 'sidebar = false')
@section('year_label')
Tahun Ajaran {{ $tahunAjaran }}
@endsection

@section('content')
        <main class="flex-1 space-y-8 px-4 py-6 sm:px-8 sm:py-8">

            {{-- Kartu selamat datang --}}
            <section class="flex flex-col gap-4 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-100 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-slate-900 sm:text-2xl">Selamat Datang, {{ $adminName }}</h1>
                    <p class="mt-1.5 text-sm text-slate-500">Sistem Informasi Laporan Siswa MI Internasional &amp; SMK Nusantara.</p>
                </div>
                <span class="inline-flex w-fit items-center gap-2 rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-600">
                    <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Sesi Aktif
                </span>
            </section>

            {{-- Ikhtisar data yayasan --}}
            <section>
                <h3 class="mb-3 text-[11px] font-semibold uppercase tracking-wider text-slate-500">Ikhtisar Data Yayasan</h3>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                    {{-- Total Unit Sekolah --}}
                    <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
                        <div class="flex items-start justify-between">
                            <p class="text-sm text-slate-500">Total Unit Sekolah</p>
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-brand">
                                <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                </svg>
                            </span>
                        </div>
                        <p class="mt-3 text-4xl font-bold text-brand">{{ $totalUnit }}</p>
                        <p class="mt-3 text-[11px] text-slate-500">MI Internasional &amp; SMK Nusantara</p>
                    </div>

                    {{-- Total Pendidik & Staf --}}
                    <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
                        <div class="flex items-start justify-between">
                            <p class="text-sm text-slate-500">Total Pendidik &amp; Staf</p>
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-brand">
                                <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>
                                </svg>
                            </span>
                        </div>
                        <p class="mt-3 text-4xl font-bold text-brand">{{ $totalPendidikStaf }}</p>
                        <p class="mt-3 inline-flex items-center gap-1 text-[11px] font-medium text-emerald-600">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                            -
                        </p>
                    </div>

                    {{-- Total Peserta Didik --}}
                    <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
                        <div class="flex items-start justify-between">
                            <p class="text-sm text-slate-500">Total Peserta Didik</p>
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-brand">
                                <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                                </svg>
                            </span>
                        </div>
                        <p class="mt-3 text-4xl font-bold text-brand">{{ $totalSiswa }}</p>
                        <p class="mt-3 flex items-center gap-2 text-[11px] text-slate-500">
                            <span>SMK: {{ $siswaSmk }} Siswa</span>
                            <span class="h-3 w-px bg-slate-300"></span>
                            <span>MI: {{ $siswaMi }} Siswa</span>
                        </p>
                    </div>
                </div>
            </section>

            {{-- Akses cepat modul pelaporan --}}
            <section>
                <h3 class="text-lg font-bold text-slate-900">Akses Cepat Modul Pelaporan</h3>
                <p class="mt-1 text-xs text-slate-500">Pintas navigasi langsung ke evaluasi capaian dan transaksi administratif harian.</p>

                <div class="mt-4 grid grid-cols-1 gap-5 md:grid-cols-3">

                    {{-- Evaluasi Calistung --}}
                    <div class="flex flex-col rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg border border-amber-100 bg-amber-50 text-amber-500">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                            </svg>
                        </span>
                        <h4 class="mt-4 text-sm font-bold text-slate-900">Evaluasi Calistung (MI)</h4>
                        <p class="mt-2 max-w-[220px] text-[11px] leading-relaxed text-slate-500">Pantau jurnal capaian baca tulis hitung kelas 1.</p>
                        <div class="mt-auto border-t border-slate-100 pt-4">
                            <a href="#" class="mt-5 inline-flex items-center gap-1.5 text-xs font-semibold text-amber-600 hover:text-amber-700">
                                Kelola
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Kehadiran & Nilai --}}
                    <div class="flex flex-col rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg border border-blue-100 bg-blue-50 text-blue-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"/>
                            </svg>
                        </span>
                        <h4 class="mt-4 text-sm font-bold text-slate-900">Kehadiran &amp; Nilai (SMK)</h4>
                        <p class="mt-2 max-w-[220px] text-[11px] leading-relaxed text-slate-500">Pantau absensi harian dan kelulusan materi SMK.</p>
                        <div class="mt-auto border-t border-slate-100 pt-4">
                            <a href="#" class="mt-5 inline-flex items-center gap-1.5 text-xs font-semibold text-amber-600 hover:text-amber-700">
                                Kelola
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Rekap Pembayaran --}}
                    <div class="flex flex-col rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg border border-emerald-100 bg-emerald-50 text-emerald-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                            </svg>
                        </span>
                        <h4 class="mt-4 text-sm font-bold text-slate-900">Rekap Pembayaran</h4>
                        <p class="mt-2 max-w-[220px] text-[11px] leading-relaxed text-slate-500">Pantau tabungan MI dan tagihan SPP SMK (Manual).</p>
                        <div class="mt-auto border-t border-slate-100 pt-4">
                            <a href="#" class="mt-5 inline-flex items-center gap-1.5 text-xs font-semibold text-amber-600 hover:text-amber-700">
                                Kelola
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Bar info --}}
            <section class="flex flex-col gap-2 rounded-lg border border-slate-200 bg-white/60 px-4 py-3 text-[11px] text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-3.5 w-3.5 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                    </svg>
                    Data terintegrasi secara terpusat untuk Yayasan Nurun 'Alannur (MI Internasional &amp; SMK Nusantara).
                </p>
                <span class="text-slate-400">Sistem versi {{ $versi }}</span>
            </section>
        </main>
@endsection
