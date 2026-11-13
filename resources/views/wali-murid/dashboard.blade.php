@extends('layouts.wali')

@section('title', 'Dashboard Orang Tua | SIAKAD Panel')
@section('page_title', 'Dashboard Orang Tua')
@section('page_title_class', 'text-base text-slate-900')
@section('page_data', 'waliPage()')
@section('escape_action', 'sidebar = false; modal = false')
@section('year_label', 'Tahun Ajaran ' . ($tahunAjaran ?? '-'))
@section('year_badge_class', 'hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700 sm:inline-flex')
@section('profile_badge_class', 'flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-xs font-medium text-white')
@section('profile_name_class', 'text-xs text-slate-900')
@section('profile_role_class', 'text-[10px] text-slate-500')

@section('page_title_prefix')
    <span class="h-5 w-1 rounded-full bg-brand"></span>
@endsection

@section('year_divider')
    <span class="hidden h-8 w-px bg-slate-200 sm:block"></span>
@endsection

@section('content')
<main class="flex-1 space-y-6 px-4 py-8 sm:px-8">

            {{-- ============ KARTU PROFIL ANAK ============ --}}
            <section class="flex flex-col gap-4 rounded-xl bg-white px-6 py-5 shadow-sm ring-1 ring-slate-200 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <div class="relative shrink-0">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full border-2 border-red-200 bg-red-50 text-lg text-brand">{{ $siswa->inisial ?? '-' }}</div>
                        <span class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-emerald-500"></span>
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-[11px] uppercase tracking-wider text-slate-400">Memantau</span>
                            <span @class(['rounded border px-2 py-0.5 text-[11px]', 'border-amber-200 bg-amber-50 text-amber-700' => ($siswa->status ?? '') === 'Aktif', 'border-slate-200 bg-slate-50 text-slate-600' => ($siswa->status ?? '') !== 'Aktif'])>{{ $siswa->status ?? '-' }}</span>
                        </div>
                        <h1 class="mt-0.5 text-xl text-slate-900">{{ $siswa->nama ?? '-' }}</h1>
                        <p class="mt-0.5 text-[11px] text-slate-500">NIS: {{ $siswa->nis ?? '-' }} &bull; Kelas {{ $siswa->kelas ?? '-' }} - <span class="text-brand">{{ $siswa->sekolah ?? '-' }}</span></p>
                    </div>
                </div>

                <button type="button" @click="modal = true"
                        class="flex w-fit items-center gap-3 rounded-lg border border-sky-200 bg-sky-50 px-4 py-2.5 text-left transition hover:bg-sky-100">
                    <svg class="h-4 w-4 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    <span class="leading-tight">
                        <span class="block text-[11px] text-sky-700">Wali Kelas</span>
                        <span class="block text-xs text-slate-900">Bapak {{ $waliKelas->nama ?? '-' }}</span>
                    </span>
                </button>
            </section>

            {{-- ============ KARTU RINGKASAN ============ --}}
            <section class="grid grid-cols-1 gap-6 md:grid-cols-3">

                {{-- Kehadiran --}}
                <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between">
                        <p class="text-[11px] uppercase tracking-wider text-slate-500">Kehadiran Siswa</p>
                        <span @class(['flex h-8 w-8 items-center justify-center rounded-lg', 'bg-emerald-50 text-emerald-600' => ($ringkasanKeuangan->statusSpp ?? '') === 'LUNAS', 'bg-red-50 text-red-600' => ($ringkasanKeuangan->statusSpp ?? '') !== 'LUNAS'])>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                    </div>
                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <p class="text-[32px] leading-none text-emerald-600">{{ $persentaseKehadiran ?? 0 }}%</p>
                        <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] text-emerald-700">{{ $labelDisiplin ?? '-' }}</span>
                    </div>
                    <p class="mt-4 text-xs text-slate-600">Hadir: {{ $jumlahHadir ?? 0 }} &bull; Sakit/Izin: {{ $jumlahSakitIzin ?? 0 }}</p>
                    <div class="mt-3 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-emerald-500" style="width: {{ $persentaseKehadiran ?? 0 }}%"></div>
                    </div>
                </div>

                {{-- Status SPP --}}
                <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between">
                        <p class="text-[11px] uppercase tracking-wider text-slate-500">Status SPP / Keuangan</p>
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"/></svg>
                        </span>
                    </div>
                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <p @class(['text-[32px] leading-none', 'text-emerald-600' => ($ringkasanKeuangan->statusSpp ?? '') === 'LUNAS', 'text-red-600' => ($ringkasanKeuangan->statusSpp ?? '') !== 'LUNAS'])>{{ $ringkasanKeuangan->statusSpp ?? '-' }}</p>
                        <span @class(['rounded-full px-2.5 py-1 text-[11px]', 'bg-emerald-50 text-emerald-700' => ($ringkasanKeuangan->statusSpp ?? '') === 'LUNAS', 'bg-red-50 text-red-700' => ($ringkasanKeuangan->statusSpp ?? '') !== 'LUNAS'])>{{ $ringkasanKeuangan->statusVerifikasi ?? '-' }}</span>
                    </div>
                    <p class="mt-4 text-xs text-slate-600">Bulan {{ $ringkasanKeuangan->periodeSpp ?? '-' }}</p>
                    <p class="mt-3 flex items-center gap-2 text-xs text-slate-400">
                        <svg @class(['h-3.5 w-3.5', 'text-emerald-500' => ($ringkasanKeuangan->statusSpp ?? '') === 'LUNAS', 'text-red-500' => ($ringkasanKeuangan->statusSpp ?? '') !== 'LUNAS']) fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        {{ $ringkasanKeuangan->pesanStatusSpp ?? '-' }}
                    </p>
                </div>

                {{-- Peringatan akademik --}}
                <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-start justify-between">
                        <p class="text-[11px] uppercase tracking-wider text-slate-500">Peringatan Akademik</p>
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-700">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        </span>
                    </div>
                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <p class="text-[32px] leading-none text-slate-900">{{ $peringatanAkademik->status ?? '-' }}</p>
                        <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] text-slate-700">{{ $peringatanAkademik->label ?? '-' }}</span>
                    </div>
                    <p class="mt-4 text-xs text-slate-600">{{ $peringatanAkademik->keterangan ?? '-' }}</p>
                    <p class="mt-3 flex items-center gap-2 text-xs text-slate-400">
                        <svg class="h-3.5 w-3.5 text-sky-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        {{ $peringatanAkademik->sumberPantauan ?? '-' }}
                    </p>
                </div>
            </section>

            {{-- ============ PEMBARUAN & PENGUMUMAN ============ --}}
            <section class="grid grid-cols-1 items-start gap-6 lg:grid-cols-[1.9fr_1fr]">

                {{-- Pembaruan nilai & transaksi --}}
                <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <h3 class="flex items-center gap-2.5 text-base text-slate-900">
                            <svg class="h-[18px] w-[18px] text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Pembaruan Nilai &amp; Transaksi
                        </h3>
                        <span class="text-[11px] text-slate-400">Aktivitas Terkini</span>
                    </div>

                    <div class="mt-5 space-y-4">
                        <template x-for="a in aktivitas" :key="a.waktu">
                            <article class="flex items-start gap-3.5 rounded-lg border border-slate-200 bg-slate-50/60 p-4">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border" :class="a.ikon.wadah">
                                    <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" x-html="a.ikon.svg"></svg>
                                </span>

                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="rounded px-2 py-0.5 text-[11px]" :class="a.tag.kelas" x-text="a.tag.teks"></span>
                                        <span class="text-[11px] text-slate-400" x-text="a.waktu"></span>
                                    </div>
                                    <p class="mt-1.5 text-sm leading-relaxed text-slate-900" x-html="a.isi"></p>
                                    <p class="mt-1.5 text-[11px] text-slate-500" x-text="a.detail"></p>
                                </div>

                                <span class="shrink-0 whitespace-pre-line rounded border px-2.5 py-1 text-center text-[11px] leading-snug" :class="a.lencana.kelas" x-text="a.lencana.teks"></span>
                            </article>
                        </template>
                    </div>
                </div>

                {{-- Pengumuman --}}
                <div class="flex flex-col rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <h3 class="flex items-center gap-2.5 text-base text-slate-900">
                            <svg class="h-[18px] w-[18px] text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                            Pengumuman
                        </h3>
                        <span class="rounded bg-slate-100 px-2 py-0.5 text-[11px] text-slate-600">Sekolah</span>
                    </div>

                    <div class="mt-5 space-y-4">
                        {{-- Agenda akademik --}}
                        <div class="rounded-lg border border-amber-200 bg-amber-50/70 p-4">
                            <p class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-amber-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>Agenda Akademik
                            </p>
                            <p class="mt-2 text-sm leading-relaxed text-slate-900">{{ $agendaAkademik ?? '-' }}</p>
                            <p class="mt-2 text-[11px] leading-relaxed text-amber-700">{{ $pesanPendampingan ?? '-' }}</p>
                        </div>

                        {{-- Undangan pertemuan --}}
                        <div class="rounded-lg border border-sky-200 bg-sky-50/70 p-4">
                            <p class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-sky-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>Undangan Pertemuan
                            </p>
                            <p class="mt-2 text-sm leading-relaxed text-slate-900">{{ $undanganPertemuan ?? '-' }}</p>
                            <p class="mt-2 text-[11px] leading-relaxed text-sky-700">{{ $informasiPertemuan ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Kartu kontak wali kelas --}}
                    <div class="mt-8 flex items-center justify-between gap-3 rounded-lg border border-slate-200 bg-slate-50/60 px-4 py-3">
                        <div class="flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-900 text-[11px] text-white">{{ $waliKelas->inisial ?? '-' }}</span>
                            <div class="leading-tight">
                                <p class="text-xs text-slate-900">Bapak {{ $waliKelas->nama ?? '-' }}</p>
                                <p class="mt-0.5 text-[10px] text-slate-500">Wali Kelas {{ $waliKelas->kelas ?? '-' }}</p>
                            </div>
                        </div>
                        <button type="button" @click="modal = true"
                                class="rounded border border-red-200 bg-white px-3 py-1.5 text-[11px] text-brand transition hover:bg-red-50">Kontak</button>
                    </div>
                </div>
            </section>

            {{-- Info bar --}}
            <div class="flex flex-col gap-2 border-t border-slate-200 pt-5 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Data pemantauan terintegrasi secara terpusat {{ $namaYayasan ?? '-' }}.
                </p>
                <span class="text-slate-400">SIAKAD v{{ $versi ?? '-' }}</span>
            </div>
        </main>
@endsection

@section('outside_content')
{{-- ===================== MODAL KONTAK WALI KELAS ===================== --}}
<div x-cloak x-show="modal" class="fixed inset-0 z-50 flex items-center justify-center p-4"
     role="dialog" aria-modal="true" aria-labelledby="modal-title">

    <div x-show="modal" x-transition.opacity @click="modal = false"
         class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

    <div x-show="modal"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative w-full max-w-sm overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-slate-100">

        <div class="flex items-start justify-between border-b border-slate-100 px-6 py-4">
            <div>
                <h3 id="modal-title" class="text-base text-slate-900">Kontak Wali Kelas</h3>
                <p class="mt-0.5 text-xs text-slate-500">Hubungi wali kelas untuk koordinasi.</p>
            </div>
            <button type="button" @click="modal = false" aria-label="Tutup"
                    class="rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="px-6 py-5">
            <div class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-full bg-slate-900 text-xs text-white">{{ $waliKelas->inisial ?? '-' }}</span>
                <div class="leading-tight">
                    <p class="text-sm text-slate-900">Bapak {{ $waliKelas->nama ?? '-' }}</p>
                    <p class="mt-0.5 text-xs text-slate-500">Wali Kelas {{ $waliKelas->kelas ?? '-' }} - {{ $siswa->sekolah ?? '-' }}</p>
                </div>
            </div>
            <dl class="mt-5 space-y-3 text-sm">
                <div class="flex justify-between gap-4"><dt class="text-slate-500">WhatsApp</dt><dd class="text-slate-900">{{ $waliKelas->telepon ?? '-' }}</dd></div>
                <div class="flex justify-between gap-4"><dt class="text-slate-500">Email</dt><dd class="text-slate-900">{{ $waliKelas->email ?? '-' }}</dd></div>
                <div class="flex justify-between gap-4"><dt class="text-slate-500">Jam konsultasi</dt><dd class="text-slate-900">{{ $waliKelas->jamKonsultasi ?? '-' }}</dd></div>
            </dl>
        </div>

        <div class="flex justify-end gap-2.5 bg-slate-50 px-6 py-4">
            <button type="button" @click="modal = false"
                    class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-50">Tutup</button>
            <a href="#"
               class="inline-flex items-center gap-2 rounded-lg bg-brand px-4 py-2 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark">
                Hubungi via WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('waliPage', () => ({
            sidebar: false,
            modal: false,

            aktivitas: @json($aktivitas ?? []),
        }));
    });
</script>
@endpush
