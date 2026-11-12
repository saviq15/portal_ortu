@extends('layouts.wali')

@section('title', 'Jurnal Belajar Mingguan | SIAKAD Panel')
@section('page_title', 'Jurnal Belajar Mingguan')
@section('page_title_class', 'text-base text-slate-900')
@section('page_data', 'kbmPage()')
@section('escape_action', 'sidebar = false; tutup()')
@section('year_label', 'Tahun Ajaran 2026/2027')
@section('year_badge_class', 'hidden items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs text-emerald-700 sm:inline-flex')
@section('profile_badge_class', 'flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-xs font-medium text-white')
@section('profile_name_class', 'text-sm text-slate-900')
@section('profile_role_class', 'text-[11px] text-slate-500')

@section('page_title_prefix')
    <span class="h-5 w-1 rounded-full bg-brand"></span>
@endsection

@section('content')
<main class="flex-1 space-y-6 px-4 py-8 sm:px-8">

            {{-- ============ KARTU SISWA ============ --}}
            <section class="flex flex-col gap-3 rounded-xl bg-white px-5 py-4 shadow-sm ring-1 ring-slate-200 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border-2 border-amber-300 bg-amber-50 text-sm text-amber-700">AF</div>
                    <div>
                        <p class="text-base text-slate-900">Ahmad Fauzi <span class="mx-1 text-slate-300">|</span> X TKJ 1 - SMK Nusantara</p>
                        <p class="mt-0.5 text-[11px] text-slate-500">NIS: 20261001 &bull; Status: Siswa Aktif</p>
                    </div>
                </div>
                <span class="inline-flex w-fit items-center gap-2 rounded-full border border-sky-200 bg-sky-50 px-3.5 py-1.5 text-xs text-sky-700">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    Wali Kelas: Bapak Heri Susanto
                </span>
            </section>

            {{-- ============ JUDUL + FILTER ============ --}}
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <h1 class="text-2xl tracking-tight text-slate-900">Tracking Materi &amp; Kehadiran</h1>
                    <p class="mt-2 text-sm text-slate-500">Pantau materi pelajaran, capaian pemahaman siswa, dan berikan tanggapan.</p>
                </div>
                <div class="flex gap-3">
                    <div class="relative w-40">
                        <select x-model="bulan" aria-label="Pilih bulan"
                                class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-3 pl-4 pr-9 text-sm text-slate-800 shadow-sm transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <option>September 2026</option>
                            <option>Oktober 2026</option>
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </span>
                    </div>
                    <div class="relative w-36">
                        <select x-model="minggu" aria-label="Pilih minggu"
                                class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-3 pl-4 pr-9 text-sm text-slate-800 shadow-sm transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <option value="1">Minggu ke-1</option>
                            <option value="2">Minggu ke-2</option>
                            <option value="3">Minggu ke-3</option>
                            <option value="4">Minggu ke-4</option>
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </span>
                    </div>
                </div>
            </div>

            {{-- ============ BUKU JURNAL HARIAN ============ --}}
            <section class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">

                <div class="flex flex-col gap-1 border-b border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="flex flex-wrap items-center gap-2 text-sm text-slate-900">
                        <span class="h-2.5 w-2.5 rounded-full bg-gold"></span>
                        Buku Jurnal Harian Pembelajaran (KBM)
                        <span class="text-[11px] text-slate-400" x-text="'• Periode: ' + periode.rentang"></span>
                    </p>
                    <p class="text-xs text-slate-600">Total Pertemuan Pekan Ini: <span class="text-slate-900" x-text="periode.sesi + ' Sesi'"></span></p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[980px] text-left">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/70 text-[11px] uppercase tracking-wider text-slate-500">
                                <th class="py-5 pl-6 pr-4 font-normal">Hari / Tgl</th>
                                <th class="px-4 py-5 font-normal leading-snug">Mapel &amp;<br>Guru</th>
                                <th class="px-4 py-5 font-normal leading-snug">Materi<br>Pokok</th>
                                <th class="px-4 py-5 font-normal">Capaian &amp; Catatan</th>
                                <th class="px-4 py-5 text-center font-normal">Hadir</th>
                                <th class="py-5 pl-4 pr-6 text-center font-normal">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-800">

                            <template x-for="r in baris" :key="r.id">
                                <tr class="transition hover:bg-slate-50/50">
                                    {{-- Hari / tanggal --}}
                                    <td class="py-6 pl-6 pr-4">
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md text-xs"
                                                  :class="r.hadir === 'Hadir' ? 'bg-slate-100 text-slate-600' : 'border border-red-200 bg-red-50 text-red-600'"
                                                  x-text="r.tgl"></span>
                                            <div>
                                                <p class="text-sm" :class="r.hadir === 'Hadir' ? 'text-slate-900' : 'text-slate-900'" x-text="r.hari + ', ' + r.tgl + ' ' + r.bln"></p>
                                                <p class="mt-0.5 text-[11px] text-slate-400" x-text="r.jam"></p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Mapel & guru --}}
                                    <td class="px-4 py-6">
                                        <p class="max-w-[110px] text-slate-900" x-text="r.mapel"></p>
                                        <p class="mt-1 max-w-[90px] text-[11px] leading-snug text-slate-400" x-text="r.guru"></p>
                                    </td>

                                    {{-- Materi --}}
                                    <td class="px-4 py-6"><p class="max-w-[110px] text-slate-900" x-text="r.materi"></p></td>

                                    {{-- Capaian & catatan --}}
                                    <td class="px-4 py-6">
                                        <span class="inline-flex rounded-full border px-2.5 py-0.5 text-[11px]" :class="kelasStatus(r.status)" x-text="labelStatus(r)"></span>
                                        <p class="mt-2 max-w-[250px] text-[11px] leading-relaxed text-slate-600" x-text="r.catatan"></p>
                                    </td>

                                    {{-- Hadir --}}
                                    <td class="px-4 py-6 text-center">
                                        <span class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-[11px]"
                                              :class="r.hadir === 'Hadir' ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-red-200 bg-red-50 text-red-600'">
                                            <span class="h-1.5 w-1.5 rounded-full" :class="r.hadir === 'Hadir' ? 'bg-emerald-500' : 'bg-red-500'"></span>
                                            <span x-text="r.hadir"></span>
                                        </span>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="py-6 pl-4 pr-6 text-center">
                                        {{-- Hadir: beri tanggapan --}}
                                        <template x-if="r.hadir === 'Hadir'">
                                            <div>
                                                <button type="button" x-show="!r.tanggapan" @click="bukaTanggapan(r)"
                                                        class="inline-flex items-center gap-2 rounded-md border border-slate-200 bg-white px-3.5 py-2 text-xs text-slate-700 shadow-sm transition hover:bg-slate-50">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/></svg>
                                                    Beri Tanggapan
                                                </button>
                                                <span x-show="r.tanggapan" class="inline-flex items-center gap-1.5 text-xs text-emerald-600">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                                    Tanggapan Terkirim
                                                </span>
                                            </div>
                                        </template>

                                        {{-- Tidak hadir: ajukan sanggahan --}}
                                        <template x-if="r.hadir !== 'Hadir'">
                                            <div>
                                                <button type="button" x-show="!r.sanggahan" @click="bukaSanggahan(r)"
                                                        class="inline-flex items-center gap-2 rounded-md bg-brand px-3.5 py-2 text-xs text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                                                    Ajukan Sanggahan
                                                </button>
                                                <span x-show="r.sanggahan" class="inline-flex items-center gap-1.5 rounded-md border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs text-amber-700">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    Menunggu Verifikasi
                                                </span>
                                            </div>
                                        </template>
                                    </td>
                                </tr>
                            </template>

                            <tr x-cloak x-show="baris.length === 0">
                                <td colspan="6" class="px-6 py-14 text-center text-sm text-slate-400">Belum ada log kegiatan pembelajaran pada periode ini.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Footer tabel --}}
                <div class="flex flex-col gap-2 border-t border-slate-200 bg-slate-50/60 px-6 py-3.5 text-[11px] text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                    <p x-html="'Menampilkan <span class=&quot;text-slate-900&quot;>' + baris.length + '</span> dari <span class=&quot;text-slate-900&quot;>' + baris.length + '</span> log kegiatan pembelajaran yang tercatat'"></p>
                    <p class="flex items-center gap-2" x-show="baris.length > 0">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        <span x-text="'Terakhir diperbarui guru: ' + periode.update"></span>
                    </p>
                </div>
            </section>

            {{-- Informasi penting --}}
            <div class="flex items-start gap-3 rounded-xl border border-amber-200 bg-amber-50/70 px-5 py-4 text-sm leading-relaxed text-amber-900">
                <svg class="mt-0.5 h-5 w-5 shrink-0 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p><span class="text-slate-900">Informasi Penting:</span> Tanggapan atau sanggahan (misalnya mengonfirmasi anak sakit namun tercatat alpa, atau anak kesulitan menangkap materi aljabar) akan langsung diteruskan ke Panel Wali Kelas untuk ditindaklanjuti.</p>
            </div>

            {{-- Info bar --}}
            <div class="flex flex-col gap-2 border-t border-slate-200 pt-5 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2">
                    <svg class="h-4 w-4 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    Logbook Digital Terpadu Yayasan Nurun 'Alannur (MI &amp; SMK)
                </p>
                <span>SIAKAD v2.4.0</span>
            </div>
        </main>
@endsection

@section('outside_content')
{{-- =====================================================================
     MODAL 1 : BERI TANGGAPAN PEMBELAJARAN (FOTO 2)
     ===================================================================== --}}
<div x-cloak x-show="modal === 'tanggapan'" class="fixed inset-0 z-50 flex items-center justify-center p-4"
     role="dialog" aria-modal="true" aria-labelledby="judul-tanggapan">

    <div x-show="modal === 'tanggapan'" x-transition.opacity @click="tutup()"
         class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

    <div x-show="modal === 'tanggapan'"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative flex max-h-[95vh] w-full max-w-lg flex-col overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-slate-100">

        <div class="flex items-start justify-between border-b border-slate-100 px-6 py-5">
            <div>
                <h3 id="judul-tanggapan" class="text-base text-slate-900">Beri Tanggapan Pembelajaran</h3>
                <p class="mt-1 text-xs text-slate-500">Tanggapan Anda akan dikirim langsung ke Guru Mata Pelajaran.</p>
            </div>
            <button type="button" @click="tutup()" aria-label="Tutup"
                    class="rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        {{-- {{ route('tanggapan.store') }} --}}
        <form action="#" method="POST" @submit.prevent="kirimTanggapan()" class="flex min-h-0 flex-1 flex-col">
            @csrf
            <template x-if="sel">
                <div class="flex-1 overflow-y-auto px-6 py-6">

                    {{-- Ringkasan sesi --}}
                    <div class="relative rounded-lg border border-sky-200 bg-sky-50/70 px-4 py-4">
                        <span class="absolute right-3 top-3 rounded-full border px-2.5 py-0.5 text-[11px]" :class="kelasStatus(sel.status)" x-text="labelStatus(sel)"></span>
                        <p class="text-[11px] text-slate-500">Mata Pelajaran:</p>
                        <p class="text-sm text-slate-900" x-text="sel.mapel + ' (' + sel.guru + ')'"></p>
                        <p class="mt-2 text-[11px] text-slate-500">Materi Pokok:</p>
                        <p class="text-sm text-slate-900" x-text="sel.materi"></p>
                        <div class="mt-3 border-t border-sky-100 pt-3">
                            <p class="text-[11px] text-slate-500">Catatan Guru:</p>
                            <p class="mt-0.5 text-xs text-slate-900" x-text="'“' + sel.catatan + '”'"></p>
                        </div>
                    </div>

                    <label for="tanggapan" class="mb-2 mt-6 block text-[11px] uppercase tracking-wider text-slate-700">Tulis Tanggapan <span class="text-red-500">*</span></label>
                    <textarea id="tanggapan" name="tanggapan" rows="4" required x-model="form.tanggapan"
                              placeholder="Contoh: Terima kasih Pak atas bimbingannya. Alhamdulillah di rumah anak saya juga antusias mempraktikkan ulang materi ini..."
                              class="block w-full resize-none rounded-lg border border-slate-300 bg-white px-3.5 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20"></textarea>
                    <p class="mt-2.5 flex items-center gap-1.5 text-[11px] text-slate-500">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Tanggapan yang baik membantu guru memahami perkembangan anak di rumah.
                    </p>
                </div>
            </template>

            <div class="flex justify-end gap-2.5 border-t border-slate-100 bg-slate-50/60 px-6 py-4">
                <button type="button" @click="tutup()"
                        class="rounded-lg border border-slate-200 bg-white px-5 py-2 text-sm text-slate-800 transition hover:bg-slate-50">Batal</button>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-brand px-5 py-2 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                    Kirim Tanggapan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- =====================================================================
     MODAL 2 : AJUKAN SANGGAHAN / KOREKSI DATA (FOTO 3)
     ===================================================================== --}}
<div x-cloak x-show="modal === 'sanggahan'" class="fixed inset-0 z-50 flex items-center justify-center p-4"
     role="dialog" aria-modal="true" aria-labelledby="judul-sanggahan">

    <div x-show="modal === 'sanggahan'" x-transition.opacity @click="tutup()"
         class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

    <div x-show="modal === 'sanggahan'"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative flex max-h-[95vh] w-full max-w-lg flex-col overflow-hidden rounded-2xl border-t-4 border-red-600 bg-white shadow-2xl ring-1 ring-slate-100">

        <div class="flex items-start justify-between border-b border-slate-100 px-6 py-5">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-red-100 bg-red-50 text-red-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                </span>
                <div>
                    <h3 id="judul-sanggahan" class="text-base text-slate-900">Ajukan Sanggahan / Koreksi Data</h3>
                    <p class="mt-0.5 text-xs text-slate-500">Laporkan ketidaksesuaian presensi atau catatan materi ke Wali Kelas.</p>
                </div>
            </div>
            <button type="button" @click="tutup()" aria-label="Tutup"
                    class="rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        {{-- {{ route('sanggahan.store') }} --}}
        <form action="#" method="POST" enctype="multipart/form-data" @submit.prevent="kirimSanggahan()" class="flex min-h-0 flex-1 flex-col">
            @csrf
            <template x-if="sel">
                <div class="flex-1 overflow-y-auto px-6 py-6">

                    {{-- Ringkasan data tercatat --}}
                    <dl class="divide-y divide-red-100 rounded-lg border border-red-100 bg-red-50/70 px-4 text-xs">
                        <div class="flex items-center justify-between gap-4 py-2.5">
                            <dt class="uppercase tracking-wider text-slate-500">Hari / Tanggal:</dt>
                            <dd class="text-right text-slate-900" x-text="sel.hari + ', ' + sel.tgl + ' ' + sel.bln.replace('Okt', 'Okt') + ' 2026 (' + sel.jam.replace(' - ', ' - ') + ')'"></dd>
                        </div>
                        <div class="flex items-center justify-between gap-4 py-2.5">
                            <dt class="uppercase tracking-wider text-slate-500">Mata Pelajaran:</dt>
                            <dd class="text-right text-slate-900" x-text="sel.mapel + ' (' + sel.guru + ')'"></dd>
                        </div>
                        <div class="flex items-center justify-between gap-4 py-2.5">
                            <dt class="uppercase tracking-wider text-slate-500">Status Tercatat:</dt>
                            <dd>
                                <span class="inline-flex items-center gap-1.5 rounded-full border border-red-200 bg-red-50 px-2.5 py-0.5 text-[11px] text-red-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                    <span x-text="sel.hadir + ' (' + sel.status + ')'"></span>
                                </span>
                            </dd>
                        </div>
                    </dl>

                    {{-- Alasan --}}
                    <label for="alasan" class="mb-2 mt-5 block text-[11px] uppercase tracking-wider text-slate-700">Pilih Alasan / Jenis Koreksi <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="alasan" name="alasan" required x-model="form.alasan"
                                class="block w-full appearance-none rounded-lg border border-slate-300 bg-white py-3 pl-3.5 pr-10 text-sm text-slate-800 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <option value="">Pilih kendala...</option>
                            <option>Anak sakit (ada surat dokter)</option>
                            <option>Izin keperluan keluarga</option>
                            <option>Kendala transportasi / cuaca</option>
                            <option>Salah input presensi oleh guru</option>
                            <option>Lainnya</option>
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </span>
                    </div>

                    {{-- Keterangan --}}
                    <label for="keterangan" class="mb-2 mt-5 block text-[11px] uppercase tracking-wider text-slate-700">Keterangan Detail Sanggahan <span class="text-red-500">*</span></label>
                    <textarea id="keterangan" name="keterangan" rows="3" required x-model="form.keterangan"
                              placeholder="Jelaskan alasan secara jelas agar Wali Kelas dapat segera memproses koreksi data presensi..."
                              class="block w-full resize-none rounded-lg border border-slate-300 bg-white px-3.5 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20"></textarea>
                    <p class="mt-1.5 text-[11px] text-slate-400">Harap sertakan kronologi singkat atau nama surat jika ada.</p>

                    {{-- Unggah bukti --}}
                    <p class="mb-2 mt-5 text-[11px] uppercase tracking-wider text-slate-700">Unggah Bukti Pendukung (Opsional)</p>
                    <input type="file" name="bukti" class="hidden" x-ref="berkas" accept=".jpg,.jpeg,.png,.pdf" @change="pilihBerkas($event.target.files[0])">
                    <div @click="$refs.berkas.click()"
                         @dragover.prevent="seret = true" @dragleave.prevent="seret = false"
                         @drop.prevent="seret = false; pilihBerkas($event.dataTransfer.files[0])"
                         class="cursor-pointer rounded-lg border-2 border-dashed px-4 py-5 text-center transition"
                         :class="seret ? 'border-brand bg-red-50/40' : 'border-slate-300 hover:bg-slate-50'">
                        <svg class="mx-auto h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"/></svg>
                        <template x-if="!berkas">
                            <div>
                                <p class="mt-1.5 text-xs text-slate-700">Klik untuk memilih berkas atau seret file ke sini</p>
                                <p class="mt-1 text-[10px] text-slate-400">Format: JPG, PNG, atau PDF (Maks. 2MB)</p>
                            </div>
                        </template>
                        <template x-if="berkas">
                            <p class="mt-1.5 text-xs text-emerald-700" x-text="'✓ ' + berkas.name + ' (' + Math.round(berkas.size / 1024) + ' KB)'"></p>
                        </template>
                    </div>
                    <p x-cloak x-show="galat" class="mt-1.5 text-[11px] text-red-600" x-text="galat"></p>

                    {{-- Catatan --}}
                    <div class="mt-5 flex items-start gap-2.5 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-xs leading-relaxed text-amber-900">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p>Laporan sanggahan akan diverifikasi langsung oleh Bapak Heri Susanto selaku Wali Kelas X TKJ 1 sebelum status presensi diperbarui di sistem.</p>
                    </div>
                </div>
            </template>

            <div class="flex justify-end gap-2.5 border-t border-slate-100 bg-slate-50/60 px-6 py-4">
                <button type="button" @click="tutup()"
                        class="rounded-lg border border-slate-200 bg-white px-5 py-2 text-sm text-slate-800 transition hover:bg-slate-50">Batal</button>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-brand px-5 py-2 text-sm text-white shadow-md shadow-brand/30 transition hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                    Kirim Sanggahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Notifikasi (simulasi) --}}
<div x-cloak x-show="toast" x-transition
     class="fixed bottom-6 right-6 z-[60] flex items-center gap-2.5 rounded-lg bg-slate-900 px-4 py-3 text-sm text-white shadow-xl">
    <svg class="h-4 w-4 text-emerald-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
    <span x-text="pesan"></span>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('kbmPage', () => ({
            sidebar: false,
            modal: null,          // null | 'tanggapan' | 'sanggahan'
            sel: null,
            form: { tanggapan: '', alasan: '', keterangan: '' },
            berkas: null, seret: false, galat: '',
            toast: false, pesan: '', toastTimer: null,

            bulan: 'Oktober 2026',
            minggu: '4',

            // Data dummy (frontend saja)
            data: {
                'Oktober 2026|4': {
                    rentang: '26 - 30 Oktober 2026', sesi: 5, update: 'Rabu, 28 Okt 2026 • 12:45 WIB',
                    baris: [
                        { id: 1, tgl: '26', hari: 'Senin',  bln: 'Okt', jam: '07:30 - 09:45', mapel: 'Dasar Jaringan',   guru: 'Bapak Heri Susanto', materi: 'Pengenalan Topologi Star & Ring', status: 'Tuntas',          nilai: 85, catatan: 'Mampu mempraktikkan crimping kabel dengan sangat baik.', hadir: 'Hadir', tanggapan: false, sanggahan: false },
                        { id: 2, tgl: '27', hari: 'Selasa', bln: 'Okt', jam: '10:15 - 11:45', mapel: 'Matematika',       guru: 'Ibu Ratna',          materi: 'Aljabar Linear',                  status: 'Perlu Bimbingan', nilai: 60, catatan: 'Masih kebingungan dalam metode substitusi. Mohon dipantau latihan soal di rumah.', hadir: 'Hadir', tanggapan: false, sanggahan: false },
                        { id: 3, tgl: '28', hari: 'Rabu',   bln: 'Okt', jam: '08:15 - 10:30', mapel: 'Bahasa Indonesia', guru: 'Bapak Anton',        materi: 'Teks Laporan Hasil Observasi',    status: 'Belum Dinilai',   nilai: null, catatan: '-', hadir: 'Alpa', tanggapan: false, sanggahan: false },
                    ],
                },
                'Oktober 2026|3': {
                    rentang: '19 - 23 Oktober 2026', sesi: 5, update: 'Jumat, 23 Okt 2026 • 13:10 WIB',
                    baris: [
                        { id: 11, tgl: '19', hari: 'Senin',  bln: 'Okt', jam: '07:30 - 09:45', mapel: 'Dasar Jaringan',         guru: 'Bapak Heri Susanto', materi: 'Model OSI dan TCP/IP',      status: 'Tuntas', nilai: 82, catatan: 'Aktif bertanya dan cepat memahami lapisan jaringan.', hadir: 'Hadir', tanggapan: false, sanggahan: false },
                        { id: 12, tgl: '21', hari: 'Rabu',   bln: 'Okt', jam: '08:15 - 10:30', mapel: 'Pendidikan Agama Islam', guru: 'Ustadz Ahmad Fauzi', materi: 'Hafalan Surat Al-Mulk',     status: 'Tuntas', nilai: 88, catatan: 'Tajwid sudah baik, makhraj perlu dilatih lagi.',        hadir: 'Hadir', tanggapan: false, sanggahan: false },
                    ],
                },
                'September 2026|4': {
                    rentang: '21 - 25 September 2026', sesi: 5, update: 'Jumat, 25 Sep 2026 • 12:30 WIB',
                    baris: [
                        { id: 21, tgl: '22', hari: 'Selasa', bln: 'Sep', jam: '10:15 - 11:45', mapel: 'Matematika', guru: 'Ibu Ratna', materi: 'Persamaan Linear', status: 'Tuntas', nilai: 78, catatan: 'Sudah mampu menyelesaikan soal dasar dengan teliti.', hadir: 'Hadir', tanggapan: false, sanggahan: false },
                    ],
                },
            },

            get periode() {
                return this.data[this.bulan + '|' + this.minggu] || { rentang: '-', sesi: 0, update: '-', baris: [] };
            },
            get baris() { return this.periode.baris; },

            kelasStatus(s) {
                if (s === 'Tuntas')          return 'border-emerald-200 bg-emerald-50 text-emerald-700';
                if (s === 'Perlu Bimbingan') return 'border-amber-300 bg-amber-50 text-amber-700';
                return 'border-slate-200 bg-slate-100 text-slate-600';
            },
            labelStatus(r) {
                return r.nilai !== null && r.nilai !== undefined ? r.status + ' (Nilai: ' + r.nilai + ')' : r.status;
            },

            bukaTanggapan(r) { this.sel = r; this.form.tanggapan = ''; this.modal = 'tanggapan'; },
            bukaSanggahan(r) { this.sel = r; this.form.alasan = ''; this.form.keterangan = ''; this.berkas = null; this.galat = ''; this.modal = 'sanggahan'; },
            tutup() { this.modal = null; },

            pilihBerkas(f) {
                this.galat = '';
                if (!f) return;
                const ok = /\.(jpe?g|png|pdf)$/i.test(f.name);
                if (!ok)               { this.galat = 'Format berkas harus JPG, PNG, atau PDF.'; this.berkas = null; return; }
                if (f.size > 2 * 1024 * 1024) { this.galat = 'Ukuran berkas maksimal 2MB.'; this.berkas = null; return; }
                this.berkas = f;
            },

            kirimTanggapan() {
                if (!this.form.tanggapan.trim()) return;
                this.sel.tanggapan = true;
                this.tutup();
                this.notif('Tanggapan berhasil dikirim ke ' + this.sel.guru + '.');
            },
            kirimSanggahan() {
                if (!this.form.alasan || !this.form.keterangan.trim()) return;
                this.sel.sanggahan = true;
                this.tutup();
                this.notif('Sanggahan terkirim, menunggu verifikasi Wali Kelas.');
            },

            notif(teks) {
                this.pesan = teks;
                this.toast = true;
                clearTimeout(this.toastTimer);
                this.toastTimer = setTimeout(() => this.toast = false, 3500);
            },
        }));
    });
</script>
@endpush
